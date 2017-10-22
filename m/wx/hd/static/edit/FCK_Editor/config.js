/*
Copyright (c) 2003-2012, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/

CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
config.language = 'zh-cn'; // 配置语言   

config.uiColor = '#FFF'; // 背景颜色   
//config.width = '100%'; // 宽度   
//config.height = '300px'; // 高度   
config.skin = 'v2';// 界面v2,kama,office2003   
config.filebrowserBrowseUrl = '/static/edit/FCK_Editor/CK_UP/ckfinder.html';
config.filebrowserImageBrowseUrl = '/static/edit/FCK_Editor/CK_UP/ckfinder.html?type=Images';
config.filebrowserFlashBrowseUrl = '/static/edit/FCK_Editor/CK_UP/ckfinder.html?type=Flash';
config.filebrowserUploadUrl = '/static/edit/FCK_Editor/CK_UP/core/connector/php/connector.php?command=QuickUpload&type=File';
config.filebrowserImageUploadUrl = '/static/edit/FCK_Editor/CK_UP/core/connector/php/connector.php?command=QuickUpload&type=Images';
config.filebrowserFlashUploadUrl = '/static/edit/FCK_Editor/CK_UP/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};
