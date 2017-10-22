<?php
/**
 * SW CRM����ϵͳV2.0�汾
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������showMain
 * 
 * @���ܣ�������ҳչʾ����
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�showMain.class.php
 * 
 * @����ʱ�䣺2014-3-3 14:28:17
 * 
 * @��ҳ����չʾ��
 * 
 */
if(file_exists('config/business_config/'.W_NUMBER.'.inc.php')){
	include('config/business_config/'.W_NUMBER.'.inc.php');
}
require_once(dirname(__FILE__)."/../manage/manage.class.php");
require_once(dirname(__FILE__)."/../manage/public/statistics.class.php");
require_once(dirname(__FILE__)."/../manage/public/user.class.php");
require_once(dirname(__FILE__)."/../manage/public/company.class.php");
class showMain extends manage{

	public function __construct(){
		parent::__construct();
		$this->filename = 'main.html';
	}

	/**
	 * @ Ĭ�������෽��
	 */
	public function index(){
		$this->getReserveCustomer();
		$this->tpl('noticeArr',$this->getContent(2,10));//���ع���
		$this->tpl('expArr',$this->getContent(1,5));//�����ĵ�

		//����ͳ������
		$this->getStatisticsInfo();
	}

	/**
	 * @ ����ԤԼ�ͻ���Ϣ
	 */
	private function getReserveCustomer(){
		include('lib/control/manage/public/clientele.class.php');//���ؿͻ���
		$k = new clientele($this->c);
		$k->uid = $this->UID;
		$this->tpl('customerArr',$k->getReserve(time()));
	}

	/**
	 * @ ���ع�����Ϣ���ĵ���Ϣ $type:1�ĵ� 2����
	 * @ @num ��ȡ����
	 */
	private function getContent($type,$num){
		$this->c->table('content');
		$dataArr = $this->c->search("C_type='".$type."' AND ".$this->where,'C_time DESC',$num,'C_id,C_title,C_time,C_level');
		return $dataArr;
	}

	/**
	 * @ ������ҳͳ����Ϣ
	 */
	private function getStatisticsInfo(){
		$level = $this->getUserLevel();
		$s = new statistics;

		$monthMoneyTopArr = $s->clerkMoneyTop('S_UserID');//��ȡ�����»ؿ����а�
		$yearMoneyTopArr = $s->clerkMoneyTop('S_UserID',time());//��ȡ������Ȼؿ����а�
		$todayTopArr = $s->getTop(13,time());//��ȡ���˵���ҵ������

		//��ȡ�����죬�£���ҵ���ܼ�
		$todayMoneyArr = $s->getTop(9,time());//��ȡ���˽���ҵ��
		$monthMoneyArr = $s->getTop(9);//��ȡ���˱���ҵ��
		$yearMoneyArr = $s->getTop(10,time());//��ȡ����ȫ��ҵ��
		
		//��ȡ�Ŷ��죬�£���ҵ���ܼ�
		switch(intval($level)){
			case 0:
			case 1:
			case 2:
			case 3:
				$todayTeamMoneyArr = $s->getTop(1,time());//��ȡ�Ŷӵ���ҵ��
				$monthTeamMoneyArr = $s->getTop(1);//��ȡ�Ŷӵ���ҵ��
				$yearTeamMoneyArr = $s->getTop(11,time());//��ȡ�Ŷ�ȫ��ҵ��
				break;
			case 4:
			case 5:
				$todayTeamMoneyArr = $s->getTop(3,time());//��ȡС�鵱��ҵ��
				$monthTeamMoneyArr = $s->getTop(3);//��ȡС�鵱��ҵ��
				$yearTeamMoneyArr = $s->getTop(12,time());//��ȡС��ȫ��ҵ��
				break;
		}

		$teamYearMoneyArr = $s->getTop(14,time());//��ȡС��ȫ��ҵ�����а�

		$this->tpl('clerkMoneyArr',array($todayMoneyArr,$monthMoneyArr,$yearMoneyArr));
		$this->tpl('teamMoneyArr',array($todayTeamMoneyArr,$monthTeamMoneyArr,$yearTeamMoneyArr));
		$this->tpl('clerkArr',$todayTopArr);
		$this->tpl('clerkMonthMoneyArr',$monthMoneyTopArr);
		$this->tpl('clerkYearMoneyArr',$yearMoneyTopArr);
		$this->tpl('teamYearMoneyArr',$teamYearMoneyArr);
		
		//��ȡ������Ϣ
		$company = new company(W_NUMBER);
		$this->tpl('depArr',$company->getDepArr());
	}

	/**
	 * @ ��ȡ�˻���ݼ���
	 */
	private function getUserLevel(){
		$user = new user($this->UID);
		$levelArr = $user->getUserLevel();
		return $levelArr['P_Level'];
	}

	/**
	 * @ ����ϵͳ��������
	 */
	public function __destruct(){
		$this->toString();
	}
}
?>