<?php
/**
 * SW ǰ̨���ƺ������
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������main
 * 
 * @���ܣ�ǰ̨���ƺ������
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�base.class.php
 * 
 * @����ʱ�䣺2014-7-28 15:00:00
 * 
 * @ǰ̨���ƺ������
 * 
 */
require_once(dirname(__FILE__)."/public/weixinAPI.class.php");
require_once(dirname(__FILE__)."/public/logcat.class.php");
require_once(dirname(__FILE__)."/public/user.class.php");
class base extends model{
	protected $user;//�û�������
	protected $userArr;//�û�������
	protected $noArr = array('receive','complete');

	public function __construct(){
		parent::__construct();
		$this->getConfigData();
		
		//��ȡopenid
		$this->user = new user($this->c);
		$this->user->getOpenid();

		//����΢���û���Ϣ
		$this->userArr = $this->user->getWeixinInfo($_COOKIE['openid']);
		$this->tpl('userArr',$this->userArr);
		$this->fuComplete();//����Ƿ��

		$this->tpl('rank',$this->user->rank($this->userArr['openid']));
	}

	/*
		@����Ƿ�ִ����ɼ���ҳ��ת��
	*/
	private function fuComplete(){
		if(G('c',2)!='show' && G('c',2)!='fenxiang' && G('c',2)!='lingqu'){
			if($this->userArr['fu']>=100 && !$this->userArr['isOver'] && !in_array(G('c',2),$this->noArr)){
				show('��ϲ���Ѿ���ü�ֵǧԪ�ĸ���Ŷ','index.php?m=main&c=complete&p=main');
			}
		}
	}

	/*
		@���س�ʼ����������
	*/
	private function getConfigData(){
		$this->tpl('Domain',W_DOMAIN);//���طֹ�˾����
		$this->tpl('DIR',DIR_MAIN);//����ģ��·��
		$this->tpl('COMPANY',W_COMPANY);//���طֹ�˾����
		$this->tpl('LOGO',W_LOGO);//������֤ģʽ
		$this->tpl('YEAR',date('Y'));
		$this->tpl('FolderName',$this->FolderName);//���طֹ�˾ͼƬĿ¼
	}
	
	/*
		@�������
	*/
	protected function toString($filename=''){
		$this->filename=$filename ? $filename : $this->filename;
		$filepath = 'tpl/wanfu/'.$this->filename;
		if($this->filename){ $this->display($filepath);	}
	}
}
?>