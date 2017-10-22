<?php
/**
 * 会员中心 —— 拍卖惠
 *
***/


defined('InShopNC') or exit('Access Invalid!');

class member_pmControl extends mobileMemberControl{

	public function __construct(){
		parent::__construct();
	}


    /*拍卖惠首页*/

    public function indexOp(){

        Tpl::output('html_title','我的拍卖惠');

        Tpl::showpage('member_pm_index');
    }

    /*我的竟拍*/
    public function my_paimaiOp(){

        $model_lepai = Model('lepai_home');

        $condition['lepai_baoming.member_id'] = $_SESSION['member_id'];

        switch (intval($_GET['type'])) {

            case '1':   //即将开始
                $condition['lepai_admin_theme.T_Ktime'] = array('gt',time());
                $condition['lepai_admin_goods.G_Atype'] = 3;
                break;

            case '2':   //正在进行
                $condition['lepai_admin_theme.T_Ktime'] = array('lt',time());
                $condition['lepai_admin_goods.G_EndTime'] = array('gt',time());
                $condition['lepai_admin_goods.G_Atype'] = 3;
                break;

            case '3':   //已结束的
                $condition['lepai_admin_goods.G_EndTime'] = array('lt',time());
                $condition['lepai_admin_goods.G_Atype'] = array('gt',5);
                break;
            
            default:
                // $condition['lepai_baoming.is_return'] = '0';
                break;

        }


        $list = $model_lepai->table('lepai_baoming,lepai_admin_goods,lepai_admin_theme')
        ->join('left,left')
        ->on('lepai_baoming.auction_id=lepai_admin_goods.G_Id,lepai_admin_goods.G_Tid=lepai_admin_theme.T_Id')
        ->where($condition)
        ->field('*')
        ->page('10')
        ->order('lepai_baoming.id desc')
        ->select();


        // var_dump($list);


        Tpl::output('list',$list);
        Tpl::output('show_page',$model_lepai->showpage(88));
        Tpl::output('html_title','我的竞拍');
        Tpl::showpage('member_pm_mypaimai');
    }


    /*我的保证金*/
    public function my_depositOp(){

        $model_lepai = Model('lepai_home');


        $condition['lepai_baoming.member_id'] = $_SESSION['member_id'];

        switch (intval($_GET['type'])) {
            case '2':
                $condition['lepai_baoming.is_return'] = '1';
                break;

            case '3':
                $condition['lepai_baoming.is_return'] = '2';
                break;
            
            default:
                // $condition['lepai_baoming.is_return'] = '0';
                break;
        }

        $list = $model_lepai->table('lepai_baoming,lepai_admin_goods')
        ->join('left')
        ->on('lepai_baoming.auction_id=lepai_admin_goods.G_Id')
        ->where($condition)
        ->field('*')
        ->page('10')
        ->order('lepai_baoming.id desc')
        ->select();

        // var_dump($list);

        Tpl::output('list',$list);
        Tpl::output('show_page',$model_lepai->showpage(88));
        Tpl::output('html_title','我的保证金');
        Tpl::showpage('member_pm_deposit');
    }





}
