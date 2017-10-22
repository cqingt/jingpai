<?php
/**
 * SW CRM����ϵͳV2.0�汾
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������db
 * 
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�db.class.php
 * 
 * @����ʱ�䣺2013-11-19 15:28:17
 * 
 * @���ݿ���
 * 
 */
include($_SERVER['DOCUMENT_ROOT'].'/wx/hd/lib/model/abstract/db.class.php');//�������ݿ������
class mysql extends db{
    private $Host;//���ݿ�IP
	private $DBName;//���ݿ�����
	private $DBUser;//���ݿ��û���
	private $DBPass;//���ݿ��½����
	private $Error;//����ID
	private $LinkID = 0;//���ݿ�����
	private $RowResult = array();//��������������
	private $RowPosition;//��¼ָ��λ������

	protected $QueryID = 0;//��ѯ�����Դ
	protected $DBTable;//���ݿ������
	protected $dbCharSet;//���ݿ����

	/**
	 * @MySql���ݿ⹹�췽��
	 * @���ã���ʼ�����ݿ����Ӳ���
	 */
	public function __construct($dbArr){
		$this->Host=$dbArr['DBHOST'];
		$this->DBUser=$dbArr['DBUSER'];
		$this->DBPass=$dbArr['DBPWD'];
		$this->DBName=$dbArr['DBNAME'];
		$this->dbCharSet=config::$DBGB;

		$this->databaseLink();//ִ�����ݿ����Ӳ���
	}

	/**
	 * @�������ݿ�����
	 */
	protected function databaseLink(){
		if($this->LinkID){ return true ;}
		$this->LinkID = mysql_connect($this->Host,$this->DBUser,$this->DBPass);
		if(!$this->LinkID){ $this->halt("�������ݿ�����ʧ��!"); }
		if(!mysql_select_db($this->DBName,$this->LinkID)) $this->halt("���ܴ�ָ�������ݿ�".$this->DBName);
		mysql_query("SET NAMES '".$this->dbCharSet."'");
	}

	/**
	 * @SQL����������
	 */
	protected function query($sql){
		if(!$sql){ return false;}
		if($this->QueryID){ $this->free(); }//�ж��Ƿ��в�ѯ����������ͷ��ڴ�
		$this->QueryID = mysql_query($sql);
		if(!$this->QueryID){ $this->halt("SQL��ѯ������".$sql); }
		return $this->QueryID;
	}

	/**
	 * @�������ָ��ָ��ָ����
	 */
	protected function seek($Position){
		if(mysql_data_seek($this->QueryID,$Position)){
			$this->RowPosition=$Position;
			return true;
		}else{
			$this->halt("��λ�������������");
			return false;
		}
	}

	/**
	 * @���ؽ������¼�������
	 */
	private function get_rows_array(){
		$this->get_rows();
		for($i=0;$i<$this->Rows;$i++){
			if(!mysql_data_seek($this->Query_ID,$i)) $this->halt("mysql_data_seek��ѯ������");
			$this->Row_Result[$i]=mysql_fetch_array($this->Query_ID);
		}
		return $this->Row_Result;
	}

	/**
	 * @���ؽ������¼����
	 */
	protected function getRows(){
		return mysql_num_rows($this->QueryID);
	}

	/**
	 * @���ؽ�����ֶ���
	 */
	protected function getFields(){
		return mysql_num_fields($this->QueryID);
	}

	/**
	 * @�������������ݿ������ID
	 */
	protected function getInsertID(){
		return mysql_insert_id();
	}

	/**
	 * @��ȡMySql���ݿ�汾
	 */
	protected function version(){
		return mysql_get_server_info();
	}

	/**
	 * @�ͷ����ݿ��ڴ�
	 */
	protected function free(){
		if( !is_resource($this->QueryID) ){
			$this->QueryID = 0;
			return false;
		}
		if( mysql_free_result($this->QueryID) ){
			unset($this->RowResult);//�ͷ��ɽ������ɵ�����
		}
		$this->QueryID = 0;
	}

	/**
	 * @��ӡ������Ϣ
	 */
	private function halt($msg){
		$this->Error=mysql_error();
		printf("<br><b>���ݿⷢ������</b>%s<br>\n",$msg);
		printf("<b>MySQL ���ش�����Ϣ:</b> %s <br>\n",$this->Error);
		die("�ű���ֹ");
	}

	/**
	 * @��ȡ�����ֶ�
	*/
	public  function getFieldName(){
		$this->QueryID = mysql_query("SELECT * FROM ".$this->DBTable."");
		$numfields = $this->getFields();
		for($i=0;$i<$numfields;$i++)
		{
			$fieldArr[] = mysql_field_name($this->QueryID ,$i);
		}
		if(is_array($fieldArr))
		{
			return $fieldArr;
		}else{
			return array();
		}
	}

	/**
	 * @�ر����ݿ�����
	 */
	protected function close(){
		if( is_resource($this->LinkID) ){
			mysql_close($this->LinkID);
		}
	}

	/**
	 * @���幹�캯��
	 * @���ã�����ִ����ɺ�ر����ݿ�����
	 */
	public function __destruct(){
		$this->close();
	}
}
?>
