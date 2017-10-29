<?php
/**
 * 专场管理
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');
class adminThemeControl extends AdminControl{
	/*专场管理默认首页*/
	public function indexOp(){
		/*搜索专题*/
		$array = array();
		$search = trim($_GET['search']);
		$selecttype = trim($_GET['select_goods_input']);
		if($search){
			$array['where'] = array(" AND T_Title like '%".$search."%' ");
		}
		$time = time();
		if($selecttype){
			switch ($selecttype) {
				case '1'://未提审
					$array['where'] = array(" AND T_Tisheng='0' ".$array['where']);
					break;
				case '2'://审核中
					$array['where'] = array(" AND T_Iswin='0' AND T_Shenghe='0' AND T_Tisheng='1' ".$array['where']);
					break;
				case '3'://已通过
					$array['where'] = array(" AND T_Iswin='0' AND T_Shenghe='1' AND T_Tisheng='1' ".$array['where']);
					break;
				case '4'://审核未通过
					$array['where'] = array(" AND T_Iswin='0' AND T_Shenghe='2' AND T_Tisheng='1' ".$array['where']);
					break;
				case '5'://正在预展
					$array['where'] = array(" AND T_Ktime>{$time} AND T_Iswin='1' AND T_Shenghe='1' AND T_Tisheng='1' ".$array['where']);
					break;
				case '6'://正在拍卖
					$array['where'] = array(" AND T_Ktime<{$time} AND T_Jtime>{$time}  AND T_Iswin='1' AND T_Shenghe='1' AND T_Tisheng='1' ".$array['where']);
					break;
				case '7'://已结束
					$array['where'] = array(" AND T_Jtime<{$time} AND T_Iswin='1' AND T_Shenghe='1' AND T_Tisheng='1' ".$array['where']);
					break;
				default:
					
					break;
			}
		}

		/*创建数据*/
		$model = Model('lepai_admin_theme');
		/*搜索专场*/
		$result = $model->sel($array);
		Tpl::output('page',$model->showpage(2));
		/*加载数据*/
		Tpl::output('result',$result);
		Tpl::showpage('theme_index');
	}



	/*添加拍品*/
	public function add_goodsOp(){
		Tpl::setLayout('kong_layout');
		$id = trim($_GET['themeid']);
		/*实例拍品数据表*/
		$model_g = Model('lepai_admin_goods');
		$result_g = $model_g->selGoods(''," AND G_Isdel<>1 AND G_Atype='3' AND G_Tid = 0");
		//$result_g = $model_g->selGoods(''," AND G_Isdel<>1  AND (G_Atype = '0'  OR G_Atype='2') ");
		Tpl::output('result_g',$result_g);
		Tpl::output('tgid',$id);
		Tpl::output('page_g',$model_g->showpage(2));
		Tpl::showpage('theme_goods');
	}

	

	/*提交审核*/
	public function push_tishengOp(){
		$id = trim($_GET['id']);
		/*创建数据*/
		$model = Model('lepai_admin_theme');
		/*搜索是否达到提交条件*/
		$result = $model->selOne($id);

        /*
		if($result['T_Sum'] < 8){
			showMessage('专题产品小于8件、请添加产品后再提交');
			exit;
		}

		if(time()+60*60*72 >=$result['T_Ktime']){
			showMessage('请选择3天（72小时）之后的时间作为开始时间！');
			exit;
		}*/
		/*提交数据*/
		$dataArr['T_Shenghe'] = "0";
		$dataArr['T_Tisheng'] = "1";
		$model->save($id,$dataArr);
		showMessage('操作成功');
	}

	/*取消提审*/
	public function del_tishengOp(){
		$id = trim($_GET['id']);
		/*创建数据*/
		$model = Model('lepai_admin_theme');
		$dataArr['T_Shenghe'] = "0";
		$dataArr['T_Tisheng'] = "0";
		$model->save($id,$dataArr);
		showMessage('操作成功');
	}



	/*创建专场*/
	public function theme_addOp(){
		Tpl::showpage('theme_add');
	}

	/*专场数据提交*/
	public function do_addOp(){
		$dataArr = $this->theme_info();
		$dataArr['T_Uid'] = $_SESSION['member_id'];
        /*添加数据*/
        $model = Model('lepai_admin_theme');
        /*执行结果*/
        if($model->add($dataArr)){
            showMessage('操作成功');
        }else{
            showMessage('操作失败');
        }
	}

	/*专场修改*/
	public function theme_updateOp(){
		$id = trim($_GET['id']);
		/*添加数据*/
        $model = Model('lepai_admin_theme');
        $result = $model->selOne($id);
		/*加载信息*/
		Tpl::output('result',$result);
		Tpl::showpage('theme_update');
	}

	/*专题修改提交*/
	public function do_updateOp(){
		/*添加数据*/
        $model = Model('lepai_admin_theme');
		$dataArr = $this->theme_info('save');
		/*执行结果*/
        if($model->save($_POST['T_Id'],$dataArr)){
            showMessage('操作成功');
        }else{
            showMessage('操作失败');
        }
	}

	/*专场取消提审*/








	/*验证数据拼装数据*/
	private function theme_info($type=''){
		/*专场开始时间*/
		$ktime = strtotime($_POST['T_Ktime']);
		/*专场结束时间*/
		$endtime = strtotime($_POST['T_Jtime']);
		/*验证数值*/
        $obj_validate = new Validate();
        /*验证返回值在一个数组*/
        if($type=='save'){
		$validate_arr = array();
        $validate_arr[] = array("input"=>$_POST["T_Title"], "require"=>"true", "message"=>'专场标题不能为空');
        $validate_arr[] = array("input"=>$_POST["T_Max"], "require"=>"true", "message"=>'拍品数量不能为空');
        $validate_arr[] = array("input"=>$_POST["T_Max"], "require"=>"true", "validator"=>"Range", "min"=>"1","max"=>"90" , "message"=>'拍品数量不能小于1件、或大于90件');
        $validate_arr[] = array("input"=>$_POST["T_Ktime"], "require"=>"true", "message"=>'开始时间不能为空');
        //$validate_arr[] = array("input"=>$ktime, "require"=>"true", "validator"=>"Range", "min"=>time()+86400*3,"max"=>time()+86400*60 , "message"=>'请选择三天之后为开始时间');
        $validate_arr[] = array("input"=>$_POST["T_Jtime"], "require"=>"true", "message"=>'结束时间不能为空');
        //$validate_arr[] = array("input"=>$endtime, "require"=>"true", "validator"=>"Range", "min"=>$ktime,"max"=>$ktime+86400*3, "message"=>'专场时间最长为3天');
        $validate_arr[] = array("input"=>$_POST["T_Content"], "require"=>"true", "message"=>'专卖描述不能为空');
        }else{
        $validate_arr = array();
        $validate_arr[] = array("input"=>$_POST["T_Title"], "require"=>"true", "message"=>'专场标题不能为空');
        $validate_arr[] = array("input"=>$_POST["T_Max"], "require"=>"true", "message"=>'拍品数量不能为空');
        $validate_arr[] = array("input"=>$_POST["T_Max"], "require"=>"true", "validator"=>"Range", "min"=>"1","max"=>"90" , "message"=>'拍品数量不能小于1件、或大于90件');
        $validate_arr[] = array("input"=>$_POST["T_Ktime"], "require"=>"true", "message"=>'开始时间不能为空');
        //$validate_arr[] = array("input"=>$ktime, "require"=>"true", "validator"=>"Range", "min"=>time()+86400*3,"max"=>time()+86400*60 , "message"=>'请选择三天之后为开始时间');
        $validate_arr[] = array("input"=>$_POST["T_Jtime"], "require"=>"true", "message"=>'结束时间不能为空');
        //$validate_arr[] = array("input"=>$endtime, "require"=>"true", "validator"=>"Range", "min"=>$ktime,"max"=>$ktime+86400*3, "message"=>'专场时间最长为3天');
        $validate_arr[] = array("input"=>$_POST["T_Topimg"], "require"=>"true", "message"=>'banner图不能为空');
        $validate_arr[] = array("input"=>$_POST["T_Bottonimg"], "require"=>"true", "message"=>'首焦图不能为空');
        $validate_arr[] = array("input"=>$_POST["T_Content"], "require"=>"true", "message"=>'专卖描述不能为空');
    	}
        /*数据进行验证*/
        $obj_validate->validateparam = $validate_arr;
        /*返回错误信息装入数组*/
        $error = $obj_validate->validate();
        /*如果有错误信息则输出、中止程序*/
        if ($error != ''){showMessage($error);exit;}
        /*没有错误继续执行以下程序*/

        /*拼接数组存入数据库*/
        $dataArr['T_Title'] = $_POST['T_Title'];
        $dataArr['T_Max'] = $_POST['T_Max'];
        $dataArr['T_Ktime'] = $ktime;
        $dataArr['T_Jtime'] = $endtime;
        $dataArr['T_Topimg'] = $_POST['T_Topimg'];
        $dataArr['T_Bottonimg'] = $_POST['T_Bottonimg'];
        $dataArr['T_Content'] = $_POST['T_Content'];
        $dataArr['T_Time'] = time();

        foreach($dataArr as $k=>$v){
        	if(empty($v)){
        		unset($dataArr[$k]);
        	}
        }

        return $dataArr;
	}


	/*AJAX上传图片*/
	public function ajaxUploadOp(){
		$imgArr = $_FILES;
		//创建上传类
		$upload = new UploadFile();
		$upload->set('max_size',1024);
		//设置上传目录
		$upload->set('default_dir','lepai/');
		$result = $upload->upfile('imgPhonto');
		//生成两张缩略图，宽高分别为 30,300
		$upload->set('thumb_width','30,300');
		$upload->set('thumb_height','30,300');
		//两个缩略图名称后面分别追加 "_tiny","_mid"
		$upload->set('thumb_ext','_30,_300');
		if($result){
		//得到图片上传后的路径
		$img_path = '/data/upload/lepai/'.$upload->file_name;
		}

		echo json_encode($img_path);

	}

	
	
}
