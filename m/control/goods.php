<?php
/**
 * 商品
 */

defined('InShopNC') or exit('Access Invalid!');
class goodsControl extends mobileHomeControl{

    //模型对象
    private $_model_search;

	public function __construct() {
        parent::__construct();
    }

    public function indexOp() {
        $this->goods_detailOp();
    }

    public function index_testOp() {
        $this->goods_detail_testOp();
    }

    /**
     * 商品列表
     */
    public function goods_listOp() {
        $model_goods = Model('goods');
        $model_search = $this->_model_search = Model('search');

        //二级分类ID
        $default_classid = intval($_GET['cate_id']);

        if (intval($_GET['cate_id']) > 0) {
            $goods_class_array = $this->_model_search->getLeftCategory(array($_GET['cate_id']));
        } elseif ($_GET['keyword'] != '') {
            //从TAG中查找分类
            $goods_class_array = $this->_model_search->getTagCategory($_GET['keyword']);
            //取出第一个分类作为默认分类，从而显示相应的属性和品牌
            $default_classid = $goods_class_array[0];
            $goods_class_array = $this->_model_search->getLeftCategory($goods_class_array, 1);;
        }

        $goods_class_array = @array_shift($goods_class_array);

        //筛选分类
        Tpl::output('goods_class_array',$goods_class_array);
        Tpl::output('default_classid', $default_classid);

        //优先从全文索引库里查找
        list($indexer_ids,$indexer_count) = $this->_model_search->indexerSearch($_GET,$this->page);

        //获得经过属性过滤的商品信息
        list($goods_param, $brand_array, $attr_array, $checked_brand, $checked_attr) = $this->_model_search->getAttr($_GET, $default_classid);

        if(!empty($checked_attr)){
        foreach ($checked_attr as $k => $v) {
            unset($attr_array[$k]);
        }
        }

        Tpl::output('brand_array', $brand_array);
        Tpl::output('attr_array', $attr_array);
        Tpl::output('checked_brand', $checked_brand);
        Tpl::output('checked_attr', $checked_attr);

        //处理排序
        $order = 'goods_id desc';
        if (in_array($_GET['key'],array('1','2','3'))) {
            $sequence = $_GET['order'] == '1' ? 'asc' : 'desc';
            $order = str_replace(array('1','2','3'), array('goods_salenum','goods_click','goods_price'), $_GET['key']);
            $order .= ' '.$sequence;
        }

        //所需字段
        $fields = "goods_id,goods_commonid,store_id,goods_name,goods_price,goods_marketprice,goods_image,goods_salenum,evaluation_good_star,evaluation_count,store_name";

        // 添加3个状态字段
        $fields .= ',is_virtual,is_presell,is_fcode,have_gift';

        $condition = array();
		if($_GET['type'] == 'ShuHua'){
			Tpl::output('no_footer',true);//
			//艺术家官网
			Tpl::output('IsShuHua',true);
			$condition['store_id'] = 22;

		}
        if (is_array($indexer_ids)) {

            //商品主键搜索
            $condition['goods_id'] = array('in',$indexer_ids);
            $goods_list = $model_goods->getGoodsOnlineList($condition, $fields, 0, $order, $this->page, null, false);

            //如果有商品下架等情况，则删除下架商品的搜索索引信息
            if (count($goods_list) != count($indexer_ids)) {
                $this->_model_search->delInvalidGoods($goods_list, $indexer_ids);
            }

            pagecmd('setEachNum',$this->page);
            pagecmd('setTotalNum',$indexer_count);

        } else {


            //执行正常搜索
            if (isset($goods_param['class'])) {     //一级分类
                $condition['gc_id_'.$goods_param['class']['depth']] = $goods_param['class']['gc_id'];
            }
            if (intval($_GET['b_id']) > 0) {        //品牌ID
                $condition['brand_id'] = intval($_GET['b_id']);
            }
            if ($_GET['keyword'] != '') {
                $condition['_zidingyi'] = " ( goods_name like '%".$_GET['keyword']."%' OR goods_keywords like '%".$_GET['keyword']."%' OR goods_serial = '".$_GET['keyword']."' OR store_name like '%".$_GET['keyword']."%') AND";
            }
            if (intval($_GET['area_id']) > 0) {     //一级地区
                $condition['areaid_1'] = intval($_GET['area_id']);
            }
            if ($_GET['type'] == 1) {               //是否为自营平台
                $condition['is_own_shop'] = 1;
            }
            if ($_GET['gift'] == 1) {
                $condition['have_gift'] = 1;        //是否拥有赠品
            }
            if (isset($goods_param['goodsid_array'])){
                $condition['goods_id'] = array('in', $goods_param['goodsid_array']);
            }

            $goods_list = $model_goods->getGoodsListByColorDistinct($condition, $fields, $order, $this->page);

        }

        //处理商品列表(抢购、限时折扣、商品图片)
        $goods_list = $this->_goods_list_extend($goods_list);

        Tpl::output('show_page', $model_goods->showpage(88));
        Tpl::output('goods_list',$goods_list);

        Tpl::output('nav_title','商品列表');

        if ($_GET['keyword'] == '') {
            $seo_class_name = $goods_param['class']['gc_name'];
            if (is_numeric($_GET['cate_id']) && empty($_GET['keyword'])) {
                $seo_info = Model('goods_class')->getKeyWords(intval($_GET['cate_id']));
                if (empty($seo_info[1])) {
                    $seo_info[1] = C('site_name') . ' - ' . $seo_class_name;
                }
                Model('seo')->type($seo_info)->param(array('name' => $seo_class_name))->show();
            }
        } elseif ($_GET['keyword'] != '') {
            Tpl::output('html_title', (empty($_GET['keyword']) ? '' : $_GET['keyword'] . ' - ')  . L('nc_common_search').' - '.C('site_name'));
        }

        /*if($_GET['keyword'] != ''){
            Tpl::output('html_title',$_GET['keyword'].' - 商品搜索列表 - '.C('site_name'));
        }else{
            Tpl::output('html_title','商品列表 - '.C('site_name'));
        }
        Tpl::output('seo_keywords','拍卖惠,收藏天下拍卖惠,收藏品拍卖,书画拍卖,0元拍卖');
        Tpl::output('seo_description','收藏天下拍卖惠频道为您提供各种收藏品拍卖服务，收藏品0元起拍，正品底价，让您低价体会到收藏品网上拍卖的乐趣，非常值得参与体验的收藏品拍卖活动。');*/
		
		Tpl::showpage('goods_list');
		
    }

    /**
     * 商品列表排序方式
     */
    private function _goods_list_order($key, $order) {
        $result = 'is_own_shop desc,goods_id desc';
        if (!empty($key)) {

            $sequence = 'desc';
            if($order == 1) {
                $sequence = 'asc';
            }

            switch ($key) {
                //销量
                case '1' :
                    $result = 'goods_salenum' . ' ' . $sequence;
                    break;
                //浏览量
                case '2' :
                    $result = 'goods_click' . ' ' . $sequence;
                    break;
                //价格
                case '3' :
                    $result = 'goods_price' . ' ' . $sequence;
                    break;
            }
        }
        return $result;
    }

    /**
     * 处理商品列表(抢购、限时折扣、商品图片)
     */
    private function _goods_list_extend($goods_list) {
        //获取商品列表编号数组
        $commonid_array = array();
        $goodsid_array = array();
        foreach($goods_list as $key => $value) {
            $commonid_array[] = $value['goods_commonid'];
            $goodsid_array[] = $value['goods_id'];
        }

        //促销
        $groupbuy_list = Model('groupbuy')->getGroupbuyListByGoodsIDString(implode(',', $goodsid_array));
        $xianshi_list = Model('p_xianshi_goods')->getXianshiGoodsListByGoodsString(implode(',', $goodsid_array));
        foreach ($goods_list as $key => $value) {
            //抢购
            if (isset($groupbuy_list[$value['goods_id']])) {
                $goods_list[$key]['goods_price'] = $groupbuy_list[$value['goods_id']]['groupbuy_price'];
                $goods_list[$key]['group_flag'] = true;
            } else {
                $goods_list[$key]['group_flag'] = false;
            }

            //限时折扣
            if (isset($xianshi_list[$value['goods_id']]) && !$goods_list[$key]['group_flag']) {
                $goods_list[$key]['goods_price'] = $xianshi_list[$value['goods_id']]['xianshi_price'];
                $goods_list[$key]['xianshi_flag'] = true;
            } else {
                $goods_list[$key]['xianshi_flag'] = false;
            }

            //商品图片url
            $goods_list[$key]['goods_image_url'] = cthumb($value['goods_image'], 360, $value['store_id']);

            unset($goods_list[$key]['store_id']);
            unset($goods_list[$key]['goods_commonid']);
            unset($goods_list[$key]['nc_distinct']);
        }

        return $goods_list;
    }

    /**
     * 商品详细页
     */
    public function goods_detailOp() {
        $goods_id = intval($_GET ['goods_id']);

        // 商品详细信息
        $model_goods = Model('goods');
        $goods_detail = $model_goods->getGoodsDetail($goods_id);
        if (empty($goods_detail)) {
            output_error('商品不存在');
        }

        //推荐商品
        $model_store = Model('store');
        $hot_sales = $model_store->getHotSalesList($goods_detail['goods_info']['store_id'], 6);
        $goods_commend_list = array();
        foreach($hot_sales as $value) {
            $goods_commend = array();
            $goods_commend['goods_id'] = $value['goods_id'];
            $goods_commend['goods_name'] = $value['goods_name'];
            $goods_commend['goods_price'] = $value['goods_price'];
            $goods_commend['goods_image_url'] = cthumb($value['goods_image'], 240);
            $goods_commend_list[] = $goods_commend;
        }
        $goods_detail['goods_commend_list'] = $goods_commend_list;
        $store_info = $model_store->getStoreInfoByID($goods_detail['goods_info']['store_id']);
        if (empty($store_info['store_state']) || $store_info['store_state'] == 2) {
            showWapMessage('该店铺审核中或已关闭','','error');
        }
		$goods_detail['store_info']['is_own_shop'] = $store_info['is_own_shop'];
        $goods_detail['store_info']['store_id'] = $store_info['store_id'];
        $goods_detail['store_info']['store_name'] = $store_info['store_name'];
        $goods_detail['store_info']['member_id'] = $store_info['member_id'];
	//显示QQ及旺旺 好商城V3
	$goods_detail['store_info']['store_qq'] = $store_info['store_qq'];
	$goods_detail['store_info']['store_ww'] = $store_info['store_ww'];
	$goods_detail['store_info']['store_phone'] = $store_info['store_phone'];
        $goods_detail['store_info']['member_name'] = $store_info['member_name'];
        $goods_detail['store_info']['avatar'] = getMemberAvatarForID($store_info['member_id']);

        //商品详细信息处理
        $goods_detail = $this->_goods_detail_extend($goods_detail);
		
		
		

		
		//v3-b11 抢购商品是否开始
		$goods_info=$goods_detail['goods_info'];
		//print_r($goods_info);
		$IsHaveBuy=0;
		if(!empty($_COOKIE['username']))
		{
		   $model_member = Model('member');
		   $member_info= $model_member->getMemberInfo(array('member_name'=>$_COOKIE['username']));
		   $buyer_id=$member_info['member_id'];
		   
		   $promotion_type=$goods_info["promotion_type"];
		   
		   if($promotion_type=='groupbuy')
		   {   
		    //检测是否限购数量
			$upper_limit=$goods_info["upper_limit"];
			if($upper_limit>0)
			{
				//查询些会员的订单中，是否已买过了
				$model_order= Model('order');
				 //取商品列表
                $order_goods_list = $model_order->getOrderGoodsList(array('goods_id'=>$goods_id,'buyer_id'=>$buyer_id,'goods_type'=>2));
				if($order_goods_list)
				{   
				    //取得上次购买的活动编号(防一个商品参加多次团购活动的问题)
				    $promotions_id=$order_goods_list[0]["promotions_id"];
					//用此编号取数据，检测是否这次活动的订单商品。
					 $model_groupbuy = Model('groupbuy');
					 $groupbuy_info = $model_groupbuy->getGroupbuyInfo(array('groupbuy_id' => $promotions_id));
					 if($groupbuy_info)
					 {
						$IsHaveBuy=1;
					 }
					 else
					 {
						$IsHaveBuy=0;
					 }
				}
			}
		  }
		}

		$goods_detail['IsHaveBuy']=$IsHaveBuy;
        //获取购买咨询数量
        $consult_count = Model('consult')->getConsultCount(array('goods_id'=>$goods_id));
        Tpl::output('consult_count', $consult_count);
        //获取关联规格
        $GetGoodsLink = $model_goods->GetGoodsLink(array('goods_id'=>$goods_id));
		Tpl::output('spec_image', $goods_detail['spec_image']);
        Tpl::output('GetGoodsLink', $GetGoodsLink);

        Tpl::output('goods',$goods_detail['goods_info']);
        Tpl::output('store_info',$goods_detail['store_info']);
        Tpl::output('gift_array',$goods_detail['gift_array']);
        Tpl::output('mansong_info',$goods_detail['mansong_info']);
		
        Tpl::output('goods_images',$goods_detail['goods_images']);

		Tpl::output('html_title',$goods_info['goods_name'].' - 商品详情 - '.C('site_name'));
        Tpl::output('seo_keywords',$goods_info['goods_keywords']);
        Tpl::output('seo_description',$goods_info['goods_description']);

		if($goods_info['gc_id_1'] == 79  && $goods_info['store_id'] == 22){
			//艺术家官网产品详情页面
			Tpl::output('no_header',true);//
			Tpl::output('no_footer',true);//
			Tpl::setDir('artist');
			Tpl::setLayout('artist_layout');
			//获取登陆用户手机号
			$memberInfo = Model('member')->getMemberInfo(array('member_id'=>intval($_SESSION['member_id'])),'member_mobile');
			Tpl::output('member_mobile',JieMiMobile($memberInfo['member_mobile']));

			Tpl::showpage('ShGoods');
		}else{
		$goodsddd_info = $model_goods->getGoodsInfoByID($goods_id, 'goods_commonid,goods_addtime');
		$goods_common_info = $model_goods->getGoodeCommonInfoByID($goodsddd_info['goods_commonid']);
        /* Add is name lt 2016-10-10 此日期后添加的商品详情替换其图片属性为600*600 */
        $edit_time = strtotime('2016-10-10 10:30:00');

        if($goodsddd_info['goods_addtime'] > $edit_time){
            $goods_common_info['goods_body'] = str_replace('_1280.jpg','_600.jpg', $goods_common_info['goods_body']);
        }
        /* End */
		Tpl::output('goods_common_info',$goods_common_info);
        Tpl::output('no_footer',true);//不要底部导航
        Tpl::output('member_id',$_SESSION['member_id']);

        $goods_url_m = urlWap('goods','index',array('goods_id'=>$goods_info['goods_id']));
        $goods_xq_url_m = urlWap('goods','goods_body',array('goods_id'=>$goods_info['goods_id']));
        $goods_pl_url_m = urlWap('goods','comments',array('goods_id'=>$goods_info['goods_id']));


$body = <<<BODY
        <nav class='demo-fixed'>
              <a class='active' href='{$goods_url_m}'>商品</a>
              <a href='#MiaoContent'>详情</a>
              <a href='{$goods_pl_url_m}'>评论</a>
        </nav>
BODY;


        Tpl::output('nav_title',$body);

		Tpl::showpage('goods_detail');
			
		}


        

        
    }
	
	/**
     * 插入议价留言类容
     */
	public function YiJiaAddOp() {
		$isYJ = Model('yijia')->getGoodsInfo(array('goods_id'=>$_POST['goods_id'],'ip'=>$_SERVER["REMOTE_ADDR"]));
		if($isYJ){
			$result['error'] = '提交成功';
			echo json_encode($result); 
			exit();
		}
		$insert = array();
		$insert['name'] = $_POST['YjName'] == '' ? '匿名' : $_POST['YjName'];
		$insert['mobile'] = $_POST['YjPhone'];
		$insert['member_id'] = intval($_SESSION['member_id']);
		$insert['member_name'] = $_SESSION['member_name'];
		$insert['goods_id'] = $_POST['goods_id'];
		$insert['goods_name'] = $_POST['goods_name'];
		$insert['store_id'] = intval($_POST['store_id']);
		$storeInfo = Model('store')->getStoreInfoByID($insert['store_id']); //获取店铺信息
		if($storeInfo['store_yijia'] == 0){
			$result['error'] = '对不起，该店铺未开启议价功能';
			echo json_encode($result); 
			exit();
		}
		$insert['store_name'] = $storeInfo['store_name'];
		if($storeInfo['store_is_shuhua_'] == 1){
			$insert['store_type'] = 3;
		}else if($storeInfo['is_own_shop'] == 1){
			$insert['store_type'] = 1;
		}else{
			$insert['store_type'] = 2;
		}
		$insert['contents'] = $_POST['YjContents'];
		$insert['state'] = 0;
		$insert['add_time'] = time();
		$insert['ip'] = $_SERVER["REMOTE_ADDR"];
		$yj = Model('yijia')->YiJiaInsert($insert);
		if($yj){
			$result['msg'] = '提交失败，参数错误';
			echo json_encode($result); 
			exit();
		}else{
			$result['error'] = '提交失败，参数错误';
			echo json_encode($result); 
			exit();
		}
		
	}

    /**
     * 商品详细页
     */
    public function goods_detail_testOp() {
        $goods_id = intval($_GET ['goods_id']);

        // 商品详细信息
        $model_goods = Model('goods');
        $goods_detail = $model_goods->getGoodsDetail($goods_id);
        if (empty($goods_detail)) {
            output_error('商品不存在');
        }

        //推荐商品
        $model_store = Model('store');
        $hot_sales = $model_store->getHotSalesList($goods_detail['goods_info']['store_id'], 6);
        $goods_commend_list = array();
        foreach($hot_sales as $value) {
            $goods_commend = array();
            $goods_commend['goods_id'] = $value['goods_id'];
            $goods_commend['goods_name'] = $value['goods_name'];
            $goods_commend['goods_price'] = $value['goods_price'];
            $goods_commend['goods_image_url'] = cthumb($value['goods_image'], 240);
            $goods_commend_list[] = $goods_commend;
        }
        $goods_detail['goods_commend_list'] = $goods_commend_list;
        $store_info = $model_store->getStoreInfoByID($goods_detail['goods_info']['store_id']);
        $goods_detail['store_info']['is_own_shop'] = $store_info['is_own_shop'];
        $goods_detail['store_info']['store_id'] = $store_info['store_id'];
        $goods_detail['store_info']['store_name'] = $store_info['store_name'];
        $goods_detail['store_info']['member_id'] = $store_info['member_id'];
    //显示QQ及旺旺 好商城V3
    $goods_detail['store_info']['store_qq'] = $store_info['store_qq'];
    $goods_detail['store_info']['store_ww'] = $store_info['store_ww'];
    $goods_detail['store_info']['store_phone'] = $store_info['store_phone'];
        $goods_detail['store_info']['member_name'] = $store_info['member_name'];
        $goods_detail['store_info']['avatar'] = getMemberAvatarForID($store_info['member_id']);

        //商品详细信息处理
        $goods_detail = $this->_goods_detail_extend($goods_detail);
        
        
        

        
        //v3-b11 抢购商品是否开始
        $goods_info=$goods_detail['goods_info'];
        //print_r($goods_info);
        $IsHaveBuy=0;
        if(!empty($_COOKIE['username']))
        {
           $model_member = Model('member');
           $member_info= $model_member->getMemberInfo(array('member_name'=>$_COOKIE['username']));
           $buyer_id=$member_info['member_id'];
           
           $promotion_type=$goods_info["promotion_type"];
           
           if($promotion_type=='groupbuy')
           {   
            //检测是否限购数量
            $upper_limit=$goods_info["upper_limit"];
            if($upper_limit>0)
            {
                //查询些会员的订单中，是否已买过了
                $model_order= Model('order');
                 //取商品列表
                $order_goods_list = $model_order->getOrderGoodsList(array('goods_id'=>$goods_id,'buyer_id'=>$buyer_id,'goods_type'=>2));
                if($order_goods_list)
                {   
                    //取得上次购买的活动编号(防一个商品参加多次团购活动的问题)
                    $promotions_id=$order_goods_list[0]["promotions_id"];
                    //用此编号取数据，检测是否这次活动的订单商品。
                     $model_groupbuy = Model('groupbuy');
                     $groupbuy_info = $model_groupbuy->getGroupbuyInfo(array('groupbuy_id' => $promotions_id));
                     if($groupbuy_info)
                     {
                        $IsHaveBuy=1;
                     }
                     else
                     {
                        $IsHaveBuy=0;
                     }
                }
            }
          }
        }

        $goods_detail['IsHaveBuy']=$IsHaveBuy;
        //获取购买咨询数量
        $consult_count = Model('consult')->getConsultCount(array('goods_id'=>$goods_id));
        Tpl::output('consult_count', $consult_count);
        //获取关联规格
        $GetGoodsLink = $model_goods->GetGoodsLink(array('goods_id'=>$goods_id));
        Tpl::output('spec_image', $goods_detail['spec_image']);
        Tpl::output('GetGoodsLink', $GetGoodsLink);

        Tpl::output('goods',$goods_detail['goods_info']);
        Tpl::output('store_info',$goods_detail['store_info']);
        Tpl::output('gift_array',$goods_detail['gift_array']);
        Tpl::output('mansong_info',$goods_detail['mansong_info']);
        Tpl::output('goods_images',$goods_detail['goods_images']);

        Tpl::output('no_footer',true);//不要底部导航
        Tpl::output('member_id',$_SESSION['member_id']);

        // var_dump($goods_info);

        $goods_url_m = urlWap('goods','index',array('goods_id'=>$goods_info['goods_id']));
        $goods_xq_url_m = urlWap('goods','goods_body',array('goods_id'=>$goods_info['goods_id']));
        $goods_pl_url_m = urlWap('goods','comments',array('goods_id'=>$goods_info['goods_id']));


$body = <<<BODY
        <nav>
              <a class='active' href='{$goods_url_m}'>商品</a>
              <a href='{$goods_xq_url_m}'>详情</a>
              <a href='{$goods_pl_url_m}'>评论</a>
        </nav>
BODY;


        Tpl::output('nav_title',$body);
        Tpl::output('html_title',$goods_info['goods_name'].' - 商品详情 - '.C('site_name'));
        Tpl::output('seo_keywords',$goods_info['goods_keywords']);
        Tpl::output('seo_description',$goods_info['goods_description']);

        Tpl::showpage('goods_detail_test');
    }


    /**
     * 商品详细信息处理
     */
    private function _goods_detail_extend($goods_detail) {
        //整理商品规格
        unset($goods_detail['spec_list']);
        $goods_detail['spec_list'] = $goods_detail['spec_list_mobile'];
        unset($goods_detail['spec_list_mobile']);

        //整理商品图片
        unset($goods_detail['goods_image']);
        $goods_detail['goods_image'] = implode(',', $goods_detail['goods_image_mobile']);
        unset($goods_detail['goods_image_mobile']);

        //商品链接
        $goods_detail['goods_info']['goods_url'] = urlShop('goods', 'index', array('goods_id' => $goods_detail['goods_info']['goods_id']));

        //整理数据
        unset($goods_detail['goods_info']['goods_commonid']);
        unset($goods_detail['goods_info']['gc_id']);
        unset($goods_detail['goods_info']['gc_name']);
        unset($goods_detail['goods_info']['store_name']);
        unset($goods_detail['goods_info']['brand_id']);
        unset($goods_detail['goods_info']['brand_name']);
        unset($goods_detail['goods_info']['type_id']);
        unset($goods_detail['goods_info']['goods_image']);
        unset($goods_detail['goods_info']['goods_body']);
        unset($goods_detail['goods_info']['goods_state']);
        unset($goods_detail['goods_info']['goods_stateremark']);
        unset($goods_detail['goods_info']['goods_verify']);
        unset($goods_detail['goods_info']['goods_verifyremark']);
        unset($goods_detail['goods_info']['goods_lock']);
        unset($goods_detail['goods_info']['goods_addtime']);
        unset($goods_detail['goods_info']['goods_edittime']);
        unset($goods_detail['goods_info']['goods_selltime']);
        unset($goods_detail['goods_info']['goods_show']);
        unset($goods_detail['goods_info']['goods_commend']);
        unset($goods_detail['goods_info']['explain']);
        unset($goods_detail['goods_info']['cart']);
        unset($goods_detail['goods_info']['buynow_text']);
        unset($goods_detail['groupbuy_info']);
        unset($goods_detail['xianshi_info']);

        return $goods_detail;
    }

    /**
     * 商品详细页
     */
    public function goods_bodyOp() {
        $goods_id = intval($_GET['goods_id']);

        $model_goods = Model('goods');

        $goods_info = $model_goods->getGoodsInfoByID($goods_id, '*');
        $goods_common_info = $model_goods->getGoodeCommonInfoByID($goods_info['goods_commonid']);

        /* Add is name lt 2016-10-10 此日期后添加的商品详情替换其图片属性为600*600 */

        $edit_time = strtotime('2016-10-10 10:30:00');

        if($goods_info['goods_addtime'] > $edit_time){
            $goods_common_info['goods_body'] = str_replace('_1280.jpg','_600.jpg', $goods_common_info['goods_body']);
        }
        /* End */

        $goods_url_m = urlWap('goods','index',array('goods_id'=>$goods_id));
        $goods_xq_url_m = urlWap('goods','goods_body',array('goods_id'=>$goods_id));
        $goods_pl_url_m = urlWap('goods','comments',array('goods_id'=>$goods_id));


$body = <<<BODY
        <nav>
              <a href='{$goods_url_m}'>商品</a>
              <a class='active' href='{$goods_xq_url_m}'>详情</a>
              <a href='{$goods_pl_url_m}'>评论</a>
        </nav>
BODY;



        Tpl::output('nav_title',$body);
        Tpl::output('html_title',$goods_info['goods_name'].' - 商品详情 - '.C('site_name'));
        Tpl::output('seo_keywords',$goods_info['goods_keywords']);
        Tpl::output('seo_description',$goods_info['goods_description']);

        Tpl::output('goods_common_info', $goods_common_info);
		Tpl::output('goods_info', $goods_info);
        // Tpl::output('no_header', true);
        Tpl::output('no_footer', true);
        Tpl::showpage('goods_body');
    }
	
	/**
     * 书画获取商品详情信息
     */
    public function ShGoodsBodyOp() {
		$goods_id = intval($_GET['goods_id']);
		if($goods_id <= 0) exit();
		$model_goods = Model('goods');
		$goods_info = $model_goods->getGoodsInfoByID($goods_id, '*');
        $goods_common_info = $model_goods->getGoodeCommonInfoByID($goods_info['goods_commonid']);
		echo $goods_common_info['goods_body'];
		exit();
	}

	/**
     * 加载书画评论页面
     */
    public function ShGoodsCommentsOp() {
		$goods_id = intval($_GET['goods_id']);
		$type = intval($_GET['type']);
        $this->_get_comments($goods_id, $type, 100);
        $goods_evaluate_info = Model('evaluate_goods')->getEvaluateGoodsInfoByGoodsID($goods_id);
	
        Tpl::output('goods_evaluate_info', $goods_evaluate_info);
		Tpl::output('type', $type);
		Tpl::output('no_header',true);//隐藏头部
		Tpl::output('no_footer',true);//隐藏尾部
		Tpl::setDir('artist');
		Tpl::setLayout('null_layout');
		Tpl::showpage('ShGoodsComments');
	}
	

    /**
     * 商品评论
     */
    public function commentsOp() {
        $goods_id = intval($_GET['goods_id']);
        $type = (intval($_GET['type']) < 1)?'1':$_GET['type'];
        $this->_get_comments($goods_id, $type, 10);

        $goods_evaluate_info = Model('evaluate_goods')->getEvaluateGoodsInfoByGoodsID($goods_id);
        $goods_info = Model('goods')->getGoodsInfoByID($goods_id, '*');

		
        $goods_url_m = urlWap('goods','index',array('goods_id'=>$goods_id));
        $goods_xq_url_m = urlWap('goods','goods_body',array('goods_id'=>$goods_id));
        $goods_pl_url_m = urlWap('goods','comments',array('goods_id'=>$goods_id));


$body = <<<BODY
        <nav>
              <a href='{$goods_url_m}'>商品</a>
              <a href='{$goods_url_m}#MiaoContent'>详情</a>
              <a class='active' href='{$goods_pl_url_m}'>评论</a>
        </nav>
BODY;


        Tpl::output('goods_id', $goods_id);
        Tpl::output('type', $type);
        Tpl::output('goods_evaluate_info', $goods_evaluate_info);
        Tpl::output('nav_title',$body);
        Tpl::output('html_title',$goods_info['goods_name'].' - 商品评论 - '.C('site_name'));
        Tpl::output('seo_keywords',$goods_info['goods_keywords']);
        Tpl::output('seo_description',$goods_info['goods_description']);
        Tpl::showpage('goods_comment');
    }

    private function _get_comments($goods_id, $type, $page) {
        $condition = array();
        $condition['geval_goodsid'] = $goods_id;
        switch ($type) {
            case '1':
                $condition['geval_scores'] = array('in', '5,4');
                Tpl::output('type', '1');
                break;
            case '2':
                $condition['geval_scores'] = array('in', '3,2');
                Tpl::output('type', '2');
                break;
            case '3':
                $condition['geval_scores'] = array('in', '1');
                Tpl::output('type', '3');
                break;
        }

        //查询商品评分信息
        $model_evaluate_goods = Model("evaluate_goods");
        $goodsevallist = $model_evaluate_goods->getEvaluateGoodsList($condition, $page);
        Tpl::output('show_page',$model_evaluate_goods->showpage(88));
        Tpl::output('html_title','商品评价');
        Tpl::output('goodsevallist',$goodsevallist);
    }

    /**
     * 商品咨询信息
     */
    public function consultOp() {
        $goods_id = intval($_GET['goods_id']);
        //得到商品咨询信息
        $model_consult = Model('consult');
        $where = array();
        $where['goods_id'] = $goods_id;
        $consult_list = $model_consult->getConsultList($where, '*', 0, 10);
        $goods_info = Model('goods')->getGoodsInfoByID($goods_id, '*');
        Tpl::output('consult_list',$consult_list);
        Tpl::output('show_page', $model_consult->showpage(88));
        Tpl::output('html_title','购买咨询');
        Tpl::output('nav_title','购买咨询');
        Tpl::output('html_title',$goods_info['goods_name'].' - 购买咨询 - '.C('site_name'));
        Tpl::output('seo_keywords',$goods_info['goods_keywords']);
        Tpl::output('seo_description',$goods_info['goods_description']);
        Tpl::showpage('goods_consult');
    }



    /**
     * 到货通知
     */
    public function arrival_noticeOp() {

        $type = intval($_GET['type']) == 2 ? 2 : 1;

        if (!$_SESSION['member_id'] ){
            showWapMessage('请登录',urlWap('login','index'),'error');
        }

        if($type == 1){
            Tpl::output('html_title','到货通知');
        }else{
            Tpl::output('html_title','立即预约');
        }
        Tpl::output('type',$type);
        Tpl::output('goods_id',$_GET['goods_id']);
        Tpl::showpage('arrival_notice');
    }


    /**
     * 到货通知表单
     */
    public function arrival_notice_submitOp() {
        $type = intval($_POST['type']) == 2 ? 2 : 1;
        $goods_id = intval($_POST['goods_id']);

        if(!preg_match("/1[34578]{1}\d{9}$/",$_POST['mobile'])){
            showWapMessage('手机号无效',urlWap('index','index'));
        }

        if ($goods_id <= 0) {
            showWapMessage('该商品参数无效',urlWap('index','index'));
        }

        // 验证商品数是否充足
        $goods_info = Model('goods')->getGoodsInfoByID($goods_id, 'goods_id,goods_name,goods_storage,goods_state');
        if (empty($goods_info) || ($goods_info['goods_storage'] > 0 && $goods_info['goods_state'] == 1)) {
            showWapMessage('参数错误',urlWap('goods','index',array('goods_id'=>$goods_id)),'error');
        }

        $model_arrivalnotice = Model('arrival_notice');
        // 验证会员是否已经添加到货通知
        $where = array();
        $where['goods_id'] = $goods_info['goods_id'];
        $where['member_id'] = $_SESSION['member_id'];
        $where['an_type'] = $type;
        $notice_info = $model_arrivalnotice->getArrivalNoticeInfo($where);
        if (!empty($notice_info)) {
            if ($type == 1) {
                showWapMessage('您已经添加过通知提醒，请不要重复添加','','error');
            } else {
                showWapMessage('您已经预约过了，请不要重复预约','','error');
            }
        }

        $insert = array();
        $insert['goods_id'] = $goods_info['goods_id'];
        $insert['goods_name'] = $goods_info['goods_name'];
        $insert['member_id'] = $_SESSION['member_id'];
        $insert['an_mobile'] = $_POST['mobile'];
        $insert['an_email'] = $_POST['email'];
        $insert['an_type'] = $type;
        $model_arrivalnotice->addArrivalNotice($insert);

        showWapMessage('提交成功',urlWap('goods','index',array('goods_id'=>$goods_id)));

    }








	/**
     * 优惠购买推荐
    */
    public function cangdou_fenxiangOp() {
		//获取商品推荐人id
		$tjid = intval($_GET['zmr']);
		//从会员中心过来的推荐产品
        $goods_id = intval($_GET['goods_id']);
		if($tjid > 0){
			$_SESSION['tjid'] = $tjid;
			//将推荐产品id存入session
			$_SESSION['tjgoodsid'] = $goods_id;
			setcookie('zmr', $tjid);
		}else{
			$_SESSION['tjid'] = 0;
			//将推荐产品id存入session
			$_SESSION['tjgoodsid'] = 0;
		}
		 // 商品详细信息
        $model_goods = Model('goods');
        $goods_detail = $model_goods->getGoodsDetail($goods_id);
		Tpl::output('goods',$goods_detail['goods_info']);
		Tpl::output('html_title','优惠购买'.' - '.C('site_name'));
		Tpl::output('seo_keywords',"收藏天下是国内最专业的收藏品网站,提供各类收藏品,包括名家书法字画,瓷器紫砂,人民币,邮票,金银币,金银条,纪念钞,纪念币,玉器,珠宝等各类收藏品,并为您提供最新最全的收藏信息！");
		Tpl::output('seo_description',"收藏天下是国内最专业的收藏品网站,提供各类收藏品,包括名家书法字画,瓷器紫砂,人民币,邮票,金银币,金银条,纪念钞,纪念币,玉器,珠宝等各类收藏品,并为您提供最新最全的收藏信息！");
		Tpl::showpage('cangdou_fenxiang');
    }
}