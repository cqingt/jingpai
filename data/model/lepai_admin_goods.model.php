<?php
/**
 * 地区模型
 *
 */
defined('InShopNC') or exit('Access Invalid!');

class lepai_admin_goodsModel extends Model {

    public function __construct() {
        parent::__construct('');
    }

    /**
     * 搜索公共继承
     *
     */
    private function father($condition='',$type=''){
        $param  = array();
        $param['table'] = empty($condition['table'])?'lepai_admin_goods':$condition['field'];
        $param['field'] = empty($condition['field'])?'*':$condition['field'];
        $param['where'] = empty($condition['where'])?'':$condition['where'];
        $param['limit'] = empty($condition['limit'])?'':$condition['limit'];
        $param['order'] = empty($condition['order'])?'':$condition['order'];
        $param['page']  = empty($condition['page'])?'':$condition['page'];
        if($type){
            $result = $this->table($param['table'])->field($param['field'])->where($param['where'])->order($param['order'])->page($param['page'])->limit($param['limit'])->find();
        }else{
            $result = $this->table($param['table'])->field($param['field'])->where($param['where'])->order($param['order'])->page($param['page'])->limit($param['limit'])->select();
        }
        return $result;
    }

    /**
     * 新增拍品数据
     *
     */
    public function add($insert) {
        if (empty($insert)){
            return false;
        }
        if (is_array($insert)){
            $tmp = array();
            foreach ($insert as $k => $v){
                $tmp[$k] = $v;
            }
            $result = Db::insert('lepai_admin_goods',$tmp);
            return $result;
        }else {
            return false;
        }
    }

    /*修改专题*/
    public function save($id,$data){
        return $this->table('lepai_admin_goods')->where(array('G_Id'=>$id))->update($data);
    }

    /**
     * 新增拍品属性
     *
     */
    public function addInfo($insert) {
        if (empty($insert)){
            return false;
        }
        if (is_array($insert)){
            $tmp = array();
            foreach ($insert as $k => $v){
                $tmp[$k] = $v;
            }
            $result = Db::insert('lepai_admin_goodsinfo',$tmp);
            return $result;
        }else {
            return false;
        }
    }

    /*新增拍品图片*/
    public function addImg($insert) {
        if (empty($insert)){
            return false;
        }
        if (is_array($insert)){
            $tmp = array();
            foreach ($insert as $k => $v){
                $tmp[$k] = $v;
            }
            $result = Db::insert('lepai_admin_img',$tmp);
            return $result;
        }else {
            return false;
        }
    }

    /*删除拍品图片*/
    public function delImg($id){
        $result = $this->table('lepai_admin_img')->where("IM_GoodsId='".$id."'")->delete();
        return $result;
    }

    /*删除拍品属性*/
    public function delInfo($id){
        $result = $this->table('lepai_admin_goodsinfo')->where("I_GoodsId='".$id."'")->delete();
        return $result;
    }

    /*查出所有产品*/
    public function selGoods($admin='',$where='',$page='10'){
        $table="lepai_admin_goods,lepai_admin_theme";
        $on = "lepai_admin_theme.T_Id=lepai_admin_goods.G_Tid";
        $order = "G_Id DESC";
        if(!$admin){
            $where = "G_Uid='".$_SESSION['member_id']."'".$where;
        }else{
            $where = "G_Atype <> 0  ".$where;
        }
        $field = "*,(SELECT C_Name FROM shop_lepai_admin_goods_class WHERE shop_lepai_admin_goods_class.C_Id=lepai_admin_goods.G_Class LIMIT 0,1) as G_ClassName,
                    (SELECT store_name FROM shop_store WHERE shop_store.member_id=lepai_admin_goods.G_Uid LIMIT 1) as M_Store_name,
                    (SELECT member_name FROM shop_store_joinin WHERE shop_store_joinin.member_id=lepai_admin_goods.G_Uid LIMIT 1) as M_Name
        ";
        $result = $this->table($table)->field($field)->join('left')->on($on)->where($where)->order($order)->page($page)->select();
        return $result;
    }

    /*查找单个产品*/
    public function selGoodsOne($id){
        $table="lepai_admin_goods,lepai_admin_theme";
        $on = "lepai_admin_theme.T_Id=lepai_admin_goods.G_Tid";
        $where = "G_Id='".$id."'";
        $result = $this->table($table)->field("*")->join('left')->on($on)->where($where)->find();
        return $result;
    }

    /*查找商品属性*/
    public function goodsInfo($id){
        $table="lepai_admin_goodsinfo";
        $where = "I_GoodsId='".$id."'";
        $result = $this->table($table)->field("*")->where($where)->find();
        return $result;
    }

    /*修改商品属性*/
    public function upGoodsInfo($id,$data){
        $table="lepai_admin_goodsinfo";
        $where = "I_GoodsId='".$id."'";
        $dataArray['I_Name'] = null;
        $dataArray['I_ZhiCheng'] = null;
        $dataArray['I_Chang'] = null;
        $dataArray['I_Kuan'] = null;
        $dataArray['I_Hou'] = null;
        $dataArray['I_Zhong'] = null;
        $dataArray['I_XingZhi'] = null;
        $result = $this->table($table)->where($where)->update($dataArray);
        $result = $this->table($table)->where($where)->update($data);
        return $result;
    }

    /*查找商品图片*/
    public function goodsImg($id){
        $table="lepai_admin_img";
        $where = "IM_GoodsId='".$id."'";
        $result = $this->table($table)->field("*")->where($where)->select();
        return $result;
    }

    /*修改商品图片*/
    public function upGoodsImg($data){
        $table = "lepai_admin_img";
        if(!empty($data)){
            foreach($data as $k => $v){
                    $where = "IM_Id='".$v['IM_Id']."'";
                if($this->table($table)->where($where)->find()){
                    $dataArr['IM_Img'] = $v['IM_Img'];
                    $result = $this->table($table)->where($where)->update($dataArr);
                    var_dump($result);
                }else{
                    unset($v['IM_Id']);
                    $result = $this->table($table)->insert($v);
                }
            }
        }
        return $result;
    }

    /*删除商品图片*/
    public function delGoodsImg($id){
        $table = "lepai_admin_img";
        $where = "IM_Id='".$id."'";
        $result = $this->table($table)->where($where)->delete();
        return $result;
    }



     /*修改产品状态*/
    public function saveGoods($id='',$val=''){
        /*提交审核*/
        if($id && $val){
        return $this->table('lepai_admin_goods')->where(array('G_Id'=>$id))->update($val);
        }else{
        return false;
        }
    }

    /*修改产品状态*/
    public function saveOne($id='',$val=''){
        /*提交审核*/
        $data['G_Atype'] = $val;
        if($id && $val){
        return $this->table('lepai_admin_goods')->where(array('G_Id'=>$id))->update($data);
        }else{
        return false;
        }
    }

    /*修改产品状态*/
    public function saveOneT($id='',$val=''){
        /*提交审核*/
        $data['G_Tid'] = $val;
        if($id && $val){
        return $this->table('lepai_admin_goods')->where(array('G_Id'=>$id))->update($data);
        }else{
        return false;
        }
    }

    /*修改产品状态*/
    public function saveDel($id='',$val=''){
        /*提交审核*/
        $data['G_Isdel'] = $val;
        if($id && $val){
        return $this->table('lepai_admin_goods')->where(array('G_Id'=>$id))->update($data);
        }else{
        return false;
        }
    }

    /*删除产品*/
    public function delGoods($id){
        /*删除产品属性*/
        $this->delInfo($id);
        /*删除产品图片*/
        $this->delImg($id);
        /*删除关联数据*/
        $this->table('lepai_admin_theme_do')->where(array('T_Gid'=>$id))->delete();
        /*删除产品数据*/
        $this->table('lepai_admin_goods')->where(array('G_Id'=>$id))->delete();
    }


    /*拍品分类*/
    public function goodsClass(){
        return $this->table('lepai_admin_goods_class')->select();
    }

    /*修改产品未通过状态*/
    public function upGoodsTwo($id){
        /*拒绝审核*/
        $data['G_Tid'] = "0";
        /*修改专题为0*/
        $this->table('lepai_admin_goods')->where(array('G_Id'=>$id))->update($data);
        /*删除关联数据*/
        $this->table('lepai_admin_theme_do')->where(array('T_Gid'=>$id))->delete();
    }


/**
 新加
*/




    /*搜索所有用户*/
    public function selUser($condition=''){
        $param  = array();
        $param['table'] = 'lepai_audit';
        $param['field'] = '*,
        (SELECT store_name FROM shop_store_joinin WHERE shop_store_joinin.member_id=shop_lepai_audit.member_id LIMIT 1) AS store_name,
        (SELECT count(*) FROM shop_lepai_admin_goods WHERE shop_lepai_audit.member_id=shop_lepai_admin_goods.G_Uid) AS U_Sum,
        (SELECT count(*) FROM shop_lepai_order WHERE shop_lepai_order.buyer_id=shop_lepai_audit.member_id) AS U_GoodsSum,
        (SELECT sum(order_amount) FROM shop_lepai_order WHERE shop_lepai_order.buyer_id=shop_lepai_audit.member_id) AS U_MoneySum';
        $param['where'] = '';
        $param['order'] = '';
        $param['page']  = '10';
        // $param['join']  = 'left';
        // $param['on']  = 'lepai_order.lepai_goods_id=lepai_admin_goods.G_Id,lepai_order.buyer_id=lepai_audit.member_id';
        if(!empty($condition)){
        foreach($condition as $k => $v){
            if($v['1'] == true){
                $param[$k] = $v[0];
            }else{
                $param[$k] = $param[$k].$v[0];
            }
        }
        }
        return $this->table($param['table'])->field($param['field'])->where($param['where'])->order($param['order'])->page($param['page'])->limit($param['limit'])->select();
    }

    /*修改用户状态*/
    public function upUserType($id,$type='0'){
        $data['is_audit'] = $type;
        return $this->table('lepai_audit')->field('*')->where("member_id='".$id."'")->update($data);
    }

    /*搜索所有产品属性*/
    public function goodsAttribute(){
        /*书画职位*/
        $sh_zhiwei = $this->table('attribute_value')->where('attr_id=15')->order('attr_value_sort asc, attr_value_id asc')->select();
        /*书画形制*/
        $sh_xingzhi = $this->table('attribute_value')->where('attr_id=16')->order('attr_value_sort asc, attr_value_id asc')->select();
        /*珠宝材质*/
        $zb_caizhi = $this->table('attribute_value')->where('attr_id=25')->order('attr_value_sort asc, attr_value_id asc')->select();
        /*瓷器容量*/
        $cq_rongliang = $this->table('attribute_value')->where('attr_id=19')->order('attr_value_sort asc, attr_value_id asc')->select();

        return array('sh_zhiwei'=>$sh_zhiwei,'sh_xingzhi'=>$sh_xingzhi,'zb_caizhi'=>$zb_caizhi,'cq_rongliang'=>$cq_rongliang);
    }




	/**
     * 根据条件获取报名记录
     */
    public function getBaoMingLog($condition, $pagesize='10',$order='id desc',$field='*,(select member_name from shop_member where `shop_member`.member_id=`shop_lepai_baoming`.member_id limit 1) as member_name',$limit='') {
        return $this->table('lepai_baoming')->where($condition)->field($field)->order($order)->limit($limit)->page($pagesize)->select();
    }

	/**
     * 根据条件获取出价记录
     */
    public function getChuJiaLog($condition, $pagesize='10',$order='price desc',$field='*,(select member_name from shop_member where `shop_member`.member_id=`shop_lepai_log`.member_id limit 1) as member_name',$limit='') {
        return $this->table('lepai_log')->where($condition)->field($field)->order($order)->limit($limit)->page($pagesize)->select();
    }






}
