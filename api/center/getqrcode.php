<?php
include dirname(__FILE__).'/phpqrcode.php';

$text = $_GET['text'];
$size = (intval($_GET['size']) <= 0) ? '8' : intval($_GET['size']);
$margin = (intval($_GET['margin']) <= 0) ? '8' : intval($_GET['margin']);


/*
    png($text, $outfile=false, $level=QR_ECLEVEL_L, $size=3, $margin=4, $saveandprint=false)
    ����$text��ʾ���ɶ�λ�ĵ���Ϣ�ı���
    ����$outfile��ʾ�Ƿ������ά��ͼƬ �ļ���Ĭ�Ϸ�
    ����$level��ʾ�ݴ��ʣ�Ҳ�����б����ǵ�������ʶ�𣬷ֱ��� L��QR_ECLEVEL_L��7%����
        M��QR_ECLEVEL_M��15%����Q��QR_ECLEVEL_Q��25%����H��QR_ECLEVEL_H��30%����
    ����$size��ʾ����ͼƬ��С��Ĭ����3������$margin��ʾ��ά����Χ�߿�հ�������ֵ��
 */
QRcode::png($text, false, QR_ECLEVEL_L, $size, $margin, false);