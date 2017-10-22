<?php
include_once('payment.class.php');
class Pay extends Payment
{
	
		/**************************请求参数**************************/
		public $configArr;

        //支付类型
        private $payment_type;
        //必填，不能修改

        //服务器异步通知页面路径
        private $notify_url;
        //需http://格式的完整路径，不能加?id=123这类自定义参数

        //页面跳转同步通知页面路径
        private $return_url;
        //需http://格式的完整路径，不能加?id=123这类自定义参数，不能写成http://localhost/

        //商户订单号
        private $out_trade_no;
        //商户网站订单系统中唯一订单号，必填

        //订单名称
        private $subject;
        //必填

        //付款金额
        private $total_fee;
        //必填

        //订单描述
        private $body;
        //默认支付方式
        private $paymethod;
        //必填
        //默认网银
        private $defaultbank;
        //必填，银行简码请参考接口技术文档

        //商品展示地址
        private $show_url;
        //需以http://开头的完整路径，例如：http://www.商户网址.com/myorder.html

        //防钓鱼时间戳
        private $anti_phishing_key;
        //若要使用请调用类文件submit中的query_timestamp函数

        //客户端的IP地址
        private $exter_invoke_ip;
        //非局域网的外网IP地址，如：221.0.0.1

        private $parameter;

        public function __set($fileds,$val){
        	$this->$fileds = $val;
        }


		/************************************************************/
		protected function setPayment(){
			//构造要请求的参数数组，无需改动
			$this->parameter = array(
						"service" => "create_direct_pay_by_user",
						"partner" => trim($this->configArr['partner']),
						"seller_email" => trim($this->configArr['seller_email']),
						"payment_type"	=> $this->payment_type,
						"notify_url"	=> $this->notify_url,
						"return_url"	=> $this->return_url,
						"out_trade_no"	=> $this->out_trade_no,
						"subject"	=> $this->subject,
						"total_fee"	=> $this->total_fee,
						"body"	=> $this->body,
						"paymethod"	=> $this->paymethod,
						"defaultbank"	=> $this->defaultbank,
						"show_url"	=> $this->show_url,
						"anti_phishing_key"	=> $this->anti_phishing_key,
						"exter_invoke_ip"	=> $this->exter_invoke_ip,
						"_input_charset"	=> trim(strtolower($this->configArr['input_charset']))
						);
			if(is_numeric($this->defaultbank)){
				unset($this->parameter['paymethod']);
				unset($this->parameter['defaultbank']);
			}
		}

				//发送数据
		public function prefixValue(){
			//$this->isCheck();//pand
			$this->setPayment();//设置参数
			//建立请求
			$alipaySubmit = new AlipaySubmit($this->configArr);
			$html_text = $alipaySubmit->buildRequestForm($this->parameter,"get", "确认");
			return $html_text;
		}

		// private isCheck(){

		// }

}
?>