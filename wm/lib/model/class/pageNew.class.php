<?php

/****************************************************************************
类别名称：数据翻页类
作用：数据翻页显示功能
开发时间：2010-3-12
开发人：精灵
*****************************************************************************/
class pageNew extends page{
	//定义构造函数
	function __construct($conn,$page,$table,$url,$pageNum,$order,$where="",$field="*"){
		$this->Resources=$conn;
		$this->Resources->DBTABLE=$table; //设置操作的数据库表
		$this->totle=$this->Resources->SumRows($where,$field);
		$this->pageNum=$pageNum;
		if(strpos($url,"?")){
			$this->url=$url."&page=";
		}else{
			$this->url=$url."?page=";
		}
		$this->pageMax=ceil($this->totle/$this->pageNum); //计算最大页码数
		if($page<=1) $page=1;
		if(!$page){
			if($page>=$this->pageMax) $page=$this->pageMax;
		}
		$this->page=$page; //获取页码
		$pagestart=($this->page-1)*$this->pageNum; //计算数据起始数
		$this->dataArr=$this->Resources->Search($where,$order,"LIMIT $pagestart,$pageNum",$field);//获取数据

	}
}
?>