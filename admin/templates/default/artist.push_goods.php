<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->


<div class="page">

  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['goods_index_goods'];?></h3>
      <ul class="tab-base">

		<li><a href="<?php echo urlAdmin('artist', 'artist');?>"><span>所有作者</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artist', array('type' => 'addArtist'));?>"><span>作者添加</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artist', array('type' => 'addPosition'));?>" ><span>添加职位</span></a></li>
        <li><a href="JavaScript:void(0);" class="current" ><span>产品推荐</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artist_images');?>" ><span>艺术相册</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artistJoinList');?>" ><span>艺术入驻</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artistGoodsCustom');?>" ><span>作品定制</span></a></li>

		<li><a href="<?php echo urlAdmin('artist', 'artistLiuYan');?>" ><span>留言管理</span></a></li>
      </ul>
    </div>
  </div>

  <div class="fixed-empty"></div>

  <form method="get" name="formSearch" id="formSearch">
    <input type="hidden" name="act" value="artist">
    <input type="hidden" name="op" value="push_goods">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_goods_name">艺术家名称</label></th>
          <td><input type="text" value="<?php echo $_GET['artist_name'];?>" name="artist_name" id="search_artist_name" class="txt"></td>
          <th><label for="search_goods_name">产品名称</label></th>
          <td><input type="text" value="<?php echo $_GET['goods_name'];?>" name="goods_name" id="search_goods_name" class="txt"></td>
          <td ><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo $lang['nc_query'];?>">&nbsp;</a></td>
        </tr>
      </tbody>
    </table>
  </form>



    <table class="table tb-type2">
      <thead>
        <tr class="thead">

          <th class="w60 align-center">平台货号</th>
          <th colspan="2"><?php echo $lang['goods_index_name'];?></th>
          <th class="w72 align-center">价格(元)</th>

          <th class="w108 align-center">推荐排序</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($output['goods_list']) && is_array($output['goods_list'])) { ?>
        <?php foreach ($output['goods_list'] as $k => $v) {?>
        <tr class="hover edit">
          <td class="align-center"><?php echo $v['goods_commonid'];?></td>
          <td class="w60 picture"><div class="size-56x56"><span class="thumb size-56x56"><i></i><img src="<?php echo thumb($v, 60);?>" onload="javascript:DrawImage(this,56,56);"/></span></div></td>
          <td>
          <dl class="goods-info"><dt class="goods-name"><?php echo $v['goods_name'];?></dt>

            </td>

          <td class="align-center"><?php echo $v['goods_price']?></td>

          <td class="align-center">
            <input type="text" onchange="chan_artist_order(<?php echo $v['goods_id'];?>);" style="width:50px;" id="artist_order_<?php echo $v['goods_id'];?>" name="artist_order" value="<?php echo $v['artist_order']?>">
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
      <tfoot>
        <tr class="tfoot">
          <td></td>
          <td colspan="16"></a>
            <div class="pagination"> <?php echo $output['page'];?> </div></td>
        </tr>
      </tfoot>
    </table>
</div>




<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script>

<script type="text/javascript">
var SITEURL = "<?php echo SHOP_SITE_URL; ?>";
$(function(){


    $('#ncsubmit').click(function(){
        $('#formSearch').submit();
    });


});

function chan_artist_order(goods_id){

  var v = $("#artist_order_" + goods_id).val();

  if(!!goods_id && !!v){

    $.ajax({
      type: "GET",
      cache: false,
      url : "index.php?act=artist&op=ajax_push_goods",
      data: 'g_id=' + goods_id + '&a_id=' + v,
      success : function(html){
        if(html){
          alert('修改成功');
        }
      }
    })

  }
}

</script>
