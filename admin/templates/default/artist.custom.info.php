<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<div class="page">

  <div class="fixed-bar">
    <div class="item-title">
      <h3>定制信息</h3>
      <ul class="tab-base">
        <li><a href="<?php echo urlAdmin('artist','artistGoodsCustom');?>" ><span>所有信息</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>定制信息</span></a></li>

      </ul>
    </div>
  </div>

  <div class="fixed-empty"></div>


  <form id="rec_form" enctype="multipart/form-data" method="POST" action="index.php?act=artist&op=add_artist">
    <table class="table tb-type2">

      <tbody>
          
        <tr class="noborder">
          <td colspan="2" class="required"><h3><?php if($output['custom_info']['C_CustomType'] == 1){echo '艺术家定制';}else{echo '个性定制';}?></h3></td>
        </tr>



      <?php if($output['custom_info']['C_CustomType'] == 1){?>

        <tr class="noborder">
          <td colspan="2" class="required"><label>艺术家名称:</label></td>
        </tr>

        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="A_Name" id="A_Name" value='<?php echo $output['custom_info']['C_ArtistName'];?>' class="txt"></td>
          <td class="vatop tips">艺术家名称</td>
        </tr>

      <?php }?>
        
        <tr class="noborder">
          <td colspan="2" class="required"><label>类型:</label></td>
        </tr>

        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="A_Name" id="A_Name" value='<?php echo $output['custom_info']['C_LeiXing'];?>' class="txt"></td>
          <td class="vatop tips">类型</td>
        </tr>

        <tr class="noborder">
          <td colspan="2" class="required"><label>尺寸:</label></td>
        </tr>

        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="A_Name" id="A_Name" value='<?php echo $output['custom_info']['C_ChiCun'];?>' class="txt"></td>
          <td class="vatop tips">尺寸</td>
        </tr>


        <?php if($output['custom_info']['C_CustomType'] == 2){?>

        <tr class="noborder">
          <td colspan="2" class="required"><label>价格:</label></td>
        </tr>

        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="A_Name" id="A_Name" value='<?php echo $output['custom_info']['C_Money'];?>' class="txt"></td>
          <td class="vatop tips">价格</td>
        </tr>

      <?php }?>


      <tr class="noborder">
          <td colspan="2" class="required"><label>手机:</label></td>
        </tr>

        <tr class="noborder">
          <td class="vatop rowform"><input type="text" name="A_Name" id="A_Name" value='<?php echo JieMiMobile($output['custom_info']['C_Mobile']);?>' class="txt"></td>
          <td class="vatop tips">手机</td>
        </tr>


        <tr class="noborder">
          <td colspan="2" class="required"><label>定制需求:</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform"><textarea name="A_JieShao" rows="6" class="tarea" id="A_JieShao"><?php echo $output['custom_info']['C_XuQiu'];?></textarea></td>
            <td class="vatop tips">定制需求</td>
        </tr>


        
      </tbody>


    <!--   <tfoot>
        <tr class="tfoot">
          <td colspan="15" ><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot> -->
    </table>
  </form>



</div>
