<?php
/**
 * cms首页
 *
 *
 ***/

defined('InShopNC') or exit('Access Invalid!');
class indexControl extends CMSHomeControl{

	public function __construct() {
		parent::__construct();
        Tpl::output('index_sign','index');
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
        $cpsx = $article_model->getList(array('article_state'=>'3','article_class_id'=>'42'),null,'article_publish_time desc','*','3');
        Tpl::output('cpsx',$cpsx);

        //收藏法规
        $scfg = $article_model->getList(array('article_state'=>'3','article_class_id'=>'57'),null,'article_publish_time desc','*','5');
        Tpl::output('scfg',$scfg);

        //保养知识
        $byzs = $article_model->getList(array('article_state'=>'3','article_class_id'=>'58'),null,'article_publish_time desc','*','5');
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



        Tpl::showpage('index');
	}
}
