<?php
/**
 * 会员中心——账户概览
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class miaoshaControl extends mobileHomeControl{

	public function __construct(){
		parent::__construct();
	}

    /**
     * 新秒杀列表
     */
    public function mew_miaosha_listOp() {
        

        /*加载SEO*/
        Tpl::output('nav_title','秒杀');
        Tpl::output('html_title','秒杀 - '.C('site_name'));
        Tpl::output('seo_keywords','收藏品秒杀,秒杀频道,限时低价,限时抢购');
        Tpl::output('seo_description','收藏天下为了回馈广大新老客户，特别推出限时价秒杀频道，热门藏品全网最低价限时秒杀，让您用最少的钱，买到最真、品相最好的收藏品。');
		$this->get_new_miaoshao_listOp();
        Tpl::showpage('miaosha_list');
    }

	/**
     * 秒杀列表
     */
    public function index_listOp() {

        //Tpl::output('miaosha',$this->get_miaoshao_listOp());

        /*加载SEO*/
        Tpl::output('nav_title','秒杀');
        Tpl::output('html_title','秒杀 - '.C('site_name'));
        Tpl::output('seo_keywords','收藏品秒杀,秒杀频道,限时低价,限时抢购');
        Tpl::output('seo_description','收藏天下为了回馈广大新老客户，特别推出限时价秒杀频道，热门藏品全网最低价限时秒杀，让您用最少的钱，买到最真、品相最好的收藏品。');
		$this->get_new_miaoshao_listOp();
        Tpl::showpage('miaosha_list');
    }

	private function get_new_miaoshao_listOp(){
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
			//获取秒杀列表
			$condition = array();
			$condition['state'] =  array('in','20,32');
			$condition['start_time'] = array(array('egt', strtotime(date('Y-m-d',time()).' '.$YH.':0:0')),array('lt', strtotime(date('Y-m-d')) + 172800),'and');
			if($_GET['type'] == 'ShuHua'){
				$goods_list = Model()->table('goods_common')->where(array("gc_id_1"=>'79'))->limit(99999999)->select();
				if($goods_list){
					$goods_idArr = array();
						foreach($goods_list as $k=>$v){
							$goods_idArr[] = $v['goods_commonid'];
					}
					$condition['goods_commonid'] = array('in',$goods_idArr);
				}
				//艺术家官网秒杀
				Tpl::output('IsShuHua',true);
			}
			$miaosha_info = $model_miaosha->getMiaoshaList($condition,null,'start_time asc,m_sort asc');
			$miaosha_list = array();
			foreach($miaosha_info as $k=>$v){
				if($v['start_time'] >= strtotime(date('Y-m-d')) && $v['start_time'] < (strtotime(date('Y-m-d')) + 172800)){
					
					if($v['start_time'] < (strtotime(date('Y-m-d')) + 86400)){
						//获取当天秒杀
						$start_hour = $new_classes[$v['class_id']]['start_hour'];
					}else{
						//预开始秒杀
						$start_hour = $new_classes[$v['class_id']]['start_hour'].'_Two';
					}
				   $end_hour   = $new_classes[$v['class_id']]['end_hour'];
				  
					$goods_info = Model('goods')->getGoodsInfoByID($v['goods_id']);
					$miaosha_list[$start_hour][$v['miaosha_id']] = $v;
					$miaosha_list[$start_hour][$v['miaosha_id']]['goods_price'] = $goods_info['goods_price'];
					$miaosha_list[$start_hour][$v['miaosha_id']]['lisheng'] = $goods_info['goods_price'] - $v['miaosha_price'];
					$yu_quantity = $v['max_quantity']-$v['buy_quantity'];
					$miaosha_list[$start_hour][$v['miaosha_id']]['shengyukucun'] = ($yu_quantity >= $goods_info['goods_storage'])?$goods_info['goods_storage']:$yu_quantity;
					$miaosha_list[$start_hour][$v['miaosha_id']]['goods_image'] = thumb($goods_info, 240);
					$miaosha_list[$start_hour][$v['miaosha_id']]['goods_url'] = urlWap('goods', 'index', array('goods_id' => $v['goods_id']));
					$miaosha_list[$start_hour][$v['miaosha_id']]['end'] = 3;
				   if(date('H',time()) >= $start_hour && date('H',time()) < $end_hour && $miaosha_list[$start_hour][$v['miaosha_id']]['shengyukucun'] > 0){
						$miaosha_list[$start_hour][$v['miaosha_id']]['end'] = 2; //进行中
				   }elseif (date('H',time()) >= $end_hour || $miaosha_list[$start_hour][$v['miaosha_id']]['shengyukucun'] == 0) {
						$miaosha_list[$start_hour][$v['miaosha_id']]['end'] = 1; //已结束
				   } else {
						$miaosha_list[$start_hour][$v['miaosha_id']]['end'] = 3; //即将开始
				  }
				   
				}
			}
		
		 Tpl::output('new_classes',$new_classes);
		 Tpl::output('miaosha',$miaosha_list);

    }


    private function get_miaoshao_listOp(){

        $model_miaosha = Model('miaosha');


        //获取今明两天秒杀列表
        $condition = array();
        $condition['state'] = '20';
        $condition['start_time'] = array(array('gt', strtotime(date('Y-m-d'))),array('lt', strtotime(date('Y-m-d')) + 172800),'and');
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
            $miaosha_list[$keys][$v['class_id']][$v['miaosha_id']]['goods_image'] = thumb($goods_info, 240);
            $miaosha_list[$keys][$v['class_id']][$v['miaosha_id']]['goods_url'] = urlShop('goods', 'index', array('goods_id' => $v['goods_id']));
        }


        return $miaosha_list;

    }


}
