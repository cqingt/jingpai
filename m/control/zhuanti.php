<?php
/**
 * 专题类
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class zhuantiControl extends mobileHomeControl {
	private $ZtModel;
	private $cacheTime = 1;//缓存时间：分
	public function __construct() {
        parent::__construct ();
        Tpl::setDir('zhuanti');
        $this->ZtModel = Model('zhuanti');
    }
    /**
	 * 默认页面
	 */
	public function indexOp(){
		showWapMessage('您访问的活动不存在','index.php','error');
	}
	
	/**
	 * 宝莱阁活动专题
	 * Add is name lt 2016-12-12
	 */
	public function ad_20161212Op(){
		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::output('nav_title','收藏天下新疆和田玉特惠专场,低至6折！全场包邮！');
		Tpl::output('html_title','收藏天下新疆和田玉特惠专场,低至6折！全场包邮！');
		Tpl::output('seo_keywords','和田玉,新疆和田玉,和田玉挂件,和田玉平安扣,和田玉吊坠，宝莱阁和田玉,收藏天下');
		Tpl::output('seo_description','收藏天下推荐，宝莱阁和田玉籽料挂件玉中之王，限时特惠，低至6折！全场包邮！');
		Tpl::showpage('20161212/index_show');
	}

	/**
	 * 乌克兰活动领取后台查看
	 * Add is name lt 2016-12-09
	 */
	public function ad_20161210_adminOp(){

		if(!empty(intval($_POST['mob_phone']))){

			$phone = intval($_POST['mob_phone']);
			$condition['U_Mobile'] = $phone;
			$phone_info = Model()->table('activity_mobile')->where($condition)->order('U_Type ASC ,U_Time DESC')->page(20)->select();

		}elseif($_GET['U_Id']){
			$data['U_Type'] = 2;
			$condition['U_Id'] = intval($_GET['U_Id']);
			$phone_info = Model()->table('activity_mobile')->where($condition)->update($data);
			showWapMessage("修改成功",'/index.php?act=zhuanti&op=ad_20161210_admin'); 
			exit;

		}else{
			$phone_info = Model()->table('activity_mobile')->order('U_Type ASC ,U_Time DESC')->page(20)->select();
		}


		Tpl::output('page',Model()->showpage(88));
		Tpl::output('list',$phone_info);
		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::showpage('20161210_admin/index_show');
	}


	/**
	 * 乌克兰活动领取活动
	 * Add is name lt 2016-12-09
	 */
	public function ad_20161210Op(){
		if($_GET['action'] == 'lingqu' && chksubmit(true)){

			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
				array("input"=>$_POST['code'],"require"=>"true", "message"=>'验证码不能为空！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				showWapMessage($error,'','error');
				// exit(json_encode(array('state'=>false,'msg'=>$error)));
			}

			$code = $_POST['code'];
			if($_SESSION['wx_phone'] != $_POST['mob_phone'] || $_SESSION['wx_phone_yzm'][$_POST['mob_phone']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mob_phone']] == ''){
				$result['state'] = false;
				$result['msg'] = "验证码错误";
				showWapMessage("验证码错误",'','error'); 
				exit;
			}

			$phone_info = Model()->table('activity_mobile')->where(array('U_Mobile'=>$_POST['mob_phone']))->find();

			if(!empty($phone_info)){
				showWapMessage("您已登记过领取信息！",'','error');
				exit;
			}

			$data['U_Mobile'] = $_POST['mob_phone'];
			$data['U_Name'] = $_POST['true_name'];
			$data['U_Time'] = time();

			$result = Model()->table('activity_mobile')->insert($data);

			if(!empty($result)){
				Tpl::output('lingqu',true);
			}else{
				showWapMessage("领取失败、重新登记！",'','error'); 
			}
		}
		Tpl::output('no_header',true);
		// Tpl::output('no_footer',true);
		Tpl::showpage('20161210/index_show');
	}


	/**
	 * 书画禅茶活动专题
	 * Add is name lt 2016-12-09
	 */
	public function ad_20161209Op(){
		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::output('nav_title','收藏天下书画馆精品专题—茶文化');
		Tpl::output('html_title','收藏天下书画馆精品专题—茶文化');
		Tpl::output('seo_keywords','书画馆，茶文化，禅茶一味，正品收藏，精品推荐，书画');
		Tpl::output('seo_description','茶里乾坤，禅中意境。禅茶一味品人生百态。');
		Tpl::showpage('20161209/index_show');
	}

	/**
	 * 双十二专题活动
	 * Add is name du 2016-12-05 
	 */
	public function ad_20161208Op(){
		Language::read('common,home_layout');

		// 删除缓存、更新后执行
		// dkcache('zhuanti_20161208');

		// 读出缓存
		$data = rkcache('zhuanti_20161208');

		if(empty($data)){
			$model_goods = Model('goods');

			// 阿斯塔普-卡瓦尔丘克
			$goods_id_list = '42308,42314,42315,42318,42320,42325,42327,42431';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_marketprice,goods_image';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_1'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 安纳托利-佐尔科
			$goods_id_list = '41815,42135,41791,41792,41813,41793,41818,41807';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_marketprice,goods_image';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_2'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 奥列斯-瓦西里维齐-索罗维
			$goods_id_list = '42151,42157,42162,42166,42168,42172,42176,42216';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_marketprice,goods_image';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_3'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 亚历山大-赫巴拉乔夫
			$goods_id_list = '42197,42206,42152,42160,42210,42175,42221,42300';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_marketprice,goods_image';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_4'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 叶甫盖尼-毕斯库诺夫
			$goods_id_list = '42003,42106,42001,42082,42038,42053,42070,41987';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_marketprice,goods_image';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_5'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);
			// 写入缓存、时效一小时
			wkcache('zhuanti_20161208',$data,3600);
		}
		
		Tpl::output('html_title','乌克兰艺术大师精品油画');
		Tpl::output('seo_keywords','油画,乌克兰,财富,收藏,投资,中央美院,理财,阿斯塔普·卡瓦尔丘克,瓦西里·古林,安德烈·戚培根,亚历山大·赫拉巴乔夫,奥列斯·瓦西里维齐·索罗维,安纳托利·佐尔科, 叶甫盖尼·毕斯库诺夫,安德烈·雅朗斯基');
		Tpl::output('seo_description','中乌建交25周年,乌克兰中央美院大师油画盛典震撼开启！国际顶尖艺术家油画作品,低于国际市场价惠民发售,财富盛宴,邀您共享！');

		Tpl::output('goods_list',$data['goods_list']);

		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::showpage('20161208/index_show');
	}


	/**
	 * 金银钞专题
	 * Add is name lt 2016-12-07
	 */
	public function ad_20161207_2Op(){
		switch($_GET['action']){
			case 'lingqu':

			// if(chksubmit(true)){

				$obj_validate = new Validate();
				$obj_validate->validateparam = array(
					array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
					array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
					array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
					array("input"=>$_POST['goods_sum'],"require"=>"true", "message"=>'订购数量不能为空！'),
					array("input"=>$_POST['prov'],"require"=>"true", "message"=>'省不能为空！'),
					array("input"=>$_POST['city'],"require"=>"true", "message"=>'市不能为空！'),
					array("input"=>$_POST['region'],"require"=>"true", "message"=>'区不能为空！'),
					array("input"=>$_POST['address'],"require"=>"true", "message"=>'详细地址不能为空！'),
				);

				$error = $obj_validate->validate();
				if ($error != ''){
					// showWapMessage($error,'','error');
					exit(json_encode(array('state'=>false,'msg'=>$error)));
				}

				$laiyuan = '金银钞专题_1'.($_GET['ua']?$_GET['ua']:'m');

				$model_member	= Model('member');
				$register_info = array();
				$register_info['username'] = $_POST['mob_phone'];
				$register_info['password'] = $_POST['mob_phone'];
				$register_info['password_confirm'] = $_POST['mob_phone'];
				$register_info['mobile'] = $_POST['mob_phone'];
				$register_info['member_from'] = $laiyuan;
				$member_info = $model_member->register($register_info);

				if(!isset($member_info['error'])) {
					$msg = "注册成功！用户名和密码均为您的手机号码：".$_POST['mob_phone']."，请及时登录收藏天下官网进行修改。";
					$sms = new Sms();
					$sms->send($_POST['mob_phone'],$msg);
				}else{
					$member_info = $model_member->getMemberInfo(array('member_mobile'=>$_POST['mob_phone']));
					if(isset($member_info)){
						exit(json_encode(array('state'=>false,'msg'=>'本次活动只限于新会员参加！')));

						// showWapMessage('本次活动只限于新会员参加！','','error');
						// exit();
					}
					$member_info['is_buy'] = 1;
				}

				$model_member->createSession($member_info,true);
				$goodsnumber = intval($_POST['goods_sum']);
				if($goodsnumber >= 5){
					$goodsid_array = array('39927'=>'298.00','33970'=>'0');
					$zp_goods_number = floor($goodsnumber/5);
				}else{
					$goodsid_array = array('39927'=>'298.00');
					$zp_goods_number = 1;
				}


				$goodsnumber_array = array('39927'=>$goodsnumber,'33970'=>$zp_goods_number);

				$goods_amount = '298.00'; //商品总额
				$shipping_fee = '0'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount*$goodsnumber,$shipping_fee,"金银钞专题",$laiyuan,false,array(),'online',$goodsnumber_array,0);

			// }

			break;
			default:
			
				Tpl::output('html_title','鸡年纯金大红包');
				Tpl::output('seo_keywords','2017鸡年,金银钞,人民币,建国钞,送礼,压岁钱,春节');
				Tpl::output('seo_description','2017鸡年纯金大红包，298元限量抢购！仅剩5000套，抢购从速！纯金打造，送亲朋、送领导、送孩子，奢华有面子！建国钞设计大师亲自设计，与纪念钞同等价值！');

				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20161207_2/index_show');
			break;
		}
	
	}



	/**
	 * 金银钞专题
	 * Add is name lt 2016-12-07
	 */
	public function ad_20161207_1Op(){
		switch($_GET['action']){
			case 'lingqu':

			// if(chksubmit(true)){

				$obj_validate = new Validate();
				$obj_validate->validateparam = array(
					array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
					array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
					array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
					array("input"=>$_POST['goods_sum'],"require"=>"true", "message"=>'订购数量不能为空！'),
					array("input"=>$_POST['prov'],"require"=>"true", "message"=>'省不能为空！'),
					array("input"=>$_POST['city'],"require"=>"true", "message"=>'市不能为空！'),
					array("input"=>$_POST['region'],"require"=>"true", "message"=>'区不能为空！'),
					array("input"=>$_POST['address'],"require"=>"true", "message"=>'详细地址不能为空！'),
				);

				$error = $obj_validate->validate();
				if ($error != ''){
					// showWapMessage($error,'','error');
					exit(json_encode(array('state'=>false,'msg'=>$error)));
				}

				$laiyuan = '金银钞专题_1'.($_GET['ua']?$_GET['ua']:'m');

				$model_member	= Model('member');
				$register_info = array();
				$register_info['username'] = $_POST['mob_phone'];
				$register_info['password'] = $_POST['mob_phone'];
				$register_info['password_confirm'] = $_POST['mob_phone'];
				$register_info['mobile'] = $_POST['mob_phone'];
				$register_info['member_from'] = $laiyuan;
				$member_info = $model_member->register($register_info);

				if(!isset($member_info['error'])) {
					$msg = "注册成功！用户名和密码均为您的手机号码：".$_POST['mob_phone']."，请及时登录收藏天下官网进行修改。";
					$sms = new Sms();
					$sms->send($_POST['mob_phone'],$msg);
				}else{
					$member_info = $model_member->getMemberInfo(array('member_mobile'=>$_POST['mob_phone']));
					if(isset($member_info)){
						exit(json_encode(array('state'=>false,'msg'=>'本次活动只限于新会员参加！')));

						// showWapMessage('本次活动只限于新会员参加！','','error');
						// exit();
					}
					$member_info['is_buy'] = 1;
				}

				$model_member->createSession($member_info,true);
				$goodsnumber = intval($_POST['goods_sum']);
				if($goodsnumber >= 5){
					$goodsid_array = array('39927'=>'298.00','33970'=>'0');
					$zp_goods_number = floor($goodsnumber/5);
				}else{
					$goodsid_array = array('39927'=>'298.00');
					$zp_goods_number = 1;
				}


				$goodsnumber_array = array('39927'=>$goodsnumber,'33970'=>$zp_goods_number);

				$goods_amount = '298.00'; //商品总额
				$shipping_fee = '0'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount*$goodsnumber,$shipping_fee,"金银钞专题",$laiyuan,false,array(),'online',$goodsnumber_array,0);

			// }

			break;
			default:
			
				Tpl::output('html_title','鸡年纯金大红包');
				Tpl::output('seo_keywords','2017鸡年,金银钞,人民币,建国钞,送礼,压岁钱,春节');
				Tpl::output('seo_description','2017鸡年纯金大红包，298元限量抢购！仅剩5000套，抢购从速！纯金打造，送亲朋、送领导、送孩子，奢华有面子！建国钞设计大师亲自设计，与纪念钞同等价值！');

				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20161207_1/index_show');
			break;
		}
	
	}

	/**
	 * 金银钞专题
	 * Add is name lt 2016-12-07
	 */
	public function ad_20161207Op(){
		switch($_GET['action']){
			case 'lingqu':

			// if(chksubmit(true)){

				$obj_validate = new Validate();
				$obj_validate->validateparam = array(
					array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
					array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
					array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
					array("input"=>$_POST['goods_sum'],"require"=>"true", "message"=>'订购数量不能为空！'),
					array("input"=>$_POST['prov'],"require"=>"true", "message"=>'省不能为空！'),
					array("input"=>$_POST['city'],"require"=>"true", "message"=>'市不能为空！'),
					array("input"=>$_POST['region'],"require"=>"true", "message"=>'区不能为空！'),
					array("input"=>$_POST['address'],"require"=>"true", "message"=>'详细地址不能为空！'),
				);

				$error = $obj_validate->validate();
				if ($error != ''){
					// showWapMessage($error,'','error');
					exit(json_encode(array('state'=>false,'msg'=>$error)));
				}

				$laiyuan = '金银钞专题'.($_GET['ua']?$_GET['ua']:'m');

				$model_member	= Model('member');
				$register_info = array();
				$register_info['username'] = $_POST['mob_phone'];
				$register_info['password'] = $_POST['mob_phone'];
				$register_info['password_confirm'] = $_POST['mob_phone'];
				$register_info['mobile'] = $_POST['mob_phone'];
				$register_info['member_from'] = $laiyuan;
				$member_info = $model_member->register($register_info);

				if(!isset($member_info['error'])) {
					$msg = "注册成功！用户名和密码均为您的手机号码：".$_POST['mob_phone']."，请及时登录收藏天下官网进行修改。";
					$sms = new Sms();
					$sms->send($_POST['mob_phone'],$msg);
				}else{
					$member_info = $model_member->getMemberInfo(array('member_mobile'=>$_POST['mob_phone']));
					if(isset($member_info)){
						exit(json_encode(array('state'=>false,'msg'=>'本次活动只限于新会员参加！')));

						// showWapMessage('本次活动只限于新会员参加！','','error');
						// exit();
					}
					$member_info['is_buy'] = 1;
				}

				$model_member->createSession($member_info,true);
				$goodsnumber = intval($_POST['goods_sum']);
				if($goodsnumber >= 5){
					$goodsid_array = array('39927'=>'298.00','33970'=>'0');
					$zp_goods_number = floor($goodsnumber/5);
				}else{
					$goodsid_array = array('39927'=>'298.00');
					$zp_goods_number = 1;
				}


				$goodsnumber_array = array('39927'=>$goodsnumber,'33970'=>$zp_goods_number);

				$goods_amount = '298.00'; //商品总额
				$shipping_fee = '0'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount*$goodsnumber,$shipping_fee,"金银钞专题",$laiyuan,false,array(),'online',$goodsnumber_array,0);

			// }

			break;
			default:
			
				Tpl::output('html_title','鸡年纯金大红包');
				Tpl::output('seo_keywords','2017鸡年,金银钞,人民币,建国钞,送礼,压岁钱,春节');
				Tpl::output('seo_description','2017鸡年纯金大红包，298元限量抢购！仅剩5000套，抢购从速！纯金打造，送亲朋、送领导、送孩子，奢华有面子！建国钞设计大师亲自设计，与纪念钞同等价值！');

				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20161207/index_show');
			break;
		}
	
	}

	/**
	 * 双十二专题活动
	 * Add is name du 2016-12-05 
	 */
	public function ad_20161205Op(){

		// 删除缓存、更新后执行
		// dkcache('zhuanti_20161205');

		// 读出缓存
		$data = rkcache('zhuanti_20161205');

		if(empty($data)){
			$model_goods = Model('goods');
			// 满299 赠 天下第一福金条
			$goods_id_list = '12384,14836,662,22502,7666,6315,41349,11240';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_1'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 满599 赠核雕手串
			$goods_id_list = '39550,16866,28623,33166,5129,14232,3986,20679';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_2'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 满999 赠 G20硬币大全
			$goods_id_list = '913,7678,17551,27974,12351,33975,1307,33169';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_3'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 满1999 赠 世界珍稀塑钞锦集
			$goods_id_list = '37943,39652,9481,39653,3991,11231,773,4094';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_4'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);


			// 满3500 赠 第三轮纯银版邮票大全套

			$goods_id_list = '34068,8561,15298,845,16895,28015,7657,14233';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_5'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);
			// 写入缓存、时效一小时
			wkcache('zhuanti_20161205',$data,3600);
		}
		
		Tpl::output('html_title','收藏天下双12钜惠 买一送一 买一得三无上限');
		Tpl::output('seo_keywords','钱币,纪念钞,金银币,生肖邮票,纪念币,第二套人民币,珠宝玉石首饰,猴钞,熊猫币');
		Tpl::output('seo_description','收藏天下双12全场买一送一,更有买一得三专区。钱币,纪念钞,金银币,生肖邮票,纪念币,第二套人民币,珠宝玉石首饰,猴钞,熊猫币等热销产品。正品收藏，入手即赚！');
		Tpl::output('goods_list',$data['goods_list']);
		Tpl::output('no_header',true);
		//Tpl::output('no_footer',true);
		Tpl::showpage('20161205/index_show');
	}


	/**
	 * 翡翠奇缘专题
	 * Add is name lt 2016-12-01
	 */
	public function ad_20161201Op(){
		Tpl::output('nav_title','收藏天下翡翠玉石联合专场，低至19元！“玉”见就不要错过！');
		Tpl::output('html_title','收藏天下翡翠玉石联合专场，低至19元！“玉”见就不要错过！');
		Tpl::output('seo_keywords','翡翠,玉石,玉佛,玉牌,翡翠吊坠,翡翠手镯,翡翠戒指,收藏天下');
		Tpl::output('seo_description','收藏天下翡翠玉石特价专场，限时特惠低至19元！全场包邮！');
		Tpl::showpage('20161201/index_show');
	}

	/**
	 * 踏雪寻梅专题
	 * Add is name lt 2016-11-30
	 */
	public function ad_20161130Op(){
		Tpl::output('nav_title','冬季书画专场');
		Tpl::output('html_title','冬季书画专场');
		Tpl::output('seo_keywords','书画，冬季，雪，梅花，书法，限量抢购，书画馆');
		Tpl::output('seo_description','寒梅素雪，冬季活动专场，寒冬小馆送温暖，收藏天下书画馆名家真迹限量抢购！');
		Tpl::showpage('20161130/index_show');
	}

	/**
	 * 齐白石专题
	 * Add is name lt 2016-11-21 
	 */
	public function ad_20161123_2Op(){

		if(chksubmit(true)){

			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
				array("input"=>$_POST['goods_sum'],"require"=>"true", "message"=>'订购数量不能为空！'),
				array("input"=>$_POST['prov'],"require"=>"true", "message"=>'省不能为空！'),
				array("input"=>$_POST['city'],"require"=>"true", "message"=>'市不能为空！'),
				array("input"=>$_POST['region'],"require"=>"true", "message"=>'区不能为空！'),
				array("input"=>$_POST['address'],"require"=>"true", "message"=>'详细地址不能为空！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				showWapMessage($error,'','error');
				exit();
			}

			if ($_POST['goods_sum'] > 5){
				showWapMessage('订购数量上限为5！','','error');
				exit();
			}

			$code = $_POST['code'];

			if($_SESSION['wx_phone'] != $_POST['mob_phone'] || $_SESSION['wx_phone_yzm'][$_POST['mob_phone']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mob_phone']] == ''){
				$result['state'] = false;
				$result['msg'] = "验证码错误";
				showWapMessage("验证码错误",'','error'); 
				exit();
			}

			$laiyuan = '齐白石'.($_GET['ua']?$_GET['ua']:'m');

			$laiyuan = urlencode($laiyuan);

			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mob_phone'].'&N='.urlencode($_POST['true_name']).'&AdFrom=ad_20161123_2'.'&A_Num='.$_POST['goods_sum'].'&A_From='.$laiyuan.'&is_reg=0&contents='.urlencode($_POST['prov_name'].' '.$_POST['city_name'].' '.$_POST['region_name'].' '.$_POST['address']).'&tg_from='.urlencode($_SESSION['tg_from']));
			
			if($retuen_type == 1){
				$msg = "齐白石游虾图推广有新的留言，请马上查看并进行分配，分配后别忘了通知业务员。";
				$sms = new Sms();
				$sms->send('15726633668',$msg);
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-876-2770客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20161123_2\';</script>';
				exit();
			}else{
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-876-2770客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20161123_2\';</script>';
				exit();
			}

		}

		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::output('html_title','齐白石·游虾图·惠民大促');
		Tpl::output('seo_keywords','齐白石,游虾图,优惠,国画');
		Tpl::output('seo_description','齐白石再传弟子《游虾图》惠民大促销！');
		Tpl::showpage('20161123_2/index_show');
	}

	/**
	 * 齐白石专题
	 * Add is name lt 2016-11-21 
	 */
	public function ad_20161123_1Op(){

		if(chksubmit(true)){

			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
				array("input"=>$_POST['goods_sum'],"require"=>"true", "message"=>'订购数量不能为空！'),
				array("input"=>$_POST['prov'],"require"=>"true", "message"=>'省不能为空！'),
				array("input"=>$_POST['city'],"require"=>"true", "message"=>'市不能为空！'),
				array("input"=>$_POST['region'],"require"=>"true", "message"=>'区不能为空！'),
				array("input"=>$_POST['address'],"require"=>"true", "message"=>'详细地址不能为空！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				showWapMessage($error,'','error');
				exit();
			}

			if ($_POST['goods_sum'] > 5){
				showWapMessage('订购数量上限为5！','','error');
				exit();
			}

			$code = $_POST['code'];

			if($_SESSION['wx_phone'] != $_POST['mob_phone'] || $_SESSION['wx_phone_yzm'][$_POST['mob_phone']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mob_phone']] == ''){
				$result['state'] = false;
				$result['msg'] = "验证码错误";
				showWapMessage("验证码错误",'','error'); 
				exit();
			}

			$laiyuan = '齐白石'.($_GET['ua']?$_GET['ua']:'m');

			$laiyuan = urlencode($laiyuan);

			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mob_phone'].'&N='.urlencode($_POST['true_name']).'&AdFrom=ad_20161123_1'.'&A_Num='.$_POST['goods_sum'].'&A_From='.$laiyuan.'&is_reg=0&contents='.urlencode($_POST['prov_name'].' '.$_POST['city_name'].' '.$_POST['region_name'].' '.$_POST['address']).'&tg_from='.urlencode($_SESSION['tg_from']));
			
			if($retuen_type == 1){
				$msg = "齐白石游虾图推广有新的留言，请马上查看并进行分配，分配后别忘了通知业务员。";
				$sms = new Sms();
				$sms->send('15726633668',$msg);
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-876-2770客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20161123_1\';</script>';
				exit();
			}else{
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-876-2770客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20161123_1\';</script>';
				exit();
			}

		}

		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::output('html_title','齐白石·游虾图·惠民大促');
		Tpl::output('seo_keywords','齐白石,游虾图,优惠,国画');
		Tpl::output('seo_description','齐白石再传弟子《游虾图》惠民大促销！');
		Tpl::showpage('20161123_1/index_show');
	}



	/**
	 * 齐白石专题
	 * Add is name lt 2016-11-21 
	 */
	public function ad_20161123Op(){

		if(chksubmit(true)){

			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
				array("input"=>$_POST['goods_sum'],"require"=>"true", "message"=>'订购数量不能为空！'),
				array("input"=>$_POST['prov'],"require"=>"true", "message"=>'省不能为空！'),
				array("input"=>$_POST['city'],"require"=>"true", "message"=>'市不能为空！'),
				array("input"=>$_POST['region'],"require"=>"true", "message"=>'区不能为空！'),
				array("input"=>$_POST['address'],"require"=>"true", "message"=>'详细地址不能为空！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				showWapMessage($error,'','error');
				exit();
			}

			if ($_POST['goods_sum'] > 5){
				showWapMessage('订购数量上限为5！','','error');
				exit();
			}

			$code = $_POST['code'];

			if($_SESSION['wx_phone'] != $_POST['mob_phone'] || $_SESSION['wx_phone_yzm'][$_POST['mob_phone']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mob_phone']] == ''){
				$result['state'] = false;
				$result['msg'] = "验证码错误";
				showWapMessage("验证码错误",'','error'); 
				exit();
			}

			$laiyuan = '齐白石'.($_GET['ua']?$_GET['ua']:'m');

			$laiyuan = urlencode($laiyuan);

			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mob_phone'].'&N='.urlencode($_POST['true_name']).'&AdFrom=ad_20161123'.'&A_Num='.$_POST['goods_sum'].'&A_From='.$laiyuan.'&is_reg=0&contents='.urlencode($_POST['prov_name'].' '.$_POST['city_name'].' '.$_POST['region_name'].' '.$_POST['address']).'&tg_from='.urlencode($_SESSION['tg_from']));
			
			if($retuen_type == 1){
				$msg = "齐白石游虾图推广有新的留言，请马上查看并进行分配，分配后别忘了通知业务员。";
				$sms = new Sms();
				$sms->send('15726633668',$msg);
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-876-2770客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20161123\';</script>';
				exit();
			}else{
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-876-2770客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20161123\';</script>';
				exit();
			}

		}

		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::output('html_title','齐白石·游虾图·惠民大促');
		Tpl::output('seo_keywords','齐白石,游虾图,优惠,国画');
		Tpl::output('seo_description','齐白石再传弟子《游虾图》惠民大促销！');
		Tpl::showpage('20161123/index_show');
	}
	/**
	 * 七彩冰裂茶具专题
	 * Add is name du 2016-11-21
	 */
	public function ad_20161121_2Op(){
		switch($_GET['action']){
			case 'lingqu':
				$model_member	= Model('member');
				$register_info = array();
				$register_info['username'] = $_POST['mob_phone'];
				$register_info['password'] = $_POST['mob_phone'];
				$register_info['password_confirm'] = $_POST['mob_phone'];
				$register_info['mobile'] = $_POST['mob_phone'];
				$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
				$register_info['member_from'] = '七彩冰裂茶具专题('.$M.')';
				$member_info = $model_member->register($register_info);
				if(!isset($member_info['error'])) {
					$msg = "注册成功！用户名和密码均为您的手机号码：".$_POST['mob_phone']."，请及时登录收藏天下官网进行修改。";
					$sms = new Sms();
					$sms->send($_POST['mob_phone'],$msg);
				}else{
					$member_info = $model_member->getMemberInfo(array('member_mobile'=>$_POST['mob_phone']));
					if(isset($member_info)){
						exit(json_encode(array('state'=>false,'msg'=>'本次活动只限于新会员参加！')));
					}
					$member_info['is_buy'] = 1;
				}
				$model_member->createSession($member_info,true);
				$goodsnumber = @intval($_POST['goodsnumber']) <= 0 ? 1 : @intval($_POST['goodsnumber']) > 20 ? 20 : @intval($_POST['goodsnumber']);
				$goodsid_array = array('17163'=>'29.80');
				$goods_amount = '29.80'; //商品总额
				$shipping_fee = '0'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount*$goodsnumber,$shipping_fee,"七彩冰裂茶具专题",'七彩冰裂茶具专题(M)',false,array(),'online',$goodsnumber,0);

			break;
			default:
				Tpl::output('html_title','七彩冰裂艺术茶具套装29.8元包邮');
				Tpl::output('seo_keywords','冰裂茶具,冰裂紫砂杯,茶具套装');
				Tpl::output('seo_description','精品七彩冰裂茶具一壶六杯套装29.8元包邮！仅1000套！');

				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20161121_2/index_show');
			break;
		}
	
	}
	/**
	 * 七彩冰裂茶具专题
	 * Add is name du 2016-11-21
	 */
	public function ad_20161121_1Op(){
		switch($_GET['action']){
			case 'lingqu':
				$model_member	= Model('member');
				$register_info = array();
				$register_info['username'] = $_POST['mob_phone'];
				$register_info['password'] = $_POST['mob_phone'];
				$register_info['password_confirm'] = $_POST['mob_phone'];
				$register_info['mobile'] = $_POST['mob_phone'];
				$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
				$register_info['member_from'] = '七彩冰裂茶具专题('.$M.')';
				$member_info = $model_member->register($register_info);
				if(!isset($member_info['error'])) {
					$msg = "注册成功！用户名和密码均为您的手机号码：".$_POST['mob_phone']."，请及时登录收藏天下官网进行修改。";
					$sms = new Sms();
					$sms->send($_POST['mob_phone'],$msg);
				}else{
					$member_info = $model_member->getMemberInfo(array('member_mobile'=>$_POST['mob_phone']));
					if(isset($member_info)){
						exit(json_encode(array('state'=>false,'msg'=>'本次活动只限于新会员参加！')));
					}
					$member_info['is_buy'] = 1;
				}
				$model_member->createSession($member_info,true);
				$goodsnumber = @intval($_POST['goodsnumber']) <= 0 ? 1 :  @intval($_POST['goodsnumber']) > 20 ? 20 : @intval($_POST['goodsnumber']);
				$goodsid_array = array('17163'=>'29.80');
				$goods_amount = '29.80'; //商品总额
				$shipping_fee = '0'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount*$goodsnumber,$shipping_fee,"七彩冰裂茶具专题",'七彩冰裂茶具专题(M)',false,array(),'online',$goodsnumber,0);

			break;
			default:
				Tpl::output('html_title','七彩冰裂艺术茶具套装29.8元包邮');
				Tpl::output('seo_keywords','冰裂茶具,冰裂紫砂杯,茶具套装');
				Tpl::output('seo_description','精品七彩冰裂茶具一壶六杯套装29.8元包邮！仅1000套！');

				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20161121_1/index_show');
			break;
		}
	
	}
	/**
	 * 七彩冰裂茶具专题
	 * Add is name du 2016-11-21
	 */
	public function ad_20161121Op(){
		switch($_GET['action']){
			case 'lingqu':
				$model_member	= Model('member');
				$register_info = array();
				$register_info['username'] = $_POST['mob_phone'];
				$register_info['password'] = $_POST['mob_phone'];
				$register_info['password_confirm'] = $_POST['mob_phone'];
				$register_info['mobile'] = $_POST['mob_phone'];
				$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
				$register_info['member_from'] = '七彩冰裂茶具专题('.$M.')';
				$member_info = $model_member->register($register_info);
				if(!isset($member_info['error'])) {
					$msg = "注册成功！用户名和密码均为您的手机号码：".$_POST['mob_phone']."，请及时登录收藏天下官网进行修改。";
					$sms = new Sms();
					$sms->send($_POST['mob_phone'],$msg);
				}else{
					$member_info = $model_member->getMemberInfo(array('member_mobile'=>$_POST['mob_phone']));
					if(isset($member_info)){
						exit(json_encode(array('state'=>false,'msg'=>'本次活动只限于新会员参加！')));
					}
					$member_info['is_buy'] = 1;
				}
				$model_member->createSession($member_info,true);
				$goodsnumber = @intval($_POST['goodsnumber']) <= 0 ? 1 : @intval($_POST['goodsnumber']) > 20 ? 20 : @intval($_POST['goodsnumber']);
				$goodsid_array = array('17163'=>'29.80');
				$goods_amount = '29.80'; //商品总额
				$shipping_fee = '0'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount*$goodsnumber,$shipping_fee,"七彩冰裂茶具专题",'七彩冰裂茶具专题(M)',false,array(),'online',$goodsnumber,0);

			break;
			default:
				Tpl::output('html_title','七彩冰裂艺术茶具套装29.8元包邮');
				Tpl::output('seo_keywords','冰裂茶具,冰裂紫砂杯,茶具套装');
				Tpl::output('seo_description','精品七彩冰裂茶具一壶六杯套装29.8元包邮！仅1000套！');

				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20161121/index_show');
			break;
		}
	
	}
	
	/**
	 * 商家双十一专题
	 * Add is name lt 2016-11-11 
	 */
	public function ad_20161111Op(){
		Tpl::output('nav_title','评级币特价保真专场，低至3折！');
		Tpl::output('html_title','评级币特价保真专场，低至3折！');
		Tpl::output('seo_keywords','钱币,银元,古币,评级币,只有一个评级币,收藏天下');
		Tpl::output('seo_description','收藏天下评级币特惠专场，全场购买任一评级币送2016猴币一枚，特价保真，对假币说“不”，低至3折！全场包邮！');
		Tpl::showpage('20161111/index_show');
	}

	/**
	 * 书画双十一专题
	 * Add is name lt 2016-11-11 
	 */
	public function ad_20161111_1Op(){
		Tpl::output('YiShu',true);
		Tpl::output('nav_title','11.11艺术范儿，名家真迹低至2折！99元秒臻品字画！- 收藏天下书画馆');
		Tpl::output('html_title','11.11艺术范儿，名家真迹低至2折！99元秒臻品字画！- 收藏天下书画馆');
		Tpl::output('seo_keywords','名家字画,书法字画,书画,国画,山水画,收藏天下书画馆');
		Tpl::output('seo_description','收藏天下书画馆双11专场，双11玩出艺术范儿，名家书画真迹低至2折！99元秒臻品字画！');
		Tpl::showpage('20161111_1/index_show');
	}

	/**
	 * 美元连体钞
	 * Add is name du 
	 */
	public function ad_20161108Op(){
		Tpl::output('html_title','美元连体钞入手的最后时机');
		Tpl::output('seo_keywords','美国大选,希拉里,特朗普,美元,汇率,升值');
		Tpl::output('seo_description','美国大选，经济动荡，美元贬值，在新总统上任之后美元将迅速回涨，现在是入手的最好时机。');
		Tpl::showpage('20161108/index_show');
	}

	/**
	 * 双十一专题
	 * Add is name lt 2016-11-01
	 */
	public function ad_20161101_1Op(){

		showWapMessage('活动已结束','index.php','error');


		$model_goods = Model('goods');

		// 删除缓存、更新后执行
		// dkcache('zhuanti_20161101')

		// // 读出缓存
		$data = rkcache('zhuanti_20161101');

		if(empty($data)){

			// 全额返券
			$goods_id_list = '11729,12384,662,36497,29780,963,36363,28211';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_1'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 精品钱币
			$goods_id_list = '913,15229,7666,846,16866,14232';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_2'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 精品邮票
			$goods_id_list = '26709,33425,35774,4094,14830,12449';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_3'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 精品金银币
			$goods_id_list = '22502,27974,20679,31244,33166,8124';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_4'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);


			// 商家产品

			// 翰墨臻品
			$goods_id_list = '35667,17291,28640,30770,30827,26075,36818,36825';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_5'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 收藏鉴赏
			$goods_id_list = '37403,28618,37506,38482,38596,38635,29775,29778';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_6'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 典雅玉饰
			$goods_id_list = '34419,35033,31468,26205,29091,34639,20909,36249,32826,33715,22420,36257,27121,34766';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_7'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 文玩风尚
			$goods_id_list = '36071,20801,23760,16028,34632,35634,36075,22580,16592,20934,36310,35563,34224,38568';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_8'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 写入缓存、时效一小时
			wkcache('zhuanti_20161101',$data,3600);
		}

		Tpl::output('goods_list',$data['goods_list']);


		Tpl::output('nav_title','狂欢11月,低至5折,免费送大金条！');
		Tpl::output('html_title','狂欢11月,低至5折,免费送大金条！ - 收藏天下');
		Tpl::output('seo_keywords','双11,双十一,购物返现,送金条,钱币,邮票,纪念币,书画,文玩,收藏天下,金银币,金银投资');
		Tpl::output('seo_description','收藏天下狂欢11月,免费送大金条！部分商品全额返现,全场低至5折！');
		Tpl::showpage('20161101_1/index_show');
	}


	/**
	 * 双十一专题
	 * Add is name lt 2016-11-01
	 */
	public function ad_20161101Op(){

		showWapMessage('活动已结束','index.php','error');

		
		$model_goods = Model('goods');

		// 删除缓存、更新后执行
		// dkcache('zhuanti_20161101')

		// // 读出缓存
		$data = rkcache('zhuanti_20161101');

		if(empty($data)){

			// 全额返券
			$goods_id_list = '11729,12384,662,36497,29780,963,36363,28211';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_1'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 精品钱币
			$goods_id_list = '913,15229,7666,846,16866,14232';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_2'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 精品邮票
			$goods_id_list = '26709,33425,35774,4094,14830,12449';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_3'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 精品金银币
			$goods_id_list = '22502,27974,20679,31244,33166,8124';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_4'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);


			// 商家产品

			// 翰墨臻品
			$goods_id_list = '35667,17291,28640,30770,30827,26075,36818,36825';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_5'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 收藏鉴赏
			$goods_id_list = '37403,28618,37506,38482,38596,38635,29775,29778';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_6'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 典雅玉饰
			$goods_id_list = '34419,35033,31468,26205,29091,34639,20909,36249,32826,33715,22420,36257,27121,34766';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_7'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 文玩风尚
			$goods_id_list = '36071,20801,23760,16028,34632,35634,36075,22580,16592,20934,36310,35563,34224,38568';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_8'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 写入缓存、时效一小时
			wkcache('zhuanti_20161101',$data,3600);
		}

		Tpl::output('goods_list',$data['goods_list']);


		Tpl::output('nav_title','狂欢双11,低至5折,免费送大金条！');
		Tpl::output('html_title','狂欢双11,低至5折,免费送大金条！ - 收藏天下');
		Tpl::output('seo_keywords','双11,双十一,购物返现,送金条,钱币,邮票,纪念币,书画,文玩,收藏天下,金银币,金银投资');
		Tpl::output('seo_description','收藏天下狂欢双11,免费送大金条！部分商品全额返现,全场低至5折！');
		Tpl::showpage('20161101/index_show');
	}


	/**
	 * 关春英书画专题
	 * Add is name du 2016-10-27
	 */
	public function ad_20161027Op(){
		switch($_GET['action']){
			case 'lingqu':
				if(!empty($_SESSION['linqu_sh_']) && ($_SESSION['linqu_sh_'] - time()) > 1 && $_SESSION['linqu_sh_sum_'] > 1){
					$result['state'] = false;
					$result['msg'] = '领取人数过多、请'.($_SESSION['linqu_sh_'] - time()).'秒后重试！';
					echo json_encode($result);
					exit();
				}
				if($_SESSION['isLogin'] != 1 && empty($_SESSION['member_id'])){
					$result['state'] = 'noLogin';
					$result['msg'] = '请登录后领取优惠券！';
					$_SESSION['linqu_sh_'] = time()+10;
					echo json_encode($result);
					exit();
				}
				$model_voucher = Model('voucher');
				$_SESSION['shoudong_voucher'] = true; //不需要积分兑换
				$vid = 381;
				//验证是否可以兑换代金券
				$data = $model_voucher->getCanChangeTemplateInfo($vid,intval($_SESSION['member_id']),intval($_SESSION['store_id']));
				if ($data['state'] == false){
					$result['state'] = false;
					$result['msg'] = $data['msg'];
					$_SESSION['linqu_sh_'] = time()+10;
					$_SESSION['linqu_sh_sum_'] = $_SESSION['linqu_sh_sum_']?($_SESSION['linqu_sh_sum_']+1):1;
					echo json_encode($result);
					exit();
				}
				//添加代金券信息
				$data = $model_voucher->exchangeVoucher($data['info'],$_SESSION['member_id'],$_SESSION['member_name'],true);
				if ($data['state'] == true){
					$result['state'] = true;
					$result['msg'] = '领取成功！';
					$_SESSION['linqu_sh_'] = time()+10;
					$_SESSION['linqu_sh_sum_'] = $_SESSION['linqu_sh_sum_']?($_SESSION['linqu_sh_sum_']+1):1;
					echo json_encode($result);
					exit();
				} else {
					$result['state'] = false;
					$result['msg'] = $data['msg'];
					$_SESSION['linqu_sh_'] = time()+10;
					$_SESSION['linqu_sh_sum_'] = $_SESSION['linqu_sh_sum_']?($_SESSION['linqu_sh_sum_']+1):1;
					echo json_encode($result);
					exit();
				}
				exit;
			break;
			default:
				Tpl::output('YiShu',true);
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::output('html_title','中国美协 官春英花鸟画专场 - 收藏天下书画馆');
				Tpl::output('seo_keywords','中国美协会员,国画,官春英,花鸟画,工笔画,书画特惠,艺术家作品,优惠券,收藏天下书画馆');
				Tpl::output('seo_description','收藏天下书画馆“中国美协官春英花鸟画专场”，领券立减800元！');
				Tpl::showpage('20161027/index_show');
			break;
		}
	}


		/**
	 * 双十一纪念币活动
	 * Add is name lt 2016-10-26
	 */
	public function ad_20161026Op(){
		showWapMessage('活动已结束','index.php','error');

		$model_goods = Model('goods');

		/*打包产品*/

		$goods_id_list = '11734,10733,5219,536,531,7514,578,564,3835,3833,3832,606';

		$condition_goods['goods_id'] = array('in',$goods_id_list);

		$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1  LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 LIMIT 1) as tuangou_money';

		$order = "field(goods_id,$goods_id_list)";

		$goods_list = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

		$goods_list_activity['11734'] = array('全网','最低价');
		$goods_list_activity['10733'] = array('销量','最高');
		$goods_list_activity['3835'] = array('藏家','热捧');
		$goods_list_activity['3833'] = array('藏家','热捧');
		$goods_list_activity['3832'] = array('藏家','热捧');

		foreach ($goods_list as $k => &$v) {
			if($goods_list_activity[$v['goods_id']]){
				$v['_activity'] = $goods_list_activity[$v['goods_id']];
			}
		}

		Tpl::output('goods_list_bao',$goods_list);

		/*返券产品*/

		$goods_id_list = '31244,34068,27974,27990,33166,17550,31230,16436,27673,22502,12384,11227';

		$condition_goods['goods_id'] = array('in',$goods_id_list);

		$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1  LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 LIMIT 1) as tuangou_money';

		$order = "field(goods_id,$goods_id_list)";

		$goods_list = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

		$goods_list_voucher['31244'] = array('100');
		$goods_list_voucher['34068'] = array('100');
		$goods_list_voucher['27974'] = array('50');
		$goods_list_voucher['27990'] = array('50');
		$goods_list_voucher['33166'] = array('50');
		$goods_list_voucher['17550'] = array('50');
		$goods_list_voucher['31230'] = array('50');
		$goods_list_voucher['16436'] = array('50');
		$goods_list_voucher['27673'] = array('30');
		$goods_list_voucher['22502'] = array('30');
		$goods_list_voucher['12384'] = array('30');
		$goods_list_voucher['11227'] = array('30');

		foreach ($goods_list as $k => &$v) {
			if($goods_list_voucher[$v['goods_id']]){
				$v['_voucher'] = $goods_list_voucher[$v['goods_id']];
			}
		}

		Tpl::output('goods_list_voucher',$goods_list);


		$this_time =  date("H:i:s");
		if($this_time < '09:59:59'){
		    $act_state = false;
		}elseif($this_time > '09:59:59' && $this_time < '19:59:59'){
			$act_state = true;
		    $s_time = strtotime(date('Y-m-d').' 09:59:59');
			$e_time = strtotime(date('Y-m-d').' 19:59:59');
		}elseif($this_time > '19:59:59' && $this_time < '23:59:59'){
			$act_state = true;
		    $s_time = strtotime(date('Y-m-d').' 19:59:59');
			$e_time = strtotime(date('Y-m-d').' 23:59:59');
		}
		if($act_state){
			$condition_act['Z_ZhuantiId'] = '1026';
			$condition_act['Z_Time'] = array('between',$s_time.','.$e_time);
			$act_count = Model()->table('activity_zhuanti')->where($condition_act)->count();
		}
		
		if($this_time < '09:59:59'){
			$t_1 = '10点开始';
			$t_2 = '今日上午10点即将开抢...';
			$t_3 = false;
		}elseif($this_time > '09:59:59' && $this_time < '19:59:59'){
			if($act_count > 5){
				$t_1 = '20点开始';
				$t_2 = '上午的配额已抢光,晚上20点再次开抢...';
				$t_3 = false;
			}else{
				$t_1 = '10点开始';
				$t_2 = '抢购中......';
				$t_3 = true;
			}
		}elseif($this_time > '19:59:59' && $this_time < '23:59:59'){
			if($act_count > 5){
				$t_1 = '10点开始';
				$t_2 = '今日配额已抢光,明日上午10点再次开抢...';
				$t_3 = false;
			}else{
				$t_1 = '20点开始';
				$t_2 = '抢购中......';
				$t_3 = true;
			}
		}

		Tpl::output('t_1',$t_1);
		Tpl::output('t_2',$t_2);
		Tpl::output('t_3',$t_3);

		Tpl::output('nav_title','纪念币特惠专场');
		Tpl::output('html_title','纪念币特惠专场 ');
		Tpl::output('seo_keywords','双11,纪念币,猴币,1元,返现');
		Tpl::output('seo_description','猴币惊爆价仅售1元！收藏天下双11预热，纪念币特价销售，1元买猴币，单品返现享不停，时间有限，速来');
		Tpl::showpage('20161026/index_show');
	}

	public function addGoods_1026Op(){

		// 检测是否登陆
		if($_SESSION['is_login'] !== '1'){
			$result['state'] = false;
			$result['msg'] = '请登陆后参与该活动！';
            exit(json_encode($result));
		}

		// 检测是否点击过领取
		if(!empty($_SESSION['qianggou_sh_']) && ($_SESSION['qianggou_sh_'] - time()) > 1){
			$result['state'] = false;
			$result['msg'] = '参加人数过多、请'.($_SESSION['qianggou_sh_'] - time()).'秒后重试！';
            exit(json_encode($result));
		}


		$this_time =  date("H:i:s");
		if($this_time < '09:59:59'){
		    $act_state = false;
		    $result['state'] = false;
			$result['msg'] = '活动还未开始！';
            exit(json_encode($result));
		}elseif($this_time > '09:59:59' && $this_time < '19:59:59'){
			$act_state = true;
		    $s_time = strtotime(date('Y-m-d').' 09:59:59');
			$e_time = strtotime(date('Y-m-d').' 19:59:59');
		}elseif($this_time > '19:59:59' && $this_time < '23:59:59'){
			$act_state = true;
		    $s_time = strtotime(date('Y-m-d').' 19:59:59');
			$e_time = strtotime(date('Y-m-d').' 23:59:59');
		}
		if($act_state){
			$condition_act['Z_ZhuantiId'] = '1026';
			$condition_act['Z_Time'] = array('between',$s_time.','.$e_time);
			$act_count = Model()->table('activity_zhuanti')->where($condition_act)->count();
			if($act_count > 5){
				$result['state'] = false;
				$result['msg'] = '该时间段活动已结束！请下个时间段再来！';
	            exit(json_encode($result));
			}
		}

 
		// 检测抢购表中是否存在该用户
		$condition['Z_MemberId'] = $_SESSION['member_id'];
		$condition['Z_ZhuantiId'] = '1026';
		$act_info = Model('activity_zhuanti')->where($condition)->find();
		if(!empty($act_info)){
			$result['state'] = false;
			$result['msg'] = '您已参与过该活动！';
			$_SESSION['qianggou_sh_'] = time()+10;
            exit(json_encode($result));
		}

		try {

            Model()->beginTransaction();

			// 添加到抢购表中
			$addData['Z_MemberId'] = $_SESSION['member_id'];
			$addData['Z_ZhuantiId'] = '1026';
			$addData['Z_Time'] = time();
			$add_act_info = Model('activity_zhuanti')->insert($addData);

			if(empty($add_act_info)){
				throw new Exception();
			}

			// 商品添加到购物车中
			$model_goods = Model('goods');
			$goods_id = '14164';
			$goods_info	= $model_goods->getGoodsOnlineInfoAndPromotionById($goods_id);
			$save_type = 'db';
	        $goods_info['buyer_id'] = $_SESSION['member_id'];
	        $goods_info['goods_price'] = '1.00';
	        $model_cart	= Model('cart');
	        $insert = $model_cart->addCart($goods_info,$save_type,'1');

	        if(empty($insert)){
				throw new Exception();
			}

	        setNcCookie('cart_goods_num',$model_cart->cart_goods_num,2*3600);



			// 添加用户到活动表中
			$addDataAct['U_MemberId'] = $_SESSION['member_id'];
			$addDataAct['U_ActivityId'] = '3';
			$addDataAct['U_State'] = '1';
			$addDataAct['U_Time'] = time();
			$add_act_user_info = Model('activity_goods_user')->insert($addDataAct);

			if(empty($add_act_user_info)){
				throw new Exception();
			}

			Model()->commit();

			$_SESSION['qianggou_sh_'] = time()+10;

			$result['state'] = true;
			$result['msg'] = '成功加入购物车，请尽快结算！';
            exit(json_encode($result));

        } catch (Exception $e) {

        	$_SESSION['qianggou_sh_'] = time()+10;


            Model()->rollback();

            $result['state'] = false;
			$result['msg'] = '参与失败！';
            exit(json_encode($result));
        }

	}

	/**
	 * 双十一纪念币活动
	 * Add is name lt 2016-10-26
	 * End
	 */

	
	
	public function ad_20161025Op(){
		Tpl::output('html_title','漪风阁佛珠臻品,低至3折！');
		Tpl::output('seo_keywords','文玩,佛珠手串,黄花梨,金丝楠木,小叶紫檀,漪风阁佛珠,收藏天下');
		Tpl::output('seo_description','收藏天下推荐，漪风阁臻品佛珠手串深秋赏新，海南黄花梨、金丝楠、老料小叶紫檀限时特惠，低至3折！满500减150，满1000减350，满1500减500，全场包邮！');
		Tpl::showpage('20161025/index_show');
	}
		/**
	 * 免费神十一宇航员亲笔签名
	 */
	public function ad_20161022Op(){
		showWapMessage('活动已结束','index.php','error');
		//设置活动参数
		$value = array(
					'maxorderamount' => '399', //限定最低订单金额
					'add_time' => 1477238400, //活动开始时间
					'Hd_time' => 1477929600, //活动结束时间
					'ad_name' => '20161022',
					'ad_log'=> '免费领取神十一宇航员亲笔签名',
					'order_log'=>'该订单已参加免费神十一宇航员亲笔签名'
		);
		switch($_GET['action']){
			case 'lingqu':
					$this->IsOrderYanZeng($value,'35625,35624');
					$goodsid_array = array('35625'=>'0','35624'=>'0');
					$goods_amount = '0'; //商品总额
					$shipping_fee = '0'; //运费
					$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'免费领取神十一宇航员亲笔签名','免费领取神十一宇航员亲笔签名(m)',true,$_POST['lid']);
			break;
			case 'YanZneg':
				$lid = $this->IsOrderYanZeng($value);
				$result['lid'] =  $lid;
				$result['order_sn'] =  $_POST['order_sn'];
				echo json_encode($result); 
				exit();
			break;
			default:
					$goods_id_list = '35042,35374,35278,29780,33975,16963,846,16866,12351,12384,15229,22502';
					$condition_goods['goods_id'] = array('in',$goods_id_list);
					$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image';
					$goods_list = Model('goods')->getGoodsList($condition_goods,$field_goods,$order);
					Tpl::output('goods_list',$goods_list);
					Tpl::output('html_title','满399元送中国航天员签名首日封 收藏天下');
					Tpl::output('seo_keywords','');
					Tpl::output('seo_description','');
					Tpl::output('no_header',true);
					Tpl::output('no_footer',true);
					Tpl::showpage('20161022/index_show');
			break;
		}
	}
	



	/**
	 * 领金条活动 Add is name du 2016-10-18
	 */
	public function ad_20161019_2Op(){
		switch($_GET['action']){
			case 'lingqu':
				$goodsid_array = array('35289'=>'19.8');
				$where_member_from['member_id'] = intval($_SESSION['member_id']);
				$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
				if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
				$goods_amount = '19.8'; //商品总额
				$shipping_fee = '0'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"领金条19.8元包邮_2",'领金条19.8元包邮_2(M)');
			break;
			case 'regs':
				//注册
				$model_member	= Model('member');
				$code = $_POST['code'];
				if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
					$result['state'] = false;
					$result['msg'] = "验证码错误";
					echo json_encode($result); 
					exit();
				}
				$register_info = array();
				$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
				$register_info['username'] = $_POST['mobile'];
				$register_info['password'] = $_POST['mobile'];
				$register_info['password_confirm'] = $_POST['mobile'];
				$register_info['mobile'] = $_POST['mobile'];
				$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
				$register_info['member_from'] = '领金条19.8元包邮_2('.$M.')';
				$member_info = $model_member->register($register_info);
				if(!isset($member_info['error'])) {
					$msg = "注册成功！用户名和密码均为您的手机号码：".$_POST['mobile']."，请及时登录收藏天下官网进行修改。";
					$sms = new Sms();
					$sms->send($_POST['mobile'],$msg);
					$model_member->createSession($member_info,true);
					exit(json_encode(array('state'=>true,'msg'=>"OK",'username'=>$_POST['mobile'],'password'=>$_POST['mobile'])));
				}else{
					exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
				}
			break;
			default:
				Tpl::output('nav_title','天下第一福 金条');
				Tpl::output('html_title','天下第一福 金条');
				Tpl::output('seo_keywords','金条、黄金价格、白银价格、投资、收藏、送礼');
				Tpl::output('seo_description','康熙帝稀世亲笔御赐，天下第一“福”——百福呈祥纪念金条，送礼、投资、收藏，每天500条疯狂派送，只为回馈！');
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20161019_2/index_show');
			break;
		}
		
	}



	/**
	 * 领金条活动 Add is name du 2016-10-18
	 */
	public function ad_20161019_1Op(){
		switch($_GET['action']){
			case 'lingqu':
				$goodsid_array = array('35289'=>'19.8');
				$where_member_from['member_id'] = intval($_SESSION['member_id']);
				$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
				if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
				$goods_amount = '19.8'; //商品总额
				$shipping_fee = '0'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"领金条19.8元包邮_1",'领金条19.8元包邮_1(M)');
			break;
			case 'regs':
				//注册
				$model_member	= Model('member');
				$code = $_POST['code'];
				if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
					$result['state'] = false;
					$result['msg'] = "验证码错误";
					echo json_encode($result); 
					exit();
				}
				$register_info = array();
				$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
				$register_info['username'] = $_POST['mobile'];
				$register_info['password'] = $_POST['mobile'];
				$register_info['password_confirm'] = $_POST['mobile'];
				$register_info['mobile'] = $_POST['mobile'];
				$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
				$register_info['member_from'] = '领金条19.8元包邮_1('.$M.')';
				$member_info = $model_member->register($register_info);
				if(!isset($member_info['error'])) {
					$msg = "注册成功！用户名和密码均为您的手机号码：".$_POST['mobile']."，请及时登录收藏天下官网进行修改。";
					$sms = new Sms();
					$sms->send($_POST['mobile'],$msg);
					$model_member->createSession($member_info,true);
					exit(json_encode(array('state'=>true,'msg'=>"OK",'username'=>$_POST['mobile'],'password'=>$_POST['mobile'])));
				}else{
					exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
				}
			break;
			default:
				Tpl::output('nav_title','天下第一福 金条');
				Tpl::output('html_title','天下第一福 金条');
				Tpl::output('seo_keywords','金条、黄金价格、白银价格、投资、收藏、送礼');
				Tpl::output('seo_description','康熙帝稀世亲笔御赐，天下第一“福”——百福呈祥纪念金条，送礼、投资、收藏，每天500条疯狂派送，只为回馈！');
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20161019_1/index_show');
			break;
		}
		
	}



	/**
	 * 领金条活动 Add is name du 2016-10-18
	 */
	public function ad_20161019Op(){
		switch($_GET['action']){
			case 'lingqu':
				$goodsid_array = array('35289'=>'19.8');
				$where_member_from['member_id'] = intval($_SESSION['member_id']);
				$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
				if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
				$goods_amount = '19.8'; //商品总额
				$shipping_fee = '0'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"领金条19.8元包邮",'领金条19.8元包邮(M)');
			break;
			case 'regs':
				//注册
				$model_member	= Model('member');
				$code = $_POST['code'];
				if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
					$result['state'] = false;
					$result['msg'] = "验证码错误";
					echo json_encode($result); 
					exit();
				}
				$register_info = array();
				$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
				$register_info['username'] = $_POST['mobile'];
				$register_info['password'] = $_POST['mobile'];
				$register_info['password_confirm'] = $_POST['mobile'];
				$register_info['mobile'] = $_POST['mobile'];
				$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
				$register_info['member_from'] = '领金条19.8元包邮('.$M.')';
				$member_info = $model_member->register($register_info);
				if(!isset($member_info['error'])) {
					$msg = "注册成功！用户名和密码均为您的手机号码：".$_POST['mobile']."，请及时登录收藏天下官网进行修改。";
					$sms = new Sms();
					$sms->send($_POST['mobile'],$msg);
					$model_member->createSession($member_info,true);
					exit(json_encode(array('state'=>true,'msg'=>"OK",'username'=>$_POST['mobile'],'password'=>$_POST['mobile'])));
				}else{
					exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
				}
			break;
			default:
				Tpl::output('nav_title','天下第一福 金条');
				Tpl::output('html_title','天下第一福 金条');
				Tpl::output('seo_keywords','金条、黄金价格、白银价格、投资、收藏、送礼');
				Tpl::output('seo_description','康熙帝稀世亲笔御赐，天下第一“福”——百福呈祥纪念金条，送礼、投资、收藏，每天500条疯狂派送，只为回馈！');
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20161019/index_show');
			break;
		}
		
	}
	
	/**
	 * 孙中山 Add is name du 2016-10-18
	 */
	public function ad_20161018_1Op(){
// 		showWapMessage('活动已结束','index.php','error');
// exit;
		switch($_GET['action']){
			case 'lingqu':
				$goodsid_array = array('33970'=>'5');
				$where_member_from['member_id'] = intval($_SESSION['member_id']);
				$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
				if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
				$goods_amount = '5'; //商品总额
				$shipping_fee = '9'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"孙中山纪念币兑换等值兑换",'孙中山纪念币兑换等值兑换(M)');
			break;
			case 'regs':
				//注册
				$model_member	= Model('member');
				$code = $_POST['code'];
				if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
					$result['state'] = false;
					$result['msg'] = "验证码错误";
					echo json_encode($result); 
					exit();
				}
				$register_info = array();
				$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
				$register_info['username'] = $_POST['mobile'];
				$register_info['password'] = $_POST['mobile'];
				$register_info['password_confirm'] = $_POST['mobile'];
				$register_info['mobile'] = $_POST['mobile'];
				$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
				$register_info['member_from'] = '孙中山纪念币兑换等值兑换('.$M.')';
				$member_info = $model_member->register($register_info);
				if(!isset($member_info['error'])) {
					$model_member->createSession($member_info,true);
					$msg = "注册成功！用户名和密码均为您的手机号码：".$_POST['mobile']."，请及时登录收藏天下官网进行修改。";
					$sms = new Sms();
					$sms->send($_POST['mobile'],$msg);
					exit(json_encode(array('state'=>true,'msg'=>"OK",'username'=>$_POST['mobile'],'password'=>$_POST['mobile'])));
				}else{
					exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
				}
			break;
			default:
				Tpl::output('nav_title','孙中山纪念币等值兑换');
				Tpl::output('html_title','孙中山纪念币等值兑换');
				Tpl::output('seo_keywords','孙中山诞辰150周年纪念币  兑换  孙中山  纪念币');
				Tpl::output('seo_description','孙中山诞辰150周年纪念币等值兑换，不需银行排队，轻松兑换！');
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20161018_1/index_show');
			break;
		}
		
	}
	/**
	 * 书画馆 Add is name lt 2016-10-18
	 */
	public function ad_20161018Op(){
		// showWapMessage('活动结束','http://m.96567.com/index.php?act=artist','error');
		// exit;
		Tpl::output('nav_title','收藏天下书画馆开馆特惠');
		Tpl::output('html_title','收藏天下书画馆开馆特惠');
		Tpl::output('seo_keywords','收藏天下书画馆,国画,油画,名家字画,书法,艺术收藏,收藏天下,返现,艺术家,中国美协,中国书协');
		Tpl::output('seo_description','收藏天下书画馆隆重上线！豪掷千万现金返现，先领券再返现，最高立省1300元，速来选择一幅属于你的名家书画！');
		Tpl::showpage('20161018/index_show');
	}


	public function shLinQuan_1018Op(){

		$quan_number = intval($_POST['quan']);

		if(empty($quan_number)){
			$result['state'] = false;
			$result['msg'] = '领取金额不正确！';
            echo json_encode($result);
            exit();
		}
		
		if(!empty($_SESSION['linqu_sh_']) && ($_SESSION['linqu_sh_'] - time()) > 1 && $_SESSION['linqu_sh_sum_'] > 1){
			$result['state'] = false;
			$result['msg'] = '领取人数过多、请'.($_SESSION['linqu_sh_'] - time()).'秒后重试！';
            echo json_encode($result);
            exit();
		}
		
		if($_SESSION['isLogin'] != 1 && empty($_SESSION['member_id'])){
			$result['state'] = false;
			$result['noLogin'] = true;
			$result['msg'] = '请登录后领取优惠券！';
			$_SESSION['linqu_sh_'] = time()+10;
            echo json_encode($result);
            exit();
		}

		$model_voucher = Model('voucher');
		$_SESSION['shoudong_voucher'] = true; //不需要积分兑换

		switch ($quan_number) {
			case '200':
				$vid = 365;
				break;
			case '500':
				$vid = 366;
				break;
		}

		//验证是否可以兑换代金券
		$data = $model_voucher->getCanChangeTemplateInfo($vid,intval($_SESSION['member_id']),intval($_SESSION['store_id']));
		if ($data['state'] == false){
			$result['state'] = false;
			$result['msg'] = $data['msg'];
			$_SESSION['linqu_sh_'] = time()+10;
						$_SESSION['linqu_sh_sum_'] = $_SESSION['linqu_sh_sum_']?($_SESSION['linqu_sh_sum_']+1):1;

            echo json_encode($result);
            exit();
		}
		//添加代金券信息
		$data = $model_voucher->exchangeVoucher($data['info'],$_SESSION['member_id'],$_SESSION['member_name'],true);
		if ($data['state'] == true){
			$result['state'] = true;
			$result['msg'] = '领取成功！';
			$_SESSION['linqu_sh_'] = time()+10;
						$_SESSION['linqu_sh_sum_'] = $_SESSION['linqu_sh_sum_']?($_SESSION['linqu_sh_sum_']+1):1;

            echo json_encode($result);
            exit();
		} else {
		    $result['state'] = false;
			$result['msg'] = $data['msg'];
			$_SESSION['linqu_sh_'] = time()+10;
						$_SESSION['linqu_sh_sum_'] = $_SESSION['linqu_sh_sum_']?($_SESSION['linqu_sh_sum_']+1):1;

            echo json_encode($result);
            exit();
		}
		exit;
	}


	/* 书画馆  End */



	/**
	 * 航天专题 Add is name lt 2016-10-17
	 */
	public function ad_20161017Op(){

		$model_goods = Model('goods');
		// 单个产品

		$goods_id_list = '35111,35048,35043,35042,11734,12354,11735,12368,12351,15698,12367,12353,15161,3381,1904,2200,3844,3842,5212,5211';

		$condition_goods['goods_id'] = array('in',$goods_id_list);

		$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1  LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 LIMIT 1) as tuangou_money';

		$order = "field(goods_id,$goods_id_list)";

		$goods_list = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

		Tpl::output('goods_list',$goods_list);
		Tpl::output('nav_title','收藏天下热烈恭贺“神十一”发射成功！');
		Tpl::output('html_title','收藏天下热烈恭贺“神十一”发射成功！');
		Tpl::output('seo_keywords','神十一发射成功,航天纪念钞,航天纪念币,神州十一号,天宫二号,航天金银币,收藏天下');
		Tpl::output('seo_description','收藏天下热烈恭贺“神十一”发射成功，航天藏品特价35元起，送熊猫金币，航天纪念钞币套装！活动力度空前，速来选购！');
		Tpl::showpage('20161017/index_show');
	}
	/**
	 * 预约航天纪念币 Add is name du. 2016-10-14
	 */
	public function ad_20161014_1Op(){
		if($_GET['action'] == 'tijiao'){
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！')
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				$result['state'] = false;
				$result['msg'] = $error;
				echo json_encode($result); 
				exit();
			}

			$laiyuan = '航天60周年纪念微章'.($_GET['ua']?$_GET['ua']:'m');

			$laiyuan = urlencode($laiyuan);

			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mob_phone'].'&N='.urlencode($_POST['true_name']).'&AdFrom=ad_20161014_1'.'&A_Num='.$_POST['goods_sum'].'&A_From='.$laiyuan.'&is_reg=0&tg_from='.urlencode($_SESSION['tg_from']));
			
			if($retuen_type == 1){
				$msg = "感谢您成功预约《航天创建60周年纪念大全》，详情请登录【收藏天下】官方网站咨询。";
				$sms = new Sms();
				$sms->send($_POST['mob_phone'],$msg);
				$result['state'] = true;
				$result['msg'] = "您已预约成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!";
				echo json_encode($result); 
				exit();
			}else{
				$result['state'] = true;
				$result['msg'] = "您已预约成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!";
				echo json_encode($result); 
				exit();
			}

		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title','官方特批“中国探月”标识官方藏品');
			Tpl::output('seo_keywords','官方特批“中国探月”标识官方藏品');
			Tpl::output('seo_description','官方特批“中国探月”标识官方藏品');

			Tpl::showpage('20161014_1/index_show');
		}
	}
	/**
	 * 预约航天纪念币 Add is name du. 2016-10-14
	 */
	public function ad_20161014Op(){
		if($_GET['action'] == 'tijiao'){
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！')
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				$result['state'] = false;
				$result['msg'] = $error;
				echo json_encode($result); 
				exit();
			}

			$laiyuan = '航天60周年纪念微章'.($_GET['ua']?$_GET['ua']:'m');

			$laiyuan = urlencode($laiyuan);

			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mob_phone'].'&N='.urlencode($_POST['true_name']).'&AdFrom=ad_20161014'.'&A_Num='.$_POST['goods_sum'].'&A_From='.$laiyuan.'&is_reg=0&tg_from='.urlencode($_SESSION['tg_from']));
			
			if($retuen_type == 1){
				$msg = "感谢您成功预约《航天创建60周年纪念大全》，详情请登录【收藏天下】官方网站咨询。";
				$sms = new Sms();
				$sms->send($_POST['mob_phone'],$msg);
				$result['state'] = true;
				$result['msg'] = "您已预约成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!";
				echo json_encode($result); 
				exit();
			}else{
				$result['state'] = true;
				$result['msg'] = "您已预约成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!";
				echo json_encode($result); 
				exit();
			}

		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title','官方特批“中国探月”标识官方藏品');
			Tpl::output('seo_keywords','官方特批“中国探月”标识官方藏品');
			Tpl::output('seo_description','官方特批“中国探月”标识官方藏品');

			Tpl::showpage('20161014/index_show');
		}
	}
	/**
	 * 邮票活动 Add is name lt 2016-10-12
	 */
	public function ad_20161012Op(){


		if(chksubmit(true)){

			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['zc_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['zc_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['zc_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
				array("input"=>$_POST['zc_yzm'],"require"=>"true", "message"=>'验证码不能为空！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				showMessage($error,'','error');
				exit();
			}

			if(($_SESSION['push_phone_yzm'] != $_POST['zc_yzm']) || ($_SESSION['push_phone'] != $_POST['zc_phone'])){
				showMessage('验证码不正确！','','error');
				exit();
			}
		}elseif($_GET['action'] == 'ZhuCe'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$register_info['member_from'] = "致记忆中逝去的邮年";
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$result['msg'] = '注册成功';
				$model_member->createSession($member_info,true);
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}

		
		Tpl::output('html_title','致记忆中逝去的\'邮\'年');
		Tpl::output('seo_keywords','邮票收藏、生肖邮票、邮册、纪念邮票、邮折、小版票、文革邮票、编年邮票、收藏天下');
		Tpl::output('seo_description','邮票，是一个时代的象征，更是一代记忆的收藏文库。它的精致，让人垂慕和追寻，它的文史价值，让人叹服和崇尚，它是高雅的品鉴“文物”，也是最具纪念价值的时代臻品。');

		Tpl::showpage('20161012/index_show');
	}


	/**
	 * 砗磲活动 Add is name lt 2016-10-11
	 */
	public function ad_20161011Op(){
		
		Tpl::output('nav_title','神秘佛宝-海底灵玉砗磲低至39元！龙御堂砗磲特惠专场！');
		Tpl::output('html_title','神秘佛宝-海底灵玉砗磲低至39元！龙御堂砗磲特惠专场！');
		Tpl::output('seo_keywords','砗磲,砗磲手串,砗磲挂件,砗磲吊坠,砗磲摆件,龙御堂砗磲,海南砗磲,收藏天下');
		Tpl::output('seo_description','神秘佛宝-海底灵玉海南砗磲，限时特惠低至39元！全场满199减40，满499减100，满1000减300，包邮！');

		Tpl::showpage('20161011/index_show');
	}



	/**
	 * 佛教七宝 Add is name lt 2016-09-29
	 */
	public function ad_20160929Op(){

		Tpl::output('nav_title','佛教七宝 最高立减1200元');
		Tpl::output('html_title','佛教七宝 最高立减1200元');
		Tpl::output('seo_keywords','文玩,佛珠手串,玛瑙,南红,小叶紫檀,菩提子,金刚菩提,只有一个,收藏天下');
		Tpl::output('seo_description','收藏天下佛教七宝结缘专场，最高立减1200元！');

		Tpl::showpage('20160929/index_show');
	}



	/**
	 * 新十国钞领取页面
	 */
	public function ad_20160920_1Op(){
		switch($_GET['action']){
			case 'lingqu':
				$goodsid_array = array('28614'=>'0');
				$where_member_from['member_id'] = intval($_SESSION['member_id']);
				$where_member_from['member_from'] = array('like','%免费领取中国纸币%');
				$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
				if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
				$goods_amount = '0'; //商品总额
				$shipping_fee = '9.9'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"免费领取中国纸币",'免费领取中国纸币(M)');
			break;
			case 'regs':
				//注册
				$model_member	= Model('member');
				$code = $_POST['code'];
				if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
					$result['state'] = false;
					$result['msg'] = "验证码错误";
					echo json_encode($result); 
					exit();
				}
				$register_info = array();
				$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
				$register_info['username'] = $_POST['user_name'];
				$register_info['password'] = $_POST['mobile'];
				$register_info['password_confirm'] = $_POST['mobile'];
				$register_info['mobile'] = $_POST['mobile'];
				$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
				$register_info['member_from'] = '免费领取中国纸币('.$M.')';
				$member_info = $model_member->register($register_info);
				if(!isset($member_info['error'])) {
					$model_member->createSession($member_info,true);
					$msg = "恭喜您注册成功，客服将第一时间与您取得联系。会员号：".$_POST['user_name']."密码：".$_POST['mobile']."登录官网·领取代金券让收藏走进大众·只做正品收藏";
					$sms = new Sms();
					$sms->send($_POST['mobile'],$msg);
					exit(json_encode(array('state'=>true,'msg'=>"OK",'username'=>$_POST['user_name'],'password'=>$_POST['mobile'])));
				}else{
					exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
				}
			break;
			default:
					Tpl::output('no_header',true);
					Tpl::output('no_footer',true);
					Tpl::showpage('20160920_1/index_show');
			break;
		}

	}
	/**
	 * 杜 免费领取
	 */
	public function ad_20160920Op(){
		if($_GET['action'] == 'yanzhengone'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$code = $_POST['code'];
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
				$result['error'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$register_info['member_mobile_bind'] = 1;
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '免费送70周年纪念币('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$result['msg'] = '注册成功';
				$model_member->createSession($member_info,true);
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}elseif($_GET['action'] == 'lingqu'){
			$goodsid_array = array('10733'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%免费送70周年纪念币%');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
			$goods_amount = '0'; //商品总额
			$shipping_fee = '12'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"免费送70周年纪念币",'免费领取(M)');
		}else{
			$goodsid_array = array('10733'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%免费送70周年纪念币%');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error'] == '您不符合领取资格') Tpl::output('is_lin','1');
			Tpl::output('member_id',intval($_SESSION['member_id']));
			Tpl::output('html_title',"收藏天下注册有礼，免费送抗战胜利70周年纪念币。");
			Tpl::output('seo_keywords',"注册有礼,免费领取,抗战胜利纪念币,抗战70周年纪念币,抗战币,纪念币");
			Tpl::output('seo_description',"收藏天下注册有礼再次来袭，注册就免费送抗战胜利70周年纪念币，带册装帧更豪华，存世流传有心意。立刻注册，立刻免费领抗战胜利70周年纪念币，自己珍藏、送人礼物，均是极棒的选择。来收藏天下，免费好礼免费拿！");
			Tpl::showpage('20160920/index_show');
		}
	}

	/**
	 * 中秋活动 Add is name lt 2016-09-10
	 */
	public function ad_20160910Op(){
		Tpl::output('nav_title','紫珊瑚画廊中秋特惠 翰墨臻品买一得二');
		Tpl::output('html_title','紫珊瑚画廊中秋特惠 翰墨臻品买一得二');
		Tpl::output('seo_keywords','中秋特惠,中秋活动,赠品,买一赠一,书画促销活动,名家真迹,收藏天下');
		Tpl::output('seo_description','紫珊瑚画廊中秋书画特惠，翰墨臻品买一得二，全场低至130元！');


		Tpl::showpage('20160910/index_show');
	}


	/**
	 * 中秋送银月饼活动 开始
	 */
	public function ad_20160905Op(){
		if(time() > 1474214400){
			showMessage('活动结束','index.php','html','error');
			exit;
		}
		switch($_GET['action']){
			case 'lingqu':
					$this->YanZeng('11086');
					$goodsid_array = array('11086'=>'0');
					$goods_amount = '0'; //商品总额
					$shipping_fee = '0'; //运费
					$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'中秋送银月饼','中秋送银月饼(m)',true,$_POST['lid']);
			break;
			case 'YanZneg':
				$lid = $this->YanZeng();
				$result['lid'] =  $lid;
				$result['order_sn'] =  $_POST['order_sn'];
				echo json_encode($result); 
				exit();
			break;
			default:
					$goods_id_list = '1310,27974,22502,28879,29515,23728,18267,18376';
					$condition_goods['goods_id'] = array('in',$goods_id_list);
					$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image';
					$goods_list = Model('goods')->getGoodsList($condition_goods,$field_goods,$order);
					Tpl::output('goods_list',$goods_list);
//					Tpl::output('no_header',true);
//					Tpl::output('no_footer',true);
				//	Tpl::output('robots',true); //屏蔽搜索引擎抓取
					Tpl::output('nav_title','【中秋献礼】送中秋好礼银月饼');
					Tpl::output('html_title','【中秋献礼】送中秋好礼银月饼');
					Tpl::output('seo_keywords','银月饼  中秋  送礼 ');
					Tpl::output('seo_description','收藏天下感恩回馈，中秋月圆之际，单笔订单满1288元即可免费领取一份礼盒装银月饼，一份热情，一份心意，收获的是一份满满的感动！');
					Tpl::showpage('20160905/index_show');
			break;
		}
	}

   private function YanZeng($goods_id=0){
	   if(time() > 1474214400){
			$result['error'] =  '活动已结束';
			echo json_encode($result); 
			exit();
		}
		//验证用户是否有资格领取
		if(intval($_SESSION['member_id']) <= 0){ //检查是否登陆
				echo '-1';
				exit;
		}
		$order_sn = $_POST['order_sn'];
		//检查订单号是否为空
		if($order_sn == ''){
			$result['error'] =  '订单号不能为空';
			echo json_encode($result); 
			exit();
		}
		$maxorderamount = 1288;//设置最低领奖金额
		//检查订单号是否符合要求
		$where = array();
		$where['buyer_id'] = intval($_SESSION['member_id']);
		$where['order_state'] = array('egt',20);
		$where['add_time'] = array('egt','1473004800');
		//$where['add_time'] = array('elt','1474214400');
		$where['order_amount'] = array('egt',$maxorderamount);
		$where['order_sn'] = $order_sn;
		$order = $this->ZtModel->getOrder($where,'order_id,order_amount,order_sn,payment_code,order_state,(select order_status from shop_yw_info where orderid = order_id) as order_status,(select shipping_status from shop_yw_info where orderid = order_id) as shipping_status,(select pay_status from shop_yw_info where orderid = order_id) as pay_status');
	
		if(count($order) > 0){
			$order_info = $order[0];
			//检查是否是货到付款订单
			if($order_info['payment_code'] == 'offline'){
				//如果是检查是否已完成
				if($order_info['order_state'] < 40){
					$result['error'] =  '对不起，您不满足领取资格！';
					echo json_encode($result); 
					exit();
				}
			}
			//检查订单号是否已经领取过
			$count_Lot = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160905','member_id'=>intval($_SESSION['member_id']),'l_orderid'=>$order_info['order_id'],'is_fafang'=>1));
			if($count_Lot > 0){
				$result['error'] =  '对不起，一个订单号只能领取一次！';
				echo json_encode($result); 
				exit();
			}else{
				
				$count_Lot = $this->ZtModel->getLotteryList(array('ad_name'=>'20160905','member_id'=>intval($_SESSION['member_id']),'l_orderid'=>$order_info['order_id']));
				$data = array();
				$data['member_id'] = intval($_SESSION['member_id']);
				$data['year'] = date('Y',time());
				$data['month'] = date('m',time());
				$data['day'] = date('d',time());
				$data['hour'] = date('H',time());
				$data['time'] = date('H:i:s',time());
				$data['add_time'] = time();
				$data['ip'] = $_SERVER['REMOTE_ADDR'];
				$data['ad_name'] = '20160905';
				$data['l_name'] = '中秋送银月饼';
				$data['l_id'] = 0;
				$data['l_orderid'] = $order_info['order_id'];
				$data['is_fafang'] = 0;
				if($goods_id == 0 && count($count_Lot) == 0){
					return $this->ZtModel->addLottery($data);
				}else{
					if($goods_id == 0){
						return $count_Lot[0]['id'];
					}
					$data['goods_id'] = $goods_id;
					$this->ZtModel->upLotteryReceive($data,array('id'=>$count_Lot[0]['id']));
					 //添加订单日志
					$data = array();
					$data['order_id'] = $order_info['order_id'];
					$data['log_role'] = '买家';
					$data['log_user'] = $_SESSION['memebr_name'];
					$data['order_status'] = intval($order_info['order_status']);
					$data['shipping_status'] = intval($order_info['shipping_status']);
					$data['pay_status'] = intval($order_info['pay_status']);
					$data['log_msg'] = '该订单已参加送银饼活动';
					$data['log_orderstate'] = $order_info['order_state'];
					Model('order')->addOrderLog($data);  
				}
				
			}

		}else{
			$result['error'] =  '对不起，您不满足领取资格！';
			echo json_encode($result); 
			exit();
		}
	}
	/**
	 * 中秋送银月饼活动结束
	 */

	/**
	 * 手串专题
	 */
	public function ad_20160826Op(){
		showWapMessage('活动已结束','index.php','error');
		exit;
//		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
	    Tpl::output('nav_title','惊爆价28.8元，精品赞比亚紫檀手串');
		Tpl::output('html_title','28.8元！买精品赞比亚紫檀手串，仅300条！');
		Tpl::output('seo_keywords','文玩、手串、紫檀、特惠');
		Tpl::output('seo_description','野生老料，高密高油。品牌推广季，你值得拥有');
		Tpl::showpage('20160826/index_show');
	}

	public function ad_20160901_2Op(){

		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
			Tpl::output('this_laiyuan','m');
		}else{
			Tpl::output('this_laiyuan','weixin');
		}

		if(chksubmit(true)){

			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
				array("input"=>$_POST['yzm'],"require"=>"true", "message"=>'验证码不能为空！'),
				array("input"=>$_POST['goods_sum'],"require"=>"true", "message"=>'订购数量不能为空！'),
				array("input"=>$_POST['prov'],"require"=>"true", "message"=>'省不能为空！'),
				array("input"=>$_POST['city'],"require"=>"true", "message"=>'市不能为空！'),
				array("input"=>$_POST['region'],"require"=>"true", "message"=>'区不能为空！'),
				array("input"=>$_POST['address'],"require"=>"true", "message"=>'详细地址不能为空！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				showWapMessage($error,'','error');
				exit();
			}

			if(($_SESSION['push_phone_yzm'] != $_POST['yzm']) || ($_SESSION['push_phone'] != $_POST['mob_phone'])){
				showWapMessage('验证码不正确！','','error');
				exit();
			}

			$laiyuan = '第三套人民币'.($_GET['ua']?$_GET['ua']:'m');

			$laiyuan = urlencode($laiyuan);

			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mob_phone'].'&N='.urlencode($_POST['true_name']).'&AdFrom=20160901_2'.'&A_Num='.$_POST['goods_sum'].'&A_From='.$laiyuan.'&is_reg=0&contents='.urlencode($_POST['prov_name'].' '.$_POST['city_name'].' '.$_POST['region_name'].' '.$_POST['address']).'&tg_from='.urlencode($_SESSION['tg_from']));
			
			if($retuen_type == 1){
				$msg = "第三套人民币推广有新的留言，请马上查看并进行分配，分配后别忘了通知业务员。";
				$sms = new Sms();
				$sms->send('15726633668',$msg);
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160901_2\';</script>';
				exit();
			}else{
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160901_2\';</script>';
				exit();
			}

		}

		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::output('html_title','第三套人民币-收藏天下-只做正品收藏');
		Tpl::output('seo_keywords','第三套人民币 惊爆抢藏价 188一套 限时限量 先抢先赚');
		Tpl::output('seo_description','第三套人民币 收藏天下');
		Tpl::showpage('20160901_2/index_show');
	}

	/*
	 * @三军大会师
	 */
	public function ad_3junhuishi_1Op(){
		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
				array("input"=>$_POST['love'],"require"=>"true","message"=>"请选择意向的产品")
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '三军大会师专题ad_3junhuishi('.$M.')';
			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_3junhuishi'.'&A_Num=1'.'&contents='.urlencode($_POST['love']).'&A_From='.urlencode($register_info['member_from']).'&is_reg=0&tg_from='.urlencode($_SESSION['tg_from']));
			echo json_encode($result); 
			exit();
		}
		Tpl::output('no_footer',true);
		Tpl::output('no_header',true);
		Tpl::output('html_title','三军大会师国玺');
		Tpl::output('seo_keywords','三军大会师国玺');
		Tpl::output('seo_description','三军大会师国玺');
		Tpl::showpage('3junhuishi_1/index_show');
	}
	
	/*
	 * @三军大会师
	 */
	public function ad_3junhuishiOp(){
		showWapMessage('活动已结束','index.php','error');
exit;
		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
				array("input"=>$_POST['love'],"require"=>"true","message"=>"请选择意向的产品")
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '三军大会师专题ad_3junhuishi('.$M.')';
			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_3junhuishi'.'&A_Num=1'.'&contents='.urlencode($_POST['love']).'&A_From='.urlencode($register_info['member_from']).'&is_reg=0&tg_from='.urlencode($_SESSION['tg_from']));
			echo json_encode($result); 
			exit();
		}
		Tpl::output('no_footer',true);
		Tpl::output('html_title','三军大会师国玺');
		Tpl::output('seo_keywords','三军大会师国玺');
		Tpl::output('seo_description','三军大会师国玺');
		Tpl::showpage('3junhuishi/index_show');
	}
	
	public function ad_20160901_4Op(){

		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
			Tpl::output('this_laiyuan','m');
		}else{
			Tpl::output('this_laiyuan','weixin');
		}

		if(chksubmit(true)){

			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
				array("input"=>$_POST['yzm'],"require"=>"true", "message"=>'验证码不能为空！'),
				array("input"=>$_POST['goods_sum'],"require"=>"true", "message"=>'订购数量不能为空！'),
				array("input"=>$_POST['prov'],"require"=>"true", "message"=>'省不能为空！'),
				array("input"=>$_POST['city'],"require"=>"true", "message"=>'市不能为空！'),
				array("input"=>$_POST['region'],"require"=>"true", "message"=>'区不能为空！'),
				array("input"=>$_POST['address'],"require"=>"true", "message"=>'详细地址不能为空！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				showWapMessage($error,'','error');
				exit();
			}

			if(($_SESSION['push_phone_yzm'] != $_POST['yzm']) || ($_SESSION['push_phone'] != $_POST['mob_phone'])){
				showWapMessage('验证码不正确！','','error');
				exit();
			}

			$laiyuan = '第三套人民币'.($_GET['ua']?$_GET['ua']:'m');

			$laiyuan = urlencode($laiyuan);

			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mob_phone'].'&N='.urlencode($_POST['true_name']).'&AdFrom=ad_20160901_4'.'&A_Num='.$_POST['goods_sum'].'&A_From='.$laiyuan.'&is_reg=0&contents='.urlencode($_POST['prov_name'].' '.$_POST['city_name'].' '.$_POST['region_name'].' '.$_POST['address']).'&tg_from='.urlencode($_SESSION['tg_from']));
			
			if($retuen_type == 1){
				$msg = "第三套人民币推广有新的留言，请马上查看并进行分配，分配后别忘了通知业务员。";
				$sms = new Sms();
				$sms->send('15726633668',$msg);
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160901_4\';</script>';
				exit();
			}else{
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160901_4\';</script>';
				exit();
			}

		}

		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::output('html_title','第三套人民币-收藏天下-只做正品收藏');
		Tpl::output('seo_keywords','第三套人民币 惊爆抢藏价 188一套 限时限量 先抢先赚');
		Tpl::output('seo_description','第三套人民币 收藏天下');
		Tpl::showpage('20160901_4/index_show');
	}

	public function ad_20160901_6Op(){

		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
			Tpl::output('this_laiyuan','m');
		}else{
			Tpl::output('this_laiyuan','weixin');
		}

		if(chksubmit(true)){

			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
				array("input"=>$_POST['yzm'],"require"=>"true", "message"=>'验证码不能为空！'),
				array("input"=>$_POST['goods_sum'],"require"=>"true", "message"=>'订购数量不能为空！'),
				array("input"=>$_POST['prov'],"require"=>"true", "message"=>'省不能为空！'),
				array("input"=>$_POST['city'],"require"=>"true", "message"=>'市不能为空！'),
				array("input"=>$_POST['region'],"require"=>"true", "message"=>'区不能为空！'),
				array("input"=>$_POST['address'],"require"=>"true", "message"=>'详细地址不能为空！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				showWapMessage($error,'','error');
				exit();
			}

			if(($_SESSION['push_phone_yzm'] != $_POST['yzm']) || ($_SESSION['push_phone'] != $_POST['mob_phone'])){
				showWapMessage('验证码不正确！','','error');
				exit();
			}

			$laiyuan = '第三套人民币'.($_GET['ua']?$_GET['ua']:'m');

			$laiyuan = urlencode($laiyuan);

			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mob_phone'].'&N='.urlencode($_POST['true_name']).'&AdFrom=ad_20160901_6'.'&A_Num='.$_POST['goods_sum'].'&A_From='.$laiyuan.'&is_reg=0&contents='.urlencode($_POST['prov_name'].' '.$_POST['city_name'].' '.$_POST['region_name'].' '.$_POST['address']).'&tg_from='.urlencode($_SESSION['tg_from']));
			
			if($retuen_type == 1){
				$msg = "第三套人民币推广有新的留言，请马上查看并进行分配，分配后别忘了通知业务员。";
				$sms = new Sms();
				$sms->send('15726633668',$msg);
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160901_3\';</script>';
				exit();
			}else{
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160901_3\';</script>';
				exit();
			}

		}

		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::output('html_title','第三套人民币-收藏天下-只做正品收藏');
		Tpl::output('seo_keywords','第三套人民币 惊爆抢藏价 188一套 限时限量 先抢先赚');
		Tpl::output('seo_description','第三套人民币 收藏天下');
		Tpl::showpage('20160901_6/index_show');
	}


	public function ad_20160901_5Op(){

		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
			Tpl::output('this_laiyuan','m');
		}else{
			Tpl::output('this_laiyuan','weixin');
		}

		if(chksubmit(true)){

			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
				array("input"=>$_POST['yzm'],"require"=>"true", "message"=>'验证码不能为空！'),
				array("input"=>$_POST['goods_sum'],"require"=>"true", "message"=>'订购数量不能为空！'),
				array("input"=>$_POST['prov'],"require"=>"true", "message"=>'省不能为空！'),
				array("input"=>$_POST['city'],"require"=>"true", "message"=>'市不能为空！'),
				array("input"=>$_POST['region'],"require"=>"true", "message"=>'区不能为空！'),
				array("input"=>$_POST['address'],"require"=>"true", "message"=>'详细地址不能为空！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				showWapMessage($error,'','error');
				exit();
			}

			if(($_SESSION['push_phone_yzm'] != $_POST['yzm']) || ($_SESSION['push_phone'] != $_POST['mob_phone'])){
				showWapMessage('验证码不正确！','','error');
				exit();
			}

			$laiyuan = '第三套人民币'.($_GET['ua']?$_GET['ua']:'m');

			$laiyuan = urlencode($laiyuan);

			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mob_phone'].'&N='.urlencode($_POST['true_name']).'&AdFrom=ad_20160901_5'.'&A_Num='.$_POST['goods_sum'].'&A_From='.$laiyuan.'&is_reg=0&contents='.urlencode($_POST['prov_name'].' '.$_POST['city_name'].' '.$_POST['region_name'].' '.$_POST['address']).'&tg_from='.urlencode($_SESSION['tg_from']));
			
			if($retuen_type == 1){
				$msg = "第三套人民币推广有新的留言，请马上查看并进行分配，分配后别忘了通知业务员。";
				$sms = new Sms();
				$sms->send('15726633668',$msg);
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160901_3\';</script>';
				exit();
			}else{
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160901_3\';</script>';
				exit();
			}

		}

		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::output('html_title','第三套人民币-收藏天下-只做正品收藏');
		Tpl::output('seo_keywords','第三套人民币 惊爆抢藏价 188一套 限时限量 先抢先赚');
		Tpl::output('seo_description','第三套人民币 收藏天下');
		Tpl::showpage('20160901_5/index_show');
	}



	public function ad_20160901_3Op(){

		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
			Tpl::output('this_laiyuan','m');
		}else{
			Tpl::output('this_laiyuan','weixin');
		}

		if(chksubmit(true)){

			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
				array("input"=>$_POST['yzm'],"require"=>"true", "message"=>'验证码不能为空！'),
				array("input"=>$_POST['goods_sum'],"require"=>"true", "message"=>'订购数量不能为空！'),
				array("input"=>$_POST['prov'],"require"=>"true", "message"=>'省不能为空！'),
				array("input"=>$_POST['city'],"require"=>"true", "message"=>'市不能为空！'),
				array("input"=>$_POST['region'],"require"=>"true", "message"=>'区不能为空！'),
				array("input"=>$_POST['address'],"require"=>"true", "message"=>'详细地址不能为空！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				showWapMessage($error,'','error');
				exit();
			}

			if(($_SESSION['push_phone_yzm'] != $_POST['yzm']) || ($_SESSION['push_phone'] != $_POST['mob_phone'])){
				showWapMessage('验证码不正确！','','error');
				exit();
			}

			$laiyuan = '第三套人民币'.($_GET['ua']?$_GET['ua']:'m');

			$laiyuan = urlencode($laiyuan);

			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mob_phone'].'&N='.urlencode($_POST['true_name']).'&AdFrom=ad_20160901_3'.'&A_Num='.$_POST['goods_sum'].'&A_From='.$laiyuan.'&is_reg=0&contents='.urlencode($_POST['prov_name'].' '.$_POST['city_name'].' '.$_POST['region_name'].' '.$_POST['address']).'&tg_from='.urlencode($_SESSION['tg_from']));
			
			if($retuen_type == 1){
				$msg = "第三套人民币推广有新的留言，请马上查看并进行分配，分配后别忘了通知业务员。";
				$sms = new Sms();
				$sms->send('15726633668',$msg);
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160901_3\';</script>';
				exit();
			}else{
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160901_3\';</script>';
				exit();
			}

		}

		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::output('html_title','第三套人民币-收藏天下-只做正品收藏');
		Tpl::output('seo_keywords','第三套人民币 惊爆抢藏价 188一套 限时限量 先抢先赚');
		Tpl::output('seo_description','第三套人民币 收藏天下');
		Tpl::showpage('20160901_3/index_show');
	}

	
	public function ad_20160901_1Op(){

		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
			Tpl::output('this_laiyuan','m');
		}else{
			Tpl::output('this_laiyuan','weixin');
		}

		if(chksubmit(true)){

			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
				array("input"=>$_POST['yzm'],"require"=>"true", "message"=>'验证码不能为空！'),
				array("input"=>$_POST['goods_sum'],"require"=>"true", "message"=>'订购数量不能为空！'),
				array("input"=>$_POST['prov'],"require"=>"true", "message"=>'省不能为空！'),
				array("input"=>$_POST['city'],"require"=>"true", "message"=>'市不能为空！'),
				array("input"=>$_POST['region'],"require"=>"true", "message"=>'区不能为空！'),
				array("input"=>$_POST['address'],"require"=>"true", "message"=>'详细地址不能为空！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				showWapMessage($error,'','error');
				exit();
			}

			if(($_SESSION['push_phone_yzm'] != $_POST['yzm']) || ($_SESSION['push_phone'] != $_POST['mob_phone'])){
				showWapMessage('验证码不正确！','','error');
				exit();
			}

			$laiyuan = '第三套人民币'.($_GET['ua']?$_GET['ua']:'m');

			$laiyuan = urlencode($laiyuan);

			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mob_phone'].'&N='.urlencode($_POST['true_name']).'&AdFrom=ad_20160901_1'.'&A_Num='.$_POST['goods_sum'].'&A_From='.$laiyuan.'&is_reg=0&contents='.urlencode($_POST['prov_name'].' '.$_POST['city_name'].' '.$_POST['region_name'].' '.$_POST['address']).'&tg_from='.urlencode($_SESSION['tg_from']));
			
			if($retuen_type == 1){
				$msg = "第三套人民币推广有新的留言，请马上查看并进行分配，分配后别忘了通知业务员。";
				$sms = new Sms();
				$sms->send('15726633668',$msg);
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160901\';</script>';
				exit();
			}else{
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160901\';</script>';
				exit();
			}

		}

		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::output('html_title','第三套人民币-收藏天下-只做正品收藏');
		Tpl::output('seo_keywords','第三套人民币 惊爆抢藏价 188一套 限时限量 先抢先赚');
		Tpl::output('seo_description','第三套人民币 收藏天下');
		Tpl::showpage('20160901_1/index_show');
	}

	public function ad_20160901Op(){

		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
			Tpl::output('this_laiyuan','m');
		}else{
			Tpl::output('this_laiyuan','weixin');
		}

		if(chksubmit(true)){

			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
				array("input"=>$_POST['yzm'],"require"=>"true", "message"=>'验证码不能为空！'),
				array("input"=>$_POST['goods_sum'],"require"=>"true", "message"=>'订购数量不能为空！'),
				array("input"=>$_POST['prov'],"require"=>"true", "message"=>'省不能为空！'),
				array("input"=>$_POST['city'],"require"=>"true", "message"=>'市不能为空！'),
				array("input"=>$_POST['region'],"require"=>"true", "message"=>'区不能为空！'),
				array("input"=>$_POST['address'],"require"=>"true", "message"=>'详细地址不能为空！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				showWapMessage($error,'','error');
				exit();
			}

			if(($_SESSION['push_phone_yzm'] != $_POST['yzm']) || ($_SESSION['push_phone'] != $_POST['mob_phone'])){
				showWapMessage('验证码不正确！','','error');
				exit();
			}

			$laiyuan = '第三套人民币'.($_GET['ua']?$_GET['ua']:'m');

			$laiyuan = urlencode($laiyuan);

			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mob_phone'].'&N='.urlencode($_POST['true_name']).'&AdFrom=ad_20160901'.'&A_Num='.$_POST['goods_sum'].'&A_From='.$laiyuan.'&is_reg=0&contents='.urlencode($_POST['prov_name'].' '.$_POST['city_name'].' '.$_POST['region_name'].' '.$_POST['address']).'&tg_from='.urlencode($_SESSION['tg_from']));
			
			if($retuen_type == 1){
				$msg = "第三套人民币推广有新的留言，请马上查看并进行分配，分配后别忘了通知业务员。";
				$sms = new Sms();
				$sms->send('15726633668',$msg);
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160901\';</script>';
				exit();
			}else{
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160901\';</script>';
				exit();
			}

		}

		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::output('html_title','第三套人民币-收藏天下-只做正品收藏');
		Tpl::output('seo_keywords','第三套人民币 惊爆抢藏价 188一套 限时限量 先抢先赚');
		Tpl::output('seo_description','第三套人民币 收藏天下');
		Tpl::showpage('20160901/index_show');
	}

	/**
	 * 新十国钞领取页面
	 */
	public function ad_20160827Op(){
		switch($_GET['action']){
			case 'lingqu':
				$goodsid_array = array('28614'=>'0');
				$where_member_from['member_id'] = intval($_SESSION['member_id']);
				$where_member_from['member_from'] = array('like','%免费领取中国纸币%');
				$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
				if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
				$goods_amount = '0'; //商品总额
				$shipping_fee = '9.9'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"免费领取中国纸币",'免费领取中国纸币(M)');
			break;
			case 'regs':
				//注册
				$model_member	= Model('member');
				$code = $_POST['code'];
				if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
					$result['state'] = false;
					$result['msg'] = "验证码错误";
					echo json_encode($result); 
					exit();
				}
				$register_info = array();
				$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
				$register_info['username'] = $_POST['user_name'];
				$register_info['password'] = $_POST['mobile'];
				$register_info['password_confirm'] = $_POST['mobile'];
				$register_info['mobile'] = $_POST['mobile'];
				$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
				$register_info['member_from'] = '免费领取中国纸币('.$M.')';
				$member_info = $model_member->register($register_info);
				if(!isset($member_info['error'])) {
					$model_member->createSession($member_info,true);
					$msg = "恭喜您注册成功，客服将第一时间与您取得联系。会员号：".$_POST['user_name']."密码：".$_POST['mobile']."登录官网·领取代金券让收藏走进大众·只做正品收藏";
					$sms = new Sms();
					$sms->send($_POST['mobile'],$msg);
					exit(json_encode(array('state'=>true,'msg'=>"OK",'username'=>$_POST['user_name'],'password'=>$_POST['mobile'])));
				}else{
					exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
				}
			break;
			default:
					Tpl::output('no_header',true);
					Tpl::output('no_footer',true);
			//		Tpl::output('html_title','第三套人民币-收藏天下-只做正品收藏');
			//		Tpl::output('seo_keywords','第三套人民币 惊爆抢藏价 188一套 限时限量 先抢先赚');
			//		Tpl::output('seo_description','第三套人民币 收藏天下');
					Tpl::showpage('20160827/index_show');
			break;
		}

	}

	public function ad_20160820_2Op(){
		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::output('html_title','第三套人民币-收藏天下-只做正品收藏');
		Tpl::output('seo_keywords','第三套人民币 惊爆抢藏价 188一套 限时限量 先抢先赚');
		Tpl::output('seo_description','第三套人民币 收藏天下');
		Tpl::showpage('20160820/index_show');
	}


	/**
	 * 第三套人民币
	 */
	public function ad_20160820_1Op(){
		
		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
			Tpl::output('this_laiyuan','m');
		}else{
			Tpl::output('this_laiyuan','weixin');
		}


		if(chksubmit(true)){

			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
				array("input"=>$_POST['yzm'],"require"=>"true", "message"=>'验证码不能为空！'),
				array("input"=>$_POST['goods_sum'],"require"=>"true", "message"=>'订购数量不能为空！'),
				array("input"=>$_POST['prov'],"require"=>"true", "message"=>'省不能为空！'),
				array("input"=>$_POST['city'],"require"=>"true", "message"=>'市不能为空！'),
				array("input"=>$_POST['region'],"require"=>"true", "message"=>'区不能为空！'),
				array("input"=>$_POST['address'],"require"=>"true", "message"=>'详细地址不能为空！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				showWapMessage($error,'','error');
				exit();
			}

			if(($_SESSION['push_phone_yzm'] != $_POST['yzm']) || ($_SESSION['push_phone'] != $_POST['mob_phone'])){
				showWapMessage('验证码不正确！','','error');
				exit();
			}

			$laiyuan = '第三套人民币'.($_GET['ua']?$_GET['ua']:'m');

			$laiyuan = urlencode($laiyuan);

			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mob_phone'].'&N='.urlencode($_POST['true_name']).'&AdFrom=ad_20160820'.'&A_Num='.$_POST['goods_sum'].'&A_From='.$laiyuan.'&is_reg=0&contents='.urlencode($_POST['prov_name'].' '.$_POST['city_name'].' '.$_POST['region_name'].' '.$_POST['address']));
			
			if($retuen_type == 1){
				$msg = "第三套人民币推广有新的留言，请马上查看并进行分配，分配后别忘了通知业务员。";
				$sms = new Sms();
				$sms->send('15726633668',$msg);
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160820_1\';</script>';
				exit();
			}else{
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160820_1\';</script>';
				exit();
			}

		}

		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::output('html_title','第三套人民币-收藏天下-只做正品收藏');
		Tpl::output('seo_keywords','第三套人民币 惊爆抢藏价 188一套 限时限量 先抢先赚');
		Tpl::output('seo_description','第三套人民币 收藏天下');
		Tpl::showpage('20160820_1/index_show');
	}


	public function ad_20160820Op(){

		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
			Tpl::output('this_laiyuan','m');
		}else{
			Tpl::output('this_laiyuan','weixin');
		}


		if(chksubmit(true)){

			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
				array("input"=>$_POST['yzm'],"require"=>"true", "message"=>'验证码不能为空！'),
				array("input"=>$_POST['goods_sum'],"require"=>"true", "message"=>'订购数量不能为空！'),
				array("input"=>$_POST['prov'],"require"=>"true", "message"=>'省不能为空！'),
				array("input"=>$_POST['city'],"require"=>"true", "message"=>'市不能为空！'),
				array("input"=>$_POST['region'],"require"=>"true", "message"=>'区不能为空！'),
				array("input"=>$_POST['address'],"require"=>"true", "message"=>'详细地址不能为空！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				showWapMessage($error,'','error');
				exit();
			}

			if(($_SESSION['push_phone_yzm'] != $_POST['yzm']) || ($_SESSION['push_phone'] != $_POST['mob_phone'])){
				showWapMessage('验证码不正确！','','error');
				exit();
			}

			$laiyuan = '第三套人民币'.($_GET['ua']?$_GET['ua']:'m');

			$laiyuan = urlencode($laiyuan);

			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mob_phone'].'&N='.urlencode($_POST['true_name']).'&AdFrom=ad_20160820'.'&A_Num='.$_POST['goods_sum'].'&A_From='.$laiyuan.'&is_reg=0&contents='.urlencode($_POST['prov_name'].' '.$_POST['city_name'].' '.$_POST['region_name'].' '.$_POST['address']));
			
			if($retuen_type == 1){
				$msg = "第三套人民币推广有新的留言，请马上查看并进行分配，分配后别忘了通知业务员。";
				$sms = new Sms();
				$sms->send('15726633668',$msg);
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160820\';</script>';
				exit();
			}else{
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://m.96567.com/index.php?act=zhuanti&op=ad_20160820\';</script>';
				exit();
			}

		}

		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::output('html_title','第三套人民币-收藏天下-只做正品收藏');
		Tpl::output('seo_keywords','第三套人民币 惊爆抢藏价 188一套 限时限量 先抢先赚');
		Tpl::output('seo_description','第三套人民币 收藏天下');
		Tpl::showpage('20160820/index_show');
	}





	/* 第三套人民币 End */





	/**
	 * 奥运竞猜领奖页面
	 */
	public function ad_20160819Op(){
		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
			exit("请在微信端打开");
		}
		//正确答案数据
		$DaAn = array('1'=>'A','2'=>'B','3'=>'B','4'=>'D','5'=>'A','6'=>'D','7'=>'D');
		switch($_GET['action']){
			case 'address':
				Tpl::showpage('20160810/address','null_layout');
			break;
			case 'lingqu':
				if($_SESSION['member_id'] <= 0){
					exit(json_encode(array('state'=>false,'msg'=>"请登录或注册后操作")));
				}
				//检查当前用户是否资格领奖
				if(!$this->GetAoYunJiang($DaAn,'1')){
					exit(json_encode(array('state'=>false,'msg'=>"对不起，您无权领取")));
				}
				
				$goodsid_array = array('963'=>'0');
				$OGWhere['goods_id'] = '963';
				$OGWhere['buyer_id'] = $_SESSION['member_id'];
				$OGWhere['lai_yuan'] = array('like','%奥运竞猜领奖%');
				//检查用户是否已经领取过奖品
				$GouMaiNum = $this->table('order_goods')->where($OGWhere)->count(); //检查用户是否已购买该商品
				if($GouMaiNum > 0){
					exit(json_encode(array('state'=>false,'msg'=>"您已经领取不能重复领取")));
				}

				$goods_amount = '0'; //商品总额
				$shipping_fee = '20'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"奥运竞猜领奖",'奥运竞猜领奖(M)');
			break;
			case 'yanzhengone':
				$model_member	= Model('member');
				$register_info = array();
				$register_info['username'] = $_POST['user_name'];
				$register_info['password'] = $_POST['password'];
				$register_info['password_confirm'] = $_POST['password1'];
				$register_info['mobile'] = $_POST['mobile'];
				$code = $_POST['code'];
				if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
					$result['error'] = "验证码错误";
					echo json_encode($result); 
					exit();
				}
				$register_info['member_mobile_bind'] = 1;
				$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
				$register_info['member_from'] = '奥运竞猜领奖('.$M.')';
				$member_info = $model_member->register($register_info);
				if(!isset($member_info['error'])) {
					$result['msg'] = '注册成功';
					$model_member->createSession($member_info,true);
					echo json_encode($result); 
					exit();
				}else{
					$result['error'] = $member_info['error'];
					echo json_encode($result); 
					exit();
				}
			break;
			default:
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::output('html_title','收藏天下  只做正品收藏  奥运竞猜');
				Tpl::output('seo_keywords','奥运竞猜 收藏天下');
				Tpl::output('seo_description','奥运竞猜 收藏天下');
				
				Tpl::output('JangName',$this->GetAoYunJiang($DaAn));
				Tpl::showpage('20160819/index_show');
			break;
		}
		
	}

	/**
	 * 获取奥运竞猜中奖用户 杜
	 */
	public function GetAoYunJiang($DaAn,$where=''){
		//查询计算7到题都答对的人员
		$Jiang = array();
		if($where){
			$where_and['W_Openid'] = $_SESSION['openid'];
		}
		$where_and['ad_name'] = '20160729';
		foreach($DaAn as $k=>$v){
			$where_and['DaAn_num'] = $v;
			$where_and['l_id'] = $k;
			$ZhongJiangList = $this->ZtModel->getLotteryList($where_and);
			if($ZhongJiangList){
				foreach($ZhongJiangList as $dk=>$dv){
					$Jiang[$dv['openid']] += 1;
				}
			}
		}
		$JangName = array();
		//排除为答对7道题的用户
		foreach($Jiang as $jk=>$jv){
			if($jv != 7){
				unset($Jiang[$jk]);
			}
		}
		//获取答对题的微信用户信息
		if($Jiang){
			foreach($Jiang as $kk=>$vv){
				$member_weixin_info_is = Model('weixin_info')->getOneMemberWeixinInfo($kk);
				$JangName[] = $member_weixin_info_is;
			}
		}
		return $JangName;
		
	}

	/**
	 * 十国钞活动
	 */
	public function ad_20160810_1Op(){
		showWapMessage('活动已结束','index.php','error');
exit;
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::output('html_title','收藏天下  只做正品收藏');
				Tpl::output('seo_keywords','十国钞活动 限时免费1人/套 每天送出500套 收藏天下');
				Tpl::output('seo_description','十国钞活动 收藏天下');
				Tpl::showpage('20160810/index_show');
	}
	
	

	/**
	 * 十国钞活动 杜
	 */
	public function ad_20160810Op(){
		showWapMessage('活动已结束','index.php','error');
exit;
		switch($_GET['action']){
			case 'address':
				Tpl::showpage('20160810/address','null_layout');
			break;
			case 'lingqu':
				$goodsid_array = array('15898'=>'0');
				$where_member_from['member_id'] = intval($_SESSION['member_id']);
				$where_member_from['member_from'] = array('like','%免费领取世界财富钞%');
				$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
				if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
				$goods_amount = '0'; //商品总额
				$shipping_fee = '6'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"免费领取世界财富钞",'免费领取世界财富钞(M)');
			break;
			case 'regs':
				//注册
				$model_member	= Model('member');
				$code = $_POST['code'];
				if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
					$result['state'] = false;
					$result['msg'] = "验证码错误";
					echo json_encode($result); 
					exit();
				}
				$register_info = array();
				$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
				$register_info['username'] = $_POST['name'];
				$register_info['password'] = $_POST['mobile'];
				$register_info['password_confirm'] = $_POST['mobile'];
				$register_info['mobile'] = $_POST['mobile'];
				$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
				$register_info['member_from'] = '免费领取世界财富钞('.$M.')';
				$member_info = $model_member->register($register_info);
				if(!isset($member_info['error'])) {
					$model_member->createSession($member_info,true);
					$msg = "恭喜您注册成功，客服将第一时间与您取得联系。会员号：".$_POST['name']."密码：".$_POST['mobile']."登录官网·领取代金券让收藏走进大众·只做正品收藏";
					$sms = new Sms();
					$sms->send($_POST['mobile'],$msg);
					exit(json_encode(array('state'=>true,'msg'=>"OK",'username'=>$_POST['name'],'password'=>$_POST['mobile'])));
				}else{
					exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
				}
			break;
			default:
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				//Tpl::output('ZhuanTiAdName',true);
				Tpl::output('html_title','收藏天下  只做正品收藏');
				Tpl::output('seo_keywords','十国钞活动 限时免费1人/套 每天送出500套 收藏天下');
				Tpl::output('seo_description','十国钞活动 收藏天下');
				Tpl::showpage('20160810/index_show');
			break;
		}
		
	}

	/**
	 * 里约奥运专题抽奖活动 杜
	 */
	public function ad_20160801Op(){
		
		if($_GET['action'] == 'lingqu'){//领取实物奖励
			$goods_id = $_POST['goods_id'];
			$lid = $_POST['lid'];
			//检查奖品是否领取和符合被领取要求
			$count_Lot = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160801','member_id'=>$_SESSION['member_id'],'goods_id'=>$goods_id,'id'=>$lid,'is_fafang'=>0));
			if($count_Lot <= 0){
				$result['msg'] = '领取失败，请联系专属客服';
				echo json_encode($result);
				exit();
			}
			$goodsid_array = array($goods_id=>0);
//			$where_member_from['member_id'] = intval($_SESSION['member_id']);
//			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
//			if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
			$goods_amount = '0'; //商品总额
			$shipping_fee = '0'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'里约奥运抽奖活动m','里约奥运抽奖活动m',true,array($lid));

		}elseif($_GET['action'] == 'Cj'){//进行抽奖
			//检查是否登陆
			$member_id = $_SESSION['member_id'];
			if($member_id <= 0){
				echo '-1';
				exit;
			}
			$order_sn = $_POST['order_sn'];
			//检查订单号是否为空
			if($order_sn == ''){
				$result['error'] =  '订单号不能为空';
				echo json_encode($result); 
				exit();
			}
			$maxorderamount = 0;//设置最低抽奖金额
			//检查订单号是否符合要求
			$order = $this->ZtModel->getOrder(array('buyer_id'=>$member_id,'order_state'=>array('egt',20),'add_time'=>array('elt','1471708800'),'add_time'=>array('egt','1469980800'),'order_amount'=>array('egt',$maxorderamount),'order_sn'=>$order_sn),'order_id,order_amount,order_sn');
			
			if(count($order) > 0){
				$order_info = $order[0];
				//检查订单是否已经抽过将
				$count_Lot = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160801','member_id'=>$member_id,'l_orderid'=>$order_info['order_id']));
				if($count_Lot > 0){
					$result['error'] =  '对不起，一个订单号只能进行一次抽奖';
					echo json_encode($result); 
					exit();
				}else{
					/**根据订单金额概率计算中奖项**/
					$prize_arr = array();
					$prize_arr = $this->getJiangXiang($order_info); //获取中奖奖品
				
					foreach ($prize_arr as $key => $val) { 
						$arr[$val['id']] = $val['rand']; 
					}
					$rid = $this->getRand($arr); //根据概率获取奖项id 
					$res = $prize_arr[$rid-1]; //重新获取中奖项
					$is_fafang = 1;
					$data = array();
					if($res['type'] == 2){
						//获得实物奖品
						$is_fafang = 0;
						$data['goods_id'] = $res['v'];
					}elseif($res['type'] == 1){
						//获得代金卷 发放代金卷
						$this->ZtModel->exchangeVoucher($res['v'],intval($_SESSION['member_id']));
						
					}
					$data['member_id'] = $member_id;
					$data['year'] = date('Y',time());
					$data['month'] = date('m',time());
					$data['day'] = date('d',time());
					$data['hour'] = date('H',time());
					$data['time'] = date('H:i:s',time());
					$data['add_time'] = time();
					$data['ip'] = $_SERVER['REMOTE_ADDR'];
					$data['ad_name'] = '20160801';
					$data['l_name'] = $res['prize'];
					$data['l_id'] = $rid;
					$data['l_orderid'] = $order_info['order_id'];
					$data['is_fafang'] = $is_fafang;
					$this->ZtModel->addLottery($data);
					exit(json_encode(array('state'=>true,'msg'=>$res['prize'],'r_id'=>$rid-1,'angles'=>$res['angles'])));
				}
		
			}else{
				$result['error'] =  '对不起，您的订单号不符合活动要求';
				echo json_encode($result); 
				exit();
			}

		}else{
			//获得所有会员中奖记录
			$MemberLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160801','l_id'=>array('not in',array(4,9))),'*,(SELECT member_name FROM shop_member WHERE `shop_member`.member_id = `shop_lottery_member`.member_id) as member_name','','add_time desc');
			Tpl::output('MemberLotteryList',$MemberLotteryList);
			$My_MemberLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160801','member_id'=>$_SESSION['member_id'],'l_id'=>array('not in',array(4,9))),'*,(SELECT member_name FROM shop_member WHERE `shop_member`.member_id = `shop_lottery_member`.member_id) as member_name','','add_time desc');
			Tpl::output('My_MemberLotteryList',$My_MemberLotteryList);
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('ZhuanTiAdName',true);
			Tpl::output('html_title','里约奥运惠 - 收藏天下');
			Tpl::output('seo_keywords','奥运惠,送银条,抽奖,竞猜,奥运纪念币,里约奥运藏品');
			Tpl::output('seo_description','收藏天下为中国奥运加油！全场满888元加送银条，订单还可拿来抽奖，最高奖励香港奥运纪念钞一套！');
			Tpl::showpage('20160801/index_show');
		}
	}

	/**
	 * 七夕专题 Add is name lt
	 */
	public function ad_20160802Op(){
		
		showWapMessage('活动结束','index.php','error');
		exit();
		$model_goods = Model('goods');


		// 单个产品

		$goods_id_list = '23786,24270,23728,20801,24194,21089,23850,21520,22979,23846,19754,17849,23873,23849';

		$condition_goods['goods_id'] = array('in',$goods_id_list);

		$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1  LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 LIMIT 1) as tuangou_money';

		$order = "field(goods_id,$goods_id_list)";

		$goods_list = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

		// 店铺
		$store = array();
		$store['13']['store_id'] = '13';
		$store['13']['goods_id'] = '24257,20278,20325,21072,23796,21083';  	//一木

		$store['455']['store_id'] = '455';
		$store['455']['goods_id'] = '22407,22395,22439,22437,22421,22442';	//千玉千祥珠宝旗舰店

		$store['68']['store_id'] = '68';
		$store['68']['goods_id'] = '20925,20917,20916,20934,20936,20938';		//木乙文玩

		$store['90']['store_id'] = '90';
		$store['90']['goods_id'] = '22338,23505,23342,22902,22714,22557';		//只有一个

		$store['897']['store_id'] = '897';
		$store['897']['goods_id'] = '22485,22559,22983,23363,22969,22635';		//轩烨翡翠

		$store['253']['store_id'] = '253';
		$store['253']['goods_id'] = '21950,21944,21242,20943,20942,20941';		//漪风阁

		$store['140']['store_id'] = '140';
		$store['140']['goods_id'] = '16111,16107,16106,16102,16103,16101';		//燕云堂紫砂艺术馆

		$store['305']['store_id'] = '305';
		$store['305']['goods_id'] = '17851,17837,17838,17853,17855,17850';		//渠玉轩

		$store['883']['store_id'] = '883';
		$store['883']['goods_id'] = '23365,23640,23459,23454,23449,23372';		//泰和荣珠宝

		$store['813']['store_id'] = '813';
		$store['813']['goods_id'] = '23769,23767,23784,23776,23774,23252';		//静德堂

		$store['522']['store_id'] = '522';
		$store['522']['goods_id'] = '22709,22705,22662,22651,19685,19781';		//新海珠宝


		$model_store = Model('store');

		$store_goods_list = array();

		foreach ($store as $k => $v) {

			$condition_store_goods = array();

			$condition_store_goods['goods_id'] = array('in',$v['goods_id']);
			$field_store_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1  LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 LIMIT 1) as tuangou_money';
			// $order = "field(goods_id,$goods_id_list)";
			$store_goods_list[$v['store_id']]['store_info'] = $model_store->getStoreInfoByID($v['store_id']);
			$store_goods_list[$v['store_id']]['goods_info'] = $model_goods->getGoodsList($condition_store_goods,$field_store_goods);
		}


		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);

		Tpl::output('html_title','七夕特惠活动 贴心爱礼低至17元 - 收藏天下');
		Tpl::output('seo_keywords','七夕活动,佛珠手串,情人节活动,七夕特惠,珠宝首饰,翡翠玉石,小叶紫檀,黄花梨,金刚菩提手串,紫砂壶,秒杀,限时折扣,满减特惠,收藏天下');
		Tpl::output('seo_description','收藏天下七夕特惠活动，佛珠手串、珠宝首饰等贴心爱礼低至17元，全场包邮，品质尖货满立减！温情七夕，选七夕礼物，来收藏天下！');


		Tpl::output('goods_list',$goods_list);
		Tpl::output('store_goods_list',$store_goods_list);
		Tpl::showpage('20160802/index_show');
	}



	/**
	 * 里约奥运答题活动
	 */
	public function ad_20160729Op(){
		showWapMessage('活动结束','index.php?act=zhuanti&op=ad_20160719','error');
		exit();
		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
			exit("请在微信端打开");
		}
		$openid_this = $_SESSION['openid'];
		switch($_GET['action']){
			case 'fenxiang': //记录分享数
				@file_put_contents(dirname(__FILE__).'/../templates/default/zhuanti/20160729/fx.txt',$openid_this.'	1\----',FILE_APPEND);
			break;
			case 'user_info':
				$member_weixin_info_is = Model('weixin_info')->getOneMemberWeixinInfo($openid_this);
				if(empty($member_weixin_info_is)){
					$this->getAuthorityUserInfo('ad_20160729',$openid_this); // 接收微信用户信息
				}else{
					header("location:".urlWap('zhuanti','ad_20160729')."");
				}
			break;
			case 'ending'://答题完成最后一步
				if($_SESSION['DaTiDaAn']){
					$count = $this->ZtModel->getLotteryList("ad_name = '20160729' group by openid");
					Tpl::output('count',157800+count($count)); //获取当前答题人数
					Tpl::output('no_header',true);
					Tpl::output('no_footer',true);
					Tpl::output('ZhuanTiAdName',true);
					Tpl::showpage('20160729/ending');
					unset($_SESSION['DaTiDaAn']);
				}else{
					header("location:".urlWap('zhuanti','ad_20160729')."");
				}
			break;
			case 'on'://进行答题
				//检查当前用户是否已经参与过答题
				$DaTiCount = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160729','openid'=>$_SESSION['openid']));
				
				$num = intval($_POST['num']);
				$QTI = array(
						'1'=> 'Q1：里约奥运会官方免费发放了45万个避孕套，究竟哪个国家的代表团用的最多？',
						'2'=> 'Q2：日本体操男团2015年世锦赛夺冠，作为伦敦奥运冠军的中国队能否坚挺降日？',
						'3'=>'Q3：林丹是唯一蝉联奥运男单冠军的羽毛球巨星，此次谁将狙杀“超级丹”三连冠？',
						'4'=>'Q4：宁泽涛作为中国队颜值担当、刷爆朋友圈的小鲜肉、国民老公 ，能否踏平纪录为国摘金？',
						'5'=>'Q5：“铁榔头”（我为补钙带盐）再度执掌中国女排教鞭，能否带领中国女排再创辉煌？',
						'6'=>'Q6：苏炳添作为首位百米跑进10秒“亚洲飞人”，里约能否擦肩博尔特问鼎奥运之巅？',
						'7'=>'Q7：阿联能否在自己的最后一届奥运会上，率队中国男篮不负众望再度杀入八强？'
					);
				if($num == 8){//答题完成
					if($_SESSION['DaTiDaAn']){
						if($DaTiCount > 0){ //如果已答题则删除以最后一次为准
							Model()->table('lottery_member')->where(array('ad_name'=>'20160729','openid'=>$_SESSION['openid']))->delete();
						}
						foreach($_SESSION['DaTiDaAn'] as $k=>$v){
							$data = array();
							//写入答题信息
							$data['member_id'] = $_SESSION['member_id'];
							$data['year'] = date('Y',time());
							$data['month'] = date('m',time());
							$data['day'] = date('d',time());
							$data['hour'] = date('H',time());
							$data['time'] = date('H:i:s',time());
							$data['add_time'] = time();
							$data['ip'] = $_SERVER['REMOTE_ADDR'];
							$data['ad_name'] = '20160729';
							$data['l_name'] = $QTI[$k];
							$data['l_id'] = $k;
							$data['is_fafang'] = 0;
							$data['openid'] = $_SESSION['openid'];
							$data['DaAn_num'] = $v;
							$lid = $this->ZtModel->addLottery($data);
						}
					
						
					}
					echo '-1';
					exit;
				}
				//如果当前用户答当前的题则获取答案
				$DAANDate = $this->ZtModel->getLotteryList(array('ad_name'=>'20160729','openid'=>$_SESSION['openid'],'l_id'=>$num));

				Tpl::output('DAANDate',$DAANDate[0]);
				Tpl::showpage('20160729/on'.$num,'null_layout');
			break;
			case 'getDaTi'://答题
				$QTI = array(
						'1'=> 'Q1：里约奥运会官方免费发放了45万个避孕套，究竟哪个国家的代表团用的最多？',
						'2'=> 'Q2：日本体操男团2015年世锦赛夺冠，作为伦敦奥运冠军的中国队能否坚挺降日？',
						'3'=>'Q3：林丹是唯一蝉联奥运男单冠军的羽毛球巨星，此次谁将狙杀“超级丹”三连冠？',
						'4'=>'Q4：宁泽涛作为中国队颜值担当、刷爆朋友圈的小鲜肉、国民老公 ，能否踏平纪录为国摘金？',
						'5'=>'Q5：“铁榔头”（我为补钙带盐）再度执掌中国女排教鞭，能否带领中国女排再创辉煌？',
						'6'=>'Q6：苏炳添作为首位百米跑进10秒“亚洲飞人”，里约能否擦肩博尔特问鼎奥运之巅？',
						'7'=>'Q7：阿联能否在自己的最后一届奥运会上，率队中国男篮不负众望再度杀入八强？'
					);
				$daan = $_POST['daan'];
				$NumberQuestions = $_POST['NumberQuestions'];
				$_SESSION['DaTiDaAn'][$NumberQuestions] = $daan;
				//计算当前答题的百分比
				$datilist = $this->ZtModel->getLotteryList("ad_name = '20160729' AND l_id = ".$NumberQuestions.' group by DaAn_num','count(0) as num,DaAn_num','','DaAn_num asc');
				$TiArray = array('A'=>0,'B'=>0,'C'=>0,'D'=>0);
				$ZongNum = 0;
				if($datilist){
					foreach($datilist as $dk=>$dv){
						$TiArray[$dv['DaAn_num']] = $dv['num'];
						$ZongNum += $dv['num'];
					}
				}
				$DaTiCount = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160729','openid'=>$_SESSION['openid']));
				if($DaTiCount <= 0){
					$TiArray[$daan] = $TiArray[$daan]+1; //计算答案的总数量
					Tpl::output('ZongNum',intval($ZongNum+1)); //总数加一计算当前回答题数
				}else{
					Tpl::output('ZongNum',intval($ZongNum)); //总数加一计算当前回答题数
				}
				Tpl::output('TiArray',$TiArray);
				Tpl::output('QTI',$QTI[$NumberQuestions]);
				Tpl::output('NumberQuestions',($NumberQuestions+1));//下一题
				Tpl::showpage('20160729/getDaTi','null_layout');
			break;
			default:
				//检查是否授权
				$member_weixin_info_is = Model('weixin_info')->getOneMemberWeixinInfo($openid_this);
				if(empty($member_weixin_info_is)){
					$this->getAuthority('ad_20160729',$openid_this); //专题微信授权
				}
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::output('ZhuanTiAdName',true);
				Tpl::showpage('20160729/index_show');
			break;
		}
		
	}

	
	/**
	 * 点赞换银条活动
	 */
	public function ad_20160719_1Op(){

		showWapMessage('活动已结束','index.php','error');


		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
			//exit("请在微信端打开");
		}

		!empty($_GET['ua'])?$_SESSION['zan_ua'] = $_GET['ua']:'';

		// 用户信息
		// $member_info = $this->getMemberAndGradeInfo(true);

		$openid_this = $_SESSION['openid'];
		$openid_push = strlen(trim($_GET['push_openid'])) == 28 ?trim($_GET['push_openid']):'';

		if(empty($openid_push)){
			$this->ad_20160719_this_userOp($openid_this);
		}else{
			$this->ad_20160719_push_userOp($openid_push);
		}

		// 是否邀请了五个
		$is_user_yaoqing = Model('weixin_info')->getCountWeixinZan($openid_this);

		// // 是否邀请你的人邀请数超过五个
		// $is_dianzan_array = Model()->table('member_weixin_dianzan')->where(array('D_ThisOpenId'=>$openid_this))->find();
		// $is_yaoqing_user = Model('weixin_info')->getCountWeixinZan($is_dianzan_array['D_PushOpenId']);

		// if($is_user_yaoqing >= 5 || $is_yaoqing_user >= 5){
			Tpl::output('dianzan_max',$is_user_yaoqing);
		// }

		Tpl::output('html_title','邀请好友点赞送银条-收藏天下');
		Tpl::output('seo_keywords','投资银条,点赞,点赞送银条,邀请好友点赞');
		Tpl::output('seo_description','收藏天下五周年好友季,邀请好友点满5个赞,即享1元/克银条超值购!免费包邮!银条数量有限,欲购从速!');

		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::showpage('20160719_1/index_show');
	}


    /**
	 * 点赞换银条活动
	 */
	public function ad_20160719Op(){

		showWapMessage('活动已结束','index.php','error');

		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
			exit("请在微信端打开");
		}

		!empty($_GET['ua'])?$_SESSION['zan_ua'] = $_GET['ua']:'';

		// 用户信息
		// $member_info = $this->getMemberAndGradeInfo(true);

		$openid_this = $_SESSION['openid'];
		$openid_push = strlen(trim($_GET['push_openid'])) == 28 ?trim($_GET['push_openid']):'';

		if($openid_this == $openid_push){
			$openid_push = '';
		}

		if(empty($openid_push)){
			$this->ad_20160719_this_userOp($openid_this);
		}else{
			$this->ad_20160719_push_userOp($openid_push);
		}

		// 是否邀请了五个
		$is_user_yaoqing = Model('weixin_info')->getCountWeixinZan($openid_this);

		// // 是否邀请你的人邀请数超过五个
		// $is_dianzan_array = Model()->table('member_weixin_dianzan')->where(array('D_ThisOpenId'=>$openid_this))->find();
		// $is_yaoqing_user = Model('weixin_info')->getCountWeixinZan($is_dianzan_array['D_PushOpenId']);

		// if($is_user_yaoqing >= 5 || $is_yaoqing_user >= 5){
			Tpl::output('dianzan_max',$is_user_yaoqing);
		// }

		Tpl::output('html_title','邀请好友点赞送银条-收藏天下');
		Tpl::output('seo_keywords','投资银条,点赞,点赞送银条,邀请好友点赞');
		Tpl::output('seo_description','收藏天下五周年好友季,邀请好友点满5个赞,即享1元/克银条超值购!免费包邮!银条数量有限,欲购从速!');

		Tpl::output('no_header',true);
		Tpl::output('no_footer',true);
		Tpl::showpage('20160719/index_show');
	}

	/**
	 * 点赞换银条活动 - 当前用户入口
	 */
	private function ad_20160719_this_userOp($openid_this){
		$member_weixin_info = Model('weixin_info')->getOneMemberWeixinInfo($openid_this,'ad_20160719');

		$member_zan_count = Model('weixin_info')->getCountWeixinZan($openid_this);

		if(!empty($member_weixin_info)){
			$member_weixin_info['dianzan'] = $member_zan_count;
			$member_weixin_info['dianzan_'] = $member_zan_count>5?100:$member_zan_count*20;
		}

		Tpl::output('zan_count',$member_zan_count);
		Tpl::output('member_weixin_info',$member_weixin_info);
		Tpl::output('member_this',true);
	}


	/**
	 * 点赞换银条活动 - 推荐用户入口
	 */
	private function ad_20160719_push_userOp($openid_push){

		// 推荐入口进入当前用户
		$member_weixin_info_push_this = Model('weixin_info')->getOneMemberWeixinInfo($_SESSION['openid'],'ad_20160719');

		// 推荐人用户信息
		$member_weixin_info_push = Model('weixin_info')->getOneMemberWeixinInfo($openid_push,'ad_20160719');

		$member_zan_count = Model('weixin_info')->getCountWeixinZan($openid_push);

		if(!empty($member_weixin_info_push)){
			$member_weixin_info_push['dianzan'] = $member_zan_count;
			$member_weixin_info_push['dianzan_'] = $member_zan_count>5?100:$member_zan_count*20;
		}
		
		Tpl::output('zan_count',$member_zan_count);
		Tpl::output('member_weixin_info_push',$member_weixin_info_push);
		Tpl::output('member_weixin_info_push_this',$member_weixin_info_push_this);
		Tpl::output('member_push',true);
	}



	/**
	 * 授权获取微信用户信息
	 */
	public function get_weixin_infoOp(){

		$openid_this = $_SESSION['openid'];
		$is_login = $_SESSION['is_login'];

		if(empty($openid_this) || empty($is_login)){
			//未登录或者没有openid状态下不允许获取微信信息
			$url = urlWap('zhuanti','ad_20160719');
			header("location:$url");
			exit;
		}

		$weixin = new weixinSDK();

		$token = $weixin->token;

		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=".$openid_this."&lang=zh_CN";

		$weixin_result = json_decode(file_get_contents($url),true);

		if($weixin_result['subscribe'] == '1'){
			//数据存入数据库

			$member_weixin_info = Model('weixin_info')->getOneMemberWeixinInfo($_SESSION['openid'],'ad_20160719');

			if(empty($member_weixin_info)){

			$dataArr['W_MemberId'] = $_SESSION['member_id'];
			$dataArr['W_MemberName'] = $_SESSION['member_name'];
			$dataArr['W_Openid'] = $_SESSION['openid'];
			$dataArr['W_Nickname'] = $weixin_result['nickname'];
			$dataArr['W_Sex'] = $weixin_result['sex'];
			$dataArr['W_City'] = $weixin_result['city'];
			$dataArr['W_Province'] = $weixin_result['province'];
			$dataArr['W_Country'] = $weixin_result['country'];
			$dataArr['W_Headimgurl'] = urlencode($weixin_result['headimgurl']);
			$dataArr['W_Subscribe_time'] = $weixin_result['subscribe_time'];
			$dataArr['W_Addtime'] = time();
			$dataArr['ad_name'] = 'ad_20160719';
			Model('weixin_info')->addOneMemberWeixinInfo($dataArr);

			}

			$url = urldecode($_GET['zan_url'])?urldecode($_GET['zan_url']):urlWap('zhuanti','ad_20160719');
			header("location:$url");
		}else{
			//授权获取微信用户数据

			$_SESSION['weixin_zan_url'] = $_GET['zan_url'];

			$url =  urlWap('zhuanti','ad_20160719_get_user_info');
			$token = $weixin->oauth($url);
		}

	}

	/**
	 * 接收微信用户信息
	 */
	public function ad_20160719_get_user_infoOp(){

		$weixin = new weixinSDK();

		$member_weixin_info = $weixin->getOauthUserInfo(trim($_GET['code']));

		$member_weixin_info_is = Model('weixin_info')->getOneMemberWeixinInfo($_SESSION['openid'],'ad_20160719');

		if(empty($member_weixin_info_is)){

		// 存入数据库
		$dataArr['W_MemberId'] = $_SESSION['member_id'];
		$dataArr['W_MemberName'] = $_SESSION['member_name'];
		$dataArr['W_Openid'] = $_SESSION['openid'];
		$dataArr['W_Nickname'] = $member_weixin_info['nickname'];
		$dataArr['W_Sex'] = $member_weixin_info['sex'];
		$dataArr['W_City'] = $member_weixin_info['city'];
		$dataArr['W_Province'] = $member_weixin_info['province'];
		$dataArr['W_Country'] = $member_weixin_info['country'];
		$dataArr['W_Headimgurl'] = urlencode($member_weixin_info['headimgurl']);
		$dataArr['W_Subscribe_time'] = $member_weixin_info['subscribe_time']?$member_weixin_info['subscribe_time']:time();
		$dataArr['W_Addtime'] = time();
		$dataArr['ad_name'] = 'ad_20160719';

		Model('weixin_info')->addOneMemberWeixinInfo($dataArr);

		}

		$url = urldecode($_SESSION['zan_url'])?urldecode($_SESSION['zan_url']):urlWap('zhuanti','ad_20160719');
		$_SESSION['zan_url'] = '';
		header("location:$url");
	}


	/**
	 * 检测是否关注并提取用户信息
	 * @param bool $is_return 是否返回会员微信信息，返回为true，输出会员信息为false
	 */
	public function is_weixin_userinfoOp($is_return = false){
		
		$weixin = new weixinSDK();
		$token = $weixin->token;
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=".$_SESSION['openid']."&lang=zh_CN";
		$weixin_result = json_decode(file_get_contents($url),true);

		// wcache($weixin_result['openid'],$weixin_result,'zhuanti719',$this->cacheTime);

		if ($is_return == true){//返回会员信息
            return $weixin_result;
        } else {//输出会员信息
            echo json_encode($weixin_result);
        }

	}


	/**
	 * 点赞
	 * 
	 */
	public function ad_20160719_dianzanOp(){

		$openid = $_SESSION['openid'];

		$push_openid = trim($_POST['push_openid']);

		if(strlen($push_openid) != 28){
			$result['error'] = 11;
            $result['msg'] = '邀请人信息不正确！';
            echo json_encode($result);
            exit();
    	}

    	if($openid == $push_openid){
			$result['error'] = 22;
            $result['msg'] = '邀请人不能是自己本人！';
            echo json_encode($result);
            exit();
    	}

    	if(!empty($_SESSION['zhuanti_is_dianzan']) && ($_SESSION['zhuanti_is_dianzan']+10) > time()){
			$result['error'] = 44;
            $result['msg'] = '刚已点过赞、请稍候再试！';
            echo json_encode($result);
            exit();
    	}

    	// 搜索数据库检测是否点过赞
    	$getZanArr['D_ThisOpenId'] = $openid;
    	$dianzan_info = Model('weixin_info')->getOneWeixinZan($getZanArr);

    	if(!empty($dianzan_info)){
    		$_SESSION['zhuanti_is_dianzan'] = time();
			$result['error'] = 33;
            $result['msg'] = '您已参与过本次点赞活动！';
            echo json_encode($result);
            exit();
    	}


    	// 搜索数据库检测是否做为邀请人被点过赞
    	$getYaoZanArr['D_PushOpenId'] = $openid;
    	$dianzan_yao_info = Model('weixin_info')->getOneWeixinZan($getYaoZanArr);
    	if(!empty($dianzan_yao_info) && $dianzan_yao_info['D_ThisOpenId'] == $push_openid){
    		$_SESSION['zhuanti_is_dianzan'] = time();
			$result['error'] = 55;
            $result['msg'] = '您与参与过分享活动、不能相互点赞！！！';
            echo json_encode($result);
            exit();
    	}



    	// 如未点赞则保存点赞数据并返回成功状态
    	$zanArr['D_ThisOpenId'] = $openid;
    	$zanArr['D_PushOpenId'] = $push_openid;
    	$zanArr['D_AddTime'] = time();

    	$addDianZanId = Model('weixin_info')->addWeixinZan($zanArr);

    	if(!empty($addDianZanId)){
    		$_SESSION['zhuanti_is_dianzan'] = time();
			$result['error'] = 1;
            $result['msg'] = '点赞成功！';
            echo json_encode($result);
            exit();
    	}else{
    		$_SESSION['zhuanti_is_dianzan'] = time();
    		$result['error'] = 10;
            $result['msg'] = '点赞失败！';
            echo json_encode($result);
            exit();
    	}
	}

	public function dianZanLinQuOp(){
		$goodsid_array = array('22210'=>'0');
		$where_member_from['member_id'] = intval($_SESSION['member_id']);
		$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from,'点赞送银条包邮领取m');
		if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));

		$member_zan_count = Model('weixin_info')->getCountWeixinZan($_SESSION['openid']);

		if($member_zan_count < 5){
			exit(json_encode(array('state'=>false,'msg'=>"请集满5个赞后领取奖励！")));
		}

		$goods_amount = '5'; //商品总额
		$shipping_fee = '0'; //运费
		$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"点赞送银条",'点赞送银条包邮领取m');
	}


	/**
	 * 会员登陆 - 以跳转方式
	 * 
	 */
	public function login_showOp(){

		if(chksubmit(true)){
			

		$obj_validate = new Validate();
		$obj_validate->validateparam = array(
			array("input"=>$_POST['login_name'],"require"=>"true", "message"=>'用户名不能为空'),
			array("input"=>$_POST['login_pass'],"require"=>"true", "message"=>'密码不能为空'),
		);

		$error = $obj_validate->validate();
		if ($error != ''){
			showWapMessage($error,'','','error');
			exit();
		}

		//登陆类型
		if(preg_match("/1[34578]{1}\d{9}$/",$_POST['login_name'])){
			$logintype='mobile';
		}else{
			$logintype='username';
		}

		$salt_where	= array();
		if($logintype == 'mobile'){
			$salt_where['member_mobile'] = $_POST['login_name'];
		}else{
			$salt_where['member_name'] = $_POST['login_name'];
		}

		$model_member	= Model('member');
		$is_salt = $model_member->getMemberInfo($salt_where,'ec_salt');

		$array	= array();
		if($logintype == 'mobile'){
			$array['member_mobile']	= $_POST['login_name'];
		}else{
			$array['member_name']	= $_POST['login_name'];
		}
		if($is_salt['ec_salt'] != 0 || !empty($is_salt['ec_salt'])){
			$array['member_passwd']	= md5(md5($_POST['login_pass']).$is_salt['ec_salt']);
		}else{
			$array['member_passwd']	= md5($_POST['login_pass']);
		}

		$member_info = $model_member->getMemberInfo($array);
		//会员存在，如果有openid存入，删除其他会员openid
		if($_SESSION['openid'] != '' && $member_info['openid'] != $_SESSION['openid']){
			$model_member->editMember(array('openid'=>$_SESSION['openid']),array('openid'=>''));
			$model_member->editMember(array('member_id'=>$member_info['member_id']),array('openid'=>$_SESSION['openid']));
		}

		if(is_array($member_info) and !empty($member_info)) {
			if(!$member_info['member_state']){
				$result['error'] = '账号被停用';
				showWapMessage('账号被停用','','','error');
				exit();
			}
		}else{
			process::addprocess('login');
			$result['error'] = '用户名或密码错误';
			showWapMessage('用户名或密码错误','','','error');
			exit();
		}

		$model_member->createSession($member_info);

		redirect(getReferer());

		}else{
			showWapMessage('操作失败','','','error');
		}
	}


	/**
	 * 会员注册 - 以跳转方式
	 */
	public function register_showOp(){

		if(chksubmit(true)){

			$code = $_POST['zc_yzm'];
			if($_SESSION['wx_phone_yzm'][$_POST['zc_phone']] != $code || $_SESSION['wx_phone_yzm'][$_POST['zc_phone']] == ''){
				showWapMessage('验证码错误','','','error');
				exit();
			}

			$model_member   = Model('member');
            $register_info = array();
            $register_info['username'] = $_POST['zc_phone'];
            $register_info['password'] = substr($_POST['zc_phone'],-6);
            $register_info['password_confirm'] = substr($_POST['zc_phone'],-6);
            $register_info['member_from'] = '点赞送银条('.($_SESSION['zan_ua']?$_SESSION['zan_ua']:'weixin').')';
            $register_info['mobile'] = $_POST['zc_phone'];
            $register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
            $register_info['openid'] = $_SESSION['openid'];

            $member_info = $model_member->register($register_info);

            if(!isset($member_info['error'])) { 
                /*信息存入session*/
                $model_member->createSession($member_info);

        $sms = new Sms();

        $sms->send($_POST["zc_phone"],"注册成功,用户名为手机号,密码为手机后六位");


                showWapMessage('注册成功,用户名为手机号,密码为手机后六位',getReferer(),'succ',6000);
            } else {
                showWapMessage($member_info['error'],'','error');
            }
		}else{
			showWapMessage('操作失败','','','error');
		}
	}


	
	/**
	 * 藏豆兑换活动页面

	 */
	public function ad_20160714Op(){
		$model_cangdou = Model('pushuser_gift');
        $where = "cangdou_gift.starttime <='".TIMESTAMP."' AND cangdou_gift.endtime >= '".TIMESTAMP."'";
		$field = "*,(SELECT count(*) goods_duihuan_sum FROM shop_order_goods WHERE shop_order_goods.goods_id = cangdou_gift.goods_id AND shop_order_goods.lai_yuan = '藏豆兑换礼品' LIMIT 1) AS goods_duihuan_sum";
        $result_list = $model_cangdou->getCangdouGiftList($where,$field,4);

        Tpl::output('html_title','邀请得礼品，好礼送不停-收藏天下');
		Tpl::output('seo_keywords','藏豆，邀请有礼，邀请好礼');
		Tpl::output('seo_description','收藏天下为回馈新老客户，特别推出邀请有礼活动，邀请好友得5藏豆，只要邀请4个人，就能换购藏品，朋友购物也有返现哦。快来参与吧。');

		Tpl::output('result_list',$result_list);
		Tpl::showpage('20160714/index_show');
	}

	/**
	 * 
	 */
	public function ad_20160716Op(){

		$avUrlInfo = Model()->table('setting')->where(array('name'=>'avUrl'))->find();

		$avUrl = $avUrlInfo['value'];

		if(!empty($avUrl) && $avUrl != 1){

			$avUrl = urldecode($avUrl);

			header("Location: $avUrl");
			exit;
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::showpage('20160716/index_show');
		}
	}


	
	/**
	 * 送银条1块1克
	 */
	public function ad_20160708_1Op(){
		switch($_GET['action']){
			case 'lingqu':
				$goodsid_array = array('22210'=>'5');
				$where_member_from['member_id'] = intval($_SESSION['member_id']);
				//$where_member_from['member_from'] = array('like','%送银条%');
				$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
				if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
				$goods_amount = '5'; //商品总额
				$shipping_fee = '15'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"送银条1块1克",'送银条1块1克(M)');
			break;
			case 'regs':
				//注册
				$model_member	= Model('member');
				$code = $_POST['code'];
				if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
					$result['state'] = false;
					$result['msg'] = "验证码错误";
					echo json_encode($result); 
					exit();
				}
				$register_info = array();
				$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
				$register_info['username'] = $_POST['mobile'];
				$register_info['password'] = substr($_POST['mobile'], -6);
				$register_info['password_confirm'] = substr($_POST['mobile'], -6);
				$register_info['mobile'] = $_POST['mobile'];
				$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
				$register_info['member_from'] = '送银条1块1克('.$M.')';
				$member_info = $model_member->register($register_info);
				if(!isset($member_info['error'])) {
					$model_member->createSession($member_info,true);
					exit(json_encode(array('state'=>true,'msg'=>"OK",'username'=>$_POST['mobile'],'password'=>substr($_POST['mobile'], -6))));
				}else{
					exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
				}
			break;
			default:
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20160708/index_show1');
			break;
		}
	}

	/**
	 *送银条活动
	 */
	public function ad_20160708Op(){
		switch($_GET['action']){
			case 'lingqu':
				$goodsid_array = array('22210'=>'0');
				$where_member_from['member_id'] = intval($_SESSION['member_id']);
				//$where_member_from['member_from'] = array('like','%送银条%');
				$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
				if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
				$goods_amount = '0'; //商品总额
				$shipping_fee = '20'; //运费
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"送银条免费领取",'送银条免费领取(M)');
			break;
			case 'regs':
				//注册
				$model_member	= Model('member');
				$code = $_POST['code'];
				if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
					$result['state'] = false;
					$result['msg'] = "验证码错误";
					echo json_encode($result); 
					exit();
				}
				$register_info = array();
				$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
				$register_info['username'] = $_POST['mobile'];
				$register_info['password'] = substr($_POST['mobile'], -6);
				$register_info['password_confirm'] = substr($_POST['mobile'], -6);
				$register_info['mobile'] = $_POST['mobile'];
				$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
				$register_info['member_from'] = '送银条免费领取('.$M.')';
				$member_info = $model_member->register($register_info);
				if(!isset($member_info['error'])) {
					$model_member->createSession($member_info,true);
					exit(json_encode(array('state'=>true,'msg'=>"OK",'username'=>$_POST['mobile'],'password'=>substr($_POST['mobile'], -6))));
				}else{
					exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
				}
			break;
			default:
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20160708/index_show');
			break;
		}
	}
	
	/**
	 * 传家宝活动
	 */
	public function ad_20160707Op(){
		showWapMessage('活动结束','index.php','error');
		exit();
		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
			//echo("请在微信端打开");
			//exit;
		}

		Tpl::output('html_title','全国首届传家宝票选活动官方网站-收藏天下');
		Tpl::output('seo_keywords','传家宝免费鉴定,传家宝免费评估,传家宝活动-收藏天下');
		Tpl::output('seo_description','全国首届传家宝票选活动火热进行中,马上拍照上传家传之宝即可参与票选活动，CCTV央视《鉴定》专家王立军免费为您评估鉴定！更有5000元现金大奖等你来拿！-收藏天下');

		
		switch($_POST['action']){
			case 'modal-8': //检查是否登陆或者是否关注微信公众号
				if(intval($_SESSION['member_id']) <= 0){ //未登陆
					exit(json_encode(array('state'=>false,'msg'=>'-1')));
				}

				//检查会员是否关注公众号
//				$weixin = new weixinSDK();
//				$token = $weixin->token;
//				$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=".$_SESSION['openid']."&lang=zh_CN";
//				$weixin_result = json_decode(file_get_contents($url),true);
//				if($weixin_result['subscribe'] != 1){
//					exit(json_encode(array('state'=>false,'msg'=>'-2')));
//				}else{
//					}
			//检查用户是否发布投票一个用户只能发布一次
			$you_count = $this->ZtModel->getPaiMing(array('member_id'=>intval($_SESSION['member_id'])));
			if($you_count > 0){
				exit(json_encode(array('state'=>false,'msg'=>'-3')));
			}else{
				exit(json_encode(array('state'=>true,'msg'=>"OK")));
			}
					
				
			break;
			case 'modal-shop': //查看别人的传家宝
				if(intval($_POST['id']) <= 0){ //未登陆
					exit(json_encode(array('state'=>false,'msg'=>'-1')));
				}
				$condition = array();
				$condition['id'] = $_POST['id'];
				$condition['is_rev'] = '1';
				$condition['ad_from'] = '20160707';
				$ChuanJia = $this->ZtModel->getTouPiaoList($condition);
				$msg = $this->ChaKanChuanJia($ChuanJia[0]);
				if($msg){ //未登陆
					exit(json_encode(array('state'=>true,'msg'=>$msg)));
				}else{
					exit(json_encode(array('state'=>false,'msg'=>'-1')));
				}
			break;
			case 'regs':
				//注册
				$model_member	= Model('member');
				$code = $_POST['code'];
				if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
					$result['state'] = false;
					$result['msg'] = "验证码错误";
					echo json_encode($result); 
					exit();
				}
				$register_info = array();
				$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
				$register_info['username'] = $_POST['user_name'];
				$register_info['password'] = $_POST['password'];
				$register_info['password_confirm'] = $_POST['password1'];
				$register_info['mobile'] = $_POST['mobile'];
				$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
				$register_info['member_from'] = '传家宝活动('.$M.')';
				$member_info = $model_member->register($register_info);
				if(!isset($member_info['error'])) {
					$model_member->createSession($member_info,true);
					exit(json_encode(array('state'=>true,'msg'=>"OK")));
				}else{
					exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
				}
			break;
			case 'toupiao': //进行投票操作
				if(intval($_SESSION['member_id']) <= 0){ //未登陆
					exit(json_encode(array('state'=>false,'msg'=>'-1')));
				}
				//检查会员是否关注公众号
//				$weixin = new weixinSDK();
//				$token = $weixin->token;
//				$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=".$_SESSION['openid']."&lang=zh_CN";
//				$weixin_result = json_decode(file_get_contents($url),true);
//				if($weixin_result['subscribe'] != 1){
//					exit(json_encode(array('state'=>false,'msg'=>'-2')));
//				}else{
//					
//				}
					//检查是否是给自己投票
					$condition = array();
					$condition['id'] = $_POST['id'];
					$condition['member_id'] = $_SESSION['member_id'];
					$ChuanJia = $this->ZtModel->getTouPiaoList($condition);
					if(count($ChuanJia) > 0){
						exit(json_encode(array('state'=>false,'msg'=>'-3')));
					}
					$condition = array();
					$condition['id'] = $_POST['id'];
					$condition['is_rev'] = '1';
					$condition['ad_from'] = '20160707';
					$L_TouPiao = $this->ZtModel->getTouPiaoList($condition);
					$TouPiao = $L_TouPiao[0];
					if($TouPiao){
						//检查会员今天的都票次数是否以用完
						$TouPiaoCount = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160707','member_id'=>intval($_SESSION['member_id']),'year'=>date("Y",time()),'month'=>date("m",time()),'day'=>date("d",time())));
						if($TouPiaoCount >= 3){
							exit(json_encode(array('state'=>false,'msg'=>'-5')));
						}else{
							//写入投票记录
							$data = array();
							//将中奖信息写入数据库
							$data['member_id'] = $_SESSION['member_id'];
							$data['year'] = date('Y',time());
							$data['month'] = date('m',time());
							$data['day'] = date('d',time());
							$data['hour'] = date('H',time());
							$data['time'] = date('H:i:s',time());
							$data['add_time'] = time();
							$data['ip'] = $_SERVER['REMOTE_ADDR'];
							$data['ad_name'] = '20160707';
							$data['l_name'] = $TouPiao['title'];
							$data['l_id'] = $condition['id'];
							$data['is_fafang'] = 0;
							$data['openid'] = $_SESSION['openid'];
							$lid = $this->ZtModel->addLottery($data);
							Model()->query("UPDATE shop_vote SET  vote_num = vote_num+1 WHERE id =".$data['l_id']." ");
							exit(json_encode(array('state'=>true,'msg'=>'OK')));
						}
					}else{
						exit(json_encode(array('state'=>false,'msg'=>'-4')));
					}

			break;
			default:
				//获取投票排行榜
				$condition = array();
				$condition['is_rev'] = '1';
				$condition['ad_from'] = '20160707';
				$PiaoList = $this->ZtModel->getTouPiaoList($condition,'*','8','vote_num desc,id desc');
				$QianYiBai = $this->ZtModel->getTouPiaoList($condition,'*','','vote_num desc,id desc','100');
				Tpl::output('QianYiBai',$QianYiBai);
				Tpl::output('PiaoList',$PiaoList);
				Tpl::output('page',$this->ZtModel->showpage(88));
				//获取自己添加的最新投票
				$condition = array();
				$condition['is_rev'] = '1';
				$condition['ad_from'] = '20160707';
				if(intval($_GET['push_memberid'])){
					$condition['member_id'] = intval($_GET['push_memberid']);
					Tpl::output('is_mycuanjia','no');
				}else{
					$condition['member_id'] = $_SESSION['member_id'];
					Tpl::output('is_mycuanjia','yes');
				}
				$value = $this->ZtModel->getTouPiaoList($condition,'*','','vote_num desc,id desc','1');
				Tpl::output('value',$value[0]);
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				$you_count = $this->ZtModel->getPaiMing(array('member_id'=>intval($_SESSION['member_id'])));
				Tpl::output('you_count',$you_count);
				Tpl::output('member_id',$condition['member_id']);
				Tpl::showpage('20160707/index_show');
			break;
		}	
	}
	
	/**
	 * 传家宝活动我要参与页面
	 */
	public function ad_20160707_bntOp(){
			if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false) {
				//echo("请在微信端打开");
				//exit;
			}
			//检查是否登陆
			if(intval($_SESSION['member_id']) <= 0){ //未登陆
				header("Location: http://m.96567.com/index.php?act=zhuanti&op=ad_20160707"); 
				exit();
			}

			//检查用户是否发布投票一个用户只能发布一次
			$you_count = $this->ZtModel->getPaiMing(array('member_id'=>intval($_SESSION['member_id'])));
			if($you_count > 0){
				echo '<script>alert("您已经上传过作品了，一个用户只能上传一次作品！");</script>';
				header("Location: http://m.96567.com/index.php?act=zhuanti&op=ad_20160707"); 
				exit();
			}
			//检查是否关注微信公众号
//			$weixin = new weixinSDK();
//			$token = $weixin->token;
//			$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=".$_SESSION['openid']."&lang=zh_CN";
//			$weixin_result = json_decode(file_get_contents($url),true);
//			if($weixin_result['subscribe'] != 1){
//				header("Location: http://m.96567.com/index.php?act=zhuanti&op=ad_20160707"); 
//				exit();
//			}
			
			if($_POST){
				$insert_array = array();
				$insert_array['title']    = $_POST['title']; //藏品title
				$insert_array['img_file']  = serialize($_POST['img_file']); //图片
				$insert_array['years']   = trim($_POST['years']); //作品年代
				$insert_array['data_time']   = trim($_POST['data_time']);//入手时间
				$insert_array['price']   = trim($_POST['price']);//入手价格
				$insert_array['contents']   = trim($_POST['contents']);//藏品描述
				$insert_array['is_rev']   = 1; //审核状态 0 未审核 1 已审核 2 拒绝审核 默认通过审核状态
				$insert_array['member_id']   = $_SESSION['member_id']; // 添加会员id
				$insert_array['member_name']   = $_SESSION['member_name']; // 添加会员名
				$insert_array['member_openid']   = $_SESSION['openid']; // 添加的openid
				$insert_array['vote_num']   = 0; // 投票数量默认为0
				$insert_array['add_time']   = time(); // 添加时间
				$insert_array['ad_from']   = '20160707'; // 项目来源
				$insert_array['ad_name']   = '传家宝活动'; // 项目标记
				$insert_array['user_name']   = trim($_POST['user_name']); // 项目标记
				$res = $this->ZtModel->insertTouPiao($insert_array);
				if($res){
					showMessage('提交成功。','http://m.96567.com/index.php?act=zhuanti&op=ad_20160707','html','succ');
				}else{
					showMessage('操作失败','','','error');
				}

			}else{
				
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20160707/20160707_bnt');
			}
			
	}
	/**
	 * 返回查看的传家宝信息
	 */
	private function ChaKanChuanJia($dataArr){
		//
		$paiming = $this->ZtModel->getPaiMing(array('vote_num'=>array('egt',$dataArr['vote_num'])));
		$img = unserialize($dataArr['img_file']);
		if($img){
			foreach($img as $k=>$v){
				$imgarr .= '<img src="http://www.96567.com/'.$v.'"/>';
			}
		}
		$msg = '<div class="md-content coloured"><div class="demo clearfix"><div class="tc-con clearfix"><div class="sea-mew mt clearfix"><img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160707/images/sea-mew.jpg"/></div><h1 class="tc-title">'.$dataArr['title'].'</h1><div class="personage-baby clearfix"><div class="perimg clearfix"><div class="margin-top"><div class="row"><div class="large-12 columns"><div class="fadeOut"><div class="container_12"><div class="grid_8"><div id="sliderA" class="slider">'.$imgarr.'</div></div></div></div></div></div></div>	</div><div class="lt-box clearfix"><span><i class="icon-love"></i>票数<em>'.$dataArr['vote_num'].'</em></span><span><i class="icon-trophy"></i>排名<em>'.intval($paiming).'</em></span></div></div><p>藏品简介</p><p>年代：'.$dataArr['years'].'</p><p>入手时间：'.$dataArr['data_time'].'</p><p>入手价格：'.$dataArr['price'].'元</p><p>'.$dataArr['contents'].'</p><button class="tc-btn-vote mt" onclick="toupiao('.$dataArr['id'].');">投票</button></div><div class="bm-painting"><img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160707/images/painting.jpg"/></div><button class="md-close close-one"><i class="icon-close"></i></button></div></div><script>$(".icon-close").click(function(){$("div").removeClass("md-show");});</script>';
		return $msg;
	}
	/**
	 * 上传图片
	 */
	public function uploadUrlOp(){
		if($_FILES){
			$imgArr = $_FILES;
			//创建上传类
			$upload = new UploadFile();
			//设置上传目录
			$upload->set('default_dir','chuanjia/');
			$result = $upload->upfile('file_data');
			//生成两张缩略图，宽高分别为 30,300
			$upload->set('thumb_width','30,300');
			$upload->set('thumb_height','30,300');
			//两个缩略图名称后面分别追加 "_tiny","_mid"
			$upload->set('thumb_ext','_30,_300');
			if($result){
				//得到图片上传后的路径
				$img_path = '/data/upload/chuanjia/'.$upload->file_name;
				$initialPreview[] = '<img src="http://www.96567.com'.$img_path.'" class="file-preview-image" title="'.$upload->file_name.'" alt="'.$upload->file_name.'" style="width:auto;height:160px;"><input type="hidden" name="img_file[]" id="img_file" value="'.$img_path.'">';
				
				exit(json_encode(array('initialPreview'=>$initialPreview)));
			}else{
				exit(json_encode(array('error'=>'上传失败')));
			}
		}
	}


	public function fenxiangOp(){
		$array['P']['title'] = '我正在参加“收藏天下好友季”送话费活动，100元话费马上到手，快点击链接为我助力吧';
		$array['P']['imgUrl'] = '/zhuanti/20160621/images/weixin.png';
		$array['P']['link'] = 'http://www.baidu.com'; //分享连接
		$array['Y']['link'] = 'http://www.baidu.com'; //分享连接
		$array['Y']['title'] = '我正在参加“收藏天下好友季”送话费活动，100元话费马上到手，快点击链接为我助力吧';
		$array['Y']['desc'] = '桃花潭水深千尺，不及好友动手指';
		$array['Y']['imgUrl'] = '/zhuanti/20160621/images/weixin.png';

		echo weixinShare($array);
	}
	/**
	 * 杜 免费领取
	 */
	public function ad_20160622Op(){
		if($_GET['action'] == 'yanzhengone'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$code = $_POST['code'];
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
				$result['error'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$register_info['member_mobile_bind'] = 1;
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '免费送70周年纪念币('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$result['msg'] = '注册成功';
				$model_member->createSession($member_info,true);
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}elseif($_GET['action'] == 'lingqu'){
			$goodsid_array = array('10733'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%免费送70周年纪念币%');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
			$goods_amount = '0'; //商品总额
			$shipping_fee = '12'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"免费送70周年纪念币",'免费领取(M)');
		}else{
			$goodsid_array = array('10733'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%免费送70周年纪念币%');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error'] == '您不符合领取资格') Tpl::output('is_lin','1');
			Tpl::output('member_id',intval($_SESSION['member_id']));
			Tpl::output('html_title',"收藏天下注册有礼，免费送抗战胜利70周年纪念币。");
			Tpl::output('seo_keywords',"注册有礼,免费领取,抗战胜利纪念币,抗战70周年纪念币,抗战币,纪念币");
			Tpl::output('seo_description',"收藏天下注册有礼再次来袭，注册就免费送抗战胜利70周年纪念币，带册装帧更豪华，存世流传有心意。立刻注册，立刻免费领抗战胜利70周年纪念币，自己珍藏、送人礼物，均是极棒的选择。来收藏天下，免费好礼免费拿！");
			Tpl::showpage('20160622/index_show');
		}
	}

	
	/**
	 * 助力送话费活动
	 */

	public function ad_20160621Op(){
		//检查会员是否关注公众号
		$weixin = new weixinSDK();
		$token = $weixin->token;
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=".$_SESSION['push_openid']."&lang=zh_CN";
		$weixin_result = json_decode(file_get_contents($url),true);
		if($weixin_result['subscribe'] != 1 || $_SESSION['push_openid'] == $_SESSION['openid']){ //如果分享人未关注微信公众号则分享无效
			$push_openid = '';
		}else{
			$push_openid = $_SESSION['push_openid'];
		}
		Tpl::output('push_openid',$push_openid);
		if($_GET['action'] == 'url_admin'){
				//登录检查验证
				if($_POST){
					$user=$_POST["username"];
					$pws=$_POST["password"];
					if($user == "杜飞" && $pws =="df123123"){
					   setcookie("DfZtAdmin", "1");
					   header("location:index.php?act=zhuanti&op=ad_20160621&action=url_admin");
					}else{
						echo "<script>window.alert('登录失败返回重新登录');window.location.href='index.php?act=zhuanti&op=ad_20160621&action=url_admin';</script>";
						exit;
					}
				}elseif($_GET['dd_act'] == 'cha'){
					$member_Id = intval($_GET['member_id']);
					if($member_Id <= 0){
						echo '参数错误';
						exit;
					}
					$model_member	= Model('member');
					$model_list = $model_member->getMemberList(array('inviter_id'=>$member_Id,'member_from'=>array('like','%微信送话费活动%')));
					echo '<table>';
					echo '<tr><td>助力会员名</td><td>手机号</td></tr>';
					foreach($model_list as $k=>$v){
						$mob = @file_get_contents("http://crm.96567.com/index.php?m=api&p=action&c=JMmobile&mobile=".$v['member_mobile']);
						echo '<tr><td>'.$v['member_name'].'</td><td>'.$mob.'</td></tr>';
					}
					echo '</table>';
					exit;

				}else{
					if(empty($_COOKIE["DfZtAdmin"])) {
						Tpl::showpage('20160621/admin/login','null_layout');
					}else{
						$member_sat = ($_GET['Start_time'] == '') ? '1466438400' : strtotime($_GET['Start_time']);
						$member_end = ($_GET['End_time'] == '') ? time() : strtotime($_GET['End_time']);
						//获得所有会员中奖记录
						$SuoYouLotteryList = $this->ZtModel->getLotteryReceiveList(array('ad_name'=>'20160621','type'=>'0','add_time'=>array('egt',$member_sat),'add_time'=>array('elt',$member_end)),'*,(SELECT count(0) from shop_member where inviter_id = `shop_lottery_receive`.member_id AND member_from like "%微信送话费活动%") as ZhuLiCnt','20');

						if($_GET['types'] == 'dao'){
							$this->DaoChu_Export(date('Y-m-d',$member_sat).'---'.date('Y-m-d',$member_end).'领取列表');
							echo '<table>';
							echo '<tr><td>领取会员</td><td>领取手机号</td><td>话费金额</td><td>运营商/地区</td><td>领取时间</td><td>助力总数</td></tr>';
							if($SuoYouLotteryList){
								foreach($SuoYouLotteryList as $k=>$v){
									echo "<tr><td>".$v['member_name']."</td><td>".$v['mobile']."</td><td>".$v['l_id']."元话费</td><td>".$v['address']."</td><td>".date("Y-m-d H:i:s",$v['add_time'])."</td><td>".$v['ZhuLiCnt']."</td></tr>";
								}
							}
							echo '</table>';
							exit;
						}else{
							Tpl::output('show_page',$this->ZtModel->showpage());
							Tpl::output('List',$SuoYouLotteryList);
							Tpl::output('member_sat',date('Y-m-d',$member_sat));
							Tpl::output('member_end',date('Y-m-d',$member_end));
							Tpl::showpage('20160621/admin/adminindex','null_layout');
						}
					}
				}
				exit;
		}
		//检查用户是否在微信浏览器打开  
		if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false) {
			if($_GET['action'] == 'btn_ajax' && intval($_POST['btn']) > 0){
				switch(intval($_POST['btn'])){
					case 1:
						//领取话费 检查是否符合条件
						if(intval($_SESSION['member_id']) <= 0){
							echo '-1';
							exit();
						}
						$val = intval($_POST['val']);
						//,'200'=>'200'
						$HuaFei = array('10'=>'10','20'=>'20','50'=>'50','100'=>'100');
						$XianZhi = array(
							'10'=>array('min'=>3,'mix'=>4),
							'20'=>array('min'=>5,'mix'=>9),
							'50'=>array('min'=>10,'mix'=>14),
							'100'=>array('min'=>15,'mix'=>9999999)
						);
						if(in_array($val, $HuaFei)){
							//检查用户是否已经领取过
							$is_lin = $this->ZtModel->LinQuCount(array('ad_name'=>'20160621','member_id'=>intval($_SESSION['member_id']),'type'=>'0'));
							if($is_lin > 0){
								exit(json_encode(array('state'=>false,'msg'=>'每位用户仅限领取一次，不能重复领取。')));
							}
							//检查用户助力是否住够
							$model_member	= Model('member');
							$MemberCount = $model_member->getMemberCount(array('inviter_id'=>$_SESSION['member_id'],'member_from'=>array('like','%微信送话费活动%')));
							$min = $XianZhi[$val]['min'];
							$mix = $XianZhi[$val]['mix'];
							if($min <= $MemberCount && $MemberCount < $mix){
								exit(json_encode(array('state'=>true,'msg'=>"OK")));
							}else{
								exit(json_encode(array('state'=>false,'msg'=>'对不起，您不满足领取条件')));
							}
						}else{
							exit(json_encode(array('state'=>false,'msg'=>'违规操作')));
						}
						break;
					case 2:
						$result['state'] = false;
						$result['msg'] = "第一波话费已被抢光，敬情关注后期活动";
						echo json_encode($result); 
						exit();
						//用户注册
						$model_member	= Model('member');
						$code = $_POST['code'];
						if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
							$result['state'] = false;
							$result['msg'] = "验证码错误";
							echo json_encode($result); 
							exit();
						}
						$_SESSION['wx_phone_yzm'][$_POST['mobile']] == '';
						$register_info = array();
						$tjr_info = $model_member->getMemberInfo(array('openid'=>$_SESSION['push_openid']));
						if($tjr_info && $_POST['no_push'] != 1){
							$register_info['inviter_id'] = intval($tjr_info['member_id']);
						}
						if($_SESSION['openid'] != ''){
							$register_info['openid'] = $_SESSION['openid'];
						}
						$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
						$register_info['username'] = $_POST['user_name'];
						$register_info['password'] = $_POST['password'];
						$register_info['password_confirm'] = $_POST['password1'];
						$register_info['mobile'] = $_POST['mobile'];
						$register_info['iscangdou'] = 'no';
						$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
						$register_info['member_from'] = '微信送话费活动('.$M.')';
						$member_info = $model_member->register($register_info);
						if(!isset($member_info['error'])) {
							$model_member->createSession($member_info,true);
							exit(json_encode(array('state'=>true,'msg'=>"OK")));
						}else{
							exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
						}
						break;
					case 3:
						//领取话费 检查是否符合条件
						if(intval($_SESSION['member_id']) <= 0){
							exit(json_encode(array('state'=>false,'msg'=>'请先登录后再来领取')));
						}
						$val = intval($_POST['val']);
						$HuaFei = array('10'=>'10','20'=>'20','50'=>'50','100'=>'100');
						$XianZhi = array(
							'10'=>array('min'=>3,'mix'=>4),
							'20'=>array('min'=>5,'mix'=>9),
							'50'=>array('min'=>10,'mix'=>14),
							'100'=>array('min'=>15,'mix'=>9999999)
						);
						if(in_array($val, $HuaFei)){
							//检查用户是否已经领取过
							$is_lin = $this->ZtModel->LinQuCount(array('ad_name'=>'20160621','member_id'=>intval($_SESSION['member_id']),'type'=>'0'));
							if($is_lin > 0){
								exit(json_encode(array('state'=>false,'msg'=>'每位用户仅限领取一次，不能重复领取。')));
							}
							//检查用户助力是否住够
							$model_member	= Model('member');
							$MemberCount = $model_member->getMemberCount(array('inviter_id'=>$_SESSION['member_id'],'member_from'=>array('like','%微信送话费活动%')));
							$min = $XianZhi[$val]['min'];
							$mix = $XianZhi[$val]['mix'];
							if($min <= $MemberCount && $MemberCount < $mix){
								$dataArr = array();
								$dataArr['mobile'] = $_POST['tel_mob'];
								$dataArr['address'] = $_POST['YunYingShang'].'	'.$_POST['prov'];
								$dataArr['member_id'] = intval($_SESSION['member_id']);
								$dataArr['member_name'] = $_SESSION['member_name'];
								$dataArr['ad_name'] = '20160621';
								$dataArr['add_time'] = time();
								$dataArr['l_id'] = $val;
								$qq = $this->ZtModel->insertLinQu($dataArr);
								exit(json_encode(array('state'=>true,'msg'=>"OK")));
							}else{
								exit(json_encode(array('state'=>false,'msg'=>'对不起，您不满足领取条件')));
							}
						}else{
							exit(json_encode(array('state'=>false,'msg'=>'违规操作')));
						}
						break;
					case 4:
					break;
					case 5:
					break;
					case 6:
						echo '-2';
						exit();
						//检查会员是否登陆
						if(intval($_SESSION['member_id']) <= 0 ){
							echo '-1';
							exit();
						}
						//检查会员是否关注公众号
						$weixin = new weixinSDK();
						$token = $weixin->token;
						$openid = $_SESSION['openid'];
						$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$openid&lang=zh_CN";
						$weixin_result = json_decode(file_get_contents($url),true);
						$weixin_result['headimgurl']; //微信头像
						if($weixin_result['subscribe'] == 1){
							echo '1';
							exit();
						}else{
							echo '2';
							exit();
						}
						break;
					case 7:
							//助力用户留言
							if($_POST['contents'] == ''){
								exit(json_encode(array('state'=>false,'msg'=>"留言类容不能为空！")));
							}
							if(intval($_SESSION['member_id']) <= 0){
								exit(json_encode(array('state'=>false,'msg'=>"参数不正确")));
							}
							//$model_member	= Model('member');
							$dataArr = array();
							//$member_info = $model_member->getMemberInfo(array('member_id'=>$_SESSION['member_id']));
							$dataArr['member_id'] = intval($_SESSION['member_id']);
							$dataArr['member_name'] = $_SESSION['member_name'];
							$dataArr['contet'] = $_POST['contents'];
							$dataArr['ad_name'] = '20160621';
							$dataArr['add_time'] = time();
							$dataArr['type'] = 1;
							//$dataArr['openid'] = $member_info['openid'];
							//$dataArr['inviter_id'] = $member_info['inviter_id'];
							$qq = $this->ZtModel->insertLinQu($dataArr);
							if($qq) {
								exit(json_encode(array('state'=>true,'msg'=>"OK")));
							}else{
								exit(json_encode(array('state'=>false,'msg'=>"提交失败")));
							}
							break;
				}
			}elseif($_GET['action'] == 'liu_yan'){
				Tpl::showpage('20160621/liu_yan');
			}else{
				//查询当前会员所有的助力好友
				$model_member	= Model('member'); //
				$weixin = new weixinSDK();
				$token = $weixin->token;
				if($push_openid){
					$where = array('openid'=>$_SESSION['push_openid']);
				}else{
					$where = array('member_id'=>$_SESSION['member_id']);
				}
				//获取当前会员的微信头像
				$member_info = $model_member->getMemberInfo($where);
				$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=".$_SESSION['push_openid']."&lang=zh_CN";

				$weixin_result = json_decode(file_get_contents($url),true);
				Tpl::output('headimgurl',$weixin_result['headimgurl']);//微信头像
				Tpl::output('nickname',$weixin_result['nickname']);//微信头像
				$weixin_result = array();

				$member_list = $model_member->getMemberList(array('inviter_id'=>$member_info['member_id'],'member_from'=>array('like','%微信送话费活动%')));
				if($member_list){
					foreach($member_list as $k=>$v){
						$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=".$v['openid']."&lang=zh_CN";
						$weixin_result = json_decode(file_get_contents($url),true);
						$member_list[$k]['headimgurl'] = $weixin_result['headimgurl']; //微信头像
						$ReceiveList = $this->ZtModel->getLotteryReceive(array('ad_name'=>'20160621','type'=>1,'member_id'=>$v['member_id']));
						$member_list[$k]['contet'] = $ReceiveList['contet']; //留言类容
					}
				}
				Tpl::output('member_list',$member_list);
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20160621/index_show');
			}	
		}else{
			echo("请在微信端打开");
			exit;
		}
	}


	/**
	 * 艺术重酬广告页面
	 */
	public function ad_20160615Op(){
			if($_GET['action'] == 'bot_ajax'){
				//检查手机号是否已经提交过
				$insert['name'] = $_POST['name'];
				$insert['mobile'] = $_POST['mobile'];
				$insert['contet'] = $_POST['content'];
				$insert['member_id'] = $_SESSION['member_id'];
				$insert['member_name'] = $_SESSION['member_name'];
				$insert['ad_name'] = '20160615';
				$insert['add_time'] = time();

				$obj_validate = new Validate();
				$obj_validate->validateparam = array(
				array("input"=>$insert["name"],		"require"=>"true",		"message"=>'用户名不能为空'),
				array("input"=>$insert["mobile"],	"require"=>"true",		"message"=>'手机号不能为空'),
				array("input"=>$insert["contet"],	"require"=>"true",		"message"=>'请输入内容')
				);
				$error = $obj_validate->validate();
				if ($error != ''){
					$result['error'] =  $error;
					echo json_encode($result); 
					exit();
				}

				$register_info['member_from'] = '艺术众筹(M)';
				//将数据写入crm存放
				$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$insert['mobile'].'&N='.urlencode($insert['name']).'&AdFrom=ad_20160615'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0&contents='.urlencode($insert['contet']));
				if($retuen_type == 1){
					echo '1';
					exit();
				}else{
					$result['error'] =  "您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!";
					echo json_encode($result); 
					exit();
				}
				
				
			}else{
				Tpl::output('html_title',"艺术众筹 书协主席毕政书法私人订制");
				Tpl::output('seo_keywords',"毕政 私人订制 众筹 书法 书协主席  收藏  书协理事");
				Tpl::output('seo_description',"为了促进文化产业的发展，响应文化部“书画中国梦”的倡导，收藏天下携手书协主席毕政发起了“艺术众筹  毕政书法私人订制”活动，以公益价格收藏万元作品，助推书法走进千家万户。");
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::showpage('20160615/index_show');
			}
	}

	

	/**
	 * 猴币推广页面1
	 */
	public function ad_20160608_1Op(){
			Tpl::output('html_title',"关注微信免费领取2016猴年生肖纪念币一枚");
			Tpl::output('seo_keywords',"2016猴年生肖纪念币,猴币,猴年纪念币,生肖纪念币");
			Tpl::output('seo_description',"收藏天下是国内最专业的收藏品网站，本次举办的关注微信免费领取2016猴年生肖贺岁纪念币活动限时限量进行中！欢迎参加！");
			Tpl::showpage('20160608_1/index_show');
	}

	/**
	 * 猴币免费领取
	 */
	public function ad_20160608Op(){
		$zmr=intval($_GET['zmr']);
		if($zmr>0)
		{
		   setcookie('zmr', $zmr);
		}
		if($_GET['action'] == 'regs'){
			//注册
			$model_member	= Model('member');
			$code = $_POST['code'];
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
				$result['state'] = false;
				$result['msg'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$register_info = array();
			$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '猴币免费领取('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$model_member->createSession($member_info,true);
				exit(json_encode(array('state'=>true,'msg'=>"OK")));
			}else{
				exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
			}
		}elseif($_GET['action'] == 'lingqu'){
			$goodsid_array = array('14164'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%猴币免费领取%');
			//$where_member_from['member_time'] = array('gt','1464796800'); //注册时间在06-02至06-12之间
			//$where_member_from['member_time'] = array('lt','1465747200');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
			$goods_amount = '0'; //商品总额
			$shipping_fee = '20'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'猴币免费领取','免费领取');
		}else{
			$goodsid_array = array('14164'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%猴币免费领取%');
			//$where_member_from['member_time'] = array('gt','1464796800'); //注册时间在06-02至06-12之间
			//$where_member_from['member_time'] = array('lt','1465747200');

			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error']) Tpl::output('is_lin','1');

			Tpl::output('html_title',"猴年纪念币不花钱，免费领取");
			Tpl::output('seo_keywords',"猴年纪念币 猴币 生肖纪念币 纪念币 免费领取");
			Tpl::output('seo_description',"猴年纪念币不花钱，免费领！猴年生肖纪念币是当下最热门的纪念币藏品，为了推广纪念币收藏文化，特发起此次免费领取活动，快来领取吧！");
			Tpl::showpage('20160608/index_show');
		}
	}

	
	/**
	 * 端午节活动
	 */
	public function ad_20160602Op(){
		//检查是否在活动时间内
		if(time() > 1465747200){
			showMessage('您访问的活动已结束','http://m.96567.com','html','error');
			exit();
		}
		if($_GET['action'] == 'regs'){
			//注册
			$model_member	= Model('member');
			$code = $_POST['code'];
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
				$result['state'] = false;
				$result['msg'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$register_info = array();
			$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '端午节活动('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$model_member->createSession($member_info,true);
				exit(json_encode(array('state'=>true,'msg'=>"OK")));
			}else{
				exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
			}
		}elseif($_GET['action'] == 'lingqu'){
			$goodsid_array = array('2711'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%端午节活动%');
			$where_member_from['member_time'] = array('gt','1464796800'); //注册时间在06-02至06-12之间
			$where_member_from['member_time'] = array('lt','1465747200');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
			$goods_amount = '0'; //商品总额
			$shipping_fee = '20'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'端午节活动免费领取','【端午活动】免费领取');
		}else{
			$goodsid_array = array('2711'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%端午节活动%');
			$where_member_from['member_time'] = array('gt','1464796800'); //注册时间在06-02至06-12之间
			$where_member_from['member_time'] = array('lt','1465747200');

			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error']) Tpl::output('is_lin','1');

			$goods_info = Model('goods')->getGoodsInfoByID(1237);

			//从缓存中获取剩余数量
//			$dataArr = rkcache('HuoDong', true);
//			$dataArr['DuanWu'] = intval($dataArr['DuanWu']) <= 19 ? 200 : intval($dataArr['DuanWu']);
//			$intRand = rand(1,15);
//			if($intRand==5){
//				$num = rand(1,2);
//				$dataArr['DuanWu']= intval($dataArr['DuanWu']-$num);
//				if($dataArr['DuanWu'] < 20){
//					$dataArr['DuanWu']= rand(10,20);
//				}
//				wkcache('HuoDong', $dataArr); 
//			}
			Tpl::output('DuanWu',$goods_info['goods_storage']);

			Tpl::output('html_title',"端午特惠 纪念钞等额兑换");
			Tpl::output('seo_keywords',"端午 等值兑换 纪念钞 吉庆佳节 免费送");
			Tpl::output('seo_description',"吉庆佳节纪念钞等额兑换，可单枚或成套兑换，限量免邮。数量有限，仅200套，速兑换！");
			Tpl::showpage('20160602/index_show');
		}
	}

	/**
     * 520_1 里约专题 
     */
	public function ad_20160520_1Op(){
		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '里约奥运专题0520_1('.$M.')';
			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_20160520_1'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
			echo json_encode($result); 
			exit();
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title',"里约2016奥运纪念章 官方发售");
			Tpl::output('seo_keywords',"里约2016奥运纪念章 官方发售");
			Tpl::output('seo_description',"里约2016奥运纪念章 官方发售");
			Tpl::showpage('20160520_1/index_show');
		}
	}

	/**
     * 520 里约专题 
     */
	public function ad_20160520Op(){
		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '里约奥运专题0520('.$M.')';
			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_20160520'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
			echo json_encode($result); 
			exit();
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title',"里约2016奥运纪念章 官方发售");
			Tpl::output('seo_keywords',"里约2016奥运纪念章 官方发售");
			Tpl::output('seo_description',"里约2016奥运纪念章 官方发售");
			Tpl::showpage('20160520/index_show');
		}
	}

	/**
     * 519 里约专题 
     */
	public function ad_20160519Op(){
		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '里约奥运专题0519('.$M.')';
			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_20160519'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
			echo json_encode($result); 
			exit();
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title',"里约2016奥运纪念章 官方发售");
			Tpl::output('seo_keywords',"里约2016奥运纪念章 官方发售");
			Tpl::output('seo_description',"里约2016奥运纪念章 官方发售");
			Tpl::showpage('20160519/index_show');
		}
	}


	/**
     * 518专题附属活动 
     */
	public function ad_20160518_1Op(){

		showWapMessage('活动结束','index.php','error');
		exit();
		Tpl::output('html_title',"收藏天下518大促，价格触底，0元大礼拿不停。");
		Tpl::output('seo_keywords',"收藏品 艺术品 人民币收藏 邮票 纪念币");
		Tpl::output('seo_description',"收藏天下5周年大促盛惠开启，注册免费送360元红包和10万面额外国钞，香港塑料钞9.9包邮；数十款火爆藏品价格触底，优惠到难以想象；每日一签到参与抽奖，每天都有30件等着大家。");
		Tpl::showpage('20160518_1/zhuanti_show');
	}

	/**
     * 518专题活动 
     */
	public function ad_20160518Op(){
		showWapMessage('活动结束','index.php','error');
		exit();
		if($_GET['action'] == 'regs'){
			$model_member	= Model('member');
			$register_info = array();
			$code = $_POST['code'];
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
				$result['state'] = false;
				$result['msg'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '518大放价('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$model_member->createSession($member_info,true);
				exit(json_encode(array('state'=>true,'msg'=>"OK")));
			}else{
				exit(json_encode(array('state'=>false,'msg'=>$member_info['error'])));
			}
		}elseif($_GET['action'] == 'lingqu'){
			//检测会员是否登陆
			if(intval($_SESSION['member_id']) <= 0){
				exit(json_encode(array('state'=>false,'msg'=>'-1')));
			}
			//领取代金卷和克罗地压十万钞
			$val = intval($_GET['val']);
			$this->FaFangDaiJingJuan($val);
		}elseif($_GET['action'] == 'linqu'){//实物领取
			$type = intval($_POST['type']);
			$lid = intval($_POST['lid']);
			if($type <= 0) exit(json_encode(array('state'=>false,'msg'=>'参数错误，请刷新浏览器后重试')));
			$this->ShiWuFaFang($type,$lid);
		}elseif($_GET['action'] == 'Xiang_GangChao'){//9.9领取香港钞
			//检测会员是否登陆
			if(intval($_SESSION['member_id']) <= 0){
				exit(json_encode(array('state'=>false,'msg'=>'-1')));
			}
			$goodsid_array = array('1111'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_exppoints'] = 0;
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from,'518(9.9包邮)');
			if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
            exit(json_encode(array('state'=>true,'msg'=>'OK')));
		}elseif($_GET['action'] == 'QianDao'){//签到
//			if(time() < 1466179200){
//				exit(json_encode(array('state'=>false,'msg'=>'签到抽奖活动于5月18日0点开启，敬请期待！')));
//			}
			//检测会员是否登陆
			$member_id = intval($_SESSION['member_id']);
			if($member_id <= 0){
				exit(json_encode(array('state'=>false,'msg'=>'-1')));
			}
			//检查当前会员当天是否已经签过到了
			$dataArr = rkcache('HuoDong', true);
			if($dataArr['QianDao'][$member_id]['date_time'] == date("Y-m-d",time())){
				exit(json_encode(array('state'=>false,'msg'=>'您今天已经签过到了')));
			}
			$dataArr['QianDao'][$member_id] = array('date_time'=>date("Y-m-d",time()),'qiandao'=>1);
			wkcache('HuoDong', $dataArr); //将签到写入缓存
			exit(json_encode(array('state'=>true,'msg'=>'今日签到已完成，获得一次抽奖机会')));
		}elseif($_GET['action'] == 'CouJiang'){//抽奖
			
			$this->CouJiangAction();
		}else{
			$miaosha_classes = Model('miaosha_class')->getList(array('order'=>' start_hour asc '));
			$new_classes = array();
			foreach($miaosha_classes as $k=>$v){
				$new_classes[$v['class_id']] = $v;
			}
			$model_miaosha = Model('miaosha');
			//获取秒杀列表
			$condition = array();
			//$condition['state'] = '20';
			$condition['start_time'] = array(array('gt', strtotime(date('Y-m-d'))),array('lt', strtotime(date('Y-m-d')) + 86400),'and');//state desc,start_time desc,miaosha_id asc
			$miaosha_info = $model_miaosha->getMiaoshaList($condition,null,'start_time asc,m_sort asc');
			$miaosha_list = array();
			foreach($miaosha_info as $k=>$v){
				if($v['start_time'] > strtotime(date('Y-m-d')) && $v['start_time'] < (strtotime(date('Y-m-d')) + 86400)){
				   $start_hour = $new_classes[$v['class_id']]['start_hour'];
				   $end_hour   = $new_classes[$v['class_id']]['end_hour'];
				   if(count($miaosha_list[$start_hour]) < 4){ // 每个时间档位只取两个秒杀
							$goods_info = Model('goods')->getGoodsInfoByID($v['goods_id']);
							$miaosha_list[$start_hour][$v['miaosha_id']] = $v;
							$miaosha_list[$start_hour][$v['miaosha_id']]['goods_marketprice'] = $goods_info['goods_marketprice'];
							$miaosha_list[$start_hour][$v['miaosha_id']]['lisheng'] = $goods_info['goods_marketprice'] - $goods_info['miaosha_price'];
							$yu_quantity = $v['max_quantity']-$v['buy_quantity'];
							$miaosha_list[$start_hour][$v['miaosha_id']]['shengyukucun'] = ($yu_quantity >= $goods_info['goods_storage'])?$goods_info['goods_storage']:$yu_quantity;
							$miaosha_list[$start_hour][$v['miaosha_id']]['goods_image'] = thumb($goods_info, 240);
							$miaosha_list[$start_hour][$v['miaosha_id']]['goods_url'] = urlShop('goods', 'index', array('goods_id' => $v['goods_id']));
							$miaosha_list[$start_hour][$v['miaosha_id']]['end'] = 3;
					   if(date('H',time()) >= $start_hour && date('H',time()) < $end_hour && $miaosha_list[$start_hour][$v['miaosha_id']]['shengyukucun'] > 0){
							$miaosha_list[$start_hour][$v['miaosha_id']]['end'] = 2; //进行中
					   }elseif (date('H',time()) >= $end_hour || $miaosha_list[$start_hour][$v['miaosha_id']]['shengyukucun'] == 0) {
							$miaosha_list[$start_hour][$v['miaosha_id']]['end'] = 1; //已结束
					   } else {
							$miaosha_list[$start_hour][$v['miaosha_id']]['end'] = 3; //即将开始
					  }
				   }
				   
				}
			}
			Tpl::output('miaosha_list',$miaosha_list);
		
			$member_id = intval($_SESSION['member_id']);
			$HuoDong = rkcache('HuoDong', true);
			if($HuoDong['QianDao'][$member_id]['date_time'] == date("Y-m-d",time())){
				$is_qian_dao = 1;
			}else{
				$is_qian_dao = 0;
			}
			Tpl::output('is_qian_dao',$is_qian_dao);
			//查询商品评分信息
			$in_goods_id = array('11734','11735','4262','8262','14809','16861','14241','15112');
			$evaluate_goods_condition['geval_goodsid'] = array('in',$in_goods_id);
			$model_evaluate_goods = Model("evaluate_goods");
			$goodsevallist = $model_evaluate_goods->getEvaluateGoodsList($evaluate_goods_condition,20);
			
			Tpl::output('goodsevallist',$goodsevallist);
			
			$array_inlid = array(0,1,2);
			//获得当前会员中奖记录
			$MyLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160518','member_id'=>$_SESSION['member_id'],'l_id'=>array('in',$array_inlid),'add_time'=>array('elt',time())),'*,(SELECT member_name FROM shop_member WHERE `shop_member`.member_id = `shop_lottery_member`.member_id) as member_name','','add_time desc');
			Tpl::output('MyLotteryList',$MyLotteryList);
			//获得所有会员中奖记录
			$SuoYouLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160518','l_id'=>array('in',$array_inlid),'add_time'=>array('elt',time())),'*,(SELECT member_name FROM shop_member WHERE `shop_member`.member_id = `shop_lottery_member`.member_id) as member_name','','add_time desc');
			Tpl::output('SuoYouLotteryList',$SuoYouLotteryList);

			Tpl::output('html_title',"收藏天下518大促，价格触底，0元大礼拿不停。");
			Tpl::output('seo_keywords',"收藏品 艺术品 人民币收藏 邮票 纪念币");
			Tpl::output('seo_description',"收藏天下5周年大促盛惠开启，注册免费送360元红包和10万面额外国钞，香港塑料钞9.9包邮；数十款火爆藏品价格触底，优惠到难以想象；每日一签到参与抽奖，每天都有30件等着大家。");
			$goodsid_in = "11734,4262,8262,11735,14809,14241,16861,15112,11729,12384,15597,963";
			$goodsidarray = explode(',',$goodsid_in);
			$goods_in['goods_id'] = array('in',$goodsidarray);
			$goods_list = Model('goods')->getGoodsList($goods_in,'*','','goods_id desc');
			Tpl::output('goods_list',$goods_list);
			Tpl::showpage('20160518/zhuanti_show');
		}
	}

	//会员抽奖
	private function CouJiangAction(){
		//检测会员是否登陆
		$member_id = intval($_SESSION['member_id']);
		if($member_id <= 0){
			exit(json_encode(array('state'=>false,'msg'=>'-1')));
		}
//		if(time() < 1466179200){
//			exit(json_encode(array('state'=>false,'msg'=>'签到抽奖活动于5月18日0点开启，敬请期待！')));
//		}
		//检查会员是否拥有抽奖资格
		$HuoDong = rkcache('HuoDong', true);
		if($HuoDong['QianDao'][$member_id]['date_time'] != date("Y-m-d",time())){
			exit(json_encode(array('state'=>false,'msg'=>'请先签到再来进行抽奖！')));
		}
		if($HuoDong['QianDao'][$member_id]['qiandao'] == 0){
			exit(json_encode(array('state'=>false,'msg'=>'您今日的抽奖次数已用完，请明日再来！')));
		}
		$prize_arr = array(
			'0' => array('prize'=>'马达加斯加时尚天然紫晶手链','v'=>17031,'type'=>'1',num=>'20'),
			'1' => array('prize'=>'海南星月菩提108颗手串','v'=>17030,'type'=>'1',num=>'20'),
			'2' => array('prize'=>'都锦生蚕丝高档丝巾（花好月圆）','v'=>11085,'type'=>'1',num=>'25'),
			'3' => array('prize'=>'很遗憾！今天没有抽中，明天接着来试试吧！','v'=>0,'type'=>'2')
		);
		$rid = rand(0,1000);
		$is_fafang = 0;
		if($rid == 5){
			$r_id = 2;
		}elseif($rid == 555){
			$r_id = 1;
		}elseif($rid == 666){
			$r_id = 0;
		}else{
			$r_id = 3;
			$is_fafang = 1;
		}
		
		$DangTianShiWu = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160518','l_id'=>$r_id));
		$res = $prize_arr[$r_id]; //中奖项
		//判断实物奖品是否发放完成
		if($res['type'] == 1){
			//如果实物奖品发放完则赠送优惠劵
			if(intval($res['num']-$DangTianShiWu) <= 0){
				$r_id = 3;
			}
		}
		$res = $prize_arr[$r_id]; //重新获取中奖项
		//将中奖信息写入数据库
		$data['member_id'] = $member_id;
		$data['year'] = date('Y',time());
		$data['month'] = date('m',time());
		$data['day'] = date('d',time());
		$data['hour'] = date('H',time());
		$data['time'] = date('H:i:s',time());
		$data['add_time'] = time();
		$data['ip'] = $_SERVER['REMOTE_ADDR'];
		$data['ad_name'] = '20160518';
		$data['l_name'] = $res['prize'];
		$data['l_id'] = $r_id;
		$data['is_fafang'] = $is_fafang;
		$lid = $this->ZtModel->addLottery($data);
		$member_id = intval($_SESSION['member_id']);
		$dataArr = rkcache('HuoDong', true);
		$dataArr['QianDao'][$member_id] = array('date_time'=>date("Y-m-d",time()),'qiandao'=>0);
		wkcache('HuoDong', $dataArr); //将签到写入缓存 清空签到次数防止重复抽奖
		exit(json_encode(array('state'=>true,'msg'=>$res['prize'],'r_id'=>$r_id,'lid'=>$lid)));
	}

	//实物发放
	private function ShiWuFaFang($val,$lid){
		if($val == 1){//领取十万钞
			//检查用户是否用领取资格 只要有过订单的会员就不能领取
			$order = $this->ZtModel->getOrder(array('buyer_id'=>$member_id,'order_state'=>array('egt',20),'order_amount'=>array('egt',1)),'order_id,order_amount');
			if(count($order) > 0){
				exit(json_encode(array('state'=>false,'msg'=>'对不起，您不符合领取资格！')));
			}
			//检查用户是否验证手机
			$memberCount = Model('member')->getMemberCount(array('member_id'=>$member_id,'member_mobile_bind'=>1));
			if($memberCount <= 0){
				exit(json_encode(array('state'=>false,'msg'=>'对不起，您尚未验证手机请验证之后再来领取！')));
			}
			$goodsid_array = array('15900'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from,'518免费领取');
			if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
			$goods_amount = '0'; //商品总额
			$shipping_fee = '0'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'518免费领取','518免费领取');
		}elseif($val == 2){
			$goodsid_array = array('1111'=>'0');
			$where_member_from['member_id'] = $member_id;
			$where_member_from['member_exppoints'] = 0;
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,'','518(9.9包邮)');
			if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
			$goods_amount = '9.9'; //商品总额
			$shipping_fee = '0'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'518(9.9包邮)','518(9.9包邮)');
		}elseif($val == 3){
			$goodsid_array = array('17031'=>'0');
			$goods_amount = '0'; //商品总额
			$shipping_fee = '0'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'518(抽奖)','518(抽奖)',true,$lid);
		}elseif($val == 4){
			$goodsid_array = array('17030'=>'0');
			$goods_amount = '0'; //商品总额
			$shipping_fee = '0'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'518(抽奖)','518(抽奖)',true,$lid);
		}elseif($val == 5){
			$goodsid_array = array('11085'=>'0');
			$goods_amount = '0'; //商品总额
			$shipping_fee = '0'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'518(抽奖)','518(抽奖)',true,$lid);
		}
	}


	//518发放带代金卷和领取十万钞
	private function FaFangDaiJingJuan($val){
		$member_id = intval($_SESSION['member_id']);
		//检查用户是否用领取资格 只要有过订单的会员就不能领取
		$order = $this->ZtModel->getOrder(array('buyer_id'=>$member_id,'order_state'=>array('egt',20),'order_amount'=>array('egt',1)),'order_id,order_amount');
		if(count($order) > 0){
			exit(json_encode(array('state'=>false,'msg'=>'-5')));
		}
		if($val == 1){//十元代金卷
			//检查用户是否已经领取过代金卷
			$store_VoucherCount = $this->ZtModel->store_VoucherCount(array('voucher_t_id'=>'3','voucher_owner_id'=>intval($member_id)));
			if($store_VoucherCount > 0){
				exit(json_encode(array('state'=>false,'msg'=>'-2')));
			}
			$this->ZtModel->store_exchangeVoucher(3,$member_id);
			$this->ZtModel->store_exchangeVoucher(3,$member_id);
			exit(json_encode(array('state'=>false,'msg'=>'1')));
		}elseif($val == 3){//二十元代金卷
			//检查用户是否已经领取过代金卷
			$store_VoucherCount = $this->ZtModel->store_VoucherCount(array('voucher_t_id'=>'4','voucher_owner_id'=>intval($member_id)));
			if($store_VoucherCount > 0){
				exit(json_encode(array('state'=>false,'msg'=>'-2')));
			}
			$this->ZtModel->store_exchangeVoucher(4,$member_id);
			$this->ZtModel->store_exchangeVoucher(4,$member_id);
			exit(json_encode(array('state'=>false,'msg'=>'1')));
		}elseif($val == 2){//五十元代金卷
			//检查用户是否已经领取过代金卷
			$store_VoucherCount = $this->ZtModel->store_VoucherCount(array('voucher_t_id'=>'5','voucher_owner_id'=>intval($member_id)));
			if($store_VoucherCount > 0){
				exit(json_encode(array('state'=>false,'msg'=>'-2')));
			}
			$this->ZtModel->store_exchangeVoucher(5,$member_id);
			$this->ZtModel->store_exchangeVoucher(5,$member_id);
			exit(json_encode(array('state'=>false,'msg'=>'1')));
		}elseif($val == 4){//一百元代金卷
			//检查用户是否已经领取过代金卷
			$store_VoucherCount = $this->ZtModel->store_VoucherCount(array('voucher_t_id'=>'6','voucher_owner_id'=>intval($member_id)));
			if($store_VoucherCount > 0){
				exit(json_encode(array('state'=>false,'msg'=>'-2')));
			}
			$this->ZtModel->store_exchangeVoucher(6,$member_id);
			$this->ZtModel->store_exchangeVoucher(6,$member_id);
			exit(json_encode(array('state'=>false,'msg'=>'1')));
		}elseif($val == 5){
			$goodsid_array = array('15900'=>'0');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,'','518免费领取');
			if($return_error['error']){
				exit(json_encode(array('state'=>false,'msg'=>'-2')));
			}
			//领取实物
			exit(json_encode(array('state'=>false,'msg'=>'1')));
		}else{//全部领取
			$array = array(3,4,5,6);
			$store_VoucherCount = $this->ZtModel->store_VoucherCount(array('voucher_t_id'=>array('in',$array),'voucher_owner_id'=>intval($member_id)));
			$goodsid_array = array('15900'=>'0');
			$where_member_from['member_id'] = $member_id;
			$where_member_from['member_exppoints'] = array('egt',0);
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,'','518免费领取');

			if($store_VoucherCount > 0 && $return_error['error']){
				exit(json_encode(array('state'=>false,'msg'=>'-2')));
			}
			foreach($array as $k=>$v){
				$store_VoucherCount = $this->ZtModel->store_VoucherCount(array('voucher_t_id'=>$v,'voucher_owner_id'=>intval($member_id)));
				if($store_VoucherCount > 0){
					unset($array[$k]); // 排除已经领取过的优惠劵
				}else{
					$this->ZtModel->store_exchangeVoucher($v,$member_id);
					$this->ZtModel->store_exchangeVoucher($v,$member_id);
				}
			}
			if($return_error['error']){
				exit(json_encode(array('state'=>false,'msg'=>'-3')));
			}else{
				exit(json_encode(array('state'=>false,'msg'=>'1')));
			}
		}
	}
	//518专题 end

	/**
	 * 杜 免费领取
	 */
	public function ad_20160511Op(){
		showWapMessage('活动已结束','index.php','error');
exit;
		if($_GET['action'] == 'yanzhengone'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$code = $_POST['code'];
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code){
				$result['error'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '免费送十国钞('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$result['msg'] = '注册成功';
				$model_member->createSession($member_info,true);
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}else{
			$goodsid_array = array('15898'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%免费送十国钞%');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error'] == '您不符合领取资格') Tpl::output('is_lin','1');
			Tpl::output('member_id',intval($_SESSION['member_id']));
			Tpl::output('html_title',"收藏天下注册有礼，免费送十国钞。");
			Tpl::output('seo_keywords',"注册有礼,免费领取,十国钞,免费送十国钞");
			Tpl::output('seo_description',"收藏天下注册有礼再次来袭，注册就免费送十国钞，带册装帧更豪华，存世流传有心意。立刻注册，立刻免费领取十国钞，自己珍藏、送人礼物，均是极棒的选择。来收藏天下，免费好礼免费拿！");
			Tpl::output('no_footer',true);
			Tpl::showpage('20160511/index_show');
		}
	}

	/**
     * 幸总的 里约奥运专题手机版 du 20160504_2
     */
    public function ad_20160504_2Op(){
		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '里约奥运专题5('.$M.')';
			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_20160504_2'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
			echo json_encode($result); 
			exit();
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_keywords',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_description',"里约2016奥运纪念币 官方发售");
			Tpl::showpage('20160504_2/index_show');
		}
	}
	

	/**
     * 尹祥宾的 里约奥运专题手机版 du 20160504
     */
    public function ad_20160504_1Op(){
		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '里约奥运专题4('.$M.')';
			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_20160504_1'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
			echo json_encode($result); 
			exit();
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_keywords',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_description',"里约2016奥运纪念币 官方发售");
			Tpl::showpage('20160504_1/index_show');
		}
	}
	
	/**
     * 尹祥宾的 里约奥运专题手机版 du 20160504
     */
    public function ad_20160504Op(){
		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '里约奥运专题3('.$M.')';
			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_20160504'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
			echo json_encode($result); 
			exit();
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_keywords',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_description',"里约2016奥运纪念币 官方发售");
			Tpl::showpage('20160504/index_show');
		}
	}

	/**
     * 幸总的 里约奥运专题手机版 du 20160429
     */
    public function ad_20160429Op(){
		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '里约奥运专题2('.$M.')';
			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_20160429'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
			echo json_encode($result); 
			exit();
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_keywords',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_description',"里约2016奥运纪念币 官方发售");
			Tpl::showpage('20160429/index_show');
		}
	}
	

	/**
     * 里约奥运专题手机版 du 20160422
     */
    public function ad_20160422Op(){

showWapMessage('活动已结束','index.php','error');

		if($_GET['action'] == 'Linqu' && $_POST){
			//验证表单信息
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["true_name"],"require"=>"true","message"=>"姓名不能为空"),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			//新用户注册
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['true_name'];
			//$register_info['password'] = rand(100000,999999); //生成随机密码
			//$register_info['password_confirm'] = $register_info['password'] ;
			$register_info['mobile'] = $_POST['mob_phone'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '里约奥运专题('.$M.')';

			$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
			//将数据写入crm存放
			@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_20160422'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
			echo json_encode($result); 
			exit();

			//$member_info = $model_member->register($register_info);
//			if(!isset($member_info['error'])) {
//				$sms = new Sms();
//				$sms->send($_POST["mob_phone"],"恭喜您成为收藏天下的会员您的密码是：".$register_info['password']);
//				//注册成功执行订购
//				$model_member->createSession($member_info,true);
//				$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
//				//将数据写入crm存放
//				@file_get_contents(CRM_SITE_URL."/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&A_AdFrom=20160422(m)'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=1');
//				echo json_encode($result); 
//				exit();
//			
//			}else{
//				if($member_info['error'] == '手机号已存在' || $member_info['error'] == '用户名已存在'){
//					$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
//					//将数据写入crm存放
//					@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&A_AdFrom=20160422(m)'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
//					echo json_encode($result); 
//					exit();
//				}else{
//					$result['msg'] = $member_info['error'];
//					echo json_encode($result); 
//					exit();
//				}
//			}
//		
	
		}else{
			Tpl::output('no_header',true);
			Tpl::output('no_footer',true);
			Tpl::output('html_title',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_keywords',"里约2016奥运纪念币 官方发售");
			Tpl::output('seo_description',"里约2016奥运纪念币 官方发售");
			Tpl::showpage('20160422/index_show');
		}
	}
	
	/**
     * 抢钱包活动 du 20160415
     */
    public function ad_20160415Op(){
		
		$JiHui = 3;
		//获取当前会员所有拆红包记录
		$ChaiCount = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160415','member_id'=>intval($_SESSION['member_id'])));
		$JiHui = intval($JiHui-$ChaiCount); //检查会员剩余拆红包次数
        if($_GET['action'] == 'caihongbao'){
			$member_id = intval($_SESSION['member_id']);
				//用户未登录
			if($member_id <= 0){
				echo '-1';
			}else{
				//执行用户拆红包
				$result['JiangHtml'] = $this->JiangHtml($JiHui);
				$ChaiCount = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160415','member_id'=>intval($member_id)));
				$result['JiHui'] = intval(3-$ChaiCount) <= 0 ? 0 : intval(3-$ChaiCount);
				echo json_encode($result); 
				exit();
			}
			exit;
        }elseif($_GET['action'] == 'yanzhengone'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$code = $_POST['code'];
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code){
				$result['error'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '微信抢钱包活动('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$result['msg'] = '注册成功';
				$model_member->createSession($member_info,true);
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}elseif($_GET['action'] == 'MyLotteryList'){ // 加载获奖列表
			//获取当前会员所有拆中的奖项
			$MyLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160415','member_id'=>intval($_SESSION['member_id'])),"*",'5','l_id desc');
			Tpl::output('MyLotteryList',$MyLotteryList);
			Tpl::showpage('20160415/MyLotteryList','null_layout');
		}elseif($_GET['action'] == 'Linqu'){
			//活动全部领取    --- 获取当前会员所有未领取奖项
			$MyLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160415','member_id'=>intval($_SESSION['member_id']),'is_fafang'=>'0'),"*",'5','l_id ASC');
			$goodsid_array = array();
			$lid = array();
			if($MyLotteryList){
				foreach($MyLotteryList as $k=>$v){
					$goodsid_array[$v['goods_id']] = 0;
					$lid[] = $v['id'];
				}
			}else{
				$result['state'] = false;
				$result['msg'] = '您暂时没有奖品可领取~';
				echo json_encode($result); 
				exit();
			}
			$goods_amount = '0'; //商品总额
			$shipping_fee = '9.9'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"微信抢钱包活动",'微信抢钱包活动(M)',true,$lid);
		}elseif($_GET['action'] == 'is_lingqu'){
			//检查会员是否关注公众号
			$weixin = new weixinSDK();
	    	$token = $weixin->token;
	    	$openid = $_SESSION['openid'];
			$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$openid&lang=zh_CN";
	        $weixin_result = json_decode(file_get_contents($url),true);
			$model_member	= Model('member');
			//$member_info = $model_member->getMemberInfo(array('member_id'=>intval($_SESSION['member_id'])),'is_open');
			$member_info['is_open'] = 1;
			if($weixin_result['subscribe'] == 1){
				//检查用户是否有未领取商品
				$MyLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160415','member_id'=>intval($_SESSION['member_id']),'is_fafang'=>'0'),"*",'5','l_id ASC');
				$goodsid_array = array();
				$lid = array();
				if($MyLotteryList){
					echo 1;
				}else{
					$result = '您暂时没有奖品可领取~';
					echo json_encode($result); 
				}
			}else{
				echo -1;
			}
			exit();
		}elseif($_GET['action'] == 'fenxiang'){
			//记录分享到朋友圈
			if(intval($_SESSION['member_id']) > 0){
				$model = Model('member');
				$model->query("UPDATE shop_member SET share_num =  share_num+1 WHERE  member_id =".intval($_SESSION['member_id'])." ");
			}
			
		}elseif($_GET['action'] == 'url_admin'){
				//登录检查验证
				if($_POST){
					$user=$_POST["username"];
					$pws=$_POST["password"];
					if($user == "杜飞" && $pws =="df123123"){
					   setcookie("DfZtAdmin", "1");
					   header("location:index.php?act=zhuanti&op=ad_20160415&action=url_admin");
					}else{
						echo "<script>window.alert('登录失败返回重新登录');window.location.href='index.php?act=zhuanti&op=ad_20160415&action=url_admin';</script>";
						exit;
					}
				}else{
					if(empty($_COOKIE["DfZtAdmin"])) {
						Tpl::showpage('20160415/admin/login','null_layout');
					}else{
						$member_sat = ($_GET['Start_time'] == '') ? '1459440000' : strtotime($_GET['Start_time']);
						$member_end = ($_GET['End_time'] == '') ? time() : strtotime($_GET['End_time']);
						//统计活动规定时间累注册的会员  以及订单总额和订单数量等
						$from ='微信抢钱包活动(m)';
						$model = Model('member');
						$members = $model->query("select member_id from shop_member WHERE member_from = '".$from."' and member_time >= ".$member_sat." AND member_time <= ".$member_end);

						$order_info = $model->query("select sum(order_amount) as order_amount,count(order_id) as num from shop_order where buyer_id in(select member_id from shop_member WHERE member_from = '".$from."' and member_time >= ".$member_sat." AND member_time <= ".$member_end.") AND add_time >= ".$member_sat." AND add_time <= ".$member_end."");

						$order_payd = $model->query("select sum(order_amount) as order_amount,count(order_id) as num from shop_order where order_state > 10 AND buyer_id in(select member_id from shop_member WHERE member_from = '".$from."' and member_time >= ".$member_sat." AND member_time <= ".$member_end.") AND add_time >= ".$member_sat." AND add_time <= ".$member_end."");

						$str = date("Y-m-d",$member_sat).' 至 '.date("Y-m-d",$member_end).'&nbsp;注册的会员数量为：'.count($members).'&nbsp;订单总额：'.$order_info[0]['order_amount'].'&nbsp;订单总数：'.intval($order_info[0]['num']).'&nbsp;已支付订单总额：'.$order_payd[0]['order_amount'].'&nbsp;已支付订单总数：'.intval($order_payd[0]['num']);
						Tpl::output('str',$str);

						//统计活动 所有订单总额和订单数量等

						$hdorder_info = $model->query("select sum(order_amount) as order_amount,count(order_id) as num from shop_order where order_id in(select orderid from shop_yw_info WHERE referer = '微信抢钱包活动') AND add_time >= ".$member_sat." AND add_time <= ".$member_end."");

						$hdorder_payd = $model->query("select sum(order_amount) as order_amount,count(order_id) as num from shop_order where order_state > 10 AND order_id in(select orderid from shop_yw_info WHERE referer = '微信抢钱包活动') AND add_time >= ".$member_sat." AND add_time <= ".$member_end."");

						$hd_str = date("Y-m-d",$member_sat).' 至 '.date("Y-m-d",$member_end).'&nbsp;活动总计：订单总额：'.$hdorder_info[0]['order_amount'].'&nbsp;订单总数：'.intval($hdorder_info[0]['num']).'&nbsp;总计已支付订单总额：'.$hdorder_payd[0]['order_amount'].'&nbsp;已支付订单总数：'.intval($hdorder_payd[0]['num']);
						Tpl::output('hd_str',$hd_str);


						//获得所有会员中奖记录
						$SuoYouLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160415','add_time'=>array('elt',$member_end),'add_time'=>array('egt',$member_sat)),'*,(SELECT member_name FROM shop_member WHERE `shop_member`.member_id = `shop_lottery_member`.member_id) as member_name','20','is_fafang ASC,id desc');
						Tpl::output('show_page',$this->ZtModel->showpage());
						Tpl::output('List',$SuoYouLotteryList);
						//总共抽奖次数
						$ZongCount = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160415','add_time'=>array('elt',$member_end),'add_time'=>array('egt',$member_sat)));
						Tpl::output('ZongCount',$ZongCount);
						//参与会员总数
						$model = Model('member');
						$ZongMember = $model->query("SELECT count(*) as count FROM shop_lottery_member where ad_name = '20160415' AND add_time >= ".$member_sat." AND add_time <= ".$member_end." group by member_id");
						Tpl::output('ZongMember',count($ZongMember));
						//新会员参与数
						$xinhuiyuanchanyu = $model->query("SELECT count(*) as count FROM shop_lottery_member where ad_name = '20160415' AND add_time >= ".$member_sat." AND add_time <= ".$member_end." AND member_id in(select member_id from shop_member WHERE member_from = '".$from."' and member_time >= ".$member_sat." AND member_time <= ".$member_end.")  group by member_id");
						Tpl::output('xinhuiyuanchanyu',count($xinhuiyuanchanyu));
						//分享2次的会员
						$FenXiangLiangCount = $model->query("SELECT count(*) as count FROM shop_lottery_member where ad_name = '20160415' AND add_time >= ".$member_sat." AND add_time <= ".$member_end." AND l_id > 2 group by member_id");
						Tpl::output('FenXiangLiangCount',count($FenXiangLiangCount));

						//分享一次的会员
						$FenXiangCount = $model->query("SELECT count(*) as count FROM shop_lottery_member where ad_name = '20160415' AND add_time >= ".$member_sat." AND add_time <= ".$member_end." AND  l_id = 2 group by member_id");
						Tpl::output('FenXiangCount',count($FenXiangCount)-count($FenXiangLiangCount));
						
						//获取当前中奖项的总数量
						//周边十国10张钞票 中奖数量
						$ZhouBian = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160415','add_time'=>array('elt',$member_end),'add_time'=>array('egt',$member_sat),'l_id'=>1));
						//克罗地亚10万纸币 中奖数量
						$KeLuoDiya = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160415','add_time'=>array('elt',$member_end),'add_time'=>array('egt',$member_sat),'l_id'=>2));
						//十元代金卷 中奖数量
						$ShiYuanDai = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160415','add_time'=>array('elt',$member_end),'add_time'=>array('egt',$member_sat),'l_id'=>3));
						$JiangHtml =	date("Y-m-d",$member_sat).' 至 '.date("Y-m-d",$member_end).'&nbsp;周边十国10张钞票，中奖数量：'.$ZhouBian.'&nbsp;克罗地亚10万纸币，中奖数量：'.$KeLuoDiya.'&nbsp;十元代金卷，中奖数量：'.$ShiYuanDai;
						Tpl::output('JiangHtml',$JiangHtml);

						//获取三个奖品的订单数量
						//周边十国10张钞票 订单数量
						$ZhouBianorder_info = $model->query("select sum(order_amount) as order_amount,count(order_id) as num from shop_order where order_id in(select orderid from shop_yw_info WHERE referer = '微信抢钱包活动') AND order_id in(select order_id from shop_order_goods WHERE goods_id = '15898') AND add_time >= ".$member_sat." AND add_time <= ".$member_end."");

						$LuoDiYaorder_info = $model->query("select sum(order_amount) as order_amount,count(order_id) as num from shop_order where order_id in(select orderid from shop_yw_info WHERE referer = '微信抢钱包活动') AND order_id in(select order_id from shop_order_goods WHERE goods_id = '15900') AND add_time >= ".$member_sat." AND add_time <= ".$member_end."");
						
						$DaiJinJuanrder_info = $model->query("select count(voucher_id) as num from shop_voucher where voucher_t_id = 197 AND voucher_state = 2");
						
						$sssssJiangHtml =	date("Y-m-d",$member_sat).' 至 '.date("Y-m-d",$member_end).'&nbsp;周边十国10张钞票，订单数量：'.$ZhouBianorder_info[0]['num'].'&nbsp;金额：'.$ZhouBianorder_info[0]['order_amount'].'&nbsp;克罗地亚10万纸币，订单数量：'.$LuoDiYaorder_info[0]['num'].'&nbsp;金额：'.$LuoDiYaorder_info[0]['order_amount'].'&nbsp;已用十元代金卷，数量：'.$DaiJinJuanrder_info[0]['num'];
						Tpl::output('sssssJiangHtml',$sssssJiangHtml);
						Tpl::showpage('20160415/admin/adminindex','null_layout');
					}
				}
				
		}else{
			//检查用户是否在微信浏览器打开
			if(strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') !== false ) {
	
				if(intval($_SESSION['member_id']) > 0){
					//获取当前会员所有拆中的奖项
					$MyLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160415','member_id'=>intval($_SESSION['member_id'])),"*",'5','l_id desc');
					Tpl::output('MyLotteryList',$MyLotteryList);
				}
				Tpl::output('no_header',true);
				Tpl::output('no_footer',true);
				Tpl::output('html_title',"");
				Tpl::output('seo_keywords',"");
				Tpl::output('seo_description',"");
				Tpl::output('JiHui',$JiHui);
				Tpl::showpage('20160415/index_show');
						
			}else{
				echo("请在微信端打开");
				exit;
			}
        }
    }
	
	/**
     * 返回用户点击拆红包样式html
     */
	public function JiangHtml($type='1'){
		$html = '';
		$prize_arr = array();
		//获取会员的分享次数
		$model_member	= Model('member');
		$member_info = $model_member->getMemberInfo(array('member_id'=>intval($_SESSION['member_id'])),'share_num');

		if($type == 3){ //第一次拆红包
			$html = '<img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160415/images/c1.png" alt="">';
			$prize_arr = array(
				'1' => array('angle'=>0,'prize'=>'周边十国10张钞票','v'=>15898)
			);
			$rid = 1;
		}elseif($type == 2){ //第二次拆红包
			//第二次拆红包需要检查是否有分享
			if($member_info['share_num'] > 0){
				$html = '<img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160415/images/c2.png" alt="">';
				$prize_arr = array(
					'2' => array('angle'=>0,'prize'=>'克罗地亚10万纸币','v'=>15900)
				);
				$rid = 2;
			}else{
				$html = '<img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160415/images/t1.png" alt="" onclick="df_aa();">';
				
			}
		}elseif($type == 1){ //第三次拆红包 抽奖
		  if($member_info['share_num'] > 1){
				$html = '<img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160415/images/c3.png" alt="">';
				$prize_arr = array(
					'3' => array('angle'=>0,'prize'=>'十元代金卷','v'=>197)
				);
				$rid = 3;
			}else{
				$html = '<img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160415/images/t2.png" alt="" onclick="df_aa();">';
			}

//			$prize_arr = array(
//				'3' => array('angle'=>2000,'prize'=>'克罗地亚10万纸币','v'=>15900),
//				'4' => array('angle'=>8000,'prize'=>'很遗憾没有拆中','v'=>0),
//			);
//			foreach ($prize_arr as $key => $val) { 
//				$arr[$key] = $val['angle']; 
//			}
//			$rid = $this->getRand($arr); //根据概率获取奖项id 
//			if($rid == 3){
//				$html = '<h2>财运爆棚！满载而归！</h2><h4>克罗地亚10万纸币</h4><h5>马钞，马上有钞，吉祥钞</h5><div class="shop"><img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160415/images/pic003.jpg" alt=""></div><p>快去我的财富收钱吧</p>';
//			}else{
//				$html = '<h2>oh，很遗憾没有拆中</h2><h4></h4><h5></h5><p>快去【我的财富】领取现金吧</p>';
//			}
//		  }else{
//			  $html = '<h2>小编温馨提示</h2><h4></h4><h5></h5><p>分享到朋友圈1次，又可以拆1次钱包哦</p>';
//		  }
		}else{
			$html = '<img src="'.MOBILE_TEMPLATES_URL.'/zhuanti/20160415/images/t3.png" alt="" onclick="df_aa();">';
		}

		if($prize_arr){
			$res = $prize_arr[$rid]; //中奖项
			if($rid < 3){
				$data['goods_id'] = $res['v'];
			}
			if($rid == 3){
				//获得代金卷 发放代金卷
				$this->ZtModel->exchangeVoucher($res['v'],intval($_SESSION['member_id']));
				$is_fafang = 1;
			} 
			$data['member_id'] = intval($_SESSION['member_id']);
			$data['year'] = date('Y',time());
			$data['month'] = date('m',time());
			$data['day'] = date('d',time());
			$data['hour'] = date('H',time());
			$data['time'] = date('H:i:s',time());
			$data['add_time'] = time();
			$data['ip'] = $_SERVER['REMOTE_ADDR'];
			$data['ad_name'] = '20160415';
			$data['l_name'] = $res['prize'];
			$data['l_id'] = $rid;
			$data['is_fafang'] = $rid == 3 ? 1 : 0;
			$this->ZtModel->addLottery($data);
		}
		return $html;
	}


	/**
     * 招商 du 20160411
     * 重庆万达送福字活动
     */
    public function ad_20160411Op(){
        if($_GET['action'] == 'zuce'){
            $model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = rand(100000,999999);//随机生成6位的密码
			$register_info['password_confirm'] = $register_info['password'];
			$register_info['mobile'] = $_POST['mobile'];
			$register_info['member_from'] = '万达送福字活动';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$yw_info_get = file_get_contents(CRM_SITE_URL.'/index.php?m=api&p=action&c=cpregister&ID='.$member_info['member_id'].'&M='.$register_info['mobile'].'&N='.urlencode($member_info['member_name']));

				$sms = new Sms();
				$sms->send($_POST["mobile"],"您好,您的密码是：".$register_info['password']);

                if(intval($yw_info_get) > 0){
                    $result['msg'] = '您已经注册成功。';
                }else{
                    $result['error'] = '您已经注册成功，活动绑定失败，请联系工作人员帮忙处理！';
                }
				$model_member->createSession($member_info,true);
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}

        }else{
            //Tpl::output('no_header',true);
            ///Tpl::output('no_footer',true);
            Tpl::output('html_title',"");
            Tpl::output('seo_keywords',"");
            Tpl::output('seo_description',"");
            Tpl::showpage('20160411/index_show');
        }
    }


    /**
     * 招商  xin 20160405
     * 查看登记记录
     */
    public function ad_20160405Op(){
        if($_GET['action'] == 'dengji'){
            if(!empty($_POST['name']) && !empty($_POST['tel'])){
               
            	$model_member   = Model('member');

	            $register_info = array();
	            $register_info['username'] = $_POST['name'];
	            $register_info['password'] = $_POST['pass'];
	            $register_info['password_confirm'] = $_POST['rpass'];
	            $register_info['mobile'] = $_POST['tel'];
	            $register_info['member_from'] = '商家入驻m';

	            $member_info = $model_member->register($register_info);

	            if(!empty($member_info['error'])){

	            	$result['msg'] = $member_info['error'];
                	echo json_encode($result);

	            }else{

	            	/*信息存入session*/
	                $model_member->createSession($member_info);

	                // cookie中的cart存入数据库
	                Model('cart')->mergecart($member_info,$_SESSION['store_id']);

	                // cookie中的浏览记录存入数据库
	                Model('goods_browse')->mergebrowse($_SESSION['member_id'],$_SESSION['store_id']);
	            	
	            	$result['success'] = true;
                	echo json_encode($result);
	            }
            }else{
                $result['msg'] = '姓名或手机号不能为空';
                echo json_encode($result);
            }
            exit();

        }else{
            Tpl::output('no_header',true);
            Tpl::output('no_footer',true);
            Tpl::output('html_title',"收藏天下诚邀国内具有实力的收藏品、艺术品、文玩等商家入驻");
            Tpl::output('seo_keywords',"收藏天下,商家入驻");
            Tpl::output('seo_description',"收藏天下再次全新启航，我们诚邀国内具有实力的收藏品、艺术品、文玩等商家入驻收藏天下平台，让我们共同努力共同发展，树立中国文化艺术收藏平台标杆！");
            Tpl::showpage('20160405/index_show');
        }
    }

	/**
	 * 杜 免费领取
	 */
	public function ad_20160331Op(){
		if($_GET['action'] == 'yanzhengone'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$code = $_POST['code'];
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code){
				$result['error'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '免费送70周年纪念币('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$result['msg'] = '注册成功';
				$model_member->createSession($member_info,true);
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}else{
			$goodsid_array = array('10733'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%免费送70周年纪念币%');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error'] == '您不符合领取资格') Tpl::output('is_lin','1');
			Tpl::output('member_id',intval($_SESSION['member_id']));
			Tpl::output('FH_Index',"index");
			Tpl::output('html_title',"收藏天下注册有礼，免费送抗战胜利70周年纪念币。");
			Tpl::output('seo_keywords',"注册有礼,免费领取,抗战胜利纪念币,抗战70周年纪念币,抗战币,纪念币");
			Tpl::output('seo_description',"收藏天下注册有礼再次来袭，注册就免费送抗战胜利70周年纪念币，带册装帧更豪华，存世流传有心意。立刻注册，立刻免费领抗战胜利70周年纪念币，自己珍藏、送人礼物，均是极棒的选择。来收藏天下，免费好礼免费拿！");
			Tpl::showpage('20160331/index_show');
		}
	}


	/**
	 * 杜 免费领取
	 */
	public function ad_20160317Op(){
		if($_GET['action'] == 'linqu'){
			if($_POST['goods_id'] == '955'){
				$goodsid_array = array('15091'=>'186');
				$goods_amount = '186'; //商品总额
			}elseif($_POST['goods_id'] == '11735'){
				$goodsid_array = array('11735'=>'100');
				$goods_amount = '100'; //商品总额
			}else{
				$goodsid_array = array('15091'=>'186','11735'=>'100');
				$goods_amount = '286'; //商品总额
			}
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			if($where_member_from['member_id'] == 0) exit(json_encode(array('state'=>false,'msg'=>'-1')));
			$where_member_from['member_exppoints'] = array('egt',0);
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
			
			$shipping_fee = '20'; //运费
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'等值兑换(m)20160317');
		}elseif($_GET['action'] == 'is_login'){
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			if($where_member_from['member_id'] == 0) {
				exit(json_encode(array('state'=>false,'msg'=>'-1')));
			}else{
				exit(json_encode(array('state'=>true,'msg'=>'OK')));
			}
		}else{
			Tpl::output('html_title',"收藏天下等值兑换惊喜来袭！");
			Tpl::output('seo_keywords',"纪念钞等值兑换,第五套人民币,中国航天纪念钞,航天钞等值兑换,人民币同号钞等值兑换");
			Tpl::output('seo_description',"收藏天下等面值兑换惊喜再度来袭！100元普通钞兑换中国航天纪念钞，186元普通钞兑换第五套人民币后五同小全套。");
			Tpl::showpage('20160317/index_show');
		}
		

	}
	
	public function web_soocangOp(){
		$model_member	= Model('member');
		$obj_validate = new Validate();
		$obj_validate->validateparam = array(
			array("input"=>$_GET['n'],		"require"=>"true", "message"=>'用户名不能为空'),
			array("input"=>$_GET['p'],		"require"=>"true", "message"=>'密码不能为空'),
		);
		$error = $obj_validate->validate();
		if ($error != ''){
			exit();
		}
		$array = array();
		$array['member_name']	= $_GET['n'];
		$array['member_passwd']	= md5($_GET['p']);
		
		$member_info = $model_member->getMemberInfo($array);
		if(is_array($member_info) and !empty($member_info)) {
			if(!$member_info['member_state']){
				exit();
			}
		}else{
			process::addprocess('login');
			exit();
		}
		$model_member->createSession($member_info);
        redirect('http://m.96567.com/index.php?act=zhuanti&op=ad_20160316#soocangaddress');
	}
	/**
	 * 杜 免费领取
	 */
	public function ad_20160316Op(){
		if($_GET['action'] == 'yanzhengone'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password'];
			$register_info['mobile'] = $_POST['mobile'];
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '航天钞兑换UC('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$result['msg'] = '注册成功';
				$model_member->createSession($member_info,true);
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}else{
			$goodsid_array = array('11735'=>'100');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%航天钞兑换UC%');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error'] == '您不符合领取资格') Tpl::output('is_lin','1');
			Tpl::output('member_id',intval($_SESSION['member_id']));
			Tpl::output('html_title',"");
			Tpl::output('seo_keywords',"");
			Tpl::output('seo_description',"");
			Tpl::output('FH_Index',"index");
			Tpl::showpage('20160316/index_show');
		}
	}

	public function ad_20160316DuiHuanOp(){
		$goodsid_array = array('11735'=>'100');
		$where_member_from['member_id'] = intval($_SESSION['member_id']);
		$where_member_from['member_from'] = array('like','%航天钞兑换UC%');
		$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
		if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
		$goods_amount = '100'; //商品总额
		$shipping_fee = '20'; //运费
		$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'航天钞兑换UC','等值兑换(M)');
	}


	/**
	 * 杜 免费领取
	 */
	public function ad_20160314Op(){
		$zmr=intval($_GET['zmr']);
		if($zmr>0)
		{
		   setcookie('zmr', $zmr);
		}
		if($_GET['action'] == 'yanzhengone'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$code = $_POST['code'];
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code){
				$result['error'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$register_info['member_mobile_bind'] = 1;
			$M = $_POST['ua'] == '' ? 'm' : $_POST['ua'];
			$register_info['member_from'] = '免费送70周年纪念币('.$M.')';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$result['msg'] = '注册成功';
				$model_member->createSession($member_info,true);
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}else{
			$goodsid_array = array('10733'=>'0');
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			$where_member_from['member_from'] = array('like','%免费送70周年纪念币%');
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error'] == '您不符合领取资格') Tpl::output('is_lin','1');
			Tpl::output('member_id',intval($_SESSION['member_id']));
			Tpl::output('html_title',"收藏天下注册有礼，免费送抗战胜利70周年纪念币。");
			Tpl::output('seo_keywords',"注册有礼,免费领取,抗战胜利纪念币,抗战70周年纪念币,抗战币,纪念币");
			Tpl::output('seo_description',"收藏天下注册有礼再次来袭，注册就免费送抗战胜利70周年纪念币，带册装帧更豪华，存世流传有心意。立刻注册，立刻免费领抗战胜利70周年纪念币，自己珍藏、送人礼物，均是极棒的选择。来收藏天下，免费好礼免费拿！");
			Tpl::showpage('20160314/index_show');
		}
	}

	/**
	 * 杜 等值兑换活动 20160303
	 */
	public function ad_20160303Op(){
		//showMessage('您访问的活动已结束','index.php?act=zhuanti&op=ad_20160115','html','error');
		//exit();
		if($_GET['action'] == 'zhu_ce'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password'];
			$register_info['mobile'] = $_POST['mobile'];
			$register_info['member_from'] = '万达航天钞兑换';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
                $yw_info_get = file_get_contents(CRM_SITE_URL.'/index.php?m=api&p=action&c=cpregister&ID='.$member_info['member_id'].'&M='.$register_info['mobile'].'&N='.urlencode($member_info['member_name']));
                if(intval($yw_info_get) > 0){
                    $result['msg'] = '您已经注册成功，请联系艾美酒店-精品店内工作人员进行兑换！';
                }else{
                    $result['error'] = '您已经注册成功，活动绑定失败，请联系工作人员帮忙处理！';
                }

				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}else{
            Tpl::output('nav_title',"收藏天下");
			Tpl::output('html_title',"中国航天纪念钞等面值兑换-收藏天下");
			Tpl::showpage('20160303/index_show');
		}
	}

	/**
	 * 杜 迎新春
	 */
	public function ad_20160110Op(){
		if($_GET['action'] == 'chou_jiang'){
			//活动结束时间 01月31号
			if(time() >= 1454256000){
				$result['error'] = -4;
				echo json_encode($result);
				exit;
			}
			$member_id = intval($_SESSION['member_id']);
			//检查是否登录
			if($member_id <= 0){
				$result['error'] = -1;
				echo json_encode($result);
				exit;
			}
			//获得所有会员中奖记录
			$SuoYouLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160110','member_id'=>$member_id),'l_orderid');
			$order_idarray = array();
			if($SuoYouLotteryList){
				foreach($SuoYouLotteryList as $ok=>$ov){
					$order_idarray[] = $ov['l_orderid'];
				}
			}
			$order = $this->ZtModel->getOrder(array('buyer_id'=>$member_id,'order_state'=>array('egt',20),'add_time'=>array('elt','1454256000'),'add_time'=>array('egt','1453046400'),'order_amount'=>array('egt',2000),'order_id'=>array('not in',$order_idarray)),'order_id,order_amount');
			//抽奖次数用完
			if(count($order) <= 0){
				$result['error'] = -3;
				echo json_encode($result);
				exit;
			}
			$order_info = $order[0];

			$prize_arr = array(
				'0' => array('angle'=>335,'prize'=>'第三条人民币小全套后三同可用 500元代金卷','v'=>106,'type'=>'1',num=>'0'),
				'1' => array('angle'=>247,'prize'=>'中国金币2016猴年贺岁银条50克可用 50元代金卷','v'=>105,'type'=>'1',num=>'0'),
				'2' => array('angle'=>292,'prize'=>'中国航天纪念钞十连号可用 100元代金卷','v'=>107,'type'=>'1',num=>'0'),
				'3' => array('angle'=>157,'prize'=>'世界财富宝典珍藏册可用 500元代金卷','v'=>104,'type'=>'1',num=>'5'), 
				'4' => array('angle'=>114,'prize'=>'中国航天纪念币一钞一币','v'=>12352,'type'=>'2',num=>'10'),
				'5' => array('angle'=>203,'prize'=>'2016年贺岁银质纪念币','v'=>12384,'type'=>'2',num=>'5'),
				'6' => array('angle'=>65,'prize'=>'第三轮生肖邮票四方联大全套 无荧光防伪','v'=>3472,'type'=>'2',num=>'5'),
				'7' => array('angle'=>24,'prize'=>'传世十二生肖册之乙末羊年金条','v'=>8865,'type'=>'2',num=>'1')
			);
			
			$rid = 0;
			if(intval($order_info['order_amount']) >=2000 && intval($order_info['order_amount']) <= 4000){
				$rid = rand(0,3);
			}elseif(intval($order_info['order_amount']) >=4001 && intval($order_info['order_amount']) <= 8000){
				$rid = rand(0,4);
			}elseif(intval($order_info['order_amount']) >=8001 && intval($order_info['order_amount']) <= 15000){
				$rid = rand(0,5);
			}elseif(intval($order_info['order_amount']) >=15001 && intval($order_info['order_amount']) <= 80000){
				$rid = rand(0,6);
			}elseif(intval($order_info['order_amount']) >80000){
				$rid = rand(4,7);
			}else{
				$result['error'] = -3;
				echo json_encode($result);
				exit;
			}
			$DangTianShiWu = $this->ZtModel->getLotteryCount(array('ad_name'=>'20160110','l_id'=>array('in'=>$rid)));
			$res = $prize_arr[$rid]; //中奖项 
			//判断实物奖品是否发放完成
			if($res['type'] == 2){
				//如果实物奖品发放完则赠送优惠劵
				if(intval($res['num']-$DangTianShiWu) <= 0){
					$rid = rand(0,3);
				}
			}
			$res = $prize_arr[$rid]; //重新获取中奖项
			if($res['type'] == 1){//判断优惠劵是否发放完
				if($res['num'] > 0){
					if(intval($res['num']-$DangTianShiWu) <= 0){
						$rid = rand(0,2);
					}
				}
			}
			$res = $prize_arr[$rid]; //重新获取中奖项
			$is_fafang = 0;
			if($res['type'] == 2){
				//获得实物奖品
			}elseif($res['type'] == 1){
				//获得代金卷 发放代金卷
				$this->ZtModel->exchangeVoucher($res['v'],intval($_SESSION['member_id']));
				$is_fafang = 1;
			}
			$data['member_id'] = $member_id;
			$data['year'] = date('Y',time());
			$data['month'] = date('m',time());
			$data['day'] = date('d',time());
			$data['hour'] = date('H',time());
			$data['time'] = date('H:i:s',time());
			$data['add_time'] = time();
			$data['ip'] = $_SERVER['REMOTE_ADDR'];
			$data['ad_name'] = '20160110';
			$data['l_name'] = $res['prize'];
			$data['l_id'] = $rid;
			$data['l_orderid'] = $order_info['order_id'];
			$data['is_fafang'] = $is_fafang;
			$this->ZtModel->addLottery($data);
			echo json_encode($res); 
			exit();
		}elseif($_GET['action'] == 'post_ajax'){
				$dataArr['name'] = $_POST['name']; //姓名
				$dataArr['mobile'] = $_POST['mobile'];//电话
				$dataArr['l_id'] = intval($_POST['l_id']);//奖品编号
				$dataArr['member_id'] = intval($_SESSION['member_id']);//领奖会员id
				$dataArr['member_name'] = $_SESSION['member_name'];//领奖会员名称
				$dataArr['ad_name'] = '20160110';//领奖会员名称
				if($dataArr['l_id'] <= 0){
					echo '-3';
					exit;
				}
				//检测会员是否登录
				if($dataArr['member_id'] <= 0){
					echo '-1';
					exit;
				}
				//检查该信息是否领取过
				$LQCount = $this->ZtModel->LinQuCount(array('l_id'=>$dataArr['l_id']));
				if($LQCount > 0){
					echo '-2';
					exit;
				}
				$this->ZtModel->insertLinQu($dataArr);
				//修改领奖状态
				$this->ZtModel->upLotteryReceive(array('is_fafang'=>'1'),array('id'=>$dataArr['l_id']));
				echo '1';
				exit;
		}else{
			Tpl::output('html_title',"收藏天下感恩大回馈，好礼0元送，金条免费抽-收藏天下");
			//获得当前会员中奖记录
			$MyLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160110','member_id'=>$_SESSION['member_id']));
			Tpl::output('MyLotteryList',$MyLotteryList);
			//获得所有会员中奖记录
			$SuoYouLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160110'));
			Tpl::output('SuoYouLotteryList',$SuoYouLotteryList);
			Tpl::output('nav_title',"好礼0元送，金条免费抽");
			Tpl::showpage('20160110/index_show');
		}
	}

    public function ad_20160115Op(){
        if($_GET['action'] == 'zhu_ce'){
            $model_member	= Model('member');
            $register_info = array();
            $register_info['username'] = $_POST['user_name'];
            $register_info['password'] = $_POST['password'];
            $register_info['password_confirm'] = $_POST['password'];
            $register_info['mobile'] = $_POST['mobile'];
            $register_info['member_from'] = '2016猴币兑换(m)';
            $member_info = $model_member->register($register_info);
            if(!isset($member_info['error'])) {
                $result['msg'] = '您已经兑换成功，活动结束后将统一发货，请耐心等待。如有疑问请咨询在线客服或拔打400-81-96567';
                echo json_encode($result);
                exit();
            }else{
                $result['error'] = $member_info['error'];
                echo json_encode($result);
                exit();
            }
        }else{
            Tpl::output('nav_title',"2016生肖猴币兑换");
            Tpl::output('html_title',"2016年猴年生肖纪念币等值兑换 - 收藏天下");
            Tpl::showpage('20160115/index_show');
        }
    }



    /*Add is name lt 2016-02-24 微信注册发红包专题*/
    public function getHongbaoOp(){

    	showWapMessage('活动已结束','index.php','error');
		exit;

    	file_put_contents('weixin_log.txt',date("Y-m-d H:i:s",time())."====",FILE_APPEND);


    	Tpl::output('nav_title',"注册领红包");
        Tpl::output('html_title',"注册领红包 - 收藏天下");


        if($_SESSION['openid']){
        	$user_info = Model()->table('member_hong_kl')->where(array('K_OpenId'=>$_SESSION['openid']))->find();
        	Tpl::output('user_info',$user_info);

			$hong_info = Model()->table('member_hong_set')->where(array('S_OpenId'=>$_SESSION['openid']))->find();
        	Tpl::output('hong_info',$hong_info);
        }

        Tpl::output('no_header',true);
    	Tpl::output('no_footer',true);
        Tpl::showpage('weixin/index_show');
    }


    /*Add is name lt 2016-02-24 注册*/
    public function doRegisterOp(){
    	exit;
    	$model_member	= Model('member');
        $register_info = array();
        $register_info['username'] = $_POST['user_name'];
        $register_info['password'] = $_POST['password'];
        $register_info['password_confirm'] = $_POST['upassword'];
        $register_info['mobile'] = $_POST['mobile'];
        $register_info['openid'] = $_SESSION['openid'];
        $register_info['member_from'] = '微信注册发红包';

        if(empty($_SESSION['openid'])){
        	$result['error'] = '请在微信上打开该专题领取红包！';
            echo json_encode($result);
            exit();
        }

        if($_POST['Yzm'] != $_SESSION['wx_phone_yzm'][$_POST['mobile']]){
        	$result['error'] = '验证码不正确、请重新获取！';
            echo json_encode($result);
            exit();
        }

        if($_POST['mobile'] != $_SESSION['wx_phone']){
        	$result['error'] = '验证码获取手机号和注册手机号不匹配~!';
            echo json_encode($result);
            exit();
        }


        $member_info = $model_member->register($register_info);

        if(!isset($member_info['error'])) {

        	$dataArr['K_MemberId'] = $member_info['member_id'];
        	$dataArr['K_MemberName'] = $member_info['member_name'];
        	$dataArr['K_OpenId'] = $member_info['openid'];
        	$dataArr['K_KouLing'] = $this->create_noncestr(8);
        	$dataArr['K_Time'] = time();
        	if(Model()->table('member_hong_kl')->insert($dataArr)){
        		$result['msg'] = '注册成功';
        		$result['K_MemberName'] = $dataArr['K_MemberName'];
        		$result['K_KouLing'] = $dataArr['K_KouLing'];
	            echo json_encode($result);
	            exit();
        	}
            exit();
        }else{
            $result['error'] = $member_info['error'];
            echo json_encode($result);
            exit();
        }
    }


    /*Add is name lt 2016-02-25 领取红包*/
    public function shouHongbaoOp(){
					//$result['error'] = '活动结束';
		            //echo json_encode($result);
		            //exit();


    	// $dataArr['K_MemberId'] = $_SESSION['member_id'];
    	$dataArr['K_OpenId'] = $_SESSION['openid'];
    	$dataArr['K_KouLing'] = trim($_POST['kl']);

    	// 注册验证
		$obj_validate = new Validate();
		$obj_validate->validateparam = array(
		// array("input"=>$dataArr["K_MemberId"],"require"=>"true","message"=>'请确认是否在微信打开该界面！'),
		array("input"=>$dataArr["K_OpenId"],"require"=>"true","message"=>'请确认是否在微信打开该界面！'),
		array("input"=>$dataArr["K_KouLing"],"require"=>"true","message"=>'红包口令不能为空'),

		);

		$error = $obj_validate->validate();
		if ($error != ''){
			$result['error'] = $error;
            echo json_encode($result);
            exit();
		}

		//为没有OpenId的红包口令添加OpenId

		$user_oepnid = Model()->table('member_hong_kl')->where(array('K_KouLing'=>$dataArr['K_KouLing']))->find();

		if(!empty($user_oepnid) && !empty($user_oepnid['K_Id']) && empty($user_oepnid['K_OpenId'])){
			Model()->table('member_hong_kl')->where(array('K_Id'=>$user_oepnid['K_Id']))->update(array('K_OpenId'=>$dataArr['K_OpenId']));
		}

		$user_info = Model()->table('member_hong_kl')->where($dataArr)->find();


		if(!empty($user_info)){
			//检测是否关注公众号
			$weixin = new weixinSDK();

	    	$token = $weixin->token;

	    	$openid = $dataArr['K_OpenId'];

			$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$openid&lang=zh_CN";

	        $weixin_result = json_decode(file_get_contents($url),true);


	        if(!empty($weixin_result['errcode'])){
                file_put_contents($weixin->path.'tuqtxs1392719300token.txt','');
                file_put_contents($weixin->path.'tuqtxs1392719300token_time.txt','');

                $result['error'] = '数据异常、请重新领取！';
	            echo json_encode($result);
	            exit();
            }


	        if($weixin_result['subscribe'] != '1'){
	        	$result['error'] = '请扫描页面下方二维码后领取红包！';
	            echo json_encode($result);
	            exit();
	        }


			//检测是否发送过红包
			$hong['S_OpenId'] = $dataArr['K_OpenId'];
			$hongbao_info = Model()->table('member_hong_set')->where($hong)->find();

			if(!empty($hongbao_info)){
				$result['error'] = '已领取过红包！';
	            echo json_encode($result);
	            exit();
			}else{
			//发送红包
				$money = mt_rand('101','110');
				$set_hongbao['S_MemberId'] = $user_info['K_MemberId'];
				$set_hongbao['S_OpenId'] = $dataArr['K_OpenId'];
				$set_hongbao['S_KouLing'] = $dataArr['K_KouLing'];
				$set_hongbao['S_Money'] = $money/100;
				$set_hongbao['S_Time'] = time();
				$resultObj = $this->hongBao($dataArr['K_OpenId'],$money);

// file_put_contents('resultObj.txt',print_r($resultObj,true),FILE_APPEND);

				if($resultObj->return_msg == '发放成功'){
				Model()->table('member_hong_set')->insert($set_hongbao);
					$result['msg'] = '领取成功';
		            echo json_encode($result);
		            exit();
				}elseif($resultObj->return_msg == '帐号余额不足，请到商户平台充值后再重试'){
					$result['error'] = '今日红包发放结束,请明日10:00领取！';
		            echo json_encode($result);
		            exit();
				}else{
					$result['error'] = '发送失败、重新领取！';
		            echo json_encode($result);
		            exit();
				}
			}
		}else{
			$result['error'] = '该口令没有对应红包信息！';
            echo json_encode($result);
            exit();
		}

    }


        /*Add is name lt 2016-12-09 获取手机验证码*/
    public function pushPhoneYzmOp(){
		
    	if(empty($_POST["mobile"])){
    		$result['error'] = '该手机号格式不正确！';
            echo json_encode($result);
            exit();
    	}

    	if(strlen($_POST['mobile']) != 11){
            $result['error'] = '该手机号格式不正确！';
            echo json_encode($result);
            exit();
    	}

    	$sms = new Sms();

    	$_SESSION['wx_phone_yzm'][$_POST["mobile"]] = mt_rand('1111','9999');

    	$_SESSION['wx_phone'] = $_POST["mobile"];

        $result = $sms->send($_POST["mobile"],"您好,您的验证码是：".$_SESSION['wx_phone_yzm'][$_POST["mobile"]]);

        echo json_encode($result);

        exit();

    }

    /*Add is name lt 2016-02-26 获取手机验证码*/
    public function getPhoneYzmOp(){
		
		if(empty($_POST["name"])){
			$result['error'] = '用户名格式不正确！';
    		exit;
    	}
    	if(empty($_POST["mobile"])){
    		$result['error'] = '该手机号格式不正确！';
            echo json_encode($result);
            exit();
    	}
		$member_name = Model()->table('member')->where(array('member_name'=>$_POST["name"]))->find();
		if(!empty($member_name)){
    		$result['error'] = '用户名已存在请修改！';
            echo json_encode($result);
            exit();
    	}

    	$name['member_mobile'] = JiaMiMobile($_POST['mobile']);

    	if(strlen($_POST['mobile']) != 11){
            $result['error'] = '该手机号格式不正确！';
            echo json_encode($result);
            exit();
    	}

    	$user_info = Model()->table('member')->field('member_mobile')->where($name)->find();

    	if(!empty($user_info)){
    		$result['error'] = '该手机号已注册！';
            echo json_encode($result);
            exit();
    	}

    	$sms = new Sms();

    	$_SESSION['wx_phone_yzm'][$_POST["mobile"]] = mt_rand('1111','9999');

    	$_SESSION['wx_phone'] = $_POST["mobile"];

        $result = $sms->send($_POST["mobile"],"您好,您的验证码是：".$_SESSION['wx_phone_yzm'][$_POST["mobile"]]);

        echo json_encode($result);

        exit();

    }





	/*给用户发送红包*/
	private function hongBao($openid,$money){
		//定义一个红包数组
		$parameters = array();
		//随机字符串
		$parameters['nonce_str'] = $this->create_noncestr();//随机生成32位
		//订单号
		$parameters['mch_billno'] = '1226270402'.time().mt_rand(10000000,99999999);//发放订单号
		//商户号
		$parameters['mch_id'] = '1226270402';
		//公众账号appid
		$parameters['wxappid'] = 'wx00d52d21505f383f';
		//提供方名称
		$parameters['nick_name'] = "收藏天下";
		//商户名称
		$parameters['send_name'] = "收藏天下";
		//用户openid
		$parameters['re_openid'] = $openid;
		//付款金额
		$parameters['total_amount'] = $money;//单位分
		//最小红包金额
		$parameters['min_value'] = $money;//单位分
		//最大红包金额
		$parameters['max_value'] = $money;//单位分
		//红包发放总人数
		$parameters['total_num'] = '1';
		//红包祝福语
		$parameters['wishing'] = "欢迎参加注册送红包活动！";
		//Ip地址
		$parameters['client_ip'] = $_SERVER['SERVER_ADDR'];
		//活动名称
		$parameters['act_name'] = '注册送红包！';
		//备注
		$parameters['remark'] = "告诉你的朋友一起来抢红包吧！";

		$unSignParaString=$this->formQueryParaMap($parameters,false);

        $parameters['sign']=$this->sign($unSignParaString,'shengwei520soucang96567key1987sw');

        ksort($parameters);
        $postXml=$this->arrayToXml($parameters);
        $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';

        $responseXml=$this->curl_post_ssl($url,$postXml);

        $responseObj = simplexml_load_string($responseXml, 'SimpleXMLElement', LIBXML_NOCDATA);

        return $responseObj;
	}

	//生成随机字符串,不长于32位
    public function create_noncestr($length=32)
    {
       	$chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
		$str ="";
		for ( $i = 0; $i < $length; $i++ )  {  
			$str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
		}  
		return $str; 
    }

	//将参数按字典序排序，使用URL键值对的格式拼接成字符串
    public function formQueryParaMap($paraMap,$urlencode)
    {
        $buff="";
        ksort($paraMap);
        foreach($paraMap as $k=>$v){
            if($v!=null && $v!="null" && $k!="sign"){
                if($urlencode){
                    $v=urlencode($v);
                }
                $buff.=$k."=".$v."&";
            }
        }
        $reqPar = '';
        if(strlen($buff)>0){
            $reqPar=substr($buff,0,strlen($buff)-1);
        }
        return $reqPar;
    }

    //生成签名
    public function sign($content,$key)
    {
        $signStr=$content."&key=".$key;
        return strtoupper(md5($signStr));
    }
    //验证签名的方法
    public function verifySignature($content,$sign,$md5Key)
    {
        $signStr=$content."&key".$md5Key;
        $calculateSign = strtolower(md5($signStr));
		$tenpaySign = strtolower($sign);
        return $calculateSign == $tenpaySign;    
    }
    public function curl_post_ssl($url, $vars, $second=30,$aHeader=array())
	{
		$ch = curl_init();
		//超时时间
		curl_setopt($ch,CURLOPT_TIMEOUT,$second);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
		//这里设置代理，如果有的话
		//curl_setopt($ch,CURLOPT_PROXY, '10.206.30.98');
		//curl_setopt($ch,CURLOPT_PROXYPORT, 8080);
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
		curl_setopt($ch,CURLOPT_SSL_VERIFYHOST,false);
		
		//以下两种方式需选择一种
		//第一种方法，cert 与 key 分别属于两个.pem文件
		curl_setopt($ch,CURLOPT_SSLCERT,getcwd() . '/paykey/apiclient_cert.pem');
 		curl_setopt($ch,CURLOPT_SSLKEY,getcwd() . '/paykey/apiclient_key.pem');
 		curl_setopt($ch,CURLOPT_CAINFO,getcwd() . '/paykey/rootca.pem');
		
		//第二种方式，两个文件合成一个.pem文件
		//curl_setopt($ch,CURLOPT_SSLCERT,getcwd().'/all.pem');
	 
		if( count($aHeader) >= 1 ){
			curl_setopt($ch, CURLOPT_HTTPHEADER, $aHeader);
		}
	 
		curl_setopt($ch,CURLOPT_POST, 1);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$vars);
		$data = curl_exec($ch);
		if($data){
			curl_close($ch);
			return $data;
		}
		else { 
			$error = curl_errno($ch);
			//echo "call faild, errorCode:$error\n"; 
			curl_close($ch);
			return false;
		}
	}

	//数组转xml
    public function arrayToXml($arr)
    {
        $xml="<xml>";
        foreach($arr as $key=>$val){
            if(is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";
        return $xml;
    }

    //去除空白字符串
    public function trimString($value)
    {
        $ret=null;
        if($value!=null){
            $ret=$value;
            if(strlen($ret)==0){
                $ret=null;
            }
        }
        return $ret;
    }




    public function testNameOp(){
    	$name['member_name'] = $_POST['user_name'];

    	if(strlen($_POST['user_name']) < 6){
            exit();
    	}

    	$user_info = Model()->table('member')->field('member_name')->where($name)->find();

    	if(!empty($user_info)){
    		$result['error'] = '该帐号已注册！';
            echo json_encode($result);
            exit();
    	}
    }

    public function testPhoneOp(){
    	$name['member_mobile'] = JiaMiMobile($_POST['mobile']);

    	if(strlen($_POST['mobile']) != 11){
            exit();
    	}

    	$user_info = Model()->table('member')->field('member_mobile')->where($name)->find();

    	if(!empty($user_info)){
    		$result['error'] = '该手机号已注册！';
            echo json_encode($result);
            exit();
    	}
    }



	public function LingQuOp(){
		$goodsid_array = array('10733'=>'0');
		$where_member_from['member_id'] = intval($_SESSION['member_id']);
		$where_member_from['member_from'] = array('like','%免费送70周年纪念币%');
		$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
		if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
		$goods_amount = '0'; //商品总额
		$shipping_fee = '7'; //运费
		$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"免费送70周年纪念币",'免费领取(M)');
	}

	public function addAddressOrder($POST,$goodsid_array,$goods_amount=0,$shipping_fee=0,$referer='',$lai_yuan='',$other=false,$lid,$payment_code='online',$goodsnumber=1,$is_ywinfo=1){
		$model_addr = Model('address');
		//验证表单信息
		$obj_validate = new Validate();
		$obj_validate->validateparam = array(
			array("input"=>$POST["true_name"],"require"=>"true","message"=>"请填写收货人姓名"),
			array("input"=>$POST["area_id"],"require"=>"true","validator"=>"Number","message"=>"请选择所在地区"),
			array("input"=>$POST["address"],"require"=>"true","message"=>"请填写收货人详细地址"),
			array("input"=>$POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
		);
		$error = $obj_validate->validate();
		if ($error != ''){
			$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
			exit(json_encode(array('state'=>false,'msg'=>$error)));
		}
		$data = array();
		$data['member_id'] = $_SESSION['member_id'];
		$data['true_name'] = $POST['true_name'];
		$data['area_id'] = intval($POST['area_id']);
		$data['city_id'] = intval($POST['city_id']);
		$data['area_info'] = $POST['area_info'];
		$data['address'] = $POST['address'];
		$data['tel_phone'] = $POST['mob_phone'];
		$data['mob_phone'] = $POST['mob_phone'];
		$data = strtoupper(CHARSET) == 'GBK' ? Language::getGBK($data) : $data;
		$insert_id = $model_addr->addAddress($data);
		if ($insert_id){
			$data['prov'] = intval($POST['prov']);
			//收货地址添加成功执行添加订单
			
			$order = $this->ZtModel->add_order($data,$goodsid_array,$goods_amount,$shipping_fee,$referer,$lai_yuan,$other,$lid,$payment_code,2,$goodsnumber,$is_ywinfo);
			if($order['error']){
				exit(json_encode(array('state'=>false,'msg'=>$order['error'])));
			}else{
				exit(json_encode(array('state'=>true,'addr_id'=>$insert_id,'pay_sn'=>$order['pay_sn'])));
			}
		}else {
			exit(json_encode(array('state'=>false,'msg'=>"请填写真实的收获地址")));
		}
	}
	//用户登陆
	public function loginOp(){
		$obj_validate = new Validate();
		$obj_validate->validateparam = array(
			array("input"=>$_POST['user_name'],		"require"=>"true", "message"=>'用户名不能为空'),
			array("input"=>$_POST['password'],		"require"=>"true", "message"=>'密码不能为空'),
		);
		$error = $obj_validate->validate();
		if ($error != ''){
			$result['error'] = $error;
			echo json_encode($result);
			exit();
		}
		//登陆类型
		if(preg_match("/1[34578]{1}\d{9}$/",$_POST['user_name'])){
			$logintype='mobile';
		}else{
			$logintype='username';
		}
		$salt_where	= array();
		if($logintype == 'mobile'){
			$salt_where['member_mobile'] = $_POST['user_name'];
		}else{
			$salt_where['member_name'] = $_POST['user_name'];
		}
		$model_member	= Model('member');
		$is_salt = $model_member->getMemberInfo($salt_where,'ec_salt');
		$array	= array();
		if($logintype == 'mobile'){
			$array['member_mobile']	= $_POST['user_name'];
		}else{
			$array['member_name']	= $_POST['user_name'];
		}
		if($is_salt['ec_salt'] != 0 || !empty($is_salt['ec_salt'])){
			$array['member_passwd']	= md5(md5($_POST['password']).$is_salt['ec_salt']);
		}else{
			$array['member_passwd']	= md5($_POST['password']);
		}
		$member_info = $model_member->getMemberInfo($array);
		//会员存在，如果有openid存入，删除其他会员openid
		if($_SESSION['openid'] != '' && $member_info['openid'] != $_SESSION['openid']){
			$model_member->editMember(array('openid'=>$_SESSION['openid']),array('openid'=>''));
			$model_member->editMember(array('member_id'=>$member_info['member_id']),array('openid'=>$_SESSION['openid']));
		}
		if(is_array($member_info) and !empty($member_info)) {
			if(!$member_info['member_state']){
				$result['error'] = '账号被停用';
				echo json_encode($result);
				exit();
			}
		}else{
			process::addprocess('login');
			$result['error'] = '用户名或密码错误';
			echo json_encode($result);
			exit();
		}
		$model_member->createSession($member_info);
		// cookie中的cart存入数据库
		Model('cart')->mergecart($member_info,$_SESSION['store_id']);

		// cookie中的浏览记录存入数据库
		Model('goods_browse')->mergebrowse($_SESSION['member_id'],$_SESSION['store_id']);

		$result['state'] = 'OK';
		echo json_encode($result);
		exit();
    }

	private function getRand($proArr) { 
		$result = ''; 
		//概率数组的总概率精度 
		$proSum = array_sum($proArr);
		//概率数组循环 
		foreach ($proArr as $key => $proCur) { 
			$randNum = mt_rand(1, $proSum); 
			if ($randNum <= $proCur) { 
				$result = $key; 
				break; 
			} else { 
				$proSum -= $proCur; 
			} 
		} 
		unset ($proArr); 
		return $result; 
	}

	/**
     * 地区列表
     */
    public function area_listOp() {
        $area_id = intval($_POST['area_id']);

        $model_area = Model('area');

        $condition = array();
        if($area_id > 0) {
            $condition['area_parent_id'] = $area_id;
        } else {
            $condition['area_deep'] = 1;
        }
        $area_list = $model_area->getAreaList($condition, 'area_id,area_name');
        output_data(array('area_list' => $area_list));
    }

	//导出exl
public function DaoChu_Export($filename){
		header("Content-type: application/vnd.ms-excel; charset=utf-8");
		header("Content-Disposition: attachment; filename=$filename.xls");
		echo '<html xmlns:o="urn:schemas-microsoft-com:office:office"
		xmlns:x="urn:schemas-microsoft-com:office:excel"
		xmlns="http://www.w3.org/TR/REC-html40">
		<head>
		<meta http-equiv="expires" content="Mon, 06 Jan 1999 00:00:01 GMT">
		<meta http-equiv=Content-Type content="text/html; charset=utf-8">
		<!--[if gte mso 9]><xml>
		<x:ExcelWorkbook>
		<x:ExcelWorksheets>
		<x:ExcelWorksheet>
		<x:Name></x:Name>
		<x:WorksheetOptions>
		<x:DisplayGridlines/>
		</x:WorksheetOptions>
		</x:ExcelWorksheet>
		</x:ExcelWorksheets>
		</x:ExcelWorkbook>
		</xml><![endif]-->

		</head>';
}
	/********微信授权***********/
	private function getAuthority($ad_name='',$openid_this='') { 
		if(empty($ad_name) || empty($openid_this)){
			return false;
		}
		$weixin = new weixinSDK();
		$token = $weixin->token;
		$url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=".$openid_this."&lang=zh_CN";
		$weixin_result = json_decode(file_get_contents($url),true);
		
		if($weixin_result['subscribe'] == '1'){
			//数据存入数据库
			$member_weixin_info = Model('weixin_info')->getOneMemberWeixinInfo($openid_this);
		
			if(empty($member_weixin_info)){
				$dataArr['W_MemberId'] = $_SESSION['member_id'];
				$dataArr['W_MemberName'] = $_SESSION['member_name'];
				$dataArr['W_Openid'] = $openid_this;
				$dataArr['W_Nickname'] = $weixin_result['nickname'];
				$dataArr['W_Sex'] = $weixin_result['sex'];
				$dataArr['W_City'] = $weixin_result['city'];
				$dataArr['W_Province'] = $weixin_result['province'];
				$dataArr['W_Country'] = $weixin_result['country'];
				$dataArr['W_Headimgurl'] = urlencode($weixin_result['headimgurl']);
				$dataArr['W_Subscribe_time'] = $weixin_result['subscribe_time'];
				$dataArr['W_Addtime'] = time();
				$dataArr['ad_name'] = $ad_name;
				Model('weixin_info')->addOneMemberWeixinInfo($dataArr);
			}
			$url = urlWap('zhuanti',$ad_name);
			header("location:$url");
		}else{
			//授权获取微信用户数据
			$url =  urlWap('zhuanti',$ad_name,array('action'=>'user_info'));
			$token = $weixin->oauth($url);
		}
	}

	/**
	 * 接收微信用户信息
	 */
	private function getAuthorityUserInfo($ad_name='',$openid_this=''){
		$weixin = new weixinSDK();
		$member_weixin_info = $weixin->getOauthUserInfo(trim($_GET['code']));
		$member_weixin_info_is = Model('weixin_info')->getOneMemberWeixinInfo($openid_this);
		if(empty($member_weixin_info_is)){
			// 存入数据库
			$dataArr['W_MemberId'] = $_SESSION['member_id'];
			$dataArr['W_MemberName'] = $_SESSION['member_name'];
			$dataArr['W_Openid'] = $openid_this;
			$dataArr['W_Nickname'] = $member_weixin_info['nickname'];
			$dataArr['W_Sex'] = $member_weixin_info['sex'];
			$dataArr['W_City'] = $member_weixin_info['city'];
			$dataArr['W_Province'] = $member_weixin_info['province'];
			$dataArr['W_Country'] = $member_weixin_info['country'];
			$dataArr['W_Headimgurl'] = urlencode($member_weixin_info['headimgurl']);
			$dataArr['W_Subscribe_time'] = $member_weixin_info['subscribe_time']?$member_weixin_info['subscribe_time']:time();
			$dataArr['W_Addtime'] = time();
			$dataArr['ad_name'] = $ad_name;
			Model('weixin_info')->addOneMemberWeixinInfo($dataArr);
		}

		$url = urlWap('zhuanti',$ad_name);
		header("location:$url");
	}

	private function getJiangXiang($order_info){
		//第一档中奖奖品
			if($order_info['order_amount'] < 70){
				$prize_arr = array(
					'3' => array(
						'id'=>4,'angles'=>234,'prize'=>'谢谢惠顾','v'=>0,'type'=>'3','rand'=>'50','num'=>5
					),
					'8' => array(
						'id'=>9,'angles'=>54,'prize'=>'谢谢惠顾','v'=>0,'type'=>'3','rand'=>'50','num'=>5
					)
				);
			}
			if($order_info['order_amount'] >= 70 && $order_info['order_amount'] <= 500){
				$prize_arr = array(
					'1' => array(
						'id'=>2,'angles'=>306,'prize'=>'5元无门槛代金券','v'=>8,'type'=>'1','rand'=>'10','num'=>5
					),
					'3' => array(
						'id'=>4,'angles'=>234,'prize'=>'谢谢惠顾','v'=>0,'type'=>'3','rand'=>'40','num'=>5
					),
					'7' => array(
						'id'=>8,'angles'=>90,'prize'=>'5元无门槛代金券','v'=>8,'type'=>'1','rand'=>'10','num'=>5
					),
					'8' => array(
						'id'=>9,'angles'=>54,'prize'=>'谢谢惠顾','v'=>0,'type'=>'3','rand'=>'40','num'=>5
					)
				);
			}
			if($order_info['order_amount'] >= 501 && $order_info['order_amount'] <= 1000){
				$prize_arr = array(
					'1' => array(
						'id'=>2,'angles'=>306,'prize'=>'5元无门槛代金券','v'=>8,'type'=>'1','rand'=>'17','num'=>5
					),
					'3' => array(
						'id'=>4,'angles'=>234,'prize'=>'谢谢惠顾','v'=>0,'type'=>'3','rand'=>'25','num'=>5
					),
					'4' => array(
						'id'=>5,'angles'=>198,'prize'=>'5元无门槛代金券','v'=>8,'type'=>'1','rand'=>'17','num'=>5
					),
					'7' => array(
						'id'=>8,'angles'=>90,'prize'=>'5元无门槛代金券','v'=>8,'type'=>'1','rand'=>'16','num'=>5
					),
					'8' => array(
						'id'=>9,'angles'=>54,'prize'=>'谢谢惠顾','v'=>0,'type'=>'3','rand'=>'25','num'=>5
					)
				);
			}
			
			if($order_info['order_amount'] >= 1001 && $order_info['order_amount'] <= 3000){
				$prize_arr = array(
					'1' => array(
						'id'=>2,'angles'=>306,'prize'=>'5元无门槛代金券','v'=>8,'type'=>'1','rand'=>'17','num'=>5
					),
					'3' => array(
						'id'=>4,'angles'=>234,'prize'=>'谢谢惠顾','v'=>0,'type'=>'3','rand'=>'20','num'=>5
					),
					'4' => array(
						'id'=>5,'angles'=>198,'prize'=>'5元无门槛代金券','v'=>8,'type'=>'1','rand'=>'17','num'=>5
					),
					'5' => array(
						'id'=>6,'angles'=>162,'prize'=>'2014年索契冬季奥运会纪念钞','v'=>5109,'type'=>'2','rand'=>'5','num'=>5
					),
					'7' => array(
						'id'=>8,'angles'=>90,'prize'=>'5元无门槛代金券','v'=>8,'type'=>'1','rand'=>'16','num'=>5
					),
					'8' => array(
						'id'=>9,'angles'=>54,'prize'=>'谢谢惠顾','v'=>0,'type'=>'3','rand'=>'20','num'=>5
					),
					'9' => array(
						'id'=>10,'angles'=>18,'prize'=>'2014年索契冬季奥运会纪念钞','v'=>5109,'type'=>'2','rand'=>'5','num'=>5
					)
				);
			}
			
			if($order_info['order_amount'] >= 3001 && $order_info['order_amount'] <= 6000){
				$prize_arr = array(
					'1' => array(
						'id'=>2,'angles'=>306,'prize'=>'5元无门槛代金券','v'=>8,'type'=>'1','rand'=>'17','num'=>5
					),
					'3' => array(
						'id'=>4,'angles'=>234,'prize'=>'谢谢惠顾','v'=>0,'type'=>'3','rand'=>'5','num'=>5
					),
					'4' => array(
						'id'=>5,'angles'=>198,'prize'=>'5元无门槛代金券','v'=>8,'type'=>'1','rand'=>'17','num'=>5
					),
					'5' => array(
						'id'=>6,'angles'=>162,'prize'=>'2014年索契冬季奥运会纪念钞','v'=>5109,'type'=>'2','rand'=>'20','num'=>5
					),
					'7' => array(
						'id'=>8,'angles'=>90,'prize'=>'5元无门槛代金券','v'=>8,'type'=>'1','rand'=>'16','num'=>5
					),
					'8' => array(
						'id'=>9,'angles'=>54,'prize'=>'谢谢惠顾','v'=>0,'type'=>'3','rand'=>'5','num'=>5
					),
					'9' => array(
						'id'=>10,'angles'=>18,'prize'=>'2014年索契冬季奥运会纪念钞','v'=>5109,'type'=>'2','rand'=>'20','num'=>5
					)
				);
			}

			if($order_info['order_amount'] >= 6001 && $order_info['order_amount'] <= 15000){
				$prize_arr = array(
					'1' => array(
						'id'=>2,'angles'=>306,'prize'=>'5元无门槛代金券','v'=>8,'type'=>'1','rand'=>'3','num'=>5
					),
					'2' => array(
						'id'=>3,'angles'=>270,'prize'=>'2014年索契冬季奥运会纪念钞','v'=>5109,'type'=>'2','rand'=>'30','num'=>5
					),
					'4' => array(
						'id'=>5,'angles'=>198,'prize'=>'5元无门槛代金券','v'=>8,'type'=>'1','rand'=>'3','num'=>5
					),
					'5' => array(
						'id'=>6,'angles'=>162,'prize'=>'2014年索契冬季奥运会纪念钞','v'=>5109,'type'=>'2','rand'=>'30','num'=>5
					),
					'7' => array(
						'id'=>8,'angles'=>90,'prize'=>'5元无门槛代金券','v'=>8,'type'=>'1','rand'=>'4','num'=>5
					),
					'9' => array(
						'id'=>10,'angles'=>18,'prize'=>'2014年索契冬季奥运会纪念钞','v'=>5109,'type'=>'2','rand'=>'30','num'=>5
					)
				);
			}

			
			if($order_info['order_amount'] >= 15001 && $order_info['order_amount'] <= 30000){
				$prize_arr = array(
					'0' => array(
						'id'=>1,'angles'=>342,'prize'=>'香港奥运纪念钞','v'=>775,'type'=>'2','rand'=>'10','num'=>5
					),
					'2' => array(
						'id'=>3,'angles'=>270,'prize'=>'2014年索契冬季奥运会纪念钞','v'=>5109,'type'=>'2','rand'=>'20','num'=>5
					),
					'3' => array(
						'id'=>4,'angles'=>234,'prize'=>'谢谢惠顾','v'=>0,'type'=>'3','rand'=>'10','num'=>5
					),
					'5' => array(
						'id'=>6,'angles'=>162,'prize'=>'2014年索契冬季奥运会纪念钞','v'=>5109,'type'=>'2','rand'=>'20','num'=>5
					),
					'6' => array(
						'id'=>7,'angles'=>126,'prize'=>'香港奥运纪念钞','v'=>775,'type'=>'2','rand'=>'10','num'=>5
					),
					'8' => array(
						'id'=>9,'angles'=>54,'prize'=>'谢谢惠顾','v'=>0,'type'=>'3','rand'=>'10','num'=>5
					),
					'9' => array(
						'id'=>10,'angles'=>18,'prize'=>'2014年索契冬季奥运会纪念钞','v'=>5109,'type'=>'2','rand'=>'20','num'=>5
					)
				);
			}

			if($order_info['order_amount'] >= 30001 && $order_info['order_amount'] <= 50000){
				$prize_arr = array(
					'0' => array(
						'id'=>1,'angles'=>342,'prize'=>'香港奥运纪念钞','v'=>775,'type'=>'2','rand'=>'15','num'=>5
					),
					'2' => array(
						'id'=>3,'angles'=>270,'prize'=>'2014年索契冬季奥运会纪念钞','v'=>5109,'type'=>'2','rand'=>'20','num'=>5
					),
					'3' => array(
						'id'=>4,'angles'=>234,'prize'=>'谢谢惠顾','v'=>0,'type'=>'3','rand'=>'5','num'=>5
					),
					'5' => array(
						'id'=>6,'angles'=>162,'prize'=>'2014年索契冬季奥运会纪念钞','v'=>5109,'type'=>'2','rand'=>'20','num'=>5
					),
					'6' => array(
						'id'=>7,'angles'=>126,'prize'=>'香港奥运纪念钞','v'=>775,'type'=>'2','rand'=>'15','num'=>5
					),
					'8' => array(
						'id'=>9,'angles'=>54,'prize'=>'谢谢惠顾','v'=>0,'type'=>'3','rand'=>'5','num'=>5
					),
					'9' => array(
						'id'=>10,'angles'=>18,'prize'=>'2014年索契冬季奥运会纪念钞','v'=>5109,'type'=>'2','rand'=>'20','num'=>5
					)
				);
			}
			if($order_info['order_amount'] >= 50001){
				$prize_arr = array(
					'0' => array(
						'id'=>1,'angles'=>342,'prize'=>'香港奥运纪念钞','v'=>775,'type'=>'2','rand'=>'30','num'=>5
					),
					'2' => array(
						'id'=>3,'angles'=>270,'prize'=>'2014年索契冬季奥运会纪念钞','v'=>5109,'type'=>'2','rand'=>'14','num'=>5
					),
					'5' => array(
						'id'=>6,'angles'=>162,'prize'=>'2014年索契冬季奥运会纪念钞','v'=>5109,'type'=>'2','rand'=>'13','num'=>5
					),
					'6' => array(
						'id'=>7,'angles'=>126,'prize'=>'香港奥运纪念钞','v'=>775,'type'=>'2','rand'=>'30','num'=>5
					),
					'9' => array(
						'id'=>10,'angles'=>18,'prize'=>'2014年索契冬季奥运会纪念钞','v'=>5109,'type'=>'2','rand'=>'13','num'=>5
					)
				);
			}
			return $prize_arr;
	}




	    /*Add is name lt 2016-08-24 获取手机验证码One*/
    public function getOnePhoneYzmOp(){

    	if(empty($_POST["mobile"])){
    		exit;
    	}

    	if(strlen($_POST['mobile']) != 11){
            $result['state'] = false;
            $result['msg'] = '该手机号格式不正确！';
            echo json_encode($result);
            exit();
    	}

		if(!preg_match("/1\d{10}$/",$_POST['mobile'])){
			$result['state'] = false;
            $result['msg'] = '该手机号格式不正确！';
            echo json_encode($result);
            exit();
		}

		if($_SESSION['push_yzm']+60 > time()){
			$result['state'] = false;
            $result['msg'] = '刚已获取过验证码、请稍候再获取！';
            echo json_encode($result);
            exit();
    	}


    	$sms = new Sms();

    	$_SESSION['push_phone_yzm'] = mt_rand('1111','9999');

    	$_SESSION['push_phone'] = $_POST["mobile"];

        $result = $sms->send($_POST["mobile"],$_SESSION['push_phone_yzm']);

        echo json_encode($result);

        $_SESSION['push_yzm'] = time();

        exit();
    }
	
	private function IsOrderYanZeng($value=array(),$goods_id=0){
	   if(time() > $value['Hd_time']){
			$result['error'] =  '活动已结束';
			echo json_encode($result); 
			exit();
		}
		//验证用户是否有资格领取
		if(intval($_SESSION['member_id']) <= 0){ //检查是否登陆
				echo '-1';
				exit;
		}
		$order_sn = $_POST['order_sn'];
		//检查订单号是否为空
		if($order_sn == ''){
			$result['error'] =  '订单号不能为空';
			echo json_encode($result); 
			exit();
		}
		$maxorderamount = $value['maxorderamount'];//设置最低领奖金额
		//检查订单号是否符合要求
		$where = array();
		$where['buyer_id'] = intval($_SESSION['member_id']);
		$where['order_state'] = array('egt',20);
		$where['add_time'] = array('egt',$value['add_time']);
		$where['order_amount'] = array('egt',$maxorderamount);
		$where['order_sn'] = $order_sn;
		$order = $this->ZtModel->getOrder($where,'order_id,order_amount,order_sn,payment_code,order_state,(select order_status from shop_yw_info where orderid = order_id) as order_status,(select shipping_status from shop_yw_info where orderid = order_id) as shipping_status,(select pay_status from shop_yw_info where orderid = order_id) as pay_status');
		$ad_name = $value['ad_name'];
		if(count($order) > 0){
			$order_info = $order[0];
			//检查是否是货到付款订单
			if($order_info['payment_code'] == 'offline'){
				//如果是检查是否已完成
				if($order_info['order_state'] < 40){
					$result['error'] =  '对不起，您不满足领取资格！';
					echo json_encode($result); 
					exit();
				}
			}
			//检查订单号是否已经领取过
			$count_Lot = $this->ZtModel->getLotteryCount(array('ad_name'=>$ad_name,'member_id'=>intval($_SESSION['member_id']),'l_orderid'=>$order_info['order_id'],'is_fafang'=>1));
			if($count_Lot > 0){
				$result['error'] =  '对不起，一个订单号只能领取一次！';
				echo json_encode($result); 
				exit();
			}else{
				$count_Lot = $this->ZtModel->getLotteryList(array('ad_name'=>$ad_name,'member_id'=>intval($_SESSION['member_id']),'l_orderid'=>$order_info['order_id']));
				$data = array();
				$data['member_id'] = intval($_SESSION['member_id']);
				$data['year'] = date('Y',time());
				$data['month'] = date('m',time());
				$data['day'] = date('d',time());
				$data['hour'] = date('H',time());
				$data['time'] = date('H:i:s',time());
				$data['add_time'] = time();
				$data['ip'] = $_SERVER['REMOTE_ADDR'];
				$data['ad_name'] = $ad_name;
				$data['l_name'] = $value['ad_log'];
				$data['l_id'] = 0;
				$data['l_orderid'] = $order_info['order_id'];
				$data['is_fafang'] = 0;
				if($goods_id == 0 && count($count_Lot) == 0){
					return $this->ZtModel->addLottery($data);
				}else{
					if($goods_id == 0){
						return $count_Lot[0]['id'];
					}
					$data['goods_id'] = $goods_id;
					$this->ZtModel->upLotteryReceive($data,array('id'=>$count_Lot[0]['id']));
					 //添加订单日志
					$data = array();
					$data['order_id'] = $order_info['order_id'];
					$data['log_role'] = '买家';
					$data['log_user'] = $_SESSION['memebr_name'];
					$data['order_status'] = intval($order_info['order_status']);
					$data['shipping_status'] = intval($order_info['shipping_status']);
					$data['pay_status'] = intval($order_info['pay_status']);
					$data['log_msg'] = $value['order_log'];
					$data['log_orderstate'] = $order_info['order_state'];
					Model('order')->addOrderLog($data);  
				}
				
			}

		}else{
			$result['error'] =  '对不起，您不满足领取资格！';
			echo json_encode($result); 
			exit();
		}
	}

}
