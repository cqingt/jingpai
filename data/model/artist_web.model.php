<?php
/**
 * 艺术家作者管理
 */
defined('InShopNC') or exit('Access Invalid!');

class artist_webModel extends Model{
    public function __construct(){
        parent::__construct('artist_web');
    }


    /**
     * 取单个艺术家数据
     *
     * @param int $id ID
     * @return array 数组类型的返回结果
     */
    public function getOneArtist($id){
        if (intval($id) > 0){
            $param = array();
            $param['table'] = 'artist_web';
            $param['field'] = 'W_Aid';
            $param['value'] = intval($id);
            $result = Db::getRow($param);
            return $result;
        }else {
            return false;
        }
    }

    /**
     * 新增艺术家数据
     *
     * @param array $insert 数据
     * @param string $table 表名
     */
    public function addArtist($insert) {
        /*判断数据库里是否有重复值*/
        if($this->where(array('W_Aid'=>$insert['W_Aid']))->find()){
            return false;
        }

        if (empty($insert)){
            return false;
        }
        if (is_array($insert)){
            $tmp = array();
            foreach ($insert as $k => $v){
                $tmp[$k] = $v;
            }
            $result = Db::insert('artist_web',$tmp);
            return $result;
        }else {
            return false;
        }
    }

    /**
     * 更新艺术家数据
     *
     * @param array $param 更新数据
     * @return bool 布尔类型的返回结果
     */
    public function saveArtist($param){
        if (empty($param)){
            return false;
        }
        if (is_array($param)){
            $tmp = array();
            foreach ($param as $k => $v){
                $tmp[$k] = $v;
            }
            $where = " W_Id = '". $param['W_Id'] ."'";
            $result = Db::update('artist_web',$tmp,$where);
            return $result;
        }else {
            return false;
        }
    }



  
	
}
