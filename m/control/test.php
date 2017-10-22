<?php



defined('InShopNC') or exit('Access Invalid!');
class testControl extends BaseHomeControl {
	public function __construct() {
		parent::__construct();
		//读取语言包

	}

    public function testMobanOp(){

        $dataArr = array(
            "first"=>array("value"=>'标题',"color"=>"#173177"),
            "FieldName"=>array("value"=>'123',"color"=>"#173177"),
            "Account"=>array("value"=>'一二三',"color"=>"#173177"),
            "change"=>array("value"=>'增加',"color"=>"#173177"),
            "CreditChange"=>array("value"=>'123',"color"=>"#173177"),
            "CreditTotal"=>array("value"=>'4984',"color"=>"#173177"),
            "Remark"=>array("value"=>'123sdf'."\n\n".$mobaninfo['remark'],"color"=>"#173177"),
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

    public function df4OP(){
        $store_voucher = Model('store_voucher');
        $ret = $store_voucher->addPT_YouHuiJuan($_SESSION['member_id'],1);
        var_dump($ret);
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
//	public function dfOP(){
//		$model = Model('order_common');
//        $order_common = $model->query("SELECT order_id,reciver_info FROM  `shop_order_common` WHERE  `reciver_info` LIKE  '%&nbsp;%'");
//		
//		foreach($order_common as $k=>$v){
//            $a=unserialize($v['reciver_info']);
//			$m = explode(',',$a['phone']);
//			$add = explode('&nbsp;',$a['address']);
//			$user_address = array(
//			'phone' => 	JiaMiMobile($m[0]),
//			'mob_phone' => JiaMiMobile($m[0]),
//			'tel_phone' => 	JiaMiMobile($m[0]),
//			'address'   => 	$add[0].' '.$add[1],
//			'area' => 	$add[0],
//			'street' => $add[1]
//			);
//			$reciver_info = serialize($user_address);
//			$model->query("UPDATE  `shopnc`.`shop_order_common` SET  `reciver_info` = '".$reciver_info."' WHERE order_id =".$v['order_id']." ");
//
//        }
//		echo 'OK';
//	}


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
        $order_ids = array(501242,501191,501353);
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
        $new_store_name = '众鑫藏品';//新店铺名称
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
            $M_goods->table('goods')->where(array('goods_id'=>$v['goods_id']))->update(array('goods_image'=>$goods_img_name,'store_id'=>$new_store_id,'store_name'=>$new_store_name,'sku_lock'=>0));

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
           $M_goods->table('goods_common')->where(array('goods_commonid'=>$goodscomm['goods_commonid']))->update(array('goods_image'=>$goods_common_img_name,'store_id'=>$new_store_id,'store_name'=>$new_store_name,'goods_lock'=>0));


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
            $oss->yun_upload_img($new_img_path);//上传到OSS
        }
        return true;
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
        //$redis->hset('shengwei-test','name','tetete');
        //$res = $redis->hMset('goodstest-1',$newdata);
        //$res = $redis->hMset('goodstest-2',$arr);
        //echo $res;exit;
        $goods =  $redis->hgetall('nc_14684');
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