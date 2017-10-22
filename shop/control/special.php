<?php
/**
 * cms专题
 *
 * @copyright  
 * @link       
 */
defined('InShopNC') or exit('Access Invalid!');
class specialControl extends BaseHomeControl{

    public function __construct() {
        parent::__construct();
        Tpl::output('index_sign','special');
    }

    public function indexOp() {
        $this->special_listOp();
    }

    /**
     * 专题列表
     */
    public function special_listOp() {
        $conition = array();
        $conition['special_state'] = 2;
        $model_special = Model('cms_special');
        $special_list = $model_special->getShopList($conition, 10, 'special_id desc');
        Tpl::output('show_page', $model_special->showpage(2));
        Tpl::output('special_list', $special_list);

		//分类导航
		$nav_link = array(
			0=>array(
				'title'=>Language::get('homepage'),
				'link'=>SHOP_SITE_URL
			),
			1=>array(
				'title'=>'专题'
			)
		);
		Tpl::output('nav_link_list', $nav_link);

        Tpl::showpage('special_list');
    }

    /**
     * 专题详细页
     */
    public function special_detailOp() {
        $special_file = getCMSSpecialHtml($_GET['special_id']);

        if($special_file) {
			$special = Model('cms_special')->getOne(array('special_id'=>$_GET['special_id']));

            if($special['special_on'] == '1'){
                Tpl::output('html_title',$special['special_title']."-收藏天下");
                Tpl::output('seo_keywords',$special['special_keywords']);
                Tpl::output('seo_description',$special['special_description']);
                Tpl::output('special_file', $special_file);
                Tpl::output('index_sign', 'special');
                Tpl::showpage('special_detail');
            }else{
                showMessage('活动已结束', 'index.php', '', 'error');
            }
        } else {
            showMessage('专题不存在', '', '', 'error');
        }
    }
}
