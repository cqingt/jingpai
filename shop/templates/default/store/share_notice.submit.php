
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
    <style>
        .recommend {
            overflow: hidden;
            padding: 14px 0;
        }
        .recommend h2 {
            font-size: 14px;
            border-left: 2px #f96767 solid;
            padding-left: 5px;
            margin-bottom: 14px;
        }
        .recommend .rec-form {
            overflow: hidden;
        }
        .recommend .rec-form input {
            width: 530px;
            height: 33px;
            border: 1px #e6e6e6 solid;
            line-height: 33px;
            font-size: 12px;
            float: left;
            padding-left: 15px;
        }
        .recommend .rec-form a {
            width: 64px;
            display: block;
            height: 33px;
            float: left;
            text-align: center;
            background: #f4f4f4;
            margin-left: 10px;
            border: 1px #e6e6e6 solid;
            line-height: 33px;
            font-size: 14px;
            color: #343434;
        }
        .recommend .rec-form a:hover {
            text-decoration: none;
        }
        .recommend .rec-horse {
            margin: 28px 0 10px 177px;
            display: block;
        }
    </style>
    <div class="recommend">
        <h2>分享方式一（复制以下链接发送给好友）</h2>
        <div class="rec-form">
            <input type="text" value="http://www.96567.com/index.php?act=goods&goods_id=<?php echo $_GET['goods_id']?>&zmr=<?php echo $_SESSION['member_id']?>" id="copy_lnk">
            <a href="javascript:void(0)" id="copy-button" onclick="share_button();">复制</a>
        </div>
        <br/>
        <!-- -->
        <h2>分享方式二（微信扫描以下二维码，然后分享给朋友）</h2>
        <img class="rec-horse"  src="http://www.96567.com/api/center/getqrcode.php?size=8&margin=2&text=<?php echo urlencode('http://m.96567.com/index.php?act=goods&op=cangdou_fenxiang&goods_id='.$_GET['goods_id'].'&zmr='.$_SESSION['member_id']);?>" alt="">
       
    </div>
<script type="text/javascript">
	function share_button(){
		var copy_text = '精美产品，最低五折，享不完的折扣，快来参与吧！'+$("#copy_lnk").val();
		var Url2=document.getElementById("copy_lnk");
		Url2.value=copy_text;
		Url2.select(); // 选择对象
		document.execCommand("Copy"); // 执行浏览器复制命令
		Url2.value="http://www.96567.com/index.php?act=goods&goods_id=<?php echo $_GET['goods_id']?>&zmr=<?php echo $_SESSION['member_id']?>";
		alert("邀请链接复制成功！\n\n马上分享给你的好友吧!" );
	}
</script>