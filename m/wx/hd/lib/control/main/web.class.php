<?php
/**
 * SW ��ҳ
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
 * @�ļ����ƣ�main.class.php
 * 
 * @����ʱ�䣺2014-7-28 15:00:00
 * 
 * @��ҳ
 * 
 */
class web extends model{
	protected $sFu;
	public function __construct(){
		parent::__construct();
		$this->c->table('user');
	}
	
	public function index(){
		$total = $this->c->sumRows();
		$dataArr = $this->c->search('','time DESC',100);
		$dataNumArr = $this->c->search('','fu DESC',20);
		$this->tpl('total',$total);
		$this->tpl('dataArr',$dataArr);
		$this->tpl('dataNumArr',$dataNumArr);
		$this->display('tpl/wanfu/wanfu.html');
	}
}

?>