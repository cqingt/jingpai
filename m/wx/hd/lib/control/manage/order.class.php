<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：order
 * 
 * @功能：订单管理
 *
 * @开发人：盛威
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：order.class.php
 * 
 * @开发时间：2014-9-13 15:28:17
 * 
 * @订单管理
 * 
 */
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
require_once(dirname(__FILE__)."/manage.class.php");
class order extends manage{
	public function __construct(){
		parent::__construct();
		$this->c->table('order');
	}

	/**
	 * @ 订单列表
	 */
	public function index(){
		$w = $this->search_order();
		$url = 'index.php?m=order&p=manage'.$w[1];
		$where = $w[0];
		$fields = '*,(SELECT region_name FROM sw_region WHERE region_id=province) as province,(SELECT region_name FROM sw_region WHERE region_id=city) as city,(SELECT type FROM sw_jiang WHERE id=uid) as type';
		$page = new PageTurn($this->c,G('page',2,2),'order',$url,20,'time DESC',$where,$fields);
		$this->tpl('dataArr',$page->dataArr);
		$this->tpl('pageStr',$page->pageStr(3));
		$this->filename = 'order_list.html';
	}

	/**
	 * @ 导出数据
	 */
	public function daochu(){
		$w = $this->search_order();
		$where = $w[0].' AND is_yidao = 0';
		$fields = '*,(SELECT region_name FROM sw_region WHERE region_id=province) as province,(SELECT region_name FROM sw_region WHERE region_id=city) as city,(SELECT type FROM sw_jiang WHERE id=uid) as type,(select mobile  from sw_jiang where id = uid) as mobile';
		$dataArr = $this->c->search($where,'','',$fields);
		$O_PayShipping = G('O_PayShipping',2);
		if($O_PayShipping == 0){
			$filename = '未发货订单';
		}elseif($O_PayShipping == 1){
			$filename = '已发货订单';
		}elseif($O_PayShipping == 2){
			$filename = '已收货订单';
		}else{
			$filename = '导出订单';
		}
		$this->Export($filename); //设置导出格式
		echo '<table><tr><td>订单编号</td><td>下单时间</td><td>收货人</td><td>收货地址</td><td>电话号码</td></tr>';
		if($dataArr){
			foreach($dataArr as $k=>$v){
			$S_AddTime = date('Y-m-d H:i:s',$v['time']);
			echo "<table><tr><td style='vnd.ms-excel.numberformat:@'>$v[order_sn]</td><td>$S_AddTime</td><td>$v[name]</td><td>$v[province]&nbsp;$v[city]&nbsp;$v[address]</td><td style='vnd.ms-excel.numberformat:@'>$v[mobile]</td></tr></table>";
			$abcdef['is_yidao']='1';
			$this->c->update($abcdef,"oid='".$v['oid']."'");
			}
		}
		echo "</table>";

	}

	/**
	 * @ 订单搜索
	 */
	private function search_order(){
		$a = G('a',2);
		if($a != 'search'){ return array(); }
		$keyword = G('k',2);
		$startTime = G('startTime',2);
		$endTime = G('endTime',2);
		$O_PayShipping = G('O_PayShipping',2);
		$type = G('type',2);
		if($startTime && $endTime){
					$w[] = " time BETWEEN '".strtotime($startTime.' 00:00:00')."' AND '".strtotime($endTime.' 23:59:59')."'";
				}else if($startTime && !$endTime){
					$w[] = "time >='".strtotime($startTime.' 00:00:00')."'";
				}
		if($keyword){$w[] = "order_sn = '".$keyword."'";}
		if($O_PayShipping >= 0){$w[] = "status = ".$O_PayShipping."";}
		if($type > 0){
			$w[] = "type = ".$type."";
		}
		$u[] = 'startTime='.$startTime.'&endTime='.$endTime."&k=".$keyword."&O_PayShipping=".$O_PayShipping."&type=".$type;
		//合并查询条件
		if(count($w)){ $where = join(' AND ',$w); }
		//合并url传参条件
		if(count($u)){ $url = '&a=search&'.join('&',$u); }
		$this->tpl('keyword',$keyword);
		$this->tpl('startTime',$startTime);
		$this->tpl('endTime',$endTime);
		$this->tpl('type',$type);
		$this->tpl('O_PayShipping',$O_PayShipping);
		$this->tpl('url',$url);
		return array($where,$url);
	}

	/**
	 * @ 订单详情
	 */
	public function orderShow(){
		$order_id = G('OID',2,2);
		$dataArr = $this->c->search("oid = '$order_id'",'','','*,(select region_name from sw_region where region_id = province) as province,(select region_name from sw_region where region_id = city) as city,(select mobile  from sw_jiang where id = uid) as mobile');
		
		$this->tpl('dataArr',$dataArr[0]);
		$this->filename = 'pop/orderShow.html';
	}

	/**
	 * @ 更改订单状态
	 */
	public function setOrderStatus(){
		$order_id = G('oid',2,2);
		if($order_id <= 0){echo 0;exit;}
		$fields = G('fields',3);
		$value = intval(G('value',3));
		$type = intval(G('type',3));
		$express_sn = G('express_sn',3);
		$this->c->table('order');
		if($fields=='status'){
			$dataArr['status'] = $value;
			if($value == 1 && $type == 1){
				$dataArr['express_sn'] = $express_sn;
				$dataArr['express'] = '特快专递';
			}else{
				$dataArr['express'] = '上门取货';
			}

		}
		$this->c->update($dataArr,"oid='".$order_id."'");
		echo 1;
		exit;
	}

    /**
	 * @ 打印快递单号
	 */
	public function Kprint(){
		$order_id = G('orderid',2,2);
		$dataArr = $this->c->search("oid = '$order_id'",'','','*,(select region_name from sw_region where region_id = province) as province,(select region_name from sw_region where region_id = city) as city,(select mobile  from sw_jiang where id = uid) as mobile');
		$this->tpl('dataArr',$dataArr[0]);
		$this->tpl("timeArr",array(date("Y"),date("m"),date("d"),date("H")));
		$this->filename = 'OrderPrint_ZTO.html';
	}
	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}

	private function Export($filename){
		header("Content-type: application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment; filename=$filename.xls");
		echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"
		xmlns:x="urn:schemas-microsoft-com:office:excel"
		xmlns="http://www.w3.org/TR/REC-html40">
		<head>
		<meta http-equiv="expires" content="Mon, 06 Jan 1999 00:00:01 GMT">
		<meta http-equiv=Content-Type content="text/html; charset=gb2312">
		<!--[if gte mso 9]><xml>
		<x:ExcelWorkbook>
		<x:ExcelWorksheets>
		<x:ExcelWorksheet>
		<x:Name></x:Name>
		<x:WorksheetOptions>
		<x:DisplayGridlines/>
		</x:WorksheetOptions>
		</x:ExcelWorksheet>
		</x:ExcelWorksheets>
		</x:ExcelWorkbook>
		</xml><![endif]-->

		</head>';
	}
}
?>	