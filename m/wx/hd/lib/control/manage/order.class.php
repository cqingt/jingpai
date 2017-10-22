<?php
/**
 * SW CRM����ϵͳV2.0�汾
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������order
 * 
 * @���ܣ���������
 *
 * @�����ˣ�ʢ��
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�order.class.php
 * 
 * @����ʱ�䣺2014-9-13 15:28:17
 * 
 * @��������
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
	 * @ �����б�
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
	 * @ ��������
	 */
	public function daochu(){
		$w = $this->search_order();
		$where = $w[0].' AND is_yidao = 0';
		$fields = '*,(SELECT region_name FROM sw_region WHERE region_id=province) as province,(SELECT region_name FROM sw_region WHERE region_id=city) as city,(SELECT type FROM sw_jiang WHERE id=uid) as type,(select mobile  from sw_jiang where id = uid) as mobile';
		$dataArr = $this->c->search($where,'','',$fields);
		$O_PayShipping = G('O_PayShipping',2);
		if($O_PayShipping == 0){
			$filename = 'δ��������';
		}elseif($O_PayShipping == 1){
			$filename = '�ѷ�������';
		}elseif($O_PayShipping == 2){
			$filename = '���ջ�����';
		}else{
			$filename = '��������';
		}
		$this->Export($filename); //���õ�����ʽ
		echo '<table><tr><td>�������</td><td>�µ�ʱ��</td><td>�ջ���</td><td>�ջ���ַ</td><td>�绰����</td></tr>';
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
	 * @ ��������
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
		//�ϲ���ѯ����
		if(count($w)){ $where = join(' AND ',$w); }
		//�ϲ�url��������
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
	 * @ ��������
	 */
	public function orderShow(){
		$order_id = G('OID',2,2);
		$dataArr = $this->c->search("oid = '$order_id'",'','','*,(select region_name from sw_region where region_id = province) as province,(select region_name from sw_region where region_id = city) as city,(select mobile  from sw_jiang where id = uid) as mobile');
		
		$this->tpl('dataArr',$dataArr[0]);
		$this->filename = 'pop/orderShow.html';
	}

	/**
	 * @ ���Ķ���״̬
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
				$dataArr['express'] = '�ؿ�ר��';
			}else{
				$dataArr['express'] = '����ȡ��';
			}

		}
		$this->c->update($dataArr,"oid='".$order_id."'");
		echo 1;
		exit;
	}

    /**
	 * @ ��ӡ��ݵ���
	 */
	public function Kprint(){
		$order_id = G('orderid',2,2);
		$dataArr = $this->c->search("oid = '$order_id'",'','','*,(select region_name from sw_region where region_id = province) as province,(select region_name from sw_region where region_id = city) as city,(select mobile  from sw_jiang where id = uid) as mobile');
		$this->tpl('dataArr',$dataArr[0]);
		$this->tpl("timeArr",array(date("Y"),date("m"),date("d"),date("H")));
		$this->filename = 'OrderPrint_ZTO.html';
	}
	/**
	 * @ ����ϵͳ��������
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