<?php
/**
 * 收藏问答商城头部
 * Created by PhpStorm.
 * User: Chenhao
 * Date: 2016/11/29
 * Time: 16:24
 */
defined('InShopNC') or exit('Access Invalid!');

class questionsControl extends QuestionControl {

    /**
     * 商城头部
     */
    public function headerOp()
    {
        Tpl::showpage('header');
    }
}