<?php
/**
 * SW CRM����ϵͳV2.0�汾
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������manageSystem
 * 
 * @���ܣ�ϵͳվ��������
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�manageSystem.class.php
 * 
 * @����ʱ�䣺2013-11-29 16:28:17
 * 
 * @ϵͳ������
 * 
 */
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/../../plugins/tool.class.php");
require_once(dirname(__FILE__)."/../../plugins/edit.class.php");
require_once(dirname(__FILE__)."/../../model/class/Upload.class.php");

class manageSystem extends manage{

	public function __construct(){
		parent::__construct();
		$this->c->table('system_info');
		$this->Number = W_NUMBER;
		$this->filename = 'system.html';
	}

	/**
	 * @ Ĭ�������෽��
	 */
	public function index(){
		$this->showUpdateSystem();//����ϵͳ��Ϣ

		//���ؿ��ñ༭���б�
		$edit = new editClass;
		$this->tpl('editArr',$edit->getEditArr());
	}

	/**
	 * @ ����ϵͳ��Ϣ�����
	 */
	private function showUpdateSystem(){
		if(!$this->Number){ return false;}//�̻���Ϊ�գ���ִ����Ϣ����
		$this->tpl('update',1);
		$this->tpl('dataArr',$this->getSystemInfo());
	}

	/**
	 * @ ����ϵͳ��ϸ��Ϣ
	 */
	private function getSystemInfo(){
		$fields = "*,(SELECT E_Content FROM sw_event WHERE E_EventTitle='subscribe') as EventContent";
		$dataArr = $this->c->search("W_Number='".$this->Number."'",'','',$fields);
		return $dataArr[0];
	}


	/**
	 * @ ����ϵͳ��Ϣ
	 */
	public function updateSystem(){
		$domain= G('W_Domain');
		//$dataArr['W_Contact'] = G('W_Contact');
		//$dataArr['W_Mobile'] = G('W_Mobile');
		$dataArr['W_Domain'] = G('W_Domain');
		$dataArr['W_Company'] = G('W_Company');
		$dataArr['W_Name'] = G('W_Name');
		$dataArr['W_Mail'] = G('W_Mail');
		$dataArr['W_Province'] = G('W_Province',1,2);
		$dataArr['W_City'] = G('W_City',1,2);
		$dataArr['W_Adress'] = G('W_Adress');
		$dataArr['W_Edit'] = G('W_Edit');

		$dataArr['W_ONLineSell'] = G('W_ONLineSell'); // ���Ͻ���������  ����
		$dataArr['W_ONLineBuy'] = G('W_ONLineBuy'); // ���Ͻ���������  ���

		$dataArr['W_NextLineSell'] = G('W_NextLineSell'); // ���½��������� ����
		$dataArr['W_NexLineBuy'] = G('W_NexLineBuy'); // ���½��������� ���

		//ͼƬ�ϴ�����
		$img = $this->logoUpload($domain);
		if($img){ $dataArr['W_Logo'] = $img; }

		$this->c->update($dataArr,"W_Number='".$this->Number."'");//�����̻���Ϣ

		//д���ע�ظ�����
		$this->subscribe(G('E_Content',1,1,1));

		//�����̻������ļ�
		$this->createSystemConfig($this->Number);

		show('ϵͳ���³ɹ�!');
	}

	/**
	 * @ �����̻������ļ�
	 */
	private function createSystemConfig($Number){
		tool::createConfig($Number);
	}

	/**
	 * @ д��ϵͳ�˵�
	 */
	private function writeSystemMenu($number,$menu=0){
		$this->c->table('system_menu');
		$this->c->insert(array('W_Number'=>$number,'W_Menu'=>$menu));
	}

	/**
	 * @ �˵���������
	 */
	static public function levelToStr($Array){
		if(!is_array($Array)){return false;}//��֤�Ƿ�Ϊ����
		foreach($Array as $k=>$v){
			if(strpos($v,':')){//�ж�����Ԫ���Ƿ�ΪID��˵����ӵ�ַ���
				$TempArr=explode(':',$v);//��ֲ˵���ַ�Ͳ˵�ID
				$Arr[$TempArr[0]]=$TempArr[1];//���˵�ID��Ϊ�±꣬�˵���ַ��ΪԪ��ֵ��ϳ�����
			}else{//������ǲ˵�ID��˵����������ֱ�ӽ��˵�ID��Ϊ�±겢�����ֵ
				$Arr[$v]='';
			}
		}
		return json_encode($Arr);
	}

	/**
	 * @ �̻�Logo�ϴ�
	 */
	private function logoUpload($domain){
		$imgArr = G('img',4);
		$filepath = 'static/upload/images/'.domain2folder($domain).'/logo';
		if($imgArr['name']){
			$upload = new upload($imgArr,$filepath,0);
			$upload->filename = 'logo';
			return $upload->upimg();
		}else{
			return false;
		}
	}

	/**
	 * @ ΢�Ź�ע�ظ������趨
	 */
	private function subscribe($content,$event='subscribe',$type='text'){
		if(!$content){ return false; }
		$this->c->table('event');
		$where = "E_EventTitle='".$event."'";
		$num = $this->c->sumRows($where);
		if($num){
			$this->c->update(array('E_Content'=>$content),$where);
		}else{
			$this->c->insert(array('E_EventTitle'=>$event,'E_Content'=>$content,'E_Type'=>$type));
		}
	}

	/**
	 * @ ����ϵͳ��������
	 */
	public function __destruct(){
		$this->toString();
	}
}
?>