<?php
/**
 * SW ��ҳ
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������main
 * 
 * @���ܣ�ǰ̨���ƺ������
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�main.class.php
 * 
 * @����ʱ�䣺2014-7-28 15:00:00
 * 
 * @��ҳ
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
		
		//��ȡjsAPI����
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
	 * @ ���ֻ����
	 */
	public function show(){
		$this->c->table('jiang');
		$num = $this->c->sumRows("fu=0");
		if($num>2000){ show('���ֱ����������´��ٶ�Ŷ��','http://m.96567.com'); }
		$this->tpl('isOver',G('isOver',2,2));
		$this->filename = 'fu.html';
		$this->toString();
	}

	/**
	 * @ ajaxģʽ���ķ���״̬
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
	 * @ ִ�ж��ڽ�Ʒ��ȡ
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
		$this->isOver($dataArr['openid']);//���ĵ�ǰ�˻�Ϊһ�콱״̬
		show('���ڿ�ݹ�˾�����ż٣����ǻᾡ�촦������ǰ�޷��յ��������ĵȴ������ͳһ����!','index.php?m=main&c=show&p=main&isOver=1');
	}

	/**
	 * @ ��������ʾ
	 */
	public function artist(){
		header('location:index.php?m=main&c=show&p=main');
		$this->filename = 'ysjjs.html';
		$this->toString();	
	}

	/**
	 * @ ����ҳ��
	 */
	public function jifu(){
		header('location:index.php?m=main&c=show&p=main');
		$f_openid = G('openid',2);
		$this->checkOpenJifu($f_openid);

		//����Ѿ���������������
		if($this->isSong($f_openid)){
			if($this->userArr['nickname']){//���δ��ȡ������΢����Ϣ��ִ�м�������
				$fu = $this->user->addFu($f_openid,$this->userArr['openid']);
				$this->clickAddFu(5);//��һ�ε����5��ף��
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
	 * @ ת��ҳ��
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
	 * @ ����÷����а�
	 */
	private function top($num=10){
		$this->c->table('user');
		$dataArr = $this->c->search('fu<>0',"fu DESC",$num);
		return $dataArr;
	}

	/**
	 * @ ��ҳ��
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
	 * @ ִ���콱����
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
				$this->isOver($openid);//���ĵ�ǰ�˻�Ϊһ�콱״̬
				echo 1;
			}else if($userArr['fu']<100){
				echo "���ļ��������벻Ҫ�Ƿ�����!";
			}else{
				echo "�����쳣������ϵ����Ա!";
			}
		}else{
			echo -1;
		}
	}

	/**
	 * @ ajaxģʽɹ��ת����ף��
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
	 * @ ����Ƿ�Ϊ��һ�ε㿪�����ָ����
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
	 * @ �����˻�Ϊһ�콱״̬
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
	 * @ �����˻�Ϊһ�콱״̬
	 */
	private function isOver($openid){
		$this->c->table('user');
		$this->c->update(array('isOver'=>1),"openid='".$openid."'");
	}

	/**
	 * @ ����Ƿ�Ϊ�Լ��򿪼���ҳ��
	 */
	private function checkOpenJifu($f_openid){
		if($this->userArr['openid']==$f_openid){
			//show('�Լ�����Ϊ�Լ�����Ŷ!','index.php');
			header('location:index.php?m=main&p=main');
		}
	}

	/**
	 * @ ����Ƿ�Ϊָ���û����͹�ף��
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
	 * @ ��������ף���嵥
	 */
	private function getSongFu(){
		$this->c->table('fu_log a,user b');
		$where = "a.L_Fopenid = b.openid AND a.L_Sopenid='".$this->userArr['openid']."' AND a.L_Type=0";
		$fileds = "a.L_ID,a.L_FU,a.L_Time,b.nickname,b.img";
		$dataArr = $this->c->search($where,'a.L_Time Desc','',$fileds);
		$this->tpl('topFuArr',$dataArr);
	}

	/**
	 * @ ���ɷ����ע����
	 */
	private function createFont(){
		$title = '�����͸�������һ��֪���鷨�ҡ��������漣���´��ø���������ɣ�';
		if($this->userArr['fu']){
			if($this->userArr['fu']>=100){
				$title = '������ȡǧԪ��������ī��һ���������μӣ������ú���';
				$title1 = '������ȡǧԪ��������ī��һ���������μӣ���ҲΪ����ף����';
			}else{
				$title1 = 'ת�����������Ȧ���͸����ѣ��ռ���100��ף����������ѻ��֪���鷨�Ҹ���һ�ţ��ȵ��ȵã����꼴ֹ��';
			}
		}else{
			//$title = '2015�����͸�������һ��֪���鷨�ҡ��������漣���´��ø���������ɣ�';
			$title1 = 'ת�����������Ȧ���͸����ѣ��ռ���100��ף����������ѻ��֪���鷨�Ҹ���һ�ţ��ȵ��ȵã����꼴ֹ��';
		}
		$this->tpl('weixinTitle',$title);
		$this->tpl('weixinTitle1',$title1);
	}

	/**
	 * @ ��·ģʽ���ɷ����ע����
	 */
	private function fromCreateFont(){
		$zt = G('zt',2);
		switch($zt){
			case "index":
				$title = "2015�͸����ң�����������ף���ɣ������鷨�漣���ɻ��.";
				$content = "2015�͸����ң�����������ף���ɣ������鷨�漣���ɻ��.��";
				break;
			case "my":
				$title = "���ѻ��".$this->userArr['fu']."��ף�����Ͳ����ˣ�����������ף���ɣ���ף�������鷨����ӵ�С�";
				$content = "���ѻ��".$this->userArr['fu']."��ף�����Ͳ����ˣ�����������ף���ɣ���ף�������鷨����ӵ�С�";
				break;
			case "jiang":
				$title = "���ѻ�����Ҹ��֡��������룬��Ҳ��������ӵ�У�";
				$content = "���ѻ�����Ҹ��֡��������룬��Ҳ��������ӵ�У�";
				break;
			case "artist":
				$title = "��ף�����ͼ�ֵǧԪ���ҡ��������鷨�漣��10000������ͣ�";
				$content = "��ף�����ͼ�ֵǧԪ���ҡ��������鷨�漣��10000������ͣ�";
				break;
			default :
				$title = "��ף�����ͼ�ֵǧԪ���ҡ��������鷨�漣��10000������ͣ�";
				$content = "��ף�����ͼ�ֵǧԪ���ҡ��������鷨�漣��10000������ͣ�";
				break;
		}

		$this->tpl('weixinTitle',$title);
		$this->tpl('weixinTitle1',$title1);
		$this->tpl('weixinContent',$content);
	}
}

?>