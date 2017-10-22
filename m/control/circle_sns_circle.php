<?php
/**
 * 图片空间操作
 ***/


defined('InShopNC') or exit('Access Invalid!');
header('content-type:text/html;charset=utf-8');
class circle_sns_circleControl extends BaseSNSControl {
	public function __construct() {
		parent::__construct();

		$this->get_visitor();	// 获取访客
		define('CIRCLE_TEMPLATES_URL', CIRCLE_SITE_URL.'/templates/'.TPL_NAME);

		$where = array();
		$where['name']	= !empty($this->master_info['member_truename'])?$this->master_info['member_truename']:$this->master_info['member_name'];
		Model('seo')->type('sns')->param($where)->show();

		$this->sns_messageboard();
	}
	/**
	 * index 默认为话题
	 */
	public function indexOp(){
		$this->themeOp();
	}
	/**
	 * 话题
	 */
	public function themeOp(){

		$model = Model();
		$theme_list = $model->table('circle_theme')->where(array('member_id'=>$this->master_id))->page(10)->order('theme_id desc')->select();
		Tpl::output('showpage', $model->showpage('2'));
		Tpl::output('theme_list', $theme_list);
		//输出会员id
		$member_id = $_GET['mid'];
		Tpl::output('members_id', $member_id);

		//查询登陆用户信息
		$member_name = $model->table('circle_member')->find($member_id);
		Tpl::output('member_name', $member_name);

		if(!empty($theme_list)){
			$theme_list = array_under_reset($theme_list, 'theme_id');
			$themeid_array = array(); $circleid_array = array();
			foreach ($theme_list as $val){
				$themeid_array[]	= $val['theme_id'];
				$circleid_array[]	= $val['circle_id'];
			}
			$themeid_array = array_unique($themeid_array);
			$circleid_array = array_unique($circleid_array);
			// 附件
			$affix_list = $model->table('circle_affix')->where(array('affix_type'=>1, 'member_id'=>$this->master_id, 'theme_id'=>array('in', $themeid_array)))->select();
			$affix_list = array_under_reset($affix_list, 'theme_id', 2);
			Tpl::output('affix_list', $affix_list);

			//查询会员信息
			$this->getMemberAndGradeInfo(false);
			$this->master_info = $this->get_member_info();
			Tpl::output('master_info',$this->master_info);
//			echo '<!--';
//			print_r($this->master_info);
//			echo '-->';

		}
		$this->profile_menu('theme');
		Tpl::showpage('circle/me');
	}

	/*
	 *个人访客
	 * */
	public function visitorOp(){

		//查看关注状态
		$mid = $_GET['mid'];
		Tpl::output('mid',$mid);
		Tpl::showpage('circle/jinRiFangWen');
	}

	/*
	 * add name mk
	 * add time 2016-11-09
	 * 个人中心圈子
	 * */
	public function quanziOp(){

		$model = Model();

		$mid = $_GET['mid'];
		Tpl::output('mid', $mid);

		$theme_list = $model->table('circle_theme')->where(array('member_id'=>$mid))->page(10)->order('theme_id desc')->select();
		Tpl::output('showpage', $model->showpage('2'));
		Tpl::output('theme_list', $theme_list);

		if(!empty($theme_list)){
			$theme_list = array_under_reset($theme_list, 'theme_id');
			$themeid_array = array(); $circleid_array = array();
			foreach ($theme_list as $val){
				$themeid_array[]	= $val['theme_id'];
				$circleid_array[]	= $val['circle_id'];
			}
			$themeid_array = array_unique($themeid_array);
			$circleid_array = array_unique($circleid_array);
			// 附件
			$affix_list = $model->table('circle_affix')->where(array('affix_type'=>1, 'member_id'=>$this->master_id, 'theme_id'=>array('in', $themeid_array)))->select();
			$affix_list = array_under_reset($affix_list, 'theme_id', 2);
			Tpl::output('affix_list', $affix_list);
		}
		$this->profile_menu('theme');

	//加入圈子
		$model = Model();
		$cm_list = $model->table('circle_member')->where(array('member_id'=>$this->master_id))->order('cm_jointime desc')->select();
		if(!empty($cm_list)){
			$cm_list = array_under_reset($cm_list, 'circle_id'); $circleid_array = array_keys($cm_list);
			$circle_list = $model->table('circle')->where(array('circle_id'=>array('in', $circleid_array)))->select();
			Tpl::output('circle_list', $circle_list);
		}

		$this->profile_menu('circle');
		Tpl::showpage('circle/quanZi');
	}
	/**
	 * 用户中心右边，小导航
	 *
	 * @param string	$menu_type	导航类型
	 * @param string 	$menu_key	当前导航的menu_key
	 * @return
	 */
	private function profile_menu($menu_key=''){
		$menu_array	= array();

		$theme_menuname = $this->relation==3?L('sns_my_theme'):L('sns_TA_theme');
		$circle_menuname = $this->relation==3?L('sns_my_group'):L('sns_TA_group');
		$menu_array	= array(
			1=>array('menu_key'=>'theme','menu_name'=>$theme_menuname,'menu_url'=>'index.php?act=sns_circle&op=theme&mid='.$this->master_id),
			2=>array('menu_key'=>'circle','menu_name'=>$circle_menuname,'menu_url'=>'index.php?act=sns_circle&op=circle&mid='.$this->master_id),
		);

		Tpl::output('member_menu',$menu_array);
		Tpl::output('menu_key',$menu_key);
	}
}
?>
