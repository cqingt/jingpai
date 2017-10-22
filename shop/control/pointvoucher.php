<?php
/**
 * 代金券
 ***/


defined('InShopNC') or exit('Access Invalid!');
class pointvoucherControl extends BasePointShopControl {
	public function __construct() {
		parent::__construct();
		//读取语言包
		Language::read('home_voucher');
		//判断系统是否开启代金券功能
		if (C('voucher_allow') != 1){
			showDialog(L('voucher_pointunavailable'),'index.php','error');
		}
	}
	public function indexOp(){
		/*SEO*/
        Tpl::output('html_title','优惠券 - 收藏天下');
        Tpl::output('seo_keywords','收藏币换券,收藏币兑换,收藏天下电子优惠券,热门优惠券');
        Tpl::output('seo_description','收藏天下会员俱乐部为全体收藏天下会员提供热门优惠券，众多收藏天下优惠券用收藏币即可以兑换。让您购买收藏品更超值，来收藏天下会员俱乐部，享受优质会员服务！');

		$this->pointvoucherOp();
	}
	/**
	 * 代金券列表
	 */
	public function pointvoucherOp(){
	    //查询会员及其附属信息
	    parent::pointshopMInfo();

		$model_voucher = Model('voucher');

		//代金券模板状态
		$templatestate_arr = $model_voucher->getTemplateState();

		//查询会员信息
		$member_info = Model('member')->getMemberInfoByID($_SESSION['member_id']);

		//查询代金券列表
		$where = array();
		$where['voucher_t_state'] = $templatestate_arr['usable'][0];
		$where['voucher_t_end_date'] = array('gt',time());
		if (intval($_GET['sc_id']) > 0){
		    $where['voucher_t_sc_id'] = intval($_GET['sc_id']);
		}
		if (intval($_GET['price']) > 0){
		    $where['voucher_t_price'] = intval($_GET['price']);
		}
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
		//排序
		switch ($_GET['orderby']){
			case 'exchangenumdesc':
			    $orderby = 'voucher_t_giveout desc,';
			    break;
			case 'exchangenumasc':
			    $orderby = 'voucher_t_giveout asc,';
			    break;
	        case 'pointsdesc':
	            $orderby = 'voucher_t_points desc,';
	            break;
            case 'pointsasc':
                $orderby = 'voucher_t_points asc,';
                break;
		}

		/*2015-11-23 Add is name Lt 代金卷是否显示台*/
		$where['voucher_t_show'] = '1';
		/*End*/


		$orderby .= 'voucher_t_id desc';
		$voucherlist = $model_voucher->getVoucherTemplateList($where, '*', 0, 18, $orderby);

    /* 2016-09-13 Add is name lt 搜索列表只显示有的优惠券 */
    $voucher_list = array();
    foreach ($voucherlist as $k => $v) {
      array_push($voucher_list,$v['voucher_t_price']);
    }
    Tpl::output('voucher_list',array_unique($voucher_list));
    /* End */


		Tpl::output('voucherlist',$voucherlist);
		Tpl::output('show_page', $model_voucher->showpage(2));

		//查询代金券面额
		$pricelist = $model_voucher->getVoucherPriceList();
		Tpl::output('pricelist',$pricelist);

		//查询店铺分类
		$store_class = rkcache('store_class', true);
		Tpl::output('store_class', $store_class);

		//分类导航
		$nav_link = array(
		        0=>array('title'=>Language::get('homepage'),'link'=>SHOP_SITE_URL),
		        1=>array('title'=>'积分中心','link'=>urlShop('pointshop','index')),
		        2=>array('title'=>'优惠券列表')
		);
		Tpl::output('nav_link_list', $nav_link);
		Tpl::showpage('pointvoucher');
	}
	/**
	 * 兑换代金券
	 */
	public function voucherexchangeOp(){
		$vid = intval($_GET['vid']);


		if($vid <= 0){
			$vid = intval($_POST['vid']);
		}
		if($_SESSION['is_login'] != '1'){
			$js = "login_dialog();";
			showDialog('','','js',$js);
		}elseif ($_GET['dialog']){
			$js = "CUR_DIALOG = ajax_form('vexchange', '".L('home_voucher_exchangtitle')."', '".url('pointvoucher','voucherexchange',array('vid'=>$vid),false,SHOP_SITE_URL)."', 550);";
			showDialog('','','js',$js);
			die;
		}
		$result = true;
		$message = "";
		if ($vid <= 0){
			$result = false;
			L('wrong_argument');
		}


		if ($result){
			//查询可兑换代金券模板信息
			$template_info = Model('voucher')->getCanChangeTemplateInfo($vid,intval($_SESSION['member_id']),intval($_SESSION['store_id']));
			if ($template_info['state'] == false){
				$result = false;
				$message = $template_info['msg'];
			}else {
				//查询会员信息
				$member_info = Model('member')->getMemberInfoByID($_SESSION['member_id'],'member_points');
				Tpl::output('member_info',$member_info);
				Tpl::output('template_info',$template_info['info']);
			}
		}


		file_put_contents('dai_money22.txt', print_r($message,true),FILE_APPEND);

		file_put_contents('dai_money33.txt', print_r($result,true),FILE_APPEND);

		Tpl::output('message',$message);
		Tpl::output('result',$result);
		Tpl::showpage('pointvoucher.exchange','null_layout');
	}
	/**
	 * 兑换代金券保存信息
	 *
	 */
	public function voucherexchange_saveOp(){
		if($_SESSION['is_login'] != '1'){
			$js = "login_dialog();";
			showDialog('','','js',$js);
		}
		$vid = intval($_POST['vid']);
		$js = "DialogManager.close('vexchange');";
		if ($vid <= 0){
			showDialog(L('wrong_argument'),'','error',$js);
		}
		$model_voucher = Model('voucher');
		//验证是否可以兑换代金券
		$data = $model_voucher->getCanChangeTemplateInfo($vid,intval($_SESSION['member_id']),intval($_SESSION['store_id']));
		if ($data['state'] == false){
			showDialog($data['msg'],'','error',$js);
		}
		//添加代金券信息
		$data = $model_voucher->exchangeVoucher($data['info'],$_SESSION['member_id'],$_SESSION['member_name']);
		if ($data['state'] == true){
			showDialog($data['msg'],'','succ',$js);
		} else {
		    showDialog($data['msg'],'','error',$js);
		}
	}

/**
	 * 代金券手动添加
	 *
	 */
	public function voucherexchange_addOp(){

		if($_SESSION['is_login'] != '1'){
			showMessage('请登录');
		}
		$vid = intval(base64_decode(decrypt(strval($_GET['vid']), sha1(md5('key')), 0)));
		$js = "DialogManager.close('vexchange');";
		if ($vid <= 0){
			showMessage('该代金卷无效');
		}
		$model_voucher = Model('voucher');

		/* Add is name lt 2016-04-27 添加一个参数识别不需要积分兑换 */

		$_SESSION['shoudong_voucher'] = true;
		
		/* End */

		//验证是否可以兑换代金券
		$data = $model_voucher->getCanChangeTemplateInfo($vid,intval($_SESSION['member_id']),intval($_SESSION['store_id']));
		if ($data['state'] == false){
			showMessage($data['msg']);
		}
		//添加代金券信息
		$data = $model_voucher->exchangeVoucher($data['info'],$_SESSION['member_id'],$_SESSION['member_name'],true);
		if ($data['state'] == true){
			showMessage($data['msg']);
		} else {
		    showMessage($data['msg']);
		}

	}

	/*代金卷发送链接*/
	public function voucherUrlOp(){
		$vid = intval($_GET['vid']);
		$url = "index.php?act=pointvoucher&op=voucherexchange_add&vid=$vid";
		showDialog('123123','','succ',empty($_GET['inajax']) ?'':'CUR_DIALOG.close();');
	}








	/**
	 * 平台代金券手动添加
	 *
	 */
	public function pingtai_voucherexchange_addOp(){

		if($_SESSION['is_login'] != '1'){
			showMessage('请登录');
		}

		$vid = intval(base64_decode(decrypt(strval($_GET['vid']), sha1(md5('key')), 0)));

		if ($vid <= 0){
			showMessage('该代金卷无效');
		}
		$model_voucher = Model('store_voucher');

		$template_info = $model_voucher->table('store_voucher_template')->where(array('voucher_t_id'=>$vid))->find();

		//添加代金券信息
		$data = $model_voucher->exchangeVoucher($template_info,$_SESSION['member_id'],$_SESSION['member_name']);


		if ($data['state'] == true){
			showMessage($data['msg']);
		} else {
		    showMessage($data['msg']);
		}

	}













	public function voucherexchange_wxaddOp(){
		$vid = intval($_GET['vid']);
		$uid = intval($_GET['uid']);

		$type = $_GET['type'];

		if($vid && $uid){
			$model = Model('voucher');
			$result = $model->addDaiJingJuan($uid,$vid,$type);

			echo json_encode($result);
		}
	}



	
}
