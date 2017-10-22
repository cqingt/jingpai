<?php
/**
 * 我的购物车
 *
 *
 *
 *
 * by 33hao.com 好商城V3 运营版
 */


defined('InShopNC') or exit('Access Invalid!');

class member_cartControl extends mobileHomeControl {

	public function __construct() {
		parent::__construct();
        Tpl::setDir('member');

        Tpl::setLayout('member_layout');
        $this->member_info = Model('member')->getMemberInfoByID($_SESSION['member_id']);
	}

    /**
     * 购物车列表
     */
    public function cart_listOp() {
        if(empty($this->member_info)) {
			$current_url = request_uri();
			redirect('index.php?act=login&ref_url='.urlencode($current_url));
        }

        $model_cart = Model('cart');
        $logic_buy_1 = logic('buy_1');

        $condition = array('buyer_id' => $this->member_info['member_id']);
        $cart_list	= $model_cart->listCart('db', $condition);
        $cart_list = $logic_buy_1->getGoodsCartList($cart_list);
        $sum = 0;

        /* Add is name lt 2016-10-25 活动商品价格单独计算*/
        $activity_list = Model('activity_goods')->getMemberAddActivityList();
        /* End */

        foreach ($cart_list as $key => &$value) {

            /* Add is name lt 2016-10-25 活动商品价格单独计算*/
            if(!empty($activity_list[$value['goods_id']])){
                $value['goods_price'] = $activity_list[$value['goods_id']]['A_GoodsPrice'];
            }
            /* End */

            $cart_list[$key]['goods_image_url'] = cthumb($value['goods_image'], $value['store_id']);
            $cart_list[$key]['goods_sum'] = ncPriceFormat($value['goods_price'] * $value['goods_num']);
            $sum += $cart_list[$key]['goods_sum'];
        }

        Tpl::output('cart_list',$cart_list);
        Tpl::output('sum', ncPriceFormat($sum));
        Tpl::output('nav_title','购物车列表');
        Tpl::output('html_title','购物车列表 - '.C('site_name'));
		Tpl::output('buy_step','step1');
        Tpl::showpage('cart_list');
    }

    /**
     * 购物车添加
     */
    public function cart_addOp() {
        $model_goods = Model('goods');
        $logic_buy_1 = Logic('buy_1');
        if (is_numeric($_POST['goods_id'])) {

            //商品加入购物车(默认)
            $goods_id = intval($_POST['goods_id']);
            $quantity = intval($_POST['quantity']);
            if ($goods_id <= 0) return ;
            $goods_info	= $model_goods->getGoodsOnlineInfoAndPromotionById($goods_id);

            //抢购
            $logic_buy_1->getGroupbuyInfo($goods_info);

            //限时折扣
            $logic_buy_1->getXianshiInfo($goods_info,$quantity);

            $this->_check_goods($goods_info,$_POST['quantity']);

        } elseif (is_numeric($_GET['bl_id'])) {

            //优惠套装加入购物车(单套)
            if (!$_SESSION['member_id']) {
                output_error('请先登录');
            }
            $bl_id = intval($_GET['bl_id']);
            if ($bl_id <= 0) return ;
            $model_bl = Model('p_bundling');
            $bl_info = $model_bl->getBundlingInfo(array('bl_id'=>$bl_id));

            if (empty($bl_info) || $bl_info['bl_state'] == '0') {
                output_error('该优惠套装已不存在，建议您单独购买');
            }

            //检查每个商品是否符合条件,并重新计算套装总价
            $bl_goods_list = $model_bl->getBundlingGoodsList(array('bl_id'=>$bl_id));
            $goods_id_array = array();
            $bl_amount = 0;
            foreach ($bl_goods_list as $goods) {
                $goods_id_array[] = $goods['goods_id'];
                $bl_amount += $goods['bl_goods_price'];
            }

            $model_goods = Model('goods');
            $goods_list = $model_goods->getGoodsOnlineListAndPromotionByIdArray($goods_id_array);

            foreach ($goods_list as $goods) {
                $this->_check_goods($goods,1);
            }

            //优惠套装作为一条记录插入购物车，图片取套装内的第一个商品图
            $goods_info    = array();
            $goods_info['store_id']	= $bl_info['store_id'];
            $goods_info['goods_id']	= $goods_list[0]['goods_id'];
            $goods_info['goods_name'] = $bl_info['bl_name'];
            $goods_info['goods_price'] = $bl_amount;
            $goods_info['goods_num']   = 1;
            $goods_info['goods_image'] = $goods_list[0]['goods_image'];
            $goods_info['store_name'] = $bl_info['store_name'];
            $goods_info['bl_id'] = $bl_id;
            $quantity = 1;
        }
        //已登录状态，存入数据库,未登录时，存入COOKIE
        if($_SESSION['member_id']) {
            $save_type = 'db';
            $goods_info['buyer_id'] = $_SESSION['member_id'];
        } else {
            $save_type = 'cookie';
        }
		  
        $model_cart	= Model('cart');
        $insert = $model_cart->addCart($goods_info,$save_type,$quantity);

        if ($insert) {
            //购物车商品种数记入cookie
            setNcCookie('cart_goods_num',$model_cart->cart_goods_num,2*3600);
            $data = array('state'=>'true', 'num' => $model_cart->cart_goods_num, 'amount' => ncPriceFormat($model_cart->cart_all_price));
			$cat_id = $insert.'|'.$quantity;
			output_data(array('cat_id'=>$cat_id));
        } else {
            output_error('加入购物车失败');
        }
        output_data('1');

    }

    /**
     * 购物车删除
     */
    public function cart_delOp() {
        $cart_id = intval($_POST['cart_id']);

        $model_cart = Model('cart');

        if($cart_id > 0) {
            $condition = array();
            $condition['buyer_id'] = $this->member_info['member_id'];
            $condition['cart_id'] = $cart_id;

            $model_cart->delCart('db', $condition);
        }

        output_data('1');
    }

    /**
     * 更新购物车购买数量
     */
    public function cart_edit_quantityOp() {
		$cart_id = intval(abs($_POST['cart_id']));
		$quantity = intval(abs($_POST['quantity']));
		if(empty($cart_id) || empty($quantity)) {
            output_error('参数错误');
		}

		$model_cart = Model('cart');

        $cart_info = $model_cart->getCartInfo(array('cart_id'=>$cart_id, 'buyer_id' => $this->member_info['member_id']));

        //检查是否为本人购物车
        if($cart_info['buyer_id'] != $this->member_info['member_id']) {
            output_error('参数错误');
        }

        //检查库存是否充足
        if(!$this->_check_goods_storage($cart_info, $quantity, $this->member_info['member_id'])) {
            output_error('库存不足');
        }

		$data = array();
        $data['goods_num'] = $quantity;
        $update = $model_cart->editCart($data, array('cart_id'=>$cart_id));
		if ($update) {
		    $return = array();
            $return['quantity'] = $quantity;
			$return['goods_price'] = ncPriceFormat($cart_info['goods_price']);
			$return['total_price'] = ncPriceFormat($cart_info['goods_price'] * $quantity);
            output_data($return);
		} else {
            output_error('修改失败');
		}
    }

    /**
     * 检查库存是否充足
     */
    private function _check_goods_storage($cart_info, $quantity, $member_id) {
		$model_goods= Model('goods');
        $model_bl = Model('p_bundling');
        $logic_buy_1 = Logic('buy_1');

		if ($cart_info['bl_id'] == '0') {
            //普通商品
		    $goods_info	= $model_goods->getGoodsOnlineInfoAndPromotionById($cart_info['goods_id']);

		    //抢购
		    $logic_buy_1->getGroupbuyInfo($goods_info);

		    //限时折扣
		    $logic_buy_1->getXianshiInfo($goods_info,$quantity);
 
		    $quantity = $goods_info['goods_num'];
		    if(intval($goods_info['goods_storage']) < $quantity) {
                return false;
		    }
		} else {
		    //优惠套装商品
		    $bl_goods_list = $model_bl->getBundlingGoodsList(array('bl_id' => $cart_info['bl_id']));
		    $goods_id_array = array();
		    foreach ($bl_goods_list as $goods) {
		        $goods_id_array[] = $goods['goods_id'];
		    }
		    $bl_goods_list = $model_goods->getGoodsOnlineListAndPromotionByIdArray($goods_id_array);

		    //如果有商品库存不足，更新购买数量到目前最大库存
		    foreach ($bl_goods_list as $goods_info) {
		        if (intval($goods_info['goods_storage']) < $quantity) {
                    return false;
		        }
		    }
		}
        return true;
    }

    /**
     * 检查商品是否符合加入购物车条件
     * @param unknown $goods
     * @param number $quantity
     */
    private function _check_goods($goods_info, $quantity) {
        if(empty($quantity)) {
            exit(json_encode(array('msg'=>Language::get('wrong_argument','UTF-8'))));
        }
        if(empty($goods_info)) {
            exit(json_encode(array('msg'=>Language::get('cart_add_goods_not_exists','UTF-8'))));
        }
        if ($goods_info['store_id'] == $_SESSION['store_id']) {
            exit(json_encode(array('msg'=>Language::get('cart_add_cannot_buy','UTF-8'))));
        }
        if(intval($goods_info['goods_storage']) < 1) {
            exit(json_encode(array('msg'=>Language::get('cart_add_stock_shortage','UTF-8'))));
        }
        if(intval($goods_info['goods_storage']) < $quantity) {
            exit(json_encode(array('msg'=>Language::get('cart_add_too_much','UTF-8'))));
        }
        if ($goods_info['is_virtual'] || $goods_info['is_fcode'] || $goods_info['is_presell']) {
            exit(json_encode(array('msg'=>'该商品不允许加入购物车，请直接购买','UTF-8')));
        }
    }

}
