<?php

defined('InShopNC') or exit('Access Invalid!');

class wxewm{
    private $token;
    private $uid;
    public function __construct($token,$uid) {
        if($token && $uid){
            $this->token = $token;
            $this->uid = intval('52'.$uid);
        }
    }

    /*取得二维码图片*/
    public function getEwm(){
        $images = $this->ewmImg();
        return $images;
    }

    /*获取二维码图片*/
    /*获取到用户CODE值*/
    private function ewmImg(){
        $array = array(
            'expire_seconds'=>86400,
            'action_name'=>'QR_SCENE',
            'action_info'=>array(
                'scene'=>array(
                    'scene_id'=>"{$this->uid}"
                )
            )
        );

        $array = json_encode($array);

        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$this->token;

        $result = $this->httpsPOST($url,$array);

        $object = json_decode($result);

        $rurl = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($object->ticket);

        return array($object,$rurl);
    }


    private function httpsPOST($url,$data){
        $ch = curl_init();
        $header = "Accept-Charset: utf-8";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        //curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS, iconv('gb2312','utf-8',$data));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        if(curl_errno($ch)){ 
            return 'Errno'.curl_error($ch);      
        }  
        curl_close($ch);
        return $tmpInfo;    
    }

}
?>