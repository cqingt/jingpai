<?php
echo create_html($_POST,"http://zyh.96567.com/respond.php?code=upop");
/**
 * 构造自动提交表单
 *
 * @param unknown_type $params
 * @param unknown_type $action
 * @return string
 */
function create_html($params, $action) {
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
?>