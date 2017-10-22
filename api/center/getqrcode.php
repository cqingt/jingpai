<?php
include dirname(__FILE__).'/phpqrcode.php';

$text = $_GET['text'];
$size = (intval($_GET['size']) <= 0) ? '8' : intval($_GET['size']);
$margin = (intval($_GET['margin']) <= 0) ? '8' : intval($_GET['margin']);


/*
    png($text, $outfile=false, $level=QR_ECLEVEL_L, $size=3, $margin=4, $saveandprint=false)
    参数$text表示生成二位的的信息文本；
    参数$outfile表示是否输出二维码图片 文件，默认否；
    参数$level表示容错率，也就是有被覆盖的区域还能识别，分别是 L（QR_ECLEVEL_L，7%），
        M（QR_ECLEVEL_M，15%），Q（QR_ECLEVEL_Q，25%），H（QR_ECLEVEL_H，30%）；
    参数$size表示生成图片大小，默认是3；参数$margin表示二维码周围边框空白区域间距值；
 */
QRcode::png($text, false, QR_ECLEVEL_L, $size, $margin, false);