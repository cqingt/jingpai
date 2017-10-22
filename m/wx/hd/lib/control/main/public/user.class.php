<?php
/**
 * SW session控制类
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：user
 * 
 * @功能：user用户信息类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：user.class.php
 * 
 * @开发时间：2014-8-13 15:44:00
 * 
 * @user类
 * 
 */
class user{
	private $db;//数据库链接句柄
	private $weixin;//微信处理类属性
	public function __construct($conn){	
		$this->weixin = new weixinAPI;
		$this->db = $conn;
		$this->db->table('user');
	}

	/**
	 * @ 获取用户openid
	 */
	public function getOpenid(){
		$code = G('code',2);
		$a = G('state',2);
		
		if($a != 'sw'){//如果为授权获取用户信息则跳过如下操作
			if(!$_COOKIE['openid'] && $code){
				$openid = $this->weixin->getOpenID($code);//获取OpenID
				setCookie('openid',$openid,time()+2592000,"/","96567.com");
			}else if(!$_COOKIE['openid'] && !$code){
				$this->weixin->sendOpenID();
			}
		}
	}


	/**
	 * @ 通过openid获取用户信息
	 */
	public function getWeixinInfo($openid){
		
		if(!$openid){
			echo "<script>window.location.reload();</script>";
			exit;	
		}
		
		$a = G('state',2);
		if($a != 'sw'){
			$userArr = $this->weixin->getWeixinUserInfo($openid);
			//如果当前账户未关注微信公众号，则执行授权获取账户信息
			if($userArr['guanzhu']!='1' && !$this->checkOpenid($openid)){
				$this->weixin->sq();
			}

		}else if($a == 'sw'){//获取确认授权后的用户信息
			$userArr = $this->weixin->getOauthUserInfo(G('code',2));
		}
		//执行微信数据记录
		return $this->addUserInfo($userArr,$openid);
	}

	/**
	 * @ 通过openid获取用户信息
	 */
	public function getUserArr($openid){
		$this->db->table('user');
		$dataArr = $this->db->search("openid='".$openid."'");
		$dataArr[0]['totalRen'] = $this->getTotalFu($openid);
		return $dataArr[0];
	}

	/**
	 * @ 通过openid获取当前用户祝福总数
	 */
	public function getTotalFu($openid){
		$this->db->table('fu_log');
		$num = $this->db->sumRows("L_Sopenid='".$openid."' AND L_Type=0");
		return $num;
	}

	/**
	 * @ 将获取的用户信息记录到数据库
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

			//记录操作记录
			if($arr['guanzhu']){
				logcat::write($this->db,$openid,0,$arr['fu'],1);
			}
		}
		return $arr;
	}

	/**
	 * @ 判断是否关注状态有改变
	 */
	private function subStatusUpdate($arr,$arr1,$openid){
		if($arr['guanzhu']!=$arr1['guanzhu']){
			//判断你是否有关注给福记录
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
	 * @ 集福数增加
	 */
	public function addFu($sopenid,$fopenid){
		$fu = $this->getFuNum($sopenid);
		$this->db->execute("UPDATE sw_user SET fu=fu+'".$fu."' WHERE openid='".$sopenid."'");
		logcat::write($this->db,$sopenid,$fopenid,$fu);
		return $fu;
	}

	/**
	 * @增加指定祝福数量
	 */
	public function addNumFu($openid,$fu,$type=0){
		$this->db->table('user');
		$this->db->execute("UPDATE sw_user SET fu=fu+'".$fu."' WHERE openid='".$openid."'");
		logcat::write($this->db,$openid,0,$fu,$type);
		return $fu;
	}

	/**
	 * @ 计算指定openid的排名未知
	 */
	public function rank($openid){
		$this->db->table('user');
		$where = "fu>=(SELECT fu FROM sw_user WHERE openid='".$openid."')";
		$num = $this->db->sumRows($where);
		return $num;
	}

	/**
	 * @ 获得集福个数
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
	 * @ 获取祝福人员清单
	 */
	public function getSongList($openid){
		$this->db->table('fu_log');
		$where = "L_Sopenid='".$openid."' AND L_Type=0 AND (SELECT nickname FROM sw_user WHERE openid=L_Fopenid)<>''";
		$fields = "(SELECT nickname FROM sw_user WHERE openid=L_Fopenid) fNickName,(SELECT img FROM sw_user WHERE openid=L_Fopenid) img,L_FU,L_ID";
		$dataArr = $this->db->search($where,'L_Time DESC','50',$fields);
		return $dataArr;
	}

	/**
	 * @ 检测openid是否存在
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
	 * @ 检测是否已赠送的关注集福
	 */
	private function checkWeixinFu($openid){
		$this->db->table('fu_log');
		$num = $this->db->sumRows("L_Sopenid='".$openid."' AND L_Type=1");
		return $num;
	}
}

?>