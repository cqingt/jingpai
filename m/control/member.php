<?php
/**
 * 会员中心——账户概览
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class memberControl extends mobileMemberControl{

	public function __construct(){
		parent::__construct();
	}

    /**
     * 我的商城
     */
    public function homeOp() {


        Tpl::output('nav_title','会员中心');

        Tpl::output('html_title','会员中心 - 尾品竞拍');

        Tpl::showpage('member');
    }


}
