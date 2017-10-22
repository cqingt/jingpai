<?php
	//使用方法http://你的域名/getMenu.php?appid=你的appid&appsecret=你的appsecret
	header("Content-type: text/html; charset=utf-8");
	@$APPID = $_GET['appid'];
	@$APPSECRET = $_GET['appsecret'];
	$TOKEN_URL = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$APPID."&secret=".$APPSECRET;
	if (ini_get('allow_url_fopen') == 1 && function_exists('curl_init')){
		$json = file_get_contents($TOKEN_URL);
		if (empty($json)){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt ($ch, CURLOPT_URL, $TOKEN_URL);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
			$json = curl_exec($ch);
			curl_close($ch);
		}
		$result = json_decode($json,true);
		@$ACC_TOKEN = $result['access_token'];
		$MENU_URL="https://api.weixin.qq.com/cgi-bin/menu/get?access_token=".$ACC_TOKEN;
		$cu = curl_init();
		curl_setopt($cu, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($cu, CURLOPT_URL, $MENU_URL);
		curl_setopt($cu, CURLOPT_RETURNTRANSFER, 1);
		$menu_json = curl_exec($cu);
		$info = curl_getinfo($cu);
		$menu = json_decode($menu_json);
		curl_close($cu);
		echo $menu_json;
	}else{
		echo "空间不支持！请询问空间商是否开启curl和allow_url_fopen";
	}
?>