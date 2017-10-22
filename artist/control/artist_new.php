<?php
/**
 * 艺术家首页
 *
 ***/
defined('InShopNC') or exit('Access Invalid!');

class artist_newControl extends ArtistHomeControl {

	//每页显示商品数
    const PAGESIZE = 20;

    //书画默认大类
    const DEFAULT_CLASS = 79;

	//店铺id收藏天下书画馆
    const DEFAULT_STOREID = 22;

    //艺术分类
    private $_yishu_class = array('1'=>'书法','2'=>'国画','3'=>'油画','4'=>'版画');

    //模型对象
    private $_model_search;

	public function __construct() {
        parent::__construct();

        Tpl::output('selOp',$_GET['op']?$_GET['op']:'');
    }


	/**
	 * 默认进入页面

	 */
	public function indexOp(){
		header("Location:index.php"); 
exit;
        // 艺术家推荐
        $model_artist = Model('artist_new');
        $condition_artist['A_Push'] = 1;
        $field_artist = 'A_Id,A_Name,A_MiaoShu,A_Img';
        $order_artist = 'A_OrderBy DESC , A_Id DESC';
        $artist_push_list = $model_artist->getArtistList($condition_artist,$field_artist);

        // 收藏推荐和作品推荐
        $model_web_config = Model('web_config');
        $condition_push['web_page'] = 'artist';
        $condition_push['web_show'] = 1;
        $web_list = $model_web_config->getWebList($condition_push);

        // 艺术资讯
        $condition_zixun['article_publisher_id'] = 306418;
        $condition_zixun['article_class_id'] = 55;
        $field_zixun = 'article_id,article_title';
        $order_zixun = 'article_sort DESC , article_id DESC';
        $artist_zixun_list = $model_artist->getYishuZixun($condition_zixun,$field_zixun,6,$order_zixun);

        // 首页轮播图
        // $model_adv = Model('adv');
        // $condition_adv['ap_id'] = 1090;
        // $artist_index_adv_list = $model_adv->getList($condition_adv);

        // foreach ($artist_index_adv_list as $k => &$v) {
        //     $adv_pic = unserialize($v['adv_content']);

        //     $v['adv_pic'] = $adv_pic['adv_pic'];
        //     $v['adv_pic_url'] = $adv_pic['adv_pic_url'];
        // }
        $model_web_config = Model('web_config');
        $web_id = '211';
        $code_list = $model_web_config->getCodeList(array('web_id'=> $web_id));
        if(is_array($code_list) && !empty($code_list)) {
            foreach ($code_list as $key => $val) {//将变量输出到页面
                $var_name = $val['var_name'];
                $code_info = $val['code_info'];
                $code_type = $val['code_type'];
                $val['code_info'] = $model_web_config->get_array($code_info,$code_type);
                $artist_index_adv_list[] = $val;
                // Tpl::output('code_'.$var_name,$val);
            }
        }

         // 艺术相册
        $order_img = 'I_Xu DESC , I_Id DESC';
        $artist_img_list = $model_artist->getArtistImages('',5,$order_img);

        Tpl::output('html_title','书画馆-书法-国画-油画-版画-名家收藏品-收藏天下');
        Tpl::output('seo_keywords','书画馆,书法收藏,国画收藏,油画收藏,版画收藏,名家收藏');
        Tpl::output('seo_description','收藏天下是国内最专业的收藏品网站,提供各类收藏品,包括书画馆,书法收藏,国画收藏,油画收藏,版画收藏,名家收藏等各类收藏品,并为您提供最新最全的收藏信息');

        Tpl::output('artist_img_list', $artist_img_list);
        Tpl::output('artist_index_adv_list',$artist_index_adv_list);
        Tpl::output('artist_zixun_list',$artist_zixun_list);
        Tpl::output('artist_push_list',$artist_push_list);
        Tpl::output('web_list',$web_list);
		Tpl::showpage('index');
	}





	/**
	 * 艺术家频道-艺术名家
	 
	 */
	public function searchArtistOp(){
		
        $model_artist = Model('artist_new');

        $zhiwei = $model_artist->getYishuZhiwei();
        
        $address = $model_artist->getYishuAddress();

        $seo = '';

        //艺术分类
        if (!empty(intval($_GET['class']))) {
            $condition['A_Class'] = intval($_GET['class']);
            $seo = $this->_yishu_class[intval($_GET['class'])];
        }

        //地区名家
        if (!empty(intval($_GET['address']))) {
            $condition['A_JiGuan'] = intval($_GET['address']);
            foreach ($address as $key => $value) {
                if($value['area_id'] == intval($_GET['address'])){
                    empty($seo)?$seo = $value['area_name']:$seo .= ','.$value['area_name'];
                    continue;
                }
            }
        }

        //职位
        if (!empty(intval($_GET['zhiwei']))) {
            $condition['A_Position'] = array(array('like',"%$_GET[zhiwei]%"));
            foreach ($zhiwei as $key => $value) {
                if($value['P_Id'] == intval($_GET['zhiwei'])){
                    empty($seo)?$seo = $value['P_Name']:$seo .= ','.$value['P_Name'];
                    continue;
                }
            }
        }

        //搜索词
        if (!empty($_GET['keyword'])) {
            $condition['A_Name'] = array(array('like',"%$_GET[keyword]%"));
        }

        $field = 'A_Id,A_Name,A_ZhiCheng,A_Img';

        $order_by = 'A_OrderBy ASC,A_Id desc';

        $artist_list_info = $model_artist->getArtistList($condition,$field,'',$order_by,20);


        Tpl::output('html_title','艺术名家-书画-国画-油画-版画名家收藏天下');
        Tpl::output('seo_keywords','艺术名家,书画名家,国画名家,油画名家,版画名家');
        Tpl::output('seo_description','收藏天下是国内最专业的收藏品网站,提供各类收藏品,包括艺术名家,书画名家,国画名家,油画名家,版画名家等各类艺术名家,并为您提供最新最全的收藏信息');


        Tpl::output('artist_list', $artist_list_info);

		Tpl::output('YiShuCount', $model_artist->gettotalnum());
        Tpl::output('show_page', $model_artist->showpage(3));

        Tpl::output('yishuClass',$this->_yishu_class);

        Tpl::output('zhiwei',$zhiwei);

        Tpl::output('address',$address);
        
        Tpl::showpage('search_artist');
	}





	/**
	 * 艺术家频道-选画中心
	 
	 */
	public function searchShuHuaOp(){

		$model_artist = Model('artist_new');

		$this->_model_search = Model('search');

		$yiShuClass = $model_artist->getYishuClass(self::DEFAULT_CLASS);

		$default_classid = intval($_GET['cate_id']);
		 //搜索的关键字
        $search_keyword = trim($_GET['keyword']);

		list($goods_param, $brand_array, $attr_array, $checked_brand, $checked_attr) = $this->_model_search->getAttr($_GET, $default_classid);
        Tpl::output('brand_array', $brand_array);
        Tpl::output('attr_array', $attr_array);
        Tpl::output('checked_brand', $checked_brand);
        Tpl::output('checked_attr', $checked_attr);



        $order = 'goods_id desc';

        if (in_array($_GET['order_key'],array('1','2','3'))) {
            $sequence = $_GET['order'] == '1' ? 'asc' : 'desc';
            $order = str_replace(array('1','2','3'), array('goods_salenum','goods_click','goods_price'), $_GET['order_key']);
            $order .= ' '.$sequence;
        }

        $model_goods = Model('goods');

        // 字段

        $fields = "goods_id,goods_commonid,goods_name,goods_jingle,artist_id,gc_id,store_id,store_name,goods_price,goods_promotion_price,goods_promotion_type,goods_marketprice,goods_storage,goods_image,goods_freight,goods_salenum,color_id,evaluation_good_star,evaluation_count,is_virtual,is_fcode,is_appoint,is_presell,have_gift,is_own_shop,goods_state,virtual_indate";

        $condition['gc_id'] = $goods_param['class']['gc_id']?$goods_param['class']['gc_id']:self::DEFAULT_CLASS;
		$condition['store_id'] = self::DEFAULT_STOREID;

        //艺术家名搜索
        if(intval($_GET['key_type']) === 1 && !empty($_GET['keyword'])){
        	$artist_info = $model_goods->table('artist')->field('A_Id')->where(array('A_Name'=>$_GET['keyword']))->find();
        	$condition['artist_id'] = $artist_info['A_Id'];
        }

        //作品名
        if(intval($_GET['key_type']) === 2 && !empty($_GET['keyword'])){
        	$condition['goods_name'] = array(array('like',"%$_GET[keyword]%"));
        }


        //自营
        if ($_GET['is_shop'] == 1) {
            $condition['is_own_shop'] = 1;
        }

        //分类检索后的商品ID
        if (isset($goods_param['goodsid_array'])){
            $condition['goods_id'] = array('in', $goods_param['goodsid_array']);
        }

		if($search_keyword){
			$condition['_zidingyi'] = " ( goods_name like '%".$_GET['keyword']."%' OR goods_keywords like '%".$_GET['keyword']."%' OR goods_serial = '".$_GET['keyword']."' OR store_name like '%".$_GET['keyword']."%') AND";
		}

        $goods_list = $model_goods->getGoodsListByColorDistinct($condition, $fields, $order, self::PAGESIZE);


        // 商品多图
        if (!empty($goods_list)) {
            $commonid_array = array(); // 商品公共id数组
            $storeid_array = array();       // 店铺id数组
            foreach ($goods_list as $value) {
                $commonid_array[] = $value['goods_commonid'];
                $storeid_array[] = $value['store_id'];
            }
            $commonid_array = array_unique($commonid_array);
            $storeid_array = array_unique($storeid_array);

            // 商品多图
            $goodsimage_more = Model('goods')->getGoodsImageList(array('goods_commonid' => array('in', $commonid_array)));
			
			

            // 店铺
            $store_list = Model('store')->getStoreMemberIDList($storeid_array);
           

            foreach ($goods_list as $key => $value) {
                // 商品多图
				//zmr>v30
				$n=0;
                foreach ($goodsimage_more as $v) {
                    if ($value['goods_commonid'] == $v['goods_commonid'] && $value['store_id'] == $v['store_id'] && $value['color_id'] == $v['color_id']) {
						$n++;
						$goods_list[$key]['image'][] = $v;
						if($n>=5)break;
                    }
                }
				
                // 店铺的开店会员编号
                $store_id = $value['store_id'];
                $goods_list[$key]['member_id'] = $store_list[$store_id]['member_id'];
                $goods_list[$key]['store_domain'] = $store_list[$store_id]['store_domain'];

                //将关键字置红
                if ($search_keyword){
                    $goods_list[$key]['goods_name_highlight'] = str_replace($search_keyword,'<font style="color:#f00;">'.$search_keyword.'</font>',$value['goods_name']);
                } else {
                    $goods_list[$key]['goods_name_highlight'] = $value['goods_name'];
                }

            }


        }


        // Dump($goods_list);

        $seo = '';

        if(!empty($checked_attr)){
            foreach ($checked_attr as $k => $v) {
                $seo .= $v['attr_value_name'].',';
            }
        }


        Tpl::output('html_title',$seo.'图片-鉴定-价格-收藏-资讯-收藏天下');
        Tpl::output('seo_keywords',$seo);
        Tpl::output('seo_description','收藏天下是国内最专业的收藏品网站,提供各类收藏品,包括['.$seo.']等各类收藏品,并为您提供最新最全的收藏信息');




        Tpl::output('goods_list', $goods_list);

        Tpl::output('totalNum', count($goods_list) == 0 ? '0' : $model_goods->getTotalNum());
        Tpl::output('show_page', $model_goods->showpage(3));


		Tpl::output('yiShuClass',$yiShuClass);
		Tpl::output('goodsAttribute',$goodsAttribute);
		Tpl::showpage('search_shuhua');
	}





    /*我的收藏*/
    public function memberShoucangOp(){
        if($_SESSION['is_login'] != 1){
            showMessage('请登录！');
        }

        $member_id = $_SESSION['member_id'];
        $condition['C_MemberId'] = $member_id;
        $condition['C_Cang'] = 1;

        $model_artist = Model('artist_new');

        $artist_shoucang_list = $model_artist->getArtistShoucang($condition);

        Tpl::output('artist_list',$artist_shoucang_list);
        Tpl::output('show_page', $model_artist->showpage(3));
        Tpl::showpage('artist_shoucang');

    }


    /*删除收藏*/
    public function delShoucangOp(){
        $id = $_POST['id'];

        if(empty($id)){
            exit(json_encode(array('state'=>false,'msg'=>'缺少参数')));
        }

        $model_artist = Model('artist_new');

        $condition['C_Id'] = $id;
        $condition['C_MemberId'] = $_SESSION['member_id'];

        if($model_artist->delArtistShoucang($condition)){
            exit(json_encode(array('state'=>true,'msg'=>'操作成功！')));
        }else{
            exit(json_encode(array('state'=>false,'msg'=>'操作失败！')));
        }


    }


        /*删除收藏*/
    public function delShoucangAllOp(){


        $del_id = join(',',$_POST['del_id']);

        if(empty($del_id)){
            exit(json_encode(array('state'=>false,'msg'=>'缺少参数')));
        }

        $model_artist = Model('artist_new');

        $condition['C_Id'] = array('in',$del_id);
        $condition['C_MemberId'] = $_SESSION['member_id'];

        if($model_artist->delArtistShoucang($condition)){
            exit(json_encode(array('state'=>true,'msg'=>'操作成功！')));
        }else{
            exit(json_encode(array('state'=>false,'msg'=>'操作失败！')));
        }

    }




    /*艺术家入驻*/
    public function artistJoinOp(){


        if(chksubmit(true)){

            $name = trim($_POST['username']);
            $mobile = intval($_POST['mobile']);

            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
            array("input"=>$name,"require"=>"true","message"=>'用户名不能为空'),
            array("input"=>$mobile,"require"=>"true","message"=>'手机号不能为空'),
            );
            $error = $obj_validate->validate();
            if ($error != ''){
                showMessage($error,urlArtist('artist_new','artistJoin'));
            }

            $dataArr['J_ArtistName'] = $name;
            $dataArr['J_Mobile'] = JiaMiMobile($mobile);
            $dataArr['J_Time'] = time();
            $dataArr['J_Laiyuan'] = '书画馆入驻';

            $model_artist = Model('artist_new');

            $condition['J_Mobile'] = $dataArr['J_Mobile'];

            if(empty($model_artist->getArtistJoinMobileOne($condition))){
                if($model_artist->addArtistJoin($dataArr)){
                    showMessage('提交成功，稍后工作人员会与您联系洽谈入驻事宜',urlArtist('artist_new','artistJoin'));
                }else{
                    showMessage('添加失败',urlArtist('artist_new','artistJoin'));
                }
            }else{
                showMessage('手机号重复！',urlArtist('artist_new','artistJoin'));
            }
        }else{
            Tpl::showpage('artist_join');
        }
    }




        /*艺术品定制*/
    public function goodsCustomOp(){


        Tpl::showpage('goods_custom');
    }


    /*艺术家定制提交*/
    public function doArtistCustomOp(){

        if(chksubmit(true,true)){
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input"=>$_POST["Yname"], "require"=>"true","message"=>'艺术家名称不能为空！'),
                array("input"=>$_POST["now_hua"], "require"=>"true","message"=>'定制类型不能为空！'),
                array("input"=>$_POST["now_chi"], "require"=>"true","message"=>'定制尺寸不能为空！'),
                array("input"=>$_POST["Sname"], "require"=>"true","message"=>'定制人姓名不能为空！'),
                array("input"=>$_POST["Sphone"], "require"=>"true","message"=>'定制人电话不能为空！'),
                array("input"=>$_POST["Sphone"], "require"=>"true","validator"=>"mobile","message"=>'手机格式不正确！'),
                array("input"=>$_POST["Sremark"], "require"=>"true","message"=>'个性化需求不能为空！'),
            );

            $error = $obj_validate->validate();
            if ($error != ''){
                showMessage($error);
            }

            $leiXing = explode(',',$_POST['now_hua']);
            $chiCun = explode(',',$_POST['now_chi']);

            $dataArr['C_ArtistName'] = $_POST['Yname'];
            $dataArr['C_LeiXingId'] = reset($leiXing);
            $dataArr['C_LeiXing'] = end($leiXing);
            $dataArr['C_ChiCunId'] = reset($chiCun);
            $dataArr['C_ChiCun'] = end($chiCun);
            $dataArr['C_Name'] = $_POST['Sname'];
            $dataArr['C_Mobile'] = JiaMiMobile($_POST['Sphone']);
            $dataArr['C_XuQiu'] = $_POST['Sremark'];
            $dataArr['C_CustomType'] = '1';
            $dataArr['C_AddTime'] = time();

            $result = Model('artist_new')->addArtistCustom($dataArr);

            if(!empty($result)){
                showMessage('提交成功！',urlArtist('artist_new','goodsCustom'));
            }else{
                showMessage('提交失败！',urlArtist('artist_new','goodsCustom'));
            }
        }
    }


    /*个人个性定制提交*/
    public function doUserCustomOp(){
        

        if(chksubmit(true,true)){
            $obj_validate = new Validate();
            $obj_validate->validateparam = array(
                array("input"=>$_POST["now_money"], "require"=>"true","message"=>'定制价钱不能为空！'),
                array("input"=>$_POST["now_hua"], "require"=>"true","message"=>'定制类型不能为空！'),
                array("input"=>$_POST["now_chi"], "require"=>"true","message"=>'定制尺寸不能为空！'),
                array("input"=>$_POST["Sname"], "require"=>"true","message"=>'定制人姓名不能为空！'),
                array("input"=>$_POST["Sphone"], "require"=>"true","message"=>'定制人电话不能为空！'),
                array("input"=>$_POST["Sphone"], "require"=>"true","validator"=>"mobile","message"=>'手机格式不正确！'),
                array("input"=>$_POST["Sremark"], "require"=>"true","message"=>'个性化需求不能为空！'),
            );

            $error = $obj_validate->validate();
            if ($error != ''){
                showMessage($error);
            }

            $leiXing = explode(',',$_POST['now_hua']);
            $chiCun = explode(',',$_POST['now_chi']);
            $money = explode(',',$_POST['now_money']);

            $dataArr['C_ArtistName'] = $_POST['Yname'];
            $dataArr['C_LeiXingId'] = reset($leiXing);
            $dataArr['C_LeiXing'] = end($leiXing);
            $dataArr['C_ChiCunId'] = reset($chiCun);
            $dataArr['C_ChiCun'] = end($chiCun);
            $dataArr['C_MoneyId'] = reset($money);
            $dataArr['C_Money'] = end($money);
            $dataArr['C_Name'] = $_POST['Sname'];
            $dataArr['C_Mobile'] = JiaMiMobile($_POST['Sphone']);
            $dataArr['C_XuQiu'] = $_POST['Sremark'];
            $dataArr['C_CustomType'] = '2';
            $dataArr['C_AddTime'] = time();

            $result = Model('artist_new')->addArtistCustom($dataArr);

            if(!empty($result)){
                showMessage('提交成功！',urlArtist('artist_new','goodsCustom'));
            }else{
                showMessage('提交失败！',urlArtist('artist_new','goodsCustom'));
            }
        }


    }

    


    /*匹配艺术家*/
    public function pipeiArtistOp(){

        $name = trim($_POST['yname']);

        $condition['A_Name'] = $name;

        $result = Model('artist_new')->table('artist')->field('A_Class')->where($condition)->find();

        echo json_encode($result);

    }





}


?>