<?php
$model = Model();
$arr_member = $model->table('seller')->where(array('seller_name'=>'藏金阁'))->select();
print_r($arr_member);
exit;


?>