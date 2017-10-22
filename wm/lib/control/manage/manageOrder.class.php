<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：manageOrder
 * 
 * @功能：订单管理
 *
 * @开发人：杜飞
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：manageOrder.class.php
 * 
 * @开发时间：2014-9-13 15:28:17
 * 
 * @订单管理
 * 
 */
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
require_once(dirname(__FILE__)."/manage.class.php");
class manageOrder extends manage{
	public function __construct(){
		parent::__construct();
		$this->c->table('order');
	}

	/**
	 * @ 订单列表
	 */
	public function index(){
		$this->getOrderList();
		$this->filename = 'order_list.html';	
	}

	/**
	 * @ 获取订单列表
	 */
	private function getOrderList(){
		$w = $this->createOrderWhere();
		$url = 'index.php?m=manageOrder&p=manage'.$w[1];
		$where = $w[0];
		$fields = "*,(select region_name from sw_region where region_id = O_Province) as Province,(select region_name from sw_region where region_id = O_City) as City";
		$page = new PageTurn($this->c,G('page',2,2),'order',$url,20,'O_ID desc',$where,$fields);
		$dataArr = $page->dataArr;
		if($dataArr){
			foreach($dataArr as $k=>$v){
				$dataArr[$k]['O_PayStatus'] = $this->OrderStatus('O_PayStatus',$v['O_PayStatus']);
				$dataArr[$k]['O_PayShipping'] = $this->OrderStatus('O_PayShipping',$v['O_PayShipping']);
				$dataArr[$k]['O_OrderStatus'] = $this->OrderStatus('O_OrderStatus',$v['O_OrderStatus']);
			}
		}
		$this->tpl('dataArr',$dataArr);
		$this->tpl('pageStr',$page->pageStr(3));
	}

	/**
	 * @ 订单搜索
	 */
	private function createOrderWhere(){
		$a = G('a',2);
		if($a != 'search'){ return array(); }
		$keyword = G('k',2);
		$startTime = G('startTime',2);
		$endTime = G('endTime',2);
		$O_OrderStatus = G('O_OrderStatus',2);
		$O_PayStatus = G('O_PayStatus',2);
		$O_PayShipping = G('O_PayShipping',2);
		if($startTime && $endTime){
					$w[] = " O_Time BETWEEN '".strtotime($startTime.' 00:00:00')."' AND '".strtotime($endTime.' 23:59:59')."'";
				}else if($startTime && !$endTime){
					$w[] = "O_Time >='".strtotime($startTime.' 00:00:00')."'";
				}
		if($keyword){$w[] = "O_Number = '".$keyword."'";}
		if($O_OrderStatus >= 0){$w[] = "O_OrderStatus = ".$O_OrderStatus."";}
		if($O_PayStatus >= 0){$w[] = "O_PayStatus = ".$O_PayStatus."";}
		if($O_PayShipping >= 0){$w[] = "O_PayShipping = ".$O_PayShipping."";}

		$u[] = 'startTime='.$startTime.'&endTime='.$endTime."&k=".$keyword."&O_OrderStatus=".$O_OrderStatus."&O_PayStatus=".$O_PayStatus."&O_PayShipping=".$O_PayShipping;
		//合并查询条件
		if(count($w)){ $where = join(' AND ',$w); }
		//合并url传参条件
		if(count($u)){ $url = '&a=search&'.join('&',$u); }
		$this->tpl('keyword',$keyword);
		$this->tpl('startTime',$startTime);
		$this->tpl('endTime',$endTime);
		$this->tpl('O_OrderStatus',$O_OrderStatus);
		$this->tpl('O_PayStatus',$O_PayStatus);
		$this->tpl('O_PayShipping',$O_PayShipping);
		return array($where,$url);
	}
	
	/**
	 * @ 订单详情
	 */
	public function orderShow(){
		$order_id = G('OID',2,2);
		$dataArr = $this->c->search("O_ID = '$order_id'",'','','*,(select region_name from sw_region where region_id = O_Province) as Province,(select region_name from sw_region where region_id = O_City) as City,(select P_name from sw_payment where P_id = O_PayID) as P_name');
		//获取订单产品详情
		$this->c->table('order_goods');
		$OordeGgoodsArr = $this->c->search("O_OID='$order_id'");
		if($dataArr){
			foreach($dataArr as $k=>$v){
				$dataArr[$k]['PayStatus'] = $this->OrderStatus('O_PayStatus',$v['O_PayStatus']);
				$dataArr[$k]['PayShipping'] = $this->OrderStatus('O_PayShipping',$v['O_PayShipping']);
				$dataArr[$k]['OrderStatus'] = $this->OrderStatus('O_OrderStatus',$v['O_OrderStatus']);

			}
		}
		$this->tpl('dataArr',$dataArr[0]);
		$this->tpl('OordeGgoodsArr',$OordeGgoodsArr);
		$this->filename = 'pop/orderShow.html';
	}

	/**
	 * @ 更改订单状态
	 */
	public function setOrderStatus(){
		$oid = intval(G('oid',2,2));
		if($oid <= 0){echo 0;exit;}
		$fields = G('fields',3);
		$value = intval(G('value',3));
		switch($fields){
			case 'O_PayStatus'://处理支付状态
			$dataArr['O_PayStatus'] = $value;
			break;
			case 'O_PayShipping'://处理发货状态
			$dataArr['O_PayShipping'] = $value;
			break;
			case 'O_OrderStatus'://处理结算状态
			$dataArr['O_OrderStatus'] = $value;
			$order_Payment = $this->c->search("O_ID='".$oid."'",'','','O_UID,O_SellUID,O_Payment');

			$this->c->table('products');
			$OordeGgoodsArr = $this->c->search(" P_ID = (select O_GoodsID from sw_order_goods WHERE O_OID='$oid')",'','','P_UID,P_Money');
			if($OordeGgoodsArr){
				foreach($OordeGgoodsArr as $k=>$v){
					if(intval($v['P_UID']) > 0){
						//插入款项记录
						$this->c->execute("insert into sw_pay_log (L_order_id, L_amount, L_type,L_is_paid,L_userid,L_time)values ('".$oid."','".$v['P_Money']."','3','1','".$v['P_UID']."','".time()."')");
						 /* 结算成功把钱冲入会员账户 */
						$sql = 'UPDATE sw_user SET U_Balance = U_Balance+'.$v['P_Money'].' where U_ID = '.$v['P_UID'].'';
						$this->c->execute($sql);
						$W_ONLINESELL = intval($v['P_Money']*W_ONLINESELL/100);
						$W_ONLINEBUY = intval($v['P_Money']*W_ONLINEBUY/100);
					}
				}
			}
			if($order_Payment){
				if($order_Payment[0]['O_Payment'] == 2){ //线上支付荣誉度
					$this->c->execute('UPDATE sw_user SET U_Credit = U_Credit+'.$W_ONLINESELL.' where U_ID = '.$order_Payment[0]['O_SellUID'].'');//线上卖家荣誉度

					$this->c->execute('UPDATE sw_user SET U_Credit = U_Credit+'.$W_ONLINEBUY.' where U_ID = '.$order_Payment[0]['O_UID'].'');//线上买家荣誉度
				}
			}
			break;
		}
		$this->c->table('order');
		$this->c->update($dataArr,"O_ID='".$oid."'");
		echo 1;
		exit;
	}

	/**
	 * @ 订单状态
	 */
	private function OrderStatus($Status,$val){
		$orderActionArr['O_PayStatus'] = array('0'=>'未支付','1'=>'已支付');
		$orderActionArr['O_PayShipping'] = array('0'=>'未发货','1'=>'已发货','2'=>'已收货');
		$orderActionArr['O_OrderStatus'] = array('0'=>'未结算','1'=>'已结算');
		return $orderActionArr[$Status][$val];
	}
	

	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}
}
?>