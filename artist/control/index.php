<?php
/**
 * 艺术家首页
 *
 ***/
defined('InShopNC') or exit('Access Invalid!');

class indexControl extends ArtistHomeControl {
	public function __construct() {
        parent::__construct();
    }

	/**
	 * 默认进入页面

	 */
	public function indexOp(){
		/*
         * 首页所有查询放缓存
         * 操作模板： \data\model\cache.model.php 方法 _artist_index()
         * add 杜 2016-09-13
         */
        $do_cache_sec = 3600;//设置一个小时更新缓存一次
        $artist_index = rkcache('artist_index', true);
		if((TIMESTAMP - $artist_index['cache_time'] > $do_cache_sec) || isset($_GET['clear'])){
            dkcache('artist_index');//超过更新缓存
        }
		//收藏快讯
		Tpl::output('GongGao',$artist_index['GongGao']);
		//板块信息
		Tpl::output('web_html',$artist_index['web_html']);
		//秒杀
        Tpl::output('miaosha_list', $artist_index['miaosha_list']);

        Tpl::output('html_title','书画馆-书法-国画-油画-版画-名家收藏品-收藏天下');
        Tpl::output('seo_keywords','书画馆,书法收藏,国画收藏,油画收藏,版画收藏,名家收藏');
        Tpl::output('seo_description','收藏天下是国内最专业的收藏品网站,提供各类收藏品,包括书画馆,书法收藏,国画收藏,油画收藏,版画收藏,名家收藏等各类收藏品,并为您提供最新最全的收藏信息');
		
		Tpl::output('artist_push_list',$artist_index['artist_push_list']);
		Tpl::output('artist_zixun_list',$artist_index['artist_zixun_list']);
		Tpl::output('hqkx',$artist_index['hqkx']);
		Tpl::output('rdgz',$artist_index['rdgz']);
		Tpl::output('mrbj',$artist_index['mrbj']);
		Tpl::showpage('index');
	}
	
	/**
	 * 更新艺术家首页缓存

	 */
	public function delrkcacheOp(){
		dkcache('artist_index');//删除艺术家首页缓存
		echo "执行成功";
	}
}
?>