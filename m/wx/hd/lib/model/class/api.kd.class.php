<?php
/**
 * ���100 API��
 * @author ʵ��Ů����    by Ҷľʢ
 * @link  http://www.shihui.cn
 * @version 2012-06-07
 */
class KaidiApi{
	private $key='988300fecc481025';//API KEY ���100������ �������ַ��http://www.kuaidi100.com/openapi/


	/**
	 * ������������
	 * @param string $wldh  ��������
	 * @param string $wlgs_dm ������˾����
	 * @param string $valicode ��֤��   ����������˾��Ҫ��֤��
	 */
	public function loadWL($wldh,$wlgs_dm,$valicode=''){
		$key=$this->key;
		if(!$valicode){
			//�Ƿ���Ҫ������֤�룬
			if($this->needValicode($wlgs_dm)){
				return array('message'=>'����������֤��','status'=>408);
			}
		}
		$url="http://api.kuaidi100.com/api?id={$key}&com={$wlgs_dm}&nu={$wldh}&valicode={$valicode}&show=0&muti=0";
		$curl = curl_init();
		curl_setopt ($curl, CURLOPT_URL, $url);
		curl_setopt ($curl, CURLOPT_HEADER,0);
		if($valicode){
		  	curl_setopt($curl,CURLOPT_COOKIE,"JSESSIONID={$_COOKIE['wl_JSESSIONID']}");
		 }
		 curl_setopt ($curl, CURLOPT_RETURNTRANSFER, 1);
		 curl_setopt ($curl, CURLOPT_USERAGENT,$_SERVER['HTTP_USER_AGENT']);
		 curl_setopt ($curl, CURLOPT_TIMEOUT,5);
		 $result = curl_exec($curl);
		 curl_close ($curl);
		$result=json_decode($result,true);

		if(!empty($result) && $result['status']==1){

		}elseif($result['status']==408 || $result['status']==4){
			//�����֤�����Ҫ����������
			return array('message'=>'��֤��������������룡','status'=>408);
		}

		//$result�������飬˵�����쳣
		if(!is_array($result)) $result=array();
		if(empty($result)) return array('message'=>'�����ݷ��أ�����ԭ�������쳣 �� ����û¼�룡','status'=>0);
		else return $result;
	}
	
	/**
	 * �ж�������˾�Ƿ���Ҫ������֤��
	 * @param string $wlgs_dm ������˾����
	 */
	public function needValicode($wlgs_dm){
		//�������������֤��Ŀ�ݹ�˾����
		$need=array('nanjing','ems','shentong','shunfeng','xingchengjibian','youzhengguonei');
		if(in_array($wlgs_dm,$need)){
			return true;
		}
		return false;
	}
	/**
	 * ������֤��
	 */
	public function loadValicode($wlgs_dm){
		$url='http://api.kuaidi100.com/verifyCode?id='.$this->key.'&com='.$wlgs_dm;
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
		return $img;
	}
	
}
?>