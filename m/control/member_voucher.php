<?php
/**
 * 代金卷
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class member_voucherControl extends mobileMemberControl{

	public function __construct(){
		parent::__construct();
	}

    /**
     * 代金卷
     */
    public function voucher_listOp() {

        $model_voucher = Model('voucher');

        $_GET['voucher_state'] = $_GET['voucher_state']?$_GET['voucher_state']:1;

        $voucher_list = $model_voucher->getMemberVoucherList($_SESSION['member_id'], $_GET['voucher_state'], $this->page );

        Tpl::output('page',$model_voucher->showpage(88));

        // var_dump($voucher_list);
        Tpl::output('voucher_list',$voucher_list);

        Tpl::output('nav_title','我的优惠券');

        Tpl::output('html_title','我的优惠券 - 会员中心 - 收藏天下');

        Tpl::showpage('member_voucher.list');

    }


}
