<?php
class WeixinTOKEN
{
  public $content;
	public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature()){
        	echo $echoStr;
        	exit;
        }
    }

	private function checkSignature()
	{
        // you must define TOKEN by yourself
        if (!defined("TOKEN")) {
            throw new Exception('TOKEN is not defined!');
        }
        
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        		
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
        // use SORT_STRING rule
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		
		if( $tmpStr == $signature ){
			return true;
		}else{
			return false;
		}
	}

    public function responseMsg()//执行接收器方法 

    { 


    $postStr = $GLOBALS["HTTP_RAW_POST_DATA"]; 


    file_put_contents('postStr.txt', print_r($postStr,true),FILE_APPEND);

    if (!empty($postStr)){ 

      $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA); 

      $RX_TYPE = trim($postObj->MsgType); 

      switch($RX_TYPE){ 

       case "event": 

       $result = $this->receiveEvent($postObj); 

       break; 

      } 

      echo $result; 

  }else{ 

   echo ""; 

   exit; 

  } 

 } 

  private function receiveEvent($object){ 


   $content = ""; 

   switch ($object->Event){ 

    case "subscribe": 

    $content = $this->content;//这里是向关注者发送的提示信息 

    break; 

    case "unsubscribe": 

    $content = ""; 

    break; 

   } 

   $result = $this->transmitText($object,$content); 

   return $result; 

    } 

 private function transmitText($object,$content){ 

   $textTpl = "<xml> 

       <ToUserName><![CDATA[%s]]></ToUserName> 

       <FromUserName><![CDATA[%s]]></FromUserName> 

       <CreateTime>%s</CreateTime> 

       <MsgType><![CDATA[text]]></MsgType> 

       <Content><![CDATA[%s]]></Content> 

       <FuncFlag>0</FuncFlag> 

       </xml>"; 

    $result = sprintf($textTpl, $object->FromUserName, $object->$ToUserName, time(), $content); 

    return $result; 

  } 
}


?>