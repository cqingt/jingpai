<?php
/**************************************************************************************
���ƣ�ͼƬ�ϴ���
�����ˣ�����
����ʱ�䣺2009-8-28
���ܣ������ϴ�ͼƬ����������ͼ�ȹ���
**************************************************************************************/

class upload{
	//��������
	public $degrees = -90;//��ת�Ƕ�
	public $rotateStatus = 0;
	public $smallStatus = 0;//����ͼ��������
	public $imgArr; //�ϴ�������������,����������
	public $folder="upimg"; //����ļ���,����������·��
	public $style=array("png","jpg","jpeg","gif");//�����ϴ�����������
	public $small_width=100; //����ͼƬ���
	public $small_height=50; //����ͼƬ�߶�
	public $small_switch=1; //�Ƿ���ͼƬ���ų��� 1Ϊ����,0Ϊ������;
	public $filename=false;//�ϴ�����ļ�����
	public $small_dir; //����ͼƬ�洢Ŀ¼
	private $max_size=8097152; //�����ϴ������Χ,Ĭ��Ϊ2M	

	//���幹�캯��
	function __construct($array,$folder,$small_switch=1){
		if(!is_array($array)) {echo "�������Ͳ����ϣ�";exit;}
		$this->imgArr=$array;
		$this->folder=$folder;
		$this->small_switch=$small_switch;
		$this->createFolder($this->folder);
		if($this->small_switch){//�ж��Ƿ�ִ��Сͼ�ļ���
			$this->small_dir = $folder."/small";
			$this->createFolder($this->small_dir);
		}
	}
	//������������

	//�ϴ�ͼƬ����
	function upimg($array=""){
		if($array==""){ $array=$this->imgArr; }
		if($num=$array['error']){
			switch($num){
				case 1: $msg="�ϴ����ļ������� php.ini �� upload_max_filesize ѡ�����Ƶ�ֵ";break;
				case 2: $msg="�ϴ��ļ��Ĵ�С������ HTML ���� MAX_FILE_SIZE ѡ��ָ����ֵ";break;
				case 3: $msg="�ļ�ֻ�в��ֱ��ϴ�";break;
				case 4: $msg="û���ļ����ϴ�";break;
				case 5: $msg="�Ҳ�����ʱ�ļ���";break;
				case 6: $msg="�ļ�д��ʧ��";break;
			}
			echo $msg;
			exit;
		}
		
		if($this->max_size<$array['size']) {echo "���ϴ����ļ������������Χ��";exit;} //�ж��Ƿ񳬳��ϴ����Χ

		$tmp=explode(".",$array['name']);
		$exte=$tmp[count($tmp)-1];
		if(!in_array(strtolower($exte),$this->style)) {echo "��֧�ָ����͵��ļ��ϴ���";exit;}

		//�����ϴ��ļ���
		if(!$this->filename){
			$filename=time().rand(10,99).".".$exte;
			$filepath=$this->folder."/".$filename;
			while(file_exists($filepath)){//�ж��ļ��Ƿ����
				$this->filename=time().rand(10,99).".".$exte;
				$filepath=$this->folder."/".$filename.".".$exte;
			}
		}else{
			$filepath = $this->folder."/".$this->filename.".".$exte;
		}
		unset($this->filename);//����������
		//ִ���ļ��ϴ�
		if(move_uploaded_file($array['tmp_name'],$filepath)){
			if($this->small_switch){ $this->NarrowImg($filename);}//��������ͼ
			return $filepath;
		}else{
			echo $array['tmp_name']."<br>";
			echo "�ϴ�����!";
			exit;
		}
	}
	
	//ʹ�õݹ麯�����ɶ༶�ļ���
	private function createFolder($path){
		if (!file_exists($path)){
			$this->createFolder(dirname($path));
			mkdir($path,755);
		}
	}
	
	//����ͼ����
	public function NarrowImg($file,$newfile=''){
		if(!is_string($file)) {echo "���ݲ��Ϸ���";exit;}
		$dir=$this->folder."/".$file;
		if(!file_exists($dir)) {echo "��Ҫ�������ļ�������!";exit;}
		//ִ��ͼƬ��ת
		$this->imgRotate($dir);
		$small_dir = $this->small_dir."/thumb_".$file;
		if($newfile){ $small_dir = $newfile; }

		if($this->smallStatus){
			require_once(dirname(__FILE__)."/thumb.php");
			$cut = new ImageCut();
			$cut->set_image($dir,$small_dir);//path����ͨ������������
			$cut->show($this->small_width,$this->small_height);//�������ÿ�ߣ�����ͨ������������
		}else{
			$imgArr=getimagesize($dir); //��ȡĿ��ͼƬ��Ϣ
			$width=$imgArr[0]; //��ȡͼƬԭʼ���
			$height=$imgArr[1]; //��ȡͼƬԭʼ�߶�
			$type=$imgArr[2]; //��ȡͼƬ��������

			//�������������ųߴ�
			if($width/$height>$this->small_width/$this->small_height){
				$wd=$this->small_width;
				$wh=intval($height*($this->small_width/$width));
			}else{
				$wd=intval($width*($this->small_height/$height));
				$wh=$this->small_height;
			}

			//����Դͼ���ļ������½�һ��������������ͼ��Ŀ���ļ���
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
					echo "��֧�ָ����Ͳ���";
					exit;
					break;
			}
			//����Ŀ���ļ�
			$ImgSrc=imagecreatetruecolor($wd,$wh);//Ŀ��ͼ
			//��ʼ����ͼƬ��С
			imagecopyresampled($ImgSrc,$src,0,0,0,0,$wd,$wh,$width,$height); //��ʼ��������ͼ
			//�������ļ���
			$newfilename= $small_dir;
			//�����ļ���ָ��Ŀ¼
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
					echo "�޷���������ͼ";
					break;
			}
			ImageDestroy($ImgSrc);
			ImageDestroy($src);
		}
	}

	//ɾ��ͼƬ
	function DelImg($file){
		if(!is_string($file)) {echo "���ݲ��Ϸ�!";exit;}
		$dir=$this->folder."/".$file;
		$dir_small=$this->small_dir."/small_".$file;
		if(file_exists($dir)) @unlink($dir);
		if(file_exists($dir_small)) @unlink($dir_small);
	}

	//ִ��ͼƬ��ת
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
//		$data = @getimagesize($filename);//��ȡͼƬ
//		if($data==false)return false;
//			//��ȡ��ͼƬ
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