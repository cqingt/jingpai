<?php
include("page.class.php");
/**************************
2012年6月14日精灵创建
集成原始翻页类，重载翻页样式
功能：翻页样式扩展子类
**************************/


class PageTurn extends page{

	//翻页样式展示方法
	function pageStr(){
		$str='<span class="gray_a">&nbsp;共'.$this->pageMax.'页&nbsp;</span>';
		if($this->page > 1){
			$str.='<a href="'.($this->url).'1" >首页</a>';
			$str.='<a href="'.($this->url.($this->page-1)).'" >上一页</a>';
		}		

		if($this->page > 5){
			$s=$this->page-4;
			$e=$this->page+5;
			if($e == $this->pageMax or $e > $this->pageMax){
				$s=$this->pageMax-9;
				$e=$this->pageMax;
			}
			if($s<1){//如果最小页面不够减，则直接起始页码为一
				$s=1;
			}
		}else{
			$s=1;
			$e=$this->pageMax < 10 ? $this->pageMax : 10;
		}

		for($i=$s;$i<=$e;$i++){
			if( ($this->page) == $i ){
				$str.='<span class="gray">'.$i.'</span>';
			}else{
				$str.='<a href="'.($this->url.$i).'">'.$i.'</a>'."\n";
			}
		}

		if($this->page < $this->pageMax){
			$str.='<a href="'.($this->url.($this->page+1)).'" >下一页</a>';
			$str.='<a href="'.($this->url.($this->pageMax)).'" >末页</a>';
		}
		return $str;
	}

}
?>