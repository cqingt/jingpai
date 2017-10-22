<?php
/**
 * 地区模型
 *
 */
defined('InShopNC') or exit('Access Invalid!');

class lepai_admin_themeModel extends Model {

    public function __construct() {
        parent::__construct('lepai_admin_theme');
    }

    /**
     * 搜索公共继承
     *
     */
    private function father($condition='',$type=''){
        $param  = array();
        $param['table'] = empty($condition['table'])?'lepai_admin_theme':$condition['field'];
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
     * 新增专场数据
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
            $result = Db::insert('lepai_admin_theme',$tmp);
            return $result;
        }else {
            return false;
        }
    }

    /*搜索所有专题*/
    public function sel($condition=''){
        $param  = array();
        $param['field'] = '*,(SELECT count(*) FROM shop_lepai_admin_theme_do WHERE shop_lepai_admin_theme_do.T_Tid=shop_lepai_admin_theme.T_Id) as T_Sum ';
        $param['where'] = ' T_Uid='.$_SESSION['member_id'];
        $param['order'] = 'T_Xu DESC ,T_Id DESC';
        $param['page']  = '10';
        if(!empty($condition)){
        foreach($condition as $k => $v){
            if($v['1'] == true){
                $param[$k] = $v[0];
            }else{
                $param[$k] = $param[$k].$v[0];
            }
        }
        }
        return $this->father($param);
    }


    /*提交审核*/
    public function tisheng($id,$val){
        $data['T_Tisheng'] = $val;
        return $this->table('lepai_admin_theme')->where(array('T_Id'=>$id))->update($data);
    }

    /*查询单个专题所有信息*/
    public function selOne($id){
        $array['where'] = 'T_Id='.$id;
        $array['field'] = '*,(SELECT count(*) FROM shop_lepai_admin_goods WHERE shop_lepai_admin_goods.G_Tid='.$id.' ) as T_Sum';
        return $this->father($array,'1');
    }

    /*修改专题*/
    public function save($id,$data){
        return $this->table('lepai_admin_theme')->where(array('T_Id'=>$id))->update($data);
    }


    /**
     * 新增专场人数
     *
     */
    public function addThemeUser($insert) {
        if (empty($insert)){
            return false;
        }
        if (is_array($insert)){
            $tmp = array();
            foreach ($insert as $k => $v){
                $tmp[$k] = $v;
            }
            $result = Db::insert('lepai_admin_theme_do',$tmp);
            return $result;
        }else {
            return false;
        }
    }

    /*删除专题产品*/
    public function del($tid,$gid){
        return $this->table('lepai_admin_theme_do')->where(array('T_Tid'=>$tid,'T_Gid'=>$gid))->delete();
    }


    /*删除专题*/
    public function delTheme($tid){
        /*取出专题关联产品*/
        $result = $this->table('lepai_admin_theme_do')->field('T_Gid')->where(array('T_Tid'=>$tid))->select();
        foreach($result as $k => $v){
            $goods_id .= ','.$v['T_Gid'];
        }
        /*该专题所有关联的产品ID*/
        $goods_id = ltrim($goods_id,',');
        /*修改所有产品专场ID*/
        $data['G_Tid']="0";
        $data['G_Atype']="0";
        $where = "G_Id in({$goods_id})";
        $this->table('lepai_admin_goods')->where($where)->update($data);
        /*删除专题产品关联表数据*/
        $this->table('lepai_admin_theme_do')->where(array('T_Tid'=>$tid))->delete();
        /*删除专题*/
        $this->table('lepai_admin_theme')->where(array('T_Id'=>$tid))->delete();
    }

    /*开启专场*/
    public function pushTheme($id){
        /*取出专题关联产品*/
        $result = $this->table('lepai_admin_theme_do')->field('T_Gid')->where(array('T_Tid'=>$id))->select();
        foreach($result as $k => $v){
            $goods_id .= ','.$v['T_Gid'];
        }
        /*该专题所有关联的产品ID*/
        $goods_id = ltrim($goods_id,',');
        /*检测关联产品是否有未审核*/
        $goods_type = $this->table('lepai_admin_goods')->field("*")->where("G_Id in({$goods_id}) AND G_Atype<>3")->select();
        if(!empty($goods_type)){
            return false;
        }

        try {

            $this->beginTransaction();

            /*更改专题状态*/
            $dataArr['T_Iswin']="1";
            $theme_update_result = $this->table('lepai_admin_theme')->where("T_Id='".$id."'")->update($dataArr);

            if(empty($theme_update_result)){
                throw new Exception('false');
            }

            $G_EndTime = $this->table('lepai_admin_theme')->field('T_Jtime')->where("T_Id='".$id."'")->find();

            if(empty($G_EndTime)){
                throw new Exception('false');
            }


            $data['G_EndTime']=$G_EndTime['T_Jtime'];
            $data['G_Atype']="3";
            $where = "G_Id in({$goods_id})";
            $theme_goods_uptime_result = $this->table('lepai_admin_goods')->where($where)->update($data);

            if(empty($theme_goods_uptime_result)){
                throw new Exception('false');
            }

            $this->commit();

            return true;

        } catch (Exception $e) {

            $this->rollback();

            return false;

        }


        
        
    }




}
