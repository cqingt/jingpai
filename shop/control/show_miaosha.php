<?php
/**
 * 前台抢购
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class show_miaoshaControl extends BaseHomeControl {

    public function __construct() {
        parent::__construct();

        //读取语言包
        Language::read('member_miaosha');
        //分类导航
        $nav_link = array(
            0=>array(
                'title'=>Language::get('homepage'),
                'link'=>SHOP_SITE_URL,
            ),
            1=>array(
                'title'=>Language::get('nc_miaosha')
            )
        );
        Tpl::output('nav_link_list',$nav_link);

        Tpl::output('index_sign','miaosha');

        /*SEO*/
        Tpl::output('html_title','秒杀'.' - '.C('site_name'));
        Tpl::output('seo_keywords','收藏品秒杀,秒杀频道,限时低价,限时抢购');
        Tpl::output('seo_description','收藏天下为了回馈广大新老客户，特别推出限时价秒杀频道，热门藏品全网最低价限时秒杀，让您用最少的钱，买到最真、品相最好的收藏品。');

        //检查抢购功能是否开启
        if (intval(C('miaosha_allow')) !== 1){
            showMessage(Language::get('miaosha_unavailable'),urlShop(),'','error');
        }
    }

//    public function indexOp(){
//        $model_miaosha = Model('miaosha');
//
//
//        //获取今明两天秒杀列表
//        $condition = array();
//        $condition['state'] = array('in','20,32');
//        $condition['start_time'] = array(array('gt', strtotime(date('Y-m-d'))),array('lt', strtotime(date('Y-m-d')) + 172800),'and');
//        $miaosha_info = $model_miaosha->getMiaoshaList($condition,null,'start_time asc,m_sort asc');
//
//        $miaosha_list = array();
//        foreach($miaosha_info as $k=>$v){
//            if($v['start_time'] > strtotime(date('Y-m-d')) && $v['start_time'] < (strtotime(date('Y-m-d')) + 86400)){
//                $keys = 'today';
//            }else{
//                $keys = 'tomorrow';
//            }
//
//            $goods_info = Model('goods')->getGoodsInfoByID($v['goods_id']);
//
//            $miaosha_list[$keys][$v['class_id']][$v['miaosha_id']] = $v;
//            $miaosha_list[$keys][$v['class_id']][$v['miaosha_id']]['goods_marketprice'] = $goods_info['goods_marketprice'];
//            $miaosha_list[$keys][$v['class_id']][$v['miaosha_id']]['lisheng'] = $goods_info['goods_marketprice'] - $goods_info['miaosha_price'];
//            $yu_quantity = $v['max_quantity']-$v['buy_quantity'];
//            $miaosha_list[$keys][$v['class_id']][$v['miaosha_id']]['shengyukucun'] = ($yu_quantity >= $goods_info['goods_storage'])?$goods_info['goods_storage']:$yu_quantity;
//            $miaosha_list[$keys][$v['class_id']][$v['miaosha_id']]['goods_image'] = thumb($goods_info, 240);
//            $miaosha_list[$keys][$v['class_id']][$v['miaosha_id']]['goods_url'] = urlShop('goods', 'index', array('goods_id' => $v['goods_id']));
//        }
//
//        Tpl::output('miaosha_list',$miaosha_list);
//
//        $miaosha_classes = Model('miaosha_class')->getList(array('order'=>' start_hour asc '));
//        $new_classes = array();
//        foreach($miaosha_classes as $k=>$v){
//            $new_classes[$v['class_id']] = $v;
//        }
//        Tpl::output('miaosha_classes',$new_classes);
//
//        Tpl::output('hour',date('H',time()));
//        Tpl::showpage('miaosha.index');
//    }

	public function indexOp(){
        $miaosha_classes = Model('miaosha_class')->getList(array('order'=>' start_hour asc '));
		$H = date("H",time());
		$YH = 0;
		$new_classes = array();
		foreach($miaosha_classes as $k=>$v){
			if($v['start_hour'] <= $H){
				$YH = $v['start_hour'];
			}
			$new_classes[$v['class_id']] = $v;
		}

        $model_miaosha = Model('miaosha');


        //获取今明两天秒杀列表
        $condition = array();
        $condition['state'] = array('in','20,32');
        $condition['start_time'] = array(array('egt', strtotime(date('Y-m-d',time()).' '.$YH.':0:0')),array('lt', strtotime(date('Y-m-d')) + 172800),'and');
        $miaosha_info = $model_miaosha->getMiaoshaList($condition,null,'start_time asc,m_sort asc');

        $miaosha_list = array();
        foreach($miaosha_info as $k=>$v){
            if($v['start_time'] >= strtotime(date('Y-m-d')) && $v['start_time'] < (strtotime(date('Y-m-d')) + 86400)){
                $keys = 'today';
            }else{
                $keys = 'tomorrow';
            }

            $goods_info = Model('goods')->getGoodsInfoByID($v['goods_id']);

            $miaosha_list[$keys][$v['class_id']][$v['miaosha_id']] = $v;
            $miaosha_list[$keys][$v['class_id']][$v['miaosha_id']]['goods_marketprice'] = $goods_info['goods_marketprice'];
            $miaosha_list[$keys][$v['class_id']][$v['miaosha_id']]['lisheng'] = $goods_info['goods_marketprice'] - $goods_info['miaosha_price'];
            $yu_quantity = $v['max_quantity']-$v['buy_quantity'];
            $miaosha_list[$keys][$v['class_id']][$v['miaosha_id']]['shengyukucun'] = ($yu_quantity >= $goods_info['goods_storage'])?$goods_info['goods_storage']:$yu_quantity;
            $miaosha_list[$keys][$v['class_id']][$v['miaosha_id']]['goods_image'] = thumb($goods_info, 360);
            $miaosha_list[$keys][$v['class_id']][$v['miaosha_id']]['goods_url'] = urlShop('goods', 'index', array('goods_id' => $v['goods_id']));
        }

        Tpl::output('miaosha_list',$miaosha_list);
		
        Tpl::output('miaosha_classes',$new_classes);

        Tpl::output('hour',date('H',time()));
        Tpl::showpage('miaosha.index');
    }


}
