<?php

!defined('IN_ASK2') && exit( 'Access Denied' );

class categorycontrol extends base
{

    function categorycontrol( & $get , & $post )
    {
        $this->base($get , $post);
        $this->load('category');
        $this->load('question');
    }

    //category/view/1/2/10
    //cid，status,第几页？
    function onview()
    {
        $cid = intval($this->get[2]) ? $this->get[2] : 'all';
        $status = isset( $this->get[3] ) ? $this->get[3] : 'all';
        @$page = max(1 , intval($this->get[4]));
        $pagesize = $this->setting['list_default'];
        $startindex = ( $page - 1 ) * $pagesize; //每页面显示$pagesize条
        if ( $cid != 'all' ) {
            $category = $this->category[$cid]; //得到分类信息
            $navtitle = $category['name'];
            $cfield = 'cid' . $category['grade'];
        } else {
            $category = $this->category;
            $navtitle = '全部分类';
            $cfield = '';
            $category['pid'] = 0;
        }
        $statusword = "";
        switch ( $status ) {
            case '1':
                $statusword = '待解决';
                break;
            case '2':
                $statusword = '已解决';
                break;
            case '4':
                $statusword = '高悬赏';
                break;
            case '6':
                $statusword = '推荐';
                break;
            case 'all':
                $statusword = '全部';
                break;
        }

        $rownum = $_ENV['question']->rownum_by_cfield_cvalue_status($cfield , $cid , $status); //获取总的记录数
        $questionlist = $_ENV['question']->list_by_cfield_cvalue_status($cfield , $cid , $status , $startindex , $pagesize); //问题列表数据

        $departstr = page($rownum , $pagesize , $page , "category/view/$cid/$status"); //得到分页字符串
        $navlist = $_ENV['category']->get_navigation($cid); //获取导航
        $sublist = $_ENV['category']->list_by_cid_pid($cid , $category['pid']); //获取子分类
        $seo_description = "";
        $seo_keywords = "";
        /* SEO */
        // $seo_keywords=$navtitle;
        //  $seo_description=$this->setting['site_name'].$navtitle.'频道，提供'.$navtitle.'相关问题及答案，'.$statusword.'问题，第'.$page."页。";;
//        if ($this->setting['seo_category_title']) {
//            $seo_title = str_replace("{wzmc}", $this->setting['site_name'], $this->setting['seo_category_title']);
//            $seo_title = str_replace("{flmc}", $navtitle, $seo_title);
//            
//            $seo_title=$seo_title.'_'.$statusword.'_第'.$page."页";
//        }else{
//        	$navtitle=$navtitle.'_'.$statusword.'_第'.$page."页";
//        }
//        
//        if ($this->setting['seo_category_description']) {
//            $seo_description = str_replace("{wzmc}", $this->setting['site_name'], $this->setting['seo_category_description']);
//            $seo_description = str_replace("{flmc}", $navtitle, $seo_description);
//        }
//        if ($this->setting['seo_category_keywords']) {
//            $seo_keywords = str_replace("{wzmc}", $this->setting['site_name'], $this->setting['seo_category_keywords']);
//            $seo_keywords = str_replace("{flmc}", $navtitle, $seo_keywords);
//        }

        if ( $category['alias'] ) {
            $navtitle = $category['alias'];
        }

        include template('category');
    }

    /**
     * 关键词筛选
     */
    function onviewKeywords()
    {
        $cid = intval($this->get[2]) ? $this->get[2] : 'all';
        $status = isset( $this->get[3] ) ? $this->get[3] : 'all';
        $keywords = urldecode($this->get[4]);
        @$page = max(1 , intval($this->get[5]));
        $pagesize = $this->setting['list_default'];
        $startindex = ( $page - 1 ) * $pagesize; //每页面显示$pagesize条
        if ( $cid != 'all' ) {
            $category = $this->category[$cid]; //得到分类信息
            $navtitle = $category['name'];
            $cfield = 'cid' . $category['grade'];
        } else {
            $category = $this->category;
            $navtitle = '全部分类';
            $cfield = '';
            $category['pid'] = 0;
        }
        $statusword = "";
        switch ( $status ) {
            case '1':
                $statusword = '待解决';
                break;
            case '2':
                $statusword = '已解决';
                break;
            case '4':
                $statusword = '高悬赏';
                break;
            case '6':
                $statusword = '推荐';
                break;
            case 'all':
                $statusword = '全部';
                break;
        }

        $rownum = $_ENV['question']->rownum_by_cfield_cvalue_status($cfield , $cid , $status , $keywords); //获取总的记录数
        $questionlist = $_ENV['question']->list_by_cfield_cvalue_status($cfield , $cid , $status , $startindex , $pagesize , $keywords); //问题列表数据
        $topiclist = $_ENV['topic']->get_bycatid($cid , 0 , 8);

        $departstr = page($rownum , $pagesize , $page , "category/view/$cid/$status/$keywords"); //得到分页字符串
        $navlist = $_ENV['category']->get_navigation($cid); //获取导航
        $sublist = $_ENV['category']->list_by_cid_pid($cid , $category['pid']); //获取子分类
        $seo_description = "";
        $seo_keywords = "";
        /* SEO */
        // $seo_keywords=$navtitle;
        //  $seo_description=$this->setting['site_name'].$navtitle.'频道，提供'.$navtitle.'相关问题及答案，'.$statusword.'问题，第'.$page."页。";;
//        if ($this->setting['seo_category_title']) {
//            $seo_title = str_replace("{wzmc}", $this->setting['site_name'], $this->setting['seo_category_title']);
//            $seo_title = str_replace("{flmc}", $navtitle, $seo_title);
//
//            $seo_title=$seo_title.'_'.$statusword.'_第'.$page."页";
//        }else{
//        	$navtitle=$navtitle.'_'.$statusword.'_第'.$page."页";
//        }
//
//        if ($this->setting['seo_category_description']) {
//            $seo_description = str_replace("{wzmc}", $this->setting['site_name'], $this->setting['seo_category_description']);
//            $seo_description = str_replace("{flmc}", $navtitle, $seo_description);
//        }
//        if ($this->setting['seo_category_keywords']) {
//            $seo_keywords = str_replace("{wzmc}", $this->setting['site_name'], $this->setting['seo_category_keywords']);
//            $seo_keywords = str_replace("{flmc}", $navtitle, $seo_keywords);
//        }

        if ( $category['alias'] ) {
            $navtitle = $category['alias'];
        }

        include template('category');
    }

    function onlist()
    {
        $status = isset( $this->get[2] ) ? $this->get[2] : 'all';
        $navtitle = $statustitle = $this->statusarray[$status];
        @$page = max(1 , intval($this->get[3]));
        $pagesize = $this->setting['list_default'];
        $startindex = ( $page - 1 ) * $pagesize; //每页面显示$pagesize条
        $rownum = $_ENV['question']->rownum_by_cfield_cvalue_status('' , 0 , $status); //获取总的记录数
        $questionlist = $_ENV['question']->list_by_cfield_cvalue_status('' , 0 , $status , $startindex , $pagesize); //问题列表数据
        $departstr = page($rownum , $pagesize , $page , "category/list/$status"); //得到分页字符串
        $metakeywords = $navtitle;
        $metadescription = '问题列表' . $navtitle;
        include template('list');
    }

    function onrecommend()
    {
        $this->load('topic');
        $navtitle = '专题列表';
        @$page = max(1 , intval($this->get[2]));
        $pagesize = $this->setting['list_default'];
        $startindex = ( $page - 1 ) * $pagesize;
        $rownum = $this->db->fetch_total('topic');
        $topiclist = $_ENV['topic']->get_list(2 , $startindex , $pagesize);
        $departstr = page($rownum , $pagesize , $page , "category/recommend");
        $metakeywords = $navtitle;
        $metadescription = '精彩推荐列表';
        include template('recommendlist');
    }

}

?>