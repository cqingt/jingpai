<?php
/**
 * 缓存操作
 *
 *
 *
 *
 
 */
defined('InShopNC') or exit('Access Invalid!');
class cacheModel extends Model {

	public function __construct(){
		parent::__construct();
	}

	public function call($method){
		$method = '_'.strtolower($method);
		if (method_exists($this,$method)){
			return $this->$method();
		}else{
			return false;
		}
	}

	/**
	 * 基本设置
	 *
	 * @return array
	 */
	private function _setting(){
		$list =$this->table('setting')->limit(false)->select();
		$array = array();
		foreach ((array)$list as $v) {
			$array[$v['name']] = $v['value'];
		}
		unset($list);
		return $array;
	}

	/**
	 * 商品分类SEO
	 *
	 * @return array
	 */
	private function _goods_class_seo(){

		$list = $this->table('goods_class')->field('gc_id,gc_title,gc_keywords,gc_description')->where(array('gc_keywords'=>array('neq','')))->limit(false)->select();
		if (!is_array($list)) return null;
		$array = array();
		foreach ($list as $k=>$v) {
			if ($v['gc_title'] != '' || $v['gc_keywords'] != '' || $v['gc_description'] != ''){
				if ($v['gc_name'] != ''){
					$array[$v['gc_id']]['name'] = $v['gc_name'];
				}
				if ($v['gc_title'] != ''){
					$array[$v['gc_id']]['title'] = $v['gc_title'];
				}
				if ($v['gc_keywords'] != ''){
					$array[$v['gc_id']]['key'] = $v['gc_keywords'];
				}
				if ($v['gc_description'] != ''){
					$array[$v['gc_id']]['desc'] = $v['gc_description'];
				}
			}
		}
		return $array;
	}

	/**
	 * 商城主要频道SEO
	 *
	 * @return array
	 */
	private function _seo(){
		$list =$this->table('seo')->limit(false)->select();
		if (!is_array($list)) return null;
		$array = array();
		foreach ($list as $key=>$value){
			$array[$value['type']] = $value;
		}
		return $array;
	}

	/**
	 * 快递公司
	 *
	 * @return array
	 */
	private function _express(){
	    $fields = 'id,e_name,e_code,e_letter,e_order,e_url,e_zt_state';
		$list = $this->table('express')->field($fields)->order('e_order,e_letter')->where(array('e_state'=>1))->limit(false)->select();
		if (!is_array($list)) return null;
		$array = array();
		foreach ($list as $k=>$v) {
			$array[$v['id']] = $v;
		}
		return $array;
	}

	/**
	 * 自定义导航
	 *
	 * @return array
	 */
	private function _nav(){
		$list = $this->table('navigation')->order('nav_sort')->limit(false)->select();
		if (!is_array($list)) return null;
		return $list;
	}

	/**
	 * 抢购价格区间
	 *
	 * @return array
	 */
	private function _groupbuy_price(){
		$price = $this->table('groupbuy_price_range')->order('range_start')->key('range_id')->select();
		if (!is_array($price)) $price = array();

		return $price;
	}

	/**
	 * 商品TAG
	 *
	 * @return array
	 */
	private function _class_tag(){
		$field = 'gc_tag_id,gc_tag_name,gc_tag_value,gc_id,type_id';
		$list = $this->table('goods_class_tag')->field($field)->limit(false)->select();
		if (!is_array($list)) return null;
		return $list;
	}

	/**
	 * 店铺分类
	 *
	 * @return array
	 */
	private function _store_class(){
	    $store_class_tmp = $this->table('store_class')->limit(false)->order('sc_sort asc,sc_id asc')->select();
	    $store_class = array();
	    if (is_array($store_class_tmp) && !empty($store_class_tmp)){
	    	foreach ($store_class_tmp as $k=>$v){
	    	    $store_class[$v['sc_id']] = $v;
	    	}
	    }
	    return $store_class;
	}

	/**
	 * 店铺等级
	 *
	 * @return array
	 */
	private function _store_grade(){
		$list =$this->table('store_grade')->limit(false)->select();
		$array = array();
		foreach ((array)$list as $v) {
			$array[$v['sg_id']] = $v;
		}
		unset($list);
		return $array;
	}

	/**
	 * 店铺等级
	 *
	 * @return array
	 */
	private function _store_msg_tpl(){
		$list = Model('store_msg_tpl')->getStoreMsgTplList(array());
		$array = array();
		foreach ((array)$list as $v) {
			$array[$v['smt_code']] = $v;
		}
		unset($list);
		return $array;
	}

	/**
	 * 店铺等级
	 *
	 * @return array
	 */
	private function _member_msg_tpl(){
		$list = Model('member_msg_tpl')->getMemberMsgTplList(array());
		$array = array();
		foreach ((array)$list as $v) {
			$array[$v['mmt_code']] = $v;
		}
		unset($list);
		return $array;
	}

	/**
	 * 咨询类型
	 *
	 * @return array
	 */
	private function _consult_type(){
		$list = Model('consult_type')->getConsultTypeList(array());
		$array = array();
		foreach ((array)$list as $val) {
		    $val['ct_introduce'] = html_entity_decode($val['ct_introduce']);
			$array[$val['ct_id']] = $val;
		}
		unset($list);
		return $array;
	}

	/**
	 * Circle Member Level
	 *
	 * @return array
	 */
	private function _circle_level(){
		$list = $this->table('circle_mldefault')->limit(false)->select();

		if (!is_array($list)) return null;
		$array = array();
		foreach ($list as $val){
			$array[$val['mld_id']] = $val;

		}
		return $array;
	}

    //增加首页所有sql存缓存
    private function _shop_index(){
        //抢购专区
        $model_groupbuy = Model('groupbuy');
        $group_list = $model_groupbuy->getGroupbuyCommendedList(4);

        //秒杀
        $miaosha_list = Model('miaosha')->getMiaoshaCommendedList(6);

        //收藏学院
        $article_model = Model('cms_article');
        //行情快讯
        $hqkx = $article_model->getList(array('article_state'=>'3','article_class_id'=>'20'),null,'article_publish_time desc','*','6');
        Tpl::output('hqkx',$hqkx);

        //热点关注
        $rdgz = $article_model->getList(array('article_state'=>'3','article_class_id'=>'39'),null,'article_publish_time desc','*','6');
        Tpl::output('rdgz',$rdgz);

        //每日报价
        $mrbj = $article_model->getList(array('article_state'=>'3','article_class_id'=>'41'),null,'article_publish_time desc','*','6');
        Tpl::output('mrbj',$mrbj);

		//商城公告
		$GongGao = Model('article')->getArticleList(array('ac_id'=>'1','article_show'=>'1','limit'=>'4'));
        Tpl::output('GongGao',$GongGao);
		

        //友情链接
        $model_link = Model('link');
        $link_list = $model_link->getLinkList(array());

        //限时折扣
        $model_xianshi_goods = Model('p_xianshi_goods');
        $xianshi_item = $model_xianshi_goods->getXianshiGoodsCommendList(4);

        //乐拍信息
        $lepai_item =  Model('lepai_home')->getGoodsInfoLimit(array('G_EndTime'=>array('gt',TIMESTAMP),'G_Atype'=>'3'),3);

        //板块信息
        $model_web_config = Model('web_config');
        $web_html = $model_web_config->getWebHtml('index');


        /*收藏社会区大家说版块*/

        $evaluate_goods_model = Model('evaluate_goods');
        $new_ping = $evaluate_goods_model->field('geval_goodsid')->page(20)->order('geval_id desc')->select();
        $ping_goods = '';
        foreach($new_ping as $k=>$v){
            $ping_goods .= $v['geval_goodsid'].',';
        }
        $ping_goods_ids = substr($ping_goods,0,-1);
        $shoucang = Model('goods')->getGoodsList(array('goods_id'=>array('in',$ping_goods_ids),'goods_state'=>'1'));

        foreach($shoucang as $k => &$v){
            $v['G_Ping'] = Model('evaluate_goods')->field('geval_content')->where("geval_scores=5 AND geval_goodsid='".$v['goods_id']."'")->page(10)->order('geval_id desc')->select();
        }

        $array = array(
            'cache_time'    =>  TIMESTAMP,
            'group_list'    =>  $group_list,
            'miaosha_list'  =>  $miaosha_list,
            'hqkx'          =>  $hqkx,
            'rdgz'          =>  $rdgz,
            'mrbj'          =>  $mrbj,
            '$link_list'    =>  $link_list,
            'xianshi_item'  =>  $xianshi_item,
            'lepai_item'    =>  $lepai_item,
            'web_html'      =>  $web_html,
            'shoucang'      =>  $shoucang,
			'GongGao'      =>  $GongGao,
        );
        return $array;
    }

	//增加sql艺术家官网首页缓存
	private function _artist_index(){
		//商城公告
		$GongGao = Model('article')->getArticleList(array('ac_id'=>'9','article_show'=>'1','limit'=>'4'));
       
		$AND = " AND goods_id in(SELECT goods_id FROM shop_goods where `shop_goods`.goods_id = `shop_miaosha`.goods_id AND `shop_goods`.gc_id_1 = 79)";
		//获取书画分类下边的秒杀活动
        $miaosha_list = Model('miaosha')->getMiaoshaCommendedList(6,$AND);

		//板块信息
        $model_web_config = Model('web_config');
        $web_html = $model_web_config->getWebHtml('artist_index',1);

		 // 艺术家推荐
        $model_artist = Model('artist_new');
        $condition_artist['A_Push'] = 1;
        $field_artist = 'A_Id,A_Name,A_MiaoShu,A_Img,A_ZhiCheng';
        $order_artist = 'A_OrderBy DESC , A_Id DESC';
        $artist_push_list = $model_artist->getArtistList($condition_artist,$field_artist);

		// 艺术交流
       // $condition_zixun['article_publisher_id'] = 306418;
        $condition_zixun['article_class_id'] = 74;
        $field_zixun = 'article_id,article_title';
        $order_zixun = 'article_sort DESC , article_id DESC';
        $artist_zixun_list = $model_artist->getYishuZixun($condition_zixun,$field_zixun,10,$order_zixun);
		
		 //收藏学院
        $article_model = Model('cms_article');
		 //行情快讯
        $hqkx = $article_model->getList(array('article_state'=>'3','article_class_id'=>'55'),null,'article_publish_time desc','*','10');

        //热点关注
        $rdgz = $article_model->getList(array('article_state'=>'3','article_class_id'=>'75'),null,'article_publish_time desc','*','10');

        //每日报价
        $mrbj = $article_model->getList(array('article_state'=>'3','article_class_id'=>'76'),null,'article_publish_time desc','*','10');

		$array = array(
            'cache_time'    =>  TIMESTAMP,
            'miaosha_list'  =>  $miaosha_list,
            'GongGao'          =>  $GongGao,
            'web_html'      =>  $web_html,
			'artist_push_list' =>$artist_push_list,
			'artist_zixun_list' =>$artist_zixun_list,
			'hqkx'          =>  $hqkx,
            'rdgz'          =>  $rdgz,
            'mrbj'          =>  $mrbj,
        );
        return $array;
	}
}
