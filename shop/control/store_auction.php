<?php
/**
 * 商家中心拍卖审核管理
 * author:
 * date:2015-10-29
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class store_auctionControl extends BaseSellerControl {

    public function __construct() {
        parent::__construct();
    }

    /**
     * 默认显示页面
     **/
    public function indexOp() {
        $this->auction_listOp();
    }

    
    /**
     * 拍卖申请
     **/
    public function auction_listOp() {
		//获取当前卖家的店铺信息
		$auction = Model('auction_joinin');
		$store_joinin = $auction->getStoreJoinin('member_id = '.$_SESSION['member_id'].'','*');
		Tpl::output('store_joinin',$store_joinin);
        Tpl::showpage('store_auction.show');
    }
	
	/**
     * 拍卖申请保存申请人信息
     **/
	public function auction_quota_add_saveOp(){
		$auction = Model('auction_joinin');
		$joinin_info = $auction->getStoreJoinin('member_id = '.$_SESSION['member_id'].'',"member_id,company_province_id,member_name,sc_name,company_name,company_address,company_address_detail,company_phone,contacts_name,contacts_phone,contacts_email");
		$result = $auction->addAuction($joinin_info);
		showDialog("添加成功",'index.php?act=store_auction','succ');
	}
}
