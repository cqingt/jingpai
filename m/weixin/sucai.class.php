<?php
/**
 * SW 微信素材管理接口类
 * 
 * @版权所有：搜藏（北京）网络科技有限公司
 * 
 * @类名：sucai
 * 
 * @功能：素材操作类
 *
 * @开发人：精灵
 * 
 * @联系QQ：9132761
 * 
 * @文件名称：sucai.class.php
 * 
 * @开发时间：2014-2-28 23:00:00
 * wxa3c2d8e6cbb00de7
 * @微信素材
 * c90a7bedba52f41e3e55a9bc85c13858
 */
include('weixin.sdk.class.php');
class sucai extends weixinSDK{
	private $dataJson;

	/**
	 * @ 保存素材到微信素材库
	 */
	public function sendSuCai(){
		$apiURL = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$this->token."&type=video";
		$tempArr = $_FILES['f'];
		$file_info = array(
							'filename'=>'/weixin/IMG_2317.mp4',  //国片相对于网站根目录的路径
							'content-type'=>$tempArr['type'],  //文件类型
							'filelength'=>$tempArr['size']         //图文大小
							);
		$real_path=$_SERVER['DOCUMENT_ROOT'].$file_info['filename'];

		$data= array("media"=>"@{$real_path}",'form-data'=>$file_info);

		$json = $this->httpsPOST($apiURL,$data,true);

		$obj = json_decode($json);
		$media_id = $this->getMedia($obj->media_id);//$obj->media_id
		echo $media_id;
		$content = Array(	'media_id'=>$media_id,
							'title'=>'wo shi yige ceshi',
							'description'=>'ce shi de hen shuang hen shuang'
							);
		$content = '{"filter":{"is_to_all":false,"group_id":"2"},"mpvideo":{"media_id":'.$media_id.',},"msgtype":"mpvideo"}';
		$this->sendALLMessage('ocmCHjmmkbX9lPLiCKZ3RGwPyQrw',$content,array(),'video');
		
	}

	private function getMedia($media_id){
		$apiURL = "https://file.api.weixin.qq.com/cgi-bin/media/uploadvideo?access_token=".$this->token;
		$dataArr['media_id'] = $media_id;
		$dataArr['title'] = "title";
		$dataArr['description'] = 'descript';
		$json = $this->httpsPOST($apiURL,json_encode($dataArr));
		$obj = json_decode($json);
		return $obj->media_id;
	}

	private function getSuCai($media_id){
		$apiURL = "https://api.weixin.qq.com/cgi-bin/media/get?access_token=".$this->token."&media_id=".$media_id;
		
		$json = $this->httpsGET($apiURL);
		$obj = json_decode($json);
		$media_id = $obj->media_id;
		return $media_id;
	}
}
$s = new sucai;
$s->sendSuCai();
?>