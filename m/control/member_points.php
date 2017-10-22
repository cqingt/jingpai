<?php
/**
 * 会员中心 —— 拍卖惠
 *
***/


defined('InShopNC') or exit('Access Invalid!');

class member_pointsControl extends mobileMemberControl{

	public function __construct(){
		parent::__construct();
	}


    /*拍卖惠首页*/

    public function indexOp(){

        switch (intval($_GET['type'])) {
            case '1':
                $this->jifen();
                Tpl::output('type',1);
                break;
            case '2':
                $this->duihuan();
                Tpl::output('type',2);
                break;
            default:
                $this->jifen();
                Tpl::output('type',1);
                break;
        }


        Tpl::output('html_title','积分明细');

        Tpl::showpage('member_points_index');
    }

    /*积分明细*/
    private function jifen(){
        $condition_arr = array();
        $condition_arr['pl_memberid'] = $_SESSION['member_id'];
        //分页
        $page   = new Page();
        $page->setEachNum(10);
        $page->setStyle('admin');
        //查询积分日志列表
        $points_model = Model('points');
        $list_log = $points_model->getPointsLogList($condition_arr,$page,'*','');
        //信息输出
        Tpl::output('show_page',$page->show(88));
        Tpl::output('list',$list_log);
    }

    /*兑换纪录*/
    private function duihuan(){
         //兑换信息列表
        $where = array();
        $where['point_buyerid'] = $_SESSION['member_id'];
        
        $model_pointorder = Model('pointorder');
        $order_list = $model_pointorder->getPointOrderList($where, '*', 10, 0, 'point_orderid desc');
        $order_idarr = array();
        $order_listnew = array();
        if (is_array($order_list) && count($order_list)>0){
            foreach ($order_list as $k => $v){
                $order_listnew[$v['point_orderid']] = $v;
                $order_idarr[] = $v['point_orderid'];
            }
        }
        
        //查询兑换商品
        if (is_array($order_idarr) && count($order_idarr)>0){
            $prod_list = $model_pointorder->getPointOrderGoodsList(array('point_orderid'=>array('in',$order_idarr)));
            if (is_array($prod_list) && count($prod_list)>0){
                foreach ($prod_list as $v){
                    if (isset($order_listnew[$v['point_orderid']])){
                        $order_listnew[$v['point_orderid']]['prodlist'][] = $v;
                    }
                }
            }
        }
        
        //信息输出
        Tpl::output('list',$order_listnew);
        Tpl::output('show_page',$model_pointorder->showpage(88));

    }



}
