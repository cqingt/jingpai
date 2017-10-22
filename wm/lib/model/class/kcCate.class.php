<?php
/*
类别名称：后台管理菜单类
作用：显示后台管理菜单
开发时间：2009-12-22
开发人：精灵
*/

//定义后台菜单管理类
class KCCate{
	public $ManageTable='sw_kccate'; //目标数据表
	private $Level; //级别属性
	private $Type; //级别类型属性 
	private $Resources; //数据库资源属性


	//定义构造函数
	function __construct($conn){
		$this->Resources=$conn; //引用外部资源
		$this->Resources->DBATBLE=$this->ManageTable; //设置数据库表
		$this->Level=0;
		$this->Type=0;
	}

	//获取菜单栏目数组
	function Menu($ID=0){
		$rowArr=$this->Resources->Search($where);//获取父分类下的全部子分类
		if(count($rowArr)) $Menu=$this->MenuFor($rowArr,$ID);
		return $Menu;
	}
	
	//取出菜单项目的递归函数
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

	//菜单删除
	function DelMenu($id,$str='操作成功！',$url=0){
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