<?php
/**
 * 手机首页
 *
 *
 *
 * by 33hao.com 好商城V3 运营版
 */


defined('InShopNC') or exit('Access Invalid!');
class textControl extends mobileHomeControl{

	public function __construct() {
        parent::__construct();
    }

    /**
     * 首页
     */
	public function indexOp() {

        Tpl::showpage('text_html');
	}




}
