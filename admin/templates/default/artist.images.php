<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">

  
  <div class="fixed-bar">
    <div class="item-title">
      <h3>作者管理</h3>
      <ul class="tab-base">
		<li><a href="<?php echo urlAdmin('artist', 'artist');?>"><span>所有作者</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artist', array('type' => 'addArtist'));?>"><span>作者添加</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artist', array('type' => 'addPosition'));?>" ><span>添加职位</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'push_goods');?>"><span>产品推荐</span></a></li>
        <li><a href="JavaScript:void(0);" class="current" ><span>艺术相册</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artistJoinList');?>" ><span>艺术入驻</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artistGoodsCustom');?>" ><span>作品定制</span></a></li>

		<li><a href="<?php echo urlAdmin('artist', 'artistLiuYan');?>" ><span>留言管理</span></a></li>
      </ul>
    </div>
  </div>


  <div class="fixed-empty"></div>


  <form method="get" name="formSearch" action="index.php">
    <input type="hidden" name="act" value="artist">
    <input type="hidden" name="op" value="artist_images">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="pic_name">艺术家名称：</label></th>
          <td><input class="txt" name="keyword" id="keyword" value="<?php echo $_GET['keyword'];?>" type="text"></td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search " title="<?php echo $lang['nc_query'];?>">&nbsp;</a>
          </td>
        </tr>
      </tbody>
    </table>
  </form>



<form method='post' action="index.php" name="picForm" id="picForm">
	<input type="hidden" name="act" value="artist" />
	<input type="hidden" name="op" value="del_artist_images" />
    <table class="table tb-type2">
      <tbody>


        <?php if(!empty($output['artist_imaes_info']) && is_array($output['artist_imaes_info'])){ ?>


<tr>

<td colspan="20">

  <ul class="thumblists">


<?php foreach($output['artist_imaes_info'] as $k => $v){ ?>
  <li class="picture">

    <div class="size-64x64">


      <span class="thumb">
        <i></i>

<a nctype="nyroModal"  href="<?php echo 'http://www.96567.com/'.$v['I_ImgXC'];?>" rel="gal">

<img title="" width="64" height="64"  class="tip" src="<?php echo 'http://www.96567.com/'.str_replace('.jpg','_60.jpg',$v['I_ImgXC']);?>">

</a>

    </span>


    </div>


    <p>
      <span style="width:100%;">
        <input class="checkitem" type="checkbox" name="delbox[]" value="<?php echo $v['I_Id'];?>">

        <input type="text" onchange="xu_chan_images(<?php echo $v['I_Id'];?>);" id="chan_images_xu_<?php echo $v['I_Id'];?>" value="<?php echo $v['I_Xu'];?>" style="width:20px;">
      </span>
    </p>

  </li>

<?php } ?>

</ul>

</td>

</tr>




        <?php }else { ?>

          <tr class="no_data">
            <td colspan="15"><?php echo $lang['nc_no_record'];?></td>
          </tr>

        <?php } ?>


      </tbody>


      <tfoot>
        <tr class="tfoot">
          <td class="w48"><input id="checkallBottom" class="checkall" type="checkbox" /></td>
          <td colspan="16">
            <label for="checkallBottom"><?php echo $lang['nc_select_all'];?></label>
            <a class="btn" href="javascript:void(0);" onclick="if(confirm('<?php echo $lang['nc_ensure_del'];?>')){$('#picForm').submit();}"><span><?php echo $lang['nc_del'];?></span></a>
            <div class="pagination"><?php echo $output['page'];?> </div>
          </td>
        </tr>
      </tfoot>


    </table>
  </form>
</div>





<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.nyroModal/custom.min.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.poshytip.min.js" charset="utf-8"></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/jquery.nyroModal/styles/nyroModal.css" rel="stylesheet" type="text/css" id="cssfile2" />
<script>





$(function(){
	$('a[nctype="nyroModal"]').nyroModal();
	$('a[nc_type="delete"]').bind('click',function(){
		if(!confirm('<?php echo $lang['nc_ensure_del'];?>')) return false;
		cur_note = this;
		$.get("index.php?act=goods_album&op=del_album_pic", {'key':$(this).attr('nc_key')}, function(data){
            if (data == 1)
            	$(cur_note).parent().parent().parent().remove();
            else
            	alert('<?php echo $lang['nc_common_del_fail'];?>');
        });
	});
	$('.tip').poshytip({
		className: 'tip-yellowsimple',
		//showOn: 'focus',
		alignTo: 'target',
		alignX: 'center',
		alignY: 'bottom',
		offsetX: 0,
		offsetY: 5,
		allowTipHover: false
	});
});




function xu_chan_images(id){
  
  var img_v = $("#chan_images_xu_" + id).val();

  $.ajax({
      type: "GET",
      cache: false,
      url : "index.php?act=artist&op=artist_images_xu",
      data: {'id':id,'xu':img_v},
      success : function(html){
        if(html){
          alert('操作成功');
        }
      }
  })

}
</script>
