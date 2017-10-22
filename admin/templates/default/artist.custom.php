<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<div class="page">

  <div class="fixed-bar">
    <div class="item-title">
      <h3>作者管理</h3>
      <ul class="tab-base">
        <li><a href="<?php echo urlAdmin('artist', 'artist');?>" ><span>所有作者</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artist', array('type' => 'addArtist'));?>" ><span>作者添加</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artist', array('type' => 'addPosition'));?>" ><span>添加职位</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'push_goods');?>" ><span>产品推荐</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artist_images');?>" ><span>艺术相册</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artistJoinList');?>"><span>艺术入驻</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>作品定制</span></a></li>
<li><a href="<?php echo urlAdmin('artist', 'artistLiuYan');?>" ><span>留言管理</span></a></li>
      </ul>
    </div>
  </div>

  <div class="fixed-empty"></div>


  <form id="form1" method="get" action='index.php' name="formSearch" id="formSearch">
    <input type="hidden" name="act" value="artist">
    <input type="hidden" name="op" value="artistGoodsCustom">
    <table class="tb-type1 noborder search">
      <tbody>

      <tr>
        <th><label for="search_store_name">艺术家名称</label></th>
        <td><input type="text" value="<?php echo $_GET['yname'];?>" name="yname" id="yname" class="txt"></td>

        <th><label for="search_store_name">定制类型</label></th>

        <td>
          <select name="custom_class" id="">
            <option value="">请选择</option>
            <option value="1" <?php if($_GET['custom_class'] == 1){echo 'selected=\'selected\'';};?>>艺术家定制</option>
            <option value="2" <?php if($_GET['custom_class'] == 2){echo 'selected=\'selected\'';};?>>个性定制</option>
          </select>
        </td>


        <td ><a href="javascript:void(0);" id="ncsubmit"  class="btn-search " title="<?php echo $lang['nc_query'];?>"></a></td>
        <td class="w120">&nbsp;</td>
      </tr>



      </tbody>
    </table>
  </form>




<!--   <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li><?php echo $lang['goods_index_help1'];?></li>
            <li><?php echo $lang['goods_index_help2'];?></li>
          </ul></td>
      </tr>
    </tbody>
  </table> -->


  <form method='POST' id="form_goods" action="">
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24">ID</th>
          <th class="align-center">艺术家名称</th>
          <th class="align-center">类型</th>
          <th class="align-center">尺寸</th>
          <th class="align-center">价格</th>
          <th class="align-center">定制方式</th>
          <th width='200' class="align-center">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($output['custom_list']) && is_array($output['custom_list'])) { ?>

        <?php foreach ($output['custom_list'] as $k => $v) {?>
        <tr class="hover edit">
          <td class="align-center"><?php echo $v['C_Id'];?></td>
          <td class="align-center"><?php echo $v['C_ArtistName'];?></td>
          <td class="align-center"><?php echo $v['C_LeiXing'];?></td>
          <td class="align-center"><?php echo $v['C_ChiCun'];?></td>
          <td class="align-center"><?php echo $v['C_Money'];?></td>
          <td class="align-center"><?php echo ($v['C_CustomType']==1)?'艺术家定制':'个性定制';?></td>
          <td class="align-center"><a href="<?php echo urlAdmin('artist','artistGoodsCustomInfo',array('id'=>$v['C_Id']));?>">查看</a></td>
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
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script>
<script>
  $(function(){

    $("#ncsubmit").click(function(){

      $("#form1").submit();

    })

  })
</script>