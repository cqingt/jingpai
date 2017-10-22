<?php
/**
 * 问答管理
 *
 *
 *
 ***/

defined('InShopNC') or exit('Access Invalid!');
class questionsControl extends SystemControl{

	public function __construct(){
		parent::__construct();
	}

    /**
     * 问答系统管理
     */
    public function homepageOp()
    {
        header('Location:'.BASE_SITE_URL.'/question/index.php?admin_setting/base.html');
    }

    /**
     * 积分管理
     */
    public function integralOp()
    {
        header('Location:'.BASE_SITE_URL.'/question/index.php?admin_setting/clist.html');
    }

    /**
     * 搜索管理
     */
    public function searchOp()
    {
        header('Location:'.BASE_SITE_URL.'/question/index.php?admin_setting/search.html');
    }

    /**
     * 导航管理
     */
    public function navigationOp()
    {
        header('Location:'.BASE_SITE_URL.'/question/index.php?admin_nav/default.html');
    }

    /**
     * 用户问答信息管理
     */
    public function userOp()
    {
        header('Location:'.BASE_SITE_URL.'/question/index.php?admin_user/default.html');
    }

    /**
     * 问题管理
     */
    public function questionOp()
    {
        header('Location:'.BASE_SITE_URL.'/question/index.php?admin_question/default.html');
    }

    /**
     * 分类管理
     */
    public function categoryOp()
    {
        header('Location:'.BASE_SITE_URL.'/question/index.php?admin_category/default.html');
    }

    /**
     * 标签管理
     */
    public function labelOp()
    {
        header('Location:'.BASE_SITE_URL.'/question/index.php?admin_tag/default.html');
    }

    /**
     * 词语过滤
     */
    public function wordfilterOp()
    {
        header('Location:'.BASE_SITE_URL.'/question/index.php?admin_word/default.html');
    }

    /**
     * 公告管理
     */
    public function announcementOp()
    {
        header('Location:'.BASE_SITE_URL.'/question/index.php?admin_note/default.html');
    }

    /**
     * 广告管理
     */
    public function advertisementOp()
    {
        header('Location:'.BASE_SITE_URL.'/question/index.php?admin_ad/default.html');
    }

    /**
     * 数据校正
     */
    public function rectificationOp()
    {
        header('Location:'.BASE_SITE_URL.'/question/index.php?admin_main/regulate.html');
    }

    /**
     * 更新缓存
     */
    public function updatesOp()
    {
        header('Location:'.BASE_SITE_URL.'/question/index.php?admin_setting/cache.html');
    }
}
