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
        <li><a href="<?php echo urlAdmin('artist', 'artist', array('type' => 'addArtist'));?>" ><span>添加职位</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artist', array('type' => 'addPosition'));?>" ><span>添加职位</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artist', array('type' => 'updateArtist','A_Id'=>$_GET['A_Id']));?>"><span>资料修改</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>艺术相册</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>




  <form id="rec_form" enctype="multipart/form-data" method="POST" action="index.php?act=artist&op=artist_images_save">
    <table class="table tb-type2">

      <tbody>

        <input type="hidden" name="A_Id" value="<?php echo $_GET['A_Id']?>">

        <tr class="noborder">
          <td colspan="2" class="required"><label>图片说明:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input value="" type="text" name="I_Name" id="I_Name" class="txt"></td>
          <td class="vatop tips">图片说明</td>
        </tr>


    <tr class="noborder">
          <td colspan="2" class="required"><label>艺术家图片:</label></td>
    </tr>
    <tr>
          <td class="vatop rowform w270"><span class="type-file-box">
            <input type="text" name="textfield" class="type-file-text" />
            <input type="button" name="button" value="" class="type-file-button" />
            <input class="type-file-file" type="file" title="" nc_type="change_default_goods_image" hidefocus="true" size="30" name="A_Img">
            </span></td>
          <td class="vatop tips">艺术家图片 <span style="color: red;">图片尺寸270*270</span></td>
    </tr>



<!--     <tr class="noborder">
          <td colspan="2" class="required"><label>艺术家相册:</label></td>
    </tr>

    <tr>
          <td class="vatop rowform w270">
            <span class="type-file-box">
            <input type="text" name="textfield_x" class="type-file-text-xiangce" />
            <input type="button" name="button" value="" class="type-file-button" />
            <input class="type-file-file" type="file" title="" nc_type="change_default_goods_image_xiangce" hidefocus="true" size="30" name="A_ImgXC">
            </span>
          </td>
          <td class="vatop tips">艺术家相册</td>
    </tr> -->
  

<!--   <tr>
    <td >


<?php if(!empty($output['artistImages'])){?>      
  <?php foreach ($output['artistImages'] as $k => $v){?>
  
  <img src="<?php echo 'http://www.96567.com/'.str_replace('.jpg','_60.jpg',$v['I_ImgXC']);?>" alt="">

  <?php }?>
<?php }?>


    </td>
  </tr> -->
        
      </tbody>


      <tfoot>
        <tr class="tfoot">
          <td colspan="15" ><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
  




    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24">ID</th>
          <th class="align-center">图片说明</th>
          <th class="align-center">图片</th>
          <th class="align-center">排序</th>
          <th width='150' class="align-center">操作</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($output['artistImages']) && is_array($output['artistImages'])) { ?>

        <?php foreach ($output['artistImages'] as $k => $v) {?>
        <tr class="hover edit">
          <td class="align-center"><?php echo $v['I_Id'];?></td>
          <td class="align-center"><input style="width:200px;" onchange="xu_chan_iname(<?php echo $v['I_Id'];?>);" id="chan_images_iname_<?php echo $v['I_Id'];?>" type="text" name="I_Name" value="<?php echo $v['I_Name']?$v['I_Name']:'无';?>"></td>
          <td class="align-center"><img src="<?php echo 'http://www.96567.com/'.str_replace('.jpg','_60.jpg',$v['I_ImgXC']);?>" alt=""></td>
          <td class="align-center"><input style="width:50px;"  onchange="xu_chan_images(<?php echo $v['I_Id'];?>);" id="chan_images_xu_<?php echo $v['I_Id'];?>" type="text" name="I_Xu" value="<?php echo $v['I_Xu'];?>"></td>
          <td class="align-center"><a href="index.php?act=artist&op=del_artist_images_one&I_Id=<?php echo $v['I_Id'];?>">删除</a></td>
        </tr>

        <?php } ?>
        <?php } else { ?>
        <tr class="no_data">
          <td colspan="15"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>

    </table>






</div>



<script type="text/javascript">
//按钮先执行验证再提交表单
$(function(){


	$("#submitBtn").click(function(){
			$("#rec_form").submit();
	});

});

function xu_chan_iname(id){
  
  var iname = $("#chan_images_iname_" + id).val();

  if(!iname){
    alert('操作失败');
    return;
  }

  $.ajax({
      type: "GET",
      cache: false,
      url : "index.php?act=artist&op=artist_images_iname",
      data: {'id':id,'iname':iname},
      success : function(html){
        if(html){
          alert('操作成功');
        }
      }
  })

}



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


<script type="text/javascript">
$(function(){
	$('input[nc_type="change_default_goods_image"]').live("change", function(){
		$(this).parent().find('input[class="type-file-text"]').val($(this).val());
	});

  $('input[nc_type="change_default_goods_image_xiangce"]').live("change", function(){
    $(this).parent().find('input[class="type-file-text-xiangce"]').val($(this).val());
  });

});
</script> 