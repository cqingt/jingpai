<?php


class response{
	public $eventArr = Array();//��Ӧ��¼����
	public $responseStatus;
	private $fromUsername;//��Ӧ�û���
	private $toUsername;//��Ӧ�����û���
	
	/**
	 * @ ΢����Ӧ���
	 */
	public function valid(){
        $this->checkSignature();
    }

	/**
	 * @ ǩ�����ݼ��
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
	 * @ ��ȡ��Ӧ����
	 */
    public function getContent(){
		$postStr = $GLOBALS["HTTP_RAW_POST_DATA"];
		if(!$postStr){ exit; }//���û���������������ն˳���ִ��
		$postStr = iconv('utf-8','gbk','<?xml version="1.0" encoding="gb2312" ?>'.$postStr);
		file_put_contents('put1.txt',$postStr);
		if (!empty($postStr)){
			$postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
			$this->fromUsername = trim($postObj->FromUserName);
			$this->toUsername = trim($postObj->ToUserName);

			//��¼������Ӧ���ݵ�����
			$this->eventArr['openID'] = trim($postObj->FromUserName);
			$this->eventArr['keyword'] = trim(iconv('utf-8','gbk',$postObj->Content));
			$this->eventArr['Event'] = trim($postObj->Event);
			$this->eventArr['EventKey'] = trim($postObj->EventKey);
			$this->eventArr['MsgType'] = trim($postObj->MsgType);
			$this->eventArr['PicUrl'] = trim($postObj->PicUrl);
		}
	}

	/**
	 *	@�ظ���Ӧ
	 *	@ $content:��Ӧ���͵�����
	 *	@ $msgType:��Ӧ�ָ�����������
	 *			   text���ı�
	 *			   image��ͼƬ
	 *			   voice������
	 *			   video����ý��
	 *			   music������
	 *			   news��ͼ��
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