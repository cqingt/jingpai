<?php
/**
 * 投资学院
 *
 *
 ***/

defined('InShopNC') or exit('Access Invalid!');
class tzxyControl extends mobileHomeControl{

	public function __construct() {
		parent::__construct();
		$this->getListSeoOp($_GET['class_id']);
    }
	public function indexOp(){
        $article_model = Model('cms_article');
        //轮播图文5
        $lbtw = $article_model->getList(array('article_state'=>'3','article_commend_image_flag'=>'1'),null,'article_publish_time desc','*','5');
        Tpl::output('lbtw',$lbtw);
        //推荐文章6
        $tjwz = $article_model->getList(array('article_state'=>'3','article_commend_flag'=>'1'),null,'article_publish_time desc','*','5');
        Tpl::output('tjwz',$tjwz);
        //热点关注(藏市热点)
        $rdgz = $article_model->getList(array('article_state'=>'3','article_class_id'=>'39'),null,'article_publish_time desc','*','6');
        Tpl::output('rdgz',$rdgz);
        //书画名家
        $shmj = $article_model->getList(array('article_state'=>'3','article_class_id'=>'69'),null,'article_publish_time desc','*','6');
        Tpl::output('shmj',$shmj);
        //最新动态
        $zxdt = $article_model->getList(array('article_state'=>'3','article_class_id'=>'19'),null,'article_publish_time desc','*','6');
        Tpl::output('zxdt',$zxdt);
        //专家观点
        $zjgd = $article_model->getList(array('article_state'=>'3','article_class_id'=>'40'),null,'article_publish_time desc','*','6');
        Tpl::output('zjgd',$zjgd);
        //收藏趣事
        $scqs = $article_model->getList(array('article_state'=>'3','article_class_id'=>'60'),null,'article_publish_time desc','*','8');
        Tpl::output('scqs',$scqs);
        //藏市热点
        $csrd = $article_model->getList(array('article_state'=>'3','article_class_id'=>'39'),null,'article_publish_time desc','*','6');
        Tpl::output('csrd',$csrd);
        //行情快讯
        $hqkx = $article_model->getList(array('article_state'=>'3','article_class_id'=>'20'),null,'article_publish_time desc','*','6');
        Tpl::output('hqkx',$hqkx);
        //拍卖结果
        $pmjg = $article_model->getList(array('article_state'=>'3','article_class_id'=>'56'),null,'article_publish_time desc','*','6');
        Tpl::output('pmjg',$pmjg);
        //邮币卡
        $ybk = $article_model->getList(array('article_state'=>'3','article_class_id'=>'37'),null,'article_publish_time desc','*','6');
        Tpl::output('ybk',$ybk);
        //贵金属
        $gjs = $article_model->getList(array('article_state'=>'3','article_class_id'=>'38'),null,'article_publish_time desc','*','6');
        Tpl::output('gjs',$gjs);
        //珠宝玉器
        $zbyq = $article_model->getList(array('article_state'=>'3','article_class_id'=>'62'),null,'article_publish_time desc','*','6');
        Tpl::output('zbyq',$zbyq);
        //书法字画
        $sfzh = $article_model->getList(array('article_state'=>'3','article_class_id'=>'55'),null,'article_publish_time desc','*','6');
        Tpl::output('sfzh',$sfzh);
        //藏品赏析
        $cpsx = $article_model->getList(array('article_state'=>'3','article_class_id'=>'42'),null,'article_publish_time desc','*','4');
        Tpl::output('cpsx',$cpsx);
        //收藏法规
        $scfg = $article_model->getList(array('article_state'=>'3','article_class_id'=>'57'),null,'article_publish_time desc','*','5');
        Tpl::output('scfg',$scfg);
        //保养知识
        $byzs = $article_model->getList(array('article_state'=>'3','article_class_id'=>'57'),null,'article_publish_time desc','*','5');
        Tpl::output('byzs',$byzs);
        //经验交流
        $jyjl = $article_model->getList(array('article_state'=>'3','article_class_id'=>'59'),null,'article_publish_time desc','*','12');
        Tpl::output('jyjl',$jyjl);
        //发行公告
        $fxgg = $article_model->getList(array('article_state'=>'3','article_class_id'=>'53'),null,'article_publish_time desc','*','12');
        Tpl::output('fxgg',$fxgg);
        Tpl::output('html_title','收藏学院'.' - '.C('site_name'));
        Tpl::output('seo_keywords','收藏投资学院,最新收藏资讯,钱币收藏,纪念钞收藏,金银币收藏,收藏行业动态,收藏品投资资讯');
        Tpl::output('seo_description','收藏天下投资学院，为藏友提供最新收藏品投资动态、投资行情、投资新闻。内容涉及艺术品投资，钱币投资、邮票投资以及金银投资，帮助收藏投资者了解更多投资知识。');
		Tpl::output('no_header', true);
        Tpl::showpage('tzxy_index');
	}

	//投资学院列表页面
	public function tzxy_listOp(){
		Tpl::output('class_id', intval($_GET['class_id']));
		Tpl::output('no_header', true);
        Tpl::showpage("tzxy_list");
	}
	//AJAX加载列表 
	public function AJAX_tzxy_listOp(){
		$condition = array();
        if(!empty($_GET['class_id'])) {
            $condition['article_class_id'] = intval($_GET['class_id']);
        }
		$page_number = 20;
        $condition['article_state'] = '3';
        $model_article = Model('cms_article');
        $article_list = $model_article->getList($condition, $page_number, 'article_publish_time desc');
        Tpl::output('article_list', $article_list);
		Tpl::output('class_id', intval($_GET['class_id']));
        Tpl::showpage("AJAX_tzxy_list",'null_layout');
	}

	//详情页面 
	public function tzxy_articleOp() {
        $article_id = intval($_GET['article_id']);
        if($article_id <= 0) {
            showMessage(Language::get('wrong_argument'),'','','error');
        }

        $model_article = Model('cms_article');
        $article_detail = $model_article->getOne(array('article_id'=>$article_id));
        if(empty($article_detail)) {
            showMessage(Language::get('article_not_exist'), CMS_SITE_URL, '', 'error');
        }

        if(intval($article_detail['article_state']) !== 3) {
            if($this->publisher_type !== 2) {
                if(empty($_SESSION['member_id']) || $_SESSION['member_id'] != $this->publisher_id) {
                    showMessage(Language::get('article_not_exist'), CMS_SITE_URL, '', 'error');
                }
            }
        }

        //相关文章
        $article_link_list = $this->get_article_link_list($article_detail['article_link']);
        Tpl::output('article_link_list', $article_link_list);
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
      
        Tpl::output('article_detail', $article_detail);
		$this->comment_list(2,$article_id);
		$condition = array();
		$condition["comment_object_id"] = $article_id;
		$condition["comment_type"] = 1;
		$model_cms_comment = Model('cms_comment');
		$getPageContents = $model_cms_comment->getContents($condition);
		Tpl::output('getPageContents', $getPageContents);
		Tpl::output('article_obj_id', $article_id);
		$this->get_article_sidebar();
        //seo
		Tpl::output('tzxy_title', $article_detail['class_name']);
        Tpl::output('html_title', $article_detail['article_title'].'- 收藏学院 - 收藏天下');
        Tpl::output('seo_keywords', $article_detail['article_keyword']);
        Tpl::output('seo_description', html_substr_word($article_detail['article_content'],100));
		Tpl::output('no_header', true);
        Tpl::showpage('tzxy_article');
    }
	 /**
     * 获取文章相关文章
     */
    protected function get_article_link_list($article_link) {
        $article_link_list = array();
        if(!empty($article_link)) {
            $model_article = Model('cms_article');
            $condition = array();
            $condition['article_id'] = array('in',$article_link);
            $condition['article_state'] = self::ARTICLE_STATE_PUBLISHED;
            $article_link_list = $model_article->getList($condition , NULL, 'article_id desc');
        }
        return $article_link_list;
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

	/**
     * 推荐文章
     */
    protected function get_article_comment() {
        $model_article = Model('cms_article');
        $condition = array();
        $condition['article_commend_flag'] = 1;
        $article_commend_list = $model_article->getListWithClassName($condition, NULL, 'article_id desc', '*', 9);
        Tpl::output('article_commend_list', $article_commend_list);

    }

	/**
     * 文章评论
     */
    public function tzxy_comment_detailOp() {
		$aid = intval($_GET['aid']);
		Tpl::output('html_title','收藏学院 - 评论');
		Tpl::output('tzxy_title', '收藏学院 - 评论');
		Tpl::output('detail_object_id', $aid);
		$this->comment_list(5,$aid);
		Tpl::output('no_header', true);
		Tpl::showpage('tzxy_comment_detail');

    }

	/**
     * ajax加载文章评论列表
     */
    public function AJAX_comment_listOp() {
		$aid = intval($_GET['aid']);
		$this->comment_list(5,$aid);
		Tpl::output('detail_object_id', $aid);
		Tpl::showpage('tzxy_comment_list','null_layout');

    }
	
	/**
     * 评论保存
     **/
    public function comment_saveOp() {

        $data = array();
        $data['result'] = 'true';
        $comment_object_id = intval($_POST['comment_object_id']);
        $model_name = '';
        $count_field = '';
		$comment_type =1;
		$model_name = 'cms_article';
		$count_field = 'article_comment_count';
		$comment_object_key = 'article_id';

        if($comment_object_id <= 0 || empty($comment_type) || empty($_POST['comment_message'])) {
            $data['result'] = 'false';
            $data['message'] = '参数错误';
            $this->echo_json($data);
        }

        if(!empty($_SESSION['member_id'])) {

            $param = array();
            $param['comment_type'] = $comment_type;
            $param["comment_object_id"] = $comment_object_id;
            if (strtoupper(CHARSET) == 'GBK'){
                $param['comment_message'] = Language::getGBK(trim($_POST['comment_message']));
            } else {
                $param['comment_message'] = trim($_POST['comment_message']);
            }
            $param['comment_member_id'] = $_SESSION['member_id'];
            $param['comment_time'] = time();

            $model_comment = Model('cms_comment');

            if(!empty($_POST['comment_id'])) {
                $comment_detail = $model_comment->getOne(array('comment_id'=>$_POST['comment_id']));
                if(empty($comment_detail['comment_quote'])) {
                    $param['comment_quote'] = $_POST['comment_id'];
                } else {
                    $param['comment_quote'] = $comment_detail['comment_quote'].','.$_POST['comment_id'];
                }
            } else {
                $param['comment_quote'] = '';
            }

            $result = $model_comment->save($param);
            if($result) {
                //评论计数加1
                $model = Model($model_name);
                $update = array();
                $update[$count_field] = array('exp',$count_field.'+1');
                $condition = array();
                $condition[$comment_object_key] = $comment_object_id;
                $model->modify($update, $condition);
                //返回信息
                $data['result'] = 'true';
                $data['message'] = '保存成功';
                $data['comment_id'] = $result;

            } else {
                $data['result'] = 'false';
                $data['message'] = '保存失敗';
            }
        } else {
            $data['result'] = 'false';
            $data['message'] = -1;
        }
        $this->echo_json($data);
    }

	 /**
     * 评论列表
     **/
    protected function comment_list($page_count=5,$comment_object_id) {
        $order = 'comment_id desc';
        $order = 'comment_up desc, comment_id desc';
        $comment_type = 1;
        if($comment_object_id > 0 && $comment_type > 0) {
            $condition = array();
            $condition["comment_object_id"] = $comment_object_id;
            $condition["comment_type"] = $comment_type;
            $model_cms_comment = Model('cms_comment');
			Tpl::output('page_count',ceil($model_cms_comment->getContents($condition)/$page_count));
            $comment_list = $model_cms_comment->getListWithUserInfo($condition, $page_count, $order);
            Tpl::output('comment_list', $comment_list);
        }
    }
	protected function echo_json($data) {
        if (strtoupper(CHARSET) == 'GBK'){
            $data = Language::getUTF8($data);//网站GBK使用编码时,转换为UTF-8,防止json输出汉字问题
        }
        echo json_encode($data);die;
    }

	   /*SEO*/
    private function getListSeoOp($goodsid){
        $array = array(
            '19'=>array(
                'title'=>'收藏知识 - 收藏学院 - 收藏天下',
				'tzxy_title'=>'收藏学院 - 收藏知识',
                'keywords'=>'收藏知识,收藏品资讯,人民币收藏知识',
                'description'=>'收藏天下投资学院，为藏友提供最新收藏品投资动态、投资行情、投资新闻。内容涉及艺术品投资，钱币投资、邮票投资以及金银投资，帮助收藏投资者了解更多投资知识'
                ),
            '40'=>array(
                'title'=>'专家观点 - 收藏学院 - 收藏天下',
				'tzxy_title'=>'收藏学院 - 专家观点',
                'keywords'=>'专家观点,如意先生观点,马未都收藏观点',
                'description'=>'收藏学院专家观点栏目特别为您提供人民币收藏、邮票收藏、金银币收藏、书画收藏的各类收藏专家的独家观点，让您在收藏的时候有一个专家作为良师益友。'
                ),
            '54'=>array(
                'title'=>'投资分析 - 收藏学院 - 收藏天下',
				'tzxy_title'=>'收藏学院 - 投资分析',
                'keywords'=>'投资分析,收藏品投资,艺术品收藏',
                'description'=>'收藏学院是依托于收藏天下百万用户而诞生的资讯类网站，根据网站百万用户的大数据特别推出投资分析频道，为您提供各种收藏投资的分析数据，让您在收藏投资中通过大数据分析，来获得投资方向和资源。'
                ),
            '37'=>array(
                'title'=>'邮币卡 - 收藏学院 - 收藏天下',
				'tzxy_title'=>'收藏学院 - 邮币卡',
                'keywords'=>'邮币卡,邮票资讯,人民币新闻,纪念钞信息',
                'description'=>'收藏学院邮币卡频道为您提供最新最全的邮票、人民币、纪念币、纪念钞等各种邮币卡的资讯，让您能够了解最多的邮币卡知识，在投资邮币卡的时候有更多的投资收藏知识。'
                ),
            '38'=>array(
                'title'=>'贵金属 - 收藏学院 - 收藏天下',
				'tzxy_title'=>'收藏学院 - 贵金属',
                'keywords'=>'贵金属,金银币资讯,金银条知识,贵金属信息',
                'description'=>'收藏学院贵金属频道为您提供最新金银币、金银条等贵金属的资讯，常识，知识等资讯，让您在收藏投资贵金属的时候有更多的资讯储备，时刻把握贵金属收藏投资的脉搏'
                ),
            '62'=>array(
                'title'=>'珠宝玉器 - 收藏学院 - 收藏天下',
				'tzxy_title'=>'收藏学院 - 珠宝玉器',
                'keywords'=>'珠宝玉器,翡翠知识,和田玉资讯,碧玉常识',
                'description'=>'收藏学院珠宝玉器频道为您提供最新最全的翡翠、和田玉、俄罗斯碧玉、缅甸翠玉等各种珠宝玉器的资讯,购买珠宝玉器的常识以及鉴定赏析珠宝玉器的简单常用方法和知识。'
                ),
            '55'=>array(
                'title'=>'书法字画 - 收藏学院 - 收藏天下',
				'tzxy_title'=>'收藏学院 - 书法字画',
                'keywords'=>'书法字画,毛笔书法知识,国画资讯,油画常识',
                'description'=>'收藏学院书法字画频道依托十六年的收藏品销售经验以及与书画名家的合作交流，特别奉献了书法字画频道，为您全面解读书法字画的收藏知识和最新资讯。'
                ),
            '41'=>array(
                'title'=>'藏品知识 - 收藏学院 - 收藏天下',
				'tzxy_title'=>'收藏学院 - 藏品知识',
                'keywords'=>'藏品知识,人民币收藏知识,手串怎么盘,邮票知识',
                'description'=>'藏品知识频道是收藏学院整理百万用户的咨询内容以及反馈的问题而特别设定的栏目，本栏目将传授各类收藏品知识以及文玩把件的盘玩技巧，以及收藏鉴赏知识。'
                ),
            '20'=>array(
                'title'=>'行情快讯 - 收藏学院 - 收藏天下',
				'tzxy_title'=>'收藏学院 - 行情快讯',
                'keywords'=>'行情快讯,收藏品行情,书画行情,邮票行情,艺术品行情',
                'description'=>'人民币收藏、邮票收藏、金银币、书画、手串、文玩等各类收藏品的行情快讯，尽在收藏学院，收藏学院为您提供最新最全的收藏品类行情资讯。'
                ),
            '39'=>array(
                'title'=>'收藏学院-藏市热点',
				'tzxy_title'=>'收藏学院 - 藏市热点',
                'keywords'=>'藏市热点,藏品热点资讯,书画热点资讯',
                'description'=>'书画、人民币收藏、邮票、金银币等各种收藏品艺术品收藏的热点资讯尽在收藏学院，收藏学院资讯具有及时性，时效性和准确度高等特点。'
                ),
            '58'=>array(
                'title'=>'保养知识 - 收藏学院 - 收藏天下',
				'tzxy_title'=>'收藏学院 - 保养知识',
                'keywords'=>'保养知识,钱币保养知识,书画保养知识,手串把玩常识',
                'description'=>'收藏学院保养知识频道为您提供钱币保养知识、书画保养知识、手串把玩常识、邮票保养知识、各种收藏品的保养知识，收藏学院让您能够更好保养好自己的收藏品。'
                ),
            '59'=>array(
                'title'=>'经验交流 - 收藏学院 - 收藏天下',
				'tzxy_title'=>'收藏学院 - 经验交流',
                'keywords'=>'经验交流,收藏经验,收藏品选购经验,书画欣赏',
                'description'=>'书画欣赏经验、钱币品相鉴定经验、邮票品相鉴定经验、金银币真假奠定经验、翡翠和田玉真假鉴定经验等各种收藏品艺术品的经验尽在收藏学院经验交流频道。'
                ),
            '60'=>array(
                'title'=>'收藏趣事 - 收藏学院 - 收藏天下',
				'tzxy_title'=>'收藏学院 - 收藏趣事',
                'keywords'=>'收藏趣事,中国画常识,毛笔书法知识',
                'description'=>'收藏学院为您搜集整理各种收藏趣闻，让您在感受收藏乐趣的时候也能体会收藏界的趣闻趣事，让你的眼界更加宽阔，收藏趣事尽在收藏学院'
                ),
            '42'=>array(
                'title'=>'藏品赏析 - 收藏学院 - 收藏天下',
				'tzxy_title'=>'收藏学院 - 藏品赏析',
                'keywords'=>'藏品赏析,书画欣赏,书法赏析,国画赏析,名画赏析',
                'description'=>'收藏学院藏品赏析栏目特别推出书画名家作品赏析，书法、国画、油画等各类书画作品欣赏以及赏析方法解析，让您更快速的了解意见书画作品，提高自己的鉴赏能力和投资能力。'
                ),
            '53'=>array(
                'title'=>'发行公告 - 收藏学院 - 收藏天下',
				'tzxy_title'=>'收藏学院 - 发行公告',
                'keywords'=>'发行公告,生肖金银纪念币发行,纪念钞发行公告,和字币发行公告',
                'description'=>'生肖金银币、生肖纪念币、生肖邮票，纪念钞、和字币等各类收藏品发行公告尽请关注收藏学院发行公告频道，让您第一时间了解各类新产品的发行，收藏抢先一步'
                ),
            '57'=>array(
                'title'=>'收藏法规 - 收藏学院 - 收藏天下',
				'tzxy_title'=>'收藏学院 - 收藏法规',
                'keywords'=>'收藏法规',
                'description'=>'收藏学院为您提供最新最全的收藏法规，让你规避收藏陷阱，真正体会收藏乐趣'
                ),
            '56'=>array(
                'title'=>'拍卖结果 - 收藏学院 - 收藏天下',
				'tzxy_title'=>'收藏学院 - 拍卖结果',
                'keywords'=>'拍卖结果,字画拍卖,保利拍卖,秋拍结果',
                'description'=>'收藏学院为您提供最新保利拍卖、嘉和拍卖等各类中外拍卖行最新拍卖信息和拍卖结果信息，了解拍卖行的收藏品艺术品拍卖风向，实时了解收藏行情，各类拍卖资讯尽在收藏天下网。'
                )
            );
        if(array_key_exists($goodsid,$array)){
            $content = $array["$goodsid"];
            /*SEO*/
			Tpl::output('html_title',$content['title']);
            Tpl::output('tzxy_title',$content['tzxy_title']);
            Tpl::output('seo_keywords',$content['keywords']);
            Tpl::output('seo_description',$content['description']);
        }
    }
}
