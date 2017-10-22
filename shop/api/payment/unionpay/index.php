<?php
/**
 * 中艺会网站支付接口 网银在线支付接口类
 *
 * @ date：2016-10-14
 */

class unionpay{

	function __construct($payment_info = array(),$order_info = array()){
		$this->sign_cert_path = dirname(__FILE__).DIRECTORY_SEPARATOR.'4066698.pfx';// 签名证书路径
        $this->encrtpy_cert_path = dirname(__FILE__).DIRECTORY_SEPARATOR;
            $this->payment	= $payment_info;
            $this->order	= $order_info;
            if($_POST['bank_code'] != ''){
                $this->bank_code = $_POST['bank_code'];
            }
		$this->cert_passwd = '406669'; // 签名证书密码
	}

    /**
     * 支付表单
     *
     * @return string
     */
    public function submit($params){
		if($params){
			// 前台请求地址
			$front_uri = 'https://gateway.95516.com/gateway/api/frontTransReq.do';
			//构造要请求的参数数组
			if($payment['bankcode'] != ''){
				$params['issInsCode'] = $payment['bankcode'];
			}
			$params['signature'] = $this->sign($params);
			$html_form = $this->create_html ( $params, $front_uri );
			echo $html_form;exit;
		}else{
			exit;
		}
    }

    /**
     * 返回地址验证 异步未支付成功，返回失败
     *
     * @return bool
     */
    public function return_verify() {
        return false;
    }

	/**
	 * 签名
	 *
	 * @param String $params_str
	 */
	function sign(&$params) {
		if(isset($params['transTempUrl'])){
			unset($params['transTempUrl']);
		}
		// 转换成key=val&串
		$params_str = $this->coverParamsToString ( $params );

		$params_sha1x16 = sha1 ( $params_str, FALSE );
		// 签名证书路径
		$cert_path = $this->sign_cert_path;
		$private_key = $this->getPrivateKey ( $cert_path );
		// 签名
		$sign_falg = openssl_sign ( $params_sha1x16, $signature, $private_key, OPENSSL_ALGO_SHA1 );
		if ($sign_falg) {
			$signature_base64 = base64_encode ( $signature );
			return $signature_base64;
		} else {
			//$log->LogInfo ( ">>>>>签名失败<<<<<<<" );
		}
	}

	/**
	 * 签名证书ID
	 *
	 * @return unknown
	 */
	function getSignCertId() {
		// 签名证书路径
		return $this->getCertId ( $this->sign_cert_path );
	}

	/**
	 * 取证书ID(.pfx)
	 *
	 * @return unknown
	 */
	function getCertId($cert_path) {
		$pkcs12certdata = file_get_contents ( $cert_path );
		openssl_pkcs12_read ( $pkcs12certdata, $certs, $this->cert_passwd );
		$x509data = $certs ['cert'];
		openssl_x509_read ( $x509data );
		$certdata = openssl_x509_parse ( $x509data );
		$cert_id = $certdata ['serialNumber'];
		return $cert_id;
	}

	/**
	 * 返回(签名)证书私钥 -
	 *
	 * @return unknown
	 */
	function getPrivateKey($cert_path) {
		$pkcs12 = file_get_contents ( $cert_path );
		openssl_pkcs12_read ( $pkcs12, $certs, $this->cert_passwd );
		return $certs ['pkey'];
	}

	/**
	 * 验签
	 *
	 * @param String $params_str
	 * @param String $signature_str
	 */
	function notify_verify() {
        $params	= $_POST;
        unset($params['extra_common_param']);

		// 公钥
		$public_key = $this->getPulbicKeyByCertId ( $params ['certId'] );
		// 签名串
		$signature_str = $params ['signature'];
		unset ( $params ['signature'] );
		$params_str = $this->coverParamsToString ( $params );
		$signature = base64_decode ( $signature_str );
//	echo date('Y-m-d',time());
		$params_sha1x16 = sha1 ( $params_str, FALSE );
		$isSuccess = openssl_verify ( $params_sha1x16, $signature,$public_key, OPENSSL_ALGO_SHA1 );
		return $isSuccess;
	}

    /**
     * 根据证书ID 加载 证书
     *
     * @param unknown_type $certId
     * @return string NULL
     */
    function getPulbicKeyByCertId($certId) {
        // 证书目录
        $cert_dir = $this->encrtpy_cert_path;
        $handle = opendir ( $cert_dir );
        if ($handle) {
            while ( $file = readdir ( $handle ) ) {
                clearstatcache ();
                $filePath = $cert_dir . '/' . $file;
                if (is_file ( $filePath )) {
                    if (pathinfo ( $file, PATHINFO_EXTENSION ) == 'cer') {
                        if ($this->getCertIdByCerPath ( $filePath ) == $certId) {
                            closedir ( $handle );
                            return $this->getPublicKey ( $filePath );
                        }
                    }
                }
            }
            return( '没有找到证书ID为[' . $certId . ']的证书' );
        } else {
            return( '证书目录 ' . $cert_dir . '不正确' );
        }
        closedir ( $handle );
        return null;
    }

    /**
     * 取证书公钥 -验签
     *
     * @return string
     */
    function getPublicKey($cert_path) {
        return file_get_contents ( $cert_path );
    }

    /**
     * 取证书ID(.cer)
     *
     * @param unknown_type $cert_path
     */
    function getCertIdByCerPath($cert_path) {
        $x509data = file_get_contents ( $cert_path );
        openssl_x509_read ( $x509data );
        $certdata = openssl_x509_parse ( $x509data );
        $cert_id = $certdata ['serialNumber'];
        return $cert_id;
    }

	/**
	 * 数组 排序后转化为字体串
	 *
	 * @param array $params
	 * @return string
	 */
	function coverParamsToString($params) {
		$sign_str = '';
		// 排序
		ksort ( $params );
		foreach ( $params as $key => $val ) {
			if ($key == 'signature') {
				continue;
			}
			$sign_str .= sprintf ( "%s=%s&", $key, $val );
			// $sign_str .= $key . '=' . $val . '&';
		}
		return substr ( $sign_str, 0, strlen ( $sign_str ) - 1 );
	}

	/**
	 * 字符串转换为 数组
	 *
	 * @param unknown_type $str
	 * @return multitype:unknown
	 */
	function coverStringToArray($str) {
		$result = array ();

		if (! empty ( $str )) {
			$temp = preg_split ( '/&/', $str );
			if (! empty ( $temp )) {
				foreach ( $temp as $key => $val ) {
					$arr = preg_split ( '/=/', $val, 2 );
					if (! empty ( $arr )) {
						$k = $arr ['0'];
						$v = $arr ['1'];
						$result [$k] = $v;
					}
				}
			}
		}
		return $result;
	}

	/**
	 * 构造自动提交表单
	 *
	 * @param unknown_type $params
	 * @param unknown_type $action
	 * @return string
	 */
	function create_html($params, $action) {
		$encodeType = isset ( $params ['encoding'] ) ? $params ['encoding'] : 'UTF-8';
		$html = <<<eot
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset={$encodeType}" />
</head>
<body onload="javascript:document.pay_form.submit();">
    <form id="pay_form" name="pay_form" action="{$action}" method="post">

eot;
		foreach ( $params as $key => $value ) {
			$html .= "    <input type=\"hidden\" name=\"{$key}\" id=\"{$key}\" value=\"{$value}\" />\n";
		}
		$html .= <<<eot
    <input type="submit" type="hidden" style="display:none">
    </form>
</body>
</html>
eot;
		return $html;
	}
}


$a = new unionpay();
//var_dump($_POST);
echo $a->submit($_POST);