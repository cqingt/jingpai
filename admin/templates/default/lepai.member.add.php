<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">



  <div class="fixed-bar">
    <div class="item-title">
      <h3>乐拍管理</h3>
      <ul class="tab-base">
        
		 <li><a href="<?php echo urlAdmin('lepai', 'index');?>"><span>用户管理</span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>用户添加</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'songpai');?>" ><span>送拍信息</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'goods');?>" ><span>拍品管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'theme');?>" ><span>专场管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'order');?>" ><span>订单管理</span></a></li>

      </ul>
    </div>
  </div>



  <div class="fixed-empty"></div>


<?php if(!$output['sel']){?>
  <form id="user_form" action="index.php?act=lepai&op=doAddUser" method="post">
<?php }else{?>
  <form id="user_form" action="index.php?act=lepai&op=doSaveUser" method="post">



    <input type="hidden" name="themeid" value="<?php echo $_GET['themeid'];?>" />
<?php }?>






    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>





        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="member_name"><?php echo $lang['member_index_name']?>名称:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input required="required" type="text" value="<?php echo $output['result']['0']['member_name'];?>" name="member_name" id="member_name" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>


<tr>
  <td colspan="2" class="required"><label class="validation" for="company_name">机构名称:</label></td>
</tr>
<tr class="noborder">
  <td class="vatop rowform"><input required="required" type="text" value="<?php echo $output['result']['0']['company_name'];?>" id="company_name" name="company_name" class="txt"></td>
  <td class="vatop tips"></td>
</tr>

<tr>
  <td colspan="2" class="required"><label class="validation" for="contacts_name">联系人:</label></td>
</tr>
<tr class="noborder">
  <td class="vatop rowform"><input required="required" type="text" value="<?php echo $output['result']['0']['contacts_name'];?>" id="contacts_name" name="contacts_name" class="txt"></td>
  <td class="vatop tips"></td>
</tr>

<tr>
  <td colspan="2" class="required"><label class="validation" for="contacts_phone">联系电话:</label></td>
</tr>
<tr class="noborder">
  <td class="vatop rowform"><input required="required" type="text" value="<?php echo $output['result']['0']['contacts_phone'];?>" id="contacts_phone" name="contacts_phone" class="txt"></td>
  <td class="vatop tips"></td>
</tr>

<tr>
  <td colspan="2" class="required"><label class="validation" for="company_address">机构地址:</label></td>
</tr>
<tr class="noborder">
  <td class="vatop rowform"><input required="required" type="text" value="<?php echo $output['result']['0']['company_address'];?>" id="company_address" name="company_address" class="txt"></td>
  <td class="vatop tips"></td>
</tr>


<tr>
  <td colspan="2" class="required"><label class="validation" for="company_address">佣金比例:</label></td>
</tr>

<tr class="noborder">
  <td class="vatop rowform"><input required="required" type="text" value="<?php echo $output['result']['0']['commis_rate'];?>" id="commis_rate" name="commis_rate" class="txt">%</td>
  <td class="vatop tips"></td>
</tr>




      </tbody>

<?php if(!$output['sel']){?>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15"><input type="submit" value="提交"></td>
        </tr>
      </tfoot>
<?php }else{?>
    <tfoot>
        <tr class="tfoot">
          <td colspan="15"><input type="submit" value="修改"></td>
        </tr>
      </tfoot>
<?php }?>

    </table>
  </form>
</div>
