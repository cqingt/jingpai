<?php
	/*
		@数据验证

		2015-3-21   L

	*/


class Accurate extends model{
	//定义构造函数：执行非空验证
	//$nullAraay	需要验证的数组
	//$url 			出错返回的URL路径
	public function __construct($nullAraay=null,$url='index.php?m=main&p=pc'){
		parent::__construct();
		//不传值则不验证
		if(!empty($nullAraay)){
		foreach($nullAraay as $key=>$val){
				if(empty($val)){
					show('请填写完整信息',$url);
					exit;
				}
			}
		}
	}

	//执行用户名验证
	//$table 		数据库表名称
	//$names 		字段名称
	//$name 		用户名称
	//$url 			出错返回的URL地址
	public function yName($table,$names,$name,$url='index.php?m=main&p=pc'){
		//连接数据库用户名表
		$this->c->table($table);
		//查询数据
		$res=$this->c->search($names.'='.$name);
		//和数据库对比用户名
		if($res){
			show('用户名已存在、请重新填写',$url);
			exit;
		}
	}

	//执行密码对比验证
	//$pass 		字段名称
	//$repass 		用户名称
	//$url 			出错返回的URL地址
	public function yPass($pass,$repass,$url='index.php?m=main&p=pc'){
		//对比两次输入密码
		if(!($pass == $repass)){
			show('两次密码输入不一致、请重新填写',$url);
			exit;
		}
	}

	//执行电话号码验证
	public function yMobile($mobile,$url='index.php?m=main&p=pc'){
		//正则验证手机号码
		// if(!preg_match("/^(((d{3}))|(d{3}-))?13d{9}$/",$mobile)){
		// 	show('手机号码输入不正确、请重新填写',$url);
		// 	exit;
		// }
		if(!preg_match("/13[0123456789]{1}\d{8}|15[1235689]\d{8}|18[89]\d{8}/",$mobile)){
			show('手机号码输入不正确、请重新填写',$url);
			exit;
		}
	}

	//身份证号码验证
	//$idcard 		身份证号码
	//$url 			出错返回URL地址
	public function ySheng($idcard,$url='index.php?m=main&p=pc'){  
	    // 只能是18位  
	    if(strlen($idcard)!=18){  
	        show('身份证号位数不正确、请重新填写',$url); 
	        exit;
	    }  
	    // 取出本体码  
	    $idcard_base = substr($idcard, 0, 17);  
	    // 取出校验码  
	    $verify_code = substr($idcard, 17, 1);  
	    // 加权因子  
	    $factor = array(7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2);  
	    // 校验码对应值  
	    $verify_code_list = array('1', '0', 'X', '9', '8', '7', '6', '5', '4', '3', '2');  
	    // 根据前17位计算校验码  
	    $total = 0;  
	    for($i=0; $i<17; $i++){  
	        $total += substr($idcard_base, $i, 1)*$factor[$i];  
	    }  
	    // 取模  
	    $mod = $total % 11;  
	    // 比较校验码  
	    if($verify_code != $verify_code_list[$mod]){  
	        show('身份证号不正确、请重新填写',$url); 
	        exit;
	    }  
	}  

	//定义系统析构方法
	public function __destruct(){
		$this->toString();
		mysql_close();
	}
	
}

?>		