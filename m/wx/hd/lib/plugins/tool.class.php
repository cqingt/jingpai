<?php
/*
	@���������
*/
class tool{
	//���������ļ�
	static public function createConfig($Number,$FolderPath=''){
		$FolderPath = $_SERVER['DOCUMENT_ROOT'];//�����ļ��и�Ŀ¼
		$db = new mysqlAction(config::$dbArr,'system_info');
		$dataArr = $db->search("W_Number='".$Number."'");
		foreach($dataArr[0] as $k=>$v){//��������
			$str.="Define('".strtoupper($k)."','".$v."');\n";		 
		}
		$TempData = "<?php\n".$str."?>";
		$Path=$FolderPath.'/config/config.php';//���������ļ�
		file_put_contents($Path,$TempData);
		unset($db);
	}
}

?>