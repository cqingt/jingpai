<?php
class kuaidiClass{

/****************��ݲ�ѯ����*****************************
$key:��ѯAPI�ܳ�
$com:��ݹ�˾����
$NO:��ݵ���
$show:�������͡�0������json�ַ�����1������xml����2������html����3������text�ı���������Ĭ�Ϸ���json�ַ���
$Code:��֤�롣Ĭ��Ϊ��ʹ����֤��
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


/************��֤��ͼƬչʾ����***************/
function ShowCode($key,$com){
	$url='http://api.kuaidi100.com/verifyCode?id='.$key.'&com='.$com;
	$img=file_get_contents($url);
	//��ȡ���100��Ӧͷ��session_id��������Ҫ��֤��ʱ����������100��session_idһ��
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
		
	//$ExpressNOArr=array('EMS'=>'ems','ZJS'=>'zhaijisong','ZTO'=>'zhongtong','ST'=>'shunfeng','LB'=>'lianbangkuaidi');//��ݱ������	
	$KEY='988300fecc481025';
	//$NOArr=explode(':',$NO);
	//$ComNO=$ExpressNOArr[$NOArr[0]];//��ȡ��ݹ�˾����
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
				//$ComNO=$ExpressNOArr[$NOArr[0]];//��ȡ��ݹ�˾����
				//$ExpressNO=$NOArr[1];
				$data=$this->SearchExpress($KEY,$ComNO,$ExpressNO,3,$Code);
				//echo $ComNO."<br />";
				//echo $ExpressNO;
				$dataArr=explode("\n",$data);
				foreach($dataArr as $v){
					$str.="<li>".$v."</li>\n";
				}
				echo "�������Ϣ����:<br><br><ul id='list'>\n	".$str."\n	</ul>";
		
}

public function Code($ComNO){
	$KEY='988300fecc481025';
	$this->ShowCode($KEY,$ComNO);
}	


}

?>