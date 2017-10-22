<?php
/**
 * 业务员绑定
 */

defined('InShopNC') or exit('Access Invalid!');
class getcodeControl extends mobileHomeControl{
	public function __construct() {
        parent::__construct();
    }

    public function indexOp() {
       if($_SESSION['openid']){
		   $getcode = Model ( 'getcode' );
		   $UName = $getcode->selectOpenid(array('openid'=>$_SESSION['openid']),'UName');
		   if($UName){
				echo '<script>alert("您的openid已经绑定“'.$UName['UName'].'”这个账户，前去分享吧！"); window.location.href="http://m.96567.com"</script>';
		   }else{
			   $shop_openid = array(
					'UID' =>  $_GET['df_UID'],
					'UName' =>$_GET['df_UName'],
					'openid' =>$_SESSION['openid'],
					'is_yw' =>'1'
				);
				$getcode->addOpenid($shop_openid);
				echo '<script>alert("绑定成功！"); window.location.href="http://m.96567.com"</script>';
		   }
	   }else{
			echo '<script>alert("绑定失败，请刷新页面重新输入绑定。"); window.location.href="http://m.96567.com/binding/login.php"</script>';
	   }
    }
}
