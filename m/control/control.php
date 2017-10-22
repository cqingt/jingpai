<?php
/**
 * mobile父类
 *
 *
 * by 33hao.com 好商城V3 运营版
 */


defined('InShopNC') or exit('Access Invalid!');

/********************************** 前台control父类 **********************************************/

class mobileControl{

    //客户端类型
    protected $client_type_array = array('android', 'wap', 'wechat', 'ios');
    //列表默认分页数
    protected $page = 10;


	public function __construct() {

        // 禁止82698访问
        $this->stop82698();

        $this->test_is_app();
        
        Language::read('mobile');

        //分页数处理
        $page = intval($_GET['page']);
        if($page > 0) {
            $this->page = $page;
        }

    }

    /*检测是否APP访问*/
    protected function test_is_app(){

        $userAgent = $_SERVER['HTTP_USER_AGENT'];

        if(preg_match('/(atsctx_app)/i',$userAgent)){
            $_SESSION['app_'] = true;
            Tpl::output('app_',true);
        }

        if(preg_match('/(android)/i',$userAgent)){
            $_SESSION['app_android'] = true;
            Tpl::output('app_android',true);
        }

    }



    /**
     * 输出会员等级
     * @param bool $is_return 是否返回会员信息，返回为true，输出会员信息为false
     */
    protected function getMemberAndGradeInfo($is_return = false){
        $member_info = array();
        //会员详情及会员级别处理
        if($_SESSION['member_id']) {
            $model_member = Model('member');
            $member_info = $model_member->getMemberInfoByID($_SESSION['member_id']);
            if ($member_info){
                $member_gradeinfo = $model_member->getOneMemberGrade(intval($member_info['member_exppoints']));
                $member_info = array_merge($member_info,$member_gradeinfo);
            }
        }
        if ($is_return == true){//返回会员信息
            return $member_info;
        } else {//输出会员信息
            Tpl::output('member_info',$member_info);
        }
    }


    protected function test_is_weixin(){

        $this->wx_browser = strpos($_SERVER['HTTP_USER_AGENT'],"MicroMessenger");

        if($_GET['push_openid']){
            $_SESSION['push_openid'] = trim($_GET['push_openid']);
        }

        if($this->wx_browser && !$_SESSION['openid']){
            if(empty($_SESSION['primary_url'])){
                $_SESSION['primary_url'] = urlencode(get_url());
            }
            $getOpenIdUrl = urlWap('weixin','index');
            header("location:$getOpenIdUrl");

        }


    }


    protected function test_is_crm_ywy(){
        if(!empty($_SESSION['openid']) && empty($_SESSION['yw_id']) && empty(intval($_GET['yw_id']))){

            $condition['openid'] = $_SESSION['openid'];

            $member_yw_info = Model()->table('openid')->where($condition)->find();

            $_SESSION['yw_id'] = $member_yw_info['UID'];

        }

        if(!empty(intval($_GET['yw_id'])) && empty($_SESSION['yw_id'])){

            $_SESSION['yw_id'] = intval($_GET['yw_id']);

        }

    }


    /*禁止非96567域名打开 Add is name lt 2016-08-05*/

    protected function stop82698(){
        $http = strtolower($_SERVER['HTTP_HOST']);
        $act = strtolower($_GET['act']);
        if($http == 'ads.82698.com' && $act != 'zhuanti'){
            header('HTTP/1.1 404 Not Found'); 
            header('status: 404 Not Found');
            exit();
        }
    }




}


/*手机站公用类*/

class mobileHomeControl extends mobileControl{
	public function __construct() {
        parent::__construct();

        Tpl::setDir('home');

        Tpl::setLayout('home_layout');

        $this->test_is_weixin();

        $this->test_is_crm_ywy();

    }
}

/*手机站个人中心类*/

class mobileMemberControl extends mobileControl{

    protected $member_info = array();

	public function __construct() {
        parent::__construct();

        Tpl::setDir('member');

        Tpl::setLayout('member_layout');

        $this->test_is_weixin();

        $this->test_is_crm_ywy();

        $model_member = Model('member');
        $this->member_info = $model_member->getMemberInfoByID($_SESSION['member_id']);
        if(empty($this->member_info)) {
            showWapMessage('请登录',urlWap('login','index'),'error');
        } else {
            //读取卖家信息
            $seller_info = Model('seller')->getSellerInfo(array('member_id'=>$this->member_info['member_id']));
            $this->member_info['store_id'] = $seller_info['store_id'];
            /*会员信息*/
            $this->getMemberAndGradeInfo(false);
        }


    }
}


/*手机站商家中心*/

class mobileSellerControl extends mobileControl{

    protected $member_info = array();

    public function __construct() {
        parent::__construct();

        Tpl::setDir('seller');

        Tpl::setLayout('home_layout');

        $this->test_is_weixin();

        $this->test_is_crm_ywy();

    }


    
}


class BaseCircleControl{
    protected $identity = 0;	// 身份	0游客 1圈主 2管理 3成员 4申请中 5申请失败 6禁言
    protected $c_id = 0;		// 圈子id
    protected $cm_info = array();	// Members of the information
    protected $m_readperm = 0;	// Members read permissions
    protected $super = 0;
    /**
     * 构造函数
     */
    public function __construct(){
        /**
         * 验证圈子是否开启
         */
//        if (C('circle_isuse') != '1'){
//            @header('location: '.SHOP_SITE_URL);die;
//        }
        /**
         * 读取通用、布局的语言包
         */
        Language::read('common');
        /**
         * 设置布局文件内容
         */
//        Tpl::setLayout('circle_layout');
        /**
         * 查询是否是超管
         */
        $this->checkSuper();
        /**
         * 获取导航
         */
//        Tpl::output('nav_list',($nav = F('nav')) ? $nav : rkcache('nav',true,'file'));
    }
    private function checkSuper() {
        if($_SESSION['is_login']){
            $super = Model('circle_member')->getSuperInfo(array('member_id' => $_SESSION['member_id']));
            $this->super = empty($super) ? 0 : 1;
        }
        Tpl::output('super', $this->super);
    }
    /**
     * 圈子信息
     */
    protected function circleInfo(){
        $this->circle_info = Model()->table('circle')->find($this->c_id);
        if(empty($this->circle_info)){
            showMessage(L('circle_group_not_exists'), '', '', 'error');
        }
        Tpl::output('circle_info', $this->circle_info);
    }
    /**
     * 取出楼主信息
     */
    protected function getLouZhu($member_id){

        $getLouZhu = Model()->table('circle_member')->where(array('circle_id'=>$this->c_id, 'member_id'=>$member_id))->find();
        if(!empty($getLouZhu)){
            switch (intval($getLouZhu['cm_state'])){
                case 1:
                    $identity = intval($getLouZhu['is_identity']);
                    break;
                case 0:
                    $identity = 4;
                    break;
                case 2:
                    $identity = 5;
                    break;
            }
            // 禁言
            if($getLouZhu['is_allowspeak'] == 0){
                $identity = 6;
            }
        }
        Tpl::output('cm_info', $getLouZhu);
        Tpl::output('identity', $identity);
    }
    /**
     * 圈主和管理信息
     */
    protected function manageList(){
        $prefix = 'circle_managelist';
        //$manager_list = rcache($this->c_id, $prefix);

        if (empty($manager_list)) {
            $manager_list = Model()->table('circle_member')->where(array('circle_id'=>$this->c_id, 'is_identity'=>array('in', array(1,2))))->select();
            $manager_list = array_under_reset($manager_list, 'is_identity', 2);
            $manager_list[2] = array_under_reset($manager_list[2], 'member_id', 1);
            wcache($this->c_id,$manager_list,$prefix);
        }
        Tpl::output('creator', $manager_list[1][0]);

        Tpl::output('manager_list', $manager_list[2]);
    }
    /**
     * 会员信息
     */
    protected function memberInfo(){
        if($_SESSION['is_login']){
            $this->cm_info = Model()->table('circle_member')->where(array('circle_id'=>$this->c_id, 'member_id'=>$_SESSION['member_id']))->find();
            if(!empty($this->cm_info)){
                switch (intval($this->cm_info['cm_state'])){
                    case 1:
                        $this->identity = intval($this->cm_info['is_identity']);
                        break;
                    case 0:
                        $this->identity = 4;
                        break;
                    case 2:
                        $this->identity = 5;
                        break;
                }
                // 禁言
                if($this->cm_info['is_allowspeak'] == 0){
                    $this->identity = 6;
                }
            }
            Tpl::output('cm_info', $this->cm_info);
        }
        Tpl::output('identity', $this->identity);
    }
    /**
     * sidebar相关信息
     */
    protected function sidebar(){
        $prefix = 'circle_sidebar';
        $data = rcache($this->c_id, $prefix);
        if (empty($data)) {
            // 圈子所属分类
            $data['class_info'] = Model()->table('circle_class')->find($this->circle_info['class_id']);

            // 明星圈友
            $data['star_member'] = Model()->table('circle_member')->where(array('cm_state'=>1, 'circle_id'=>$this->c_id, 'is_star'=>1))->order('rand()')->limit(5)->select();

            // 最新加入
            $data['newest_member'] = Model()->table('circle_member')->where(array('cm_state'=>1, 'circle_id'=>$this->c_id))->order('cm_jointime desc')->limit(5)->select();

            // 友情圈子
            $data['friendship_list'] = Model()->table('circle_fs')->where(array('circle_id'=>$this->c_id, 'friendship_status'=>1))->order('friendship_sort asc')->select();
        }
        Tpl::output('class_info', $data['class_info']);
        Tpl::output('star_member', $data['star_member']);
        Tpl::output('newest_member', $data['newest_member']);
        Tpl::output('friendship_list', $data['friendship_list']);
    }
    /**
     * 最新话题/热门话题/人气回复
     */
    protected function themeTop(){
        $prefix = 'circle_themetop';
        $data = rcache('circle', $prefix);
        if (empty($data)) {
            $model = Model();
            // 最新话题
            $data['new_themelist'] = $model->table('circle_theme')->where(array('is_closed'=>0))->order('theme_id desc')->limit(10)->select();
            if($data['new_themelist']){
                // 附件
                $data['new_themelist'] = array_under_reset($data['new_themelist'], 'theme_id');
                $themeid_array = array_keys($data['new_themelist']);
                $affix_list = $model->table('circle_affix')->where(array('theme_id'=>array('in', $themeid_array), 'affix_type'=>1))->group('theme_id')->select();
                if(!empty($affix_list)) $affix_list = array_under_reset($affix_list, 'theme_id');
                foreach ($data['new_themelist'] as $key=>$val){
                    if(isset($affix_list[$val['theme_id']])) $data['new_themelist'][$key]['affix'] = themeImageUrl($affix_list[$val['theme_id']]['affix_filethumb']);

                }
            }
            // 热门话题
            $data['hot_themelist'] = $model->table('circle_theme')->where(array('is_closed'=>0))->order('theme_browsecount desc')->limit(10)->select();
            // 人气回复
            $data['reply_themelist'] = $model->table('circle_theme')->where(array('is_closed'=>0))->order('theme_commentcount desc')->limit(10)->select();
        }
        Tpl::output('new_themelist', $data['new_themelist']);
        Tpl::output('hot_themelist', $data['hot_themelist']);
        Tpl::output('reply_themelist', $data['reply_themelist']);
    }
    /**
     * SEO
     */
    protected function circleSEO($title= '') {
        Tpl::output('html_title',$title.' '.C('circle_seotitle').'');
        Tpl::output('seo_keywords',C('circle_seokeywords'));
        Tpl::output('seo_description',C('circle_seodescription'));
    }

    /**
     * Read permissions
     */
    protected function readPermissions($cm_info){
        $data = rkcache('circle_level') ? rkcache('circle_level') : rkcache('circle_level', true);
        $rs = array();
        $rs[0] = 0;
        $rs[0] = L('circle_no_limit');
        foreach ($data as $v){
            $rs[$v['mld_id']]	= $v['mld_name'];
        }
        switch ($cm_info['is_identity']){
            case 1:
            case 2:
                $rs['255'] = L('circle_administrator');
                $this->m_readperm = 255;
                return $rs;
                break;
            case 3:
                $rs = array_slice($rs, 0, intval($cm_info['cm_level'])+1, true);
                $this->m_readperm = $cm_info['cm_level'];
                return $rs;
                break;
        }
    }
    /**
     * breadcrumb navigation
     */
    protected function breadcrumd($param = ''){
        $crumd = array(
            0=>array(
                'link'=>CIRCLE_SITE_URL,
                'title'=>L('nc_index')
            ),
            1=>array(
                'link'=>CIRCLE_SITE_URL.'/index.php?act=group&c_id='.$this->c_id,
                'title'=>$this->circle_info['circle_name']
            ),
        );
        if(!empty($this->theme_info)){
            $crumd[2] = array(
                'link'=>CIRCLE_SITE_URL.'/index.php?act=theme&op=theme_detail&c_id='.$this->c_id.'&t_id='.$this->t_id,
                'title'=>$this->theme_info['theme_name']
            );
        }
        if(empty($param)){
            unset($crumd[(count($crumd)-1)]['link']);
        }else{
            $crumd[]['title'] = $param;
        }
        Tpl::output('breadcrumd', $crumd);
    }
}

class BaseCircleThemeControl extends BaseCircleControl{
    protected $circle_info = array();	// 圈子详细信息
    protected $t_id = 0;		// 话题id
    protected $theme_info = array();	// 话题详细信息
    protected $r_id = 0;		// 回复id
    protected $reply_info = array();	// reply info
    protected $cm_info = array();		// Members of the information
    public function __construct(){
        parent::__construct();
        Language::read('circle');

        $this->c_id = intval($_GET['c_id']);
        if($this->c_id <= 0){
            @header("location: ".CIRCLE_SITE_URL);
        }
        Tpl::output('c_id', $this->c_id);
    }
    /**
     * 话题信息
     */
    protected function themeInfo(){
        $this->t_id = intval($_GET['t_id']);
        if($this->t_id <= 0){
            @header("location: ".CIRCLE_SITE_URL);
        }
        Tpl::output('t_id', $this->t_id);

        $this->theme_info = Model()->table('circle_theme')->where(array('circle_id'=>$this->c_id, 'theme_id'=>$this->t_id))->find();
        if(empty($this->theme_info)){
            showMessage(L('circle_theme_not_exists'), '', '', 'error');
        }
        // 话题信息
        $this->getLouZhu($this->theme_info['member_id']);
        Tpl::output('theme_info', $this->theme_info);
    }
    /**
     * 验证回复
     */
    protected function checkReplySelf(){
        $this->t_id = intval($_GET['t_id']);
        if($this->t_id <= 0){
            showDialog(L('wrong_argument'));
        }
        Tpl::output('t_id', $this->t_id);

        $this->r_id = intval($_GET['r_id']);
        if($this->r_id <= 0){
            showDialog(L('wrong_argument'));
        }
        Tpl::output('r_id', $this->r_id);

        $this->reply_info = Model()->table('circle_threply')->where(array('theme_id'=>$this->t_id, 'reply_id'=>$this->r_id, 'member_id'=>$_SESSION['member_id']))->find();
        if(empty($this->reply_info)){
            showDialog(L('wrong_argument'));
        }
        Tpl::output('reply_info', $this->reply_info);
    }
    /**
     * 验证话题
     */
    protected function checkThemeSelf(){
        $this->t_id = intval($_GET['t_id']);
        if($this->t_id <= 0){
            showDialog(L('wrong_argument'));
        }
        Tpl::output('t_id', $this->t_id);

        $this->theme_info = Model()->table('circle_theme')->where(array('theme_id'=>$this->t_id, 'member_id'=>$_SESSION['member_id']))->find();
        if(empty($this->theme_info)){
            showDialog(L('wrong_argument'));
        }
        Tpl::output('theme_info', $this->theme_info);
    }
}
/*
 *文章管理类
 * add name mk
 * add time 2016-11-08
 * */
class BaseCircleManageControl extends BaseCircleControl{
    protected $circle_info = array();	// 圈子详细信息
    protected $t_id = 0;		// 话题id
    protected $theme_info = array();	// 话题详细信息
    protected $identity = 0;	// 身份	0游客 1圈主 2管理 3成员
    protected $cm_info = array();	// 会员信息
    public function __construct(){
        parent::__construct();
        $this->c_id = intval($_GET['c_id']);
        if($this->c_id <= 0){
            @header("location: ".CIRCLE_SITE_URL);
        }
        Tpl::output('c_id', $this->c_id);
    }
    /**
     * 圈子信息
     */
    protected function circleInfo(){
        // 圈子信息
        $this->circle_info = Model()->table('circle')->find($this->c_id);
        if(empty($this->circle_info)) @header("location: ".CIRCLE_SITE_URL);
        Tpl::output('circle_info', $this->circle_info);
    }


    /**
     * 会员信息
     */
    protected function circleMemberInfo(){
        // 会员信息
        $this->cm_info = Model()->table('circle_member')->where(array('circle_id'=>$this->c_id, 'member_id'=>$_SESSION['member_id']))->find();
        if(!empty($this->cm_info)){
            $this->identity = $this->cm_info['is_identity'];
            Tpl::output('cm_info', $this->cm_info);
        }
        if(in_array($this->identity, array(0,3))){
//            @header("location: ".CIRCLE_SITE_URL);
        }
        Tpl::output('identity', $this->identity);
    }
    /**
     * 去除圈主
     */
    protected function removeCreator($array){
        return array_diff($array, array($this->cm_info['member_id']));
    }
    /**
     * 去除圈主和管理
     */
    protected function removeManager($array){
        $where = array();
        $where['is_identity']	= array('in', array(1,2));
        $where['circle_id']		= $this->c_id;
        $cm_info = Model()->table('circle_member')->where($where)->select();
        if(empty($cm_info)){
            return $array;
        }
        foreach ($cm_info as $val){
            $array = array_diff($array, array($val['member_id']));
        }
        return $array;
    }
    /**
     * 身份验证
     */
    protected function checkIdentity($type){		// c圈主 m管理 cm圈主和管理
        $this->cm_info = Model()->table('circle_member')->where(array('circle_id'=>$this->c_id, 'member_id'=>$_SESSION['member_id']))->find();
        $identity = intval($this->cm_info['is_identity']); $sign = false;
        switch ($type){
            case 'c':
                if($identity != 1) $sign = true;
                break;
            case 'm':
                if($identity != 2) $sign = true;
                break;
            case 'cm':
                if($identity != 1 && $identity != 2) $sign = true;
                break;
            default:
                $sign = true;
                break;
        }
        if ($this->super) {
            $sign = false;
        }
        if($sign){
            return L('circle_permission_denied');
        }
    }
    /**
     * 会员加入的圈子
     */
    protected function memberJoinCircle(){
        // 所属圈子信息
        $circle_array = Model()->table('circle,circle_member')->field('circle.*,circle_member.is_identity')
            ->join('inner')->on('circle.circle_id=circle_member.circle_id')
            ->where(array('circle_member.member_id'=>$_SESSION['member_id']))->select();
        Tpl::output('circle_array', $circle_array);
    }
    /**
     * Top Navigation
     */
    protected  function sidebar_menu($sign, $child_sign=''){
        $menu = array(
            'index'=>array('menu_name'=>L('circle_basic_setting'), 'menu_url'=>'index.php?act=manage&c_id='.$this->c_id),
            'member'=>array('menu_name'=>L('circle_member_manage'), 'menu_url'=>'index.php?act=manage&op=member_manage&c_id='.$this->c_id),
            'applying'=>array('menu_name'=>L('circle_wait_apply'), 'menu_url'=>'index.php?act=manage&op=applying&c_id='.$this->c_id),
            'level'=>array('menu_name'=>L('circle_member_level'), 'menu_url'=>'index.php?act=manage_level&op=level&c_id='.$this->c_id),
            'class'=>array('menu_name'=>L('circle_tclass'), 'menu_url'=>'index.php?act=manage&op=class&c_id='.$this->c_id),
            'inform'=>array(
                'menu_name'=>L('circle_inform'),
                'menu_url'=>'index.php?act=manage_inform&op=inform&c_id='.$this->c_id,
                'menu_child'=>array(
                    'untreated'=>array('name'=>L('circle_inform_untreated'), 'url'=>'index.php?act=manage_inform&op=inform&c_id='.$this->c_id),
                    'treated'=>array('name'=>L('circle_inform_treated'), 'url'=>'index.php?act=manage_inform&op=inform&type=treated&c_id='.$this->c_id)
                ),
            ),
            'managerapply'=>array('menu_name'=>L('circle_mapply'), 'menu_url'=>'index.php?act=manage_mapply&c_id='.$this->c_id),
            'friendship'=>array('menu_name'=>L('fcircle'), 'menu_url'=>'index.php?act=manage&op=friendship&c_id='.$this->c_id)
        );
        if($this->identity == 2){
            unset($menu['index']);unset($menu['member']);unset($menu['level']);unset($menu['class']);unset($menu['friendship']);
            unset($menu['inform']['menu_child']['untreated']);unset($menu['managerapply']);
        }
        Tpl::output('sidebar_menu', $menu);
        Tpl::output('sidebar_sign', $sign);
        Tpl::output('sidebar_child_sign', $child_sign);
    }
}
/*
 * 个人主页类
 * add name mk
 * add time 2016-11-7
 *  */
class Control{

    /**
     * 检查短消息数量
     *
     */
    protected function checkMessage() {
        if($_SESSION['member_id'] == '') return ;
        //判断cookie是否存在
        $cookie_name = 'msgnewnum'.$_SESSION['member_id'];
        if (cookie($cookie_name) != null){
            $countnum = intval(cookie($cookie_name));
        }else {
            $message_model = Model('message');
            $countnum = $message_model->countNewMessage($_SESSION['member_id']);
            setNcCookie($cookie_name,"$countnum",2*3600);//保存2小时
        }
        Tpl::output('message_num',$countnum);
    }

    /**
     *  输出头部的公用信息
     *
     */
    protected function showLayout() {
        $this->checkMessage();//短消息检查
        $this->article();//文章输出

        $this->showCartCount();

        Tpl::output('hot_search',@explode(',',C('hot_search')));//热门搜索

        $model_class = Model('goods_class');
        $goods_class = $model_class->get_all_category();
        Tpl::output('show_goods_class',$goods_class);//商品分类

        //获取导航
        Tpl::output('nav_list', rkcache('nav',true));
    }

    /**
     * 显示购物车数量
     */
    protected function showCartCount() {
        if (cookie('cart_goods_num') != null){
            $cart_num = intval(cookie('cart_goods_num'));
        }else {
            //已登录状态，存入数据库,未登录时，优先存入缓存，否则存入COOKIE
            if($_SESSION['member_id']) {
                $save_type = 'db';
            } else {
                $save_type = 'cookie';
            }
            $cart_num = Model('cart')->getCartNum($save_type,array('buyer_id'=>$_SESSION['member_id']));//查询购物车商品种类
        }
        Tpl::output('cart_goods_num',$cart_num);
    }

    /**
     * 输出会员等级
     * @param bool $is_return 是否返回会员信息，返回为true，输出会员信息为false
     */
    protected function getMemberAndGradeInfo($is_return = false){
        $member_info = array();
        //会员详情及会员级别处理

        if($_SESSION['member_id']) {
//        if(425585) {
            $model_member = Model('member');
            $member_info = $model_member->getMemberInfoByID($_SESSION['member_id']);
            if ($member_info){
                $member_gradeinfo = $model_member->getOneMemberGrade(intval($member_info['member_exppoints']));
                $member_info = array_merge($member_info,$member_gradeinfo);
            }
        }
        if ($is_return == true){//返回会员信息
            return $member_info;
        } else {//输出会员信息
            Tpl::output('member_info',$member_info);
        }
    }

    /**
     * 验证会员是否登录
     *
     */
    protected function checkLogin(){
        if ($_SESSION['is_login'] !== '1'){
            if (trim($_GET['op']) == 'favoritesgoods' || trim($_GET['op']) == 'favoritesstore'){
                $lang = Language::getLangContent('UTF-8');
                echo json_encode(array('done'=>false,'msg'=>$lang['no_login']));
                die;
            }
            $ref_url = request_uri();
            if ($_GET['inajax']){
                showDialog('','','js',"login_dialog();",200);
            }else {
                @header("location: index.php?act=login&ref_url=".urlencode($ref_url));
            }
            exit;
        }
    }

    /**
     * 添加到任务队列
     *
     * @param array $goods_array
     * @param boolean $ifdel 是否删除以原记录
     */
    protected function addcron($data = array(), $ifdel = false) {
        $model_cron = Model('cron');
        if (isset($data[0])) { // 批量插入
            $where = array();
            foreach ($data as $k => $v) {
                if (isset($v['content'])) {
                    $data[$k]['content'] = serialize($v['content']);
                }
                // 删除原纪录条件
                if ($ifdel) {
                    $where[] = '(type = ' . $data['type'] . ' and exeid = ' . $data['exeid'] . ')';
                }
            }
            // 删除原纪录
            if ($ifdel) {
                $model_cron->delCron(implode(',', $where));
            }
            $model_cron->addCronAll($data);
        } else { // 单条插入
            if (isset($data['content'])) {
                $data['content'] = serialize($data['content']);
            }
            // 删除原纪录
            if ($ifdel) {
                $model_cron->delCron(array('type' => $data['type'], 'exeid' => $data['exeid']));
            }
            $model_cron->addCron($data);
        }
    }

    //文章输出
    protected function article() {

        if (C('cache_open')) {
            if ($article = rkcache("index/article")) {
                Tpl::output('show_article', $article['show_article']);
                Tpl::output('article_list', $article['article_list']);
                return;
            }
        } else {
            if (file_exists(BASE_DATA_PATH.'/cache/index/article.php')){
                include(BASE_DATA_PATH.'/cache/index/article.php');
                Tpl::output('show_article', $show_article);
                Tpl::output('article_list', $article_list);
                return;
            }
        }

        $model_article_class	= Model('article_class');
        $model_article	= Model('article');
        $show_article = array();//商城公告
        $article_list	= array();//下方文章
        $notice_class	= array('notice');
        $code_array	= array('member','store','payment','sold','service');
        $notice_limit	= 5;
        $faq_limit	= 5;

        $class_condition	= array();
        $class_condition['home_index'] = 'home_index';
        $class_condition['order'] = 'ac_sort asc';
        $article_class	= $model_article_class->getClassList($class_condition);
        $class_list	= array();
        if(!empty($article_class) && is_array($article_class)){
            foreach ($article_class as $key => $val){
                $ac_code = $val['ac_code'];
                $ac_id = $val['ac_id'];
                $val['list']	= array();//文章
                $class_list[$ac_id]	= $val;
            }
        }

        $condition	= array();
        $condition['article_show'] = '1';
        $condition['home_index'] = 'home_index';
        $condition['field'] = 'article.article_id,article.ac_id,article.article_url,article.article_title,article.article_time,article_class.ac_name,article_class.ac_parent_id';
        $condition['order'] = 'article_sort asc,article_time desc';
        $condition['limit'] = '300';
        $article_array	= $model_article->getJoinList($condition);
        if(!empty($article_array) && is_array($article_array)){
            foreach ($article_array as $key => $val){
                $ac_id = $val['ac_id'];
                $ac_parent_id = $val['ac_parent_id'];
                if($ac_parent_id == 0) {//顶级分类
                    $class_list[$ac_id]['list'][] = $val;
                } else {
                    $class_list[$ac_parent_id]['list'][] = $val;
                }
            }
        }
        if(!empty($class_list) && is_array($class_list)){
            foreach ($class_list as $key => $val){
                $ac_code = $val['ac_code'];
                if(in_array($ac_code,$notice_class)) {
                    $list = $val['list'];
                    array_splice($list, $notice_limit);
                    $val['list'] = $list;
                    $show_article[$ac_code] = $val;
                }
                if (in_array($ac_code,$code_array)){
                    $list = $val['list'];
                    $val['class']['ac_name']	= $val['ac_name'];
                    array_splice($list, $faq_limit);
                    $val['list'] = $list;
                    $article_list[] = $val;
                }
            }
        }

        if (C('cache_open')) {
            wkcache('index/article', array(
                'show_article' => $show_article,
                'article_list' => $article_list,
            ));
        } else {
            $string = "<?php\n\$show_article=".var_export($show_article,true).";\n";
            $string .= "\$article_list=".var_export($article_list,true).";\n?>";
            file_put_contents(BASE_DATA_PATH.'/cache/index/article.php',($string));
        }

        Tpl::output('show_article',$show_article);
        Tpl::output('article_list',$article_list);
    }


    /*禁止非96567域名打开 Add is name lt 2016-08-05*/

    protected function stop82698(){
        $http = strtolower($_SERVER['HTTP_HOST']);
        if($http == 'ads.82698.com'){
            header('HTTP/1.1 404 Not Found');
            header('status: 404 Not Found');
            exit();
        }
    }

    /*Add is name lt 2016-09-20 自动登录*/

    protected function loginAuto(){
        if($_SESSION['is_login'] != '1' && $_COOKIE['is_login_cookie']){
            $model = Model('member');
            $userinfo = $model->getMemberInfoByID($_COOKIE['is_login_cookie']);
            if(!empty($userinfo)){
                $model->createSession($userinfo);
            }
        }
    }


}

class BaseSNSControl extends Control {
    protected $relation = 0;//浏览者与主人的关系：0 表示游客 1 表示一般普通会员 2表示朋友 3表示自己4表示已关注主人
    protected $master_id = 0; //主人编号
    const MAX_RECORDNUM = 20;//允许插入新记录的最大条数
    protected $master_info;

    public function __construct(){

        // 禁止82698访问
        // $this->stop82698();

        //验证会员及与主人关系
        $this->check_relation();

        //查询会员信息
        $this->getMemberAndGradeInfo(false);

        $this->master_info = $this->get_member_info();
        Tpl::output('master_info',$this->master_info);

        //添加访问记录
        $this->add_visit();

        //我的关注
        $this->my_attention();

        //获取设置
        $this->get_setting();

        //允许插入新记录的最大条数
        Tpl::output('max_recordnum',self::MAX_RECORDNUM);

        $this->showCartCount();

        Tpl::output('nav_list', rkcache('nav',true));
    }

    /**
     * 格式化时间
     * @param string $time时间戳
     */
    protected function formatDate($time){
        $handle_date = @date('Y-m-d',$time);//需要格式化的时间
        $reference_date = @date('Y-m-d',time());//参照时间
        $handle_date_time = strtotime($handle_date);//需要格式化的时间戳
        $reference_date_time = strtotime($reference_date);//参照时间戳
        if ($reference_date_time == $handle_date_time){
            $timetext = @date('H:i',$time);//今天访问的显示具体的时间点
        }elseif (($reference_date_time-$handle_date_time)==60*60*24){
            $timetext = Language::get('sns_yesterday');
        }elseif ($reference_date_time-$handle_date_time==60*60*48){
            $timetext = Language::get('sns_beforeyesterday');
        }else {
            $month_text = Language::get('nc_month');
            $day_text = Language::get('nc_day');
            $timetext = @date("m{$month_text}d{$day_text}",$time);
        }
        return $timetext;
    }

    /**
     * 会员信息
     *
     * @return array
     */
    public function get_member_info() {
        if($this->master_id <= 0){
            showMessage(L('wrong_argument'), '', '', 'error');
        }
        $model = Model();

        $member_info = Model('member')->getMemberInfoByID($this->master_id);

        if(empty($member_info)){
//            echo $this->master_id;
            // showMessage(L('wrong_argument'), 'index.php?act=member_snshome', '', 'error');
        }
        //粉丝数
        $fan_count = $model->table('sns_friend')->where(array('friend_tomid'=>$this->master_id))->count();
        $member_info['fan_count'] = $fan_count;
        //关注数
        $attention_count = $model->table('sns_friend')->where(array('friend_frommid'=>$this->master_id))->count();
        $member_info['attention_count'] = $attention_count;
        //兴趣标签
        $mtag_list = $model->table('sns_membertag,sns_mtagmember')->field('mtag_name')->on('sns_membertag.mtag_id = sns_mtagmember.mtag_id')->join('inner')->where(array('sns_mtagmember.member_id'=>$this->master_id))->select();
        $tagname_array = array();
        if(!empty($mtag_list)){
            foreach ($mtag_list as $val){
                $tagname_array[] = $val['mtag_name'];
            }
        }
        $member_info['tagname'] = $tagname_array;
        return $member_info;
    }

    /**
     * 访客信息
     */
    protected function get_visitor(){
        /*
         *飞仔help！
         * */
        $model = Model();
        $member_id = $_SESSION['member_id'];

        //查询谁来看过我
        $visitme_list = $model->table('sns_visitor')->where(array('v_ownermid'=>$this->master_id))->limit(9)->order('v_addtime desc')->select();
        if (!empty($visitme_list)){
            foreach ($visitme_list as $k=>$v){
                $memlist = $model->table('sns_friend')->where(array('friend_frommid'=>$member_id,'friend_tomid'=>$v['v_mid']))->count();
                $v['memlist'] = $memlist;
                $v['adddate_text'] = $this->formatDate($v['v_addtime']);
                $v['addtime_text'] = @date('H:i',$v['v_addtime']);
                $visitme_list[$k] = $v;
            }

        }
        Tpl::output('visitme_list',$visitme_list);

        $me_num = count($visitme_list);
        Tpl::output('me_num',$me_num);

        if($this->relation == 3){	// 主人自己才有我访问过的人
            //查询我访问过的人
            $visitother_list = $model->table('sns_visitor')->where(array('v_mid'=>$this->master_id))->limit(9)->order('v_addtime desc')->select();
//            $visitother_list = $model->table('sns_visitor')->where(array('v_ownermid'=>$this->master_id))->limit(9)->order('v_addtime desc')->select();
            if (!empty($visitother_list)){
                foreach ($visitother_list as $k=>$v){
                    $memlist = $model->table('sns_friend')->where(array('friend_frommid'=>$member_id,'friend_tomid'=>$v['v_ownermid']))->count();
                    $v['adddate_text'] = $this->formatDate($v['v_addtime']);
                    $v['outhlist'] = $memlist;
                    $visitother_list[$k] = $v;
                }
            }
            Tpl::output('visitother_list',$visitother_list);

        }

        //查看他人访问记录

        $member_id = $_GET['mid'];

        //查询谁来看过他
        $visitme_list = $model->table('sns_visitor')->where(array('v_ownermid'=>$this->master_id))->limit(9)->order('v_addtime desc')->select();
        if (!empty($visitme_list)){
            foreach ($visitme_list as $k=>$v){
                $memlist = $model->table('sns_friend')->where(array('friend_frommid'=>$member_id,'friend_tomid'=>$v['v_mid']))->count();
                $v['memlist'] = $memlist;
                $v['adddate_text'] = $this->formatDate($v['v_addtime']);
                $v['addtime_text'] = @date('H:i',$v['v_addtime']);
                $visitme_list[$k] = $v;
            }

        }
        Tpl::output('ta_visitme_list',$visitme_list);

        $me_num = count($visitme_list);
        Tpl::output('other_num',$me_num);

        if($this->relation == 3){	// 主人自己才有我访问过的人
            //查询他访问过的人
            $visitother_list = $model->table('sns_visitor')->where(array('v_mid'=>$this->master_id))->limit(9)->order('v_addtime desc')->select();
//            $visitother_list = $model->table('sns_visitor')->where(array('v_ownermid'=>$this->master_id))->limit(9)->order('v_addtime desc')->select();
            if (!empty($visitother_list)){
                foreach ($visitother_list as $k=>$v){
                    $memlist = $model->table('sns_friend')->where(array('friend_frommid'=>$member_id,'friend_tomid'=>$v['v_ownermid']))->count();
                    $v['adddate_text'] = $this->formatDate($v['v_addtime']);
                    $v['outhlist'] = $memlist;
                    $visitother_list[$k] = $v;
                }
            }
            Tpl::output('ta_visitother_list',$visitother_list);

        }

    }

    /**
     * 验证会员及主人关系
     */
    private function check_relation(){
        $model = Model();
        //验证主人会员编号
        $this->master_id = intval($_GET['mid']);
        if ($this->master_id <= 0){
//        if ($this->master_id == ''){
            if ($_SESSION['is_login'] == 1){
                //原is_login值为1
                $this->master_id = $_SESSION['member_id'];
//                $this->master_id =515468;
            }else {
                /*update from mk  time 20016-11-08*/
                @header("location: http://m.96567.com/index.php?act=login&ref_url=".urlencode('index.php?act=circle_index'));
                /*end*/
            }
        }
        Tpl::output('master_id', $this->master_id);

        $model = Model();

        //判断浏览者与主人的关系
        if ($_SESSION['is_login'] == '1'){
            if ($this->master_id == $_SESSION['member_id']){//主人自己
                $this->relation = 3;
            }else{
                $this->relation = 1;
                //查询好友表
                $friend_arr = $model->table('sns_friend')->where(array('friend_frommid'=>$_SESSION['member_id'],'friend_tomid'=>$this->master_id))->find();
                if (!empty($friend_arr) && $friend_arr['friend_followstate'] == 2){
                    $this->relation = 2;
                }elseif($friend_arr['friend_followstate'] == 1){
                    $this->relation = 4;
                }
            }
        }
        Tpl::output('relation',$this->relation);
    }

    /**
     * 增加访问记录
     */
    private function add_visit(){
        $model = Model();
        //记录访客
        if ($_SESSION['is_login'] == '1' && $this->relation != 3){
            //访客为会员且不是空间主人则添加访客记录
            $visitor_info = $model->table('member')->find($_SESSION['member_id']);
            if (!empty($visitor_info)){
                //查询访客记录是否存在
                $existevisitor_info = $model->table('sns_visitor')->where(array('v_ownermid'=>$this->master_id, 'v_mid'=>$visitor_info['member_id']))->find();
                if (!empty($existevisitor_info)){//访问记录存在则更新访问时间
                    $update_arr = array();
                    $update_arr['v_addtime'] = time();
                    $model->table('sns_visitor')->update(array('v_id'=>$existevisitor_info['v_id'], 'v_addtime'=>time()));
                }else {//添加新访问记录
                    $insert_arr = array();
                    $insert_arr['v_mid']			= $visitor_info['member_id'];
                    $insert_arr['v_mname']			= $visitor_info['member_name'];
                    $insert_arr['v_mavatar']		= $visitor_info['member_avatar'];
                    $insert_arr['v_ownermid']		= $this->master_info['member_id'];
                    $insert_arr['v_ownermname']		= $this->master_info['member_name'];
                    $insert_arr['v_ownermavatar']	= $this->master_info['member_avatar'];
                    $insert_arr['v_addtime']		= time();
                    $model->table('sns_visitor')->insert($insert_arr);
                }
            }
        }

        //增加主人访问次数
        $cookie_str = cookie('visitor');
        $cookie_arr = array();
        $is_increase = false;
        if (empty($cookie_str)){
            //cookie不存在则直接增加访问次数
            $is_increase = true;
        }else{
            //cookie存在但是为空则直接增加访问次数
            $cookie_arr = explode('_',$cookie_str);
            if(!in_array($this->master_id,$cookie_arr)){
                $is_increase = true;
            }
        }
        if ($is_increase == true){
            //增加访问次数
            $model->table('member')->update(array('member_id'=>$this->master_id, 'member_snsvisitnum'=>array('exp', 'member_snsvisitnum+1')));
            //设置cookie，24小时之内不再累加
            $cookie_arr[] = $this->master_id;
            setNcCookie('visitor',implode('_',$cookie_arr),24*3600);//保存24小时
        }
    }
    //我的关注
    private function my_attention(){
        if(intval($_SESSION['member_id']) >0){
            $my_attention = Model()->table('sns_friend')->where(array('friend_frommid'=>$_SESSION['member_id']))->order('friend_addtime desc')->limit(4)->select();
            Tpl::output('my_attention', $my_attention);
        }
    }

    /**
     * 获取设置信息
     */
    private function get_setting(){
        $m_setting = Model()->table('sns_setting')->find($this->master_id);
        Tpl::output('skin_style', (!empty($m_setting['setting_skin'])?$m_setting['setting_skin']:'skin_01'));
    }
    /**
     * 留言板
     */
    protected function sns_messageboard(){
        $model = Model();
        $where = array();
        $where['from_member_id']	= array('neq',0);
        $where['to_member_id']		= $this->master_id;
        $where['message_state']		= array('neq',2);
        $where['message_parent_id']	= 0;
        $where['message_type']		= 2;
        $message_list = $model->table('message')->where($where)->order('message_id desc')->limit(10)->select();
        if(!empty($message_list)){
            $pmsg_id = array();
            foreach ($message_list as $key=>$val){
                $pmsg_id[]	= $val['message_id'];
                $message_list[$key]['message_time'] = $this->formatDate($val['message_time']);
            }
            $where = array();
            $where['message_parent_id'] = array('in',$pmsg_id);
            $rmessage_array = $model->table('message')->where($where)->select();
            $rmessage_list	= array();
            if(!empty($rmessage_array)){
                foreach ($rmessage_array as $key=>$val){
                    $val['message_time'] = $this->formatDate($val['message_time']);
                    $rmessage_list[$val['message_parent_id']][] = $val;
                }
                foreach ($rmessage_list as $key=>$val){
                    $rmessage_list[$key]	 = array_slice($val, -3, 3);
                }
            }
            Tpl::output('rmessage_list', $rmessage_list);
        }
        Tpl::output('message_list', $message_list);
    }
}
/*
 * 会员control父类
 * add name mk
 * add time 2016-11-09
 * */
class BaseMemberControl extends Control {
    protected $member_info = array();   // 会员信息
    protected $quicklink = array();       // 常用菜单
    public function __construct(){

        // 禁止82698访问
//        $this->stop82698();

        // 自动登录
        $this->loginAuto();

        if(!C('site_status')) halt(C('closed_reason'));

//        Language::read('common,member_layout');

        if ($_GET['column'] && strtoupper(CHARSET) == 'GBK'){
            $_GET = Language::getGBK($_GET);
        }
        //会员验证
//        $this->checkLogin();
        //输出头部的公用信息
//        $this->showLayout();
//        Tpl::setDir('member');
//        Tpl::setLayout('member_layout');

        //获得会员信息
        $this->member_info = $this->getMemberAndGradeInfo(true);
        $this->quicklink = explode(',', $this->member_info['member_quicklink']);
        Tpl::output('member_info', $this->member_info);

        // 常用操作及导航
        $common_menu_list = $this->_getCommonOperationsAndNavLink();

    }

    /**
     * 常用操作
     *
     * @param string $act
     * 如果菜单中的切换卡不在一个菜单中添加$act参数，值为当前菜单的下标
     *
     */
    protected function _getCommonOperationsAndNavLink ($act = '') {
        // 左侧导航
        $menu_list = $this->_getMenuList();
        $operations_list = array();
        foreach ($menu_list as $key => $val) {
            foreach ($val['child'] as $k=>$v) {
                if (in_array($k, $this->quicklink)) {
                    $ql = array_flip($this->quicklink);
                    $operations_list[$ql[$k]] = array_merge($v,array('key' => $k));
                    $menu_list[$key]['child'][$k]['selected'] = true;
                }
                if (($_GET['act'] == $k && $act == '') || $act == $k) {
                    $nav['act'] = $k;
                    $nav['name'] = $v['name'];
                }
            }
        }
        Tpl::output('menu_list', $menu_list);
        // 菜单高亮
        Tpl::output('menu_highlight', $nav['act']);
        ksort($operations_list);
        Tpl::output('common_menu_list', $operations_list);


        // 面包屑
        $nav_link = array();
        $nav_link[] = array('title' => L('homepage'), 'link'=>SHOP_SITE_URL);
        if ($nav == '') {
            $nav_link[] = array('title' => '我的商城');
        } else {
            $nav_link[] = array('title' => '我的商城',  'link' => urlShop('member', 'home'));
            $nav_link[] = array('title' => $nav['name']);
        }
        Tpl::output('nav_link_list',$nav_link);
    }

    /**
     * 买家的左侧上部的头像和订单数量
     *
     */
    public function get_member_info() {
        //生成缓存的键值
        $hash_key = $_SESSION['member_id'];
        //写入缓存的数据
        $cachekey_arr = array('member_name','store_id','member_avatar','member_qq','member_email','member_ww','member_goldnum','member_points',
            'available_predeposit','member_snsvisitnum','credit_arr','order_nopay','order_noreceiving','order_noeval','fan_count');
        if (false){
            foreach ($_cache as $k=>$v){
                $member_info[$k] = $v;
            }
        } else {
            $model_order = Model('order');
            $model_member = Model('member');
            $member_info = $model_member->getMemberInfo(array('member_id'=>$_SESSION['member_id']));
            $member_info['order_nopay'] = $model_order->getOrderStateNewCount(array('buyer_id'=>$_SESSION['member_id']));
            $member_info['order_noreceiving'] = $model_order->getOrderStateSendCount(array('buyer_id'=>$_SESSION['member_id']));
            $member_info['order_noeval'] = $model_order->getOrderStateEvalCount(array('buyer_id'=>$_SESSION['member_id']));
            if (C('voucher_allow') == 1) {
                $time_to = time();//当前日期
                $member_info['voucher'] = Model()->table('voucher')->where(array('voucher_owner_id'=> $_SESSION['member_id'],'voucher_state'=> 1,'voucher_start_date'=> array('elt',$time_to),'voucher_end_date'=> array('egt',$time_to)))->count();
            }
        }
        Tpl::output('member_info',$member_info);
        Tpl::output('header_menu_sign','snsindex');//默认选中顶部“买家首页”菜单
    }

    /**
     * 左侧导航
     * 菜单数组中child的下标要和其链接的act对应。否则面包屑不能正常显示
     * @return array
     */
    private function _getMenuList() {
        $menu_list = array(
            'trade' => array('name' => '交易管理', 'child' => array(
                'member_order'      => array('name' => '实物交易订单', 'url'=>urlShop('member_order', 'index')),
                'lepai_order'      => array('name' => '我的拍卖惠', 'url'=>urlShop('lepai_order', 'index')),
                //'member_vr_order'   => array('name' => '虚拟兑码订单', 'url'=>urlShop('member_vr_order','index')),
                'member_favorites'  => array('name' => '我的收藏', 'url'=>urlShop('member_favorites', 'fglist')),
                'member_evaluate'   => array('name' => '交易评价/晒单', 'url'=>urlShop('member_evaluate', 'list')),
                'predeposit'        => array('name' => '账户余额', 'url'=>urlShop('predeposit', 'pd_log_list')),
                'cangdou'        => array('name' => '<strong style=\'color: red;\'>推荐有礼</strong>', 'url'=>urlShop('cangdou', 'index')),
                //'member_flea'     => array('name' => '我的闲置', 'url'=>urlShop('member_flea', 'index')),
                'member_points'     => array('name' => '我的积分', 'url'=>urlShop('member_points', 'index')),
                'member_voucher'    => array('name' => '我的优惠券', 'url'=>urlShop('member_voucher', 'index'))
            )),
//			'zulin' => array('name' => '租赁管理', 'child' => array(
//                'zu_order'      => array('name' => '租赁订单', 'url'=>urlShop('yizhu', 'index')),
//                'zu_goods'      => array('name' => '租赁产品信息', 'url'=>urlShop('yizhu', 'zu_goods')),
//                'zu_collect_goods'   => array('name' => '我的收藏', 'url'=>urlShop('yizhu','zu_collect_goods'))
//            )),
            'serv' => array('name' => '客户服务', 'child' => array(
                'member_refund'     => array('name' => '退款及退货', 'url'=>urlShop('member_refund', 'index')),
                'member_complain'   => array('name' => '交易投诉', 'url'=>urlShop('member_complain', 'index')),
                'member_consult'    => array('name' => '商品咨询', 'url'=>urlShop('member_consult', 'my_consult')),
                'member_inform'     => array('name' => '违规举报', 'url'=>urlShop('member_inform', 'index')),
                'member_mallconsult'=> array('name' => '平台客服', 'url'=>urlShop('member_mallconsult', 'index'))
            )),
            'info' => array('name' => '资料管理', 'child' => array(
                'member_information'=> array('name' => '账户信息', 'url'=>urlShop('member_information', 'member')),
                'member_security'   => array('name' => '账户安全', 'url'=>urlShop('member_security', 'index')),
                'member_address'    => array('name' => '收货地址', 'url'=>urlShop('member_address', 'address')),
                'member_message'    => array('name' => '我的消息', 'url'=>urlShop('member_message', 'message')),
                //'member_snsfriend'  => array('name' => '我的好友', 'url'=>urlShop('member_snsfriend', 'find')),
                'member_goodsbrowse'=> array('name' => '我的足迹', 'url'=>urlShop('member_goodsbrowse', 'list')),
                //'member_connect'    => array('name' => '第三方账号登录', 'url'=>urlShop('member_connect', 'qqbind')),
                //'member_sharemanage'=> array('name' => '分享绑定', 'url'=>urlShop('member_sharemanage', 'index'))
            ))
            //		,
//            'app' => array('name' => '应用管理', 'child' => array(
//                'sns'               => array('name' => '个人主页', 'url'=>urlShop('member_snshome', 'index')),
//                'cms'               => array('name' => '我的CMS', 'url'=>urlCMS('member_article', 'article_list')),
//                'circle'            => array('name' => '我的圈子', 'url'=>urlCircle('p_center', 'index')),
//                'microshop'         => array('name' => '我的微商城', 'url'=>urlMicroshop('home', 'index', array('member_id' => $_SESSION['member_id'])))
//            ))
        );
        return $menu_list;
    }
}
