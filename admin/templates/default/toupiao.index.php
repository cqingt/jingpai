<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<div class="page">

  <div class="fixed-bar">
    <div class="item-title">
      <h3>投票管理</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li><a href="<?php echo urlAdmin('toupiao', 'shenqing_list');?>" ><span>投票申请</span></a></li>

      </ul>
    </div>
  </div>




  <div class="fixed-empty"></div>
  <!--
  <form id="form1" method="get" name="formSearch" id="formSearch">
    <input type="hidden" name="act" value="lepai">
    <input type="hidden" name="op" value="index">
    <table class="tb-type1 noborder search">
      <tbody>

      <tr>
        <th><label for="search_store_name">用户名称</label></th>
        <td><input type="text" value="" name="search" id="search" class="txt"></td>
          <td ><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo $lang['nc_query'];?>"></a></td>
          <td class="w120">&nbsp;</td>
        </tr>
      </tbody>
    </table>
  </form>

-->


  <form method='POST' id="form_goods" action="<?php echo urlAdmin('artist', 'del_artist');?>">
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24">ID</th>
		  <th class="align-center">会员名称</th>
          <th class="align-center">藏品标题</th>
          <th class="align-center">作品年代</th>
          <th class="align-center">入手时间</th>
          <th class="align-center">入手价格</th>
          <th class="align-center">提交时间</th>
		  <th class="align-center">是否通过审核</th>
		  <th class="align-center">投票数量</th>
		  <th class="align-center">实际投票人数</th>
		  <th class="align-center">项目来源</th>
          <th width='150' class="align-center">操作</th>
        </tr>
      </thead>


      <tbody>
        <?php if (!empty($output['result_list']) && is_array($output['result_list'])) { ?>

        <?php foreach ($output['result_list'] as $k => $v) {?>
        <tr class="hover edit">
          <td class="align-center"><?php echo $v['id'];?></td>
          <td class="align-center"><?php echo $v['member_name'];?></td>
          <td class="align-center"><?php echo $v['title'];?></td>
          <td class="align-center"><?php echo $v['years'];?></td>
          <td class="align-center"><?php echo $v['data_time'];?></td>
          <td class="align-center"><?php echo $v['price'];?></td>
		  <td class="align-center"><?php echo date("Y-m-d",$v['add_time']);?></td>
		  <td class="align-center"><?php if($v['is_rev'] == 0){ echo '未审核';}elseif($v['is_rev'] == 1){ echo '通过审核';}else{ echo '未通过审核';}?></td>
		  <td class="align-center"><?php echo $v['vote_num'];?></td>
		  <td class="align-center"><?php echo $v['vote_num'];?></td>
		  <td class="align-center"><?php echo $v['ad_name'];?></td>
          <td class="align-center">
<a href="index.php?act=toupiao&op=end_toupiao&id=<?php echo $v['id'];?>">编辑/查看</a>
&nbsp;&nbsp;&nbsp;&nbsp;<a nctype="btn_del" data-id="<?php echo $v['id'];?>" data-is-rev="<?php echo $v['is_rev'];?>" href="javascript:;">删除</a>
          </td>
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
  </form>

<tfoot>
        <tr class="tfoot">
          
            <div class="pagination"> <?php echo $output['page'];?> </div></td>
        </tr>
      </tfoot>
  
</div>

<form id="op_form" action="" method="POST">
    <input type="hidden" id="id" name="id">
</form>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script>

<script type="text/javascript">
$(function (){

  $("#ncsubmit").click(function (){
      $("#form1").submit();
  });

})


$('[nctype="btn_del"]').on('click', function() {
		var is_rev = $(this).attr('data-is-rev');
		if(is_rev == 1){
			alert("已审核的活动不能删除");
			return;
		}
		if(confirm('确认删除该投票活动？')) {
			var action = 'index.php?act=toupiao&op=toupiao_del';
			var id = $(this).attr('data-id');
			$('#op_form').attr('action', action);
			$('#id').val(id);
			$('#op_form').submit();
		}
	});
</script>
