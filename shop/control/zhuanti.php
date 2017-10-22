<?php
/**
 * 专题类
 *
 *
 *
 ***/


defined('InShopNC') or exit('Access Invalid!');

class zhuantiControl extends BaseHomeControl {
	private $ZtModel;
	public function __construct() {

        parent::__construct ();
        $this->ZtModel = Model('zhuanti');
    }
    /**
	 * 默认页面
	 */
	public function indexOp(){
		// $this->ad_20160903p();
		showMessage('您访问的活动不存在','http://www.96567.com/index.php','html','error');
	}
	

	/**
	 * 宝莱阁活动专题
	 * Add is name lt 2016-12-09
	 */
	public function ad_20161212Op(){
		Tpl::output('html_title','收藏天下新疆和田玉特惠专场,低至6折！全场包邮！');
		Tpl::output('seo_keywords','和田玉,新疆和田玉,和田玉挂件,和田玉平安扣,和田玉吊坠，宝莱阁和田玉,收藏天下');
		Tpl::output('seo_description','收藏天下推荐，宝莱阁和田玉籽料挂件玉中之王，限时特惠，低至6折！全场包邮！');
		Tpl::showpage('zhuanti/20161212/index_show');
	}

	/**
	 * 书画禅茶活动专题
	 * Add is name lt 2016-12-09
	 */
	public function ad_20161209Op(){
		Tpl::output('YiShu',true);
		Tpl::output('html_title','收藏天下书画馆精品专题—茶文化');
		Tpl::output('seo_keywords','书画馆，茶文化，禅茶一味，正品收藏，精品推荐，书画');
		Tpl::output('seo_description','茶里乾坤，禅中意境。禅茶一味品人生百态。');
		Tpl::showpage('zhuanti/20161209/index_show');
	}

	/**
	 * 乌克兰油画专题活动
	 * Add is name lt 2016-12-08
	 */
	public function ad_20161208Op(){

		// 删除缓存、更新后执行
		// dkcache('zhuanti_20161208_pc');

		// 读出缓存
		$data = rkcache('zhuanti_20161208_pc');

		if(empty($data)){
			$model_goods = Model('goods');
			// 阿斯塔普-卡瓦尔丘克
			$goods_id_list = '42308,42314,42315,42318,42320,42325,42327,42431,42437,42334,42339,42434';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_marketprice,goods_image';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_1'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 安纳托利-佐尔科
			$goods_id_list = '41815,42135,41791,41792,41813,41793,41818,41807,41811,41808,41805,41816';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_marketprice,goods_image';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_2'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 奥列斯-瓦西里维齐-索罗维
			$goods_id_list = '42151,42157,42162,42166,42168,42172,42176,42216,42223';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_marketprice,goods_image';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_3'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 亚历山大-赫巴拉乔夫
			$goods_id_list = '42197,42206,42152,42160,42210,42175,42221,42300,42389,42387,42310,42364';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_marketprice,goods_image';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_4'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 叶甫盖尼-毕斯库诺夫
			$goods_id_list = '42003,42106,42001,42082,42038,42053,42070,41987,42072,42095,41978,42104';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_marketprice,goods_image';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_5'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);
			// 写入缓存、时效一小时
			wkcache('zhuanti_20161208_pc',$data,3600);
		}
		
		Tpl::output('YiShu',true);
		Tpl::output('html_title','乌克兰艺术大师精品油画');
		Tpl::output('seo_keywords','油画,乌克兰,财富,收藏,投资,中央美院,理财,阿斯塔普·卡瓦尔丘克,瓦西里·古林,安德烈·戚培根,亚历山大·赫拉巴乔夫,奥列斯·瓦西里维齐·索罗维,安纳托利·佐尔科, 叶甫盖尼·毕斯库诺夫,安德烈·雅朗斯基');
		Tpl::output('seo_description','中乌建交25周年,乌克兰中央美院大师油画盛典震撼开启！国际顶尖艺术家油画作品,低于国际市场价惠民发售,财富盛宴,邀您共享！');
		Tpl::output('goods_list',$data['goods_list']);
		Tpl::showpage('zhuanti/20161208/index_show');
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
			$goods_id_list = '913,17551,14830,27974,12351,33975,1307,33169';
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
		Tpl::showpage('zhuanti/20161205/index_show');
	}

	/**
	 * 翡翠奇缘专题
	 * Add is name lt 2016-11-30 
	 */
	public function ad_20161201Op(){
		Tpl::output('html_title','收藏天下翡翠玉石联合专场，低至19元！“玉”见就不要错过！');
		Tpl::output('seo_keywords','翡翠,玉石,玉佛,玉牌,翡翠吊坠,翡翠手镯,翡翠戒指,收藏天下');
		Tpl::output('seo_description','收藏天下翡翠玉石特价专场，限时特惠低至19元！全场包邮！');
		Tpl::showpage('zhuanti/20161201/index_show');
	}

	/**
	 * 踏雪专题
	 * Add is name lt 2016-11-30 
	 */
	public function ad_20161130Op(){
		Tpl::output('YiShu',true);
		Tpl::output('html_title','冬季书画专场');
		Tpl::output('seo_keywords','书画，冬季，雪，梅花，书法，限量抢购，书画馆');
		Tpl::output('seo_description','寒梅素雪，冬季活动专场，寒冬小馆送温暖，收藏天下书画馆名家真迹限量抢购！');
		Tpl::showpage('zhuanti/20161130/index_show');
	}

	/**
	 * 商家双十一专题
	 * Add is name lt 2016-11-11 
	 */
	public function ad_20161111Op(){
		Tpl::output('html_title','评级币特价保真专场，低至3折！');
		Tpl::output('seo_keywords','钱币,银元,古币,评级币,只有一个评级币,收藏天下');
		Tpl::output('seo_description','收藏天下评级币特惠专场，全场购买任一评级币送2016猴币一枚，特价保真，对假币说“不”，低至3折！全场包邮！');
		Tpl::showpage('zhuanti/20161111/index_show');
	}

	/**
	 * 书画双十一专题
	 * Add is name lt 2016-11-11 
	 */
	public function ad_20161111_1Op(){
		Tpl::output('YiShu',true);
		Tpl::output('html_title','11.11艺术范儿，名家真迹低至2折！99元秒臻品字画！- 收藏天下书画馆');
		Tpl::output('seo_keywords','名家字画,书法字画,书画,国画,山水画,收藏天下书画馆');
		Tpl::output('seo_description','收藏天下书画馆双11专场，双11玩出艺术范儿，名家书画真迹低至2折！99元秒臻品字画！');
		Tpl::showpage('zhuanti/20161111_1/index_show');
	}

	/**
	 * 
	 * Add is name du 
	 */
	public function ad_20161108Op(){
		Tpl::output('html_title','美元连体钞入手的最后时机');
		Tpl::output('seo_keywords','美国大选,希拉里,特朗普,美元,汇率,升值');
		Tpl::output('seo_description','美国大选，经济动荡，美元贬值，在新总统上任之后美元将迅速回涨，现在是入手的最好时机。');
		Tpl::showpage('zhuanti/20161108/index_show');
	}

	/**
	 * 双十一专题
	 * Add is name lt 2016-11-01
	 */
	public function ad_20161101Op(){

		showMessage('活动已结束','http://www.96567.com/index.php','html','error');


		$model_goods = Model('goods');

		// 删除缓存、更新后执行
		// dkcache('zhuanti_20161101');

		// 读出缓存
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
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC  LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_2'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 精品邮票
			$goods_id_list = '26709,33425,35774,4094,14830,12449';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC  LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_3'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 精品金银币
			$goods_id_list = '22502,27974,20679,31244,33166,8124';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC  LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_4'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);


			// 商家产品

			// 翰墨臻品
			$goods_id_list = '35667,17291,28640,30770,30827,26075,36818,36825';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC  LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_5'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 收藏鉴赏
			$goods_id_list = '37403,28618,37506,38482,38596,38635,29775,29778';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC  LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_6'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 典雅玉饰
			$goods_id_list = '34419,35033,31468,26205,29091,34639,20909,36249,32826,33715,22420,36257,27121,34766';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC  LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_7'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 文玩风尚
			$goods_id_list = '36071,20801,23760,16028,34632,35634,36075,22580,16592,20934,36310,35563,34224,38568';
			$condition_goods['goods_id'] = array('in',$goods_id_list);
			$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1 ORDER BY xianshi_id DESC  LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 ORDER BY groupbuy_id DESC LIMIT 1) as tuangou_money';
			$order = "field(goods_id,$goods_id_list)";
			$data['goods_list']['goods_list_8'] = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

			// 写入缓存、时效一小时
			wkcache('zhuanti_20161101',$data,3600);
		}

		Tpl::output('goods_list',$data['goods_list']);

		Tpl::output('html_title','狂欢双11,低至5折,免费送大金条！ - 收藏天下');
		Tpl::output('seo_keywords','双11,双十一,购物返现,送金条,钱币,邮票,纪念币,书画,文玩,收藏天下,金银币,金银投资');
		Tpl::output('seo_description','收藏天下狂欢双11,免费送大金条！部分商品全额返现,全场低至5折！');
		Tpl::showpage('zhuanti/20161101/index_show');
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
				Tpl::output('html_title','中国美协 官春英花鸟画专场 - 收藏天下书画馆');
				Tpl::output('seo_keywords','中国美协会员,国画,官春英,花鸟画,工笔画,书画特惠,艺术家作品,优惠券,收藏天下书画馆');
				Tpl::output('seo_description','收藏天下书画馆“中国美协官春英花鸟画专场”，领券立减800元！');
				Tpl::showpage('zhuanti/20161027/index_show');
			break;
		}
	
	}


	/**
	 * 双十一纪念币活动
	 * Add is name lt 2016-10-26
	 */
	public function ad_20161026Op(){

		showMessage('您访问的活动已结束','index.php','html','error');
		exit();
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

		Tpl::output('html_title','纪念币特惠专场 ');
		Tpl::output('seo_keywords','双11,纪念币,猴币,1元,返现');
		Tpl::output('seo_description','猴币惊爆价仅售1元！收藏天下双11预热，纪念币特价销售，1元买猴币，单品返现享不停，时间有限，速来');
		Tpl::showpage('zhuanti/20161026/index_show');
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




	/**
	 * 
	 */
	public function ad_20161025Op(){
		Tpl::output('html_title','漪风阁佛珠臻品,低至3折！');
		Tpl::output('seo_keywords','文玩,佛珠手串,黄花梨,金丝楠木,小叶紫檀,漪风阁佛珠,收藏天下');
		Tpl::output('seo_description','收藏天下推荐，漪风阁臻品佛珠手串深秋赏新，海南黄花梨、金丝楠、老料小叶紫檀限时特惠，低至3折！满500减150，满1000减350，满1500减500，全场包邮！');
		Tpl::showpage('zhuanti/20161025/index_show');
	}
	/**
	 * 免费神十一宇航员亲笔签名
	 */
	public function ad_20161022Op(){
		showMessage('您访问的活动已结束','index.php','html','error');
		exit();
		//设置活动参数
		$value = array(
					'maxorderamount' => '399',
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
					$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'免费领取神十一宇航员亲笔签名','免费领取神十一宇航员亲笔签名(pc)',true,$_POST['lid']);
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
					Tpl::showpage('zhuanti/20161022/index_show');
			break;
		}
	}
	 
	/**
	 * 免费神十一宇航员亲笔签名 end
	 */
	/**
	 * 书画馆 Add is name lt 2016-10-18
	 */
	public function ad_20161018Op(){
		showMessage('活动结束','http://www.96567.com/artist/index.php','html','error');
		exit;
		Tpl::output('YiShu',true);
		Tpl::output('html_title','收藏天下书画馆开馆特惠');
		Tpl::output('seo_keywords','收藏天下书画馆,国画,油画,名家字画,书法,艺术收藏,收藏天下,返现,艺术家,中国美协,中国书协');
		Tpl::output('seo_description','收藏天下书画馆隆重上线！豪掷千万现金返现，先领券再返现，最高立省1300元，速来选择一幅属于你的名家书画！');
		Tpl::showpage('zhuanti/20161018/index_show');
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
			$result['state'] = 'noLogin';
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

		$goods_id_list = '24329,35048,35043,35042,11734,12354,11735,12368,12351,15698,12367,12353,15161,3381,1904,2200,3844,3842,5212,5211';

		$condition_goods['goods_id'] = array('in',$goods_id_list);

		$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1  LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 LIMIT 1) as tuangou_money';

		$order = "field(goods_id,$goods_id_list)";

		$goods_list = $model_goods->getGoodsList($condition_goods,$field_goods,$order);


		Tpl::output('goods_list',$goods_list);
		Tpl::output('html_title','收藏天下热烈恭贺“神十一”发射成功！');
		Tpl::output('seo_keywords','神十一发射成功,航天纪念钞,航天纪念币,神州十一号,天宫二号,航天金银币,收藏天下');
		Tpl::output('seo_description','收藏天下热烈恭贺“神十一”发射成功，航天藏品特价35元起，送熊猫金币，航天纪念钞币套装！活动力度空前，速来选购！');
		Tpl::showpage('zhuanti/20161017/index_show');
	}





	/**
	 * 邮票活动 Add is name lt 2016-10-12
	 */
	public function ad_20161012Op(){

		
		if($_GET['action'] == 'ZhuCe'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$register_info['member_from'] = '致记忆中逝去的邮年';
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
			Tpl::output('html_title','致记忆中逝去的\'邮\'年');
			Tpl::output('seo_keywords','邮票、收藏、时代臻品');
			Tpl::output('seo_description','邮票，是一个时代的象征，更是一代记忆的收藏文库。它的精致，让人垂慕和追寻，它的文史价值，让人叹服和崇尚，它是高雅的品鉴“文物”，也是最具纪念价值的时代臻品。');

			Tpl::showpage('zhuanti/20161012/index_show');
		}
	}





	/**
	 * 砗磲活动 Add is name lt 2016-10-11
	 */
	public function ad_20161011Op(){

		showMessage('活动结束','http://www.96567.com/index.php','html','error');

		
		Tpl::output('html_title','神秘佛宝-海底灵玉砗磲低至39元！龙御堂砗磲特惠专场！');
		Tpl::output('seo_keywords','砗磲,砗磲手串,砗磲挂件,砗磲吊坠,砗磲摆件,龙御堂砗磲,海南砗磲,收藏天下');
		Tpl::output('seo_description','神秘佛宝-海底灵玉海南砗磲，限时特惠低至39元！全场满199减40，满499减100，满1000减300，包邮！');

		Tpl::showpage('zhuanti/20161011/index_show');
	}



	/**
	 * 佛教七宝 Add is name lt 2016-09-29
	 */
	public function ad_20160929Op(){

				showMessage('活动结束','http://www.96567.com/index.php','html','error');

		
		Tpl::output('html_title','佛教七宝 最高立减1200元');
		Tpl::output('seo_keywords','文玩,佛珠手串,玛瑙,南红,小叶紫檀,菩提子,金刚菩提,只有一个,收藏天下');
		Tpl::output('seo_description','收藏天下佛教七宝结缘专场，最高立减1200元！');

		Tpl::showpage('zhuanti/20160929/index_show');
	}


	/**
	 * 感恩专题 Add is name lt 2016-09-28
	 */
	public function ad_20160928Op(){
		
		Tpl::output('html_title','《三军大会师·国玺》品鉴会 感恩会员');
		Tpl::output('seo_keywords','长征 80周年 《三军大会师·国玺》 感恩');
		Tpl::output('seo_description','由收藏天下携手北京工美集团举办的《三军大会师·国玺》品鉴会在京圆满落幕！开国元勋后代及创作大师和央视鉴宝专家出席，数百位会员客户不远万里前来参会……对此，收藏天下奉上最诚挚的谢意！');

		Tpl::showpage('zhuanti/20160928/index_show');
	}


	/**
	 * 中秋活动 Add is name lt 2016-09-10
	 */
	public function ad_20160910Op(){
		
		Tpl::output('html_title','紫珊瑚画廊中秋特惠 翰墨臻品买一得二');
		Tpl::output('seo_keywords','中秋特惠,中秋活动,赠品,买一赠一,书画促销活动,名家真迹,收藏天下');
		Tpl::output('seo_description','紫珊瑚画廊中秋书画特惠，翰墨臻品买一得二，全场低至130元！');

		Tpl::showpage('zhuanti/20160910/index_show');
	}

	/**
	 * 中秋送银月饼活动 开始
	 */
	public function ad_20160905_1Op(){
		// if(time() > 1474214400){
		// 	showMessage('活动结束','http://www.96567.com/index.php','html','error');
		// 	exit;
		// }
		switch($_GET['action']){
			case 'lingqu':
					$this->YanZeng('11086');
					$goodsid_array = array('11086'=>'0');
					$goods_amount = '0'; //商品总额
					$shipping_fee = '0'; //运费
					$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'中秋送银月饼','中秋送银月饼(pc)',true,$_POST['lid']);
			break;
			case 'YanZneg':
				$lid = $this->YanZeng();
				$result['lid'] =  $lid;
				$result['order_sn'] =  $_POST['order_sn'];
				echo json_encode($result); 
				exit();
			break;
			default:
					$goods_id_list = '1310,27974,22502,11729,28879,26709,21462,13238,29515,23728,18267,18376';
					$condition_goods['goods_id'] = array('in',$goods_id_list);
					$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image';
					$goods_list = Model('goods')->getGoodsList($condition_goods,$field_goods,$order);
					Tpl::output('goods_list',$goods_list);
					Tpl::output('no_header',true);
					Tpl::output('no_footer',true);
				//	Tpl::output('robots',true); //屏蔽搜索引擎抓取
					Tpl::output('html_title','【中秋献礼】送中秋好礼银月饼');
					Tpl::output('seo_keywords','银月饼  中秋  送礼 ');
					Tpl::output('seo_description','收藏天下感恩回馈，中秋月圆之际，单笔订单满1288元即可免费领取一份礼盒装银月饼，一份热情，一份心意，收获的是一份满满的感动！');
					Tpl::showpage('zhuanti/20160905/index_show');
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
	 * 三军大会师国玺
	 */
	public function ad_20160902_2Op(){
				showMessage('活动已结束','http://www.96567.com/index.php','html','error');

		if($_POST){
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['user_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mobile'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mobile'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				$result['state'] = false;
				$result['msg'] = $error;
				echo json_encode($result); 
				exit();
			}


			$laiyuan = '三军大会师国玺pc_'.($_POST['ua']?$_POST['ua']:'pc');

			$laiyuan = urlencode($laiyuan);
			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mobile'].'&N='.urlencode($_POST['user_name']).'&AdFrom=ad_20160902_2'.'&A_Num=1&A_From='.$laiyuan.'&is_reg=0&contents='.urlencode($_POST['contents']).'&tg_from='.urlencode($_SESSION['tg_from']));
			$result['state'] = true;
			$result['msg'] = '您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!';
			echo json_encode($result); 
			exit();
		

		}else{
			Tpl::showpage('zhuanti/20160902_2/index_show');
		}

	}
	
	/**
	 * 三军大会师国玺
	 */
	public function ad_20160902_1Op(){
				showMessage('活动已结束','http://www.96567.com/index.php','html','error');

		if($_POST){
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['user_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mobile'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mobile'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				$result['state'] = false;
				$result['msg'] = $error;
				echo json_encode($result); 
				exit();
			}


			$laiyuan = '三军大会师国玺pc_'.($_POST['ua']?$_POST['ua']:'pc');

			$laiyuan = urlencode($laiyuan);
			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mobile'].'&N='.urlencode($_POST['user_name']).'&AdFrom=ad_20160902_1'.'&A_Num=1&A_From='.$laiyuan.'&is_reg=0&contents='.urlencode($_POST['contents']).'&tg_from='.urlencode($_SESSION['tg_from']));
			$result['state'] = true;
			$result['msg'] = '您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!';
			echo json_encode($result); 
			exit();
		

		}else{
			Tpl::showpage('zhuanti/20160902_1/index_show');
		}

	}

	/**
	 * 三军大会师国玺
	 */
	public function ad_20160902Op(){
				showMessage('活动已结束','http://www.96567.com/index.php','html','error');

		if($_POST){
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['user_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mobile'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mobile'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				$result['state'] = false;
				$result['msg'] = $error;
				echo json_encode($result); 
				exit();
			}


			$laiyuan = '三军大会师国玺pc_'.($_POST['ua']?$_POST['ua']:'pc');

			$laiyuan = urlencode($laiyuan);
			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mobile'].'&N='.urlencode($_POST['user_name']).'&AdFrom=ad_20160902'.'&A_Num=1&A_From='.$laiyuan.'&is_reg=0&contents='.urlencode($_POST['contents']).'&tg_from='.urlencode($_SESSION['tg_from']));
			$result['state'] = true;
			$result['msg'] = '您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!';
			echo json_encode($result); 
			exit();
		

		}else{
			Tpl::showpage('zhuanti/20160902/index_show');
		}

	}


	/**
	 * 三军大会师国玺[复制上面]
	 */
	public function ad_20160903Op(){
		if($_POST){
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['user_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mobile'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mobile'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				$result['state'] = false;
				$result['msg'] = $error;
				echo json_encode($result); 
				exit();
			}


			$laiyuan = '三军大会师国玺pc_'.($_POST['ua']?$_POST['ua']:'pc');

			$laiyuan = urlencode($laiyuan);
			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mobile'].'&N='.urlencode($_POST['user_name']).'&AdFrom=ad_20160903'.'&A_Num=1&A_From='.$laiyuan.'&is_reg=0&contents='.urlencode($_POST['contents']).'&tg_from='.urlencode($_SESSION['tg_from']));
			$result['state'] = true;
			$result['msg'] = '您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!';
			echo json_encode($result); 
			exit();
		}else{
			Tpl::output('html_title','三军大会师宝玺-隆重纪念中国工农红军长征胜利80周年-收藏天下');
			Tpl::showpage('zhuanti/20160903/index_show');
		}

	}


	/**
	 * 等值兑换
	 */
	public function ad_20160829Op(){
		switch($_GET['action']){
			case 'lingqu':
				if(intval($_POST['is_bao']) == 1){
					$goodsid_array = array('28286'=>'186');
					$where_member_from['member_id'] = intval($_SESSION['member_id']);
					$where_member_from['member_from'] = array('like','%等值兑换第五套人民币%');
					$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
					if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
					$goods_amount = '186'; //商品总额
					$shipping_fee = '10'; //运费
				}elseif(intval($_POST['is_bao']) == 2){ //带包装
					$goodsid_array = array('15091'=>'201');
					$where_member_from['member_id'] = intval($_SESSION['member_id']);
					$where_member_from['member_from'] = array('like','%等值兑换第五套人民币%');
					$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
					if($return_error['error']) exit(json_encode(array('state'=>false,'msg'=>$return_error['error'])));
					$goods_amount = '201'; //商品总额
					$shipping_fee = '10'; //运费
				}
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"等值兑换第五套人民币",'等值兑换第五套人民币(pc)');
			break;
			case 'regs':
				//注册
				$model_member	= Model('member');
				$code = $_POST['code'];
				if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
					$result['state'] = false;
					$result['msg'] = "验证码错误".$_SESSION['wx_phone_yzm'][$_POST['mobile']];
					echo json_encode($result); 
					exit();
				}
				unset($_SESSION['wx_phone_yzm'][$_POST['mobile']]);
				$register_info = array();
				$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
				$register_info['username'] = $_POST['user_name'];
				$register_info['password'] = $_POST['mobile'];
				$register_info['password_confirm'] = $_POST['mobile'];
				$register_info['mobile'] = $_POST['mobile'];
				$M = $_POST['ua'] == '' ? 'pc' : $_POST['ua'];
				$register_info['member_from'] = '等值兑换第五套人民币('.$M.')';
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
					Tpl::output('robots',true); //屏蔽搜索引擎抓取
			//		Tpl::output('html_title','第三套人民币-收藏天下-只做正品收藏');
			//		Tpl::output('seo_keywords','第三套人民币 惊爆抢藏价 188一套 限时限量 先抢先赚');
			//		Tpl::output('seo_description','第三套人民币 收藏天下');
					Tpl::showpage('zhuanti/20160829/index_show');
			break;
		}

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
				$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,"免费领取中国纸币",'免费领取中国纸币(pc)');
			break;
			case 'regs':
				//注册
				$model_member	= Model('member');
				$code = $_POST['code'];
				if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
					$result['state'] = false;
					$result['msg'] = "验证码错误".$_SESSION['wx_phone_yzm'][$_POST['mobile']];
					echo json_encode($result); 
					exit();
				}
				unset($_SESSION['wx_phone_yzm'][$_POST['mobile']]);
				$register_info = array();
				$register_info['member_mobile_bind'] = 1;//是否验证手机 已验证
				$register_info['username'] = $_POST['user_name'];
				$register_info['password'] = $_POST['mobile'];
				$register_info['password_confirm'] = $_POST['mobile'];
				$register_info['mobile'] = $_POST['mobile'];
				$M = $_POST['ua'] == '' ? 'pc' : $_POST['ua'];
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
					Tpl::showpage('zhuanti/20160827/index_show');
			break;
		}

	}
	/**
	 * 手串专题
	 */
	public function ad_20160826Op(){
		showWapMessage('活动以结束','index.php','error');
		exit;
		Tpl::output('html_title','【惊爆价28.8元】 精品赞比亚紫檀手串（仅100条）');
		Tpl::output('seo_keywords','文玩、手串、紫檀、特惠');
		Tpl::output('seo_description','收藏天下品牌推广季，惊人优惠力度！顶级赞比亚紫檀佛珠手串仅售28.8元/条。限量100条，请抓紧时间抢购。');
		Tpl::showpage('zhuanti/20160826/index_show');
	}

	/**
	 * 第三套人民币专题 Add is name lt
	 */
	public function ad_20160820Op(){


		if(chksubmit(true)){

			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST['true_name'],"require"=>"true", "message"=>'用户姓名不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true", "message"=>'手机号不能为空！'),
				array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机格式不正确！'),
				array("input"=>$_POST['yzm'],"require"=>"true", "message"=>'验证码不能为空！'),
				array("input"=>$_POST['goods_sum'],"require"=>"true", "message"=>'订购数量不能为空！'),
				array("input"=>$_POST['address'],"require"=>"true", "message"=>'详细地址不能为空！'),
			);

			$error = $obj_validate->validate();
			if ($error != ''){
				showMessage($error,'','error');
				exit();
			}

			if(($_SESSION['push_phone_yzm'] != $_POST['yzm']) || ($_SESSION['push_phone'] != $_POST['mob_phone'])){
				showMessage('验证码不正确！','','error');
				exit();
			}

			$laiyuan = '第三套人民币pc_'.($_GET['ua']?$_GET['ua']:'pc');

			$laiyuan = urlencode($laiyuan);

			$retuen_type = @file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$_POST['mob_phone'].'&N='.urlencode($_POST['true_name']).'&AdFrom=ad_20160820'.'&A_Num='.$_POST['goods_sum'].'&A_From='.$laiyuan.'&is_reg=0&contents='.urlencode($_POST['prov_name'].' '.$_POST['city_name'].' '.$_POST['region_name'].' '.$_POST['address']));
			
			if($retuen_type == 1){
				$msg = "第三套人民币推广有新的留言，请马上查看并进行分配，分配后别忘了通知业务员。";
				$sms = new Sms();
				$sms->send('15726633668',$msg);
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://www.96567.com/index.php?act=zhuanti&op=ad_20160820\';</script>';
				exit();
			}else{
				echo '<script>alert(\'您已提交成功，客服人员会尽快与您取得电话联系 咨询请拨400-81-96567客服热线!\');window.location.href=\'http://www.96567.com/index.php?act=zhuanti&op=ad_20160820\';</script>';
				exit();
			}

		}

		$model_order = Model('order');

		$condition_order['order.order_state'] = 30;

		$condition_order['order_goods.goods_id'] = 16091;

		$order_list = $model_order->getOrderAndOrderGoodsList($condition_order,'*','20');

		Tpl::output('html_title','第三套人民币-收藏天下-只做正品收藏');
		Tpl::output('seo_keywords','第三套人民币 惊爆抢藏价 188一套 限时限量 先抢先赚');
		Tpl::output('seo_description','第三套人民币 收藏天下');
		Tpl::output('order_list',$order_list);
		Tpl::showpage('zhuanti/20160820/index_show');
	}

	/**
	 * 七夕专题 Add is name lt
	 */
	public function ad_20160802Op(){
		showMessage('活动结束','http://www.96567.com/index.php','html','error');
		exit();
		$model_goods = Model('goods');

		// 单个产品

		$goods_id_list = '23786,23728,20801,23850,21520,22979,24270,23846,19754,24194,17849,23873,23849,22658,22702,21089,23879,23895,22605,23845,21240,17852,19696,22146';

		$condition_goods['goods_id'] = array('in',$goods_id_list);

		$field_goods = 'goods_id,goods_name,goods_price,goods_promotion_price,goods_image,(SELECT xianshi_price FROM shop_p_xianshi_goods WHERE shop_p_xianshi_goods.goods_id = shop_goods.goods_id  AND shop_p_xianshi_goods.state = 1  LIMIT 1) as xianshi_money,(SELECT groupbuy_price FROM shop_groupbuy WHERE shop_groupbuy.goods_id = shop_goods.goods_id AND shop_groupbuy.state = 20 LIMIT 1) as tuangou_money';

		$order = "field(goods_id,$goods_id_list)";

		$goods_list = $model_goods->getGoodsList($condition_goods,$field_goods,$order);

		// 店铺
		$store = array();
		$store['13']['store_id'] = '13';
		$store['13']['goods_id'] = '24257,20278,20325,21072,23796,21083,21088';

		$store['455']['store_id'] = '455';
		$store['455']['goods_id'] = '22407,22395,22439,22437,22421,22442,22451';

		$store['68']['store_id'] = '68';
		$store['68']['goods_id'] = '20925,20917,20916,20934,20936,20938,20935';

		$store['90']['store_id'] = '90';
		$store['90']['goods_id'] = '22338,23505,23342,22902,22714,22557,22900';

		$store['897']['store_id'] = '897';
		$store['897']['goods_id'] = '22485,22559,22983,23363,22969,22635,23569';

		$store['253']['store_id'] = '253';
		$store['253']['goods_id'] = '21950,21944,21242,20943,20942,20941,20314';

		$store['140']['store_id'] = '140';
		$store['140']['goods_id'] = '16111,16107,16106,16102,16103,16101,16099';

		$store['305']['store_id'] = '305';
		$store['305']['goods_id'] = '17851,17837,17838,17853,17855,17850,17866';

		$store['883']['store_id'] = '883';
		$store['883']['goods_id'] = '23365,23640,23459,23454,23449,23372,23887';

		$store['813']['store_id'] = '813';
		$store['813']['goods_id'] = '23769,23767,23784,23776,23774,23252,23250';

		$store['522']['store_id'] = '522';
		$store['522']['goods_id'] = '22709,22705,22662,22651,19685,19781,19389';


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


		Tpl::output('html_title','七夕特惠活动 贴心爱礼低至17元 - 收藏天下');
		Tpl::output('seo_keywords','七夕活动,佛珠手串,情人节活动,七夕特惠,珠宝首饰,翡翠玉石,小叶紫檀,黄花梨,金刚菩提手串,紫砂壶,秒杀,限时折扣,满减特惠,收藏天下');
		Tpl::output('seo_description','收藏天下七夕特惠活动，佛珠手串、珠宝首饰等贴心爱礼低至17元，全场包邮，品质尖货满立减！温情七夕，选七夕礼物，来收藏天下！');

		Tpl::output('goods_list',$goods_list);
		Tpl::output('store_goods_list',$store_goods_list);
		Tpl::showpage('zhuanti/20160802/index_show');
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
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'里约奥运抽奖活动pc','里约奥运抽奖活动pc',true,array($lid));

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

		}elseif($_GET['action'] == 'url_admin'){
				//登录检查验证
				if($_POST){
					$user=$_POST["username"];
					$pws=$_POST["password"];
					if($user == "杜飞" && $pws =="df123123"){
					   setcookie("DfZtAdmin", "1");
					   header("location:index.php?act=zhuanti&op=ad_20160801&action=url_admin");
					}else{
						echo "<script>window.alert('登录失败返回重新登录');window.location.href='index.php?act=zhuanti&op=ad_20160801&action=url_admin';</script>";
						exit;
					}
				}else{
					if(empty($_COOKIE["DfZtAdmin"])) {
						Tpl::showpage('zhuanti/20160801/admin/login','null_layout');
					}else{
						//获得所有会员中奖记录
						$SuoYouLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160801'),'*,(SELECT member_name FROM shop_member WHERE `shop_member`.member_id = `shop_lottery_member`.member_id) as member_name,(select order_sn from shop_order where order_id = l_orderid) as cj_order_sn,(select order_state from shop_order where order_id = l_orderid) as order_state','20','is_fafang ASC,id desc');
						Tpl::output('show_page',$this->ZtModel->showpage());
						if($SuoYouLotteryList){
							foreach($SuoYouLotteryList as $k=>$v){
								$Receive = $this->ZtModel->getLotteryReceive(array('l_id'=>$v['id']));
								$SuoYouLotteryList[$k]['liqu_name'] = $Receive['name'];
								$SuoYouLotteryList[$k]['liqu_mobile'] = $Receive['mobile'];
							}
						}
						Tpl::output('List',$SuoYouLotteryList);
						Tpl::showpage('zhuanti/20160801/admin/adminindex','null_layout');
					}
				}
				
		}else{
			Tpl::output('html_title','里约奥运惠 - 收藏天下');
			Tpl::output('seo_keywords','奥运惠,送银条,抽奖,竞猜,奥运纪念币,里约奥运藏品');
			Tpl::output('seo_description','收藏天下为中国奥运加油！全场满888元加送银条，订单还可拿来抽奖，最高奖励香港奥运纪念钞一套！');
			//获得所有会员中奖记录
			$MemberLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160801','l_id'=>array('not in',array(4,9))),'*,(SELECT member_name FROM shop_member WHERE `shop_member`.member_id = `shop_lottery_member`.member_id) as member_name','','add_time desc');
			Tpl::output('MemberLotteryList',$MemberLotteryList);
			$My_MemberLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160801','member_id'=>$_SESSION['member_id'],'l_id'=>array('not in',array(4,9))),'*,(SELECT member_name FROM shop_member WHERE `shop_member`.member_id = `shop_lottery_member`.member_id) as member_name','','add_time desc');
			Tpl::output('My_MemberLotteryList',$My_MemberLotteryList);
			Tpl::showpage('zhuanti/20160801/index_show');
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
		Tpl::output('result_list',$result_list);
		Tpl::output('html_title','邀请得礼品，好礼送不停-收藏天下');
		Tpl::output('seo_keywords','藏豆，邀请有礼，邀请好礼');
		Tpl::output('seo_description','收藏天下为回馈新老客户，特别推出邀请有礼活动，邀请好友得5藏豆，只要邀请4个人，就能换购藏品，朋友购物也有返现哦。快来参与吧。');
		Tpl::showpage('zhuanti/20160714/index_show');
	}

	/**
	 * 传家宝活动
	 */
	public function ad_20160707Op(){
		showMessage('您访问的活动已结束','http://www.96567.com/vip/','html','error');
		exit();
		Tpl::output('html_title','全国首届传家宝票选活动官方网站-收藏天下');
		Tpl::output('seo_keywords','传家宝免费鉴定,传家宝免费评估,传家宝活动-收藏天下');
		Tpl::output('seo_description','全国首届传家宝票选活动火热进行中,马上拍照上传家传之宝即可参与票选活动，CCTV央视《鉴定》专家王立军免费为您评估鉴定！更有5000元现金大奖等你来拿！-收藏天下');

		Tpl::showpage('zhuanti/20160707/index_show');
	}

	/**
	 * 送银条活动
	 */
	public function ad_20160708_1Op(){
		Tpl::output('html_title','注册送银条免费送-包邮-收藏天下');
		Tpl::output('seo_keywords','银条,银条免费送,收藏品,纪念银条,纪念银币');
		Tpl::output('seo_description','值此收藏天下6周年之际,特别举办注册银条免费送活动!超值包邮,免费送到家!');
		Tpl::showpage('zhuanti/20160708_1/index_show');
	}

	/**
	 * 送银条活动
	 */
	public function ad_20160708Op(){
		Tpl::output('html_title','一元一克银条免费送-包邮-收藏天下');
		Tpl::output('seo_keywords','银条,银条免费送,收藏品,纪念银条,纪念银币');
		Tpl::output('seo_description','值此收藏天下6周年之际,特别举办银条一元一克送活动!超值包邮,免费送到家!');
		Tpl::showpage('zhuanti/20160708/index_show');
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

				$register_info['member_from'] = '艺术众筹';
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
				Tpl::showpage('zhuanti/20160615/index_show');
			}
	}
	
	/**
	 * 猴币推广页面1
	 */
	public function ad_20160608_1Op(){
			$zmr=intval($_GET['zmr']);
			if($zmr>0)
			{
			   setcookie('zmr', $zmr);
			}
			Tpl::output('html_title',"猴年纪念币不花钱，免费领取");
			Tpl::output('seo_keywords',"猴年纪念币 猴币 生肖纪念币 纪念币 免费领取");
			Tpl::output('seo_description',"猴年纪念币不花钱，免费领！猴年生肖纪念币是当下最热门的纪念币藏品，为了推广纪念币收藏文化，特发起此次免费领取活动，快来领取吧！");
			Tpl::showpage('zhuanti/20160608_1/index_show');
	}
	
	/**
	 * 端午节活动
	 */
	public function ad_20160602Op(){
		//检查是否在活动时间内
		if(time() > 1465747200){
			showMessage('您访问的活动已结束','http://www.96567.com/vip/','html','error');
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
			$M = $_POST['ua'] == '' ? 'pc' : $_POST['ua'];
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
			$goods_info = Model('goods')->getGoodsInfoByID(1237);
			
			$return_error = $this->ZtModel->JianChaHuoDong($goodsid_array,$where_member_from);
			if($return_error['error']) Tpl::output('is_lin','1');
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
			Tpl::showpage('zhuanti/20160602/index_show');
		}
	}

	/**
     * 518专题活动 str
     */
	public function ad_20160518Op(){
		showMessage('您访问的活动已结束','http://www.96567.com/vip/','html','error');
		exit();
		if($_GET['action'] == 'regs'){
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
			$M = $_POST['ua'] == '' ? 'pc' : $_POST['ua'];
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
			Tpl::showpage('zhuanti/20160518/zhuanti_show');
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
		}elseif($rid == 888){
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
     * 里约奥运专题手机版 wang 20160422
     */
    public function ad_20160422Op(){
		//从缓存中获取剩余数量
		$dataArr = rkcache('HuoDong', true);
		$dataArr['LiYue'] = intval($dataArr['LiYue']) <= 10 ? 100 : intval($dataArr['LiYue']);
		$intRand = rand(1,15);
		if($intRand==5){
			$num = rand(1,2);
			$dataArr['LiYue']= intval($dataArr['LiYue']-$num);
			if($dataArr['LiYue'] < 20){
				$dataArr['LiYue']= rand(10,20);
			}
			wkcache('HuoDong', $dataArr); 
		}
		$this->commentOp();
		$this->orderOp();
		
		Tpl::output('shuliang',$dataArr['LiYue']);
		Tpl::output('html_title',"里约2016奥运纪念币 官方发售");
		Tpl::output('seo_keywords',"2016年里约热内卢奥运会纪念币 里约奥运纪念币 里约热内卢纪念币");
		Tpl::output('seo_description',"2016里约奥运会纪念币火爆热销中，官方特批500套原始价格发售，只需1592元，逾期涨至1980元！最热的奥运题材，先进的钞币工艺，稀缺的收藏资源，无限的涨幅空间。");
		Tpl::showpage('zhuanti/20160422/zhuanti_show');
	}

	/**
	 * 注册
	 * @return [type] [description]
	 */
	public function ad_20160425Op(){
		//验证表单信息
		$obj_validate = new Validate();
		$obj_validate->validateparam = array(
			array("input"=>$_POST["true_name"],"require"=>"true","message"=>'用户名不能为空'),
			array("input"=>$_POST['mob_phone'],"require"=>"true","validator"=>"mobile", "message"=>'手机号码格式不正确'),
		);
		$error = $obj_validate->validate();
		if ($error != ''){
			$error = strtoupper(CHARSET) == 'GBK' ? Language::getUTF8($error) : $error;
			exit(json_encode(array('state'=>false,'msg'=>$error)));
		}
		//新用户注册
		$register_info = array();
		$register_info['username'] = $_POST['true_name'];
		$register_info['mobile'] = $_POST['mob_phone'];
		$M = $_POST['ua'] == '' ? 'pc' : $_POST['ua'];
		$register_info['member_from'] = '里约奥运专题('.$M.')';

		$result['state'] = "恭喜您预约成功，请等待专属客服与您联系";
		//将数据写入crm存放
		@file_get_contents("http://crm.96567.com/index.php?m=api&c=getActivityApi&p=action&M=".$register_info['mobile'].'&N='.urlencode($register_info['username']).'&AdFrom=ad_20160422pc'.'&A_Num=1'.'&A_From='.urlencode($register_info['member_from']).'&is_reg=0');
		echo json_encode($result); 
		exit();
	}

	/**
	 * 发货通知
	 */
	public function orderOp() {
		$order_model = Model('order');
		$condition['goods_id'] = '15597';
		$field= 'buyer_name,order_goods.goods_name,add_time,order_state';
		$o_list = $order_model->getOrderAndOrderGoodsList($condition);
		Tpl::output('o_list',$o_list);
	}

	/**
	 * 商品评论
	 */
	public function commentOp() {
		$eg_model = Model('evaluate_goods');
		$field= 'geval_frommembername,geval_scores,geval_content,geval_addtime';
		$c_list = $eg_model->getEvaluateGoodsList('','','',$field);
		// print_r($c_list);die;
		Tpl::output('c_list',$c_list);
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
			$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'等值兑换20160317');
		}elseif($_GET['action'] == 'is_login'){
			$where_member_from['member_id'] = intval($_SESSION['member_id']);
			if($where_member_from['member_id'] == 0) {
				exit(json_encode(array('state'=>false,'msg'=>'-1')));
			}else{
				exit(json_encode(array('state'=>true,'msg'=>'OK')));
			}
		}elseif($_GET['action'] == 'ZhuCe'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$register_info['member_from'] = '航天钞小五等值兑换';
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
			Tpl::output('html_title',"");
			Tpl::output('seo_keywords',"");
			Tpl::output('seo_description',"");
			Tpl::showpage('zhuanti/20160317/index_show');
		}
		

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
			if($_SESSION['wx_phone_yzm'][$_POST['mobile']] != $code || $_SESSION['wx_phone_yzm'][$_POST['mobile']] == ''){
				$result['error'] = "验证码错误";
				echo json_encode($result); 
				exit();
			}
			$register_info['member_mobile_bind'] = 1;
			$ua = $_POST['ua'] == '' ? '' : "(".$_POST['ua'].")";
			$register_info['member_from'] = '免费送70周年纪念币'.$ua;
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
			Tpl::showpage('zhuanti/20160314/index_show');
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
				'0' => array('angle'=>335,'prize'=>'第三条人民币小全套后三同500元代金券','v'=>106,'type'=>'1',num=>'0'),
				'1' => array('angle'=>247,'prize'=>'中国金币2016猴年贺岁银条50克元代金券','v'=>105,'type'=>'1',num=>'0'),
				'2' => array('angle'=>292,'prize'=>'中国航天纪念钞十连号元代金券','v'=>107,'type'=>'1',num=>'0'),
				'3' => array('angle'=>157,'prize'=>'世界财富宝典珍藏册500元代金券','v'=>104,'type'=>'1',num=>'5'), 
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
		}elseif($_GET['action'] == 'disp_prompt'){
				$this->ZtModel->upLotteryReceive(array('order_sn'=>$_POST['order_sn'],'is_fafang'=>'1'),array('id'=>$_POST['id']));
				echo '1';
				exit;
		}elseif($_GET['action'] == 'url_admin'){
				//登录检查验证
				if($_POST){
					$user=$_POST["username"];
					$pws=$_POST["password"];
					if($user == "杜飞" && $pws =="df123123"){
					   setcookie("DfZtAdmin", "1");
					   header("location:index.php?act=zhuanti&op=ad_20160110&action=url_admin");
					}else{
						echo "<script>window.alert('登录失败返回重新登录');window.location.href='index.php?act=zhuanti&op=ad_20160110&action=url_admin';</script>";
						exit;
					}
				}else{
					if(empty($_COOKIE["DfZtAdmin"])) {
						Tpl::showpage('zhuanti/20160110/admin/login','null_layout');
					}else{
						//获得所有会员中奖记录
						$SuoYouLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160110'),'*,(SELECT member_name FROM shop_member WHERE `shop_member`.member_id = `shop_lottery_member`.member_id) as member_name,(SELECT order_sn FROM shop_order WHERE `shop_order`.order_id = `shop_lottery_member`.l_orderid) as l_order_sn','20','is_fafang ASC,id desc');
						Tpl::output('show_page',$this->ZtModel->showpage());
						if($SuoYouLotteryList){
							foreach($SuoYouLotteryList as $k=>$v){
								$Receive = $this->ZtModel->getLotteryReceive(array('l_id'=>$v['id']));
								$SuoYouLotteryList[$k]['liqu_name'] = $Receive['name'];
								$SuoYouLotteryList[$k]['liqu_mobile'] = $Receive['mobile'];
							}
						}
						Tpl::output('List',$SuoYouLotteryList);
						Tpl::showpage('zhuanti/20160110/admin/adminindex','null_layout');
					}
				}
				
		}else{
			Tpl::output('html_title',"收藏天下感恩大回馈，好礼0元送，金条免费抽-收藏天下");
			//获得当前会员中奖记录
			$MyLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160110','member_id'=>$_SESSION['member_id']));
			Tpl::output('MyLotteryList',$MyLotteryList);
			//获得所有会员中奖记录
			$SuoYouLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20160110'));
			Tpl::output('SuoYouLotteryList',$SuoYouLotteryList);
			Tpl::showpage('zhuanti/20160110/index_show');
		}
	}

	/**
	 * 杜 2016猴币兑换
	 */
	public function ad_20160115Op(){
		if($_GET['action'] == 'zhu_ce'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$register_info['mobile'] = $_POST['mobile'];
			$register_info['member_from'] = '2016猴币兑换';
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
			Tpl::output('html_title',"2016年丙申猴年贺岁普通纪念币");
			Tpl::showpage('zhuanti/20160115/index_show');
		}
	}


	/**
	 * 杜 双十二大惠站
	 */
	public function ad_20151212_3Op(){

		Tpl::output('html_title',"收藏天下双12大惠站之免费送礼。");
		Tpl::output('seo_keywords',"收藏天下，双12，五折，满赠，180送纪念币，限时立减，单品大促，新人惠，礼包，促销");
		Tpl::output('seo_description',"收藏天下双12大惠站之免费送礼，不拘新老会员，单笔订单只需消费180元即有好礼可以拿。主场优惠低至五折，以及众多更多藏品。推荐新人特别礼包，免费拿，超大力度尽在收藏天下1212。");
		$goodsid_array = array('0'=>'12449','1'=>'12450','2'=>'12351','3'=>'830','4'=>'11231','5'=>'11241','6'=>'12155','7'=>'10488');
		$goods_in['goods_id'] = array('in', $goodsid_array);
		$goods_list = Model('goods')->getGoodsList($goods_in);
		Tpl::output('goods_list',$goods_list);
		Tpl::showpage('zhuanti/20151212-3/index_show');
	}

	/**
	 * 杜 双十二大惠站 
	 */
	public function ad_20151212_2Op(){
		if($_GET['action'] == 'yanzhengone'){ //第一步
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password1'];
			$member_info = $this->ZtModel->register($register_info);
			if(!isset($member_info['error'])) {
				$new_register = serialize($register_info);
				setNcCookie('ZhuanTi_Reg',$new_register, 86400 * 20);  // 二十天
				$result['msg'] = 'ok';
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}elseif($_GET['action'] == 'yanzhengtwo'){ //第二步
			if(!$_COOKIE[COOKIE_PRE.'ZhuanTi_Reg']){
				$result['error'] = '未填写用户名和密码信息！';
				echo json_encode($result); 
				exit();
			}
			if($_POST['code'] == ''){
				$result['error'] = '验证码不能为空！';
				echo json_encode($result); 
				exit();
			}
			if($_POST['code'] != $_SESSION['ZhuanTicode']){
				$result['error'] = '验证码输入错误，请重新输入！';
				echo json_encode($result); 
				exit();
			}
			$ZhuanTi_Reg = unserialize($_COOKIE[COOKIE_PRE.'ZhuanTi_Reg']);
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $ZhuanTi_Reg['username'];
			$register_info['password'] = $ZhuanTi_Reg['password'];
			$register_info['password_confirm'] = $ZhuanTi_Reg['password_confirm'];
			$register_info['mobile'] = $_POST['tel'];
			$register_info['member_mobile_bind'] = '1'; //绑定手机
			$register_info['member_from'] = '双十二快速注册';
			$member_info = $model_member->register($register_info);
			if(!isset($member_info['error'])) {
				$insert_arr['pl_memberid'] = $member_info['member_id'];
				$insert_arr['pl_membername'] = $register_info['username'];
				$insert_arr['pl_points'] = '1000';
				$insert_arr['pl_desc'] = '双十二新人独享礼手机验证';
				$obj_points = Model('points');
				$obj_points->savePointsLog('zhuanti',$insert_arr,true);
				$this->ZtModel->exchangeVoucher(36,intval($member_info['member_id']));
				$result['msg'] = 'ok';
				$register_info['member_id'] = $member_info['member_id']; 
				$new_register = serialize($register_info);
				setNcCookie('ZhuanTi_Reg',$new_register, 86400 * 20);  // 二十天
				echo json_encode($result); 
				exit();
			}else{
				$result['error'] = $member_info['error'];
				echo json_encode($result); 
				exit();
			}
		}elseif($_GET['action'] == 'loginbtn_three'){
				$register_info = unserialize($_COOKIE[COOKIE_PRE.'ZhuanTi_Reg']);
				$model_member = Model('member');
				$condition = array();
				$condition['member_id'] = $register_info['member_id'];
				$condition['member_email_bind'] = '1';
				$member_info = $model_member->getMemberInfo($condition,'member_id');
				if($member_info){ //以验证赠送积分和搜藏币
					$insert_arr['pl_memberid'] = $register_info['member_id'];
					$insert_arr['pl_membername'] = $register_info['username'];
					$insert_arr['pl_points'] = '600';
					$insert_arr['pl_desc'] = '双十二新人独享礼邮箱验证';
					$obj_points = Model('points');
					$obj_points->savePointsLog('zhuanti',$insert_arr,true);
					$register_info['member_email_bind'] = '1'; 
					$new_register = serialize($register_info);
					setNcCookie('ZhuanTi_Reg',$new_register, 86400 * 20);  // 二十天
					$result['msg'] = 'ok';
					echo json_encode($result); 
					exit();
				}else{
					$result['error'] = '您未验证邮箱，请进入邮箱进行验证！';
					echo json_encode($result); 
					exit();
				}

		}elseif($_GET['action'] == 'yz_email'){
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["email"], "require"=>"true", 'validator'=>'email',"message"=>'请正确填写邮箱')
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				$result['error'] = $error;
				echo json_encode($result); 
				exit();
			}
			$register_info = unserialize($_COOKIE[COOKIE_PRE.'ZhuanTi_Reg']);
			$model_member = Model('member');
			$condition = array();
			$condition['member_email'] = $_POST["email"];
			$condition['member_id'] = array('neq',$register_info['member_id']);
			$member_info = $model_member->getMemberInfo($condition,'member_id');
			if ($member_info) {
				$result['error'] = '该邮箱已被使用';
				echo json_encode($result); 
				exit();
			}
			$data = array();
			$data['member_email'] = $_POST['email'];
			$data['member_email_bind'] = 0;
			$update = $model_member->editMember(array('member_id'=>$register_info['member_id']),$data);
			if (!$update) {
				$result['error'] = '系统发生错误，如有疑问请与客服联系';
				echo json_encode($result); 
				exit();
			}

			 $seed = random(6);
			 $data = array();
			 $data['auth_code'] = $seed;
			 $data['send_acode_time'] = TIMESTAMP;
			 $update = $model_member->editMemberCommon($data,array('member_id'=>$register_info['member_id']));
			 if (!$update) {
				$result['error'] = '系统发生错误，如有疑问请与客服联系';
				echo json_encode($result); 
				exit();
			 }
			$uid = base64_encode(encrypt($register_info['member_id'].' '.$_POST["email"]));
			$verify_url = SHOP_SITE_URL.'/index.php?act=login&op=bind_email&uid='.$uid.'&hash='.md5($seed);
			$model_tpl = Model('mail_templates');
			$tpl_info = $model_tpl->getTplInfo(array('code'=>'bind_email'));
			$param = array();
			$param['site_name']	= C('site_name');
			$param['user_name'] = $register_info['username'];
			$param['verify_url'] = $verify_url;
			$subject	= ncReplaceText($tpl_info['title'],$param);
			$message	= ncReplaceText($tpl_info['content'],$param);
			$email	= new Email();
			$result	= $email->send_sys_email($_POST["email"],$subject,$message);
			$result['msg'] = 'ok';
			$register_info['email'] = $_POST["email"]; 
			$new_register = serialize($register_info);
			setNcCookie('ZhuanTi_Reg',$new_register, 86400 * 20);  // 二十天
			echo json_encode($result); 
			exit();
		}elseif($_GET['action'] == 'telmode'){
			$mobile = $_POST['tel'];
			$obj_validate = new Validate();
			$obj_validate->validateparam = array(
			array("input"=>$mobile,		"require"=>"true",		"validator"=>"mobile", "message"=>'手机号码格式不正确'),
			);
			$error = $obj_validate->validate();
			if ($error != ''){
				echo '-1';
				exit;
			}
			$check_member_mobile	= Model('member')->getMemberInfo(array('member_mobile'=>$mobile));
			if(is_array($check_member_mobile) and count($check_member_mobile)>0) {
				echo '-2';
				exit;
			}
			$_SESSION['ZhuanTicode']=rand(100000,999999);
			$sms = new Sms();
			$result = $sms->send($mobile,"您好,您的手机验证码是".$_SESSION['ZhuanTicode']."");
			echo '1';
			exit;
		}else{
			if($_COOKIE[COOKIE_PRE.'ZhuanTi_Reg']){ $ZhuanTi_Reg = unserialize($_COOKIE[COOKIE_PRE.'ZhuanTi_Reg']);}
			Tpl::output('ZhuanTi_Reg',$ZhuanTi_Reg);
			$goodsid_array = array('0'=>'12449','1'=>'12450','2'=>'12351','3'=>'830','4'=>'11231','5'=>'11241','6'=>'12155','7'=>'10488');
			$goods_in['goods_id'] = array('in', $goodsid_array);
			$goods_list = Model('goods')->getGoodsList($goods_in);
			Tpl::output('goods_list',$goods_list);
			Tpl::output('html_title',"收藏天下双12大惠站之新人有礼。");
			Tpl::output('seo_keywords',"收藏天下，双12，五折，满赠，限时立减，单品大促，新人惠，礼包，促销");
			Tpl::output('seo_description',"收藏天下双12大惠站之新人有礼。截止至2015年12月31日，新会员注册成功即送1600积分+200现金券，独属的实惠，领券下单很实惠。注册完成去主场参与五折秒杀，，超大力度尽在收藏天下1212。");
			Tpl::showpage('zhuanti/20151212-2/index_show');

		}
	}

	/**
	 * 杜 双十二大惠站 
	 */
	public function ad_20151212_1Op(){
		showMessage('您访问的活动已结束','http://www.96567.com/vip/','html','error');
		exit();
		$miaosha_classes = Model('miaosha_class')->getList(array('order'=>' start_hour asc '));
        $new_classes = array();
        foreach($miaosha_classes as $k=>$v){
            $new_classes[$v['class_id']] = $v;
        }
		$model_miaosha = Model('miaosha');
		//获取秒杀列表
		$condition = array();
        //$condition['state'] = '20';
        $condition['start_time'] = array(array('gt', strtotime(date('Y-m-d'))),array('lt', strtotime(date('Y-m-d')) + 86400),'and');
        $miaosha_info = $model_miaosha->getMiaoshaList($condition,null,'state desc,start_time desc,miaosha_id asc');
		$miaosha_list = array();
        foreach($miaosha_info as $k=>$v){
            if($v['start_time'] > strtotime(date('Y-m-d')) && $v['start_time'] < (strtotime(date('Y-m-d')) + 86400)){
			   $start_hour = $new_classes[$v['class_id']]['start_hour'];
			   $end_hour   = $new_classes[$v['class_id']]['end_hour'];
			   if(count($miaosha_list[$start_hour]) < 2){ // 每个时间档位只取两个秒杀
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
		$condition = array();
		//获取限时折扣活动下指定活动id的商品
		$condition['xianshi_id'] = '13';
		$shuhua_goods_list = $this->ZtModel->getXianshiGoodsExtendList($condition);
		Tpl::output('shuhua_goods_list',$shuhua_goods_list);
		//$condition['xianshi_id'] = '16';
		//$qiabi_goods_list = $this->ZtModel->getXianshiGoodsExtendList($condition);
		$goodsid_array = array('0'=>'11987','1'=>'11959','2'=>'11982','3'=>'11998','4'=>'11974','5'=>'11975');
		$goods_in['goods_id'] = array('in', $goodsid_array);
		$goods_list = Model('goods')->getGoodsList($goods_in);
		Tpl::output('qiabi_goods_list',$goods_list);
		$condition['xianshi_id'] = '15';
		$wenwan_goods_list = $this->ZtModel->getXianshiGoodsExtendList($condition);
		Tpl::output('wenwan_goods_list',$wenwan_goods_list);

		Tpl::output('html_title',"收藏天下双12大惠站，不止五折。");
		Tpl::output('seo_keywords',"收藏天下，双12，五折，满赠，限时立减，单品大促，新人惠，礼包，促销");
		Tpl::output('seo_description',"收藏天下双12疯狂大惠站，不止是五折！自2015年12月12日至12月31日，每日五折秒抢热门藏品，更多藏品限时折扣，好货不等人哦！还有新人特别礼包、满赠礼可以免费拿，超大力度尽在收藏天下1212。");
		Tpl::showpage('zhuanti/20151212-1/index_show');
	}



	/**
	 * 杜 招商平台 20151203
	 */
	public function ad_20151203Op(){
		Tpl::showpage('zhuanti/20151203/index_show','null_layout');
	}

	/**
	 * 杜 等值兑换活动 20151126
	 */
	public function ad_20151126Op(){
		showMessage('您访问的活动已结束','index.php?act=zhuanti&op=ad_20160115','html','error');
		exit();
		if($_GET['action'] == 'zhu_ce'){
			$model_member	= Model('member');
			$register_info = array();
			$register_info['username'] = $_POST['user_name'];
			$register_info['password'] = $_POST['password'];
			$register_info['password_confirm'] = $_POST['password'];
			$register_info['mobile'] = $_POST['mobile'];
			$register_info['member_from'] = '航天钞兑换';
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
			Tpl::output('html_title',"中国航天纪念钞等面值兑换-收藏天下");
			Tpl::showpage('zhuanti/20151126/index_show');
		}
	}

	/**
	 * 杜 招商 活动 20151121
	 */
	public function ad_20151121Op(){
		if($_GET['action'] == 'post'){
			//提交
			$dataArr['name'] = $_POST['name']; //姓名
			$dataArr['mobile'] = $_POST['mobile'];//电话
			$dataArr['address'] = trim($_POST['address']);//地址
			$dataArr['contet'] = trim($_POST['contet']);//留言内容
			$dataArr['member_id'] = intval($_SESSION['member_id']);//会员id
			$dataArr['member_name'] = $_SESSION['member_name'];//会员名称
			$dataArr['add_time'] = time();//时间
			$dataArr['ad_name'] = '20151121';//活动编号
			//检查该信息是否领取过
			$LQCount = $this->ZtModel->LinQuCount(array('mobile'=>$dataArr['mobile'],'ad_name'=>$dataArr['ad_name']));
			if($LQCount > 0){
				$result['error'] = -1;
				echo json_encode($result);
				exit;
			}
			$this->ZtModel->insertLinQu($dataArr);
			$result['error'] = 1;
			echo json_encode($result);
			exit;
		}elseif($_GET['action'] == 'url_admin'){
				//登录检查验证
				if($_POST){
					$user=$_POST["username"];
					$pws=$_POST["password"];
					if($user == "admin" && $pws =="admin123123"){
					   setcookie("DfZtAdmin", "1");
					   header("location:index.php?act=zhuanti&op=ad_20151121&action=url_admin");
					}else{
						echo "<script>window.alert('登录失败返回重新登录');window.location.href='index.php?act=zhuanti&op=ad_20151121&action=url_admin';</script>";
						exit;
					}
				}else{
					if(empty($_COOKIE["DfZtAdmin"])) {
						Tpl::showpage('zhuanti/20151121/admin/login','null_layout');
					}else{
						$getLotteryReceiveList = $this->ZtModel->getLotteryReceiveList(array('ad_name'=>'20151121'),'*','20','id desc');
						Tpl::output('show_page',$this->ZtModel->showpage());
						Tpl::output('List',$getLotteryReceiveList);
						Tpl::showpage('zhuanti/20151121/admin/adminindex','null_layout');
					}
				}
				
		}else{
			
			Tpl::output('html_title',"收藏天下艺术馆-收藏产业连锁化领航者");
			Tpl::showpage('zhuanti/20151121/index_show');
		}
	}

	/**
	 * 杜 双十一活动 20151111
	 */
	public function ad_20151111Op(){
		if($_GET['action'] == 'lottery_ajax'){
			//活动结束时间 11月21号
			if(time() > 1448899200){
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
			//获得会员的已抽奖次数
			$YiChouNum = $this->ZtModel->getLotteryCount(array('ad_name'=>'20151111','member_id'=>$member_id));
			$MianFei = 1;//设置每天免费抽奖的次数
			$MianFeiCount = $this->ZtModel->getMianFeiLottery(array('ad_name'=>'20151111','member_id'=>$member_id,'year'=>date("Y",time()),'month'=>date("m",time()),'day'=>date("d",time())),$MianFei);

			$MianFeiCount = $MianFeiCount <= 0 ? 0 : $MianFeiCount;
			//判断免费抽奖次数是否已用完
			if($MianFeiCount <= 0){
				//获取满足条件的订单 
				$order = $this->ZtModel->getOrder(array('buyer_id'=>$member_id,'order_state'=>array('egt',20),'add_time'=>array('elt','1448899200'),'add_time'=>array('egt','1447171200')),'order_id');
				$ChouJiangNum = intval((count($order)*3)+$MianFeiCount-$YiChouNum);
				//判断是否有抽奖次数
				if($ChouJiangNum <= 0){
					//抽奖次数用完
					if($YiChouNum > 0){
						$result['error'] = -3;
						echo json_encode($result);
						exit;
					}
					//未获得抽奖次数
					$result['error'] = -2;
					echo json_encode($result);
					exit;
				}
			}
			
			/**根据会员抽奖订单个数计算抽奖**/
			//所有奖品
			$prize_arr = array('0' => array(
				'id'=>1,'min'=>5,'max'=>32,'prize'=>'中国书协会员郭友华法作品《心经》','v'=>8146,'type'=>'1','rand'=>'5','num'=>5),
				'1' => array('id'=>2,'min'=>41,'max'=>68,'prize'=>'立减20元（全平台）','v'=>11,'type'=>'2','rand'=>'20'), 
				'2' => array('id'=>3,'min'=>77,'max'=>104,'prize'=>'100积分','v'=>100,'type'=>'3','rand'=>'421'),
				'3' => array('id'=>4,'min'=>113,'max'=>140,'prize'=>'中国人民抗日战争暨世界反法西斯战争胜利70周年普通纪念币 单枚','v'=>10733,'type'=>'1','rand'=>'10','num'=>30),
				'4' => array('id'=>5,'min'=>149,'max'=>176,'prize'=>'20元夺宝金','v'=>127,'type'=>'4','rand'=>'20'),
				'5' => array('id'=>6,'min'=>185,'max'=>212,'prize'=>'立减10元（全平台）','v'=>10,'type'=>'2','rand'=>'50'),
				'6' => array('id'=>7,'min'=>221,'max'=>248,'prize'=>'官春英工笔精品《花间记》团面','v'=>9123,'type'=>'1','rand'=>'1','num'=>3),
				'7' => array('id'=>8,'min'=>257,'max'=>284,'prize'=>'中国美术家协会理事 吴冠中版画《小双燕》','v'=>11146,'type'=>'1','rand'=>'1','num'=>2),
				'8' => array('id'=>9,'min'=>293,'max'=>320,'prize'=>'10元夺宝金','v'=>126,'type'=>'4','rand'=>'50'),
				'9' => array('id'=>10,'min'=>329,'max'=>356,'prize'=>'50积分','v'=>50,'type'=>'3','rand'=>'422')
				);
				foreach ($prize_arr as $key => $val) { 
					$arr[$val['id']] = $val['rand']; 
				}
				$rid = $this->getRand($arr); //根据概率获取奖项id 
				//判断是否获得实物奖品如果获得实物奖品 
				//则检测当天实物奖品是否发放完成 且每一个会员只能领取一件实物奖品
				//限制一天只能发放三个实物奖品
				if($prize_arr[$rid-1]['type'] == 1){
					//获取当前会员是否抽中过实物奖品
					$l_id[0] = 0;
					$l_id[1] = 3;
					$l_id[2] = 6;
					$l_id[3] = 7;
					$LM_Count = $this->ZtModel->getLotteryCount(array('ad_name'=>'20151111','member_id'=>$member_id,'l_id'=>array('in'=>$l_id)));
					if($LM_Count > 0){
						$rid = 10;
					}else{
						//判断当天实物奖品是否发放完成
						//每天限制数量为三个实物
						$DangTianShiWu = $this->ZtModel->getLotteryCount(array('ad_name'=>'20151111','year'=>date("Y",time()),'month'=>date("m",time()),'day'=>date("d",time()),'l_id'=>array('in'=>$l_id)));
						if($DangTianShiWu >= 3){
							$rid = 10;
						}else{
							$ShiWuCount = $this->ZtModel->getLotteryCount(array('ad_name'=>'20151111','member_id'=>$member_id,'l_id'=>array('in'=>$l_id)));
							//判断奖品是否发放完成
							if($ShiWuCount > intval($prize_arr[$rid-1]['num'])){
								$rid = 10;
							}
						}
					}
				}

				$res = $prize_arr[$rid-1]; //中奖项  
				$is_fafang = 0;
				if($res['type'] == 1){
					//获得实物奖品
				}elseif($res['type'] == 2){
					//获得代金卷 发放代金卷
					$this->ZtModel->exchangeVoucher($res['v'],intval($_SESSION['member_id']));
					$is_fafang = 1;
				}elseif($res['type'] == 3){
					$insert_arr['pl_memberid'] = $_SESSION['member_id'];
					$insert_arr['pl_membername'] = $_SESSION['member_name'];
					$insert_arr['pl_points'] = $res['v'];
					$insert_arr['pl_desc'] = '从新开始双十一抽奖';
					$obj_points = Model('points');
					$obj_points->savePointsLog('zhuanti',$insert_arr,true);
					//获得积分
					$is_fafang = 1;
				}elseif($res['type'] == 4){
					//发放夺宝红包
					$ToApi = new ToApi();
					$user_info = Model('member')->getMemberInfoByID($_SESSION['member_id']);
					$coupon = $ToApi->send_yiyuan_coupon($user_info['member_name'],$res['v']);
					if($coupon == 2){
						$mobile_phone = $user_info['member_mobile'];//JieMiMobile(); //加密手机号
						$is_cheng = $ToApi->act_yiyuanuser($user_info['member_name'],$mobile_phone,$user_info['member_passwd'],$user_info['ec_salt'],$user_info['openid'],$user_info['rank_points'],'96567');
						if($is_cheng['res'] == 'succ'){
							$ToApi->send_yiyuan_coupon($user_info['member_name'],$res['v']);
						}
					}
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
				$data['ad_name'] = '20151111';
				$data['l_name'] = $res['prize'];
				$data['l_id'] = ($rid-1);
				$data['is_fafang'] = $is_fafang;
				$this->ZtModel->addLottery($data);
				
				$min = $res['min']; 
				$max = $res['max'];
				$result['type']  =  $res['type'];
				$result['angle'] = mt_rand($min,$max); //随机生成一个角度 
				$result['prize'] = $res['prize'];
				echo json_encode($result);
				exit;
		}elseif($_GET['action'] == 'post_ajax'){
				$dataArr['name'] = $_POST['name']; //姓名
				$dataArr['mobile'] = $_POST['mobile'];//电话
				$dataArr['l_id'] = intval($_POST['l_id']);//奖品编号
				$dataArr['member_id'] = intval($_SESSION['member_id']);//领奖会员id
				$dataArr['member_name'] = $_SESSION['member_name'];//领奖会员名称
				$dataArr['ad_name'] = '20151111';//领奖会员名称
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
				echo '1';
				exit;
		}elseif($_GET['action'] == 'youhui_ajax'){

				//领取优惠卷
				$member_id = intval($_SESSION['member_id']);

				//检查是否登录
				if($member_id <= 0){
					$result['error'] = -1;
					echo json_encode($result);
					exit;
				}
				//检查是否已经领取过、
				$VoucherCount = $this->ZtModel->VoucherCount(array('voucher_t_id'=>'6','voucher_owner_id'=>intval($member_id)));
				if($VoucherCount > 0){
					$result['error'] = -2;
					echo json_encode($result);
					exit;
				}
				//活动结束时间 11月21号
				if(time() > 1448899200){
					$result['error'] = -3;
					echo json_encode($result);
					exit;
				}
				$this->ZtModel->exchangeVoucher('6',intval($member_id));
				$this->ZtModel->exchangeVoucher('7',intval($member_id));
				$this->ZtModel->exchangeVoucher('8',intval($member_id));
				$this->ZtModel->exchangeVoucher('8',intval($member_id));
				$this->ZtModel->exchangeVoucher('9',intval($member_id));
				$this->ZtModel->exchangeVoucher('9',intval($member_id));
				$this->ZtModel->exchangeVoucher('9',intval($member_id));
				$this->ZtModel->exchangeVoucher('9',intval($member_id));
				//发放夺宝红包
				$ToApi = new ToApi();
				$user_info = Model('member')->getMemberInfoByID($_SESSION['member_id']);
				$coupon = $ToApi->send_yiyuan_coupon($user_info['member_name'],'128');
				if($coupon == 2){
					$mobile_phone = $user_info['member_mobile'];//JieMiMobile(); 加密手机号
					$is_cheng = $ToApi->act_yiyuanuser($user_info['member_name'],$mobile_phone,$user_info['member_passwd'],$user_info['ec_salt'],$user_info['openid'],$user_info['rank_points'],'96567');
					if($is_cheng == 1){
						$ToApi->send_yiyuan_coupon($user_info['member_name'],'128');
						$ToApi->send_yiyuan_coupon($user_info['member_name'],'129');
						$ToApi->send_yiyuan_coupon($user_info['member_name'],'130');
					}
				}else{
						$ToApi->send_yiyuan_coupon($user_info['member_name'],'129');
						$ToApi->send_yiyuan_coupon($user_info['member_name'],'130');
				}
				$result['error'] = 1;
				echo json_encode($result);
				exit;
		}elseif($_GET['action'] == 'url_admin'){
				//登录检查验证
				if($_POST){
					$user=$_POST["username"];
					$pws=$_POST["password"];
					if($user == "杜飞" && $pws =="df123123"){
					   setcookie("DfZtAdmin", "1");
					   header("location:index.php?act=zhuanti&op=ad_20151111&action=url_admin");
					}else{
						echo "<script>window.alert('登录失败返回重新登录');window.location.href='index.php?act=zhuanti&op=ad_20151111&action=url_admin';</script>";
						exit;
					}
				}else{
					if(empty($_COOKIE["DfZtAdmin"])) {
						Tpl::showpage('zhuanti/20151111/admin/login','null_layout');
					}else{
						//获得所有会员中奖记录
						$SuoYouLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20151111'),'*,(SELECT member_name FROM shop_member WHERE `shop_member`.member_id = `shop_lottery_member`.member_id) as member_name','20','is_fafang ASC,id desc');
						Tpl::output('show_page',$this->ZtModel->showpage());
						if($SuoYouLotteryList){
							foreach($SuoYouLotteryList as $k=>$v){
								$Receive = $this->ZtModel->getLotteryReceive(array('l_id'=>$v['id']));
								$SuoYouLotteryList[$k]['liqu_name'] = $Receive['name'];
								$SuoYouLotteryList[$k]['liqu_mobile'] = $Receive['mobile'];
							}
						}
						Tpl::output('List',$SuoYouLotteryList);
						Tpl::showpage('zhuanti/20151111/admin/adminindex','null_layout');
					}
				}
				
		}else{
			//获取限时折扣活动下指定活动id的商品
			$condition['xianshi_id'] = '12';
            $xianshi_goods_list = $this->ZtModel->getXianshiGoodsExtendList($condition);
			Tpl::output('goods_list',$xianshi_goods_list);
			//获得当前会员中奖记录
			$MyLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20151111','member_id'=>$_SESSION['member_id']));
			Tpl::output('MyLotteryList',$MyLotteryList);
			//获得所有会员中奖记录
			$SuoYouLotteryList = $this->ZtModel->getLotteryList(array('ad_name'=>'20151111'));
			Tpl::output('SuoYouLotteryList',$SuoYouLotteryList);
			Tpl::output('html_title',"收藏天下双11从新开启，给您最真的优惠。");
			Tpl::output('seo_keywords',"收藏天下，双11，优惠活动，促销，抽奖，限时立减，单品大促");
			Tpl::output('seo_description',"收藏天下双11 全新升级，平台正式运营，商铺云集，热门藏品全搜罗，给您便捷实惠。上新大促专场活动，真实、大力度。免费送1111大礼包，领券下单更实惠；赠免费抽奖，名家书画0元得；享单品限时立减，价格绝对实惠。");
			Tpl::showpage('zhuanti/20151111/index_show');
		}
		
	}

    /*
     * 迎新大促 xin 20151231
     */
    public function ad_20160101Op(){
        Tpl::output('html_title',"收藏天下元旦特别订制套餐，套餐内第二件半价。");
        Tpl::output('seo_keywords',"收藏天下,元旦,第二件半价,五折,活动,促销,送礼");
        Tpl::output('seo_description',"收藏天下元旦特别订制套餐，会员购套餐享受最优惠价格，套餐内第二件藏品半价，均是最新最热硬挺收藏。过新年，购精品送老人，爱人，伙伴，超低折扣买，实惠又满意。");
        Tpl::showpage('zhuanti/20160101/index_show');
    }

    /*
     * 万达专题 xin 20160114
     */
    public function ad_20160114Op(){
        Tpl::output('html_title',"这里大有希望“！报告习大大，我们《艺境艾美》名家书画特展1月16号在万达艾美准备好了！ - 收藏天下");
        Tpl::output('seo_keywords',"画展,书画,展览,作品");
        Tpl::output('seo_description',"收藏天下与万达集团首次跨界合作，共同打造国内首批艺术品主题酒店，并兹于2016年1月16日在重庆万达艾美酒店举办首届《艺境 艾美——中国名家书画大型特展》");
        Tpl::showpage('zhuanti/20160114/index_show');
    }

    /*
     * 平台招商活动 xin 20151118
     */
    public function zhaoshangOp(){
        Tpl::output('html_title','收藏天下平台招商入驻'.' - '.C('site_name'));
        Tpl::output('nofooter',true);
        Tpl::showpage('zhuanti/20151118/index_show');
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




	/*
     * Add is name lt 2016-02-29 微信注册送红包活动
     */
    public function weixinOp(){

    	if($_SESSION['member_id']){
        	$user_info = Model()->table('member_hong_kl')->where(array('K_MemberId'=>$_SESSION['member_id']))->find();
        	Tpl::output('user_info',$user_info);
        }

        Tpl::output('html_title','注册送红包活动'.' - '.C('site_name'));
        Tpl::output('nofooter',true);
        Tpl::showpage('zhuanti/weixin/index_show');
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
        // $register_info['openid'] = $_SESSION['openid'];
        $register_info['member_from'] = '微信注册发红包';

        if($_POST['Yzm'] != $_SESSION['wx_phone_yzm'][$_POST['mobile']]){
        	$result['error'] = '验证码不正确、请重新获取！';
            echo json_encode($result);
            exit();
        }

        if($_POST['mobile'] != $_SESSION['wx_phone']){
        	$result['error'] = '验证码获取手机号和注册手机号不匹配~！';
            echo json_encode($result);
            exit();
        }


        $member_info = $model_member->register($register_info);

        if(!isset($member_info['error'])) {

        	$dataArr['K_MemberId'] = $member_info['member_id'];
        	$dataArr['K_MemberName'] = $member_info['member_name'];
        	// $dataArr['K_OpenId'] = $member_info['openid'];
        	$dataArr['K_KouLing'] = $this->create_noncestr(8);
        	$dataArr['K_Time'] = time();
        	if(Model()->table('member_hong_kl')->insert($dataArr)){
        		$result['msg'] = '注册成功';
        		$model_member->createSession($member_info,true);
        		// $result['K_MemberName'] = $dataArr['K_MemberName'];
        		// $result['K_KouLing'] = $dataArr['K_KouLing'];
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



    /*Add is name lt 2016-02-26 获取手机验证码*/
    public function getPhoneYzmOp(){
		
		if(empty($_POST["name"])){
    		exit;
    	}
    	if(empty($_POST["mobile"])){
    		exit;
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

    	$user_info = Model()->table('member')->where($name)->find();

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


    //生成随机字符串,不长于32位
    private function create_noncestr($length=32)
    {
       	$chars = "abcdefghijklmnopqrstuvwxyz0123456789";  
		$str ="";
		for ( $i = 0; $i < $length; $i++ )  {  
			$str.= substr($chars, mt_rand(0, strlen($chars)-1), 1);  
		}  
		return $str; 
    }


    public function testNameOp(){
    	$name['member_name'] = $_POST['user_name'];

    	$user_info = Model()->table('member')->where($name)->find();

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

    	$user_info = Model()->table('member')->where($name)->find();

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
		$this->addAddressOrder($_POST,$goodsid_array,$goods_amount,$shipping_fee,'免费送70周年纪念币','免费领取');
	}

	public function addAddressOrder($POST,$goodsid_array,$goods_amount=0,$shipping_fee=0,$referer='',$lai_yuan='',$other=false,$lid,$payment_code='online'){
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
			
			$order = $this->ZtModel->add_order($data,$goodsid_array,$goods_amount,$shipping_fee,$referer,$lai_yuan,$other,$lid,$payment_code);
			if($order['error']){
				exit(json_encode(array('state'=>false,'msg'=>$order['error'])));
			}else{
				exit(json_encode(array('state'=>true,'addr_id'=>$insert_id,'pay_sn'=>$order['pay_sn'])));
			}
		}else {
			exit(json_encode(array('state'=>false,'msg'=>"请填写真实的收获地址")));
		}
	}

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

    public function weixinUrlOp(){
    	header("location:/index.php?act=zhuanti&op=weixin#balloon");
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
