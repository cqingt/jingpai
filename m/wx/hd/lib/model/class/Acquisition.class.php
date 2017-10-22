<?php
class Crawl{
	public $domain; //������
	public $url_lsit; //��Ҫץȡ���б�ҳ��ַ
	public $url_page; //ҳ������
	public $title_start; //���⿪ʼ
	public $title_end; //�������
	public $content_start; //���ݿ�ʼ
	public $content_end; //���ݽ���
	public $content_del=array("/<div[^>]*>|<\/div>/i","/<script (.+)\/script>/i","/<span [^>]*>|<\/span>/i","/<a [^>]*>|<\/a>/i","/<FONT [^>]*>|<\/FONT>/","/<O:P[^>]*>|<\/O:P>/i","/<input[^>]*>/i","/<STYLE(.*?)\/STYLE>/is"); //���˵Ĵ���
	public $content_chu=array("","","","","","","","",""); //���˴����Ӧ��ת��

	private $url_show; //��Ҫץȡ����ҳ��ַ


	private function zhua_show($url){
		$content=@file_get_contents($url);
		if(empty($content)) {echo "ץȡ����!";exit;}
		$preg_title="/".$this->title_start."(.+)".$this->title_end."/i"; //ƥ�����������ʽ
		$preg_content=$this->content_start."|".$this->content_end; //ƥ������������ʽ
		
		preg_match($preg_title,$content,$bt); //ƥ���������
		$tmp=spliti($preg_content,$content); //ƥ����������
		
		$title=$bt[1]; //��ȡ����
		$html_content=strip_tags(trim(preg_replace($this->content_del,$this->content_chu,$tmp[1])),"<p>"); //��ȡ����

		return array($title,$html_content,$url);
	}
	
	function zhua_list($list_start,$list_end,$link_preg){
		$content=file_get_contents($this->url_list);
		//if(empty($content)) {echo "ץȡ����!";exit;}
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