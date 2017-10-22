<?php
/**
 * SW ΢��API�ӿ�ִ����
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������weixinRun
 * 
 * @���ܣ�΢�Žӿ�ִ����
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�weixinRun.class.php
 * 
 * @����ʱ�䣺2014-2-28 23:00:00
 * 
 * @΢��APIִ����
 * 
 */
require_once(dirname(__FILE__)."/../../model/class/weixin/response.class.php");
require_once(dirname(__FILE__)."/../../model/class/weixin/weixin.sdk.class.php");
define("TOKEN", "sc96567");
class weixin extends model{
	private $msgType = 'text';//������������

	/**
	 * @ ΢��Ĭ�ϼ��
	 */
	public function valid(){
		$weixin = new response;
		$weixin->valid();//��ȡ����״̬
		if($weixin->responseStatus){
			file_put_contents('s.txt',$signature);
			$weixin->getContent();
			$content = $this->getContent($weixin->eventArr);
			$weixin->responseMsg($content,$this->msgType);
		}
	}

	/**
	 * @ ���ݹؼ��ʻ�ȡ�ظ�����
	 */
	private function getContent($arr){
		switch($arr['MsgType']){
			case 'voice'://������Ӧ
				break;
			case 'image'://ͼƬ��Ӧ
				break;
			case 'event'://�¼���Ӧ
				$content = $this->getEventContent($arr);
				break;
			case 'text'://�ı���Ӧ
				if( $this->checkGoods($arr['keyword']) ){
					$content = $this->getGoodsModel($arr['keyword']);
				}else{
					$content = $this->getTextContent($arr['keyword']);
					if(!$content){
						$weixin = new weixinSDK;
						$weixin->sendMessage('op6P9t1Q3BiQLNj6b-V-e1iFyLLA',$arr['keyword']);
					}
				}
				break;
		}
		
		//�����ȥ����Ϊ�����򷵻���������
		if(is_array($content)){
			return $content;
		}
		
		if(is_utf8($content)){
			return $content;
		}else{
			return iconv('gbk','utf-8',$content);
		}
	}


	/**
	 * @ �ı�/ͼ��ģʽ�ظ�
	 */
	private function getTextContent($keyword,$event='keyword'){
		if(is_utf8($keyword)){ $keyword = iconv('utf-8','gbk',$keyword); }
		$this->c->table('keyword_weixin');
		$dataArr = $this->c->search("K_Keyword='".$keyword."' AND K_Event='".$event."'",'K_ID DESC');
		$this->msgType = $dataArr[0]['K_Type'];

		//ͼ��ģʽ��ִ��ͼ������ת��
		switch($this->msgType){
			case "news"://ͼ��ģʽ
				foreach($dataArr as $k=>$v){
					$tempArr[$k]['title'] = iconv('gbk','utf-8',$v['K_Title']);
					$tempArr[$k]['description'] = iconv('gbk','utf-8',$v['K_Description']);
					$tempArr[$k]['img'] = $v['K_Img'];
					$tempArr[$k]['url'] = 'http://'.W_DOMAIN.'/index.php?m=news&c=show&p=main&kid='.$v['K_ID'];
				}
				return $tempArr;
				break;

			case "image"://ͼƬģʽ
				break;
		}
		return $dataArr[0]['K_Content'];
	}

	/**
	 * @ �����Ӧ�ؼ����Ƿ��в�Ʒ���ݴ���
	 */
	private function checkGoods($key){
		$this->c->table('products');
		$num = $this->c->sumRows("P_Author='".trim($key)."'");
		return $num;
	}

	/**
	 * @ ��ȡ���ڵĲ�Ʒ������ϳ�ͼƬģʽ����
	 */
	private function getGoodsModel($key){
		$this->c->table('products');
		$fileds = "P_ID,P_Name,P_Content,(SELECT I_Img FROM sw_products_img WHERE I_PID=P_ID ORDER BY I_ID ASC LIMIT 1) as img";
		$dataArr = $this->c->search("P_Author='".trim($key)."' AND P_Type=1",'','',$fileds);
		$this->msgType = 'news';
		foreach($dataArr as $k=>$v){
			$tempArr[$k]['title'] = iconv('gbk','utf-8',$v['P_Name']);
			$tempArr[$k]['description'] = iconv('gbk','utf-8',$v['P_Content']);
			$tempArr[$k]['img'] = 'http://'.W_DOMAIN.'/'.$v['img'];
			$tempArr[$k]['url'] = 'http://'.W_DOMAIN.'/index.php?m=goods&p=main&id='.$v['P_ID'];
		}
		return $tempArr;

	}

	/**
	 * @ �¼���Ӧģʽ��������
	 */
	private function getEventContent($arr){
		switch($arr['Event']){
			case 'subscribe'://��עʱ����Ӧ
				$dataArr = $this->getEventMsg($arr['Event']);
				$content = $dataArr['E_Content'];
				break;

			case 'LOCATION'://��ȡ���������¼���Ӧ
				break;
			case 'CLICK'://�˵��¼���Ӧ
				$content = $this->getTextContent($arr['EventKey'],'CLICK');
				break;

		}
		return $content;
	}

	/**
	 * @ �¼��ؼ�����Ӧ
	 */
	private function getEventKey($key){
		return $key;
	}

	/**
	 * @ ����ʱ�����ͻ�ȡָ����Ӧ����
	 */
	private function getEventMsg($event){
		$this->c->table('event');
		$dataArr = $this->c->search("E_EventTitle='".$event."'",'','','E_Content,E_Type');
		if(count($dataArr)){
			$this->msgType = $dataArr[0]['E_Type'];
			return $dataArr[0];
		}
	}
}

?>