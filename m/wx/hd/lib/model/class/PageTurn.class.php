<?php
include("page.class.php");
/**************************
2012��6��14�վ��鴴��
����ԭʼ��ҳ�࣬���ط�ҳ��ʽ
���ܣ���ҳ��ʽ��չ����
**************************/


class PageTurn extends page{

	//��ҳ��ʽչʾ����
	function pageStr(){
		$str='<span class="gray_a">&nbsp;��'.$this->pageMax.'ҳ&nbsp;</span>';
		if($this->page > 1){
			$str.='<a href="'.($this->url).'1" >��ҳ</a>';
			$str.='<a href="'.($this->url.($this->page-1)).'" >��һҳ</a>';
		}		

		if($this->page > 5){
			$s=$this->page-4;
			$e=$this->page+5;
			if($e == $this->pageMax or $e > $this->pageMax){
				$s=$this->pageMax-9;
				$e=$this->pageMax;
			}
			if($s<1){//�����Сҳ�治��������ֱ����ʼҳ��Ϊһ
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
			$str.='<a href="'.($this->url.($this->page+1)).'" >��һҳ</a>';
			$str.='<a href="'.($this->url.($this->pageMax)).'" >ĩҳ</a>';
		}
		return $str;
	}

}
?>