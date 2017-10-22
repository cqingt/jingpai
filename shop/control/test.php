<?php
header ("Content-Type: text/html; charset=utf-8");


defined('InShopNC') or exit('Access Invalid!');
class testControl extends BaseHomeControl {
	public function __construct() {
		parent::__construct();
		//读取语言包
	}
	
	//已签收订单操作错误改变会未签收状态
	public function WeiQianShouOrderOp(){
		$order_sn = $_GET['order_sn'];
		$model_order = Model('order');
		/**检查订单号是否存在**/
		$orderCont = $model_order->getOrderCount(array('order_sn'=>$order_sn,'order_state'=>40));
		if($orderCont <= 0) {
			echo "订单不存在或者未签收不能执行此操作";
			exit;
		}
		try {
			$order_info	= $model_order->getOrderInfo(array('order_sn'=>$order_sn,'order_state'=>40));
			if (!$order_info) {
                throw new Exception('保存失败');
            }
			//更新订单状态
            $update_order = array();
            $update_order['finnshed_time'] = '';
            $update_order['order_state'] = 30;
            $update = $model_order->editOrder($update_order,array('order_id'=>$order_info['order_id']));
			if (!$update) {
                throw new Exception('保存失败');
            }
			$crm_model = Model('crm');
			$crm_order_info = $crm_model->getYWinfo(array('orderid'=>$order_info['order_id']));
			if(!empty($crm_order_info)){
                $crm_model->updateYWinfo(array('orderid'=>$order_info['order_id']),array('shipping_status'=>'1'));
            }
			//添加订单日志
            $data = array();
            $data['order_id'] = $order_info['order_id'];
            $data['log_role'] = '系统';
            $data['log_msg'] = '签收订单操作错误改变回未签收状态';
            $data['log_user'] = '系统';
            $data['log_orderstate'] = 30;
            $model_order->addOrderLog($data);
			$order_amount = '-'.$order_info['order_amount'];
			//减去会员积分
            if (C('points_isuse') == 1){
                Model('points')->savePointsLog('order',array('pl_memberid'=>$order_info['buyer_id'],'pl_membername'=>$order_info['buyer_name'],'orderprice'=>$order_amount,'order_sn'=>$order_info['order_sn'],'order_id'=>$order_info['order_id']),true);
            }
			//减去会员经验值
            Model('exppoints')->saveExppointsLog('order',array('exp_memberid'=>$order_info['buyer_id'],'exp_membername'=>$order_info['buyer_name'],'orderprice'=>$order_amount,'order_sn'=>$order_info['order_sn'],'order_id'=>$order_info['order_id']),true);
			print_r(callback(true,'操作成功'));
		} catch (Exception $e) {
            print_r(callback(false,'操作失败'));
        }

	}

	//航天首日封兑换数据
	public function HangTianShouRiFongOp(){
		$ZtModel = Model('zhuanti');
		$LotteryList = $ZtModel->getLotteryList(array('ad_name'=>'20161022','is_fafang'=>1));
		$str = '<table class="table" width="60%" border="0" cellspacing="1" cellpadding="0">';
		$str .= '<tr><td>原订单号</td><td>原订单金额</td><td>下单时间</td><td>状态</td><td>用户名</td><td>首日封订单号</td></tr>';
		$order = Model('order');
		foreach($LotteryList as $k=>$v){
			$order_info = $order->getOrderInfo(array('order_id'=>$v['l_orderid']),array(),'order_sn,order_amount,add_time,buyer_name,order_state');
			if($order_info['order_state'] == 0){ $order_state = '取消'; }
			if($order_info['order_state'] == 10){ $order_state = '待付款'; }
			if($order_info['order_state'] == 20){ $order_state = '待发货'; }
			if($order_info['order_state'] == 30){ $order_state = '待收货'; }
			if($order_info['order_state'] == 40){ $order_state = '已完成'; }
			$str .= '<tr><td>&nbsp;'.$order_info['order_sn'].'</td><td>'.$order_info['order_amount'].'</td><td>'.date("Y-m-d H:i:s",$order_info['add_time']).'</td><td>'.$order_state.'</td><td>'.$order_info['buyer_name'].'</td><td>&nbsp;'.$v['order_sn'].'</td></tr>';
		}

		$str .= "</table>";
		echo $str;
		exit;
	}
	
	public function ClassGoodsOrderInfoOp(){
		$Model = Model('goods_class');
		$goods_class = $Model->getChildClass(668);
		$SQL = "SELECT order_id FROM shop_order as a,shop_yw_info as b where a.order_id = b.orderid AND a.add_time > '1472659200' AND b.shipping_status > 0 AND b.order_status = 1 AND a.order_sn LIKE  '%80000000%' ";

		$str = '<table class="table" width="60%" border="0" cellspacing="1" cellpadding="0">';
		$str .= '<tr><td>分类</td><td>销售金额</td><td>回款金额</td></tr>';
		$QbArr = array();
		foreach($goods_class as $k=>$v){
			$QbArr[] = $v['gc_id'];
		}


		$Order_InFo = $Model->query("SELECT sum(goods_pay_price-(Discount*goods_num)) as goods_pay_price FROM shop_order_goods where order_id in(".$SQL.") AND gc_id in(".implode(',',$QbArr).") AND Is_Crm = 0"); //查询钱币销售金额
		echo "SELECT sum(goods_pay_price-(Discount*goods_num)) as goods_pay_price FROM shop_order_goods where order_id in(".$SQL.") AND gc_id in(".implode(',',$QbArr).") AND Is_Crm = 0";
		$Order_InFo1 = $Model->query("SELECT sum(goods_pay_price-(Discount*goods_num)) as goods_pay_price FROM shop_order_goods where order_id in(".$SQL." AND b.pay_status = 3) AND gc_id in(".implode(',',$QbArr).") AND Is_Crm = 0"); //查询钱币回款金额
		$str .= '<tr><td>钱币</td><td>'.$Order_InFo[0]['goods_pay_price'].'</td><td>'.$Order_InFo1[0]['goods_pay_price'].'</td></tr>';
		
		$goods_class1 = Model('goods_class')->getChildClass('678');
		$YpArr = array();
		foreach($goods_class1 as $k1=>$v1){
			$YpArr[] = $v1['gc_id'];
		}
		
		$Order_InFo2 = $Model->query("SELECT sum(goods_pay_price-(Discount*goods_num)) as goods_pay_price FROM shop_order_goods where order_id in(".$SQL.") AND gc_id in(".implode(',',$YpArr).") AND Is_Crm = 0"); //查询邮票销售金额
		$Order_InFo3 = $Model->query("SELECT sum(goods_pay_price-(Discount*goods_num)) as goods_pay_price FROM shop_order_goods where order_id in(".$SQL." AND b.pay_status = 3) AND gc_id in(".implode(',',$YpArr).") AND Is_Crm = 0"); //查询邮票回款金额
		$str .= '<tr><td>邮票</td><td>'.$Order_InFo2[0]['goods_pay_price'].'</td><td>'.$Order_InFo3[0]['goods_pay_price'].'</td></tr>';
		
		$goods_class2 = $Model->getChildClass(12);
		$YpArr = array();
		foreach($goods_class2 as $k=>$v){
			$YpArr[] = $v['gc_id'];
		}

		$Order_InFo4 = $Model->query("SELECT sum(goods_pay_price-(Discount*goods_num)) as goods_pay_price FROM shop_order_goods where order_id in(".$SQL.") AND gc_id in(".implode(',',$YpArr).") AND Is_Crm = 0"); //查询邮票销售金额
		$Order_InFo5 = $Model->query("SELECT sum(goods_pay_price-(Discount*goods_num)) as goods_pay_price FROM shop_order_goods where order_id in(".$SQL." AND b.pay_status = 3) AND gc_id in(".implode(',',$YpArr).") AND Is_Crm = 0"); //查询邮票回款金额
		$str .= '<tr><td>金银制品</td><td>'.$Order_InFo4[0]['goods_pay_price'].'</td><td>'.$Order_InFo5[0]['goods_pay_price'].'</td></tr>';
		
		
		$str .= "</table>";
		echo $str;
		exit;
	}
	
	//商家分类统计
	public function ClassGoodsInfoOp(){
		$Model = Model('goods_class');
		$goods_class = $Model->getTreeClassList();

		$store_where = "is_own_shop = 0 AND store_id <> 22 AND store_is_shuhua_ = 0"; //第三方订单查询
		$StoreList = Model('store')->getStoreList($store_where,'','','store_id','0,5000');
		if($StoreList){
			$store = array();
			foreach($StoreList as $k=>$v){
				$store[] = $v['store_id'];
			}
			$where['store_id'] = array('in',$store);
		}
		$str = '<table class="table" width="60%" border="0" cellspacing="1" cellpadding="0">';
		$str .= '<tr><td>分类</td><td>数量</td></tr>';
		foreach($goods_class as $k=>$v){
			if($v['deep'] == 2 && $v['gc_name']){
				 $where['gc_id_2'] = $v['gc_id'];
				 $coint = Model('goods')->getGoodsCommonCount($where);
				 $str .= '<tr><td>'.$v['gc_name'].'</td><td>'.$coint.'</td></tr>';
			}
		}
		$str .= "</table>";
		echo $str;
		exit;
		
	}
	//
	public function memberDaoChuOp(){
		$Model = Model('member');
		$member_info = $Model->query("SELECT member_id,member_name,member_exppoints FROM  `shop_member` WHERE member_exppoints >= 1000");
		$this->DaoChu_Export("银卡以上会员列表"); //设置导出格式
		$str = '<table class="table" width="60%" border="0" cellspacing="1" cellpadding="0">';
		if($member_info){
			foreach($member_info as $k=>$v){
                $member_gradeinfo = Model('member')->getOneMemberGrade(intval($v['member_exppoints']));
				 $str .= '<tr><td>'.$v['member_id'].'</td><td>'.$v['member_name'].'</td><td>'.$member_gradeinfo['level_name'].'</td></tr>';
				
			}
		}
		$str .= "</table>";
		echo $str;
		exit;
	}

	
	//合并送礼客户导出
	public function SongLiKeHuHeOp(){
		$tempArr = file(dirname(__FILE__).'/songlikehu.txt');
		$Model = Model('member');
		$this->DaoChu_Export("送礼客户合并"); //设置导出格式
		$str = '<table class="table" width="60%" border="0" cellspacing="1" cellpadding="0">';
        $str .= '<tr><td>部门</td><td>注册会员</td><td>银卡会员</td><td>金卡会员</td><td>钻石会员</td><td>至尊会员</td></tr>';
		foreach($tempArr as $k=>$v){
			$dataArr = trim($v);
			$tem = explode('	',$dataArr);
			$member_info = $Model->query("SELECT member_name,member_exppoints FROM  `shop_member` WHERE member_id = '".intval($tem[1])."'");
			if ($member_info){
                $member_gradeinfo = Model('member')->getOneMemberGrade(intval($member_info[0]['member_exppoints']));
            }
			$address = $Model->query("SELECT area_info,address FROM  `shop_address` WHERE member_id = '".intval($tem[1])."' order by address_id desc limit 1");

			$order_info = $Model->query("SELECT sum(order_amount) as z_order_amount FROM  `shop_order` WHERE buyer_id = '".intval($tem[1])."' AND order_state = 40");
			if($address && intval($order_info[0]['z_order_amount']) > 0){
				$deteArr[$tem[3]][$member_gradeinfo['level_name']] +=1;
				//$str .= '<tr><td>&nbsp;'.$tem[0].'</td><td>&nbsp;'.$member_info[0]['member_name'].'</td><td>&nbsp;'.$address[0]['area_info'].$address[0]['address'].'</td><td>&nbsp;'.$member_gradeinfo['level_name'].'</td><td>&nbsp;'.intval($order_info[0]['z_order_amount']).'</td><td>&nbsp;'.$tem[2].'</td><td>&nbsp;'.$tem[3].'</td></tr>';
			}
		}
		$zhu = 0;
		$yin = 0;
		$jin = 0;
		$zhuan = 0;
		$zhi = 0;
		foreach($deteArr as $dk=>$dv){
			$str .= '<tr><td>&nbsp;'.$dk.'</td><td>&nbsp;'.intval($dv['注册会员']).'</td><td>&nbsp;'.intval($dv['银卡会员']).'</td><td>&nbsp;'.intval($dv['金卡会员']).'</td><td>&nbsp;'.intval($dv['钻石会员']).'</td><td>&nbsp;'.intval($dv['至尊会员']).'</td></tr>';
			$zhu += intval($dv['注册会员']);
			$yin += intval($dv['银卡会员']);
			$jin += intval($dv['金卡会员']);
			$zhuan += intval($dv['钻石会员']);
			$zhi += intval($dv['至尊会员']);
		}
		$str .= '<tr><td>合计</td><td>&nbsp;'.$zhu.'</td><td>&nbsp;'.$yin.'</td><td>&nbsp;'.$jin.'</td><td>&nbsp;'.$zhuan.'</td><td>&nbsp;'.$zhi.'</td></tr>';
		$str .= "</table>";
		echo $str;
		exit;
	}
	//送礼客户导出
	public function SongLiKeHuOp(){
		$tempArr = file(dirname(__FILE__).'/songlikehu.txt');
		$Model = Model('member');
		$this->DaoChu_Export("送礼客户"); //设置导出格式
		$str = '<table class="table" width="60%" border="0" cellspacing="1" cellpadding="0">';
        $str .= '<tr><td>姓名</td><td>会员账号</td><td>地址</td><td>客户级别</td><td>消费金额</td><td>业务员</td><td>部门</td></tr>';
		foreach($tempArr as $k=>$v){
			$dataArr = trim($v);
			$tem = explode('	',$dataArr);
			$member_info = $Model->query("SELECT member_name,member_exppoints FROM  `shop_member` WHERE member_id = '".intval($tem[1])."'");
			if ($member_info){
                $member_gradeinfo = Model('member')->getOneMemberGrade(intval($member_info[0]['member_exppoints']));
            }
			$address = $Model->query("SELECT area_info,address FROM  `shop_address` WHERE member_id = '".intval($tem[1])."' order by address_id desc limit 1");

			$order_info = $Model->query("SELECT sum(order_amount) as z_order_amount FROM  `shop_order` WHERE buyer_id = '".intval($tem[1])."' AND order_state = 40");
			if($address && intval($order_info[0]['z_order_amount']) > 0){
				$str .= '<tr><td>&nbsp;'.$tem[0].'</td><td>&nbsp;'.$member_info[0]['member_name'].'</td><td>&nbsp;'.$address[0]['area_info'].$address[0]['address'].'</td><td>&nbsp;'.$member_gradeinfo['level_name'].'</td><td>&nbsp;'.intval($order_info[0]['z_order_amount']).'</td><td>&nbsp;'.$tem[2].'</td><td>&nbsp;'.$tem[3].'</td></tr>';
			}
		}
		$str .= "</table>";
		echo $str;
		exit;
	}

	//传家宝活动优惠劵发放
	public function FaChuanJiaOp(){
		$tempArr = file(dirname(__FILE__).'/1111111111.txt');
		$Model = Model('member');
		$this->DaoChu_Export("会员数据查询"); //设置导出格式
		$str = '<table class="table" width="60%" border="0" cellspacing="1" cellpadding="0">';
        $str .= '<tr><td>会员名</td><td>手机号</td><td>注册时间</td><td>来源</td></tr>';
		foreach($tempArr as $k=>$v){
			$member_mobile = trim($v);
			$mobile = @file_get_contents("http://crm.96567.com/index.php?m=api&c=Jmobile&p=action&mobile=".$member_mobile);
			$member_info = $Model->query("SELECT member_name,member_truename,member_mobile,member_time,member_from FROM  `shop_member` WHERE member_mobile = '".$mobile."'");
			if($member_info){
			$str .= '<tr><td>'.$member_info[0]['member_name'].'</td><td>'.$member_mobile.'</td><td>'.date('Y-m-d H:i:s',$member_info[0]['member_time']).'</td><td>'.$member_info[0]['member_from'].'</td></tr>';
			}

		}
		$str .= "</table>";
		echo $str;
		exit;
	}
	
	//1月1日-6月30日所有crm已完成自主订单数量、订单金额，并统计每个类目商品订单数量及金额
	//1月1日-6月30日所有商家已完成订单数量、订单金额，并统计每个类目商品订单数量及金额
	//1月1日-6月30日crm所有已完成的非活动自主订单数量、订单金额，并统计每个类目商品订单数量及金额
	public function getorderCountOp(){
		$Model = Model('order');
//		$My_info = $Model->query("SELECT sum(order_amount) as order_amount,count(0) as num FROM  `shop_order` WHERE order_id IN(select orderid from shop_yw_info where order_status = 1 AND shipping_status = 2 AND pay_status >= 2 AND order_sn like '%8000000%') AND add_time > 1451577600 AND add_time < 1467302400");
//		echo '1月1日-6月30日所有crm已完成自主订单数量：'.$My_info[0]['num'].'&nbsp;&nbsp;订单金额：'.$My_info[0]['order_amount'];
//		$cat_order = $Model->query("select (select gc_name from shop_goods_class where `shop_goods_class`.gc_id = (select gc_id_2 from shop_goods where `shop_goods`.goods_id = `shop_order_goods`.goods_id)) as gc_name,goods_id,sum(goods_pay_price) as price,sum(goods_num) as goods_num from shop_order_goods where order_id in(SELECT order_id FROM  `shop_order` WHERE order_id IN(select orderid from shop_yw_info where order_status = 1 AND shipping_status = 2 AND pay_status >= 2 AND order_sn like '%8000000%') AND add_time > 1451577600 AND add_time < 1467302400) group by (select gc_id_2 from shop_goods where `shop_goods`.goods_id = `shop_order_goods`.goods_id)");
//		foreach($cat_order as $ck=>$cv){
//			echo '<br />'.$cv['gc_name'].' 类目下 产品数量：'.$cv['goods_num'].' 金额：'.$cv['price'];
//		}
//		/*************2********************/
//		
//		$My_info = $Model->query("SELECT sum(order_amount) as order_amount,count(0) as num FROM  `shop_order` WHERE order_id NOT IN(select orderid from shop_yw_info) AND order_state = 40 AND add_time > 1451577600 AND add_time < 1467302400");
//		echo '<br /><br /><br />1月1日-6月30日所有商家已完成订单数量：'.$My_info[0]['num'].'&nbsp;&nbsp;订单金额：'.$My_info[0]['order_amount'];
//		$cat_order = $Model->query("select (select gc_name from shop_goods_class where `shop_goods_class`.gc_id = (select gc_id_2 from shop_goods where `shop_goods`.goods_id = `shop_order_goods`.goods_id)) as gc_name,sum(goods_pay_price) as price,count(0) as num from shop_order_goods where order_id in(SELECT order_id FROM  `shop_order` WHERE order_id NOT IN(select orderid from shop_yw_info) AND add_time > 1451577600 AND add_time < 1467302400 AND order_state = 40) group by (select gc_id_2 from shop_goods where `shop_goods`.goods_id = `shop_order_goods`.goods_id)");
//		foreach($cat_order as $ck=>$cv){
//			echo '<br />'.$cv['gc_name'].' 类目下 产品数量：'.$cv['num'].' 金额：'.$cv['price'];
//		}
		/*************非活动订单********************/
		$timeArray = array(
			0=>array('set'=>'2016-01-01','end'=>'2016-02-01'),
			1=>array('set'=>'2016-02-01','end'=>'2016-03-01'),
			2=>array('set'=>'2016-03-01','end'=>'2016-04-01'),
			3=>array('set'=>'2016-04-01','end'=>'2016-05-01'),
			4=>array('set'=>'2016-05-01','end'=>'2016-06-01'),
			5=>array('set'=>'2016-06-01','end'=>'2016-07-01'),
			6=>array('set'=>'2016-07-01','end'=>'2016-08-01'),
		);
		foreach($timeArray as $ik=>$iv){
			echo '<br /> <br />'.date('Y-m',strtotime($iv['set'])).'统计';
			$My_info = $Model->query("SELECT sum(order_amount) as order_amount,count(0) as num FROM  `shop_order` WHERE order_id IN(select orderid from shop_yw_info where order_status = 1 AND shipping_status = 2 AND pay_status >= 2 AND order_sn like '%8000000%' AND (referer = '本站' or referer='手机站')) AND add_time > ".strtotime($iv['set'])." AND add_time < ".strtotime($iv['end'])."");
			echo '<br />'.date('Y-m',strtotime($iv['set'])).'crm所有已完成的非活动自主订单数量：'.$My_info[0]['num'].'&nbsp;&nbsp;订单金额：'.$My_info[0]['order_amount'];
			$cat_order = $Model->query("select (select gc_name from shop_goods_class where `shop_goods_class`.gc_id = (select gc_id_2 from shop_goods where `shop_goods`.goods_id = `shop_order_goods`.goods_id)) as gc_name,sum(goods_pay_price) as price,count(0) as num from shop_order_goods where order_id in(SELECT order_id FROM  `shop_order` WHERE order_id IN(select orderid from shop_yw_info where order_status = 1 AND shipping_status = 2 AND pay_status >= 2 AND order_sn like '%8000000%' AND (referer = '本站' or referer='手机站')) AND add_time > ".strtotime($iv['set'])." AND add_time < ".strtotime($iv['end']).") group by (select gc_id_2 from shop_goods where `shop_goods`.goods_id = `shop_order_goods`.goods_id)");
			foreach($cat_order as $ck=>$cv){
				echo '<br />'.$cv['gc_name'].' 类目下 产品数量：'.$cv['num'].' 金额：'.$cv['price'];
			}
		}
	}


	public function member_commonOp(){
		
//		// 生成商店二维码
//		$store_id = 13;
//        require_once(BASE_RESOURCE_PATH.DS.'phpqrcode'.DS.'index.php');
//        $PhpQRCode = new PhpQRCode();
//        $PhpQRCode->set('pngTempDir',BASE_UPLOAD_PATH.DS.ATTACH_STORE.DS.$store_id.DS);
//		//生成店铺二维码
//		$qrcode_url=M_SITE_URL . '/index.php?act=member_store&op=store_info&store_id='.$store_id;
//		$PhpQRCode->set('date',$qrcode_url);
//		$PhpQRCode->set('pngTempName', $store_id . '_store.png');
//		$PhpQRCode->init();
//		echo '生成店铺二维码成功》》》'.$qrcode_url;
//		echo '<br/>';
//		exit;
//// 删除商品缓存

		//更新商品缓存
		$goods_list = Model('goods')->getGoodsList(array('store_id'=>'22'), 'goods_id,goods_commonid,store_id');
		foreach($goods_list as $k=>$val){
			dcache($val['goods_id'], 'goods');
//			// 删除商品规格缓存
			dcache($val['goods_commonid'], 'goods_spec');
			dcache($val['goods_commonid'], 'goods_common');
		}
		echo 'OK';
		exit;
//		$model = Model('member');
//		$member_info = $model->query("SELECT member_id FROM  `shop_member` WHERE member_id NOT IN(select member_id from shop_member_common)");
//		
//		//var_dump($member_info);
//		exit;
//		foreach($member_info as $k=>$v){;
//			$a = $model->query("insert into shop_member_common(member_id,auth_code,send_acode_time) VALUES ('".$v['member_id']."','',0)");
//		}
	}
	public function daochuhdOp(){
	
		
		$goodsid_in = "11734,4262,8262,11735,14809,14241,16861,15112,11729,12384,15597,963,16091";
		$model = Model('order');
//		$evaluate_goods = $model->query("SELECT geval_frommemberid,geval_frommembername,geval_content FROM  `shop_evaluate_goods` WHERE geval_addtime > 1463414400 AND geval_addtime < 1464710400 AND geval_goodsid in(".$goodsid_in.") AND geval_scores = 5");
//		foreach($evaluate_goods as $k=>$v){
//			if(strlen($v['geval_content']) >= 10){
//				$member_info = $model->query("SELECT member_mobile FROM  `shop_member` WHERE member_id =".$v['geval_frommemberid']." ");
//				$mobile = @file_get_contents("http://crm.96567.com/index.php?m=api&c=JMmobile&p=action&mobile=".$member_info[0]['member_mobile']);
//				Model('zhuanti')->store_exchangeVoucher(7,$v['geval_frommemberid']);
//
//				$sms = new Sms();
//				$result = $sms->send($mobile,"尊敬的会员您好：5元现金券已到账！感谢您对收藏天下5·18评论返现活动的参与。我们致力于为您提供更好的收藏服务。");
//
//				echo $mobile.'==='.$v['geval_frommemberid'].'=='.$v['geval_frommembername'].'=='.$v['geval_content'].'<br />';
//			}
//		}
		exit;
		$order_goods = $model->query("SELECT goods_name,sum(goods_pay_price) as goods_pay_price,sum(goods_num) as goods_num FROM  `shop_order` as a,shop_order_goods as b WHERE b.goods_id in(".$goodsid_in.") AND a.order_crm_add = 10 AND a.order_state > 20 AND a.add_time > 1462032000 AND a.add_time < 1463414400 AND a.order_id = b.order_id group by goods_id");
		foreach($order_goods as $k=>$v){
			echo date("Y-m-d",1462032000).'{'.$v['goods_name'].'}数量=='.$v['goods_num'].'金额=='.$v['goods_pay_price'].'<br />';
		}
		exit;

		$order_info = $model->query("SELECT count(*) as num,sum(order_amount) as order_amount FROM  `shop_order` WHERE order_crm_add = 10 AND order_state > 20 AND add_time > 1463414400 AND add_time < 1464710400 AND order_id in(select order_id from shop_order_goods where goods_id in(".$goodsid_in."))");


		$member_count = $model->query("SELECT count(*) as num FROM  `shop_member` WHERE member_time > 1463414400 AND member_time < 1464710400 AND member_from like '%518大放价%'");
//
		$evaluate_goods = $model->query("SELECT count(*) as num,geval_goodsname FROM  `shop_evaluate_goods` WHERE geval_addtime > 1462032000 AND geval_addtime < 1463414400 AND geval_goodsid in(".$goodsid_in.") AND geval_scores = 5 group by geval_goodsid");
		foreach($evaluate_goods as $k=>$v){
			echo '{'.$v['geval_goodsname'].'}评价数量=='.$v['num'].'<br />';
		}
		echo '金额=='.$order_info[0]['order_amount'].'==订单量=='.$order_info[0]['num'].'==注册量=='.$member_count[0]['num'].'=={'.$evaluate_goods[0]['geval_goodsname'].'}评价数量=='.$evaluate_goods[0]['num'];
		exit;
		//$this->DaoChu_Export("17-23订单"); //设置导出格式
		$str = '<table class="table" width="60%" border="0" cellspacing="1" cellpadding="0">';
        $str .= '<tr><td>订单号</td><td>订单金额</td><td>下单日期</td><td>会员名</td><td>订单状态</td></tr>';
		if($order_info){
			foreach($order_info as $k=>$v){
				$order_state = '';
				if($v['order_state'] == 10){
					$order_state = '代付款';
				}elseif($v['order_state'] == 20){
					$order_state = '代发货';
				}elseif($v['order_state'] == 30){
					$order_state = '代收货';
				}elseif($v['order_state'] == 40){
					$order_state = '已完成';
				}
				
				$str .= '<tr><td>&nbsp;'.$v['order_sn'].'</td><td>&nbsp;'.$v['order_amount'].'</td><td>&nbsp;'.date("Y-m-d",$v['add_time']).'</td><td>&nbsp;'.$v['buyer_name'].'</td><td>&nbsp;'.$order_state.'</td></tr>';
			}
		}
		$str .='</table>';
        echo $str;

		//$member_count = $model->query("SELECT count(*) as num FROM  `shop_member` WHERE member_time > 1463414400 AND member_time < 1464019200");
		//var_dump($member_count);
        exit;
	}
    /**
     * 修改关键字内容
     * @return [type] [description]
     */
    public function cms_articleOp(){
        $model = Model('cms_article');
        $cms_article_list = $model->query("SELECT * FROM  `shop_cms_article` WHERE `article_id` between 26000 and 31000 order by article_id");
        foreach($cms_article_list as $k=>$v){
            $article_keyword = $v['article_keyword'];
            $array_str = explode(',',$article_keyword);
            foreach($array_str as $kk=>$vv){
                if(strpos($vv,"书协")!== false){
                    $array_str[$kk] = "中国书协";
                }
            }
            $article_keyword = implode(',',$array_str);
            echo $v['article_id'],$article_keyword,"<br />";
            $model->query("UPDATE shop_cms_article SET article_keyword='".$article_keyword."' WHERE article_id =".intval($v['article_id'])."  ");
        }
        // var_dump($cms_article_list);
    }


    /**
     * 替换段首空格
     * @return [type] [description]
     */
    public function cms_article2Op(){
        $model = Model('cms_article');
        $cms_article_list = $model->query("SELECT * FROM  `shop_cms_article` WHERE  `article_content` LIKE  '%<p>　　%' and `article_id` between 26600 and 27000 order by article_id");
        foreach($cms_article_list as $k=>$v){
            $article_content = $v['article_content'];
            // echo $v['article_id'],$article_content;
            $article_content = str_replace('<p>　　','<p>',$article_content);//替换空格
            echo $v['article_id'],$article_content;
            $model->query("UPDATE shop_cms_article SET article_content='".$article_content."' WHERE article_id =".intval($v['article_id'])."  ");
        }
        // var_dump($cms_article_list);
    }



	public function cms_article1Op(){
		$model = Model('cms_article');
		$cms_article_list = $model->query("SELECT * FROM  `shop_cms_article` WHERE  `article_content` LIKE  '%class=\"clearfix\"%' order by article_id");
		foreach($cms_article_list as $k=>$v){
			$article_content = $v['article_content'];
			$article_content = str_replace('<div id="intro" class="clearfix">','<div id="intro" class="clearfix" style="text-align:center;">',$article_content);//图片居中
			$article_content = str_replace('<div class="left info">','<div class="left info" style="text-align:left;">',$article_content);//文字居右显示
			$article_content = str_replace('<h3>','',$article_content);
			$article_content = str_replace('</h3>','',$article_content);
			preg_match_all('/<td>(.*?)<\/td>/',$article_content,$match);
			$str = '';
			$str1 = '';
			foreach($match[1] as $mv){
				if(strstr($mv, '创作方向：')){
					$exp = explode('：',$mv);
					$str = str_replace(' ',',',$exp[1]);
					$str = rtrim($str, ",");
					$str = ltrim($str, ",");
				}

				if(strstr($mv, '历任职务: ')){
					$exp1 = explode(':',$mv);
					$exp1[1] = str_replace('<span class="zhiwu">','',$exp1[1]);
					$exp1[1] = str_replace('</span>','',$exp1[1]);
					$str1 = str_replace(' ',',',$exp1[1]);
					$str1 = rtrim($str1, ",");
					$str1 = ltrim($str1, ",");
				}
			}
			$article_keyword = '';
			if($str && $str1){
				$array_str = array($str,$str1);
				$article_keyword = implode(',',$array_str);
			}elseif($str){
				$article_keyword = $str;
			}elseif($str1){
				$article_keyword = $str1;
			}
			$model->query("UPDATE shop_cms_article SET  article_content =  '".$article_content."',article_keyword='".$article_keyword."' WHERE article_id =".intval($v['article_id'])."  ");
			echo $v['article_id']."<br />";
		}
		// var_dump($cms_article_list);
	}


	//更新用户收获地址手机号未加密的
	public function addressOp(){
	//商品上架
//		 $update = array('goods_state' => 1);
//		 $goods_commonid = array('15272','15308','15309','15310','15311','15312');
//        // 禁售商品、审核失败商品不能上架。
//		 $condition['goods_commonid'] = array('in',$goods_commonid);
//        $condition['goods_verify'] = array('neq', 0);
//        // 修改预约商品状态
//        $update['is_appoint'] = 0;
//		Model('goods')->editProduces($condition, $update);

//		$model = Model('order_goods');
//		  $order_goods = $model->query("select rec_id,goods_id,gc_id,store_id from shop_order_goods where commis_rate <> 5 AND store_id = 90 order by order_id desc");
//		$store_bind_class = Model('store_bind_class');
//		$store_gc_id_commis_rate = $store_bind_class->getStoreGcidCommisRateList($order_goods);
//		foreach($order_goods as $k=>$v){
//			if($store_gc_id_commis_rate[$v['store_id']]){
//				foreach($store_gc_id_commis_rate[$v['store_id']] as $sk=>$sv){
//				$model->query("UPDATE shop_order_goods SET  commis_rate =  '".intval($sv)."' WHERE gc_id =".intval($sk)." AND store_id = ".$v['store_id']." ");
//				}
//			}
//		}
		//$model = Model('address');
//		$address = $model->query("select address_id,mob_phone from shop_address where LENGTH(mob_phone) = 11 limit 100");
//		foreach($address as $k=>$v){
//			$mob_phone = file_get_contents("http://crm.96567.com/index.php?m=api&c=Jmobile&p=action&mobile=".$v['mob_phone']);
//			$model->query("UPDATE shop_address SET mob_phone='".$mob_phone."' WHERE address_id =  '".intval($v['address_id'])."'");
//			echo $v['mob_phone']."<br />";
//		}
	}
	//重新计算佣金比例
	public function testCommisOp(){
		$model = Model('order_goods');
        $order_goods = $model->query("select rec_id,goods_id,gc_id,store_id from shop_order_goods where commis_rate = 0 AND store_id > 0 AND store_id <> 22 AND store_id <> 3 AND store_id <> 7 AND store_id <> 13 AND store_id <> 19 AND store_id <> 20 order by order_id desc limit 0,100");
		$store_bind_class = Model('store_bind_class');
		$store_gc_id_commis_rate = $store_bind_class->getStoreGcidCommisRateList($order_goods);
	var_dump($order_goods);
	exit;
	
		//
		foreach($order_goods as $k=>$v){
			if($store_gc_id_commis_rate[$v['store_id']]){
				foreach($store_gc_id_commis_rate[$v['store_id']] as $sk=>$sv){
				$model->query("UPDATE shop_order_goods SET  commis_rate =  '".intval($sv)."' WHERE gc_id =".intval($sk)." AND store_id = ".$v['store_id']." ");
				}
			}
		}
				
	
	}

	
	//重新计算佣金比例
	public function daoChuOp(){
		$model = Model('member');
		$member_sat = strtotime('2016-05-21 0:0:0');
		$member_end = strtotime('2016-05-23 0:0:0');
		$member = $model->query("select member_name,member_truename,member_mobile,member_time,member_from from shop_member where member_time > ".$member_sat." AND member_time < ".$member_end."");
		$this->DaoChu_Export("05-21/05-22会员列表"); //设置导出格式
		$str = '<table class="table" width="60%" border="0" cellspacing="1" cellpadding="0">';
        $str .= '<tr><td>会员名</td><td>手机号</td><td>注册来源</td><td>注册日期</td></tr>';
		if($member){
			foreach($member as $k=>$v){
				$mobile = file_get_contents("http://crm.96567.com/index.php?m=api&p=action&c=JMmobile&mobile=".$v['member_mobile']);
				if($mobile){
				$str .= '<tr><td>&nbsp;'.$v['member_name'].'</td><td>&nbsp;'.$mobile.'</td><td>&nbsp;'.$v['member_from'].'</td><td>&nbsp;'.date("Y-m-d",$v['member_time']).'</td></tr>';
				}
			}
		}
		$str .='</table>';
        echo $str;
        exit;
				
	
	}
    public function testMobanOp(){

        $dataArr = array(
            "first"=>'标题',
            "FieldName"=>'123',
            "Account"=>'一二三',
            "change"=>'增加',
            "CreditChange"=>'123',
            "CreditTotal"=>'4984',
            "Remark"=>'123sdf'
        );


        $wx_param = array(
            'func'=>'jifen_change',
            'template_id'=>'',
            'openid'=>'',
            'url'=>'',
            'data'=>$dataArr,
        );





        QueueClient::push('sendWXTemplateMsg', $wx_param);



    }
	
	public function df6OP(){
		$model = Model('order');
		//AND a.buyer_id in(select member_id from shop_member WHERE member_from NOT LIKE '2040crm' AND member_from NOT LIKE '2059crm' AND member_from <> '')
       // $order = $model->query("select count(*) as num,sum(order_amount) as order_amount from shop_order as a,shop_yw_info as b WHERE a.order_id = b.orderid AND b.referer NOT LIKE '由京东订单转入' AND b.referer NOT LIKE '业务员国美添加' AND b.referer NOT LIKE '业务员当当添加' AND b.referer NOT LIKE '业务员京东添加' AND b.referer NOT LIKE '业务员收藏天下旗舰店添加' AND b.referer NOT LIKE '业务员褚商华添加' AND b.referer NOT LIKE '业务员一元夺宝添加' AND b.referer NOT LIKE '业务员艺术网添加' AND b.referer NOT LIKE '业务员平台乐拍添加' AND b.referer NOT LIKE '业务员苏宁易购添加' AND b.referer NOT LIKE '业务员刘海永添加' AND b.referer NOT LIKE '业务员闫飞添加' AND b.referer NOT LIKE '业务员吴善良添加' AND b.referer NOT LIKE '业务员重庆万达添加' AND b.referer NOT LIKE '业务员国美数据库添加' AND b.referer NOT LIKE '业务员电商部数据添加' AND b.referer NOT LIKE '业务员1元购添加'  AND a.order_state > 20");

	   $order = $model->query("select count(*) as num,sum(order_amount) as order_amount from shop_order as a,shop_yw_info as b WHERE a.order_id = b.orderid AND b.bumen = 11  AND a.order_state > 0");
		echo '客服部 订单总额：'.$order[0]['order_amount'].'&nbsp;订单数量：'.$order[0]['num'].'';
	}

	public function df5OP(){
		$qujianarr = array('0'=>array('max'=>0,'min'=>500),'1'=>array('max'=>500,'min'=>2000),'2'=>array('max'=>2000,'min'=>5000),'3'=>array('max'=>5000,'min'=>10000),'4'=>array('max'=>10000,'min'=>9999999999));
		$model = Model('order');
		foreach($qujianarr as $k=>$v){
			$order = $model->query("select count(*) as num from shop_order as a,shop_yw_info as b WHERE a.order_id = b.orderid and Number=2040 and FROM_UNIXTIME(a.add_time,'%Y')='2015' AND b.referer = '本站' AND order_amount >= ".$v['max']." AND order_amount < ".$v['min']." group by buyer_id");
			echo '订单价格：'.$v['max'].'到'.$v['min']." 的人数：".intval(count($order)).'<br />';
		}
	}

    public function df4OP(){
       $dataArr = array(
            "first"=>'{店铺名称}，您有新退货/退款申请生成，请于24时内处理。',
            "keyword1"=>'退款申请',
            "keyword2"=>'申请商品',
            "keyword3"=>'订单编号',
            "keyword4"=>'申请时间',
            "remark"=>'备注：啊阿斯顿'
        );
        $wx_param = array(
            'func'=>'shouhou_notice',
            'openid'=>'ocmCHjhE8blCfxhwR3ItQmnrYJrY',
            'url'=>'',
            'data'=>$dataArr,
        );
        QueueClient::push('sendWXTemplateMsg', $wx_param);
    }

    public function tongjiOP(){
        $from = $_GET['from'] == '' ? '免费送70周年纪念币(toutiao)' : $_GET['from'];
        $member_sat = ($_GET['stime'] == '')?'1451577600':$_GET['stime'];
        $member_end = ($_GET['etime'] == '')?time():$_GET['etime'];
        $model = Model('member');
        $members = $model->query("select member_id from shop_member WHERE member_from like '%".$from."%' and member_time >= ".$member_sat." AND member_time <= ".$member_end);

        $order_info = $model->query("select sum(order_amount) as order_amount,count(order_id) as num from shop_order where buyer_id in(select member_id from shop_member WHERE member_from like '%".$from."%' and member_time >= ".$member_sat." AND member_time <= ".$member_end.") AND add_time >= ".$member_sat." AND add_time <= ".$member_end."");

        $order_payd = $model->query("select sum(order_amount) as order_amount,count(order_id) as num from shop_order where order_state > 10 AND buyer_id in(select member_id from shop_member WHERE member_from like '%".$from."%' and member_time >= ".$member_sat." AND member_time <= ".$member_end.") AND add_time >= ".$member_sat." AND add_time <= ".$member_end."");

        echo $from.'<br />'.date("Y-m-d H:i",$member_sat).' 至 '.date("Y-m-d H:i",$member_end).'<br />注册的会员数量为：'.count($members).'<br />订单总额：'.intval($order_info[0]['order_amount']).'<br />订单总数：'.intval($order_info[0]['num']).'<br />已支付订单总额：'.intval($order_payd[0]['order_amount']).'<br />已支付订单总数：'.intval($order_payd[0]['num']);
    }


    public function df3OP(){
		$from = $_GET['from'] == '' ? '免费送70周年纪念币(toutiao)' : $_GET['from'];
		$model = Model('member');
		$member_sat = strtotime(date("Y-m-d",time()-86400).' 0:0:0');
		$member_end = strtotime(date("Y-m-d",time()-86400).' 23:59:59');
		$order_info = $model->query("select sum(order_amount) as order_amount,count(order_id) as num from shop_order where buyer_id in(select member_id from  WHERE member_from = '".$from."' and member_time > ".$member_sat." AND member_time <= ".$member_end.") ");
		echo $from.date("Y-m-d",time()-86400).'日注册的会员订单总额：'.intval($order_info[0]['order_amount']).'&nbsp;订单总数：'.intval($order_info[0]['num']);
	}

//	public function df2OP(){
//		$model = Model('order');
//		$tempArr = file(dirname(__FILE__).'/log.txt');
//		if($tempArr){
//			foreach($tempArr as $k=>$v){
//				$tepArr = explode('	',$v);
//				$model->query("UPDATE shop_yw_info SET  TH_Time =  '".$tepArr[1]."' WHERE  orderid =".$tepArr[0]." ");
//			}
//		}
//	}

//	public function df1OP(){
//		$model = Model('order');
//		$in = '201603101699148,201603105049690,201603102447064,201603105511742,201603101407408,201603105919681,201603104621501,201603104585889,201603100357694,201603103749926,201603105884526,201603101143433,201603100399698,201603102862845,201603091462728,201603101381515,201603102496331,201603105082381,201603104329298,201603105294698,201603051335317,201603110478109,201603103421347,201603115998929,201603105778526,201603100611679,201603105535071,201603100669550,201603103138989,201603104586628,201603102537414,201603074218820,201603125250860,201603075640833,201603110061067,201603145483739,201603075360606,201603165832670';
//		$order_snINfo = explode(',',$in);
//		foreach($order_snINfo as $k=>$v){
//			 $order_info = $model->query("SELECT order_amount,rcb_amount,pd_amount FROM  `shop_order` WHERE order_sn = '".$v."'");
//			 $Money = $order_info[0]['order_amount']-$order_info[0]['rcb_amount']-$order_info[0]['pd_amount'];
//			 $model->query("UPDATE  shop_yw_info SET  `pay_status` = '2',`money_paid` = '".$Money."' WHERE order_sn ='".$v."' ");
//			 $model->query("UPDATE  shop_order SET  payment_time=".time()." WHERE order_sn ='".$v."' ");
//		}	
//
//	echo 'OK';
//
//	}
//
	public function dfOP(){
		$model = Model('order_common');
        $order_common = $model->query("SELECT order_id,reciver_name,reciver_info,(select buyer_id from shop_order where `shop_order`.order_id=`shop_order_common`.order_id) as buyer_id FROM  `shop_order_common` WHERE  `reciver_info` LIKE  '%\"mob_phone\";s:1:\"0\"%'");
		
		foreach($order_common as $k=>$v){
			 $order_address = $model->query("SELECT * FROM  shop_address WHERE member_id = '".$v['buyer_id']."' order by is_default desc limit 1");
			$user_address = array(
			'phone' => 	 $order_address[0]['mob_phone'],
			'mob_phone' => $order_address[0]['mob_phone'],
			'tel_phone' => 	$order_address[0]['mob_phone'],
			'address'   => 	$order_address[0]['area_info'].' '.$order_address[0]['address'],
			'area' => 	$order_address[0]['area_info'],
			'street' => $order_address[0]['address']
			);
			$reciver_info = serialize($user_address);
			$model->query("UPDATE  `shopnc`.`shop_order_common` SET  `reciver_info` = '".$reciver_info."' WHERE order_id =".$v['order_id']." ");

        }
		echo 'OK';
	}


    public function tetttOp(){

        $model = Model('goods');
        $res = $model->getGoodsInfoByID("14232");
        print_r($res);
    }

    /*
     * 根据订单支付SN查找出问题的订单会员
     */
    public function delcacheOp(){
        $goodsid = array(14232);
        foreach($goodsid as $id){
            dcache($id, 'goods');
        }

        $commonid = array(13821);

        foreach($commonid as $cid){
            dcache($cid, 'goods_common');
            dcache($cid, 'goods_spec');
        }

    }

    public function testtOp(){
        $dotime = TIMESTAMP - ORDER_AUTO_RECEIVE_DAY * 86400;
        $model_order = Model('order');
        $a = $model_order->query("SELECT o.* FROM `shop_order`as o left join `shop_yw_info` as yw on o.order_id = yw.orderid WHERE yw.orderid is null and  o.order_state='40' and o.lock_state='0' and o.delay_time < '".$dotime."'");
        print_r($a);
    }

    public function do_test_orderOp(){
        $model = Model('order_log');
        /*
        $condition = array();
        $condition['log_msg'] = array(array('like','%超期未收货系统自动完成订单%'));
        $order_list = $model->query("SELECT count(order_id) cc,order_id,log_msg from shop_order_log where log_msg like '%超期未收货系统%' group by order_id order by cc desc");
        foreach($order_list as $k=>$v){
            echo $v['order_id'].',';
        }
        */
        $order_ids = array(499274);
        foreach ($order_ids as $k => $order_id) {
            $res = $this->do_order_thinks($order_id);//删除订单会员积分和经验值
            //$res = $this->do_tui_log($order_id);//订单状态改成取消
            print_r($res['msg']);
        }
        echo '===end===';exit;
    }

    //操作订单 删除已发放的会员积分和经验值
    public function do_order_thinks($order_id){
        $model = Model('order_log');
        $order_res = $model->query("SELECT order_id,order_sn,buyer_id from shop_order where `order_id`={$order_id}");
        if(!empty($order_res[0]['order_sn'])){
            $member_id = $order_res[0]['buyer_id'];
            $order_sn = $order_res[0]['order_sn'];
            try{
                $model->beginTransaction();
                //查会员积分日志表
                $points_res = $model->query("SELECT sum(pl_points) as points from shop_points_log where `pl_desc`='订单{$order_sn}购物消费' and `pl_stage`='order'");
                if($points_res[0]['points'] > 0){
                    //减掉会员积分
                    $res = $model->table('member')->where(array('member_id'=>$member_id))->update(array('member_points'=>array('exp','member_points-'.$points_res[0]['points'])));
                    if (!$res) {
                        throw new Exception("订单ID：{$order_id}，减掉会员积分操作失败");
                    }
                    //删除会员积分日志
                    $res = $model->execute("delete from shop_points_log where `pl_desc`='订单{$order_sn}购物消费' and `pl_stage`='order'");
                    if (!$res) {
                        throw new Exception("订单ID：{$order_id}，删除会员积分日志失败");
                    }
                }


                //查经验值日志表
                $exppoints_res = $model->query("SELECT sum(exp_points) as points from shop_exppoints_log where `exp_desc`='订单{$order_sn}购物消费' and `exp_stage`='order'");
                if($exppoints_res[0]['points'] > 0){
                    //减掉会员经验值，删除日志
                    $res = $model->table('member')->where(array('member_id'=>$member_id))->update(array('member_exppoints'=>array('exp','member_exppoints-'.$exppoints_res[0]['points'])));
                    if (!$res) {
                        throw new Exception("订单ID：{$order_id}，减掉会员经验值操作失败");
                    }
                    //删除会员经验值日志
                    $res = $model->execute("delete from shop_exppoints_log where `exp_desc`='订单{$order_sn}购物消费' and `exp_stage`='order'");
                    if (!$res) {
                        throw new Exception("订单ID：{$order_id}，删除会员经验值日志失败");
                    }
                }

                $model->commit();
                return array('state'=>'succ','msg'=>"订单ID：{$order_id},减掉积分:{$points_res[0]['points']},减掉经验值:{$exppoints_res[0]['points']}");
            }catch (Exception $e){
                $model->rollback();
                return array('state'=>'fail','msg'=>$e->getMessage());
            }
        }else{
            return array('state'=>'succ','msg'=>"未找到订单ID：{$order_id},对应的订单信息");
        }
    }

    //退回删除日志自定义
    public function do_tui_log($order_id){
        $model = Model('order_log');
        $condition = array();
        $condition['order_id'] = $order_id;
        $condition['log_msg'] = array(array('like','%超期未收货系统自动完成%'));
        $logres = $model->table('order_log')->where($condition)->order('log_id desc')->select();
        if(!empty($logres)) {
            //更新业务info
            $res = $model->table('yw_info')->where(array('orderid' => $order_id))->update(array('order_status' => $logres[1]['order_status'], 'shipping_status' => $logres[1]['shipping_status']));
            //更新订单
            $res = $model->table('order')->where(array('order_id' => $order_id))->update(array('order_state' => '0'));

            //删除错误日志
            $res = $model->execute("delete from shop_order_log where `log_msg` like '%超期未收货系统自动完成%' and `order_id`='" . $order_id . "'");

            return array('state' => 'succ', 'msg' => "订单ID：{$order_id}，已退回状态");
        }else{
            return array('state' => 'fail', 'msg' => "订单ID：{$order_id}，没找到对应条件");
        }
    }

    //恢复订单
    public function do_order_log($order_id){
        $model = Model('order_log');
        $order_res = $model->query("SELECT order_id,order_sn,buyer_id from shop_order where `order_id`={$order_id} and `add_time`<'1447171200'");
        if(!empty($order_res[0]['order_sn'])){
            $condition = array();
            $condition['order_id'] = $order_id;
            $logres = $model->table('order_log')->where($condition)->order('log_id desc')->select();
            if(strpos($logres[1]['log_msg'],'退回') !== false){
                if($logres[1]['order_status'] == 7){
                    //更新业务info
                    $res = $model->table('yw_info')->where(array('orderid'=>$order_id))->update(array('order_status'=>$logres[1]['order_status'],'shipping_status'=>$logres[1]['shipping_status']));
                    //更新订单
                    $res = $model->table('order')->where(array('order_id'=>$order_id))->update(array('order_state'=>'0'));

                    //删除错误日志
                    $res = $model->execute("delete from shop_order_log where `log_msg` like '%超期未收货系统自动完成%' and `order_id`='".$order_id."'");

                    return array('state'=>'succ','msg'=>"订单ID：{$order_id}，已退回状态");
                }else{
                    return array('state'=>'fail','msg'=>"订单ID：{$order_id}，不是7退回状态");
                }
            }else{
                return array('state'=>'fail','msg'=>"订单ID：{$order_id}，不是退回信息");
            }
            /*
            if(!empty($logres)){
                if(strpos($logres[0]['log_msg'],'超期未收货系统自动完成') !== false){
                    //判定是否做了两次超期自动收货日志
                    if(strpos($logres[1]['log_msg'],'超期未收货系统自动完成') !== false){

                    }else{
                        if(strpos($logres[1]['log_msg'],'退回') !== false){

                        }
                    }


                }else{
                    return array('state'=>'succ','msg'=>"订单ID：{$order_id}，未做自动运行");
                }
            }else{
                return array('state'=>'succ','msg'=>"订单ID：{$order_id}，没有日志");
            }
            */
        }else{
            return array('state'=>'succ','msg'=>"不在有效期订单ID：{$order_id}");
        }
    }
	
	//按订单金额返现3%
	public function pd_fanxianOp(){
		//$model->query("delete from shop_order_log where log_msg like '%购物返现%' AND order_id = ".$dataArr['order_id']);
		//$model->query("delete from shop_pd_log where lg_member_id = '".$dataArr['buyer_id']."' order by lg_id desc limit 1");
		$model = Model('order');
		$tempArr = file(dirname(__FILE__).'/2222222.txt');
		$i=0;
		foreach($tempArr as $k=>$v){
			$order_sn = trim($v);
			$res = $model->query("select order_id,order_sn,order_amount,buyer_id,buyer_name,order_state from shop_order WHERE order_sn = '".$order_sn."'");
			$dataArr = $res[0];
			$available_predeposit = $dataArr['order_amount']*0.03;
//			//增加预存款记录
//			$model->query("insert into shop_pd_log (lg_member_id,lg_member_name,lg_admin_name,lg_type,lg_av_amount,lg_freeze_amount,lg_add_time,lg_desc) VALUES ('".$dataArr['buyer_id']."','".$dataArr['buyer_name']."','系统','recharge','".$available_predeposit."','0','".time()."','【购物返现】订单“".$dataArr['order_sn']."”返现3%') ");
//			//发送模版消息
//			$message_body = '您的账户于 '.date('Y-m-d H:i:s',time()).' 账户资金有变化，描述：【购物返现】订单'.$order_info[0]['order_sn'].'购物返现，可用金额变化 ：'.$available_predeposit.'元，冻结金额变化：0.00元。<a href="/shop/index.php?act=predeposit&op=pd_log_list" target="_blank">点击查看余额</a>';
//			$model->query("insert into shop_message (to_member_id,message_body,message_time,message_update_time,message_state,message_type,read_member_id,del_member_id,from_member_name,to_member_name) VALUES ('".$dataArr['buyer_id']."','".$message_body."','".time()."','".time()."','0','1','','','','')");
//			
//			//增加订单记录
//			$yw_info = $model->query("select order_status,shipping_status,pay_status from shop_yw_info WHERE order_sn = '".$dataArr['order_sn']."'");
//			$model->query("insert into shop_order_log (order_id,log_msg,log_time,log_role,log_user,log_orderstate,order_status,shipping_status,pay_status) VALUES ('".$dataArr['order_id']."','【购物返现】该订单返现".$available_predeposit."元，已发已充值至会员余额，如订单发生退换货，需扣除返现金额".$available_predeposit."元。','".time()."','系统','系统','".$dataArr['order_state']."','".$yw_info[0]['order_status']."','".$yw_info[0]['shipping_status']."','".$yw_info[0]['pay_status']."')");
//$model->query("UPDATE shop_member SET available_predeposit =  available_predeposit+".$available_predeposit." WHERE  member_id =".$dataArr['buyer_id']." ");
			
			//$member = $model->query("select available_predeposit,member_name from shop_member WHERE member_id = '".$dataArr['buyer_id']."'");
			//if(intval($member[0]['available_predeposit']) <= 0){
				////修改会员余额
				//$model->query("UPDATE shop_member SET available_predeposit =  available_predeposit+".$available_predeposit." WHERE  member_id =".$dataArr['buyer_id']." ");
				//echo $member[0]['member_name'].'====='.intval($member[0]['available_predeposit']);
				//
			//}
			$i++;

		}
		echo '成功执行'.$i;

//		$member = $model->query("select available_predeposit,member_name,member_id from shop_member WHERE member_id in(".join(',',$member_id).") AND available_predeposit <> (select sum(lg_av_amount) as a from shop_pd_log WHERE lg_member_id = member_id) group by member_id");
//			if($member){
//				foreach($member as $k=>$v){
//					$pd_log = $model->query("select sum(lg_av_amount) as amount from shop_pd_log WHERE lg_member_id = '".$v['member_id']."'");
//					echo 'ID&nbsp;'.$v['member_id'].'&nbsp;'.$v['member_name'].'&nbsp;现在的余额&nbsp;'.$v['available_predeposit'].'&nbsp;记录余额&nbsp;'.$pd_log[0]['amount'].'&nbsp;差额&nbsp;'.($pd_log[0]['amount']-$v['available_predeposit']).'&nbsp;返现金额&nbsp;'.$$available_predepositarray[$v['member_id']].'<br />';
//				
//				}
//			}
	}

	
	 public function order_infoOp(){
        $model = Model('order');
		$this->DaoChu_Export('2016年3月29日-4月20日的已完成订单');
        $res = $model->query("select *,(select pay_status from shop_yw_info where orderid = order_id) as pay_status from shop_order WHERE add_time >=1459180800 and add_time < 1461168000 AND finnshed_time >=1461945600 and finnshed_time < 1462464000  AND order_state = 40 AND order_amount > 0");
		//$res = $model->query("select count(*) as num,sum(order_amount) as amount from shop_order WHERE add_time >=1458230400 and add_time < 1459180800 AND order_state >0");
		//echo '订单数量'.$res[0]['num']."====".$res[0]['amount'];
		//exit;
		echo '<table>';
		echo '<tr><td>订单号</td><td>订单金额</td><td>会员名</td><td>下单时间</td><td>订单完成时间</td><td>所属店铺</td><td>回款状态</td></tr>';
		foreach($res as $k=>$v){
			if($v['pay_status'] == 3){
				$pay_status = '已回款';
			}else{
				$pay_status = '未回款';
			}
			$finnshed_time = $v['finnshed_time'] == 0 ? '' : date("Y-m-d H:i:s",$v['finnshed_time']);
				echo '<tr><td>&nbsp;'.$v['order_sn'].'</td><td>&nbsp;'.$v['order_amount'].'</td><td>&nbsp;'.$v['buyer_name'].'</td><td>&nbsp;'.date("Y-m-d H:i:s",$v['add_time']).'</td><td>&nbsp;'.$finnshed_time.'</td><td>&nbsp;'.$v['store_name'].'</td><td>&nbsp;'.$pay_status.'</td></tr>';
		}
		echo '</table>';
    }
	 /*
     
     */
    public function goods_infoOp(){
        $model = Model('goods');
		$this->DaoChu_Export('产品列表');
         /*  订单导出 */
		$res = $model->query("select *,(select brand_name from shop_brand where `shop_brand`.brand_id = `shop_goods`.brand_id) as brand_name,(select goods_costprice from shop_goods_common where `shop_goods_common`.goods_commonid = `shop_goods`.goods_commonid) as goods_costprice,(select gc_name from shop_goods_class where `shop_goods_class`.gc_id = `shop_goods`.gc_id) as gc_name,(select gc_name from shop_goods_class where `shop_goods_class`.gc_id = `shop_goods`.gc_id_1) as gc_name_1,(select gc_name from shop_goods_class where `shop_goods_class`.gc_id = `shop_goods`.gc_id_2) as gc_name_2,(select gc_name from shop_goods_class where `shop_goods_class`.gc_id = `shop_goods`.gc_id_3) as gc_name_3,(select goods_selltime from shop_goods_common where `shop_goods_common`.goods_commonid = `shop_goods`.goods_commonid) as goods_selltime from shop_goods WHERE `goods_serial` LIKE  '96%' order by goods_id desc");
		echo '<table>';
		echo '<tr><td>货品编号</td><td>品名</td><td>类别</td><td>别名</td><td>规格</td><td>条码</td><td>固定成本价</td><td>多规格标记</td><td>单位</td><td>零售价</td><td>批发价</td><td>会员价</td><td>自定价1</td><td>自定价2</td><td>自定价3</td><td>品牌</td><td>产地</td><td>重量</td><td>积分</td><td>标记</td><td>长</td><td>宽</td><td>高</td><td>耗材消耗天</td><td>采购员</td><td>自定义1</td><td>自定义2</td><td>自定义3</td><td>自定义4</td><td>备注</td><td>上架日期</td><td>最低售价</td></tr>';
		foreach($res as $k=>$v){
				if($v['goods_selltime']){
					$goods_selltime = date("Y-m-d H:i:s",$v['goods_selltime']);
				}
				$gc_name = '';
				if($v['gc_name_1']){
					$gc_name .= $v['gc_name_1'];
				}
				if($v['gc_name_2']){
					$gc_name .= '>>'.$v['gc_name_2'];
				}
				if($v['gc_name_3']){
					$gc_name .= '>>'.$v['gc_name_3'];
				}
				echo '<tr><td>'.$v['goods_serial'].'</td><td>'.$v['goods_name'].'</td><td>'.$gc_name.'</td><td>'.$v['goods_jingle'].'</td><td></td><td>'.$v['goods_serial'].'</td><td>'.$v['goods_costprice'].'</td><td></td><td></td><td>'.$v['goods_price'].'</td><td></td><td></td><td></td><td></td><td></td><td>'.$v['brand_name'].'</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td>自定义3</td><td></td><td></td><td>'.$goods_selltime.'</td><td>'.$v['d_price'].'</td></tr>';
		}
		echo '</table>';
    }

	 /*
     
     */
    public function goods_classOp(){
        $model = Model('goods_class');
         /*  订单导出 */
		$res = $model->query("select * from shop_goods_class where gc_parent_id > 0 order by gc_parent_id asc");
		echo '<table>';
		echo '<tr><td>父类层级序号</td><td>父类名称</td><td>子类层级序号</td><td>子类名称</td><td>自编码</td><td>排序</td></tr>';
		foreach($res as $k=>$v){
			$gc_name = $model->query("select gc_id,gc_name,gc_parent_id from shop_goods_class where gc_id =  ".$v['gc_parent_id']);
			$zi_name = $model->query("select gc_name from shop_goods_class where gc_parent_id =  ".$v['gc_id']);
			$isf = $model->query("select count(*) as num from shop_goods_class where gc_id =  ".$gc_name[0]['gc_parent_id']);
			if($isf[0]['num'] == 0){
				$fuji = 0;
			}else{
				$fuji = 1;
			}
			$zil = $model->query("select gc_parent_id from shop_goods_class where gc_id =  ".$v['gc_parent_id']);
			$zil2 = $model->query("select count(*) as num from shop_goods_class where gc_parent_id =  ".$v['gc_id']);
			if($zil[0]['gc_parent_id'] == 0){
				$ziji = 1;
			}elseif($zil2[0]['num'] > 0){
				$ziji = 3;
			}else{
				$ziji = 2;
			}
			echo '<tr>';
			echo '<td> '.$fuji.'</td>';
			echo '<td> '.$gc_name[0]['gc_name'].'</td>';
			echo '<td>'.$ziji.'</td>';
			echo '<td>'.$v['gc_name'].'</td>';
			echo '<td></td>';
			echo '<td>'.$v['gc_sort'].'</td>';
			echo '</tr>';
		}
		echo '</table>';
    }

    /*
     * 财务要导出的银联和微信支付记录 xin
     * 调用方式：http://www.96567.com/index.php?act=test&op=ext_order&stime=1451577600&etime=1454256000&type=order
     * stime 为要开始时间，etime为结束时间，type为要导出类型（order导出订单，chongzhi导出充值记录）
     */
    public function ext_orderOp(){
        $model = Model('order');
        $stime = $_GET['stime'];//开始时间
        $etime = $_GET['etime'];//结束时间
        if($stime == '' || $etime == ''){
            exit('开始和结束时间都不能为空');
        }

        $type = ($_GET['type'] == 'chongzhi')?:'order';//导出充值或订单

        if($type == 'order'){
            /*  订单导出 */
            $res = $model->query("select o.*,cc.reciver_name from shop_order as o,shop_order_common as cc where o.order_id=cc.order_id and o.payment_code IN('unionpay','wxpay') AND o.payment_time >= '1451577600' and o.payment_time < '1454256000' order by o.payment_time asc");
            $order_statue = array('0'=>'已取消','10'=>'未支付','20'=>'已支付','30'=>'已发货','40'=>'已收货');
            echo '<table>';
            echo '<tr><td>商城订单号</td><td>商城支付单号</td><td>买家用户名</td><td>收货人姓名</td><td>支付方式</td><td>支付时间</td><td>在线支付金额</td><td>订单状态</td></tr>';
            foreach($res as $k=>$v){
                echo '<tr>';
                echo '<td> '.$v['order_sn'].'</td>';
                echo '<td> '.$v['pay_sn'].'</td>';
                echo '<td>'.$v['buyer_name'].'</td>';
                echo '<td>'.$v['reciver_name'].'</td>';
                echo '<td>'.(($v['payment_code'] == 'unionpay')?'银联支付':'微信支付').'</td>';
                echo '<td>'.date('Y-m-d H:i:s',$v['payment_time']).'</td>';
                echo '<td>'.($v['order_amount'] - $v['rcb_amount'] - $v['pd_amount'] - $v['other_paid_amount']).'</td>';
                echo '<td>'.$order_statue[$v['order_state']].'</td>';
                echo '</tr>';
            }
            echo '</table>';
        }else{
            /* 充值订单导出 */
            $res = $model->query("select * from shop_pd_recharge where pdr_payment_code IN('unionpay','wxpay') AND pdr_payment_time >= '1451577600' and pdr_payment_time < '1454256000' AND pdr_payment_state = '1'");
            echo '<table>';
            echo '<tr><td>商城充值单号</td><td>第三方返回流水单号</td><td>充值会员用户名</td><td>充值方式</td><td>充值时间</td><td>充值金额</td></tr>';
            foreach($res as $k=>$v){
                echo '<tr>';
                echo '<td> '.$v['pdr_sn'].'</td>';
                echo '<td> '.$v['pdr_trade_sn'].'</td>';
                echo '<td>'.$v['pdr_member_name'].'</td>';
                echo '<td>'.$v['pdr_payment_name'].'</td>';
                echo '<td>'.date('Y-m-d H:i:s',$v['pdr_payment_time']).'</td>';
                echo '<td>'.$v['pdr_amount'].'</td>';
                echo '</tr>';
            }
            echo '</table>';
        }
    }

    /**
     * 生成excel
     *
     * @param array $data
     */
    private function createExcel($data = array()){
        Language::read('export');
        import('libraries.excel');
        $excel_obj = new Excel();
        $excel_data = array();
        //设置样式
        $excel_obj->setStyle(array('id'=>'s_title','Font'=>array('FontName'=>'宋体','Size'=>'12','Bold'=>'1')));
        //header
        $excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_no'));
        $excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_store'));
        $excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_buyer'));
        $excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_xtimd'));
        $excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_count'));
        $excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_yfei'));
        $excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_paytype'));
        $excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_state'));
        $excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_storeid'));
        $excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_buyerid'));
        $excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_od_bemail'));
        //data
        foreach ((array)$data as $k=>$v){
            $tmp = array();
            $tmp[] = array('data'=>'NC'.$v['order_sn']);
            $tmp[] = array('data'=>$v['store_name']);
            $tmp[] = array('data'=>$v['buyer_name']);
            $tmp[] = array('data'=>date('Y-m-d H:i:s',$v['add_time']));
            $tmp[] = array('format'=>'Number','data'=>ncPriceFormat($v['order_amount']));
            $tmp[] = array('format'=>'Number','data'=>ncPriceFormat($v['shipping_fee']));
            $tmp[] = array('data'=>orderPaymentName($v['payment_code']));
            $tmp[] = array('data'=>orderState($v));
            $tmp[] = array('data'=>$v['store_id']);
            $tmp[] = array('data'=>$v['buyer_id']);
            $tmp[] = array('data'=>$v['buyer_email']);
            $excel_data[] = $tmp;
        }
        $excel_data = $excel_obj->charset($excel_data,CHARSET);
        $excel_obj->addArray($excel_data);
        $excel_obj->addWorksheet($excel_obj->charset(L('exp_od_order'),CHARSET));
        $excel_obj->generateXML($excel_obj->charset(L('exp_od_order'),CHARSET).$_GET['curpage'].'-'.date('Y-m-d-H',time()));
    }


    /*
     * 移动商品脚本 xin
     * 说明：商品转移包含所有图片转移，就是整个商品都归属到新的店铺
     * 调用方式：http://www.96567.com/index.php?act=test&op=move_goods&ids=9481,6373,891
     * 说明：参数ids为商品的goods_id，可以传多个，以英文逗号隔开，每次最好不超过20个商品，因为商品多了超时会502
     */
    public function move_goodsOp(){

        $ids = trim($_GET['ids']);
        $goods_arr = explode(',',$ids);


        $new_store_id = '22';//新店铺ID
        $new_store_name = '收藏天下书画馆';//新店铺名称
		$transport_id = 7;
        //$goods_arr = array('9481','4333','6373','6597','4097','6710','891');//要转移的商品ID goods_id

        $M_goods = Model('goods');



        //取商品表
        $goods = $M_goods->getGoodsList(array('goods_id'=>array('in',$goods_arr)),'goods_id,goods_commonid,goods_name,gc_id_1,store_id,store_name,goods_image,goods_serial','','',1000);
        if(empty($goods)){
            echo 'no goods';exit;
        }
        foreach($goods as $k=>$v){
            $goods_img_name = '';
            if($v['goods_image'] != ''){
                $goods_img_name = $this->do_imgs($v['goods_image'],$v['store_id'],$new_store_id);
                //echo $goods_img_name;
            }
            //更新商品信息
            $M_goods->table('goods')->where(array('goods_id'=>$v['goods_id']))->update(array('goods_image'=>$goods_img_name,'store_id'=>$new_store_id,'store_name'=>$new_store_name,'transport_id'=>$transport_id,'sku_lock'=>0));
			echo $a;

            //取商品common表
            $goodscomm = $M_goods->getGoodeCommonInfo(array('goods_commonid'=>$v['goods_commonid']),'goods_commonid,goods_name,gc_id_1,store_id,store_name,goods_image');
            $goods_common_img_name = '';
            if($goodscomm['goods_image'] != ''){
                if($goodscomm['goods_image'] != $v['goods_image']){
                    $goods_common_img_name = $this->do_imgs($v['goods_image'],$goodscomm['store_id'],$new_store_id);
                }else{
                    $goods_common_img_name = $goods_img_name;
                }
            }
            //更新商品common信息
           $M_goods->table('goods_common')->where(array('goods_commonid'=>$goodscomm['goods_commonid']))->update(array('goods_image'=>$goods_common_img_name,'store_id'=>$new_store_id,'store_name'=>$new_store_name,'transport_id'=>$transport_id,'goods_lock'=>0));
            //更新商品图片库
            $goods_images = $M_goods->getGoodsImageList(array('goods_commonid'=>$v['goods_commonid']));
            if(is_array($goods_images) && !empty($goods_images)){
				
                foreach($goods_images as $key=>$value){
                    $goodsimages_img_name = '';
                    if($value['goods_image'] != ''){
                        if($v['goods_image'] != $value['goods_image']){
                            $goodsimages_img_name = $this->do_imgs($value['goods_image'],$value['store_id'],$new_store_id);
                        }else{
                            $goodsimages_img_name = $goods_img_name;
							
                        }
                    }
					
				
                    //更新商品图片表信息
                    $M_goods->table('goods_images')->where(array('goods_image_id'=>$value['goods_image_id']))->update(array('goods_image'=>$goodsimages_img_name,'store_id'=>$new_store_id));
                }
            }
            echo '<Br/>ok<Br/>';
        }
        exit;

    }
	
	 public function move_goods2Op(){

        $ids = trim($_GET['ids']);
        $goods_arr = explode(',',$ids);


        $new_store_id = '22';//新店铺ID
        $new_store_name = '收藏天下书画馆';//新店铺名称
		$transport_id = 7;
        //$goods_arr = array('9481','4333','6373','6597','4097','6710','891');//要转移的商品ID goods_id

        $M_goods = Model('goods');



        //取商品表
        $goods = $M_goods->getGoodsList(array('goods_id'=>array('in',$goods_arr)),'goods_id,goods_commonid,goods_name,gc_id_1,store_id,store_name,goods_image,goods_serial','','',1000);
        if(empty($goods)){
            echo 'no goods';exit;
        }
        foreach($goods as $k=>$v){
            $goods_img_name = '';
            if($v['goods_image'] != ''){
                $goods_img_name = $this->do_imgs($v['goods_image'],$v['store_id'],$new_store_id);
                //echo $goods_img_name;
            }
            //更新商品信息
            $M_goods->table('goods')->where(array('goods_id'=>$v['goods_id']))->update(array('goods_image'=>$goods_img_name,'store_id'=>$new_store_id,'store_name'=>$new_store_name,'transport_id'=>$transport_id,'sku_lock'=>0));
			echo $a;

            //取商品common表
            $goodscomm = $M_goods->getGoodeCommonInfo(array('goods_commonid'=>$v['goods_commonid']),'goods_commonid,goods_name,gc_id_1,store_id,store_name,goods_image');
            $goods_common_img_name = '';
            if($goodscomm['goods_image'] != ''){
                if($goodscomm['goods_image'] != $v['goods_image']){
                    $goods_common_img_name = $this->do_imgs($v['goods_image'],$goodscomm['store_id'],$new_store_id);
                }else{
                    $goods_common_img_name = $goods_img_name;
                }
            }
            //更新商品common信息
           $M_goods->table('goods_common')->where(array('goods_commonid'=>$goodscomm['goods_commonid']))->update(array('goods_image'=>$goods_common_img_name,'store_id'=>$new_store_id,'store_name'=>$new_store_name,'transport_id'=>$transport_id,'goods_lock'=>0));
            //更新商品图片库
            $goods_images = $M_goods->getGoodsImageList(array('goods_commonid'=>$v['goods_commonid']));
            if(is_array($goods_images) && !empty($goods_images)){
				
                foreach($goods_images as $key=>$value){
                    $goodsimages_img_name = '';
                    if($value['goods_image'] != ''){
                        if($v['goods_image'] != $value['goods_image']){
                            $goodsimages_img_name = $this->do_imgs($value['goods_image'],$value['store_id'],$new_store_id);
                        }else{
                            $goodsimages_img_name = $goods_img_name;
							
                        }
                    }
					
				
                    //更新商品图片表信息
                    $M_goods->table('goods_images')->where(array('goods_image_id'=>$value['goods_image_id']))->update(array('goods_image'=>$goodsimages_img_name,'store_id'=>$new_store_id));
                }
            }
            echo '<Br/>ok<Br/>';
        }
        exit;

    }
    /*
     * 商品移动，图片操作
     */
    protected function do_imgs($goods_image,$old_store_id,$new_store_id){
        $oldshoppath =  BASE_UPLOAD_PATH. '/' . ATTACH_GOODS . '/'.$old_store_id.'/';
        $new_shoppath =  BASE_UPLOAD_PATH. '/' . ATTACH_GOODS . '/'.$new_store_id.'/';
        $goodsimgs = array('.jpg','_60.jpg','_240.jpg','_360.jpg','_1280.jpg');
        preg_match('/goods_img\/(.+?).jpg/',$goods_image,$results);
        if($results[1]!= ''){
            //图片类型为images/201106/goods_img/843_G_1307731894972.jpg
            $newimages = $new_store_id.'_'.$results[1];
            $goods_img_name = $newimages.'.jpg';
            $old_img_path = $oldshoppath.$goods_image;
            foreach($goodsimgs as $ext){
                $new_img_path = $new_shoppath.$newimages.$ext;
                if(file_exists($old_img_path)){
                    $this->copyimgs($old_img_path,$new_img_path);
                }
                echo $old_img_path.'<Br/>';
                echo $new_img_path.'<Br/>';
            }
        }else{
            //图片类型为3_04990202215881035.jpg
            $strpos_num = strpos($goods_image,'_');
            $goods_img_name = $new_store_id.substr($goods_image,$strpos_num);
            foreach($goodsimgs as $ext){
                $old_img_path = $oldshoppath.str_replace('.jpg',$ext,$goods_image);
                $new_img_path = $new_shoppath.str_replace('.jpg',$ext,$goods_img_name);
                if(file_exists($old_img_path)){
                    $this->copyimgs($old_img_path,$new_img_path);
                }
                echo $old_img_path.'<Br/>';
                echo $new_img_path.'<Br/>';
            }
        }
        return $goods_img_name;
    }

    /*
     * 商品移动，图片OSS操作
     */
    protected function copyimgs($old_img_path,$new_img_path){
        require_once(BASE_CORE_PATH.'/framework/libraries/oss/aili_yun_oss.class.php');//引入阿里云OSS
        if(file_exists($old_img_path)){
            copy($old_img_path,$new_img_path);//复制图片
            $oss = new aili_yun_oss;//实例化云
            echo $oss->yun_upload_img($new_img_path);//上传到OSS
        }
        return true;
    }


	/*
     * 文交所发送短信
     */
    public function FaSongsmsOp(){
		$IpArray = array('203.158.19.67','123.57.49.61','101.254.181.52');
		if(!in_array($_SERVER['REMOTE_ADDR'],$IpArray)){
			echo 0;
			exit;
		}else{
			$mobile = $_GET['mobile'];
			$content =  $_GET['content'];
			$sms = new Sms();
			$result = $sms->send($mobile,$content);
			echo $result;
		}
    }



	/*写入全部商品信息到redis*/
	public function redisOp(){
		$goodsObj= Model('goods');
        $dataArr = $goodsObj->getGoodsCommonList(array(),'*','','',1);
        $newdata = array();
        foreach($dataArr[0] as $k=>$v){
            if($v == ''){
                $newdata[$k] = '';
            }else{
                $newdata[$k] = $v;
            }
        }
        //print_r($newdata);exit;
        //print_r($dataArr[0]);exit;
		$redis = new redis();
		$redis->connect('127.0.0.1', 6379);
        //$arr = array('goods_discount','gc_id_1','store_name');
        $redis->hset('shengwei-test','name','tetete');
        //$res = $redis->hMset('goodstest-1',$newdata);
        //$res = $redis->hMset('goodstest-2',$arr);
        //echo $res;exit;
        $goods =  $redis->hgetall('shengwei-test');
        //$arr = array('goods_discount','gc_id_1','store_name');
        //$goods = $redis->hmGet('goodstest-1',$arr);
        print_r($goods);
        echo 'success';
	}

	//导出exl
public function DaoChu_Export($filename){
		header("Content-type: application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment; filename=$filename.xls");
		echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"
		xmlns:x="urn:schemas-microsoft-com:office:excel"
		xmlns="http://www.w3.org/TR/REC-html40">
		<head>
		<meta http-equiv="expires" content="Mon, 06 Jan 1999 00:00:01 GMT">
		<meta http-equiv=Content-Type content="text/html; charset=utf-8">
		<!--[if gte mso 9]><xml>
		<x:ExcelWorkbook>
		<x:ExcelWorksheets>
		<x:ExcelWorksheet>
		<x:Name></x:Name>
		<x:WorksheetOptions>
		<x:DisplayGridlines/>
		</x:WorksheetOptions>
		</x:ExcelWorksheet>
		</x:ExcelWorksheets>
		</x:ExcelWorkbook>
		</xml><![endif]-->

		</head>';
}

}