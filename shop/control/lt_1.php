<?php



defined('InShopNC') or exit('Access Invalid!');
class lt_1Control extends BaseHomeControl {

    public $openid;
    public $mch_id;
    public $value;//请求参数，类型为关联数组
    public $keyStr='shengwei520soucang96567key1987sw';
    public $order_id;

    private $prepay_id;
    private $apiURL = 'https://api.mch.weixin.qq.com/pay/unifiedorder';

    const ARRIVAL_NOTICE_NUM = 100;

    //每页显示商品数
    const PAGESIZE = 20;

    //模型对象
    private $_model_search;

	public function __construct() {
		parent::__construct();
		//读取语言包

	}



    public function fa_voucher_11Op(){

        $model = Model();

        $model_voucher = Model('voucher');

        $model_member = Model('member');

        $model_order = Model('order');

        $sql = 'SELECT o.*,og.goods_id FROM `shop_order_goods` as og 
left join `shop_order` as o ON og.order_id=o.order_id
WHERE og.rec_id > 321021 
AND og.goods_id IN(11729,12384,662,36497,29780,963,36363,28211) 
AND o.buyer_id = 444650 
AND o.payment_time <> \'\'
AND o.sh_this_voucher_ = 1
GROUP BY og.order_id LIMIT 0,100';

        // 所有有资格送卷的订单ID
        $order_list = $model->query($sql);

        foreach ($order_list as $k => $v) {

            // 判断当前订单是否发送过优券
            if($v['sh_this_voucher_'] == 2){
                continue;
            }

            // 判断当前订单是即时付款还是货到付款 !!货到付款订单完成后才有支付时间
            if($v['payment_code'] == 'offline'){//货到付款
                if(empty($v['finnshed_time'])){
                    continue;
                }
            }elseif(empty($v['payment_time'])){
                continue;
            }



            $condition['order_id'] = $v['order_id'];
            $order_goods_list = $model_order->getOrderGoodsList($condition);

            foreach ($order_goods_list as $goods) {

                switch (intval($goods['goods_id'])) {
                    case '11729':
                        $vid = '388';
                        break;
                    case '12384':
                        $vid = '389';
                        break;
                    case '662':
                        $vid = '390';
                        break;
                    case '36497':
                        $vid = '391';
                        break;
                    case '29780':
                        $vid = '392';
                        break;
                    case '963':
                        $vid = '393';
                        break;
                    case '36363':
                        $vid = '394';
                        break;
                    case '28211':
                        $vid = '395';
                        break;
                    default:
                        $vid = '';
                        break;
                }

                if(empty($vid)){
                    continue;
                }

                try {

                    $model->beginTransaction();

                    $_SESSION['shoudong_voucher'] = true; //不需要积分兑换

                    $data = $model_voucher->getCanChangeTemplateInfo($vid,intval($v['buyer_id']),'');

                    if ($data['state'] == false){
                        throw new Exception();
                    }

                    $data = $model_voucher->exchangeVoucher($data['info'],$v['buyer_id'],$v['buyer_name'],true);

                    if ($data['state'] == false){
                        throw new Exception();
                    }

                    // 修改当前订单是否发送过优惠券
                    $order_update_info = $model_order->editOrder(array('sh_this_voucher_'=>2),array('order_id'=>$v['order_id']));

                    if(empty($order_update_info)){
                        throw new Exception();
                    }

                    $model->commit();

                } catch (Exception $e) {

                    $model->rollback();
                    continue;
                }

            }

        }



    }




    public function test_searchOp() {
        exit;
        Language::read('home_goods_class_index');
        $this->_model_search = Model('search');
        //显示左侧分类
        //默认分类，从而显示相应的属性和品牌
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
        Tpl::output('goods_class_array', $goods_class_array);
        Tpl::output('default_classid', $default_classid);

        //优先从全文索引库里查找
        list($indexer_ids,$indexer_count) = $this->_model_search->indexerSearch($_GET,self::PAGESIZE);

        //获得经过属性过滤的商品信息
        list($goods_param, $brand_array, $attr_array, $checked_brand, $checked_attr) = $this->_model_search->getAttr($_GET, $default_classid);
        Tpl::output('brand_array', $brand_array);
        Tpl::output('attr_array', $attr_array);
        Tpl::output('checked_brand', $checked_brand);
        Tpl::output('checked_attr', $checked_attr);



        //处理排序
        //$order = 'is_own_shop desc,goods_id desc';
        $order = 'goods_id desc';
        if (in_array($_GET['key'],array('1','2','3'))) {
            $sequence = $_GET['order'] == '1' ? 'asc' : 'desc';
            $order = str_replace(array('1','2','3'), array('goods_salenum','goods_click','goods_price'), $_GET['key']);
            $order .= ' '.$sequence;
        }

        $model_goods = Model('goods');
        // 字段
        $fields = "goods_id,goods_commonid,goods_name,goods_jingle,gc_id,store_id,store_name,goods_price,goods_promotion_price,goods_promotion_type,goods_marketprice,goods_storage,goods_image,goods_freight,goods_salenum,color_id,evaluation_good_star,evaluation_count,is_virtual,is_fcode,is_appoint,is_presell,have_gift,is_own_shop";

        $condition = array();
        if (is_array($indexer_ids)) {

            //商品主键搜索
            $condition['goods_id'] = array('in',$indexer_ids);
            $goods_list = $model_goods->getGoodsOnlineList($condition, $fields, 0, $order, self::PAGESIZE, null, false);

            //如果有商品下架等情况，则删除下架商品的搜索索引信息
            if (count($goods_list) != count($indexer_ids)) {
                $this->_model_search->delInvalidGoods($goods_list, $indexer_ids);
            }

            pagecmd('setEachNum',self::PAGESIZE);
            pagecmd('setTotalNum',$indexer_count);

        } else {
            //执行正常搜索
            if (isset($goods_param['class'])) {
                $condition['gc_id_'.$goods_param['class']['depth']] = $goods_param['class']['gc_id'];
            }
            if (intval($_GET['b_id']) > 0) {
                $condition['brand_id'] = intval($_GET['b_id']);
            }
            if ($_GET['keyword'] != '') {
                $condition['_zidingyi'] = " ( goods_name like '%".$_GET['keyword']."%' OR goods_keywords like '%".$_GET['keyword']."%' OR goods_serial = '".$_GET['keyword']."' OR store_name like '%".$_GET['keyword']."%') AND";
            }
            if (intval($_GET['area_id']) > 0) {
                $condition['areaid_1'] = intval($_GET['area_id']);
            }
            if ($_GET['type'] == 1) {
                $condition['is_own_shop'] = 1;
            }
            if ($_GET['gift'] == 1) {
                $condition['have_gift'] = 1;
            }
            if (isset($goods_param['goodsid_array'])){
                $condition['goods_id'] = array('in', $goods_param['goodsid_array']);
            }

            $catch_str = '';
            $catch_page = $_GET['curpage']?$_GET['curpage']:1;
            foreach ($condition as $k => $v) {
                $catch_str .= $v;
            }

            $catch_str_ = 'search_'.md5($catch_str.$catch_page);
            $catch_redis = rkcache($catch_str_);

            if(empty($catch_redis)){
                $goods_list = $model_goods->getGoodsListByColorDistinct($condition, $fields, $order, self::PAGESIZE);
                wkcache($catch_str_,$goods_list,3600);
            }else{
                $goods_list = $catch_redis;
            }

        }


        Tpl::output('show_page1', $model_goods->showpage(4));
        Tpl::output('show_page', $model_goods->showpage(5));

        // 商品多图
        if (!empty($goods_list)) {
            $commonid_array = array(); // 商品公共id数组
            $storeid_array = array();       // 店铺id数组
            foreach ($goods_list as $value) {
                $commonid_array[] = $value['goods_commonid'];
                $storeid_array[] = $value['store_id'];
            }
            $commonid_array = array_unique($commonid_array);
            $storeid_array = array_unique($storeid_array);

            // 商品多图
            $goodsimage_more = Model('goods')->getGoodsImageList(array('goods_commonid' => array('in', $commonid_array)));
            
            

            // 店铺
            $store_list = Model('store')->getStoreMemberIDList($storeid_array);
            //搜索的关键字
            $search_keyword = trim($_GET['keyword']);
            foreach ($goods_list as $key => $value) {
                // 商品多图
                //zmr>v30
                $n=0;
                foreach ($goodsimage_more as $v) {
                    if ($value['goods_commonid'] == $v['goods_commonid'] && $value['store_id'] == $v['store_id'] && $value['color_id'] == $v['color_id']) {
                        $n++;
                        $goods_list[$key]['image'][] = $v;
                        if($n>=5)break;
                    }
                }
                
                // 店铺的开店会员编号
                $store_id = $value['store_id'];
                $goods_list[$key]['member_id'] = $store_list[$store_id]['member_id'];
                $goods_list[$key]['store_domain'] = $store_list[$store_id]['store_domain'];
                //将关键字置红
                if ($search_keyword){
                    $goods_list[$key]['goods_name_highlight'] = str_replace($search_keyword,'<font style="color:#f00;">'.$search_keyword.'</font>',$value['goods_name']);
                } else {
                    $goods_list[$key]['goods_name_highlight'] = $value['goods_name'];
                }
            }
        }
        
        Tpl::output('goods_list', $goods_list);
        if ($_GET['keyword'] != ''){
            Tpl::output('show_keyword',  $_GET['keyword']);
        } else {
            Tpl::output('show_keyword',  $goods_param['class']['gc_name']);
        }

        $model_goods_class = Model('goods_class');

        // SEO
        if ($_GET['keyword'] == '') {
            $seo_class_name = $goods_param['class']['gc_name'];
            if (is_numeric($_GET['cate_id']) && empty($_GET['keyword'])) {
                $seo_info = $model_goods_class->getKeyWords(intval($_GET['cate_id']));
                if (empty($seo_info[1])) {
                    $seo_info[1] = C('site_name') . ' - ' . $seo_class_name;
                }
                Model('seo')->type($seo_info)->param(array('name' => $seo_class_name))->show();
            }
        } elseif ($_GET['keyword'] != '') {
            Tpl::output('html_title', (empty($_GET['keyword']) ? '' : $_GET['keyword'] . ' - ')  . L('nc_common_search').' - '.C('site_name'));
        }

        // 当前位置导航
        $nav_link_list = $model_goods_class->getGoodsClassNav(intval($_GET['cate_id']));
        Tpl::output('nav_link_list', $nav_link_list );
        //$gc_id_1 = $model_goods_class->getGoodsClassYiJi(intval($_GET['cate_id']));


        loadfunc('search');
//      if($gc_id_1 == 79){
//          //书画分类进入选画中心
//          $_GET['op'] = 'Shsearch';
//          Tpl::output('YiShu', true);
//          $yiShuClass = Model('artist_new')->getYishuClass(79);
//          $CateArrData = $model_goods_class->getCateArr(intval($_GET['cate_id']));
//          Tpl::output('CateArrData',$CateArrData);
//          Tpl::output('yiShuClass',$yiShuClass);
//          Tpl::output('TotalNum',$model_goods->getGoodsCount($condition));
//          Tpl::showpage('Sh.search');
//      }else{
//          }
            // 得到自定义导航信息
            $nav_id = intval($_GET['nav_id']) ? intval($_GET['nav_id']) : 0;
            Tpl::output('index_sign', $nav_id);

            // 地区
            $province_array = Model('area')->getTopLevelAreas();
            Tpl::output('province_array', $province_array);
                        
            //增加促销信息 热卖推荐 盛威添加 2015-9-27
            $dataArr = Model('promotion')->getPromotionList($_GET['cate_id']);
            Tpl::output('dataArr',$dataArr);
            //add 秒杀模块 搜索页（今日秒杀） xin
            $miaosha_list = Model('miaosha')->getMiaoshaCommendedList(3);
            Tpl::output('miaosha_list', $miaosha_list);
            //add end
            //商品精选
            $dataArr = Model('promotion')->getPromotionList($_GET['cate_id'],1,5);
            Tpl::output('dataArr1',$dataArr);
            //新品推荐
            $dataArr = Model('promotion')->getPromotionList($_GET['cate_id'],2,2);
            Tpl::output('dataArr2',$dataArr);
            // 浏览过的商品
            $viewed_goods = Model('goods_browse')->getViewedGoodsList($_SESSION['member_id'],20);
            Tpl::output('viewed_goods',$viewed_goods);


            Tpl::showpage('search');    
        
    }



    public function fa_voucherOp(){

        sleep(5);

        $model_member  = Model('member');
        $model_message  = Model('message');
        $model_voucher = Model('voucher');

        $_SESSION['shoudong_voucher'] = true; //不需要积分兑换

        $vid = 381;

        $condition = array();

        $member_id = rkcache('fs_voucher_member');

        if(!empty($member_id)){
            $condition['member_id'] = array('gt',$member_id);
        }
        
        $field = 'member_id,member_name';
        $member_list = $model_member->table('member')->where($condition)->field($field)->limit(200)->order('member_id')->select();


        if(empty($member_list)){
            echo '发送完成';
            exit;
        }

        foreach ($member_list as $k => $v) {
            $_SESSION['shoudong_voucher'] = true; //不需要积分兑换

            $data = $model_voucher->getCanChangeTemplateInfo($vid,intval($v['member_id']),'');

            if ($data['state'] == false){
            $result['state'] = false;
            $result['msg'] = $data['msg'];
            $result['vid'] = $vid;
            
            var_dump($result,$_SESSION['shoudong_voucher']);

            exit();
        }

            $data = $model_voucher->exchangeVoucher($data['info'],$v['member_id'],$v['member_name'],true);

            $insert_arr = array();
            $insert_arr['from_member_id'] = 0; // 消息发送人
            $insert_arr['from_member_name'] = ''; // 发送人用户名
            $insert_arr['member_id'] = $v['member_id']; // 消息接收人
            $insert_arr['to_member_name'] = $v['member_name']; // 接收人用户名
            $insert_arr['msg_content'] = "恭喜您获得一张800元优惠券！<a href='http://www.96567.com/index.php?act=member_voucher&op=voucher_list'>查看</a>";
            $insert_arr['message_type'] = 1;
            $return = $model_message->saveMessage($insert_arr);

            wkcache('fs_voucher_member',$v['member_id']);
        }


        header("location:http://www.96567.com/index.php?act=lt&op=fa_voucher&r=".mt_rand(1111,9999));

    }



    public function lepai_tOp(){

        exit;

        $pay_array['add_time'] = array('lt',time()-86400*3);
        $pay_array['order_state'] = '10';
        $pay_result = Model()->table('lepai_order')->where($pay_array)->select();
        if(!empty($pay_result)){
            foreach($pay_result as $k => $v){
                $h_model = Model('lepai_home');
                $h_model->updateLepaiOrder(array('order_state'=>'0'),array('order_id'=>$v['order_id']));
                if($v['pd_amount'] > '0'){
                    try {
                        Model()->beginTransaction();
                        //变更预存款
                        $data_pd = array();
                        $data_pd['member_id'] = $v['buyer_id'];
                        $data_pd['member_name'] = $v['buyer_name'];
                        $data_pd['amount'] = $v['pd_amount'];
                        $data_pd['auction_id'] = $v['lepai_goods_id'];
                        $res = $h_model->changePd('lepai_set_money',$data_pd);
                        if(!$res){
                            throw new Exception('操作失败');
                        }
                        Model()->commit();
                    }catch (Exception $e){
                        Model()->rollback();
                        continue;
                    }
                }
            }
        }

        var_dump($pay_result);

    }

    public function daochu_dbOp(){

        exit;


        $sql = "SELECT 
a.A_Name,a.A_AdFrom,a.A_From,c.B_ID,c.B_EntryName,(select U_Name from sw_user_info u where U_ID = A_UID) as yw_name
FROM sw_activity as a
LEFT JOIN sw_customer as c
ON(a.A_Name=c.B_Name)
WHERE a.Number=2040 
AND a.A_From LIKE '第三套人民币%' 
AND c.B_EntryName='项目客户数据分配'
GROUP BY a.A_Mobile ORDER BY a.id desc ";
    
        $crm_list = CrmDb::getAll($sql);


        $sql_ = "SELECT y.MemberID,o.order_sn,o.order_amount,o.order_state 
FROM `shop_yw_info` y 
INNER JOIN `shop_order` o 
ON(y.orderid=o.order_id)
WHERE 
MemberID IN(1599253,1599252,1599251,1599256,1599255,1599254,1535878,1599259,1524990";

        $shop_list = Model()->query($sql_);


        $shop_list_array = array();


        foreach ($shop_list as $k => $v) {
            $shop_list_array[$v['MemberID']] = $v;
        }

        foreach ($crm_list as $k => &$v) {
            if(!empty($shop_list_array[$v['B_ID']])){
                $v['MemberID'] = $shop_list_array[$v['B_ID']]['MemberID'];
                $v['order_sn'] = $shop_list_array[$v['B_ID']]['order_sn'];
                $v['order_amount'] = $shop_list_array[$v['B_ID']]['order_amount'];
                $v['order_state'] = $shop_list_array[$v['B_ID']]['order_state'];
            }
        }



                $this->DaoChu_Export("file"); //设置导出格式
        $str = '<table class="table" width="60%" border="0" cellspacing="1" cellpadding="0">';
        $str .= '<tr><td>项目来源</td><td>业务员</td><td>订单金额</td><td>订单状态</td></tr>';
        foreach($crm_list as $k=>$v){

            if(empty($v['order_sn'])){
            switch ($v['order_state']) {
                case '0':
                    $state = '已取消';
                case '10':
                    $state = '默认';
                    break;
                case '20':
                    $state = '已付款';
                    break;
                case '30':
                    $state = '已发货';
                    break;
                case '40':
                    $state = '已收货';
                    break;
                default:
                    $state = '';
                    break;
            }

            $str .= '<tr>
            <td>&nbsp;'.$v['A_From'].'</td>
            <td>&nbsp;'.$v['yw_name'].'</td>
            <td>&nbsp;'.$v['order_amount'].'</td>
            <td>&nbsp;'.$state.'</td>
            </tr>';
        }

        }
        $str .='</table>';
        echo $str;
        exit;





    }




    public function dc_voucherOp(){

        $model = Model();

        $sql = 'SELECT 
vt.*,COUNT(v.voucher_t_id) AS count_user ,COUNT(v.voucher_order_id) AS count_order
FROM 
(SELECT voucher_t_id,voucher_t_title,voucher_t_desc,voucher_t_price FROM shop_store_voucher_template WHERE voucher_t_id > 9 AND voucher_t_id IN(10,11,12,13,14,15,16)) AS vt 
INNER JOIN shop_store_voucher AS v ON(vt.voucher_t_id=v.voucher_t_id) 
GROUP BY v.voucher_t_id
LIMIT 10';

        $sql_ = 'SELECT o.order_id,o.order_sn,o.buyer_name,o.order_state,ol.log_msg,ol.log_role,ol.log_user,v.voucher_price,v.voucher_order_id
FROM `shop_order` o 
LEFT JOIN `shop_order_log` ol 
ON(o.order_id=ol.order_id) 
LEFT JOIN `shop_store_voucher` v 
ON(ol.log_user=v.voucher_id)
WHERE o.`order_id` > 548431 
AND o.`sh_this_voucher_` = 2
AND ol.`log_id` > 856273 
AND ol.`log_msg` LIKE \'该订单参与%\' 
ORDER BY v.voucher_price DESC';
        
        $count_list = $model->query($sql);

        $info_list = $model->query($sql_);

        $this->DaoChu_Export("file"); //设置导出格式
        $str = '<table class="table" width="60%" border="0" cellspacing="1" cellpadding="0">';
        $str .= '<tr><td>优惠券</td><td>领取</td><td>使用</td></tr>';
        if($count_list){
            foreach($count_list as $k=>$v){
                $str .= '<tr>
                <td>&nbsp;'.$v['voucher_t_title'].'</td>
                <td>&nbsp;'.$v['count_user'].'</td>
                <td>&nbsp;'.$v['count_order'].'</td>
                </tr>';
            }
        }

        if($info_list){
            $str .= '<tr><td>用户名</td><td>订单号</td><td>领取金额</td><td>订单状态</td><td>使用订单号</td><td>详情</td></tr>';
            foreach($info_list as $k=>$v){

                switch ($v['order_state']) {
                    case '10':
                        $state = '默认';
                        break;
                    case '20':
                        $state = '已付款';
                        break;
                    case '30':
                        $state = '已发货';
                        break;
                    case '40':
                        $state = '已收货';
                        break;
                    default:
                        $state = '已取消';
                        break;
                }

                $str .= '<tr>
                <td>&nbsp;'.$v['buyer_name'].'</td>
                <td>&nbsp;'.$v['order_sn'].'</td>
                <td>&nbsp;'.$v['voucher_price'].'</td>
                <td>&nbsp;'.$state.'</td>
                <td>&nbsp;'.$v['voucher_order_id'].'</td>
                <td>&nbsp;'.$v['log_msg'].'</td>
                </tr>';
            }
        }
        $str .='</table>';
        echo $str;
        exit;




    }



    public function test_rOP(){
        exit;
        $crm_sql = "SELECT m.C_Mobile,c.B_Name,(SELECT U_Name FROM sw_user_info WHERE sw_user_info.U_ID = c.B_UserID LIMIT 1) as U_Name FROM sw_customer_mobile m INNER JOIN sw_customer c ON(m.C_BID=c.B_ID) WHERE m.C_BID=77";
        $crm_list = CrmDb::getAll($crm_sql);

        var_dump($crm_list);

    }


    public function vou_1026Op(){

        $model = Model();

        $model_voucher = Model('store_voucher');

        $model_member = Model('member');

        $model_order = Model('order');

        $sql = 'SELECT o.* FROM `shop_order_goods` as og 
left join `shop_order` as o ON og.order_id=o.order_id
WHERE og.rec_id > 313598 
AND og.goods_id IN(31244,34068,27974,27990,33166,17550,31230,16436,27673,22502,12384,11227)
AND o.finnshed_time <> \'\'
AND o.sh_this_voucher_ = 1
GROUP BY og.order_id LIMIT 0,10';
        

        // 所有有资格送卷的订单ID
        $order_list = $model->query($sql);

        // 100券
        $vou_100 = array('31244','34068');
        // 50券
        $vou_50 = array('27974','27990','33166','17550','31230','16436');
        // 30券
        $vou_30 = array('27673','22502','12384','11227');


        foreach ($order_list as $k => $v) {

            // 判断当前订单是否发送过优券
            if($v['sh_this_voucher_'] == 2){
                continue;
            }

            // 判断当前订单是即时付款还是货到付款 !!货到付款订单完成后才有支付时间
            if(empty($v['finnshed_time'])){
                continue;
            }

            $condition['order_id'] = $v['order_id'];
            $order_goods_list = $model_order->getOrderGoodsList($condition);

            foreach ($order_goods_list as $goods) {
                if(in_array($goods['goods_id'],$vou_100)){
                    $voucher_id = 14;
                }elseif(in_array($goods['goods_id'],$vou_50)){
                    $voucher_id = 15;
                }elseif(in_array($goods['goods_id'],$vou_30)){
                    $voucher_id = 16;
                }

                if(empty($voucher_id)){
                    continue;
                }

                try {

                    $model->beginTransaction();

                    // 发送优惠券给用户

                    $template_info = $model_voucher->table('store_voucher_template')->where(array('voucher_t_id'=>$voucher_id))->find();

                    //添加代金券信息
                    $data = $model_voucher->exchangeVoucher($template_info,$v['buyer_id'],$v['buyer_name']);

                    if($data['state'] != true){
                        throw new Exception();
                    }

                    // 给订单信息中记录优惠券发送纪录
                    $order_log['order_id'] = $v['order_id'];
                    $order_log['log_msg'] = '该订单参与纪念币返现活动，'.$template_info['voucher_t_price'].'元平台优惠券已发放，优惠券id：'.$voucher_id.'-'.$data['voucher_id'].',如退款/退货，需收回优惠券。';
                    $order_log['log_time'] = time();
                    $order_log['log_role'] = '纪念币';
                    $order_log['log_user'] = 'admin';
                    $order_log['log_orderstate'] = $v['order_state'];

                    $order_log_info = $model_order->addOrderLog($order_log);

                    if(empty($order_log_info)){
                        throw new Exception();
                    }

                    // 修改当前订单是否发送过优惠券
                    $order_update_info = $model_order->editOrder(array('sh_this_voucher_'=>2),array('order_id'=>$v['order_id']));

                    if(empty($order_update_info)){
                        throw new Exception();
                    }

                    $model->commit();

                } catch (Exception $e) {

                    $model->rollback();
                    continue;
                }

            }


        }

    }




    public function crm_dbOp(){

        $model = Model();

        $sql = 'SELECT y.UserID,y.MemberName,y.MemberID,c.reciver_name,c.reciver_info FROM shop_yw_info y 
INNER JOIN shop_order_common c 
ON(y.orderid=c.order_id) 
WHERE y.Number = 2040 AND y.MemberName 
IN(\'刘光强\') 
ORDER BY y.UserId;';
        
        $list = $model->query($sql);


        foreach ($list as $k => &$v) {
        
        $crm_sql = "SELECT m.C_Mobile,c.B_Name,(SELECT U_Name FROM sw_user_info WHERE sw_user_info.U_ID = c.B_UserID LIMIT 1) as U_Name FROM sw_customer_mobile m INNER JOIN sw_customer c ON(m.C_BID=c.B_ID) WHERE m.C_BID={$v['MemberID']}";
        $crm_list = CrmDb::getAll($crm_sql);
        $v['crm_mobile'] = JieMiMobile(reset($crm_list)['C_Mobile']);
        $v['crm_name'] = reset($crm_list)['B_Name'];
        $v['crm_uname'] = reset($crm_list)['U_Name'];
        $v['crm'] = $v['reciver_info'];
        $order_ = @preg_replace('!s:(\d+):"(.*?)";!se','"s:".strlen("$2").":\"$2\";"',$v['reciver_info']);
        $reciver_info = unserialize($order_);

        $v['phone'] = JieMiMobile($reciver_info['phone'])?JieMiMobile($reciver_info['phone']):JieMiMobile($reciver_info['mob_phone']);
        $v['address'] = $reciver_info['address'];

        }

        $this->DaoChu_Export("file"); //设置导出格式
        $str = '<table class="table" width="60%" border="0" cellspacing="1" cellpadding="0">';
        $str .= '<tr><td>memberid</td><td>业务员</td><td>现业务员</td><td>客户</td><td>收货人手机</td><td>客户手机</td><td>客户姓名</td><td>地址</td></tr>';
        if($list){
            foreach($list as $k=>$v){
                if(empty($v['crm_name'])){
                $str .= '<tr>
                <td>&nbsp;'.$v['MemberID'].'</td>
                <td>&nbsp;'.$v['MemberName'].'</td>
                <td>&nbsp;'.$v['crm_uname'].'</td>
                <td>&nbsp;'.$v['reciver_name'].'</td>
                <td>&nbsp;'.$v['phone'].'</td>
                <td>&nbsp;'.$v['crm_mobile'].'</td>
                <td>&nbsp;'.$v['crm_name'].'</td>
                <td>&nbsp;'.$v['address'].'</td>
                </tr>';
                }
            }
        }
        $str .='</table>';
        echo $str;
        exit;

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


    
    public function test_1024Op(){
        $model = Model();


        $sql = 'SHOW TABLES';
        
        $list = $model->query($sql);

        foreach ($list as $k => $v) {
            echo 'GRANT SELECT ON `shopnc`.`'.$v['Tables_in_shopnc'].'` TO \'test_shopnc\'@\'10.172.0.131\';';
            echo '</br>';
        }



    }


    /* 书画馆店铺增送平台级优惠券 */
    public function zs_1018Op(){

       $model = Model();

        $model_voucher = Model('store_voucher');

        $model_member = Model('member');

        $model_order = Model('order');

        $sql = 'SELECT o.* FROM `shop_order_goods` as og 
left join `shop_goods` as g ON og.goods_id=g.goods_id 
left join `shop_order` as o ON og.order_id=o.order_id
WHERE og.rec_id > 296080 
AND og.store_id IN(3,22)
AND og.goods_pay_price > 798 
AND g.gc_id_1 = 79 
AND o.payment_time <> \'\'
AND o.sh_this_voucher_ = 1
AND o.order_amount > 999
GROUP BY og.order_id LIMIT 0,20';
        

        // 所有有资格送卷的订单ID
        $order_list = $model->query($sql);

        foreach ($order_list as $k => $v) {

            // 判断当前订单是否发送过优券
            if($v['sh_this_voucher_'] == 2){
                continue;
            }

            // 判断当前订单是即时付款还是货到付款 !!货到付款订单完成后才有支付时间
            if($v['payment_code'] == 'offline'){//货到付款
                if(empty($v['finnshed_time'])){
                    continue;
                }
            }elseif(empty($v['payment_time'])){
                continue;
            }

            // 查出当前订单的所有书画商品 !!在订单商品表中的实际成交金额是已减过优惠券的金额
            $this_order_goods_list_sql = 'SELECT SUM(`pingtai_voucher_price`) as pt_money,SUM(`goods_pay_price`) as sum_money FROM `shop_order_goods` as og left join `shop_goods` as g ON og.goods_id=g.goods_id WHERE og.rec_id > 296080 AND og.order_id = '.$v['order_id'].' AND g.gc_id_1 = 79 LIMIT 0,10';
            $this_order_goods_list = $model->query($this_order_goods_list_sql);

            $this_money = $this_order_goods_list['0']['sum_money'];

            if($this_money >= 999 && $this_money < 2000){
                $voucher_id = '10';
            }elseif($this_money >= 2000 && $this_money < 3000){
                $voucher_id = '11';
            }elseif($this_money >= 3000 && $this_money < 4000){
                $voucher_id = '12';
            }elseif($this_money >= 4000){
                $voucher_id = '13';
            }else{
                continue;
            }

            try {

                $model->beginTransaction();

                // 发送优惠券给用户

                $template_info = $model_voucher->table('store_voucher_template')->where(array('voucher_t_id'=>$voucher_id))->find();

                //添加代金券信息
                $data = $model_voucher->exchangeVoucher($template_info,$v['buyer_id'],$v['buyer_name']);

                if($data['state'] != true){
                    throw new Exception();
                }

                // 给订单信息中记录优惠券发送纪录
                $order_log['order_id'] = $v['order_id'];
                $order_log['log_msg'] = '该订单参与书画馆返现活动，'.$template_info['voucher_t_price'].'元平台优惠券已发放，优惠券id：'.$voucher_id.'-'.$data['voucher_id'].',如退款/退货，需收回优惠券。';
                $order_log['log_time'] = time();
                $order_log['log_role'] = '书画馆';
                $order_log['log_user'] = $data['voucher_id'];
                $order_log['log_orderstate'] = $v['order_state'];

                $order_log_info = $model_order->addOrderLog($order_log);

                if(empty($order_log_info)){
                    throw new Exception();
                }

                // 修改当前订单是否发送过优惠券
                $order_update_info = $model_order->editOrder(array('sh_this_voucher_'=>2),array('order_id'=>$v['order_id']));

                if(empty($order_update_info)){
                    throw new Exception();
                }

                $model->commit();

            } catch (Exception $e) {

                $model->rollback();
                continue;
            }
        }

    }



    /* End */





    /* 藏品惠图片编辑 */

    public function cp_imagesOp(){

        $model = Model();

        $condition['end_time'] = array('gt','1476158400');

        $result_info = $model->table('groupbuy')->where($condition)->select();

        $model_goods = Model('goods');

        foreach ($result_info as $k => $v) {

            $goods_info = $model_goods->getGoodsInfoByID($v['goods_id'],'goods_id,goods_image');


            $data['groupbuy_image1'] = $goods_info['goods_image'];
            $condition_up['groupbuy_id'] = $v['groupbuy_id'];

            $res_id = $model->table('groupbuy')->where($condition_up)->update($data);

        }

        


    }





    /*订单分配*/
    public function lOrderOp(){

        $this->member_info = $this->getMemberAndGradeInfo(true);

        $model_order = Model('order');
        $condition['order_id'] = '540764';
        $order_list['0'] = $model_order->getOrderInfo($condition);

        // echo JieMiMobile('aUYzeDYoaUYzeDYoYjFBUjYo*czRc*KjVdIzFHZe*Ms*dioa*XSMxRc*dAMmhQXnJi*YWYtKSoheVpPLe*MjMUdn');

        if(is_array($order_list) && !empty($order_list)){
            foreach($order_list as $k=>$v){


                $store_info = Model('store')->getStoreInfoByID($v['store_id']);

                if($store_info['is_own_shop'] || $store_info['store_id'] == '22'  || $store_info['store_is_shuhua_'] == 1){

                    $result =  $this->fenpeiCrmOrderOp($v,$this->member_info);

                    var_dump($result);

                    exit;




                    // //查询订单支付状态
                    // $order_info = Model('order')->getOrderInfo(array('order_id'=>$v['order_id']),array(),'order_id,buyer_id,order_amount,payment_time,payment_code,order_state');
                    // $DaiYunStoreId=0;
                    // if($store_info['store_is_shuhua_'] == 1){
                    //     $DaiYunStoreId=$store_info['store_id'];
                    // }
                    // //获取业务信息
                    // $yw_info_get = file_get_contents(CRM_SITE_URL.'/index.php?m=api&p=action&c=userOrder&ID='.$this->member_info['member_id'].'&M='.$this->member_info['member_mobile'].'&N='.urlencode($this->member_info['member_name']).'&store_id='.$DaiYunStoreId);
                    
                    // $yw_info = explode('|',gbk_to_utf8($yw_info_get));
                    // $insert_data = array();
                    // $insert_data['Number'] = $yw_info[0];
                    // $insert_data['UserID'] = intval($yw_info[1]);
                    // $insert_data['MemberName'] = $yw_info[2];
                    // $insert_data['team'] = intval($yw_info[3]);
                    // $insert_data['ShopID'] = $this->member_info['member_id'];
                    // $insert_data['bumen'] = intval($yw_info[4]);
                    // $insert_data['MemberID'] = intval($yw_info[5]);
                    // $insert_data['order_sn'] = $v['order_sn'];
                    // $insert_data['orderid'] = $v['order_id'];
                    // if($order_info['order_state'] == '20'){ //20已支付
                    //     if($order_info['payment_code'] != 'offline'){
                    //         $insert_data['review'] = 1;
                    //         $insert_data['confirm_time'] = $order_info['payment_time'];
                    //         $insert_data['order_status'] = 1;
                    //         $insert_data['shipping_status'] = 5;
                    //         $insert_data['pay_status'] = 2;
                    //         @file_get_contents(CRM_SITE_URL."/index.php?m=api&p=action&c=updateTime&uid=".$order_info['buyer_id']."");

                    //     }
                    // }
                    // Model('order')->ywInfoInsert($insert_data);//存入业务info
                }
            }
        }



    }



    private function fenpeiCrmOrderOp($order = '',$member = ''){

        // 数据不能为空
        if(empty($order) || empty($member) || !is_array($order) || !is_array($member)){
            return false;
        }

        // 注册时间超过15天返回false
        // if($member['member_time'] <= (time() - 86400*15)){
        //     return false;
        // }

        // $mobile = $member[''];


        var_dump($member);


        return true;

        // $yw_info_get = file_get_contents(CRM_SITE_URL.'/index.php?m=api&p=action&c=testMobile&M=15158365448');


        // var_dump($yw_info_get);

    }




    /* 测试82698 */
    public function test82698Op(){

        $http = strtolower($_SERVER['HTTP_HOST']);

        if($http == 'ads.82698.com'){
            header('HTTP/1.1 404 Not Found'); 
            header('status: 404 Not Found');
            exit();
        }

    }



    /* 秒杀订单会员 */
    public function miaosha_order_memberOp(){

        exit;

        $mobile = $_GET['lt'];

        echo JieMiMobile($mobile);

        exit;

        $order_list = Model()->query("SELECT o.*,m.member_name,m.member_id,m.member_time,FROM_UNIXTIME(m.member_time,'%Y-%m-%d %H:%i:%S') as member_z_time FROM  `shop_order_goods` as o LEFT JOIN `shop_member` as m ON o.buyer_id = m.member_id WHERE  o.`goods_type` =6 GROUP BY o.buyer_id ORDER BY o.rec_id DESC;");

        var_dump($order_list);

    }


        /* 秒杀订单会员 */
    public function jiamiOp(){

        $mobile = $_GET['lt'];

        echo JiaMiMobile($mobile);

        exit;

        $order_list = Model()->query("SELECT o.*,m.member_name,m.member_id,m.member_time,FROM_UNIXTIME(m.member_time,'%Y-%m-%d %H:%i:%S') as member_z_time FROM  `shop_order_goods` as o LEFT JOIN `shop_member` as m ON o.buyer_id = m.member_id WHERE  o.`goods_type` =6 GROUP BY o.buyer_id ORDER BY o.rec_id DESC;");

        var_dump($order_list);

    }


    /*艺术家生涯*/
    public function artist_Op(){

        $artist_list = Model('artist')->field('A_Name,A_ShenYa')->page('1000')->select();


        foreach ($artist_list as $key => &$value) {
            $str = '';

            $value['A_ShenYa'] = html_entity_decode($value['A_ShenYa']);

            preg_match_all("/<div.*?class=\"shmj_box.*?div>/ism",$value['A_ShenYa'],$matches);

            $str = $matches['0']['0'];

            $str = str_replace("<div class=\"shmj_box\">",'',$str);

            $str = str_replace("<dd>",'',$str);

            $str = str_replace("</dd>",'',$str);

            $str = str_replace("<dt>",'',$str);

            $str = str_replace("</dt>",'',$str);

            $str = str_replace("</div>",'',$str);

            $str = preg_replace('/\s+/','',$str);

            $str = str_replace("</dl>",'</dl>-----',$str);

            $value['A_ShenYa'] = $str;
        }

        foreach ($artist_list as $key => $value) {
            file_put_contents('artist_shengya.txt',$value['A_Name'].'-----11-----',FILE_APPEND);
            file_put_contents('artist_shengya.txt',$value['A_ShenYa'].'-----22-----',FILE_APPEND);
        }

    }


    /*查询所有专题多返保证金*/
    public function lepaiFanMoneyOp(){
        $list = Model()->query("SELECT lg_desc,count(`lg_member_name`) AS C FROM `shop_pd_log` WHERE `lg_type`='lepai_tuihuan' GROUP BY `lg_desc` HAVING count(`lg_member_name`)>1 ORDER BY C DESC;");

        $MoneyArr = array();

        foreach ($list as $key => $value) {
            $condition['lg_desc'] = $value['lg_desc'];
            $d_member_money = Model()->table('pd_log')->field("*,count('lg_member_name') as c")->where($condition)->group('lg_member_name')->having("count('lg_member_name')>1")->page(500)->select();
            if(!empty($d_member_money)){
                foreach ($d_member_money as $k => $v) {
                    $MoneyArr[$v['lg_member_id'].$key.$k]['lg_member_id'] = $v['lg_member_id'];
                    $MoneyArr[$v['lg_member_id'].$key.$k]['lg_member_name'] = $v['lg_member_name'];
                    $MoneyArr[$v['lg_member_id'].$key.$k]['lg_av_amount'] = $v['lg_av_amount'];
                    $MoneyArr[$v['lg_member_id'].$key.$k]['lg_desc'] = $v['lg_desc'];
                    $MoneyArr[$v['lg_member_id'].$key.$k]['c'] = $v['c'];
                    $MoneyArr[$v['lg_member_id'].$key.$k]['lg_add_time'] = $v['lg_add_time'];
                }
            }
        }  


        echo '<table border=1>';
        echo '<tr><td>会员ID</td><td>会员名称</td><td>退款金额</td><td>备注</td><td>数量</td><td>时间</td></tr>';

        foreach ($MoneyArr as $k => $v) {
            echo '<tr>';
            foreach ($v as $key => $value) {
                echo '<td>'.$value.'</td>';
            }
            echo '</tr>';
        }


        echo '</table>';

        // var_dump($MoneyArr);

    }














    /*查询专题所有产品产修改积分缴纳状态*/
    public function lepai_pointsOp(){

        $tid = '153';
        exit;

        $theme_list = Model()->table('lepai_admin_goods')->field('G_Id,G_Tid')->where(array('G_Tid'=>$tid))->select();
        if(!empty($theme_list)){
            foreach ($theme_list as $key => $value) {
                if($value['G_Tid'] == $tid){
                    $this->save_lepai_pointsOp($v['G_Id']);
                }
            }
        }
    }

    /*修改乐拍积分缴纳状态*/
    private function save_lepai_pointsOp($goods_id){
        $list = Model()->query("SELECT *  FROM `shop_points_log` WHERE `pl_desc` LIKE '%{$goods_id}%' AND `pl_stage` LIKE 'other';");
        if(!empty($list)){
            $pl_lepai_type = 'lepai_jiaona';
            $pl_lepai_goodsid = '';
            foreach ($list as $k => $v) {
                $pl_lepai_goodsid = substr(trim($v['pl_desc']),-4);
                $update = array();
                $condition = array();
                if(empty($v['pl_lepai_type']) && empty($v['pl_lepai_goodsid'])){
                    $update['pl_lepai_type'] = $pl_lepai_type;
                    $update['pl_lepai_goodsid'] = $pl_lepai_goodsid;
                    $condition['pl_id'] = $v['pl_id'];
                    Model()->table('points_log')->where($condition)->update($update);
                }
            }
        }
    }



    public function lepai_testOp(){

        $baoming_list = Model()->query('SELECT * FROM `shop_lepai_baoming` WHERE `auction_id` in(SELECT G_Id FROM  `shop_lepai_admin_goods` WHERE  `G_Tid` = 145 ) HAVING type = 1;');

        var_dump($baoming_list);

    }



    public function test_lepai_jifenOp(){

        exit;

        $condition_jiaona['pl_memberid'] = 497284;
        $condition_jiaona['pl_lepai_type'] = 'lepai_jiaona';
        $condition_jiaona['pl_lepai_goodsid'] = 2791;
        $lepai_jiaona = Model()->table('points_log')->where($condition_jiaona)->find();



        $condition_tuihuan['pl_memberid'] = 497284;
        $condition_tuihuan['pl_lepai_type'] = 'lepai_tuihuan';
        $condition_tuihuan['pl_lepai_goodsid'] = 2791;
        $lepai_tuihuan = Model()->table('points_log')->where($condition_tuihuan)->find();


        var_dump($lepai_tuihuan);
    }



    public function test1111Op(){

        exit;

        $h_model = Model('lepai_home');

        $result = $h_model->tuihuanBZJ(7,3095,514876);

        var_dump($result);


        // $condition_jiaona['lg_member_id'] = 435376;
        // $condition_jiaona['lg_type'] = 'lepai_jiaona';
        // $condition_jiaona['lg_lepai_goodsid'] = 2765;
        // $lepai_jiaona = Model()->table('pd_log')->where($condition_jiaona)->find();



        // $condition_tuihuan['lg_member_id'] = 435376;
        // $condition_tuihuan['lg_type'] = 'lepai_tuihuan';
        // $condition_tuihuan['lg_lepai_goodsid'] = 2648;
        // $lepai_tuihuan = Model()->table('pd_log')->where($condition_tuihuan)->find();


        // var_dump($lepai_tuihuan);


    }


    public function saveWxUserOp(){

        exit;

        $weixin = new weixinSDK();
        $token = $weixin->token;

        $next_openid = 'ocmCHjhmqvWENL1MRTxpDrjYST5g';

        $user_result = file_get_contents("https://api.weixin.qq.com/cgi-bin/user/get?access_token=".$token."&next_openid={$next_openid}");

        $user = json_decode($user_result);

        /*拼接SQL中的IN值*/
        foreach($user->data->openid as $v){
            $in .= "'".$v."',";
        }
        $in = rtrim($in,',');

        $field = 'member_id';

        $member_id_list = Model()->query("SELECT member_id FROM shop_member WHERE openid <>'' AND is_open <> 1 AND openid in(".$in.")");

        /*拼接SQL中的IN值*/
        foreach($member_id_list as $v){
            $id_in .= $v['member_id'].',';
        }

        $id_in = rtrim($id_in,',');

        Model()->query("UPDATE shop_member SET is_open='1' WHERE member_id IN(".$id_in.");");

    


    }


    public function test77Op(){
        exit;

        $h_model = Model('lepai_home');
        $condition = array();
        // $condition['G_Atype'] = '3';
        $condition['G_Tid'] = '98';
        $list = $h_model->table('lepai_admin_goods')->where($condition)->field('*')->select();


        foreach($list as $k=>$goods){
            $chujia_user = $h_model->getLepaiLogOne(array('auction_id'=>$goods['G_Id']));//最后出价用户


            if($chujia_user['price'] > 0){
                $member_info = Model('member')->getMemberInfoByID($chujia_user['member_id']);//获取买家信息
                
                if($goods['G_BaoliuMoney'] > 0 && $chujia_user['price'] < $goods['G_BaoliuMoney']){
                    //变更状态为流拍
                    $g_atype = 7;
                }else{
                    //变更状态为竞拍成功
                    $g_atype = 6;
                }



                //成功与流拍都退还保证金 竞拍成功用户暂不退还

                if($chujia_user['member_id'] > 0){
                    $baoming = $h_model->getLepaiBaomingSelect(array('auction_id'=>$goods['G_Id']));

                    



    try {
            $h_model->beginTransaction();


            foreach($baoming as $k=>$v){
                //如果竞拍状态为成功6，竞拍成功用户不退保证金
                if($g_atype == 6){
                    if($v['member_id'] == $chujia_user['member_id']){
                        continue;
                    }
                }



                $member_info = Model('member')->getMemberInfoByID($v['member_id']);


                //退还保证金 1现金，2收藏币，3免保证金
                if($v['type'] == 1){

                    //变更预存款
                    if($v['amount'] > 0){
                        $data_pd = array();
                        $data_pd['member_id'] = $member_info['member_id'];
                        $data_pd['member_name'] = $member_info['member_name'];
                        $data_pd['amount'] = intval($v['amount']);
                        $data_pd['auction_id'] = $chujia_user['member_id'];
                        $res = $h_model->changePd('lepai_tuihuan',$data_pd);
                    }else{
                        $res = true;
                    }

                }elseif($v['type'] == 2){

                    //变更积分
                    if($v['amount'] > 0){
                        $points_arr = array();
                        $points_arr['pl_memberid'] = $member_info['member_id'];
                        $points_arr['pl_membername'] = $member_info['member_name'];
                        $points_arr['pl_points'] = intval($v['amount']);
                        $points_arr['pl_desc'] = '【解冻】拍卖惠活动结束退还收藏币缴纳保证金，活动编号：'.$chujia_user['member_id'];
                        $res = Model('points')->savePointsLog('other',$points_arr);
                    }else{
                        $res = true;
                    }


                }elseif($v['type'] == 3){ //免保证金

                    $res = true;
                }else{
                    continue;
                }




                if (!$res) {
                    throw new Exception('更新失败');
                }else{
                    $update_res = $h_model->updateLepaiBaoming(array('is_return'=>'1'),array('id'=>$v['id']));
                    if(!$update_res){
                        throw new Exception('更新失败');
                    }
                }
            }

            $h_model->commit();
        }catch (Exception $e){
            $h_model->rollback();
            return false;
        }



                }


                // $sta = $h_model->tuihuanBZJ($g_atype,$goods['G_Id'],$chujia_user['member_id']);
                // var_dump($sta);
            }else{
                $g_atype = 7;
            }

        }

    }




    public function test6Op(){

        $shop_index = rkcache('shop_index', true);

        var_dump($shop_index);


    }




    public function test5Op(){

        // $sms = new Sms();
        // $sms->send('18701134009','尊敬的会员您好，您预约的商品【商品名称】已到货，赶快去下单吧！退订回T');

        // exit;
        
        $strat_time = strtotime("-30 day"); // 只通知最近30天的记录
    
        $model_arrtivalnotice = Model('arrival_notice');
        // 删除30天之前的记录
        $model_arrtivalnotice->delArrivalNotice(array('an_addtime' => array('lt', $strat_time), 'an_type' => array('in','1,2')));
    
        $count = $model_arrtivalnotice->getArrivalNoticeCount(array());
        $times = ceil($count/self::ARRIVAL_NOTICE_NUM);
        // if ($times == 0) return false;

        for ($i = 0; $i <= $times; $i++) {
    
            $notice_list = $model_arrtivalnotice->getArrivalNoticeList(array(), '*', $i.','.self::ARRIVAL_NOTICE_NUM);
            if (empty($notice_list)) continue;
    


            // 查询商品是否已经上架
            $goodsid_array = array();
            foreach ($notice_list as $val) {
                $goodsid_array[] = $val['goods_id'];
            }
            $goodsid_array = array_unique($goodsid_array);



            $goods_list = Model('goods')->getGoodsOnlineList(array('goods_id' => array('in', $goodsid_array), 'goods_storage' => array('gt', 0)), 'goods_id');
            if (empty($goods_list)) continue;
    
            // 需要通知到货的商品
            $goodsid_array = array();
            foreach ($goods_list as $val) {
                $goodsid_array[] = $val['goods_id'];
            }

            // 根据商品id重新查询需要通知的列表
            $notice_list = $model_arrtivalnotice->getArrivalNoticeList(array('goods_id' => array('in', $goodsid_array)), '*');
            if (empty($notice_list)) continue;


            foreach ($notice_list as $val) {
                $param = array();
                $param['code'] = 'arrival_notice';
                $param['member_id'] = '435376';
                $param['param'] = array(
                        'goods_name' => $val['goods_name'],
                        'goods_url' => urlShop('goods', 'index', array('goods_id' => $val['goods_id']))
                );
                $param['number'] = array('mobile' => '15927207778', 'email' => '1195555@qq.com');

                QueueClient::push('sendMemberMsg', $param);

                exit;
            }
    
            // 清楚发送成功的数据
            // $model_arrtivalnotice->delArrivalNotice(array('goods_id' => array('in', $goodsid_array)));
        }



    }




    public function test4Op(){
        $where = "order.order_state=10 and order_goods.goods_type='6' and payment_code != 'offline' and lock_state = 0 and add_time < 1461830140";
        $orders = Model()->table('order,order_goods')->field('*')->join('left')->on('order.order_id=order_goods.order_id')->where($where)->select();

        var_dump($orders);

    }




    public function test3Op(){
        $crontab_minutes = rkcache('crontab_minutes', true);

        var_dump($crontab_minutes);

        exit;

        $model_order = Model('order');
        $logic_order = Logic('order');
        $dotime = TIMESTAMP - (3600*72);//超过$frequency分钟
        
        $where = "order.order_state=10 and order_goods.goods_type='1' and order.payment_code = 'bank' and order.lock_state = 0 and order.add_time < '".$dotime."'";
        $orders = $model_order->table('order,order_goods')->field('*')->join('left')->on('order.order_id=order_goods.order_id')->where($where)->select();

        foreach($orders as $k => $v){
            $if_allow = $model_order->getOrderOperateState('buyer_cancel',$v);

            if ($if_allow === true) {
                $result = $logic_order->changeOrderStateCancel($v,'system','系统','银行转账订单超期未支付系统自动关闭');
            }else{
                continue;
            }
        }



    }


    public function test2Op(){

        var_dump(rkcache('crontab_minutes', true));

        $model_order = Model('order');
        $logic_order = Logic('order');
        $dotime = TIMESTAMP - (3600*24);//超过$frequency分钟
        
        $where = "order_state=10  and payment_code = 'online' and lock_state = 0 and add_time < '".$dotime."'";

        $orders = $model_order->table('order')->where($where)->select();

        // foreach($orders as $k => $v){
        //     $if_allow = $model_order->getOrderOperateState('buyer_cancel',$v);

        //     if ($if_allow === true) {
        //         $result = $logic_order->changeOrderStateCancel($v,'system','系统','在线支付订单超期未支付系统自动关闭');
        //     }else{
        //         continue;
        //     }
        // }


        var_dump($orders);



    }




    public function test1Op(){

        $model_order = Model('order');

        $condition['order_id'] = 518062;

        $order_info = $model_order->getOrderInfo($condition,array('order_goods','order_common','store'));

        // $order_info = $model_order->getOrderGoodsInfo(array('order_id'=>518062,'goods_type'=>6));

        foreach ($order_info['extend_order_goods'] as $v) {
            if($v['goods_type'] == 6){
                $miaosha_order_type = true;
            }
        }

        var_dump($order_info);



    }


    public function testOp(){

        /* Add is name lt 2016-04-25 秒杀和团购取消订单加回数量 */

        $model_order = Model('order');
        $model_miaosha = Model('miaosha');
        $model_groupbuy = Model('groupbuy');


        //秒杀
        // $goods_info = $model_order->getOrderGoodsInfo(array('order_id'=>517554,'goods_type'=>6));

        // $miaosha_goods_id = $goods_info['goods_id'];
        // $miaosha_goodsnum = $goods_info['goods_num'];

        // $miaosha_info = $model_miaosha->getMiaoshaList(array('goods_id'=>$miaosha_goods_id),null,'state asc','*',1);

        // $miaosha_id = $miaosha_info[0]['miaosha_id'];

        // $model_miaosha->table('miaosha')->where(array('miaosha_id'=>$miaosha_id))->setDec('buyer_count',$miaosha_goodsnum);
        // $model_miaosha->table('miaosha')->where(array('miaosha_id'=>$miaosha_id))->setDec('buy_quantity',$miaosha_goodsnum);

        //团购
        // $tuangou_goods_info = $model_order->getOrderGoodsInfo(array('order_id'=>517640,'goods_type'=>2));

        // $tuangou_goods_id = $tuangou_goods_info['goods_id'];
        // $tuangou_goodsnum = $tuangou_goods_info['goods_num'];

        // $tuangou_info = $model_groupbuy->getGroupbuyList(array('goods_id'=>$tuangou_goods_id,'state'=>20),null,'state asc','*',1);

        // $tuangou_id = $tuangou_info[0]['groupbuy_id'];

        // $model_groupbuy->table('groupbuy')->where(array('groupbuy_id'=>$tuangou_id))->setDec('buyer_count',$tuangou_goodsnum);
        // $model_groupbuy->table('groupbuy')->where(array('groupbuy_id'=>$tuangou_id))->setDec('buy_quantity',$tuangou_goodsnum);


        var_dump($tuangou_info);



        /* End */

    }




    public function testMobanOp(){


        $dataArr = array(
            'first' => 'ltauto120,您好，您有一笔新订单生成哦~',
            'keyword1' => '8000000005370201',
            'keyword2' => '892',
            'keyword3' => '澳门生肖马钞-羊钞十连号/n',
            // 'keyword4' => '审核通过',
            // 'keyword5' => '2016-04-08',
            'remark' => "\n".'如果您有任何疑问，可咨询在线客服或致电客户服热线400-81-96567，我们将竭诚为您服务'
        );


        $wx_param = array(
            'func'=>'order_notice',
            'template_id'=>'',
            'openid'=>'ocmCHjvOcGWeMkzeXPBIMWTDRNaY',
            'url'=>'',
            'data'=>$dataArr,
        );





        QueueClient::push('sendWXTemplateMsg', $wx_param);



    }








      /**
     * @ 发送订单信息换取prepayID
     */
    public function send_payOp(){



        $this->value['appid'] = 'wx00d52d21505f383f';
        $this->value['attach'] = '支付测试';
        $this->value['body'] = '支付测试';
        $this->value['mch_id'] = '1226270402';
        $this->value['nonce_str'] = $this->createNoncestr();
        $this->value['notify_url'] = 'http://m.96567.com/api/payment/wxpay/notify_url.php';
        $this->value['openid'] = 'ocmCHjvOcGWeMkzeXPBIMWTDRNaY';
        $this->value['out_trade_no'] = time();
        $this->value['spbill_create_ip'] = '123.56.146.201';
        $this->value['total_fee'] = '1';
        $this->value['trade_type'] = 'WAP';
        $this->value['sign'] = $this->getSign($this->value);//生成签名





        $xml = $this->arrayToXml($this->value);





        $data = $this->httpsPOST($this->apiURL,$xml);



var_dump($data);

exit;

        $arr = $this->xmlToArray($data);



//        $arr['return_msg'] = iconv('utf-8','gbk',$arr['return_msg']);
//        $arr['err_code_des'] = iconv('utf-8','gbk',$arr['err_code_des']);
        //echo $arr['err_code_des'];
        if($arr['code_url'] != ""){
            return $arr;
        }
        $this->prepay_id = $arr['prepay_id'];
        //echo $this->prepay_id;
        //exit;
    }

    /**
     * @ 设置jsapi的参数
     */
    public function getParameters($type=0){
        $timeStamp = time();
        $jsApiObj["timeStamp"] = "$timeStamp";
        $jsApiObj["appId"] = WXN_APPID;
        $jsApiObj["nonceStr"] = $this->createNoncestr();
        $jsApiObj["package"] = "prepay_id=".$this->prepay_id;
        $jsApiObj["signType"] = "MD5";
        $jsApiObj["paySign"] = $this->getSign($jsApiObj);
        if($type){
            return json_encode($jsApiObj);
        }else{
            return $jsApiObj;
        }
    }


    function arrayToXml($arr){
        $xml = "<xml>";
        foreach ($arr as $key=>$val){
            if(is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";
        return $xml;
    }


    /**
     * @ 将xml转为array
     */
    public function xmlToArray($xml){
        //将XML转为array        
        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $array_data;
    }

    protected function httpsPOST($url,$data,$bianma=false){
        $ch = curl_init();
        $header = "Accept-Charset: utf-8";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        //$data = $bianma ? $data : iconv('gb2312','utf-8',$data);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        if(curl_errno($ch)){
            return 'Errno'.curl_error($ch);
        }
        curl_close($ch);
        return $tmpInfo;
    }

    /**
     * @ 生成签名
     */
    public function getSign($Obj){
        foreach ($Obj as $k => $v){ $value[$k] = $v; }

        $value = $this->parafilter($value);
        //签名步骤一：按字典序排序参数
        $String = $this->formatBizQueryParaMap($value, false);
        $String = $String."&key=".$this->keyStr;

        $String = md5($String);
        $result_ = strtoupper($String);
        return $result_;
    }

    /**
     * @ 格式化参数，签名过程需要使用
     */
    function formatBizQueryParaMap($paraMap, $urlencode){
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v){
            if($urlencode){ $v = urlencode($v); }
            $buff .= $k . "=" . $v . "&";
        }
        $reqPar;
        if (strlen($buff) > 0){
            $reqPar = substr($buff, 0, strlen($buff)-1);
        }
        return $reqPar;
    }

    /**
     *  @ 设置请求参数
     */
    function setParameter($parameter, $parameterValue){
        $this->value[trim($parameter)] = trim($parameterValue);
    }

    /**
     * @ 产生随机字符串，不长于32位
     */
    public function createNoncestr($length = 32) {
        $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
        $str ="";
        for ($i = 0; $i < $length; $i++ ){
            $str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);
        }
        return $str;
    }

    /**
     * 验证服务器通知 ->支付回调验签使用
     * @param array $data
     * @return array
     */
    public function verify() {
        $post = $_POST;
        $sign = $_POST['sign'];
        $para = $this->parafilter($post);
        $para = $this->argsort($para);
        $signValue = $this->createlinkstring($para);
        $signValue = $signValue."&key=".$this->keyStr;
        $signValue = strtoupper(md5($signValue));
        if ( $sign == $signValue ){
            return true;
        }else{
            return false;
        }

    }

    /**
     * 除去数组中的空值和签名参数 ->支付回调验签使用
     * @param $para 签名参数组
     * return 去掉空值与签名参数后的新签名参数组
     */
    public  function parafilter($para) {
        $para_filter = array();
        foreach ($para as $key => $val ) {
            if($key == "sign_method" || $key == "sign" ||$val == "")continue;
            else    $para_filter[$key] = $para[$key];
        }
        return $para_filter;
    }

    /**
     * 对数组排序 ->支付回调验签使用
     * @param $para 排序前的数组
     * return 排序后的数组
     */
    public function argsort($para) {
        ksort($para);
        reset($para);
        return $para;
    }

    /**
     * 把数组所有元素，按照“参数=参数值”的模式用“&”字符拼接成字符串 ->支付回调验签使用
     * @param $para 需要拼接的数组
     * return 拼接完成以后的字符串
     */
    public function createlinkstring($para) {
        $arg  = "";
        foreach ($para as $key => $val ) {
            $arg.=strtolower($key)."=".$val."&";
        }
        //去掉最后一个&字符
        $arg = substr($arg,0,count($arg)-2);

        //如果存在转义字符，那么去掉转义
        if(get_magic_quotes_gpc()){$arg = stripslashes($arg);}

        return $arg;

    }























}