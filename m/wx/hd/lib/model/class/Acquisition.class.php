<?php
class Crawl{
	public $domain; //主域名
	public $url_lsit; //需要抓取的列表页地址
	public $url_page; //页码总数
	public $title_start; //标题开始
	public $title_end; //标题结束
	public $content_start; //内容开始
	public $content_end; //内容结束
	public $content_del=array("/<div[^>]*>|<\/div>/i","/<script (.+)\/script>/i","/<span [^>]*>|<\/span>/i","/<a [^>]*>|<\/a>/i","/<FONT [^>]*>|<\/FONT>/","/<O:P[^>]*>|<\/O:P>/i","/<input[^>]*>/i","/<STYLE(.*?)\/STYLE>/is"); //过滤的代码
	public $content_chu=array("","","","","","","","",""); //过滤代码对应的转换

	private $url_show; //需要抓取内容页地址


	private function zhua_show($url){
		$content=@file_get_contents($url);
		if(empty($content)) {echo "抓取错误!";exit;}
		$preg_title="/".$this->title_start."(.+)".$this->title_end."/i"; //匹配标题正则表达式
		$preg_content=$this->content_start."|".$this->content_end; //匹配内容正则表达式
		
		preg_match($preg_title,$content,$bt); //匹配标题数据
		$tmp=spliti($preg_content,$content); //匹配内容数据
		
		$title=$bt[1]; //获取标题
		$html_content=strip_tags(trim(preg_replace($this->content_del,$this->content_chu,$tmp[1])),"<p>"); //获取正文

		return array($title,$html_content,$url);
	}
	
	function zhua_list($list_start,$list_end,$link_preg){
		$content=file_get_contents($this->url_list);
		//if(empty($content)) {echo "抓取错误!";exit;}
		$list=spliti($list_start."|".$list_end,$content);
		preg_match_all($link_preg,$list[1],$prov);
		$listArr=$prov[1];
		$max=count($listArr);
		for($i=0;$i<$max;$i++){
			$tmp[]=$this->zhua_show($this->domain."/".$listArr[$i]);
		}
		return $tmp;
	}
}
?>