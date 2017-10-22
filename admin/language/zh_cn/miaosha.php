<?php
defined('InShopNC') or exit('Access Invalid!');
/**
 * 秒杀状态 
 */
$lang['miaosha_state_name'] = '审核状态';
$lang['miaosha_state_succ'] = '审核通过';
$lang['miaosha_state_false'] = '拒绝';
$lang['miaosha_state_all'] = '全部秒杀';
$lang['miaosha_state_verify'] = '未审核';
$lang['miaosha_state_cancel'] = '已取消';
$lang['miaosha_state_progress'] = '已通过';
$lang['miaosha_state_fail'] = '审核失败';
$lang['miaosha_state_close'] = '已结束';
$lang['miaosha_state_close1'] = '关闭此秒杀';

/**
 * index
 */
$lang['miaosha_index_manage']		= '秒杀管理';
$lang['miaosha_verify']    		= '待审核';
$lang['miaosha_cancel']    		= '已取消';
$lang['miaosha_progress']  		= '已审核';
$lang['miaosha_close']     		= '已结束';
$lang['miaosha_back']     		= '返回列表';

$lang['miaosha_recommend_goods']	= '推荐商品';
$lang['miaosha_template_list']		= '秒杀活动';
$lang['miaosha_template_add']		= '添加活动';
$lang['miaosha_template_name']		= '活动名称';
$lang['miaosha_class_list']		= '秒杀分类';
$lang['miaosha_class_add']		    = '添加分类';
$lang['miaosha_hodong_add']		    = '添加活动';
$lang['miaosha_class_edit']	    = '编辑分类';
$lang['miaosha_class_name']	    = '分类名称';
$lang['miaosha_start_time']	    = '开始时间';
$lang['miaosha_end_time']	    = '结束时间';
$lang['miaosha_parent_class']	    = '父级分类';
$lang['miaosha_root_class']	    = '一级分类';
$lang['miaosha_area_list'] 		= '秒杀地区';
$lang['miaosha_area_add']		    = '添加地区';
$lang['miaosha_area_edit'] 	    = '编辑地区';
$lang['miaosha_area_name'] 	    = '地区名称';
$lang['miaosha_parent_area']	    = '父级地区';
$lang['miaosha_root_area'] 	    = '一级地区';
$lang['miaosha_price_list']		= '秒杀价格区间';
$lang['miaosha_price_add']		    = '添加价格区间';
$lang['miaosha_price_edit']	    = '编辑价格区间';
$lang['miaosha_price_name']	    = '价格区间名称';
$lang['miaosha_price_range_start']	    = '价格区间上限';
$lang['miaosha_price_range_end']	    = '价格区间下限';
$lang['miaosha_detail'] = '秒杀信息详情';
$lang['range_name']	    = '价格区间名称';
$lang['range_start']	    = '价格区间下限';
$lang['range_end']	    = '价格区间上限';
$lang['miaosha_index_name']		= '秒杀名称';
$lang['miaosha_index_goods_name']	= '商品名称';
$lang['miaosha_index_store_name']	= '店铺名称';
$lang['start_time']             	= '开始时间';
$lang['end_time']               	= '结束时间';
$lang['join_end_time']             	= '报名截止时间';
$lang['miaosha_index_start_time']	= '开始时间';
$lang['miaosha_index_end_time']	= '结束时间';
$lang['day']						= '日';
$lang['hour']						= '时';
$lang['miaosha_index_state']		= '秒杀状态';
$lang['miaosha_index_pub_state']	= '发布状态';
$lang['miaosha_index_click']		= '浏览数';
$lang['miaosha_index_long_group']	= '长期活动';
$lang['miaosha_index_un_pub']		= '未发布';
$lang['miaosha_index_canceled']	= '已取消';
$lang['miaosha_index_going']		= '进行中';
$lang['miaosha_index_finished']	= '已完成';
$lang['miaosha_index_ended']		= '已结束';
$lang['miaosha_index_published']	= '已发布';
$lang['group_template'] = '秒杀活动';
$lang['group_name'] = '秒杀名称';
$lang['store_name'] = '店铺名称';
$lang['goods_name'] = '商品名称';
$lang['group_help'] = '秒杀说明';
$lang['start_time'] = '开始时间';
$lang['end_time'] = '结束时间';
$lang['goods_price'] = '商品原价';
$lang['store_price'] = '商城价';
$lang['miaosha_price'] = '秒杀价格';
$lang['limit_type'] = '限制类型';
$lang['virtual_quantity'] = '虚拟数量';
$lang['min_quantity'] = '成抢数量';
$lang['sale_quantity'] = '每人限购';
$lang['max_quantity'] = '秒杀数量';
$lang['max_num'] = '商品总数';
$lang['group_intro'] = '本抢介绍';
$lang['group_pic'] = '秒杀图片';
$lang['buyer_count'] = '已购买人数';
$lang['def_quantity'] = '已购商品数量';
$lang['base_info'] = '基本信息';
$lang['text_no_limit'] = '请选择...';
$lang['max_quantity_explain'] = '要参加秒杀的商品可购买数量，当秒杀人数达到此人数商品秒杀结束，不限数量请填 "0"';

/**
 * 页面说明
 **/
$lang['miaosha_start_time_tip']	    = '秒杀活动开始时间，整点';
$lang['miaosha_end_time_tip']	    = '秒杀活动结束时间，整点';
$lang['miaosha_template_help1'] = '点击活动的管理按钮查看活动详细信息，对秒杀申请进行审批管理';
$lang['miaosha_template_help2'] = '未开始的活动可以直接删除，删除后该活动下的所有秒杀信息将被同时删除';
$lang['miaosha_template_help3'] = '活动开始后可以点击关闭按钮手动关闭该活动';
$lang['miaosha_template_help4'] = '推荐秒杀商品到首页，请到秒杀活动管理页面点亮推荐列下的对勾';
$lang['miaosha_template_add_help1'] = '活动时间不能重叠，新活动的开始时间必须大于已有活动的结束时间';
$lang['miaosha_template_add_help2'] = '报名截止时间必须小于活动开始时间';
$lang['miaosha_start_time_explain'] = '秒杀活动开始时间不能早于';
$lang['miaosha_class_help1'] = '秒杀分类后台为2级分类，前台默认显示1级，如需扩展需要二次开发';
$lang['miaosha_area_help1'] = '秒杀地区后台为3级分类，前台默认显示1级，如需扩展需要二次开发';
$lang['miaosha_price_range_help1'] = '前台秒杀按价格筛选的区间，各个区间段的金额不要发生重叠';
$lang['miaosha_index_help1']		= "点击导航菜单中的'返回列表'链接返回活动列表页";
$lang['miaosha_index_help2']		= '秒杀信息审核后才会出现在前台页面';
$lang['miaosha_fail_errormsg']		= '秒杀商品不存在';
$lang['class_fail_errormsg']		= '秒杀活动分类不存在';
$lang['miaosha_parent_class_add_tip'] = '请选择父级分类，默认为一级分类';
$lang['miaosha_parent_area_add_tip'] = '请选择父级地区，默认为一级地区';
$lang['sort_tip'] = '排序数值从0到255，数字0优先级最高';
$lang['addhuodong_sort_tip'] = '数字0优先级最高，排序以开始时间为主，排序值为辅';
$lang['price_range_tip'] = "区间名称应该明确，比如'1000元以下'和'2000元-3000元'";
$lang['price_range_price_tip'] = '价格必须为正整数';
$lang['maxhour_error'] = '结束时间小时必须大于开始时间小时';

$lang['miaosha_recommend_help1'] = '此页面显示的是已经通过审核的正在秒杀中的商品，只能进行推荐操作';

$lang['state_text_notstarted'] = '未开始';
$lang['state_text_in_progress'] = '进行中';
$lang['state_text_closed'] = '已关闭';
$lang['miaosha_goods'] = '秒杀商品';
$lang['miaosha_class'] = '秒杀分类';
/**
 * 秒杀删除
 */
$lang['miaosha_del_choose']		= '请选择要删除的内容';
$lang['miaosha_del_succ']			= '删除成功';
$lang['miaosha_del_fail']			= '删除失败';
/**
 * 秒杀推荐
 */
$lang['miaosha_recommend_choose']	= '请选择要推荐的内容';
$lang['miaosha_recommend_succ']	= '推荐成功';
$lang['miaosha_recommend_fail']	= '推荐失败';


/**
 * 提示信息
 */
$lang['class_name_error'] = '分类名称不能为空';
$lang['sort_error'] = '排序必须是数字';
$lang['area_name_error'] = '地区名称不能为空';
$lang['verify_success'] = '审核通过';
$lang['verify_fail'] = '审核失败';
$lang['ensure_verify_success'] = '确认审核通过该秒杀活动?';
$lang['ensure_verify_fail'] = '确认审核失败该秒杀活动?';
$lang['op_close'] = '结束';
$lang['ensure_close'] = '确认结束该秒杀活动?';
$lang['template_name_error'] = '活动名称不能为空';
$lang['start_time_error'] = '开始时间不能为空';
$lang['end_time_error'] = '结束时间不能为空，且必须大于开始时间';
$lang['join_end_time_error'] = '报名截止时间不能为空';
$lang['range_name_error'] = '价格区间名称不能为空';
$lang['range_start_error'] = '价格区间上限不能为空且必须位数字';
$lang['range_end_error'] = '价格区间下限不能为空且必须位数字';
$lang['start_time_overlap'] = '秒杀活动时间有重叠请您重新选择秒杀开始时间';
/**
 * 提示信息
 */

$lang['admin_miaosha_unavailable'] = '秒杀功能尚未开启，是否自动开启';
$lang['miaosha_template_add_success'] = '秒杀活动添加成功';
$lang['miaosha_template_add_fail'] = '秒杀活动添加失败';
$lang['miaosha_tempalte_drop_success'] = '秒杀活动删除成功';
$lang['miaosha_template_drop_fail'] = '秒杀活动删除失败';
$lang['miaosha_tempalte_close_success'] = '秒杀活动关闭成功';
$lang['miaosha_template_close_fail'] = '秒杀活动关闭失败';
$lang['miaosha_verify_success'] = '秒杀审核操作成功';
$lang['miaosha_verify_fail'] = '秒杀审核操作失败';
$lang['miaosha_close_success'] = '秒杀结束成功';
$lang['miaosha_close_fail'] = '秒杀结束失败';
$lang['miaosha_class_add_success'] = '秒杀分类添加成功';
$lang['miaosha_class_add_fail'] = '秒杀分类添加失败';
$lang['miaosha_class_edit_success'] = '秒杀分类编辑成功';
$lang['miaosha_class_edit_fail'] = '秒杀分类编辑失败';
$lang['miaosha_class_drop_success'] = '秒杀分类删除成功';
$lang['miaosha_class_drop_fail'] = '秒杀分类删除失败';
$lang['miaosha_area_add_success'] = '秒杀地区添加成功';
$lang['miaosha_area_add_fail'] = '秒杀地区添加失败';
$lang['miaosha_area_edit_success'] = '秒杀地区编辑成功';
$lang['miaosha_area_edit_fail'] = '秒杀地区编辑失败';
$lang['miaosha_area_drop_success'] = '秒杀地区删除成功';
$lang['miaosha_area_drop_fail'] = '秒杀地区删除失败';
$lang['miaosha_price_range_add_success'] = '秒杀价格区间添加成功';
$lang['miaosha_price_range_add_fail'] = '秒杀价格区间添加失败';
$lang['miaosha_price_range_edit_success'] = '秒杀价格区间编辑成功';
$lang['miaosha_price_range_edit_fail'] = '秒杀价格区间编辑失败';
$lang['miaosha_price_range_drop_success'] = '秒杀价格区间删除成功';
$lang['miaosha_price_range_drop_fail'] = '秒杀价格区间删除失败';

$lang['miaosha_close_confirm'] = '确认关闭秒杀活动？关闭后无法再次开启。';

/**
 * 秒杀状态
 */
$lang['miaosha_state_all'] = '全部秒杀';
$lang['miaosha_state_verify'] = '未审核';
$lang['miaosha_state_cancel'] = '已取消';
$lang['miaosha_state_progress'] = '已通过';
$lang['miaosha_state_fail'] = '审核失败';
$lang['miaosha_state_close'] = '已结束';

/**
 * 秒杀字段
 **/
$lang['group_template'] = '秒杀活动';
$lang['group_template_tip'] = '选择要参加的秒杀活动及时间段';
$lang['miaosha_name'] = '秒杀名称';
$lang['miaosha_name_tip'] = '秒杀标题名称长度最多可输入30个字符';
$lang['group_goods_sel'] = '选择商品';
$lang['group_help'] = '秒杀说明';
$lang['start_time'] = '开始时间';
$lang['end_time'] = '结束时间';
$lang['goods_price'] = '商品原价';
$lang['goods_storage'] = '商品库存数';
$lang['store_price'] = '商城价';
$lang['miaosha_price'] = '秒杀价格';
$lang['miaosha_price_tip'] = '秒杀价格为该商品参加活动时的促销价格<br/>必须是0.01~1000000之间的数字(单位：元)<br/>秒杀价格应包含邮费，秒杀商品系统默认不收取邮费';
$lang['limit_type'] = '限制类型';
$lang['max_quantity'] = '秒杀数量';
$lang['min_quantity'] = '成抢数量';
$lang['sale_quantity'] = '每人限购';
$lang['max_num'] = '商品总数';
$lang['group_intro'] = '本抢介绍';
$lang['group_pic'] = '秒杀图片';
$lang['group_edit'] = '编辑内容';

$lang['miaosha_class'] = '秒杀类别';
$lang['miaosha_class_tip'] = '请选择秒杀商品的所属类别';
$lang['miaosha_area'] = '所属区域';
$lang['miaosha_goods'] = '秒杀商品';
$lang['miaosha_goods_explain'] = '点击上方输入框从已发布商品中选择要参加秒杀的商品';
$lang['min_quantity_explain'] = '秒杀成功的最低数值，默认为 "1"';
$lang['max_quantity_explain'] = '要参加秒杀的商品可购买数量，当秒杀人数达到此人数商品秒杀结束，不限数量请填 "0"';
$lang['sale_quantity_explain'] = '每个买家ID可秒杀的最大数量，不限数量请填 "0"';
$lang['max_num_explain'] = '秒杀商品总数应等于或小于该商品库存数量<br/>请提前确认要参与活动的商品库存数量足够充足';
$lang['group_pic_explain'] = '用于秒杀活动页面的图片,请使用宽度440像素、高度293像素、大小1M内的图片，<br/>支持jpg、jpeg、gif、png格式上传。';
$lang['group_pic_explain2'] = '用于秒杀页侧边推荐位，首页推荐位的图片,请使用宽度210像素、高度180像素、大小1M内的图片，<br/>支持jpg、jpeg、gif、png格式上传。';
$lang['miaosha_message_not_start'] = '秒杀活动尚未开始';
$lang['miaosha_message_close'] = '秒杀活动已经结束';
$lang['miaosha_message_start'] = '数量有限请您尽快下单';
$lang['miaosha_message_success'] = '秒杀成功可继续购买';

/**
 * 错误提示
 **/
$lang['miaosha_unavailable'] = '秒杀功能没有开启';
$lang['no_miaosha_template_in_progress'] = '没有正在进行中的秒杀活动';
$lang['no_miaosha_info'] = '没有秒杀信息';
$lang['no_miaosha_template_soon'] = '没有即将开始的秒杀活动';
$lang['no_miaosha_template_history'] = '没有历史秒杀活动';
$lang['no_miaosha'] = '当前没有秒杀信息';
$lang['param_error'] = '参数错误';
$lang['group_name_error'] = '秒杀名称不能为空';
$lang['group_goods_error'] = '请选择秒杀商品';
$lang['group_help_error'] = '秒杀说明不能为空';
$lang['start_time_error'] = '开始时间不能为空';
$lang['end_time_error'] = '结束时间不能为空';
$lang['miaosha_price_error'] = '请输入正确的秒杀价格';
$lang['group_pic_error'] = '秒杀图片不能为空，且必须为jpg/gif/png格式';
$lang['min_quantity_error'] = '成抢数量不能为空，且必须为大于0的整数';
$lang['max_quantity_error'] = '秒杀数量不能为空，且必须为整数';
$lang['sale_quantity_error'] = '限购数量不能为空，其必须为整数';
$lang['max_num_error'] = '商品总数不能为空，且必须小于当前库存';
$lang['miaosha_none'] = '平台当前没有进行中的秒杀活动';
$lang['group_goods_is_exist'] = '该商品已经在本期秒杀活动中，请选择其它商品';
$lang['goods_info'] = '商品信息';
$lang['buyer_list'] = '购买记录';
$lang['store_info'] = '店铺信息';
$lang['miaosha_not_state'] = '秒杀活动尚未开始';
$lang['miaosha_closed'] = '秒杀活动已经结束';
$lang['goods_not_enough'] = '商品库存不足';
$lang['miaosha_not_enough'] = '秒杀余额不足';
$lang['miaosha_sale_quantity'] = '您最多只能购买';
$lang['can_not_buy'] = '您不能购买自己发布的商品';

$lang['miaosha_add_success'] = '秒杀活动发布成功请等待审核';
$lang['miaosha_add_fail'] = '秒杀活动发布失败';
$lang['miaosha_edit_success'] = '秒杀活动编辑成功';
$lang['miaosha_edit_fail'] = '秒杀活动编辑失败';
$lang['miaosha_quota_add_success'] = '秒杀活动套餐购买成功';

/**
 * 文字
 **/
$lang['miaosha_title'] = '商品秒杀';
$lang['miaosha_soon'] = '即将开始';
$lang['miaosha_history'] = '往期秒杀';
$lang['text_year'] = '年';
$lang['text_month'] = '月';
$lang['text_day'] = '日';
$lang['text_tian'] = '天';
$lang['text_hour'] = '小时';
$lang['text_minute'] = '分';
$lang['text_second'] = '秒';
$lang['text_to'] = '至';
$lang['text_di'] = '第';
$lang['text_qi'] = '期';
$lang['text_miaosha'] = '商城秒杀';
$lang['text_miaosha_list'] = '秒杀列表';
$lang['text_miaosha_detail'] = '秒杀详情';
$lang['text_goods_price'] = '原价';
$lang['text_zhe'] = '折';
$lang['text_discount'] = '折扣';
$lang['text_save'] = '节省';
$lang['miaosha_buy'] = '我要抢';
$lang['miaosha_close'] = '已结束';
$lang['text_end_time'] = '距离本期结束';
$lang['text_start_time'] = '距离本期开始';
$lang['text_no_limit'] = '不限';
$lang['text_class'] = '分类';
$lang['text_price'] = '价格';
$lang['text_unit_price'] = '单价';
$lang['text_default'] = '默认';
$lang['text_sale'] = '销量';
$lang['text_rebate'] = '折扣';
$lang['text_order'] = '排序';
$lang['text_country'] = '全国';
$lang['text_people'] = '人';
$lang['text_buy'] = '已购买';
$lang['text_jiangyu'] = '将于';
$lang['text_start'] = '准时开抢';
$lang['see_store'] = '逛逛店铺';
$lang['see_goods'] = '查看商品';
$lang['to_see'] = '去看看';
$lang['history_hot'] = '往期热销排行';
$lang['current_hot'] = '本期热门秒杀';
$lang['text_buyer'] = '买家';
$lang['text_buy_count'] = '购买数量';
$lang['text_buy_now'] = '立即购买';
$lang['text_buy_time'] = '下单时间';
$lang['text_piece'] = '件';
$lang['text_goods_buy'] = '本商品已被秒杀';
$lang['text_goods_store'] = '商品所在店铺';
$lang['text_goods_commend'] = '店铺推荐商品';
$lang['text_read_agree1'] = '我已阅读';
$lang['text_read_agree2'] = '并同意';
$lang['text_agreement'] = '秒杀服务协议';
$lang['agree_must'] = '您必须同意本协议';
$lang['store_goods_album_insert_users_photo'] = '插入相册图片';
$lang['text_remain'] = '剩余';

/**
 * index
 */
$lang['miaosha_index_no_right']			= '您的店铺等级没有此权限';
$lang['miaosha_index_in_audit']			= '您的店铺等级正在审核中';
$lang['miaosha_index_add_success']			= '添加秒杀活动成功';
$lang['miaosha_index_add_fail']			= '添加秒杀活动失败';
$lang['miaosha_index_not_exists']			= '未找到秒杀活动';
$lang['miaosha_index_modify_success']		= '修改秒杀活动成功';
$lang['miaosha_index_modify_fail']			= '修改秒杀活动失败';
$lang['miaosha_index_default_spec']		= '默认规格';
$lang['miaosha_index_all_group']			= '全部秒杀';
$lang['miaosha_index_unpublish']			= '未发布';
$lang['miaosha_index_canceled']			= '已取消';
$lang['miaosha_index_going']				= '进行中';
$lang['miaosha_index_finished']			= '已完成';
$lang['miaosha_index_ended']				= '已结束';
$lang['miaosha_index_num']					= '(人数)';
$lang['miaosha_index_amount']				= '(数量)';
$lang['miaosha_index_desc']				= '说明';
$lang['miaosha_index_order_num']			= '订购数';
$lang['miaosha_index_input_name']			= '请填写秒杀名称';
$lang['miaosha_index_desc']				= '秒杀说明';
$lang['miaosha_index_end_time']			= '结束时间';
$lang['miaosha_index_search_first']		= '请先搜索秒杀商品';
$lang['miaosha_index_input_right_num']		= '请正确填写成抢人数';
$lang['miaosha_index_input_right_amount']	= '请正确填写成抢件数';
$lang['miaosha_index_def_quantity_error']  = '请正确填写已订购数';
$lang['miaosha_index_goods_sum_null']		= '商品总数不能为空';
$lang['miaosha_index_goods_sum_one']		= '商品总数不能小于1';
$lang['miaosha_index_input_right_price']	= '请正确填写秒杀价格';
$lang['miaosha_index_max_per_user_error']  = '请正确填写每人限购数量';
$lang['miaosha_index_input_price']			= '请填写秒杀价格';
$lang['miaosha_index_base_info']			= '秒杀基本信息';
$lang['miaosha_index_activity_name']		= '活动名称';
$lang['miaosha_index_publish_now']			= '立即发布';
$lang['miaosha_index_yes']					= '是';
$lang['miaosha_index_no']					= '否';
$lang['miaosha_index_publish_tip']			= '如果“立即发布”，除“秒杀说明”外的信息将不能再被更改';
$lang['miaosha_index_start_time']			= '开始时间';
$lang['miaosha_index_end_time']			= '结束时间';
$lang['miaosha_index_goods_info']			= '秒杀商品信息';
$lang['miaosha_index_choose_goods']		= '选择商品';
$lang['miaosha_index_order_num_now']		= '已订购数';
$lang['miaosha_index_order_num_published']	= '发布后显示的已订购数';
$lang['miaosha_index_condition']			= '限制条件';
$lang['miaosha_index_by_num']				= '以购买成功人数成抢';
$lang['miaosha_index_by_amount']			= '以产品购买数量成抢';
$lang['miaosha_index_group_num']			= '成抢人数';
$lang['miaosha_index_group_espect_num']	= '能完成秒杀的期望订购人数';
$lang['miaosha_index_group_amount']		= '成抢件数';
$lang['miaosha_index_group_espect_amount']	= '能完成秒杀的期望订购件数';
$lang['miaosha_index_amount_limit']		= '每人限购';
$lang['miaosha_index_amount_limit_tip']	= '每个参抢者最多能订购的件数，0为不限制';
$lang['miaosha_index_goods_sum']			= '商品总数';
$lang['miaosha_index_amount_max_limit']	= '所有参抢者最多能订购的数量，默认为商品库存数';
$lang['miaosha_index_intro']				= '本抢介绍';
$lang['miaosha_index_spec_price']			= '规格价格';
$lang['miaosha_index_spec']				= '规格';
$lang['miaosha_index_stock']				= '库存';
$lang['miaosha_index_store_price']			= '店铺价格';
$lang['miaosha_index_group_price']			= '秒杀价';
$lang['miaosha_index_search']				= '查询';
$lang['miaosha_index_submit']				= '提交';
$lang['miaosha_index_new_group']			= '新增秒杀';
$lang['miaosha_index_activity_state']		= '活动状态';
$lang['miaosha_index_start_time']			= '起始时间';
$lang['miaosha_index_group_num']			= '已秒杀';
$lang['miaosha_index_to']					= '至';
$lang['miaosha_index_year']				= '年';
$lang['miaosha_index_month']				= '月';
$lang['miaosha_index_day']					= '日';
$lang['miaosha_index_publish_tip']			= '发布后除修改说明外不能再被编辑，您确定要发布吗';
$lang['miaosha_index_publish']				= '发布';
$lang['miaosha_index_del_tip']				= '若该秒杀已完成，则删除该秒杀将导致未下单的用户无法下单，您确定要这么做吗';
$lang['miaosha_index_order']				= '订单';
$lang['miaosha_index_order_state']			= '订购情况';
$lang['miaosha_index_finish_tip']			= '该操作将要把秒杀设置为成功状态，您确定要结束预定吗';
$lang['miaosha_index_finish']				= '完成';
$lang['miaosha_index_end']				    = '结束预定';
$lang['miaosha_index_no_record']			= '没有找到符合条件的商品';
$lang['miaosha_index_loading_list']		= '正在加载商品列表';
$lang['miaosha_index_no_goods']			= '没有找到相关商品';
$lang['miaosha_index_choose_goods']		= '选择商品';
$lang['miaosha_index_goods_name']			= '商品名称';
$lang['miaosha_index_store_class']			= '本店分类';
$lang['miaosha_index_please_choose']		= '全部分类';
$lang['miaosha_index_search_back']			= '请先从上面搜索';
$lang['miaosha_index_publish_success']		= '发布成功';
$lang['miaosha_index_change_to_finish']		= '已更改状态为完成';
$lang['miaosha_index_group_canceled']			= '秒杀商品已取消';
$lang['miaosha_index_modify_intro_success']	= '修改商品说明成功';
$lang['miaosha_index_modify_order_num_sucess']	= '修改商品订购数成功';
$lang['miaosha_index_cancel_reason']			= '取消原因';
$lang['miaosha_index_username']				= '用户名';
$lang['miaosha_index_linkman']					= '联系人';
$lang['miaosha_index_phone']					= '联系电话';
$lang['miaosha_index_jian']					= '件';
$lang['miaosha_index_no_record_now']			= '暂无订购记录';
$lang['miaosha_index_del_success']		= '删除秒杀活动成功';
$lang['miaosha_index_del_fail']		= '删除秒杀活动失败';
$lang['miaosha_index_datefail']		= '日期不能小于当日，\n默认秒杀时间为7天！';
$lang['miaosha_index_startdatefail']		= '秒杀开始时间不早于当日，\n默认秒杀开始时间为当日！';