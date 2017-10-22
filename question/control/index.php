<?php

!defined('IN_ASK2') && exit('Access Denied');

class indexcontrol extends base {

    function indexcontrol(& $get, & $post) {
        $this->base($get, $post);
        $this -> load('question');
    }

    function ondefault() {
    	$this->load('setting');
        /* SEO */
        $this->setting['seo_index_title'] && $seo_title = str_replace("{wzmc}", $this->setting['site_name'], $this->setting['seo_index_title']);
        $this->setting['seo_index_description'] && $seo_description = str_replace("{wzmc}", $this->setting['site_name'], $this->setting['seo_index_description']);
        $this->setting['seo_index_keywords'] && $seo_keywords = str_replace("{wzmc}", $this->setting['site_name'], $this->setting['seo_index_keywords']);
        $navtitle = $this->setting['site_alias'];
        //推荐问题
        $recommend_question = $this -> fromcache('recommendquestion');
        //待解决问题
        $at_issue_question = $this -> fromcache('nosolvelist');
        //已解决问题
        $resolved_question = $this -> fromcache('solvelist');
        //一级分类及分类下推荐问题
        $categorylist = $this -> fromcache('indexcategorylist');
        //热门回答
        $hotanswers = $this -> fromcache('hotanswers');
        //推荐用户(按照用户被关注数量排行)
        $recommend_user = $this->fromcache('recommendlist');
        //轮播图及活动专题
        $adlist = $this -> fromcache('adlist');
        //热门标签
        $hosttaglist = $this -> fromcache('hosttaglist');
        //随便看看
        $rand_question = $_ENV['question']->randQuestion();
        include template('index');
    }

    function onhelp() {
        $this->load('usergroup');
        $usergrouplist = $_ENV['usergroup']->get_list(2);
        include template('help');
    }
    function ondoing() {
        include template("doing");
    }
     function onnotfound(){
     	  include template("404");
     }
    /* 查询图片是否需要点击放大 */

    function onajaxchkimg() {
        list($width, $height, $type, $attr) = getimagesize($this->post['imgsrc']);
        ($width > 300) && exit('1');
        exit('-1');
    }

    function ononline() {
        $navtitle = "当前在线";
        $this->load('user');
        @$page = max(1, intval($this->get[2]));
        $pagesize = 30;
        $startindex = ($page - 1) * $pagesize;
        $onlinelist = $_ENV['user']->list_online_user($startindex, $pagesize);
        $onlinetotal = $_ENV['user']->rownum_onlineuser();
        $departstr = page($onlinetotal, $pagesize, $page, "index/online");
        include template("online");
    }
}

?>