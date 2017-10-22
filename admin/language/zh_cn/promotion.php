<?php
defined('InShopNC') or exit('Access Invalid!');
/**
 * 公用
 */
$lang['promotion_openstate']		= '展示位置';
$lang['promotion_cate_name']		= '所属分类';
$lang['promotion_openstate_open']		= '顶部';
$lang['promotion_openstate_close']		= '底部';
/**
 * 活动列表
 */
$lang['promotion_weizhi']		= '显示位置';
$lang['promotion_index']				= '促销信息';
$lang['promotion_index_content']		= '活动内容';
$lang['promotion_index_manage']		= '促销信息管理';
$lang['promotion_index_title']		= '促销信息标题';
$lang['promotion_index_type']		= '活动类型';
$lang['promotion_index_banner']		= '横幅图片';
$lang['promotion_index_style']		= '使用样式';
$lang['promotion_index_start']		= '开始时间';
$lang['promotion_index_end']			= '结束时间';
$lang['promotion_index_goods']		= '商品';
$lang['promotion_index_group']		= '抢购';
$lang['promotion_index_default']		= '默认风格';
$lang['promotion_index_long_time']	= '长期活动';
$lang['promotion_index_deal_apply']	= '处理申请';
$lang['promotion_index_help1']		= '当平台发起活动时，店铺可申请参与活动';
$lang['promotion_index_help2']		= '在“页面导航”模块处可选择添加活动导航';
$lang['promotion_index_help3']		= '只有关闭或者过期的活动才能删除';
$lang['promotion_index_help4']		= '活动列表排序越小越靠前显示';
$lang['promotion_index_periodofvalidity']= '有效期';
/**
 * 添加活动
 */
$lang['promotion_category']	= '绑定分类';
$lang['promotion_index_goods']	= '促销商品';
$lang['promotion_select_goods_null']	= '请选择商品分类信息';
$lang['promotion_new_title_null']	= '请填写促销商品';
$lang['promotion_goods_id_null']	= '促销商品ID不能为空';
$lang['promotion_new_style_null']	= '必须选择页面风格';
$lang['promotion_new_type_null']		= '必须选择活动类别';
$lang['promotion_new_sort_tip']		= '排序必须是数字，范围0~255';
$lang['promotion_new_end_date_too_early']	= '截止时间必须晚于开始时间';
$lang['promotion_new_title_tip']		= '请为您的活动填写一个简明扼要的主题';
$lang['promotion_new_type_tip']		= '请为您的活动选择一个类别';
$lang['promotion_new_start_tip']		= '留空默认为活动立即开始';
$lang['promotion_new_end_tip']		= '留空默认为活动永久进行';
$lang['promotion_new_banner_tip']	= '支持jpg、jpeg、gif、png格式';
$lang['promotion_new_style']			= '页面风格';
$lang['promotion_new_style_tip']		= '请选择该活动所在页面的风格样式';
$lang['promotion_new_desc']			= '活动说明';
$lang['promotion_new_sort_tip1']		= '数字范围为0~255，数字越小越靠前';
$lang['promotion_new_sort_null']		= '排序不能为空';
$lang['promotion_new_sort_minerror']	= '数字范围为0~255';
$lang['promotion_new_sort_maxerror']	= '数字范围为0~255';
$lang['promotion_new_sort_error']	= '排序为0~255的数字';
$lang['promotion_new_banner_null']   = '横幅图片不能为空';
$lang['promotion_new_ing_wrong']     = '图片限于png,gif,jpeg,jpg格式';
$lang['promotion_new_startdate_null']   = '开始时间不能为空';
$lang['promotion_new_enddate_null']     = '结束时间不能为空';

/**
 * 删除活动
 */
$lang['promotion_del_choose_promotiony']	= '请选择促销信息';
/**
 * 活动内容
 */
$lang['promotion_detail_index_goods_name']	= '商品名称';
$lang['promotion_detail_index_store']		= '所属店铺';
$lang['promotion_detail_index_auditstate']	= '审核状态';
$lang['promotion_detail_index_to_audit']		= '待审核';
$lang['promotion_detail_index_passed']		= '已通过';
$lang['promotion_detail_index_unpassed']		= '已拒绝';
$lang['promotion_detail_index_apply_again']	= '再次申请';
$lang['promotion_detail_index_pass']			= '通过';
$lang['promotion_detail_index_refuse']		= '拒绝';
$lang['promotion_detail_index_pass_all']		= '您确定要通过已选信息吗?';
$lang['promotion_detail_index_refuse_all']	= '您确定要拒绝已选信息吗?';
$lang['promotion_detail_index_tip1']	= '申请商品在没有审核或者审核失败的时候可以删除';
$lang['promotion_detail_index_tip2']	= '本页申请商品的显示规则是未审核先显示，排序越小越靠前显示';
$lang['promotion_detail_index_tip3']	= '下架、违规下架商品或者所属店铺已经关闭的商品将不会在活动页面显示，请慎重审核';

/**
 * 活动内容删除
 */
$lang['promotion_detail_del_choose_detail']	= '请选择活动内容(比如商品或抢购等)';