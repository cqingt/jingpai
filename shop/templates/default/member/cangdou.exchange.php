<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script>
<div class="wrap">
  <div class="tabmenu">
    <?php include template('layout/submenu');?>
  </div>
  <div class="alert alert-block">
      <h4>藏豆兑换礼品（我的可用藏豆：<strong class="mr5 red" style="font-size: 18px;"><?php echo $output['member_info']['cangdou']; ?></strong>）</h4>
      <ul>
          <li>每款商品每人仅限兑换3件<strong>(包邮)</strong></li>
      </ul>
  </div>

    <style>
        .last {
            margin-left: 0 !important;
        }
        .bean-list {
            width: 980px;
            overflow: hidden;
            padding-top: 14px;
        }
        .bean-list ul li {
            float: left;
            margin-left: 22px;
            margin-bottom: 20px;
            border: 2px #fff solid;
        }
        .bean-list ul li a {
            border: 1px #e6e6e6 solid;
            display: block;
            width: 306px;
            height: 340px;
            overflow: hidden;
        }
        .bean-list ul li a .beanimg {
            position: relative;
            width: 240px;
            height: 240px;
            margin: 0 auto;
            overflow: hidden;
        }
        .bean-list ul li a .beanimg .over {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }
        .bean-list ul li a .beanimg img {
            width: 100%;
        }
        .bean-list ul li a .beaniword {
            width: 234px;
            float: left;
            padding: 0 10px;
        }
        .bean-list ul li a .beaniword h2 {
            font-size: 14px;
            line-height: 16px;
            height: 32px;
            width: 292px;
            margin-top: 10px;
            overflow: hidden;
            color: #555;
        }
        .bean-list ul li a .beaniword .p1 {
            font: 14px/16px 'Microsoft YaHei';
            color: #999;
            margin-top: 8px;
        }
        .bean-list ul li a .beaniword .p1 em {
            text-decoration:line-through;
        }
        .bean-list ul li a .beaniword .finish {
            font-size: 16px;
            color: #ec4f4a;
            margin-top: 2px;
            font-family: 'Microsoft YaHei';
        }
        .bean-list ul li a .beaniword .finish em {
            font: 12px/20px 'Microsoft YaHei';
            color: #999;
            display: block;
            float: left;
            margin-right: 8px;
        }
        .bean-list ul li a .beaniword .finish em i {
            margin: 0 6px;
        }
        .bean-list ul li a .beaniword .finish strong {
            color: #000;
        }
        .bean-list ul li a .numberbox {
            float: right;
            width: 42px;
            height: 44px;
            margin: 45px 10px 0 0;
            color: #fff;
            background: #ef4d4a;
            text-align: center;
        }
        .bean-list ul li a .numberbox h4 {
            font-size: 20px;
            font-size: 14px;
            padding-top: 2px;
            border-top: 2px #dd2429 solid;
        }
        .bean-list ul li a .numberbox p {
            font-size: 12px;
            line-height: 12px;
            font-size: 14px;
        }
        .bean-title {
            border-bottom: 1px #e7e7e7 solid;
            margin-bottom: 20px;
        }
        .bean-title h2 {
            font-size: 16px;
            padding-bottom: 6px;
        }
        .bean-title h2 strong {
            color: #ec4f4a;
        }
        .bean-title h2 a {
            font-size: 14px;
            color: #3672ae;
            text-decoration: underline;
            margin-left: 4px;
        }
        .alert li strong {
            font-size: 16px;
            color: #EC4F4A;
        }
        .form-edit {
            margin: 10px 0 0 46px;
        }
        .form-edit .form-control {
            width: 272px;
        }
    </style>
    <div class="bean-list wrapper">
        <!--
        <div class="bean-title">
            <h2>我的藏豆：<strong>0</strong><a href="">藏豆明细</a></h2>
        </div>
        -->
        <?php if(!empty($output['result_list'])){ ?>
        <ul>
            <?php foreach($output['result_list'] as $k=>$v){?>
            <li<?php echo (($k % 3) > 0)?'':' class="last"'?>>
<?php if(intval($v['kucun']-$v['goods_duihuan_sum']) <= 0) {
				?>
				<div class="icon-sold"></div>
				<?php
				}
				?>
                <a href="javascript:void(0)">
                    <div class="beanimg">
                        <img src="<?php echo cthumb($v['goods_image'],'240');?>" alt="<?php echo $v['goods_name'];?>">
                        <p class="over"><i class="icon-make"></i></p>
                    </div>
                    <div class="beaniword">
                        <h2><?php echo $v['goods_name'];?></h2>
                        <p class="p1">售价：<em>￥<?php echo $v['goods_price'];?></em></p>
                        <p class="finish">藏豆：<?php echo $v['use_cangdou'];?></p>
                    </div>
					<?php if($output['member_info']['cangdou'] < $v['use_cangdou'] || intval($v['kucun']-$v['goods_duihuan_sum']) <= 0){ ?>
					<div class="numberbox duihuan" style="background: #bfbfbf;">
                        <h4  style="border-top: 2px #bfbfbf solid;">立即</h4>
                        <p>兑换</p>
                    </div>
					<?php }else {?>
                    <div class="numberbox duihuan" nc_type='exchangebtn' gift_id="<?php echo $v['id'];?>">
                        <h4>立即</h4>
                        <p>兑换</p>
                    </div>
					<?php } ?>
                </a>
            </li>
            <?php } ?>

        </ul>
        <?php }?>
    </div>

        <div class="pagination" style="text-align: center;width: 100%;"> <?php echo $output['page'];?> </div>
    
</div>



<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.zclip.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        var copy_text = '收藏天下是国内最专业的收藏品网站,提供各类收藏品,包括名家书法字画,瓷器紫砂,人民币,邮票,金银币,金银条,纪念钞,纪念币,玉器,珠宝等各类收藏品,并为您提供最新最全的收藏信息！'+$("#copy_lnk").val();
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
<script type="text/javascript">
    $(function(){
        $("[nc_type='exchangebtn']").live('click',function(){
            var gift_id = $(this).attr('gift_id');
            ajaxget('index.php?act=cangdou&op=giftexchange&dialog=1&gift_id='+gift_id);
            return false;
        });
    });
</script>
