<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：showMain
 * 
 * @功能：加载首页展示数据
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：showMain.class.php
 * 
 * @开发时间：2014-3-3 14:28:17
 * 
 * @首页数据展示类
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
	 * @ 默认主控类方法
	 */
	public function index(){
		$this->getReserveCustomer();
		$this->tpl('noticeArr',$this->getContent(2,10));//加载公告
		$this->tpl('expArr',$this->getContent(1,5));//加载心得

		//加载统计数据
		$this->getStatisticsInfo();
	}

	/**
	 * @ 加载预约客户信息
	 */
	private function getReserveCustomer(){
		include('lib/control/manage/public/clientele.class.php');//加载客户类
		$k = new clientele($this->c);
		$k->uid = $this->UID;
		$this->tpl('customerArr',$k->getReserve(time()));
	}

	/**
	 * @ 加载公告信息与心得信息 $type:1心得 2公告
	 * @ @num 读取数量
	 */
	private function getContent($type,$num){
		$this->c->table('content');
		$dataArr = $this->c->search("C_type='".$type."' AND ".$this->where,'C_time DESC',$num,'C_id,C_title,C_time,C_level');
		return $dataArr;
	}

	/**
	 * @ 加载首页统计信息
	 */
	private function getStatisticsInfo(){
		$level = $this->getUserLevel();
		$s = new statistics;

		$monthMoneyTopArr = $s->clerkMoneyTop('S_UserID');//获取个人月回款排行榜
		$yearMoneyTopArr = $s->clerkMoneyTop('S_UserID',time());//获取个人年度回款排行榜
		$todayTopArr = $s->getTop(13,time());//获取个人当日业绩排行

		//获取个人天，月，年业绩总计
		$todayMoneyArr = $s->getTop(9,time());//获取个人今日业绩
		$monthMoneyArr = $s->getTop(9);//获取个人本月业绩
		$yearMoneyArr = $s->getTop(10,time());//获取个人全年业绩
		
		//获取团队天，月，年业绩总计
		switch(intval($level)){
			case 0:
			case 1:
			case 2:
			case 3:
				$todayTeamMoneyArr = $s->getTop(1,time());//获取团队当日业绩
				$monthTeamMoneyArr = $s->getTop(1);//获取团队当月业绩
				$yearTeamMoneyArr = $s->getTop(11,time());//获取团队全年业绩
				break;
			case 4:
			case 5:
				$todayTeamMoneyArr = $s->getTop(3,time());//获取小组当日业绩
				$monthTeamMoneyArr = $s->getTop(3);//获取小组当月业绩
				$yearTeamMoneyArr = $s->getTop(12,time());//获取小组全年业绩
				break;
		}

		$teamYearMoneyArr = $s->getTop(14,time());//获取小组全年业绩排行榜

		$this->tpl('clerkMoneyArr',array($todayMoneyArr,$monthMoneyArr,$yearMoneyArr));
		$this->tpl('teamMoneyArr',array($todayTeamMoneyArr,$monthTeamMoneyArr,$yearTeamMoneyArr));
		$this->tpl('clerkArr',$todayTopArr);
		$this->tpl('clerkMonthMoneyArr',$monthMoneyTopArr);
		$this->tpl('clerkYearMoneyArr',$yearMoneyTopArr);
		$this->tpl('teamYearMoneyArr',$teamYearMoneyArr);
		
		//获取部门信息
		$company = new company(W_NUMBER);
		$this->tpl('depArr',$company->getDepArr());
	}

	/**
	 * @ 获取账户身份级别
	 */
	private function getUserLevel(){
		$user = new user($this->UID);
		$levelArr = $user->getUserLevel();
		return $levelArr['P_Level'];
	}

	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}
}
?>