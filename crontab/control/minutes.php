<?php
/**
 * 任务计划 - 分钟执行的任务
 *
 *
 *
 *
 
 */
defined('InShopNC') or exit('Access Invalid!');

class minutesControl extends BaseCronControl {

    const MINUTES = 60;

    /**
     * 默认方法
     * 目前此脚本运行频率5分钟一次。
     */
    public function indexOp() {

        //取缓存中每个定时任务配置信息
        $crontab_minutes = rkcache('crontab_minutes', true);


        if(!is_array($crontab_minutes)|| empty($crontab_minutes)){
            $this->refresh_cacheOp();
            exit('没找到缓存信息，请重新刷新一遍，如还未找到缓存，请检查代码');
        }


        //秒杀订单提交后超过60分钟未付款自动取消
        if($this->do_this($crontab_minutes['miaosha_order_cancel'])){
            $this->_miaosha_order_cancel($crontab_minutes['miaosha_order_cancel']['frequency']);
            $crontab_minutes['miaosha_order_cancel']['last_time'] = TIMESTAMP;
        }

		//秒杀10分钟未付款发送微信通知
        if($this->do_this($crontab_minutes['miaosha_pay_status'])){
            $this->_wei_pay_tongzhi($crontab_minutes['miaosha_pay_status']['frequency'],'miaosha');
            $crontab_minutes['miaosha_pay_status']['last_time'] = TIMESTAMP;
        }

		//未付订单，下单后2小时未付款发送消息通知
        if($this->do_this($crontab_minutes['wei_pay_status'])){
            $this->_wei_pay_tongzhi($crontab_minutes['wei_pay_status']['frequency']);
            $crontab_minutes['wei_pay_status']['last_time'] = TIMESTAMP;
        }

        //在线支付订单，订单提交后超过24小时未付款自动取消
        if($this->do_this($crontab_minutes['online_pay_order_cancel'])){
            $this->_online_pay_order_cancel($crontab_minutes['online_pay_order_cancel']['implement']);
            $crontab_minutes['online_pay_order_cancel']['last_time'] = TIMESTAMP;
        }
		
        //银行转账订单，订单提交后超过72小时未付款自动取消
        if($this->do_this($crontab_minutes['bank_pay_order_cancel'])){
            $this->_bank_pay_order_cancel($crontab_minutes['bank_pay_order_cancel']['implement']);
            $crontab_minutes['bank_pay_order_cancel']['last_time'] = TIMESTAMP;
        }


        //10分钟更新一次
        if($this->do_this($crontab_minutes['refresh_10_min'])){

            //团购活动判断是否结束，结束修改状态并解锁商品
            $this->_groupbuy_close();

            //秒杀活动判断是否结束，结束修改状态并解锁商品
            $this->_miaosha_close();

            //拍卖结束后自动生成订单，未经拍成功用户保证金自动返还
            $this->_paimai_close();

            //拍卖结束后三天未付款自动取消
            $this->_paimai_close_quxiao();

			//限时折扣活动结束，解锁商品
            $this->_xianshi_close();

            $crontab_minutes['refresh_10_min']['last_time'] = TIMESTAMP;
        }

        //书画馆赠送优惠券 5分钟更新一次
        if($this->do_this($crontab_minutes['sh_voucher_'])){

            // $this->_sh_zs_voucher(); // 书画馆

            // $this->_jnb_zs_voucher(); // 纪念币

            // $this->_ssy_zs_voucher(); // 双十一

            $crontab_minutes['sh_voucher_']['last_time'] = TIMESTAMP;
        }



        //$this->_cron_common();
        //$this->_web_index_update();
        //$this->_cron_mail_send();

        wkcache('crontab_minutes', $crontab_minutes);


    }
    /*
     * 手动更新缓存 xin 20160323
     * 运行脚本：http://www.96567.com/crontab/index.php?act=minutes&op=refresh_cache
     * 说明：手动运行此文件，当需要更改某一定时脚本更新频率，再此方法中修改更新频率时间后运营一次更新缓存中的保存的更新频率
     * frequency 更新频率，单位分钟
     * last_time 最后更新时间
     */
    public function refresh_cacheOp(){
        $caches = array();

        //秒杀订单，订单提交后超过60分钟未付款自动取消 执行频率60分钟一次
        $caches['miaosha_order_cancel'] = array('frequency'=>'60','last_time'=>'');

        //在线支付订单，订单提交后超过24小时未付款自动取消 执行频率1小时一次
        $caches['online_pay_order_cancel'] = array('frequency'=>'60','implement'=>'1440','last_time'=>'');

        //银行转账订单，订单提交后超过72小时未付款自动取消 执行频率1小时一次
        $caches['bank_pay_order_cancel'] = array('frequency'=>'60','implement'=>'4320','last_time'=>'');

		//未付订单，下单后2小时未付款发送消息通知
        $caches['wei_pay_status'] = array('frequency'=>'120','last_time'=>'');
		//秒杀订单下单后10分钟未付款，发送消息通知
        $caches['miaosha_pay_status'] = array('frequency'=>'10','last_time'=>'');

        //书画馆赠送优惠券
        $caches['sh_voucher_'] = array('frequency'=>'5','last_time'=>'');

        //执行频率10分钟
        $caches['refresh_10_min'] = array('frequency'=>'10','last_time'=>'');

        wkcache('crontab_minutes', $caches);
    }


    /*
     * 检测此定时任务是否超过刷新时间，超过即可运行
     */
    private function do_this($param){
        $refresh_second = $param['frequency'] * self::MINUTES; //刷新频率，秒
        //当前时间减去最后操作时间大于刷新频率，则执行
        if((TIMESTAMP - $param['last_time']) > $refresh_second){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 更新首页的商品价格信息
     */
    private function _web_index_update(){
         Model('web_config')->updateWebGoods();
    }

    /**
     * 发送邮件消息
     */
    private function _cron_mail_send() {
        //每次发送数量
        $_num = 50;
        $model_storemsgcron = Model('mail_cron');
        $cron_array = $model_storemsgcron->getMailCronList(array(), $_num);
        if (!empty($cron_array)) {
            $email = new Email();
            $mail_array = array();
            foreach ($cron_array as $val) {
                $return = $email->send_sys_email($val['mail'],$val['subject'],$val['contnet']);
                if ($return) {
                    // 记录需要删除的id
                    $mail_array[] = $val['mail_id'];
                }
            }
            // 删除已发送的记录
            $model_storemsgcron->delMailCron(array('mail_id' => array('in', $mail_array)));
        }
    }

    /**
     * 执行通用任务
     */
    private function _cron_common(){

        //查找待执行任务
        $model_cron = Model('cron');
        $cron = $model_cron->getCronList(array('exetime'=>array('elt',TIMESTAMP)));
        if (!is_array($cron)) return ;
        $cron_array = array(); $cronid = array();
        foreach ($cron as $v) {
            $cron_array[$v['type']][$v['exeid']] = $v;
        }
        foreach ($cron_array as $k=>$v) {
            // 如果方法不存是，直接删除id
            if (!method_exists($this,'_cron_'.$k)) {
                $tmp = current($v);
                $cronid[] = $tmp['id'];continue;
            }
            $result = call_user_func_array(array($this,'_cron_'.$k),array($v));
            if (is_array($result)){
                $cronid = array_merge($cronid,$result);
            }
        }
        //删除执行完成的cron信息
        if (!empty($cronid) && is_array($cronid)){
            $model_cron->delCron(array('id'=>array('in',$cronid)));
        }
    }

    /**
     * 上架
     *
     * @param array $cron
     */
    private function _cron_1($cron = array()){
        $condition = array('goods_commonid' => array('in',array_keys($cron)));
        $update = Model('goods')->editProducesOnline($condition);
        if ($update){
            //返回执行成功的cronid
            $cronid = array();
            foreach ($cron as $v) {
                $cronid[] = $v['id'];
            }
        }else{
            return false;
        }
        return $cronid;
    }

    /**
     * 根据商品id更新商品促销价格
     *
     * @param array $cron
     */
    private function _cron_2($cron = array()){
        $condition = array('goods_id' => array('in',array_keys($cron)));
        $update = Model('goods')->editGoodsPromotionPrice($condition);
        if ($update){
            //返回执行成功的cronid
            $cronid = array();
            foreach ($cron as $v) {
                $cronid[] = $v['id'];
            }
        }else{
            return false;
        }
        return $cronid;
    }

    /**
     * 优惠套装过期
     *
     * @param array $cron
     */
    private function _cron_3($cron = array()) {
        $condition = array('store_id' => array('in', array_keys($cron)));
        $update = Model('p_bundling')->editBundlingQuotaClose($condition);
        if ($update) {
            //返回执行成功的cronid
            $cronid = array();
            foreach ($cron as $v) {
                $cronid[] = $v['id'];
            }
        } else {
            return false;
        }
        return $cronid;
    }

    /**
     * 推荐展位过期
     *
     * @param array $cron
     */
    private function _cron_4($cron = array()) {
        $condition = array('store_id' => array('in', array_keys($cron)));
        $update = Model('p_booth')->editBoothClose($condition);
        if ($update) {
            //返回执行成功的cronid
            $cronid = array();
            foreach ($cron as $v) {
                $cronid[] = $v['id'];
            }
        } else {
            return false;
        }
        return $cronid;
    }

    /**
     * 抢购开始更新商品促销价格
     *
     * @param array $cron
     */
    private function _cron_5($cron = array()) {
        $condition = array();
        $condition['goods_commonid'] = array('in', array_keys($cron));
        $condition['start_time'] = array('lt', TIMESTAMP);
        $condition['end_time'] = array('gt', TIMESTAMP);
        $groupbuy = Model('groupbuy')->getGroupbuyList($condition);
        foreach ($groupbuy as $val) {
            Model('goods')->editGoods(array('goods_promotion_price' => $val['groupbuy_price'], 'goods_promotion_type' => 1), array('goods_commonid' => $val['goods_commonid']));
        }
        //返回执行成功的cronid
        $cronid = array();
        foreach ($cron as $v) {
            $cronid[] = $v['id'];
        }
        return $cronid;
    }

    /**
     * 抢购过期
     *
     * @param array $cron
     */
    private function _cron_6($cron = array()) {
        $condition = array('goods_commonid' => array('in', array_keys($cron)));
        //抢购活动过期
        $update = Model('groupbuy')->editExpireGroupbuy($condition);
        if ($update){
            //返回执行成功的cronid
            $cronid = array();
            foreach ($cron as $v) {
                $cronid[] = $v['id'];
            }
        }else{
            return false;
        }
        return $cronid;
    }

    /**
     * 限时折扣过期
     *
     * @param array $cron
     */
    private function _cron_7($cron = array()) {
        $condition = array('xianshi_id' => array('in', array_keys($cron)));
        //限时折扣过期
        $update = Model('p_xianshi')->editExpireXianshi($condition);
        if ($update){
            //返回执行成功的cronid
            $cronid = array();
            foreach ($cron as $v) {
                $cronid[] = $v['id'];
            }
        }else{
            return false;
        }
        return $cronid;
    }
	 /*
     *  du 2016-04-14
     *  未付订单，下单后2小时未付款发送消息通知
     *  秒杀订单下单后10分钟未付款发送消息通知
     */
	private function _wei_pay_tongzhi($frequency,$miaosha=''){
		$model = Model();
		$dotime = TIMESTAMP - (self::MINUTES * $frequency);//超过$frequency分钟
		$shangtime = $dotime - (self::MINUTES * 5);//计算上次执行的时间
        
		if($miaosha == 'miaosha'){
			$where = "order.order_state=10 and order_goods.goods_type='6'  and order.payment_code != 'offline' and order.lock_state = 0 and order.add_time >='".$shangtime."' and order.add_time < '".$dotime."'";
			$orders = $model->table('order,order_goods')->field('*')->join('left')->on('order.order_id=order_goods.order_id')->where($where)->select();
		}else{
			$where = "order_state=10  and payment_code != 'offline' and lock_state = 0 and add_time >='".$shangtime."' and add_time < '".$dotime."'";
			$orders = $model->table('order')->field('*')->where($where)->select();
			
		}
		if(empty($orders) || !is_array($orders)){
            return;
        }

		foreach($orders as $key=>$val){
			$extend_order_goods = Model('order')->getOrderGoodsList(array('order_id'=>$val['order_id']));
			$goods_name_list = '';
			$dataArr = array();
			if($extend_order_goods){
				foreach ($extend_order_goods as $k => $v) {
						$goods_name_list .= $v['goods_name']."\n";
				}
			}
			$member_info = Model('member')->getMemberInfoByID($val['buyer_id']);
			$dataArr['first'] = $val['buyer_name'].',您有一笔待付款订单，别忘了去付款哦~';
			$dataArr['keyword1'] = $val['order_sn'];
			$dataArr['keyword2'] = $val['order_amount'];
			$dataArr['keyword3'] = $goods_name_list;
			$dataArr['remark'] = "\n".'如果您有任何疑问，可咨询在线客服或致电客户服热线400-81-96567，我们将竭诚为您服务。';
			$wx_param = array(
				 'func'=>'order_notice',
				 'template_id'=>'',
				 'openid'=>$member_info['openid'],
				  'url'=>'',
				 'data'=>$dataArr,          //dataArr为一维数组、详细字段如下：
			);


            //$log_array = array($wx_param,date('Y-m-d H:i:s',time()));

            //file_put_contents('log_moban.txt',print_r($log_array,true),FILE_APPEND);

			QueueClient::push('sendWXTemplateMsg', $wx_param);


		}

	}

    /*
     *  xin 20160318
     *  秒杀订单，订单提交后超过30分钟未付款自动取消 2016-04-12 改成一个小时未付款自动取消
     *  取消订单，恢复秒杀和商品库存，并将订单里秒杀商品价格恢复成原价，订单恢复成原价，如果同步CRM，CRM也恢复原价
     */
    private function _miaosha_order_cancel($frequency){
        $model = Model();
        $dotime = TIMESTAMP - (self::MINUTES * $frequency);//超过$frequency分钟
        
        $where = "order.order_state=10 and order_goods.goods_type='6' and payment_code != 'offline' and lock_state = 0 and add_time < '".$dotime."'";
        $orders = $model->table('order,order_goods')->field('*')->join('left')->on('order.order_id=order_goods.order_id')->where($where)->select();

        if(empty($orders) || !is_array($orders)){
            return;
        }


        $model_goods = Model('goods');
        $model_order = Model('order');
        $model_miaosha = Model('miaosha');
        $logic_order = Logic('order');
        $order_id_arr = array();

        foreach($orders as $key=>$val){
            if(!in_array($val['order_id'],$order_id_arr)){
                $order_id_arr[] = $val['order_id'];
                //关闭订单
                $result = $logic_order->changeOrderStateCancel($val,'system','系统','秒杀订单超期未支付系统自动关闭',true,false);
                if (!$result['state']) {
                    $this->log('实物秒杀订单超期未支付关闭失败SN:'.$val['order_sn']); continue;
                }
            }

            //处理订单商品，秒杀价格全部恢复成商品原价并重新计算订单金额覆盖原金额
            $goods_info = $model_goods->getGoodsInfoByID($val['goods_id']);
            if(!empty($goods_info)){
                //恢复秒杀库存
                $miaosha_update = array(
                    'buyer_count'=> array('exp','buyer_count-1'),
                    'buy_quantity'=>array('exp','buy_quantity-'.$val['goods_num']),
                );
                $model_miaosha->updateMiaoshaGoods($miaosha_update,array('miaosha_id'=>$val['promotions_id']));

                //变更订单商品价格，活动改默认
                // $update = array(
                //     'goods_price'=>$goods_info['goods_price'],
                //     'goods_pay_price'=>$goods_info['goods_price'] * $val['goods_num'],
                //     'goods_type'=>'1',
                //     'promotions_id'=>'0',
                // );
                // $model_order->editOrderGoods($update,array('rec_id'=>$val['rec_id']));

                // //重新计算订单金额  计算商品总金额
                // $goods_amount = $model_order->table('order_goods')->where(array('order_id'=>$val['order_id']))->sum('goods_pay_price');

                // //修改订单金额及订单商品金额，恢复成原价
                // $update_order = array(
                //     'goods_amount'=>$goods_amount,
                //     'order_amount'=>$goods_amount+$val['shipping_fee']+$val['pay_fee'],
                // );
                // $model_order->editOrder($update_order,array('order_id'=>$val['order_id']));

            }
        }
    }

    //团购活动判断是否结束，结束修改状态并解锁商品
    private function _groupbuy_close(){
        //查询状态未变已过期团购产品
        $model_groupbuy = Model('groupbuy');
        $condition = array();
        $condition['state'] = '20';
        $condition['end_time'] = array('lt',TIMESTAMP);
        $list = $model_groupbuy->getGroupbuyList($condition);
        if(empty($list) || !is_array($list)){
            return true;
        }

        //修改状态为结束并解锁
        foreach($list as $k=>$v){
            $model_groupbuy->closeGroupbuy($v['groupbuy_id']);
        }
        return true;
    }

    //秒杀活动判断是否结束，结束修改状态并解锁商品
    private function _miaosha_close(){
        //查询状态未变已过期秒杀产品
        $model_miaosha = Model('miaosha');
        $condition = array();
        $condition['state'] = '20';
        $condition['end_time'] = array('lt',TIMESTAMP);
        $list = $model_miaosha->getMiaoshaList($condition);
		
        if(empty($list) || !is_array($list)){
            return true;
        }
        //修改状态为结束并解锁
        foreach($list as $k=>$v){
            $model_miaosha->cancelMiaosha($v['miaosha_id']);
        }
        return true;
    }
	//显示折扣结束自动解锁商品
	private function _xianshi_close(){
		$xianshi_goods = Model('p_xianshi_goods');
		$condition = array();
        $condition['end_time'] = array('lt',TIMESTAMP);
		$xianshi_goods->CancleXianshiGoods($condition);
	
	}
    //拍卖结束后自动生成订单，未经拍成功用户保证金自动返还
    private function _paimai_close(){
        $h_model = Model('lepai_home');
        $condition = array();
        $condition['G_Atype'] = '3';
        $condition['G_EndTime'] = array('lt',TIMESTAMP);
        $list = $h_model->table('lepai_admin_goods')->where($condition)->field('*')->select();
        if(empty($list) || !is_array($list)){
            return true;
        }

        foreach($list as $k=>$goods){
            $chujia_user = $h_model->getLepaiLogOne(array('auction_id'=>$goods['G_Id']));//最后出价用户
            if($chujia_user['price'] > 0){
                $member_info = Model('member')->getMemberInfoByID($chujia_user['member_id']);//获取买家信息
                if($goods['G_BaoliuMoney'] > 0 && $chujia_user['price'] < $goods['G_BaoliuMoney']){
                    //变更状态为流拍
                    $g_atype = 7;
                }else{
                    //变更状态为竞拍成功
                    $g_atype = 6;

                    //生成订单
                    $sellerInfo = $h_model->getStoreInfo(array('member_id'=>$goods['G_Uid']));//获取本产品关联卖家信息
                    $addOrder = array();
                    $addOrder['order_sn'] = $this->makeLepaiSn($goods['G_Id']);
                    $addOrder['store_member_id'] = $sellerInfo['member_id'];
                    $addOrder['store_member_name'] = $sellerInfo['member_name'];
                    $addOrder['lepai_theme_id'] = $goods['G_Tid'];
                    $addOrder['lepai_goods_id'] = $goods['G_Id'];
                    $addOrder['buyer_id'] = $member_info['member_id'];
                    $addOrder['buyer_name'] = $member_info['member_name'];
                    $addOrder['add_time'] = TIMESTAMP;
                    $addOrder['goods_amount'] = $chujia_user['price'];
                    $addOrder['order_amount'] = $chujia_user['price'];
                    //获取用户保证金
                    $baoming = $h_model->getLepaiBaoming(array('auction_id'=>$goods['G_Id'],'member_id'=>$member_info['member_id'],'is_return'=>'0'));
                    $pd_amount = ($baoming['type'] == 1)?$baoming['amount']:'0';
                    $addOrder['pd_amount'] = $pd_amount;//预存款支付金额，如果竞拍是用余额缴纳保证金，抵扣到这里
                    $addOrder['shipping_fee'] = 0;
                    $addOrder['order_state'] = 10;

                    $order_res = $h_model->addLepaiOrder($addOrder);
                    if(!$order_res){
                        continue;
                        //showMessage('拍卖惠订单创建失败！','','html','error');
                    }

                    //通知客户竞拍成功
                    $param = array();
                    $param['code'] = 'lepai_order';
                    $param['member_id'] = $member_info['member_id'];
                    $param['param'] = array(
                        'goods_url' => urlLepai('index','auction',array('id'=>$goods['G_Id'])),
                    );
                    QueueClient::push('sendMemberMsg', $param);
                }
                //成功与流拍都退还保证金 竞拍成功用户暂不退还
                $h_model->tuihuanBZJ($g_atype,$goods['G_Id'],$chujia_user['member_id']);
            }else{
                $g_atype = 7;
            }
            $h_model->updateAuctionGoods(array('G_Atype'=>$g_atype),array('G_Id'=>$goods['G_Id']));//修改结束拍品竞拍状态
            //发送微信模板消息，拍卖结束通知
            $wx_param = array(
                'func'=>'lepai_jieshu',
                'auction_id'=>$goods['G_Id'],
                'g_atype'=>$g_atype,//结束状态，7流拍6竞拍成功
            );
            if($g_atype == 6){
                //竞拍成功用户名，价格
                $wx_param['buyer_name'] = $member_info['member_name'];
                $wx_param['price'] = $chujia_user['price'];
            }
            QueueClient::push('sendWXTemplateMsg', $wx_param);
        }
        return true;
    }


    /* Add is name lt 2016-04-27 在线支付订单超过24小时未支付取消订单
    *  走商城取消订单流程并同步CRM
    */
    private function _online_pay_order_cancel($frequency){
        $model_order = Model('order');
        $logic_order = Logic('order');
        $dotime = TIMESTAMP - (self::MINUTES * $frequency);//超过$frequency分钟
        
        // $where = "order.order_state=10 and order_goods.goods_type='1' and order.payment_code = 'online' and order.lock_state = 0 and order.add_time < '".$dotime."'";
        // $orders = $model_order->table('order,order_goods')->field('*')->join('left')->on('order.order_id=order_goods.order_id')->where($where)->select();

        $where = "order_state=10  and payment_code = 'online' and lock_state = 0 and add_time < '".$dotime."'";
        $orders = $model_order->table('order')->where($where)->select();

        //file_put_contents('order_onlin.txt',print_r($orders,true),FILE_APPEND);


        if(empty($orders) || !is_array($orders)){
            return;
        }

        foreach($orders as $k => $v){
            $if_allow = $model_order->getOrderOperateState('buyer_cancel',$v);

            if ($if_allow === true) {
                $result = $logic_order->changeOrderStateCancel($v,'system','系统','在线支付订单超期未支付系统自动关闭');
            }else{
                continue;
            }
        }


    }


    /* Add is name lt 2016-04-27 银行转账订单超过72小时未支付取消订单
    *  走商城取消订单流程并同步CRM
    */
    private function _bank_pay_order_cancel($frequency){
        $model_order = Model('order');
        $logic_order = Logic('order');
        $dotime = TIMESTAMP - (self::MINUTES * $frequency);//超过$frequency分钟
        
        // $where = "order.order_state=10 and order_goods.goods_type='1' and order.payment_code = 'bank' and order.lock_state = 0 and order.add_time < '".$dotime."'";
        // $orders = $model_order->table('order,order_goods')->field('*')->join('left')->on('order.order_id=order_goods.order_id')->where($where)->select();

        $where = "order_state=10  and payment_code = 'bank' and lock_state = 0 and add_time < '".$dotime."'";
        $orders = $model_order->table('order')->where($where)->select();

        if(empty($orders) || !is_array($orders)){
            return;
        }

        foreach($orders as $k => $v){
            $if_allow = $model_order->getOrderOperateState('buyer_cancel',$v);

            if ($if_allow === true) {
                $result = $logic_order->changeOrderStateCancel($v,'system','系统','银行转账订单超期未支付系统自动关闭');
            }else{
                continue;
            }
        }

        
    }



    private function _sh_zs_voucher(){

        $t = strtotime('2016-10-31 23:59:59');

        if(time() > $t){
            exit;
        }
        
        $model = Model();

        $model_voucher = Model('store_voucher');

        $model_member = Model('member');

        $model_order = Model('order');

        $sql = 'SELECT o.* FROM `shop_order_goods` as og 
left join `shop_goods` as g ON og.goods_id=g.goods_id 
left join `shop_order` as o ON og.order_id=o.order_id
WHERE og.rec_id > 296080 
AND og.store_id IN(3,22)
AND og.goods_pay_price > 798 
AND g.gc_id_1 = 79 
AND o.payment_time <> \'\'
AND o.sh_this_voucher_ = 1
AND o.order_amount > 999
GROUP BY og.order_id LIMIT 0,20';
        

        // 所有有资格送卷的订单ID
        $order_list = $model->query($sql);

        foreach ($order_list as $k => $v) {

            // 判断当前订单是否发送过优券
            if($v['sh_this_voucher_'] == 2){
                continue;
            }

            // 判断当前订单是即时付款还是货到付款 !!货到付款订单完成后才有支付时间
            if($v['payment_code'] == 'offline'){//货到付款
                if(empty($v['finnshed_time'])){
                    continue;
                }
            }elseif(empty($v['payment_time'])){
                continue;
            }

            // 查出当前订单的所有书画商品 !!在订单商品表中的实际成交金额是已减过优惠券的金额
            $this_order_goods_list_sql = 'SELECT SUM(`pingtai_voucher_price`) as pt_money,SUM(`goods_pay_price`) as sum_money FROM `shop_order_goods` as og left join `shop_goods` as g ON og.goods_id=g.goods_id WHERE og.rec_id > 296080 AND og.order_id = '.$v['order_id'].' AND g.gc_id_1 = 79 LIMIT 0,10';
            $this_order_goods_list = $model->query($this_order_goods_list_sql);

            $this_money = $this_order_goods_list['0']['sum_money'];

            if($this_money >= 999 && $this_money < 2000){
                $voucher_id = '10';
            }elseif($this_money >= 2000 && $this_money < 3000){
                $voucher_id = '11';
            }elseif($this_money >= 3000 && $this_money < 4000){
                $voucher_id = '12';
            }elseif($this_money >= 4000){
                $voucher_id = '13';
            }else{
                continue;
            }


            try {

                $model->beginTransaction();

                // 发送优惠券给用户

                $template_info = $model_voucher->table('store_voucher_template')->where(array('voucher_t_id'=>$voucher_id))->find();

                //添加代金券信息
                $data = $model_voucher->exchangeVoucher($template_info,$v['buyer_id'],$v['buyer_name']);

                if($data['state'] != true){
                    throw new Exception();
                }

                // 给订单信息中记录优惠券发送纪录
                $order_log['order_id'] = $v['order_id'];
                $order_log['log_msg'] = '该订单参与书画馆返现活动，'.$template_info['voucher_t_price'].'元平台优惠券已发放，优惠券id：'.$voucher_id.'-'.$data['voucher_id'].',如退款/退货，需收回优惠券。';
                $order_log['log_time'] = time();
                $order_log['log_role'] = '书画馆';
                $order_log['log_user'] = $data['voucher_id'];
                $order_log['log_orderstate'] = $v['order_state'];

                $order_log_info = $model_order->addOrderLog($order_log);

                if(empty($order_log_info)){
                    throw new Exception();
                }

                // 修改当前订单是否发送过优惠券
                $order_update_info = $model_order->editOrder(array('sh_this_voucher_'=>2),array('order_id'=>$v['order_id']));

                if(empty($order_update_info)){
                    throw new Exception();
                }

                $model->commit();

            } catch (Exception $e) {

                $model->rollback();
                continue;
            }
        }


    }


    private function _jnb_zs_voucher(){

        $model = Model();

        $model_voucher = Model('store_voucher');

        $model_member = Model('member');

        $model_order = Model('order');

        $sql = 'SELECT o.* FROM `shop_order_goods` as og 
left join `shop_order` as o ON og.order_id=o.order_id
WHERE og.rec_id > 313598 
AND og.goods_id IN(31244,34068,27974,27990,33166,17550,31230,16436,27673,22502,12384,11227)
AND o.finnshed_time <> \'\'
AND o.sh_this_voucher_ = 1
GROUP BY og.order_id LIMIT 0,10';
        

        // 所有有资格送卷的订单ID
        $order_list = $model->query($sql);

        // 100券
        $vou_100 = array('31244','34068');
        // 50券
        $vou_50 = array('27974','27990','33166','17550','31230','16436');
        // 30券
        $vou_30 = array('27673','22502','12384','11227');


        foreach ($order_list as $k => $v) {

            // 判断当前订单是否发送过优券
            if($v['sh_this_voucher_'] == 2){
                continue;
            }

            // 判断当前订单是即时付款还是货到付款 !!货到付款订单完成后才有支付时间
            if(empty($v['finnshed_time'])){
                continue;
            }

            $condition['order_id'] = $v['order_id'];
            $order_goods_list = $model_order->getOrderGoodsList($condition);

            foreach ($order_goods_list as $goods) {
                if(in_array($goods['goods_id'],$vou_100)){
                    $voucher_id = 14;
                }elseif(in_array($goods['goods_id'],$vou_50)){
                    $voucher_id = 15;
                }elseif(in_array($goods['goods_id'],$vou_30)){
                    $voucher_id = 16;
                }

                if(empty($voucher_id)){
                    continue;
                }

                try {

                    $model->beginTransaction();

                    // 发送优惠券给用户

                    $template_info = $model_voucher->table('store_voucher_template')->where(array('voucher_t_id'=>$voucher_id))->find();

                    //添加代金券信息
                    $data = $model_voucher->exchangeVoucher($template_info,$v['buyer_id'],$v['buyer_name']);

                    if($data['state'] != true){
                        throw new Exception();
                    }

                    // 给订单信息中记录优惠券发送纪录
                    $order_log['order_id'] = $v['order_id'];
                    $order_log['log_msg'] = '该订单参与纪念币返现活动，'.$template_info['voucher_t_price'].'元平台优惠券已发放，优惠券id：'.$voucher_id.'-'.$data['voucher_id'].',如退款/退货，需收回优惠券。';
                    $order_log['log_time'] = time();
                    $order_log['log_role'] = '纪念币';
                    $order_log['log_user'] = 'admin';
                    $order_log['log_orderstate'] = $v['order_state'];

                    $order_log_info = $model_order->addOrderLog($order_log);

                    if(empty($order_log_info)){
                        throw new Exception();
                    }

                    // 修改当前订单是否发送过优惠券
                    $order_update_info = $model_order->editOrder(array('sh_this_voucher_'=>2),array('order_id'=>$v['order_id']));

                    if(empty($order_update_info)){
                        throw new Exception();
                    }

                    $model->commit();

                } catch (Exception $e) {

                    $model->rollback();
                    continue;
                }

            }


        }
    }

    /* Add is name lt 2016-10-31 拍卖三天未付款自动取消*/
    private function _paimai_close_quxiao(){
        $pay_array['add_time'] = array('lt',time()-86400*3);
        $pay_array['order_state'] = '10';
        $pay_result = Model()->table('lepai_order')->where($pay_array)->select();
        if(!empty($pay_result)){
            foreach($pay_result as $k => $v){
                $h_model = Model('lepai_home');
                $h_model->updateLepaiOrder(array('order_state'=>'0'),array('order_id'=>$v['order_id']));
                if($v['pd_amount'] > '0'){
                    try {
                        Model()->beginTransaction();
                        //变更预存款
                        $data_pd = array();
                        $data_pd['member_id'] = $v['buyer_id'];
                        $data_pd['member_name'] = $v['buyer_name'];
                        $data_pd['amount'] = $v['pd_amount'];
                        $data_pd['auction_id'] = $v['lepai_goods_id'];
                        $res = $h_model->changePd('lepai_set_money',$data_pd);
                        if(!$res){
                            throw new Exception('操作失败');
                        }
                        Model()->commit();
                    }catch (Exception $e){
                        Model()->rollback();
                        continue;
                    }
                }
            }
        }
    }
    /* End */


    private function _ssy_zs_voucher(){

        $model = Model();

        $model_voucher = Model('voucher');

        $model_member = Model('member');

        $model_order = Model('order');

        $sql = 'SELECT o.*,og.goods_id FROM `shop_order_goods` as og 
left join `shop_order` as o ON og.order_id=o.order_id
WHERE og.rec_id > 321021 
AND og.goods_id IN(11729,12384,662,36497,29780,963,36363,28211) 
AND o.payment_time <> \'\'
AND o.sh_this_voucher_ = 1
GROUP BY og.order_id LIMIT 0,100';

        // 所有有资格送卷的订单ID
        $order_list = $model->query($sql);

        foreach ($order_list as $k => $v) {

            // 判断当前订单是否发送过优券
            if($v['sh_this_voucher_'] == 2){
                continue;
            }

            // 判断当前订单是即时付款还是货到付款 !!货到付款订单完成后才有支付时间
            if($v['payment_code'] == 'offline'){//货到付款
                if(empty($v['finnshed_time'])){
                    continue;
                }
            }elseif(empty($v['payment_time'])){
                continue;
            }



            $condition['order_id'] = $v['order_id'];
            $order_goods_list = $model_order->getOrderGoodsList($condition);

            foreach ($order_goods_list as $goods) {

                switch (intval($goods['goods_id'])) {
                    case '11729':
                        $vid = '388';
                        break;
                    case '12384':
                        $vid = '389';
                        break;
                    case '662':
                        $vid = '390';
                        break;
                    case '36497':
                        $vid = '391';
                        break;
                    case '29780':
                        $vid = '392';
                        break;
                    case '963':
                        $vid = '393';
                        break;
                    case '36363':
                        $vid = '394';
                        break;
                    case '28211':
                        $vid = '395';
                        break;
                    default:
                        $vid = '';
                        break;
                }

                if(empty($vid)){
                    continue;
                }

                try {

                    $model->beginTransaction();

                    $_SESSION['shoudong_voucher'] = true; //不需要积分兑换

                    $data = $model_voucher->getCanChangeTemplateInfo($vid,intval($v['buyer_id']),'');

                    if ($data['state'] == false){
                        throw new Exception();
                    }

                    $data = $model_voucher->exchangeVoucher($data['info'],$v['buyer_id'],$v['buyer_name'],true);

                    if ($data['state'] == false){
                        throw new Exception();
                    }

                    // 修改当前订单是否发送过优惠券
                    $order_update_info = $model_order->editOrder(array('sh_this_voucher_'=>2),array('order_id'=>$v['order_id']));

                    if(empty($order_update_info)){
                        throw new Exception();
                    }

                    $model->commit();

                } catch (Exception $e) {

                    $model->rollback();
                    continue;
                }

            }

        }


    }







}