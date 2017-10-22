<?php
/**
 * 微信模板消息通知
 * 
 * @package    
 */
defined('InShopNC') or exit('Access Invalid!');

class WeixinTemplateMsg {

    function __construct(){
        $this->wxsdk = new weixinSDK();
    }

    //拍卖结束提醒
    function lepai_jieshu($param){

        $lepai_model = Model('lepai_home');

        $openid_members = $lepai_model->table('member,lepai_baoming')->field('member.openid')->join('left')->on('member.member_id = lepai_baoming.member_id')->where("member.openid != '' AND lepai_baoming.auction_id = '".$param['auction_id']."'")->select();
        if(!is_array($openid_members) || empty($openid_members)){
            return false;
        }

        $auction = $lepai_model->getGoodsInfoOne(array('G_Id'=>$param['auction_id']));

        $template_id = "NURFBHG-9yzIInKOpMZzdVu6d7QXC1A9d4ehFgTMYLY"; //模板ID
        if($param['g_atype'] == 6){
            $mark = "会员 ".mb_substr($param['buyer_name'],0,2,'utf-8')."*** 竞拍成功\n成交价：".$param['price']."元";
        }else{
            $mark = '';
        }
        $wx_data = array(
            "first"=>array("value"=>"您参与的拍卖已结束！","color"=>"#173177"),
            "number"=>array("value"=>$auction['T_Title'],"color"=>"#173177"),
            "name"=>array("value"=>$auction['G_Name'],"color"=>"#173177"),
            "deadline"=>array("value"=>date('Y-m-d H:i',$auction['G_EndTime']),"color"=>"#173177"),
            "remark"=>array("value"=>$mark,"color"=>"#173177"),
        );
        $url = url('lepai', 'auction', array('id'=>$auction['G_Id']), false, M_SITE_URL);

        foreach($openid_members as $k=>$v){
            if($v['openid'] != ''){
                $this->wxsdk->sendTemplateMessage($v['openid'],$wx_data,$template_id,$url);
            }
        }

        return true;
    }

    //拍卖出价被超越通知
    /*
        {{first.DATA}}
        拍卖期数：{{number.DATA}}
        拍品名称：{{name.DATA}}
        {{remark.DATA}}
     */
    function lepai_chaoguo($param){
        $member_info = Model('member')->getMemberInfoByID($param['member_id'],'openid');
        if(empty($member_info['openid'])){
            return false;
        }

        $auction = Model('lepai_home')->getGoodsInfoOne(array('G_Id'=>$param['auction_id']));

        $wx_openid = $member_info['openid']; //用户openid
        $template_id = "7sgYpmpb1Ie2bA4ZLPQI_vTCCyquYiO6ZvQtPVikMaU"; //模板ID
        $wx_data = array(
            "first"=>array("value"=>"感谢您参与拍卖，您的出价已被超越！\n当前价￥".$param['nextprice'],"color"=>"#173177"),
            "number"=>array("value"=>$auction['T_Title'],"color"=>"#173177"),
            "name"=>array("value"=>$auction['G_Name'],"color"=>"#173177"),
            "remark"=>array("value"=>"距离本场拍卖结束还有:".$this->gettime(time(),$auction['G_EndTime']),"color"=>"#173177"),
        );
        $url = url('lepai', 'auction', array('id'=>$auction['G_Id']), false, M_SITE_URL);

        $this->wxsdk->sendTemplateMessage($wx_openid,$wx_data,$template_id,$url);

        return true;
    }


    /**
     * 订单通知模板
     */
    public function order_notice($param){
        $this->send_moban_info('order_notice',7,$param);
    }

    /**
     * 积分变动通知
     */
    public function jifen_change($param){
        $this->send_moban_info('jifen_change',8,$param);
    }

    /**
     * 竞拍成功通知
     */
    public function jingpai_success($param){
        $this->send_moban_info('jingpai_success',9,$param);
    }

    /**
     * 账户余额变动通知
     */
    public function money_change($param){
        $this->send_moban_info('money_change',10,$param);
    }

    /**
     * 退款进度通知
     */
    public function refund_notice($param){
        $this->send_moban_info('refund_notice',11,$param);
    }

    /**
     * 到期提醒通知
     */
    public function endtime_notice($param){
        $this->send_moban_info('endtime_notice',12,$param);
    }

    /**
     * 商品详情通知
     */
    public function goods_info($param){
        $this->send_moban_info('goods_info',13,$param);
    }

    /**
     * 提现审核结果通知
     */
    public function tixian_result($param){
        $this->send_moban_info('tixian_result',14,$param);
    }

    /**
     * 提醒供应商发货通知
     */
    public function fahuo_notice($param){
        $this->send_moban_info('fahuo_notice',15,$param);
    }

    /**
     * 售后申请通知
     */
    public function shouhou_notice($param){
        $this->send_moban_info('shouhou_notice',16,$param);
    }






/**

调用方法

*/
    
    
    /*
        接收模板消息并发送
    */
    private function send_moban_info($moban,$id,$param){

//	if($param['openid'] != 'ocmCHjp2lDPvkzyYVMgD4S7SMTRg'){
//		return false;
//	}
		if(!$param['openid']){
			return false;
		}
        $mobaninfo = json_decode($this->getMobanInfo($id),true);
        $template_id = $mobaninfo['template_id'];
        $openid = $param['openid']?$param['openid']:'ocmCHjvOcGWeMkzeXPBIMWTDRNaY';
        $url = $param['url']?$param['url']:$mobaninfo['url'];

        switch ($moban) {

            /*
            订单通知模板
            {{first.DATA}}
            订单号：{{keyword1.DATA}}
            订单金额：{{keyword2.DATA}}
            商品信息：{{keyword3.DATA}}
            {{remark.DATA}}
             */

            case 'order_notice':
                $wx_data = array(
                    "first"=>array("value"=>$param['data']['first'],"color"=>"#173177"),
                    "keyword1"=>array("value"=>$param['data']['keyword1'],"color"=>"#173177"),
                    "keyword2"=>array("value"=>$param['data']['keyword2'],"color"=>"#173177"),
                    "keyword3"=>array("value"=>$param['data']['keyword3'],"color"=>"#173177"),
                    "remark"=>array("value"=>$param['data']['remark']."\n\n".$mobaninfo['remark'],"color"=>"#173177"),
                );
                break;


            /*
             积分变动通知
             {{first.DATA}}
             {{FieldName.DATA}}:{{Account.DATA}}
             {{change.DATA}}积分:{{CreditChange.DATA}}
             积分余额:{{CreditTotal.DATA}}
             {{Remark.DATA}}
             */
            case 'jifen_change':
                $wx_data = array(
                    "first"=>array("value"=>$param['data']['first'],"color"=>"#173177"),
                    "FieldName"=>array("value"=>$param['data']['FieldName'],"color"=>"#000"),
                    "Account"=>array("value"=>$param['data']['Account'],"color"=>"#173177"),
                    "change"=>array("value"=>$param['data']['change'],"color"=>"#000"),
                    "CreditChange"=>array("value"=>$param['data']['CreditChange'],"color"=>"#173177"),
                    "CreditTotal"=>array("value"=>$param['data']['CreditTotal'],"color"=>"#173177"),
                    "Remark"=>array("value"=>$param['data']['Remark']."\n\n".$mobaninfo['remark'],"color"=>"#173177"),
                );
                break;


            /*
            竞拍成功通知
            jb3Hr8npAbToKQZtPmo6EzSOvUOQUck4qRsC-p5pKT0

            {{first.DATA}}
            拍卖商品：{{keyword1.DATA}}
            拍卖价：{{keyword2.DATA}}
            {{remark.DATA}}
            */
            case 'jingpai_success':
                $wx_data = array(
                    "first"=>array("value"=>$param['data']['first'],"color"=>"#173177"),
                    "keyword1"=>array("value"=>$param['data']['keyword1'],"color"=>"#173177"),
                    "keyword2"=>array("value"=>$param['data']['keyword2'],"color"=>"#173177"),
                    "remark"=>array("value"=>$param['data']['remark']."\n\n".$mobaninfo['remark'],"color"=>"#173177"),
                );
                break;


            /*
            账户余额变动通知
            EXUWWLR7EHFn9guEyUTzr37Kv1G4iV7bMld4Y7IXqXM

            {{first.DATA}}
            账户类型：{{keyword1.DATA}}
            操作类型：{{keyword2.DATA}}
            操作内容：{{keyword3.DATA}}
            变动额度：{{keyword4.DATA}}
            账户余额：{{keyword5.DATA}}
            {{remark.DATA}}
            */
            case 'money_change':
                $wx_data = array(
                    "first"=>array("value"=>$param['data']['first'],"color"=>"#173177"),
                    "keyword1"=>array("value"=>$param['data']['keyword1'],"color"=>"#173177"),
                    "keyword2"=>array("value"=>$param['data']['keyword2'],"color"=>"#173177"),
                    "keyword3"=>array("value"=>$param['data']['keyword3'],"color"=>"#173177"),
                    "keyword4"=>array("value"=>$param['data']['keyword4'],"color"=>"#173177"),
                    "keyword5"=>array("value"=>$param['data']['keyword5'],"color"=>"#173177"),
                    "remark"=>array("value"=>$param['data']['remark']."\n\n".$mobaninfo['remark'],"color"=>"#173177"),
                );
                break;



            /*
            退款进度通知
            loNCp090cPBGZIgkZqIexDbJGsbqU0QpyVtFbCJ8MoI

            {{first.DATA}}
            订单编号：{{keyword1.DATA}}
            当前进度：{{keyword2.DATA}}
            商品名称：{{keyword3.DATA}}
            退款金额：{{keyword4.DATA}}
            {{remark.DATA}}
            */
            case 'refund_notice':
                $wx_data = array(
                    "first"=>array("value"=>$param['data']['first'],"color"=>"#173177"),
                    "keyword1"=>array("value"=>$param['data']['keyword1'],"color"=>"#173177"),
                    "keyword2"=>array("value"=>$param['data']['keyword2'],"color"=>"#173177"),
                    "keyword3"=>array("value"=>$param['data']['keyword3'],"color"=>"#173177"),
                    "keyword4"=>array("value"=>$param['data']['keyword4'],"color"=>"#173177"),
                    "remark"=>array("value"=>$param['data']['remark']."\n\n".$mobaninfo['remark'],"color"=>"#173177"),
                );
                break;



            /*
            到期提醒通知
            QGWpDcFpL1RXJkdmeUngcAR3gCoFcI6bOolTehSx-mw

            {{first.DATA}}
            您的{{name.DATA}}有效期至{{expDate.DATA}}。
            {{remark.DATA}}
            */
            case 'endtime_notice':
                $wx_data = array(
                    "first"=>array("value"=>$param['data']['first'],"color"=>"#173177"),
                    "name"=>array("value"=>$param['data']['name'],"color"=>"#173177"),
                    "expDate"=>array("value"=>$param['data']['expDate'],"color"=>"#173177"),
                    "remark"=>array("value"=>$param['data']['remark']."\n\n".$mobaninfo['remark'],"color"=>"#173177"),
                );
                break;



            /*
            商品详情通知
            gioFqFTIExhZ0lcm1Yr1etxIFNj1i6qWBkeA0507PBE

            {{first.DATA}}
            店铺名称：{{keyword1.DATA}}
            商品名称：{{keyword2.DATA}}
            商品价格：{{keyword3.DATA}}
            {{remark.DATA}}
            */
            case 'goods_info':
                $wx_data = array(
                    "first"=>array("value"=>$param['data']['first'],"color"=>"#173177"),
                    "keyword1"=>array("value"=>$param['data']['keyword1'],"color"=>"#173177"),
                    "keyword2"=>array("value"=>$param['data']['keyword2'],"color"=>"#173177"),
                    "keyword3"=>array("value"=>$param['data']['keyword3'],"color"=>"#173177"),
                    "remark"=>array("value"=>$param['data']['remark']."\n\n".$mobaninfo['remark'],"color"=>"#173177"),
                );
                break;




            /*
            提现审核结果通知
            NxbJjJXPw59Hra7CxY96NvMuuGSxo6oJQh4M6weXd5g

            {{first.DATA}}
            提现金额：{{keyword1.DATA}}
            提现方式：{{keyword2.DATA}}
            申请时间：{{keyword3.DATA}}
            审核结果：{{keyword4.DATA}}
            审核时间：{{keyword5.DATA}}
            {{remark.DATA}}
            */
            case 'tixian_result':
                $wx_data = array(
                    "first"=>array("value"=>$param['data']['first'],"color"=>"#173177"),
                    "keyword1"=>array("value"=>$param['data']['keyword1'],"color"=>"#173177"),
                    "keyword2"=>array("value"=>$param['data']['keyword2'],"color"=>"#173177"),
                    "keyword3"=>array("value"=>$param['data']['keyword3'],"color"=>"#173177"),
                    "keyword4"=>array("value"=>$param['data']['keyword4'],"color"=>"#173177"),
                    "keyword5"=>array("value"=>$param['data']['keyword5'],"color"=>"#173177"),
                    "remark"=>array("value"=>$param['data']['remark']."\n\n".$mobaninfo['remark'],"color"=>"#173177"),
                );
                break;



            /*
            提醒供应商发货通知
            OZ40pW6XK_OqBw3M-RiPmnwIiIePaH3Q9BIPMfENKZw

            {{first.DATA}}
            订单号：{{keyword1.DATA}}
            商品名称：{{keyword2.DATA}}
            订单金额：{{keyword3.DATA}}
            下单时间：{{keyword4.DATA}}
            {{remark.DATA}}
            */
            case 'fahuo_notice':
                $wx_data = array(
                    "first"=>array("value"=>$param['data']['first'],"color"=>"#173177"),
                    "keyword1"=>array("value"=>$param['data']['keyword1'],"color"=>"#173177"),
                    "keyword2"=>array("value"=>$param['data']['keyword2'],"color"=>"#173177"),
                    "keyword3"=>array("value"=>$param['data']['keyword3'],"color"=>"#173177"),
                    "keyword4"=>array("value"=>$param['data']['keyword4'],"color"=>"#173177"),
                    "remark"=>array("value"=>$param['data']['remark']."\n\n".$mobaninfo['remark'],"color"=>"#173177"),
                );
                break;


            /*
            售后申请通知
            QLVetp8oJSeQZWodC0loC3BKmckcRu5bPQtPsDB3tq8

            {{first.DATA}}
            售后类型：{{keyword1.DATA}}
            售后商品：{{keyword2.DATA}}
            订单编号：{{keyword3.DATA}}
            申请时间：{{keyword4.DATA}}
            {{remark.DATA}}
            */
            case 'shouhou_notice':
                $wx_data = array(
                    "first"=>array("value"=>$param['data']['first'],"color"=>"#173177"),
                    "keyword1"=>array("value"=>$param['data']['keyword1'],"color"=>"#173177"),
                    "keyword2"=>array("value"=>$param['data']['keyword2'],"color"=>"#173177"),
                    "keyword3"=>array("value"=>$param['data']['keyword3'],"color"=>"#173177"),
                    "keyword4"=>array("value"=>$param['data']['keyword4'],"color"=>"#173177"),
                    "remark"=>array("value"=>$param['data']['remark']."\n\n".$mobaninfo['remark'],"color"=>"#173177"),
                );
                break;






        }



        $this->wxsdk->sendTemplateMessage($openid,$wx_data,$template_id,$url);
    }



    
    /**
     * 
     *获取模板广告信息
     */

    private function getMobanInfo($id = null){
        if($id){
            $url = "http://www.96567.com/wm/index.php?m=getMobanInfo&p=action&c=getOneMobanInfo&id=".$id;
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $tmpInfo = curl_exec($ch);
            if(curl_errno($ch)){ 
                return 'Errno'.curl_error($ch);      
            }  
            curl_close($ch);
            return $tmpInfo;
        }else{
            return;
        }
    }



    //获取剩余时间
    public function gettime($time_s,$time_n){
        $strtime = '';
        $time = $time_n-$time_s;
        if($time >= 86400){
            $strtime .= intval($time/86400).'天';
            $time = $time % 86400;
        }
        if($time >= 3600){
            $strtime .= intval($time/3600).'小时';
            $time = $time % 3600;
        }else{
            $strtime .= '';
        }
        if($time >= 60){
            $strtime .= intval($time/60).'分';
            $time = $time % 60;
        }else{
            $strtime .= '';
        }
        return $strtime;
    }





}

?>
