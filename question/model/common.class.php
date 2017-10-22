<?php
/**
 * Created by PhpStorm.
 * Class: common 模型公共方法
 * User: chenhao
 * Date: 2016/10/31
 * Time: 13:53
 */
!defined('IN_ASK2') && exit('Access Denied');
class Common
{
    private $sql = '';
    private $table;
    private $field = '*';
    private $bindparam = array();
    private function content()
    {
        $dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET, DB_USER, DB_PW);
        $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false); //禁用prepared statements的仿真效果
        $dbh->exec('set names '.DB_CHARSET);
        return $dbh;
    }
    /**
     * 查询
     * @param $table
     * @param string $where
     * @param string $field
     * @param string $order
     * @param string $limit
     * @return string
     */
    public function selectSql( $table , $where = '' , $field = '*' , $order = '' , $limit = '' )
    {
        //判断参数类型   组合SQL语句
        //字段
        if( is_array( $field ) )
        {
            $field = implode( '`,`' , $field );
        }
        $sql = 'SELECT `'.$field.'` FROM `';
        //表
        if( is_array( $table ) )
        {
            $sql.= DB_TABLEPRE.$table[0]['table1'].'` ';
            foreach( $table as $key => $val )
            {
                if( strpos( $val['join'] , ',' ) )
                {
                    $join = explode(',',$val['join']);
                    $sql.= $val['join_type'] . ' `' . DB_TABLEPRE . $val['table2'] . '` ON `' . DB_TABLEPRE . $val['table1'];
                    $sql.= '`.`'.$join[0].'`=`'.DB_TABLEPRE.$val['table2'].'`.`'.$join[1].'` ';
                }
                else
                {
                    $sql .= $val['join_type'] . ' `' . DB_TABLEPRE . $val['table2'] . '` ON `' . DB_TABLEPRE . $val['table1'];
                    $sql.= '`.`'.$val['join'].'`=`'.DB_TABLEPRE.$val['table2'].'`.`'.$val['join'].'` ';
                }
            }
        }
        else
        {
            $sql.= DB_TABLEPRE.$table.'` ';
        }
        //条件
        if( is_array( $where ) )
        {
            $sql.= 'WHERE ';
            foreach($where as $val)
            {
                $sql.= $val.' AND ';
            }
            $sql = substr($sql , 0 ,-4);
        }
        elseif( $where != '' )
        {
            $sql.= 'WHERE '.$where;
        }
        //排序
        if( $order != '' )
        {
            $sql.=' ORDER BY '.$order;
        }
        //限定结果集
        if( is_array( $limit ) )
        {
            $sql.= ' LIMIT '.$limit[0].','.$limit[1];
        }
        elseif( $limit != '' )
        {
            $sql.= ' LIMIT '.$limit;
        }

        return $sql;
    }

    /**
     * 添加
     * @param $table
     * @param $data
     * @return string
     */
    public function insertSql( $table , $data )
    {
        $sql = 'INSERT INTO `'.DB_TABLEPRE.$table.'` ';
        $count = count( $data );
        $i = 0;
        foreach( $data as $key => $val )
        {
            if( is_array($val) )
            {
                if( $key == 0 )
                {
                    $array_key = array_keys($val);
                    $sql.='(';
                    foreach( $array_key as $v )
                    {
                        $sql.='`'.$v.'`,';
                    }
                    $sql = substr( $sql , 0 , -1 );
                    $sql.= ') VALUES ';
                }
                $array_value = array_values( $val );
                $sql.='(';
                foreach( $array_value as $v )
                {
                    $sql.= "'$v',";
                }
                $sql = substr($sql , 0 , -1);
                $sql.= '),';
            }
            else
            {
                if( $i == 0 ) {
                    $array_key = array_keys($data);
                    $sql .= '(';
                    foreach ($array_key as $v) {
                        $sql .= '`' . $v . '`,';
                    }
                    $sql = substr($sql, 0, -1);
                    $sql.= ') VALUES (';
                }
                $sql.= "'$val',";
                if( $i == $count-1 )
                {
                    $sql = substr($sql , 0 , -1);
                    $sql.= '),';
                }
                $i++;
            }
        }
        $sql = substr($sql , 0 , -1);
        return $sql;
    }

    /**
     * 修改
     * @param $table
     * @param $data
     * @param $where
     * @return string
     */
    public function updateSql( $table , $data , $where )
    {
        $sql = 'UPDATE `'.DB_TABLEPRE.$table.'` SET ';
        foreach( $data as $key => $val )
        {
            $sql.= '`'.$key.'`='."'$val',";
        }
        $sql = substr( $sql ,0 , -1 );
        $sql.= ' WHERE '.$where;
        return $sql;
    }

    /**
     * 删除
     * @param $table
     * @param $where
     * @return string
     */
    public function deleteSql( $table , $where )
    {
        $sql = 'DELETE FROM `'.DB_TABLEPRE.$table.'` WHERE '.$where;
        return $sql;
    }

    public function table( $table = '')
    {
        $this -> table = '`'.DB_TABLEPRE.$table.'`';
        $this -> sql .= ' '.$this -> table;
        return $this;
    }
    public function join( $jointable , $join1 , $join2 = '' , $type = 'LEFT JOIN'  )
    {
        (empty($join2)) && $join2 = $join1;
        $this -> sql .= ' ' . $type . ' `' . DB_TABLEPRE . $jointable . '` ON `' . $this -> table . '`.`' . $join1 . '` = `'.DB_TABLEPRE . $jointable . '`.`' . $join2. '`';
        return $this;
    }
    public function where( $where = array() )
    {
        $wherestr = '';
        if( is_array( $where ) ){
            foreach( $where as $key => $val ){
                if( $key > 0 ){
                    $wherestr.='AND ';
                }
                $v = explode(',',$val);
                if( count( $v ) == 2 ){
                    $wherestr .= $v[0].' = ? ';
                    $this -> bindparam = array_merge( $this->bindparam , array( $v[1] ) );
                }else{
                    $wherestr .= $v[0].' '.$v[1].' ? ';
                    $this -> bindparam = array_merge( $this->bindparam , array( $v[2] ) );
                }
            }
        }else{
            $wherestr = $where;
        }
        $this -> sql.= ' WHERE '.$wherestr;
        return $this;
    }
    public function order( $order )
    {
        $this -> sql .= ' ORDER BY '.$order;
        return $this;
    }
    public function limit( $n , $num = 0 )
    {
        $this -> sql .= ' LIMIT '. $n;
        if( $num ) $this -> sql .= ',' . $num;
        return $this;
    }
    public function field( $field = '*' )
    {
        (strpos( $field , ',' )) && $field = explode( ',' , $field );
        if( !is_array( $field ) ) $field = array($field);
        $new_field = '';
        foreach( $field as $val ){
            $new_field .= '`' . $val . '`,';
        }
        $new_field = substr( $new_field , 0 ,-1 );
        $this -> field = $new_field;
        return $this;
    }

    /**
     * 异常显示
     */
    public function dbError($dbh)
    {
        if ($dbh->errorCode() != '00000'){
            print_r($dbh->errorInfo());
            exit;
        }
    }
    public function get()
    {
        $sql = 'SELECT ' . $this -> field . ' FROM '.$this -> sql;
        $dbh = $this -> content();
        $query = $dbh->prepare( $sql );
        if( isset($this -> bindparam) ){
            foreach( $this->bindparam as $key => $val ) {
                $query->bindParam($key+1 , $val);
            }
        }
        $query -> execute();
        $this->dbError( $dbh );
        $query ->setFetchMode(PDO::FETCH_ASSOC);
        $data = $query -> fetchAll();
        $dbh = null;
        return $data;
    }
    public function getOne()
    {
        $sql = 'SELECT ' . $this -> field . ' FROM ' . $this -> sql . ' limit 1';
        $dbh = $this -> content();
        $query = $dbh->query( $sql );
        $this->dbError( $dbh );
        $query ->setFetchMode(PDO::FETCH_ASSOC);
        $data = $query -> fetch();
        $dbh = null;
        return $data;
    }
    public function rowCount()
    {
        $sql = 'SELECT COUNT(*) FROM ' . $this -> sql;
        $dbh = $this -> content();
        $query = $dbh -> query( $sql );
        $this->dbError( $dbh );
        $num = $query -> fetchColumn();
        $dbh = null;
        return $num;
    }
    public function add($data = array() , $table = null)
    {
        if( $table == null ) $table = $this -> table;
        $sql = 'INSERT INTO `'.DB_TABLEPRE.$table.'` ';
        $count = count( $data );
        $i = 0;
        foreach( $data as $key => $val )
        {
            if( is_array($val) )
            {
                if( $key == 0 )
                {
                    $array_key = array_keys($val);
                    $sql.='(';
                    foreach( $array_key as $v )
                    {
                        $sql.='`'.$v.'`,';
                    }
                    $sql = substr( $sql , 0 , -1 );
                    $sql.= ') VALUES ';
                }
                $array_value = array_values( $val );
                $sql.='(';
                foreach( $array_value as $v )
                {
                    $sql.= "'$v',";
                }
                $sql = substr($sql , 0 , -1);
                $sql.= '),';
            }
            else
            {
                if( $i == 0 ) {
                    $array_key = array_keys($data);
                    $sql .= '(';
                    foreach ($array_key as $v) {
                        $sql .= '`' . $v . '`,';
                    }
                    $sql = substr($sql, 0, -1);
                    $sql.= ') VALUES (';
                }
                $sql.= "'$val',";
                if( $i == $count-1 )
                {
                    $sql = substr($sql , 0 , -1);
                    $sql.= '),';
                }
                $i++;
            }
        }
        $sql = substr($sql , 0 , -1);
        $dbh = $this -> content();
        $num = $dbh->exec( $sql );
        $dbh = null;
        if( $num > 0 )
        {
            return $dbh -> lastInsertId();
        }
        else
        {
            return 0;
        }
    }

    public function del($where = 1 , $table = null)
    {
        if($table == null)$table = $this->table;
        $sql = 'DELETE FROM `'.DB_TABLEPRE.$table.'` WHERE '.$where;
        $dbh = $this -> content();
        $num = $dbh->exec( $sql );
        $dbh = null;
        if( $num > 0 )
        {
            return $dbh -> lastInsertId();
        }
        else
        {
            return 0;
        }
    }

    public function upd( $data , $where = 1 , $table = null )
    {
        if($table == null)$table = $this->table;
        $sql = 'UPDATE `'.DB_TABLEPRE.$table.'` SET ';
        foreach( $data as $key => $val )
        {
            $sql.= '`'.$key.'`='."'$val',";
        }
        $sql = substr( $sql ,0 , -1 );
        $sql.= ' WHERE '.$where;
        $dbh = $this -> content();
        $num = $dbh->exec( $sql );
        $dbh = null;
        if( $num > 0 )
        {
            return $dbh -> lastInsertId();
        }
        else
        {
            return 0;
        }
    }
}