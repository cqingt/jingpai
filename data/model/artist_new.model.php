<?php
/**
 * 艺术家作者管理
 */
defined('InShopNC') or exit('Access Invalid!');

class artist_newModel extends Model{
    public function __construct(){
        parent::__construct();
    }

    /**
     * 艺术家信息
     *
     */
    public function getArtistInfo($artist_id) {

        $condition['A_Id'] = $artist_id;

        $condition['A_Web'] = 1;

        $on = 'artist.A_Id=artist_web.W_Aid';

        return $this->table('artist,artist_web')->join('left')->on($on)->where($condition)->find();
    }



    /**
     * 艺术家列表
     *
     */
    public function getArtistList($condition='', $field = '*', $group = '',$order = '', $page = 0, $count = 0) {
        return $this->table('artist')->field($field)->where($condition)->group($group)->order($order)->page($page, $count)->select();
    }
    /**
     * 艺术家列表
     *
     */
    public function getArtistListLimit($condition='', $field = '*', $group = '',$order = '', $limit) {
        return $this->table('artist')->field($field)->where($condition)->group($group)->order($order)->limit($limit)->select();
    }


    /**
     * 艺术分类
     *
     */
    public function getYishuClass($id){

        $condition['gc_parent_id'] = $id;
		$condition['gc_id'] = array('neq','658');
        $result = $this->table('goods_class')->field("gc_id,gc_name,type_id,type_name,gc_parent_id,is_artist")->where($condition)->order('gc_sort ASC')->select();

        if(!empty($result)){
            foreach ($result as $k => &$v) {
                if(!empty($v['gc_id'])){
                    $v['xiaji_class'] = $this->getYishuClass($v['gc_id']);
                }else{
                    return false;
                }
            }
            return $result;
        }else{
            return false;
        }
    }

    /**
     * 艺术家职位
     *
     */
    public function getYishuZhiwei(){
        
        $result = $this->table('artist_position')->field("P_Id,P_Name")->select();

        return $result;
    }


    /**
     * 艺术家地区
     *
     */
    public function getYishuAddress(){
        
        $jiguan_info = $this->table('artist')->field('A_JiGuan')->where(array('A_JiGuan'=>array('neq',0)))->group('A_JiGuan')->select();

        $address_id = '';

        foreach ($jiguan_info as $k => $v) {
            $address_id .= $v['A_JiGuan'].',';
        }

        $condition['area_id'] = array('in',$address_id);

        $address_array_info = $this->table('area')->where($condition)->select();

        return $address_array_info;
    }


    /**
     * 艺术家资讯
     *
     */
    public function getYishuZixun($condition,$field='*',$page=0,$order=''){

        $result =  $this->table('cms_article')->field($field)->where($condition)->page($page)->order($order)->select();

        foreach ($result as $k => &$v) {
            /*提取IMG属性*/
            preg_match('/<img.*?src="(.*?)".*?>/is',stripcslashes($v['article_content']),$array);
            $res = preg_replace('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+\"\/>/i','',stripcslashes($v['article_content']));

            $v['N_Img'] = $array['0'];
            $v['N_Img_Url'] = $array['1'];

            $v['N_Content'] = strip_tags($res);
        }

        return $result;
    }





    /**
     * 根据商品分类搜索出属性
     *
     */
    public function getGoodsAttribute($gc_id){
        
        $type_id = $this->table('goods_class')->field('type_id')->where(array('gc_id'=>$gc_id))->find();

        $type_id = $type_id['type_id'];

        $attr_id_array = $this->table('attribute')->where(array('type_id'=>$type_id))->select();

        $attr_array = array();

        if(!empty($attr_id_array)){
            foreach ($attr_id_array as $k => $v) {
                $attr_array[$k]['attr_name'] = $v['attr_name'];
                $attr_array[$k]['attr_value'] = $this->table('attribute_value')->where(array('attr_id'=>$v['attr_id']))->select();

                foreach ($attr_array[$k]['attr_value'] as $key => $value) {
                    $attr_array[$k]['attr_id'] .= ','.$value['attr_value_id'].',';
                }

            }
            return $attr_array;
        }else{
            return false;
        }
    }




    /**
     * 艺术家-评论
     *
     */
    public function getArtistPinglun($condition,$field='*',$page=20,$order='',$group=''){
        return $this->table('artist_pinglun')->field($field)->where($condition)->page($page)->group($group)->order($order)->select();
    }
	
	/**
     * 艺术家评论-删除
     *
     */
    public function delArtistPinglun($id=0){
		if(is_array($id)){
			$condition['P_Id'] = array('in',$id);
			$condition1['H_Pid'] = array('in',$id);
		}else{
			$condition['P_Id'] = $id;
			$condition1['H_Pid'] = $id;
		}
        $this->table('artist_pinglun')->where($condition)->delete(); //删除评论       
		$this->table('artist_pinglun_huifu')->where($condition1)->delete(); //删除回复    
    }

    /**
     * 艺术家-个人-评论
     *
     */
    public function getArtistPinglunById($artist_id,$field='*',$page=10,$order='P_AddTime DESC'){

        $condition['P_ArtistId'] = $artist_id;

        $pinglun_info = $this->getArtistPinglun($condition,$field,$page,$order);
        foreach ($pinglun_info as $k => &$v) {
            $pl_huifu = $this->table('artist_pinglun_huifu')->where(array('H_Pid'=>$v['P_Id']))->order('H_AddTime DESC')->select();
            $v['Pl_Huifu_count'] = count($pl_huifu);
            $v['Pl_Huifu'] = $pl_huifu;
        }

        return $pinglun_info;
    }


    /**
     * 艺术家-赞-收藏
     *
     */
    public function getArtistZanOrCang($condition){

        return $this->table('artist_cang')->where($condition)->find();
        
    }


    /**
     * 搜索该艺术家有多少个赞
     *
     */
    public function getArtistZanCount($condition){

        return $this->table('artist_cang')->where($condition)->count();
        
    }


    /**
     * 艺术家-相册
     *
     */
    public function getArtistImages($condition,$page='20',$order=''){
		
        return $this->table('artist_images')->where($condition)->page($page)->order($order)->select();
       
    }


    /**
     * 艺术家-收藏
     *
     */
    public function getArtistShoucang($condition,$page='',$order='',$field='*'){

            $result = $this->table('artist_cang,artist')->field($field)->join('left')->on('artist_cang.C_Aid=artist.A_Id')->where($condition)->page($page)->order($order)->select();        

            if(!empty($result)){
                return $result;
            }else{
                return false;
            }

    }

    /**
     * 艺术家-入驻手机号
     *
     */
    public function getArtistJoinMobileOne($condition){

        return $this->table('artist_join')->where($condition)->find();        

    }

    /**
     * 艺术家-获取定制信息一条
     *
     */
    public function getArtistCustomOne($condition='',$field='*'){

        $result = $this->table('artist_custom')->field($field)->where($condition)->find();        

        if(!empty($result)){
            return $result;
        }else{
            return false;
        }

    }

    /**
     * 艺术家-获取定制信息
     *
     */
    public function getArtistCustomList($condition='',$field='*',$order='',$page=20,$limit=''){

        $result = $this->table('artist_custom')->field($field)->where($condition)->order($order)->page($page)->limit($limit)->select();        

        if(!empty($result)){
            return $result;
        }else{
            return false;
        }

    }


    /**
     * 艺术家-入驻
     *
     */
    public function addArtistJoin($data){

        return $this->table('artist_join')->insert($data);        

    }


    /**
     * 艺术家-定制
     *
     */
    public function addArtistCustom($data){

        $result = $this->table('artist_custom')->insert($data);

        if(!empty($result)){
            return $result;
        }else{
            return false;
        }
        
    }


    /**
     * 艺术家-收藏删除
     *
     */
    public function delArtistShoucang($condition){

        return $this->table('artist_cang')->where($condition)->delete();        

    }





	
}
