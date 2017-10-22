<?php
/**
 * 经验值管理
 *
 ***/

defined('InShopNC') or exit('Access Invalid!');
class exppointsControl extends SystemControl{
    const EXPORT_SIZE = 5000;
	public function __construct(){
		parent::__construct();		
	}
	/**
	 * 设置经验值获取规则
	 */
	public function expsettingOp(){
	    $model_setting = Model('setting');
		if (chksubmit()){
		    $exp_arr = array();
		    $exp_arr['exp_login'] = intval($_POST['exp_login'])?$_POST['exp_login']:0;
		    $exp_arr['exp_comments'] = intval($_POST['exp_comments'])?$_POST['exp_comments']:0;
		    $exp_arr['exp_orderrate'] = intval($_POST['exp_orderrate'])?$_POST['exp_orderrate']:0;
		    $exp_arr['exp_ordermax'] = intval($_POST['exp_ordermax'])?$_POST['exp_ordermax']:0;
			$result = $model_setting->updateSetting(array('exppoints_rule'=>serialize($exp_arr)));
			if ($result === true){
				$this->log(L('nc_edit,nc_exppoints_manage,nc_exppoints_setting'),1);
				showMessage(L('nc_common_save_succ'));
			}else {
				showMessage(L('nc_common_save_fail'));
			}			
		}
		$list_setting = $model_setting->getListSetting();
		$list_setting['exppoints_rule'] = $list_setting['exppoints_rule']?unserialize($list_setting['exppoints_rule']):array();
	    Tpl::output('list_setting',$list_setting);
		Tpl::showpage('exppoints.setting');
	}
	/**
	 * 积分日志列表
	 */
	public function indexOp(){
		$where = array();
		$search_mname = trim($_GET['mname']);
		$where['exp_membername'] = array('like',"%{$search_mname}%");
		if ($_GET['stage']){
			$where['exp_stage'] = trim($_GET['stage']);
		}
		$stime = $_GET['stime']?strtotime($_GET['stime']):0;
		$etime = $_GET['etime']?strtotime($_GET['etime']):0;
		if ($stime > 0 && $etime>0){
		    $where['exp_addtime'] = array('between',array($stime,$etime));
		}elseif ($stime > 0){
		    $where['exp_addtime'] = array('egt',$stime);
		}elseif ($etime > 0){
		    $where['exp_addtime'] = array('elt',$etime);
		}
		$search_desc = trim($_GET['description']);
		$where['exp_desc'] = array('like',"%$search_desc%");
		
		//查询积分日志列表
		$model = Model('exppoints');
		$list_log = $model->getExppointsLogList($where, '*', 20, 0, 'exp_id desc');
		//信息输出
		Tpl::output('stage_arr',$model->getStage());
		Tpl::output('show_page',$model->showpage(2));
		Tpl::output('list_log',$list_log);
		Tpl::showpage('exppoints.log');
	}

	/**
	 * 检验值管理
	 */
	public function addexpOp(){
		if (chksubmit()){
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["member_id"], "require"=>"true", "message"=>"会员信息错误"),
				array("input"=>$_POST["exppointsnum"], "require"=>"true",'validator'=>'Compare','operator'=>' >= ','to'=>1,"message"=>"经验值数必须大于0")
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				showMessage($error,'','','error');
			}
			//查询会员信息
			$obj_member = Model('member');
			$member_id = intval($_POST['member_id']);
			$member_info = $obj_member->getMemberInfo(array('member_id'=>$member_id));

			if (!is_array($member_info) || count($member_info)<=0){
				showMessage("会员信息错误",'index.php?act=exppoints&op=addexp','','error');
			}

			$exppointsnum = intval($_POST['exppointsnum']);
			if ($_POST['operatetype'] == 2 && $exppointsnum > intval($member_info['member_exppoints'])){
				showMessage("减少经验值不能大于会员当前经验值".$member_info['member_exppoints'],'index.php?act=exppoints&op=addexp','','error');
			}

			$obj_points = Model('exppoints');
			$insert_arr['exp_memberid'] = $member_info['member_id'];
			$insert_arr['exp_membername'] = $member_info['member_name'];
			$admininfo = $this->getAdminInfo();
			$insert_arr['exp_adminid'] = $admininfo['id'];
			$insert_arr['exp_adminname'] = $admininfo['name'];
			if ($_POST['operatetype'] == 2){
				$insert_arr['exp_points'] = -$_POST['exppointsnum'];
			}else {
				$insert_arr['exp_points'] = $_POST['exppointsnum'];
			}
			if ($_POST['pointsdesc']){
				$insert_arr['exp_desc'] = trim($_POST['pointsdesc']);
			} else {
				$insert_arr['exp_desc'] = "管理员调节";
			}
			$result = $obj_points->saveExppointsLog('system',$insert_arr);
			if ($result){
				$this->log("经验值调整".$member_info['member_name'].'['.(($_POST['operatetype'] == 2)?'':'+').strval($insert_arr['pl_points']).']',null);
				showMessage("操作成功",'index.php?act=exppoints&op=addexp');
			}else {
				showMessage("操作失败",'index.php?act=exppoints&op=addexp','','error');
			}
		}else{
			Tpl::showpage('exppoints.add');
		}
	}
	public function checkmemberOp(){
		$name = trim($_GET['name']);
		if (!$name){
			echo ''; die;
		}
		/**
		 * 转码
		 */
		if(strtoupper(CHARSET) == 'GBK'){
			$name = Language::getGBK($name);
		}
		$obj_member = Model('member');
		$member_info = $obj_member->getMemberInfo(array('member_name'=>$name));
		if (is_array($member_info) && count($member_info)>0){
			if(strtoupper(CHARSET) == 'GBK'){
				$member_info['member_name'] = Language::getUTF8($member_info['member_name']);
			}
			echo json_encode(array('id'=>$member_info['member_id'],'name'=>$member_info['member_name'],'exppoints'=>$member_info['member_exppoints']));
		}else {
			echo ''; die;
		}
	}
	/**
	 * 积分日志列表导出
	 */
	public function export_step1Op(){
		$where = array();
		$search_mname = trim($_GET['mname']);
		$where['exp_membername'] = array('like',"%{$search_mname}%");
	    if ($_GET['stage']){
			$where['exp_stage'] = trim($_GET['stage']);
		}
		$stime = $_GET['stime']?strtotime($_GET['stime']):0;
		$etime = $_GET['etime']?strtotime($_GET['etime']):0;
		if ($stime > 0 && $etime>0){
		    $where['exp_addtime'] = array('between',array($stime,$etime));
		}elseif ($stime > 0){
		    $where['exp_addtime'] = array('egt',$stime);
		}elseif ($etime > 0){
		    $where['exp_addtime'] = array('elt',$etime);
		}
		$search_desc = trim($_GET['description']);
		$where['exp_desc'] = array('like',"%$search_desc%");
		
		//查询积分日志列表
		$model = Model('exppoints');
		$list_log = $model->getExppointsLogList($where, '*', self::EXPORT_SIZE, 0, 'exp_id desc');
		if (!is_numeric($_GET['curpage'])){
			$count = $model->getExppointsLogCount($where);
			$array = array();
			if ($count > self::EXPORT_SIZE ){	//显示下载链接
				$page = ceil($count/self::EXPORT_SIZE);
				for ($i=1;$i<=$page;$i++){
					$limit1 = ($i-1)*self::EXPORT_SIZE + 1;
					$limit2 = $i*self::EXPORT_SIZE > $count ? $count : $i*self::EXPORT_SIZE;
					$array[$i] = $limit1.' ~ '.$limit2 ;
				}
				Tpl::output('list',$array);				
				Tpl::showpage('export.excel');
			}else{	//如果数量小，直接下载
				$this->createExcel($list_log);
			}
		}else{	//下载
			$this->createExcel($list_log);
		}
	}

	/**
	 * 生成excel
	 *
	 * @param array $data
	 */
	private function createExcel($data = array()){
		import('libraries.excel');
		$excel_obj = new Excel();
		$excel_data = array();
		//设置样式
		$excel_obj->setStyle(array('id'=>'s_title','Font'=>array('FontName'=>'宋体','Size'=>'12','Bold'=>'1')));
		//header
		$excel_data[0][] = array('styleid'=>'s_title','data'=>'会员名称');
		$excel_data[0][] = array('styleid'=>'s_title','data'=>'经验值');
		$excel_data[0][] = array('styleid'=>'s_title','data'=>'添加时间');
		$excel_data[0][] = array('styleid'=>'s_title','data'=>'操作阶段');
		$excel_data[0][] = array('styleid'=>'s_title','data'=>'描述');
		$stage_arr = Model('exppoints')->getStage();
		foreach ((array)$data as $k=>$v){
			$tmp = array();
			$tmp[] = array('data'=>$v['exp_membername']);
			$tmp[] = array('format'=>'Number','data'=>ncPriceFormat($v['exp_points']));
			$tmp[] = array('data'=>date('Y-m-d H:i:s',$v['exp_addtime']));
			$tmp[] = array('data'=>$stage_arr[$v['exp_stage']]);
			$tmp[] = array('data'=>$v['exp_desc']);
			$excel_data[] = $tmp;
		}
		$excel_data = $excel_obj->charset($excel_data,CHARSET);
		$excel_obj->addArray($excel_data);
		$excel_obj->addWorksheet($excel_obj->charset('经验值明细',CHARSET));
		$excel_obj->generateXML($excel_obj->charset('经验值明细',CHARSET).$_GET['curpage'].'-'.date('Y-m-d-H',time()));
	}
}
