<?php
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
class manageUser extends manage{
	public $huoDong;
	public $mobanStyle;

	public function __construct(){
		parent::__construct();
		$this->dbConnect();//切换到shopnc数据库

		$this->huoDong = array(
			'1'=>'拍卖会员',
			'2'=>'参与过秒杀',
			'3'=>'参与过团购'
			);

		$this->tpl('huoDong',$this->huoDong);

		$this->mobanStyle = array(
			'mroy9Wgsfz4thgwCZdU8b8EYwVkoyMFAYKRM8pwDzbc'=>'公告通知提醒',
			'7sgYpmpb1Ie2bA4ZLPQI_vTCCyquYiO6ZvQtPVikMaU'=>'出价被超越通知',
			'NURFBHG-9yzIInKOpMZzdVu6d7QXC1A9d4ehFgTMYLY'=>'拍卖结束提醒',
			'X6g07E0tmPriSc4TKvdeD5I33vHSbl0eGWeQ1euuuiE'=>'订单通知',
			'0CAszU1ZZB-bTdyYoAD3ArMqN_Q7rc6aO4LdoeYq0ow'=>'积分变动通知',
			'jb3Hr8npAbToKQZtPmo6EzSOvUOQUck4qRsC-p5pKT0'=>'竞拍成功通知',
			'EXUWWLR7EHFn9guEyUTzr37Kv1G4iV7bMld4Y7IXqXM'=>'账户余额变动通知',
			'loNCp090cPBGZIgkZqIexDbJGsbqU0QpyVtFbCJ8MoI'=>'退款进度通知',
			'QGWpDcFpL1RXJkdmeUngcAR3gCoFcI6bOolTehSx-mw'=>'到期提醒通知',
			'gioFqFTIExhZ0lcm1Yr1etxIFNj1i6qWBkeA0507PBE'=>'商品详情通知',
			'NxbJjJXPw59Hra7CxY96NvMuuGSxo6oJQh4M6weXd5g'=>'提现审核结果通知',
			'OZ40pW6XK_OqBw3M-RiPmnwIiIePaH3Q9BIPMfENKZw'=>'提醒供应商发货通知',
			'QLVetp8oJSeQZWodC0loC3BKmckcRu5bPQtPsDB3tq8'=>'售后申请通知',

			);

		$this->tpl('mobanStyleArr',$this->mobanStyle);
	}

	public function index(){

		if($_GET['form_submit'] == 'ok'){
			$list_where = $this->get_list_where();
		}

		$page_page = G('page',2,2);
		if($list_where['gc_id_1_where'] || $list_where['goods_name_where']){
			$page_db = 'member m ,order_goods o ,goods g';
			$list_where['left_where'] = ' AND m.member_id=o.buyer_id AND o.goods_id=g.goods_id ';
		}else{
			$page_db = 'member m';
		}
		$page_url = "index.php?m=manageUser&p=manage".$list_where['url'];
		$page_limit = '20000';
		$page_order = 'm.member_id ASC';
		$page_where = $list_where['in_where']." m.openid <> '' AND m.is_open <> '' ".$list_where['left_where'].$list_where['gc_id_1_where'].$list_where['goods_name_where'].$list_where['points_where'].$list_where['available_predeposit_where'].$list_where['time_where'].' group by m.member_id';
		$page_field = 'm.member_id';

		$page = new PageTurn($this->c,$page_page,$page_db,$page_url,$page_limit,$page_order,$page_where,$page_field);

		foreach ($page->dataArr as $k => $v) {
			$result .= $v['member_id'].',';
		}

		//page_where条件存入session用于发送模板
		// $_SESSION['moban_db'] = $page_db;
		// $_SESSION['moban_where'] = $page_where;
		$_SESSION['moban_member_id_array'] = trim($result,',');

		//重置模板发送设置
		$_SESSION['user_end_member_id'] = '';
		$_SESSION['moban_stop'] = '';
		$_SESSION['do_moban_true_sum'] = '';
		$_SESSION['do_moban_false_sum'] = '';
		$_SESSION['moban_array'] = '';
		$_SESSION['text_array'] = '';
		$_SESSION['do_moban_false_id'] = '';

		$this->filename='user_list.html';
		// $this->tpl('dataArr',$result);
		$this->tpl('pageTotle',$page->totle);
		// $this->tpl('pageStr',$page->pageStr(3));
		$this->tpl('goodsClass',$this->getGoodsClass());

		$this->toString();
	}

	/*拼接搜索条件*/
	private function get_list_where(){

		// 三个选项：1为拍卖会员,2为参与过秒杀,3为参与过团购
		$member_moban_type = intval(trim($_GET['moban_type']));
		switch ($member_moban_type) {
			case '1':
				$this->c->table('lepai_log');
				$lepai_user = $this->c->search("member_id <> '' group by member_id",'','','member_id');
				foreach ($lepai_user as $k => $v) {
					$lepai_user_str .= $v['member_id'].',';
				}
				$where_in_str = rtrim($lepai_user_str,',');
				$list_where['in_where'] = " m.member_id in($where_in_str) AND";
				break;
			case '2':
				$this->c->table('order_goods');
				$miaosha_user = $this->c->search("goods_type = 6 group by buyer_id",'','','buyer_id');
				foreach ($miaosha_user as $k => $v) {
					$miaosha_user_str .= $v['buyer_id'].',';
				}
				$where_in_str = rtrim($miaosha_user_str,',');
				$list_where['in_where'] = " m.member_id in($where_in_str) AND";
				break;
			case '3':
				$this->c->table('order_goods');
				$miaosha_user = $this->c->search("goods_type = 2 group by buyer_id",'','','buyer_id');
				foreach ($miaosha_user as $k => $v) {
					$miaosha_tuan_str .= $v['buyer_id'].',';
				}
				$where_in_str = rtrim($miaosha_tuan_str,',');
				$list_where['in_where'] = " m.member_id in($where_in_str) AND";
				break;
		}

		$_SESSION['sel_moban_type'] = $member_moban_type;

		//购买分类
		$gc_id_1 = intval(trim($_GET['gc_id_1']));
		if($gc_id_1){
			$list_where['gc_id_1_where'] = " AND g.gc_id_1=$gc_id_1 ";
		}

		$_SESSION['sel_gc_id_1'] = $gc_id_1;

		//购买商品(名称/编号)
		$goods_name = intval(trim($_GET['goods_name']));
		if($goods_name){
			$list_where['goods_name_where'] = " AND g.goods_serial=$goods_name ";
		}else{

			$goods_name = trim($_GET['goods_name']);
			if($goods_name){
				$list_where['goods_name_where'] = " AND g.goods_name=$goods_name ";
			}
		}

		$_SESSION['sel_goods_name'] = $goods_name;

		// 会员积分
		$member_points_min = intval(trim($_GET['member_points_min']));
		$member_points_max = intval(trim($_GET['member_points_max']));

		$_SESSION['sel_member_points_min'] = $member_points_min;
		$_SESSION['sel_member_points_max'] = $member_points_max;

		if($member_points_min && $member_points_max){
			$list_where['points_where'] = " AND m.member_points between $member_points_min AND $member_points_max ";
		}elseif($member_points_min || $member_points_max){
			$member_points = $member_points_min?$member_points_min:$member_points_max;
			$list_where['points_where'] = " AND m.member_points <= $member_points ";
		}


		// 余额
		$member_available_predeposit_min = intval(trim($_GET['member_available_predeposit_min']));
		$member_available_predeposit_max = intval(trim($_GET['member_available_predeposit_max']));

		if($member_available_predeposit_min && $member_available_predeposit_max){
			$list_where['available_predeposit_where'] = " AND m.available_predeposit between $member_available_predeposit_min AND $member_available_predeposit_max ";
		}elseif($member_available_predeposit_min || $member_available_predeposit_max){
			$available_predeposit = $member_available_predeposit_min?$member_available_predeposit_min:$member_available_predeposit_max;
			$list_where['available_predeposit_where'] = " AND m.available_predeposit <= $available_predeposit ";
		}


		//购买时间
		$member_add_time_min = strtotime(trim($_GET['member_add_time_min']));
		$member_add_time_max = strtotime(trim($_GET['member_add_time_max']));
		if($member_add_time_min && $member_add_time_max){
			$list_where['add_time'] = " AND add_time between '$member_add_time_min' AND '$member_add_time_max' ";
		}elseif($member_add_time_min || $member_add_time_max){
			$member_add_time = $member_add_time_min?$member_add_time_min:$member_add_time_max;
			$list_where['add_time'] = " AND add_time <= '$member_add_time' ";
		}

		if(!empty($list_where['add_time'])){
			$this->c->table('order o,member m');
			$order_add_user = $this->c->search(" o.buyer_id=m.member_id AND  m.openid <> '' AND m.is_open = 1 ".$list_where['add_time'].'  group by buyer_id ','','','buyer_id');

			foreach ($order_add_user as $k => $v) {
				$order_in_where .= $v['buyer_id'].',';
			}
			$order_in_where = rtrim($order_in_where,',');


			//判断是否有参与的活动,如果没有以购买时间查出会员ID作为IN
			if(!empty($where_in_str)){//有参与活动筛选
				$arr1 = explode(',',$where_in_str);
				$arr2 = explode(',',$order_in_where);
				$intersection = array_unique(array_merge($arr1,$arr2));

				foreach ($intersection as $k => $v) {
					$order_in_where_str .= $v.',';
				}

				$order_in_where_str = rtrim($order_in_where_str,',');

				$list_where['in_where'] = " m.member_id in($order_in_where_str) AND ";

			}else{
				$list_where['in_where'] = " m.member_id in($order_in_where) AND ";
			}

		}
		

		// 注册时间
		$member_time_min = strtotime(trim($_GET['member_time_min']));
		$member_time_max = strtotime(trim($_GET['member_time_max']));

		if($member_time_min && $member_time_max){
			$list_where['time_where'] = " AND m.member_time between '$member_time_min' AND '$member_time_max' ";
		}elseif($member_time_min || $member_time_max){
			$member_time = $member_time_min?$member_time_min:$member_time_max;
			$list_where['time_where'] = " AND m.member_time <= '$member_time' ";
		}

		//搜索后的URL地址
		// $list_where['url'] = "&moban_type=$member_moban_type&member_points_min=$member_points_min&member_points_max=$member_points_max&member_time_min=$member_time_min&member_time_max=$member_time_max&form_submit=ok";

		return $list_where;
	}


	/*接收发送信息*/
	public function setMoBanStyle(){
		if($_POST['msg'] == 'ok'){
			$text_array['content'] = $_POST['user_one_msg'];
			$_SESSION['text_array'] = json_encode($text_array);
			$_SESSION['moban_type'] = 'text';
		}else{
			$moban_array = $this->getMobanHtmlVal();
			$_SESSION['moban_array'] = json_encode($moban_array);
			$_SESSION['moban_type'] = 'moban';
		}


		//判断是否预览

		$yname = trim($_POST['Y_Name']);
		if(!empty($yname)){
			$_SESSION['moban_yname'] = $yname;
			header("location:index.php?m=manageUser&p=manage&c=yuNan");
			exit;
		}

		//存到数据库记录当前发送记录

		// $dataArr['S_Vid'] = intval(trim($_POST['MoBanStyleId']));
		$dataArr['S_Vname'] = trim($_POST['MoBanStyle']);
		$dataArr['S_HuoDong'] = $_SESSION['sel_moban_type'];
		$dataArr['S_TypeClass'] = $_SESSION['sel_gc_id_1'];
		$dataArr['S_Goods'] = $_SESSION['sel_goods_name'];
		$dataArr['S_Points'] = $_SESSION['sel_member_points_min'].'-'.$_SESSION['sel_member_points_max'];
		$dataArr['S_MobanType'] = $_SESSION['moban_type'];
		$dataArr['S_Remark'] = $moban_array?addslashes(json_encode($moban_array)):$text_array['content'];
		$dataArr['S_Time'] = time();

		//保存发送纪录
		$this->setMysql();
		$this->c->table('moban_send');
		$this->c->insert($dataArr);
		$resultId = $this->c->insertID();

		$_SESSION['moban_send_id'] = $resultId;

		// //如发送模板消息、发送次数加一
		// if(!empty($moban_array)){
		// 	$sql = "UPDATE `sw_moban_val` SET V_Click = `V_Click`+1 WHERE `V_Id` = ".$dataArr['S_Vid'];
		// 	$this->c->execute($sql);
		// }


		

		//清空搜索选择状态
		$_SESSION['sel_moban_type'] = '';
		$_SESSION['sel_gc_id_1'] = '';
		$_SESSION['sel_goods_name'] = '';
		$_SESSION['sel_member_points_min'] = '';
		$_SESSION['sel_member_points_max'] = '';

		header("location:index.php?m=manageUser&p=manage&c=doMoBan");
	}


	/*发送模板消息*/
	public function doMoBan(){
		$moban_array = json_decode($_SESSION['moban_array'],true);
		$text_array = json_decode($_SESSION['text_array'],true);

		if($_SESSION['moban_type'] == 'text'){
			if(empty($text_array)){
				echo "没有可发送的消息、请填写发送信息！";
				exit;
			}
		}

		if($_SESSION['moban_type'] == 'moban'){
			if(empty($moban_array)){
			echo "没有可发送的消息、请填写发送信息！";
			exit;
			}
		}

		$moban_style = $moban_array['MoBanStyle'];
		unset($moban_array['MoBanStyle']);

		require_once($_SERVER['DOCUMENT_ROOT']."/core/framework/libraries/weixinsdk.php");
		require_once(dirname(__FILE__)."/../../model/class/weixinMoban.class.php");
		$weixinMoban = new weixinMoban;//模板消息
		$weixinInfo = new weixinSDK;//微信基类

		$add_moban_where = $_SESSION['user_end_member_id']?" AND member_id > $_SESSION[user_end_member_id]":'';

		$moban_token = $weixinInfo->token;
		$moban_stop = $_SESSION['moban_stop'];//停止发送条件
		// $moban_db = $_SESSION['moban_db'];//数据库
		$moban_where = " m.member_id in($_SESSION[moban_member_id_array]) ".$add_moban_where;//数据库查询发送条件

		if($moban_stop == true){
			echo "模板消息已发送完毕1！";
			echo '已成功发送'.$_SESSION['do_moban_true_sum'].'用户,发送失败'.$_SESSION['do_moban_false_sum'].'用户';
			exit;
		}

		// if(empty($moban_db)){
		// 	echo "当前没有可发送消息用户！";
		// 	exit;
		// }

		if(empty($moban_where)){
			echo "当前没有可发送消息用户！";
			exit;
		}

		$this->c->table('member m');
		$moban_user_all = $this->c->search($moban_where,'m.member_id ASC','0,100','m.member_id,m.openid,m.member_name,m.member_points,m.available_predeposit');


		if(empty($moban_user_all)){
			echo "当前没有可发送消息用户！";
			exit;
		}

		$user_end = end($moban_user_all);//当前用户组最后一个用户

		//判断当前用户组最后一个用户是否和纪录发送用户同一个人

		if($_SESSION['user_end_member_id'] == $user_end['member_id']){
			echo "模板消息已发送完毕2！";
			echo '已成功发送'.$_SESSION['do_moban_true_sum'].'用户,发送失败'.$_SESSION['do_moban_false_sum'].'用户';
			exit;
		}

		foreach($moban_user_all as $k => $v){

			$_SESSION['user_end_member_id'] = $v['member_id'];

			if($_SESSION['moban_type'] == 'text'){

				$text_array = str_replace('%name%', $v['member_name'], $text_array['content']);
				$text_array = str_replace('%jifen%', $v['member_points'], $text_array);
				$text_array = str_replace('%yue%', $v['available_predeposit'], $text_array);

				$result = $this->sendMessage($v['openid'],$text_array,$moban_token);
			}

			if($_SESSION['moban_type'] == 'moban'){
				
				$moban_array = str_replace('%name%', $v['member_name'], $moban_array);
				$moban_array = str_replace('%jifen%', $v['member_points'], $moban_array);
				$moban_array = str_replace('%yue%', $v['available_predeposit'], $moban_array);

				$result = $weixinMoban->$moban_style($v['openid'],$moban_array,$moban_token);
			}

			$result = json_decode($result,true);

			if($result['errmsg'] == 'ok'){
				$_SESSION['do_moban_true_sum'] = $_SESSION['do_moban_true_sum']+1;
			}else{

				$_SESSION['do_moban_false_sum'] = $_SESSION['do_moban_false_sum']+1;

				$_SESSION['do_moban_false_id'] .= $v['member_id'].',';

				if($result['errcode'] == '40001'){
					$weixinInfo->set_null_token();
					break;
				}
				if($result['errcode'] == '41001'){
					break;
				}

			}

			//如果当前用户总数少于一百,并且当前循环用户是用户组最后一个用户则发送完毕！
			if(count($moban_user_all) < 100 && $v['member_id'] == $user_end['member_id']){
				$_SESSION['moban_stop'] = true;
			}

		}


		//记录成功失败数量
		$this->setMysql();
		$this->c->table('moban_send');
		$dataArr['S_Ture'] = $_SESSION['do_moban_true_sum'];
		$dataArr['S_False'] = $_SESSION['do_moban_false_sum'];
		if($_SESSION['moban_send_id']){
			$this->c->update($dataArr,"S_Id='".$_SESSION['moban_send_id']."'");


			//记录失败ID
		if(!empty($_SESSION['do_moban_false_id'])){
			$this->c->table('moban_false');
			$falseArr['F_MobanSend'] = $_SESSION['moban_send_id'];
			$falseArr['F_FalseId'] = trim($_SESSION['do_moban_false_id'],',');
			if($this->c->search("F_MobanSend='".$_SESSION['moban_send_id']."'")){
				$this->c->update($falseArr,"F_MobanSend='".$_SESSION['moban_send_id']."'");
			}else{
				$this->c->insert($falseArr);
			}
		}

		}

echo '已成功发送'.($_SESSION['do_moban_true_sum']?$_SESSION['do_moban_true_sum']:'0').'用户,发送失败'.($_SESSION['do_moban_false_sum']?$_SESSION['do_moban_false_sum']:'0').'用户';

		$js = <<<TIAO
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>微信模板发消息发送</title>
<script type="text/javascript">     
function countDown(secs,surl){     
 //alert(surl);     
 var jumpTo = document.getElementById('jumpTo');
 jumpTo.innerHTML=secs;  
 if(--secs>0){     
     setTimeout("countDown("+secs+",'"+surl+"')",1000);     
     }     
 else{       
     location.href=surl;     
     }     
 }     
</script> 
</head>
<body><span id="jumpTo">10</span>秒后自动跳转...
<script type="text/javascript">countDown(10,'http://www.96567.com/wm/index.php?m=manageUser&p=manage&c=doMoBan');</script>  
</body>
</html>
TIAO;
	echo $js;
	}




	/*预览*/
	public function yuNan(){
		
		$moban_array = json_decode($_SESSION['moban_array'],true);
		$text_array = json_decode($_SESSION['text_array'],true);
		$yname = $_SESSION['moban_yname'];

		if($_SESSION['moban_type'] == 'text'){
			if(empty($text_array)){
				echo "没有可发送的消息、请填写发送信息！";
				exit;
			}
		}

		if($_SESSION['moban_type'] == 'moban'){
			if(empty($moban_array)){
			echo "没有可发送的消息、请填写发送信息！";
			exit;
			}
		}

		$moban_style = $moban_array['MoBanStyle'];
		unset($moban_array['MoBanStyle']);

		require_once($_SERVER['DOCUMENT_ROOT']."/core/framework/libraries/weixinsdk.php");
		require_once(dirname(__FILE__)."/../../model/class/weixinMoban.class.php");
		$weixinMoban = new weixinMoban;//模板消息
		$weixinInfo = new weixinSDK;//微信基类

		$moban_token = $weixinInfo->token;


		if(empty($yname)){
			echo "当前没有可发送消息用户！";
			exit;
		}

		$this->c->table('member m');
		$moban_user_all = $this->c->search("openid='".$yname."'",'','','m.member_id,m.openid,m.member_name,m.member_points,m.available_predeposit');


		if(empty($moban_user_all)){
			echo "当前没有可发送消息用户！";
			exit;
		}

		foreach($moban_user_all as $k => $v){

			if($_SESSION['moban_type'] == 'text'){

				$text_array = str_replace('%name%', $v['member_name'], $text_array['content']);
				$text_array = str_replace('%jifen%', $v['member_points'], $text_array);
				$text_array = str_replace('%yue%', $v['available_predeposit'], $text_array);

				$result = $this->sendMessage($v['openid'],$text_array,$moban_token);
			}

			if($_SESSION['moban_type'] == 'moban'){
				
				$moban_array = str_replace('%name%', $v['member_name'], $moban_array);
				$moban_array = str_replace('%jifen%', $v['member_points'], $moban_array);
				$moban_array = str_replace('%yue%', $v['available_predeposit'], $moban_array);

				$result = $weixinMoban->$moban_style($v['openid'],$moban_array,$moban_token);
			}

			$result = json_decode($result,true);

			if($result['errmsg'] == 'ok'){

				$_SESSION['do_moban_true_sum'] = $_SESSION['do_moban_true_sum']+1;

			}else{

				$_SESSION['do_moban_false_sum'] = $_SESSION['do_moban_false_sum']+1;

				if($result['errcode'] == '40001'){
					$weixinInfo->set_null_token();
					break;
				}
				if($result['errcode'] == '41001'){
					break;
				}

			}


		}



echo '已成功发送'.($_SESSION['do_moban_true_sum']?$_SESSION['do_moban_true_sum']:'0').'用户,发送失败'.($_SESSION['do_moban_false_sum']?$_SESSION['do_moban_false_sum']:'0').'用户';

		$js = <<<TIAO
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>微信模板发消息发送</title>
<script type="text/javascript">     
function countDown(secs,surl){     
 //alert(surl);     
 var jumpTo = document.getElementById('jumpTo');
 jumpTo.innerHTML=secs;  
 if(--secs>0){     
     setTimeout("countDown("+secs+",'"+surl+"')",1000);     
     }     
 else{       
     location.href=surl;     
     }     
 }     
</script> 
</head>
<body><span id="jumpTo">3</span>秒后自动跳转...
<script type="text/javascript">countDown(3,'http://www.96567.com/wm/index.php?m=manageUser&p=manage&c=index');</script>  
</body>
</html>
TIAO;
	echo $js;


	}



/**
模板列表



*/


	/*模板列表*/
	public function viewMoBanVal(){
		$this->setMysql();
		$page_page = G('page',2,2);
		$page_db = 'moban_val v,moban_ad a';
		$page_url = 'index.php?m=manageUser&p=manage&c=viewMoBanVal';
		$page_limit = '20';
		$page_order = 'v.V_Id';
		$page_where = 'v.V_Ad = a.A_Id';
		$page_field = '*';

		$page = new PageTurn($this->c,$page_page,$page_db,$page_url,$page_limit,$page_order,$page_where,$page_field);

		$this->tpl('mobanArray',$page->dataArr);

		$this->tpl('pageStr',$page->pageStr(3));
		$this->filename='moban_list.html';
		$this->toString();
	}


	/*模板添加*/
	public function addMobanVal(){
		$this->setMysql();
		
		$mobanArr = $this->mobanStyle;

		if($_POST['form_submit'] == 'ok'){

		$dataArr['V_ChangJing'] = trim($_POST['V_ChangJing']);
		$dataArr['V_MoBanId'] = trim($_POST['V_MoBanName']);
		$dataArr['V_MoBanName'] = $mobanArr[$dataArr['V_MoBanId']];
		$dataArr['V_Ad'] = trim($_POST['V_Ad']);

		$this->c->table('moban_val');
		$this->c->insert($dataArr);

		header("location:index.php?m=manageUser&p=manage&c=viewMoBanVal");

		}else{

		//广告列表
		$this->c->table('moban_ad');
		$moban_ad = $this->c->search();
		$this->tpl('mobanAd',$moban_ad);
		$this->filename='moban_one_val.html';
		$this->toString();

		}

	}

	/*模板修改*/
	public function setMobanVal(){
		$this->setMysql();
		
		$mobanArr = $this->mobanStyle;

		if($_POST['form_submit'] == 'ok'){

			$vid = $_POST['V_Id'];
			$vad = $_POST['V_Ad'];

			$dataArr['V_Ad'] = $vad;

			$this->c->table('moban_val');
			$this->c->update($dataArr,"V_Id = '".$vid."'");

			show('修改成功','/wm/index.php?m=manageUser&p=manage&c=viewMoBanVal');

		}else{

		$id = intval(trim($_GET['id']));

		//广告列表
		$this->c->table('moban_ad');
		$moban_ad = $this->c->search();
		$this->tpl('mobanAd',$moban_ad);

		$this->c->table('moban_val');
		$mobanArray = $this->c->search("V_Id='".$id."'");

		$this->tpl('mobanArray',$mobanArray[0]);

		$this->filename='moban_one_val.html';
		$this->toString();

		}

	}

	/*模板删除*/
	public function delMoBan(){
		$this->setMysql();
		$this->c->table('moban_val');
		$id = intval(trim($_GET['id']));
		$this->c->del('V_Id',$id);

		header("location:index.php?m=manageUser&p=manage&c=viewMoBanVal");
	}


	// /*模板添加*/
	// public function doMobanVal(){
	// 	$this->setMysql();
	// 	$moban_array = $this->getMobanHtmlVal();
	// 	$dataArr['V_Name'] = $moban_array['MoBanStyle'];
	// 	$dataArr['V_MoBanStyle'] = $moban_array['MoBanStyle'];
	// 	$dataArr['V_ChangJing'] = trim($_POST['V_ChangJing']);
	// 	$dataArr['V_Title'] = $moban_array['first'];
	// 	unset($moban_array['MoBanStyle']);
	// 	$dataArr['V_Remark'] = addslashes(json_encode($moban_array));
	// 	$dataArr['V_Url'] = $moban_array['url'];

	// 	$this->c->table('moban_val');
	// 	$this->c->insert($dataArr);
				
	// 	header("location:index.php?m=manageUser&p=manage&c=viewMoBanVal");

	// }


	// /*模板编辑*/
	// public function setMobanVal(){
	// 	$this->setMysql();
	// 	if($_POST['form_submit'] == 'ok'){

	// 		$vid = intval(trim($_POST['V_Id']));
	// 		$moban_array = $this->getMobanHtmlVal();

	// 		if($vid){
	// 			$dataArr['V_Name'] = $moban_array['MoBanStyle'];
	// 			$dataArr['V_MoBanStyle'] = $moban_array['MoBanStyle'];
	// 			$dataArr['V_Title'] = $moban_array['first'];
	// 			$dataArr['V_ChangJing'] = trim($_POST['V_ChangJing']);
	// 			unset($moban_array['MoBanStyle']);
	// 			$dataArr['V_Remark'] = addslashes(json_encode($moban_array));
	// 			$dataArr['V_Url'] = $moban_array['url'];

	// 			$this->c->table('moban_val');
	// 			$this->c->update($dataArr,"V_Id = '".$vid."'");
				
	// 			header("location:index.php?m=manageUser&p=manage&c=viewMoBanVal");
	// 		}
			
	// 	}else{
	// 		$id = intval(trim($_GET['id']));
	// 		$this->c->table('moban_val');
	// 		$result = $this->c->search("V_Id='".$id."'");
	// 		$result = end($result);
	// 		$result['V_Remark'] = json_decode($result['V_Remark'],true);

	// 		$this->tpl('mobanArray',$result);
	// 		$this->filename='moban_one_val.html';
	// 		$this->toString();
	// 	}
	// }

	// /*模板删除*/
	// public function delMoBan(){
	// 	$id = intval(trim($_GET['id']));
	// 	if($id){
	// 		$this->setMysql();
	// 		$this->c->table('moban_val');
	// 		$this->c->del('V_Id',$id);
	// 		header("location:index.php?m=manageUser&p=manage&c=viewMoBanVal");
	// 	}
	// }





/**
模板广告



*/

	/*广告列表*/
	public function adList(){
		$this->setMysql();

		$page_page = G('page',2,2);
		$page_db = 'moban_ad';
		$page_url = 'index.php?m=manageUser&p=manage&c=adList';
		$page_limit = '20';
		$page_order = 'A_Id DESC';
		$page_where = '';
		$page_field = '*';
		$page = new PageTurn($this->c,$page_page,$page_db,$page_url,$page_limit,$page_order,$page_where,$page_field);

		$this->tpl('dataArr',$page->dataArr);
		$this->tpl('pageStr',$page->pageStr(3));

		$this->filename='moban_ad_list.html';
		$this->toString();
	}


	/*广告添加*/
	public function addAd(){
		if($_POST['form_submit'] == 'ok'){
			$dataArr['A_Content'] = $_POST['A_Content'];
			$dataArr['A_Url'] = $_POST['A_Url'];
			$this->setMysql();
			$this->c->table('moban_ad');
			$this->c->insert($dataArr);
			header("location:index.php?m=manageUser&p=manage&c=adList");
		}else{
			$this->filename='moban_ad_val.html';
			$this->toString();
		}
		
	}


	/*广告修改*/
	public function saveAd(){
		$this->setMysql();
		$this->c->table('moban_ad');

		if($_POST['form_submit'] == 'ok'){

			$id = intval(trim($_POST['V_Id']));
			$dataArr['A_Content'] = $_POST['A_Content'];
			$dataArr['A_Url'] = $_POST['A_Url'];
			$this->c->update($dataArr,"A_Id='".$id."'");

			header("location:index.php?m=manageUser&p=manage&c=adList");
		}else{
			$id = intval(trim($_GET['id']));
			$result = $this->c->search("A_Id='".$id."'");

			$this->tpl('dataArr',$result[0]);

			$this->filename='moban_ad_val.html';
			$this->toString();
		}

	}


	/*广告删除*/
	public function delAd(){
		$this->setMysql();
		$this->c->table('moban_ad');
		$id = intval(trim($_GET['id']));
		$this->c->del('A_Id',$id);

		header("location:index.php?m=manageUser&p=manage&c=adList");
	}


/**
发送纪录



*/
	public function sendRecordList(){
		$goodsClass = $this->getGoodsClass();

		foreach($goodsClass as $k => $v){
			$newGoodsClass[$v['gc_id']] = $v['gc_name'];
		}

		$huoDong = $this->huoDong;

		$this->setMysql();
		$page_page = G('page',2,2);
		$page_db = 'moban_send';
		$page_url = 'index.php?m=manageUser&p=manage&c=sendRecordList';
		$page_limit = '20';
		$page_order = 'S_Id DESC';
		$page_where = '';
		$page_field = '*';

		$page = new PageTurn($this->c,$page_page,$page_db,$page_url,$page_limit,$page_order,$page_where,$page_field);

		foreach ($page->dataArr as $k => &$v) {
			$v['S_HuoDong'] = $huoDong[$v['S_HuoDong']]?$huoDong[$v['S_HuoDong']]:'全部';
			$v['S_TypeClass'] = $newGoodsClass[$v['S_TypeClass']]?$newGoodsClass[$v['S_TypeClass']]:'全部';
			if($v['S_MobanType'] == 'text'){
				$v['S_MobanType'] = '聊天消息';
			}else{
				$v['S_MobanType'] = '模版消息';
			}
			$v['S_Time'] = date('Y-m-d',$v['S_Time']);
		}

		$_SESSION['do_moban_true_sum_send'] = '';

		$_SESSION['do_moban_false_sum_send'] = '';


		$this->filename='moban_send_list.html';
		$this->tpl('dataArr',$page->dataArr);
		$this->tpl('pageStr',$page->pageStr(3));
		$this->toString();

	}

	/*发送失败内容查看*/
	public function sendFalseShow(){
		$id = G('id',2,2);

		//保存发送纪录
		$this->setMysql();
		$this->c->table('moban_send');
		$result = $this->c->search("S_Id='".$id."'");
		$result = $result[0];

		$result['S_Time'] = date('Y-m-d',$result['S_Time']);
		if($result['S_MobanType'] == 'moban'){
			$result['S_Remark'] = json_decode($result['S_Remark'],true);
		}


		$this->tpl('result',$result);
		$this->filename='moban_send_record.html';
		$this->toString();
	}


	/*失败重新发送*/
	public function doFalseSendRecord(){
		$id = G('id',2,2);
		if(empty($id)){
			echo "没有该条数据！";
			exit;
		}
		$this->setMysql();
		$this->c->table('moban_send s ,moban_false f');
		$where = "s.S_Id = $id AND s.S_Id=f.F_MobanSend";
		$result = $this->c->search($where);
		$result = $result[0];

		if($result['S_MobanType'] == 'moban'){
			$result['S_Remark'] = json_decode($result['S_Remark'],true);
		}

		//反转后的需发送人UID，键为UID
		$doSendUserlArr = array_flip(explode(',',$result['F_FalseId']));

		$userSum = count($doSendUserlArr);

		$_SESSION['do_moban_false_sum_send'] = $userSum;

		//找出所有人OpenId
		$this->dbConnect();//切换到shopnc数据库
		$this->c->table('member');
		$shopWHere = "member_id in($result[F_FalseId])";
		$shopResult = $this->c->search($shopWHere,'','','member_id,openid');

		if(empty($shopResult)){
			echo "没有用户数据！";
			exit;
		}

		require_once($_SERVER['DOCUMENT_ROOT']."/core/framework/libraries/weixinsdk.php");
		require_once(dirname(__FILE__)."/../../model/class/weixinMoban.class.php");
		$weixinMoban = new weixinMoban;//模板消息
		$weixinInfo = new weixinSDK;//微信基类
		$moban_token = $weixinInfo->token;
		$i = 1;
		$ii = 1;
		foreach($shopResult as $k => $v){

			if($result['S_MobanType'] == 'text'){
				$result = $this->sendMessage($v['openid'],$result['S_Remark'],$moban_token);
			}

			if($result['S_MobanType'] == 'moban'){
				$result = $weixinMoban->$result['S_Vname']($v['openid'],$result['S_Remark'],$moban_token);
			}

			$resultJs = json_decode($result,true);

			if($resultJs['errmsg'] == 'ok'){

				$_SESSION['do_moban_true_sum_send'] = $_SESSION['do_moban_true_sum_send']+1;

				$_SESSION['do_moban_false_sum_send'] = $_SESSION['do_moban_false_sum_send']-1;

				unset($doSendUserlArr[$v['member_id']]);

				$ii++;
			}else{
				if($resultJs['errcode'] == '40001'){
					$weixinInfo->set_null_token();
					break;
				}
				if($resultJs['errcode'] == '41001'){
					break;
				}

				$_SESSION['do_moban_false_id'] .= $v['member_id'].',';
			}

			if($i >= 100){
				break;
			}

			$i++;
		}

		$userArr = join(',',array_flip($doSendUserlArr));

		//更新失败用户数
		$this->setMysql();
		$this->c->table('moban_false');
		$dateArr['F_FalseId'] = $userArr?$userArr:"Null";
		$this->c->update($dateArr,"F_MobanSend='".$id."'");

		$this->c->table('moban_send');
		$upArr['S_False'] = $userSum-$ii+1;
		$upArr['S_False'] = $upArr['S_False']?$upArr['S_False']:'0';
		$this->c->update($upArr,"S_Id='".$id."'");


echo '已成功发送'.$_SESSION['do_moban_true_sum_send'].'用户,发送失败'.($_SESSION['do_moban_false_sum_send']?$_SESSION['do_moban_false_sum_send']:'0').'用户';

		$js = <<<TIAO
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>微信模板发消息发送</title>
<script type="text/javascript">     
function countDown(secs,surl){     
 //alert(surl);     
 var jumpTo = document.getElementById('jumpTo');
 jumpTo.innerHTML=secs;  
 if(--secs>0){     
     setTimeout("countDown("+secs+",'"+surl+"')",1000);     
     }     
 else{       
     location.href=surl;     
     }     
 }     
</script> 
</head>
<body><span id="jumpTo">10</span>秒后自动跳转...
<script type="text/javascript">countDown(10,'http://www.96567.com/wm/index.php?m=manageUser&p=manage&c=doFalseSendRecord&id={$id}');</script>  
</body>
</html>
TIAO;
	echo $js;




	}



/**

直接链接


*/
	public function avUrl(){


		if($_POST['sub_form'] == 'ok'){

			$url = urlencode(trim($_POST['av_url']));

			$url = $url?$url:'1';

			if(!empty($url)){
				$this->c->table('setting');

				$dataArr['value'] = $url;

				if($this->c->update($dataArr,"name='avUrl'")){
					header("location:http://www.96567.com/wm/index.php?m=manageUser&p=manage&c=avUrl");
				}else{
					header("location:http://www.96567.com/wm/index.php?m=manageUser&p=manage&c=avUrl");
				}
			}
		}else{
			$this->filename='avUrl.html';
			$this->toString();
		}
		
	}


/**
公用信息



*/
	/*获取商品分类*/
	private function getGoodsClass(){
		$this->c->table('goods_class');
		$result = $this->c->search("gc_parent_id='0'",'','','gc_id,gc_name');
		return $result;
	}


	
	/*获取数据*/
	private function getMobanHtmlVal(){
		switch (trim($_POST['MoBanStyle'])){
			case 'GongGao':
				$moban_array['MoBanStyle'] = $_POST['MoBanStyle'];
				$moban_array['first'] = $_POST['GongGao_first'];
				$moban_array['keyword1'] = $_POST['GongGao_keyword1'];
				$moban_array['keyword2'] = $_POST['GongGao_keyword2'];
				$moban_array['remark'] = $_POST['GongGao_remark'];
				$moban_array['url'] = $_POST['GongGao_url'];
				break;
			case 'ChaoYue':
				$moban_array['MoBanStyle'] = $_POST['MoBanStyle'];
				$moban_array['first'] = $_POST['ChaoYue_first'];
				$moban_array['number'] = $_POST['ChaoYue_number'];
				$moban_array['name'] = $_POST['ChaoYue_name'];
				$moban_array['remark'] = $_POST['ChaoYue_remark'];
				$moban_array['url'] = $_POST['ChaoYue_url'];
				break;
			case 'LePaiJieShu':
				$moban_array['MoBanStyle'] = $_POST['MoBanStyle'];
				$moban_array['first'] = $_POST['LePaiJieShu_first'];
				$moban_array['number'] = $_POST['LePaiJieShu_number'];
				$moban_array['name'] = $_POST['LePaiJieShu_name'];
				$moban_array['deadline'] = $_POST['LePaiJieShu_deadline'];
				$moban_array['remark'] = $_POST['LePaiJieShu_remark'];
				$moban_array['url'] = $_POST['LePaiJieShu_url'];
				break;
		}

		return $moban_array;
	}
	


	/*获取所有模板定义信息*/
	private function getMobanVal($off=''){

		$this->c->table('moban_val');
		$result = $this->c->search();

		foreach($result as $k => $v){
			$dataArr[$v['V_Name']][$v['V_Id']] = json_decode($v['V_Remark'],true);
			$dataArr[$v['V_Name']][$v['V_Id']]['V_Id'] = $v['V_Id'];
			$dataArr[$v['V_Name']][$v['V_Id']]['V_ChangJing'] = $v['V_ChangJing'];
			$dataArr[$v['V_Name']][$v['V_Id']]['V_MoBanStyle'] = $v['V_MoBanStyle'];
			$dataArr[$v['V_Name']][$v['V_Id']]['V_Name'] = $v['V_Name'];
			$dataArr[$v['V_Name']][$v['V_Id']]['V_Title'] = $v['V_Title'];
			$dataArr[$v['V_Name']][$v['V_Id']]['V_Url'] = $v['V_Url'];
		}

		foreach($result as $k => &$v){
			$v['V_Remark'] = json_decode($v['V_Remark'],true);
		}

		return $off?$dataArr:$result;
	}


	/*切换回weixin数据库*/
	private function setMysql(){
		$this->c = new mysqlAction(config::$dbArr);//实例化数据库对象
		$this->Prefix = config::$dbArr['Prefix'];
	}


	private function sendMessage($openID,$content,$token,$dataArr=array(),$type='text'){
		$api = 'https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$token;
		$dataArr['touser'] = $openID;
		$dataArr['msgtype'] = $type;
		$dataArr[$type]['content'] = urlencode($content);
		$dataJSON =  urldecode(json_encode($dataArr));
		$returnJson = $this->httpPOST($api,$dataJSON);
		return $returnJson;
	}

	private function httpPOST($url,$data){
		$curl = curl_init();      
		curl_setopt($curl, CURLOPT_URL, $url);       
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);      
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);      
		curl_setopt($curl, CURLOPT_POST, 1);      
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);      
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
		$result = curl_exec($curl); 
		if (curl_errno($curl)) { 
			return 'Errno'.curl_error($curl);      
		}      
		curl_close($curl); 
		return $result;  
	}


	public function ajaxGetMobanVal(){
		$this->setMysql();

		$id = intval(trim($_POST['id']));

		$this->c->table('moban_val');

		$result = $this->c->search("V_Id='".$id."'");

		foreach($result as $k => $v){
			$dataArr['V_Remark'] = json_decode($v['V_Remark'],true);
			$dataArr['V_Id'] = $v['V_Id'];
			$dataArr['V_ChangJing'] = $v['V_ChangJing'];
			$dataArr['V_MoBanStyle'] = $v['V_MoBanStyle'];
			$dataArr['V_Name'] = $v['V_Name'];
			$dataArr['V_Title'] = $v['V_Title'];
			$dataArr['V_Url'] = $v['V_Url'];
		}

		echo json_encode($dataArr);
	}




}