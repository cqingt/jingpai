<?php
/**
 * 艺术家官网手机列表
 *
 *
 */


defined('InShopNC') or exit('Access Invalid!');
class artist_newControl extends mobileHomeControl{
    //艺术分类
    private $_yishu_class = array('1'=>'书画','2'=>'国画','3'=>'油画','4'=>'版画');

	public function __construct() {
        parent::__construct();
		Tpl::setDir('artist_new');
		Tpl::setLayout('artist_new_layout');
    }

    /**
     * 艺术家列表
     */
	public function listOp()
    {
        $model_artist = Model('artist_new');

        $zhiwei = $model_artist->getYishuZhiwei();

        $address = $model_artist->getYishuAddress();

        //艺术分类
        if (!empty(intval($_GET['class']))) {
            $condition['A_Class'] = intval($_GET['class']);;
        }

        //地区名家
        if (!empty(intval($_GET['address']))) {
            $condition['A_JiGuan'] = intval($_GET['address']);
        }

        //职位
        if (!empty(intval($_GET['zhiwei']))) {
            $condition['A_Position'] = array(array('like',"%$_GET[zhiwei]%"));
        }

        //搜索词
        if (!empty($_GET['keyword'])) {
            $condition['A_Name'] = array(array('like',"%$_GET[keyword]%"));
        }

        $field = 'A_Id,A_Name,A_ZhiCheng,A_Img';

        $order_by = 'A_OrderBy ASC';

        $artist_list_info = $model_artist->getArtistList($condition,$field,'',$order_by,20);
        $artist_list_info = $this -> getzhicheng($artist_list_info);
        // Dump($artist_list_info);

        Tpl::output('artist_list', $artist_list_info);

        Tpl::output('yishuClass',$this->_yishu_class);

        Tpl::output('zhiwei',$zhiwei);

        Tpl::output('address',$address);

        Tpl::showpage('list');
    }

    /**
     * 艺术家列表  ajax自动加载下一页
     */
    public function list_ajaxOp(){
        $page = $_GET['page'];

        $n = ($page - 1) * 20;
        $model_artist = Model('artist_new');

        $zhiwei = $model_artist->getYishuZhiwei();

        $address = $model_artist->getYishuAddress();

        //艺术分类
        if (!empty(intval($_GET['class']))) {
            $condition['A_Class'] = intval($_GET['class']);;
        }

        //地区名家
        if (!empty(intval($_GET['address']))) {
            $condition['A_JiGuan'] = intval($_GET['address']);
        }

        //职位
        if (!empty(intval($_GET['zhiwei']))) {
            $condition['A_Position'] = array(array('like',"%$_GET[zhiwei]%"));
        }

        //搜索词
        if (!empty($_GET['keyword'])) {
            $condition['A_Name'] = array(array('like',"%$_GET[keyword]%"));
        }

        $field = 'A_Id,A_Name,A_ZhiCheng,A_Img';

        $order_by = 'A_OrderBy ASC';

        $artist_list_info = $model_artist->getArtistListLimit($condition,$field,'',$order_by,$n . ',20');
        $artist_list_info = $this -> getzhicheng($artist_list_info);

        if(!empty($artist_list_info)) {
            echo json_encode($artist_list_info);
            exit;
        }else{
            echo 0;
            exit;
        }
    }

    /**
     * 资讯详情页
     */
    public function artist_defaultOp()
    {
        $article_id = $_GET['article_id'];
        $model_article = Model('cms_article');
        $article_detail = $model_article->getOne(array('article_id'=>$article_id));
        Tpl::output('article_detail' , $article_detail);
        Tpl::showpage('article_default');
    }

    /**
     * 公共方法   获取第一个职称
     * @param $artistInfo
     * @return array|bool
     */
    private function getzhicheng($artistInfo)
    {
        if(isset($artistInfo) && is_array($artistInfo)){

            foreach($artistInfo as $key => $val) {
                $a_zhicheng = explode('|' , $val['A_ZhiCheng']);
                $artistInfo[$key]['A_ZhiCheng'] = $a_zhicheng[0];
            }

            return $artistInfo;
        }else{
            return false;
        }
    }

}
