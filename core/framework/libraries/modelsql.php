<?php
/**
 * 核心文件
 *
 * 优化WHERE语句
 *
 * @package
 */
class ModelSql extends ModelDb{


	// public function __construct(){
		
	// }

    public function getWhere($where){

        if(is_string($where)) {
            $whereStr = $where;
        }elseif(is_array($where)){
            $whereStr = $this->parseWhere($where);

            $whereStr = str_replace('WHERE', '', $whereStr);
        }

        return $whereStr;
    }


  
}
?>
