<?php
/**
 * SW ΢���زĹ���ӿ���
 * 
 * @��Ȩ���У��Ѳأ�����������Ƽ����޹�˾
 * 
 * @������sucai
 * 
 * @���ܣ��زĲ�����
 *
 * @�����ˣ�����
 * 
 * @��ϵQQ��9132761
 * 
 * @�ļ����ƣ�sucai.class.php
 * 
 * @����ʱ�䣺2014-2-28 23:00:00
 * wxa3c2d8e6cbb00de7
 * @΢���ز�
 * c90a7bedba52f41e3e55a9bc85c13858
 */
include('weixin.sdk.class.php');
class sucai extends weixinSDK{
	private $dataJson;

	/**
	 * @ �����زĵ�΢���زĿ�
	 */
	public function sendSuCai(){
		$apiURL = "https://api.weixin.qq.com/cgi-bin/media/upload?access_token=".$this->token."&type=video";
		$tempArr = $_FILES['f'];
		$file_info = array(
							'filename'=>'/weixin/IMG_2317.mp4',  //��Ƭ�������վ��Ŀ¼��·��
							'content-type'=>$tempArr['type'],  //�ļ�����
							'filelength'=>$tempArr['size']         //ͼ�Ĵ�С
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