<?php
class weixinMoban{

	public function GongGao($openid,$array,$token){
        $data = array(
            "touser" => "$openid",
            "template_id" => "mroy9Wgsfz4thgwCZdU8b8EYwVkoyMFAYKRM8pwDzbc",
            "url" => "$array[url]",
            "topcolor" => "#FF0000",
            'data' => array(
                'first' => array(
                            'value' => "$array[first]",
                            'color' => "#743A3A",
                            ),
                'keyword1' => array(
                            'value' => "$array[keyword1]",
                            'color' => "#743A3A",
                            ),
                'keyword2' => array(
                            'value' => "$array[keyword2]",
                            'color' => "#743A3A",
                            ),
                'remark' => array(
                            'value' => "$array[remark]",
                            'color' => "#743A3A",
                            ),
                )
            );

		$url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$token;

		$result = $this->httpsPOST($url,json_encode($data));

        return $result;

	}


    public function ChaoYue($openid,$array,$token){
        $data = array(
            "touser" => "$openid",
            "template_id" => "7sgYpmpb1Ie2bA4ZLPQI_vTCCyquYiO6ZvQtPVikMaU",
            "url" => "$array[url]",
            "topcolor" => "#FF0000",
            'data' => array(
                'first' => array(
                            'value' => "$array[first]",
                            'color' => "#743A3A",
                            ),
                'number' => array(
                            'value' => "$array[number]",
                            'color' => "#743A3A",
                            ),
                'name' => array(
                            'value' => "$array[name]",
                            'color' => "#743A3A",
                            ),
                'remark' => array(
                            'value' => "$array[remark]",
                            'color' => "#743A3A",
                            ),
                )
            );

        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$token;

        $result = $this->httpsPOST($url,json_encode($data));

        return $result;

    }


    public function LePaiJieShu($openid,$array,$token){
        $data = array(
            "touser" => "$openid",
            "template_id" => "NURFBHG-9yzIInKOpMZzdVu6d7QXC1A9d4ehFgTMYLY",
            "url" => "$array[url]",
            "topcolor" => "#FF0000",
            'data' => array(
                'first' => array(
                            'value' => "$array[first]",
                            'color' => "#743A3A",
                            ),
                'number' => array(
                            'value' => "$array[number]",
                            'color' => "#743A3A",
                            ),
                'name' => array(
                            'value' => "$array[name]",
                            'color' => "#743A3A",
                            ),
                'deadline' => array(
                            'value' => "$array[deadline]",
                            'color' => "#743A3A",
                            ),
                'remark' => array(
                            'value' => "$array[remark]",
                            'color' => "#743A3A",
                            ),
                )
            );

        $url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$token;

        $result = $this->httpsPOST($url,json_encode($data));

        return $result;

    }


	public function httpsPOST($url,$data){
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


	public function gbk_to_utf8($data){
        $result = '';
        if(is_array($data)){
            foreach($data as $key => $val){
                if(is_array($val)){
                    $result[$key] = gbk_to_utf8($val);
                }else{
                    $result[$key] = iconv("GBK", "UTF-8", $val);
                }
            }
        }else{
            $result = iconv("GBK", "UTF-8", $data);
        }
        return $result;
    }


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


    /*解决JSON中文乱码	适用于低版本PHP 5.3以下*/
    public function jsonZhong($array){

        $array = json_encode($array);
        $str = urldecode($array);
        return preg_replace_callback('/\\\\u([0-9a-f]{4})/i',create_function('$matches',
            'return mb_convert_encoding(pack("H*", $matches[1]), "UTF-8", "UCS-2BE");'
        ),
        $str);

    }


}