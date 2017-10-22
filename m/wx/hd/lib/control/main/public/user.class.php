<?php
/**
 * SW session������
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������user
 * 
 * @���ܣ�user�û���Ϣ��
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�user.class.php
 * 
 * @����ʱ�䣺2014-8-13 15:44:00
 * 
 * @user��
 * 
 */
class user{
	private $db;//���ݿ����Ӿ��
	private $weixin;//΢�Ŵ���������
	public function __construct($conn){	
		$this->weixin = new weixinAPI;
		$this->db = $conn;
		$this->db->table('user');
	}

	/**
	 * @ ��ȡ�û�openid
	 */
	public function getOpenid(){
		$code = G('code',2);
		$a = G('state',2);
		
		if($a != 'sw'){//���Ϊ��Ȩ��ȡ�û���Ϣ���������²���
			if(!$_COOKIE['openid'] && $code){
				$openid = $this->weixin->getOpenID($code);//��ȡOpenID
				setCookie('openid',$openid,time()+2592000,"/","96567.com");
			}else if(!$_COOKIE['openid'] && !$code){
				$this->weixin->sendOpenID();
			}
		}
	}


	/**
	 * @ ͨ��openid��ȡ�û���Ϣ
	 */
	public function getWeixinInfo($openid){
		
		if(!$openid){
			echo "<script>window.location.reload();</script>";
			exit;	
		}
		
		$a = G('state',2);
		if($a != 'sw'){
			$userArr = $this->weixin->getWeixinUserInfo($openid);
			//�����ǰ�˻�δ��ע΢�Ź��ںţ���ִ����Ȩ��ȡ�˻���Ϣ
			if($userArr['guanzhu']!='1' && !$this->checkOpenid($openid)){
				$this->weixin->sq();
			}

		}else if($a == 'sw'){//��ȡȷ����Ȩ����û���Ϣ
			$userArr = $this->weixin->getOauthUserInfo(G('code',2));
		}
		//ִ��΢�����ݼ�¼
		return $this->addUserInfo($userArr,$openid);
	}

	/**
	 * @ ͨ��openid��ȡ�û���Ϣ
	 */
	public function getUserArr($openid){
		$this->db->table('user');
		$dataArr = $this->db->search("openid='".$openid."'");
		$dataArr[0]['totalRen'] = $this->getTotalFu($openid);
		return $dataArr[0];
	}

	/**
	 * @ ͨ��openid��ȡ��ǰ�û�ף������
	 */
	public function getTotalFu($openid){
		$this->db->table('fu_log');
		$num = $this->db->sumRows("L_Sopenid='".$openid."' AND L_Type=0");
		return $num;
	}

	/**
	 * @ ����ȡ���û���Ϣ��¼�����ݿ�
	 */
	private function addUserInfo($arr,$openid){
		if(!is_array($arr) && $openid){ return false; }
		$this->db->table('user');
		if($this->checkOpenid($openid)){
			$dataArr = $this->db->search("openid='".$openid."'");
			$arr = $this->subStatusUpdate($arr,$dataArr[0],$openid);
			//$arr = $dataArr[0];
			$arr['newAdd'] = 0;
		}else if($arr['nickname']){
			$arr['time'] = time();
			$arr['tj_openid'] = G('tj_openid',1);
			if($arr['guanzhu']){ $arr['fu'] = 0; }
			$this->db->insert($arr);
			$arr['newAdd'] = 1;

			//��¼������¼
			if($arr['guanzhu']){
				logcat::write($this->db,$openid,0,$arr['fu'],1);
			}
		}
		return $arr;
	}

	/**
	 * @ �ж��Ƿ��ע״̬�иı�
	 */
	private function subStatusUpdate($arr,$arr1,$openid){
		if($arr['guanzhu']!=$arr1['guanzhu']){
			//�ж����Ƿ��й�ע������¼
			if(!$this->checkWeixinFu($openid)){
				//$fu = ",fu=".($arr1['fu'] + 30);
				//$arr1['fu'] = $arr1['fu'] + 30;
				//logcat::write($this->db,$openid,0,30,1);
			}
			if($arr['nickname']){
				$this->db->execute("UPDATE sw_user SET guanzhu='".$arr['guanzhu']."'".$fu." WHERE openid='".$openid."'");
				$arr1['guanzhu'] = $arr['guanzhu'];
			}
		}
		return $arr1;
	}

	/**
	 * @ ����������
	 */
	public function addFu($sopenid,$fopenid){
		$fu = $this->getFuNum($sopenid);
		$this->db->execute("UPDATE sw_user SET fu=fu+'".$fu."' WHERE openid='".$sopenid."'");
		logcat::write($this->db,$sopenid,$fopenid,$fu);
		return $fu;
	}

	/**
	 * @����ָ��ף������
	 */
	public function addNumFu($openid,$fu,$type=0){
		$this->db->table('user');
		$this->db->execute("UPDATE sw_user SET fu=fu+'".$fu."' WHERE openid='".$openid."'");
		logcat::write($this->db,$openid,0,$fu,$type);
		return $fu;
	}

	/**
	 * @ ����ָ��openid������δ֪
	 */
	public function rank($openid){
		$this->db->table('user');
		$where = "fu>=(SELECT fu FROM sw_user WHERE openid='".$openid."')";
		$num = $this->db->sumRows($where);
		return $num;
	}

	/**
	 * @ ��ü�������
	 */
	private function getFuNum($openid){
		$this->db->table('user');
		$dataArr = $this->db->search("openid='".$openid."'",'','','fu');
		$fu = intval($dataArr[0]['fu']);
		if($fu<=100){
			$num = rand(1,3);
		}else{
			$num = 1;
		}
		return $num;
	}

	/**
	 * @ ��ȡף����Ա�嵥
	 */
	public function getSongList($openid){
		$this->db->table('fu_log');
		$where = "L_Sopenid='".$openid."' AND L_Type=0 AND (SELECT nickname FROM sw_user WHERE openid=L_Fopenid)<>''";
		$fields = "(SELECT nickname FROM sw_user WHERE openid=L_Fopenid) fNickName,(SELECT img FROM sw_user WHERE openid=L_Fopenid) img,L_FU,L_ID";
		$dataArr = $this->db->search($where,'L_Time DESC','50',$fields);
		return $dataArr;
	}

	/**
	 * @ ���openid�Ƿ����
	 */
	private function checkOpenid($openid){
		$num = $this->db->sumRows("openid='".$openid."'");
		if($num){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * @ ����Ƿ������͵Ĺ�ע����
	 */
	private function checkWeixinFu($openid){
		$this->db->table('fu_log');
		$num = $this->db->sumRows("L_Sopenid='".$openid."' AND L_Type=1");
		return $num;
	}
}

?>