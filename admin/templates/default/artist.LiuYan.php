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
        <li><a href="<?php echo urlAdmin('artist', 'artist_images');?>"><span>艺术相册</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artistJoinList');?>" ><span>艺术入驻</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artistGoodsCustom');?>" ><span>作品定制</span></a></li>

		<li><a href="JavaScript:void(0);" class="current"  ><span>留言管理</span></a></li>
      </ul>
    </div>
  </div>


  <div class="fixed-empty"></div>

<!--
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

-->
<form method="POST" id="form_goods" action="index.php?act=artist&op=DeleteLiuYan">
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
			<th class="w24"></th>
          <th class="w24">ID</th>
		  <th class="w24"></th>
          <th class="align-center">艺术家</th>
          <th class="align-center">会员名</th>
          <th class="align-center">评价内容</th>
          <th class="align-center">时间</th>
          <th width="200" class="align-center">操作</th>
        </tr>
      </thead>
      <tbody>
		<?php if(!empty($output['artPinLun']) && is_array($output['artPinLun'])){ ?>
			<?php foreach($output['artPinLun'] as $k => $v){ ?>
			<input type="hidden" id="IsDisplay<?php echo $v['P_Id'];?>" value='0'>
		     <tr class="hover edit">
			 <td class="align-center"><input type="checkbox" name="P_Id[]" value="<?php echo $v['P_Id'];?>" class="checkitem"></td>
			  <td class="align-center"><?php echo $v['P_Id'];?></td>
			  <td class="align-center"><?php if($v['Pl_Huifu_count'] > 0){ ?> <a href="javascript:void(0);" onclick="ChaKanHuiFu(<?php echo $v['P_Id'];?>);">[+]</a><?php } ?></td>
			  <td class="align-center"><?php  echo $v['P_ArtistName'];?></td>
			  <td class="align-center"><?php echo $v['P_MemberName'];?></td>
			  <td class="align-center"><?php echo $v['P_Content'];?></td>
			  <td class="align-center"><?php echo date('Y-m-d H:i:s',$v['P_AddTime']);?></td>

			  <td class="align-center"><a href="http://www.96567.com/artist/index.php?act=artist_blog&op=liuyan&aid=<?php echo $v['P_ArtistId'];?>" target="_blank">查看</a>&nbsp;&nbsp;<a href="index.php?act=artist&op=DeleteLiuYan&id=<?php echo $v['P_Id'];?>" onclick="return confirm('您确认要删除此留言吗？');">删除</a>&nbsp;&nbsp;<a href="javascript:void(0);" onclick="ChaKanHuiFu(<?php echo $v['P_Id'];?>);">查看回复信息</a></td>
			</tr>

      
			<td class="hover edit" style="display: none;" id="HuiFu<?php echo $v['P_Id'];?>" colspan="7">
				
			</td>
			<?php } ?>     
     <?php }else { ?>

          <tr class="no_data">
            <td colspan="15"><?php echo $lang['nc_no_record'];?></td>
          </tr>

        <?php } ?>
        
      </tbody>
		<tfoot>


        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16">
		  <label for="checkallBottom">全选</label>
            &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" nctype="lockup_batch"><span>删除</span></a>

            <div class="pagination"> 
				<?php echo $output['page'];?>
			</div>
			</td>
		</tr>
      </tfoot>
    </table>
  </form>
</div>


<script>

$(function (){
  $(".btn").click(function (){
    var flag;
      $('input[name="P_Id[]"]').each(function(){
        if ($(this).attr('checked') == 'checked')  flag = true;
      });
      if(flag !== true){
        alert('请至少选择一个要删除对象');
      }else{
        $("#form_goods").submit();
      }
  });

})

function ChaKanHuiFu(PID){
	$.ajax({
			type:'post',
			url:"index.php?act=artist&op=ChaKanHuiFu",
			data:{id:PID},
			dataType:'html',
			success:function(result){
				$("#HuiFu"+PID).html(result);
				var IsDisplay = $("#IsDisplay"+PID).val();
				if(IsDisplay == 0){
					document.getElementById('HuiFu'+PID).style.display='';
					$("#IsDisplay"+PID).val(1);
				}else{
					document.getElementById('HuiFu'+PID).style.display='none';
					$("#IsDisplay"+PID).val(0);
				}
			}
		});
}
</script>
