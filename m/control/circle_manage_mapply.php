<?php
/**
 * 圈子首页
 *
 *
 *********************************/

defined('InShopNC') or exit('Access Invalid!');

class circle_manage_mapplyControl extends BaseCircleManageControl{
	public function __construct(){
		parent::__construct();
		Language::read('circle');
		$this->circleSEO();
	}
	/**
	 * Apply to be a management
	 */
	public function indexOp(){
		// Circle information
		$this->circleInfo();
		// Membership information
		$this->circleMemberInfo();
		// Members to join the circle list
		$this->memberJoinCircle();

		$model = Model();
		$mapply_list = $model->table('circle_mapply')->where(array('circle_id'=>$this->c_id))->page(10)->order('mapply_id desc')->select();
		if(!empty($mapply_list)){
			$memberid_array = array();
			$mapply_array	= array();
			foreach ($mapply_list as $val){
				$memberid_array[]	= $val['member_id'];
				$mapply_array[$val['member_id']]	= $val;
			}
			$member_list = $model->table('circle_member')->field('cm_level,cm_levelname,member_id,member_name')->where(array('circle_id'=>$this->c_id, 'member_id'=>array('in', $memberid_array)))->select();
			$mapply_list = array();
			if (!empty($member_list)){
				foreach ($member_list as $val){
					$mapply_list[$val['member_id']] = array_merge($val, $mapply_array[$val['member_id']]);
				}
			}
			Tpl::output('mapply_list', $mapply_list);
			Tpl::output('mapply_list', $mapply_list);
			Tpl::output('show_page', $model->showpage(2));
		}

		$this->sidebar_menu('managerapply');
		//输出圈信息
		Tpl::output('circle_info', $this->circle_info);

		//会员信息
		Tpl::output('identity', $this->identity);
		Tpl::output('cm_info', $this->cm_info);

	//		Tpl::showpage('group_manage_mapply');
		Tpl::showpage('circle/ziXunHuoDong4-5');
	}
	/**
	 * Management application approved 管理通过
	 */
	public function mapply_passOp(){
		// Verify the identity
		$rs = $this->checkIdentity('c');
		if(!empty($rs)){
			showDialog($rs);
		}

		$cmid_array = explode(',', $_GET['cm_id']);
		foreach ($cmid_array as $key=>$val){
			if(!is_numeric($val)) unset($cmid_array[$key]);
		}
		if(empty($cmid_array)){
			showDialog(L('wrong_argument'));
		}
		$model = Model();
		// Calculate number allows you to add administrator
		$manage_count = $model->table('circle_member')->where(array('circle_id'=>$this->c_id, 'is_identity'=>2))->count();
		$i = intval(C('circle_managesum')) - intval($manage_count);
		$cmid_array	= array_slice($cmid_array, 0, $i);

		// conditions
		$where = array();
		$where['member_id'] = array('in', $cmid_array);
		$where['circle_id'] = $this->c_id;

		// Update the data
		$update = array();
		$update['is_identity'] = 2;
		$model->table('circle_member')->where($where)->update($update);

		// Delete already through application information
		$model->table('circle_mapply')->where($where)->delete();

		// Update the application for membership
		$count = $model->table('circle_mapply')->where(array('circle_id'=>$this->c_id))->count();
		$model->table('circle')->update(array('circle_id'=>$this->c_id, 'new_mapplycount'=>$count));

//		showDialog(L('nc_common_op_succ'), 'reload', 'succ');
		showMessage('通过');

	}
	/**
	 * Management application to delete
	 */
	public function delOp(){
		// Verify the identity
		$rs = $this->checkIdentity('c');
		if(!empty($rs)){
			showDialog($rs);
		}

		$cmid_array = explode(',', $_GET['cm_id']);
		foreach ($cmid_array as $key=>$val){
			if(!is_numeric($val)) unset($cmid_array[$key]);
		}
		if(empty($cmid_array)){
			showDialog(L('wrong_argument'));
		}

		$model = Model();
		// conditions
		$where = array();
		$where['circle_id']	= $this->c_id;
		$where['member_id'] = array('in', $cmid_array);

		// Delete the information
		$model->table('circle_mapply')->where($where)->delete();

		// Update the application for membership
		$count = $model->table('circle_mapply')->where(array('circle_id'=>$this->c_id))->count();
		$model->table('circle')->update(array('circle_id'=>$this->c_id, 'new_mapplycount'=>$count));

//		showDialog(L('nc_common_op_succ'), 'reload', 'succ');
		showMessage('删除成功');
	}
}
