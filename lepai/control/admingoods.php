<?php
/**
 * 拍品管理
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');
class adminGoodsControl extends AdminControl{
	/*拍品管理首页*/
	public function indexOp(){
		/*拼装搜索WHERE条件*/
		$search = trim($_GET['search']);		//产品名
		$s_one = trim($_GET['s_one']);			//产品分类
		$s_two = trim($_GET['s_two']);			//产品状态
		$where = $this->goodswhere($search,$s_one,$s_two);
		/*实例拍品数据表*/
		$model = Model('lepai_admin_goods');
		$result = $model->selGoods(''," AND G_Isdel<>1 ".$where);
		/*拍品分类*/
        Tpl::output('lepai_class',$model->goodsClass());
		Tpl::output('result',$result);
		Tpl::output('page',$model->showpage(2));
		Tpl::showpage('goods_index');
	}

	/*拍品编辑*/
	public function upGoodsOp(){
		$id = trim($_GET['gid']);
		/*实例拍品数据表*/
		$model = Model('lepai_admin_goods');
		$result = $model->selGoodsOne($id);
		/*搜索商品属性*/
		$result_info = $model->goodsInfo($id);
		/*搜索商品图片*/
		$result_img = $model->goodsImg($id);


		/*产品属性*/
		$model = Model('lepai_admin_goods');
		Tpl::output('goodsInfo',$model->goodsAttribute());

		Tpl::output('lepai_class',$model->goodsClass());
		Tpl::output('result',$result);//商品数据
		Tpl::output('result_info',$result_info);//商品属性
		Tpl::output('result_img',$result_img);//商品图片
		Tpl::showpage('goods_update');
	}

	/*拍品编辑*/
	public function doUpGoodsOp(){
		$goodsid = $_POST['G_Id'];
		/*实例拍品数据表*/
		$model = Model('lepai_admin_goods');
		/*事务开始*/
		$model->beginTransaction();
		/*验证数据*/
		$this->yzGoodsInfoOp(true);
		/*得到商品详情*/
		$result = $this->getGoodsOp(true);
		/*去掉空数组*/
		foreach($result as $k=>$v){
			if(empty($v)){
				if($v != '0'){
					unset($result[$k]);
				}
			}
		}
		/*修改拍品属性*/
		$model->save($goodsid,$result);
		/*得到商品属性*/
		$info = $this->getGoodsInfoOp($goodsid);
		/*修改商品属性*/
		$model->upGoodsInfo($goodsid,$info);
		/*得到商品图片*/
		$img = $this->goodsImgOp($goodsid,true);
		/*修改商品图片*/
		$model->upGoodsImg($img);
		$model->commit();
		showMessage('操作成功');
	}

	/*AJAX删除商品图片*/
	public function ajaxDelImgOp(){
		$imgid = $_GET['imgid'];
		/*实例拍品数据表*/
		$model = Model('lepai_admin_goods');
		$model->delGoodsImg($imgid);
	}

	/*专场报名*/
	public function add_goodsOp(){
		Tpl::setLayout('kong_layout');
		$id = trim($_GET['themeid']);
		/*实例拍品数据表*/
		/*查出专场信息*/
		$model_theme = Model('lepai_admin_theme');
		$array['where'] = array("T_Shenghe = '1' AND T_Tisheng = '1' AND T_Iswin = '0'",true);
		$result_theme = $model_theme->sel($array);
		Tpl::output('result_theme',$result_theme);
		Tpl::output('page_theme',$model_theme->showpage(2));
		Tpl::output('tgid',$id);
		Tpl::showpage('goods_theme');
	}

	/*回收站*/
	public function collectOp(){
		/*实例拍品数据表*/
		$model = Model('lepai_admin_goods');
		$result = $model->selGoods(''," AND G_Isdel=1 ");
		Tpl::output('result',$result);
		Tpl::output('page',$model->showpage(2));
		Tpl::showpage('goods_collect');
	}

	/*移出回收站*/
	public function moveGoodsOp(){
		/*实例拍品数据表*/
		$id = trim($_GET['id']);
		$model = Model('lepai_admin_goods');
		$model->saveDel($id,"'0'");
		showMessage('操作成功');
	}

	/*专卖报名*/
	public function doThemeGoodsOp(){
		/*专场ID*/
		$tid = $_GET['themeid'];
		/*产品ID*/
		$gid = $_GET['goodsid'];
		/*提交位置*/
		$u = $_GET['u'];
		$y = $_GET['y'];

		/*检测当前专场是否满员*/
		$model_theme = Model('lepai_admin_theme');

		$result = $model_theme->selOne($tid);

		if($result['T_Sum'] <= $result['T_Max']){

			$res_one = $model_theme->table('lepai_admin_theme_do')->where("T_Tid='".$tid."' AND T_Gid='".$gid."'")->find();

			if(!$res_one){


			$dataArr['T_Tid'] = $tid;
			$dataArr['T_Gid'] = $gid;
			$dataArr['T_Sheng'] = '0';
			$dataArr['T_Uid'] = $_SESSION['member_id'];
			$dataArr['T_Time'] = time();
			if($model_theme->addThemeUser($dataArr)){
				/*修改当前产品状态*/
				/*实例拍品数据表*/
				$model = Model('lepai_admin_goods');
				/*修改产品状态*/
				$result = $model->saveOne($gid,'1');
				/*给产品加上专场ID*/
				$result = $model->saveOneT($gid,$tid);

				if($u){
				showMessage('操作成功','index.php?act=adminReport&op=index');
				exit;
				}
				if($y){
				showMessage('操作成功');
				exit;
				}
				showMessage('操作成功','index.php?act=adminGoods&op=index');
				exit;
			}else{
				if($u){
				showMessage('操作失败','index.php?act=adminReport&op=index');
				exit;
				}
				if($y){
				showMessage('操作失败');
				exit;
				}
				showMessage('操作失败','index.php?act=adminGoods&op=index');
				exit;
			}


			}else{
				if($u){
				showMessage('已经报过该专场','index.php?act=adminReport&op=index');
				exit;
				}
				if($y){
				showMessage('已经报过该专场');
				exit;
				}
				showMessage('已经报过该专场','index.php?act=adminGoods&op=index');
				exit;
			}


		}else{

			if($u){
				showMessage('该专场人数已满','index.php?act=adminReport&op=index');
				exit;
				}
				if($y){
				showMessage('该专场人数已满');
				exit;
				}
				showMessage('该专场人数已满','index.php?act=adminGoods&op=index');
				exit;
		}
	}

	/*取消报名*/
	public function delThemeGoodsOp(){
		/*专场ID*/
		$tid = $_GET['themeid'];
		/*产品ID*/
		$gid = $_GET['goodsid'];
		/*提交位置*/
		$u = $_GET['u'];
		/*删除关联专题信息*/
		$model = Model('lepai_admin_theme');
		$model->del($tid,$gid);
		/*更新产品信息*/
		$model_g = Model('lepai_admin_goods');
		$dataArr['G_Tid'] = "0";
		$dataArr['G_Atype'] = "0";
		$model_g->saveGoods($gid,$dataArr);
		/*事务结束、失败回滚*/
		if($u){
				showMessage('操作成功','index.php?act=adminReport&op=index');
			}else{
				showMessage('操作成功','index.php?act=adminGoods&op=index');
		}
	}

	/*拍品发布*/
	public function goods_releaseOp(){
		/*产品属性*/
		$model = Model('lepai_admin_goods');
		Tpl::output('goodsInfo',$model->goodsAttribute());
		Tpl::output('lepai_class',$model->goodsClass());
		Tpl::showpage('goods_release');
	}

	/*拍品发布提交*/
	public function goods_addOp(){
		/*验证数据*/
		$this->yzGoodsInfoOp();
		/*得到商品详情*/
		$result = $this->getGoodsOp();
		/*实例拍品数据表*/
		$model = Model('lepai_admin_goods');
		/*添加拍品数据*/
		$goodsid = $model->add($result);
		/*得到商品属性*/
		$info = $this->getGoodsInfoOp($goodsid);
		/*商品图片*/
		$img = $this->goodsImgOp($goodsid);
		if($goodsid){
			if($model->addInfo($info)){
				/*添加图片*/
				foreach($img as $k => $v){
					$result_img = $model->addImg($v);
				}
				showMessage('操作成功');
			}else{
				showMessage('操作失败');
			}
		}else{
			showMessage('操作失败');
		}
	}


	/*拍品回收站*/
	public function goods_deleteOp(){
		$id = trim($_GET['id']);
		/*收入回收站把相应状态清零*/
		$dataArr['G_Tid'] = '0';
		$dataArr['G_Atype'] = '0';
		$dataArr['G_Isdel'] = '1';
		$model = Model('lepai_admin_goods');
		$model->saveGoods($id,$dataArr);
		showMessage('操作成功');
	}


	/*产品数据验证*/
	private function yzGoodsInfoOp($type=''){
		$obj_validate = new Validate();
		$validate_arr = array();
        $validate_arr[] = array("input"=>$_POST["G_Name"], "require"=>"true", "message"=>'拍品名称不能为空');
        $validate_arr[] = array("input"=>$_POST["G_Class"], "require"=>"true", "message"=>'拍品分类不能为空');
        $validate_arr[] = array("input"=>$_POST["editorValue"], "require"=>"true", "message"=>'拍品描述不能为空');
        $validate_arr[] = array("input"=>$_POST["G_Qipai"], "require"=>"true", "message"=>'起拍价不能为空');
        $validate_arr[] = array("input"=>$_POST["G_IncMoney"], "require"=>"true", "message"=>'加价幅度不能为空');
        $validate_arr[] = array("input"=>$_POST["G_BaoZhenMoney"], "require"=>"true", "message"=>'保证金不能为空');
        $validate_arr[] = array("input"=>$_POST["G_BaoliuMoney"], "require"=>"true", "message"=>'保留价不能为空');
        if(!$type){
        	$validate_arr[] = array("input"=>$_POST["G_MainImg"], "require"=>"true", "message"=>'拍品主图不能为空');
        }
        /*数据进行验证*/
        $obj_validate->validateparam = $validate_arr;
        /*返回错误信息装入数组*/
        $error = $obj_validate->validate();
        /*如果有错误信息则输出、中止程序*/
        if ($error != ''){showMessage($error);exit;}
        /*没有错误继续执行以下程序*/
	}

	/*数据接收*/
	private function getGoodsOp($type=''){
		$dataArr['G_Name'] = $_POST['G_Name'];
		$dataArr['G_Class'] = $_POST['G_Class'];
		$dataArr['G_MainImg'] = $_POST['G_MainImg'];
		$dataArr['G_Content'] = $_POST['editorValue'];
		$dataArr['G_Qipai'] = $_POST['G_Qipai'];
		$dataArr['G_IncMoney'] = $_POST['G_IncMoney'];
		$dataArr['G_BaoZhenMoney'] = $_POST['G_BaoZhenMoney'];
		$dataArr['G_BaoliuMoney'] = $_POST['G_BaoliuMoney'];
		$dataArr['G_Yanchi'] = $_POST['G_Yanchi'];
		$dataArr['G_Time'] = time();
		$dataArr['G_Atype'] = 3; // 默认通过审核 @2017-10-22
		if(!$type){
			$dataArr['G_Uid'] = $_SESSION['member_id'];
		}
		return $dataArr;
	}

	/*产品属性接收*/
	private function getGoodsInfoOp($goodsid){
		switch ($_POST['G_Class']) {
			case '1': //邮币卡数据
				$infoArr['I_GoodsId'] = $goodsid;
				$infoArr['I_Chang'] = $_POST['I_Chang_y'];
				$infoArr['I_Kuan'] = $_POST['I_Kuan_y'];
				$infoArr['I_Hou'] = $_POST['I_Hou_y'];
				$infoArr['I_Zhong'] = $_POST['I_Zhong_y'];
				$infoArr['I_Time'] = time();
				break;
			case '2': //贵金属数据
				$infoArr['I_GoodsId'] = $goodsid;
				$infoArr['I_Chang'] = $_POST['I_Chang_j'];
				$infoArr['I_Kuan'] = $_POST['I_Kuan_j'];
				$infoArr['I_Hou'] = $_POST['I_Hou_j'];
				$infoArr['I_Zhong'] = $_POST['I_Zhong_j'];
				$infoArr['I_Time'] = time();
				break;
			case '3': //书法字画数据
				$infoArr['I_GoodsId'] = $goodsid;
				$infoArr['I_Name'] = $_POST['I_Name_s'];
				$infoArr['I_ZhiCheng'] = $_POST['ZhiCheng'];
				$infoArr['I_Chang'] = $_POST['I_Chang_s'];
				$infoArr['I_Kuan'] = $_POST['I_Kuan_s'];
				$infoArr['I_Hou'] = $_POST['I_Hou_s'];
				$infoArr['I_Zhong'] = $_POST['I_Zhong_s'];
				$infoArr['I_XingZhi'] = $_POST['XingZhi'];
				$infoArr['I_Time'] = time();
				break;
			case '4': //玉器珠宝数据
				$infoArr['I_GoodsId'] = $goodsid;
				$infoArr['I_XingZhi'] = $_POST['Z_XingZhi'];
				$infoArr['I_Time'] = time();
				break;
			case '5': //瓷器紫砂数据
				$infoArr['I_GoodsId'] = $goodsid;
				$infoArr['I_Name'] = $_POST['I_Name_z'];
				$infoArr['I_XingZhi'] = $_POST['C_XingZhi'];
				$infoArr['I_Time'] = time();
				break;
			case '6': //红木文玩杂项数据
				$infoArr['I_GoodsId'] = $goodsid;
				$infoArr['I_Name'] = $_POST['I_Name_h'];
				$infoArr['I_Chang'] = $_POST['I_Chang_h'];
				$infoArr['I_Zhong'] = $_POST['I_Zhong_h'];
				$infoArr['I_Time'] = time();
				break;
		}
		return $infoArr;
	}

	/*产品图册*/
	private function goodsImgOp($goodsid,$up=''){
		if(!$up){
		$img = array(
			'1'=>array(
				'IM_GoodsId' =>$goodsid,
				'IM_Img' => $_POST['G_MainImg'],
				'IM_Type' => '1'
				),
			'2'=>array(
				'IM_GoodsId' =>$goodsid,
				'IM_Img' => $_POST['G_MainImg2'],
				'IM_Type' => '0'
				),
			'3'=>array(
				'IM_GoodsId' =>$goodsid,
				'IM_Img' => $_POST['G_MainImg3'],
				'IM_Type' => '0'
				),
			'4'=>array(
				'IM_GoodsId' =>$goodsid,
				'IM_Img' => $_POST['G_MainImg4'],
				'IM_Type' => '0'
				),
			'5'=>array(
				'IM_GoodsId' =>$goodsid,
				'IM_Img' => $_POST['G_MainImg5'],
				'IM_Type' => '0'
				)
			);
		}else{
			$img = array(
			'1'=>array(
				'IM_Id' =>	$_POST['G_MainImgId'],
				'IM_GoodsId' =>$goodsid,
				'IM_Img' => $_POST['G_MainImg'],
				'IM_Type' => '1'
				),
			'2'=>array(
				'IM_Id' =>	$_POST['G_MainImgId2'],
				'IM_GoodsId' =>$goodsid,
				'IM_Img' => $_POST['G_MainImg2'],
				'IM_Type' => '0'
				),
			'3'=>array(
				'IM_Id' =>	$_POST['G_MainImgId3'],
				'IM_GoodsId' =>$goodsid,
				'IM_Img' => $_POST['G_MainImg3'],
				'IM_Type' => '0'
				),
			'4'=>array(
				'IM_Id' =>	$_POST['G_MainImgId4'],
				'IM_GoodsId' =>$goodsid,
				'IM_Img' => $_POST['G_MainImg4'],
				'IM_Type' => '0'
				),
			'5'=>array(
				'IM_Id' =>	$_POST['G_MainImgId5'],
				'IM_GoodsId' =>$goodsid,
				'IM_Img' => $_POST['G_MainImg5'],
				'IM_Type' => '0'
				)
			);
		}
		foreach($img as $k=>$v){
			if($v['IM_Img'] == ''){
				unset($img[$k]);
			}
		}

		return $img;
	}

	
	/*搜索条件*/
	private function goodswhere($search,$selOne,$selTwo){

		$time = time();

		if($search){
			$where = " AND G_Name like '%".$search."%' ";
		}

		if($selOne){
			$where .= " AND G_Class = '".$selOne."' ";
		}

		switch ($selTwo) {
			case '1':	//已送拍、审核中
				$where .= " AND G_Atype = 1 ";
				break;
			case '2':	//送拍审核未通过
				$where .= " AND G_Atype = 2 ";
				break;
			case '3':	//送拍审核已通过
				$where .= " AND G_Atype = 3 ";
				break;
			case '4':	//正在预展
				$where .= " AND G_Atype = 3 AND ".$time."<(SELECT T_Ktime FROM 33hao_lepai_admin_theme WHERE 33hao_lepai_admin_theme.T_Id=lepai_admin_goods.G_Tid LIMIT 1) ";
				break;
			case '5':	//正在拍卖
				$where .= " AND G_Atype = 3 AND ".$time.">(SELECT T_Ktime FROM 33hao_lepai_admin_theme WHERE 33hao_lepai_admin_theme.T_Id=lepai_admin_goods.G_Tid LIMIT 1) AND ".$time."<(SELECT T_Jtime FROM 33hao_lepai_admin_theme WHERE 33hao_lepai_admin_theme.T_Id=lepai_admin_goods.G_Tid LIMIT 1) ";
				break;
			case '6':	//竞拍成功
				$where .= " AND G_Atype = 6 ";
				break;
			case '7':	//流拍
				$where .= " AND G_Atype = 7 ";
				break;
		}
		return $where;
	}













	
}
