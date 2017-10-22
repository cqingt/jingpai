<?php
/**
 * mobile公共方法
 *
 * 公共方法
 *
 * by 33hao.com 好商城V3 运营版
 */
defined('InShopNC') or exit('Access Invalid!');

function output_data($datas, $extend_data = array()) {
    $data = array();
    $data['code'] = 200;

    if(!empty($extend_data)) {
        $data = array_merge($data, $extend_data);
    }

    $data['datas'] = $datas;

    if(!empty($_GET['callback'])) {
        echo $_GET['callback'].'('.json_encode($data).')';die;
    } else {
        echo json_encode($data);die;
    }
}

function output_error($message, $extend_data = array()) {
    $datas = array('error' => $message);
    output_data($datas, $extend_data);
}

function mobile_page($page_count) {
    //输出是否有下一页
    $extend_data = array();
    $current_page = intval($_GET['curpage']);
    if($current_page <= 0) {
        $current_page = 1;
    }
    if($current_page >= $page_count) {
        $extend_data['hasmore'] = false;
    } else {
        $extend_data['hasmore'] = true;
    }
    $extend_data['page_total'] = $page_count;
    return $extend_data;
}

function urlWap($act = '', $op = '', $args = array()){
    return url($act, $op, $args, false, M_SITE_URL);
}

function showWapMessage($msg,$url='',$msg_type='succ',$time=2000,$show_type='html',$is_show=1){
    /**
     * 如果默认为空，则跳转至上一步链接
     */
    $url = ($url!='' ? $url : getReferer());

    $msg_type = in_array($msg_type,array('succ','error')) ? $msg_type : 'error';

    /**
     * 输出类型
     */
    switch ($show_type){
        case 'json':
            $return = '{';
            $return .= '"msg":"'.$msg.'",';
            $return .= '"url":"'.$url.'"';
            $return .= '}';
            echo $return;
            break;
        case 'javascript':
            echo "<script>";
            echo "alert('". $msg ."');";
            echo "location.href='". $url ."'";
            echo "</script>";
            exit;
            break;
        default:
            /**
             * html输出形式
             * 指定为指定项目目录下的error模板文件
             */
            Tpl::setDir('');
            // Tpl::output('html_title',Language::get('nc_html_title'));
            Tpl::output('msg',$msg);
            Tpl::output('nav_title','提示信息');
            Tpl::output('html_title','提示信息 - '.C('site_name'));
            Tpl::output('url',$url);
            Tpl::output('msg_type',$msg_type);
            Tpl::output('is_show',$is_show);
            Tpl::showpage('msg','msg_layout',$time);
    }
    exit;
}

function get_url(){
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

    $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    return $url;
}


function weixinShare($array = '',$FenXiangTiaoZhuanUrl=''){

    if(!strpos($_SERVER['HTTP_USER_AGENT'],"MicroMessenger") || empty($array)){
        return '';
    }
	//分享成功后的跳转地址
	if($FenXiangTiaoZhuanUrl){
		$tiaoZHuan = "window.location.href='".$FenXiangTiaoZhuanUrl."'";
	}
    $url = get_url();

    if($_SESSION['openid']){
        if(strpos($url,'?')){
            $push_url = get_url().'&push_openid='.$_SESSION['openid'];
        }else{
            $push_url = get_url().'?push_openid='.$_SESSION['openid'];
        }
    }else{
        $push_url = get_url();
    }

    /* Add is name 2016-07-25 增加CRM业务员ID*/
    if(strpos($push_url,'?')){
        intval($_GET['yw_id'])?$yw_id='&yw_id='.intval($_GET['yw_id']):$yw_id='&yw_id='.intval($_SESSION['yw_id']);
    }else{
        intval($_GET['yw_id'])?$yw_id='?yw_id='.intval($_GET['yw_id']):$yw_id='?yw_id='.intval($_SESSION['yw_id']);
    }

    /* End */

    $array['P']['link'] = $array['P']['link']?$array['P']['link'].$yw_id:$push_url.$yw_id;
    $array['Y']['link'] = $array['Y']['link']?$array['Y']['link'].$yw_id:$push_url.$yw_id;

    $array['P']['imgUrl'] = $array['P']['imgUrl']?str_replace('images.96567.com','www.96567.com/data',$array['P']['imgUrl']):'';
    $array['Y']['imgUrl'] = $array['Y']['imgUrl']?str_replace('images.96567.com','www.96567.com/data',$array['Y']['imgUrl']):'';

    $jsweixin = new JsSDK('wx00d52d21505f383f','1dad56778549190c2d1268caa9e2aa11',$url);

    $getSignPackage = $jsweixin->getSignPackage();

    $weixin_share_str = <<<EOF
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>
    wx.config({
        debug: false,
        appId:"$getSignPackage[appId]",
        timestamp:"$getSignPackage[timestamp]",
        nonceStr:"$getSignPackage[nonceStr]",
        signature:"$getSignPackage[signature]",
        jsApiList: [
          // 所有要调用的 API 都要加到这个列表中
          'onMenuShareTimeline',
          'onMenuShareAppMessage',
        ]
    });

    wx.ready(function () {
        wx.onMenuShareTimeline({
            title: "{$array['P']['title']}", // 分享标题
            link: "{$array['P']['link']}", // 分享链接
            imgUrl: "{$array['P']['imgUrl']}", // 分享图标
            success: function () {
            alert('分享成功');
			{$tiaoZHuan}
        }
    });

    wx.onMenuShareAppMessage({
        title: "{$array['Y']['title']}", // 分享标题
        desc: "{$array['Y']['desc']}", // 分享描述
        link: "{$array['Y']['link']}", // 分享链接
        imgUrl: "{$array['Y']['imgUrl']}", // 分享图标
        type: "", // 分享类型,music、video或link，不填默认为link
        dataUrl: "", // 如果type是music或video，则要提供数据链接，默认为空
        success: function () {
            alert('分享成功');
			{$tiaoZHuan}
        }
    });
  });

</script>
EOF;

echo $weixin_share_str;
}

//检查是否分享成功
function weixinShareHuiDiao($array = '',$FenXiangTiaoZhuanUrl='',$ad_name = 'ad_20160415'){

    if(!strpos($_SERVER['HTTP_USER_AGENT'],"MicroMessenger") || empty($array)){
        return '';
    }
	//分享成功后的跳转地址
	if($FenXiangTiaoZhuanUrl){
		$tiaoZHuan = "window.location.href='".$FenXiangTiaoZhuanUrl."'";
	}

    $url = get_url();

    if($_SESSION['openid']){
        if(strpos($url,'?')){
            $push_url = get_url().'&push_openid='.$_SESSION['openid'];
        }else{
            $push_url = get_url().'?push_openid='.$_SESSION['openid'];
        }
    }else{
        $push_url = get_url();
    }

    $array['P']['link'] = $array['P']['link']?$array['P']['link']:$push_url;
    $array['Y']['link'] = $array['Y']['link']?$array['Y']['link']:$push_url;

    $array['P']['imgUrl'] = $array['P']['imgUrl']?str_replace('images.96567.com','www.96567.com/data',$array['P']['imgUrl']):'';
    $array['Y']['imgUrl'] = $array['Y']['imgUrl']?str_replace('images.96567.com','www.96567.com/data',$array['Y']['imgUrl']):'';

    $jsweixin = new JsSDK('wx00d52d21505f383f','1dad56778549190c2d1268caa9e2aa11',$url);

    $getSignPackage = $jsweixin->getSignPackage();

    $weixin_share_str = <<<EOF
    <script src="http://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script>
    wx.config({
        debug: false,
        appId:"$getSignPackage[appId]",
        timestamp:"$getSignPackage[timestamp]",
        nonceStr:"$getSignPackage[nonceStr]",
        signature:"$getSignPackage[signature]",
        jsApiList: [
          // 所有要调用的 API 都要加到这个列表中
          'onMenuShareTimeline',
          'onMenuShareAppMessage',
        ]
    });

    wx.ready(function () {
        wx.onMenuShareTimeline({
            title: "{$array['P']['title']}", // 分享标题
            link: "{$array['P']['link']}", // 分享链接
            imgUrl: "{$array['P']['imgUrl']}", // 分享图标
            success: function () {
            $.ajax({
				type:'post',
				url:"index.php?act=zhuanti&op={$ad_name}&action=fenxiang",
				data:'',
				dataType:'json',
				success:function(result){
					alert('分享成功');
					{$tiaoZHuan}
				}
			});
        }
    });

    wx.onMenuShareAppMessage({
        title: "{$array['Y']['title']}", // 分享标题
        desc: "{$array['Y']['desc']}", // 分享描述
        link: "{$array['Y']['link']}", // 分享链接
        imgUrl: "{$array['Y']['imgUrl']}", // 分享图标
        type: "", // 分享类型,music、video或link，不填默认为link
        dataUrl: "", // 如果type是music或video，则要提供数据链接，默认为空
        success: function () {
            $.ajax({
				type:'post',
				url:"index.php?act=zhuanti&op={$ad_name}&action=fenxiang",
				data:'',
				dataType:'json',
				success:function(result){
					alert('分享成功');
					{$tiaoZHuan}
				}
			});
        }
    });
  });

</script>
EOF;

echo $weixin_share_str;
}