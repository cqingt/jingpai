<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">



  <div class="fixed-bar">
    <div class="item-title">
      <h3>乐拍管理</h3>
      <ul class="tab-base">
	  <?php if($output['dataArr']['is_rev'] != 1){ ?>
		<li><a href="<?php echo urlAdmin('toupiao', 'index');?>"><span>管理</span></a></li>
        <li><a href="JavaScript:void(0);" class="current" ><span>投票申请</span></a></li>
		<?php }else{ ?>
        <li><a href="JavaScript:void(0);" class="current"><span>管理</span></a></li>
        <li><a href="<?php echo urlAdmin('toupiao', 'shenqing_list');?>" ><span>投票申请</span></a></li>
	  <?php } ?>
      </ul>
    </div>
  </div>



  <div class="fixed-empty"></div>


<form id="user_form" action="index.php?act=toupiao&op=up_toupiao" method="post">
    <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />


    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>





        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="title"><?php echo $lang['member_index_name']?>藏品标题:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input required="required" type="text" value="<?php echo $output['dataArr']['title'];?>" name="title" id="member_name" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>


<tr>
  <td colspan="2" class="required"><label class="validation" for="company_name">藏品图片:</label></td>
</tr>
<tr class="noborder">
  <td class="vatop rowform">
  <?php $img = unserialize($output['dataArr']['img_file']);?>
  <?php foreach($img as $k=>$v){?>
  <img src="http://www.96567.com<?php echo $v;?>" style="width: 60px;height: 60px;">
  <?php } ?>
  </td>
</tr>

<tr>
  <td colspan="2" class="required"><label class="validation" for="contacts_name">藏品年代:</label></td>
</tr>
<tr class="noborder">
  <td class="vatop rowform"><input required="required" type="text" value="<?php echo $output['dataArr']['years'];?>" name="years" class="txt"></td>
</tr>

<tr>
  <td colspan="2" class="required"><label class="validation" for="contacts_name">入手时间:</label></td>
</tr>
<tr class="noborder">
  <td class="vatop rowform"><input required="required" type="text" value="<?php echo $output['dataArr']['data_time'];?>" name="data_time" class="txt"></td>
</tr>

<tr>
  <td colspan="2" class="required"><label class="validation" for="contacts_name">入手价格:</label></td>
</tr>
<tr class="noborder">
  <td class="vatop rowform"><input required="required" type="text" value="<?php echo $output['dataArr']['price'];?>" name="price" class="txt"></td>
</tr>

<tr>
  <td colspan="2" class="required"><label class="validation" for="contacts_name">藏品描述:</label></td>
</tr>
<tr class="noborder">
  <td class="vatop rowform">
  <textarea class="txt" name="contents" rows="" cols="" style="height: 70px;"><?php echo $output['dataArr']['contents'];?></textarea></td>
</tr>
<tr>
  <td colspan="2" class="required"><label class="validation" for="contacts_name">投票数:</label></td>
</tr>
<tr class="noborder">
  <td class="vatop rowform"><input required="required" type="text" value="<?php echo $output['dataArr']['vote_num'];?>" name="vote_num" class="txt"></td>
</tr>

<tr>
  <td colspan="2" class="required"><label class="validation" for="contacts_name">审核状态:</label></td>
</tr>
<tr class="noborder">
  <td class="vatop rowform">
	<input type="radio" name="is_rev" value='0' <?php if($output['dataArr']['is_rev'] == 0){ echo 'checked';}?>>待审核
	<input type="radio" name="is_rev" value='1' <?php if($output['dataArr']['is_rev'] == 1){ echo 'checked';}?>>通过审核
	<input type="radio" name="is_rev" value='2' <?php if($output['dataArr']['is_rev'] == 2){ echo 'checked';}?>>拒绝
  </td>
</tr>
</tbody>

  <tfoot>
	<tr class="tfoot">
	  <td colspan="15"><input type="submit" value="提交"></td>
	</tr>
  </tfoot>


    </table>
  </form>
</div>
