<?php
/****************************************************************************
������ƣ����ݷ�ҳ��
���ã����ݷ�ҳ��ʾ����
����ʱ�䣺2010-3-12
�����ˣ�����
*****************************************************************************/
class page{
//**********************************��������***********************************
	public $page=1; //��ǰҳ��
	public $url;
	public $dataArr; //���ص�����
	public $totle; //��Ϣ����
	protected $pageNum=20; //ÿҳ��ʾ��Ϣ��
	protected $pageMax; //���ҳ��

	protected $Resources; //���ݿ���Դ����
//*******************************�������Խ���***********************************

//**********************************�����෽��***********************************
	//���幹�캯��
	function __construct($conn,$page,$table,$url,$pageNum,$order,$where="",$field="*"){
		
		$this->Resources=$conn;
		$this->Resources->table($table); //���ò��������ݿ��
		$this->totle=$this->Resources->sumRows($where);
		$this->pageNum=$pageNum;
		if(strpos($url,"?")){
			$this->url=$url."&page=";
		}else{
			$this->url=$url."-p-";
		}
		$this->pageMax=ceil($this->totle/$this->pageNum); //�������ҳ����
		if($page<=1) $page=1;
		if(!$page){
			if($page>=$this->pageMax) $page=$this->pageMax;
		}
		$this->page=$page; //��ȡҳ��
		$pagestart=($this->page-1)*$this->pageNum; //����������ʼ��
	
		
			
		$this->dataArr=$this->Resources->search($where,$order,"$pagestart,$pageNum",$field);//��ȡ����

	}

	/*
		@��ȡ���ҳ����
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
						$Str.="��ҳ | ��һҳ";
					}else{
						$Str.="<a href=\"".($this->url)."1\">��ҳ</a> | ";
						$Str.="<a href=\"".($this->url.($this->page-1))."\">��һҳ</a>";
					}
					if($this->page>=$this->pageMax){
						$Str.="";
					}else{
						$Str.=" | <a href=\"".($this->url.($this->page+1))."\">��һҳ</a> | ";
						$Str.="<a href=\"".($this->url.$this->pageMax)."\">βҳ</a>";
					}
				}
				break;

			case 2:
				if($this->totle<=$pageNum){
				$Str="";
				}else{
					if($this->page<=1){
						$Str.="��ҳ | ��һҳ ";
					}else{
						$Str.="<a href=\"".($this->url)."1\">��ҳ</a> | ";
						$Str.="<a href=\"".($this->url.($this->page-1))."\">��һҳ</a> ";
					}
					if($this->page>=$this->pageMax){
						$Str.="��һҳ | βҳ";
					}else{
						$Str.=" | <a href=\"".($this->url.($this->page+1))."\">��һҳ</a> | ";
						$Str.="<a href=\"".($this->url.$this->pageMax)."\">βҳ</a>";
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
						$Str.="ȫ����".$this->totle."����¼ ��".$this->page."/".$this->pageMax."ҳ ��ҳ | ��һҳ";
					}else{
						$Str.="ȫ����".$this->totle."����¼ ��".$this->page."/".$this->pageMax."ҳ <a href=\"".($this->url)."1\">��ҳ</a> | ";
						$Str.="<a href=\"".($this->url.($this->page-1))."\">��һҳ</a>";
					}
					if($this->page>=$this->pageMax){
						$Str.=" ��һҳ | βҳ";
					}else{
						$Str.=" | <a href=\"".($this->url.($this->page+1))."\">��һҳ</a> | ";
						$Str.="<a href=\"".($this->url.$this->pageMax)."\">βҳ</a>";
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
//*******************************�����෽������***********************************

}
?>