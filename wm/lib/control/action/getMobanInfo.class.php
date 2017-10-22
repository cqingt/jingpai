<?php

require_once(dirname(__FILE__)."/../../model/class/mysqlAction.class.php");

class getMobanInfo{
	public function __construct(){
		$this->c = new mysqlAction(config::$dbArr,'moban_val');//实例化数据库对象
	}

	public function getOneMobanInfo(){
		$id = G('id',2,2);

		if(!empty($id)){
			$this->c->table('moban_val v,moban_ad a');
			$result = $this->c->search("v.V_Id='".$id."' AND v.V_Ad = a.A_Id");
			$result = $result['0'];

			$dataArr['msg'] = 'ok';
			$dataArr['template_id'] = $result['V_MoBanId'];
			$dataArr['moban_name'] = $result['V_MoBanName'];
			$dataArr['remark'] = $result['A_Content'];
			$dataArr['url'] = $result['A_Url'];

			$sql = "UPDATE `sw_moban_val` SET V_Click = `V_Click`+1 WHERE `V_Id` = ".$id;
			$this->c->execute($sql);
		}else{
			$dataArr['msg'] = 'ID参数为空';
		}
		
		echo json_encode($dataArr);
	}





}
?>