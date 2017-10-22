<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161210/css/main.css"/>
<link rel="stylesheet" type="text/css" href="http://m.96567.com/templates/default/css/reset.css">
<link rel="stylesheet" type="text/css" href="http://m.96567.com/templates/default/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="http://m.96567.com/templates/default/css/main.css">
<link rel="stylesheet" type="text/css" href="http://m.96567.com/templates/default/css/member.css">

<table width="100%" border="1" cellspacing="0" cellpadding="2" bordercolor="#009900">

<form action="/index.php?act=zhuanti&op=ad_20161210_admin" method="post">
	<tr style="height:80px;">
		<td colspan="3">      			
      		<input type="tel" name="mob_phone" id="mob_phone" maxlength='11' onkeyup="value=value.replace(/[^\d]/g,'')" placeholder="请输入手机号!" />
		</td>
		<td><input type="submit" style="width:50px; height:30px;"></td>
	</tr>
</form>
	

	<tr style="height:50px;">
	</tr>


<?php if(!empty($output['list'])){?>
	<?php foreach ($output['list'] as $k => $v){?>
	<tr style="height:35px;">
		<td><?php echo $v['U_Id'];?></td>
		<td><?php echo $v['U_Name'];?></td>
		<td><?php echo $v['U_Mobile'];?></td>
		<td>
			<?php if($v['U_Type'] == 1){?>
			<a href="http://m.96567.com/index.php?act=zhuanti&op=ad_20161210_admin&U_Id=<?php echo $v['U_Id'];?>">点击确认</a>
			<?php }else{?>
			已领取
			<?php }?>
		</td>
	</tr>
	<?php }?>
<?php }?>

	<tr style="height:35px;">
		<td colspan="4"><?php echo $output['page'];?>
</td>
	</tr>

</table>

