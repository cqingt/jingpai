<?php
/**
 * 卖家账号管理
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');
class store_apiControl extends BaseSellerControl {
    public function __construct() {
        parent::__construct();
        Language::read('member_store_index');
    }

    public function indexOp() {
        $model_store = Model('store');
        $storeOneInfo = $model_store->getStoreInfoByID($_SESSION['store_id']);

        if($storeOneInfo['store_is_appkey'] == 22){
            $storeAppKeyInfo = $model_store->table('store_app_key')->where(array('K_StoreId'=>$_SESSION['store_id']))->find();
            Tpl::output('storeAppKeyInfo', $storeAppKeyInfo);
        }

        Tpl::output('storeOneInfo', $storeOneInfo);
        $this->profile_menu('sotre_api');
        Tpl::showpage('store_api.list');
    }


    /* 添加API */
    public function api_addOp(){

        list($appid,$appkey) = $this->storeAppKey($_SESSION['store_id'],$_SESSION['member_id']);

        $keyArr['K_StoreId'] = $_SESSION['store_id'];
        $keyArr['K_AppId'] = $appid;
        $keyArr['K_Key'] = $appkey;
        $keyArr['K_Time'] = time();

        $model = Model();

        if($model->table('store_app_key')->where(array('K_StoreId'=>$_SESSION['store_id']))->find()){
            showMessage('您已申请过、请勿重复申请！');
        }else{
            if($model->table('store_app_key')->insert($keyArr)){
                Model('store')->editStore(array('store_is_appkey'=>11),array('store_id'=>$_SESSION['store_id']));
                showMessage('提交成功');
            }else{
                showMessage('申请失败');
            }
        }

    }

    private function storeAppKey($storeid,$memberid){

        // $sum =  mt_rand(1111,9999).((($storeid+$memberid)*96567) + (($storeid.$memberid)*96567)).($storeid*$memberid);

        // $AppId = substr($sum,0,10);

        // $md5Store = md5(md5($storeid).md5($memberid));

        // $AppKey = md5(substr($md5Store,16,16).md5($storeid).md5($memberid));

        // return array($AppId,$AppKey);


        $AppId =  '1' . sprintf('%09d',($storeid.$memberid)+96567);

        $md5Store = md5(md5($storeid).md5($memberid));

        $AppKey = md5(substr($md5Store,16,16).md5($storeid).md5($memberid));

        return array($AppId,$AppKey);
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string 	$menu_key	当前导航的menu_key
     * @return
     */
    private function profile_menu($menu_key = '') {
        $menu_array = array();

        $menu_array[] = array(
            'menu_key'=>'sotre_api',
            'menu_name' => 'API管理',
            'menu_url' => urlShop('store_api', 'index')
        );
        
        Tpl::output('member_menu', $menu_array);
        Tpl::output('menu_key', $menu_key);
    }

}
