<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />

<div class="wrap">
  <div class="tabmenu">
    <?php include template('layout/submenu');?>
  </div>
  <div class="alert alert-block">
  <h4>藏豆获得规则（当前可用藏豆：<strong class="mr5 red" style="font-size: 18px;"><?php echo $output['member_info']['cangdou']; ?></strong>）</h4>
        <ul>
            <li>1.会员A推荐一位新会员B注册并绑定手机后，会员A获得<?php echo C('cangdou_one');?>藏豆</li>
            <li>2.会员B推荐一位新会员C注册并绑定手机后，会员B获得<?php echo C('cangdou_one');?>藏豆，会员A获得<?php echo C('cangdou_two');?>藏豆</li>
            <li>3.被推荐者C购物完成后，推荐人B可获得订单商品实际支付总金额（不含运费、优惠券、满减、手续费）的<?php echo C('cangdou_order_one');?>‰的藏豆，推荐人A可获得<?php echo C('cangdou_order_two');?>‰的藏豆</li>
            <li>4.藏豆可以兑换商城实物商品或现金券</li>
        </ul>
  </div>

    <style>
        .recommend {
            width: 980px;
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
            width: 555px;
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
        <h2>推荐方式一（复制以下链接发送给好友）</h2>
        <div class="rec-form">
            <input type="text" value="http://www.96567.com/index.php?act=zhuanti&op=ad_20160314&ua=cangdou&zmr=<?php echo $_SESSION['member_id']?>" id="copy_lnk">
            <a href="javascrit:;" data-url="http://www.thsmw.com/shop/templates/default/images/invite/ZeroClipboard.swf" id="copy-button">复制</a>
        </div>
        <br/>
        <!--
        <h2>推荐方式二（微信扫描以下二维码，然后分享给朋友）</h2>
        <img class="rec-horse" src="http://www.96567.com/api/center/getqrcode.php?text=http://m.96567.com/?zmr=<?php echo $_SESSION['member_id']?>&size=10&margin=2" alt="">
        -->
    </div>

</div>


<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.zclip.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        var copy_text = '您的好友推荐您注册收藏天下网，注册免费送抗战币，推荐注册送藏豆，藏豆免费兑礼品！'+$("#copy_lnk").val();
        $("#copy-button").zclip({
            path: $("#copy-button").attr('data-url'),
            copy: function(){
                return copy_text;
            },
            beforeCopy:function(){/* 按住鼠标时的操作 */
                $(this).css("color","orange");
            },
            afterCopy:function(){/* 复制成功后的操作 */
                alert("邀请链接复制成功！\n\n马上分享给你的好友吧!" );
            }
        });


    })
</script>
