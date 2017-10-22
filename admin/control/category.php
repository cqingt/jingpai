<?php
/**
 * 交易管理
 *
 *
 *
 ***/

defined('InShopNC') or exit('Access Invalid!');
class categoryControl extends SystemControl{
    /**
     * 每次导出订单数量
     * @var int
     */
	const EXPORT_SIZE = 1000;


	public function __construct(){
		parent::__construct();
		Language::read('trade');
	}


	public function indexOp(){

		$model_goods_class = Model('goods_class');
		$model_order = Model('order');
        $condition	= array();


        // 所有商品类目
        $goods_class_list = $model_goods_class->getGoodsClassListAll();
        $class_list = array();
        foreach ($goods_class_list as $k => $v) {
        	$class_list[$v['gc_id']] = $v['gc_name'];
        }
        Tpl::output('class_list',$class_list);

		// 类目选择
		$choose_gcid = ($t = intval($_REQUEST['choose_gcid']))>0?$t:0;
        $gccache_arr = Model('goods_class')->getGoodsclassCache($choose_gcid,3);
	    Tpl::output('gc_json',json_encode($gccache_arr['showclass']));
		Tpl::output('gc_choose_json',json_encode($gccache_arr['choose_gcid']));

		// 时间选择
		$beginTime = strtotime(date('Y-m').'-1 00:00:01');
		$engTime = strtotime(date('Y-m').'-'.date('t').' 23:59:59');

		if($_GET['query_start_time'] && $_GET['query_end_time']){
			$beginTime = strtotime($_GET['query_start_time'].' 00:00:01');
			$engTime = strtotime($_GET['query_end_time'].' 23:59:59');
		}

		$condition['order.add_time'] = array('between',$beginTime.','.$engTime);

		// 订单状态选择
		if(in_array($_GET['order_state'],array('0','10','20','30','40'))){
        	$condition['order.order_state'] = $_GET['order_state'];
        }

        // 是否商城自主下单
		$condition['order.order_crm_add'] = 10;

		//自营店铺订单查询
		if($_GET['is_short'] == 1) {
			$store_where = "(is_own_shop = 1 or store_id = 22) AND store_is_shuhua_ = 0"; //店铺id 22 为众鑫藏品为自营店
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }

        //代运营店铺
		if($_GET['is_short'] == 3) {
			$store_where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 1"; //代运营店铺
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }

		//第三方店铺
		if($_GET['is_short'] == 2) {
			$store_where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 0"; //第三方订单查询
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }


        //店铺名
		if(!empty($_GET['store_name'])) {
			$condition_store['store_name'] = trim($_GET['store_name']);
			$store_info = Model('store')->getStoreInfo($condition_store);
			$condition['order.store_id'] = $store_info['store_id'];
        }


        // 类目
        if($_GET['search_gc']['0'] && $_GET['search_gc']['1']){
        	$condition['goods.gc_id_1'] = intval($_GET['search_gc']['0']);
        	$condition['goods.gc_id_2'] = intval($_GET['search_gc']['1']);
        	Tpl::output('search_gc_type',2);
        }elseif($_GET['search_gc']['0'] && !$_GET['search_gc']['1']){
        	$condition['goods.gc_id_1'] = intval($_GET['search_gc']['0']);
        	Tpl::output('search_gc_type',1);
        }

        $condition['order_goods.Is_Crm'] = '0';

		$field = 'order_goods.rec_id,
		order_goods.order_id,
		order_goods.goods_id,
		order_goods.goods_pay_price,
		order_goods.commis_rate,
		order_goods.gc_id,
		order.order_id,
		goods.goods_id,
		goods.gc_id_1,
		goods.gc_id_2,
		goods.gc_id_3,
		SUM(order_goods.goods_pay_price) as pay_num,
		SUM(order_goods.commis_rate*(order_goods.goods_pay_price/100)) as pay_commis_rate,
		count(distinct order.order_sn) as count_order';

		$page = 100;
		$order = 'goods.gc_id_1,goods.gc_id_2,order_goods.rec_id desc';

        $order_list	= $model_order->table('order_goods,order,goods')
        ->join('left')
        ->on('order_goods.order_id=order.order_id,order_goods.goods_id=goods.goods_id')
        ->where($condition)
        ->field($field)
        ->group('goods.gc_id_2')
        ->page($page)
        ->order($order)
        ->select();

        Tpl::output('order_list',$order_list);
        Tpl::output('page',$model_order->showpage('2'));
        Tpl::showpage('category.index');
	}

	public function leimuHuiKuanOp(){

		$model_goods_class = Model('goods_class');
		$model_order = Model('order');
        $condition	= array();


        // 所有商品类目
        $goods_class_list = $model_goods_class->getGoodsClassListAll();
        $class_list = array();
        foreach ($goods_class_list as $k => $v) {
        	$class_list[$v['gc_id']] = $v['gc_name'];
        }
        Tpl::output('class_list',$class_list);

		// 类目选择
		$choose_gcid = ($t = intval($_REQUEST['choose_gcid']))>0?$t:0;
        $gccache_arr = Model('goods_class')->getGoodsclassCache($choose_gcid,3);
	    Tpl::output('gc_json',json_encode($gccache_arr['showclass']));
		Tpl::output('gc_choose_json',json_encode($gccache_arr['choose_gcid']));

		// 时间选择
		$beginTime = strtotime(date('Y-m').'-1 00:00:01');
		$engTime = strtotime(date('Y-m').'-'.date('t').' 23:59:59');

		if($_GET['query_start_time'] && $_GET['query_end_time']){
			$beginTime = strtotime($_GET['query_start_time'].' 00:00:01');
			$engTime = strtotime($_GET['query_end_time'].' 23:59:59');
		}

		$condition['order.payment_time'] = array('between',$beginTime.','.$engTime);

		// 订单付款方式、默认不要货到付款
		$condition['order.payment_code'] = array('neq','offline');

		// 默认订单已付款
		$condition['order.order_state'] = array('egt','20');

		// 订单状态选择
		if(in_array($_GET['order_state'],array('0','10','20','30','40'))){
        	$condition['order.order_state'] = $_GET['order_state'];
        }

        // 是否商城自主下单
		$condition['order.order_crm_add'] = 10;

		//自营店铺订单查询
		if($_GET['is_short'] == 1) {
			$store_where = "(is_own_shop = 1 or store_id = 22) AND store_is_shuhua_ = 0"; //店铺id 22 为众鑫藏品为自营店
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }

        //代运营店铺
		if($_GET['is_short'] == 3) {
			$store_where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 1"; //代运营店铺
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }

		//第三方店铺
		if($_GET['is_short'] == 2) {
			$store_where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 0"; //第三方订单查询
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }


        //店铺名
		if(!empty($_GET['store_name'])) {
			$condition_store['store_name'] = trim($_GET['store_name']);
			$store_info = Model('store')->getStoreInfo($condition_store);
			$condition['order.store_id'] = $store_info['store_id'];
        }


        // 类目
        if($_GET['search_gc']['0'] && $_GET['search_gc']['1']){
        	$condition['goods.gc_id_1'] = intval($_GET['search_gc']['0']);
        	$condition['goods.gc_id_2'] = intval($_GET['search_gc']['1']);
        	Tpl::output('search_gc_type',2);
        }elseif($_GET['search_gc']['0'] && !$_GET['search_gc']['1']){
        	$condition['goods.gc_id_1'] = intval($_GET['search_gc']['0']);
        	Tpl::output('search_gc_type',1);
        }

        $condition['order_goods.Is_Crm'] = '0';

		$field = 'order_goods.rec_id,
		order_goods.order_id,
		order_goods.goods_id,
		order_goods.goods_pay_price,
		order_goods.commis_rate,
		order_goods.gc_id,
		order.order_id,
		goods.goods_id,
		goods.gc_id_1,
		goods.gc_id_2,
		goods.gc_id_3,
		SUM(order_goods.goods_pay_price) as pay_num,
		SUM(order_goods.commis_rate*(order_goods.goods_pay_price/100)) as pay_commis_rate,
		count(distinct order.order_sn) as count_order';

		$page = 100;
		$order = 'goods.gc_id_1,goods.gc_id_2,order_goods.rec_id desc';

        $order_list	= $model_order->table('order_goods,order,goods')
        ->join('left')
        ->on('order_goods.order_id=order.order_id,order_goods.goods_id=goods.goods_id')
        ->where($condition)
        ->field($field)
        ->group('goods.gc_id_2')
        ->page($page)
        ->order($order)
        ->select();

        Tpl::output('order_list',$order_list);

        $condition['order.payment_time'] = '';

        $condition['order.finnshed_time'] = array('between',$beginTime.','.$engTime);
		// 订单付款方式、默认不要货到付款
		$condition['order.payment_code'] = array('eq','offline');

		unset($condition['order.payment_time']);

		$order_list_offline	= $model_order->table('order_goods,order,goods')
        ->join('left')
        ->on('order_goods.order_id=order.order_id,order_goods.goods_id=goods.goods_id')
        ->where($condition)
        ->field($field)
        ->group('goods.gc_id_2')
        ->page($page)
        ->order($order)
        ->select();


        Tpl::output('order_list_offline',$order_list_offline);

        Tpl::output('page',$model_order->showpage('2'));
        Tpl::showpage('category.leimu.huikuan');
	}




	public function shopCountOp(){

		$model_goods_class = Model('goods_class');
		$model_order = Model('order');
        $condition	= array();

        // 类目选择
		$choose_gcid = ($t = intval($_REQUEST['choose_gcid']))>0?$t:0;
        $gccache_arr = Model('goods_class')->getGoodsclassCache($choose_gcid,3);
	    Tpl::output('gc_json',json_encode($gccache_arr['showclass']));
		Tpl::output('gc_choose_json',json_encode($gccache_arr['choose_gcid']));

		//自营店铺订单查询
		if($_GET['is_short'] == 1) {
			$store_where = "(is_own_shop = 1 or store_id = 22) AND store_is_shuhua_ = 0"; //店铺id 22 为众鑫藏品为自营店
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }

        //代运营店铺
		if($_GET['is_short'] == 3) {
			$store_where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 1"; //代运营店铺
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }

		//第三方店铺
		if($_GET['is_short'] == 2) {
			$store_where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 0"; //第三方订单查询
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }

        //店铺名
		if(!empty($_GET['store_name'])) {
			$condition_store['store_name'] = trim($_GET['store_name']);
			$store_info = Model('store')->getStoreInfo($condition_store);
			$condition['order.store_id'] = $store_info['store_id'];
        }

        // 时间选择
		$beginTime = strtotime(date('Y-m').'-1 00:00:01');
		$engTime = strtotime(date('Y-m').'-'.date('t').' 23:59:59');

		if($_GET['query_start_time'] && $_GET['query_end_time']){
			$beginTime = strtotime($_GET['query_start_time'].' 00:00:01');
			$engTime = strtotime($_GET['query_end_time'].' 23:59:59');
		}

		$condition['order.add_time'] = array('between',$beginTime.','.$engTime);

		// 订单状态选择
		if(in_array($_GET['order_state'],array('0','10','20','30','40'))){
        	$condition['order.order_state'] = $_GET['order_state'];
        }

        // 类目
        if($_GET['search_gc']['0'] && $_GET['search_gc']['1']){
        	$condition['goods.gc_id_1'] = intval($_GET['search_gc']['0']);
        	$condition['goods.gc_id_2'] = intval($_GET['search_gc']['1']);
        	Tpl::output('search_gc_type',2);
        	Tpl::output('gc_id_1',$condition['goods.gc_id_1']);
        }elseif($_GET['search_gc']['0'] && !$_GET['search_gc']['1']){
        	$condition['goods.gc_id_1'] = intval($_GET['search_gc']['0']);
        	Tpl::output('search_gc_type',1);
        	Tpl::output('gc_id_1',$condition['goods.gc_id_1']);
        }

        // 是否商城自主下单
		$condition['order.order_crm_add'] = 10;

		// 默认团购
		$condition['order_goods.goods_type'] = 2;

        // 订单商品是否CRM添加
        $condition['order_goods.Is_Crm'] = '0';

		$field = 'order_goods.rec_id,
		order_goods.order_id,
		order_goods.goods_id,
		order_goods.goods_pay_price,
		order_goods.commis_rate,
		order_goods.gc_id,
		order.order_id,
		goods.gc_id_1,
		goods.gc_id_2,
		SUM(order_goods.goods_pay_price) as pay_num,
		SUM(order_goods.commis_rate*(order_goods.goods_pay_price/100)) as pay_commis_rate,
		count(distinct order.order_sn) as count_order';

		$page = 100;
		$order = 'order_goods.rec_id desc';

        $order_list	= $model_order->table('order_goods,order,goods')
        ->join('left')
        ->on('order_goods.order_id=order.order_id,order_goods.goods_id=goods.goods_id')
        ->where($condition)
        ->field($field)
        ->page($page)
        ->order($order)
        ->select();

        Tpl::output('tuangou_list',reset($order_list));

        // 秒杀
        $condition['order_goods.goods_type'] = 6;

        $order_list_miaosha	= $model_order->table('order_goods,order,goods')
        ->join('left')
        ->on('order_goods.order_id=order.order_id,order_goods.goods_id=goods.goods_id')
        ->where($condition)
        ->field($field)
        ->page($page)
        ->order($order)
        ->select();
        

        Tpl::output('miaosha_list',reset($order_list_miaosha));

        // Tpl::output('page',$model_order->showpage('2'));
        Tpl::showpage('category.shop.count');
	}



	public function shopHuikuanOp(){

		$model_goods_class = Model('goods_class');
		$model_order = Model('order');
        $condition	= array();

        // 类目选择
		$choose_gcid = ($t = intval($_REQUEST['choose_gcid']))>0?$t:0;
        $gccache_arr = Model('goods_class')->getGoodsclassCache($choose_gcid,3);
	    Tpl::output('gc_json',json_encode($gccache_arr['showclass']));
		Tpl::output('gc_choose_json',json_encode($gccache_arr['choose_gcid']));

		//自营店铺订单查询
		if($_GET['is_short'] == 1) {
			$store_where = "(is_own_shop = 1 or store_id = 22) AND store_is_shuhua_ = 0"; //店铺id 22 为众鑫藏品为自营店
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }

        //代运营店铺
		if($_GET['is_short'] == 3) {
			$store_where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 1"; //代运营店铺
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }

		//第三方店铺
		if($_GET['is_short'] == 2) {
			$store_where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 0"; //第三方订单查询
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }

        //店铺名
		if(!empty($_GET['store_name'])) {
			$condition_store['store_name'] = trim($_GET['store_name']);
			$store_info = Model('store')->getStoreInfo($condition_store);
			$condition['order.store_id'] = $store_info['store_id'];
        }

        // 时间选择
		$beginTime = strtotime(date('Y-m').'-1 00:00:01');
		$engTime = strtotime(date('Y-m').'-'.date('t').' 23:59:59');

		if($_GET['query_start_time'] && $_GET['query_end_time']){
			$beginTime = strtotime($_GET['query_start_time'].' 00:00:01');
			$engTime = strtotime($_GET['query_end_time'].' 23:59:59');
		}

		$condition['order.payment_time'] = array('between',$beginTime.','.$engTime);

		// 订单状态选择
		if(in_array($_GET['order_state'],array('0','10','20','30','40'))){
        	$condition['order.order_state'] = $_GET['order_state'];
        }

        // 类目
        if($_GET['search_gc']['0'] && $_GET['search_gc']['1']){
        	$condition['goods.gc_id_1'] = intval($_GET['search_gc']['0']);
        	$condition['goods.gc_id_2'] = intval($_GET['search_gc']['1']);
        	Tpl::output('search_gc_type',2);
        	Tpl::output('gc_id_1',$condition['goods.gc_id_1']);
        }elseif($_GET['search_gc']['0'] && !$_GET['search_gc']['1']){
        	$condition['goods.gc_id_1'] = intval($_GET['search_gc']['0']);
        	Tpl::output('search_gc_type',1);
        	Tpl::output('gc_id_1',$condition['goods.gc_id_1']);
        }

        // 是否商城自主下单
		$condition['order.order_crm_add'] = 10;

		// 默认团购
		$condition['order_goods.goods_type'] = 2;

        // 订单商品是否CRM添加
        $condition['order_goods.Is_Crm'] = '0';

        // 默认订单已付款
		$condition['order.order_state'] = array('egt','20');

		$field = 'order_goods.rec_id,
		order_goods.order_id,
		order_goods.goods_id,
		order_goods.goods_pay_price,
		order_goods.commis_rate,
		order_goods.gc_id,
		order.order_id,
		goods.gc_id_1,
		goods.gc_id_2,
		SUM(order_goods.goods_pay_price) as pay_num,
		SUM(order_goods.commis_rate*(order_goods.goods_pay_price/100)) as pay_commis_rate,
		count(distinct order.order_sn) as count_order';

		$page = 100;
		$order = 'order_goods.rec_id desc';

        $order_list	= $model_order->table('order_goods,order,goods')
        ->join('left')
        ->on('order_goods.order_id=order.order_id,order_goods.goods_id=goods.goods_id')
        ->where($condition)
        ->field($field)
        ->page($page)
        ->order($order)
        ->select();


        Tpl::output('tuangou_list',reset($order_list));

        // 秒杀
        $condition['order_goods.goods_type'] = 6;

        $order_list_miaosha	= $model_order->table('order_goods,order,goods')
        ->join('left')
        ->on('order_goods.order_id=order.order_id,order_goods.goods_id=goods.goods_id')
        ->where($condition)
        ->field($field)
        ->page($page)
        ->order($order)
        ->select();
        

        Tpl::output('miaosha_list',reset($order_list_miaosha));

        // Tpl::output('page',$model_order->showpage('2'));
        Tpl::showpage('category.shop.huikuan');
	}





	public function shopCountInfoOp(){

		$model_goods_class = Model('goods_class');
		$model_order = Model('order');
        $condition	= array();

        // 所有店铺名称
        $sotre_list = Model('store')->getStoreList('',null,'','store_id,store_name','5000');
        $sotre_list_array = array();
        foreach ($sotre_list as $k => $v) {
        	$sotre_list_array[$v['store_id']] = $v['store_name'];
        }

        Tpl::output('sotre_list_array',$sotre_list_array);

		//自营店铺订单查询
		if($_GET['is_short'] == 1) {
			$store_where = "(is_own_shop = 1 or store_id = 22) AND store_is_shuhua_ = 0"; //店铺id 22 为众鑫藏品为自营店
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }

        //代运营店铺
		if($_GET['is_short'] == 3) {
			$store_where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 1"; //代运营店铺
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }

		//第三方店铺
		if($_GET['is_short'] == 2) {
			$store_where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 0"; //第三方订单查询
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }

        //店铺名
		if(!empty($_GET['store_name'])) {
			$condition_store['store_name'] = trim($_GET['store_name']);
			$store_info = Model('store')->getStoreInfo($condition_store);
			$condition['order.store_id'] = $store_info['store_id'];
        }

        // 时间选择
		$beginTime = strtotime(date('Y-m').'-1 00:00:01');
		$engTime = strtotime(date('Y-m').'-'.date('t').' 23:59:59');

		if($_GET['query_start_time'] && $_GET['query_end_time']){
			$beginTime = strtotime($_GET['query_start_time'].' 00:00:01');
			$engTime = strtotime($_GET['query_end_time'].' 23:59:59');
		}

		$condition['order.payment_time'] = array('between',$beginTime.','.$engTime);

		// 订单状态选择
		if(in_array($_GET['order_state'],array('0','10','20','30','40'))){
        	$condition['order.order_state'] = $_GET['order_state'];
        }

        // 分类
        if($_GET['gc_id_1']){
		    $condition['goods.gc_id_1'] = intval($_GET['gc_id_1']);
		}

        // 是否商城自主下单
		$condition['order.order_crm_add'] = 10;

		// 默认团购
		$condition['order_goods.goods_type'] = 2;

		if($_GET['class_type'] == 2){
			// 默认团购
			$condition['order_goods.goods_type'] = 6;
		}

		if($_GET['hui'] == 1){
			// 默认订单已付款
			$condition['order.order_state'] = array('egt','20');
		}

        // 订单商品是否CRM添加
        $condition['order_goods.Is_Crm'] = '0';

		$field = 'order_goods.rec_id,
		order_goods.order_id,
		order_goods.goods_id,
		order_goods.goods_name,
		order_goods.goods_pay_price,
		order_goods.commis_rate,
		order_goods.gc_id,
		order.store_id,
		order.order_sn,
		order.add_time,
		order.finnshed_time,
		order.order_state';

		$page = 100;
		$order = 'order_goods.rec_id desc';

		if($_GET['exportExcel']){
        	$page = 5000;
        }


        $order_list	= $model_order->table('order_goods,order,goods')
        ->join('left')
        ->on('order_goods.order_id=order.order_id,order_goods.goods_id=goods.goods_id')
        ->where($condition)
        ->field($field)
        ->page($page)
        ->order($order)
        ->select();

        if($_GET['exportExcel']){


        	$this->DaoChu_Export("file"); //设置导出格式
			$str = '<table class="table" width="60%" border="0" cellspacing="1" cellpadding="0">';
	        $str .= '<tr>
	        <td>商品名称</td>
	        <td>订单号</td>
	        <td>下单时间</td>
	        <td>完成时间</td>
	        <td>订单金额</td>
	        <td>佣金</td>
	        <td>订单状态</td>
	        <td>所属店铺</td>
	        </tr>';



			if($order_list){
				foreach($order_list as $k=>$v){

					switch ($v['order_state']) {
		              case '0':
		                $order_state = '已取消';
		                break;
		              case '10':
		                $order_state = '未付款';
		                break;
		              case '20':
		                $order_state = '已付款';
		                break;
		              case '30':
		                $order_state = '已发货';
		                break;
		              case '40':
		                $order_state = '已收货';
		                break;
		            }

					$str .= '<tr>
					<td>&nbsp;'.$v['goods_name'].'</td>
					<td>&nbsp;'.$v['order_sn'].'</td>
					<td>&nbsp;'.date('Y-m-d',$v['add_time']).'</td>
					<td>&nbsp;'.date('Y-m-d',$v['finnshed_time']).'</td>
					<td>&nbsp;'.$v['goods_pay_price'].'</td>
					<td>&nbsp;'.$v['goods_pay_price']*($v['commis_rate']/100).'</td>
					<td>&nbsp;'.$order_state.'</td>
					<td>&nbsp;'.$sotre_list_array[$v['store_id']].'</td>
					</tr>';
				}
			}
			$str .='</table>';
	        echo $str;

	        exit;
        }else{

	        Tpl::output('order_list',$order_list);
	        Tpl::output('page',$model_order->showpage('2'));
	        Tpl::showpage('category.shopcount.info');

    	}
	}

















	public function infoOp(){

		$model_goods_class = Model('goods_class');
		$model_order = Model('order');
        $condition	= array();

        $goods_class_list = $model_goods_class->getGoodsClassListAll();
        $class_list = array();
        foreach ($goods_class_list as $k => $v) {
        	$class_list[$v['gc_id']] = $v['gc_name'];
        }
        Tpl::output('class_list',$class_list);


        // 所有店铺名称
        $sotre_list = Model('store')->getStoreList('',null,'','store_id,store_name','5000');
        $sotre_list_array = array();
        foreach ($sotre_list as $k => $v) {
        	$sotre_list_array[$v['store_id']] = $v['store_name'];
        }

        Tpl::output('sotre_list_array',$sotre_list_array);


        // 商城下单
        $condition['order.order_crm_add'] = 10;

        // 分类
		switch (intval($_GET['type'])) {
			case '1':
				if($_GET['gc_id_1']){
		        	$condition['goods.gc_id_1'] = intval($_GET['gc_id_1']);
		        }
				break;

			case '2':
				if($_GET['gc_id_1'] && $_GET['gc_id_2']){
		        	$condition['goods.gc_id_2'] = intval($_GET['gc_id_2']);
		        }
				break;
		}

		// 时间选择
		$beginTime = strtotime(date('Y-m').'-1 00:00:01');
		$engTime = strtotime(date('Y-m').'-'.date('t').' 23:59:59');

		if($_GET['query_start_time'] && $_GET['query_end_time']){
			$beginTime = strtotime($_GET['query_start_time'].' 00:00:01');
			$engTime = strtotime($_GET['query_end_time'].' 23:59:59');
		}

		$condition['order.add_time'] = array('between',$beginTime.','.$engTime);


		// 订单状态
		if(in_array($_GET['order_state'],array('0','10','20','30','40'))){
        	$condition['order.order_state'] = $_GET['order_state'];
        }


        //自营店铺订单查询
		if($_GET['is_short'] == 1) {
			$store_where = "(is_own_shop = 1 or store_id = 22) AND store_is_shuhua_ = 0"; //店铺id 22 为众鑫藏品为自营店
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }

        //代运营店铺
		if($_GET['is_short'] == 3) {
			$store_where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 1"; //代运营店铺
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }

		//第三方店铺
		if($_GET['is_short'] == 2) {
			$store_where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 0"; //第三方订单查询
			$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
			if($StoreList){
				$store = array();
				foreach($StoreList as $k=>$v){
					$store[] = $v['store_id'];
				}
				$condition['order.store_id'] = array('in',$store);
			}
        }


        //店铺名
		if(!empty($_GET['store_name'])) {
			$condition_store['store_name'] = trim($_GET['store_name']);
			$store_info = Model('store')->getStoreInfo($condition_store);
			$condition['order.store_id'] = $store_info['store_id'];
        }

        $condition['order_goods.Is_Crm'] = '0';


		$field = 'order_goods.rec_id,
		order_goods.order_id,
		order_goods.goods_id as order_goods_id,
		order_goods.goods_name,
		order_goods.goods_pay_price,
		order_goods.commis_rate,
		order_goods.gc_id,
		order.store_id,
		order.order_sn,
		order.add_time,
		order.finnshed_time,
		order.order_state,
		goods.goods_id,
		if(goods.gc_id_1,goods.gc_id_1,0) as gc_id_1,
		if(goods.gc_id_2,goods.gc_id_2,0) as gc_id_2,
		if(goods.gc_id_3,goods.gc_id_3,0) as gc_id_3';

		$page = 100;
		$order = 'goods.gc_id_1,order_goods.rec_id desc';


		if($_GET['hui'] == 1){

        	// 默认订单已付款
			$condition['order.order_state'] = array('egt','20');

			unset($condition['order.add_time']);

			if($_GET['class_type'] == 1){

				$condition['order.payment_time'] = array('between',$beginTime.','.$engTime);
				$condition['order.payment_code'] = array('neq','offline');
			}elseif($_GET['class_type'] == 2){
				$condition['order.finnshed_time'] = array('between',$beginTime.','.$engTime);
				// 订单付款方式、默认不要货到付款
				$condition['order.payment_code'] = array('eq','offline');
			}

        }

        if(empty($_GET['gc_id_1']) && empty($_GET['gc_id_2'])){
        	$having = 'gc_id_1<1';
        }elseif(!empty($_GET['gc_id_1']) && empty($_GET['gc_id_2'])){
        	$field = 'order_goods.rec_id,
			order_goods.order_id,
			order_goods.goods_id as order_goods_id,
			order_goods.goods_name,
			order_goods.goods_pay_price,
			order_goods.commis_rate,
			order_goods.gc_id,
			order.store_id,
			order.order_sn,
			order.add_time,
			order.finnshed_time,
			order.order_state,
			goods.goods_id,
			goods.gc_id_1,
			goods.gc_id_2,
			goods.gc_id_3';
        	$having = 'gc_id_2<1';
        }

        if($_GET['exportExcel']){
        	$page = 5000;
        }

        $order_list	= $model_order->table('order_goods,order,goods')
        ->join('left')
        ->on('order_goods.order_id=order.order_id,order_goods.goods_id=goods.goods_id')
        ->where($condition)
        ->field($field)
        ->page($page)
        ->order($order)
        ->having($having)
        ->select();


        if($_GET['exportExcel']){

        	$this->DaoChu_Export("file"); //设置导出格式
			$str = '<table class="table" width="60%" border="0" cellspacing="1" cellpadding="0">';
	        $str .= '<tr>
	        <td>商品名称</td>
	        <td>商品类目（二级）</td>
	        <td>订单号</td>
	        <td>下单时间</td>
	        <td>完成时间</td>
	        <td>订单金额</td>
	        <td>佣金</td>
	        <td>订单状态</td>
	        <td>所属店铺</td>
	        </tr>';



			if($order_list){
				foreach($order_list as $k=>$v){

					switch ($v['order_state']) {
		              case '0':
		                $order_state = '已取消';
		                break;
		              case '10':
		                $order_state = '未付款';
		                break;
		              case '20':
		                $order_state = '已付款';
		                break;
		              case '30':
		                $order_state = '已发货';
		                break;
		              case '40':
		                $order_state = '已收货';
		                break;
		            }

					$str .= '<tr>
					<td>&nbsp;'.$v['goods_name'].'</td>
					<td>&nbsp;'.$class_list[$v['gc_id_1']].' > '.$class_list[$v['gc_id_2']].'</td>
					<td>&nbsp;'.$v['order_sn'].'</td>
					<td>&nbsp;'.($v['add_time']?date('Y-m-d',$v['add_time']):'').'</td>
					<td>&nbsp;'.($v['finnshed_time']?date('Y-m-d',$v['finnshed_time']):'').'</td>
					<td>&nbsp;'.$v['goods_pay_price'].'</td>
					<td>&nbsp;'.$v['goods_pay_price']*($v['commis_rate']/100).'</td>
					<td>&nbsp;'.$order_state.'</td>
					<td>&nbsp;'.$sotre_list_array[$v['store_id']].'</td>
					</tr>';
				}
			}
			$str .='</table>';
	        echo $str;

	        exit;
        }else{
        	Tpl::output('order_list',$order_list);
        	Tpl::output('page',$model_order->showpage('2'));
        	Tpl::showpage('category.info');
        }
	}



	public function DaoChu_Export($filename){
		header("Content-type: application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment; filename=$filename.xls");
		echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"
		xmlns:x="urn:schemas-microsoft-com:office:excel"
		xmlns="http://www.w3.org/TR/REC-html40">
		<head>
		<meta http-equiv="expires" content="Mon, 06 Jan 1999 00:00:01 GMT">
		<meta http-equiv=Content-Type content="text/html; charset=utf-8">
		<!--[if gte mso 9]><xml>
		<x:ExcelWorkbook>
		<x:ExcelWorksheets>
		<x:ExcelWorksheet>
		<x:Name></x:Name>
		<x:WorksheetOptions>
		<x:DisplayGridlines/>
		</x:WorksheetOptions>
		</x:ExcelWorksheet>
		</x:ExcelWorksheets>
		</x:ExcelWorkbook>
		</xml><![endif]-->
		</head>';
	}









}