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
        <li><a href="JavaScript:void(0);" class="current"><span>所有作者</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artist', array('type' => 'addArtist'));?>" ><span>作者添加</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artist', array('type' => 'addPosition'));?>" ><span>添加职位</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'push_goods');?>" ><span>产品推荐</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artist_images');?>" ><span>艺术相册</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artistJoinList');?>" ><span>艺术入驻</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artistGoodsCustom');?>" ><span>作品定制</span></a></li>

		 <li><a href="<?php echo urlAdmin('artist', 'artistLiuYan');?>" ><span>留言管理</span></a></li>
      </ul>
    </div>
  </div>

  <div class="fixed-empty"></div>
  <form id="form1" method="get" name="formSearch" id="formSearch">
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
  </form>



  <table class="table tb-type2" id="prompt">
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
  </table>
  <form method='POST' id="form_goods" action="<?php echo urlAdmin('artist', 'del_artist');?>">
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24"></th>
          <th class="w24">ID</th>
          <th class="align-center">艺术家名称</th>
          <th class="align-center">签约</th>
          <th class="align-center">润格价格</th>
          <th class="align-center">排序</th>
          <th width='200' class="align-center">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($output['result_list']) && is_array($output['result_list'])) { ?>

        <?php foreach ($output['result_list'] as $k => $v) {?>
        <tr class="hover edit">
          <td><input type="checkbox" name="A_Id[]" value="<?php echo $v['A_Id'];?>" class="checkitem"></td>
          <td class="align-center"><?php echo $v['A_Id'];?></td>
          <td class="align-center"><?php echo $v['A_Name'];?></td>
          <td class="align-center"><?php if($v['A_QianYue'] == '1'){echo '是';}else{echo '否';}?></td>
          <td class="align-center"><?php echo $v['A_Money'];?></td>
          <td class="align-center"><?php echo $v['A_OrderBy'];?></td>
          <td class="align-center"><a href="http://www.96567.com/artist/index.php?act=artist_blog&op=index&aid=<?php echo $v['A_Id'];?>"  target="_blank">查看 | </a><?php if($v['A_Web'] == 1){ echo "<a href='".urlAdmin('artist','artist',array('type'=>'webArtist','A_Id'=>$v['A_Id']))."'>官网信息 | </a>";}else{ echo "<a href='".urlAdmin('artist','artist',array('type'=>'webArtistShow','A_Id'=>$v['A_Id']))."'>开通官网 | </a>";}?><a href="<?php echo urlAdmin('artist','artist',array('type'=>'updateArtist','A_Id'=>$v['A_Id']));?>">编辑 | </a><a href="javascript:delInfo(<?php echo $v['A_Id'];?>);">删除</a></td>
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
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16"><label for="checkallBottom"><?php echo $lang['nc_select_all']; ?></label>
            &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" nctype="lockup_batch"><span>删除</span></a>
            <div class="pagination"> <?php echo $output['page'];?> </div></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script>

<script type="text/javascript">
$(function (){

  $("#ncsubmit").click(function (){
      $("#form1").submit();
  });

  $(".btn").click(function (){
    var flag;
      $('input[name="A_Id[]"]').each(function(){
        if ($(this).attr('checked') == 'checked')  flag = true;
      });
      if(flag !== true){
        alert('请至少选择一个要删除对象');
      }else{
        $("#form_goods").submit();
      }
  });

})



function delInfo(id){
  if(confirm('确定要删除吗？')){
    window.location.href="index.php?act=artist&op=del_artist&A_Id=" + id;
  }
}



</script>
