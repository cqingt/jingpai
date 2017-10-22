<?php
/**
 * 艺术家官网手机列表
 *
 *
 */


defined('InShopNC') or exit('Access Invalid!');
class artist_blogControl extends mobileHomeControl{

    private $artist_id;

    private $artist_model;

    private $artist_info;

	public function __construct() {
        parent::__construct();

        $this->artist_id = $_GET['aid']?$_GET['aid']:234;

        $this->artist_model = Model('artist_new');

        $this->artist_info = $this->artist_model->getArtistInfo($this->artist_id);

        $this->artist_info = $this->getArtistZhiCheng($this->artist_info);

        //判断是否赞过
        $member_id = $_SESSION['member_id'];
        $condition['C_Aid'] = $this->artist_id;
        $condition['C_MemberId'] = $member_id;
        $zanCangInfo = $this->artist_model->getArtistZanOrCang($condition);
        if(!empty($zanCangInfo)){
            $c_zan = $zanCangInfo['C_Zan'];
            $c_cang = $zanCangInfo['C_Cang'];
            Tpl::output('c_zan',$c_zan);
            Tpl::output('c_cang',$c_cang);
        }

        //赞的数量
        $zan_num = $this->artist_model->getArtistZanCount(array('C_Aid'=>$this->artist_id));

        Tpl::output('aid',$this->artist_id);

        Tpl::output('zan_num',$zan_num);

        Tpl::output('artist_info',$this->artist_info);

		Tpl::setDir('artist_new');

		Tpl::setLayout('artist_blog_layout');
    }


    /**
     * 艺术家博客首页

     */
    public function indexOp(){

        // 推荐作品
        $goods_model = Model('goods');
        $condition['artist_id'] = $this->artist_id;
        $field = 'goods_id,goods_name,goods_price,goods_image';
        $order = 'artist_order DESC , goods_id';
        $goods_list = $goods_model->getGoodsListByColorDistinct($condition,$field,$order,4);

        // 艺术资讯
        $condition_zixun['article_publisher_id'] = 306418;
        $condition_zixun['article_class_id'] = 55;
        $artist_name = $this->artist_info['A_Name'];
        $condition_zixun['article_content'] = array(array('like',"%$artist_name%"));
        $field_zixun = 'article_id,article_title,article_publish_time,article_content,article_author';
        $zixun_info = $this->artist_model->getYishuZixun($condition_zixun,$field_zixun,4,'article_publish_time desc');

        // 艺术相册
        $condition_img['I_ArtistId'] = intval($_GET['aid']);
        $order_img = 'I_Xu DESC';
        $artist_img_list = $this->artist_model->getArtistImages($condition_img,4,$order_img);

        Tpl::output('zixun_info', $zixun_info);
        Tpl::output('artist_img_list', $artist_img_list);
        Tpl::output('goods_list',$goods_list);
        Tpl::showpage('blog_home');
    }

    /**
     * 个人简介

     */
    public function jianjieOp(){
        Tpl::showpage('blog_jianjie');
    }


    /**
     * 艺术相册

     */
    public function xiangceOp(){

        $condition['I_ArtistId'] = intval($_GET['aid']);

        $order = 'I_Xu DESC';

        $artist_img_list = $this->artist_model->getArtistImages($condition,20,$order);

        //获取总页码
        $str = '#<span .*>(.*)</span>#Uis';
        preg_match($str,$this->artist_model->showpage(88),$arr);
        $page_num = substr($arr[1] , 2 , 1 );

        Tpl::output('page_num' , $page_num);

        Tpl::output('artist_img_list', $artist_img_list);

        Tpl::showpage('blog_xiangce');
    }

    /**
     * 艺术相册翻页   ajax自动加载

     */
    public function ajaxxiangceOp(){

        $condition['I_ArtistId'] = intval($_GET['aid']);

        $order = 'I_Xu DESC';

        $artist_img_list = $this->artist_model->getArtistImages($condition,20,$order);

        $this->artist_model->showpage(88);

        if(!empty($artist_img_list)){
            echo json_encode($artist_img_list);
        }else{
            echo 0;
        }
    }

    /**
     * 艺术资讯

     */
    public function zixunOp(){

        $condition['article_publisher_id'] = 306418;

        $condition['article_class_id'] = 55;

        $artist_name = $this->artist_info['A_Name'];

        $condition['article_content'] = array(array('like',"%$artist_name%"));

        $field = 'article_id,article_title,article_publish_time,article_content,article_author';

        $zixun_info = $this->artist_model->getYishuZixun($condition,$field);

        $str = '#<span .*>(.*)</span>#Uis';
        preg_match($str,$this->artist_model->showpage(88),$arr);
        $page_num = substr($arr[1] , 2 , 1 );

        // Dump($zixun_info);

        Tpl::output('zixun_info',$zixun_info);

        Tpl::output('page_num' , $page_num);

        Tpl::showpage('blog_zixun');
    }
    /**
     * 艺术资讯翻页   ajax自动加载
     */
    public function ajaxzixunOp(){

        $condition['article_publisher_id'] = 306418;

        $condition['article_class_id'] = 55;

        $artist_name = $this->artist_info['A_Name'];

        $condition['article_content'] = array(array('like',"%$artist_name%"));

        $field = 'article_id,article_title,article_publish_time,article_content,article_author';

        $zixun_info = $this->artist_model->getYishuZixun($condition,$field);
        foreach($zixun_info as $key => $val){
            $zixun_info[$key]['url'] = urlWap('artist_new','artist_default',array('article_id'=> $val['article_id']));
        }

        if($zixun_info){
            echo json_encode($zixun_info);
        }else{
            echo 0;
        }
    }

    /**
     * 艺术作品

     */
    public function zuopingOp(){

        $goods_model = Model('goods');

        $condition['artist_id'] = $this->artist_id;

        $field = 'goods_id,goods_name,goods_price,goods_image';

        $order = 'goods_id DESC';

        $goods_list = $goods_model->getGoodsListByColorDistinct($condition,$field,$order,20);

        $str = '#<span .*>(.*)</span>#Uis';
        preg_match($str,$this->artist_model->showpage(88),$arr);
        $page_num = substr($arr[1] , 2 , 1 );

        Tpl::output('goods_list', $goods_list);

        Tpl::output('page_num' , $page_num);

        Tpl::showpage('blog_zuoping');
    }

    /**
     * 艺术作品翻页  下拉自动加载效果
     */
    public function ajaxzuopingOp(){

        $goods_model = Model('goods');

        $condition['artist_id'] = $this->artist_id;

        $field = 'goods_id,goods_name,goods_price,goods_image';

        $order = 'goods_id DESC';

        $goods_list = $goods_model->getGoodsListByColorDistinct($condition,$field,$order,20);

        foreach($goods_list as $key => $val){
            $goods_list[$key]['goods_image'] = cthumb($val['goods_image'],360);
            $goods_list[$key]['goods_price'] = ($val['goods_price'] < 1)?"价格：咨询客服":'¥'.intval($val['goods_price']);
            $goods_list[$key]['goods_url'] = urlWap('goods','index',array('goods_id'=>$val['goods_id']));
        }
        if(!empty($goods_list)){
            echo json_encode($goods_list);
        }else{
            echo 0;
        }
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

        // Dump($pinglun_info);

        Tpl::output('pinglun_info', $pinglun_info);

        Tpl::output('totalNum', $this->artist_model->getTotalNum());

        Tpl::output('show_page', $this->artist_model->showpage(3));

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

            $artistInfo['array_zhicheng'] = array_slice(explode('|',$artistInfo['A_ZhiCheng']),0,2);

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
