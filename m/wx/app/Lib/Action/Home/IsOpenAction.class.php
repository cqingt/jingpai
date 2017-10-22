<?php
class IsOpenAction extends Action
{

    function __construct(){
        $this->sign_key = "sdfdd4e9ac3673de3bc12b1ccef908";
        $this->center_uri = "http://1.96567.com/?/api/usercenterapi/";
    }

    public function index()
    {
        $openid = trim($_GET['openid']);
        /*更新OpenId*/
        $this->saveOpenId($openid);
        /*提交到一元*/
        $id = $this->cash_money($openid);

        echo $id;
    }

    /*把OPENID更新进关注表*/
    private function saveOpenId($openid){
        /*连接所有OPENID表*/
        $is_open = M('users_is_wx','ecs_','mysql://shop:_96567_data@localhost:3306/_96567data_');
        /*查询是否存在*/
        $resultId = $is_open->where("W_OpenId='".$openid."'")->find();
        /*如果不存在则添加到关注表*/
        if(!$resultId){
            $dataArr['W_OpenId'] = $openid;
            $dataArr['W_Time'] = time();
            $is_open->add($dataArr);
            $this->save96567User($openid);
        }else{
        /*如果存在则更新96567用户表*/
            $this->save96567User($openid);
        }
    }

    /*更新96567用户关注状态*/
    private function save96567User($openid){
        $is_user = M('users','ecs_','mysql://shop:_96567_data@localhost:3306/_96567data_');
        /*检测用户表中是否存在用户*/
        $user = $is_user->where("openid='%s'",$openid)->find();
        if($user){
            /*如果用户存在检测是否为关注状态，不是则更新*/
            if($user['is_open'] != '1'){
                $dataArr['is_open'] = '1';
                $is_user->where("openid='%s'",$openid)->save($dataArr);
            }
        }
    }

    //用户提交到一元
    private function cash_money($openid = '') {
        $param_arr = array(
            'method' => 'GetUserByOpenid',
            'time' => time(),
            'from' => '1yuan',
            'openid' => $openid,
            'is_open' => '1',
        );

        $send_arr = $this->gbk_to_utf8($param_arr); //转换成UTF-8，用于传递
        
        $send_arr['sign'] = $this->get_sign($send_arr);

        $center_res = $this->httpPOST($this->center_uri, $send_arr);
        
        return $center_res;
    }


    /**
     * @ 生成签名值sign
     */
    private function get_sign($params) {
        $sort_array = array();
        $arg = "";
        $sort_array = $this->arg_sort($params);
        foreach($params as $key => $val){
            $arg .= $key.$val;
        }
        $sign = md5(md5($arg).$this->sign_key);
        return $sign;
    }

    /**
     * @ 数组排序
     */
    private function arg_sort($array) {
        ksort($array);
        reset($array);
        return $array;
    }

    /**
     * @ POST模式发送接口数据
     */
    private function httpPOST($url, $data){
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

    /**
     * @ GBK编码转换成UTF-8
     */
    private function gbk_to_utf8($data){
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

        /**
     * @ UTF-8编码转换成GBK
     */
    private function utf8_to_gbk($data){
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





 
}
?>