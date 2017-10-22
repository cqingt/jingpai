<?php
/**
 * Class ToApi
 *
 *  @ API接口类，用于与用户中心或其他平台对接调用使用
 *
 * 方法调用：$ToApi = new ToApi(); $ToApi->test();
 *
 * author：Xin
 *
 * date：2015.10.14
 *
 */

defined('InShopNC') or exit('Access Invalid!');

class ToApi {

    public function __construct(){
        $this->sign_key = "sdfdd4e9ac3673de3bc12b1ccef908";
        $this->center_uri = BASE_SITE_URL."/shop/centerapi.php";
        $this->yiyuan_uri = "http://duobao.96567.com/?/api/usercenterapi/";
    }

    /**
     *  商城修改openid后同步openid到中心
     */
    public function update_openid($username = '', $openid = '') {
        $param_arr = array(
            'method' => 'UpdateOpenid',
            'time' => time(),
            'from' => '96567',
            'username' => $username,
            'openid' => $openid,
        );
        $param_arr['sign'] = $this->get_sign($param_arr);
        $center_res = $this->httpPOST($this->center_uri, $param_arr);
        return json_decode($center_res,true);
    }


	//活动，商城活动送1元夺宝金
    function shop_send_money($username = '', $money = '',$desc = '商城活动送一元夺宝金') {
        $param_arr = array(
            'method' => 'ShopSendMoney',
            'time' => time(),
            'from' => '96567',
            'username' => $username,
            'money' => $money,
			'desc' => $desc,
        );
        $param_arr['sign'] = $this->get_sign($param_arr);
        $center_res = $this->httpPOST($this->yiyuan_uri, $param_arr);
        return json_decode($center_res,true);
    }

	//活动，激活一元夺宝用户
    function act_yiyuanuser($username = '', $mobile = '', $password = '', $ec_salt = '', $openid = '', $rank_points = '', $u_from = '96567') {
        $param_arr = array(
            'method' => 'ActYiyuanUser',
            'time' => time(),
            'from' => '96567',
            'username' => $username,
            'mobile'   => $mobile,
            'password' => $password,
            'ec_salt'  => $ec_salt,
            'openid'    => $openid,
            'rank_points'    => $rank_points,
            'u_from'    => $u_from,
        );
        $param_arr['sign'] = $this->get_sign($param_arr);
        $center_res = $this->httpPOST($this->yiyuan_uri, $param_arr);
        return $center_res;
    }

	 /*
     * 发放红包给夺宝用户
     * 传入参数，夺宝用户username，夺宝红包id
     */
    function send_yiyuan_coupon($username, $couponid){
        $param_arr = array(
            'method' => 'SendYiyuanCoupon',
            'time' => time(),
            'from' => '96567',
            'username' => $username,
            'couponid' => $couponid,
        );
        $param_arr['sign'] = $this->get_sign($param_arr);
        $center_res = $this->httpPOST($this->yiyuan_uri, $param_arr);
        return $center_res;
    }

    /**
     *  商城修改密码后同步密码到中心
     */
    public function update_password($username = '', $newpassword = '') {
        $param_arr = array(
            'method' => 'UpdatePassword',
            'time' => time(),
            'from' => '96567',
            'username' => $username,
            'newpassword' => $newpassword,
        );

        $param_arr['sign'] = $this->get_sign($param_arr);

        $center_res = $this->httpPOST($this->center_uri, $param_arr);
        return json_decode($center_res,true);
    }

    /**
     *  商城商家获取自己夺宝商品信息
     */
    public function get_duobao_item($store_id = '',$size = '20',$page = '1') {
        $param_arr = array(
            'method' => 'GetDuobaoItem',
            'time' => time(),
            'from' => '96567',
            'store_id' => $store_id,
            'size' => $size,
            'page' => $page,
        );

        $param_arr['sign'] = $this->get_sign($param_arr);
        $center_res = $this->httpPOST($this->yiyuan_uri, $param_arr);
        return json_decode($center_res,true);
    }

    /**
     *  商城商家获取自己夺宝商品中奖订单信息
     */
    public function get_duobao_order($store_id = '',$size = '20',$page = '1') {
        $param_arr = array(
            'method' => 'GetDuobaoOrder',
            'time' => time(),
            'from' => '96567',
            'store_id' => $store_id,
            'size' => $size,
            'page' => $page,
        );

        $param_arr['sign'] = $this->get_sign($param_arr);

        $center_res = $this->httpPOST($this->yiyuan_uri, $param_arr);
        return json_decode($center_res,true);
    }

    /**
     *  商城商家发货同步至夺宝
     */
    public function duobao_fahuo($store_id,$gid,$company,$company_code) {
        $param_arr = array(
            'method' => 'DuobaoFahuo',
            'time' => time(),
            'from' => '96567',
            'store_id' => $store_id,
            'gid' => $gid,
            'company' => $company,
            'company_code' => $company_code,
        );

        $param_arr['sign'] = $this->get_sign($param_arr);

        $center_res = $this->httpPOST($this->yiyuan_uri, $param_arr);
        return json_decode($center_res,true);
    }

    /**
     * @ 生成签名值sign
     */
    protected function get_sign($params) {
        $arg = "";
        $params = $this->arg_sort($params);
        foreach($params as $key => $val){
            $arg .= $key.$val;
        }
        $sign = md5(md5($arg).$this->sign_key);
        return $sign;
    }

    /**
     * @ 数组排序
     */
    protected function  arg_sort($array) {
        ksort($array);
        reset($array);
        return $array;
    }

    /**
     * @ POST模式发送接口数据
     */
    private function  httpPOST($url, $data){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_POST, 1);
//        curl_setopt($curl, CURLOPT_POSTFIELDS, iconv('gb2312','utf-8',$data));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);

        curl_close($curl);
        return $result;
    }
}
