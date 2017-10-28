<?php if (!defined('THINK_PATH')) exit();?>﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<title>投票参数设置</title>
</head>
<style>
	.index_box{
		max-width: 640px;
	  	min-width: 320px;
	  	width: 100%;
	  	display: block;
	  	overflow: hidden;
	  	margin: 0 auto;
		word-break:break-word;
	}

	.setPiao{
		width: 100%;
		max-height: 100px;
  		min-height: 50px;
	}

	.setTable{
		width: 100%;
	}

	.setTableTd1{
		width: 20%;
	}

	.setTableTd2{
		width: 60%;
	}

	.setTableTd3{
		width: 20%;
	}

	.setTr{
		height:50px;
	}
</style>
<body>

<div class="index_box">

	<form action="<?php echo U('Home/Nianhui/doSetJm');?>" method="post">

	<?php if($getJm["S_Type"] == 1): ?><input type="hidden" name="type" value="0"/>
		<input class="setPiao" type="submit" value="关闭签到"/> <br/>
	<?php else: ?>
		<input type="hidden" name="type" value="1"/>
		<input class="setPiao" type="submit" value="开启签到"/> <br/><?php endif; ?>	

	

	</form>

	<br/>

	<table class="setTable">

		<tr class="setTr">
			<td class="setTableTd1">编号</td>
			<td class="setTableTd2">节目名称</td>
			<td class="setTableTd3">操作</td>
		</tr>
	
	<?php if(is_array($result)): foreach($result as $key=>$v): ?><tr class="setTr">
			<td class="setTableTd1"><?php echo ($v["J_Number"]); ?></td>
			<td class="setTableTd2"><?php echo ($v["J_Name"]); ?></td>
			<td class="setTableTd3">

			<?php if($v["J_Type"] == 1): ?><input onclick="setJmType(<?php echo ($v["J_Id"]); ?>,<?php echo ($v["J_Type"]); ?>);" type="button" value="关闭投票"/>
			<?php else: ?>
				<input onclick="setJmType(<?php echo ($v["J_Id"]); ?>,<?php echo ($v["J_Type"]); ?>);" type="button" value="开启投票"/><?php endif; ?>

			</td>
		</tr><?php endforeach; endif; ?>

	</table>

</div>
</body>
<script>
	function setJmType(id,val){
		window.location.href="http://m.96567.com/wx/index.php?g=Home&m=Nianhui&a=doSetPiao&id="+id+"&val="+val;
	}
</script>
</html>