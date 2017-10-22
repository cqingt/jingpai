<?php
/**
 * IOS APP数据 V1 版
 * 
 * @package    
 */
defined('InShopNC') or exit('Access Invalid!');

Class app_ios_v1{


	/**
     * 首页数据
     */
	public static function getAppHomeData($param = ''){


		// 首页轮播图
		$model_mb_special = Model('mb_special'); 
        $result_data = $model_mb_special->getMbSpecialIndex();
        $home_images = $result_data[0]['adv_list']['item'];


        $dataArr = array();
        $dataArr['code'] = 10000;
		$dataArr['message'] = 'success';

        foreach ($home_images as $k => $v) {
        	$dataArr['data']['firstSection'][$k]['imageUrl'] = str_replace('images.96567.com/','www.96567.com/data/',$v['image']);
        	$dataArr['data']['firstSection'][$k]['linkUrl'] = html_entity_decode($v['data']);
        }

        // 导航页面
        $dataArr['data']['secondSection']['0']['functionIndex'] = '1';
        $dataArr['data']['secondSection']['0']['linkUrl'] = 'http://m.96567.com/index.php?act=lepai&op=index';

        $dataArr['data']['secondSection']['1']['functionIndex'] = '2';
        $dataArr['data']['secondSection']['1']['linkUrl'] = 'http://m.96567.com/index.php?act=vip&op=index';

        $dataArr['data']['secondSection']['2']['functionIndex'] = '3';
        $dataArr['data']['secondSection']['2']['linkUrl'] = 'http://m.96567.com/index.php?act=group_buy&op=index';

        $dataArr['data']['secondSection']['3']['functionIndex'] = '4';
        $dataArr['data']['secondSection']['3']['linkUrl'] = 'http://m.96567.com/scxy.html';

        $dataArr['data']['secondSection']['4']['functionIndex'] = '5';
        $dataArr['data']['secondSection']['4']['linkUrl'] = 'http://m.96567.com/index.php?act=zhuanti&op=ad_20160405';


        // 掌上秒杀
		$miaosha_classes = Model('miaosha_class')->getList(array('order'=>' start_hour asc '));
        $new_classes = array();
        foreach($miaosha_classes as $k=>$v){
            $new_classes[$v['class_id']] = $v;
        }
		$miaosha_list = Model('miaosha')->getMiaoshaCommendedList(3);


		$dataArr['data']['thirdSection']['sectionName'] = '掌上秒杀';
		$dataArr['data']['thirdSection']['endTime'] = date('Y-m-d H:m:s z',$miaosha_list['0']['end_time']);
		$dataArr['data']['thirdSection']['clickMore'] = 'http://m.96567.com/index.php?act=miaosha&op=index_list';

		foreach($miaosha_list as $k=>$v){
			$dataArr['data']['thirdSection']['goodses'][$k]['goodsIndex'] = $k+1;
			$dataArr['data']['thirdSection']['goodses'][$k]['goodsImageUrl'] = str_replace('images.96567.com/','www.96567.com/data/',$v['goods_image']);
			$dataArr['data']['thirdSection']['goodses'][$k]['price'] = $v['miaosha_price'];
			$dataArr['data']['thirdSection']['goodses'][$k]['obsoletePrice'] = $v['goods_price'];
			$dataArr['data']['thirdSection']['goodses'][$k]['goodsLinkUrl'] = 'http://m.96567.com/index.php?act=goods&op=index&goods_id='.$v['goods_id'];
		}

		// 0元起拍
		$lepai_item =  Model('lepai_home')->getGoodsInfoLimit(array('G_EndTime'=>array('gt',TIMESTAMP)),1);
		$lepai_item[0]['T_Click'] = Model('lepai_home')->getGoodsSum(array('G_Id'=>$lepai_item[0]['G_Id']),'G_Click');
        $lepai_item[0]['chujia_count'] = Model('lepai_home')->getGoodsSum(array('G_Id'=>$lepai_item[0]['G_Id']),'pai_count');


        $dataArr['data']['fourthSection']['sectionName'] = '0元起拍';
        $dataArr['data']['fourthSection']['goodses']['0']['goodsIndex'] = 1;
        $dataArr['data']['fourthSection']['goodses']['0']['goodsImageUrl'] = str_replace('/data','http://www.96567.com/data',$lepai_item['0']['G_MainImg']);
        $dataArr['data']['fourthSection']['goodses']['0']['goodsLinkUrl'] = 'http://m.96567.com/index.php?act=lepai&op=index';
        $dataArr['data']['fourthSection']['goodses']['0']['goodsName'] = $lepai_item['0']['G_Name'];
        $dataArr['data']['fourthSection']['goodses']['0']['price'] = $lepai_item['0']['new_price'];
        $dataArr['data']['fourthSection']['goodses']['0']['bidCount'] = $lepai_item['0']['chujia_count'];
        $dataArr['data']['fourthSection']['goodses']['0']['endTime'] = date('Y-m-d H:m:s z',$lepai_item['0']['G_EndTime']);


		// 新品上市
        $dataArr['data']['fifthSection']['sectionName'] = '新品上市';
        $dataArr['data']['fifthSection']['goodses']['0']['goodsIndex'] = 1;
        $dataArr['data']['fifthSection']['goodses']['0']['goodsImageUrl'] = str_replace('images.96567.com/','www.96567.com/data/',$result_data[1]['home2']['square_image']);
        $dataArr['data']['fifthSection']['goodses']['0']['goodsLinkUrl'] = 'http://m.96567.com/index.php?act=goods&op=index&goods_id='.$result_data[1]['home2']['square_data'];

        $dataArr['data']['fifthSection']['goodses']['1']['goodsIndex'] = 2;
        $dataArr['data']['fifthSection']['goodses']['1']['goodsImageUrl'] = str_replace('images.96567.com/','www.96567.com/data/',$result_data[1]['home2']['rectangle1_image']);
        $dataArr['data']['fifthSection']['goodses']['1']['goodsLinkUrl'] = 'http://m.96567.com/index.php?act=goods&op=index&goods_id='.$result_data[1]['home2']['rectangle1_data'];

        $dataArr['data']['fifthSection']['goodses']['2']['goodsIndex'] = 3;
        $dataArr['data']['fifthSection']['goodses']['2']['goodsImageUrl'] = str_replace('images.96567.com/','www.96567.com/data/',$result_data[1]['home2']['rectangle2_image']);
        $dataArr['data']['fifthSection']['goodses']['2']['goodsLinkUrl'] = 'http://m.96567.com/index.php?act=goods&op=index&goods_id='.$result_data[1]['home2']['rectangle2_data'];



		// 超值购

        $dataArr['data']['sixthSection']['sectionName'] = '超值购';
        $dataArr['data']['sixthSection']['goodses']['0']['goodsIndex'] = 1;
        $dataArr['data']['sixthSection']['goodses']['0']['goodsImageUrl'] = str_replace('images.96567.com/','www.96567.com/data/',$result_data[2]['home4']['rectangle1_image']);
        $dataArr['data']['sixthSection']['goodses']['0']['goodsLinkUrl'] = 'http://m.96567.com/index.php?act=goods&op=index&goods_id='.$result_data[2]['home4']['rectangle1_data'];

        $dataArr['data']['sixthSection']['goodses']['1']['goodsIndex'] = 2;
        $dataArr['data']['sixthSection']['goodses']['1']['goodsImageUrl'] = str_replace('images.96567.com/','www.96567.com/data/',$result_data[2]['home4']['rectangle2_image']);
        $dataArr['data']['sixthSection']['goodses']['1']['goodsLinkUrl'] = 'http://m.96567.com/index.php?act=goods&op=index&goods_id='.$result_data[2]['home4']['rectangle2_data'];

        $dataArr['data']['sixthSection']['goodses']['2']['goodsIndex'] = 3;
        $dataArr['data']['sixthSection']['goodses']['2']['goodsImageUrl'] = str_replace('images.96567.com/','www.96567.com/data/',$result_data[2]['home4']['square_image']);
        $dataArr['data']['sixthSection']['goodses']['2']['goodsLinkUrl'] = 'http://m.96567.com/index.php?act=goods&op=index&goods_id='.$result_data[2]['home4']['square_data'];


		// 热门活动


		$dataArr['data']['seventhSection']['sectionName'] = '热门活动';
        $dataArr['data']['seventhSection']['goodses']['0']['goodsIndex'] = 1;
        $dataArr['data']['seventhSection']['goodses']['0']['goodsImageUrl'] = str_replace('images.96567.com/','www.96567.com/data/',$result_data[3]['home2']['square_image']);
        $dataArr['data']['seventhSection']['goodses']['0']['goodsLinkUrl'] = 'http://m.96567.com/index.php?act=goods&op=index&goods_id='.$result_data[3]['home2']['square_data'];

        $dataArr['data']['seventhSection']['goodses']['1']['goodsIndex'] = 2;
        $dataArr['data']['seventhSection']['goodses']['1']['goodsImageUrl'] = str_replace('images.96567.com/','www.96567.com/data/',$result_data[3]['home2']['rectangle1_image']);
        $dataArr['data']['seventhSection']['goodses']['1']['goodsLinkUrl'] = html_entity_decode($result_data[3]['home2']['rectangle1_data']);

        $dataArr['data']['seventhSection']['goodses']['2']['goodsIndex'] = 3;
        $dataArr['data']['seventhSection']['goodses']['2']['goodsImageUrl'] = str_replace('images.96567.com/','www.96567.com/data/',$result_data[3]['home2']['rectangle2_image']);
        $dataArr['data']['seventhSection']['goodses']['2']['goodsLinkUrl'] = 'http://m.96567.com/index.php?act=goods&op=index&goods_id='.$result_data[3]['home2']['rectangle2_data'];


		// 值得购买

        $dataArr['data']['eighthSection']['sectionName'] = '值得购买';



        foreach($result_data[5]['goods']['item'] as $k=>$v){
			$dataArr['data']['eighthSection']['goodses'][$k]['goodsIndex'] = $k+1;
			$dataArr['data']['eighthSection']['goodses'][$k]['goodsImageUrl'] = str_replace('images.96567.com/','www.96567.com/data/',$v['goods_image']);
            $dataArr['data']['eighthSection']['goodses'][$k]['goodsName'] = $v['goods_name'];
			$dataArr['data']['eighthSection']['goodses'][$k]['price'] = $v['goods_price'];
			// $dataArr['data']['eighthSection']['goodses'][$k]['obsoletePrice'] = $v['goods_promotion_price'];
			$dataArr['data']['eighthSection']['goodses'][$k]['goodsLinkUrl'] = 'http://m.96567.com/index.php?act=goods&op=index&goods_id='.$v['goods_id'];
		}


        // 首页广告
        $getadvImg = getadvImg(1080);

        $dataArr['data']['advSection']['sectionName'] = '首页广告';
        $dataArr['data']['advSection']['advImages']['0']['advIndex'] = 1;
        $dataArr['data']['advSection']['advImages']['0']['advImageUrl'] = str_replace('images.96567.com/','www.96567.com/data/',$getadvImg['Img']);
        $dataArr['data']['advSection']['advImages']['0']['advLinkUrl'] = html_entity_decode($getadvImg['Href']);


        return json_encode($dataArr,JSON_HEX_AMP);
	}



    /**
     * 用户登陆
     */
    public static function userLogin($param = ''){
        
        if(empty($param['param_name'])){
            $msg['code'] = 10011;
            $msg['message'] = 'error';
            $msg['reason'] = '用户名不能为空！';
            echo json_encode($msg);
            exit;
        }

        if(empty($param['param_pass'])){
            $msg['code'] = 10012;
            $msg['message'] = 'error';
            $msg['reason'] = '密码不能为空！';
            echo json_encode($msg);
            exit;
        }


        if(preg_match("/1[34578]{1}\d{9}$/",$param['param_name'])){
            $logintype='mobile';
        }else{
            $logintype='username';
        }

        $model_member   = Model('member');

        $salt_where = array();

        if($logintype == 'mobile'){
            $salt_where['member_mobile'] = $param['param_name'];
        }else{
            $salt_where['member_name'] = $param['param_name'];
        }

        $is_salt = $model_member->getMemberInfo($salt_where,'ec_salt');

        if(empty($is_salt)){
            $msg['code'] = 10013;
            $msg['message'] = 'error';
            $msg['reason'] = '没有该帐户！';
            echo json_encode($msg);
            exit;
        }


        $array  = array();

        if($logintype == 'mobile'){
            $array['member_mobile'] = $param['param_name'];
        }else{
            $array['member_name']   = $param['param_name'];
        }


        if($is_salt['ec_salt'] != 0 || !empty($is_salt['ec_salt'])){
            $array['member_passwd'] = md5($param['param_pass'].$is_salt['ec_salt']);
        }else{
            $array['member_passwd'] = $param['param_pass'];
        }

        $member_info = $model_member->getMemberInfo($array);

        if(empty($member_info)){
            $msg['code'] = 10014;
            $msg['message'] = 'error';
            $msg['reason'] = '帐户密码错误！';
            echo json_encode($msg);
            exit;
        }

        $dataArr['is_login']   = '1';
        $dataArr['member_id']  = $member_info['member_id'];
        $dataArr['member_name']= $member_info['member_name'];
        $dataArr['member_email']= $member_info['member_email']?$member_info['member_email']:'';
        $dataArr['is_buy']     = isset($member_info['is_buy']) ? $member_info['is_buy'] : 1;
        $dataArr['avatar']     = $member_info['member_avatar']?$member_info['member_avatar']:'';

        $seller_info = Model('seller')->getSellerInfo(array('member_id'=>$member_info['member_id']));
        $dataArr['store_id'] = $seller_info['store_id']?$seller_info['store_id']:'';

        $member_gradeinfo = $model_member->getOneMemberGrade(intval($member_info['member_exppoints']));
        $dataArr['level']  = strval($member_gradeinfo['level']);
        
        // //添加会员积分
        // $model_member->addPoint($member_info);
        // //添加会员经验值
        // $model_member->addExppoint($member_info);


        if(!empty($member_info['member_login_time'])) {
            $update_info    = array(
                'member_login_num'=> ($member_info['member_login_num']+1),
                'member_login_time'=> TIMESTAMP,
                'member_old_login_time'=> $member_info['member_login_time'],
                'member_login_ip'=> getIp(),
                'member_old_login_ip'=> $member_info['member_login_ip']
            );
            $model_member->editMember(array('member_id'=>$member_info['member_id']),$update_info);
        }

        $_SESSION['is_login'] = $dataArr['is_login'];
        $_SESSION['member_id']  = $dataArr['member_id'];
        $_SESSION['member_name']= $dataArr['member_name'];
        $_SESSION['member_email']= $dataArr['member_email'];
        $_SESSION['is_buy']     = $dataArr['is_buy'];
        $_SESSION['avatar']     = $dataArr['avatar'];
        $_SESSION['store_id']     = $dataArr['store_id'];
        $_SESSION['level']     = $dataArr['level'];

        $resultArr = array();
        $resultArr['code'] = 10000;
        $resultArr['message'] = 'success';
        $resultArr['data'] = $dataArr;

        return json_encode($resultArr);
    }


    /**
     * 获取注册手机验证码
     */
    public static function registerVerification($param = ''){
        if(empty($param['param_mobile'])){
            $msg['code'] = 10031;
            $msg['message'] = 'error';
            $msg['reason'] = '手机号不能为空！';
            echo json_encode($msg);
            exit;
        }

        if(!preg_match("/1[34578]{1}\d{9}$/",$param['param_mobile'])){
            $msg['code'] = 10032;
            $msg['message'] = 'error';
            $msg['reason'] = '手机号格式不正确！';
            echo json_encode($msg);
            exit;
        }

        $sms = new Sms();

        $value = mt_rand(1111,9999);

        $result = $sms->send($param['param_mobile'],$value);

        if(!$result){
            $msg['code'] = 10033;
            $msg['message'] = 'error';
            $msg['reason'] = '验证码发送失败、重新获取！';
            echo json_encode($msg);
            exit;
        }

        $key = 'zcyzm'.$param['param_mobile'];

        wkcache($key,$value,300);

        if(rkcache($key)){
            $msg['code'] = 10000;
            $msg['message'] = 'success';
            $msg['data'] = 'true';
            echo json_encode($msg);
            exit;
        }else{
            $msg['code'] = 10034;
            $msg['message'] = 'error';
            $msg['reason'] = '验证码发送失败、重新获取！';
            echo json_encode($msg);
            exit;
        }

    }


    /**
     * 用户注册
     */
    public static function userRegister($param = ''){
        if(empty($param['param_mobile'])){
            $msg['code'] = 10021;
            $msg['message'] = 'error';
            $msg['reason'] = '用户名不能为空！';
            echo json_encode($msg);
            exit;
        }

        if(empty($param['param_pass'])){
            $msg['code'] = 10022;
            $msg['message'] = 'error';
            $msg['reason'] = '密码不能为空！';
            echo json_encode($msg);
            exit;
        }

        if(empty($param['param_mobile'])){
            $msg['code'] = 10023;
            $msg['message'] = 'error';
            $msg['reason'] = '手机号不能为空！';
            echo json_encode($msg);
            exit;
        }

        if(!preg_match("/1[34578]{1}\d{9}$/",$param['param_mobile'])){
            $msg['code'] = 10024;
            $msg['message'] = 'error';
            $msg['reason'] = '手机号格式不正确！';
            echo json_encode($msg);
            exit;
        }

        $key = 'zcyzm'.$param['param_mobile'];

        if($param['param_mobile_yzm'] != rkcache($key)){
            $msg['code'] = 10025;
            $msg['message'] = 'error';
            $msg['reason'] = '验证码不正确或已过期！';
            echo json_encode($msg);
            exit;
        }


        $register_info = array();
        $register_info['member_name'] = $param['param_mobile'];
        $register_info['member_passwd'] = $param['param_pass'];
        $register_info['member_mobile'] = $param['param_mobile'];
        $register_info['member_from'] = 'ios';


        $model_member = Model('member');

        // 验证用户名是否重复
        $check_member_name  = $model_member->getMemberInfo(array('member_name'=>$register_info['member_name']));
        if(is_array($check_member_name) and count($check_member_name) > 0) {
            $msg['code'] = 10026;
            $msg['message'] = 'error';
            $msg['reason'] = '用户名已存在！';
            echo json_encode($msg);
            exit;
        }

        // 验证手机是否重复
        $check_member_mobile    = $model_member->getMemberInfo(array('member_mobile'=>$register_info['member_mobile']));
        if(is_array($check_member_mobile) and count($check_member_mobile)>0) {
            $msg['code'] = 10027;
            $msg['message'] = 'error';
            $msg['reason'] = '手机号已存在！';
            echo json_encode($msg);
            exit;
        }


        $insert_id  = $model_member->addMember($register_info);

        if(empty($insert_id)){
            $msg['code'] = 10028;
            $msg['message'] = 'error';
            $msg['reason'] = '注册失败！';
            echo json_encode($msg);
            exit;
        }

        //添加会员积分
        if (C('points_isuse')){
            Model('points')->savePointsLog('regist',array('pl_memberid'=>$insert_id,'pl_membername'=>$register_info['username']),false);
        }

        // 添加默认相册
        $insert['ac_name']      = '买家秀';
        $insert['member_id']    = $insert_id;
        $insert['ac_des']       = '买家秀默认相册';
        $insert['ac_sort']      = 1;
        $insert['is_default']   = 1;
        $insert['upload_time']  = TIMESTAMP;
        $model_member->table('sns_albumclass')->insert($insert);


        $resultArr = array();
        $resultArr['code'] = 10000;
        $resultArr['message'] = 'success';
        $resultArr['data'] = 'true';

        return json_encode($resultArr);

    }



    /**
     * 获取重置密码手机验证码
     */
    public static function resetPassVerification($param = ''){
        if(empty($param['param_mobile'])){
            $msg['code'] = 10041;
            $msg['message'] = 'error';
            $msg['reason'] = '手机号不能为空！';
            echo json_encode($msg);
            exit;
        }

        if(!preg_match("/1[34578]{1}\d{9}$/",$param['param_mobile'])){
            $msg['code'] = 10042;
            $msg['message'] = 'error';
            $msg['reason'] = '手机号格式不正确！';
            echo json_encode($msg);
            exit;
        }

        $sms = new Sms();

        $value = mt_rand(1111,9999);

        $result = $sms->send($param['param_mobile'],$value);

        if(!$result){
            $msg['code'] = 10043;
            $msg['message'] = 'error';
            $msg['reason'] = '验证码发送失败、重新获取！';
            echo json_encode($msg);
            exit;
        }

        $key = 'resetpassyzm'.$param['param_mobile'];

        wkcache($key,$value,300);

        if(rkcache($key)){
            $msg['code'] = 10000;
            $msg['message'] = 'success';
            $msg['data'] = 'true';
            echo json_encode($msg);
            exit;
        }else{
            $msg['code'] = 10044;
            $msg['message'] = 'error';
            $msg['reason'] = '验证码发送失败、重新获取！';
            echo json_encode($msg);
            exit;
        }

    }


    /**
     * 重置密码
     */
    public static function resetPass($param = ''){


        if(empty($param['param_mobile'])){
            $msg['code'] = 10051;
            $msg['message'] = 'error';
            $msg['reason'] = '手机号不能为空！';
            echo json_encode($msg);
            exit;
        }

        if(!preg_match("/1[34578]{1}\d{9}$/",$param['param_mobile'])){
            $msg['code'] = 10052;
            $msg['message'] = 'error';
            $msg['reason'] = '手机号格式不正确！';
            echo json_encode($msg);
            exit;
        }

        $key = 'resetpassyzm'.$param['param_mobile'];

        if($param['param_mobile_yzm'] != rkcache($key)){
            $msg['code'] = 10053;
            $msg['message'] = 'error';
            $msg['reason'] = '验证码不正确或已过期！';
            echo json_encode($msg);
            exit;
        }


        $model_member = Model('member');

        // 验证用户名是否重复
        $check_member_name  = $model_member->getMemberInfo(array('member_name'=>$param['param_mobile']));
        if(empty($check_member_name)) {
            $msg['code'] = 10054;
            $msg['message'] = 'error';
            $msg['reason'] = '没有该帐户！';
            echo json_encode($msg);
            exit;
        }

        // 验证用户名和手机号是否同一帐户
        $condition['member_name'] = $param['param_mobile'];
        $condition['member_mobile'] = JiaMiMobile($param['param_mobile']);
        $check_member_name_mobile  = Model()->table('member')->where($condition)->find();
        if(empty($check_member_name_mobile)) {
            $msg['code'] = 10055;
            $msg['message'] = 'error';
            $msg['reason'] = '帐号和手机号不匹配！';
            echo json_encode($msg);
            exit;
        }

        $pas = rand(100000,999999);
        $sms = new Sms();

        $sms->send($param['param_mobile'],"您好,您的新密码是".$pas."");
        Model('member')->editMember(array('member_id'=>$check_member_name_mobile['member_id']),array('member_passwd'=>md5($pas)));

        $msg['code'] = 10000;
        $msg['message'] = 'success';
        $msg['data'] = 'true';
        echo json_encode($msg);
        exit;

    }


    public static function getLoginSession($param = ''){

        if(!$param['member_name']){
            $msg['code'] = 10061;
            $msg['message'] = 'error';
            $msg['reason'] = '用户名为空！';
            echo json_encode($msg);
            exit;
        }

        if(trim($param['member_name']) != trim($_SESSION['member_name'])){
            $msg['code'] = 10062;
            $msg['message'] = 'error';
            $msg['reason'] = '该用户未登陆！';
            echo json_encode($msg);
            exit;
        }

        if($_SESSION['is_login'] != 1){
            $msg['code'] = 10063;
            $msg['message'] = 'error';
            $msg['reason'] = '该用户未登陆！';
            echo json_encode($msg);
            exit;
        }

        $dataArr['is_login'] = $_SESSION['is_login'];
        $dataArr['member_id'] = $_SESSION['member_id'];
        $dataArr['member_name'] = $_SESSION['member_name'];
        $dataArr['member_email'] = $_SESSION['member_email'];
        $dataArr['is_buy'] = $_SESSION['is_buy'];
        $dataArr['avatar'] = $_SESSION['avatar'];
        $dataArr['store_id'] = $_SESSION['store_id'];
        $dataArr['level'] = $_SESSION['level'];

        $resultArr = array();
        $resultArr['code'] = 10000;
        $resultArr['message'] = 'success';
        $resultArr['data'] = $dataArr;

        return json_encode($resultArr);
    }













}
?>
