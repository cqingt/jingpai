<?php
/**
 * SW CRM����ϵͳV2.0�汾
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������order
 * 
 * @���ܣ���������
 *
 * @�����ˣ�ʢ��
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�order.class.php
 * 
 * @����ʱ�䣺2014-9-13 15:28:17
 * 
 * @��������
 * 
 */
require_once(dirname(__FILE__)."/../../model/class/PageTurn.class.php");
require_once(dirname(__FILE__)."/manage.class.php");
class lt extends manage{
	public function __construct(){
		parent::__construct();
	}

	/**
	 * @ �����б�
	 */
	public function index(){
		$file = file('order.txt');
		foreach($file as $v){
			$arr = explode(' ',$v);
			$mobile = trim(str_replace("\n","",$arr[2]));
			$dataArr['name'] = $arr[0];
			$dataArr['address'] = $arr[1];
			$this->c->table('jiang');
			$dataArr1 = $this->c->search("mobile='".$mobile."'");
			if(!empty($dataArr1)){
				$this->c->update($dataArr,"mobile='".$mobile."'");
				$dataArr2['name'] = $arr[0];
				$dataArr2['address'] = $arr[1];
				$dataArr2['uid'] = $dataArr1[0]['id'];
				$this->createOrder($dataArr2);
				$strID .= "\n".$dataArr2['uid'];
			}
		}
	}

	/**
	 * @ ��������
	 */
	private function createOrder($dataArr){
		$this->c->table('order');
		$num = $this->c->sumRows("uid='".$dataArr['uid']."'");
		if(!$num){
			$arr['uid'] = $dataArr['uid'];
			$arr['order_sn'] = date('YmdHis').rand(1000,9999);
			$arr['name'] = $dataArr['name'];
			$arr['province'] = 0;
			$arr['city'] = 0;
			$arr['address'] = $dataArr['address'];
			$arr['type'] = 1;
			$arr['express'] = '�ؿ�ר��';
			$arr['express_sn'] = 1;
			$arr['status'] = 2;
			$arr['time'] = time();
			$this->c->insert($arr);
		}
	}
}
?>	