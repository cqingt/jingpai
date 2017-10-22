<?php
//到期检测
function D($time,$date){
	if($time>$date){
		return false;
	}else{
		return true;
	}
}

//文件大小统计函数
function sizecount($filesize) {
	if($filesize >= 1073741824){
		$filesize = round($filesize / 1073741824 * 100) / 100 . ' G';
	}elseif($filesize >= 1048576){
		$filesize = round($filesize / 1048576 * 100) / 100 . ' M';
	}elseif($filesize >= 1024){
		$filesize = round($filesize / 1024 * 100) / 100 . ' K';
	}else{
		$filesize = $filesize . ' bytes';
	}
	return $filesize;
}

//目录大小测试函数
function dirsize($dir) { 
	@$dh = opendir($dir);
	$size = 0;
	while ($file = @readdir($dh)) {
		if ($file != "." and $file != "..") {
			$path = $dir."/".$file;
			if (is_dir($path)) {
				$size += dirsize($path);
			} elseif (is_file($path)) {
				$size += filesize($path);
			}
		}
	}
	@closedir($dh);
	return $size;
}

//信息返回页面
function show($Message="操作成功！",$url=0,$close=0){
	if(!$url){
		$toURL=$_SERVER["HTTP_REFERER"];
	}else{
		$toURL=$url;
	}
	echo "<script>alert('".$Message."');window.location.href='".$toURL."';</script>";
	exit;
}

//获取访问者IP函数
function getIP(){
	static $realip;
	if (isset($_SERVER)){
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
			$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		}elseif(isset($_SERVER["HTTP_CLIENT_IP"])) {
			$realip = $_SERVER["HTTP_CLIENT_IP"];
		}else{
			$realip = $_SERVER["REMOTE_ADDR"];
		}
	}else{
	if (getenv("HTTP_X_FORWARDED_FOR")){
			$realip = getenv("HTTP_X_FORWARDED_FOR");
		}elseif(getenv("HTTP_CLIENT_IP")) {
			$realip = getenv("HTTP_CLIENT_IP");
		}else{
			$realip = getenv("REMOTE_ADDR");
	}
	}
	return trim($realip);
}

//获取汉字拼音首字母
function getinitial($str)
{
    $asc=ord(substr($str,0,1));
    if ($asc<160) //非中文
    {
        if ($asc>=48 && $asc<=57){
            return '1'; //数字
        }elseif ($asc>=65 && $asc<=90){
            return chr($asc);   // A--Z
        }elseif ($asc>=97 && $asc<=122){
            return chr($asc-32); // a--z
        }else{
            return '~'; //其他
        }
    }
    else   //中文
    {
        $asc=$asc*1000+ord(substr($str,1,1));
        //获取拼音首字母A--Z
        if ($asc>=176161 && $asc<176197){
            return 'A';
        }elseif ($asc>=176197 && $asc<178193){
            return 'B';
        }elseif ($asc>=178193 && $asc<180238){
            return 'C';
        }elseif ($asc>=180238 && $asc<182234){
            return 'D';
        }elseif ($asc>=182234 && $asc<183162){
            return 'E';
        }elseif ($asc>=183162 && $asc<184193){
            return 'F';
        }elseif ($asc>=184193 && $asc<185254){
            return 'G';
        }elseif ($asc>=185254 && $asc<187247){
            return 'H';
        }elseif ($asc>=187247 && $asc<191166){
            return 'J';
        }elseif ($asc>=191166 && $asc<192172){
            return 'K';
        }elseif ($asc>=192172 && $asc<194232){
            return 'L';
        }elseif ($asc>=194232 && $asc<196195){
            return 'M'; 
      }elseif ($asc>=196195 && $asc<197182){
            return 'N';
        }elseif ($asc>=197182 && $asc<197190){
            return 'O';
        }elseif ($asc>=197190 && $asc<198218){
            return 'P';
        }elseif ($asc>=198218 && $asc<200187){
            return 'Q';
        }elseif ($asc>=200187 && $asc<200246){
            return 'R';
        }elseif ($asc>=200246 && $asc<203250){
            return 'S';
        }elseif ($asc>=203250 && $asc<205218){
            return 'T';
        }elseif ($asc>=205218 && $asc<206244){
            return 'W';
        }elseif ($asc>=206244 && $asc<209185){
            return 'X';
        }elseif ($asc>=209185 && $asc<212209){
            return 'Y';
        }elseif ($asc>=212209){
            return 'Z';
        }else{
            return "";
        }
    }
}

function hanzi($str){
	$str=preg_replace("/[0-9]+/","",$str);
	$arr = str_split($str,2);
	foreach($arr as $key => $value) $arr[$key]=getinitial(trim($value));
	return join("",$arr);
}

//大小写金额转换函数
function num2rmb($num){  
	//$num=$num["num"];
	$c1="零壹贰叁肆伍陆柒捌玖";  
	$c2="分角元拾佰仟万拾佰仟亿";  
	$num=round($num,2);  
	$num=$num*100;  
	$NewNum = ceil($num);  
	if(strlen($NewNum)>10){ return "金额太大";  }
	$i=0;  
	$c=""; 
	while (1){  
		if($i==0){  
			$n=substr($num,strlen($num)-1,1);  
		}else{  
			$n=$num %10;  
		}  	
		$p1=substr($c1,2*$n,2);  
		$p2=substr($c2,2*$i,2);  
		if($n!='0' || ($n=='0' &&($p2=='亿' || $p2=='万' || $p2=='元' ))){  
			$c=$p1.$p2.$c;  
		}else{  
			$c=$p1.$c;  
		}
		$i=$i+1;  
		$num=$num/10;  
		$num=(int)$num;  
		if($num==0){ break; }  
	}  

	$j = 0;  
	$slen=strlen($c);  
	while ($j< $slen) {  
		$m = substr($c,$j,4);   
		if ($m=='零元' || $m=='零万' || $m=='零亿' || $m=='零零'){  
			$left=substr($c,0,$j);  
			$right=substr($c,$j+2);
			$c = $left.$right;
			$j = $j-2;
			$slen = $slen-2;
		}  
		$j=$j+2;
	}  

	if(substr($c,strlen($c)-2,2)=='零'){  
		$c=substr($c,0,strlen($c)-2);
	}
	return $c;
}

//全角数字替换
function QzB($intValue){
	$int=str_replace('１','1',$intValue);
	$int=str_replace('２','2',$int);
	$int=str_replace('３','3',$int);
	$int=str_replace('４','4',$int);
	$int=str_replace('５','5',$int);
	$int=str_replace('６','6',$int);
	$int=str_replace('７','7',$int);
	$int=str_replace('８','8',$int);
	$int=str_replace('９','9',$int);
	$int=str_replace('０','0',$int);
	return $int;
}

//特殊字符过滤函数
function uhtml($str) { 
    $farr = array(	"/\s+/", //过滤多余空白 
					//过滤 <script>等可能引入恶意内容或恶意改变显示布局的代码,如果不需要插入flash等,还可以加入<object>的过滤 
					"/<(\/?)(script|i?frame|style|html|body|title|link|meta|a|object|br|\?|\%)([^>]*?)>/isU",
					"/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",//过滤javascript的on事件 
				); 
	$tarr = array(	" ", 
					"",//如果要直接清除不安全的标签，这里可以留空 
					"\1\2", 
				); 
	$strs = preg_replace( $farr,$tarr,$str); 
	return $strs; 
}

//url地址获取函数
function G($name,$style=1,$state=1,$html=0){
	switch($style){
		case 1://表单数据接受
			$str=$_POST[$name];
			break;
		case 2://URL数据接受
			$str=$_GET[$name];
			break;
		case 3://全局数据接受
			$str=$_REQUEST[$name];
			break;
		case 4://资源数据接受
			$str=$_FILES[$name];
			break;
	}
	
	//数据类型整理
	if(!is_array($str)){
		switch($State){
			case 1:
				$str=trim($str);
				break;
			case 2:
				$str=intval($str);
				break;
		}
	}
	if($html){
		return $str;
	}else{
		return uhtml($str);
	}
}

//每月最大天数返回
function MonthMax($Month,$Day){
	$MonthArr=Array('04','06','09','10','11');
	if(array_search($Month,$MonthArr)){
		$DayShow=30;
	}elseif($Month=='02'){
		$DayShow=28;
	}else{
		$DayShow=31;
	}

	if(intval($Day)>30){
		return $DayShow;
	}else{
		return $Day;
	}
}

//RWRITE连接整理函数
function RwriteUrl($str){
	return str_replace($array1,$array2,strtolower(preg_replace("/([^a-zA-Z0-9]*\s+)/","-",$str)));
}
function RwriteUrl1($str){
	return str_replace($array1,$array2,strtolower(preg_replace("/([^a-zA-Z0-9]/*\s+)/","-",$str['str'])));
}

//数据整理获取函数
function getPOST($arr){
	foreach($arr as $k=>$v){
		$arr[$k]=trim($v);
	}
	return $arr;
}

//判断一个数组在另一个数组中是否存在
function check_in_array($arr){
	if(!is_array($arr)){ return false;}
	extract($arr);
	if($value1 && is_array($arr)){
		if(in_array($value,$arr)){
			echo 'checked="checked"';
		}
	}
}

//多图片上传数组整理函数
function uploadImgArr($arr){
	if(!is_array($arr)){ return false;}//判断是否为数组
	if(!count($arr)){ return false;}//判断数组是否有值
	foreach($arr as $k=>$v){
		foreach($v as $k1=>$v1){
			if($v1){
				$temp[$k1][$k]=$v1;
			}
		}
	}
	return $temp;
}

/*
	@显示当前星期几
*/
function getWeek($number){
	$number=intval($number);
	switch($number){
		case 0:
			return '星期日';
		case 1:
			return '星期一';
		case 2:
			return '星期二';
		case 3:
			return '星期三';
		case 4:
			return '星期四';
		case 5:
			return '星期五';
		case 6:
			return '星期六';
	}
}

/*
	@显示一周内时间与当前日期星期几，并返回数组
	@$type：日期循环类型，0为从今天开始循环7天，1则为从明天开始循环
	@$dayNum：循环几天
*/
function getWeekDay($type=0,$dayNum=7){
	for($i=$type;$i<=$dayNum+$type;$i++){
		$time=date("Y-m-d",strtotime("+{$i} day"));
		$week=getWeek( date( 'w',strtotime($time) ) );
		$date[$time]=Array($time,$week);
	}
	return $date;
}

/*
	@伪静态处理操作
*/
function Rwrite($url){
	$url = $url['value'];
	if(RWRITE){
		$url = str_replace('&p=index','',$url);
		$urlArr = explode('&',$url);
		foreach($urlArr as $k=>$v){
			if($k==0){
				$u[] = str_replace('index.php?m=index&m=','',$v);
			}else{
				$u[] = str_replace('=','-',$v);
			}
		}
		$url = join('-',$u).'.html';
	}
	return $url;
}

/*
	@创建下来菜单选择数据
*/
function createSelectOption($dataArr,$name,$value,$tid){
	foreach($dataArr as $k=>$v){
		if($tid==$v[$value]){ $selected = 'selected="selected"'; }
		$str.="<option value=\"".$v[$value]."\" ".$selected.">".$v[$name]."</option>\n";
		unset($selected);
	}
	return $str;
}

/*
	@域名路径转换
*/
function domain2folder($domain){
	if(!$domain){ return $domain; }
	return str_replace('.','_',$domain);
}

/*
	@目录遍历函数
*/
function listFile($dir){
	global $tempArr;
	$list = scandir($dir); // 得到该文件下的所有文件和文件夹
	foreach($list as $file){//遍历
		$filename = $dir."/".$file;//生成路径
		if(is_dir($filename) && $file!="." && $file!=".."){ //判断是不是文件夹
			listFile($filename); //继续遍历
		}else{
			$tempArr[] = $filename;
		}
	}
	return $tempArr;
}

/*
	@获取文件内容
*/
function getFileContent($filePath){
	$fp = fopen($filePath,'r');
	while(!feof($fp)){ $content.=fgets($fp); }
	fclose($fp);
	return $content;
}

/*
	@获取文件扩展名
*/
function getExtName($file){
	$tempArr = explode('.',$file);
	$max = count($tempArr)-1;
	return $tempArr[$max];
}

/*
	@检测是否为手机号
*/
function checkMobile($mobile){
	/*
	$pattern="/^(13|15|18|14)/\d\{9\}$/";
	if(preg_match($pattern,$mobile)){
		return true;
	}else{
		return false;
	}
	*/
	return true;
}

/*
	@ 积分操作函数
*/
function setJF($orderid,$status=0){
	if($status){//加积分
		file_get_contents('http://www.96567.com/api/api_jf.php?order_id='.$orderid);
	}else{//减积分
		file_get_contents('http://www.96567.com/api/api_losejf.php?order_id='.$orderid);
	}
}

/*
	@ 生成位随机密码
*/
function randPass($n=6){
	$dataArr = '1234567890abcdefghijklmnopqrstuvwxyz';
	$length = strlen($dataArr);
	for($i=0;$i<$n;$i++){
		$num = rand(0,($length-1));
		$temp[] = $dataArr[$num];
	}
	return join('',$temp);
}

//判断你是否为utf8编码
function is_utf8($word){
	if(preg_match("/^([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}/",$word) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}$/",$word) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){2,}/",$word) == true){
		return true;
	}else{
		return false;
	}
}

//判断手机系统类型
function wap_client(){
	if(stristr($_SERVER['HTTP_USER_AGENT'],"Android")) {
		return "android";
	}else if(stristr($_SERVER['HTTP_USER_AGENT'],"iPhone")){
		return "ios";
	}else{
		return "other";
	}
}

/***
 * @按照系统类型生成数字文本域
 * @ $length长度 $value默认值
 * @ $name文本域名
 * @ $other其他参数
 */
function createNumberInput($name,$length=10,$other,$value=''){
	if(wap_client() == 'android'){
		return '<input name="'.$name.'" id="'.$name.'" maxlength="'.$length.'" type="number" '.$other.'>';
	}else{
		return '<input name="'.$name.'" id="'.$name.'" maxlength="'.$length.'" type="text" pattern="[0-9]*" '.$other.'>';
	}
}
?>