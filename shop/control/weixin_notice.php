<?php
defined('InShopNC') or exit('Access Invalid!');
class weixin_noticeControl extends BaseHomeControl {
	public function __construct() {
		parent::__construct();
		//读取语言包

	}


    /*CRM订单发货通知*/

    public function crm_order_noticeOp(){
        $kuaidi_name = trim($_GET['sn_name']);
        $order_sn = intval(trim($_GET['order_sn']));
        $kuaidi_sn = trim($_GET['kuaidi_sn']);

        if(!empty($order_sn)){

            /* Add is name lt 2016-04-08 订单发货、微信消息*/

            $model_order= Model('order');

            $order_goods_info = $model_order->getOrderInfo(array('order_sn'=>$order_sn),array('order_goods'));

            $member_info = Model('member')->getMemberInfoByID($order_goods_info['buyer_id']);

            foreach ($order_goods_info['extend_order_goods'] as $k => $v) {

                $goods_name_list .= $v['goods_name']."\n";
            }

            $dataArr['first'] = $order_goods_info['buyer_name'].',您好！您有一笔订单已发货,'."{$kuaidi_name}:{$kuaidi_sn}".',请保持电话畅通静等快递小哥上门吧~';
            $dataArr['keyword1'] = $order_goods_info['order_sn'];
            $dataArr['keyword2'] = $order_goods_info['order_amount'];
            $dataArr['keyword3'] = $goods_name_list;
            $dataArr['remark'] = "\n".'如果您有任何疑问，可咨询在线客服或致电客户服热线400-81-96567，我们将竭诚为您服务。';

            $wx_param = array(
                 'func'=>'order_notice',
                 'template_id'=>'',
                 'openid'=>$member_info['openid'],
                  'url'=>'',
                 'data'=>$dataArr,          //dataArr为一维数组、详细字段如下：
            );

            QueueClient::push('sendWXTemplateMsg', $wx_param);

            /* End */

        }


    }















    public function testMobanOp(){


        $dataArr = array(
            'first' => 'ltauto120,您好，您有一笔新订单生成哦~',
            'keyword1' => '8000000005370201',
            'keyword2' => '892',
            'keyword3' => '澳门生肖马钞-羊钞十连号/n',
            // 'keyword4' => '审核通过',
            // 'keyword5' => '2016-04-08',
            'remark' => "\n".'如果您有任何疑问，可咨询在线客服或致电客户服热线400-81-96567，我们将竭诚为您服务'
        );


        $wx_param = array(
            'func'=>'order_notice',
            'template_id'=>'',
            'openid'=>'ocmCHjvOcGWeMkzeXPBIMWTDRNaY',
            'url'=>'',
            'data'=>$dataArr,
        );





        QueueClient::push('sendWXTemplateMsg', $wx_param);



    }

}