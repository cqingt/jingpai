<?php
/**
 * Title:���˲��ͱ༭��PHP���װ��
 * coder:gently
 * Date:2007��11��9��
 * Power by ZendStudio.Net
 * http://www.zendstudio.net/
 * ����������ʹ�úʹ��������뱣��������Ϣ��
 *
 */
class sinaEditor{
	var $BasePath;
	var $Width;
	var $Height;
	var $eName;
	var $Value;
	var $AutoSave;
	function sinaEditor($eName){
		$this->eName=$eName;
		$this->BasePath='.';
		$this->AutoSave=true;
		$this->Height=460;
		$this->Width=630;
	}
	function __construct($eName){
		$this->sinaEditor($eName);
	}
	function Create(){
		$ReadCookie=$this->AutoSave?1:0;
		$edit= <<<eot
		<textarea name="{$this->eName}" id="{$this->eName}" style="display:none;">{$this->Value}</textarea>
		<iframe src="{$this->BasePath}/SinaEdit/editor.htm?id={$this->eName}&ReadCookie={$ReadCookie}" frameBorder="0" marginHeight="0" marginWidth="0" scrolling="No" width="{$this->Width}" height="{$this->Height}"></iframe>
eot;
		return $edit;
	}
}