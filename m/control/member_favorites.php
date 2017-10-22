<?php
/**
 * 会员中心——收藏管理
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class member_favoritesControl extends mobileMemberControl{

	public function __construct(){
		parent::__construct();
	}

    /**
     * 收藏列表
     */
    public function favorites_listOp() {

        $model_favorites = Model('favorites');

        $favorites_list = $model_favorites->getGoodsFavoritesList(array('member_id'=>$_SESSION['member_id']), '*', $this->page);

        $favorites_id = '';

        foreach ($favorites_list as $value){

            $favorites_id .= $value['fav_id'] . ',';

        }

        $favorites_id = rtrim($favorites_id, ',');

        $model_goods = Model('goods');

        $field = 'goods_id,goods_name,goods_price,goods_image,store_id';

        $goods_list = $model_goods->getGoodsList(array('goods_id' => array('in', $favorites_id)), $field);

        foreach ($goods_list as $key=>$value) {

            $goods_list[$key]['fav_id'] = $value['goods_id'];

            $goods_list[$key]['goods_image_url'] = cthumb($value['goods_image'], 240, $value['store_id']);
			//获取促销信息
			$goods_info = Model('goods')->getChuXiao($value['goods_id']);
			if($goods_info['promotion_type'] && $goods_info['promotion_price']){
				$goods_list[$key]['promotion_type'] = $goods_info['promotion_type'];
				$goods_list[$key]['promotion_price'] = $goods_info['promotion_price'];
			}

        }

        Tpl::output('favorites_list',$goods_list);

        Tpl::output('page',$model_goods->showpage(88));

        Tpl::output('html_title','我的收藏 - 会员中心 - 收藏天下');

        Tpl::output('nav_title','我的收藏');

        Tpl::showpage('member_favorites.list');
    }


    /**
     * 删除收藏
     */
    public function favorites_delOp() {

        $fav_id = intval($_GET['fav_id']);

        if ($fav_id <= 0){

            showWapMessage('参数错误','','error');

        }

        $model_favorites = Model('favorites');

        $condition = array();

        $condition['fav_id'] = $fav_id;

        $condition['member_id'] = $_SESSION['member_id'];

        $model_favorites->delFavorites($condition);

        redirect(urlWap('member_favorites','favorites_list'));

    }

    /**
     * 收藏艺术家列表
     */
    public function favorites_artistOp(){
        $member_id = $_SESSION['member_id'];
        $condition['C_MemberId'] = $member_id;
        $condition['C_Cang'] = 1;

        $model_artist = Model('artist_new');

        $artist_shoucang_list = $model_artist->getArtistShoucang($condition);
        //获取总页码
        $str = '#<span .*>(.*)</span>#Uis';
        preg_match($str,$model_artist->showpage(88),$arr);
        $page_num = substr($arr[1] , 2 , 1 );

        Tpl::output('artist_list',$artist_shoucang_list);
        Tpl::output('page_num',$page_num);
        Tpl::output('html_title','我的收藏'.' - 艺术家收藏');
        Tpl::output('nav_title','我的艺术家收藏');
        Tpl::showpage('artist_shoucang');
    }

    /**
     * 收藏艺术家列表翻页   自动加载下一页
     */
    public function ajaxfavorites_artistOp(){
        $member_id = $_SESSION['member_id'];
        $condition['C_MemberId'] = $member_id;
        $condition['C_Cang'] = 1;

        $model_artist = Model('artist_new');

        $artist_shoucang_list = $model_artist->getArtistShoucang($condition);
        if(!empty($artist_shoucang_list)){
            echo json_encode($artist_shoucang_list);
        }else{
            echo 0;
        }
    }

    /*艺术家收藏删除*/
    public function delShoucangOp(){
        $id = $_GET['id'];
        if(empty($id)){
            showWapMessage("缺少参数",'','error');
        }

        $model_artist = Model('artist_new');

        $condition['C_Id'] = $id;
        $condition['C_MemberId'] = $_SESSION['member_id'];

        $model_artist->delArtistShoucang($condition);
        redirect(urlWap('member_favorites','favorites_artist'));
    }
}
