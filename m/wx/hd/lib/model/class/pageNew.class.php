<?php

/****************************************************************************
������ƣ����ݷ�ҳ��
���ã����ݷ�ҳ��ʾ����
����ʱ�䣺2010-3-12
�����ˣ�����
*****************************************************************************/
class pageNew extends page{
	//���幹�캯��
	function __construct($conn,$page,$table,$url,$pageNum,$order,$where="",$field="*"){
		$this->Resources=$conn;
		$this->Resources->DBTABLE=$table; //���ò��������ݿ��
		$this->totle=$this->Resources->SumRows($where,$field);
		$this->pageNum=$pageNum;
		if(strpos($url,"?")){
			$this->url=$url."&page=";
		}else{
			$this->url=$url."?page=";
		}
		$this->pageMax=ceil($this->totle/$this->pageNum); //�������ҳ����
		if($page<=1) $page=1;
		if(!$page){
			if($page>=$this->pageMax) $page=$this->pageMax;
		}
		$this->page=$page; //��ȡҳ��
		$pagestart=($this->page-1)*$this->pageNum; //����������ʼ��
		$this->dataArr=$this->Resources->Search($where,$order,"LIMIT $pagestart,$pageNum",$field);//��ȡ����

	}
}
?>