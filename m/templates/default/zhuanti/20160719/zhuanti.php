<?php
/**
 * 专题类
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class zhuantiControl extends mobileHomeControl {
	private $ZtModel;
	private $cacheTime = 1;//缓存时间：分
	public function __construct() {
        parent::__construct ();
        Tpl::setDir('zhuanti');
        $this->ZtModel = Model('zhuanti');
    }
    /**
	 * 默认页面
	 */
	public function indexOp(){
		showWapMessage('您访问的活动不存在','index.php','html','error');
	}





    /**
	 * 点赞换银条活动

	 */
	public function ad_20160719Op(){

		// 用户信息
		// $member_info = $this->getMemberAndGradeInfo(true);

		// var_dump($_SESSION);

		$openid_this = $_SESSION['openid'];
		$openid_push = $_GET['push_openid'];

		// var_dump($member_info);

		// wcache($member_info['member_id'],$member_info,'zhuanti719',1);

		// var_dump(rcache($openid_this,'zhuanti719'));

		// $this->is_weixin_userinfoOp();


		if(empty($openid_push)){
			$this->ad_20160719_this_userOp($openid_this);
		}else{
			$this->ad_20160719_push_userOp($openid_push);
		}

		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::showpage('20160719/index_show');
	}

	/**
	 * 点赞换银条活动 - 当前用户入口
	 */
	private function ad_20160719_this_userOp($openid_this){
		$member_weixin_info = Model('weixin_info')->getOneMemberWeixinInfo($openid_this);

		if(!empty($member_weixin_info)){
			$member_weixin_info['dianzan'] = 2;
			$member_weixin_info['dianzan_'] = 2>5?100:2*20;
		}

		Tpl::output('member_weixin_info',$member_weixin_info);
		Tpl::output('member_this',true);
	}


	/**
	 * 点赞换银条活动 - 推荐用户入口
	 */
	private function ad_20160719_push_userOp($openid_push){

		// 推荐入口进入当前用户
		$member_weixin_info_push_this = Model('weixin_info')->getOneMemberWeixinInfo($_SESSION['openid']);

		// 推荐人用户信息
		$member_weixin_info_push = Model('weixin_info')->getOneMemberWeixinInfo($openid_push);

		if(!empty($member_weixin_info_push)){
			$member_weixin_info_push['dianzan'] = 2;
			$member_weixin_info_push['dianzan_'] = 2>5?100:2*20;
		}
		
		Tpl::output('member_weixin_info_push',$member_weixin_info_push);
		Tpl::output('member_weixin_info_push_this',$member_weixin_info_push_this);
		Tpl::output('member_push',true);
	}



	/**
	 * 授权获取微信用户信息
	 */
	public function get_weixin_infoOp(){

		$openid_this = $_SESSION['openid'];
		$is_login = $_SESSION['is_login'];

		if(empty($openid_this) || empty($is_login)){
			//未登录或者没有openid状态下不允许获取微信信息
			$url = urlWap('zhuanti','ad_20160719');
			header("location:$url");
			exit;
		}

		$weixin = new weixinSDK();

		$token = $weixin->token;

		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=".$openid_this."&lang=zh_CN";

		$weixin_result = json_decode(file_get_contents($url),true);

		if($weixin_result['subscribe'] == '1'){
			//数据存入数据库

			$member_weixin_info = Model('weixin_info')->getOneMemberWeixinInfo($_SESSION['openid']);

			if(empty($member_weixin_info)){

			$dataArr['W_MemberId'] = $_SESSION['member_id'];
			$dataArr['W_MemberName'] = $_SESSION['member_name'];
			$dataArr['W_Openid'] = $_SESSION['openid'];
			$dataArr['W_Nickname'] = $weixin_result['nickname'];
			$dataArr['W_Sex'] = $weixin_result['sex'];
			$dataArr['W_City'] = $weixin_result['city'];
			$dataArr['W_Province'] = $weixin_result['province'];
			$dataArr['W_Country'] = $weixin_result['country'];
			$dataArr['W_Headimgurl'] = urlencode($weixin_result['headimgurl']);
			$dataArr['W_Subscribe_time'] = $weixin_result['subscribe_time'];
			$dataArr['W_Addtime'] = time();

			Model('weixin_info')->addOneMemberWeixinInfo($dataArr);

			}

			$url = urlWap('zhuanti','ad_20160719');
			header("location:$url");
		}else{
			//授权获取微信用户数据
			$url =  urlWap('zhuanti','ad_20160719_get_user_info');
			$token = $weixin->oauth($url);
		}

	}

	/**
	 * 接收微信用户信息
	 */
	public function ad_20160719_get_user_infoOp(){

		$weixin = new weixinSDK();

		$member_weixin_info = $weixin->getOauthUserInfo(trim($_GET['code']));

		$member_weixin_info_is = Model('weixin_info')->getOneMemberWeixinInfo($_SESSION['openid']);

		if(empty($member_weixin_info_is)){

		// 存入数据库
		$dataArr['W_MemberId'] = $_SESSION['member_id'];
		$dataArr['W_MemberName'] = $_SESSION['member_name'];
		$dataArr['W_Openid'] = $_SESSION['openid'];
		$dataArr['W_Nickname'] = $member_weixin_info['nickname'];
		$dataArr['W_Sex'] = $member_weixin_info['sex'];
		$dataArr['W_City'] = $member_weixin_info['city'];
		$dataArr['W_Province'] = $member_weixin_info['province'];
		$dataArr['W_Country'] = $member_weixin_info['country'];
		$dataArr['W_Headimgurl'] = urlencode($member_weixin_info['headimgurl']);
		$dataArr['W_Subscribe_time'] = $member_weixin_info['subscribe_time']?$member_weixin_info['subscribe_time']:time();
		$dataArr['W_Addtime'] = time();


		Model('weixin_info')->addOneMemberWeixinInfo($dataArr);

		}

		$url = urlWap('zhuanti','ad_20160719');
		header("location:$url");

	}


	/**
	 * 检测是否关注并提取用户信息
	 * @param bool $is_return 是否返回会员微信信息，返回为true，输出会员信息为false
	 */
	public function is_weixin_userinfoOp($is_return = false){
		
		$weixin = new weixinSDK();
		$token = $weixin->token;
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=".$_SESSION['openid']."&lang=zh_CN";
		$weixin_result = json_decode(file_get_contents($url),true);

		// wcache($weixin_result['openid'],$weixin_result,'zhuanti719',$this->cacheTime);

		if ($is_return == true){//返回会员信息
            return $weixin_result;
        } else {//输出会员信息
            echo json_encode($weixin_result);
        }

	}

	/**
	 * 会员登陆 - 以跳转方式
	 * 
	 */
	public function login_showOp(){

		if(chksubmit(true)){
			

		$obj_validate = new Validate();
		$obj_validate->validateparam = array(
			array("input"=>$_POST['login_name'],"require"=>"true", "message"=>'用户名不能为空'),
			array("input"=>$_POST['login_pass'],"require"=>"true", "message"=>'密码不能为空'),
		);

		$error = $obj_validate->validate();
		if ($error != ''){
			showMessage($error,'','','error');
			exit();
		}

		//登陆类型
		if(preg_match("/1[34578]{1}\d{9}$/",$_POST['login_name'])){
			$logintype='mobile';
		}else{
			$logintype='username';
		}

		$salt_where	= array();
		if($logintype == 'mobile'){
			$salt_where['member_mobile'] = $_POST['login_name'];
		}else{
			$salt_where['member_name'] = $_POST['login_name'];
		}

		$model_member	= Model('member');
		$is_salt = $model_member->getMemberInfo($salt_where,'ec_salt');

		$array	= array();
		if($logintype == 'mobile'){
			$array['member_mobile']	= $_POST['login_name'];
		}else{
			$array['member_name']	= $_POST['login_name'];
		}
		if($is_salt['ec_salt'] != 0 || !empty($is_salt['ec_salt'])){
			$array['member_passwd']	= md5(md5($_POST['login_pass']).$is_salt['ec_salt']);
		}else{
			$array['member_passwd']	= md5($_POST['login_pass']);
		}

		$member_info = $model_member->getMemberInfo($array);
		//会员存在，如果有openid存入，删除其他会员openid
		if($_SESSION['openid'] != '' && $member_info['openid'] != $_SESSION['openid']){
			$model_member->editMember(array('openid'=>$_SESSION['openid']),array('openid'=>''));
			$model_member->editMember(array('member_id'=>$member_info['member_id']),array('openid'=>$_SESSION['openid']));
		}

		if(is_array($member_info) and !empty($member_info)) {
			if(!$member_info['member_state']){
				$result['error'] = '账号被停用';
				showMessage('账号被停用','','','error');
				exit();
			}
		}else{
			process::addprocess('login');
			$result['error'] = '用户名或密码错误';
			showMessage('用户名或密码错误','','','error');
			exit();
		}

		$model_member->createSession($member_info);

		$url = urlWap('zhuanti','ad_20160719');

		header("location:$url");

		}else{
			showMessage('操作失败','','','error');
		}
	}


	/**
	 * 会员注册 - 以跳转方式
	 */
	public function register_showOp(){

		if(chksubmit(true)){


			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['zc_pass'],"require"=>"true","validator"=>"Length","min"=>"6","max"=>"20", "message"=>'密码位数不对！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				showMessage($error,'','','error');
				exit();
			}
			
			$model_member   = Model('member');
            $register_info = array();
            $register_info['username'] = $_POST['zc_name'];
            $register_info['password'] = $_POST['zc_pass'];
            $register_info['password_confirm'] = $_POST['zc_rpass'];
            $register_info['member_from'] = '点赞送银条';
            $register_info['mobile'] = $_POST['zc_phone'];
            $register_info['openid'] = $_SESSION['openid'];

            $member_info = $model_member->register($register_info);

            if(!isset($member_info['error'])) { 
                /*信息存入session*/
                $model_member->createSession($member_info);
                showWapMessage('注册成功',getReferer());
            } else {
                showWapMessage($member_info['error'],'','error');
            }
		}else{
			showMessage('操作失败','','','error');
		}
	}

	
	/**
	 * 藏豆兑换活动页面

	 */
	public function ad_20160714Op(){
		$model_cangdou = Model('pushuser_gift');
        $where = "cangdou_gift.starttime <='".TIMESTAMP."' AND cangdou_gift.endtime >= '".TIMESTAMP."'";
		$field = "*,(SELECT count(*) goods_duihuan_sum FROM shop_order_goods WHERE shop_order_goods.goods_id = cangdou_gift.goods_id AND shop_order_goods.lai_yuan = '藏豆兑换礼品' LIMIT 1) AS goods_duihuan_sum";
        $result_list = $model_cangdou->getCangdouGiftList($where,$field,4);

        Tpl::output('html_title','邀请得礼品，好礼送不停-收藏天下');
		Tpl::output('seo_keywords','藏豆，邀请有礼，邀请好礼');
		Tpl::output('seo_description','收藏天下为回馈新老客户，特别推出邀请有礼活动，邀请好友得5藏豆，只要邀请4个人，就能换购藏品，朋友购物也有返现哦。快来参与吧。');

		Tpl::output('result_list',$result_list);
		Tpl::showpage('20160714/index_show');
	}

	/**
	 * 
	 */
	public function ad_20160716Op(){

		$avUrlInfo = Model()->table('setting')->where(array('name'=>'avUrl'))->find();

		$avUrl = $avUrlInfo['value'];

		if(!empty($avUrl) && $avUrl != 1){

			$avUrl = urldecode($avUrl);

			header("Location: $avUrl");
			exit;
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::showpage('20160716/index_show');
		}
	}


	
	/**
	 * 送银条1块1克
	 */
	public function ad_20160708_1Op(){
		switch($_GET['action']){
			case 'lingqu':
				$goodsid_array = array('22210'=>'5');
				$where_member_from['member_id'] = intval($_SESSION['member_id']);
				//$where_member_from['member_from'] = array('like','%送银条%');
				$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
				if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
				$goods_amount = '5'; //商品总额
				$shipping_fee = '15'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"送银条1块1克",'送银条1块1克(M)');
			break;
			case 'regs':
				//注册
				$model_member	= Model('member');
				$code = $_POST['code'];
				if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
					$result['state'] = false;
					$result['msg'] = "验证码错误";
					echo json_encode($result); 
					exit();
				}
				$register_info = array();
				$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
				$register_info['username'] = $_POST['mobile'];
				$register_info['password'] = substr($_POST['mobile'], -6);
				$register_info['password_confirm'] = substr($_POST['mobile'], -6);
				$register_info['mobile'] = $_POST['mobile'];
				$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
				$register_info['member_from'] = '送银条1块1克('.$M.')';
				$member_info = $model_member->register($register_info);
				if(!isset($member_info['error'])) {
					$model_member->createSession($member_info,true);
					exit(json_encode(array('state'=>true,'msg'=>"OK",'username'=>$_POST['mobile'],'password'=>substr($_POST['mobile'], -6))));
				}else{
					exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
				}
			break;
			default:
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20160708/index_show1');
			break;
		}
	}

	/**
	 *送银条活动
	 */
	public function ad_20160708Op(){
		switch($_GET['action']){
			case 'lingqu':
				$goodsid_array = array('22210'=>'0');
				$where_member_from['member_id'] = intval($_SESSION['member_id']);
				//$where_member_from['member_from'] = array('like','%送银条%');
				$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
				if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
				$goods_amount = '0'; //商品总额
				$shipping_fee = '20'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"送银条免费领取",'送银条免费领取(M)');
			break;
			case 'regs':
				//注册
				$model_member	= Model('member');
				$code = $_POST['code'];
				if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
					$result['state'] = false;
					$result['msg'] = "验证码错误";
					echo json_encode($result); 
					exit();
				}
				$register_info = array();
				$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
				$register_info['username'] = $_POST['mobile'];
				$register_info['password'] = substr($_POST['mobile'], -6);
				$register_info['password_confirm'] = substr($_POST['mobile'], -6);
				$register_info['mobile'] = $_POST['mobile'];
				$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
				$register_info['member_from'] = '送银条免费领取('.$M.')';
				$member_info = $model_member->register($register_info);
				if(!isset($member_info['error'])) {
					$model_member->createSession($member_info,true);
					exit(json_encode(array('state'=>true,'msg'=>"OK",'username'=>$_POST['mobile'],'password'=>substr($_POST['mobile'], -6))));
				}else{
					exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
				}
			break;
			default:
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20160708/index_show');
			break;
		}
	}
	
	/**
	 * 传家宝活动
	 */
	public function ad_20160707Op(){
		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
			//echo("请在微信端打开");
			//exit;
		}

		Tpl::output('html_title','全国首届传家宝票选活动官方网站-收藏天下');
		Tpl::output('seo_keywords','传家宝免费鉴定,传家宝免费评估,传家宝活动-收藏天下');
		Tpl::output('seo_description','全国首届传家宝票选活动火热进行中,马上拍照上传家传之宝即可参与票选活动，CCTV央视《鉴定》专家王立军免费为您评估鉴定！更有5000元现金大奖等你来拿！-收藏天下');

		
		switch($_POST['action']){
			case 'modal-8': //检查是否登陆或者是否关注微信公众号
				if(intval($_SESSION['member_id']) <= 0){ //未登陆
					exit(json_encode(array('state'=>false,'msg'=>'-1')));
				}

				//检查会员是否关注公众号
//				$weixin = new weixinSDK();
//				$token = $weixin->token;
//				$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=".$_SESSION['openid']."&lang=zh_CN";
//				$weixin_result = json_decode(file_get_contents($url),true);
//				if($weixin_result['subscribe'] != 1){
//					exit(json_encode(array('state'=>false,'msg'=>'-2')));
//				}else{
//					}
			//检查用户是否发布投票一个用户只能发布一次
			$you_count = $this->ZtModel->getPaiMing(array('member_id'=>intval($_SESSION['member_id'])));
			if($you_count > 0){
				exit(json_encode(array('state'=>false,'msg'=>'-3')));
			}else{
				exit(json_encode(array('state'=>true,'msg'=>"OK")));
			}
					
				
			break;
			case 'modal-shop': //查看别人的传家宝
				if(intval($_POST['id']) <= 0){ //未登陆
					exit(json_encode(array('state'=>false,'msg'=>'-1')));
				}
				$condition = array();
				$condition['id'] = $_POST['id'];
				$condition['is_rev'] = '1';
				$condition['ad_from'] = '20160707';
				$ChuanJia = $this->ZtModel->getTouPiaoList($condition);
				$msg = $this->ChaKanChuanJia($ChuanJia[0]);
				if($msg){ //未登陆
					exit(json_encode(array('state'=>true,'msg'=>$msg)));
				}else{
					exit(json_encode(array('state'=>false,'msg'=>'-1')));
				}
			break;
			case 'regs':
				//注册
				$model_member	= Model('member');
				$code = $_POST['code'];
				if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
					$result['state'] = false;
					$result['msg'] = "验证码错误";
					echo json_encode($result); 
					exit();
				}
				$register_info = array();
				$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
				$register_info['username'] = $_POST['user_name'];
				$register_info['password'] = $_POST['password'];
				$register_info['password_confirm'] = $_POST['password1'];
				$register_info['mobile'] = $_POST['mobile'];
				$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
				$register_info['member_from'] = '传家宝活动('.$M.')';
				$member_info = $model_member->register($register_info);
				if(!isset($member_info['error'])) {
					$model_member->createSession($member_info,true);
					exit(json_encode(array('state'=>true,'msg'=>"OK")));
				}else{
					exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
				}
			break;
			case 'toupiao': //进行投票操作
				if(intval($_SESSION['member_id']) <= 0){ //未登陆
					exit(json_encode(array('state'=>false,'msg'=>'-1')));
				}
				//检查会员是否关注公众号
//				$weixin = new weixinSDK();
//				$token = $weixin->token;
//				$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=".$_SESSION['openid']."&lang=zh_CN";
//				$weixin_result = json_decode(file_get_contents($url),true);
//				if($weixin_result['subscribe'] != 1){
//					exit(json_encode(array('state'=>false,'msg'=>'-2')));
//				}else{
//					
//				}
					//检查是否是给自己投票
					$condition = array();
					$condition['id'] = $_POST['id'];
					$condition['member_id'] = $_SESSION['member_id'];
					$ChuanJia = $this->ZtModel->getTouPiaoList($condition);
					if(count($ChuanJia) > 0){
						exit(json_encode(array('state'=>false,'msg'=>'-3')));
					}
					$condition = array();
					$condition['id'] = $_POST['id'];
					$condition['is_rev'] = '1';
					$condition['ad_from'] = '20160707';
					$L_TouPiao = $this->ZtModel->getTouPiaoList($condition);
					$TouPiao = $L_TouPiao[0];
					if($TouPiao){
						//检查会员今天的都票次数是否以用完
						$TouPiaoCount = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160707','member_id'=>intval($_SESSION['member_id']),'year'=>date("Y",time()),'month'=>date("m",time()),'day'=>date("d",time())));
						if($TouPiaoCount >= 3){
							exit(json_encode(array('state'=>false,'msg'=>'-5')));
						}else{
							//写入投票记录
							$data = array();
							//将中奖信息写入数据库
							$data['member_id'] = $_SESSION['member_id'];
							$data['year'] = date('Y',time());
							$data['month'] = date('m',time());
							$data['day'] = date('d',time());
							$data['hour'] = date('H',time());
							$data['time'] = date('H:i:s',time());
							$data['add_time'] = time();
							$data['ip'] = $_SERVER['REMOTE_ADDR'];
							$data['ad_name'] = '20160707';
							$data['l_name'] = $TouPiao['title'];
							$data['l_id'] = $condition['id'];
							$data['is_fafang'] = 0;
							$data['openid'] = $_SESSION['openid'];
							$lid = $this->ZtModel->addLottery($data);
							Model()->query("UPDATE shop_vote SET  vote_num = vote_num+1 WHERE id =".$data['l_id']." ");
							exit(json_encode(array('state'=>true,'msg'=>'OK')));
						}
					}else{
						exit(json_encode(array('state'=>false,'msg'=>'-4')));
					}

			break;
			default:
				//获取投票排行榜
				$condition = array();
				$condition['is_rev'] = '1';
				$condition['ad_from'] = '20160707';
				$PiaoList = $this->ZtModel->getTouPiaoList($condition,'*','','vote_num desc,id desc','8');
				$QianYiBai = $this->ZtModel->getTouPiaoList($condition,'*','','vote_num desc,id desc','100');
				Tpl::output('QianYiBai',$QianYiBai);
				Tpl::output('PiaoList',$PiaoList);
				Tpl::output('page',$this->ZtModel->showpage(88));
				//获取自己添加的最新投票
				$condition = array();
				$condition['is_rev'] = '1';
				$condition['ad_from'] = '20160707';
				if(intval($_GET['push_memberid'])){
					$condition['member_id'] = intval($_GET['push_memberid']);
					Tpl::output('is_mycuanjia','no');
				}else{
					$condition['member_id'] = $_SESSION['member_id'];
					Tpl::output('is_mycuanjia','yes');
				}
				$value = $this->ZtModel->getTouPiaoList($condition,'*','','vote_num desc,id desc','1');
				Tpl::output('value',$value[0]);
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				$you_count = $this->ZtModel->getPaiMing(array('member_id'=>intval($_SESSION['member_id'])));
				Tpl::output('you_count',$you_count);
				Tpl::output('member_id',$condition['member_id']);
				Tpl::showpage('20160707/index_show');
			break;
		}	
	}
	
	/**
	 * 传家宝活动我要参与页面
	 */
	public function ad_20160707_bntOp(){
			if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
				//echo("请在微信端打开");
				//exit;
			}
			//检查是否登陆
			if(intval($_SESSION['member_id']) <= 0){ //未登陆
				header("Location: http://m.96567.com/index.php?act=zhuanti&op=ad_20160707"); 
				exit();
			}

			//检查用户是否发布投票一个用户只能发布一次
			$you_count = $this->ZtModel->getPaiMing(array('member_id'=>intval($_SESSION['member_id'])));
			if($you_count > 0){
				echo '<script>alert("您已经上传过作品了，一个用户只能上传一次作品！");</script>';
				header("Location: http://m.96567.com/index.php?act=zhuanti&op=ad_20160707"); 
				exit();
			}
			//检查是否关注微信公众号
//			$weixin = new weixinSDK();
//			$token = $weixin->token;
//			$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=".$_SESSION['openid']."&lang=zh_CN";
//			$weixin_result = json_decode(file_get_contents($url),true);
//			if($weixin_result['subscribe'] != 1){
//				header("Location: http://m.96567.com/index.php?act=zhuanti&op=ad_20160707"); 
//				exit();
//			}
			
			if($_POST){
				$insert_array = array();
				$insert_array['title']    = $_POST['title']; //藏品title
				$insert_array['img_file']  = serialize($_POST['img_file']); //图片
				$insert_array['years']   = trim($_POST['years']); //作品年代
				$insert_array['data_time']   = trim($_POST['data_time']);//入手时间
				$insert_array['price']   = trim($_POST['price']);//入手价格
				$insert_array['contents']   = trim($_POST['contents']);//藏品描述
				$insert_array['is_rev']   = 1; //审核状态 0 未审核 1 已审核 2 拒绝审核 默认通过审核状态
				$insert_array['member_id']   = $_SESSION['member_id']; // 添加会员id
				$insert_array['member_name']   = $_SESSION['member_name']; // 添加会员名
				$insert_array['member_openid']   = $_SESSION['openid']; // 添加的openid
				$insert_array['vote_num']   = 0; // 投票数量默认为0
				$insert_array['add_time']   = time(); // 添加时间
				$insert_array['ad_from']   = '20160707'; // 项目来源
				$insert_array['ad_name']   = '传家宝活动'; // 项目标记
				$insert_array['user_name']   = trim($_POST['user_name']); // 项目标记
				$res = $this->ZtModel->insertTouPiao($insert_array);
				if($res){
					showMessage('提交成功。','http://m.96567.com/index.php?act=zhuanti&op=ad_20160707','html','succ');
				}else{
					showMessage('操作失败','','','error');
				}

			}else{
				
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20160707/20160707_bnt');
			}
			
	}
	/**
	 * 返回查看的传家宝信息
	 */
	private function ChaKanChuanJia($dataArr){
		//
		$paiming = $this->ZtModel->getPaiMing(array('vote_num'=>array('egt',$dataArr['vote_num'])));
		$img = unserialize($dataArr['img_file']);
		if($img){
			foreach($img as $k=>$v){
				$imgarr .= '<img src="http://www.96567.com/'.$v.'"/>';
			}
		}
		$msg = '<div class="md-content coloured"><div class="demo clearfix"><div class="tc-con clearfix"><div class="sea-mew mt clearfix"><img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160707/images/sea-mew.jpg"/></div><h1 class="tc-title">'.$dataArr['title'].'</h1><div class="personage-baby clearfix"><div class="perimg clearfix"><div class="margin-top"><div class="row"><div class="large-12 columns"><div class="fadeOut"><div class="container_12"><div class="grid_8"><div id="sliderA" class="slider">'.$imgarr.'</div></div></div></div></div></div></div>	</div><div class="lt-box clearfix"><span><i class="icon-love"></i>票数<em>'.$dataArr['vote_num'].'</em></span><span><i class="icon-trophy"></i>排名<em>'.intval($paiming).'</em></span></div></div><p>藏品简介</p><p>年代：'.$dataArr['years'].'</p><p>入手时间：'.$dataArr['data_time'].'</p><p>入手价格：'.$dataArr['price'].'元</p><p>'.$dataArr['contents'].'</p><button class="tc-btn-vote mt" onclick="toupiao('.$dataArr['id'].');">投票</button></div><div class="bm-painting"><img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160707/images/painting.jpg"/></div><button class="md-close close-one"><i class="icon-close"></i></button></div></div><script>$(".icon-close").click(function(){$("div").removeClass("md-show");});</script>';
		return $msg;
	}
	/**
	 * 上传图片
	 */
	public function uploadUrlOp(){
		if($_FILES){
			$imgArr = $_FILES;
			//创建上传类
			$upload = new UploadFile();
			//设置上传目录
			$upload->set('default_dir','chuanjia/');
			$result = $upload->upfile('file_data');
			//生成两张缩略图，宽高分别为 30,300
			$upload->set('thumb_width','30,300');
			$upload->set('thumb_height','30,300');
			//两个缩略图名称后面分别追加 "_tiny","_mid"
			$upload->set('thumb_ext','_30,_300');
			if($result){
				//得到图片上传后的路径
				$img_path = '/data/upload/chuanjia/'.$upload->file_name;
				$initialPreview[] = '<img src="http://www.96567.com'.$img_path.'" class="file-preview-image" title="'.$upload->file_name.'" alt="'.$upload->file_name.'" style="width:auto;height:160px;"><input type="hidden" name="img_file[]" id="img_file" value="'.$img_path.'">';
				
				exit(json_encode(array('initialPreview'=>$initialPreview)));
			}else{
				exit(json_encode(array('error'=>'上传失败')));
			}
		}
	}


	public function fenxiangOp(){
		$array['P']['title'] = '我正在参加“收藏天下好友季”送话费活动，100元话费马上到手，快点击链接为我助力吧';
		$array['P']['imgUrl'] = '/zhuanti/20160621/images/weixin.png';
		$array['P']['link'] = 'http://www.baidu.com'; //分享连接
		$array['Y']['link'] = 'http://www.baidu.com'; //分享连接
		$array['Y']['title'] = '我正在参加“收藏天下好友季”送话费活动，100元话费马上到手，快点击链接为我助力吧';
		$array['Y']['desc'] = '桃花潭水深千尺，不及好友动手指';
		$array['Y']['imgUrl'] = '/zhuanti/20160621/images/weixin.png';

		echo weixinShare($array);
	}
	/**
	 * 杜 免费领取
	 */
	public function ad_20160622Op(){
		if($_GET['action'] == 'yanzhengone'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$code = $_POST['code'];
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
				$result['error'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '免费送70周年纪念币('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$result['msg'] = '注册成功';
				$model_member->createSession($member_info,true);
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}elseif($_GET['action'] == 'lingqu'){
			$goodsid_array = array('10733'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%免费送70周年纪念币%');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
			$goods_amount = '0'; //商品总额
			$shipping_fee = '12'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"免费送70周年纪念币",'免费领取(M)');
		}else{
			$goodsid_array = array('10733'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%免费送70周年纪念币%');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error'] == '您不符合领取资格') Tpl::output('is_lin','1');
			Tpl::output('member_id',intval($_SESSION['member_id']));
			Tpl::output('html_title',"收藏天下注册有礼，免费送抗战胜利70周年纪念币。");
			Tpl::output('seo_keywords',"注册有礼,免费领取,抗战胜利纪念币,抗战70周年纪念币,抗战币,纪念币");
			Tpl::output('seo_description',"收藏天下注册有礼再次来袭，注册就免费送抗战胜利70周年纪念币，带册装帧更豪华，存世流传有心意。立刻注册，立刻免费领抗战胜利70周年纪念币，自己珍藏、送人礼物，均是极棒的选择。来收藏天下，免费好礼免费拿！");
			Tpl::showpage('20160622/index_show');
		}
	}

	
	/**
	 * 助力送话费活动
	 */

	public function ad_20160621Op(){
		//检查会员是否关注公众号
		$weixin = new weixinSDK();
		$token = $weixin->token;
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=".$_SESSION['push_openid']."&lang=zh_CN";
		$weixin_result = json_decode(file_get_contents($url),true);
		if($weixin_result['subscribe'] != 1 || $_SESSION['push_openid'] == $_SESSION['openid']){ //如果分享人未关注微信公众号则分享无效
			$push_openid = '';
		}else{
			$push_openid = $_SESSION['push_openid'];
		}
		Tpl::output('push_openid',$push_openid);
		if($_GET['action'] == 'url_admin'){
				//登录检查验证
				if($_POST){
					$user=$_POST["username"];
					$pws=$_POST["password"];
					if($user == "杜飞" && $pws =="df123123"){
					   setcookie("DfZtAdmin", "1");
					   header("location:index.php?act=zhuanti&op=ad_20160621&action=url_admin");
					}else{
						echo "<script>window.alert('登录失败返回重新登录');window.location.href='index.php?act=zhuanti&op=ad_20160621&action=url_admin';</script>";
						exit;
					}
				}elseif($_GET['dd_act'] == 'cha'){
					$member_Id = intval($_GET['member_id']);
					if($member_Id <= 0){
						echo '参数错误';
						exit;
					}
					$model_member	= Model('member');
					$model_list = $model_member->getMemberList(array('inviter_id'=>$member_Id,'member_from'=>array('like','%微信送话费活动%')));
					echo '<table>';
					echo '<tr><td>助力会员名</td><td>手机号</td></tr>';
					foreach($model_list as $k=>$v){
						$mob = @file_get_contents("http://crm.96567.com/index.php?m=api&p=action&c=JMmobile&mobile=".$v['member_mobile']);
						echo '<tr><td>'.$v['member_name'].'</td><td>'.$mob.'</td></tr>';
					}
					echo '</table>';
					exit;

				}else{
					if(empty($_COOKIE["DfZtAdmin"])) {
						Tpl::showpage('20160621/admin/login','null_layout');
					}else{
						$member_sat = ($_GET['Start_time'] == '') ? '1466438400' : strtotime($_GET['Start_time']);
						$member_end = ($_GET['End_time'] == '') ? time() : strtotime($_GET['End_time']);
						//获得所有会员中奖记录
						$SuoYouLotteryList = $this->ZtModel->getLotteryReceiveList(array('ad_name'=>'20160621','type'=>'0','add_time'=>array('egt',$member_sat),'add_time'=>array('elt',$member_end)),'*,(SELECT count(0) from shop_member where inviter_id = `shop_lottery_receive`.member_id AND member_from like "%微信送话费活动%") as ZhuLiCnt','20');

						if($_GET['types'] == 'dao'){
							$this->DaoChu_Export(date('Y-m-d',$member_sat).'---'.date('Y-m-d',$member_end).'领取列表');
							echo '<table>';
							echo '<tr><td>领取会员</td><td>领取手机号</td><td>话费金额</td><td>运营商/地区</td><td>领取时间</td><td>助力总数</td></tr>';
							if($SuoYouLotteryList){
								foreach($SuoYouLotteryList as $k=>$v){
									echo "<tr><td>".$v['member_name']."</td><td>".$v['mobile']."</td><td>".$v['l_id']."元话费</td><td>".$v['address']."</td><td>".date("Y-m-d H:i:s",$v['add_time'])."</td><td>".$v['ZhuLiCnt']."</td></tr>";
								}
							}
							echo '</table>';
							exit;
						}else{
							Tpl::output('show_page',$this->ZtModel->showpage());
							Tpl::output('List',$SuoYouLotteryList);
							Tpl::output('member_sat',date('Y-m-d',$member_sat));
							Tpl::output('member_end',date('Y-m-d',$member_end));
							Tpl::showpage('20160621/admin/adminindex','null_layout');
						}
					}
				}
				exit;
		}
		//检查用户是否在微信浏览器打开  
		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
			if($_GET['action'] == 'btn_ajax' && intval($_POST['btn']) > 0){
				switch(intval($_POST['btn'])){
					case 1:
						//领取话费 检查是否符合条件
						if(intval($_SESSION['member_id']) <= 0){
							echo '-1';
							exit();
						}
						$val = intval($_POST['val']);
						//,'200'=>'200'
						$HuaFei = array('10'=>'10','20'=>'20','50'=>'50','100'=>'100');
						$XianZhi = array(
							'10'=>array('min'=>3,'mix'=>4),
							'20'=>array('min'=>5,'mix'=>9),
							'50'=>array('min'=>10,'mix'=>14),
							'100'=>array('min'=>15,'mix'=>9999999)
						);
						if(in_array($val, $HuaFei)){
							//检查用户是否已经领取过
							$is_lin = $this->ZtModel->LinQuCount(array('ad_name'=>'20160621','member_id'=>intval($_SESSION['member_id']),'type'=>'0'));
							if($is_lin > 0){
								exit(json_encode(array('state'=>false,'msg'=>'每位用户仅限领取一次，不能重复领取。')));
							}
							//检查用户助力是否住够
							$model_member	= Model('member');
							$MemberCount = $model_member->getMemberCount(array('inviter_id'=>$_SESSION['member_id'],'member_from'=>array('like','%微信送话费活动%')));
							$min = $XianZhi[$val]['min'];
							$mix = $XianZhi[$val]['mix'];
							if($min <= $MemberCount && $MemberCount < $mix){
								exit(json_encode(array('state'=>true,'msg'=>"OK")));
							}else{
								exit(json_encode(array('state'=>false,'msg'=>'对不起，您不满足领取条件')));
							}
						}else{
							exit(json_encode(array('state'=>false,'msg'=>'违规操作')));
						}
						break;
					case 2:
						$result['state'] = false;
						$result['msg'] = "第一波话费已被抢光，敬情关注后期活动";
						echo json_encode($result); 
						exit();
						//用户注册
						$model_member	= Model('member');
						$code = $_POST['code'];
						if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
							$result['state'] = false;
							$result['msg'] = "验证码错误";
							echo json_encode($result); 
							exit();
						}
						$_SESSION['wx_phone_yzm'][$_POST['mobile']] == '';
						$register_info = array();
						$tjr_info = $model_member->getMemberInfo(array('openid'=>$_SESSION['push_openid']));
						if($tjr_info && $_POST['no_push'] != 1){
							$register_info['inviter_id'] = intval($tjr_info['member_id']);
						}
						if($_SESSION['openid'] != ''){
							$register_info['openid'] = $_SESSION['openid'];
						}
						$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
						$register_info['username'] = $_POST['user_name'];
						$register_info['password'] = $_POST['password'];
						$register_info['password_confirm'] = $_POST['password1'];
						$register_info['mobile'] = $_POST['mobile'];
						$register_info['iscangdou'] = 'no';
						$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
						$register_info['member_from'] = '微信送话费活动('.$M.')';
						$member_info = $model_member->register($register_info);
						if(!isset($member_info['error'])) {
							$model_member->createSession($member_info,true);
							exit(json_encode(array('state'=>true,'msg'=>"OK")));
						}else{
							exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
						}
						break;
					case 3:
						//领取话费 检查是否符合条件
						if(intval($_SESSION['member_id']) <= 0){
							exit(json_encode(array('state'=>false,'msg'=>'请先登录后再来领取')));
						}
						$val = intval($_POST['val']);
						$HuaFei = array('10'=>'10','20'=>'20','50'=>'50','100'=>'100');
						$XianZhi = array(
							'10'=>array('min'=>3,'mix'=>4),
							'20'=>array('min'=>5,'mix'=>9),
							'50'=>array('min'=>10,'mix'=>14),
							'100'=>array('min'=>15,'mix'=>9999999)
						);
						if(in_array($val, $HuaFei)){
							//检查用户是否已经领取过
							$is_lin = $this->ZtModel->LinQuCount(array('ad_name'=>'20160621','member_id'=>intval($_SESSION['member_id']),'type'=>'0'));
							if($is_lin > 0){
								exit(json_encode(array('state'=>false,'msg'=>'每位用户仅限领取一次，不能重复领取。')));
							}
							//检查用户助力是否住够
							$model_member	= Model('member');
							$MemberCount = $model_member->getMemberCount(array('inviter_id'=>$_SESSION['member_id'],'member_from'=>array('like','%微信送话费活动%')));
							$min = $XianZhi[$val]['min'];
							$mix = $XianZhi[$val]['mix'];
							if($min <= $MemberCount && $MemberCount < $mix){
								$dataArr = array();
								$dataArr['mobile'] = $_POST['tel_mob'];
								$dataArr['address'] = $_POST['YunYingShang'].'	'.$_POST['prov'];
								$dataArr['member_id'] = intval($_SESSION['member_id']);
								$dataArr['member_name'] = $_SESSION['member_name'];
								$dataArr['ad_name'] = '20160621';
								$dataArr['add_time'] = time();
								$dataArr['l_id'] = $val;
								$qq = $this->ZtModel->insertLinQu($dataArr);
								exit(json_encode(array('state'=>true,'msg'=>"OK")));
							}else{
								exit(json_encode(array('state'=>false,'msg'=>'对不起，您不满足领取条件')));
							}
						}else{
							exit(json_encode(array('state'=>false,'msg'=>'违规操作')));
						}
						break;
					case 4:
					break;
					case 5:
					break;
					case 6:
						echo '-2';
						exit();
						//检查会员是否登陆
						if(intval($_SESSION['member_id']) <= 0 ){
							echo '-1';
							exit();
						}
						//检查会员是否关注公众号
						$weixin = new weixinSDK();
						$token = $weixin->token;
						$openid = $_SESSION['openid'];
						$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$openid&lang=zh_CN";
						$weixin_result = json_decode(file_get_contents($url),true);
						$weixin_result['headimgurl']; //微信头像
						if($weixin_result['subscribe'] == 1){
							echo '1';
							exit();
						}else{
							echo '2';
							exit();
						}
						break;
					case 7:
							//助力用户留言
							if($_POST['contents'] == ''){
								exit(json_encode(array('state'=>false,'msg'=>"留言类容不能为空！")));
							}
							if(intval($_SESSION['member_id']) <= 0){
								exit(json_encode(array('state'=>false,'msg'=>"参数不正确")));
							}
							//$model_member	= Model('member');
							$dataArr = array();
							//$member_info = $model_member->getMemberInfo(array('member_id'=>$_SESSION['member_id']));
							$dataArr['member_id'] = intval($_SESSION['member_id']);
							$dataArr['member_name'] = $_SESSION['member_name'];
							$dataArr['contet'] = $_POST['contents'];
							$dataArr['ad_name'] = '20160621';
							$dataArr['add_time'] = time();
							$dataArr['type'] = 1;
							//$dataArr['openid'] = $member_info['openid'];
							//$dataArr['inviter_id'] = $member_info['inviter_id'];
							$qq = $this->ZtModel->insertLinQu($dataArr);
							if($qq) {
								exit(json_encode(array('state'=>true,'msg'=>"OK")));
							}else{
								exit(json_encode(array('state'=>false,'msg'=>"提交失败")));
							}
							break;
				}
			}elseif($_GET['action'] == 'liu_yan'){
				Tpl::showpage('20160621/liu_yan');
			}else{
				//查询当前会员所有的助力好友
				$model_member	= Model('member'); //
				$weixin = new weixinSDK();
				$token = $weixin->token;
				if($push_openid){
					$where = array('openid'=>$_SESSION['push_openid']);
				}else{
					$where = array('member_id'=>$_SESSION['member_id']);
				}
				//获取当前会员的微信头像
				$member_info = $model_member->getMemberInfo($where);
				$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=".$_SESSION['push_openid']."&lang=zh_CN";

				$weixin_result = json_decode(file_get_contents($url),true);
				Tpl::output('headimgurl',$weixin_result['headimgurl']);//微信头像
				Tpl::output('nickname',$weixin_result['nickname']);//微信头像
				$weixin_result = array();

				$member_list = $model_member->getMemberList(array('inviter_id'=>$member_info['member_id'],'member_from'=>array('like','%微信送话费活动%')));
				if($member_list){
					foreach($member_list as $k=>$v){
						$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=".$v['openid']."&lang=zh_CN";
						$weixin_result = json_decode(file_get_contents($url),true);
						$member_list[$k]['headimgurl'] = $weixin_result['headimgurl']; //微信头像
						$ReceiveList = $this->ZtModel->getLotteryReceive(array('ad_name'=>'20160621','type'=>1,'member_id'=>$v['member_id']));
						$member_list[$k]['contet'] = $ReceiveList['contet']; //留言类容
					}
				}
				Tpl::output('member_list',$member_list);
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20160621/index_show');
			}	
		}else{
			echo("请在微信端打开");
			exit;
		}
	}


	/**
	 * 艺术重酬广告页面
	 */
	public function ad_20160615Op(){
			if($_GET['action'] == 'bot_ajax'){
				//检查手机号是否已经提交过
				$insert['name'] = $_POST['name'];
				$insert['mobile'] = $_POST['mobile'];
				$insert['contet'] = $_POST['content'];
				$insert['member_id'] = $_SESSION['member_id'];
				$insert['member_name'] = $_SESSION['member_name'];
				$insert['ad_name'] = '20160615';
				$insert['add_time'] = time();

				$obj_validate = new Validate();
				$obj_validate->validateparam = array(
				array("input"=>$insert["name"],		"require"=>"true",		"message"=>'用户名不能为空'),
				array("input"=>$insert["mobile"],	"require"=>"true",		"message"=>'手机号不能为空'),
				array("input"=>$insert["contet"],	"require"=>"true",		"message"=>'请输入内容')
				);
				$error = $obj_validate->validate();
				if ($error != ''){
					$result['error'] =  $error;
					echo json_encode($result); 
					exit();
				}

				$register_info['member_from'] = '艺术众筹(M)';
				//将数据写入crm存放
				$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$insert['mobile'].'&N='.urlencode($insert['name']).'&AdFrom=ad_20160615'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0&contents='.urlencode($insert['contet']));
				if($retuen_type == 1){
					echo '1';
					exit();
				}else{
					$result['error'] =  "您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!";
					echo json_encode($result); 
					exit();
				}
				
				
			}else{
				Tpl::output('html_title',"艺术众筹 书协主席毕政书法私人订制");
				Tpl::output('seo_keywords',"毕政 私人订制 众筹 书法 书协主席  收藏  书协理事");
				Tpl::output('seo_description',"为了促进文化产业的发展，响应文化部“书画中国梦”的倡导，收藏天下携手书协主席毕政发起了“艺术众筹  毕政书法私人订制”活动，以公益价格收藏万元作品，助推书法走进千家万户。");
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20160615/index_show');
			}
	}

	

	/**
	 * 猴币推广页面1
	 */
	public function ad_20160608_1Op(){
			Tpl::output('html_title',"关注微信免费领取2016猴年生肖纪念币一枚");
			Tpl::output('seo_keywords',"2016猴年生肖纪念币,猴币,猴年纪念币,生肖纪念币");
			Tpl::output('seo_description',"收藏天下是国内最专业的收藏品网站，本次举办的关注微信免费领取2016猴年生肖贺岁纪念币活动限时限量进行中！欢迎参加！");
			Tpl::showpage('20160608_1/index_show');
	}

	/**
	 * 猴币免费领取
	 */
	public function ad_20160608Op(){
		$zmr=intval($_GET['zmr']);
		if($zmr>0)
		{
		   setcookie('zmr', $zmr);
		}
		if($_GET['action'] == 'regs'){
			//注册
			$model_member	= Model('member');
			$code = $_POST['code'];
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
				$result['state'] = false;
				$result['msg'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$register_info = array();
			$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '猴币免费领取('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$model_member->createSession($member_info,true);
				exit(json_encode(array('state'=>true,'msg'=>"OK")));
			}else{
				exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
			}
		}elseif($_GET['action'] == 'lingqu'){
			$goodsid_array = array('14164'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%猴币免费领取%');
			//$where_member_from['member_time'] = array('gt','1464796800'); //注册时间在06-02至06-12之间
			//$where_member_from['member_time'] = array('lt','1465747200');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
			$goods_amount = '0'; //商品总额
			$shipping_fee = '20'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'猴币免费领取','免费领取');
		}else{
			$goodsid_array = array('14164'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%猴币免费领取%');
			//$where_member_from['member_time'] = array('gt','1464796800'); //注册时间在06-02至06-12之间
			//$where_member_from['member_time'] = array('lt','1465747200');

			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error']) Tpl::output('is_lin','1');

			Tpl::output('html_title',"猴年纪念币不花钱，免费领取");
			Tpl::output('seo_keywords',"猴年纪念币 猴币 生肖纪念币 纪念币 免费领取");
			Tpl::output('seo_description',"猴年纪念币不花钱，免费领！猴年生肖纪念币是当下最热门的纪念币藏品，为了推广纪念币收藏文化，特发起此次免费领取活动，快来领取吧！");
			Tpl::showpage('20160608/index_show');
		}
	}

	
	/**
	 * 端午节活动
	 */
	public function ad_20160602Op(){
		//检查是否在活动时间内
		if(time() > 1465747200){
			showMessage('您访问的活动已结束','http://m.96567.com','html','error');
			exit();
		}
		if($_GET['action'] == 'regs'){
			//注册
			$model_member	= Model('member');
			$code = $_POST['code'];
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
				$result['state'] = false;
				$result['msg'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$register_info = array();
			$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '端午节活动('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$model_member->createSession($member_info,true);
				exit(json_encode(array('state'=>true,'msg'=>"OK")));
			}else{
				exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
			}
		}elseif($_GET['action'] == 'lingqu'){
			$goodsid_array = array('2711'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%端午节活动%');
			$where_member_from['member_time'] = array('gt','1464796800'); //注册时间在06-02至06-12之间
			$where_member_from['member_time'] = array('lt','1465747200');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
			$goods_amount = '0'; //商品总额
			$shipping_fee = '20'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'端午节活动免费领取','【端午活动】免费领取');
		}else{
			$goodsid_array = array('2711'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%端午节活动%');
			$where_member_from['member_time'] = array('gt','1464796800'); //注册时间在06-02至06-12之间
			$where_member_from['member_time'] = array('lt','1465747200');

			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error']) Tpl::output('is_lin','1');

			$goods_info = Model('goods')->getGoodsInfoByID(1237);

			//从缓存中获取剩余数量
//			$dataArr = rkcache('HuoDong', true);
//			$dataArr['DuanWu'] = intval($dataArr['DuanWu']) <= 19 ? 200 : intval($dataArr['DuanWu']);
//			$intRand = rand(1,15);
//			if($intRand==5){
//				$num = rand(1,2);
//				$dataArr['DuanWu']= intval($dataArr['DuanWu']-$num);
//				if($dataArr['DuanWu'] < 20){
//					$dataArr['DuanWu']= rand(10,20);
//				}
//				wkcache('HuoDong', $dataArr); 
//			}
			Tpl::output('DuanWu',$goods_info['goods_storage']);

			Tpl::output('html_title',"端午特惠 纪念钞等额兑换");
			Tpl::output('seo_keywords',"端午 等值兑换 纪念钞 吉庆佳节 免费送");
			Tpl::output('seo_description',"吉庆佳节纪念钞等额兑换，可单枚或成套兑换，限量免邮。数量有限，仅200套，速兑换！");
			Tpl::showpage('20160602/index_show');
		}
	}

	/**
     * 520_1 里约专题 
     */
	public function ad_20160520_1Op(){
		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '里约奥运专题0520_1('.$M.')';
			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_20160520_1'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
			echo json_encode($result); 
			exit();
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title',"里约2016奥运纪念章 官方发售");
			Tpl::output('seo_keywords',"里约2016奥运纪念章 官方发售");
			Tpl::output('seo_description',"里约2016奥运纪念章 官方发售");
			Tpl::showpage('20160520_1/index_show');
		}
	}

	/**
     * 520 里约专题 
     */
	public function ad_20160520Op(){
		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '里约奥运专题0520('.$M.')';
			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_20160520'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
			echo json_encode($result); 
			exit();
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title',"里约2016奥运纪念章 官方发售");
			Tpl::output('seo_keywords',"里约2016奥运纪念章 官方发售");
			Tpl::output('seo_description',"里约2016奥运纪念章 官方发售");
			Tpl::showpage('20160520/index_show');
		}
	}

	/**
     * 519 里约专题 
     */
	public function ad_20160519Op(){
		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '里约奥运专题0519('.$M.')';
			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_20160519'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
			echo json_encode($result); 
			exit();
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title',"里约2016奥运纪念章 官方发售");
			Tpl::output('seo_keywords',"里约2016奥运纪念章 官方发售");
			Tpl::output('seo_description',"里约2016奥运纪念章 官方发售");
			Tpl::showpage('20160519/index_show');
		}
	}


	/**
     * 518专题附属活动 
     */
	public function ad_20160518_1Op(){
		Tpl::output('html_title',"收藏天下518大促，价格触底，0元大礼拿不停。");
		Tpl::output('seo_keywords',"收藏品 艺术品 人民币收藏 邮票 纪念币");
		Tpl::output('seo_description',"收藏天下5周年大促盛惠开启，注册免费送360元红包和10万面额外国钞，香港塑料钞9.9包邮；数十款火爆藏品价格触底，优惠到难以想象；每日一签到参与抽奖，每天都有30件等着大家。");
		Tpl::showpage('20160518_1/zhuanti_show');
	}

	/**
     * 518专题活动 
     */
	public function ad_20160518Op(){
		if($_GET['action'] == 'regs'){
			$model_member	= Model('member');
			$register_info = array();
			$code = $_POST['code'];
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
				$result['state'] = false;
				$result['msg'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '518大放价('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$model_member->createSession($member_info,true);
				exit(json_encode(array('state'=>true,'msg'=>"OK")));
			}else{
				exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
			}
		}elseif($_GET['action'] == 'lingqu'){
			//检测会员是否登陆
			if(intval($_SESSION['member_id']) <= 0){
				exit(json_encode(array('state'=>false,'msg'=>'-1')));
			}
			//领取代金卷和克罗地压十万钞
			$val = intval($_GET['val']);
			$this->FaFangDaiJingJuan($val);
		}elseif($_GET['action'] == 'linqu'){//实物领取
			$type = intval($_POST['type']);
			$lid = intval($_POST['lid']);
			if($type <= 0) exit(json_encode(array('state'=>false,'msg'=>'参数错误，请刷新浏览器后重试')));
			$this->ShiWuFaFang($type,$lid);
		}elseif($_GET['action'] == 'Xiang_GangChao'){//9.9领取香港钞
			//检测会员是否登陆
			if(intval($_SESSION['member_id']) <= 0){
				exit(json_encode(array('state'=>false,'msg'=>'-1')));
			}
			$goodsid_array = array('1111'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_exppoints'] = 0;
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from,'518(9.9包邮)');
			if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
            exit(json_encode(array('state'=>true,'msg'=>'OK')));
		}elseif($_GET['action'] == 'QianDao'){//签到
//			if(time() < 1466179200){
//				exit(json_encode(array('state'=>false,'msg'=>'签到抽奖活动于5月18日0点开启，敬请期待！')));
//			}
			//检测会员是否登陆
			$member_id = intval($_SESSION['member_id']);
			if($member_id <= 0){
				exit(json_encode(array('state'=>false,'msg'=>'-1')));
			}
			//检查当前会员当天是否已经签过到了
			$dataArr = rkcache('HuoDong', true);
			if($dataArr['QianDao'][$member_id]['date_time'] == date("Y-m-d",time())){
				exit(json_encode(array('state'=>false,'msg'=>'您今天已经签过到了')));
			}
			$dataArr['QianDao'][$member_id] = array('date_time'=>date("Y-m-d",time()),'qiandao'=>1);
			wkcache('HuoDong', $dataArr); //将签到写入缓存
			exit(json_encode(array('state'=>true,'msg'=>'今日签到已完成，获得一次抽奖机会')));
		}elseif($_GET['action'] == 'CouJiang'){//抽奖
			
			$this->CouJiangAction();
		}else{
			$miaosha_classes = Model('miaosha_class')->getList(array('order'=>' start_hour asc '));
			$new_classes = array();
			foreach($miaosha_classes as $k=>$v){
				$new_classes[$v['class_id']] = $v;
			}
			$model_miaosha = Model('miaosha');
			//获取秒杀列表
			$condition = array();
			//$condition['state'] = '20';
			$condition['start_time'] = array(array('gt', strtotime(date('Y-m-d'))),array('lt', strtotime(date('Y-m-d')) + 86400),'and');//state desc,start_time desc,miaosha_id asc
			$miaosha_info = $model_miaosha->getMiaoshaList($condition,null,'start_time asc,m_sort asc');
			$miaosha_list = array();
			foreach($miaosha_info as $k=>$v){
				if($v['start_time'] > strtotime(date('Y-m-d')) && $v['start_time'] < (strtotime(date('Y-m-d')) + 86400)){
				   $start_hour = $new_classes[$v['class_id']]['start_hour'];
				   $end_hour   = $new_classes[$v['class_id']]['end_hour'];
				   if(count($miaosha_list[$start_hour]) < 4){ // 每个时间档位只取两个秒杀
							$goods_info = Model('goods')->getGoodsInfoByID($v['goods_id']);
							$miaosha_list[$start_hour][$v['miaosha_id']] = $v;
							$miaosha_list[$start_hour][$v['miaosha_id']]['goods_marketprice'] = $goods_info['goods_marketprice'];
							$miaosha_list[$start_hour][$v['miaosha_id']]['lisheng'] = $goods_info['goods_marketprice'] - $goods_info['miaosha_price'];
							$yu_quantity = $v['max_quantity']-$v['buy_quantity'];
							$miaosha_list[$start_hour][$v['miaosha_id']]['shengyukucun'] = ($yu_quantity >= $goods_info['goods_storage'])?$goods_info['goods_storage']:$yu_quantity;
							$miaosha_list[$start_hour][$v['miaosha_id']]['goods_image'] = thumb($goods_info, 240);
							$miaosha_list[$start_hour][$v['miaosha_id']]['goods_url'] = urlShop('goods', 'index', array('goods_id' => $v['goods_id']));
							$miaosha_list[$start_hour][$v['miaosha_id']]['end'] = 3;
					   if(date('H',time()) >= $start_hour && date('H',time()) < $end_hour && $miaosha_list[$start_hour][$v['miaosha_id']]['shengyukucun'] > 0){
							$miaosha_list[$start_hour][$v['miaosha_id']]['end'] = 2; //进行中
					   }elseif (date('H',time()) >= $end_hour || $miaosha_list[$start_hour][$v['miaosha_id']]['shengyukucun'] == 0) {
							$miaosha_list[$start_hour][$v['miaosha_id']]['end'] = 1; //已结束
					   } else {
							$miaosha_list[$start_hour][$v['miaosha_id']]['end'] = 3; //即将开始
					  }
				   }
				   
				}
			}
			Tpl::output('miaosha_list',$miaosha_list);
		
			$member_id = intval($_SESSION['member_id']);
			$HuoDong = rkcache('HuoDong', true);
			if($HuoDong['QianDao'][$member_id]['date_time'] == date("Y-m-d",time())){
				$is_qian_dao = 1;
			}else{
				$is_qian_dao = 0;
			}
			Tpl::output('is_qian_dao',$is_qian_dao);
			//查询商品评分信息
			$in_goods_id = array('11734','11735','4262','8262','14809','16861','14241','15112');
			$evaluate_goods_condition['geval_goodsid'] = array('in',$in_goods_id);
			$model_evaluate_goods = Model("evaluate_goods");
			$goodsevallist = $model_evaluate_goods->getEvaluateGoodsList($evaluate_goods_condition,20);
			
			Tpl::output('goodsevallist',$goodsevallist);
			
			$array_inlid = array(0,1,2);
			//获得当前会员中奖记录
			$MyLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160518','member_id'=>$_SESSION['member_id'],'l_id'=>array('in',$array_inlid),'add_time'=>array('elt',time())),'*,(SELECT member_name FROM shop_member WHERE `shop_member`.member_id = `shop_lottery_member`.member_id) as member_name','','add_time desc');
			Tpl::output('MyLotteryList',$MyLotteryList);
			//获得所有会员中奖记录
			$SuoYouLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160518','l_id'=>array('in',$array_inlid),'add_time'=>array('elt',time())),'*,(SELECT member_name FROM shop_member WHERE `shop_member`.member_id = `shop_lottery_member`.member_id) as member_name','','add_time desc');
			Tpl::output('SuoYouLotteryList',$SuoYouLotteryList);

			Tpl::output('html_title',"收藏天下518大促，价格触底，0元大礼拿不停。");
			Tpl::output('seo_keywords',"收藏品 艺术品 人民币收藏 邮票 纪念币");
			Tpl::output('seo_description',"收藏天下5周年大促盛惠开启，注册免费送360元红包和10万面额外国钞，香港塑料钞9.9包邮；数十款火爆藏品价格触底，优惠到难以想象；每日一签到参与抽奖，每天都有30件等着大家。");
			$goodsid_in = "11734,4262,8262,11735,14809,14241,16861,15112,11729,12384,15597,963";
			$goodsidarray = explode(',',$goodsid_in);
			$goods_in['goods_id'] = array('in',$goodsidarray);
			$goods_list = Model('goods')->getGoodsList($goods_in,'*','','goods_id desc');
			Tpl::output('goods_list',$goods_list);
			Tpl::showpage('20160518/zhuanti_show');
		}
	}

	//会员抽奖
	private function CouJiangAction(){
		//检测会员是否登陆
		$member_id = intval($_SESSION['member_id']);
		if($member_id <= 0){
			exit(json_encode(array('state'=>false,'msg'=>'-1')));
		}
//		if(time() < 1466179200){
//			exit(json_encode(array('state'=>false,'msg'=>'签到抽奖活动于5月18日0点开启，敬请期待！')));
//		}
		//检查会员是否拥有抽奖资格
		$HuoDong = rkcache('HuoDong', true);
		if($HuoDong['QianDao'][$member_id]['date_time'] != date("Y-m-d",time())){
			exit(json_encode(array('state'=>false,'msg'=>'请先签到再来进行抽奖！')));
		}
		if($HuoDong['QianDao'][$member_id]['qiandao'] == 0){
			exit(json_encode(array('state'=>false,'msg'=>'您今日的抽奖次数已用完，请明日再来！')));
		}
		$prize_arr = array(
			'0' => array('prize'=>'马达加斯加时尚天然紫晶手链','v'=>17031,'type'=>'1',num=>'20'),
			'1' => array('prize'=>'海南星月菩提108颗手串','v'=>17030,'type'=>'1',num=>'20'),
			'2' => array('prize'=>'都锦生蚕丝高档丝巾（花好月圆）','v'=>11085,'type'=>'1',num=>'25'),
			'3' => array('prize'=>'很遗憾！今天没有抽中，明天接着来试试吧！','v'=>0,'type'=>'2')
		);
		$rid = rand(0,1000);
		$is_fafang = 0;
		if($rid == 5){
			$r_id = 2;
		}elseif($rid == 555){
			$r_id = 1;
		}elseif($rid == 666){
			$r_id = 0;
		}else{
			$r_id = 3;
			$is_fafang = 1;
		}
		
		$DangTianShiWu = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160518','l_id'=>$r_id));
		$res = $prize_arr[$r_id]; //中奖项
		//判断实物奖品是否发放完成
		if($res['type'] == 1){
			//如果实物奖品发放完则赠送优惠劵
			if(intval($res['num']-$DangTianShiWu) <= 0){
				$r_id = 3;
			}
		}
		$res = $prize_arr[$r_id]; //重新获取中奖项
		//将中奖信息写入数据库
		$data['member_id'] = $member_id;
		$data['year'] = date('Y',time());
		$data['month'] = date('m',time());
		$data['day'] = date('d',time());
		$data['hour'] = date('H',time());
		$data['time'] = date('H:i:s',time());
		$data['add_time'] = time();
		$data['ip'] = $_SERVER['REMOTE_ADDR'];
		$data['ad_name'] = '20160518';
		$data['l_name'] = $res['prize'];
		$data['l_id'] = $r_id;
		$data['is_fafang'] = $is_fafang;
		$lid = $this->ZtModel->addLottery($data);
		$member_id = intval($_SESSION['member_id']);
		$dataArr = rkcache('HuoDong', true);
		$dataArr['QianDao'][$member_id] = array('date_time'=>date("Y-m-d",time()),'qiandao'=>0);
		wkcache('HuoDong', $dataArr); //将签到写入缓存 清空签到次数防止重复抽奖
		exit(json_encode(array('state'=>true,'msg'=>$res['prize'],'r_id'=>$r_id,'lid'=>$lid)));
	}

	//实物发放
	private function ShiWuFaFang($val,$lid){
		if($val == 1){//领取十万钞
			//检查用户是否用领取资格 只要有过订单的会员就不能领取
			$order = $this->ZtModel->getOrder(array('buyer_id'=>$member_id,'order_state'=>array('egt',20),'order_amount'=>array('egt',1)),'order_id,order_amount');
			if(count($order) > 0){
				exit(json_encode(array('state'=>false,'msg'=>'对不起，您不符合领取资格！')));
			}
			//检查用户是否验证手机
			$memberCount = Model('member')->getMemberCount(array('member_id'=>$member_id,'member_mobile_bind'=>1));
			if($memberCount <= 0){
				exit(json_encode(array('state'=>false,'msg'=>'对不起，您尚未验证手机请验证之后再来领取！')));
			}
			$goodsid_array = array('15900'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from,'518免费领取');
			if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
			$goods_amount = '0'; //商品总额
			$shipping_fee = '0'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'518免费领取','518免费领取');
		}elseif($val == 2){
			$goodsid_array = array('1111'=>'0');
			$where_member_from['member_id'] = $member_id;
			$where_member_from['member_exppoints'] = 0;
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,'','518(9.9包邮)');
			if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
			$goods_amount = '9.9'; //商品总额
			$shipping_fee = '0'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'518(9.9包邮)','518(9.9包邮)');
		}elseif($val == 3){
			$goodsid_array = array('17031'=>'0');
			$goods_amount = '0'; //商品总额
			$shipping_fee = '0'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'518(抽奖)','518(抽奖)',true,$lid);
		}elseif($val == 4){
			$goodsid_array = array('17030'=>'0');
			$goods_amount = '0'; //商品总额
			$shipping_fee = '0'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'518(抽奖)','518(抽奖)',true,$lid);
		}elseif($val == 5){
			$goodsid_array = array('11085'=>'0');
			$goods_amount = '0'; //商品总额
			$shipping_fee = '0'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'518(抽奖)','518(抽奖)',true,$lid);
		}
	}


	//518发放带代金卷和领取十万钞
	private function FaFangDaiJingJuan($val){
		$member_id = intval($_SESSION['member_id']);
		//检查用户是否用领取资格 只要有过订单的会员就不能领取
		$order = $this->ZtModel->getOrder(array('buyer_id'=>$member_id,'order_state'=>array('egt',20),'order_amount'=>array('egt',1)),'order_id,order_amount');
		if(count($order) > 0){
			exit(json_encode(array('state'=>false,'msg'=>'-5')));
		}
		if($val == 1){//十元代金卷
			//检查用户是否已经领取过代金卷
			$store_VoucherCount = $this->ZtModel->store_VoucherCount(array('voucher_t_id'=>'3','voucher_owner_id'=>intval($member_id)));
			if($store_VoucherCount > 0){
				exit(json_encode(array('state'=>false,'msg'=>'-2')));
			}
			$this->ZtModel->store_exchangeVoucher(3,$member_id);
			$this->ZtModel->store_exchangeVoucher(3,$member_id);
			exit(json_encode(array('state'=>false,'msg'=>'1')));
		}elseif($val == 3){//二十元代金卷
			//检查用户是否已经领取过代金卷
			$store_VoucherCount = $this->ZtModel->store_VoucherCount(array('voucher_t_id'=>'4','voucher_owner_id'=>intval($member_id)));
			if($store_VoucherCount > 0){
				exit(json_encode(array('state'=>false,'msg'=>'-2')));
			}
			$this->ZtModel->store_exchangeVoucher(4,$member_id);
			$this->ZtModel->store_exchangeVoucher(4,$member_id);
			exit(json_encode(array('state'=>false,'msg'=>'1')));
		}elseif($val == 2){//五十元代金卷
			//检查用户是否已经领取过代金卷
			$store_VoucherCount = $this->ZtModel->store_VoucherCount(array('voucher_t_id'=>'5','voucher_owner_id'=>intval($member_id)));
			if($store_VoucherCount > 0){
				exit(json_encode(array('state'=>false,'msg'=>'-2')));
			}
			$this->ZtModel->store_exchangeVoucher(5,$member_id);
			$this->ZtModel->store_exchangeVoucher(5,$member_id);
			exit(json_encode(array('state'=>false,'msg'=>'1')));
		}elseif($val == 4){//一百元代金卷
			//检查用户是否已经领取过代金卷
			$store_VoucherCount = $this->ZtModel->store_VoucherCount(array('voucher_t_id'=>'6','voucher_owner_id'=>intval($member_id)));
			if($store_VoucherCount > 0){
				exit(json_encode(array('state'=>false,'msg'=>'-2')));
			}
			$this->ZtModel->store_exchangeVoucher(6,$member_id);
			$this->ZtModel->store_exchangeVoucher(6,$member_id);
			exit(json_encode(array('state'=>false,'msg'=>'1')));
		}elseif($val == 5){
			$goodsid_array = array('15900'=>'0');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,'','518免费领取');
			if($return_error['error']){
				exit(json_encode(array('state'=>false,'msg'=>'-2')));
			}
			//领取实物
			exit(json_encode(array('state'=>false,'msg'=>'1')));
		}else{//全部领取
			$array = array(3,4,5,6);
			$store_VoucherCount = $this->ZtModel->store_VoucherCount(array('voucher_t_id'=>array('in',$array),'voucher_owner_id'=>intval($member_id)));
			$goodsid_array = array('15900'=>'0');
			$where_member_from['member_id'] = $member_id;
			$where_member_from['member_exppoints'] = array('egt',0);
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,'','518免费领取');

			if($store_VoucherCount > 0 && $return_error['error']){
				exit(json_encode(array('state'=>false,'msg'=>'-2')));
			}
			foreach($array as $k=>$v){
				$store_VoucherCount = $this->ZtModel->store_VoucherCount(array('voucher_t_id'=>$v,'voucher_owner_id'=>intval($member_id)));
				if($store_VoucherCount > 0){
					unset($array[$k]); // 排除已经领取过的优惠劵
				}else{
					$this->ZtModel->store_exchangeVoucher($v,$member_id);
					$this->ZtModel->store_exchangeVoucher($v,$member_id);
				}
			}
			if($return_error['error']){
				exit(json_encode(array('state'=>false,'msg'=>'-3')));
			}else{
				exit(json_encode(array('state'=>false,'msg'=>'1')));
			}
		}
	}
	//518专题 end

	/**
	 * 杜 免费领取
	 */
	public function ad_20160511Op(){
		if($_GET['action'] == 'yanzhengone'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$code = $_POST['code'];
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code){
				$result['error'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '免费送十国钞('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$result['msg'] = '注册成功';
				$model_member->createSession($member_info,true);
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}else{
			$goodsid_array = array('15898'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%免费送十国钞%');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error'] == '您不符合领取资格') Tpl::output('is_lin','1');
			Tpl::output('member_id',intval($_SESSION['member_id']));
			Tpl::output('html_title',"收藏天下注册有礼，免费送十国钞。");
			Tpl::output('seo_keywords',"注册有礼,免费领取,十国钞,免费送十国钞");
			Tpl::output('seo_description',"收藏天下注册有礼再次来袭，注册就免费送十国钞，带册装帧更豪华，存世流传有心意。立刻注册，立刻免费领取十国钞，自己珍藏、送人礼物，均是极棒的选择。来收藏天下，免费好礼免费拿！");
			Tpl::output('no_footer',true);
			Tpl::showpage('20160511/index_show');
		}
	}

	/**
     * 幸总的 里约奥运专题手机版 du 20160504_2
     */
    public function ad_20160504_2Op(){
		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '里约奥运专题5('.$M.')';
			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_20160504_2'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
			echo json_encode($result); 
			exit();
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_keywords',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_description',"里约2016奥运纪念币 官方发售");
			Tpl::showpage('20160504_2/index_show');
		}
	}
	

	/**
     * 尹祥宾的 里约奥运专题手机版 du 20160504
     */
    public function ad_20160504_1Op(){
		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '里约奥运专题4('.$M.')';
			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_20160504_1'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
			echo json_encode($result); 
			exit();
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_keywords',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_description',"里约2016奥运纪念币 官方发售");
			Tpl::showpage('20160504_1/index_show');
		}
	}
	
	/**
     * 尹祥宾的 里约奥运专题手机版 du 20160504
     */
    public function ad_20160504Op(){
		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '里约奥运专题3('.$M.')';
			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_20160504'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
			echo json_encode($result); 
			exit();
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_keywords',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_description',"里约2016奥运纪念币 官方发售");
			Tpl::showpage('20160504/index_show');
		}
	}

	/**
     * 幸总的 里约奥运专题手机版 du 20160429
     */
    public function ad_20160429Op(){
		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '里约奥运专题2('.$M.')';
			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_20160429'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
			echo json_encode($result); 
			exit();
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_keywords',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_description',"里约2016奥运纪念币 官方发售");
			Tpl::showpage('20160429/index_show');
		}
	}
	

	/**
     * 里约奥运专题手机版 du 20160422
     */
    public function ad_20160422Op(){
		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			//$register_info['password'] = rand(100000,999999); //生成随机密码
			//$register_info['password_confirm'] = $register_info['password'] ;
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '里约奥运专题('.$M.')';

			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_20160422'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
			echo json_encode($result); 
			exit();

			//$member_info = $model_member->register($register_info);
//			if(!isset($member_info['error'])) {
//				$sms = new Sms();
//				$sms->send($_POST["mob_phone"],"恭喜您成为收藏天下的会员您的密码是：".$register_info['password']);
//				//注册成功执行订购
//				$model_member->createSession($member_info,true);
//				$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
//				//将数据写入crm存放
//				@file_get_contents(CRM_SITE_URL."/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&A_AdFrom=20160422(m)'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=1');
//				echo json_encode($result); 
//				exit();
//			
//			}else{
//				if($member_info['error'] == '手机号已存在' || $member_info['error'] == '用户名已存在'){
//					$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
//					//将数据写入crm存放
//					@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&A_AdFrom=20160422(m)'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
//					echo json_encode($result); 
//					exit();
//				}else{
//					$result['msg'] = $member_info['error'];
//					echo json_encode($result); 
//					exit();
//				}
//			}
//		
	
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_keywords',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_description',"里约2016奥运纪念币 官方发售");
			Tpl::showpage('20160422/index_show');
		}
	}
	
	/**
     * 抢钱包活动 du 20160415
     */
    public function ad_20160415Op(){
		
		$JiHui = 3;
		//获取当前会员所有拆红包记录
		$ChaiCount = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160415','member_id'=>intval($_SESSION['member_id'])));
		$JiHui = intval($JiHui-$ChaiCount); //检查会员剩余拆红包次数
        if($_GET['action'] == 'caihongbao'){
			$member_id = intval($_SESSION['member_id']);
				//用户未登录
			if($member_id <= 0){
				echo '-1';
			}else{
				//执行用户拆红包
				$result['JiangHtml'] = $this->JiangHtml($JiHui);
				$ChaiCount = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160415','member_id'=>intval($member_id)));
				$result['JiHui'] = intval(3-$ChaiCount) <= 0 ? 0 : intval(3-$ChaiCount);
				echo json_encode($result); 
				exit();
			}
			exit;
        }elseif($_GET['action'] == 'yanzhengone'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$code = $_POST['code'];
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code){
				$result['error'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '微信抢钱包活动('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$result['msg'] = '注册成功';
				$model_member->createSession($member_info,true);
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}elseif($_GET['action'] == 'MyLotteryList'){ // 加载获奖列表
			//获取当前会员所有拆中的奖项
			$MyLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160415','member_id'=>intval($_SESSION['member_id'])),"*",'5','l_id desc');
			Tpl::output('MyLotteryList',$MyLotteryList);
			Tpl::showpage('20160415/MyLotteryList','null_layout');
		}elseif($_GET['action'] == 'Linqu'){
			//活动全部领取    --- 获取当前会员所有未领取奖项
			$MyLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160415','member_id'=>intval($_SESSION['member_id']),'is_fafang'=>'0'),"*",'5','l_id ASC');
			$goodsid_array = array();
			$lid = array();
			if($MyLotteryList){
				foreach($MyLotteryList as $k=>$v){
					$goodsid_array[$v['goods_id']] = 0;
					$lid[] = $v['id'];
				}
			}else{
				$result['state'] = false;
				$result['msg'] = '您暂时没有奖品可领取~';
				echo json_encode($result); 
				exit();
			}
			$goods_amount = '0'; //商品总额
			$shipping_fee = '9.9'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"微信抢钱包活动",'微信抢钱包活动(M)',true,$lid);
		}elseif($_GET['action'] == 'is_lingqu'){
			//检查会员是否关注公众号
			$weixin = new weixinSDK();
	    	$token = $weixin->token;
	    	$openid = $_SESSION['openid'];
			$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$openid&lang=zh_CN";
	        $weixin_result = json_decode(file_get_contents($url),true);
			$model_member	= Model('member');
			//$member_info = $model_member->getMemberInfo(array('member_id'=>intval($_SESSION['member_id'])),'is_open');
			$member_info['is_open'] = 1;
			if($weixin_result['subscribe'] == 1){
				//检查用户是否有未领取商品
				$MyLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160415','member_id'=>intval($_SESSION['member_id']),'is_fafang'=>'0'),"*",'5','l_id ASC');
				$goodsid_array = array();
				$lid = array();
				if($MyLotteryList){
					echo 1;
				}else{
					$result = '您暂时没有奖品可领取~';
					echo json_encode($result); 
				}
			}else{
				echo -1;
			}
			exit();
		}elseif($_GET['action'] == 'fenxiang'){
			//记录分享到朋友圈
			if(intval($_SESSION['member_id']) > 0){
				$model = Model('member');
				$model->query("UPDATE shop_member SET share_num =  share_num+1 WHERE  member_id =".intval($_SESSION['member_id'])." ");
			}
			
		}elseif($_GET['action'] == 'url_admin'){
				//登录检查验证
				if($_POST){
					$user=$_POST["username"];
					$pws=$_POST["password"];
					if($user == "杜飞" && $pws =="df123123"){
					   setcookie("DfZtAdmin", "1");
					   header("location:index.php?act=zhuanti&op=ad_20160415&action=url_admin");
					}else{
						echo "<script>window.alert('登录失败返回重新登录');window.location.href='index.php?act=zhuanti&op=ad_20160415&action=url_admin';</script>";
						exit;
					}
				}else{
					if(empty($_COOKIE["DfZtAdmin"])) {
						Tpl::showpage('20160415/admin/login','null_layout');
					}else{
						$member_sat = ($_GET['Start_time'] == '') ? '1459440000' : strtotime($_GET['Start_time']);
						$member_end = ($_GET['End_time'] == '') ? time() : strtotime($_GET['End_time']);
						//统计活动规定时间累注册的会员  以及订单总额和订单数量等
						$from ='微信抢钱包活动(m)';
						$model = Model('member');
						$members = $model->query("select member_id from shop_member WHERE member_from = '".$from."' and member_time >= ".$member_sat." AND member_time <= ".$member_end);

						$order_info = $model->query("select sum(order_amount) as order_amount,count(order_id) as num from shop_order where buyer_id in(select member_id from shop_member WHERE member_from = '".$from."' and member_time >= ".$member_sat." AND member_time <= ".$member_end.") AND add_time >= ".$member_sat." AND add_time <= ".$member_end."");

						$order_payd = $model->query("select sum(order_amount) as order_amount,count(order_id) as num from shop_order where order_state > 10 AND buyer_id in(select member_id from shop_member WHERE member_from = '".$from."' and member_time >= ".$member_sat." AND member_time <= ".$member_end.") AND add_time >= ".$member_sat." AND add_time <= ".$member_end."");

						$str = date("Y-m-d",$member_sat).' 至 '.date("Y-m-d",$member_end).'&nbsp;注册的会员数量为：'.count($members).'&nbsp;订单总额：'.$order_info[0]['order_amount'].'&nbsp;订单总数：'.intval($order_info[0]['num']).'&nbsp;已支付订单总额：'.$order_payd[0]['order_amount'].'&nbsp;已支付订单总数：'.intval($order_payd[0]['num']);
						Tpl::output('str',$str);

						//统计活动 所有订单总额和订单数量等

						$hdorder_info = $model->query("select sum(order_amount) as order_amount,count(order_id) as num from shop_order where order_id in(select orderid from shop_yw_info WHERE referer = '微信抢钱包活动') AND add_time >= ".$member_sat." AND add_time <= ".$member_end."");

						$hdorder_payd = $model->query("select sum(order_amount) as order_amount,count(order_id) as num from shop_order where order_state > 10 AND order_id in(select orderid from shop_yw_info WHERE referer = '微信抢钱包活动') AND add_time >= ".$member_sat." AND add_time <= ".$member_end."");

						$hd_str = date("Y-m-d",$member_sat).' 至 '.date("Y-m-d",$member_end).'&nbsp;活动总计：订单总额：'.$hdorder_info[0]['order_amount'].'&nbsp;订单总数：'.intval($hdorder_info[0]['num']).'&nbsp;总计已支付订单总额：'.$hdorder_payd[0]['order_amount'].'&nbsp;已支付订单总数：'.intval($hdorder_payd[0]['num']);
						Tpl::output('hd_str',$hd_str);


						//获得所有会员中奖记录
						$SuoYouLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160415','add_time'=>array('elt',$member_end),'add_time'=>array('egt',$member_sat)),'*,(SELECT member_name FROM shop_member WHERE `shop_member`.member_id = `shop_lottery_member`.member_id) as member_name','20','is_fafang ASC,id desc');
						Tpl::output('show_page',$this->ZtModel->showpage());
						Tpl::output('List',$SuoYouLotteryList);
						//总共抽奖次数
						$ZongCount = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160415','add_time'=>array('elt',$member_end),'add_time'=>array('egt',$member_sat)));
						Tpl::output('ZongCount',$ZongCount);
						//参与会员总数
						$model = Model('member');
						$ZongMember = $model->query("SELECT count(*) as count FROM shop_lottery_member where ad_name = '20160415' AND add_time >= ".$member_sat." AND add_time <= ".$member_end." group by member_id");
						Tpl::output('ZongMember',count($ZongMember));
						//新会员参与数
						$xinhuiyuanchanyu = $model->query("SELECT count(*) as count FROM shop_lottery_member where ad_name = '20160415' AND add_time >= ".$member_sat." AND add_time <= ".$member_end." AND member_id in(select member_id from shop_member WHERE member_from = '".$from."' and member_time >= ".$member_sat." AND member_time <= ".$member_end.")  group by member_id");
						Tpl::output('xinhuiyuanchanyu',count($xinhuiyuanchanyu));
						//分享2次的会员
						$FenXiangLiangCount = $model->query("SELECT count(*) as count FROM shop_lottery_member where ad_name = '20160415' AND add_time >= ".$member_sat." AND add_time <= ".$member_end." AND l_id > 2 group by member_id");
						Tpl::output('FenXiangLiangCount',count($FenXiangLiangCount));

						//分享一次的会员
						$FenXiangCount = $model->query("SELECT count(*) as count FROM shop_lottery_member where ad_name = '20160415' AND add_time >= ".$member_sat." AND add_time <= ".$member_end." AND  l_id = 2 group by member_id");
						Tpl::output('FenXiangCount',count($FenXiangCount)-count($FenXiangLiangCount));
						
						//获取当前中奖项的总数量
						//周边十国10张钞票 中奖数量
						$ZhouBian = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160415','add_time'=>array('elt',$member_end),'add_time'=>array('egt',$member_sat),'l_id'=>1));
						//克罗地亚10万纸币 中奖数量
						$KeLuoDiya = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160415','add_time'=>array('elt',$member_end),'add_time'=>array('egt',$member_sat),'l_id'=>2));
						//十元代金卷 中奖数量
						$ShiYuanDai = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160415','add_time'=>array('elt',$member_end),'add_time'=>array('egt',$member_sat),'l_id'=>3));
						$JiangHtml =	date("Y-m-d",$member_sat).' 至 '.date("Y-m-d",$member_end).'&nbsp;周边十国10张钞票，中奖数量：'.$ZhouBian.'&nbsp;克罗地亚10万纸币，中奖数量：'.$KeLuoDiya.'&nbsp;十元代金卷，中奖数量：'.$ShiYuanDai;
						Tpl::output('JiangHtml',$JiangHtml);

						//获取三个奖品的订单数量
						//周边十国10张钞票 订单数量
						$ZhouBianorder_info = $model->query("select sum(order_amount) as order_amount,count(order_id) as num from shop_order where order_id in(select orderid from shop_yw_info WHERE referer = '微信抢钱包活动') AND order_id in(select order_id from shop_order_goods WHERE goods_id = '15898') AND add_time >= ".$member_sat." AND add_time <= ".$member_end."");

						$LuoDiYaorder_info = $model->query("select sum(order_amount) as order_amount,count(order_id) as num from shop_order where order_id in(select orderid from shop_yw_info WHERE referer = '微信抢钱包活动') AND order_id in(select order_id from shop_order_goods WHERE goods_id = '15900') AND add_time >= ".$member_sat." AND add_time <= ".$member_end."");
						
						$DaiJinJuanrder_info = $model->query("select count(voucher_id) as num from shop_voucher where voucher_t_id = 197 AND voucher_state = 2");
						
						$sssssJiangHtml =	date("Y-m-d",$member_sat).' 至 '.date("Y-m-d",$member_end).'&nbsp;周边十国10张钞票，订单数量：'.$ZhouBianorder_info[0]['num'].'&nbsp;金额：'.$ZhouBianorder_info[0]['order_amount'].'&nbsp;克罗地亚10万纸币，订单数量：'.$LuoDiYaorder_info[0]['num'].'&nbsp;金额：'.$LuoDiYaorder_info[0]['order_amount'].'&nbsp;已用十元代金卷，数量：'.$DaiJinJuanrder_info[0]['num'];
						Tpl::output('sssssJiangHtml',$sssssJiangHtml);
						Tpl::showpage('20160415/admin/adminindex','null_layout');
					}
				}
				
		}else{
			//检查用户是否在微信浏览器打开
			if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
	
				if(intval($_SESSION['member_id']) > 0){
					//获取当前会员所有拆中的奖项
					$MyLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160415','member_id'=>intval($_SESSION['member_id'])),"*",'5','l_id desc');
					Tpl::output('MyLotteryList',$MyLotteryList);
				}
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::output('html_title',"");
				Tpl::output('seo_keywords',"");
				Tpl::output('seo_description',"");
				Tpl::output('JiHui',$JiHui);
				Tpl::showpage('20160415/index_show');
						
			}else{
				echo("请在微信端打开");
				exit;
			}
        }
    }
	
	/**
     * 返回用户点击拆红包样式html
     */
	public function JiangHtml($type='1'){
		$html = '';
		$prize_arr = array();
		//获取会员的分享次数
		$model_member	= Model('member');
		$member_info = $model_member->getMemberInfo(array('member_id'=>intval($_SESSION['member_id'])),'share_num');

		if($type == 3){ //第一次拆红包
			$html = '<img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160415/images/c1.png" alt="">';
			$prize_arr = array(
				'1' => array('angle'=>0,'prize'=>'周边十国10张钞票','v'=>15898)
			);
			$rid = 1;
		}elseif($type == 2){ //第二次拆红包
			//第二次拆红包需要检查是否有分享
			if($member_info['share_num'] > 0){
				$html = '<img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160415/images/c2.png" alt="">';
				$prize_arr = array(
					'2' => array('angle'=>0,'prize'=>'克罗地亚10万纸币','v'=>15900)
				);
				$rid = 2;
			}else{
				$html = '<img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160415/images/t1.png" alt="" onclick="df_aa();">';
				
			}
		}elseif($type == 1){ //第三次拆红包 抽奖
		  if($member_info['share_num'] > 1){
				$html = '<img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160415/images/c3.png" alt="">';
				$prize_arr = array(
					'3' => array('angle'=>0,'prize'=>'十元代金卷','v'=>197)
				);
				$rid = 3;
			}else{
				$html = '<img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160415/images/t2.png" alt="" onclick="df_aa();">';
			}

//			$prize_arr = array(
//				'3' => array('angle'=>2000,'prize'=>'克罗地亚10万纸币','v'=>15900),
//				'4' => array('angle'=>8000,'prize'=>'很遗憾没有拆中','v'=>0),
//			);
//			foreach ($prize_arr as $key => $val) { 
//				$arr[$key] = $val['angle']; 
//			}
//			$rid = $this->getRand($arr); //根据概率获取奖项id 
//			if($rid == 3){
//				$html = '<h2>财运爆棚！满载而归！</h2><h4>克罗地亚10万纸币</h4><h5>马钞，马上有钞，吉祥钞</h5><div class="shop"><img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160415/images/pic003.jpg" alt=""></div><p>快去我的财富收钱吧</p>';
//			}else{
//				$html = '<h2>oh，很遗憾没有拆中</h2><h4></h4><h5></h5><p>快去【我的财富】领取现金吧</p>';
//			}
//		  }else{
//			  $html = '<h2>小编温馨提示</h2><h4></h4><h5></h5><p>分享到朋友圈1次，又可以拆1次钱包哦</p>';
//		  }
		}else{
			$html = '<img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160415/images/t3.png" alt="" onclick="df_aa();">';
		}

		if($prize_arr){
			$res = $prize_arr[$rid]; //中奖项
			if($rid < 3){
				$data['goods_id'] = $res['v'];
			}
			if($rid == 3){
				//获得代金卷 发放代金卷
				$this->ZtModel->exchangeVoucher($res['v'],intval($_SESSION['member_id']));
				$is_fafang = 1;
			} 
			$data['member_id'] = intval($_SESSION['member_id']);
			$data['year'] = date('Y',time());
			$data['month'] = date('m',time());
			$data['day'] = date('d',time());
			$data['hour'] = date('H',time());
			$data['time'] = date('H:i:s',time());
			$data['add_time'] = time();
			$data['ip'] = $_SERVER['REMOTE_ADDR'];
			$data['ad_name'] = '20160415';
			$data['l_name'] = $res['prize'];
			$data['l_id'] = $rid;
			$data['is_fafang'] = $rid == 3 ? 1 : 0;
			$this->ZtModel->addLottery($data);
		}
		return $html;
	}


	/**
     * 招商 du 20160411
     * 重庆万达送福字活动
     */
    public function ad_20160411Op(){
        if($_GET['action'] == 'zuce'){
            $model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = rand(100000,999999);//随机生成6位的密码
			$register_info['password_confirm'] = $register_info['password'];
			$register_info['mobile'] = $_POST['mobile'];
			$register_info['member_from'] = '万达送福字活动';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$yw_info_get = file_get_contents(CRM_SITE_URL.'/index.php?m=api&p=action&c=cpregister&ID='.$member_info['member_id'].'&M='.$register_info['mobile'].'&N='.urlencode($member_info['member_name']));

				$sms = new Sms();
				$sms->send($_POST["mobile"],"您好,您的密码是：".$register_info['password']);

                if(intval($yw_info_get) > 0){
                    $result['msg'] = '您已经注册成功。';
                }else{
                    $result['error'] = '您已经注册成功，活动绑定失败，请联系工作人员帮忙处理！';
                }
				$model_member->createSession($member_info,true);
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}

        }else{
            //Tpl::output('no_header',true);
            ///Tpl::output('no_footer',true);
            Tpl::output('html_title',"");
            Tpl::output('seo_keywords',"");
            Tpl::output('seo_description',"");
            Tpl::showpage('20160411/index_show');
        }
    }


    /**
     * 招商  xin 20160405
     * 查看登记记录
     */
    public function ad_20160405Op(){
        if($_GET['action'] == 'dengji'){
            if(!empty($_POST['name']) && !empty($_POST['tel'])){
               
            	$model_member   = Model('member');

	            $register_info = array();
	            $register_info['username'] = $_POST['name'];
	            $register_info['password'] = $_POST['pass'];
	            $register_info['password_confirm'] = $_POST['rpass'];
	            $register_info['mobile'] = $_POST['tel'];
	            $register_info['member_from'] = '商家入驻m';

	            $member_info = $model_member->register($register_info);

	            if(!empty($member_info['error'])){

	            	$result['msg'] = $member_info['error'];
                	echo json_encode($result);

	            }else{

	            	/*信息存入session*/
	                $model_member->createSession($member_info);

	                // cookie中的cart存入数据库
	                Model('cart')->mergecart($member_info,$_SESSION['store_id']);

	                // cookie中的浏览记录存入数据库
	                Model('goods_browse')->mergebrowse($_SESSION['member_id'],$_SESSION['store_id']);
	            	
	            	$result['success'] = true;
                	echo json_encode($result);
	            }
            }else{
                $result['msg'] = '姓名或手机号不能为空';
                echo json_encode($result);
            }
            exit();

        }else{
            Tpl::output('no_header',true);
            Tpl::output('no_footer',true);
            Tpl::output('html_title',"收藏天下诚邀国内具有实力的收藏品、艺术品、文玩等商家入驻");
            Tpl::output('seo_keywords',"收藏天下,商家入驻");
            Tpl::output('seo_description',"收藏天下再次全新启航，我们诚邀国内具有实力的收藏品、艺术品、文玩等商家入驻收藏天下平台，让我们共同努力共同发展，树立中国文化艺术收藏平台标杆！");
            Tpl::showpage('20160405/index_show');
        }
    }

	/**
	 * 杜 免费领取
	 */
	public function ad_20160331Op(){
		if($_GET['action'] == 'yanzhengone'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$code = $_POST['code'];
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code){
				$result['error'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '免费送70周年纪念币('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$result['msg'] = '注册成功';
				$model_member->createSession($member_info,true);
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}else{
			$goodsid_array = array('10733'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%免费送70周年纪念币%');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error'] == '您不符合领取资格') Tpl::output('is_lin','1');
			Tpl::output('member_id',intval($_SESSION['member_id']));
			Tpl::output('FH_Index',"index");
			Tpl::output('html_title',"收藏天下注册有礼，免费送抗战胜利70周年纪念币。");
			Tpl::output('seo_keywords',"注册有礼,免费领取,抗战胜利纪念币,抗战70周年纪念币,抗战币,纪念币");
			Tpl::output('seo_description',"收藏天下注册有礼再次来袭，注册就免费送抗战胜利70周年纪念币，带册装帧更豪华，存世流传有心意。立刻注册，立刻免费领抗战胜利70周年纪念币，自己珍藏、送人礼物，均是极棒的选择。来收藏天下，免费好礼免费拿！");
			Tpl::showpage('20160331/index_show');
		}
	}


	/**
	 * 杜 免费领取
	 */
	public function ad_20160317Op(){
		if($_GET['action'] == 'linqu'){
			if($_POST['goods_id'] == '955'){
				$goodsid_array = array('15091'=>'186');
				$goods_amount = '186'; //商品总额
			}elseif($_POST['goods_id'] == '11735'){
				$goodsid_array = array('11735'=>'100');
				$goods_amount = '100'; //商品总额
			}else{
				$goodsid_array = array('15091'=>'186','11735'=>'100');
				$goods_amount = '286'; //商品总额
			}
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			if($where_member_from['member_id'] == 0) exit(json_encode(array('state'=>false,'msg'=>'-1')));
			$where_member_from['member_exppoints'] = array('egt',0);
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
			
			$shipping_fee = '20'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'等值兑换(m)20160317');
		}elseif($_GET['action'] == 'is_login'){
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			if($where_member_from['member_id'] == 0) {
				exit(json_encode(array('state'=>false,'msg'=>'-1')));
			}else{
				exit(json_encode(array('state'=>true,'msg'=>'OK')));
			}
		}else{
			Tpl::output('html_title',"收藏天下等值兑换惊喜来袭！");
			Tpl::output('seo_keywords',"纪念钞等值兑换,第五套人民币,中国航天纪念钞,航天钞等值兑换,人民币同号钞等值兑换");
			Tpl::output('seo_description',"收藏天下等面值兑换惊喜再度来袭！100元普通钞兑换中国航天纪念钞，186元普通钞兑换第五套人民币后五同小全套。");
			Tpl::showpage('20160317/index_show');
		}
		

	}
	
	public function web_soocangOp(){
		$model_member	= Model('member');
		$obj_validate = new Validate();
		$obj_validate->validateparam = array(
			array("input"=>$_GET['n'],		"require"=>"true", "message"=>'用户名不能为空'),
			array("input"=>$_GET['p'],		"require"=>"true", "message"=>'密码不能为空'),
		);
		$error = $obj_validate->validate();
		if ($error != ''){
			exit();
		}
		$array = array();
		$array['member_name']	= $_GET['n'];
		$array['member_passwd']	= md5($_GET['p']);
		
		$member_info = $model_member->getMemberInfo($array);
		if(is_array($member_info) and !empty($member_info)) {
			if(!$member_info['member_state']){
				exit();
			}
		}else{
			process::addprocess('login');
			exit();
		}
		$model_member->createSession($member_info);
        redirect('http://m.96567.com/index.php?act=zhuanti&op=ad_20160316#soocangaddress');
	}
	/**
	 * 杜 免费领取
	 */
	public function ad_20160316Op(){
		if($_GET['action'] == 'yanzhengone'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password'];
			$register_info['mobile'] = $_POST['mobile'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '航天钞兑换UC('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$result['msg'] = '注册成功';
				$model_member->createSession($member_info,true);
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}else{
			$goodsid_array = array('11735'=>'100');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%航天钞兑换UC%');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error'] == '您不符合领取资格') Tpl::output('is_lin','1');
			Tpl::output('member_id',intval($_SESSION['member_id']));
			Tpl::output('html_title',"");
			Tpl::output('seo_keywords',"");
			Tpl::output('seo_description',"");
			Tpl::output('FH_Index',"index");
			Tpl::showpage('20160316/index_show');
		}
	}

	public function ad_20160316DuiHuanOp(){
		$goodsid_array = array('11735'=>'100');
		$where_member_from['member_id'] = intval($_SESSION['member_id']);
		$where_member_from['member_from'] = array('like','%航天钞兑换UC%');
		$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
		if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
		$goods_amount = '100'; //商品总额
		$shipping_fee = '20'; //运费
		$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'航天钞兑换UC','等值兑换(M)');
	}


	/**
	 * 杜 免费领取
	 */
	public function ad_20160314Op(){
		if($_GET['action'] == 'yanzhengone'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$code = $_POST['code'];
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code){
				$result['error'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '免费送70周年纪念币('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$result['msg'] = '注册成功';
				$model_member->createSession($member_info,true);
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}else{
			$goodsid_array = array('10733'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%免费送70周年纪念币%');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error'] == '您不符合领取资格') Tpl::output('is_lin','1');
			Tpl::output('member_id',intval($_SESSION['member_id']));
			Tpl::output('html_title',"收藏天下注册有礼，免费送抗战胜利70周年纪念币。");
			Tpl::output('seo_keywords',"注册有礼,免费领取,抗战胜利纪念币,抗战70周年纪念币,抗战币,纪念币");
			Tpl::output('seo_description',"收藏天下注册有礼再次来袭，注册就免费送抗战胜利70周年纪念币，带册装帧更豪华，存世流传有心意。立刻注册，立刻免费领抗战胜利70周年纪念币，自己珍藏、送人礼物，均是极棒的选择。来收藏天下，免费好礼免费拿！");
			Tpl::showpage('20160314/index_show');
		}
	}

	/**
	 * 杜 等值兑换活动 20160303
	 */
	public function ad_20160303Op(){
		//showMessage('您访问的活动已结束','index.php?act=zhuanti&op=ad_20160115','html','error');
		//exit();
		if($_GET['action'] == 'zhu_ce'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password'];
			$register_info['mobile'] = $_POST['mobile'];
			$register_info['member_from'] = '万达航天钞兑换';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
                $yw_info_get = file_get_contents(CRM_SITE_URL.'/index.php?m=api&p=action&c=cpregister&ID='.$member_info['member_id'].'&M='.$register_info['mobile'].'&N='.urlencode($member_info['member_name']));
                if(intval($yw_info_get) > 0){
                    $result['msg'] = '您已经注册成功，请联系艾美酒店-精品店内工作人员进行兑换！';
                }else{
                    $result['error'] = '您已经注册成功，活动绑定失败，请联系工作人员帮忙处理！';
                }

				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}else{
            Tpl::output('nav_title',"收藏天下");
			Tpl::output('html_title',"中国航天纪念钞等面值兑换-收藏天下");
			Tpl::showpage('20160303/index_show');
		}
	}

	/**
	 * 杜 迎新春
	 */
	public function ad_20160110Op(){
		if($_GET['action'] == 'chou_jiang'){
			//活动结束时间 01月31号
			if(time() >= 1454256000){
				$result['error'] = -4;
				echo json_encode($result);
				exit;
			}
			$member_id = intval($_SESSION['member_id']);
			//检查是否登录
			if($member_id <= 0){
				$result['error'] = -1;
				echo json_encode($result);
				exit;
			}
			//获得所有会员中奖记录
			$SuoYouLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160110','member_id'=>$member_id),'l_orderid');
			$order_idarray = array();
			if($SuoYouLotteryList){
				foreach($SuoYouLotteryList as $ok=>$ov){
					$order_idarray[] = $ov['l_orderid'];
				}
			}
			$order = $this->ZtModel->getOrder(array('buyer_id'=>$member_id,'order_state'=>array('egt',20),'add_time'=>array('elt','1454256000'),'add_time'=>array('egt','1453046400'),'order_amount'=>array('egt',2000),'order_id'=>array('not in',$order_idarray)),'order_id,order_amount');
			//抽奖次数用完
			if(count($order) <= 0){
				$result['error'] = -3;
				echo json_encode($result);
				exit;
			}
			$order_info = $order[0];

			$prize_arr = array(
				'0' => array('angle'=>335,'prize'=>'第三条人民币小全套后三同可用 500元代金卷','v'=>106,'type'=>'1',num=>'0'),
				'1' => array('angle'=>247,'prize'=>'中国金币2016猴年贺岁银条50克可用 50元代金卷','v'=>105,'type'=>'1',num=>'0'),
				'2' => array('angle'=>292,'prize'=>'中国航天纪念钞十连号可用 100元代金卷','v'=>107,'type'=>'1',num=>'0'),
				'3' => array('angle'=>157,'prize'=>'世界财富宝典珍藏册可用 500元代金卷','v'=>104,'type'=>'1',num=>'5'), 
				'4' => array('angle'=>114,'prize'=>'中国航天纪念币一钞一币','v'=>12352,'type'=>'2',num=>'10'),
				'5' => array('angle'=>203,'prize'=>'2016年贺岁银质纪念币','v'=>12384,'type'=>'2',num=>'5'),
				'6' => array('angle'=>65,'prize'=>'第三轮生肖邮票四方联大全套 无荧光防伪','v'=>3472,'type'=>'2',num=>'5'),
				'7' => array('angle'=>24,'prize'=>'传世十二生肖册之乙末羊年金条','v'=>8865,'type'=>'2',num=>'1')
			);
			
			$rid = 0;
			if(intval($order_info['order_amount']) >=2000 && intval($order_info['order_amount']) <= 4000){
				$rid = rand(0,3);
			}elseif(intval($order_info['order_amount']) >=4001 && intval($order_info['order_amount']) <= 8000){
				$rid = rand(0,4);
			}elseif(intval($order_info['order_amount']) >=8001 && intval($order_info['order_amount']) <= 15000){
				$rid = rand(0,5);
			}elseif(intval($order_info['order_amount']) >=15001 && intval($order_info['order_amount']) <= 80000){
				$rid = rand(0,6);
			}elseif(intval($order_info['order_amount']) >80000){
				$rid = rand(4,7);
			}else{
				$result['error'] = -3;
				echo json_encode($result);
				exit;
			}
			$DangTianShiWu = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160110','l_id'=>array('in'=>$rid)));
			$res = $prize_arr[$rid]; //中奖项 
			//判断实物奖品是否发放完成
			if($res['type'] == 2){
				//如果实物奖品发放完则赠送优惠劵
				if(intval($res['num']-$DangTianShiWu) <= 0){
					$rid = rand(0,3);
				}
			}
			$res = $prize_arr[$rid]; //重新获取中奖项
			if($res['type'] == 1){//判断优惠劵是否发放完
				if($res['num'] > 0){
					if(intval($res['num']-$DangTianShiWu) <= 0){
						$rid = rand(0,2);
					}
				}
			}
			$res = $prize_arr[$rid]; //重新获取中奖项
			$is_fafang = 0;
			if($res['type'] == 2){
				//获得实物奖品
			}elseif($res['type'] == 1){
				//获得代金卷 发放代金卷
				$this->ZtModel->exchangeVoucher($res['v'],intval($_SESSION['member_id']));
				$is_fafang = 1;
			}
			$data['member_id'] = $member_id;
			$data['year'] = date('Y',time());
			$data['month'] = date('m',time());
			$data['day'] = date('d',time());
			$data['hour'] = date('H',time());
			$data['time'] = date('H:i:s',time());
			$data['add_time'] = time();
			$data['ip'] = $_SERVER['REMOTE_ADDR'];
			$data['ad_name'] = '20160110';
			$data['l_name'] = $res['prize'];
			$data['l_id'] = $rid;
			$data['l_orderid'] = $order_info['order_id'];
			$data['is_fafang'] = $is_fafang;
			$this->ZtModel->addLottery($data);
			echo json_encode($res); 
			exit();
		}elseif($_GET['action'] == 'post_ajax'){
				$dataArr['name'] = $_POST['name']; //姓名
				$dataArr['mobile'] = $_POST['mobile'];//电话
				$dataArr['l_id'] = intval($_POST['l_id']);//奖品编号
				$dataArr['member_id'] = intval($_SESSION['member_id']);//领奖会员id
				$dataArr['member_name'] = $_SESSION['member_name'];//领奖会员名称
				$dataArr['ad_name'] = '20160110';//领奖会员名称
				if($dataArr['l_id'] <= 0){
					echo '-3';
					exit;
				}
				//检测会员是否登录
				if($dataArr['member_id'] <= 0){
					echo '-1';
					exit;
				}
				//检查该信息是否领取过
				$LQCount = $this->ZtModel->LinQuCount(array('l_id'=>$dataArr['l_id']));
				if($LQCount > 0){
					echo '-2';
					exit;
				}
				$this->ZtModel->insertLinQu($dataArr);
				//修改领奖状态
				$this->ZtModel->upLotteryReceive(array('is_fafang'=>'1'),array('id'=>$dataArr['l_id']));
				echo '1';
				exit;
		}else{
			Tpl::output('html_title',"收藏天下感恩大回馈，好礼0元送，金条免费抽-收藏天下");
			//获得当前会员中奖记录
			$MyLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160110','member_id'=>$_SESSION['member_id']));
			Tpl::output('MyLotteryList',$MyLotteryList);
			//获得所有会员中奖记录
			$SuoYouLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160110'));
			Tpl::output('SuoYouLotteryList',$SuoYouLotteryList);
			Tpl::output('nav_title',"好礼0元送，金条免费抽");
			Tpl::showpage('20160110/index_show');
		}
	}

    public function ad_20160115Op(){
        if($_GET['action'] == 'zhu_ce'){
            $model_member	= Model('member');
            $register_info = array();
            $register_info['username'] = $_POST['user_name'];
            $register_info['password'] = $_POST['password'];
            $register_info['password_confirm'] = $_POST['password'];
            $register_info['mobile'] = $_POST['mobile'];
            $register_info['member_from'] = '2016猴币兑换(m)';
            $member_info = $model_member->register($register_info);
            if(!isset($member_info['error'])) {
                $result['msg'] = '您已经兑换成功，活动结束后将统一发货，请耐心等待。如有疑问请咨询在线客服或拔打400-81-96567';
                echo json_encode($result);
                exit();
            }else{
                $result['error'] = $member_info['error'];
                echo json_encode($result);
                exit();
            }
        }else{
            Tpl::output('nav_title',"2016生肖猴币兑换");
            Tpl::output('html_title',"2016年猴年生肖纪念币等值兑换 - 收藏天下");
            Tpl::showpage('20160115/index_show');
        }
    }



    /*Add is name lt 2016-02-24 微信注册发红包专题*/
    public function getHongbaoOp(){


    	file_put_contents('weixin_log.txt',date("Y-m-d H:i:s",time())."====",FILE_APPEND);


    	Tpl::output('nav_title',"注册领红包");
        Tpl::output('html_title',"注册领红包 - 收藏天下");


        if($_SESSION['openid']){
        	$user_info = Model()->table('member_hong_kl')->where(array('K_OpenId'=>$_SESSION['openid']))->find();
        	Tpl::output('user_info',$user_info);

			$hong_info = Model()->table('member_hong_set')->where(array('S_OpenId'=>$_SESSION['openid']))->find();
        	Tpl::output('hong_info',$hong_info);
        }

        Tpl::output('no_header',true);
    	Tpl::output('no_footer',true);
        Tpl::showpage('weixin/index_show');
    }


    /*Add is name lt 2016-02-24 注册*/
    public function doRegisterOp(){
    	exit;
    	$model_member	= Model('member');
        $register_info = array();
        $register_info['username'] = $_POST['user_name'];
        $register_info['password'] = $_POST['password'];
        $register_info['password_confirm'] = $_POST['upassword'];
        $register_info['mobile'] = $_POST['mobile'];
        $register_info['openid'] = $_SESSION['openid'];
        $register_info['member_from'] = '微信注册发红包';

        if(empty($_SESSION['openid'])){
        	$result['error'] = '请在微信上打开该专题领取红包！';
            echo json_encode($result);
            exit();
        }

        if($_POST['Yzm'] != $_SESSION['wx_phone_yzm'][$_POST['mobile']]){
        	$result['error'] = '验证码不正确、请重新获取！';
            echo json_encode($result);
            exit();
        }

        if($_POST['mobile'] != $_SESSION['wx_phone']){
        	$result['error'] = '验证码获取手机号和注册手机号不匹配~!';
            echo json_encode($result);
            exit();
        }


        $member_info = $model_member->register($register_info);

        if(!isset($member_info['error'])) {

        	$dataArr['K_MemberId'] = $member_info['member_id'];
        	$dataArr['K_MemberName'] = $member_info['member_name'];
        	$dataArr['K_OpenId'] = $member_info['openid'];
        	$dataArr['K_KouLing'] = $this->create_noncestr(8);
        	$dataArr['K_Time'] = time();
        	if(Model()->table('member_hong_kl')->insert($dataArr)){
        		$result['msg'] = '注册成功';
        		$result['K_MemberName'] = $dataArr['K_MemberName'];
        		$result['K_KouLing'] = $dataArr['K_KouLing'];
	            echo json_encode($result);
	            exit();
        	}
            exit();
        }else{
            $result['error'] = $member_info['error'];
            echo json_encode($result);
            exit();
        }
    }


    /*Add is name lt 2016-02-25 领取红包*/
    public function shouHongbaoOp(){
					//$result['error'] = '活动结束';
		            //echo json_encode($result);
		            //exit();


    	// $dataArr['K_MemberId'] = $_SESSION['member_id'];
    	$dataArr['K_OpenId'] = $_SESSION['openid'];
    	$dataArr['K_KouLing'] = trim($_POST['kl']);

    	// 注册验证
		$obj_validate = new Validate();
		$obj_validate->validateparam = array(
		// array("input"=>$dataArr["K_MemberId"],"require"=>"true","message"=>'请确认是否在微信打开该界面！'),
		array("input"=>$dataArr["K_OpenId"],"require"=>"true","message"=>'请确认是否在微信打开该界面！'),
		array("input"=>$dataArr["K_KouLing"],"require"=>"true","message"=>'红包口令不能为空'),

		);

		$error = $obj_validate->validate();
		if ($error != ''){
			$result['error'] = $error;
            echo json_encode($result);
            exit();
		}

		//为没有OpenId的红包口令添加OpenId

		$user_oepnid = Model()->table('member_hong_kl')->where(array('K_KouLing'=>$dataArr['K_KouLing']))->find();

		if(!empty($user_oepnid) && !empty($user_oepnid['K_Id']) && empty($user_oepnid['K_OpenId'])){
			Model()->table('member_hong_kl')->where(array('K_Id'=>$user_oepnid['K_Id']))->update(array('K_OpenId'=>$dataArr['K_OpenId']));
		}

		$user_info = Model()->table('member_hong_kl')->where($dataArr)->find();


		if(!empty($user_info)){
			//检测是否关注公众号
			$weixin = new weixinSDK();

	    	$token = $weixin->token;

	    	$openid = $dataArr['K_OpenId'];

			$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$openid&lang=zh_CN";

	        $weixin_result = json_decode(file_get_contents($url),true);


	        if(!empty($weixin_result['errcode'])){
                file_put_contents($weixin->path.'tuqtxs1392719300token.txt','');
                file_put_contents($weixin->path.'tuqtxs1392719300token_time.txt','');

                $result['error'] = '数据异常、请重新领取！';
	            echo json_encode($result);
	            exit();
            }


	        if($weixin_result['subscribe'] != '1'){
	        	$result['error'] = '请扫描页面下方二维码后领取红包！';
	            echo json_encode($result);
	            exit();
	        }


			//检测是否发送过红包
			$hong['S_OpenId'] = $dataArr['K_OpenId'];
			$hongbao_info = Model()->table('member_hong_set')->where($hong)->find();

			if(!empty($hongbao_info)){
				$result['error'] = '已领取过红包！';
	            echo json_encode($result);
	            exit();
			}else{
			//发送红包
				$money = mt_rand('101','110');
				$set_hongbao['S_MemberId'] = $user_info['K_MemberId'];
				$set_hongbao['S_OpenId'] = $dataArr['K_OpenId'];
				$set_hongbao['S_KouLing'] = $dataArr['K_KouLing'];
				$set_hongbao['S_Money'] = $money/100;
				$set_hongbao['S_Time'] = time();
				$resultObj = $this->hongBao($dataArr['K_OpenId'],$money);

// file_put_contents('resultObj.txt',print_r($resultObj,true),FILE_APPEND);

				if($resultObj->return_msg == '发放成功'){
				Model()->table('member_hong_set')->insert($set_hongbao);
					$result['msg'] = '领取成功';
		            echo json_encode($result);
		            exit();
				}elseif($resultObj->return_msg == '帐号余额不足，请到商户平台充值后再重试'){
					$result['error'] = '今日红包发放结束,请明日10:00领取！';
		            echo json_encode($result);
		            exit();
				}else{
					$result['error'] = '发送失败、重新领取！';
		            echo json_encode($result);
		            exit();
				}
			}
		}else{
			$result['error'] = '该口令没有对应红包信息！';
            echo json_encode($result);
            exit();
		}

    }


    /*Add is name lt 2016-02-26 获取手机验证码*/
    public function getPhoneYzmOp(){
		
		if(empty($_POST["name"])){
			$result['error'] = '用户名格式不正确！';
    		exit;
    	}
    	if(empty($_POST["mobile"])){
    		$result['error'] = '该手机号格式不正确！';
            echo json_encode($result);
            exit();
    	}
		$member_name = Model()->table('member')->where(array('member_name'=>$_POST["name"]))->find();
		if(!empty($member_name)){
    		$result['error'] = '用户名已存在请修改！';
            echo json_encode($result);
            exit();
    	}

    	$name['member_mobile'] = JiaMiMobile($_POST['mobile']);

    	if(strlen($_POST['mobile']) != 11){
            $result['error'] = '该手机号格式不正确！';
            echo json_encode($result);
            exit();
    	}

    	$user_info = Model()->table('member')->field('member_mobile')->where($name)->find();

    	if(!empty($user_info)){
    		$result['error'] = '该手机号已注册！';
            echo json_encode($result);
            exit();
    	}

    	$sms = new Sms();

    	$_SESSION['wx_phone_yzm'][$_POST["mobile"]] = mt_rand('1111','9999');

    	$_SESSION['wx_phone'] = $_POST["mobile"];

        $result = $sms->send($_POST["mobile"],"您好,您的验证码是：".$_SESSION['wx_phone_yzm'][$_POST["mobile"]]);

        echo json_encode($result);

        exit();

    }





	/*给用户发送红包*/
	private function hongBao($openid,$money){
		//定义一个红包数组
		$parameters = array();
		//随机字符串
		$parameters['nonce_str'] = $this->create_noncestr();//随机生成32位
		//订单号
		$parameters['mch_billno'] = '1226270402'.time().mt_rand(10000000,99999999);//发放订单号
		//商户号
		$parameters['mch_id'] = '1226270402';
		//公众账号appid
		$parameters['wxappid'] = 'wx00d52d21505f383f';
		//提供方名称
		$parameters['nick_name'] = "收藏天下";
		//商户名称
		$parameters['send_name'] = "收藏天下";
		//用户openid
		$parameters['re_openid'] = $openid;
		//付款金额
		$parameters['total_amount'] = $money;//单位分
		//最小红包金额
		$parameters['min_value'] = $money;//单位分
		//最大红包金额
		$parameters['max_value'] = $money;//单位分
		//红包发放总人数
		$parameters['total_num'] = '1';
		//红包祝福语
		$parameters['wishing'] = "欢迎参加注册送红包活动！";
		//Ip地址
		$parameters['client_ip'] = $_SERVER['SERVER_ADDR'];
		//活动名称
		$parameters['act_name'] = '注册送红包！';
		//备注
		$parameters['remark'] = "告诉你的朋友一起来抢红包吧！";

		$unSignParaString=$this->formQueryParaMap($parameters,false);

        $parameters['sign']=$this->sign($unSignParaString,'shengwei520soucang96567key1987sw');

        ksort($parameters);
        $postXml=$this->arrayToXml($parameters);
        $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';

        $responseXml=$this->curl_post_ssl($url,$postXml);

        $responseObj = simplexml_load_string($responseXml, 'SimpleXMLElement', LIBXML_NOCDATA);

        return $responseObj;
	}

	//生成随机字符串,不长于32位
    public function create_noncestr($length=32)
    {
       	$chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
		$str ="";
		for ( $i = 0; $i < $length; $i++ )  {  
			$str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
		}  
		return $str; 
    }

	//将参数按字典序排序，使用URL键值对的格式拼接成字符串
    public function formQueryParaMap($paraMap,$urlencode)
    {
        $buff="";
        ksort($paraMap);
        foreach($paraMap as $k=>$v){
            if($v!=null && $v!="null" && $k!="sign"){
                if($urlencode){
                    $v=urlencode($v);
                }
                $buff.=$k."=".$v."&";
            }
        }
        $reqPar = '';
        if(strlen($buff)>0){
            $reqPar=substr($buff,0,strlen($buff)-1);
        }
        return $reqPar;
    }

    //生成签名
    public function sign($content,$key)
    {
        $signStr=$content."&key=".$key;
        return strtoupper(md5($signStr));
    }
    //验证签名的方法
    public function verifySignature($content,$sign,$md5Key)
    {
        $signStr=$content."&key".$md5Key;
        $calculateSign = strtolower(md5($signStr));
		$tenpaySign = strtolower($sign);
        return $calculateSign == $tenpaySign;    
    }
    public function curl_post_ssl($url, $vars, $second=30,$aHeader=array())
	{
		$ch = curl_init();
		//超时时间
		curl_setopt($ch,CURLOPT_TIMEOUT,$second);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		//这里设置代理，如果有的话
		//curl_setopt($ch,CURLOPT_PROXY, '10.206.30.98');
		//curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
		
		//以下两种方式需选择一种
		//第一种方法，cert 与 key 分别属于两个.pem文件
		curl_setopt($ch,CURLOPT_SSLCERT,getcwd() . '/paykey/apiclient_cert.pem');
 		curl_setopt($ch,CURLOPT_SSLKEY,getcwd() . '/paykey/apiclient_key.pem');
 		curl_setopt($ch,CURLOPT_CAINFO,getcwd() . '/paykey/rootca.pem');
		
		//第二种方式，两个文件合成一个.pem文件
		//curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/all.pem');
	 
		if( count($aHeader) >= 1 ){
			curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
		}
	 
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
		$data = curl_exec($ch);
		if($data){
			curl_close($ch);
			return $data;
		}
		else { 
			$error = curl_errno($ch);
			//echo "call faild, errorCode:$error\n"; 
			curl_close($ch);
			return false;
		}
	}

	//数组转xml
    public function arrayToXml($arr)
    {
        $xml="<xml>";
        foreach($arr as $key=>$val){
            if(is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";
        return $xml;
    }

    //去除空白字符串
    public function trimString($value)
    {
        $ret=null;
        if($value!=null){
            $ret=$value;
            if(strlen($ret)==0){
                $ret=null;
            }
        }
        return $ret;
    }




    public function testNameOp(){
    	$name['member_name'] = $_POST['user_name'];

    	if(strlen($_POST['user_name']) < 6){
            exit();
    	}

    	$user_info = Model()->table('member')->field('member_name')->where($name)->find();

    	if(!empty($user_info)){
    		$result['error'] = '该帐号已注册！';
            echo json_encode($result);
            exit();
    	}
    }

    public function testPhoneOp(){
    	$name['member_mobile'] = JiaMiMobile($_POST['mobile']);

    	if(strlen($_POST['mobile']) != 11){
            exit();
    	}

    	$user_info = Model()->table('member')->field('member_mobile')->where($name)->find();

    	if(!empty($user_info)){
    		$result['error'] = '该手机号已注册！';
            echo json_encode($result);
            exit();
    	}
    }



	public function LingQuOp(){
		$goodsid_array = array('10733'=>'0');
		$where_member_from['member_id'] = intval($_SESSION['member_id']);
		$where_member_from['member_from'] = array('like','%免费送70周年纪念币%');
		$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
		if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
		$goods_amount = '0'; //商品总额
		$shipping_fee = '7'; //运费
		$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"免费送70周年纪念币",'免费领取(M)');
	}

	public function addAddressOrder($POST,$goodsid_array,$goods_amount=0,$shipping_fee=0,$referer='',$lai_yuan='',$other=false,$lid,$payment_code='online'){
		$model_addr = Model('address');
		//验证表单信息
		$obj_validate = new Validate();
		$obj_validate->validateparam = array(
			array("input"=>$POST["true_name"],"require"=>"true","message"=>"请填写收货人姓名"),
			array("input"=>$POST["area_id"],"require"=>"true","validator"=>"Number","message"=>"请选择所在地区"),
			array("input"=>$POST["address"],"require"=>"true","message"=>"请填写收货人详细地址"),
			array("input"=>$POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
		);
		$error = $obj_validate->validate();
		if ($error != ''){
			$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
			exit(json_encode(array('state'=>false,'msg'=>$error)));
		}
		$data = array();
		$data['member_id'] = $_SESSION['member_id'];
		$data['true_name'] = $POST['true_name'];
		$data['area_id'] = intval($POST['area_id']);
		$data['city_id'] = intval($POST['city_id']);
		$data['area_info'] = $POST['area_info'];
		$data['address'] = $POST['address'];
		$data['tel_phone'] = $POST['mob_phone'];
		$data['mob_phone'] = $POST['mob_phone'];
		$data = strtoupper(CHARSET) == 'GBK' ? Language::getGBK($data) : $data;
		$insert_id = $model_addr->addAddress($data);
		if ($insert_id){
			$data['prov'] = intval($POST['prov']);
			//收货地址添加成功执行添加订单
			
			$order = $this->ZtModel->add_order($data,$goodsid_array,$goods_amount,$shipping_fee,$referer,$lai_yuan,$other,$lid,$payment_code,2);
			if($order['error']){
				exit(json_encode(array('state'=>false,'msg'=>$order['error'])));
			}else{
				exit(json_encode(array('state'=>true,'addr_id'=>$insert_id,'pay_sn'=>$order['pay_sn'])));
			}
		}else {
			exit(json_encode(array('state'=>false,'msg'=>"请填写真实的收获地址")));
		}
	}
	//用户登陆
	public function loginOp(){
		$obj_validate = new Validate();
		$obj_validate->validateparam = array(
			array("input"=>$_POST['user_name'],		"require"=>"true", "message"=>'用户名不能为空'),
			array("input"=>$_POST['password'],		"require"=>"true", "message"=>'密码不能为空'),
		);
		$error = $obj_validate->validate();
		if ($error != ''){
			$result['error'] = $error;
			echo json_encode($result);
			exit();
		}
		//登陆类型
		if(preg_match("/1[34578]{1}\d{9}$/",$_POST['user_name'])){
			$logintype='mobile';
		}else{
			$logintype='username';
		}
		$salt_where	= array();
		if($logintype == 'mobile'){
			$salt_where['member_mobile'] = $_POST['user_name'];
		}else{
			$salt_where['member_name'] = $_POST['user_name'];
		}
		$model_member	= Model('member');
		$is_salt = $model_member->getMemberInfo($salt_where,'ec_salt');
		$array	= array();
		if($logintype == 'mobile'){
			$array['member_mobile']	= $_POST['user_name'];
		}else{
			$array['member_name']	= $_POST['user_name'];
		}
		if($is_salt['ec_salt'] != 0 || !empty($is_salt['ec_salt'])){
			$array['member_passwd']	= md5(md5($_POST['password']).$is_salt['ec_salt']);
		}else{
			$array['member_passwd']	= md5($_POST['password']);
		}
		$member_info = $model_member->getMemberInfo($array);
		//会员存在，如果有openid存入，删除其他会员openid
		if($_SESSION['openid'] != '' && $member_info['openid'] != $_SESSION['openid']){
			$model_member->editMember(array('openid'=>$_SESSION['openid']),array('openid'=>''));
			$model_member->editMember(array('member_id'=>$member_info['member_id']),array('openid'=>$_SESSION['openid']));
		}
		if(is_array($member_info) and !empty($member_info)) {
			if(!$member_info['member_state']){
				$result['error'] = '账号被停用';
				echo json_encode($result);
				exit();
			}
		}else{
			process::addprocess('login');
			$result['error'] = '用户名或密码错误';
			echo json_encode($result);
			exit();
		}
		$model_member->createSession($member_info);
		// cookie中的cart存入数据库
		Model('cart')->mergecart($member_info,$_SESSION['store_id']);

		// cookie中的浏览记录存入数据库
		Model('goods_browse')->mergebrowse($_SESSION['member_id'],$_SESSION['store_id']);

		$result['state'] = 'OK';
		echo json_encode($result);
		exit();
    }

	private function getRand($proArr) { 
		$result = ''; 
		//概率数组的总概率精度 
		$proSum = array_sum($proArr);
		//概率数组循环 
		foreach ($proArr as $key => $proCur) { 
			$randNum = mt_rand(1, $proSum); 
			if ($randNum <= $proCur) { 
				$result = $key; 
				break; 
			} else { 
				$proSum -= $proCur; 
			} 
		} 
		unset ($proArr); 
		return $result; 
	}

	/**
     * 地区列表
     */
    public function area_listOp() {
        $area_id = intval($_POST['area_id']);

        $model_area = Model('area');

        $condition = array();
        if($area_id > 0) {
            $condition['area_parent_id'] = $area_id;
        } else {
            $condition['area_deep'] = 1;
        }
        $area_list = $model_area->getAreaList($condition, 'area_id,area_name');
        output_data(array('area_list' => $area_list));
    }

	//导出exl
public function DaoChu_Export($filename){
		header("Content-type: application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment; filename=$filename.xls");
		echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"
		xmlns:x="urn:schemas-microsoft-com:office:excel"
		xmlns="http://www.w3.org/TR/REC-html40">
		<head>
		<meta http-equiv="expires" content="Mon, 06 Jan 1999 00:00:01 GMT">
		<meta http-equiv=Content-Type content="text/html; charset=utf-8">
		<!--[if gte mso 9]><xml>
		<x:ExcelWorkbook>
		<x:ExcelWorksheets>
		<x:ExcelWorksheet>
		<x:Name></x:Name>
		<x:WorksheetOptions>
		<x:DisplayGridlines/>
		</x:WorksheetOptions>
		</x:ExcelWorksheet>
		</x:ExcelWorksheets>
		</x:ExcelWorkbook>
		</xml><![endif]-->

		</head>';
}
}
