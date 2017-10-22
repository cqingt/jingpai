<?php
require_once(dirname(__FILE__).'/zhima.sdk.php');
$zm = new zhima();
$dataArr = $zm->Decryption();
echo $zm->GetZhimaScore($dataArr['open_id']);
