<?php
/*
	@类名:php验证码类
	@作用:完全自定义化生成验证码
	@作者:精灵
	@开发时间:2013年7月5日
	@联系QQ:9132761

*/
class Code{

    private $img_type = 'png';//输出图片类型 png,gif,jpg

    private $line      = TRUE;//是否增加干扰线

    private $text      = '0';//验证码类型：0数字，1字母，2汉字

    private $text_size= 18;//字体大小

    private $length      = 4;//字符串长度

    private $width      = 100;//图片宽度，像素

    private $height      = 30;//图片高度，像素

    private $font_file= 'static/font/simhei.ttf';//字体文件

    public  $img      = '';

	private $im;

   

    /*

    * 创建图片

    */

    private function img_create(){

        $this->img = imagecreate($this->width, $this->height);

        imagecolorallocate($this->img, 255,255,255);

 

    }

    /*
		@显示图片
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
		@生成字符串
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
            //数字，字母
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
            //汉字,此处可以引入汉字文件
			$arr=array('大','小','多','少','人','天','水','土','木','火','云');
            for($i=0;$i<$this->length;$i++){
				$l = count($arr)-1;               
				//文件编码为gbk需要转换
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

    * 生成线条

    */

    private function img_line(){

        $this->im = $this->img;

        $img_width = $this->width;

        $img_height= $this->height;

            //背景横线

        $lineColor1 = imagecolorallocate($this->im, 0xda, 0xd9, 0xd1);

        for($j=3; $j<=$img_height-3; $j=$j+3)

        {

            imageline($this->im, 2, $j, $img_width - 2, $j, $lineColor1);

        }

       

        //背景竖线

        $lineColor2 = imagecolorallocate($this->im, 0xda,0xd9,0xd1);

        for($j=2;$j<$img_width-6;$j=$j+6)

        {

            imageline($this->im, $j, 0, $j+8, $img_height, $lineColor2);

        }

   

        //画边框

        if( $use_boder && $filter_type == 0 ){
            $bordercolor = imagecolorallocate($im, 0x9d, 0x9e, 0x96);
            imagerectangle($this->im, 0, 0, $img_width-1, $img_height-1, $bordercolor);
        }

    }

    /*

    * 生成输出

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