<?php
/*
	@商户管理后台核心类库
	@2013年7月6日开发
	@开发人:精灵
	@联系QQ:9132761
*/
require_once(dirname(__FILE__)."/public/writeLog.class.php");
class manage extends model{
	protected $UID;//用户ID
	protected $Umax;//客户最大上限数
	protected $Level;//登陆权限级别属性
	protected $Number;//商户号
	protected $where;//主查询条件
	protected $NavList;//菜单数据
	protected $isAdmin;//管理员判断字段 1为管理员，0为普通账户
	protected $pMax = 10;//每页最大显示数据数量
	protected $Prefix;//表前缀
	protected $startTime;//开始时间
	protected $endTime;//结束时间

	public function __construct(){
		parent::__construct();
		$m = G('m',2) ? G('m',2) : 'login';
		session_start();
		if( G('p',2)=='action' && $m=='manageTask' ){
			//判断是否执行计划任务
		}else if($m!='login'){//session权限验证控制
			$this->setSession();//加载Session验证
			$this->checkLevel();//检测级别权限
		}
		$this->where="Number=".W_NUMBER;
		$this->setTime();//加载报表生成时间
		$this->getConfigSet();
	}

	/*
		@session验证方法
	*/
	private function setSession(){
		if(!$_SESSION['U_UserName'] && !$_SESSION['U_Level'] && !$_SESSION['U_Number']){
			echo '<script>top.location.href="index.php?m=login&p=manage"</script>';
			exit;
		}else{
			$this->UID = intval($_SESSION['U_ID']);
			$this->Level = $_SESSION['U_Level'];//加载登陆用户权限级别
			$this->Number = $_SESSION['U_Number'];//载入商户号
			$this->isAdmin = intval($_SESSION['U_isAdmin']);//加载管理员判定字段
			$this->Umax = intval($_SESSION['U_Max']);//加载记录客户最大上限数
			$this->getUserMenu($this->UID);
		}
	}

	/*
		@加载用户菜单列表
	*/
	private function getUserMenu($uid){
		if($this->Level!='1'){
			$this->c->table('adminuser');
			$dataArr = $this->c->search("U_ID='".$uid."'",'','','U_NavList');
			$this->NavList = $dataArr[0]['U_NavList'];
		}elseif(!$this->isAdmin && $this->Level==1){
			$this->c->table('system_menu');
			$dataArr = $this->c->search("W_Number='".$this->Number."'",'','','W_Menu');
			$this->NavList = $dataArr[0]['W_Menu'];
			if(!$this->NavList){
				$this->NavList = json_encode($this->getMenuArrZ());
			}
		}else{
			$this->NavList = 1;
		}
	}

	/*
		@获取菜单列表并整理
	*/
	private function getMenuArrZ(){
		$this->c->table('managecate');
		$dataArr = $this->c->search('C_Type!=1','','','C_ID,C_Link');
		foreach($dataArr as $v){
			$tempArr[$v['C_ID']] = $v['C_Link'];
		}
		return $tempArr;
	}

	/*
		@检测栏目访问权限
	*/
	private function checkLevel(){
		//整理URL地址链接
		$urlArr=explode('&',$_SERVER["QUERY_STRING"]);
		$url=trim($urlArr[0]);
		if( !strpos($this->NavList,$url) && !strpos($_SERVER["QUERY_STRING"],'p=action') && $this->isAdmin!=1 && !strpos($url,'manageIndex')){
			echo '您无权使用当前功能!';
			exit;
		}
	}
	
	/*
		@加载初始化数据配置
	*/
	protected function getConfigSet(){
		$this->tpl('Domain',W_DOMAIN);//加载分公司域名
		$this->tpl('DIR',DIR_MANAGE);//加载分公司管理路径
		$this->tpl('COMPANY',W_COMPANY);//加载分公司名称
		$this->tpl('W_NUMBER',W_NUMBER);//加载分公司ID
		$this->tpl('W_ORDERMODE',W_ORDERMODE);//加载分公司ID
		$this->tpl('W_VERMODE',W_VERMODE);//加载下单模式
		$this->tpl('LOGO',W_LOGO);//加载验证模式
		$this->tpl('YEAR',date('Y'));
		$this->tpl('FolderName',$this->FolderName);//加载分公司图片目录
		$this->tpl('UID',$this->UID);//传入身份ID
		$this->tpl('level',$this->Level);//传入级别ID
		$this->tpl('public_status',S_PUBLIC);//传入级别ID
	}

	/**
	 * @ 获取每页显示数量页码
	 */	
	protected function getPageMax(){
		$pMax = G('pageMax',2,2);
		$this->pMax = $pMax ? $pMax : 10;
	}

	/**
	 * @ 数据库链接切换
	 */
	protected function dbConnect(){
		if(W_ORDERMODE){
			$this->c = new mysqlAction(config::$dbShopArr);//实例化数据库对象
			$this->Prefix = config::$dbShopArr['Prefix'];
		}else{
			$this->Prefix = config::$dbArr['Prefix'];
		}
	}

	/**
	 * @ 结算时间点设置
	 */
	protected function setTime(){
		$time = G('time') ? strtotime(G('time')) : time();
		$year = date('Y',$time);
		$month = date('m',$time);
		$day = date('j',$time);
		//$shijian = $year.'-'.($month+1);

		if(S_TIME=='No'){
			$endDay = Date('t',$time);
			$this->startTime = strtotime($year.'-'.$month.'-1');
			$this->endTime = strtotime($year.'-'.$month.'-'.$endDay);
		}else{
			$arr = explode('|',S_TIME);

			//设置起始时间
			if($arr[0]){
				if($day<$arr[1]){//如果开始天数小于结束天数这月份减1到上月
					$startMonth = $month-1;
				}else{
					$startMonth = $month;
				}
				$this->startTime = $year.'-'.($startMonth).'-'.$arr[1];
			}else{
				$this->startTime = $year.'-'.$startMonth.'-'.$arr[1];
			}
			
			//设置结束时间
			if($arr[2]){
				$this->endTime = $year.'-'.($month-1).'-'.$arr[1];
			}else{
				if($day>$arr[3]){//如果当天时间大于结束时间则当前月份加1为下月结束时间
					$endMonth = $month+1;	
				}else{
					$endMonth = $month;
				}
				$this->endTime = $year.'-'.$endMonth.'-'.$arr[3];
			}
			$this->startTime = strtotime($this->startTime.' 00:00:00');
			$this->endTime = strtotime($this->endTime.' 23:59:59');
		}
	}

	/*
		@错误信息输出
	*/
	private function error($message){
		echo $message;
		exit;
	}
}

?>