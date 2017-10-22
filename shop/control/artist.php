<?php
/**
 * 前台品牌分类
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class artistControl extends BaseHomeControl {

	public function indexOp(){
        /*艺术家ID*/
        $artistid = trim($_GET['artist_id']);
        /*搜索详细信息*/
        $artist_model = Model('artist');
        $result = $artist_model->getInfo($artistid);
        /*搜索该艺术家对应的产品信息*/
        $model_goods = Model('goods');
        $goods = $model_goods->field('goods_id')->where("artist_id='".$artistid."'")->select();

        /*艺术家产品信息*/
        $artistGoods = $artist_model->artistGoods($artistid,100);
        /*加载艺术家产品信息*/
        Tpl::output('artistGoods',$artistGoods);
        /*艺术家推荐信息*/
        $artistPush = $artist_model->getArtistPush('7',$artistid);
        /*加载艺术家推荐信息*/
        Tpl::output('artistPush',$artistPush);
        /*拆份职位*/
        $zhi = explode('|',$result['A_ZhiCheng']);
        /*加载职位信息*/
        Tpl::output('zhi',$zhi);
        /*加载艺术家信息*/
        Tpl::output('artist',$result);
        /*加载书画资讯*/
        Tpl::output('news',$this->shuhuaNews($result['A_Name']));
        /*加载SEO*/
        Tpl::output('html_title',$result['W_Title'].' - '.C('site_name'));
        Tpl::output('seo_keywords',$result['W_Keywords']);
        Tpl::output('seo_description',$result['W_Description']);
        /*加载艺术家模板*/
        Tpl::showpage('artist.index');
	}






    /*艺术家列表*/
    public function artistListOp(){
        //实例化属性数据表
        $model = Model('artist');

        $listWhere = $model->artistSearch();

        $artist_list = $this->artistListWebOp();

        foreach($artist_list as $k => &$v){
            $v['A_Goods'] = $model->table('goods')->where("artist_id='".$v['A_Id']."'")->page('3')->order('goods_addtime DESC')->select();
        }

        /*加载艺术家模板*/
        Tpl::output('artist_list',$artist_list);
        Tpl::output('listWhere',$listWhere);
        Tpl::showpage('artist.user.list');
    }

    /*搜索所有艺术家并对应三条产品*/
    private function artistListWebOp(){
        $model = Model();

        $table="artist";

        $field = "*";

        $where = $this->listWhereOp(true);


        $where = "".$where;

        if($_GET['order']=='1'){
            $order = "A_Id DESC";
        }elseif($_GET['otime']=='1'){
            $order = "(SELECT goods_id from shop_goods where shop_goods.artist_id=shop_artist.A_Id  order by goods_id desc limit 1) desc";
        }else{
            $order = "A_OrderBy ASC , A_Id DESC";
        }
        
        $artist_list = $model->table($table)->field($field)->where($where)->page('10')->order($order)->select();


        foreach($artist_list as $k => &$v){
            $v['A_ZhiCheng'] = explode('|',$v['A_ZhiCheng']);
        }

        Tpl::output('max', $model->table($table)->field('count(*) as Max')->where($where)->select());
        Tpl::output('page', $model->showpage(2));
        Tpl::output('page_6', $model->showpage(6));
        return $artist_list;
    }


    /*艺术家搜索条件*/
    private function listWhereOp($trim=''){
        $search = trim($_GET['search']);
        $class = trim($_GET['class']);
        $position = trim($_GET['position']);
        $jiguan = trim($_GET['jiguan']);

        if($search){
            $where .= " AND A_Name LIKE '%".$search."%'";
        }

        if($class){
            $where .= " AND A_Class = '".$class."'";
        }

        if($position){
            $where .= " AND A_Position LIKE '%".$position."%'";
        }

        if($jiguan){
            $where .= " AND A_JiGuan = '".$jiguan."'";
        }

        if($trim && $where){
            $where = 'A'.ltrim($where,' AND');
        }

        return $where;

    }





        /*艺术家作品列表*/
        public function listOp(){

        $where_list = $this->artistWhere();


        $result = $this->artistInfoOp($where_list);


        Tpl::output('goods_max',$result['goods_max']);//产品总数
        Tpl::output('result',$result['result']);//产品环境
        /*艺术家筛选属性*/
        //实例化属性数据表
        $attr_model = Model('artist');
        /*if如果有搜索条件的情况下执行搜索结果*/
        if(!empty($where_list)){
        $result_name = $result['result_name'];
        //环境
        $result_14 = $result['result_14'];
        //职位
        $result_15 = $result['result_15'];
        //形制
        $result_16 = $result['result_16'];
        }else{
        //加载所有名家
        $condition['field'] = 'A_Id,A_Name';
        $result_name = $attr_model->getArtist($condition,'1000');
        //环境
        $result_14 = $attr_model->getArtistAttr('attr_id = 14 AND type_id = 4');
        //职位
        $result_15 = $attr_model->getArtistAttr('attr_id = 15 AND type_id = 4');
        //形制
        $result_16 = $attr_model->getArtistAttr('attr_id = 16 AND type_id = 4');
        }
        /*加载信息*/
        Tpl::output('result_name',$result_name);//产品环境
        Tpl::output('result_14',$result_14);//产品环境
        Tpl::output('result_15',$result_15);//产品职位
        Tpl::output('result_16',$result_16);//产品形制
        /*加载模板*/
        Tpl::showpage('artist.list');
        }

        /*拼接搜索条件*/
        private function artistWhere(){
                $idname = trim($_GET['idname']);//艺术家名称ID
                $id_14 = trim($_GET['id_14']);//产品环境
                $id_15 = trim($_GET['id_15']);//产品职位
                $id_16 = trim($_GET['id_16']);//产品形制

                $wherejoin = '';
                if($idname){
                    $wherejoin .= " AND artist.A_Id='".$idname."'";
                }

                if($id_14){
                    $wherejoin .= " AND goods_attr_index.attr_value_id='".$id_14."'";
                }

                if($id_15 && !$id_14){
                    $wherejoin .= " AND goods_attr_index.attr_value_id='".$id_15."'";
                }elseif($id_14 || $id_16){
                    $wherejoin .= " OR goods_attr_index.attr_value_id='".$id_15."'";
                }

                if($id_16 && !$id_14 && !$id_15){
                    $wherejoin .= " AND goods_attr_index.attr_value_id='".$id_16."'";
                }elseif($id_14 || $id_15){
                    $wherejoin .= " OR goods_attr_index.attr_value_id='".$id_16."'";
                }

                return $wherejoin;
        }


        /*所有艺术家产品*/
        private function artistInfoOp($wherejoin=''){
        $model = Model();


        /*排序条件*/
        $g_time = trim($_GET['time']);//上架时间
        $g_click = trim($_GET['click']);//点击量
        $g_money = trim($_GET['money']);//价格
        $g_sa = trim($_GET['sa']);//销售数量

        $order = '';

        if($g_time){
            $order = " goods.goods_addtime DESC,goods.goods_id DESC ";
        }

        if($g_click){
            $order = " goods.goods_click DESC,goods.goods_id DESC ";
        }

        if($g_money){
            $order = " goods.goods_price DESC,goods.goods_id DESC ";
        }

        if($g_sa){
            $order = " goods.goods_salenum DESC,goods.goods_id DESC ";
        }



        if($wherejoin){
            // $id_14 = trim($_GET['id_14']);//产品环境
            // $id_15 = trim($_GET['id_15']);//产品职位
            // $id_16 = trim($_GET['id_16']);//产品形制
            // if($id_14 || $id_15 || $id_16){
                /*关联表名*/
                $table="goods,artist,goods_attr_index";
                /*关联类型*/
                $on = "goods.artist_id=artist.A_Id,goods_attr_index.goods_id=goods.goods_id";
                /*关联表型*/
                $join = "inner,left";
                /*去掉重复值*/
                $group = " GROUP BY goods.goods_id ";
                /*属性类型*/
                $goods_attr_index = "AND goods_attr_index.type_id = 4";
            // }else{
            //     /*关联表名*/
            //     $table="goods,artist";
            //     /*关联类型*/
            //     $on = "goods.artist_id=artist.A_Id";
            //     /*关联表型*/
            //     $join = "inner";
            // }
                
                /*搜索条件*/
                $where = "goods.artist_id <> '' ".$goods_attr_index.$wherejoin.$group;
                /*作品总数*/
                $goods_max = $model->table($table)->field("count(*) as goods_max")->join($join)->on($on)->where($where)->find();
                /*所有作品信息*/
                $resultAll = $model->table($table)->field("goods.goods_id")->join($join)->on($on)->where($where)->page('10000')->order($order)->select();
                /*根据所有作品ID找出对应的搜索信息*/
                foreach($resultAll as $k=>$v){
                $str_id .= ','.$v['goods_id'];
                }
                $str_id = ltrim($str_id,',');
                if(!empty($str_id)){
                /*搜索新的名家名称*/
                $name_sql = "SELECT g.goods_id,g.artist_id,a.A_Id,a.A_Name FROM shop_goods g , shop_artist a  WHERE g.goods_id IN(".$str_id.") AND g.artist_id=a.A_Id GROUP BY A_Name";
                $result_name = $model->query($name_sql);
                /*搜索新的环境*/
                $sql_14 = "SELECT * FROM shop_goods_attr_index g , shop_attribute_value a  WHERE g.goods_id IN(".$str_id.") AND g.attr_value_id=a.attr_value_id AND g.attr_id = 14 GROUP BY attr_value_name";
                $result_14 = $model->query($sql_14);
                /*搜索新的职位*/
                $sql_15 = "SELECT * FROM shop_goods_attr_index g , shop_attribute_value a  WHERE g.goods_id IN(".$str_id.") AND g.attr_value_id=a.attr_value_id AND g.attr_id = 15 GROUP BY attr_value_name";
                $result_15 = $model->query($sql_15);
                /*搜索新的形制*/
                $sql_16 = "SELECT * FROM shop_goods_attr_index g , shop_attribute_value a  WHERE g.goods_id IN(".$str_id.") AND g.attr_value_id=a.attr_value_id AND g.attr_id = 16 GROUP BY attr_value_name";
                $result_16 = $model->query($sql_16);
                }
                /*作品信息分页*/
                $result = $model->table($table)->field("*")->join($join)->on($on)->where($where)->page('35')->order($order)->select();
        }else{
                $where = "artist_id <> '' ";
                /*作品总数*/
                $goods_max = $model->table('goods,artist')->field("count(*) as goods_max")->join('inner')->on('goods.artist_id = artist.A_Id')->where($where)->find();
                /*作品信息分页*/
                $result = $model->table('goods,artist')->field("*")->join('inner')->on('goods.artist_id = artist.A_Id')->where($where)->page('35')->order($order)->select();
        }
        /*加载翻页样式*/
        Tpl::output('page_1', $model->showpage(6));
        Tpl::output('page', $model->showpage(2));
        return array('goods_max'=>$goods_max,'result'=>$result,'resultAll'=>$resultAll,'result_name'=>$result_name,'result_14'=>$result_14,'result_15'=>$result_15,'result_16'=>$result_16);
        }



        /*数据修改*/
        // public function goods_upOp(){
        //         $res_array = array();
        //         $model = Model();
        //         $comm_sql = "SELECT goods_commonid,goods_name,goods_serial FROM shop_goods_common LIMIT 10000";
        //         $result = $model->query($comm_sql);
        //         foreach($result as $k=>$v){
        //                 $str .= $v['goods_commonid'].',';
        //         }
        //         echo $str = rtrim($str,',');
        //         // var_dump($result);
        //         exit;
        //         foreach($result as $k=>$v){
        //                 $goods_sql = "SELECT goods_id,goods_commonid,goods_name,goods_serial FROM shop_goods WHERE goods_serial = '".trim($v['goods_serial'])."' LIMIT 1";
        //                 $goods_res = $model->query($goods_sql);
        //                 $goods_res['0']['goodsid'] = $v['goods_commonid'];
        //                 $goods_res['0']['serial'] = $v['goods_serial'];
        //                 if($goods_res['0']['goods_id'] != $goods_res['0']['goodsid']){

        //                         /*修改goods表*/
        //                         // $sql_u = "UPDATE shop_goods SET goods_id='".$goods_res['0']['goodsid']."' WHERE goods_serial = '".trim($v['goods_serial'])."' AND goods_commonid = '".$goods_res['0']['goodsid']."'";
        //                         array_push($res_array,$goods_res);
        //                         // $model->query($sql_u);
        //                         /*修改属性表*/
        //                         // $sql_x = "UPDATE shop_goods_attr_index SET goods_id='".$goods_res['0']['goodsid']."' , goods_commonid='".$goods_res['0']['goodsid']."' WHERE goods_id = '".$goods_res['0']['goods_id']."'";
        //                         // $model->query($sql_x);
        //                 }
        //         }
        // var_dump($res_array);
        // }



        /*书画资讯*/
        private function shuhuaNews($name){
            $model = Model();
            $result = $model->table('cms_article')->field('article_id,article_title,article_publish_time')->where("article_publisher_id=306418 AND article_class_id=55 AND article_content LIKE '%".$name."%'")->order('article_id DESC')->select();
            return $result;
        }


}
