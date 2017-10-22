<?php
/**
 * 活动管理
 * @精灵添加
 * @添加时间：2015年9月25日
 * @功能说明：分类列表页右侧顶部促销信息管理
 ***/

defined('InShopNC') or exit('Access Invalid!');

class promotionControl extends SystemControl{
	
	public static $typeArr = array('热卖推荐','商品精选','新品推荐');

	public function __construct(){
		parent::__construct();
		Language::read('promotion');
		Tpl::output('typeArr',promotionControl::$typeArr);
	}
	/**
	 * 活动列表
	 */
	public function indexOp(){
		$this->promotionOp();
	}
	/**
	 * 活动列表/删除活动
	 */
	public function promotionOp(){
		$promotion	= Model('promotion');
		//条件
		$condition_arr = array();
		//$condition_arr['activity_type'] = '1';//只显示商品活动
		//状态
		if (!empty($_GET['searchstate'])){
			$state = intval($_GET['searchstate'])-1;
			$condition_arr['promotion_state'] = "$state";
			$condition_arr['status'] = 1;
		}
		//标题
		if (!empty($_GET['searchtitle'])){
			$condition_arr['promotion_title'] = $_GET['searchtitle'];
		}
		//展示位置
		$condition_arr['promotion_state'] = intval($_GET['promotion_state']);

		//有效期范围
		if (!empty($_GET['searchstartdate']) && !empty($_GET['searchenddate'])){
			$condition_arr['promotion_daterange']['startdate'] = strtotime($_GET['searchstartdate']);
			$condition_arr['promotion_daterange']['enddate'] = strtotime($_GET['searchenddate']);
            if($condition_arr['promotion_daterange']['enddate'] > 0) {
                $condition_arr['promotion_daterange']['enddate'] += 86400;
            }
		}

		//分类
		if(intval($_GET['promotion3']) > 0) {
            $condition_arr['cate_id'] = $_GET['promotion3'];
        }elseif(intval($_GET['promotion2']) > 0) {
            $condition_arr['cate_id'] = $_GET['promotion2'];
        }elseif(intval($_GET['promotion1']) > 0){
            $condition_arr['cate_id'] = $_GET['promotion1'];
        }
		$condition_arr['order'] = 'promotion_sort asc';
		//活动列表
		$page	= new Page();
		$page->setEachNum(10);
		$page->setStyle('admin');
		$list	= $promotion->getList($condition_arr,$page);
    	$this->getPromotion1(0);

		//输出
		Tpl::output('show_page',$page->show());
		Tpl::output('list',$list);
		Tpl::showpage('promotion.index');
	}

	/**
	 * 新建活动/保存新建活动
	 */
	public function newOp(){
		//新建处理
		if($_POST['form_submit'] != 'ok'){
			$model_class = Model('goods_class');
			$parent_goods_class = $model_class->getTreeClassList(2);//商品分类父类列表，只取到第二级
			if (is_array($parent_goods_class) && !empty($parent_goods_class)){
				foreach ($parent_goods_class as $k => $v){
					$parent_goods_class[$k]['gc_name'] = str_repeat("&nbsp;",$v['deep']*2).$v['gc_name'];
				}
			}
			Tpl::output('parent_goods_class',$parent_goods_class);
			$goods_class = $model_class->getTreeClassList(1);//第一级商品分类
			Tpl::output('goods_class',$goods_class);

			Tpl::showpage('promotion.add');
			exit;
		}

		//提交表单
		$obj_validate = new Validate();
		$validate_arr[] = array("input"=>$_POST["cate_id"],"require"=>"true","message"=>Language::get('promotion_select_goods_null'));
		array("input"=>$_POST["recommend_goods_name"],"require"=>"true","message"=>Language::get('promotion_new_title_null'));
		array("input"=>$_POST["goods_id"],"require"=>"true","message"=>Language::get('promotion_goods_id_null'));
		$validate_arr[] = array("input"=>$_POST["promotion_title"],"require"=>"true","message"=>Language::get('promotion_new_title_null'));
		$validate_arr[] = array("input"=>$_POST["promotion_start_date"],"require"=>"true","message"=>Language::get('promotion_new_startdate_null'));
		$validate_arr[] = array("input"=>$_POST["promotion_end_date"],"require"=>"true",'validator'=>'Compare','operator'=>'>','to'=>"{$_POST['activity_start_date']}","message"=>Language::get('promotion_new_enddate_null'));
		$validate_arr[] = array('input'=>$_POST['promotion_sort'],'require'=>'true','validator'=>'Range','min'=>0,'max'=>255,'message'=>Language::get('promotion_new_sort_error'));
		$obj_validate->validateparam = $validate_arr;
		$error = $obj_validate->validate();
		if ($error != ''){
			showMessage(Language::get('error').$error,'','','error');
		}
		//保存
		$input	= array();
		$input['cate_id']	= trim($_POST['cate_id']);
		$input['cate_name']	= trim($_POST['cate_name']);
		$input['goods_id']	= trim($_POST['goods_id']);
		$input['goods_pic']	= trim($_POST['goods_pic']);
		$input['goods_price']	= trim($_POST['goods_price']);
		$input['market_price']	= trim($_POST['market_price']);
		$input['goods_name']	= trim($_POST['recommend_goods_name']);
		$input['promotion_state']	= intval($_POST['promotion_state']);
		$input['promotion_title']	= trim($_POST['promotion_title']);
		$input['promotion_sort']		= intval(trim($_POST['promotion_sort']));
		$input['promotion_start_date']= strtotime(trim($_POST['promotion_start_date']));
		$input['promotion_end_date']	= strtotime(trim($_POST['promotion_end_date']));

		$input['add_time']	= time();

		$activity	= Model('promotion');
		$result	= $activity->add($input);
		if($result){
			$this->log(L('nc_add,promotion_index').'['.$_POST['promotion_title'].']',null);
			showMessage(Language::get('nc_common_op_succ'),'index.php?act=promotion&op=promotion');
		}else{
			showMessage(Language::get('nc_common_op_fail'));
		}
	}

	/**
	 * 异步修改
	 */
	public function ajaxOp(){
		if(in_array($_GET['branch'],array('promotion_title','promotion_sort'))){
			$activity = Model('promotion');
			$update_array = array();
			switch ($_GET['branch']){
				/**
				 * 活动主题
				 */
				case 'promotion_title':
					if(trim($_GET['value'])=='')exit;
					break;
				/**
				 * 排序
				 */
				case 'promotion_sort':
					if(preg_match('/^\d+$/',trim($_GET['value']))<=0 or intval(trim($_GET['value']))<0 or intval(trim($_GET['value']))>255)exit;
					break;
				default:
						exit;
			}
			$update_array[$_GET['column']] = trim($_GET['value']);
			if($activity->update($update_array,intval($_GET['id'])))
			echo 'true';
		}elseif(in_array($_GET['branch'],array('promotion_detail_sort'))){
			$promotion_detail = Model('promotion');
			$update_array = array();
			switch ($_GET['branch']){
				/**
				 * 排序
				 */
				case 'promotion_detail_sort':
					if(preg_match('/^\d+$/',trim($_GET['value']))<=0 or intval(trim($_GET['value']))<0 or intval(trim($_GET['value']))>255)exit;
					break;
				default:
						exit;
			}
			$update_array[$_GET['column']] = trim($_GET['value']);
			if($promotion_detail->update($update_array,intval($_GET['id'])))
			echo 'true';
		}
	}

	/**
	 * 删除活动
	 */
	public function delOp(){

		$id	= '';
		if(empty($_REQUEST['promotion_id'])){
			showMessage(Language::get('promotion_del_choose_promotion'));
		}
		if(is_array($_POST['promotion_id'])){
			try{
				//删除数据先删除横幅图片，节省空间资源
				foreach ($_POST['promotion_id'] as $v){
					$this->delBanner(intval($v));
				}
			}catch(Exception $e){
				showMessage($e->getMessage());
			}
			$id	= "'".implode("','",$_POST['promotion_id'])."'";
		}else{
			//删除数据先删除横幅图片，节省空间资源
			$this->delBanner(intval($_GET['promotion_id']));
			$id	= intval($_GET['promotion_id']);
		}
		$promotion	= Model('promotion');
		//获取可以删除的数据
		$condition_arr = array();
		
		//$condition_arr['promotion_enddate_greater_or'] = time();//过期
		$condition_arr['p_id'] = $id;
		$promotion_list = $promotion->getList($condition_arr);
		if (empty($promotion_list)){//没有符合条件的活动信息直接返回成功信息
			showMessage(Language::get('nc_common_del_succ'));
		}
		$id_arr = array();
		foreach ($promotion_list as $v){
			$id_arr[] = $v['p_id'];
		}
		$id_new	= "'".implode("','",$id_arr)."'";
		if($promotion->del($id_new)){
			$this->log(L('nc_del,promotion_index').'[ID:'.$id.']',null);
			showMessage(Language::get('nc_common_del_succ'));
		}
		showMessage(Language::get('promotion_del_fail'));
	}

	/**
	 * 编辑活动/保存编辑活动
	 */
	public function editOp(){
		if($_POST['form_submit'] != 'ok'){
			$model_class = Model('goods_class');
			$parent_goods_class = $model_class->getTreeClassList(2);//商品分类父类列表，只取到第二级
			if (is_array($parent_goods_class) && !empty($parent_goods_class)){
				foreach ($parent_goods_class as $k => $v){
					$parent_goods_class[$k]['gc_name'] = str_repeat("&nbsp;",$v['deep']*2).$v['gc_name'];
				}
			}
			Tpl::output('parent_goods_class',$parent_goods_class);
			$goods_class = $model_class->getTreeClassList(1);//第一级商品分类
			Tpl::output('goods_class',$goods_class);

			if(empty($_GET['promotion_id'])){
				showMessage(Language::get('miss_argument'));
			}
			$promotion	= Model('promotion');
			$row	= $promotion->getOneById(intval($_GET['promotion_id']));
			Tpl::output('promotion',$row);
			Tpl::showpage('promotion.edit');
			exit;
		}
		//提交表单
		$obj_validate = new Validate();
		$validate_arr[] = array("input"=>$_POST["cate_id"],"require"=>"true","message"=>Language::get('promotion_select_goods_null'));
		array("input"=>$_POST["recommend_goods_name"],"require"=>"true","message"=>Language::get('promotion_new_title_null'));
		array("input"=>$_POST["goods_id"],"require"=>"true","message"=>Language::get('promotion_goods_id_null'));
		$validate_arr[] = array("input"=>$_POST["promotion_title"],"require"=>"true","message"=>Language::get('promotion_new_title_null'));
		$validate_arr[] = array("input"=>$_POST["promotion_start_date"],"require"=>"true","message"=>Language::get('promotion_new_startdate_null'));
		$validate_arr[] = array("input"=>$_POST["promotion_end_date"],"require"=>"true",'validator'=>'Compare','operator'=>'>','to'=>"{$_POST['activity_start_date']}","message"=>Language::get('promotion_new_enddate_null'));
		$validate_arr[] = array('input'=>$_POST['promotion_sort'],'require'=>'true','validator'=>'Range','min'=>0,'max'=>255,'message'=>Language::get('promotion_new_sort_error'));
		$obj_validate->validateparam = $validate_arr;
		$error = $obj_validate->validate();
		if ($error != ''){
			showMessage(Language::get('error').$error,'','','error');
		}
		//构造更新内容
		$input	= array();
		$input['cate_id']	= trim($_POST['cate_id']);
		$input['cate_name']	= trim($_POST['cate_name']);
		$input['goods_id']	= trim($_POST['goods_id']);
		$input['goods_pic']	= trim($_POST['goods_pic']);
		$input['goods_price']	= trim($_POST['goods_price']);
		$input['market_price']	= trim($_POST['market_price']);
		$input['goods_name']	= trim($_POST['recommend_goods_name']);
		$input['promotion_state']	= intval($_POST['promotion_state']);
		$input['promotion_title']	= trim($_POST['promotion_title']);
		$input['promotion_sort']		= intval(trim($_POST['promotion_sort']));
		$input['promotion_start_date']= strtotime(trim($_POST['promotion_start_date']));
		$input['promotion_end_date']	= strtotime(trim($_POST['promotion_end_date']));

		$activity	= Model('promotion');
		$row	= $activity->getOneById(intval($_POST['promotion_id']));
		$result	= $activity->update($input,intval($_POST['promotion_id']));
		if($result){
			$this->log(L('nc_edit,promotion_index').'[ID:'.$_POST['promotion_id'].']',null);
			showMessage(Language::get('nc_common_save_succ'),'index.php?act=promotion&op=promotion');
		}else{
			showMessage(Language::get('nc_common_save_fail'));
		}
	}

	/**
	 * 活动细节列表
	 */
	public function detailOp(){
		$activity_id = intval($_GET['id']);
		if($activity_id <= 0){
			showMessage(Language::get('miss_argument'));
		}
		//条件
		$condition_arr = array();
		$condition_arr['activity_id'] = $activity_id;
		//审核状态
		if (!empty($_GET['searchstate'])){
			$state = intval($_GET['searchstate'])-1;
			$condition_arr['activity_detail_state'] = "$state";
		}
		//店铺名称
		if (!empty($_GET['searchstore'])){
			$condition_arr['store_name'] = $_GET['searchstore'];
		}
	    //商品名称
		if (!empty($_GET['searchgoods'])){
			$condition_arr['item_name'] = $_GET['searchgoods'];
		}
		$condition_arr['order'] = 'activity_detail.activity_detail_state asc,activity_detail.activity_detail_sort asc';

		$page	= new Page();
		$page->setEachNum(10);
		$page->setStyle('admin');
		$activitydetail_model	= Model('activity_detail');
		$list	= $activitydetail_model->getList($condition_arr,$page);
		//输出到模板
		Tpl::output('show_page',$page->show());
		Tpl::output('list',$list);
		Tpl::showpage('activity_detail.index');
	}

	/**
	 * 活动内容处理
	 */
	public function dealOp(){
		if(empty($_REQUEST['activity_detail_id'])){
			showMessage(Language::get('activity_detail_del_choose_detail'));
		}
		//获取id
		$id	= '';
		if(is_array($_POST['activity_detail_id'])){
			$id	= "'".implode("','",$_POST['activity_detail_id'])."'";
		}else{
			$id	= intval($_GET['activity_detail_id']);
		}
		//创建活动内容对象
		$activity_detail	= Model('activity_detail');
		if($activity_detail->update(array('activity_detail_state'=>intval($_GET['state'])),$id)){
			$this->log(L('nc_edit,activity_index').'[ID:'.$id.']',null);
			showMessage(Language::get('nc_common_op_succ'));
		}else{
			showMessage(Language::get('nc_common_op_fail'));
		}
	}

	/**
	 * 删除活动内容
	 */
	public function del_detailOp(){
		if(empty($_REQUEST['activity_detail_id'])){
			showMessage(Language::get('activity_detail_del_choose_detail'));
		}
		$id	= '';
		if(is_array($_POST['activity_detail_id'])){
			$id	= "'".implode("','",$_POST['activity_detail_id'])."'";
		}else{
			$id	= "'".intval($_GET['activity_detail_id'])."'";
		}
		$activity_detail	= Model('activity_detail');
		//条件
		$condition_arr = array();
		$condition_arr['activity_detail_id_in'] = $id;
		$condition_arr['activity_detail_state_in'] = "'0','2'";//未审核和已拒绝
		if($activity_detail->delList($condition_arr)){
			$this->log(L('nc_del,activity_index_content').'[ID:'.$id.']',null);
			showMessage(Language::get('nc_common_del_succ'));
		}else{
			showMessage(Language::get('nc_common_del_fail'));
		}
	}

	/**
	 * 根据活动编号删除横幅图片
	 *
	 * @param int $id
	 */
	private function delBanner($id){
		$activity	= Model('activity');
		$row	= $activity->getOneById($id);
		//删除图片文件
		@unlink(BASE_UPLOAD_PATH.DS.ATTACH_ACTIVITY.DS.$row['activity_banner']);
	}

  /**
     * 促销信息分类检索  王  20160622
     *
     */
    public function getPromotion1($id=0){
        $promotion1 = Model()->query("SELECT * FROM `shop_goods_class` where gc_parent_id = '{$id}'");
        Tpl::output('promotion1',$promotion1);
    }

    public function getPromotion2Op(){
        $id = isset($_POST['promotion1']) ? $_POST['promotion1'] : '0';
        $str = '<option value=0>请选择</option>';
        if ($id != 0) {
            $promotion1 = Model()->query("SELECT * FROM `shop_goods_class` where gc_parent_id = '{$id}'");
            if($promotion1){
                foreach($promotion1 as $val) {
                    $str .= '<option value='.$val['gc_id'].'>'.$val['gc_name'].'</option>';
                }
            }
        }
        echo $str;
        exit;
    }
    public function getPromotion3Op(){
        $id = isset($_POST['promotion2']) ? $_POST['promotion2'] : '0';
        $str = '<option value=0>请选择</option>';
        if ($id != 0) {
            $promotion2 = Model()->query("SELECT * FROM `shop_goods_class` where gc_parent_id = '{$id}'");
            if($promotion2){
                foreach($promotion2 as $val) {
                    $str .= '<option value='.$val['gc_id'].'>'.$val['gc_name'].'</option>';
                }
            }
        }
        echo $str;
        exit;
    }
}
