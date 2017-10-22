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
        <li><a href="JavaScript:void(0);" class="current"  ><span>添加职位</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'push_goods');?>" ><span>产品推荐</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artist_images');?>" ><span>艺术相册</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artistJoinList');?>" ><span>艺术入驻</span></a></li>
        <li><a href="<?php echo urlAdmin('artist', 'artistGoodsCustom');?>" ><span>作品定制</span></a></li>

		<li><a href="<?php echo urlAdmin('artist', 'artistLiuYan');?>" ><span>留言管理</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>

 <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li>双击职位名称可修改</li>
          </ul></td>
      </tr>
    </tbody>
  </table>


  <form method='post' id="form1" action="<?php echo urlAdmin('artist', 'add_position');?>">
    <table class="tb-type1 noborder search">
      <tbody>
      <tr>
        <th><label for="search_store_name">职位添加</label></th>
        <td><input type="text" value="" name="addPosition" id="addPosition" class="txt" required="required"></td>
        <td ><input type="submit" value='添加'></td>
        <td class="w120">&nbsp;</td>
        </tr>
      </tbody>
    </table>
  </form>



  <form >
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24">ID</th>
          <th class="align-center">职位名称</th>
          <th width='200' class="align-center"><?php echo $lang['nc_handle'];?> </th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($output['result_position']) && is_array($output['result_position'])) { ?>
        <?php foreach ($output['result_position'] as $k => $v) {?>
        <tr class="hover edit">
          <td class="align-center"><?php echo $v['P_Id'];?></td>
          <td class="align-center" ondblclick="up_val(s_<?php echo $v['P_Id'];?>,<?php echo $v['P_Id'];?>);" id="s_<?php echo $v['P_Id'];?>"><?php echo $v['P_Name'];?></td>
          <td class="align-center"><a href="<?php echo urlAdmin('artist', 'del_position',array('id'=>$v['P_Id']));?>" onclick="{if(confirm('确认删除?')){return true;}return false;}">删除</a></td>
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
          <td colspan="16">
            <div class="pagination"> <?php echo $output['page'];?> </div></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>


<script type="text/javascript">
  function up_val(id,id_v){
    var w_val = $(id).text();
    var list_form = '<input type="text" value="'+ w_val +'" size=15 class="listorder_input" />' ;
    $(id).append(list_form); //插入 input框
    $(".listorder_input").focus();
    $(".listorder_input").blur(function(){
        var x_val = $(".listorder_input").val();
        if(w_val != x_val){
          $.ajax({
            type: "GET",
            cache: false,
            url : "index.php?act=artist&op=ajax_up_position",
            data: 'text=' + x_val + '&id=' + id_v,
            success : function(html){
              if(html){
                alert('操作成功');
                $(id).text(html);
              }
            }
          })
        }
      $(".listorder_input").remove();
    })
  }
</script>