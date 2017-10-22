<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">



  <div class="fixed-bar">
    <div class="item-title">
      <h3>乐拍管理</h3>
      <ul class="tab-base">
        
       <li><a href="<?php echo urlAdmin('lepai', 'index');?>"><span>用户管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'adduser');?>"><span>用户添加</span></a></li>
        <li><a href="JavaScript:void(0);" class="current" ><span>送拍信息</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'goods');?>" ><span>拍品管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'theme');?>" ><span>专场管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'order');?>" ><span>订单管理</span></a></li>

      </ul>
    </div>
  </div>



  <div class="fixed-empty"></div>





    <table class="table tb-type2">
      <tbody>





<tr class="noborder">
  <td colspan="2" class="required"><label class="validation" for="member_name"><?php echo $lang['member_index_name']?>送拍类型:</label></td>
</tr>
<tr class="noborder">
  <td class="vatop rowform"><input required="required" type="text" value="<?php echo $output['oneInfo']['I_Class'];?>" name="member_name" id="member_name" class="txt"></td>
  <td class="vatop tips"></td>
</tr>


<tr>
  <td colspan="2" class="required"><label class="validation" for="company_name">价格区间:</label></td>
</tr>
<tr class="noborder">
  <td class="vatop rowform"><input required="required" type="text" value="<?php echo $output['oneInfo']['I_Money'];?>" id="company_name" name="company_name" class="txt"></td>
  <td class="vatop tips"></td>
</tr>

<tr>
  <td colspan="2" class="required"><label class="validation" for="contacts_name">卖家姓名:</label></td>
</tr>
<tr class="noborder">
  <td class="vatop rowform"><input required="required" type="text" value="<?php echo $output['oneInfo']['I_Name'];?>" id="contacts_name" name="contacts_name" class="txt"></td>
  <td class="vatop tips"></td>
</tr>

<tr>
  <td colspan="2" class="required"><label class="validation" for="contacts_phone">卖家电话:</label></td>
</tr>
<tr class="noborder">
  <td class="vatop rowform"><input required="required" type="text" value="<?php echo $output['oneInfo']['I_Phone'];?>" id="contacts_phone" name="contacts_phone" class="txt"></td>
  <td class="vatop tips"></td>
</tr>

<tr>
  <td colspan="2" class="required"><label class="validation" for="company_address">所在地区:</label></td>
</tr>
<tr class="noborder">
  <td class="vatop rowform"><input required="required" type="text" value="<?php echo $output['oneInfo']['I_Dizhi'];?>" id="company_address" name="company_address" class="txt"></td>
  <td class="vatop tips"></td>
</tr>


<tr>
  <td colspan="2" class="required"><label class="validation" for="company_address">备注信息:</label></td>
</tr>

<tr class="noborder">
  <td class="vatop rowform"><input required="required" type="text" value="<?php echo $output['oneInfo']['I_Remark'];?>" id="commis_rate" name="commis_rate" class="txt"></td>
  <td class="vatop tips"></td>
</tr>




      </tbody>



    </table>
  </form>
</div>
