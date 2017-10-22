<?php
set_time_limit(0);
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：manageSMS
 * 
 * @功能：短信营销系统主控类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：manageSMS.class.php
 * 
 * @开发时间：2014-04-17 16:28:17
 * 
 * @短信营销管理类
 * 
 */
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/public/mobile.class.php");
require_once(dirname(__FILE__)."/../action/customer.class.php");
require_once(dirname(__FILE__)."/public/user.class.php");
require_once(dirname(__FILE__)."/public/writeLog.class.php");
require_once(dirname(__FILE__)."/public/sms.class.php");
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
class manageSMS extends manage{
	public static $smsStatusArr = Array('未发送','已发送','部分发送','已存档');
	private $smsDataPath = 'static/smsData/';//短信发送手机数据存储路径
	private $sms;//短信操作对象

	public function __construct(){
		parent::__construct();
		$this->sms = new sms;
		$this->tpl('smsStatusArr',manageSMS::$smsStatusArr);
		$this->filename = 'sms.html';
	}
	
	/**
	 * @ 默认主控类方法
	 */
	public function index(){
		$this->tpl('cateArr',$this->getCustomerCategoryArr());
		$this->customerWhere();
	}

	/**
	 * @ 客户筛选搜索操作
	 */
	private function customerWhere(){
		$a = G('a',2);
		if($a == 'search'){
			$w[] = $this->where;
			//执行客户订单表条件组合生成
			//省级
			$this->dbConnect();
			$province = G('province',2,2);
			if($province){
				$shopW[] = "a.province='".$province."'";
				$u[] = 'province='.$province; 
				$this->tpl('province',$province);
			}
			//城市
			$city = G('city',2,2);
			if($city){
				$shopW[] = "a.city='".$city."'";
				$u[] = 'city='.$city; 
				$this->tpl('city',$city);
			}
			//地区
			$district = G('district',2,2);
			if($district){
				$shopW[] = "a.district='".$district."'";
				$u[] = 'district='.$district; 
				$this->tpl('district',$district);
			}

			//成交金额
			$leastMoney = G('leastMoney',2);
			$maxMoney = G('maxMoney',2);
			if($leastMoney && !$maxMoney){
				$groupWhere = "HAVING totalMoney>='".$leastMoney."'";
				$u[] = 'leastMoney'.$leastMoney;
				$this->tpl('leastMoney',$leastMoney);
			}else if($maxMoney && !$leastMoney){
				$groupWhere = "HAVING totalMoney<='".$maxMoney."'";
				$u[] = 'maxMoney='.$maxMoney;
				$this->tpl('maxMoney',$maxMoney);
			}else if($maxMoney && $leastMoney){
				$groupWhere = "HAVING totalMoney BETWEEN '".$leastMoney."' AND '".$maxMoney."'";
				$u[] = 'leastMoney='.$leastMoney;
				$u[] = 'maxMoney='.$maxMoney;
				$this->tpl('maxMoney',$maxMoney);
				$this->tpl('leastMoney',$leastMoney);
			}
			//排除产品
			$noPro = G('noPro',2);
			if($noPro){
				$noPro = str_replace(",","','",$noPro);

				//获取排除含有指定产品的会员ID
				$this->c->table('order_info a,order_goods b');
				$noUserID = $this->c->search("a.order_id=b.order_id AND goods_sn IN('".$noPro."') GROUP BY a.user_id",'','','a.user_id');
				foreach($noUserID as $v){
					$tempUserArr[] = $v['user_id'];
				}
				$noID = join(',',$tempUserArr);//组合排除会员ID为字符串

				$shopW[] = 'NOT a.user_id IN('.$noID.')';
				$u[] = 'noPro='.$noPro;
				$this->tpl('noPro',$noPro);
			}

			//执行商城会员ID获取
			if(count($shopW) || $groupWhere){
				$shopW[] = 'a.shipping_status>0 AND a.order_status=1';
				//$shopW[] = '(SELECT Number FROM '.$this->Prefix.'yw_info WHERE orderid=a.order_id)='.W_NUMBER;
				$shopWhere = join(" AND ",$shopW);
				$this->c->table('order_info a');
				$fields = "a.user_id,SUM((a.goods_amount - a.discount - a.integral_money - a.bonus)) as totalMoney";
				$dataArr = $this->c->search($shopWhere.' GROUP BY a.user_id '.$groupWhere,'','',$fields);
				if(count($dataArr)){
					foreach($dataArr as $v){ $tempArr[] = $v['user_id']; }
					$w[] = "B_WebUserID IN('".join("','",$tempArr)."')";
				}
			}

			//执行客户主题表条件组合
			$type = G('B_Type',2);//客户类型
			if($type){
				if($type=='B_Status'){
					$w[] = "B_Status>0";
				}else{
					$w[] = "B_Status = 0";
					$w[] = "B_Type='".$type."'";
				}
				$u[] = 'B_Type='.$type;
				$this->tpl('B_Type',$type);
			}
			
			$clerk = G('Clerk',2,2);
			if($clerk){//按业务员
				$w[] = "B_UserID='".$clerk."'";
				$u[] = 'clerk='.$clerk;
				$this->tpl('clerk',$clerk);
			}else{
				//按部门
				$bumen = G('bumen',2,2);
				if($bumen){
					$w[] = "B_UserID IN(SELECT U_ID FROM sw_user_info WHERE U_DepID='".$bumen."')";
					$u[] = 'bumen='.$bumen;
				}
				//按小组
				$team = G('team',2,2);
				if($team){
					$w[] = "B_UserID IN(SELECT U_ID FROM sw_user_info WHERE U_DepID='".$bumen."' AND U_Team='".$team."')";
					$u[] = 'team='.$team;
				}
			}

			//按录入时间
			$startTime = G('startTime',2);
			$endTime = G('endTime',2);
			if($startTime && !$endTime){
				$w[] = "B_Time>'".strtotime($startTime.' 00:00:00')."'";
				$u[] = 'startTime='.$startTime;
				$this->tpl('startTime',$startTime);
			}else if(!$startTime && $endTime){
				$w[] = "B_Time<'".strtotime($endTime.' 23:59:59')."'";
				$u[] = 'endTime='.$endTime;
				$this->tpl('endTime',$endTime);
			}else if($startTime && $endTime){
				$w[] = "B_Time BETWEEN '".strtotime($startTime.' 00:00:00')."' AND '".strtotime($endTime.' 23:59:59')."'";
				$u[] = 'startTime='.$startTime.'&endTime='.$endTime;
				$this->tpl('startTime',$startTime);
				$this->tpl('endTime',$endTime);
			}

			if(count($w)){
				$this->c = new mysqlAction(config::$dbArr);
				$where = join(' AND ',$w);
				if(count($u)){
				$url = '&'.join('&',$u);
				}
				$url = 'index.php?m=manageSMS&p=manage&a=search'.$url;
				$fields = 'B_ID,B_Name,B_Type,B_Status,B_Time,B_WebUserID,(SELECT U_Name FROM sw_user_info WHERE U_ID=B_UserID) as ClerkName';
				$page = new PageTurn($this->c,G('page',2,2),'customer',$url,50,'',$where,$fields);
				$this->tpl('dataArr',$page->dataArr);
				$this->tpl('pageStr',$page->pageStr());
				$this->tpl('numCustomer',$this->c->sumRows($where));

				$this->tpl('wid',$this->writeDataWhere($where));//记录筛选条件到数据库
			}
		}
		
			$this->tpl('team',intval($team));
			$this->tpl('bumen',intval($bumen));
	}

	/**
	 * @ 将记录写入发送队列
	 */
	public function exportSMS(){
		$wid = G('wid',1,2);
		$where = $this->getDataWhere($wid);
		$this->c->table('customer_mobile');
		$dataArr = $this->c->search("C_BID IN(SELECT B_ID FROM sw_customer WHERE ".$where.") AND ".$this->where,'','','C_Mobile');

		//将数据添加到短信发送队列


		$arr['Number'] = W_NUMBER;
		$arr['L_ActionUser'] = $_SESSION['U_UserName'];
		$arr['L_Num'] = count($dataArr);
		$arr['L_DataFile'] = $this->createDataFile($dataArr);
		$arr['L_Time'] = time();
		$this->c->table('sms_list');
		$this->c->insert($arr);
		$lid = $this->c->insertID();
		header('location:index.php?m=manageSMS&c=editSMScontent&p=manage&lid='.$lid);//转向到短信内容编辑
	}

	/**
	 * @ 短信发布内容编辑
	 */
	public function editSMScontent(){
		$lid = G('lid',2,2);
		$dataArr = $this->getSMSlistContent($lid);
		$this->tpl('dataArr',$dataArr);
		$this->tpl('smsInfoArr',$this->sms->getSMSinfo());
		$this->tpl('lid',$lid);
		$this->filename = 'sms_content.html';
	}

	/**
	 * @ 存档短信内容
	 */
	public function saveSMScontent($status=0){
		$lid = G('lid',1,2);
		$dataArr['L_setTime'] = G('L_setTime');
		$dataArr['L_Content'] = G('L_Content');
		$dataArr['L_Remark'] = G('L_Remark');
		$dataArr['L_Status'] = 3;
		if($dataArr['L_Content']){
			$this->c->table('sms_list');
			$this->c->update($dataArr,"L_ID='".$lid."' AND ".$this->where);
			if(!$status){ show('存档成功!'); }
		}
	}

	/**
	 * @ 执行短信发送
	 */
	public function sendSMS(){
		$lid = G('lid',1,2);
		$this->saveSMScontent(1);
		$mobileArr = $this->getMobileData($lid);
		$dataArr = $this->getSMSlistContent($lid,'L_Content,L_setTime');//加载发送内容
		
		foreach($mobileArr as $v){//执行发送开始
			$this->sms->send($v,$dataArr['L_Content'],$dataArr['L_setTime']);
		}
		$this->updateSMSstatus(1,$lid);//更新发送状态

		show('发送成功');
	}

	/**
	 * @ 加载发送队列
	 */
	public function smsList(){
		$type = G('type',2,2);
		$where = $this->where." AND L_Status='".$type."'";
		$page = new PageTurn($this->c,G('page',2,2),'sms_list',$url,20,'L_Time DESC',$where);
		$this->tpl('dataArr',$page->dataArr);
		$this->tpl('pageStr',$page->pageStr());	
		$this->tpl('type',$type);

		$this->filename = 'sms_list.html';
	}

	/**
	 * @ 更新队列状态
	 */
	private function updateSMSstatus($val,$lid){
		$this->c = new mysqlAction(config::$dbArr,'sms_list');//实例化数据库对象
		$this->c->update(array('L_Status'=>$val),"L_ID='".$lid."' AND ".$this->where);
	}

	/**
	 * @ 获取发送队列指定ID详细内容
	 */
	private function getSMSlistContent($lid,$fields='*'){
		$this->c->table('sms_list');
		$dataArr = $this->c->search("L_ID='".$lid."' AND ".$this->where,'','',$fields);
		return $dataArr[0];
	}


	/**
	 * @ 记录筛选条件
	 */
	private function writeDataWhere($where){
		if($where){
			$dataArr['W_Where'] = addslashes($where);
			$dataArr['Number'] = W_NUMBER;
			$this->c->table('sms_where');
			$this->c->insert($dataArr);
			return $this->c->insertID();
		}else{
			return 0;
		}
	}
	/**
	 * @ 获取筛选条件
	 */
	private function getDataWhere($wid){
		if($wid){
			$this->c->table('sms_where');
			$dataArr = $this->c->search("W_ID='".$wid."' AND ".$this->where);
			return $dataArr[0]['W_Where'];
		}else{
			show('参数异常，请从新操作后在导入数据到队列!','index.php?m=manageSMS&p=manage');
			exit;
		}
	}
	
	/*
		@ 将发送目标手机号存成json数据保存为sms文件
	*/
	private function createDataFile($dataArr){
		if(is_array($dataArr)){
			$dataFile = time().'.sms';
			file_put_contents($this->smsDataPath.$dataFile,json_encode($dataArr));
			return $dataFile;
		}else{
			return 0;
		}
	}

	/*
		@ 获取文件手机号数据，并将数据转换成500个一组的数组数据
		@ $lid:队列ID
	*/
	private function getMobileData($lid){
		$this->c->table('sms_list');
		$dataArr = $this->c->search("L_ID='".$lid."' AND ".$this->where,'','','L_DataFile');
		$filePath = $this->smsDataPath.$dataArr[0]['L_DataFile'];
		$mArr = json_decode(file_get_contents($filePath),true);
		
		$m = new mobile;
		$i=1;
		echo $max;
		foreach($mArr as $k=>$v){
			if($i%500 == 0){
				$mobileArr[] = join(',',$temp);
				unset($temp);
			}
			$temp[] = $m->unMobile($v['C_Mobile']);

			//判断循环是否到最后一阶段
			if(count($mArr)==$i){
				$mobileArr[] = join(',',$temp);
			}
			$i++;
		}
		return $mobileArr;
	}

	/**
	 * @ 加载客户分类信息
	 */
	protected function getCustomerCategoryArr(){
		$customer = new customer;
		return $customer->getCategoryArr();
	}

	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}

}
?>