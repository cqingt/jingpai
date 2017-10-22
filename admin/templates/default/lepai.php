<?php
/**
 * 乐拍管理
 ***/

defined('InShopNC') or exit('Access Invalid!');
class lepaiControl extends SystemControl{
    public function __construct() {
        parent::__construct ();
        /*加载字符集*/
        Language::read('goods');
        /*添加作者页面语言包*/
        Language::read('rec_position');


    }

/**
 用户管理
*/

    /**
     * 乐拍管理首页--用户管理
     */
    public function indexOp() {
        $search = trim($_GET['search']);
        if($search){
            $array['where'] = array(" member_name LIKE '%".$search."%' ");
        }
        $model = Model('lepai_admin_goods');
        $result = $model->selUser($array);

        Tpl::output('result_list',$result);
        Tpl::showpage('lepai.index');
    }

    /*允许拍卖*/
    public function onLepaiOp(){
        $id = trim($_GET['id']);
        $type = trim($_GET['type']);
        $model = Model('lepai_admin_goods');
        $model->upUserType($id,$type);
        showMessage('操作成功');
    }

    /*用户添加*/
    public function addUserOp(){
        Language::read('member');
        $id = trim($_GET['themeid']);
        if($id){
        $array['where'] = array(" member_id = '".$id."' ");
        $model = Model('lepai_admin_goods');
        $result = $model->selUser($array,true);
        Tpl::output('result',$result);
        Tpl::output('sel',true);
        }
        Tpl::showpage('lepai.member.add');
    }


    /*用户添加提交*/
    public function doAddUserOp(){
        $lang   = Language::getLangContent();

        $model_member = Model('member');
        $obj_validate = new Validate();
        $obj_validate->validateparam = array(
            array("input"=>$_POST["member_name"], "require"=>"true", "message"=>$lang['member_add_name_null']),
            array("input"=>$_POST["member_passwd"], "require"=>"true", "message"=>'密码不能为空'),
            array("input"=>$_POST["member_email"], "require"=>"true", 'validator'=>'Email', "message"=>$lang['member_edit_valid_email'])
        );
        $error = $obj_validate->validate();
        if ($error != ''){
            showMessage($error);
        }else {
            $insert_array = array();
            $insert_array['member_name']    = trim($_POST['member_name']);
            $insert_array['member_passwd']  = trim($_POST['member_passwd']);
            $insert_array['member_email']   = trim($_POST['member_email']);
            //默认允许举报商品
            $insert_array['inform_allow']   = '1';
            if (!empty($_POST['member_avatar'])){
                $insert_array['member_avatar'] = trim($_POST['member_avatar']);
            }

            $userinfo = $model_member->field('member_id')->where("member_name like '%".$insert_array['member_name']."%'")->find();

            if($userinfo){
                showMessage('该帐户已存在');
            }else{


                $result = $model_member->addMember($insert_array);
                if ($result){
                    $dataArr['member_id'] = $result;
                    $dataArr['member_name'] = trim($_POST['member_name']);
                    $dataArr['company_name'] = trim($_POST['company_name']);
                    $dataArr['contacts_name'] = trim($_POST['contacts_name']);
                    $dataArr['contacts_phone'] = trim($_POST['contacts_phone']);
                    $dataArr['company_address'] = trim($_POST['company_address']);
                    $dataArr['contacts_email'] = trim($_POST['member_email']);
                    $res = $model_member->table('lepai_audit')->insert($dataArr);
                    if($res){
                        showMessage('操作成功');
                    }else{
                        showMessage('操作失败');
                    }
                }else {
                    showMessage('操作失败');
                }
            }






        }



    }


/**
 拍品管理
*/

    /*拍品管理*/
    public function goodsOp(){
        /*拼装搜索WHERE条件*/
        $search = trim($_GET['search']);        //产品名
        $s_one = trim($_GET['s_one']);          //产品分类
        $s_two = trim($_GET['s_two']);          //产品状态
        $where = $this->goodswhere($search,$s_one,$s_two);
        $model = Model('lepai_admin_goods');
        /*搜索所有产品信息*/
        $result = $model->selGoods('admin',$where);
        /*拍品分类*/
        Tpl::output('lepai_class',$model->goodsClass());
        Tpl::output('page',$model->showpage(2));
        Tpl::output('result',$result);

var_dump($result);

        Tpl::showpage('lepai.goods');
    }

    /*拍品删除*/
    public function delGoodsOp(){
        $id = trim($_GET['goodsid']);
        /*实例产品数据*/
        $model = Model('lepai_admin_goods');
        /*删除产品*/
        $model->delGoods($id);
        showMessage('操作成功');
    }

    /*拍品编辑*/
    public function upGoodsOp(){
        $id = trim($_GET['goodsid']);
        /*实例产品数据*/
        $model = Model('lepai_admin_goods');
        $result = $model->selGoodsOne($id);
        /*搜索商品属性*/
        $result_info = $model->goodsInfo($id);
        /*搜索商品图片*/
        $result_img = $model->goodsImg($id);


        /*产品属性*/
        Tpl::output('goodsInfo',$model->goodsAttribute());
        /*拍品分类*/
        Tpl::output('lepai_class',$model->goodsClass());
        Tpl::output('result_info',$result_info);//商品属性
        Tpl::output('result_img',$result_img);//商品图片
        Tpl::output('result',$result);

        Tpl::showpage('lepai.goods.up');
    }

    /*拍品编辑提交*/
    public function doUpGoodsOp(){
        $goodsid = $_POST['G_Id'];
        /*实例拍品数据表*/
        $model = Model('lepai_admin_goods');
        /*验证数据*/
        $this->yzGoodsInfoOp(true);
        /*得到商品详情*/
        $result = $this->getGoodsOp(true);
        /*去掉空数组*/
        foreach($result as $k=>$v){
            if(empty($v)){
                unset($result[$k]);
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
        /*如果修改为拒绝状态、修改当前专题ID、删除关联数据*/
        if($result['G_Atype'] == '2'){
            $model->upGoodsTwo($goodsid);
        }
        showMessage('操作成功');
    }

/**
 专场管理
*/

    /*专场管理*/
    public function themeOp(){
        /*搜索专题*/
        $array = array();
        $search = trim($_GET['search']);
        $selecttype = trim($_GET['select_goods_input']);
        if($search){
            $array['where'] = array(" AND T_Title like '%".$search."%' ");
        }
        $time = time();

            switch ($selecttype) {
                case '1'://未提审
                    $array['where'] = array(" AND T_Tisheng='0' ".$array['where'][0]);
                    break;
                case '2'://审核中
                    $array['where'] = array(" AND T_Iswin='0' AND T_Shenghe='0' AND T_Tisheng='1' ".$array['where'][0]);
                    break;
                case '3'://已通过
                    $array['where'] = array(" AND T_Iswin='0' AND T_Shenghe='1' AND T_Tisheng='1' ".$array['where'][0]);
                    break;
                case '4'://审核未通过
                    $array['where'] = array(" AND T_Iswin='0' AND T_Shenghe='2' AND T_Tisheng='1' ".$array['where'][0]);
                    break;
                case '5'://正在预展
                    $array['where'] = array(" AND T_Ktime>{$time} AND T_Iswin='1' AND T_Shenghe='1' AND T_Tisheng='1' ".$array['where'][0]);
                    break;
                case '6'://正在拍卖
                    $array['where'] = array(" AND T_Ktime<{$time} AND T_Jtime>{$time}  AND T_Iswin='1' AND T_Shenghe='1' AND T_Tisheng='1' ".$array['where'][0]);
                    break;
                case '7'://已结束
                    $array['where'] = array(" AND T_Jtime<{$time} AND T_Iswin='1' AND T_Shenghe='1' AND T_Tisheng='1' ".$array['where'][0]);
                    break;
                default:
                $array['where'] = array("T_Tisheng=1 ".$array['where'][0]);
                    break;
            
        }
        $model = Model('lepai_admin_theme');
        /*搜索所有专场信息*/
        $array['where'] = array(ltrim($array['where']['0'],' AND'),true);
        $result = $model->sel($array);
        Tpl::output('page',$model->showpage(2));
        Tpl::output('result',$result);
        Tpl::showpage('lepai.theme');
    }

    /*创建专场*/
    public function addThemeOp(){
        Tpl::showpage('lepai.theme.add');
    }

    /*专场数据提交*/
    public function doAddThemeOp(){
        $dataArr = $this->theme_info();
        $dataArr['T_Uid'] = $_SESSION['member_id'];
        $dataArr['T_Tisheng'] = '1';
        /*添加数据*/
        $model = Model('lepai_admin_theme');
        /*执行结果*/
        if($model->add($dataArr)){
            showMessage('操作成功');
        }else{
            showMessage('操作失败');
        }
    }


    /*编辑专场*/
    public function upThemeOp(){
        $id = trim($_GET['id']);
        /*添加数据*/
        $model = Model('lepai_admin_theme');
        $result = $model->selOne($id);
        /*加载信息*/
        Tpl::output('result',$result);
        Tpl::showpage('lepai.theme.up');
    }

    /*专场数据提交*/
    public function doUpThemeOp(){
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

    /*删除专场*/
    public function delThemeOp(){
        $id = trim($_GET['themeid']);
        /*实例数据*/
        $model = Model('lepai_admin_theme');
        /*数据操作*/
        $model->delTheme($id);
        showMessage('操作成功');
    }

    /*开启专场*/
    public function pushThemeOp(){
        $id = trim($_GET['themeid']);
        /*实例数据*/
        $model = Model('lepai_admin_theme');
        /*数据操作*/
        $result = $model->pushTheme($id);

        if($result){
            showMessage('操作成功');
        }else{
            showMessage('操作失败，该专题有未通过审核产品！');
        }
    }



/**
 订单管理
*/


    /*订单管理*/
    public function orderOp(){
        /*拼装搜索WHERE条件*/
        $search = trim($_GET['search']);        //产品名
        $s_one = trim($_GET['s_one']);          //产品分类
        $s_two = trim($_GET['s_two']);          //产品状态
        $where = $this->orderwhere($search,$s_one,$s_two);
        $array['where'] = array($where,true);
        $model = Model('lepai_admin_order');
        $result = $model->selOrder($array);
        // vp($result);
        Tpl::output('result_list',$result);
        Tpl::showpage('lepai.order');
    }


    /*订单查看*/
    public function orderInfoOp(){
        $id = trim($_GET['orderid']);

        $express = rkcache('express',true);
        $model = Model('lepai_admin_order');
        $array['where'] = array("order_id='".$id."'",true);
        $result = $model->selOrder($array);
        //收货地址
        $area_info = unserialize($result[0]['reciver_info']);
        //快递公司
        $kuaidi = $model->kuaidi($result[0]['shipping_ecode']);
        Tpl::output('result',$result[0]);
        Tpl::output('kuaidi',$kuaidi);
        Tpl::output('area_info',$area_info['area_info']);
        Tpl::output('express',$express);
        Tpl::showpage('lepai.order.info');
    }



    /*订单发货*/
    public function orderPushOp(){
        $id = trim($_POST['order_id']);
        $array['order_state'] = '30';
        $array['shipping_ecode'] = $_POST['kuaidi'];
        $array['shipping_code'] = $_POST['order_sn'];
        $model = Model('lepai_admin_order');
        if($model->orderPush($id,$array)){
            showMessage('操作成功');
        }else{
            showMessage('操作失败');
        }
    }


/**
 调用方法
*/


    /*验证数据拼装数据*/
    private function theme_info($type){
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
        $validate_arr[] = array("input"=>$_POST["T_Max"], "require"=>"true", "validator"=>"Range", "min"=>"10","max"=>"90" , "message"=>'拍品数量不能小于10件、或大于90件');
        $validate_arr[] = array("input"=>$_POST["T_Ktime"], "require"=>"true", "message"=>'开始时间不能为空');
        $validate_arr[] = array("input"=>$ktime, "require"=>"true", "validator"=>"Range", "min"=>time()+86400*3,"max"=>time()+86400*60 , "message"=>'请选择三天之后为开始时间');
        $validate_arr[] = array("input"=>$_POST["T_Jtime"], "require"=>"true", "message"=>'结束时间不能为空');
        $validate_arr[] = array("input"=>$endtime, "require"=>"true", "validator"=>"Range", "min"=>$ktime,"max"=>$ktime+86400*3, "message"=>'专场时间最长为3天');
        $validate_arr[] = array("input"=>$_POST["T_Content"], "require"=>"true", "message"=>'专卖描述不能为空');
        }else{
        $validate_arr = array();
        $validate_arr[] = array("input"=>$_POST["T_Title"], "require"=>"true", "message"=>'专场标题不能为空');
        $validate_arr[] = array("input"=>$_POST["T_Max"], "require"=>"true", "message"=>'拍品数量不能为空');
        // $validate_arr[] = array("input"=>$_POST["T_Max"], "require"=>"true", "validator"=>"Range", "min"=>"10","max"=>"90" , "message"=>'拍品数量不能小于10件、或大于90件');
        // $validate_arr[] = array("input"=>$_POST["T_Ktime"], "require"=>"true", "message"=>'开始时间不能为空');
        // $validate_arr[] = array("input"=>$ktime, "require"=>"true", "validator"=>"Range", "min"=>time()+86400*3,"max"=>time()+86400*60 , "message"=>'请选择三天之后为开始时间');
        // $validate_arr[] = array("input"=>$_POST["T_Jtime"], "require"=>"true", "message"=>'结束时间不能为空');
        // $validate_arr[] = array("input"=>$endtime, "require"=>"true", "validator"=>"Range", "min"=>$ktime,"max"=>$ktime+86400*3, "message"=>'专场时间最长为3天');
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
        $dataArr['T_Shenghe'] = $_POST['T_Shenghe'];
        $dataArr['T_Lose'] = $_POST['T_Lose'];
        $dataArr['T_Time'] = time();

        foreach($dataArr as $k=>$v){
            if(empty($v)){
                unset($dataArr[$k]);
            }
        }

        return $dataArr;
    }


    /*产品数据验证*/
    private function yzGoodsInfoOp($type=''){
        $obj_validate = new Validate();
        $validate_arr = array();
        $validate_arr[] = array("input"=>$_POST["G_Name"], "require"=>"true", "message"=>'拍品名称不能为空');
        $validate_arr[] = array("input"=>$_POST["G_Class"], "require"=>"true", "message"=>'拍品分类不能为空');
        $validate_arr[] = array("input"=>$_POST["G_Content"], "require"=>"true", "message"=>'拍品描述不能为空');
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
        $dataArr['G_Content'] = $_POST['G_Content'];
        $dataArr['G_Qipai'] = $_POST['G_Qipai'];
        $dataArr['G_IncMoney'] = $_POST['G_IncMoney'];
        $dataArr['G_BaoZhenMoney'] = $_POST['G_BaoZhenMoney'];
        $dataArr['G_BaoliuMoney'] = $_POST['G_BaoliuMoney'];
        $dataArr['G_Yanchi'] = $_POST['G_Yanchi'];
        $dataArr['G_Atype'] = $_POST['G_Atype'];
        $dataArr['G_Lose'] = $_POST['G_Lose'];
        $dataArr['G_Time'] = time();
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
                'IM_Id' =>  $_POST['G_MainImgId'],
                'IM_GoodsId' =>$goodsid,
                'IM_Img' => $_POST['G_MainImg'],
                'IM_Type' => '1'
                ),
            '2'=>array(
                'IM_Id' =>  $_POST['G_MainImgId2'],
                'IM_GoodsId' =>$goodsid,
                'IM_Img' => $_POST['G_MainImg2'],
                'IM_Type' => '0'
                ),
            '3'=>array(
                'IM_Id' =>  $_POST['G_MainImgId3'],
                'IM_GoodsId' =>$goodsid,
                'IM_Img' => $_POST['G_MainImg3'],
                'IM_Type' => '0'
                ),
            '4'=>array(
                'IM_Id' =>  $_POST['G_MainImgId4'],
                'IM_GoodsId' =>$goodsid,
                'IM_Img' => $_POST['G_MainImg4'],
                'IM_Type' => '0'
                ),
            '5'=>array(
                'IM_Id' =>  $_POST['G_MainImgId5'],
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
    private function orderwhere($search,$selOne,$selTwo){

        if(empty($selOne))$selOne='1';
        if($search){
            switch ($selOne) {
            case '1':   //已送拍、审核中
                $where .= " AND order_sn LIKE '%".$search."%'";
                break;
            case '2':   //送拍审核未通过
                $where .= " AND G_Name LIKE '%".$search."%'";
                break;
            }
        }

        switch ($selTwo) {
            case '1':   //未付款
                $where .= " AND order_state = 10 ";
                break;
            case '2':   //已付款
                $where .= " AND order_state = 20 ";
                break;
            case '3':   //已发货
                $where .= " AND order_state = 30 ";
                break;
            case '4':   //已收货
                $where .= " AND order_state = 40 ";
                break;
            case '5':   //已取消
                $where .= " AND order_state = '0' ";
                break;
        }
        return $where;
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
            case '1':   //已送拍、审核中
                $where .= " AND G_Atype = 1 ";
                break;
            case '2':   //送拍审核未通过
                $where .= " AND G_Atype = 2 ";
                break;
            case '3':   //送拍审核已通过
                $where .= " AND G_Atype = 3 ";
                break;
            case '4':   //正在预展
                $where .= " AND G_Atype = 3 AND ".$time."<(SELECT T_Ktime FROM 33hao_lepai_admin_theme WHERE 33hao_lepai_admin_theme.T_Id=lepai_admin_goods.G_Tid LIMIT 1) ";
                break;
            case '5':   //正在拍卖
                $where .= " AND G_Atype = 3 AND ".$time.">(SELECT T_Ktime FROM 33hao_lepai_admin_theme WHERE 33hao_lepai_admin_theme.T_Id=lepai_admin_goods.G_Tid LIMIT 1) AND ".$time."<(SELECT T_Jtime FROM 33hao_lepai_admin_theme WHERE 33hao_lepai_admin_theme.T_Id=lepai_admin_goods.G_Tid LIMIT 1) ";
                break;
            case '6':   //竞拍成功
                $where .= " AND G_Atype = 6 ";
                break;
            case '7':   //流拍
                $where .= " AND G_Atype = 7 ";
                break;
        }
        return $where;
    }


    /*AJAX上传图片*/
    public function ajaxUploadOp(){
        $imgArr = $_FILES;
        //创建上传类
        $upload = new UploadFile();
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

        echo $img_path;

    }


    /*AJAX删除商品图片*/
    public function ajaxDelImgOp(){
        $imgid = $_GET['imgid'];
        /*实例拍品数据表*/
        $model = Model('lepai_admin_goods');
        $model->delGoodsImg($imgid);
    }





}
