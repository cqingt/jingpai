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
        <li><a href="<?php echo urlAdmin('artist', 'artist', array('type' => 'updateArtist','A_Id' => $_GET['A_Id']));?>" ><span>资料修改</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>官网信息</span></a></li>

      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>


  <form id="rec_form" enctype="multipart/form-data" method="POST" action="<?php if($output['result_web']['W_Id']){echo 'index.php?act=artist&op=save_web_artist';}else{echo 'index.php?act=artist&op=add_web_artist';}?>">
    <table class="table tb-type2">

      <?php if($output['result_web']['W_Id']){echo "<input type='hidden' name='W_Id' value={$output[result_web][W_Id]}>";}?>

      <tbody>

        <input type="hidden" name="W_Aid" value="<?php echo $_GET['A_Id'];?>">

        <tr class="noborder">
          <td colspan="2" class="required"><label>官网名称:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input value="<?php echo $output['result_web']['W_Title'];?>" type="text" name="W_Title" id="W_Title" class="txt"></td>
          <td class="vatop tips">艺术家官网名称</td>
        </tr>

        <tr class="noborder">
          <td colspan="2" class="required"><label>官网页面关键字:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="W_Keywords" id="W_Keywords" value="<?php echo $output['result_web']['W_Keywords'];?>" class="txt"></td>
          <td class="vatop tips">艺术家官网页面关键字</td>
        </tr>


        <tr class="noborder">
          <td colspan="2" class="required"><label>官网页面描述:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform"><textarea name="W_Description" rows="6" class="tarea" id="W_Description"><?php echo $output['result_web']['W_Description'];?></textarea></td>
            <td class="vatop tips">艺术家官网页面描述</td>
        </tr>

            <tr class="noborder">
          <td colspan="2" class="required"><label>艺术家图片:</label></td>
    </tr>
    <tr>
          <td class="vatop rowform w270"><span class="type-file-box">
            <input type="text" name="textfield" class="type-file-text" />
            <input type="button" name="button" value="" class="type-file-button" />
            <input class="type-file-file" type="file" title="" nc_type="change_default_goods_image" hidefocus="true" size="30" name="A_Topimg">
            </span></td>
          <td class="vatop tips">艺术家图片</td>
    </tr>

        <tr class="noborder">
          <td colspan="2" class="required"><label>艺术家详细介绍:</label></td>
        </tr>
        <tr class="noborder">
            <td style="width:600px;" class="vatop rowform">
              <?php showEditor('W_ArtistInfo',$output['result_web']['W_ArtistInfo'],'100%','480px','visibility:hidden;',"true");?></td>
            <td class="vatop tips">艺术家官网简介</td>
        </tr>

        <tr class="noborder">
          <td colspan="2" class="required">上传图片:</td>
        </tr>
        <tr class="noborder">
          <td colspan="3" id="divComUploadContainer"><input type="file" multiple="multiple" id="fileupload" name="fileupload" /></td>
        </tr>

      <tr class="noborder">
          <td colspan="2" class="required">已传图片:</td>
        <tr>
          <td colspan="2"><ul id="thumbnails" class="thumblists">
              <?php if(is_array($output['file_upload'])){?>
              <?php foreach($output['file_upload'] as $k => $v){ ?>
              <li id="<?php echo $v['upload_id'];?>" class="picture" >
                <input type="hidden" name="file_id[]" value="<?php echo $v['upload_id'];?>" />
                <div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo $v['upload_path'];?>" alt="<?php echo $v['file_name'];?>" onload="javascript:DrawImage(this,64,64);"/></span></div>
                <p><span><a href="javascript:insert_editor('<?php echo $v['upload_path'];?>');">插入</a></span><span><a href="javascript:del_file_upload('<?php echo $v['upload_id'];?>');">删除</a></span></p>
              </li>
              <?php } ?>
              <?php } ?>
            </ul><div class="tdare">
              
          </div></td>
      </tr>


      </tbody>

      <tfoot>
        <tr class="tfoot">
          <td colspan="15" ><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>



</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.iframe-transport.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.ui.widget.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.fileupload.js" charset="utf-8"></script> 
<script type="text/javascript">
//按钮先执行验证再提交表单
$(function(){
	function _check(){
    if($("#W_Title").val() == ''){
      alert('请填写艺术家官网名称');
      return false;
    }

    if($("#W_Keywords").val() == ''){
      alert('请填写艺术家官网页面关键字');
      return false;
    }

    if($("#W_Description").val() == ''){
      alert('请填写艺术家官网页面描述');
      return false;
    }

    if($("#W_ArtistInfo").val() == ''){
      alert('请填写艺术家简介');
      return false;
    }

		return true;
	}

	$("#submitBtn").click(function(){
		if(_check()){
			$("#rec_form").submit();
		}
	});

});

$(document).ready(function(){
    // 图片上传
    $('#fileupload').each(function(){
        $(this).fileupload({
            dataType: 'json',
            url: 'index.php?act=article&op=article_pic_upload',
            done: function (e,data) {
                if(data != 'error'){
                  add_uploadedfile(data.result);
                }
            }
        });
    });
});


function add_uploadedfile(file_data)
{
    var newImg = '<li id="' + file_data.file_id + '" class="picture"><input type="hidden" name="file_id[]" value="' + file_data.file_id + '" /><div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE.'/';?>' + file_data.file_name + '" alt="' + file_data.file_name + '" width="64px" height="64px"/></span></div><p><span><a href="javascript:insert_editor(\'<?php echo UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE.'/';?>' + file_data.file_name + '\');">插入</a></span><span><a href="javascript:del_file_upload(' + file_data.file_id + ');">删除</a></span></p></li>';
    $('#thumbnails').prepend(newImg);
}
function insert_editor(file_path){
  KE.appendHtml('article_content', '<img src="'+ file_path + '" alt="'+ file_path + '">');
}
function del_file_upload(file_id)
{
    if(!window.confirm('<?php echo $lang['nc_ensure_del'];?>')){
        return;
    }
    $.getJSON('index.php?act=article&op=ajax&branch=del_file_upload&file_id=' + file_id, function(result){
        if(result){
            $('#' + file_id).remove();
        }else{
            alert('<?php echo $lang['article_add_del_fail'];?>');
        }
    });
}
</script>
<script type="text/javascript">
$(function(){
  $('input[nc_type="change_default_goods_image"]').live("change", function(){
    $(this).parent().find('input[class="type-file-text"]').val($(this).val());
  });
});
</script> 