<?php
/**
 * 艺术家官网手机首页
 *
 *
 */


defined('InShopNC') or exit('Access Invalid!');
class artistControl extends mobileHomeControl{

	public function __construct() {
        parent::__construct();
		Tpl::setDir('artist');
		Tpl::setLayout('artist_layout');
    }

    /**
     * 首页
     */
	public function indexOp() {
		//zmr>v30
		$model_mb_special = Model('mb_special'); 
        $data = $model_mb_special->getMbSpecialIndex(1);

        //Tpl::output('no_header',true);
		Tpl::output('adv_list',$data[0]['adv_list']['item']); //获取轮播图片
		//获取秒杀产品
		$miaosha_classes = Model('miaosha_class')->getList(array('order'=>' start_hour asc '));
        $new_classes = array();
        foreach($miaosha_classes as $k=>$v){
            $new_classes[$v['class_id']] = $v;
        }
		$AND = " AND goods_id in(SELECT goods_id FROM shop_goods where `shop_goods`.goods_id = `shop_miaosha`.goods_id AND `shop_goods`.gc_id_1 = 79)";
		$miaosha_list = Model('miaosha')->getMiaoshaCommendedList(6,$AND);
		if($miaosha_list){
			foreach($miaosha_list as $k=>$v){
				   $start_hour = $new_classes[$v['class_id']]['start_hour'];
				   $end_hour   = $new_classes[$v['class_id']]['end_hour'];
				   $goods_info = Model('goods')->getGoodsInfoByID($v['goods_id']);
				   $yu_quantity = $v['max_quantity']-$v['buy_quantity'];
				   $miaosha_list[$k]['shengyukucun'] = ($yu_quantity >= $goods_info['goods_storage'])?$goods_info['goods_storage']:$yu_quantity;
				   $miaosha_list[$k]['end'] = 3;
				   if(date('H',time()) >= $start_hour && date('H',time()) < $end_hour && $miaosha_list[$k]['shengyukucun'] > 0){
						$miaosha_list[$k]['end'] = 2; //进行中
				   }elseif (date('H',time()) >= $end_hour || $miaosha_list[$k]['shengyukucun'] == 0) {
						$miaosha_list[$k]['end'] = 1; //已结束
				   } else {
						$miaosha_list[$k]['end'] = 3; //即将开始
				   }
			}
		}
        Tpl::output('miaosha_list', $miaosha_list);
        /*加载SEO*/
        Tpl::output('html_title','国画收藏_书法收藏_书画收藏_书法字画拍卖_收藏天下书画馆');
        Tpl::output('seo_keywords','国画收藏,书法收藏,书画收藏,书法字画拍卖,版画收藏,书画馆');
        Tpl::output('seo_description','收藏天下书画馆为您提供收藏价值极高的国画,书法,书画,版画等珍稀藏品!并有书法字画拍卖中心,为您拍卖各类图画书法等各类收藏品!');
		 // 艺术家推荐
        $model_artist = Model('artist_new');
        $condition_artist['A_Push'] = 1;
        $field_artist = 'A_Id,A_Name,A_MiaoShu,A_Img,A_ZhiCheng';
        $order_artist = 'A_OrderBy DESC , A_Id DESC';
        $artist_push_list = $model_artist->getArtistList($condition_artist,$field_artist);
		Tpl::output('artist_push_list', $artist_push_list);
		Tpl::output('IsIndex',true);
        Tpl::showpage('index');
	}


	/**
     * 加载手机版后台设置模版
     */
	public function shopMtelOp() {
        $model_mb_special = Model('mb_special'); 
        $data = $model_mb_special->getMbSpecialIndex(1);
		if(empty($data))
		{
			$data=array();
		}
		output_data($data);
	}


	/**
     * 选画中心分类
     */
	public function FenLeiOp() {
		 /*加载SEO*/
        Tpl::output('html_title','山水花鸟人物画|风景动物画|草书隶书楷书|行书篆书|收藏天下书画馆');
        Tpl::output('seo_keywords','书法画,图画,油画,版画,山水画,花鸟画,人物画,风景画,动物画,草书,隶书,楷书,行书,篆书');
        Tpl::output('seo_description','收藏天下书画馆选画中心为您提供书法画,图画,油画,版画,山水画,花鸟画,人物画,风景画,动物画,草书,隶书,楷书,行书,篆书等各类书法字画藏品!');
		Tpl::output('XuanHuaType', 'FenLei');
		Tpl::output('IsIndex',true);
        Tpl::showpage('FenLei');
	}

}
