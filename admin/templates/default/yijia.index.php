<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

<div class="page">

  <div class="fixed-bar">
    <div class="item-title">
      <h3>议价管理</h3>
    </div>
  </div>

  <div class="fixed-empty"></div>
  <form  id="form1" method="get" name="formSearch" id="formSearch">
    <input type="hidden" name="act" value="yijia">
    <input type="hidden" name="op" value="yijia">
    <table class="tb-type1 noborder search">
      <tbody>

      <tr>
        <td>议价人：<input type="text" value="<?php echo $_GET['name'];?>" name="name" id="name" class="txt" placeholder='咨询人'></td>
		<td>所属店铺：<input type="text" value="<?php echo $_GET['store_name'];?>" name="store_name" id="store_name" class="txt" placeholder='店铺名称'></td>
        <td>店铺类型：
          <select name="store_type" id="store_type">
            <option value="" selected>请选择</option>
            <option value="1" <?php if(@intval($_GET['store_type']) == 1){ echo 'selected'; } ?>>自营店铺</option>
            <option value="2" <?php if(@intval($_GET['store_type']) == 2){ echo 'selected'; } ?>>商家店铺</option>
			<option value="3" <?php if(@intval($_GET['store_type']) == 3){ echo 'selected'; } ?>>书画代运营</option>
          </select>
        </td>
       
          <td ><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo $lang['nc_query'];?>"></a></td>
          <td class="w120">&nbsp;</td>
        </tr>
      </tbody>
    </table>
  </form>




    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24">议价人</th>
          <th class="align-center">手机号</th>
          <th class="align-center">议价商品</th>
          <th class="align-center">所属店铺</th>
          <th class="align-center">店铺类型</th>
          <th class="align-center">议价内容</th>
          <th class="align-center">议价时间</th>
          <th class="align-center">处理时间</th>
          <th width='150' class="align-center">操作</th>
        </tr>
      </thead>


      <tbody>
        <?php if (!empty($output['yijia_list']) && is_array($output['yijia_list'])) { ?>
		<?php $store_type = array('1'=>'自营店铺','2'=>'商家店铺','3'=>'书画代运营');?>
        <?php foreach ($output['yijia_list'] as $k => $v) {?>
        <tr class="hover edit">
          <td class="align-center"><?php echo $v['member_name'] == '' ? '匿名' : $v['member_name'];?></td>
          <td class="align-center"><?php echo $v['mobile'];?></td>
          <td class="align-center"><a href="http://www.96567.com/goods-<?php echo $v['goods_id'];?>.html" target="_blank"><?php echo $v['goods_name'];?></a></td>
          <td class="align-center"><?php echo $v['store_name'];?></td>
          <td class="align-center"><?php echo $store_type[$v['store_type']];?></td>
		  <td class="align-center"><?php echo $v['contents'];?></td>
          <td class="align-center"><?php echo date('Y-m-d H:i:s',$v['add_time']);?></td>
          <td class="align-center"><?php if($v['state_time']){ echo date('Y-m-d H:i:s',$v['state_time']); }else{ echo '';}?></td>
          <td class="align-center"> 
			  <?php if($v['state'] == 0){ ?>
				<a href="JavaScript:void(0);" class="btn" onclick="ChuLiYiJia(<?php echo $v['id'];?>);"><span>处理</span></a>
			  <?php }else{ ?>
			  <?php if($v['state_contents']){ echo $v['state_contents']."<br />";}?>
			  
				已处理
			  <?php } ?>
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
    <tfoot>
        <tr class="tfoot">
          
            <div class="pagination"> <?php echo $output['page'];?> </div></td>
        </tr>
      </tfoot>
</div>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.mousewheel.js"></script>

<script type="text/javascript">
$(function (){

  $("#ncsubmit").click(function (){
      $("#form1").submit();
  });
})

// 议价处理
function ChuLiYiJia(id) {
    _uri = "<?php echo ADMIN_SITE_URL;?>/index.php?act=yijia&op=ChuLiYiJia&id="+id ;
    CUR_DIALOG = ajax_form('ChuLiYiJia', '议价处理', _uri, 450);
}

</script>
