<?php
/*
������ƣ���̨����˵���
���ã���ʾ��̨����˵�
����ʱ�䣺2009-12-22
�����ˣ�����
*/

//�����̨�˵�������
class KCCate{
	public $ManageTable='sw_kccate'; //Ŀ�����ݱ�
	private $Level; //��������
	private $Type; //������������ 
	private $Resources; //���ݿ���Դ����


	//���幹�캯��
	function __construct($conn){
		$this->Resources=$conn; //�����ⲿ��Դ
		$this->Resources->DBATBLE=$this->ManageTable; //�������ݿ��
		$this->Level=0;
		$this->Type=0;
	}

	//��ȡ�˵���Ŀ����
	function Menu($ID=0){
		$rowArr=$this->Resources->Search($where);//��ȡ�������µ�ȫ���ӷ���
		if(count($rowArr)) $Menu=$this->MenuFor($rowArr,$ID);
		return $Menu;
	}
	
	//ȡ���˵���Ŀ�ĵݹ麯��
	private function MenuFor($Array,$Level=0){
		//Global $MenuStr,$MenuArrSmall;
		if(!$Level) $Level=0;
		foreach($Array as $key => $value){
			if($value["K_Level"]==$Level){
				$tmp[]=array("K_ID"=>$value["K_ID"],"K_CateName"=>$value["K_CateName"],"K_Level"=>0,"K_Link"=>$value["K_Link"],"K_Sort"=>$value["K_Sort"]);
			}
		}
		foreach($tmp as $ky => $val){
			foreach($Array as $k => $v){
				if($val["K_ID"]==$v["K_Level"]){
					$tmp[$ky]["A"][]=array("K_ID"=>$v["K_ID"],"K_CateName"=>$v["K_CateName"],"K_Level"=>$v["K_Level"],"K_Link"=>$v["K_Link"],"K_Sort"=>$v["K_Sort"]);
				}
				/*
				foreach($tmp[$ky] as $ke => $vl){
					foreach($Array as $kye => $vy){
						if($vl["K_ID"]==$vy["K_Level"]){
							$tmp[$ky][$ke][1][$kye]=array( "K_ID"=>$vy["K_ID"],
													"K_CateName"=>$vy["K_CateName"],
													"K_Level"=>$vy["K_Level"],
													"K_Link"=>$vy["K_Link"],
													"K_Sort"=>$vy["K_Sort"]
													);
						}
					}
				}
				*/
			}
			if(is_array($tmp[$ky]["A"])){
				foreach($tmp[$ky]["A"] as $ke => $vl){
					foreach($Array as $kye => $vy){
						if($vl["K_ID"]==$vy["K_Level"]){
							$tmp[$ky]["A"][$ke]["B"][]=array( "K_ID"=>$vy["K_ID"],
														"K_CateName"=>$vy["K_CateName"],
														"K_Level"=>$vy["K_Level"],
														"K_Link"=>$vy["K_Link"],
														"K_Sort"=>$vy["K_Sort"]
														);
						}
					}
				}

			}
		}
		return $tmp;
	}

	//�˵�ɾ��
	function DelMenu($id,$str='�����ɹ���',$url=0){
		if(is_Array($id)){
			foreach($id as $value){
				$sql="delete from ".$this->ManageTable." where ".$this->Resources->GetIdName()."=".$value;
				$exec="select * from ".$this->ManageTable." where K_Level=".$value;
				if($this->Resources->GetMySqlNum($exec)){
					$this->Resources->query("delete from ".$this->ManageTable." where K_Level=".$value);
				}
				$this->Resources->query($sql);
				$this->Resources->show($str,$url=0);
			}
		}else{
			$sql="delete from ".$this->ManageTable." where ".$this->Resources->GetIdName()."=".$id;
			$exec="select * from ".$this->ManageTable." where K_Level=".$id;
			if($this->Resources->GetMySqlNum($exec)){
				$this->Resources->query("delete from ".$this->ManageTable." where K_Level=".$id);
			}
			$this->Resources->query($sql);
			$this->Resources->show($str,$url=0);
		}
	}
}
?>