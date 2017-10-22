<?php
/**
 * 艺术家首页
 *
 ***/
defined('InShopNC') or exit('Access Invalid!');

class artist_blogControl extends ArtistHomeControl {

    private $artist_id;

    private $artist_model;

    private $artist_info;

	public function __construct() {
        parent::__construct();

        $this->artist_id = $_GET['aid'] ? $_GET['aid']:234;

        $this->artist_model = Model('artist_new');

        $this->artist_info = $this->artist_model->getArtistInfo($this->artist_id);

        // 赞总数
        $condition_zan['C_Aid'] = $this->artist_id;
        $condition_zan['C_Zan'] = '1';
        $artist_zan_count = $this->artist_model->getArtistZanCount($condition_zan);


      



        Tpl::output('artist_zan_count',$artist_zan_count);

        Tpl::output('aid',$this->artist_id);

        Tpl::output('topimg',$this->artist_info['A_Topimg']);

        Tpl::output('sou_top',true);
    }


	/**
	 * 艺术家博客首页

	 */
	public function indexOp(){

        $this->artist_info = $this->getArtistZhiCheng($this->artist_info);

        // 推荐作品
        $goods_model = Model('goods');
        $condition['artist_id'] = $this->artist_id;
        $field = 'goods_id,goods_name,goods_price,goods_image';
        $order = 'artist_order DESC , goods_id';
        $goods_list = $goods_model->getGoodsListByColorDistinct($condition,$field,$order,5);

        // 艺术资讯
        // $condition_zixun['article_publisher_id'] = 306418;
        $condition_zixun['article_class_id'] = 55;
        $artist_name = $this->artist_info['A_Name'];//|article_content
        $condition_zixun['article_title'] = array(array('like',"%$artist_name%"));
        $field_zixun = 'article_id,article_title,article_publish_time,article_content';
        $zixun_info = $this->artist_model->getYishuZixun($condition_zixun,$field_zixun,4,'article_id desc');


        // 艺术相册
        $condition_img['I_ArtistId'] = intval($_GET['aid']);
        $order_img = 'I_Xu DESC';
        $artist_img_list = $this->artist_model->getArtistImages($condition_img,5,$order_img);

		Tpl::output('html_title',$this->artist_info['A_Name'].' '.$this->artist_info['A_Name'].'书画代表作品-收藏天下');
        Tpl::output('seo_keywords',$this->artist_info['A_Name'].' '.$this->artist_info['A_Name'].'书画代表作品');
        Tpl::output('seo_description',$this->artist_info['A_Name']);


        Tpl::output('zixun_info', $zixun_info);
        Tpl::output('artist_img_list', $artist_img_list);
        Tpl::output('goods_list',$goods_list);
        Tpl::output('artist_info',$this->artist_info);
		Tpl::showpage('blog_home');
	}

    /**
     * 个人简介

     */
    public function jianjieOp(){

        $this->artist_info = $this->getArtistZhiCheng($this->artist_info);


        // 艺术相册
        $condition_img['I_ArtistId'] = intval($_GET['aid']);
        $order_img = 'I_Xu DESC';
        $artist_img_list = $this->artist_model->getArtistImages($condition_img,20,$order_img);

        Tpl::output('artist_img_list', $artist_img_list);

        Tpl::output('artist_info',$this->artist_info);
		Tpl::output('html_title',$this->artist_info['A_Name'].'的简介 '.$this->artist_info['A_Name'].'的资料-收藏天下');
        Tpl::output('seo_keywords',$this->artist_info['A_Name'].'画家,艺术名家,收藏天下');
        Tpl::output('seo_description',$this->artist_info['A_Name']);
        Tpl::showpage('blog_jianjie');
    }


    /**
     * 艺术相册

     */
    public function xiangceOp(){

        $condition['I_ArtistId'] = intval($_GET['aid']);

        $order = 'I_Xu DESC';

        $artist_img_list = $this->artist_model->getArtistImages($condition,20,$order);


        Tpl::output('artist_img_list', $artist_img_list);

        Tpl::output('show_page', $this->artist_model->showpage(3));
		Tpl::output('html_title',$this->artist_info['A_Name'].'相册-收藏天下');
        Tpl::output('seo_keywords',$this->artist_info['A_Name'].'画家,艺术名家,收藏天下');
        Tpl::output('seo_description',$this->artist_info['A_Name']);
        Tpl::showpage('blog_xiangce');
    }

    /**
     * 艺术资讯

     */
    public function zixunOp(){

        // $condition['article_publisher_id'] = 306418;

        $condition['article_class_id'] = 55;

        $artist_name = $this->artist_info['A_Name'];
		//|article_content
        $condition['article_title'] = array(array('like',"%$artist_name%"));

        $field = 'article_id,article_title,article_publish_time,article_content';

        $zixun_info = $this->artist_model->getYishuZixun($condition,$field);

        // Dump($zixun_info);

        Tpl::output('zixun_info',$zixun_info);

        Tpl::output('show_page', $this->artist_model->showpage(3));
		Tpl::output('html_title',$this->artist_info['A_Name'].'资讯 '.$this->artist_info['A_Name'].'拍卖信息-收藏天下');
        Tpl::output('seo_keywords',$this->artist_info['A_Name'].'画家,艺术名家,收藏天下');
        Tpl::output('seo_description',$this->artist_info['A_Name']);
        Tpl::showpage('blog_zixun');
    }

    /**
     * 艺术作品

     */
    public function zuopingOp(){

        $goods_model = Model('goods');

        $condition['artist_id'] = $this->artist_id;

        $field = 'goods_id,goods_name,goods_price,goods_image';

        $order = 'goods_id DESC';

        if (in_array($_GET['order_key'],array('1','2','3'))) {
            $sequence = $_GET['order'] == '1' ? 'asc' : 'desc';
            $order = str_replace(array('1','2','3'), array('goods_salenum','goods_click','goods_promotion_price'), $_GET['order_key']);
            $order .= ' '.$sequence;
        }

        //艺术家名搜索
        if(!empty($_GET['keyword'])){

            $condition['goods_name'] = array(array('like',"%$_GET[keyword]%"));

        }

		
        $goods_list = $goods_model->getGoodsListByColorDistinct($condition,$field,$order,20);
        Tpl::output('goods_list', $goods_list);
		Tpl::output('CountGoods', $goods_model->gettotalnum());
        Tpl::output('show_page', $goods_model->showpage(3));
		Tpl::output('html_title',$this->artist_info['A_Name'].'作品赏析 '.$this->artist_info['A_Name'].'作品鉴赏 '.$this->artist_info['A_Name'].'书画作品鉴定-收藏天下');
        Tpl::output('seo_keywords',$this->artist_info['A_Name'].'画家,艺术名家,收藏天下');
        Tpl::output('seo_description',$this->artist_info['A_Name']);
        Tpl::showpage('blog_zuoping');
    }

    /**
     * 留言板

     */
    public function liuyanOp(){

        $pinglun_info = $this->artist_model->getArtistPinglunById($this->artist_id);

        foreach ($pinglun_info as $key => &$value) {
            if($value['Pl_Huifu']){
                foreach ($value['Pl_Huifu'] as $k => &$v) {
                    $v['re_day'] = $this->re_day(time()-$v['H_AddTime']);
                }
            }
        }

        Tpl::output('pinglun_info', $pinglun_info);

        Tpl::output('totalNum', $this->artist_model->getTotalNum());

        Tpl::output('show_page', $this->artist_model->showpage(3));
		
		Tpl::output('html_title',$this->artist_info['A_Name'].'留言板-收藏天下');
        Tpl::output('seo_keywords',$this->artist_info['A_Name'].'画家,艺术名家,收藏天下');
        Tpl::output('seo_description',$this->artist_info['A_Name']);

        Tpl::showpage('blog_liuyan');
    }


    /**
     * 留言板-评论提交

     */
    public function addPinglunOp(){

        // $data['state']
        $data = array();

        if($_SESSION['is_login'] !== '1'){
            echo 11;
            exit;
        }

        if(empty($_POST['data'])){
            echo 22;
            exit;
        }

        if(!empty($_SESSION['artist_pinglun_time'])){
            $d_time = time() - $_SESSION['artist_pinglun_time'];

            if($d_time < 15){
                echo 33;
                exit;
            }

        }

        $dataArr['P_MemberId'] = $_SESSION['member_id'];
        $dataArr['P_MemberName'] = $_SESSION['member_name'];
        $dataArr['P_Content'] = $_POST['data'];
        $dataArr['P_ArtistId'] = $this->artist_id;
        $dataArr['P_AddTime'] = time();
        
        $result = Model()->table('artist_pinglun')->insert($dataArr);

        if($result){

            $_SESSION['artist_pinglun_time'] = $dataArr['P_AddTime'];

            echo 1;
            exit;
        }else{
            echo 22;
            exit;
        }


    }

    /**
     * 留言板-评论回复提交

     */
    public function addPinglunHuifuOp(){

        $data['state'];
        $data = array();

        if($_SESSION['is_login'] !== '1'){
            echo 11;
            exit;
        }

        if(!empty($_SESSION['artist_pinglun_time'])){
            $d_time = time() - $_SESSION['artist_pinglun_time'];

            if($d_time < 15){
                echo 33;
                exit;
            }

        }

        $content = preg_replace('/\s+/',',',$_POST['data']);
        $huifu = explode(',',$content);

        if($huifu[0] == '回复' && $huifu[2] == '::'){
            if($_SESSION['member_name'] != $huifu[1]){
                $zd_member_name = $huifu[1];
            }
            $content = ltrim(strstr($_POST['data'],'::'),'::');
        }else{
            $content = $_POST['data'];
        }

        if(empty($content)){
            echo 22;
            exit;
        }

        $dataArr['H_Pid'] = $_POST['Pid'];
        $dataArr['H_MemberId'] = $_SESSION['member_id'];
        $dataArr['H_MemberName'] = $_SESSION['member_name'];
        $dataArr['H_ZdMemberId'] = '';
        $dataArr['H_ZdMemberName'] = $zd_member_name?$zd_member_name:'';
        $dataArr['H_Content'] = $content;
        $dataArr['H_AddTime'] = time();
        
        $result = Model()->table('artist_pinglun_huifu')->insert($dataArr);

        if($result){

            $_SESSION['artist_pinglun_time'] = $dataArr['H_AddTime'];

            echo 1;
            exit;
        }else{
            echo 22;
            exit;
        }


    }

    /**
     * 点赞 OR 收藏

     */
    public function isZan_CangOp(){

        $aid = intval($_POST['aid']);
        $member_id = $_SESSION['member_id'];
        $type = $_POST['type'];

        if($_SESSION['is_login'] !== '1'){
            echo 11;
            exit;
        }

        if(!$aid || !$member_id){
            echo 22;
            exit;
        }

        if(!empty($_SESSION['artist_zan_cang'])){
            $d_time = time() - $_SESSION['artist_zan_cang'];

            if($d_time < 5){
                echo 44;
                exit;
            }
        }

        $condition['C_Aid'] = $aid;
        $condition['C_MemberId'] = $member_id;
        $zanCangInfo = $this->artist_model->getArtistZanOrCang($condition);


        if(!empty($zanCangInfo)){


            if($type == 'zan' && $zanCangInfo['C_Zan'] != 1){
                $dataArr['C_Zan'] = 1;
            }elseif($type == 'cang' && $zanCangInfo['C_Cang'] != 1){
                $dataArr['C_Cang'] = 1;
            }else{

                $_SESSION['artist_zan_cang'] = time();
                echo 33;
                exit;
            }

            if($this->artist_model->table('artist_cang')->where($condition)->update($dataArr)){
                $_SESSION['artist_zan_cang'] = time();
                echo 1;
                exit;
            }else{
                echo 22;
                exit;
            }


        }else{


            if($type == 'zan'){
                $dataArr['C_Aid'] = $aid;
                $dataArr['C_MemberId'] = $member_id;
                $dataArr['C_Zan'] = 1;
            }elseif($type == 'cang'){
                $dataArr['C_Aid'] = $aid;
                $dataArr['C_MemberId'] = $member_id;
                $dataArr['C_Cang'] = 1;
            }

            if(!empty($dataArr)){
                if($this->artist_model->table('artist_cang')->insert($dataArr)){
                    $_SESSION['artist_zan_cang'] = time();
                    echo 1;
                    exit;
                }else{
                    echo 22;
                    exit;
                }
            }else{
                echo 22;
                exit;
            }

        }






    }

















    /**


        公用方法


     */

    /**
     *  艺术家职称
     *  
     */
    private function getArtistZhiCheng($artistInfo){
        if(isset($artistInfo) && is_array($artistInfo)){

            $artistInfo['array_zhicheng'] = explode('|',$artistInfo['A_ZhiCheng']);

            return $artistInfo;
        }else{
            return false;
        }
    }




    /**
     *  留言回复时间
     *  
     */

    private function re_day($miao){

        if($miao < 60){  //分

            return '1分钟内';
        }

        if($miao < 3600){  //分

            $day = '分钟';

            $str = intval($miao/(60));

        }

        if($miao > 3600 && $miao < 86400){  //小时

            $day = '小时';

            $str = intval($miao/(60*60));

        }

        if($miao > 86400 && $miao < 2592000){   // 天
            $day = '天';

            $str = intval($miao/(60*60*24));
        }

        if($miao > 2592000 && $miao < 31104000){   // 月
            $day = '月';

            $str = intval($miao/(60*60*24*30));
        }

        if($miao > 31104000 ){   // 年
            $day = '年';

            $str = intval($miao/(60*60*24*30*12));
        }

        return $str.$day.'前';

    }




}


?>