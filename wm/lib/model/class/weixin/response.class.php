<?php


class response{
	public $eventArr = Array();//响应记录内容
	public $responseStatus;
	private $fromUsername;//响应用户名
	private $toUsername;//响应发送用户名
	
	/**
	 * @ 微信响应检查
	 */
	public function valid(){
        $this->checkSignature();
    }

	/**
	 * @ 签名数据检查
	 */
	private function checkSignature(){
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
		$token = TOKEN;
		$tmpArr = array($token, $timestamp, $nonce);
		sort($tmpArr, SORT_STRING);
		$tmpStr = implode( $tmpArr );
		$tmpStr = sha1( $tmpStr );
		if( $tmpStr == $signature ){
			echo $_GET["echostr"];
			$this->responseStatus = true;
		}else{
			$this->responseStatus = false;
		}
	}

	/**
	 * @ 获取响应内容
	 */
    public function getContent(){
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		if(!$postStr){ exit; }//如果没有数据流返回则终端程序执行
		$postStr = iconv('utf-8','gbk','<?xml version="1.0" encoding="gb2312" ?>'.$postStr);
		file_put_contents('put1.txt',$postStr);
		if (!empty($postStr)){
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$this->fromUsername = trim($postObj->FromUserName);
			$this->toUsername = trim($postObj->ToUserName);

			//记录其它响应内容到数组
			$this->eventArr['openID'] = trim($postObj->FromUserName);
			$this->eventArr['keyword'] = trim(iconv('utf-8','gbk',$postObj->Content));
			$this->eventArr['Event'] = trim($postObj->Event);
			$this->eventArr['EventKey'] = trim($postObj->EventKey);
			$this->eventArr['MsgType'] = trim($postObj->MsgType);
			$this->eventArr['PicUrl'] = trim($postObj->PicUrl);
		}
	}

	/**
	 *	@回复响应
	 *	@ $content:响应发送的内容
	 *	@ $msgType:响应恢复的数据类型
	 *			   text：文本
	 *			   image：图片
	 *			   voice：语音
	 *			   video：多媒体
	 *			   music：音乐
	 *			   news：图文
	 */
	public function responseMsg($content,$msgType='text'){
		if(!$content){ return false; }
		switch($msgType){
			case "text":
				$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[%s]]></MsgType>
							<Content><![CDATA[%s]]></Content>
							<FuncFlag>0</FuncFlag>
							</xml>";
				$resultStr = sprintf($textTpl, $this->fromUsername, $this->toUsername, time(), $msgType, $content);
				break;
			case "news":
				$num = count($content);
				$textTpl = "<xml>
							<ToUserName><![CDATA[%s]]></ToUserName>
							<FromUserName><![CDATA[%s]]></FromUserName>
							<CreateTime>%s</CreateTime>
							<MsgType><![CDATA[news]]></MsgType>
							<ArticleCount>".$num."</ArticleCount>
							<Articles>%s</Articles>
							</xml>";
				$itemTpl = "<item>
							<Title><![CDATA[%s]]></Title>
							<Description><![CDATA[%s]]></Description>
							<PicUrl><![CDATA[%s]]></PicUrl>
							<Url><![CDATA[%s]]></Url>
							</item>";
				foreach($content as $k=>$v){
					$item .= sprintf($itemTpl,$v['title'],$v['description'],$v['img'],$v['url']);
				}
				$resultStr = sprintf($textTpl, $this->fromUsername, $this->toUsername, time(), $item);
				file_put_contents('img.txt',$resultStr);
				break;
		}
		echo $resultStr;
	}
}
?>