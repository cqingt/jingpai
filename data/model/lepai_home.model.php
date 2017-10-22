<?php
/**
 * 拍卖惠前台模块
 *
 */
defined('InShopNC') or exit('Access Invalid!');

class lepai_homeModel extends Model {

    public function __construct() {
        parent::__construct();
    }


    /**
     * 获取拍品信息
     */
    public function getGoodsInfo($condition, $field = '*',$order = "G_EndTime desc",$pagesize='20',$limit='') {
        $info = $this->table('lepai_admin_goods')->field($field)->where($condition)->order($order)->limit($limit)->page($pagesize)->select();

        if(is_array($info) && !empty($info)){
            foreach($info as $k=>$v){
                $chujia_user = $this->getLepaiLogOne(array('auction_id'=>$v['G_Id']));//当前价格
                $info[$k]['new_price'] =($chujia_user['price'] > 0)?$chujia_user['price']:$v['G_Qipai'];
                $member_info = '';
                if($chujia_user['price'] > 0){
                    $member_info = Model('member')->getMemberInfoByID($chujia_user['member_id']);
                    $info[$k]['member_name'] = $member_info['member_name'];
                }
                $theme = $this->getThemeInfoOne(array('T_Id'=>$v['G_Tid']));
                $info[$k]['T_Ktime'] =$theme['T_Ktime'];
            }
        }
        return $info;
    }

    /**
     * 获取拍品信息 limit + 当前价格
     */
    public function getGoodsInfoLimit($condition,$pagesize='10',$order='pai_count desc,G_Click desc',$field='*',$limit='') {
        $info = $this->table('lepai_admin_goods')->where($condition)->field($field)->order($order)->limit($limit)->page($pagesize)->select();
        if(is_array($info) && !empty($info)){
            foreach($info as $k=>$v){
                $chujia_user = $this->getLepaiLogOne(array('auction_id'=>$v['G_Id']));//当前价格
                $info[$k]['new_price'] =($chujia_user['price'] > 0)?$chujia_user['price']:$v['G_Qipai'];
            }
        }
        return $info;
    }

    /**
     * 获取往期信息 limit + 当前价格
     */
    public function getGoodsInfoMore($condition,$pagesize='20',$order='G_EndTime desc,G_Id desc',$field='*',$limit='') {
        $info = $this->table('lepai_admin_goods')->where($condition)->field($field)->order($order)->limit($limit)->page($pagesize)->select();
        if(is_array($info) && !empty($info)){
            foreach($info as $k=>$v){
                $chujia_user = $this->getLepaiLogOne(array('auction_id'=>$v['G_Id']));//当前价格
                $info[$k]['new_price'] =($chujia_user['price'] > 0)?$chujia_user['price']:$v['G_Qipai'];
                $member_info = '';
                if($chujia_user['price'] > 0){
                    $member_info = Model('member')->getMemberInfoByID($chujia_user['member_id']);
                    $info[$k]['member_name'] = $member_info['member_name'];
                }
            }
        }
        return $info;
    }

    /**
     * 获取单条拍品信息
     */
    public function getGoodsInfoOne($condition, $field = '*') {
        $goods = $this->table('lepai_admin_goods')->field($field)->where($condition)->find();
        if(is_array($goods) && !empty($goods)){
            $goods['imgs'] = $this->getGoodsImgs(array('IM_GoodsId'=>$goods['G_Id']));
            $goods['attribute'] = $this->getGoodsAttribute(array('I_GoodsId'=>$goods['G_Id']));
            $goods['baoming'] = $this->getLepaiBaomingCount(array('auction_id'=>$goods['G_Id']));
            $theme = $this->getThemeInfoOne(array('T_Id'=>$goods['G_Tid']));
            if(is_array($goods) && !empty($goods)){
                return array_merge($goods,$theme);
            }
        }
        return $goods;
    }

    /**
     * 获取开场产品
     */
    public function getGoodsInfoKai($condition,$on,$order = 'lepai_admin_goods.pai_count desc,lepai_admin_goods.G_Click desc', $field = 'lepai_admin_goods.*,lepai_admin_theme.T_Ktime',$limit='8') {
        $info = $this->table('lepai_admin_goods,lepai_admin_theme')->join('inner')->on($on)->field($field)->order($order)->limit($limit)->where($condition)->select();
        if(is_array($info) && !empty($info)){
            foreach($info as $k=>$v){
                $chujia_user = $this->getLepaiLogOne(array('auction_id'=>$v['G_Id']));//当前价格
                $info[$k]['new_price'] =($chujia_user['price'] > 0)?$chujia_user['price']:$v['G_Qipai'];
            }
        }
        return $info;
    }

    /**
     * 获取拍品求和
     */
    public function getGoodsSum($condition,$sumkey='pai_count') {
        return $this->table('lepai_admin_goods')->where($condition)->sum($sumkey);
    }

    /**
     * 获取拍品数量
     */
    public function getGoodsCount($condition) {
        return $this->table('lepai_admin_goods')->where($condition)->count();
    }

    /**
     * 更新商品数据
     */
    public function updateAuctionGoods($update, $condition) {
        return $this->table('lepai_admin_goods')->where($condition)->update($update);
    }

    /**
     * 获取单条出价信息
     */
    public function getLepaiLogOne($condition, $field = '*',$order = "price desc") {
        return $this->table('lepai_log')->field($field)->where($condition)->order($order)->find();
    }

    /**
     * 获取出价信息
     */
    public function getLepaiLog($condition,$pagesize='4',$order='price desc',$field='*',$limit='') {
        return $this->table('lepai_log')->where($condition)->field($field)->order($order)->limit($limit)->page($pagesize)->select();
    }

    /**
     * 获取出价记录数量
     */
    public function getLepaiLogCount($condition) {
        return $this->table('lepai_log')->where($condition)->count();
    }

    /**
     * 增加出价记录
     */
    public function addLepaiChujiaOnly($insert) {
        //判断是否延迟
        $goods = $this->getGoodsInfoOne(array('G_Id'=>$insert['auction_id']));
        if($goods['G_Yanchi'] > 0){
            if(($goods['G_EndTime'] - TIMESTAMP) < ($goods['G_Yanchi'] * 60)){
                $new_endtime = TIMESTAMP + ($goods['G_Yanchi'] * 60);
                //更新产品和关联专场结束时间
                $this->updateTheme(array('T_Jtime'=>$new_endtime),array('T_Id'=>$goods['T_Id']));
                $this->updateAuctionGoods(array('G_EndTime'=>$new_endtime),array('G_Id'=>$goods['G_Id']));
            }
        }
        $this->updateAuctionGoods(array('pai_count'=>array('exp','pai_count+1')),array('G_Id'=>$goods['G_Id']));//增加竞拍次数
        return $this->table('lepai_log')->insert($insert);
    }

    /**
     * 增加出价记录 轮询
     * $insert 客户最新出价
     * $status 是否存在客户最新出价
     * $IncMoney 最少加价金额
     */
    public function addLepaiChujia($insert,$status = true,$IncMoney = '',$kaichang = false) {
        //$status 客户提交出价 没有提交直接轮询委托出价记录
        if($status){ //用户提交出价
            $res = $this->addLepaiChujiaOnly($insert);
            if(!$res){
                return $res;
            }
        }

        //轮询逻辑
        $weituo = $this->getWeituo(array('auction_id'=>$insert['auction_id'],'is_sms'=>0));

        if(is_array($weituo) && !empty($weituo)){
            //委托存在，前一次出价用户出局
            $chujia_user = $this->getLepaiLogOne(array('auction_id'=>$insert['auction_id']));//最后出价用户
            if(is_array($chujia_user) && !empty($chujia_user) && $chujia_user['weituo'] != 1){
                //消息通知客户出局
                $param = array();
                $param['code'] = 'lepai_chaoguo';
                $param['member_id'] = $chujia_user['member_id'];
                $param['param'] = array(
                    'goods_url' => urlLepai('index','auction',array('id'=>$chujia_user['auction_id'])),
                );
                QueueClient::push('sendMemberMsg', $param);
            }
            try{
                $this->beginTransaction();
                //查询委托出价
                $res = $this->chujiaAction($weituo,$insert,$IncMoney,$kaichang);
                if (!$res) {
                    throw new Exception('操作失败,最后返回失败');
                }
                $this->commit();
            }catch (Exception $e){
                $this->rollback();
                return false;
            }
        }else{
            $res = true;
        }
        return $res;

    }

    /*
     * 逻辑：轮询查询委托出价刷新最新价格
     */
    public function chujiaAction($weituo,$insert,$IncMoney,$kaichang = false) {
        $member_id = $insert['member_id'];//当前出价用户
        $nextprice = intval($insert['price']+$IncMoney);//下一次出价
        if($kaichang != false){
            $addtime = $kaichang;
        }else{
            $addtime = TIMESTAMP;
        }
        foreach($weituo as $k=>$v){

            $weituo_price = intval($v['weituo_price']);

            if($v['member_id'] == $member_id){
                continue;
            }

            if($weituo_price < $nextprice){
                //出局
                //消息通知客户出局
                $param = array();
                $param['code'] = 'lepai_chaoguo';
                $param['member_id'] = $v['member_id'];
                $param['param'] = array(
                    'goods_url' => urlLepai('index','auction',array('id'=>$v['auction_id'])),
                );
                QueueClient::push('sendMemberMsg', $param);

                //出价被超过微信模板消息通知
                $wx_param = array(
                    'func'=>'lepai_chaoguo',
                    'auction_id'=>$v['auction_id'],
                    'member_id'=>$v['member_id'],
                    'nextprice'=>$nextprice,
                );
                QueueClient::push('sendWXTemplateMsg', $wx_param);

                $this->updateWeituo(array('is_sms'=>'1'),array('member_id'=>$v['member_id'],'auction_id'=>$v['auction_id']));

                unset($weituo[$k]);
                continue;
            }


            $new_price = ($weituo_price > $nextprice)?$nextprice:$weituo_price;
            $nextprice = intval($new_price+$IncMoney);
            $add = array();
            $add['auction_id'] = $v['auction_id'];
            $add['member_id'] = $member_id = $v['member_id'];
            $add['price'] = $new_price;
            $add['weituo'] = 1;
            $add['add_time'] = $addtime;
            $addres = $this->addLepaiChujiaOnly($add);//增加出价记录
            if(!$addres){
                throw new Exception('操作失败，循环存入失败');
            }
        }
        if(count($weituo) >1){
            $inst = array();
            $inst['member_id'] = $member_id;
            $inst['price'] = $new_price;
            self::chujiaAction($weituo,$inst,$IncMoney,$kaichang);
        }
        return true;
    }

    /**
     * 获取单条用户委托出价
     */
    public function getWeituoOne($condition, $field = '*') {
        return $this->table('lepai_weituo')->field($field)->where($condition)->find();
    }

    /**
     * 更新用户委托价格
     */
    public function updateWeituo($update, $condition) {
        return $this->table('lepai_weituo')->where($condition)->update($update);
    }

    /**
     * 增加用户委托信息
     */
    public function addWeituo($insert) {
        return $this->table('lepai_weituo')->insert($insert);
    }

    /**
     * 获取用户委托信息
     */
    public function getWeituo($condition, $field = '*',$order = "weituo_price asc,add_time asc") {
        return $this->table('lepai_weituo')->field($field)->where($condition)->order($order)->select();
    }

    /**
     * 获取拍品图片信息
     */
    public function getGoodsImgs($condition, $field = '*',$order = "IM_Type desc") {
        return $this->table('lepai_admin_img')->field($field)->where($condition)->order($order)->select();
    }

    /**
     * 获取拍品属性信息
     */
    public function getGoodsAttribute($condition, $field = '*') {
        return $this->table('lepai_admin_goodsinfo')->field($field)->where($condition)->select();
    }

    /**
     * 获取单挑专场信息
     */
    public function getThemeInfoOne($condition, $field = '*') {
        return $this->table('lepai_admin_theme')->field($field)->where($condition)->find();
    }

    /**
     * 获取多条专场信息
     */
    public function getThemeInfo($condition, $field = '*',$order='T_Ktime asc') {
        $theme =  $this->table('lepai_admin_theme')->field($field)->where($condition)->order($order)->select();
        if(is_array($theme) && !empty($theme)){
            foreach($theme as $k=>$v){
                $theme[$k]['goods_count'] = $this->getGoodsCount(array('G_Tid'=>$v['T_Id'],'G_Atype'=>array('egt','3')));
            }
        }
        return $theme;
    }

    /**
     * 更新专场
     */
    public function updateTheme($update, $condition) {
        return $this->table('lepai_admin_theme')->where($condition)->update($update);
    }

    /**
     * 拍卖报名数量
     */
    public function getLepaiBaomingCount($condition) {
        return $this->table('lepai_baoming')->where($condition)->count();
    }

    /**
     * 获取当前用户报名信息
     */
    public function getLepaiBaoming($condition, $field = '*') {
        return $this->table('lepai_baoming')->field($field)->where($condition)->find();
    }

    /**
     * 按条件检索报名信息
     */
    public function getLepaiBaomingSelect($condition, $field = '*') {
        return $this->table('lepai_baoming')->field($field)->where($condition)->select();
    }

    /**
     * 缴纳保证金
     */
    public function addLepaiBaoming($insert) {
        return $this->table('lepai_baoming')->insert($insert);
    }

    /**
     * 更新报名信息
     */
    public function updateLepaiBaoming($update, $condition) {
        return $this->table('lepai_baoming')->where($condition)->update($update);
    }

    /**
     * 获取单个拍卖惠订单
     */
    public function getLepaiOrderOne($condition, $field = '*') {
        return $this->table('lepai_order')->field($field)->where($condition)->find();
    }

    /**
     * 更新拍卖惠订单
     */
    public function updateLepaiOrder($update, $condition) {
		if($update['order_state'] == 0){
			//取消乐拍订单增加取消时间
			$update['cancel_time'] = time();
		}
        return $this->table('lepai_order')->where($condition)->update($update);
    }

    /**
     * 创建拍卖惠订单
     */
    public function addLepaiOrder($insert) {
        if(!empty($insert['order_sn']) && !empty($insert['lepai_theme_id']) && !empty($insert['lepai_goods_id']) && !empty($insert['buyer_id'])){

            $condition_sn['order_sn'] = $insert['order_sn'];
            $result_sn = $this->getLepaiOrderOne($condition_sn);
            if(!empty($result_sn)){
                return false;
            }

            $condition_['lepai_theme_id'] = $insert['lepai_theme_id'];
            $condition_['lepai_goods_id'] = $insert['lepai_goods_id'];
            $condition_['buyer_id'] = $insert['buyer_id'];

            $result = $this->getLepaiOrderOne($condition_);

            if(!empty($result)){

                return false;

            }else{

                return $this->table('lepai_order')->insert($insert);

            }
        }
    }

    /**
     * 获取拍卖惠订单列表
     */
    public function getLepaiOrder($condition,$pagesize='10',$order='add_time desc',$field='*',$limit='') {
        return $this->table('lepai_order')->where($condition)->field($field)->order($order)->limit($limit)->page($pagesize)->select();
    }

	/**
     * 获取拍卖惠订单详情
     */
	public function getLepaiOrderShow($condition, $extend = array(),$field="*"){
		 $order_info = $this->table('lepai_order')->where($condition)->field($field)->find();
		 $order_info['reciver_info'] = unserialize($order_info['reciver_info']);
		 $order_info['goods_list'] = $this->table('lepai_admin_goods')->where(array('G_Id'=>$order_info['lepai_goods_id']))->select();
        $order_info['reciver_info']['tel_phone'] = JieMiMobile($order_info['reciver_info']['tel_phone']);
        $order_info['reciver_info']['mob_phone'] =JieMiMobile($order_info['reciver_info']['mob_phone']);
        //追加返回店铺信息
        if (in_array('store',$extend)) {
            $order_info['extend_store'] = Model('store')->getStoreInfo(array('member_id'=>$order_info['store_member_id']));
        }

        //返回买家信息
        if (in_array('member',$extend)) {
            $order_info['extend_member'] = Model('member')->getMemberInfoByID($order_info['buyer_id']);
        }

        //追加返回商品信息
        if (in_array('order_goods',$extend)) {
            //取商品列表
            $order_goods_list = $this->getGoodsInfoOne(array('G_Id'=>$order_info['lepai_goods_id']));
            $order_info['extend_order_goods'] = $order_goods_list;
        }
		 return $order_info;
	}

    /**
     * 获取发布拍品的店主信息
     */
    public function getStoreInfo($condition, $field = '*') {
        return $this->table('lepai_audit')->field($field)->where($condition)->find();
    }

    /*
     * 拍卖惠结束退还用户保证金
     */
    public function tuihuanBZJ($g_atype, $auction_id, $member_id = '0'){
        if($member_id > 0){
            $baoming = $this->getLepaiBaomingSelect(array('auction_id'=>$auction_id));

            try {
                $this->beginTransaction();
                foreach($baoming as $k=>$v){
                    //如果竞拍状态为成功6，竞拍成功用户不退保证金
                    if($g_atype == 6){
                        if($v['member_id'] == $member_id){
                            continue;
                        }
                    }

                    $member_info = Model('member')->getMemberInfoByID($v['member_id']);

                    //退还保证金 1现金，2收藏币，3免保证金
                    if($v['type'] == 1){
                        //变更预存款
                        if($v['amount'] > 0){

                            $condition_jiaona['lg_member_id'] = $member_info['member_id'];
                            $condition_jiaona['lg_type'] = 'lepai_jiaona';
                            $condition_jiaona['lg_lepai_goodsid'] = $auction_id;
                            $lepai_jiaona = $this->table('pd_log')->where($condition_jiaona)->find();

                            $condition_tuihuan['lg_member_id'] = $member_info['member_id'];
                            $condition_tuihuan['lg_type'] = 'lepai_tuihuan';
                            $condition_tuihuan['lg_lepai_goodsid'] = $auction_id;
                            $lepai_tuihuan = $this->table('pd_log')->where($condition_tuihuan)->find();

                            if(!empty($lepai_jiaona)){

                                if(empty($lepai_tuihuan)){

                                    $data_pd = array();
                                    $data_pd['member_id'] = $member_info['member_id'];
                                    $data_pd['member_name'] = $member_info['member_name'];
                                    $data_pd['amount'] = intval($v['amount']);
                                    $data_pd['auction_id'] = $auction_id;
                                    $res = $this->changePd('lepai_tuihuan',$data_pd);

                                }else{
                                    $res = false;
                                }


                            }else{
                                $res = false;
                            }

                            
                        }else{
                            $res = true;
                        }

                    }elseif($v['type'] == 2){
                        //变更积分
                        if($v['amount'] > 0){

                            $condition_jiaona_jifen['pl_memberid'] = $member_info['member_id'];
                            $condition_jiaona_jifen['pl_lepai_type'] = 'lepai_jiaona';
                            $condition_jiaona_jifen['pl_lepai_goodsid'] = $auction_id;
                            $lepai_jiaona_jifen = Model()->table('points_log')->where($condition_jiaona_jifen)->find();

                            $condition_tuihuan_jifen['pl_memberid'] = $member_info['member_id'];
                            $condition_tuihuan_jifen['pl_lepai_type'] = 'lepai_tuihuan';
                            $condition_tuihuan_jifen['pl_lepai_goodsid'] = $auction_id;
                            $lepai_tuihuan_jifen = Model()->table('points_log')->where($condition_tuihuan_jifen)->find();

                            if(!empty($lepai_jiaona_jifen)){
                                if(empty($lepai_tuihuan_jifen)){
                                    $points_arr = array();
                                    $points_arr['pl_memberid'] = $member_info['member_id'];
                                    $points_arr['pl_membername'] = $member_info['member_name'];
                                    $points_arr['pl_points'] = intval($v['amount']);
                                    $points_arr['pl_desc'] = '【解冻】拍卖惠活动结束退还收藏币缴纳保证金，活动编号：'.$auction_id;
                                    $points_arr['pl_lepai_type'] = 'lepai_tuihuan';
                                    $points_arr['pl_lepai_goodsid'] = $auction_id;
                                    $res = Model('points')->savePointsLog('other',$points_arr);
                                }else{
                                    $res = false;
                                }
                            }else{
                                $res = false;
                            }
                        }else{
                            $res = true;
                        }


                    }elseif($v['type'] == 3){ //免保证金
                        $res = true;
                    }
                    if (!$res) {
                        throw new Exception('更新失败');
                    }else{
                        $update_res = $this->updateLepaiBaoming(array('is_return'=>'1'),array('id'=>$v['id']));
                        if(!$update_res){
                            throw new Exception('更新失败');
                        }
                    }
                }

                $this->commit();
            }catch (Exception $e){
                $this->rollback();
                return false;
            }
        }else{
            return true;
        }
    }

    /**
     * 变更预存款
     * @param unknown $change_type
     * @param unknown $data
     * @throws Exception
     * @return unknown
     */
    public function changePd($change_type,$data = array()) {
        $data_log = array();
        $data_pd = array();
        $data_msg = array();

        $data_log['lg_member_id'] = $data['member_id'];
        $data_log['lg_member_name'] = $data['member_name'];
        $data_log['lg_add_time'] = TIMESTAMP;
        $data_log['lg_type'] = $change_type;

        $data_msg['time'] = date('Y-m-d H:i:s');
        $data_msg['pd_url'] = urlShop('predeposit', 'pd_log_list');

        $data_log['lg_admin_name'] = $data['admin_name'];

        switch ($change_type){
            case 'lepai_jiaona':
                $data_log['lg_av_amount'] = -$data['amount'];
                $data_log['lg_freeze_amount'] = $data['amount'];
                $data_pd['available_predeposit'] = array('exp','available_predeposit-'.$data['amount']);
                $data_pd['freeze_predeposit'] = array('exp','freeze_predeposit+'.$data['amount']);
                $data_log['lg_desc'] = '【冻结】拍卖惠活动缴纳保证金，活动编号：'.$data['auction_id'];
                $data_log['lg_lepai_goodsid'] = $data['auction_id'];
                break;
            case 'lepai_tuihuan':
                $data_log['lg_av_amount'] = $data['amount'];
                $data_log['lg_freeze_amount'] = -$data['amount'];
                $data_pd['available_predeposit'] = array('exp','available_predeposit+'.$data['amount']);
                $data_pd['freeze_predeposit'] = array('exp','freeze_predeposit-'.$data['amount']);
                $data_log['lg_desc'] = '【解冻】拍卖惠活动解冻保证金，活动编号：'.$data['auction_id'];
                $data_log['lg_lepai_goodsid'] = $data['auction_id'];
                break;
            case 'lepai_set_money':
                $data_log['lg_freeze_amount'] = -$data['amount'];
                $data_pd['freeze_predeposit'] = array('exp','freeze_predeposit-'.$data['amount']);
                $data_log['lg_desc'] = '【超时】拍卖惠订单3天内未支付超时被取消！、活动编号：'.$data['auction_id'];
                break;
            default:
                throw new Exception('参数错误');
                break;
        }
        $data_msg['desc'] = $data_log['lg_desc'];
        $data_msg['av_amount'] = $data_log['lg_av_amount'];
        $data_msg['freeze_amount'] = $data_log['lg_freeze_amount'];

        $update = Model('member')->editMember(array('member_id'=>$data['member_id']),$data_pd);

        if (!$update) {
            throw new Exception('操作失败');
        }
        $insert = $this->table('pd_log')->insert($data_log);
        if (!$insert) {
            throw new Exception('操作失败');
        }

        // 支付成功发送买家消息
        $param = array();
        $param['code'] = 'predeposit_change';
        $param['member_id'] = $data['member_id'];
        $data_msg['av_amount'] = ncPriceFormat($data_msg['av_amount']);
        $data_msg['freeze_amount'] = ncPriceFormat($data_msg['freeze_amount']);
        $param['param'] = $data_msg;
        QueueClient::push('sendMemberMsg', $param);
        return $insert;
    }


}
