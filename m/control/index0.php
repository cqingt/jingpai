<?php
/**
 * 手机首页
 *
 *
 *
 * by 33hao.com 好商城V3 运营版
 */


defined('InShopNC') or exit('Access Invalid!');
class indexControl extends mobileHomeControl{

	public function __construct() {
        parent::__construct();
    }

    /**
     * 首页
     */
	public function indexOp() {
		//zmr>v30
		$zmr=intval($_GET['zmr']);
		if($zmr>0)
		{
		   setcookie('zmr', $zmr);
		}
		$model_mb_special = Model('mb_special'); 
        $data = $model_mb_special->getMbSpecialIndex();

        Tpl::output('no_header',true);
		Tpl::output('adv_list',$data[0]['adv_list']['item']); //获取轮播图片
		//获取秒杀产品
		$miaosha_classes = Model('miaosha_class')->getList(array('order'=>' start_hour asc '));
        $new_classes = array();
        foreach($miaosha_classes as $k=>$v){
            $new_classes[$v['class_id']] = $v;
        }
		$miaosha_list = Model('miaosha')->getMiaoshaCommendedList(3);
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
		//乐拍信息
		$lepai_item =  Model('lepai_home')->getGoodsInfoLimit(array('G_EndTime'=>array('gt',TIMESTAMP)),1);
		$lepai_item[0]['T_Click'] = Model('lepai_home')->getGoodsSum(array('G_Id'=>$lepai_item[0]['G_Id']),'G_Click');
        $lepai_item[0]['chujia_count'] = Model('lepai_home')->getGoodsSum(array('G_Id'=>$lepai_item[0]['G_Id']),'pai_count');
        /*加载SEO*/
        Tpl::output('html_title',C('site_name').' - 艺术收藏品综合网购平台！');
        Tpl::output('seo_keywords','收藏,收藏品,人民币收藏,钱币收藏,纪念钞收藏,邮票收藏,金银币收藏,金银条收藏,书法字画,瓷器紫砂,玉器,珠宝');
        Tpl::output('seo_description','收藏天下是国内最专业的收藏品网站,提供各类收藏品,包括名家书法字画,瓷器紫砂,人民币,邮票,金银币,金银条,纪念钞,纪念币,玉器,珠宝等各类收藏品,并为您提供最新最全的收藏信息。');
        Tpl::output('lepai_item',$lepai_item[0]);
        Tpl::showpage('index');
	}


	/**
     * 加载手机版后台设置模版
     */
	public function shopMtelOp() {
        $model_mb_special = Model('mb_special'); 
        $data = $model_mb_special->getMbSpecialIndex();
		if(empty($data))
		{
			$data=array();
		}
		output_data($data);
	}

}
