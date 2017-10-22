<?php
/**
 * 艺术家首页
 *
 ***/
defined('InShopNC') or exit('Access Invalid!');

class artist_newControl extends ArtistHomeControl {

	//每页显示商品数
    const PAGESIZE = 20;

    //书画默认大类
    const DEFAULT_CLASS = 79;

    //艺术分类
    private $_yishu_class = array('1'=>'书画','2'=>'国画','3'=>'油画','4'=>'版画');

    //模型对象
    private $_model_search;

	public function __construct() {
        parent::__construct();

        Tpl::output('selOp',$_GET['op']?$_GET['op']:'');
    }


	/**
	 * 默认进入页面

	 */
	public function indexOp(){
        // 艺术家推荐
        $model_artist = Model('artist_new');
        $condition_artist['A_Push'] = 1;
        $field_artist = 'A_Id,A_Name,A_MiaoShu,A_Img';
        $order_artist = 'A_OrderBy DESC , A_Id DESC';
        $artist_push_list = $model_artist->getArtistList($condition_artist,$field_artist);

        // 收藏推荐和作品推荐
        $model_web_config = Model('web_config');
        $condition_push['web_page'] = 'artist';
        $condition_push['web_show'] = 1;
        $web_list = $model_web_config->getWebList($condition_push);

        // 艺术资讯
        $condition_zixun['article_publisher_id'] = 306418;
        $condition_zixun['article_class_id'] = 55;
        $field_zixun = 'article_id,article_title';
        $order_zixun = 'article_sort DESC , article_id DESC';
        $artist_zixun_list = $model_artist->getYishuZixun($condition_zixun,$field_zixun,6,$order_zixun);

        // 首页轮播图
        // $model_adv = Model('adv');
        // $condition_adv['ap_id'] = 1090;
        // $artist_index_adv_list = $model_adv->getList($condition_adv);

        // foreach ($artist_index_adv_list as $k => &$v) {
        //     $adv_pic = unserialize($v['adv_content']);

        //     $v['adv_pic'] = $adv_pic['adv_pic'];
        //     $v['adv_pic_url'] = $adv_pic['adv_pic_url'];
        // }
        $model_web_config = Model('web_config');
        $web_id = '211';
        $code_list = $model_web_config->getCodeList(array('web_id'=> $web_id));
        if(is_array($code_list) && !empty($code_list)) {
            foreach ($code_list as $key => $val) {//将变量输出到页面
                $var_name = $val['var_name'];
                $code_info = $val['code_info'];
                $code_type = $val['code_type'];
                $val['code_info'] = $model_web_config->get_array($code_info,$code_type);
                $artist_index_adv_list[] = $val;
                // Tpl::output('code_'.$var_name,$val);
            }
        }

         // 艺术相册
        $order_img = 'I_Xu DESC , I_Id DESC';
        $artist_img_list = $model_artist->getArtistImages('',5,$order_img);


        Tpl::output('artist_img_list', $artist_img_list);
        Tpl::output('artist_index_adv_list',$artist_index_adv_list);
        Tpl::output('artist_zixun_list',$artist_zixun_list);
        Tpl::output('artist_push_list',$artist_push_list);
        Tpl::output('web_list',$web_list);
		Tpl::showpage('index');
	}





	/**
	 * 艺术家频道-艺术名家
	 
	 */
	public function searchArtistOp(){
		
        $model_artist = Model('artist_new');

        $zhiwei = $model_artist->getYishuZhiwei();
        
        $address = $model_artist->getYishuAddress();

        //艺术分类
        if (!empty(intval($_GET['class']))) {
            $condition['A_Class'] = intval($_GET['class']);;
        }

        //地区名家
        if (!empty(intval($_GET['address']))) {
            $condition['A_JiGuan'] = intval($_GET['address']);
        }

        //职位
        if (!empty(intval($_GET['zhiwei']))) {
            $condition['A_Position'] = array(array('like',"%$_GET[zhiwei]%"));
        }

        //搜索词
        if (!empty($_GET['keyword'])) {
            $condition['A_Name'] = array(array('like',"%$_GET[keyword]%"));
        }

        $field = 'A_Id,A_Name,A_ZhiCheng,A_Img';

        $order_by = 'A_OrderBy ASC';

        $artist_list_info = $model_artist->getArtistList($condition,$field,'',$order_by,20);

        // Dump($artist_list_info);

        Tpl::output('artist_list', $artist_list_info);

        Tpl::output('show_page', $model_artist->showpage(3));

        Tpl::output('yishuClass',$this->_yishu_class);

        Tpl::output('zhiwei',$zhiwei);

        Tpl::output('address',$address);
        
        Tpl::showpage('search_artist');
	}





	/**
	 * 艺术家频道-选画中心
	 
	 */
	public function searchShuHuaOp(){

		$model_artist = Model('artist_new');

		$this->_model_search = Model('search');

		$yiShuClass = $model_artist->getYishuClass(self::DEFAULT_CLASS);

		$default_classid = intval($_GET['cate_id']);

		list($goods_param, $brand_array, $attr_array, $checked_brand, $checked_attr) = $this->_model_search->getAttr($_GET, $default_classid);
        Tpl::output('brand_array', $brand_array);
        Tpl::output('attr_array', $attr_array);
        Tpl::output('checked_brand', $checked_brand);
        Tpl::output('checked_attr', $checked_attr);

        // Dump($checked_attr);

        $order = 'goods_id desc';

        if (in_array($_GET['order_key'],array('1','2','3'))) {
            $sequence = $_GET['order'] == '1' ? 'asc' : 'desc';
            $order = str_replace(array('1','2','3'), array('goods_salenum','goods_click','goods_promotion_price'), $_GET['order_key']);
            $order .= ' '.$sequence;
        }

        $model_goods = Model('goods');

        // 字段

        $fields = "goods_id,goods_commonid,goods_name,goods_jingle,artist_id,gc_id,store_id,store_name,goods_price,goods_promotion_price,goods_promotion_type,goods_marketprice,goods_storage,goods_image,goods_freight,goods_salenum,color_id,evaluation_good_star,evaluation_count,is_virtual,is_fcode,is_appoint,is_presell,have_gift,is_own_shop";

        $condition['gc_id'] = $goods_param['class']['gc_id']?$goods_param['class']['gc_id']:self::DEFAULT_CLASS;

        //艺术家名搜索
        if(intval($_GET['key_type']) === 1 && !empty($_GET['keyword'])){
        	$artist_info = $model_goods->table('artist')->field('A_Id')->where(array('A_Name'=>$_GET['keyword']))->find();
        	$condition['artist_id'] = $artist_info['A_Id'];
        }

        //作品名
        if(intval($_GET['key_type']) === 2 && !empty($_GET['keyword'])){
        	$condition['goods_name'] = array(array('like',"%$_GET[keyword]%"));
        }


        //自营
        if ($_GET['is_shop'] == 1) {
            $condition['is_own_shop'] = 1;
        }

        //分类检索后的商品ID
        if (isset($goods_param['goodsid_array'])){
            $condition['goods_id'] = array('in', $goods_param['goodsid_array']);
        }

        $goods_list = $model_goods->getGoodsListByColorDistinct($condition, $fields, $order, self::PAGESIZE);


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


        // Dump($goods_list);

        Tpl::output('goods_list', $goods_list);

        Tpl::output('totalNum', $model_goods->getTotalNum());
        Tpl::output('show_page', $model_goods->showpage(3));


		Tpl::output('yiShuClass',$yiShuClass);
		Tpl::output('goodsAttribute',$goodsAttribute);
		Tpl::showpage('search_shuhua');
	}


















}


?>