<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">


  <div class="fixed-bar">
    <div class="item-title">
      <h3>藏豆兑换礼品列表</h3>
        <ul class="tab-base">
            <?php   foreach($output['menu'] as $menu) {  if($menu['menu_type'] == 'text') { ?>
                <li><a href="JavaScript:void(0);" class="current"><span><?php echo $menu['menu_name'];?></span></a></li>
            <?php }  else { ?>
                <li><a href="<?php echo $menu['menu_url'];?>" ><span><?php echo $menu['menu_name'];?></span></a></li>
            <?php  } }  ?>
        </ul>
    </div>
  </div>
    <div class="fixed-empty"></div>
    <form  id="form1" method="get" name="formSearch" id="formSearch">
        <input type="hidden" name="act" value="push_user_tuijian">
        <input type="hidden" name="op" value="exchange">
        <table class="tb-type1 noborder search">
            <tbody>

            <tr>
                <td><input type="text" value="" name="search" id="search" class="txt" placeholder='商品名称'></td>
                
                <td ><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo $lang['nc_query'];?>"></a></td>
                <td class="w120">&nbsp;</td>
            </tr>
            </tbody>
        </table>
    </form>
    <div style="text-align:right;"><a class="btns" href="<?php echo urlAdmin('push_user_gift','tuijian_add')?>"><span>新增推荐</span></a></div>


    <table class="table tb-type2">
        <thead>
        <tr class="thead">
            <th class="align-left">商品名称</th>
            <th class="align-center">价格(元)</th>
            <th class="align-center">折后价</th>
			<th class="align-center">可售数量</th>
			<th class="align-center">每人可购买数量</th>
            <th class="align-center">已售</th>
            <th class="align-center">开始时间</th>
            <th class="align-center">结束时间</th>
           <!-- <th class="align-center">添加时间</th>-->
			<th class="align-center">是否推荐</th>
            <th class="align-center">操作</th>
        </tr>
        </thead>


        <tbody>
        <?php if (!empty($output['result_list']) && is_array($output['result_list'])) { ?>

            <?php foreach ($output['result_list'] as $k => $v) {?>
                <tr class="hover edit">
                    <td class="align-left"><a href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']))?>" target="_blank"><?php echo $v['goods_name'];?></a> </td>
                    <td class="align-center"><?php echo $v['goods_price'];?></td>
                    <td class="align-center"><?php echo $v['price'];?></td>
					<td class="align-center"><?php echo $v['number'];?></td>
					<td class="align-center"><?php echo $v['member_number'];?></td>
                    <td class="align-center"><?php echo $v['buy_quantity'];?></td>
                    <td class="align-center"><?php echo date('Y-m-d H:i:s',$v['starttime']);?></td>
                    <td class="align-center"><?php echo date('Y-m-d H:i:s',$v['endtime']);?></td>
                    <!--<td class="align-center"><?php echo date('Y-m-d H:i:s',$v['addtime']);?></td>-->
					<td class="align-center"><?php  if($v['is_tuijian'] == 1){echo '已推荐';}else{ echo '未推荐';} ?>
					</td>
                    <td class="align-center"><a href="index.php?act=push_user_gift&op=tuijian_add&gift_id=<?php echo $v['id'];?>">编辑</a>&nbsp;&nbsp;<a nctype="btn_del" data-tj-id="<?php echo $v['id'];?>" href="javascript:;">删除</a></td>
                </tr>
                <tr style="display:none;">
                    <td colspan="20"><div class="ncsc-goods-sku ps-container"></div></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr class="no_data">
                <td colspan="15"><?php echo $lang['nc_no_record'];?></td>
            </tr>
        <?php } ?>
        </tbody>



    </table>
    <tfoot>
    <tr class="tfoot">

        <div class="pagination"> <?php echo $output['page'];?> </div></td>
    </tr>
    </tfoot>
</div>
<form id="op_form" action="" method="POST">
    <input type="hidden" id="tj_id" name="tj_id">
</form>

<script>
$('[nctype="btn_del"]').on('click', function() {
	if(confirm('确认删除该礼品兑换活动？')) {
		var action = 'http://system.96567.com/index.php?act=push_user_gift&op=cangdou_tuijian_del';
		var tj_id = $(this).attr('data-tj-id');
		$('#op_form').attr('action', action);
		$('#tj_id').val(tj_id);
		$('#op_form').submit();
	}
});
</script>