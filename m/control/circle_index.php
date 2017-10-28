<?php
/**
 * 圈子首页
 *
 *
 *********************************/

defined('InShopNC') or exit('Access Invalid!');
header('content-type:text/html;charset=utf-8');
class circle_indexControl extends BaseCircleControl{
	public function __construct(){
		Language::read('circle');
		parent::__construct();
	}
	/**
	 * 首页
	 */
	public function indexOp(){
		$model = Model();

		//活动社区  分类下的通过审核的推荐圈子（鉴定专区）
		$HuoDong_List = $model->table('circle')->field('*')->where(array('circle_status'=>1, 'is_recommend'=>1,'class_id'=>7))->order('circle_id desc')->limit(5)->select();
		Tpl::output('HuoDong_List', $HuoDong_List);

		//近期热点
		$ReDian_list = $model->table('circle_theme')->field('*')->where(array('is_closed'=>0, 'is_recommend'=>1))->order('theme_id desc')->limit(6)->select();
		Tpl::output('ReDian_list', $ReDian_list);

		//资讯快递
		$ZhiXun_list = $model->table('circle_theme')->field('*')->where(array('is_closed'=>0, 'is_recommend'=>1))->order('theme_id ASC')->limit(20)->select();

		if($ZhiXun_list){
			// 附件
			$ZhiXun_list = array_under_reset($ZhiXun_list, 'theme_id');
			$themeid_array = array_keys($ZhiXun_list);
			$affix_list = $model->table('circle_affix')->where(array('theme_id'=>array('in', $themeid_array), 'affix_type'=>1))->group('theme_id')->select();
			if(!empty($affix_list)) $affix_list = array_under_reset($affix_list, 'theme_id');
			foreach ($ZhiXun_list as $key=>$val){
				if(isset($affix_list[$val['theme_id']])) $ZhiXun_list[$key]['affix'] = themeImageUrl($affix_list[$val['theme_id']]['affix_filethumb']);
				
			}
		}
		Tpl::output('ZhiXun_list', $ZhiXun_list);
		
		// 热门圈子      **显示3个圈子，按推荐随机排列，推荐不够按成员数主题数降序排列**
		$circle_list = $model->table('circle')->field('*, is_hot*rand() as rand')->where(array('circle_status'=>1, 'is_hot'=>1))->order('circle_mcount desc')->limit(8)->select();
		
		if(!empty($circle_list)){
			$circle_list = array_under_reset($circle_list, 'circle_id');$circleid_array = array_keys($circle_list);
			// 查询圈子最新主题
			$i=1;
			foreach($circle_list as $key=>$val){
				// 最新的两条数据
				$theme_list = $model->table('circle_theme')->where(array('circle_id'=>$val['circle_id'], 'is_closed'=>0))->order('theme_id desc')->limit(2)->select();
				$circle_list[$key]['theme_list'] = $theme_list;
				$circle_list[$key]['i'] = $i;
				$i++;
			}
			Tpl::output('circle_list', $circle_list);
			$now = strtotime(date('Y-m-d',time()));
			// 今天发表的主题
			$nowthemecount_array = $model->table('circle_theme')->field('count(circle_id) as count,circle_id')->group('circle_id')->where(array('theme_addtime'=>array('gt', $now), 'circle_id'=>array('in', $circleid_array), 'is_closed'=>0))->select();
			if(!empty($nowthemecount_array)){
				$nowthemecount_array = array_under_reset($nowthemecount_array, 'circle_id');
				Tpl::output('nowthemecount_array', $nowthemecount_array);
			}

			// 今天新加入的成员
			$nowjoincount_array = $model->table('circle_member')->field('count(circle_id) as count,circle_id')->group('circle_id')->where(array('cm_jointime'=>array('gt', $now), 'circle_id'=>array('in', $circleid_array)))->select();
			if(!empty($nowjoincount_array)){
				$nowjoincount_array = array_under_reset($nowjoincount_array, 'circle_id');
				Tpl::output('nowjoincount_array', $nowjoincount_array);
			}
		}

		// 圈子分类
		$class_list = $model->table('circle_class')->where(array('class_status'=>1, 'is_recommend'=>1))->order('class_sort asc')->select();
		Tpl::output('class_list', $class_list);

		// 推荐圈子
		$rcircle_list = $model->table('circle')->field('*, is_recommend*rand() as rand')->where(array('circle_status'=>1, 'is_recommend'=>1))->order('rand desc')->limit('20')->select();
		Tpl::output('rcircle_list', $rcircle_list);

		// 推荐话题'has_affix'=>1, , is_recommend*rand() as rand
		$theme_list = $model->table('circle_theme')->field('*')->where(array('is_closed'=>0, 'is_recommend'=>1))->order('theme_addtime desc')->limit(6)->select();
		if(!empty($theme_list)){
			$theme_list = array_under_reset($theme_list, 'theme_id'); $themeid_array = array_keys($theme_list);

			// 附件
			$affix_list = $model->table('circle_affix')->where(array('theme_id'=>array('in', $themeid_array), 'affix_type'=>1))->group('theme_id')->select();
			if(!empty($affix_list)) $affix_list = array_under_reset($affix_list, 'theme_id');


			foreach ($theme_list as $key=>$val){
				if(isset($affix_list[$val['theme_id']])) $theme_list[$key]['affix'] = themeImageUrl($affix_list[$val['theme_id']]['affix_filethumb']);
			}

			Tpl::output('theme_list', $theme_list);
		}

		// 商品话题
		$gtheme_list = $model->table('circle_theme')->where(array('has_goods'=>1, 'is_closed'=>0))->order('theme_id desc')->limit(6)->select();
		if(!empty($gtheme_list)){
			$gtheme_list = array_under_reset($gtheme_list, 'theme_id'); $themeid_array = array_keys($gtheme_list);

			// 圈子商品
			$thg_list = $model->table('circle_thg')->where(array('theme_id'=>array('in', $themeid_array), 'reply_id'=>0))->select();
			$thg_list = tidyThemeGoods($thg_list, 'theme_id', 2);
			Tpl::output('thg_list', $thg_list);

			Tpl::output('gtheme_list', $gtheme_list);
		}

		// 明星圈主
		$member_list = $model->table('circle_member')->field('*, is_recommend*rand() as rand')->where(array('is_recommend'=>1))->order('rand desc')->limit(8)->select();
		Tpl::output('member_list', $member_list);

		// 最新话题/热门话题/人气回复
		$this->themeTop();

		// 首页幻灯
//		$loginpic = unserialize(C('circle_loginpic'));
//		Tpl::output('loginpic', $loginpic);


		$model_mb_special = Model('mb_special');
		$data = $model_mb_special->getMbSpecialIndex();
		Tpl::output('no_header',true);
		Tpl::output('adv_list',$data[0]['adv_list']['item']); //获取轮播

//		$this->circleSEO();
		Tpl::showpage('circle/circle_index');
	}
	/**
	 * 创建圈子
	 */
	public function add_groupOp(){
		if($_SESSION['is_login'] != 1){
//			@header('location: '.SHOP_SITE_URL.'/index.php?act=login&ref_url='.getRefUrl());
			showMessage('请先登陆');
		}
		if(!intval(C('circle_iscreate'))){
			showMessage(L('circle_grooup_not_create'), '', '', 'error');
		}

		$model = Model();
		// 在验证
		// 允许创建圈子验证
		$where = array();
		$where['circle_masterid'] = $_SESSION['member_id'];
		$create_count = $model->table('circle')->where($where)->count();
		if(intval($create_count) >= C('circle_createsum')) showDialog(L('circle_create_max_error'));

		// 允许加入圈子验证
		$where = array();
		$where['member_id']	= $_SESSION['member_id'];
		$join_count = $model->table('circle_member')->where($where)->count();
		if(intval($join_count) >= C('circle_joinsum')) showDialog(L('circle_join_max_error'));

		if($_POST){
			/**
			 * 验证
			 */
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
					array("input"=>$_POST["c_name"], "require"=>"true", "message"=>L('circle_name_not_null'))
			);
			$error = $obj_validate->validate();
			if($error != ''){
				showMessage($error);
			}else{
				$insert = array();
				$insert['circle_name']			= $_POST['c_name'];
				$insert['circle_masterid']		= $_SESSION['member_id'];
				$insert['circle_mastername']	= $_SESSION['member_name'];
				$insert['circle_desc']			= $_POST['c_desc'];
				$insert['circle_tag']			= $_POST['c_tag'];
				$insert['circle_pursuereason']	= $_POST['c_pursuereason'];
				$insert['circle_status']		= 2;
				$insert['is_recommend']			= 0;
				$insert['class_id']				= intval($_POST['class_id']);
				$insert['circle_addtime']		= time();
				$insert['circle_mcount']		= 1;
				$result = $model->table('circle')->insert($insert);
				if($result){
					// Membership level information
					$data = rkcache('circle_level') ? rkcache('circle_level') : rkcache('circle_level', true);

					// 把圈主信息加入圈子会员表
					$insert = array();
					$insert['member_id']	= $_SESSION['member_id'];
					$insert['circle_id']	= $result;
					$insert['circle_name']	= $_POST['c_name'];
					$insert['member_name']	= $_SESSION['member_name'];
					$insert['cm_applytime']	= $insert['cm_jointime'] = time();
					$insert['cm_state']		= 1;
					$insert['cm_level']		= $data[1]['mld_id'];
					$insert['cm_levelname']	= $data[1]['mld_name'];
					$insert['cm_exp']		= 1;
					$insert['cm_nextexp']	= $data[2]['mld_exp'];
					$insert['is_identity']	= 1;
					$insert['cm_lastspeaktime'] = '';
					$model->table('circle_member')->insert($insert);
					showMessage('创建成功',"index.php?act=circle_group&c_id=$result");
				}else{
					showMessage('创建失败');
				}
			}
		}
		Tpl::output('create_count', $create_count);
		Tpl::output('join_count', $join_count);

		// 圈子分类
		$class_list = $model->table('circle_class')->where(array('class_status'=>1))->order('class_sort asc')->select();
		Tpl::output('class_list', $class_list);

		$this->circleSEO(L('circle_create'));
		Tpl::showpage('circle/quanzichuangjian');
	}
	/**
	 * 我加入的圈子
	 */
	public function myjoinedcircleOp(){
		$model = Model('circle_member');

		$cm_list = $model->getCircleMemberList(array('member_id'=>$_SESSION['member_id'], 'circle_id' => array('neq', 0)),'circle_id,circle_name,is_identity', 0, 'is_identity asc');
		if (empty($cm_list)) {
			echo false;die;
		}
		if (strtoupper(CHARSET) == 'GBK'){
		    $cm_list = Language::getUTF8($cm_list);
		}
		echo json_encode($cm_list);
	}
	/**
	 * 圈子名称验证
	 */
	public function check_circle_nameOp(){
		$name = $_GET['name'];
		if (strtoupper(CHARSET) == 'GBK'){
			$name = Language::getGBK($name);
		}
		$rs = Model()->table('circle')->where(array('circle_name'=>$name))->find();
		if (!empty($rs)){
			echo 'false';
		}else{
			echo 'true';
		}
	}

	/**
	 * ajax加载分页
	 */
	public function ajax_pageOp(){
		$circle_theme = Model('circle_theme');
		$page = 6;
		$cir_count = $circle_theme->where(array('is_closed'=>0, 'is_recommend'=>1))->count();
		$countpage = ceil($cir_count/$page);
		$curpage = intval($_GET['curpage']);
		if($curpage > $countpage){
			exit;
		}
		//资讯快递
		$ZhiXun_list = $circle_theme->field('*')->where(array('is_closed'=>0, 'is_recommend'=>1))->order('theme_id ASC')->page($page)->select();
		
		if($ZhiXun_list){
			// 附件
			$ZhiXun_list = array_under_reset($ZhiXun_list, 'theme_id');
			$themeid_array = array_keys($ZhiXun_list);
			$affix_list = $circle_theme->table('circle_affix')->where(array('theme_id'=>array('in', $themeid_array), 'affix_type'=>1))->group('theme_id')->select();
			$str = '';
			if(!empty($affix_list)) $affix_list = array_under_reset($affix_list, 'theme_id');
			foreach ($ZhiXun_list as $key=>$val){
				$affix = '';
				if(isset($affix_list[$val['theme_id']])) $affix = themeImageUrl($affix_list[$val['theme_id']]['affix_filethumb']);
				$af = '';
				$str .= '<li>';
				if($affix){
					$af = '<a class="eximg" href="'.CIRCLE_SITE_URL.'/index.php?act=theme&op=theme_detail&c_id='.$val['circle_id'].'&t_id='.$val['theme_id'].'" target="_blank" title="'.$val['theme_name'].'"><img src="'.$affix.'"/></a>';
				}
				$str .= $af.'<div class="word"><a href="'.CIRCLE_SITE_URL.'/index.php?act=theme&op=theme_detail&c_id='.$val['circle_id'].'&t_id='.$val['theme_id'].'" target="_blank"><h2>'.$val['theme_name'].'</h2><p>'.ubb($val['theme_content']).'</p></a><span><i>'.$val['member_name'].'</i><em>'.date("m:d",$val['theme_addtime']).'</em><strong>阅读（'.$val['theme_browsecount'].'）</strong></span></div>';
				
				$str .= '</li>';
			}
		}
		
		echo $str;
		exit;
	}
}