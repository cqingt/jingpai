<?php
/**
 * 微信杂志扫码发送优惠卷
 */
defined('InShopNC') or exit('Access Invalid!');

class weixin_activityControl extends mobileControl{

    public function __construct(){
        parent::__construct();

        $_SESSION['weixinVoucher_goods_id'] = intval(trim($_GET['goods_id']));

        $model_member = Model('member');

        $this->member_info = $model_member->getMemberInfoByID($_SESSION['member_id']);

        if(empty($this->member_info)) {

            showWapMessage('请登录',urlWap('login','index'),'error');

        }


    }

    /*第三套人民币《国钞瑰宝》、优惠卷ID_114*/
    public function setVoucher114Op(){
        $this->getWeixinVoucherOp(114,'【第一轮生肖邮票方联大全套3000元抵用券】');
    }


    /*第一轮生肖邮票四方连（单猴） 优惠券ID_115*/
    public function setVoucher115Op(){
        $this->getWeixinVoucherOp(115,'【第三套人民币《国钞瑰宝》5000元抵用券】');
    }

    /*一二三轮生肖邮票大全单品券 优惠券ID_155*/
    public function setVoucher155Op(){
        $this->getWeixinVoucherOp(155,'【一二三轮生肖邮票大全单品券 5000元抵用券】');
    }

    /*【纯银金猴大版票单品券 优惠券ID_157*/
    public function setVoucher157Op(){
        $this->getWeixinVoucherOp(157,'【纯银金猴大版票单品券 1000元抵用券】');
    }

    /*【第三套人民大全套单品券 优惠券ID_158*/
    public function setVoucher158Op(){
        $this->getWeixinVoucherOp(158,'【第三套人民大全套单品券 5000元抵用券】');
    }


    /*发送优惠券*/
    private function getWeixinVoucherOp($vid,$msg){
        if($vid && $_SESSION['member_id']){
            $result = file_get_contents("http://www.96567.com/index.php?act=pointvoucher&op=voucherexchange_wxadd&vid=$vid&uid=$_SESSION[member_id]");
            $result = json_decode($result,true);
            if($result['state'] == true){
                $msg = $msg?$msg:$result['msg'];
                if(!empty($_SESSION['weixinVoucher_goods_id'])){
                showWapMessage($msg.' 领取成功<br/><br/><a href=\''.urlWap('goods','index',array('goods_id'=>$_SESSION['weixinVoucher_goods_id'])).'\'>立即使用</a>',urlWap('goods','index',array('goods_id'=>$_SESSION['weixinVoucher_goods_id'])),'succ',30000);
                }else{
                showWapMessage($msg.' 领取成功',urlWap('member_voucher','voucher_list'),'succ',5000);
                }
            }else{
                if(!empty($_SESSION['weixinVoucher_goods_id'])){
                showWapMessage('请勿重复领取！',urlWap('goods','index',array('goods_id'=>$_SESSION['weixinVoucher_goods_id'])),'error');
                }else{
                showWapMessage('请勿重复领取！',urlWap('member_voucher','voucher_list'),'error');
                }
            }
        }else{
            showWapMessage('数据无效',urlWap('index','index'),'error');
        }
    }



}
