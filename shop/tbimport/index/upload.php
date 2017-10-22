<?php
require_once('../../../core/framework/libraries/oss/aili_yun_oss.class.php');
include 'tbconfig.php';

global $tbconfig;
if (isset($_FILES["Filedata"]) || !is_uploaded_file($_FILES["Filedata"]["tmp_name"]) || $_FILES["Filedata"]["error"] != 0) {

	$path = $tbconfig['web_root'].trim($_POST['storeid']);//取得上传图片的绝对路径
	$SID=trim($_POST['storeid'])."_";
	if(!file_exists($path)){mkdir($path,0777);}//如果目录不存在，则创建
	$path = realpath($path).'/';
	$filetype	 = '.jpg';//后缀
	$upload_file = $_FILES['Filedata'];//上传的数据
	$file_info   = pathinfo($upload_file['name']);//图片数组
    if($file_info['extension'] == 'jpg'){
        $contents_root = '../../../data/upload/shop/contents/';
        $save_jpg = realpath($contents_root).'/'. $file_info['filename'].$filetype;

        $name        = $_FILES['Filedata']['tmp_name'];//上传到服务器的临时文件
        if (!move_uploaded_file($name, $save_jpg)) {

            exit('move fail');
        }
        if(file_exists($save_jpg)){
            $oss = new aili_yun_oss;//实例化云
            //把双杠替换成单杠
            $DBASE_UPLOAD_PATH = str_replace('//','/',$save_jpg);
            echo $DBASE_UPLOAD_PATH;
            $oss->yun_upload_img($DBASE_UPLOAD_PATH);

        }
        exit('内容图片完成');
    }
	$sourimgname = $file_info['filename'];//不带后缀文件名，入库
	$rukuimgname = $SID.$sourimgname.$filetype;//带后缀入库的名字
	$save        = $path . $rukuimgname;//将要保存到服务器的路径
	$name        = $_FILES['Filedata']['tmp_name'];//上传到服务器的临时文件
    $image_info = @getimagesize($_FILES['Filedata']['tmp_name']);

  //echo $save;
	if (!move_uploaded_file($name, $save)) {
		
		exit('move fail');
	}

    if(file_exists($save)){
        $oss = new aili_yun_oss;//实例化云
        //把双杠替换成单杠
        $DBASE_UPLOAD_PATH = str_replace('//','/',$save);
        $oss->yun_upload_img($DBASE_UPLOAD_PATH);

    }
	//生成不同规格大小的图片
    $img_width = array('60','240','360','1280');
    foreach($img_width as $k=>$wext){
        $new_fz = $path.$SID.$sourimgname.'_'.$wext.'.jpg';
        if(file_exists($save)){
            $size=getimagesize($save);
            switch($size[2]){
                case 1:
                    $img=imagecreatefromgif($save);
                    break;
                case 2:
                    $img=imagecreatefromjpeg($save);//从源文件建立一个新图片
                    break;
                case 3:
                    $img=imagecreatefrompng($save);
                    break;
                default:
                    exit;
            }
            $srcw=imagesx($img);//源文件的宽度
            $srch=imagesy($img);//源文件的高度

            //更改图片大小,等比例缩放
            $s_width = ($image_info[0] < $wext)?$image_info[0]:$wext;
            $s_height = $image_info[1] / $image_info[0] * $s_width;
            $ratio = $image_info[0]/$image_info[1];
            $wh = $ratio > 1 ? $s_width : $s_height;

            if($ratio>1){
                $dst_y = ($wh-$wh/$ratio)/2;
                $dst_x = 0;
            }else{
                $dst_x = ($wh-$wh*$ratio)/2;
                $dst_y = 0;
            }

            //等比缩图(宽高最大为$wh)
            if ($ratio > 1){
                $s_width = $wh;
                $s_height = $wh/$ratio;
            }else{
                $s_height = $wh;
                $s_width = $wh*$ratio;
            }

            $snewimg = imagecreatetruecolor($wh,$wh);
            imagecopyresampled($snewimg, $img, 0, 0, 0, 0, $s_width, $s_height, $srcw, $srch);

            //创建空白正方目标图
            $newimg = imagecreatetruecolor($wh,$wh);
            $white = imagecolorallocate($newimg, 255, 255, 255);
            imagefill($newimg, 0, 0, $white);
            //填入图片
            imagecopymerge($newimg, $snewimg,$dst_x,$dst_y,0,0,$s_width,$s_height,100);
            if( $new_fz ) {
                //图片保存输出
                imagejpeg($newimg, $new_fz ,100);
            }
            //释放图片
            imagedestroy($snewimg);

            //resizeimage($new_fz,$s_width,$s_height, $new_fz);
            $DBASE_UPLOAD = str_replace('//','/',$new_fz);
            $oss->yun_upload_img($DBASE_UPLOAD);
        }
    }
    echo '上传完成';exit;

    /*
	//数据库信息
	$conn1 = mysql_connect($tbconfig['datahost'],$tbconfig['datausername'],$tbconfig['datauserpass'],true) or die('连接数据库失败');
	mysql_select_db($tbconfig['databasename'],$conn1);
	//用到的表
	$tablegoods       = $tbconfig['datatablepre'].'goods';
	$tablegoodscommon = $tbconfig['datatablepre'].'goods_common';
	$tablegoodsimages = $tbconfig['datatablepre'].'goods_images';
	$tablealbum_pic   = $tbconfig['datatablepre'].'album_pic';
	
	//更新goods表
	$updategoodssql = "UPDATE $tablegoods SET goods_image='".$rukuimgname."' WHERE goods_image='".$sourimgname."'";
	//更新goods_common表
	$updategoodscomsql = "UPDATE $tablegoodscommon SET goods_image='".$rukuimgname."' WHERE goods_image='".$sourimgname."'";
	//更新goods_images表
	$updategoodsimgsql = "UPDATE $tablegoodsimages SET goods_image='".$rukuimgname."' WHERE goods_image='".$sourimgname."'";
	//插入album_pic表
	$insertpic = "INSERT INTO $tablealbum_pic (apic_name,aclass_id,apic_cover,store_id) VALUES('".$sourimgname."','5','".$rukuimgname."','1')";
	mysql_query($updategoodssql,$conn1) or die('更新goods表失败');
	mysql_query($updategoodscomsql,$conn1) or die('更新common表失败');
	mysql_query($updategoodsimgsql,$conn1) or die('更新images表失败');
	mysql_query($insertpic,$conn1) or die('插入album_pic表失败');
    */
}



/* 
 * 图片缩略图 
 */
function resizeimage($srcfile,$ratew='',$rateh='', $filename = "" ){
	$size=getimagesize($srcfile);
	switch($size[2]){
		case 1:
			$img=imagecreatefromgif($srcfile);
			break;
		case 2:
			$img=imagecreatefromjpeg($srcfile);//从源文件建立一个新图片
			break;
		case 3:
			$img=imagecreatefrompng($srcfile);
			break;
		default:
			exit;
	}
	//源图片的宽度和高度
	$srcw=imagesx($img);
	echo '源文件的宽度'.$srcw.'<br />';
	$srch=imagesy($img);
	echo '源文件的高度'.$srch.'<br />';
	//目的图片的宽度和高度
	$dstw=$ratew;
	$dsth=$rateh;
	//新建一个真彩色图像
	echo '新图片的宽度'.$dstw.'高度'.$dsth.'<br />';
	$im=imagecreatetruecolor($dstw,$dsth);
	$black=imagecolorallocate($im,255,255,255);
	imagefilledrectangle($im,0,0,$dstw,$dsth,$black);
	imagecopyresized($im,$img,0,0,0,0,$dstw,$dsth,$srcw,$srch);
	// 以 JPEG 格式将图像输出到浏览器或文件
	if( $filename ) {
	//图片保存输出
		imagejpeg($im, $filename ,100);
	}
	//释放图片
	imagedestroy($im);
	imagedestroy($img);
}
