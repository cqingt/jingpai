<?php
/**
 * SW CRM管理系统V2.0版本
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：managePayment
 * 
 * @功能：微信支付方式
 *
 * @开发人：杜飞
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：managePayment.class.php
 * 
 * @开发时间：2014-9-10 15:28:17
 * 
 * @微信支付方式
 * 
 */
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/../../model/class/Upload.class.php");
class managePayment extends manage{
	public function __construct(){
		parent::__construct();
		$this->c->table('payment');
	}

	/**
	 * @ 支付列表
	 */
	public function index(){
		$this->getPaymentList();
		$this->filename = 'payment_list.html';	
	}

	/**
	 * @ 获取支付列表
	 */
	private function getPaymentList(){
		global $_LANG;
		$pay_list = array();
		//取得插件文件中的支付方式 
		$modules = $this->read_modules(dirname(__FILE__).'/../../plugins/payment');
		$dataArr = $this->c->search("P_enabled=1",'P_order ASC');
		if($dataArr){
			foreach($dataArr as $k=>$v){
				$pay_list[$v['P_code']] = $v;
			}
		}
		for ($i = 0; $i < count($modules); $i++)
		{
			$code = $modules[$i]['code'];
			$modules[$i]['pay_code'] = $modules[$i]['code'];
			//如果数据库中有，取数据库中的名称和描述 
			if (isset($pay_list[$code]))
			{
				$modules[$i]['name'] = $pay_list[$code]['P_name'];
				$modules[$i]['pay_fee'] =  $pay_list[$code]['P_fee'];
				$modules[$i]['is_cod'] = $pay_list[$code]['P_is_cod'];
				$modules[$i]['desc'] = $pay_list[$code]['P_desc'];
				$modules[$i]['pay_order'] = $pay_list[$code]['P_order'];
				$modules[$i]['install'] = '1';
			}
			else
			{
				$modules[$i]['name'] = $_LANG[$modules[$i]['code']];
				if (!isset($modules[$i]['pay_fee']))
				{
					$modules[$i]['pay_fee'] = 0;
				}
				$modules[$i]['desc'] = $_LANG[$modules[$i]['desc']];
				$modules[$i]['install'] = '0';
			}
		}
	
		$this->tpl('modules',$modules);
	}

	/**
	 * @ 安装支付方式
	 */
	public function Install(){
		global $_LANG;
		$set_modules = true;
		require_once(dirname(__FILE__).'/../../plugins/payment/'.G('code',3).'.php');
		$dataArr = $modules[0];
		//对支付费用判断。如果data['pay_fee']为false无支付费用，为空则说明以配送有关，其它可以修改 
		if (isset($dataArr['pay_fee']))
		{
			$dataArr['pay_fee'] = trim($dataArr['pay_fee']);
		}
		else
		{
			$dataArr['pay_fee']     = 0;
		}
		$pay['pay_code']    = $dataArr['code'];
		$pay['pay_name']    = $_LANG[$dataArr['code']];
		$pay['pay_desc']    = $_LANG[$dataArr['desc']];
		$pay['is_cod']      = $dataArr['is_cod'];
		$pay['pay_fee']     = $dataArr['pay_fee'];
		$pay['is_online']   = $dataArr['is_online'];
		$pay['pay_config']  = array();
		foreach ($dataArr['config'] AS $key => $value)
		{
			$config_desc = (isset($_LANG[$value['name'] . '_desc'])) ? $_LANG[$value['name'] . '_desc'] : '';
			$pay['pay_config'][$key] = $value +
				array('label' => $_LANG[$value['name']], 'value' => $value['value'], 'desc' => $config_desc);

			if ($pay['pay_config'][$key]['type'] == 'select' ||
				$pay['pay_config'][$key]['type'] == 'radiobox')
			{
				$pay['pay_config'][$key]['range'] = $_LANG[$pay['pay_config'][$key]['name'] . '_range'];
			}
		}
		$this->tpl('pay',$pay);
		$this->filename = 'pop/poppayment_edit.html';
	}
	
	/**
	 * 修改支付方式
	 */
	public function paymentedit(){
		$code = trim(G('code',3));
		if (!isset($code)){show('参数错误!');exit;}
		$dataArr = $this->c->search("P_code = '$code' AND P_enabled=1");
		$pay = $dataArr[0];
		if (empty($pay)){show('该支付插件不存在或尚未安装!');exit;}
		global $_LANG;
		$set_modules = true;
		require_once(dirname(__FILE__).'/../../plugins/payment/'.$code.'.php');
		$data = $modules[0];
		// 取得配置信息  
		if (is_string($pay['P_config']))
		{
			$store = unserialize($pay['P_config']);
			// 取出已经设置属性的code  
			$code_list = array();
			foreach ($store as $key=>$value)
			{
				$code_list[$value['name']] = $value['value'];
			}
			$pay['P_config'] = array();
			// 循环插件中所有属性  
			foreach ($data['config'] as $key => $value)
			{
				$pay['P_config'][$key]['desc'] = (isset($_LANG[$value['name'] . '_desc'])) ? $_LANG[$value['name'] . '_desc'] : '';
				$pay['P_config'][$key]['label'] = $_LANG[$value['name']];
				$pay['P_config'][$key]['name'] = $value['name'];
				$pay['P_config'][$key]['type'] = $value['type'];
				if (isset($code_list[$value['name']]))
				{
					$pay['P_config'][$key]['value'] = $code_list[$value['name']];
				}
				else
				{
					$pay['P_config'][$key]['value'] = $value['value'];
				}

				if ($pay['P_config'][$key]['type'] == 'select' || $pay['P_config'][$key]['type'] == 'radiobox')
				{
					$pay['P_config'][$key]['range'] = $_LANG[$pay['P_config'][$key]['name'] . '_range'];
				}
			}
		}
		//支付费用
		if (!isset($pay['pay_fee']))
		{
			if (isset($data['pay_fee']))
			{
				$pay['pay_fee'] = $data['pay_fee'];
			}
			else
			{
				$pay['pay_fee'] = 0;
			}
		}
		$pay['pay_id'] = $pay['P_id'];
		$pay['pay_name'] = $pay['P_name'];
		$pay['pay_config'] = $pay['P_config'];
		$pay['pay_desc'] = $pay['P_desc'];
		$pay['is_cod'] = $pay['P_is_cod'];
		$pay['pay_fee'] = $pay['P_fee'];
		$pay['pay_code'] = $pay['P_code'];
		$pay['is_online'] = $pay['P_is_online'];
		$this->tpl('pay',$pay);
		$this->filename = 'pop/poppayment_edit.html';

	}

	/**
	 * 提交支付方式 post
	 */
	public function popSubmit(){
		$pay_name = trim($_POST['pay_name']);
		if (empty($pay_name))
		{
			show('支付名称不能为空!');
			exit;
		}
		$nums = $this->c->sumRows("P_name = '$_POST[pay_name]' AND P_code <> '$_POST[pay_code]'");
		if($nums > 0){
			show('支付名称已存在!');
			exit;
		}
		//取得配置信息 
		$pay_config = array();
		if (isset($_POST['cfg_value']) && is_array($_POST['cfg_value']))
		{
			for ($i = 0; $i < count($_POST['cfg_value']); $i++)
			{
				$pay_config[] = array('name'  => trim($_POST['cfg_name'][$i]),
									  'type'  => trim($_POST['cfg_type'][$i]),
									  'value' => trim($_POST['cfg_value'][$i])
				);
			}
		}
		$pay_config = serialize($pay_config);
		//取得支付手续费 
		$pay_fee    = empty($_POST['pay_fee'])?'0':$_POST['pay_fee'];
		//上传支付图片
		$file_name = $this->Upload($_POST['pay_code']);
	
		//判断是编辑还是安装 
		if ($_POST['pay_id'])
		{
			$dataArr['P_name'] = $_POST['pay_name'];
			$dataArr['P_desc'] = $_POST['pay_desc'];
			$dataArr['P_config'] = $pay_config;
			$dataArr['P_fee'] = $pay_fee;
			if($file_name){$dataArr['P_img'] = $file_name;} //图片
			$this->c->update($dataArr,"P_code = '$_POST[pay_code]'");
			show('更新成功!',"index.php?m=managePayment&p=manage&c=paymentedit&code=".$_POST['pay_code']);
			exit;
		}else{
			//安装，检查该支付方式是否曾经安装过 
			$pay_code = $this->c->sumRows("P_code = '$_REQUEST[pay_code]'");
			if ($pay_code > 0)
			{
				// 该支付方式已经安装过, 将该支付方式的状态设置为 可用
				$dataArr1['P_name'] = $_POST['pay_name'];
				$dataArr1['P_desc'] = $_POST['pay_desc'];
				$dataArr1['P_config'] = $pay_config;
				$dataArr1['P_fee'] = $pay_fee;
				$dataArr1['P_enabled'] = '1';
				if($file_name){$dataArr1['P_img'] = $file_name;} //图片
				$this->c->update($dataArr1,"P_code = '$_POST[pay_code]'");
			}
			else
			{
				// 该支付方式没有安装过, 将该支付方式的信息添加到数据库
				$dataArr2['P_code'] = $_POST['pay_code'];
				$dataArr2['P_name'] = $_POST['pay_name'];
				$dataArr2['P_desc'] = $_POST['pay_desc'];
				$dataArr2['P_config'] = $pay_config;
				$dataArr2['P_is_cod'] = $_POST['is_cod'];
				$dataArr2['P_fee'] = $pay_fee;
				$dataArr2['P_enabled'] = '1';
				$dataArr2['P_is_online'] = $_POST['is_online'];
				$dataArr2['P_img'] = $file_name; //图片
				$this->c->insert($dataArr2);
			}
			show('安装成功!',"index.php?m=managePayment&p=manage&c=paymentedit&code=".$_POST['pay_code']);
			exit;
		}
	}
	
	/**
	 * @ 上传支付图片
	 */
	private function Upload($pay_code){
		$imgArr = G('P_img',4);
		
		$filepath = 'static/upload/images/web3_so_com/pay';
		if($imgArr['name']){
			$upload = new upload($imgArr,$filepath,0);
			$upload->filename = $pay_code;
			return $upload->upimg();
		}
	}

	/**
	 * 卸载支付方式
	 */
	public function uninstall(){
		//把支付方式设置成不可用状态
		$dataArr['P_enabled'] = '0';
		$this->c->update($dataArr,"P_code = '".$_GET['pay_code']."'");
		show('卸载成功!');
		exit;
	}

	/**
	 * 插件存放的目录
	 */
	private function read_modules($directory = '.')
	{
		global $_LANG;
		$dir         = @opendir($directory);
		$set_modules = true;
		$modules     = array();
		while (false !== ($file = @readdir($dir)))
		{
			if (preg_match("/^.*?\.php$/", $file))
			{
				include_once($directory. '/' .$file);
			}
		}
		@closedir($dir);
		unset($set_modules);
		foreach ($modules AS $key => $value)
		{
			ksort($modules[$key]);
		}
		ksort($modules);
		return $modules;
	}

	/**
	 * @ 定义系统析构方法
	 */
	public function __destruct(){
		$this->toString();
	}
}
?>	