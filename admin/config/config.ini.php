<?php
defined('InShopNC') or exit('Access Invalid!');

$config['sys_log'] 			= true;

/*拍品分类*/
$config['lepai_class']['1'] = '邮币卡';
$config['lepai_class']['2'] = '贵金属';
$config['lepai_class']['3'] = '书法字画';
$config['lepai_class']['4'] = '玉器珠宝';
$config['lepai_class']['5'] = '瓷器紫砂';
$config['lepai_class']['6'] = '红木文玩杂项';

/*拍品状态*/
$config['lepai_type']['1'] = '未送拍';
$config['lepai_type']['2'] = '已送拍,审核中';
$config['lepai_type']['3'] = '送拍审核未通过';
$config['lepai_type']['4'] = '送拍审核已通过';
$config['lepai_type']['5'] = '正在预展';
$config['lepai_type']['6'] = '正在拍卖';
$config['lepai_type']['7'] = '竞拍成功';
$config['lepai_type']['8'] = '流拍';

/*书画职称*/
$config['lepai_zhi']['1'] = '中国书协主席团';
$config['lepai_zhi']['2'] = '中国美协主席团';
$config['lepai_zhi']['3'] = '中国书协理事';
$config['lepai_zhi']['4'] = '中国美协理事';
$config['lepai_zhi']['5'] = '中国书协会员';
$config['lepai_zhi']['6'] = '中国美协会员';
$config['lepai_zhi']['7'] = '省级书协主席团';
$config['lepai_zhi']['8'] = '国家画院';
$config['lepai_zhi']['9'] = '八大美院';
$config['lepai_zhi']['10'] = '民间大家';
$config['lepai_zhi']['11'] = '其它';

/*玉器材质*/
$config['lepai_caizhi']['1'] = '黄金';
$config['lepai_caizhi']['2'] = '水晶';
$config['lepai_caizhi']['3'] = '碧玺';
$config['lepai_caizhi']['4'] = '琉璃';
$config['lepai_caizhi']['5'] = '玛瑙';

/*容量*/
$config['lepai_rongliang']['1'] = '200cc以内';
$config['lepai_rongliang']['2'] = '201cc - 300cc';
$config['lepai_rongliang']['3'] = '301cc - 400cc';
$config['lepai_rongliang']['4'] = '401cc - 500cc';
$config['lepai_rongliang']['5'] = '500cc以上';



/*产品对应审核状态*/
$config['lepai_goodstype']['1'] = '已送拍,审核中';
$config['lepai_goodstype']['2'] = '送拍审核未通过';
$config['lepai_goodstype']['3'] = '送拍审核已通过';
$config['lepai_goodstype']['4'] = '正在预展';
$config['lepai_goodstype']['5'] = '正在拍卖';
$config['lepai_goodstype']['6'] = '竞拍成功';
$config['lepai_goodstype']['7'] = '流拍';


/*专题对应审核状态*/
$config['lepai_themetype']['1'] = '未提审';
$config['lepai_themetype']['2'] = '审核中';
$config['lepai_themetype']['3'] = '已通过';
$config['lepai_themetype']['4'] = '审核未通';
$config['lepai_themetype']['5'] = '正在预展';
$config['lepai_themetype']['6'] = '正在拍卖';
$config['lepai_themetype']['7'] = '已结束';


/*订单对应搜索状态*/
$config['lepai_order_type']['1'] = '等待发货';
$config['lepai_order_type']['2'] = '已发货';
$config['lepai_order_type']['3'] = '已完成';
$config['lepai_order_type']['4'] = '已退货';
$config['lepai_order_type']['5'] = '已取消';
$config['lepai_order_type']['6'] = '未付款';
$config['lepai_order_type']['7'] = '已付款';

return $config;
