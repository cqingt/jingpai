<?php
/**
 * 入口文件
 *
 * 中心API接口被动请求统一入口
 *
 * author：Xin
 *
 * date：2015.10.13
 */

header("Content-type: text/html; charset=utf-8");
date_default_timezone_set('Asia/Shanghai');


//接口秘钥
define('SIGN_KEY','sdfdd4e9ac3673de3bc12b1ccef908');

//中心回调URL
define('YIYUAN_URI','http://1.96567.com/?/api/usercenterapi/');


$GLOBALS['center_core'] = $coreapi = new core_centerapi();

//获取接口参数并过滤非法字符 *注：如接口参数含有非法字符，这里需要进行修改

$params = array();
$params = $coreapi->safe_array($_POST);

//签名验证码
$sign_foreign = (empty($params['sign']))?'0':$params['sign'];
unset($params['sign']);

$GLOBALS['params'] = $params;
$get_sign = $coreapi->get_sign($params);


if($get_sign == $sign_foreign){
    $_GET['act']	= 'center';
    $_GET['op']		= (empty($params['method']))?'index':$params['method'];
    require_once(dirname(__FILE__).'/../index.php');
}else{
    $coreapi->res_message('fail','invalid signature ');
}
exit;




class core_centerapi
{

    public function __call($functionName, $args){
        $this->res_message('fail',"invalid method");
    }

    /**
     * @ 获取客户端ip
     */
    public function _get_ip(){
        if (isset($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], "unknown"))
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], "unknown"))
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if (isset($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
            $ip = $_SERVER['REMOTE_ADDR'];
        else if (isset($_SERVER['REMOTE_ADDR']) && isset($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
            $ip = $_SERVER['REMOTE_ADDR'];
        else $ip = "";
        return ($ip);
    }

    /**
     * @ 数组过滤
     */
    public function safe_array($params){
        $res = array();
        foreach($params as $key => $val){
            $res[$key] = $this->safe_replace($val);
        }
        return $res;
    }

    /**
     * @ 字符过滤
     */
    public function safe_replace($string) {
        $string = str_replace('%20','',$string);
        $string = str_replace('%27','',$string);
        $string = str_replace('%2527','',$string);
        $string = str_replace('*','',$string);
        $string = str_replace('"','&quot;',$string);
        $string = str_replace("'",'',$string);
        $string = str_replace('"','',$string);
        $string = str_replace(';','',$string);
        $string = str_replace('<','&lt;',$string);
        $string = str_replace('>','&gt;',$string);
        $string = str_replace("{",'',$string);
        $string = str_replace('}','',$string);
        $string = str_replace('\\','',$string);
        return $string;
    }

    /**
     * @ 生成签名值sign
     */
    public function get_sign($params) {
        $arg = "";
        $params = $this->arg_sort($params);
        foreach($params as $key => $val){
            $arg .= $key.$val;
        }
        $sign = md5(md5($arg).SIGN_KEY);
        return $sign;
    }

    /**
     * @ 数组排序
     */
    public function arg_sort($array) {
        ksort($array);
        reset($array);
        return $array;
    }

    /**
     * @ GET模式发送接口数据
     */
    public function httpGET($url){
        $output = file_get_contents($url);
        return $output;
    }

    /**
     * @ POST模式发送接口数据
     */
    public function httpPOST($url, $data){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_POST, 1);
//        curl_setopt($curl, CURLOPT_POSTFIELDS, iconv('gb2312','utf-8',$data));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        if (curl_errno($curl)) {
            $this->res_message('fail','Errno'.curl_error($curl));
        }
        curl_close($curl);
        return $result;
    }

    /**
     * @ 接口返回
     * $res : succ，fail
     * $message : 返回内容
     * return Json
     */
    public function res_message($res = 'fail', $message = ''){
        $return_arr = array(
            'res'     => $res,
            'message' => $message,
        );
        exit(json_encode($return_arr));
    }

    /**
     * @ UTF-8编码转换成GBK
     */
    public function utf8_to_gbk($data){
        $result = '';
        if(is_array($data)){
            foreach($data as $key => $val){
                if(is_array($val)){
                    $result[$key] = self::utf8_to_gbk($val);
                }else{
                    $result[$key] = iconv("UTF-8", "GBK//IGNORE", $val);
                }
            }
        }else{
            $result = iconv("UTF-8", "GBK//IGNORE", $data);
        }
        return $result;
    }

    /**
     * @ GBK编码转换成UTF-8
     */
    public function gbk_to_utf8($data){
        $result = '';
        if(is_array($data)){
            foreach($data as $key => $val){
                if(is_array($val)){
                    $result[$key] = self::gbk_to_utf8($val);
                }else{
                    $result[$key] = iconv("GBK", "UTF-8", $val);
                }
            }
        }else{
            $result = iconv("GBK", "UTF-8", $data);
        }
        return $result;
    }

}