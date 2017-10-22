<?php
/**
 * 前台control父类,店铺control父类,会员control父类
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

if (!@include_once(BASE_ROOT_PATH."/shop/control/control.php")) exit('control.php isn\'t exists!');

/********************************** 前台control父类 **********************************************/

class HomeControl extends Control {

    public function __construct(){
        //输出头部的公用信息
        $this->showLayout();
        //输出会员信息
        $this->getMemberAndGradeInfo(false);

        Language::read('common,home_layout');

        Tpl::setDir('home');

        Tpl::setLayout('home_layout');

        if ($_GET['column'] && strtoupper(CHARSET) == 'GBK'){
            $_GET = Language::getGBK($_GET);
        }
        if(!C('site_status')) halt(C('closed_reason'));
    }

}

class AdminControl extends Control {
    protected $member_info = array();   // 会员信息
    protected $quicklink = array();       // 常用菜单
    public function __construct(){

        if(!C('site_status')) halt(C('closed_reason'));

        Language::read('common,member_layout');

        if ($_GET['column'] && strtoupper(CHARSET) == 'GBK'){
            $_GET = Language::getGBK($_GET);
        }
        //会员验证
        $this->checkLogin('lepai');

        /*验证会员是否允许拍卖*/
        $this->checkLepai();
        //输出头部的公用信息

        Tpl::setDir('admin');
        Tpl::setLayout('admin_layout');

        /*加载公用分类*/
        // $lepai_class = C('lepai_class');
        // Tpl::output('lepai_class',$lepai_class);

        /*加载拍品状态*/
        $lepai_type = C('lepai_type');
        Tpl::output('lepai_type',$lepai_type);

        //获得会员信息
        $this->member_info = $this->getMemberAndGradeInfo(true);
        $this->quicklink = explode(',', $this->member_info['member_quicklink']);

        Tpl::output('member_info', $this->member_info);
    }

    /*验证拍卖*/
    private function checkLepai(){
        $model = Model();
        $result = $model->table('lepai_audit')->where('member_id='.$_SESSION['member_id'])->find();

        if($result['is_audit'] != '1'){
            echo "<script>alert('此用户不能参与拍卖、请先申请！');window.location.href='index.php'</script>";
            exit;
        }
    }
}


