<?php
/**
 * 网站设置
 *
 *
 *
 ***/

defined('InShopNC') or exit('Access Invalid!');
class push_user_giftControl extends SystemControl{

	public function __construct(){
		parent::__construct();
	}

	public function indexOp(){

		$model_setting = Model('setting');

		$list_setting = $model_setting->getListSetting();

		Tpl::output('setArr',$list_setting);
        $this->show_menu('index');
		Tpl::showpage('push_user_gift.index');
	}


    /*
     * 藏豆变更日志
     */
    public function logOp(){
        $this->show_menu('log');

        $result = Model()->table('cangdou_log,member')
        ->field('cangdou_log.*,member.member_id,member.member_name')
        ->join('inner')->on('cangdou_log.C_PushId = member.member_id')
        ->page(10)
        ->order('C_Id desc')
        ->select();


        Tpl::output('result_list',$result);
        Tpl::output('page',Model()->showpage(2));
        Tpl::showpage('push_user_gift.log');
    }


    /*
     * 用户列表
     */
    public function user_cangdouOp(){

        if($_GET['search']){
            $where['member_name'] = array(array('like','%'.$_GET['search'].'%'));
        }

        $model_member = Model('member');
		$where['cangdou'] = array('gt','0');

        $member_list = $model_member->getMemberList($where,'member_id,member_name,cangdou', 10,'member_id desc');


        $this->show_menu('user');
        Tpl::output('result_list',$member_list);
        Tpl::output('page',Model()->showpage(2));
        Tpl::showpage('push_user_gift.user');
    }

    /*
     * 藏豆修改
     */
    public function update_cangdouOp(){
        
        $id = intval(trim($_GET['id']));

        $model_member = Model('member');

        $member_info = $model_member->getMemberInfoByID($id);

        Tpl::output('member_info',$member_info);

        Tpl::showpage('push_user_gift.user_info');
    }

    /*
     * 藏豆修改
     */
    public function do_update_cangdouOp(){
        if(chksubmit()){
            $model_member = Model('member');
            $member_id = $_POST['P_Id'];
            $cangdou = $_POST['cangdou'];

            try {
                $model_member->beginTransaction();

                $model_member->editMember(array('member_id'=>$member_id),array('cangdou'=>$cangdou));

                $data['C_PushId'] = $member_id;
                $data['C_Time'] = time();
                $data['C_CangDou'] = $cangdou;
                $data['C_DouType'] = 'admin';
                $data['C_Remark'] = '商城后台管理员变更操作';

                Model()->table('cangdou_log')->insert($data);

                $model_member->commit();

                showMessage('操作成功');
            } catch (Exception $e) {
                $model_member->rollback();

                showMessage('操作失败');
            }
        }
    }

    /*
     * 兑换商品列表
     */
    public function exchangeOp(){
        $model_cangdou = Model('pushuser_gift');

        $field = "*";
        $page = 10;

        $result_list = $model_cangdou->getCangdouGiftList(array(),$field,$page);


        Tpl::output('result_list',$result_list);
		Tpl::output('page',$model_cangdou->showpage(2));
        $this->show_menu('exchange');
        Tpl::showpage('push_user_gift.exchange');
    }


    /*
     * 兑换礼品添加
     */
    public function add_giftOp(){
        $lang	= Language::getLangContent();
        $model_cangdou = Model('pushuser_gift');
        if (chksubmit()){

            if($_POST['gift_id'] > 0){
                $update = array();
                $update['goods_id'] = $_POST['goods_id'];
                $update['use_cangdou'] = $_POST['use_cangdou'];
                $update['kucun'] = $_POST['kucun'];
                $update['starttime'] = strtotime($_POST['starttime']);
                $update['endtime'] = strtotime($_POST['endtime']);
                $res = $model_cangdou->editCangdouGift($update,array('id'=>$_POST['gift_id']));
                if ($res){
                    showMessage($lang['nc_common_save_succ'],'index.php?act=push_user_gift&op=exchange');
                }else {
                    showMessage($lang['nc_common_save_fail']);
                }
            }else{
                $add = array();
                $add['goods_id'] = $_POST['goods_id'];
                $add['use_cangdou'] = $_POST['use_cangdou'];
                $add['kucun'] = $_POST['kucun'];
                $add['starttime'] = strtotime($_POST['starttime']);
                $add['endtime'] = strtotime($_POST['endtime']);
                $add['addtime'] = TIMESTAMP;
                $res = $model_cangdou->addCangdouGift($add);
                if ($res){
                    showMessage($lang['nc_common_save_succ'],'index.php?act=push_user_gift&op=exchange');
                }else {
                    showMessage($lang['nc_common_save_fail']);
                }
            }

        }
        if($_GET['gift_id'] > 0){
            $cangdou_info = $model_cangdou->getCangdouGiftInfo('cangdou_gift.id='.$_GET['gift_id']);

            Tpl::output('cangdou_info',$cangdou_info);
        }
        $this->show_menu('add_gift');
        Tpl::showpage('push_user_gift.gift_edit');
    }
	
	/*
     * 删除礼品兑换
     */
	public function cangdou_gift_delOp(){
		$model_cangdou = Model('pushuser_gift');
		$gift_id = intval($_POST['gift_id']);
		$result = $model_cangdou->getGiftDel(array('id'=>$gift_id));
		if($result) {
			$this->log('删除兑换礼品活动，礼品编号'.$gift_id,null);
			showMessage(L('nc_common_op_succ'), '');
		}else{
			showMessage(L('nc_common_op_fail'), '');
		}
		
	}

	/*
     * 兑换商品列表
     */
    public function tuijian_listOp(){
		$model_cangdou = Model('pushuser_gift');
        $result_list = $model_cangdou->getCangdouTuiJianList(array(),'*',10);
		Tpl::output('page',$model_cangdou->showpage(2));
        Tpl::output('result_list',$result_list);
        $this->show_menu('tuijian_list');
        Tpl::showpage('push_user_tuijian.exchange');
	}


	/*
     * 删除推荐商品
    */
	public function cangdou_tuijian_delOp(){
		$model_cangdou = Model('pushuser_gift');
		$tj_id = intval($_POST['tj_id']);
		$result = $model_cangdou->getTuiJianDel(array('id'=>$tj_id));
		if($result) {
			$this->log('删除推荐商品活动，礼品编号'.$tj_id,null);
			showMessage(L('nc_common_op_succ'), '');
		}else{
			showMessage(L('nc_common_op_fail'), '');
		}
	}
	/*
     * 推荐商品添加
    */
    public function tuijian_addOp(){
        $lang	= Language::getLangContent();
        $model_cangdou = Model('pushuser_gift');
        if (chksubmit()){
            if($_POST['gift_id'] > 0){
                $update = array();
                $update['goods_id'] = $_POST['goods_id'];
                $update['price'] = $_POST['price'];
				$update['number'] = intval($_POST['number']);
				$update['member_number'] = intval($_POST['member_number']);
                $update['starttime'] = strtotime($_POST['starttime']);
                $update['endtime'] = strtotime($_POST['endtime']);
				$update['is_tuijian'] = intval($_POST['is_tuijian']);
                $res = $model_cangdou->editCangdouTuiJian($update,array('id'=>$_POST['gift_id']));
                if ($res){
                    showMessage($lang['nc_common_save_succ'],'index.php?act=push_user_gift&op=tuijian_list');
                }else {
                    showMessage($lang['nc_common_save_fail']);
                }
            }else{
                $add = array();
                $add['goods_id'] = $_POST['goods_id'];
                $add['price'] = $_POST['price'];
				$add['number'] = intval($_POST['number']);
                $add['starttime'] = strtotime($_POST['starttime']);
                $add['endtime'] = strtotime($_POST['endtime']);
				$add['member_number'] = intval($_POST['member_number']);
                $add['addtime'] = TIMESTAMP;
				$add['is_tuijian'] = intval($_POST['is_tuijian']);
                $res = $model_cangdou->addCangdouTuiJian($add);
                if ($res){
                    showMessage($lang['nc_common_save_succ'],'index.php?act=push_user_gift&op=tuijian_list');
                }else {
                    showMessage($lang['nc_common_save_fail']);
                }
            }

        }
        if($_GET['gift_id'] > 0){
            $cangdou_info = $model_cangdou->getCangdouTuiJianInfo('cangdou_tuijian.id='.$_GET['gift_id']);

            Tpl::output('cangdou_info',$cangdou_info);
        }
        $this->show_menu('tuijian_add');
        Tpl::showpage('push_user_tuijian.tuijian_edit');
    }


    /*
     * AJAX获取商品信息
     */
    public function get_goodsOp(){
        $goods_id = intval($_GET['goods_id']);
        $goods_info = Model('goods')->getGoodsInfoByID($goods_id);

        $return = array();
        if(!empty($goods_info)){
            $goods_info['goods_img_url'] = cthumb($goods_info['goods_image'],360);
            $return['state'] = true;
            $return['info'] = $goods_info;
        }else{
            $return['state'] = false;
        }
        echo json_encode($return);exit;
    }


	/*提交设置*/
	public function doSetOp(){
		// $dataArr['P_ZhuCe'] = intval(trim($_POST['P_ZhuCe']));
		$dataArr['cangdou_one'] = intval(trim($_POST['cangdou_one']));
		$dataArr['cangdou_two'] = intval(trim($_POST['cangdou_two']));
		$dataArr['cangdou_order_one'] = intval(trim($_POST['cangdou_order_one']));
		$dataArr['cangdou_order_two'] = intval(trim($_POST['cangdou_order_two']));

		$obj_validate = new Validate();
		$validate_arr = array();
		// $validate_arr[] = array("input"=>$dataArr["P_ZhuCe"], "require"=>"true", "message"=>'注册送豆不能为空');
		$validate_arr[] = array("input"=>$dataArr["cangdou_one"], "require"=>"true", "message"=>'一级分销积分不能为空');
		$validate_arr[] = array("input"=>$dataArr["cangdou_two"], "require"=>"true", "message"=>'二级分销积分不能为空');
		$validate_arr[] = array("input"=>$dataArr["cangdou_order_one"], "require"=>"true", "message"=>'一级订单返利不能为空');
		$validate_arr[] = array("input"=>$dataArr["cangdou_order_two"], "require"=>"true", "message"=>'二级订单返利不能为空');

		$obj_validate->validateparam = $validate_arr;
		$error = $obj_validate->validate();
		if ($error != ''){
			showMessage($error);
		}

		$model_setting = Model('setting');

		$result = $model_setting->updateSetting($dataArr);
		if ($result === true){
			showMessage(L('nc_common_save_succ'));
		}else {
			showMessage(L('nc_common_save_fail'));
		}



	}


    /**
     * 页面内导航菜单
     *
     * @param string 	$menu_key	当前导航的menu_key
     * @param array 	$array		附加菜单
     * @return
     */
    private function show_menu($menu_key) {
        $menu_array = array(
            'index'=>array('menu_type'=>'link','menu_name'=>'藏豆设置','menu_url'=>'index.php?act=push_user_gift&op=index'),
            'user'=>array('menu_type'=>'link','menu_name'=>'会员藏豆管理','menu_url'=>'index.php?act=push_user_gift&op=user_cangdou'),
            'log'=>array('menu_type'=>'link','menu_name'=>'藏豆变更记录','menu_url'=>'index.php?act=push_user_gift&op=log'),
            'exchange'=>array('menu_type'=>'link','menu_name'=>'兑换礼品列表','menu_url'=>'index.php?act=push_user_gift&op=exchange'),
            'add_gift'=>array('menu_type'=>'link','menu_name'=>'兑换礼品添加','menu_url'=>'index.php?act=push_user_gift&op=add_gift'),
			'tuijian_list'=>array('menu_type'=>'link','menu_name'=>'推荐商品列表','menu_url'=>'index.php?act=push_user_gift&op=tuijian_list'),
			'tuijian_add'=>array('menu_type'=>'link','menu_name'=>'添加推荐商品','menu_url'=>'index.php?act=push_user_gift&op=tuijian_add'),
        );

        $menu_array[$menu_key]['menu_type'] = 'text';
        Tpl::output('menu',$menu_array);
    }


	
}
