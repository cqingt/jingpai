<?php
class editClass{
	
	/*
		@���ؿ��ñ༭��
	*/
	public function getEditArr(){
		$str = file_get_contents('lib/plugins/edit.class.php');
		preg_match_all('/static public function ?(get)(.*?)\(/',$str,$arr);
		return $arr[2];
	}

	/*
		@����FCK�༭��
	*/
	static public function getFckEdit($name,$w,$h,$value=''){
		$w = '100%';
		include("static/edit/FCK_Editor/ckeditor.php");
		/* ȡ�õ�ǰ�ļ�·��+�ļ��� */
		$sBasePath="static/edit/FCK_Editor/";
		$CKEditor = new CKEditor();
		/* ָ��ckeditor��Ŀ¼λ�� */
		$CKEditor->basePath = $sBasePath;
		/* ָ���߿� */
		$CKEditor->config['width'] = $w;
		$CKEditor->config['height'] = $h;
		include('static/edit/FCK_Editor/toolbar_config.php');//����༭��������������
		return $CKEditor->getEditor($name, $value);
	}

	/*
		@����Sina�༭��
	*/
	static public function getSinaEdit($name,$w,$h,$value=''){
		include("lib/model/class/SinaEditor.class.php");
		$editor=new sinaEditor($name);
		$editor->BasePath='static/edit';
		$editor->Height=$h;
		$editor->Width=$w;
		$editor->AutoSave=false;
		$editor->Value=$value;
		return $editor->Create();
	}

	/*
		@����Kind�༭��
	*/
	static public function getKindEdit($name,$w,$h,$value=''){
		$editCss = '<link rel="stylesheet" href="static/edit/KindEditor/themes/default/default.css" />';
		$editJs = '<script charset="utf-8" src="static/edit/KindEditor/kindeditor-min.js"></script>';
		$editJs .= '<script charset="utf-8" src="static/edit/KindEditor/lang/zh_CN.js"></script>';
		$js = "\n<script>
			$(function() {
				var editor = KindEditor.create('textarea[name=\"".$name."\"]');
			});
		</script>\n";
		$input = $editCss.$js."\n".$editJs."\n";
		$input .= '<textarea id="'.$name.'" name="'.$name.'" style="width:'.$w.'px;height:'.$h.'px;">'.$value.'</textarea>';
		return $input;
	}

	/*
		@����QQ�༭��
	*/
	static public function getCETEdit($name,$w,$h,$value=''){
		$edit= <<<eot
				<textarea name="{$name}" cols="80" rows="2" style="display:none">{$value}</textarea>
				<iframe ID="{$name}" name="{$name}" src="static/edit/CET_Edit/edit.html?ubb=1&id={$name}" frameBorder="0" marginHeight="0" marginWidth="0" scrolling="No" width="{$w}" height="{$h}"></iframe>
eot;
		return $edit;
	}
}

?>