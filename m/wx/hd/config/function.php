<?php
//���ڼ��
function D($time,$date){
	if($time>$date){
		return false;
	}else{
		return true;
	}
}

//�ļ���Сͳ�ƺ���
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

//Ŀ¼��С���Ժ���
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

//��Ϣ����ҳ��
function show($Message="�����ɹ���",$url=0,$close=0){
	if(!$url){
		$toURL=$_SERVER["HTTP_REFERER"];
	}else{
		$toURL=$url;
	}
	echo "<script>alert('".$Message."');window.location.href='".$toURL."';</script>";
	exit;
}

//��ȡ������IP����
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

//��ȡ����ƴ������ĸ
function getinitial($str)
{
    $asc=ord(substr($str,0,1));
    if ($asc<160) //������
    {
        if ($asc>=48 && $asc<=57){
            return '1'; //����
        }elseif ($asc>=65 && $asc<=90){
            return chr($asc);   // A--Z
        }elseif ($asc>=97 && $asc<=122){
            return chr($asc-32); // a--z
        }else{
            return '~'; //����
        }
    }
    else   //����
    {
        $asc=$asc*1000+ord(substr($str,1,1));
        //��ȡƴ������ĸA--Z
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

//��Сд���ת������
function num2rmb($num){  
	//$num=$num["num"];
	$c1="��Ҽ��������½��ƾ�";  
	$c2="�ֽ�Ԫʰ��Ǫ��ʰ��Ǫ��";  
	$num=round($num,2);  
	$num=$num*100;  
	$NewNum = ceil($num);  
	if(strlen($NewNum)>10){ return "���̫��";  }
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
		if($n!='0' || ($n=='0' &&($p2=='��' || $p2=='��' || $p2=='Ԫ' ))){  
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
		if ($m=='��Ԫ' || $m=='����' || $m=='����' || $m=='����'){  
			$left=substr($c,0,$j);  
			$right=substr($c,$j+2);
			$c = $left.$right;
			$j = $j-2;
			$slen = $slen-2;
		}  
		$j=$j+2;
	}  

	if(substr($c,strlen($c)-2,2)=='��'){  
		$c=substr($c,0,strlen($c)-2);
	}
	return $c;
}

//ȫ�������滻
function QzB($intValue){
	$int=str_replace('��','1',$intValue);
	$int=str_replace('��','2',$int);
	$int=str_replace('��','3',$int);
	$int=str_replace('��','4',$int);
	$int=str_replace('��','5',$int);
	$int=str_replace('��','6',$int);
	$int=str_replace('��','7',$int);
	$int=str_replace('��','8',$int);
	$int=str_replace('��','9',$int);
	$int=str_replace('��','0',$int);
	return $int;
}

//�����ַ����˺���
function uhtml($str) { 
    $farr = array(	"/\s+/", //���˶���հ� 
					//���� <script>�ȿ�������������ݻ����ı���ʾ���ֵĴ���,�������Ҫ����flash��,�����Լ���<object>�Ĺ��� 
					"/<(\/?)(script|i?frame|style|html|body|title|link|meta|a|object|br|\?|\%)([^>]*?)>/isU",
					"/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",//����javascript��on�¼� 
				); 
	$tarr = array(	" ", 
					"",//���Ҫֱ���������ȫ�ı�ǩ������������� 
					"\1\2", 
				); 
	$strs = preg_replace( $farr,$tarr,$str); 
	return $strs; 
}

//url��ַ��ȡ����
function G($name,$style=1,$state=1,$html=0){
	switch($style){
		case 1://�����ݽ���
			$str=$_POST[$name];
			break;
		case 2://URL���ݽ���
			$str=$_GET[$name];
			break;
		case 3://ȫ�����ݽ���
			$str=$_REQUEST[$name];
			break;
		case 4://��Դ���ݽ���
			$str=$_FILES[$name];
			break;
	}
	
	//������������
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

//ÿ�������������
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

//RWRITE����������
function RwriteUrl($str){
	return str_replace($array1,$array2,strtolower(preg_replace("/([^a-zA-Z0-9]*\s+)/","-",$str)));
}
function RwriteUrl1($str){
	return str_replace($array1,$array2,strtolower(preg_replace("/([^a-zA-Z0-9]/*\s+)/","-",$str['str'])));
}

//���������ȡ����
function getPOST($arr){
	foreach($arr as $k=>$v){
		$arr[$k]=trim($v);
	}
	return $arr;
}

//�ж�һ����������һ���������Ƿ����
function check_in_array($arr){
	if(!is_array($arr)){ return false;}
	extract($arr);
	if($value1 && is_array($arr)){
		if(in_array($value,$arr)){
			echo 'checked="checked"';
		}
	}
}

//��ͼƬ�ϴ�����������
function uploadImgArr($arr){
	if(!is_array($arr)){ return false;}//�ж��Ƿ�Ϊ����
	if(!count($arr)){ return false;}//�ж������Ƿ���ֵ
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
	@��ʾ��ǰ���ڼ�
*/
function getWeek($number){
	$number=intval($number);
	switch($number){
		case 0:
			return '������';
		case 1:
			return '����һ';
		case 2:
			return '���ڶ�';
		case 3:
			return '������';
		case 4:
			return '������';
		case 5:
			return '������';
		case 6:
			return '������';
	}
}

/*
	@��ʾһ����ʱ���뵱ǰ�������ڼ�������������
	@$type������ѭ�����ͣ�0Ϊ�ӽ��쿪ʼѭ��7�죬1��Ϊ�����쿪ʼѭ��
	@$dayNum��ѭ������
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
	@α��̬�������
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
	@���������˵�ѡ������
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
	@����·��ת��
*/
function domain2folder($domain){
	if(!$domain){ return $domain; }
	return str_replace('.','_',$domain);
}

/*
	@Ŀ¼��������
*/
function listFile($dir){
	global $tempArr;
	$list = scandir($dir); // �õ����ļ��µ������ļ����ļ���
	foreach($list as $file){//����
		$filename = $dir."/".$file;//����·��
		if(is_dir($filename) && $file!="." && $file!=".."){ //�ж��ǲ����ļ���
			listFile($filename); //��������
		}else{
			$tempArr[] = $filename;
		}
	}
	return $tempArr;
}

/*
	@��ȡ�ļ�����
*/
function getFileContent($filePath){
	$fp = fopen($filePath,'r');
	while(!feof($fp)){ $content.=fgets($fp); }
	fclose($fp);
	return $content;
}

/*
	@��ȡ�ļ���չ��
*/
function getExtName($file){
	$tempArr = explode('.',$file);
	$max = count($tempArr)-1;
	return $tempArr[$max];
}

/*
	@����Ƿ�Ϊ�ֻ���
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
	@ ���ֲ�������
*/
function setJF($orderid,$status=0){
	if($status){//�ӻ���
		file_get_contents('http://www.96567.com/api/api_jf.php?order_id='.$orderid);
	}else{//������
		file_get_contents('http://www.96567.com/api/api_losejf.php?order_id='.$orderid);
	}
}

/*
	@ ����λ�������
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

//�ж����Ƿ�Ϊutf8����
function is_utf8($word){
	if(preg_match("/^([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}/",$word) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){1}$/",$word) == true || preg_match("/([".chr(228)."-".chr(233)."]{1}[".chr(128)."-".chr(191)."]{1}[".chr(128)."-".chr(191)."]{1}){2,}/",$word) == true){
		return true;
	}else{
		return false;
	}
}

//�ж��ֻ�ϵͳ����
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
 * @����ϵͳ�������������ı���
 * @ $length���� $valueĬ��ֵ
 * @ $name�ı�����
 * @ $other��������
 */
function createNumberInput($name,$length=10,$other,$value=''){
	if(wap_client() == 'android'){
		return '<input name="'.$name.'" id="'.$name.'" maxlength="'.$length.'" type="number" '.$other.'>';
	}else{
		return '<input name="'.$name.'" id="'.$name.'" maxlength="'.$length.'" type="text" pattern="[0-9]*" '.$other.'>';
	}
}
?>