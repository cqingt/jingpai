<?php
/*****************************************
������Access���ݿ������
��д�ˣ����� 9132761
���ã�����Access���ݿ�
ʹ�÷�����
$databasepath="database.mdb";
$dbusername="";
$dbpassword="";
include_once("class.php");
$access=new Access($databasepath,$dbusername,$dbpassword);
******************************************/
class Access{
	public $databasepath;
	public $constr;
	public $dbusername;
	public $dbpassword;
	public $link;


	function __construct($databasepath,$dbusername,$dbpassword){
		$this->databasepath=$databasepath;
		$this->username=$dbusername;
		$this->password=$dbpassword;
		$this->connect();
    }

	function connect(){
		$this->constr="DRIVER={Microsoft Access Driver (*.mdb)}; DBQ=" . realpath($this->databasepath);
		$this->link=odbc_connect($this->constr,$this->username,$this->password,SQL_CUR_USE_ODBC);
    }

    function query($sql){
        return @odbc_exec($this->link,$sql);
    }

    function first_array($sql)
    {
        return odbc_fetch_array($this->query($sql));
    }

    function fetch_row($query)
    {
        return odbc_fetch_row($query);
    }

    function total_num($sql)//ȡ�ü�¼����
    {
        return odbc_num_rows($this->query($sql));
    }

    function close()//�ر����ݿ����Ӻ���
    {
        odbc_close($this->link);
    }

	function insert($table,$field,$value){//�����¼����
		$sql="INSERT INTO ".$table." (".$field.") VALUES (".$value.")";
		$this->query($sql);
    }

    function getinfo($table,$field,$id,$colnum)//ȡ�õ�����¼��ϸ��Ϣ
    {
        $sql="SELECT * FROM ".$table." WHERE ".$field."=".$id."";
        $query=$this->query($sql);
        if($this->fetch_row($query))
        {
            for ($i=1;$i<$colnum;$i++)
            {
          $info[$i]=odbc_result($query,$i);
             }
         }
         return $info;
    }

    function getlist($table,$field,$colnum,$condition,$sort="ORDER BY id DESC")//ȡ�ü�¼�б�
    {
         $sql="SELECT * FROM ".$table." ".$condition." ".$sort;
         $query=$this->query($sql);
         $i=0;
         while ($this->fetch_row($query))
         {
        $recordlist[$i]=getinfo($table,$field,odbc_result($query,1),$colnum);
        $i++;
          }
          return $recordlist;
    }

    function getfieldlist($table,$field,$fieldnum,$condition="",$sort="")//ȡ�ü�¼�б�
    {
         $sql="SELECT ".$field." FROM ".$table." ".$condition." ".$sort;
         $query=$this->query($sql);
         $i=0;
         while ($this->fetch_row($query))
         {
         for ($j=0;$j<$fieldnum;$j++)
        {
                   $info[$j]=odbc_result($query,$j+1);
        }
        $rdlist[$i]=$info;
        $i++;
         }
         return $rdlist;
    }

    function updateinfo($table,$field,$id,$set)//���¼�¼
    {
        $sql="UPDATE ".$table." SET ".$set." WHERE ".$field."=".$id;
        $this->query($sql);
    }

    function deleteinfo($table,$field,$id)//ɾ����¼
    {
         $sql="DELETE FROM ".$table." WHERE ".$field."=".$id;
         $this->query($sql);
    }

    function deleterecord($table,$condition)//ɾ��ָ�������ļ�¼
    {
         $sql="DELETE FROM ".$table." WHERE ".$condition;
         $this->query($sql);
    }

    function getcondrecord($table,$condition="")// ȡ��ָ�������ļ�¼��
    {
         $sql="SELECT COUNT(*) AS num FROM ".$table." ".$condition;
         $query=$this->query($sql);
         $this->fetch_row($query);
         $num=odbc_result($query,1);
         return $num;
    }
}
?>