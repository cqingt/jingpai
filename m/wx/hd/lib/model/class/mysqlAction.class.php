<?php
/**
 * SW CRM����ϵͳV2.0�汾
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������mysqlAction
 * 
 * @���ܣ�mysql������ɾ�Ĳ����
 *
 * @�����ˣ�����
 * 
 * ��ϵQQ��9132761
 * 
 * @�ļ����ƣ�mysqlAction.php
 * 
 * @����ʱ�䣺2013-11-19 17:26:37
 * 
 */
include('mysql.class.php');
include('createSql.class.php');
class mysqlAction extends mysql{
	private $Prefix;//��ǰ׺
	private $Debug = 1;//�Ƿ�������ģʽ,0�رգ�1����

	public function __construct($dbArr,$tableName=''){
		parent::__construct($dbArr);
		$this->Prefix = $dbArr['Prefix'];
		if($tableName){ $this->table($tableName); }//Ĭ�ϲ������ݿ��ֵ
	}

	/**
	 *	@����sql���ִ�в���
	 */
	public function execute($sql){
		$this->query($sql);
	}

	/**
	 *	@�������
	 */
	public function table($tableName){
		if(!$tableName){ return $tableName; }
		$tableName = $this->Prefix.str_replace(',',','.$this->Prefix,$tableName);
		$this->DBTable = $tableName;
	}

	/**
	 *	@�������
	 *
	 *  @���ݲ�ѯ����
	 */
	public function search($where='',$order='',$num='',$fileds='*'){
		$sql = 'SELECT '.$fileds.' FROM '.$this->DBTable;
		if($where){ $where = ' WHERE '.$where; }//������������
		if($order){ $order = ' ORDER BY '.$order; }//��������
		if($num){ $num = ' LIMIT '.$num; }//���ض�ȡ����
		$sql.= $where.$order.$num;
		return $this->returnArray($sql);
	}
	
	/**
	 *	@�������
	 *
	 *  @��ѯһ�����ݵķ���
	 */
	public  function getRow($sql, $limited = false)
    {
        if ($limited == true)
        {
            $sql = trim($sql . ' LIMIT 1');
        }

        $res = $this->query($sql);
        if ($res !== false)
        {
            return mysql_fetch_assoc($res);
        }
        else
        {
            return false;
        }
    }
	
	/**
	 *	@���ݿ��ѯ��Դ����
	 *
	 *  @����ѯ��Դ��������������
	 */
	private function returnArray($sql){
		$result=$this->query($sql) or die($this->showBug($sql)."������");
		while($row = mysql_fetch_assoc($result)){ $TmpArr[]=$row; }
		return $TmpArr;
	}

	/**
	 *	@���ݿ�д�����
	 */
	public function insert($dataArr){
		$sql = $this->createSQL('Insert',$dataArr);
		$this->query($sql);
	}

	/**
	 *	@���ݿ���²���
	 */
	public function update($dataArr,$where=''){
		$sql = $this->createSQL('Update',$dataArr);
		if($where){ $sql .= ' WHERE '.$where; }//�ж��Ƿ���Ҫ���ظ�������
		$this->query($sql);
	}

	/**
	 *	@����SQL���
	 *
	 *  @Action:�������� Insert [���ɲ������],Update [���ɸ������],Delete [����ɾ�����] 
	 *
	 *	@dataArr:��Ҫд�������
	 */
	private function createSQL($Action,$dataArr){
		$this->setDatabaseResources();//������Դ
		$fieldArr = $this->getFieldsArray();//��ȡ��ͷ��Ϣ������
		
		$Action = 'create'.$Action.'Sql';
		$createSql = new createSql($fieldArr);//ʵ����SQL���������
		$sql = $createSql->$Action($dataArr,$this->DBTable);
		if($sql){
			return $sql;
		}else{
			echo 'SQL��䴴��ʧ��!';
			exit;
		}
	}

	/**
	 *	@��ȡ�ֶμ�������
	 */
	private function getFieldsArray(){
		$fieldsArr = $this->getFields();
		for($i=0;$i<$fieldsArr;$i++){
			$obj=mysql_fetch_field($this->QueryID);
			$temp[$i]=$obj->name;
		}
		return $temp;
	}

	/**
	 *	@���ݿ�ɾ������
	 *  @
	 */
	public function del($fields,$value,$where=false){
		if(is_array($value)){
			$w = $fields.' IN('.join(',',$value).')';
		}else{
			$w =  $fields."='".intval($value)."'";
		}
		
		//�ж��Ƿ���ɾ����������
		if($where){ $w .= ' AND '.$where; }
		
		//����ɾ��SQL���
		$sql = 'DELETE FROM '.$this->DBTable." WHERE ".$w;

		$this->query($sql);
	}

	/**
	 *	@��ȡָ��������������
	 */
	public function sumRows($where=false){
		$sql = 'SELECT * FROM '.$this->DBTable;
		if($where){ $sql.=" WHERE ".$where; }
		$this->query($sql);
		$num = $this->getRows();
		return $num;
	}

	/**
	 *	@��ȡ�������ݵ�ID��Ϣ
	 */
	public function insertID(){
		return $this->getInsertID();
	}

	/**
	 *	@���ز�ѯ���ݿ���Դ
	 */
	private function setDatabaseResources(){
		return $this->query('SELECT * FROM '.$this->DBTable.' LIMIT 1');
	}

	/**
	 *	@�������
	 */
	private function showBug($sql){
		if($this->Debug){ return $sql; }
	}

}
?>
