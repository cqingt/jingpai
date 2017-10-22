<?php
/**
 * 拍卖惠手机版
 *
 **
 */


defined('InShopNC') or exit('Access Invalid!');
class indexControl extends mobileHomeControl{

    public function __construct() {
        parent::__construct ();
        Tpl::output('index_sign','lepai');

    }

	public function indexOp(){
        $h_model = Model('lepai_home');
		$kaishiArray = array('lepai_admin_goods.G_Atype'=>'3','lepai_admin_theme.T_Ktime'=>array('lt',TIMESTAMP),'lepai_admin_goods.G_EndTime'=>array('gt',TIMESTAMP));

		$weikaishiArray = array('lepai_admin_goods.G_Atype'=>'3','lepai_admin_theme.T_Ktime'=>array('gt',TIMESTAMP),'lepai_admin_goods.G_EndTime'=>array('gt',TIMESTAMP));

		$ThemeInfoArray = array('T_Jtime'=>array('gt',TIMESTAMP),'T_Iswin'=>'1');
		if($_GET['type'] == 'ShuHua'){
			//书画馆的只查询收藏天下书画馆下的拍品
			$kaishiArray['G_Class'] = '3';
			$weikaishiArray['G_Class'] = '3';
			$ThemeInfoArray['T_Uid'] = array('in',array('431999','467791','476532','481251'));
			Tpl::output('IsShuHua',true);
		}
        $theme = $h_model->getThemeInfo($ThemeInfoArray);
        foreach($theme as $k=>$v){
            $theme[$k]['T_Click'] = $h_model->getGoodsSum(array('G_Tid'=>$v['T_Id']),'G_Click');
            $theme[$k]['chujia_count'] = $h_model->getGoodsSum(array('G_Tid'=>$v['T_Id']),'pai_count');
        }

		

        $kaishi_arr = $h_model->getGoodsInfoKai($kaishiArray,'lepai_admin_theme.T_Id =lepai_admin_goods.G_Tid','lepai_admin_goods.pai_count desc,lepai_admin_goods.G_Click desc','lepai_admin_goods.*,lepai_admin_theme.T_Ktime',32);
       
	   //未开始
        $weikaishi_arr = $h_model->getGoodsInfoKai($weikaishiArray,'lepai_admin_theme.T_Id =lepai_admin_goods.G_Tid','lepai_admin_goods.pai_count desc,lepai_admin_goods.G_Click desc','lepai_admin_goods.*,lepai_admin_theme.T_Ktime',32);
       
		
        Tpl::output('theme',$theme);
        Tpl::output('weikaishi_arr',$weikaishi_arr);
        Tpl::output('kaishi_arr',$kaishi_arr);

        //分类导航
        $nav_link = array(
            0=>array(
                'title'=>Language::get('homepage'),
                'link'=>MOBILE_SITE_URL,
            ),
            1=>array(
                'title'=>'尾品竞拍'
            )
        );
        /*SEO*/
        Tpl::output('nav_title','尾品竞拍');
        Tpl::output('html_title','尾品竞拍'.' - '.C('site_name'));
        Tpl::output('seo_keywords','尾品竞拍');
        Tpl::output('seo_description','尾品竞拍服务，收藏品0元起拍，正品底价，让您低价体会到收藏品网上拍卖的乐趣，非常值得参与体验的收藏品拍卖活动。');
        Tpl::output('nav_link_list',$nav_link);
		Tpl::showpage('lepai');
	}


    public function themeOp(){
        $h_model = Model('lepai_home');
        $theme_id = intval($_GET['tid']);
        $theme = $h_model->getThemeInfoOne(array('T_Id'=>$theme_id));

        if(!is_array($theme)){
            showMessage('专场不存在！','','html','error');
        }

        $h_model->updateTheme(array('T_Click'=>array('exp','T_Click+1')),array('T_Id'=>$theme_id));//点击加1
		$theme['T_Click'] = $h_model->getGoodsSum(array('G_Tid'=>$theme['T_Id']),'G_Click');
		$theme['chujia_count'] = $h_model->getGoodsSum(array('G_Tid'=>$theme['T_Id']),'pai_count');
		$theme['goods_count'] = $h_model->getGoodsCount(array('G_Tid'=>$theme['T_Id']));

        Tpl::output('theme',$theme);

        $auction_info = $h_model->getGoodsInfo(array('G_Tid'=>$theme_id,'G_Atype'=>array('egt','3')),'*','pai_count desc,G_Click desc','100');
        Tpl::output('auction_info',$auction_info);

        //判定专场是否结束，结束自动判断拍品是否成交，没成交自动完成
        if($theme['T_Ktime'] < TIMESTAMP && $theme['T_Jtime'] < TIMESTAMP){
            if(count($auction_info) > 0){
                foreach ($auction_info as $k => $goods) {
                    if($goods['G_Atype'] == 3 && $goods['G_EndTime'] < TIMESTAMP){
                        $chujia_user = array();
                        $chujia_user = $h_model->getLepaiLogOne(array('auction_id'=>$goods['G_Id']));//最后出价用户
                        if($chujia_user['price'] > 0){
                            $member_info = Model('member')->getMemberInfoByID($chujia_user['member_id']);//获取买家信息
                            if($goods['G_BaoliuMoney'] > 0 && $chujia_user['price'] < $goods['G_BaoliuMoney']){
                                //变更状态为流拍
                                $g_atype = 7;
                            }else{
                                //变更状态为竞拍成功
                                $g_atype = 6;

                                //生成订单
                                $sellerInfo = $h_model->getStoreInfo(array('member_id'=>$goods['G_Uid']));//获取本产品关联卖家信息
                                $addOrder = array();
                                $addOrder['order_sn'] = $this->makeLepaiSn($goods['G_Id']);
                                $addOrder['store_member_id'] = $sellerInfo['member_id'];
                                $addOrder['store_member_name'] = $sellerInfo['member_name'];
                                $addOrder['lepai_theme_id'] = $goods['G_Tid'];
                                $addOrder['lepai_goods_id'] = $goods['G_Id'];
                                $addOrder['buyer_id'] = $member_info['member_id'];
                                $addOrder['buyer_name'] = $member_info['member_name'];
                                $addOrder['add_time'] = TIMESTAMP;
                                $addOrder['goods_amount'] = $chujia_user['price'];
                                $addOrder['order_amount'] = $chujia_user['price'];
                                //获取用户保证金
                                $baoming = $h_model->getLepaiBaoming(array('auction_id'=>$goods['G_Id'],'member_id'=>$member_info['member_id'],'is_return'=>'0'));
                                $pd_amount = ($baoming['type'] == 1)?$baoming['amount']:'0';
                                $addOrder['pd_amount'] = $pd_amount;//预存款支付金额，如果竞拍是用余额缴纳保证金，抵扣到这里
                                $addOrder['shipping_fee'] = 0;
                                $addOrder['order_state'] = 10;

                                $order_res = $h_model->addLepaiOrder($addOrder);
                                if(!$order_res){
                                    continue;
                                    //showMessage('拍卖惠订单创建失败！','','html','error');
                                }

                                //通知客户竞拍成功
                                $param = array();
                                $param['code'] = 'lepai_order';
                                $param['member_id'] = $member_info['member_id'];
                                $param['param'] = array(
                                    'goods_url' => urlLepai('index','auction',array('id'=>$goods['G_Id'])),
                                );
                                QueueClient::push('sendMemberMsg', $param);
                            }
                            //成功与流拍都退还保证金 竞拍成功用户暂不退还
                            $h_model->tuihuanBZJ($g_atype,$goods['G_Id'],$chujia_user['member_id']);
                        }else{
                            $g_atype = 7;
                        }
                        $h_model->updateAuctionGoods(array('G_Atype'=>$g_atype,'ChangeType'=>4),array('G_Id'=>$goods['G_Id']));//修改结束拍品竞拍状态
                        //发送微信模板消息，拍卖结束通知
                        $wx_param = array(
                            'func'=>'lepai_jieshu',
                            'auction_id'=>$goods['G_Id'],
                            'g_atype'=>$g_atype,//结束状态，7流拍6竞拍成功
                        );
                        if($g_atype == 6){
                            //竞拍成功用户名，价格
                            $wx_param['buyer_name'] = $member_info['member_name'];
                            $wx_param['price'] = $chujia_user['price'];
                        }
                        QueueClient::push('sendWXTemplateMsg', $wx_param);
                    }
                }
            }
        }

        //分类导航
        $nav_link = array(
            0=>array(
                'title'=>Language::get('homepage'),
                'link'=>SHOP_SITE_URL,
            ),
            1=>array(
                'title'=>'尾品竞拍',
                'link'=>LEPAI_SITE_URL,
            ),
            2=>array(
                'title'=>$theme['T_Title']
            )
        );
        /*SEO*/
        Tpl::output('nav_title','尾品竞拍专场');
        Tpl::output('html_title',$theme['T_Title'].' - 尾品竞拍 - '.C('site_name'));
        Tpl::output('seo_keywords','尾品竞拍');
        Tpl::output('seo_description','尾品竞拍服务，收藏品0元起拍，正品底价，让您低价体会到收藏品网上拍卖的乐趣，非常值得参与体验的收藏品拍卖活动。');
        Tpl::output('nav_link_list',$nav_link);
        Tpl::showpage('theme');
    }

    public function auctionOp(){
        $h_model = Model('lepai_home');

        $auction_id = intval($_GET['id']);
        $goods = $h_model->getGoodsInfoOne(array('G_Id'=>$auction_id));
		if($goods['G_Class'] == '3'){
			//收藏天下书画馆
			Tpl::output('IsShuHua',true);
		}
        if(!is_array($goods) || intval($goods['G_Atype']) < 3){
            showMessage('拍品不存在！','','html','error');
        }
        $nav_link[2] = array('title'=>$goods['G_Name']);
        $h_model->updateAuctionGoods(array('G_Click'=>array('exp','G_Click+1')),array('G_Id'=>$auction_id));//点击加1

        Tpl::output('goods',$goods);

        //判定拍品当前状态
        if($goods['T_Ktime'] > TIMESTAMP){
            $status = '1';//即将开始
            Tpl::output('now_price',$goods['G_Qipai']);//当前价
        }else{
            $chujia_user = $h_model->getLepaiLogOne(array('auction_id'=>$auction_id));//最后出价用户
            if($chujia_user['price'] > 0){
                $member_info = Model('member')->getMemberInfoByID($chujia_user['member_id']);//获取买家信息
            }
            if($goods['G_EndTime'] > TIMESTAMP){
                $status = '2';//正在进行

                if($goods['G_kaichang'] == 0){ //开场后用户第一次触发页面
                    //开场短信通知
                    $baoming = $h_model->getLepaiBaomingSelect(array('auction_id'=>$auction_id));
                    if(is_array($baoming) && !empty($baoming)){
                        foreach($baoming as $k=>$v){
                            $param = array();
                            $param['code'] = 'lepai_kaichang';
                            $param['member_id'] = $v['member_id'];
                            $param['param'] = array(
                                'goods_url' => urlLepai('index','auction',array('id'=>$v['auction_id'])),
                            );
                            QueueClient::push('sendMemberMsg', $param);
                        }
                    }
                    $h_model->updateAuctionGoods(array('G_kaichang'=>1),array('G_Id'=>$auction_id));//更新开场标识

                    $h_model->addLepaiChujia(array('auction_id'=>$auction_id,'member_id'=>'0','price'=>$goods['G_Qipai']),false,$goods['G_IncMoney'],$goods['T_Ktime']);//进入轮询


                }

                $chujia_user = $h_model->getLepaiLogOne(array('auction_id'=>$auction_id));//最后出价用户

                if(is_array($chujia_user) && !empty($chujia_user)){
                    $now_price = $chujia_user['price'];
                }else{
                    $now_price = $goods['G_Qipai'];
                }
                Tpl::output('now_price',$now_price);//当前价
            }else{
                $status = '3';//已结束
                if($goods['G_Atype'] == 3){ //竞拍结束，竞拍状态未变

                    if($chujia_user['price'] > 0){
                        if($goods['G_BaoliuMoney'] > 0 && $chujia_user['price'] < $goods['G_BaoliuMoney']){
                            //变更状态为流拍
                            $g_atype = 7;
                        }else{
                            //变更状态为竞拍成功
                            $g_atype = 6;

                            //生成订单
                            $sellerInfo = $h_model->getStoreInfo(array('member_id'=>$goods['G_Uid']));//获取本产品关联卖家信息
                            $addOrder = array();
                            $addOrder['order_sn'] = $this->makeLepaiSn($goods['G_Id']);
                            $addOrder['store_member_id'] = $sellerInfo['member_id'];
                            $addOrder['store_member_name'] = $sellerInfo['member_name'];
                            $addOrder['lepai_theme_id'] = $goods['G_Tid'];
                            $addOrder['lepai_goods_id'] = $goods['G_Id'];
                            $addOrder['buyer_id'] = $member_info['member_id'];
                            $addOrder['buyer_name'] = $member_info['member_name'];
                            $addOrder['add_time'] = TIMESTAMP;
                            $addOrder['goods_amount'] = $chujia_user['price'];
                            $addOrder['order_amount'] = $chujia_user['price'];
                            //获取用户保证金
                            $baoming = $h_model->getLepaiBaoming(array('auction_id'=>$goods['G_Id'],'member_id'=>$member_info['member_id'],'is_return'=>'0'));
                            $pd_amount = ($baoming['type'] == 1)?$baoming['amount']:'0';
                            $addOrder['pd_amount'] = $pd_amount;//预存款支付金额，如果竞拍是用余额缴纳保证金，抵扣到这里
                            $addOrder['shipping_fee'] = 0;
                            $addOrder['order_state'] = 10;

                            $order_res = $h_model->addLepaiOrder($addOrder);
                            if(!$order_res){
                                showMessage('拍卖惠订单创建失败！','','html','error');
                            }

                            //通知客户竞拍成功
                            $param = array();
                            $param['code'] = 'lepai_order';
                            $param['member_id'] = $member_info['member_id'];
                            $param['param'] = array(
                                'goods_url' => urlLepai('index','auction',array('id'=>$goods['G_Id'])),
                            );
                            QueueClient::push('sendMemberMsg', $param);
                        }
                        //成功与流拍都退还保证金 竞拍成功用户暂不退还
                        $h_model->tuihuanBZJ($g_atype,$goods['G_Id'],$chujia_user['member_id']);
                    }else{
                        $g_atype = 7;
                    }

                    $h_model->updateAuctionGoods(array('G_Atype'=>$g_atype,'ChangeType'=>5),array('G_Id'=>$goods['G_Id']));//修改结束拍品竞拍状态
                    $goods['G_Atype'] = $g_atype;

                    //发送微信模板消息，拍卖结束通知
                    $wx_param = array(
                        'func'=>'lepai_jieshu',
                        'auction_id'=>$goods['G_Id'],
                        'g_atype'=>$g_atype,//结束状态，7流拍6竞拍成功
                    );
                    if($g_atype == 6){
                        //竞拍成功用户名，价格
                        $wx_param['buyer_name'] = $member_info['member_name'];
                        $wx_param['price'] = $chujia_user['price'];
                    }
                    QueueClient::push('sendWXTemplateMsg', $wx_param);

                }
                if($goods['G_Atype'] == 7){
                    $pai_status = array('status'=>'2','price'=>(($chujia_user['price'] < $goods['G_Qipai'])?$goods['G_Qipai']:$chujia_user['price']));
                }elseif($goods['G_Atype'] == 6){
                    $pai_status = array('status'=>'1','price'=>$chujia_user['price'],'member_name'=>$member_info['member_name']);
                }else{
                    showMessage('拍品竞拍状态错误！','','html','error');
                }
                Tpl::output('pai_status',$pai_status);
            }
        }
        Tpl::output('status',$status);

        if($_SESSION['member_id'] > 0){
            $baoming_status = $h_model->getLepaiBaoming(array('auction_id'=>$auction_id,'member_id'=>$_SESSION['member_id']));
            if($baoming_status){
                Tpl::output('baoming_status',true);
            }
            $weituoRes = $h_model->getWeituoOne(array('member_id'=>$_SESSION['member_id'],'auction_id'=>$auction_id));

            if(!empty($weituoRes)){
                Tpl::output('weituoInfo',$weituoRes);
            }
        }

        //热门拍品
        $remen = $h_model->getGoodsInfoLimit(array('G_EndTime'=>array('gt',TIMESTAMP),'G_Atype'=>'3'));
        Tpl::output('remen',$remen);

        //分类导航
        $nav_link = array(
            0=>array(
                'title'=>Language::get('homepage'),
                'link'=>SHOP_SITE_URL,
            ),
            1=>array(
                'title'=>'拍卖惠',
                'link'=>LEPAI_SITE_URL,
            ),
            2=>array(
                'title'=>$goods['T_Title'],
                'link'=>urlLepai('index','theme',array('tid'=>$goods['T_Id'])),
            ),
            3=>array(
                'title'=>$goods['G_Name']
            )
        );
		$logres = $h_model->getLepaiLog(array('auction_id'=>$auction_id),10);

        Tpl::output('nav_title','拍卖惠拍品');
        Tpl::output('html_title',$goods['T_Title'].' - 拍卖惠 - '.C('site_name'));
        Tpl::output('seo_keywords','拍卖惠,收藏天下拍卖惠,收藏品拍卖,书画拍卖,0元拍卖');
        Tpl::output('seo_description','收藏天下拍卖惠频道为您提供各种收藏品拍卖服务，收藏品0元起拍，正品底价，让您低价体会到收藏品网上拍卖的乐趣，非常值得参与体验的收藏品拍卖活动。');

        Tpl::output('nav_link_list',$nav_link);
		Tpl::output('logres',$logres);
        Tpl::showpage('auction');
    }

    //往期拍卖惠产品
    public function moreOp(){
        $h_model = Model('lepai_home');
        $lists = $h_model->getGoodsInfoMore(array('G_Atype'=>array('egt','6')),20);
        Tpl::output('pagename','more');
        Tpl::output('lists',$lists);
        Tpl::output('show_page',$h_model->showpage());

        //分类导航
        $nav_link = array(
            0=>array(
                'title'=>Language::get('homepage'),
                'link'=>SHOP_SITE_URL,
            ),
            1=>array(
                'title'=>'拍卖惠',
                'link'=>LEPAI_SITE_URL,
            ),
            2=>array(
                'title'=>'往期拍卖',
            )
        );
        Tpl::output('nav_link_list',$nav_link);
        Tpl::showpage('more');
    }

    //正在进行产品
    public function auction_moreOp(){
        $h_model = Model('lepai_home');
        $lists = $h_model->getGoodsInfo(array('G_Atype'=>array('eq','3')),'*','pai_count desc,G_Click desc','50');

        Tpl::output('pagename','auction_more');
        Tpl::output('lists',$lists);
        Tpl::output('show_page',$h_model->showpage(1));

        //分类导航
        $nav_link = array(
            0=>array(
                'title'=>Language::get('homepage'),
                'link'=>SHOP_SITE_URL,
            ),
            1=>array(
                'title'=>'拍卖惠',
                'link'=>LEPAI_SITE_URL,
            ),
            2=>array(
                'title'=>'正在进行',
            )
        );
        Tpl::output('nav_link_list',$nav_link);
        Tpl::showpage('more');
    }


    //拍卖报名
    public function ajaxbaomingOp(){
        $h_model = Model('lepai_home');

        $auction_id = intval($_POST['id']);
        $type = (intval($_POST['type']) < 1)?'1':intval($_POST['type']);

        $goods = $h_model->getGoodsInfoOne(array('G_Id'=>$auction_id));

        if(!is_array($goods) || intval($goods['G_Atype']) < 3){
            exit('1');
        }

        if($_SESSION['member_id'] < 1){
            exit('-1');
        }

        if($goods['G_EndTime'] < TIMESTAMP){
            exit('3');
        }

        $baoming = $h_model->getLepaiBaoming(array('auction_id'=>$auction_id,'member_id'=>$_SESSION['member_id']));
        if(is_array($baoming) && !empty($baoming)){
            if($baoming['type'] == '3'){
                exit('7');
            }else{
                exit('2');
            }
        }

        $member_info = Model('member')->getMemberInfoByID($_SESSION['member_id']);

        try {
            $h_model->beginTransaction();
            if($type == '1'){
                //现金支付保证金
                $baozhengjin = intval($goods['G_BaoZhenMoney']);
                if($member_info['available_predeposit'] < $goods['G_BaoZhenMoney']){
                    exit('4');
                }
                //变更预存款
                if($baozhengjin > 0){
                    $data_pd = array();
                    $data_pd['member_id'] = $member_info['member_id'];
                    $data_pd['member_name'] = $member_info['member_name'];
                    $data_pd['amount'] = $baozhengjin;
                    $data_pd['auction_id'] = $auction_id;
                    $res = $h_model->changePd('lepai_jiaona',$data_pd);
                    if(!$res){
                        throw new Exception('操作失败');
                    }
                }

            }elseif($type == '2'){
                //收藏币支付保证金
                $baozhengjin = intval($goods['G_BaoZhenMoney']*100);
                if($member_info['member_points'] < intval($goods['G_BaoZhenMoney']*100)){
                    exit('6');
                }
                //变更积分
                if($baozhengjin > 0) {
                    $points_arr = array();
                    $points_arr['pl_memberid'] = $member_info['member_id'];
                    $points_arr['pl_membername'] = $member_info['member_name'];
                    $points_arr['pl_points'] = -$baozhengjin;
                    $points_arr['pl_desc'] = '【冻结】拍卖惠活动使用收藏币缴纳保证金，活动编号：' . $auction_id;
                    $points_arr['pl_lepai_type'] = 'lepai_jiaona';
                    $points_arr['pl_lepai_goodsid'] = $auction_id;
                    $res = Model('points')->savePointsLog('other', $points_arr);
                    if (!$res) {
                        throw new Exception('操作失败');
                    }
                }

            }else{
                //银卡会员及以上免保证金
                $baozhengjin = 0;
            }
            $bm_add = array();
            $bm_add['auction_id'] = $auction_id;
            $bm_add['type'] = $type;
            $bm_add['member_id'] = $member_info['member_id'];
            $bm_add['amount'] = $baozhengjin;
            $bm_add['bind_time'] = TIMESTAMP;
            $addbaoming = $h_model->addLepaiBaoming($bm_add);

            if (!$addbaoming) {
                throw new Exception('操作失败');
            }
            $h_model->commit();
            exit('5');

        }catch (Exception $e){
            $h_model->rollback();
            exit('-2');
        }

    }

    //拍卖出价
    public function ajaxchujiaOp(){
        $h_model = Model('lepai_home');

        $auction_id = intval($_POST['id']);
        $price = (intval($_POST['price']));

        $goods = $h_model->getGoodsInfoOne(array('G_Id'=>$auction_id));

        if(!is_array($goods) || intval($goods['G_Atype']) < 3){
            exit('1');
        }

        if($_SESSION['member_id'] < 1){
            exit('-1');
        }

        if($goods['G_EndTime'] < TIMESTAMP){
            exit('-3');
        }

        $chujia_user = $h_model->getLepaiLogOne(array('auction_id'=>$auction_id));//最后出价用户
        $now_price = ($chujia_user['price'] >= $goods['G_Qipai'])?$chujia_user['price']:$goods['G_Qipai'];
        if($price < intval($now_price + $goods['G_IncMoney'])){
            exit('3');
        }

        if($chujia_user['member_id'] == $_SESSION['member_id']){
            exit('4');
        }

        if(is_array($chujia_user) && !empty($chujia_user) && $chujia_user['weituo'] != 1){
            //消息通知前一次出价客户出局
            $param = array();
            $param['code'] = 'lepai_chaoguo';
            $param['member_id'] = $chujia_user['member_id'];
            $param['param'] = array(
                'goods_url' => urlLepai('index','auction',array('id'=>$chujia_user['auction_id'])),
            );
            QueueClient::push('sendMemberMsg', $param);
        }

        $add = array();
        $add['auction_id'] = $auction_id;
        $add['member_id'] = $_SESSION['member_id'];
        $add['price'] = $price;
        $add['add_time'] = TIMESTAMP;
        $addres = $h_model->addLepaiChujia($add,true,$goods['G_IncMoney']);
        if(!$addres){
            exit('-2');
        }else{
            exit('0');
        }
    }

    //委托出价
    public function ajaxweituoOp(){
        $h_model = Model('lepai_home');

        $auction_id = intval($_POST['id']);
        $price = (intval($_POST['client_prices']));

        $goods = $h_model->getGoodsInfoOne(array('G_Id'=>$auction_id));

        if(!is_array($goods) || intval($goods['G_Atype']) < 3){
            exit('1');
        }

        if($_SESSION['member_id'] < 1){
            exit('-1');
        }

        if($goods['G_EndTime'] < TIMESTAMP){
            exit('5');
        }

        $chujia_user = $h_model->getLepaiLogOne(array('auction_id'=>$auction_id));//最后出价用户
        $now_price = ($chujia_user['price'] >= $goods['G_Qipai'])?$chujia_user['price']:$goods['G_Qipai'];

        if($price < intval($now_price + $goods['G_IncMoney'])){
            exit('2');
        }
        $weituoRes = $h_model->getWeituoOne(array('member_id'=>$_SESSION['member_id'],'auction_id'=>$auction_id));
        if(is_array($weituoRes) && !empty($weituoRes)){
            $update = array();
            $update['weituo_price'] = $price;
            $update['is_sms'] = '0';
            $update['add_time'] = TIMESTAMP;
            $Res = $h_model->updateWeituo($update,array('member_id'=>$_SESSION['member_id'],'auction_id'=>$auction_id));
            //用户委托信息不为空
        }else{
            $insert = array();
            $insert['member_id'] = $_SESSION['member_id'];
            $insert['weituo_price'] = $price;
            $insert['auction_id'] = $auction_id;
            $insert['is_sms'] = '0';
            $insert['add_time'] = TIMESTAMP;
            $Res = $h_model->addWeituo($insert);
        }
        if(!$Res){
            exit('-2');
        }else{
            if($goods['T_Ktime'] > TIMESTAMP){ //未开始，不进行出价
                exit('0');
            }
            if($chujia_user['member_id'] == $_SESSION['member_id']){
                exit('0');
            }
            //委托成功，进行出价
            $add = array();
            $add['auction_id'] = $auction_id;
            $add['member_id'] = $_SESSION['member_id'];
            $add['price'] = intval($now_price + $goods['G_IncMoney']);
            $add['weituo'] = 1;
            $add['add_time'] = TIMESTAMP;
            $Res = $h_model->addLepaiChujia($add,true,$goods['G_IncMoney']);
            if(!$Res){
                exit('-2');
            }else{
                exit('0');
            }
        }
    }

    //出价记录
    public function ajaxChuJiaLogOp(){
        $h_model = Model('lepai_home');
        $member_model = Model('member');
        $pagesize = 4;//每页显示数量
        $auction_id = intval($_GET['id']);
        //隐藏未开始出价记录
        $goods = $h_model->getGoodsInfoOne(array('G_Id'=>$auction_id));
        if($goods['T_Ktime'] > TIMESTAMP){
            $TotalNum = 0;
        }else{
            $_GET['curpage'] = (intval($_GET['pagenum'])<1)?'1':intval($_GET['pagenum']);
            $logres = $h_model->getLepaiLog(array('auction_id'=>$auction_id),$pagesize);

            $TotalNum = $h_model->getTotalNum();
            $TotalPage = $h_model->getTotalPage();
        }


        $html = "<div class='auction_center_right_top_jilu'><p><span>参与人</span><span>价格</span><span>时间</span></p>";
        if($TotalNum > 0){
            foreach($logres as $k=>$v){
                $memberinfo = $member_model->getMemberInfoByID($v['member_id']);
                $html .= "<p><span>";
                if($k == 0 && $_GET['curpage'] == 1){
                    $html .= "<i title='该用户目前处于领先' style='background: #e43a3d;'>先</i>";
                }
                $html .= mb_substr($memberinfo['member_name'],0,2,'utf-8')."***</span><span>￥".intval($v['price'])."</span><span>".date('m/d H:i:s',$v['add_time']);
                if($v['weituo']){
                    $html .= " <i title='该用户使用了委托出价' style='cursor:pointer;'>代</i>";
                }
                $html .= "</span></p>";
            }
        }else{
            $html .= "<p><span>没有出价记录</span></p>";
        }
        $html .= "</div><p class='auction_center_right_top_p' style='width: 200px;'>";

        if($_GET['curpage'] <= '1'){
            $html .= "<a href='javascript:void(0);'>&lt;</a>";
        }else{
            $html .= "<a href='javascript:chujiajilu(1);'>&lt;</a>";
        }
        for($i=1;$i<=$TotalPage;$i++){
            $html .= "<a href='javascript:chujiajilu(".$i.");'";
            if($_GET['curpage'] == $i){
                $html .= "style='color: #FFF;border: 1px solid #d00000;background-color: #d00000;'";
            }
            $html .= ">".$i."</a>";
        }
        if($_GET['curpage'] == $TotalPage){
            $html .= "<a href='javascript:void(0);'>&gt;</a>";
        }else{
            $html .= "<a href='javascript:chujiajilu(".$TotalPage.");'>&gt;</a>";
        }
        echo $html;exit;
    }

	 /**
     * 拍卖惠产品详细页
     */
    public function lepai_detailOp() {
        $G_Id = intval($_GET ['G_Id']);
		$h_model = Model('lepai_home');
		$goods = $h_model->getGoodsInfoOne(array('G_Id'=>$G_Id));

        if(!is_array($goods) || intval($goods['G_Atype']) < 3){
            showMessage('拍品不存在！','','html','error');
        }
        $nav_link[2] = array('title'=>$goods['G_Name']);
		$goods_common_info['goods_body'] = htmlspecialchars_decode($goods['G_Content']);
        Tpl::output('goods_common_info', $goods_common_info);
        Tpl::output('no_header', true);
        Tpl::output('no_footer', true);
        Tpl::showpage('lepai_detail');
    }

	/**
     * 保证金须知
     */
    public function processOp() {
		Tpl::output('html_title','保证金须知');
        Tpl::showpage('process');
    }


    private function makeLepaiSn($id){
        return (date('y',time()) % 9+1) . sprintf('%013d', $id) . sprintf('%02d', mt_rand(11,99));
    }

}
