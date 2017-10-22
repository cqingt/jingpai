<?php
/**
 * cms文章
 *
 *
 ***/

defined('InShopNC') or exit('Access Invalid!');
class articleControl extends CMSHomeControl{

    public function __construct() {
        parent::__construct();
        Tpl::output('index_sign', 'article');

        $this->getListSeoOp($_GET['class_id']);
    }

    public function indexOp() {
        $this->article_listOp();
    }

    /**
     * 文章列表
     */
    public function article_listOp() {
        //获取文章列表
        if(empty($_GET['type'])) {
            $page_number = 10;
            $template_name = 'article_list';
        } else {
            $page_number = 40;
            $template_name = 'article_list.modern';
        }
        $condition = array();
        if(!empty($_GET['class_id'])) {
            $condition['article_class_id'] = intval($_GET['class_id']);
        }
        /*
         * add 书画名家列表页单独样式 xin 20160329
         */
        if($_GET['class_id'] == '69'){
            //推荐文章取4个
            $tuijian_list = Model('cms_article')->table('cms_article')->field('*')->where(array('article_class_id'=>$_GET['class_id'],'article_commend_flag'=>'1'))->limit('4')->select();

            Tpl::output('tuijian_list', $tuijian_list);
            if($_GET['keywords'] != ''){
                $condition['article_keyword'] = array(array('like',"%".$_GET['keywords']."%"));
            }
            $template_name = 'article_list.shuhua';

        }
        $condition['article_state'] = self::ARTICLE_STATE_PUBLISHED;
        $model_article = Model('cms_article');
        $article_list = $model_article->getList($condition, $page_number, 'article_publish_time desc');
        Tpl::output('show_page', $model_article->showpage(2));
        Tpl::output('article_list', $article_list);
        $this->get_article_sidebar();

        Tpl::showpage($template_name);
    }

    /**
     * 文章详情
     */
    public function article_detailOp() {
        $article_id = intval($_GET['article_id']);
        if($article_id <= 0) {
            showMessage(Language::get('wrong_argument'),'','','error');
        }

        $model_article = Model('cms_article');
        $article_detail = $model_article->getOne(array('article_id'=>$article_id));
        if(empty($article_detail)) {
            showMessage(Language::get('article_not_exist'), CMS_SITE_URL, '', 'error');
        }

        if(intval($article_detail['article_state']) !== self::ARTICLE_STATE_PUBLISHED) {
            if($this->publisher_type !== self::ARTICLE_TYPE_ADMIN) {
                if(empty($_SESSION['member_id']) || $_SESSION['member_id'] != $this->publisher_id) {
                    showMessage(Language::get('article_not_exist'), CMS_SITE_URL, '', 'error');
                }
            }
        }

        //相关文章
        $article_link_list = $this->get_article_link_list($article_detail['article_link']);
        Tpl::output('article_link_list', $article_link_list);

        //相关商品
        $article_goods_list = unserialize($article_detail['article_goods']);
        Tpl::output('article_goods_list', $article_goods_list);

        //计数加1
        $model_article->modify(array('article_click'=>array('exp','article_click+1')),array('article_id'=>$article_id));

        //文章心情
        $article_attitude_list = array();
        $article_attitude_list[1] = Language::get('attitude1');
        $article_attitude_list[2] = Language::get('attitude2');
        $article_attitude_list[3] = Language::get('attitude3');
        $article_attitude_list[4] = Language::get('attitude4');
        $article_attitude_list[5] = Language::get('attitude5');
        $article_attitude_list[6] = Language::get('attitude6');
        Tpl::output('article_attitude_list', $article_attitude_list);

        //分享
        $this->get_share_app_list();

        Tpl::output('article_detail', $article_detail);
        Tpl::output('detail_object_id', $article_id);
        $this->get_article_sidebar();

        //seo
        Tpl::output('seo_title', $article_detail['article_title']);
        Tpl::output('seo_keywords', $article_detail['article_keyword']);
        Tpl::output('seo_description', html_substr_word($article_detail['article_content'],100));

        //藏品推荐  wang 20160516
        $rst = Model()->query('SELECT * FROM `shop_promotion`');
        foreach($rst as $k=>$v){
         $temp[] = $v['p_id'];
        }
        shuffle($temp);
        $temp = array_slice($temp, 0, 4);
        $id_nums = implode(", ", $temp);
        $sqlquery = "Select goods_id,goods_pic,goods_name,goods_price from `shop_promotion` where p_id IN ($id_nums)";
        $tuijian = Model()->query($sqlquery);
		if($tuijian){
			foreach($tuijian as $k=>$v){
				//获取促销信息
				$goods_info = Model('goods')->getChuXiao($v['goods_id']);
				if($goods_info['promotion_type'] && $goods_info['promotion_price']){
					$tuijian[$k]['promotion_type'] = $goods_info['promotion_type'];
					$tuijian[$k]['promotion_price'] = $goods_info['promotion_price'];
				}
			}
		}
        Tpl::output('tuijian', $tuijian);

        Tpl::showpage('article_detail');
    }

    /**
     * 文章评论
     */
    public function article_comment_detailOp() {
        $article_id = intval($_GET['article_id']);
        if($article_id <= 0) {
            showMessage(Language::get('wrong_argument'),'','','error');
        }

        $model_article = Model('cms_article');
        $article_detail = $model_article->getOne(array('article_id'=>$article_id));
        if(empty($article_detail)) {
            showMessage(Language::get('article_not_exist'), CMS_SITE_URL, '', 'error');
        }

        if(intval($article_detail['article_state']) !== self::ARTICLE_STATE_PUBLISHED) {
            if($this->publisher_type !== self::ARTICLE_TYPE_ADMIN) {
                if(empty($_SESSION['member_id']) || $_SESSION['member_id'] != $this->publisher_id) {
                    showMessage(Language::get('article_not_exist'), CMS_SITE_URL, '', 'error');
                }
            }
        }

        $article_hot_comment = $model_article->getList(array('article_state'=>self::ARTICLE_STATE_PUBLISHED), null, 'article_comment_count desc', '*', 10);
        Tpl::output('hot_comment', $article_hot_comment);

        Tpl::output('article_detail', $article_detail);
        Tpl::output('detail_object_id', $article_id);
        Tpl::output('comment_all', 'all');

        //推荐文章
        $this->get_article_comment();

        Tpl::showpage('comment_detail');
    }


    /**
     * 文章列表
     */
	public function article_searchOp() {
        $condition = array();
        $condition['article_title'] = array("like",'%'.trim($_GET['keyword']).'%');
        $condition['article_state'] = self::ARTICLE_STATE_PUBLISHED;
        $model_article = Model('cms_article');
        $article_list = $model_article->getList($condition, 20, 'article_sort asc, article_id desc');
        Tpl::output('show_page', $model_article->showpage(2));
        Tpl::output('total_num', $model_article->gettotalnum());
        Tpl::output('article_list', $article_list);
        $this->get_article_sidebar();

        Tpl::showpage('search_article');
	}

    /**
     * 根据标签搜索
     */
	public function article_tag_searchOp() {
        $article_list = array();
        if(intval($_GET['tag_id']) > 0) {
            $model_article = Model('cms_article');

            $condition = array();
            $condition['relation_tag_id'] = $_GET['tag_id'];
            $condition['article_state'] = self::ARTICLE_STATE_PUBLISHED;
            $article_list = $model_article->getListByTagID($condition, 20, 'article_sort asc, article_id desc');

            Tpl::output('show_page', $model_article->showpage(2));
            Tpl::output('total_num', $model_article->gettotalnum());
        }

        Tpl::output('article_list', $article_list);
        $this->get_article_sidebar();

        Tpl::showpage('search_article');
    }

    /**
     * 文章侧栏
     */
    private function get_article_sidebar() {

        $model_tag = Model('cms_tag');
        $model_article = Model('cms_article');

        //标签
        $cms_tag_list = $model_tag->getList(TRUE, null, 'tag_sort asc', '', 10);
        $cms_tag_list = array_under_reset($cms_tag_list, 'tag_id');
        Tpl::output('cms_tag_list', $cms_tag_list);

        //推荐文章(图文)
        $condition = array();
        $condition['article_commend_image_flag'] = 1;
        $article_commend_image_list = $model_article->getList($condition, 5, 'article_id desc', '*', 3);
        Tpl::output('article_commend_image_list', $article_commend_image_list);

        //推荐文章
        $this->get_article_comment();

    }



    /*SEO*/
    private function getListSeoOp($goodsid){
        $array = array(
            '19'=>array(
                'title'=>'收藏知识 收藏品资讯 人民币收藏知识 - 收藏天下',
                'keywords'=>'收藏知识,收藏品资讯,人民币收藏知识',
                'description'=>'收藏天下投资学院，为藏友提供最新收藏品投资动态、投资行情、投资新闻。内容涉及艺术品投资，钱币投资、邮票投资以及金银投资，帮助收藏投资者了解更多投资知识'
                ),
            '40'=>array(
                'title'=>'专家观点 如意先生观点 马未都收藏观点 - 收藏天下',
                'keywords'=>'专家观点,如意先生观点,马未都收藏观点',
                'description'=>'收藏学院专家观点栏目特别为您提供人民币收藏、邮票收藏、金银币收藏、书画收藏的各类收藏专家的独家观点，让您在收藏的时候有一个专家作为良师益友。'
                ),
            '54'=>array(
                'title'=>'投资分析 收藏品投资 艺术品收藏 - 收藏天下',
                'keywords'=>'投资分析,收藏品投资,艺术品收藏',
                'description'=>'收藏学院是依托于收藏天下百万用户而诞生的资讯类网站，根据网站百万用户的大数据特别推出投资分析频道，为您提供各种收藏投资的分析数据，让您在收藏投资中通过大数据分析，来获得投资方向和资源。'
                ),
            '37'=>array(
                'title'=>'邮币卡 邮票资讯 人民币信息 纪念币常识 - 收藏天下',
                'keywords'=>'邮币卡,邮票资讯,人民币新闻,纪念钞信息',
                'description'=>'收藏学院邮币卡频道为您提供最新最全的邮票、人民币、纪念币、纪念钞等各种邮币卡的资讯，让您能够了解最多的邮币卡知识，在投资邮币卡的时候有更多的投资收藏知识。'
                ),
            '38'=>array(
                'title'=>'贵金属 金银币资讯 金银条知识 贵金属信息 - 收藏天下',
                'keywords'=>'贵金属,金银币资讯,金银条知识,贵金属信息',
                'description'=>'收藏学院贵金属频道为您提供最新金银币、金银条等贵金属的资讯，常识，知识等资讯，让您在收藏投资贵金属的时候有更多的资讯储备，时刻把握贵金属收藏投资的脉搏'
                ),
            '62'=>array(
                'title'=>'珠宝玉器 翡翠知识 和田玉资讯 碧玉常识 - 收藏天下',
                'keywords'=>'珠宝玉器,翡翠知识,和田玉资讯,碧玉常识',
                'description'=>'收藏学院珠宝玉器频道为您提供最新最全的翡翠、和田玉、俄罗斯碧玉、缅甸翠玉等各种珠宝玉器的资讯,购买珠宝玉器的常识以及鉴定赏析珠宝玉器的简单常用方法和知识。'
                ),
            '55'=>array(
                'title'=>'书法字画 毛笔书法知识 国画资讯 油画常识 - 收藏天下',
                'keywords'=>'书法字画,毛笔书法知识,国画资讯,油画常识',
                'description'=>'收藏学院书法字画频道依托十六年的收藏品销售经验以及与书画名家的合作交流，特别奉献了书法字画频道，为您全面解读书法字画的收藏知识和最新资讯。'
                ),
            '41'=>array(
                'title'=>'藏品知识 人民币收藏知识 手串怎么盘 邮票知识 - 收藏天下',
                'keywords'=>'藏品知识,人民币收藏知识,手串怎么盘,邮票知识',
                'description'=>'藏品知识频道是收藏学院整理百万用户的咨询内容以及反馈的问题而特别设定的栏目，本栏目将传授各类收藏品知识以及文玩把件的盘玩技巧，以及收藏鉴赏知识。'
                ),
            '20'=>array(
                'title'=>'行情快讯 收藏品行情 书画行情 邮票行情 艺术品行情 - 收藏天下',
                'keywords'=>'行情快讯,收藏品行情,书画行情,邮票行情,艺术品行情',
                'description'=>'人民币收藏、邮票收藏、金银币、书画、手串、文玩等各类收藏品的行情快讯，尽在收藏学院，收藏学院为您提供最新最全的收藏品类行情资讯。'
                ),
            '39'=>array(
                'title'=>'藏市热点 藏品热点资讯 书画热点资讯 - 收藏天下',
                'keywords'=>'藏市热点,藏品热点资讯,书画热点资讯',
                'description'=>'书画、人民币收藏、邮票、金银币等各种收藏品艺术品收藏的热点资讯尽在收藏学院，收藏学院资讯具有及时性，时效性和准确度高等特点。'
                ),
            '58'=>array(
                'title'=>'保养知识 钱币保养知识 书画保养知识 手串把玩常识 - 收藏天下',
                'keywords'=>'保养知识,钱币保养知识,书画保养知识,手串把玩常识',
                'description'=>'收藏学院保养知识频道为您提供钱币保养知识、书画保养知识、手串把玩常识、邮票保养知识、各种收藏品的保养知识，收藏学院让您能够更好保养好自己的收藏品。'
                ),
            '59'=>array(
                'title'=>'经验交流 收藏经验 收藏品选购经验 书画欣赏 - 收藏天下',
                'keywords'=>'经验交流,收藏经验,收藏品选购经验,书画欣赏',
                'description'=>'书画欣赏经验、钱币品相鉴定经验、邮票品相鉴定经验、金银币真假奠定经验、翡翠和田玉真假鉴定经验等各种收藏品艺术品的经验尽在收藏学院经验交流频道。'
                ),
            '60'=>array(
                'title'=>'收藏趣事 中国画常识 毛笔书法知识 - 收藏天下',
                'keywords'=>'收藏趣事,中国画常识,毛笔书法知识',
                'description'=>'收藏学院为您搜集整理各种收藏趣闻，让您在感受收藏乐趣的时候也能体会收藏界的趣闻趣事，让你的眼界更加宽阔，收藏趣事尽在收藏学院'
                ),
            '42'=>array(
                'title'=>'藏品赏析 书画欣赏 书法赏析 国画赏析 名画赏析 - 收藏天下',
                'keywords'=>'藏品赏析,书画欣赏,书法赏析,国画赏析,名画赏析',
                'description'=>'收藏学院藏品赏析栏目特别推出书画名家作品赏析，书法、国画、油画等各类书画作品欣赏以及赏析方法解析，让您更快速的了解意见书画作品，提高自己的鉴赏能力和投资能力。'
                ),
            '53'=>array(
                'title'=>'发行公告 生肖金银纪念币发行 纪念钞发行公告 和字币发行公告 - 收藏天下',
                'keywords'=>'发行公告,生肖金银纪念币发行,纪念钞发行公告,和字币发行公告',
                'description'=>'生肖金银币、生肖纪念币、生肖邮票，纪念钞、和字币等各类收藏品发行公告尽请关注收藏学院发行公告频道，让您第一时间了解各类新产品的发行，收藏抢先一步'
                ),
            '57'=>array(
                'title'=>'收藏百科 - 收藏天下',
                'keywords'=>'收藏百科',
                'description'=>'收藏学院为您提供最新最全的收藏法规，让你规避收藏陷阱，真正体会收藏乐趣'
                ),
            '56'=>array(
                'title'=>'拍卖结果 字画拍卖 保利拍卖 秋拍结果 - 收藏天下',
                'keywords'=>'拍卖结果,字画拍卖,保利拍卖,秋拍结果',
                'description'=>'收藏学院为您提供最新保利拍卖、嘉和拍卖等各类中外拍卖行最新拍卖信息和拍卖结果信息，了解拍卖行的收藏品艺术品拍卖风向，实时了解收藏行情，各类拍卖资讯尽在收藏天下网。'
                )
            );
        if(array_key_exists($goodsid,$array)){
            $content = $array["$goodsid"];
            /*SEO*/
            Tpl::output('html_title',$content['title']);
            Tpl::output('seo_keywords',$content['keywords']);
            Tpl::output('seo_description',$content['description']);
        }
    }

}
