<?php
/**
 * 前台control父类,
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

if (!@include_once(BASE_ROOT_PATH."/shop/control/control.php")) exit('control.php isn\'t exists!');

/********************************** 前台control父类 **********************************************/

class ArtistHomeControl extends Control {

    public function __construct(){
        //输出头部的公用信息
        $this->showLayout();

        //输出会员信息
        $this->getMemberAndGradeInfo(false);

        Language::read('common,home_layout');

        Tpl::setDir('artist');

        Tpl::setLayout('artist_layout');

        if ($_GET['column'] && strtoupper(CHARSET) == 'GBK'){
            $_GET = Language::getGBK($_GET);
        }

        if(!C('site_status')) halt(C('closed_reason'));
    }

}