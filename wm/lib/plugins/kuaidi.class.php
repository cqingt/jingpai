<?php
class kuaidiClass{

/****************快递查询函数*****************************
$key:查询API密匙
$com:快递公司编码
$NO:快递单号
$show:返回类型。0：返回json字符串，1：返回xml对象，2：返回html对象，3：返回text文本。如果不填，默认返回json字符串
$Code:验证码。默认为不使用验证码
**********************************************************/
public function SearchExpress($key,$com,$NO,$show=2,$Code=''){
	$URL='http://api.kuaidi100.com/api?id='.$key.'&order=asc&com='.$com.'&nu='.$NO.'&show='.$show;
	if($Code){
		$URL.='&valicode='.$Code;
	}
	//echo $URL;
	$curl = curl_init();
	curl_setopt ($curl, CURLOPT_URL, $URL);
	curl_setopt ($curl, CURLOPT_HEADER,0);
	if($Code){
		curl_setopt($curl,CURLOPT_COOKIE,"JSESSIONID={$_COOKIE['wl_JSESSIONID']}");
	}
	curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt ($curl, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
	curl_setopt ($curl, CURLOPT_TIMEOUT,5);
	$result = curl_exec($curl);
	curl_close ($curl);

	return iconv('UTF-8','GB2312',$result);
}


/************验证码图片展示函数***************/
function ShowCode($key,$com){
	$url='http://api.kuaidi100.com/verifyCode?id='.$key.'&com='.$com;
	$img=file_get_contents($url);
	//获取快递100响应头的session_id，用于需要验证码时，保持与快递100的session_id一致
	foreach($http_response_header as $val){
		if(strpos($val,'Set-Cookie')!==false){
			$a=explode(';',$val);
			$b=explode('=',$a[0]);
			setcookie('wl_JSESSIONID',trim($b[1]),time()+3600);
			break;
		}
	}
	echo $img;
}




public function SearchKuaiDi($ComNO,$ExpressNO,$Code){
		
	//$ExpressNOArr=array('EMS'=>'ems','ZJS'=>'zhaijisong','ZTO'=>'zhongtong','ST'=>'shunfeng','LB'=>'lianbangkuaidi');//快递编号数组	
	$KEY='988300fecc481025';
	//$NOArr=explode(':',$NO);
	//$ComNO=$ExpressNOArr[$NOArr[0]];//获取快递公司编码
	//$ExpressNO=$NOArr[1];
			//if(count($NOArr)==2){
				//if($ComNO=='ems' or $ComNO=='shunfeng'){
					//$Smarty->assign('CodeImg',ShowCode($KEY,$ComNO));
				//	$this->tpl('State',1);
				//}
			//}
			
			//$this->tpl('Number',$NO);
		//	$this->toString('block/SearchNO.html');
			//if(count($NOArr)==2){
				//$ComNO=$ExpressNOArr[$NOArr[0]];//获取快递公司编码
				//$ExpressNO=$NOArr[1];
				$data=$this->SearchExpress($KEY,$ComNO,$ExpressNO,3,$Code);
				//echo $ComNO."<br />";
				//echo $ExpressNO;
				$dataArr=explode("\n",$data);
				foreach($dataArr as $v){
					$str.="<li>".$v."</li>\n";
				}
				echo "　快递信息如下:<br><br><ul id='list'>\n	".$str."\n	</ul>";
		
}

public function Code($ComNO){
	$KEY='988300fecc481025';
	$this->ShowCode($KEY,$ComNO);
}	


}

?>