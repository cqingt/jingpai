<?php
/****************************************************************************
类别名称：数据翻页类
作用：数据翻页显示功能
开发时间：2010-3-12
开发人：精灵
*****************************************************************************/
class page{
//**********************************定义属性***********************************
	public $page=1; //当前页码
	public $url;
	public $dataArr; //返回的数据
	public $totle; //信息总数
	protected $pageNum=20; //每页显示信息数
	protected $pageMax; //最大页码

	protected $Resources; //数据库资源属性
//*******************************定义属性结束***********************************

//**********************************定义类方法***********************************
	//定义构造函数
	function __construct($conn,$page,$table,$url,$pageNum,$order,$where="",$field="*"){
		
		$this->Resources=$conn;
		$this->Resources->table($table); //设置操作的数据库表
		$this->totle=$this->Resources->sumRows($where);
		$this->pageNum=$pageNum;
		if(strpos($url,"?")){
			$this->url=$url."&page=";
		}else{
			$this->url=$url."-p-";
		}
		$this->pageMax=ceil($this->totle/$this->pageNum); //计算最大页码数
		if($page<=1) $page=1;
		if(!$page){
			if($page>=$this->pageMax) $page=$this->pageMax;
		}
		$this->page=$page; //获取页码
		$pagestart=($this->page-1)*$this->pageNum; //计算数据起始数
	
		
			
		$this->dataArr=$this->Resources->search($where,$order,"$pagestart,$pageNum",$field);//获取数据

	}

	/*
		@获取最大页码数
	*/
	public function getPageMax(){
		return $this->pageMax;
	}

	function pageStr($style){
		switch($style){
			case 1:
				if($this->pageMax<=1){
					$Str="";
				}else{
					if($this->page<=1){
						$Str.="首页 | 上一页";
					}else{
						$Str.="<a href=\"".($this->url)."1\">首页</a> | ";
						$Str.="<a href=\"".($this->url.($this->page-1))."\">上一页</a>";
					}
					if($this->page>=$this->pageMax){
						$Str.="";
					}else{
						$Str.=" | <a href=\"".($this->url.($this->page+1))."\">下一页</a> | ";
						$Str.="<a href=\"".($this->url.$this->pageMax)."\">尾页</a>";
					}
				}
				break;

			case 2:
				if($this->totle<=$pageNum){
				$Str="";
				}else{
					if($this->page<=1){
						$Str.="首页 | 上一页 ";
					}else{
						$Str.="<a href=\"".($this->url)."1\">首页</a> | ";
						$Str.="<a href=\"".($this->url.($this->page-1))."\">上一页</a> ";
					}
					if($this->page>=$this->pageMax){
						$Str.="下一页 | 尾页";
					}else{
						$Str.=" | <a href=\"".($this->url.($this->page+1))."\">下一页</a> | ";
						$Str.="<a href=\"".($this->url.$this->pageMax)."\">尾页</a>";
					}
					$Str.=" <select name=\"menu1\" onchange=\"location.href=this.value\">\n";
					for($i=1;$i<=$this->pageMax;$i++){
						$Str.="<option value=\"".($this->url.$i)."\" ";
						if($this->page==$i) $Str.="selected=\"selected\"";
						$Str.=">".$i."/".$this->pageMax."</option>\n";
					}
					$Str.="</select>\n";
				}
				break;
				
				case 3:
				if($this->totle<=$pageNum){
				$Str="";
				}else{
					if($this->page<=1){
						$Str.="全部共".$this->totle."条记录 第".$this->page."/".$this->pageMax."页 首页 | 上一页";
					}else{
						$Str.="全部共".$this->totle."条记录 第".$this->page."/".$this->pageMax."页 <a href=\"".($this->url)."1\">首页</a> | ";
						$Str.="<a href=\"".($this->url.($this->page-1))."\">上一页</a>";
					}
					if($this->page>=$this->pageMax){
						$Str.=" 下一页 | 尾页";
					}else{
						$Str.=" | <a href=\"".($this->url.($this->page+1))."\">下一页</a> | ";
						$Str.="<a href=\"".($this->url.$this->pageMax)."\">尾页</a>";
					}
					$Str.=" <select name=\"menu1\" onchange=\"location.href=this.value\">\n";
					for($i=1;$i<=$this->pageMax;$i++){
						$Str.="<option value=\"".($this->url.$i)."\" ";
						if($this->page==$i) $Str.="selected=\"selected\"";
						$Str.=">".$i."/".$this->pageMax."</option>\n";
					}
					$Str.="</select>\n";
				}
				break;
		}
		return $Str;
	}
//*******************************定义类方法结束***********************************

}
?>