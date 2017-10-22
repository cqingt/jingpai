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
        <li><a  href="JavaScript:void(0);" class="current" ><span>作者添加</span></a></li>
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


  <form id="rec_form" enctype="multipart/form-data" method="POST" action="index.php?act=artist&op=add_artist">
    <table class="table tb-type2">

      <tbody>

        <tr class="noborder">
          <td colspan="2" class="required"><label>人物名称:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="A_Name" id="A_Name" class="txt"></td>
          <td class="vatop tips">艺术家人物姓名</td>
        </tr>

        <tr class="noborder">
          <td colspan="2" class="required"><label>人物排序:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="A_OrderBy" id="A_OrderBy" value="100" class="txt"></td>
          <td class="vatop tips">艺术家显示排序</td>
        </tr>


      <tr><td colspan="2" class="required">艺术家作者是否签约</td></tr>
        <tr class="noborder">
          <td class="vatop rowform"><ul>
              <li>
                <label>
                  <input name="A_QianYue" id="A_QianYue" type="radio" value="1" >
                  是</label>
              </li>
              <li>
                <label>
                  <input type="radio" name="A_QianYue" id="A_QianYue" value="0" checked="checked">
                  否</label>
              </li>
            </ul></td>
          <td class="vatop tips">艺术家作者是否签约</td>
        </tr>


        <tr><td colspan="2" class="required">艺术家职位</td></tr>
        <tr class="noborder">
          <td class="vatop rowform"><ul>
<?php foreach($output['result_position'] as $k=>$v){?>

              <li>
                <label>
                  <input name="A_Position[]" id="" type="checkbox" value="<?php echo $v['P_Id'];?>" >
                  <?php echo $v['P_Name'];?>
                </label>
              </li>

<?php }?>
            </ul></td>
          <td class="vatop tips">艺术家作者职位</td>
        </tr>


        <tr class="noborder">
          <td colspan="2" class="required"><label>人物简介:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform"  style="width:800px;">
              <?php showEditor('A_JieShao','','100%','400px','visibility:hidden;',"true");?></td>

              <!-- <textarea name="A_JieShao" rows="6" class="tarea" id="A_JieShao"></textarea> -->
            </td>
            <td class="vatop tips">艺术家简介</td>
        </tr>

        <tr class="noborder">
          <td colspan="2" class="required"><label>人物描述:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
              <?php showEditor('A_MiaoShu','','100%','400px','visibility:hidden;',"true");?></td>

              <!-- <textarea name="A_MiaoShu" rows="6" class="tarea" id="A_MiaoShu"></textarea> -->
            </td>
            <td class="vatop tips">艺术家描述</td>
        </tr>

        <tr class="noborder">
          <td colspan="2" class="required"><label>人物职称:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
              <?php showEditor('A_ZhiCheng','','100%','400px','visibility:hidden;',"true");?></td>

              <!-- <textarea name="A_ZhiCheng" rows="6" class="tarea" id="A_ZhiCheng"></textarea -->
               </td>
            <td class="vatop tips">艺术家职称</td>
        </tr>

        <tr class="noborder">
          <td colspan="2" class="required"><label>艺术生涯:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
              <?php showEditor('A_ShenYa','','100%','400px','visibility:hidden;',"true");?></td>

              <!-- <textarea name="A_ShenYa" rows="6" class="tarea" id="A_ShenYa"></textarea> -->
            </td>
            <td class="vatop tips">艺术家生涯</td>
        </tr>


        <tr>
          <td colspan="2" class="required"><label>人物分类:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <select name="A_Class" id="A_Class" required="required">
              <option value="">请选择</option>
              <option value="1">书画</option>
              <option value="2">国画</option>
              <option value="3">油画</option>
              <option value="4">版画</option>
            </select>
          </td>
          <td class="vatop tips">下拉选择人物分类</td>
        </tr>

        <tr>
          <td colspan="2" class="required"><label>人物籍贯:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform">
            <select name="A_JiGuan" id="A_JiGuan" required="required">
              <option value="">请选择</option>
<?php foreach($output['result_area'] as $k=>$v){?>
              <option value="<?php echo $v['area_id'];?>"><?php echo $v['area_name'];?></option>
<?php }?>
            </select>
          </td>
          <td class="vatop tips">下拉选择人物籍贯</td>
        </tr>

        <tr class="noborder">
          <td colspan="2" class="required"><label>润格价格:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="A_Money" id="A_Money" class="txt"></td>
          <td class="vatop tips">艺术家润格价格、价格：元/平尺</td>
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
          <td class="vatop tips">艺术家图片</td>
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
<script type="text/javascript">
//按钮先执行验证再提交表单
$(function(){
  var flag;
	function _check(){
    if($("#A_Name").val() == ''){
      alert('请填写艺术家名称');
      return false;
    }

    $('input[name="A_Position[]"]').each(function(){

        if ($(this).attr('checked') == 'checked')  flag = true;
    });
    if(flag !== true){
      alert('请选择艺术家职位');
      return false;
    }

    if($("#A_Class").val() == ''){
      alert('请填写艺术家分类');
      return false;
    }

    if($("#A_JiGuan").val() == ''){
      alert('请填写艺术家籍贯');
      return false;
    }

    if($("#A_Money").val() == ''){
      alert('请填写艺术家润格价格');
      return false;
    }

    if($('input[class="type-file-text"]').val() == ''){
      alert('请上传艺术家图片');
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
</script>


<script type="text/javascript">
$(function(){
	$('input[nc_type="change_default_goods_image"]').live("change", function(){
		$(this).parent().find('input[class="type-file-text"]').val($(this).val());
	});
});
</script> 