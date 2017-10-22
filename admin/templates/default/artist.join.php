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
		<li><a href="<?php echo urlAdmin('artist', 'artist');?>"><span>所有作者</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artist', array('type' => 'addArtist'));?>"><span>作者添加</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artist', array('type' => 'addPosition'));?>" ><span>添加职位</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'push_goods');?>"><span>产品推荐</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artist_images');?>" ><span>艺术相册</span></a></li>
        <li><a href="JavaScript:void(0);" class="current" ><span>艺术入驻</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artistGoodsCustom');?>" ><span>作品定制</span></a></li>

		<li><a href="<?php echo urlAdmin('artist', 'artistLiuYan');?>" ><span>留言管理</span></a></li>
      </ul>
    </div>
  </div>

  <div class="fixed-empty"></div>
<!--   <form id="form1" method="get" name="formSearch" id="formSearch">
    <input type="hidden" name="act" value="artist">
    <input type="hidden" name="op" value="artist">
    <table class="tb-type1 noborder search">
      <tbody>

      <tr>
        <th><label for="search_store_name">艺术家名称</label></th>
        <td><input type="text" value="" name="search" id="search" class="txt"></td>
          <td ><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo $lang['nc_query'];?>"></a></td>
          <td class="w120">&nbsp;</td>
        </tr>
      </tbody>
    </table>
  </form> -->



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
          <th class="align-center">联系人</th>
          <th class="align-center">手机号</th>
          <th class="align-center">来源</th>
          <th width='200' class="align-center">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($output['artist_list']) && is_array($output['artist_list'])) { ?>

        <?php foreach ($output['artist_list'] as $k => $v) {?>
        <tr class="hover edit">
          <td class="align-center"><?php echo $v['J_Id'];?></td>
          <td class="align-center"><?php echo $v['J_ArtistName'];?></td>
          <td class="align-center"><?php echo JieMiMobile($v['J_Mobile']);?></td>
          <td class="align-center"><?php echo $v['J_Laiyuan'];?></td>
          <td class="align-center"><a href="<?php echo urlAdmin('artist','saveArtistType',array('id'=>$v['J_Id'],'type'=>($v['J_Type']?0:1)));?>"><?php echo $v['J_Type']?'取消':'确认联系';?></a></td>
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
