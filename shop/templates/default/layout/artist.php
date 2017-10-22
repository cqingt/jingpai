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
        $artistGoods = $artist_model->artistGoods($artistid);
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
        /*加载SEO*/
        Tpl::output('html_title',$result['W_Title']);
        Tpl::output('seo_keywords',$result['W_Keywords']);
        Tpl::output('seo_description',$result['W_Description']);
        /*加载艺术家模板*/
        Tpl::showpage('artist.index');
	}




        /*艺术家作品列表*/
        public function listOp(){
        $result = $this->artistInfoOp();


        Tpl::output('goods_max',$result['goods_max']);//产品总数
        Tpl::output('result',$result['result']);//产品环境
        /*艺术家筛选属性*/
        //实例化属性数据表
        $attr_model = Model('artist');
        //加载所有名家
        $condition['field'] = 'A_Id,A_Name';
        $result_name = $attr_model->getArtist($condition,'1000');
        //环境
        $result_14 = $attr_model->getArtistAttr('attr_id = 14 AND type_id = 4');
        //职位
        $result_15 = $attr_model->getArtistAttr('attr_id = 15 AND type_id = 4');
        //形制
        $result_16 = $attr_model->getArtistAttr('attr_id = 16 AND type_id = 4');
        /*加载信息*/
        Tpl::output('result_name',$result_name);//产品环境
        Tpl::output('result_14',$result_14);//产品环境
        Tpl::output('result_15',$result_15);//产品职位
        Tpl::output('result_16',$result_16);//产品形制
        /*加载模板*/
        Tpl::showpage('artist.list');
        }


        /*所有艺术家产品*/
        private function artistInfoOp($wherejoin=''){
        $model = Model();
                        $goods_max = $model->table('goods,artist')->field("count(*) as goods_max")->join('inner')->on('goods.artist_id = artist.A_Id')->where($where)->find();
exit;
        if($wherejoin){
                $where = "artist_id <> '' ";
                /*作品总数*/
                $goods_max = $model->table('goods,artist,goods_attr_index')->field("count(*) as goods_max")->join('inner,left')->on('goods.artist_id = artist.A_Id,goods_attr_index.goods_id=goods.goods_id')->where($where)->find();
                /*作品信息分页*/
                $result = $model->table('goods,artist,goods_attr_index')->field("*")->join('inner,left')->on('goods.artist_id = artist.A_Id')->where($where)->page('35')->select();
                /*所有作品信息*/
                $resultAll = $model->table('goods,artist,goods_attr_index')->field("goods_id")->join('inner,left')->on('goods.artist_id = artist.A_Id')->where($where)->page('10000')->select();
                /*根据所有作品ID找出对应的搜索信息*/
                foreach($resultAll as $k=>$v){
                $str_id .= ','.$v['goods_id'];
                }
                $str_id = ltrim($str_id,',');
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
        }else{
                $where = "artist_id <> '' ";
                /*作品总数*/
                $goods_max = $model->table('goods,artist')->field("count(*) as goods_max")->join('inner')->on('goods.artist_id = artist.A_Id')->where($where)->find();
                /*作品信息分页*/
                $result = $model->table('goods,artist')->field("*")->join('inner')->on('goods.artist_id = artist.A_Id')->where($where)->page('35')->select();
                /*所有作品信息*/
                $resultAll = $model->table('goods,artist')->field("goods_id")->join('inner')->on('goods.artist_id = artist.A_Id')->where($where)->page('10000')->select();
                /*根据所有作品ID找出对应的搜索信息*/
                foreach($resultAll as $k=>$v){
                $str_id .= ','.$v['goods_id'];
                }
                $str_id = ltrim($str_id,',');
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
        /*加载翻页样式*/
        Tpl::output('page_1', $model->showpage(6));
        Tpl::output('page', $model->showpage(2));
        return array('goods_max'=>$goods_max,'result'=>$result,'resultAll'=>$resultAll,'result_name'=>$result_name,'result_14'=>$result_14,'result_15'=>$result_15,'result_16'=>$result_16);
        }


}
