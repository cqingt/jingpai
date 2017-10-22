<?php
/*
	@����:php��֤����
	@����:��ȫ�Զ��廯������֤��
	@����:����
	@����ʱ��:2013��7��5��
	@��ϵQQ:9132761

*/
class Code{

    private $img_type = 'png';//���ͼƬ���� png,gif,jpg

    private $line      = TRUE;//�Ƿ����Ӹ�����

    private $text      = '0';//��֤�����ͣ�0���֣�1��ĸ��2����

    private $text_size= 18;//�����С

    private $length      = 4;//�ַ�������

    private $width      = 100;//ͼƬ��ȣ�����

    private $height      = 30;//ͼƬ�߶ȣ�����

    private $font_file= 'static/font/simhei.ttf';//�����ļ�

    public  $img      = '';

	private $im;

   

    /*

    * ����ͼƬ

    */

    private function img_create(){

        $this->img = imagecreate($this->width, $this->height);

        imagecolorallocate($this->img, 255,255,255);

 

    }

    /*
		@��ʾͼƬ
    */
    public function show(){
        session_start();
        $this->img_create();
        if($this->line){
			$this->img_line();
        }
        $this->img_text();
        $this->img_header();
        imagedestroy($this->im);
        exit();
    }

 
    /*
		@�����ַ���
    */
    private function img_text(){
		$data='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand_string = '';
        $this->im = $this->img;
        $fontColor[]  = imagecolorallocate($this->im, 0x15, 0x15, 0x15);
        $fontColor[]  = imagecolorallocate($this->im, 0x95, 0x1e, 0x04);
        $fontColor[]  = imagecolorallocate($this->im, 0x93, 0x14, 0xa9);
        $fontColor[]  = imagecolorallocate($this->im, 0x12, 0x81, 0x0a);
        $fontColor[]  = imagecolorallocate($this->im, 0x06, 0x3a, 0xd5);

        if($this->text<2){
            //���֣���ĸ
            for($i=0;$i<$this->length;$i++){
				/*
				if($this->text){
					$c=chr(mt_rand(65,90));
				}else{
					$c=chr(mt_rand(48,57));
				}
				*/
				$c=$data[mt_rand(0,strlen($data)-1)];
				if( $c=='I' ) $c = 'K';
				if( $c=='O' ) $c = 'E';
				$rand_string[]=$c;
			}   
        }else{
            //����,�˴��������뺺���ļ�
			$arr=array('��','С','��','��','��','��','ˮ','��','ľ','��','��');
            for($i=0;$i<$this->length;$i++){
				$l = count($arr)-1;               
				//�ļ�����Ϊgbk��Ҫת��
				$rand_string[] = iconv('gb2312','utf-8',$arr[mt_rand(0,$l)]);
				$rand_string[] = $arr[mt_rand(0,$l)];
            }
        }

		$_SESSION['sw_code']=join('',$rand_string);
		$_c = count($rand_string);
		for($i=0;$i<$_c;$i++){
			if($this->text == 1){
			$rand_string[$i] = strtoupper($rand_string[$i]);
		}
        $c_fontColor = $fontColor[mt_rand(0,4)];

        $y = $this->height-($this->height-$this->text_size)/2;

        $x = ($this->width-($this->text_size+2)*$this->length)/2;

        $y_pos = $i==0 ? $x : $i*($this->text_size+2)+$x;

        $c = mt_rand(0, 15);

        @imagettftext($this->im, $this->text_size, $c, $y_pos, $y, $c_fontColor, $this->font_file, $rand_string[$i]);
        }
    }

    /*

    * ��������

    */

    private function img_line(){

        $this->im = $this->img;

        $img_width = $this->width;

        $img_height= $this->height;

            //��������

        $lineColor1 = imagecolorallocate($this->im, 0xda, 0xd9, 0xd1);

        for($j=3; $j<=$img_height-3; $j=$j+3)

        {

            imageline($this->im, 2, $j, $img_width - 2, $j, $lineColor1);

        }

       

        //��������

        $lineColor2 = imagecolorallocate($this->im, 0xda,0xd9,0xd1);

        for($j=2;$j<$img_width-6;$j=$j+6)

        {

            imageline($this->im, $j, 0, $j+8, $img_height, $lineColor2);

        }

   

        //���߿�

        if( $use_boder && $filter_type == 0 ){
            $bordercolor = imagecolorallocate($im, 0x9d, 0x9e, 0x96);
            imagerectangle($this->im, 0, 0, $img_width-1, $img_height-1, $bordercolor);
        }

    }

    /*

    * �������

    */

    private function img_header(){

        header("Pragma:no-cache\r\n");

           header("Cache-Control:no-cache\r\n");

            header("Expires:0\r\n");

        if($this->img_type == 'jpg'){

            header('Content-type: image/jpeg');

            imagejpeg($this->img);

        }else if($this->img_type == 'png'){

            header('Content-type: image/png');

            imagepng($this->img);

        }else{

            header('Content-type: image/gif');

            imagegif($this->img);

        }

    }

}
?>