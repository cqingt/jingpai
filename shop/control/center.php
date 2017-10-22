<?php
/**
 * CLASS center 仅能从centerapi入口进入
 *
 * 接口内容操作模型
 *
 * author：Xin
 *
 * date：2015.10.13
 */


defined('InShopNC') or exit('Access Invalid!');
class centerControl{

    public function __construct() {
        $this->core = $GLOBALS['center_core'];
        $this->params = $GLOBALS['params'];
        if(!is_object($this->core)){
            exit('null');
        }
        if(!is_array($this->params) || empty($this->params)){
            exit('null');
        }
        $this->M_member = Model('member');
	}

	/**
	 * 入口
	 */
    public function indexOp() {
        $this->core->res_message('fail',"invalid method");
        exit;
	}

	/**
     * @ 接口：CRM产品退货减去用户藏豆 du 2016-06-13
     * 应用级参数：
     * order_id 订单编号
	 * total_price 金额
     */
    public function CrmJianQuZengSongCangDouOp(){
        $order_id = $this->params['order_id'];
		$total_price = $this->params['total_price'];
        if(!empty($order_id)){
           $model_order= Model('order');
            $order_goods_info = $model_order->getOrderInfo(array('order_id'=>$order_id,'order_state'=>40),array(),'buyer_id');
		   if(!empty($order_goods_info) && is_array($order_goods_info)){
				//减去用户藏豆
				Model('pushuser_gift')->setUserJianQuPoints($order_goods_info['buyer_id'],$order_id,$total_price);
		   }else{
				$this->core->res_message('fail',"underfind not order_id");
		   }
        }else{
            $this->core->res_message('fail',"missing order_id");
        }
    }




	/**
     * @ 接口：CRM发货发送微信通知  du 2016-04-14
     * 应用级参数：
     * order_id 订单编号 kuaidi_name 快递公司 kuaidi_sn 快递编号
     */
	public function CrmFaHuoTongZhiOp(){
		$kuaidi_name = $this->params['kuaidi_name'];
        $order_id = $this->params['order_id'];
        $kuaidi_sn = $this->params['kuaidi_sn'];
		if(!empty($order_id)){
           $model_order= Model('order');
            $order_goods_info = $model_order->getOrderInfo(array('order_id'=>$order_id),array('order_goods'));
		   if(!empty($order_goods_info) && is_array($order_goods_info)){
				$member_info = Model('member')->getMemberInfoByID($order_goods_info['buyer_id']);
				foreach ($order_goods_info['extend_order_goods'] as $k => $v) {
					$goods_name_list .= $v['goods_name']."\n";
				}
				$dataArr['first'] = $order_goods_info['buyer_name'].',您好！您有一笔订单已发货，'."{$kuaidi_name}:{$kuaidi_sn}".',请保持电话畅通静等快递小哥上门吧~';
				$dataArr['keyword1'] = $order_goods_info['order_sn'];
				$dataArr['keyword2'] = $order_goods_info['order_amount'];
				$dataArr['keyword3'] = $goods_name_list;
				$dataArr['remark'] = "\n".'如果您有任何疑问，可咨询在线客服或致电客户服热线400-81-96567，我们将竭诚为您服务。';
				$wx_param = array(
					 'func'=>'order_notice',
					 'template_id'=>'',
					 'openid'=>$member_info['openid'],
					  'url'=>'',
					 'data'=>$dataArr,          //dataArr为一维数组、详细字段如下：
				);
				QueueClient::push('sendWXTemplateMsg', $wx_param);
				$this->core->res_message('succ',array('code'=>'1','params'=>''));
		   }else{
				$this->core->res_message('fail',"underfind not order_id");
		   }
        }else{
            $this->core->res_message('fail',"missing order_id");
        }
	}
		
	/**
     * @ 接口：CRM货物签收发送微信通知  du 2016-04-14
     * 应用级参数：
     * order_id 订单编号
     */
    public function CrmWeiXinQianShouTongZhiOp(){
        $order_id = $this->params['order_id'];
        if(!empty($order_id)){
           $model_order= Model('order');
            $order_goods_info = $model_order->getOrderInfo(array('order_id'=>$order_id,'order_state'=>40),array('order_goods'));
		   if(!empty($order_goods_info) && is_array($order_goods_info)){
				//订单完成送上级藏豆 订单签收赠送藏豆
				Model('pushuser_gift')->setUserPoints($order_goods_info['buyer_id'],$order_id);

				$member_info = Model('member')->getMemberInfoByID($order_goods_info['buyer_id']);
				foreach ($order_goods_info['extend_order_goods'] as $k => $v) {
					$goods_name_list .= $v['goods_name']."\n";
				}
				$dataArr['first'] = $order_goods_info['buyer_name'].',您好！您有一笔订单已确认收货，积分奖励已发放，赶快去评论晒单与大家分享您的购物心得感受吧~ ';
				$dataArr['keyword1'] = $order_goods_info['order_sn'];
				$dataArr['keyword2'] = $order_goods_info['order_amount'];
				$dataArr['keyword3'] = $goods_name_list;
				$dataArr['remark'] = "\n".'如果您有任何疑问，可咨询在线客服或致电客户服热线400-81-96567，我们将竭诚为您服务。';
				$wx_param = array(
					 'func'=>'order_notice',
					 'template_id'=>'',
					 'openid'=>$member_info['openid'],
					  'url'=>'',
					 'data'=>$dataArr,          //dataArr为一维数组、详细字段如下：
				);
				QueueClient::push('sendWXTemplateMsg', $wx_param);
				$this->core->res_message('succ',array('code'=>'1','params'=>''));
		   }else{
				$this->core->res_message('fail',"underfind not order_id");
		   }
        }else{
            $this->core->res_message('fail',"missing order_id");
        }
    }

	/**
     * @ 接口：CRM更新会员缓存
     */
    public function UpdateMemberCacheOp(){
        $member_id = $this->params['member_id'];
		dcache($member_id, 'member');
       
    }

    /**
     * @ 接口：CRM修改商品信息后商城更新或删除商品缓存  xin 20160324
     * 应用级参数：
     * goods_ids  商品ID，可能多个，多个以英文逗号隔开
     */
    public function UpdateGoodsCacheOp(){
        $goods_ids = $this->params['goods_ids'];
        if(!empty($goods_ids)){
            $model_goods = Model('goods');
            $goods_list = $model_goods->getGoodsList(array('goods_id'=>array('in',$goods_ids)),'goods_id,goods_commonid');
            if(!empty($goods_list) && is_array($goods_list)){
                foreach($goods_list as $k=>$v){
                    dcache($v['goods_id'], 'goods');
                    dcache($v['goods_commonid'], 'goods_common');
                    dcache($v['goods_commonid'], 'goods_spec');
                }
                $this->core->res_message('succ',array('code'=>'1','params'=>''));
            }else{
                $this->core->res_message('fail',"underfind goods info");
            }
        }else{
            $this->core->res_message('fail',"missing goods_ids");
        }
    }

    /**
     * @ 接口：验证用户名或手机号是否已被注册
     */
    public function CheckUserInfoOp(){
        $params = $this->params;

        $code = '4';//成功返回值，默认4，用户名和手机都未注册
        if($params['mobile'] == '' && $params['username'] == ''){
            $this->core->res_message('fail',"missing parameters");
        }
        if($params['username'] != ''){
            $userinfo = $this->M_member->getMemberInfo(array('member_name'=>$params['username']));
            if(is_array($userinfo) && !empty($userinfo)){
                $code = '1';
            }
        }
        if($params['mobile'] != ''){
            $mobile = $params['mobile'];
            $userinfo = $this->M_member->getMemberInfo(array('member_mobile'=>$mobile));
            if(is_array($userinfo) && !empty($userinfo)){
                if($code == '1'){
                    $code = '3';
                }else{
                    $code = '2';
                }
            }
        }
        $this->core->res_message('succ',array('code'=>$code));
    }

    /**
     * @ 接口：登录用户本地未注册，查询中心是否注册，如注册返回用户信息
     */
    public function CheckUserLoginOp(){
        $params = $this->params;
        //用户名和手机号不能同时传入
        if($params['username'] != '' && $params['mobile'] != ''){
            $this->core->res_message('fail',"parameter username,mobile can only choose one");
        }
        //用户名和手机号其中一个不为空，密码不为空，go on
        elseif(($params['username'] != '' || $params['mobile'] != '') && $params['password'] != ''){
            if($params['username'] != ''){
                $userinfo = $this->M_member->getMemberInfo(array('member_name'=>$params['username']));
            }elseif($params['mobile'] != ''){
                $mobile = $params['mobile'];
                $userinfo = $this->M_member->getMemberInfo(array('member_mobile'=>$mobile));
            }

            //对中心用户数据库返回信息判定，没有则返回未注册账号，如果存在，go on
            if(is_array($userinfo) && !empty($userinfo)){
                if($userinfo['ec_salt'] != "" && $userinfo['ec_salt'] != "0"){
                    $userpassword = md5($params['password'].$userinfo['ec_salt']);
                }else{
                    $userpassword = $params['password'];
                }

                //判定密码是否正确，不正确返回密码错误，正确 go on 给用户返回当前用户信息
                if($userpassword == $userinfo['member_passwd']){
                    $user_arr = array(
                        'username'      => $userinfo['member_name'],
                        'mobile'        => JieMiMobile($userinfo['member_mobile']),
                        'password'      => $userinfo['member_passwd'],
                        'ec_salt'       => $userinfo['ec_salt'],
                        'openid'        => $userinfo['openid'],
                        'is_open'       => $userinfo['is_open'],
                        //'rank_points'   => $userinfo['rank_points'],
                    );
                    $return_arr = array(
                        "code"    => '3',
                        "params" => $user_arr,
                    );
                    $this->core->res_message('succ',$return_arr);
                }else{
                    // 密码错误
                    $this->core->res_message('succ',array('code'=>'2','params'=>''));
                }

            }else{
                //用户不存在
                $this->core->res_message('succ',array('code'=>'1','params'=>''));
            }
        }
        else{
            $this->core->res_message('fail',"missing parameters");
        }
    }

    /**
     * @ 接口：第三方网站注册成功，并同步用户信息到这里
     */
    public function UserRegisterOp(){
        $params = $this->params;
        $username = $params['username'];
        $password = $params['password'];
        if($params['tg_from'] == ''){
            $params['tg_from'] = '0-0-843';
        }
        $mobile_phone = $params['mobile'];
        $openid = $params['openid'];
        if($username != '' && $password != '' && $mobile_phone != ''){
            $register_info	= array();
            $register_info['username']	= $username;
            $register_info['password']	= $password;
            $register_info['password_confirm']	= $password;
            $register_info['email']	= (empty($params['email']))?$params['mobile'].'@96567.com':$params['email'];
            $register_info['mobile']	= $mobile_phone;
            $register_info['member_mobile_bind']	= '1';
            $register_info['inviter_id']	= '0';
            $register_info['member_from']	= ($params['from'] == '1yuan')?'一元夺宝':$params['from'];
            $member_info = $this->M_member->register($register_info);

            if(!isset($member_info['error'])) {
                if($openid != ''){
                    $this->M_member->editMember(array('member_name'=>$username),array('openid'=>$openid));
                }
                $this->core->res_message('succ',array('code'=>'1'));
                /*
                //向CRM系统同步用户信息
                $crm_url = "http://crm.96567.com/index.php?m=api&p=action&c=register&typ_from=1yuan&N=".urlencode($username)."&ID=".$member_info['member_id']."&M=".$params['mobile']."&U=".urlencode($username)."&tg_from=".$params['tg_from'];
                $crm_res = $this->core->httpGET($crm_url);//传输成功，没返回状态
                if(trim($crm_res) == '1'){
                    $this->core->res_message('succ',array('code'=>'1'));
                }else{
                    $this->core->res_message('fail','crm update fail');
                }
                */
            }else{
                $this->core->res_message('fail','center update fail.'.$member_info['error']);
            }
        }else{
            $this->core->res_message('fail',"missing parameters");
        }
    }

    /**
     * @ 接口：同步更新密码
     */
    public function UpdatePasswordOp(){
        $params = $this->params;
        if($params['from'] == '96567'){
            //中心数据库密码已更新，将密码同步给1yuan
            $params['sign'] = $this->core->get_sign($params);
            $res = $this->core->httpPOST(YIYUAN_URI, $params);

            if(trim($res) == 1){
                $this->core->res_message('succ',array('code'=>'1'));
            }else{
                $this->core->res_message('fail','yiyuan update password fail');
            }
        }
        if($params['from'] == '1yuan'){
            //$oldpassword = $params['oldpassword'];
            $username = $params['username'];
            $newpassword = $params['newpassword'];
        }

        if($username != '' && $newpassword != ''){
            $userinfo = $this->M_member->getMemberInfo(array('member_name'=>$params['username']));
            if(is_array($userinfo) && !empty($userinfo)){
                $edit_state = $this->M_member->editMember(array('member_name'=>$username),array('member_passwd'=>$newpassword,'ec_salt'=>''));
                if($edit_state){
                    $this->core->res_message('succ',array('code'=>'1'));
                }else{
                    $this->core->res_message('fail','center update fail');
                }
            }else{
                $this->core->res_message('fail','center no user');
            }
        }else{
            $this->core->res_message('fail','missing parameters');
        }
    }

    /**
     * @ 接口：同步微信openid
     */
    public function UpdateOpenidOp(){
        $params = $this->params;
        if($params['from'] == '96567'){
            //中心数据库openid已更新，将openid同步给1yuan
            $params['sign'] = $this->core->get_sign($params);
            $res = $this->core->httpPOST(YIYUAN_URI, $params);

            if(trim($res) == 1){
                $this->core->res_message('succ',array('code'=>'1'));
            }else{
                $this->core->res_message('fail','yiyuan update openid fail');
            }
        }
        if($params['from'] == '1yuan'){
            $username = $params['username'];
            $openid = $params['openid'];
        }

        if($username != '' && $openid != ''){
            $userinfo = $this->M_member->getMemberInfo(array('member_name'=>$username));
            if(is_array($userinfo) && !empty($userinfo)){
                $edit_state = $this->M_member->editMember(array('member_name'=>$username),array('openid'=>$openid));
                if($edit_state){
                    $this->core->res_message('succ',array('code'=>'1'));
                }else{
                    $this->core->res_message('fail','center update fail');
                }
            }else{
                $this->core->res_message('fail','center no user');
            }
        }else{
            $this->core->res_message('fail','missing parameters');
        }
    }

    /*
     * @ 接口 1元夺宝用户openid获取96567用户信息
     */
    public function GetUserByOpenidOp(){
        $params = $this->params;

        if($params['openid'] == ''){
            $this->core->res_message('fail',"openid is null");
        }

        $userinfo = $this->M_member->getMemberInfo(array('openid'=>$params['openid']));

        if(!is_array($userinfo) || $userinfo['member_name'] == ''){
            //没有找到用户
            $this->core->res_message('succ',array('code'=>'1'));
        }

        $user_arr = array(
            'username' => $userinfo['member_name'],
            'mobile'   => JieMiMobile($userinfo['member_mobile']),
            'password' => $userinfo['member_passwd'],
            'ec_salt'  => $userinfo['ec_salt'],
            'openid'    => $userinfo['openid'],
            'is_open'    => $userinfo['is_open'],
            //'rank_points'    => $userinfo['password'],
        );
        $return_arr = array(
            "code"    => '3',
            "params" => $user_arr,
        );
        $this->core->res_message('succ',$return_arr);

    }

    /*
     * @ 商城接口 使用商品货号获取店铺信息
     */
    public function GetStoreInfoOp(){
        $params = $this->params;
        if($params['goodssn'] == ''){
            $this->core->res_message('fail',"goodssn is null");
        }
        $resInfo = Model('goods')->getGoodsInfo(array('goods_serial'=>$params['goodssn']),'store_id,store_name');
        if(is_array($resInfo) && $resInfo['store_id'] != ''){
            //没有找到用户
            $this->core->res_message('succ',$resInfo);
        }else{
            $this->core->res_message('succ','can not find store');
        }

    }


    /*
     * @ 通过域COOKIE PHPSESSID获取用户session信息
     */
    public function GetSessByIdOp(){
        $params = $this->params;

        if($params['session_id'] == ''){
            $this->core->res_message('fail',"session_id is null");
        }
        session_destroy();
        session_id($params['session_id']);
        session_start();
        $this->core->res_message('succ',array('member_id'=>$_SESSION['member_id'],'member_name'=>$_SESSION['member_name']));
    }


	/**
     * @ 接口：Api上传商品图片到商城 du 2016-07-13
     * 应用级参数：
     * img_fiel 图片路径
	 * goodsid 商品id
	 * stroe_id 店铺id
     */
    public function ApiUploadImgOp(){
        $img_fiel = $this->params['img_fiel'];
		$goodsid = $this->params['goodsid'];
		$stroe_id = $this->params['stroe_id'];
        $upload = new UploadFile();
		$upload->set('default_dir', ATTACH_GOODS . DS . $stroe_id . DS . $upload->getSysSetPath());
        $upload->set('max_size', C('image_max_filesize'));
        $upload->set('thumb_width', GOODS_IMAGES_WIDTH);
        $upload->set('thumb_height', GOODS_IMAGES_HEIGHT);
        $upload->set('thumb_ext', GOODS_IMAGES_EXT);
        $upload->set('fprefix', $stroe_id);
        $upload->set('allow_type', array('gif', 'jpg', 'jpeg', 'png'));
		$result = $upload->upfile('img_fiel');
		if (!$result) {
            $this->core->res_message('fail',"Upload failed");
        }
		$img_path = $upload->getSysSetPath() . $upload->file_name;
		// 取得图像大小
        list($width, $height, $type, $attr) = getimagesize(BASE_UPLOAD_PATH . '/' . ATTACH_GOODS . '/' . $stroe_id . DS . $img_path);
		// 存入相册
		$model_album = Model('album');
		$class_info = $model_album->getOne(array('store_id' => $stroe_id, 'is_default' => 1), 'album_class');
        $image = explode('.', $_FILES['img_fiel']["name"]);
        $insert_array = array();
        $insert_array['apic_name'] = $image['0'];
        $insert_array['apic_tag'] = '';
        $insert_array['aclass_id'] = $class_info['aclass_id'];
        $insert_array['apic_cover'] = $img_path;
        $insert_array['apic_size'] = intval($_FILES['img_fiel']['size']);
        $insert_array['apic_spec'] = $width . 'x' . $height;
        $insert_array['upload_time'] = TIMESTAMP;
        $insert_array['store_id'] = $stroe_id;
        $model_album->addPic($insert_array);
		$this->core->res_message('succ',$upload->file_name);
    }

	/**
     * @ 接口：Api生成商品二维码和店铺二维码 du 2016-07-14
     * 应用级参数：
	 * goodsid 商品id
	 * stroe_id 店铺id
     */
    public function ApiErWeiMaImgOp(){
		$goods_id = $this->params['goods_id'];
		$stroe_id = $this->params['stroe_id'];
		//生成商品二维码
        require_once(BASE_RESOURCE_PATH.DS.'phpqrcode'.DS.'index.php');
		$PhpQRCode = new PhpQRCode();
		$PhpQRCode->set('pngTempDir',BASE_UPLOAD_PATH.DS.ATTACH_STORE.DS.$stroe_id.DS);
		$PhpQRCode->set('date',M_SITE_URL . '/index.php?act=goods&op=index&goods_id='.$goods_id);
		$PhpQRCode->set('pngTempName', $goods_id . '.png');
		$PhpQRCode->init();
		//生成店铺二维码
		$qrcode_url=M_SITE_URL . '/index.php?act=member_store&op=store_info&store_id='.$stroe_id;
		$PhpQRCode->set('date',$qrcode_url);
		$PhpQRCode->set('pngTempName', $stroe_id . '_store.png');
		$PhpQRCode->init();
		$this->core->res_message('succ','OK');
    }
}
