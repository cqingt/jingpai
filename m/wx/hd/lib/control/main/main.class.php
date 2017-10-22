<?php
/**
 * SW 首页
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：main
 * 
 * @功能：前台控制核心类库
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：main.class.php
 * 
 * @开发时间：2014-7-28 15:00:00
 * 
 * @首页
 * 
 */
require_once(dirname(__FILE__)."/base.class.php");
class main extends base{
	protected $sFu;
	public function __construct(){
		parent::__construct();
		$this->getSongFu();
		$this->tpl('top10',$this->top());
		$this->createFont();
		//$this->fromCreateFont();
		
		//获取jsAPI参数
		$w = new weixinAPI;
		$this->tpl('jsApiArr',$w->getJsAPI());
	}
	
	public function index(){
		header('location:index.php?m=main&c=show&p=main');
		if(!$this->userArr['newAdd']){
			$this->filename = 'index_3.html';
		}else{
			$this->tpl('c_fu',(100-$this->userArr['fu']));
			$this->filename = 'index.html';
		}
		$this->toString();
	}

	/**
	 * @ 福字活动二期
	 */
	public function show(){
		$this->c->table('jiang');
		$num = $this->c->sumRows("fu=0");
		if($num>2000){ show('福字被领完啦，下次速度哦！','http://m.96567.com'); }
		$this->tpl('isOver',G('isOver',2,2));
		$this->filename = 'fu.html';
		$this->toString();
	}

	/**
	 * @ ajax模式更改分享状态
	 */
	public function fenxiang(){
		$this->c->table('user');
		$openid = G('fx_openid',2);
		if($openid){
			$this->c->update(array('isFx'=>1),"openid='".$openid."'");
			echo 1;
		}else{
			echo 0;
		}
	}

	/**
	 * @ 执行二期奖品领取
	 */
	public function lingqu(){
		$dataArr['openid'] = G('lq_openid');
		$dataArr['name'] = G('name');
		$dataArr['mobile'] = G('mobile');
		$dataArr['address'] = G('address');
		$dataArr['nickname'] = $this->userArr['nickname'];
		$dataArr['time'] = time();
		$this->c->table('jiang');
		$this->c->insert($dataArr);
		$this->isOver($dataArr['openid']);//更改当前账户为一领奖状态
		show('由于快递公司即将放假，我们会尽快处理，如年前无法收到，请耐心等待，年后将统一发出!','index.php?m=main&c=show&p=main&isOver=1');
	}

	/**
	 * @ 艺术家显示
	 */
	public function artist(){
		header('location:index.php?m=main&c=show&p=main');
		$this->filename = 'ysjjs.html';
		$this->toString();	
	}

	/**
	 * @ 集福页面
	 */
	public function jifu(){
		header('location:index.php?m=main&c=show&p=main');
		$f_openid = G('openid',2);
		$this->checkOpenJifu($f_openid);

		//如果已经集福则跳过集福
		if($this->isSong($f_openid)){
			if($this->userArr['nickname']){//如果未获取访问者微信信息则不执行集福操作
				$fu = $this->user->addFu($f_openid,$this->userArr['openid']);
				$this->clickAddFu(5);//第一次点击送5个祝福
			}
		}else{
			$fu = $this->sFu;
			$this->tpl('isSong',1);
		}
		$this->tpl('f_UserArr',$this->user->getUserArr($f_openid));
		$this->tpl('songArr',$this->user->getSongList($f_openid));
		$this->tpl('fu',$fu);
		$this->filename = 'index_2.html';
		$this->toString();
	}

	/**
	 * @ 转发页面
	 */
	public function zhuanfa(){
		header('location:index.php?m=main&c=show&p=main');
		$f_openid = G('openid',2);
		if($f_openid != $this->userArr['openid']){
			header("location:index.php?m=main&c=jifu&p=main&openid=$f_openid");
		}
		$this->filename = 'zhuanfa.html';
		$this->toString();
	}

	/**
	 * @ 计算得分排行榜
	 */
	private function top($num=10){
		$this->c->table('user');
		$dataArr = $this->c->search('fu<>0',"fu DESC",$num);
		return $dataArr;
	}

	/**
	 * @ 获奖页面
	 */
	public function complete(){
		header('location:index.php?m=main&c=show&p=main');
		if($this->userArr['fu']<100){
			header('location:index.php?m=main&c=jifu&p=main');
			exit;
		}
		$this->filename = 'index_5.html';
		$this->toString();
	}

	/**
	 * @ 执行领奖操作
	 */
	public function receive(){
		$openid = G('lopenid');
		$mobile = G('mobile');
		if($this->isCheckJiang($mobile)){	
			$userArr = $this->user->getUserArr($openid);
			if($userArr['fu']>=100){
				$dataArr['openid'] = $openid;
				$dataArr['mobile'] = $mobile;
				$dataArr['nickname'] = $userArr['nickname'];
				$dataArr['fu'] = $userArr['fu'];
				$dataArr['time'] = time();
				$this->c->table('jiang');
				$this->c->insert($dataArr);
				$this->isOver($openid);//更改当前账户为一领奖状态
				echo 1;
			}else if($userArr['fu']<100){
				echo "您的集福不够请不要非法操作!";
			}else{
				echo "操作异常，请联系管理员!";
			}
		}else{
			echo -1;
		}
	}

	/**
	 * @ ajax模式晒奖转发送祝福
	 */
	public function ajaxAddFu(){
		$openid = G('openid',2);
		$this->c->table('fu_log');
		$num = $this->c->sumRows("L_Sopenid='".$openid."' AN L_Type=2");
		if(!$num){
			$this->user->addNumFu($openid,200,2);
		}

		echo $num;
	}

	/**
	 * @ 检测是否为第一次点开活动并送指定福
	 */
	private function clickAddFu($fu){
		$num = $this->c->sumRows("L_Sopenid='".$this->userArr['openid']."' AND L_Type=3");
		if(!$num){
			$this->user->addNumFu($this->userArr['openid'],$fu,3);
			$this->tpl('clickFu',$fu);
			$chaFu = $this->userArr['fu']+$fu-100;
			if($chaFu>0){
				$this->tpl('chaFu','zhong');
			}else{
				$this->tpl('chaFu',$chaFu);
			}
		}
	}

	public function test(){
		$this->filename = 'ttp.html';
		$this->toString();
	}

	/**
	 * @ 更改账户为一领奖状态
	 */
	public function isCheckJiang($mobile){
		$this->c->table('jiang');
		$num = $this->c->sumRows("openid='".$this->userArr['openid']."'");
		if($num){
			return false;
		}else{
			return true;
		}
	}


	/**
	 * @ 更改账户为一领奖状态
	 */
	private function isOver($openid){
		$this->c->table('user');
		$this->c->update(array('isOver'=>1),"openid='".$openid."'");
	}

	/**
	 * @ 检测是否为自己打开集福页面
	 */
	private function checkOpenJifu($f_openid){
		if($this->userArr['openid']==$f_openid){
			//show('自己不能为自己集福哦!','index.php');
			header('location:index.php?m=main&p=main');
		}
	}

	/**
	 * @ 检测是否为指定用户赠送过祝福
	 */
	private function isSong($f_openid){
		$this->c->table('fu_log');
		$dataArr = $this->c->search("L_Sopenid='".$f_openid."' AND L_Fopenid='".$this->userArr['openid']."'");
		if(!empty($dataArr)){
			$this->sFu = $dataArr[0]['L_FU'];
			return false;
		}else{
			return true;
		}
	}

	/**
	 * @ 加载所有祝福清单
	 */
	private function getSongFu(){
		$this->c->table('fu_log a,user b');
		$where = "a.L_Fopenid = b.openid AND a.L_Sopenid='".$this->userArr['openid']."' AND a.L_Type=0";
		$fileds = "a.L_ID,a.L_FU,a.L_Time,b.nickname,b.img";
		$dataArr = $this->c->search($where,'a.L_Time Desc','',$fileds);
		$this->tpl('topFuArr',$dataArr);
	}

	/**
	 * @ 生成分享关注文字
	 */
	private function createFont(){
		$title = '新年送福，送你一张知名书法家“福”字真迹，新春得福，快来领吧！';
		if($this->userArr['fu']){
			if($this->userArr['fu']>=100){
				$title = '我已领取千元“福”字墨宝一幅！快来参加，轻松拿豪礼！';
				$title1 = '我已领取千元“福”字墨宝一幅！快来参加，我也为你送祝福！';
			}else{
				$title1 = '转发本活动到朋友圈或发送给朋友，收集到100份祝福，即可免费获得知名书法家福字一张，先到先得，送完即止。';
			}
		}else{
			//$title = '2015新年送福，送你一张知名书法家“福”字真迹，新春得福，快来领吧！';
			$title1 = '转发本活动到朋友圈或发送给朋友，收集到100份祝福，即可免费获得知名书法家福字一张，先到先得，送完即止。';
		}
		$this->tpl('weixinTitle',$title);
		$this->tpl('weixinTitle1',$title1);
	}

	/**
	 * @ 来路模式生成分享关注文字
	 */
	private function fromCreateFont(){
		$zt = G('zt',2);
		switch($zt){
			case "index":
				$title = "2015送福到家，快来给我送祝福吧！名家书法真迹轻松获得.";
				$content = "2015送福到家，快来给我送祝福吧！名家书法真迹轻松获得.。";
				break;
			case "my":
				$title = "我已获得".$this->userArr['fu']."个祝福，就差你了，快来给我送祝福吧！集祝福名家书法轻松拥有。";
				$content = "我已获得".$this->userArr['fu']."个祝福，就差你了，快来给我送祝福吧！集祝福名家书法轻松拥有。";
				break;
			case "jiang":
				$title = "我已获得名家福字。快来参与，你也可以轻松拥有！";
				$content = "我已获得名家福字。快来参与，你也可以轻松拥有！";
				break;
			case "artist":
				$title = "集祝福，送价值千元名家《福》字书法真迹！10000幅免费送！";
				$content = "集祝福，送价值千元名家《福》字书法真迹！10000幅免费送！";
				break;
			default :
				$title = "集祝福，送价值千元名家《福》字书法真迹！10000幅免费送！";
				$content = "集祝福，送价值千元名家《福》字书法真迹！10000幅免费送！";
				break;
		}

		$this->tpl('weixinTitle',$title);
		$this->tpl('weixinTitle1',$title1);
		$this->tpl('weixinContent',$content);
	}
}

?>