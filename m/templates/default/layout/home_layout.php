<?php defined('InShopNC') or exit('Access Invalid!');?>
<?php
if($output['IsShuHua']){
	require_once template('artist/sh_header');
	require_once($tpl_file);
	require_once template('artist/sh_footer');
}else{
	require_once template('header');
	require_once($tpl_file);
	require_once template('footer');	
}

?>

