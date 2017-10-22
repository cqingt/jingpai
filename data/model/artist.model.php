<?php
/**
 * 艺术家作者管理
 */
defined('InShopNC') or exit('Access Invalid!');

class artistModel extends Model{
    public function __construct(){
        parent::__construct('artist');
    }

    /**
     * 查询艺术家数据
     *
     * @param array $condition 检索条件
     * @param obj $page 分页
     * @return array 数组结构的返回结果
     */
    public function getArtist($condition='',$page='15'){
        $result = array();
        //$condition_str  = $this->_condition($condition);
        $param  = array();
        $param['table'] = 'artist';
        $param['field'] = empty($condition['field'])?'*':$condition['field'];
        $param['where'] = empty($condition['where'])?'':$condition['where'];
        $param['limit'] = empty($condition['limit'])?'':$condition['limit'];
        $param['order'] = empty($condition['order'])?'':$condition['order'];
        $result = $this->table($param['table'])->field($param['field'])->page($page)->where($param['where'])->order($param['order'])->limit($param['limit'])->select();
        return $result;
    }

    /**
     * 根据艺术家名称取出数据
     *
     */
    public function getNameArtist($name){
        if ($name != ''){
            $param = array();
            $param['table'] = 'artist';
            $param['field'] = 'A_Id,A_Name';
            $param['where'] = " A_Name like '%".$name."%' ";
            $result = $this->table($param['table'])->field($param['field'])->where($param['where'])->select();
            return $result;
        }else {
            return false;
        }
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
            $param['table'] = 'artist';
            $param['field'] = 'A_Id';
            $param['value'] = intval($id);
            $result = Db::getRow($param);
            return $result;
        }else {
            return false;
        }
    }

	/**
     * 取单个艺术家产品数量以及销量
     */
    public function getOneGoods($id){
        $Arr['goodscount'] = $this->table('goods_common')->where(array('artist_id'=>$id))->count();
		//$Arr['OGoodsCount'] = $this->table('order_goods')->where("goods_id in(select goods_id from shop_goods where artist_id=".$id.")")->count();
		return $Arr;
    }

    /*取出艺术家和官网数据*/
    public function getInfo($id){
        if (intval($id) > 0){
            $result = $this->table('artist,artist_web')->join('inner')->on('artist.A_Id = artist_web.W_Aid')->where('artist.A_Id='.$id)->find();
            return $result;
        }else {
            return false;
        }
    }

    /*读取艺术家推荐排行榜*/
    public function getArtistPush($page='8',$id){
        if($id){
            $where = " A_Id <> $id ";
        }
        $result = $this->table('artist')->field('A_Id,A_Name,A_Img,A_ZhiCheng')->where($where)->order('A_OrderBy ASC , A_Id DESC')->page($page)->select();
        /*重组职称*/
        foreach($result as $k=>$v){
            $zhi = explode('|',$v['A_ZhiCheng']);
            $result[$k]['A_Zhi'] = $zhi['0'];
        }

        return $result;
    }

    /*读取艺术家对应的产品信息*/
    public function artistGoods($id,$page='8'){
        if($id){
            $result = $this->table('goods')->field('goods_id,goods_commonid,goods_name,goods_price,goods_image,goods_salenum')->where("artist_id='".$id."' AND goods_state=1 AND goods_verify=1")->order('goods_id DESC')->page($page)->select();
            return $result;
        }else{
            return false;
        }
    }

    /*读取艺术家产品信息属性*/
    public function getArtistAttr($condition, $field = '*',$order = ''){
        return $this->table('attribute_value')->where($condition)->field($field)->order($order)->select();
    }

    /**
     * 新增艺术家数据
     *
     * @param array $insert 数据
     * @param string $table 表名
     */
    public function addArtist($insert) {
        if (empty($insert)){
            return false;
        }
        if (is_array($insert)){
            $tmp = array();
            foreach ($insert as $k => $v){
                $tmp[$k] = $v;
            }
            $result = Db::insert('artist',$tmp);
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
            $where = " A_Id = '". $param['A_Id'] ."'";
            $result = Db::update('artist',$tmp,$where);
            return $result;
        }else {
            return false;
        }
    }

    /**
     * 删除艺术家数据
     *
     * @param int $id 记录ID
     * @return bool 布尔类型的返回结果
     */
    public function delArtist($id){
        if (intval($id) > 0){
            $where = " A_Id = '". intval($id) ."'";
            $result = Db::delete('artist',$where);
            return $result;
        }else {
            return false;
        }
    }

    /**
     * 删除多个艺术家数据
     *
     * @param int $id ID组
     * @return bool 布尔类型的返回结果
     */
    public function delAllArtist($id){
        if (!empty($id)){
            $where = " A_Id IN(". $id .")";
            $result = Db::delete('artist',$where);
            return $result;
        }else {
            return false;
        }
    }

  /**
    新加
*/


    public function artistSearch(){
        /*城市*/
        $shi = $this->table('area')->where("area_id in(SELECT A_JiGuan FROM `shop_artist` GROUP BY A_JiGuan ORDER BY A_JiGuan)")->select();

        /*职位*/
        $position = $this->table('artist_position')->select();

        /*所有城市*/
        $all_shi = $this->table('area')->where(array('area_parent_id'=>'0'))->select();

        /*所有分类*/
        $artist_array = array('1'=>'书画','2'=>'国画','3'=>'油画','4'=>'版画');


        return array('shi'=>$shi,'position'=>$position,'all_shi'=>$all_shi,'class'=>$artist_array);
    }

	
}
