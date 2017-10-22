<?php if (!defined('THINK_PATH')) exit();?>
<style>
.action {
    background: none repeat scroll 0 0 #FFFFFF;
    box-shadow: 1px 1px 3px #666666;
    width: 359px;
}
td{text-align: -webkit-left;}
</style>

	<form action="" method="post" id="realinfo_form">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
		<tbody>
		<tr bgcolor="#F1F1F1">
			<td align="right" height="42" width="">父级菜单：</td>
			<td>
				<div class="mr15 l">
				<select name="pid" id="pid">
					<option  value="0">请选择菜单</option>
					<?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$class): $mod = ($i % 2 );++$i;?><option  value="<?php echo ($class["id"]); ?>" <?php if($show['pid'] == $class['id']): ?>selected<?php endif; ?>><?php echo ($class["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				</div>
			</td>
		</tr>
		<tr>
			<td align="right" height="42" width="">主菜单名称:</td>
			<td>
				<div class="mr15 l">
				<input id="menu_title" class="txt" name="title" title="主菜单名称" value="<?php echo ($show["title"]); ?>" type="text"></div>
				<div class="system l"></div>
			</td>
		</tr>					
		<tr bgcolor="#F1F1F1">
			<td align="right" height="42" width="">关联关键词</td>
			<td>
				<div class="mr15 l"><input id="menu_key" class="txt" name="keyword" title="关联关键词" value="<?php echo ($show["keyword"]); ?>" type="text"></div>
				<div class="system l"></div>
			</td>
		</tr>
		<tr bgcolor="#F1F1F1">
			<td align="right" height="42" width="">外链接url</td>
			<td>
				<div class="mr15 l"><input id="menu_key" class="txt" name="url" title="外链接url" value="<?php echo ($show["url"]); ?>" type="text"></div>
				<div class="system l"></div>
			</td>
		</tr>
		<tr>
			<td align="right" height="42">显示：　</td>
			<td>
				<div class="mr15 l">
				<input type="radio" name="is_show" <?php if($show['is_show'] == 1): ?>checked="checked"<?php endif; ?> value="1">是&nbsp;
				<input type="radio" name="is_show" <?php if($show['is_show'] == 0): ?>checked="checked"<?php endif; ?> value="0">否&nbsp;
				</div>
				<div class="system l"></div>
			</td>
		</tr>
		<tr bgcolor="#F1F1F1">
			<td align="right" height="42">排序:</td>
			<td>
				<div class="mr15 l">
				<input id="sort" class="txt" name="sort" title="排序" value="<?php echo ($show["sort"]); ?>" type="text"></div>
				<div class="system l"></div>
			</td>
		</tr>
		<tr>
			<td height="42">&nbsp;</td>
			<td>
				<input class="btn" type="submit" name="submit" value="提交">
			</td>
		</tr>
			
	</tbody></table>
</form>