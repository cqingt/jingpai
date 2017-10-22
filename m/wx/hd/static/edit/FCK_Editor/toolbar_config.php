<?php
		$CKEditor->config['toolbar']=array(
			//Source源码，Save保存，NewPage新建，Preview预览，Templates模板
			array('Source','-','Preview','-','Templates'),
			//Cut剪切，Copy复制，Paste粘贴，PasteText粘贴为无格式文本，PasteFromWord从MS Word粘贴，Print打印，SpellChecker拼写检查，Scayt即时拼写检查
			array('Cut','Copy','Paste','PasteText','PasteFromWord','-','Print'),
			//Form表单，Checkbox复选框，Radio单选框，TextField单选文本，Textarea多行文本，Select列表/菜单，Button按钮，ImageButton图像域，HiddenField隐藏域
			//BidiLtr文字方向为从左至右，BidiRtl文字方向为从右至左
			array('BidiLtr', 'BidiRtl'),
			//Bold加粗，Italic倾斜，Underline下划线，Strike删除线，Subscript下标，Superscript上标
			array('Bold','Italic','Underline','Strike','-','Subscript','Superscript'),
			//NumberedList编号列表，BulletedList项目列表，Outdent减少缩进量，Indent增加缩进量，Blockquote块引用，CreateDiv创建DIV容器
			array('NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'),
			//JustifyLeft左对齐，JustifyCenter居中，JustifyRight右对齐，JustifyBlock两端对齐
			array('JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
			//Link插入/编辑超链接，Unlink取消超链接，Anchor插入/编辑锚点链接
			array('Link','Unlink','Anchor'),
			//Image图像，Flash Flash，Table表格，HorizontalRule插入水平线，Smiley表情符，SpecialChar插入特殊符号，PageBreak插入分页符
			array('Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'),
			//Styles样式，Format格式，Font字体，FontSize字号
			array('Styles','Format','Font','FontSize'),
			//TextColor文本颜色，BGColor背景颜色
			array('TextColor','BGColor'),
			//Maximize全屏，ShowBlocks显示区块，About关于Editor
			array('Maximize', 'ShowBlocks','-','About'),
		);
?>