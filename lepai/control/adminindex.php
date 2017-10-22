<?php
/**
 * 默认展示页面、用户管理、数据
 *
 *
 **by 多用户商城 www.abc.com 多用户商城 运营版*/


defined('InShopNC') or exit('Access Invalid!');
class adminIndexControl extends AdminControl{
	public function indexOp(){
		$model = Model();
		/*个人资料*/
		$where="member_id={$_SESSION['member_id']}";
		$result = $model->table('lepai_audit')->where($where)->find();
		/*累计成交额*/
		$where="store_member_id={$_SESSION['member_id']} AND order_state > '20'";
		$array['Money_Sum'] = $model->table('lepai_order')->field('sum(order_amount) as Money_Sum')->where($where)->find();
		/*累积专场数*/
		$where="T_Uid={$_SESSION['member_id']} AND T_Iswin = '1'";
		$array['Theme_Sum'] = $model->table('lepai_admin_theme')->field('count(*) as Theme_Sum')->where($where)->find();
		/*累计送拍数*/
		$where="G_Uid={$_SESSION['member_id']} AND (G_Atype = '3' OR G_Atype = '6')";
		$array['Goods_Sum'] = $model->table('lepai_admin_goods')->field('count(*) as Goods_Sum')->where($where)->find();
		/*累计成交数*/
		$where="store_member_id={$_SESSION['member_id']} AND order_state > '20'";
		$array['Goods_Sum_C'] = $model->table('lepai_order')->field('count(*) as Goods_Sum_C')->where($where)->find();
		/*订单通知*/
		$where="store_member_id={$_SESSION['member_id']} AND (order_state <> '40' OR order_state <> '0')";
		$array['Order_Sum'] = $model->table('lepai_order')->field('count(*) as Order_Sum')->where($where)->find();
		/*加载资料*/
		Tpl::output('result',$result);
		Tpl::output('userInfo',$array);
		Tpl::showpage('index');
	}

	/*ajax修改*/
	public function ajaxUpOp(){

		$model = Model();
		$where = "member_id={$_SESSION['member_id']}";
		/*联系人*/
		if(trim($_GET['contacts_name'])){
			$data['contacts_name'] = trim($_GET['contacts_name']);
		}
		/*email*/
		if(trim($_GET['contacts_email'])){
			$data['contacts_email'] = trim($_GET['contacts_email']);
		}
		/*联系电话*/
		if(trim($_GET['contacts_phone'])){
			$data['contacts_phone'] = trim($_GET['contacts_phone']);
		}
		/*机构地址*/
		if(trim($_GET['company_address'])){
			$data['company_address'] = trim($_GET['company_address']);
		}

		$model->table('lepai_audit')->where($where)->update($data);

	}

	
	
}
