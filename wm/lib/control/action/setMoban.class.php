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
require_once(dirname(__FILE__)."/../manage/manage.class.php");
require_once($_SERVER['DOCUMENT_ROOT']."/core/framework/libraries/weixinsdk.php");
require_once(dirname(__FILE__)."/../../model/class/weixinMoban.class.php");
class setMoban extends manage{

	public function __construct(){
		parent::__construct();
	}

	/**
	 * @ 默认主控类方法
	 */
	public function doMoban(){
		if($_POST['form_submit'] == 'ok'){
			switch (trim($_POST['MoBanStyle'])){
				case 'GongGao':
					$moban_array['first'] = $_POST['first'];
					$moban_array['keyword1'] = $_POST['keyword1'];
					$moban_array['keyword2'] = $_POST['keyword2'];
					$moban_array['remark'] = $_POST['remark'];
					$moban_array['url'] = $_POST['url'];
					break;
				case 'ChaoYue':
					$moban_array['first'] = $_POST['first'];
					$moban_array['number'] = $_POST['number'];
					$moban_array['name'] = $_POST['name'];
					$moban_array['remark'] = $_POST['remark'];
					$moban_array['url'] = $_POST['url'];
					break;
				case 'LePaiJieShu':
					$moban_array['first'] = $_POST['first'];
					$moban_array['number'] = $_POST['number'];
					$moban_array['name'] = $_POST['name'];
					$moban_array['deadline'] = $_POST['deadline'];
					$moban_array['remark'] = $_POST['remark'];
					$moban_array['url'] = $_POST['url'];
					break;
			}

			$result = $this->sendMoban($_POST['openid'],$_POST['MoBanStyle'],$moban_array);

			return $result;

		}else{
			return json_encode(array('errmsg'=>'信息提交错误'));
		}
	}


	private function sendMoban($openid,$moban_style,$moban_array){
		$weixinMoban = new weixinMoban;//模板消息
		$weixinInfo = new weixinSDK;//微信基类
		$moban_token = $weixinInfo->token;
		$result = $weixinMoban->$moban_style($openid,$moban_array,$moban_token);
		return $result;
	}


}
?>