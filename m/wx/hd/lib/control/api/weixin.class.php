<?php
/**
 * SW 微信API接口执行类
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：weixinRun
 * 
 * @功能：微信接口执行类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：weixinRun.class.php
 * 
 * @开发时间：2014-2-28 23:00:00
 * 
 * @微信API执行类
 * 
 */
require_once(dirname(__FILE__)."/../../model/class/weixin/response.class.php");
require_once(dirname(__FILE__)."/../../model/class/weixin/weixin.sdk.class.php");
define("TOKEN", "sc96567");
class weixin extends model{
	private $msgType = 'text';//发送数据类型

	/**
	 * @ 微信默认检测
	 */
	public function valid(){
		$weixin = new response;
		$weixin->valid();//获取返回状态
		if($weixin->responseStatus){
			file_put_contents('s.txt',$signature);
			$weixin->getContent();
			$content = $this->getContent($weixin->eventArr);
			$weixin->responseMsg($content,$this->msgType);
		}
	}

	/**
	 * @ 根据关键词获取回复内容
	 */
	private function getContent($arr){
		switch($arr['MsgType']){
			case 'voice'://语音响应
				break;
			case 'image'://图片响应
				break;
			case 'event'://事件响应
				$content = $this->getEventContent($arr);
				break;
			case 'text'://文本响应
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
		
		//如果回去内容为数组则返回数组类型
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
	 * @ 文本/图文模式回复
	 */
	private function getTextContent($keyword,$event='keyword'){
		if(is_utf8($keyword)){ $keyword = iconv('utf-8','gbk',$keyword); }
		$this->c->table('keyword_weixin');
		$dataArr = $this->c->search("K_Keyword='".$keyword."' AND K_Event='".$event."'",'K_ID DESC');
		$this->msgType = $dataArr[0]['K_Type'];

		//图文模式下执行图文内容转换
		switch($this->msgType){
			case "news"://图文模式
				foreach($dataArr as $k=>$v){
					$tempArr[$k]['title'] = iconv('gbk','utf-8',$v['K_Title']);
					$tempArr[$k]['description'] = iconv('gbk','utf-8',$v['K_Description']);
					$tempArr[$k]['img'] = $v['K_Img'];
					$tempArr[$k]['url'] = 'http://'.W_DOMAIN.'/index.php?m=news&c=show&p=main&kid='.$v['K_ID'];
				}
				return $tempArr;
				break;

			case "image"://图片模式
				break;
		}
		return $dataArr[0]['K_Content'];
	}

	/**
	 * @ 检测响应关键词是否有产品内容存在
	 */
	private function checkGoods($key){
		$this->c->table('products');
		$num = $this->c->sumRows("P_Author='".trim($key)."'");
		return $num;
	}

	/**
	 * @ 获取存在的产品内容组合成图片模式内容
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
	 * @ 事件响应模式内容整理
	 */
	private function getEventContent($arr){
		switch($arr['Event']){
			case 'subscribe'://关注时间响应
				$dataArr = $this->getEventMsg($arr['Event']);
				$content = $dataArr['E_Content'];
				break;

			case 'LOCATION'://获取地理坐标事件响应
				break;
			case 'CLICK'://菜单事件响应
				$content = $this->getTextContent($arr['EventKey'],'CLICK');
				break;

		}
		return $content;
	}

	/**
	 * @ 事件关键词响应
	 */
	private function getEventKey($key){
		return $key;
	}

	/**
	 * @ 根据时间类型获取指定响应内容
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