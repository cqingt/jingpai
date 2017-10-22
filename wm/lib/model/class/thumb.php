<?php
class ImageCut {
	public $path = '';
	public $key = '';
	public function __construct() {
		
	}
	public function set_image($path,$newfilename) {
		$this->path = $path;
		$this->newfilename = $newfilename;
	}

	public function get_data($width,$height){
		if($this->path) {
			$path = $this->path;
		} else {
			trigger_error('unset path');
		}
		if(!file_exists($path)) {
			trigger_error('file not exist');
		}
		
		$old_size = getimagesize($path);
		$old_width = $old_size[0];
		$old_height =  $old_size[1];
		$img_type=$old_size[2]; //获取图片类型数据
		
		if($width==0 && $height==0) {
			$width = $old_width;
			$height = $old_height;
		} else if($width==0) {
			if($height>$old_height) {
				$height = $old_height;
			}
			$width = $height/$old_height * $old_width;
		} else if($height==0) {
			if($width>$old_width) {
				$width = $old_width;
			}
			$height = $width/$old_width * $old_height;
		}
		
		$dst_wh = $width/$height;
		if($old_height>($old_width/$dst_wh)) {
			$src_width = $old_width;
			$src_height = $old_width/$dst_wh;
			$src_x = 0;
			$src_y = ($old_height-$src_height)/2;
		} else {
			$src_height = $old_height;
			$src_width = $old_height*$dst_wh;
			$src_y = 0;
			$src_x = ($old_width-$src_width)/2;
		}
		
		switch($img_type){
			case 1:
				$img = imagecreatefromgif($path);
				break;
			case 2:
				$img = imagecreatefromjpeg($path);
				break;
			case 3:
				$img = imagecreatefrompng($path);
				break;
			default :
				echo "不支持该类型操作";
				exit;
				break;
		}
		
		if($src_width<$width) {
			$width = $src_width;
		}
		if($src_height<$height) {
			$height = $src_height;
		}
		//重新画
		$newimage = imagecreatetruecolor($width,$height);
		imagecopyresampled($newimage,$img,0,0,$src_x,$src_y,$width,$height,$src_width,$src_height);
		
		switch($img_type){
			case 1:
				ImageGIF($newimage,$this->newfilename);
				break;
			case 2:
				ImageJPEG($newimage,$this->newfilename);
				break;
			case 3:
				ImagePNG($newimage,$this->newfilename);
				break;
			default :
				echo "不支持该类型操作";
				exit;
				break;
		}
		
		imagedestroy($newimage);
		imagedestroy($img); 
	}
	public function show($width,$height){
		
	   $this->get_data($width, $height);
	}
}
?>