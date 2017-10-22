<?php
/**
 * 会员俱乐部
 */

defined('InShopNC') or exit('Access Invalid!');
class vipControl extends mobileHomeControl{

	public function __construct() {
        parent::__construct();
    }

    /**
     * 会员俱乐部首页
     */
	public function indexOp() {

		//开启代金券功能后查询推荐的热门代金券列表
	    if (C('voucher_allow') == 1){
	        $recommend_voucher = Model('voucher')->getRecommendTemplate(6);


	        Tpl::output('recommend_voucher',$recommend_voucher);
	    }

	    //开启积分兑换功能后查询推荐的热门兑换商品列表
	    if (C('pointprod_isuse') == 1){
	        //热门积分兑换商品
	        $recommend_pointsprod = Model('pointprod')->getRecommendPointProd(5);

	        Tpl::output('recommend_pointsprod_one',array_shift($recommend_pointsprod));

	        Tpl::output('recommend_pointsprod',$recommend_pointsprod);
	    }

	    $this->getMemberAndGradeInfo(false);

	    $userVoucherMax = Model('voucher')->getCurrentAvailableVoucherCount($_SESSION['member_id']);

	    $top = $this->getadvImgOp(1086);

	    Tpl::output('userVoucherMax',$userVoucherMax);

	    Tpl::output('top',$top);

        Tpl::output('nav_title','会员俱乐部');
        Tpl::output('html_title','会员俱乐部 - '.C('site_name'));
        Tpl::output('seo_keywords','会员俱乐部,收藏天下优惠券,会员特价,优惠活动,礼品兑换,积分中心,抽奖');
        Tpl::output('seo_description','收藏天下会员俱乐部为全体收藏天下会员提供收藏币换券、礼品兑换服务和会员特价商品、收藏币抽奖等超值活动。来收藏天下会员俱乐部，享受优质会员服务！');

        Tpl::showpage('vip_index');
	}


	/**
     * 优惠卷列表
     */
	public function discount_listOp() {
		$model_voucher = Model('voucher');

		//代金券模板状态
		$templatestate_arr = $model_voucher->getTemplateState();

		//查询代金券列表
		$where = array();
		$where['voucher_t_state'] = $templatestate_arr['usable'][0];
		$where['voucher_t_end_date'] = array('gt',time());

		/*2015-11-23 Add is name Lt 代金卷是否显示台*/
		$where['voucher_t_show'] = '1';
		/*End*/

		if($_SESSION['member_id']){

		//查询会员信息
		$member_info = Model('member')->getMemberInfoByID($_SESSION['member_id']);

		//查询仅我能兑换和所需积分
		$points_filter = array();
		if (intval($_GET['isable']) == 1){
		    $points_filter['isable'] = $member_info['member_points'];
		}
		if (intval($_GET['points_min']) > 0){
		    $points_filter['min'] = intval($_GET['points_min']);
		}
		if (intval($_GET['points_max']) > 0){
		    $points_filter['max'] = intval($_GET['points_max']);
		}
		if (count($points_filter) > 0){
		    asort($points_filter);
		    if (count($points_filter) > 1){
		        $points_filter = array_values($points_filter);
		        $where['voucher_t_points'] = array('between',array($points_filter[0],$points_filter[1]));
		    } else {
		        if ($points_filter['min']){
		            $where['voucher_t_points'] = array('egt',$points_filter['min']);
		        } elseif ($points_filter['max']) {
		            $where['voucher_t_points'] = array('elt',$points_filter['max']);
		        } elseif ($points_filter['isable']) {
		            $where['voucher_t_points'] = array('elt',$points_filter['isable']);
		        }
		    }
		}

		}


		$orderby .= 'voucher_t_id desc';
		$voucherlist = $model_voucher->getVoucherTemplateList($where, '*', 0, 10, $orderby);

		Tpl::output('voucherlist',$voucherlist);

		Tpl::output('show_page', $model_voucher->showpage(88));

        Tpl::output('nav_title','优惠券');
        Tpl::output('html_title','优惠券 - 会员俱乐部 - '.C('site_name'));
        Tpl::output('seo_keywords','收藏币换券,收藏币兑换,收藏天下电子优惠券,热门优惠券');
        Tpl::output('seo_description','收藏天下会员俱乐部为全体收藏天下会员提供热门优惠券，众多收藏天下优惠券用收藏币即可以兑换。让您购买收藏品更超值，来收藏天下会员俱乐部，享受优质会员服务！');

        Tpl::showpage('vip_discount.list');
	}



	/**
	 * 兑换代金券
	 *
	 */
	public function voucher_exchangeOp(){

		if(empty($_SESSION['member_id'])){
			echo '该用户未登录';
			exit;
		}

		$vid = intval($_GET['vid']);
		if ($vid <= 0){
			echo '该代金卷无效';
			exit;
		}

		$model_voucher = Model('voucher');
		//验证是否可以兑换代金券
		$data = $model_voucher->getCanChangeTemplateInfo($vid,intval($_SESSION['member_id']),intval($_SESSION['store_id']));
		if ($data['state'] == false){
			echo $data['msg'];
			exit;
		}

		//添加代金券信息
		$data = $model_voucher->exchangeVoucher($data['info'],$_SESSION['member_id'],$_SESSION['member_name']);
		if ($data['state'] == true){
			echo $data['msg'];
			exit;
		} else {
		    echo $data['msg'];
			exit;
		}

	}


	/**
     * 积分兑换列表
     */
	public function integral_listOp() {
	    $model_pointprod = Model('pointprod');
	    //展示状态
	    $pgoodsshowstate_arr = $model_pointprod->getPgoodsShowState();
	    //开启状态
	    $pgoodsopenstate_arr = $model_pointprod->getPgoodsOpenState();

	    //查询兑换商品列表
	    $where = array();

	    $where['pgoods_show'] = $pgoodsshowstate_arr['show'][0];

	    $where['pgoods_state'] = $pgoodsopenstate_arr['open'][0];

	    $orderby .= 'pgoods_sort asc,pgoods_id desc';
	    
		$pointprod_list = $model_pointprod->getPointProdList($where, '*', $orderby,'',20);

		Tpl::output('pointprod_list',$pointprod_list);

		Tpl::output('show_page', $model_pointprod->showpage(88));

        Tpl::output('nav_title','礼品兑换');
        Tpl::output('html_title','礼品兑换 - 会员俱乐部 - '.C('site_name'));
        Tpl::output('seo_keywords','礼品兑换,收藏币兑换,积分兑换');
        Tpl::output('seo_description','收藏天下会员俱乐部为全体收藏天下会员提供收藏币兑换礼品服务，众多超值商品用收藏币即可以换购。来收藏天下会员俱乐部，通过收藏币可免费获得心仪藏品。');

        Tpl::showpage('vip_integral.list');
	}



	/**
     * 积分兑换商品
     */
	public function integral_goodsOp(){
		$pid = intval($_GET['goods_id']);

		$model_pointprod = Model('pointprod');
		//查询兑换礼品详细
		$prodinfo = $model_pointprod->getOnlinePointProdInfo(array('pgoods_id'=>$pid));
		// var_dump($prodinfo);
		Tpl::output('prodinfo',$prodinfo);

        Tpl::output('nav_title','兑换商品');
        Tpl::output('html_title',$prodinfo['pgoods_name'].' - 会员俱乐部 - '.C('site_name'));
        Tpl::output('seo_keywords','礼品兑换,收藏币兑换,积分兑换');
        Tpl::output('seo_description','收藏天下会员俱乐部为全体收藏天下会员提供收藏币兑换礼品服务，众多超值商品用收藏币即可以换购。来收藏天下会员俱乐部，通过收藏币可免费获得心仪藏品。');

        Tpl::showpage('vip_integral.goods');
	}


	/**
     * 积分兑换商品
     */
	public function integral_exchange_orderOp(){
		$this->checkLoginOp();

		$this->integral_addOp();

		//获取符合条件的兑换礼品和总积分
		$data = Model('pointcart')->getCartGoodsList($_SESSION['member_id']);

		if (!$data['state']){
		    showWapMessage($data['msg'],urlWap('vip','integral_goods',array('goods_id'=>intval($_GET['pgid']))),'error');
		}

		Tpl::output('pointprod_arr',$data['data']);

		//实例化收货地址模型（不显示自提点地址）
		$address_list = Model('address')->getAddressList(array('member_id'=>$_SESSION['member_id'],'dlyp_id'=>0), 'is_default desc,address_id desc');
		Tpl::output('address_info',$address_list);

        Tpl::output('nav_title','兑换商品');
        Tpl::output('html_title','兑换商品 - 会员俱乐部 - '.C('site_name'));
        Tpl::output('seo_keywords','礼品兑换,收藏币兑换,积分兑换');
        Tpl::output('seo_description','收藏天下会员俱乐部为全体收藏天下会员提供收藏币兑换礼品服务，众多超值商品用收藏币即可以换购。来收藏天下会员俱乐部，通过收藏币可免费获得心仪藏品。');

        Tpl::showpage('vip_integral_exchange.order');
	}


	/*提交订单*/
	public function integral_add_orderOp(){
		$address_id = array('address_options'=>$_POST['address_id']);

		$pgid = $_POST['pgid'];

		$model_pointcart = Model('pointcart');
		//获取符合条件的兑换礼品和总积分
		$data = $model_pointcart->getCartGoodsList($_SESSION['member_id']);
		if (!$data['state']){
			showWapMessage($data['msg'],urlWap('vip','integral_goods'),'error');
		}
		$pointprod_arr = $data['data'];
		unset($data);
		
		//验证积分数是否足够
		$data = $model_pointcart->checkPointEnough($pointprod_arr['pgoods_pointall'], $_SESSION['member_id']);
		if (!$data['state']){
		    showWapMessage($data['msg'],urlWap('vip','integral_goods'),'error');
		}
		unset($data);
		
		//创建兑换订单
		$data = Model('pointorder')->createOrder($address_id, $pointprod_arr, array('member_id'=>$_SESSION['member_id'],'member_name'=>$_SESSION['member_name'],'member_email'=>$_SESSION['member_email']));
		if (!$data['state']){
		    showWapMessage($data['msg'],urlWap('vip','integral_exchange_order',array('pgid'=>$pgid)),'error');
		}
		$order_id = $data['data']['order_id'];

		$member_url = urlWap('member_integral','order');

		header("location:$member_url");

	}




	/*验证是否登陆*/
	private function checkLoginOp(){

		//判断系统是否开启积分和积分兑换功能
		if (C('pointprod_isuse') != 1){
			showWapMessage('未开启该功能','','error');
		}
		//验证是否登录
		if (empty($_SESSION['member_id'])){
			showWapMessage('请登录',urlWap('login','index'),'error');
		}
	}


	/**
	 * 购物车添加礼品
	 */
	private function integral_addOp() {
		$pgid	= intval($_GET['pgid']);
		$quantity	= 1;
		if($pgid <= 0 || $quantity <= 0) {
			showWapMessage('兑换数量错误',urlWap('vip','integral_goods',array('goods_id'=>$pgid)),'error');
		}

		//验证积分礼品是否存在购物车中
		$model_pointcart = Model('pointcart');
		$check_cart	= $model_pointcart->getPointCartInfo(array('pgoods_id'=>$pgid,'pmember_id'=>$_SESSION['member_id']));

		if(empty($check_cart)) {
		
		//验证是否能兑换
		$data = $model_pointcart->checkExchange($pgid, $quantity, $_SESSION['member_id']);

		if (!$data['state']){
		    switch ($data['error']){
		        case 'ParameterError':
		            showWapMessage($data['msg'],urlWap('vip','integral_goods',array('goods_id'=>$pgid)),'error');
		            break;
		        default:
		        	showWapMessage($data['msg'],urlWap('vip','integral_goods',array('goods_id'=>$pgid)),'error');
		    	    break;		    	
		    }
		}
		$prod_info = $data['data']['prod_info'];

		$insert_arr	= array();
		$insert_arr['pmember_id']		= $_SESSION['member_id'];
		$insert_arr['pgoods_id']		= $prod_info['pgoods_id'];
		$insert_arr['pgoods_name']		= $prod_info['pgoods_name'];
		$insert_arr['pgoods_points']	= $prod_info['pgoods_points'];
		$insert_arr['pgoods_choosenum']	= $prod_info['quantity'];
		$insert_arr['pgoods_image']		= $prod_info['pgoods_image_old'];

		//删除原有购物车内商品
		$model_pointcart->delPointCart(array('pmember_id'=>$_SESSION['member_id']),$_SESSION['member_id']);

		$cart_state = $model_pointcart->addPointCart($insert_arr);
		}


	}


	// /**
	//  * 购物车添加礼品读取
	//  */
	// private function integral_get_goodsOp() {
	// 	$model_pointcart = Model('pointcart');
	// 	$data = $model_pointcart->getPCartListAndAmount(array('pmember_id'=>$_SESSION['member_id']));

	// 	Tpl::output('pgoods_pointall',$data['data']['cartgoods_pointall']);
	// 	Tpl::output('cart_array',$data['data']['cartgoods_list']);

	// }

	private function getadvImgOp($ap_id = 0){
	$ap_id = intval($ap_id);
	$where['ap_id'] = $ap_id;
	$ap_info = Model()->table('adv')->where($where)->order('adv_id DESC')->select();

	if (!$ap_info)return;

	foreach($ap_info as $k => $v){
		$pic_content = unserialize($v['adv_content']);
		$content[$k]['Img'] = UPLOAD_SITE_URL."/".ATTACH_ADV."/".$pic_content['adv_pic'];
		$content[$k]['Href'] = "http://".$pic_content['adv_pic_url']."";
	}
	
	return $content;

	}














}
