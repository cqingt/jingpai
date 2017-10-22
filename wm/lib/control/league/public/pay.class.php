<?php
/**
 * SW 支付类
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：pay
 * 
 * @功能：支付类
 *
 * @开发人：杜飞
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：pay.class.php
 * 
 * @开发时间：2014-9-12 17:04:00
 * 
 * @支付类
 * 
 */
class pay{
	public function __construct(){
		$mysqli=mysql_connect("192.168.1.88",'weixin','shengwei!23');
		mysql_select_db('weixin');
		mysql_query('SET NAMES gbk');
	}
	/**
	 * @ 插入支付记录
	 */
	public function insert_pay_log($id,$amount,$type,$user_id){
		mysql_query("insert into sw_pay_log (L_order_id, L_amount, L_type,L_is_paid,L_userid,L_time)values ('".$id."','".$amount."','".$type."','0','".$user_id."','".time()."')");
		return mysql_insert_id();
	}

	/**
	 * @ 取得某个支付方式的信息
	 */
	public function get_payment($code)
	{
		$this->result = mysql_query("select * from sw_payment where P_code = '$code' AND P_enabled = '1'");
		
		while($row = mysql_free_result($this->result)){ $dataArr[]=$row; }
		
		
		$payment = $dataArr[0];
		if ($payment)
		{
			$config_list = unserialize($payment['P_config']);
			foreach ($config_list AS $config)
			{
				$payment[$config['name']] = $config['value'];
			}
		}
		return $payment;
	}

	/**
	 * @ 修改订单支付状态
	 */
	public function order_paid($log_id){
		/* 取得支付记录id */
		$log_id = intval($log_id);
		
		if ($log_id > 0)
		{
			/* 取得要修改的支付记录信息 */
			$result = mysql_query("select * from sw_pay_log where L_id = ".$log_id."");
			while($row = mysql_fetch_assoc($result)){ $dataArr[]=$row; }
			$pay_log = $dataArr[0];
			if ($pay_log && $pay_log['is_paid'] == 0)
			{
				mysql_query("UPDATE sw_pay_log SET L_is_paid = 1,L_time='".time()."' where L_id = ".$log_id."");
				//支付订单
				if ($pay_log['L_type'] == 0)
				{
					/* 修改订单状态为已付款 */
					mysql_query("UPDATE sw_order SET O_PayStatus = 1 where O_ID = ".$pay_log['L_order_id']."");
				}elseif($pay_log['L_type'] == 1){//支付充值
					 /* 修改会员帐户金额 */
					$sql = 'UPDATE sw_user SET U_Balance = U_Balance+'.$pay_log['L_amount'].' where U_ID = '.$pay_log['L_userid'].'';
					mysql_query($sql);
				}
			}
		}
	}
}

?>