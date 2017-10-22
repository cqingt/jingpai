<?php
/**
 * SW CRM����ϵͳV2.0�汾
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������manageMenu
 * 
 * @���ܣ��˵�����������
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�manageMenu.class.php
 * 
 * @����ʱ�䣺2013-11-19 15:28:17
 * 
 * @�˵���
 * 
 */
require_once(dirname(__FILE__)."/manage.class.php");
require_once(dirname(__FILE__)."/../../model/class/menu.class.php");
class manageMenu extends manage{

	public function __construct(){
		parent::__construct();
		$this->c->table('managecate');
		$this->filename='menu.html';
	}

	/**
	 * @ Ĭ�������෽��
	 */
	public function index(){
		$tid = G('tid',2,2);
		$this->tpl('menuArr',manageMenu::getMenuArr($this->c));
		$this->tpl('tid',$tid);
		$this->toString();
	}

	/**
	 * @ ��ȡȫ���˵����ݣ����������νṹ����
	 */
	static public function getMenuArr($db){
		$menu = new menu($db,1);
		foreach(config::$UserMenuConfigArr as $k=>$v){
			$temp[$k]['menuName'] = $v; 
			$temp[$k][] = $menu->getMenu('C_Type',$k);
		}
		return $temp;
	}

	/**
	 * @ ��ȡָ��ID�Ĳ˵�����
	 */
	static public function getMenuSelect($db,$idArr){
		if(is_array($idArr) && count($idArr)){
			$menu = new menu($db,1);
			foreach(config::$UserMenuConfigArr as $k=>$v){
				$arr = $menu->getMenuID($k,join(',',$idArr));
				if(count($arr)){//����¼��Ƿ��в˵�
					$temp[$k]['menuName'] = $v; 
					$temp[$k][] = $arr;
				}
			}		
		}
		return $temp;
	}

	/**
	 * @ �˵�д�����
	 */
	public function addMenu(){
		$dataArr['C_CateName'] = G('C_CateName');
		$dataArr['C_Link'] = G('C_Link');
		$dataArr['C_Level'] = G('C_Level',1,2);
		$dataArr['C_Type'] = G('C_Type',1,2);
		$this->c->insert($dataArr);
		show('��ӳɹ�','index.php?m=manageMenu&p=manage&tid='.$dataArr['C_Type']);
	}

	/**
	 * @ �˵�ɾ������
	 */
	public function delMenu(){
		$tid = G('tid',2,2);
		$type = G('type',2,2);
		$num = $this->getSubMenuQuantity($tid);
		if($num){
			show('�ò˵��������Ӳ˵��޷�ɾ��');
		}else{
			$this->c->del('C_ID',$tid);
		}
		show('ɾ���ɹ�!','index.php?m=manageMenu&p=manage&tid='.$type);
	}

	/**
	 * @ �˵�ɾ������
	 */
	private function getSubMenuQuantity($tid){
		return $this->c->sumRows("C_Level='".$tid."'");
	}

	/**
	 * @ �˵�������ʾ����
	 */
	public function popMenuUpdate(){
		$tid = G('tid',2,2);
		$dataArr = $this->c->search("C_ID='".$tid."'");
		$this->tpl('dataArr',$dataArr[0]);
		$this->tpl('menuArr',manageMenu::getMenuArr($this->c));

		$this->toString('pop/popMenuUpdate.html');
	}

	/**
	 * @ �˵���Ϣ���½���
	 */
	public function updateMenu(){
		$tid = G('C_ID',1,2);
		$dataArr['C_CateName'] = G('C_CateName');
		$dataArr['C_Type'] = G('C_Type',1,2);
		$dataArr['C_Level'] = G('C_Level',1,2);
		$dataArr['C_Link'] = G('C_Link');
		$dataArr['C_Sort'] = G('C_Sort',1,2);

		$this->c->update($dataArr,"C_ID='".$tid."'");
		show('���ĳɹ�!','index.php?m=manageMenu&p=manage&tid='.$type);
	}
	
	/**
	 * @ Ajaxģʽ��ȡָ��һ���˵���ȫ�������˵�
	 */
	public function ajaxGetSmallMenu(){
		$cid = G('cid',2,2);
		$tid = G('tid',2,2);
		if(!$tid){ $selected = 'selected="selected"'; }
		$dataArr = $this->c->search("C_Type='".$cid."' AND C_Level=0");
		$optionArr = createSelectOption($dataArr,'C_CateName','C_ID',$tid);
		echo "<option value='' ".$selected.">һ���˵�</option>\n".$optionArr;
	}


}
?>