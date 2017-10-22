<?php
/**
 * SW 前台控制核心类库
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：main
 * 
 * @功能：前台控制核心类库
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：base.class.php
 * 
 * @开发时间：2014-7-28 15:00:00
 * 
 * @前台控制核心类库
 * 
 */
require_once(dirname(__FILE__)."/public/session.class.php");
class league extends model{
	public static $paymentArr = Array(1=>'线下交易',2=>'担保交易');
	public $noCheckArr = Array(/*'register',*/'goods','areaAction');//不进行openid检测的数组

	public function __construct(){
		parent::__construct();
		if( !in_array(G('m',2),$this->noCheckArr) && G('m',2)){
			session::sessionRun($this->c);
		}
		$this->getConfigData();
	}

	/*
		@加载初始化数据配置
	*/
	private function getConfigData(){
		$this->tpl('Domain',W_DOMAIN);//加载分公司域名
		$this->tpl('DIR',DIR_MAIN);//加载模板路径
		$this->tpl('COMPANY',W_COMPANY);//加载分公司名称
		$this->tpl('LOGO',W_LOGO);//加载验证模式
		$this->tpl('YEAR',date('Y'));
		$this->tpl('FolderName',$this->FolderName);//加载分公司图片目录
		$this->tpl('rzUser',$_SESSION['sw_renzheng']);

		//如果为登陆状态则生成转发记录参数
		if($_SESSION['sw_uid']){
			$this->tpl('swurl','&swopenid='.$_SESSION['sw_openid']);
		}else if(G('swopenid',2)){
			$this->tpl('swurl','&swopenid='.G('swopenid',2));
		}
		if($_SESSION['sw_openid'] != G('af_openid',2)){
			$af_id = intval(G('af_id',2,2)); //活动id
			$this->c->table('affiliate');
			$affiliate = $this->c->search("is_k =1 AND id = ".$af_id);
			if($affiliate[0]){
				$affte = $affiliate[0];
				if($affte['expire_unit'] == 1){
					$time = time()+($affte['expire']*3600); //按小时
				}
				if($affte['expire_unit'] == 2){
					$time = time()+($affte['expire']*86400); //按天
				}
				if($affte['expire_unit'] == 3){
					$time = time()+($affte['expire']*604800); //按周
				}
				setcookie("level_register_all",$affte['level_register_all'],$time);//注册所赠送的积分
				setcookie("order_all",$affte['order_all'],$time);//下单所赠送的积分
				setcookie("level_register_up",$affte['level_register_up'],$time);//赠送积分上限
				setcookie("affiliate_range",$affte['affiliate_range'],$time);//赠送范围
				setcookie("af_openid",G('af_openid',2),$time);//推荐人的openid
			}
		}
	}
	
	/*
		@输出方法
	*/
	protected function toString($filename=''){
		$this->filename=$filename ? $filename : $this->filename;
		$filepath = 'tpl/show/'.$this->filename;
		if($this->filename){ $this->display($filepath);	}
	}

	/*
		@处理序列化的支付、配送的配置参数
	*/
	protected function unserialize_config($cfg)
	{
		if (is_string($cfg) && ($arr = unserialize($cfg)) !== false)
		{
			$config = array();

			foreach ($arr AS $key => $val)
			{
				$config[$val['name']] = $val['value'];
			}

			return $config;
		}
		else
		{
			return false;
		}
	}

	/**
	 * @ 通过商品ID获取信息
	 */
	protected function getGoodsInfo($id){
		$this->c->table('products');
		$fields = "*,if(P_Money=0.00,'询价',P_Money) as P_Money,(SELECT U_isRZ FROM sw_user WHERE U_OpenID=OpenID) as isRZ,(SELECT region_name FROM sw_region WHERE region_id=P_Province) as Province,(SELECT region_name FROM sw_region WHERE region_id=P_City) as City,(SELECT I_Img FROM sw_products_img WHERE I_PID=P_ID LIMIT 1) as Img";
		$dataArr = $this->c->search("P_ID='".$id."'",'','',$fields);
		return $dataArr[0];
	}

	/*
		@计算订单的支付费用
	*/
	protected function pay_fee($payment, $order_amount, $cod_fee=null)
	{
		$pay_fee = 0;
		$rate    = ($payment['P_is_cod'] && !is_null($cod_fee)) ? $cod_fee : $payment['P_fee'];

		if (strpos($rate, '%') !== false)
		{
			/* 支付费用是一个比例 */
			$val     = floatval($rate) / 100;
			$pay_fee = $val > 0 ? $order_amount * $val /(1- $val) : 0;
		}
		else
		{
			$pay_fee = floatval($rate);
		}

		return round($pay_fee, 2);
	}

	/**
	 * @ 检测是否为认证账户
	 */
	protected function checkRenZheng(){
		if(!intval($_SESSION['sw_renzheng'])){
			show('您的账户未认证，认证后才能执行此操作!','index.php?m=autho&p=main');
			exit;
		}
	}
}

?>