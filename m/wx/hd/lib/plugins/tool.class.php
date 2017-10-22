<?php
/*
	@插件工具类
*/
class tool{
	//生成配置文件
	static public function createConfig($Number,$FolderPath=''){
		$FolderPath = $_SERVER['DOCUMENT_ROOT'];//设置文件夹根目录
		$db = new mysqlAction(config::$dbArr,'system_info');
		$dataArr = $db->search("W_Number='".$Number."'");
		foreach($dataArr[0] as $k=>$v){//整理数据
			$str.="Define('".strtoupper($k)."','".$v."');\n";		 
		}
		$TempData = "<?php\n".$str."?>";
		$Path=$FolderPath.'/config/config.php';//生成配置文件
		file_put_contents($Path,$TempData);
		unset($db);
	}
}

?>