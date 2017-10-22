<?php
/**************************************************************************************
名称：图片上传类
制作人：精灵
制作时间：2009-8-28
功能：用于上传图片，生成缩略图等功能
**************************************************************************************/

class upload{
	//定义属性
	public $degrees = -90;//旋转角度
	public $rotateStatus = 0;
	public $smallStatus = 0;//缩略图生成类型
	public $imgArr; //上传的数据流数据,数组性数据
	public $folder="upimg"; //存放文件夹,可以是完整路径
	public $style=array("png","jpg","jpeg","gif");//允许上传的数据类型
	public $small_width=100; //缩放图片宽度
	public $small_height=50; //缩放图片高度
	public $small_switch=1; //是否开启图片缩放程序 1为开启,0为不开启;
	public $filename=false;//上传后的文件名称
	public $small_dir; //缩放图片存储目录
	private $max_size=8097152; //允许上传的最大范围,默认为2M	

	//定义构造函数
	function __construct($array,$folder,$small_switch=1){
		if(!is_array($array)) {echo "数据类型不符合！";exit;}
		$this->imgArr=$array;
		$this->folder=$folder;
		$this->small_switch=$small_switch;
		$this->createFolder($this->folder);
		if($this->small_switch){//判断是否执行小图文件夹
			$this->small_dir = $folder."/small";
			$this->createFolder($this->small_dir);
		}
	}
	//定义析构函数

	//上传图片方法
	function upimg($array=""){
		if($array==""){ $array=$this->imgArr; }
		if($num=$array['error']){
			switch($num){
				case 1: $msg="上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值";break;
				case 2: $msg="上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值";break;
				case 3: $msg="文件只有部分被上传";break;
				case 4: $msg="没有文件被上传";break;
				case 5: $msg="找不到临时文件夹";break;
				case 6: $msg="文件写入失败";break;
			}
			echo $msg;
			exit;
		}
		
		if($this->max_size<$array['size']) {echo "你上传的文件超出最大允许范围！";exit;} //判断是否超出上传最大范围

		$tmp=explode(".",$array['name']);
		$exte=$tmp[count($tmp)-1];
		if(!in_array(strtolower($exte),$this->style)) {echo "不支持该类型的文件上传！";exit;}

		//生成上传文件名
		if(!$this->filename){
			$filename=time().rand(10,99).".".$exte;
			$filepath=$this->folder."/".$filename;
			while(file_exists($filepath)){//判断文件是否存在
				$this->filename=time().rand(10,99).".".$exte;
				$filepath=$this->folder."/".$filename.".".$exte;
			}
		}else{
			$filepath = $this->folder."/".$this->filename.".".$exte;
		}
		unset($this->filename);//销毁类属性
		//执行文件上传
		if(move_uploaded_file($array['tmp_name'],$filepath)){
			if($this->small_switch){ $this->NarrowImg($filename);}//生成缩略图
			return $filepath;
		}else{
			echo $array['tmp_name']."<br>";
			echo "上传错误!";
			exit;
		}
	}
	
	//使用递归函数生成多级文件夹
	private function createFolder($path){
		if (!file_exists($path)){
			$this->createFolder(dirname($path));
			mkdir($path,755);
		}
	}
	
	//缩略图生成
	public function NarrowImg($file,$newfile=''){
		if(!is_string($file)) {echo "数据不合法！";exit;}
		$dir=$this->folder."/".$file;
		if(!file_exists($dir)) {echo "需要操作的文件不存在!";exit;}
		//执行图片旋转
		$this->imgRotate($dir);
		$small_dir = $this->small_dir."/thumb_".$file;
		if($newfile){ $small_dir = $newfile; }

		if($this->smallStatus){
			require_once(dirname(__FILE__)."/thumb.php");
			$cut = new ImageCut();
			$cut->set_image($dir,$small_dir);//path可以通过参数传过来
			$cut->show($this->small_width,$this->small_height);//随意设置宽高，可以通过参数传过来
		}else{
			$imgArr=getimagesize($dir); //获取目标图片信息
			$width=$imgArr[0]; //获取图片原始宽度
			$height=$imgArr[1]; //获取图片原始高度
			$type=$imgArr[2]; //获取图片类型数据

			//按比例生成缩放尺寸
			if($width/$height>$this->small_width/$this->small_height){
				$wd=$this->small_width;
				$wh=intval($height*($this->small_width/$width));
			}else{
				$wd=intval($width*($this->small_height/$height));
				$wh=$this->small_height;
			}

			//根据源图形文件类型新建一个用来生成缩略图的目标文件。
			switch($type){
				case 1:
					$src=ImageCreateFromGIF($dir);
					break;
				case 2:
					$src=ImageCreateFromJPEG($dir);
					break;
				case 3:
					$src=ImageCreateFromPNG($dir);
					break;
				default :
					echo "不支持该类型操作";
					exit;
					break;
			}
			//生成目标文件
			$ImgSrc=imagecreatetruecolor($wd,$wh);//目标图
			//开始复制图片缩小
			imagecopyresampled($ImgSrc,$src,0,0,0,0,$wd,$wh,$width,$height); //开始复制缩略图
			//创建新文件名
			$newfilename= $small_dir;
			//保存文件到指定目录
			switch($type){
				case 1:
					ImageGIF($ImgSrc,$newfilename);
					break;
				case 2:
					ImageJPEG($ImgSrc,$newfilename);
					break;
				case 3:
					ImagePNG($ImgSrc,$newfilename);
					break;
				default:
					echo "无法生成缩略图";
					break;
			}
			ImageDestroy($ImgSrc);
			ImageDestroy($src);
		}
	}

	//删除图片
	function DelImg($file){
		if(!is_string($file)) {echo "数据不合法!";exit;}
		$dir=$this->folder."/".$file;
		$dir_small=$this->small_dir."/small_".$file;
		if(file_exists($dir)) @unlink($dir);
		if(file_exists($dir_small)) @unlink($dir_small);
	}

	//执行图片旋转
	function imgRotate($filename){
		$image = imagecreatefromstring(file_get_contents($filename));
		$exif = @exif_read_data($filename);
		if(!empty($exif['Orientation'])) {
			switch($exif['Orientation']) {
				case 8:
					$image = imagerotate($image,90,0);
					break;
				case 3:
					$image = imagerotate($image,180,0);
					break;
				case 6:
					$image = imagerotate($image,-90,0);
					break;
			}
		}
		if(!imagejpeg($image,$filename)){ return false; }
		@imagedestroy($image);
		return true;
//		if(!$this->rotateStatus){ return false; }
//		$data = @getimagesize($filename);//读取图片
//		if($data==false)return false;
//			//读取旧图片
//			switch ($data[2]) {
//			case 1:
//			$src_f = imagecreatefromgif($filename);break;
//			case 2:
//			$src_f = imagecreatefromjpeg($filename);break;
//			case 3:
//			$src_f = imagecreatefrompng($filename);break;
//		}
//		if($src_f==""){ return false; };
//		$rotate = @imagerotate($src_f, $this->degrees,0);
//		if(!imagejpeg($rotate,$filename,100)){ return false; }
//		@imagedestroy($rotate);
//		return true;
	}
}
?>