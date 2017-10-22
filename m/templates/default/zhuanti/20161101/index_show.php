<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161101/css/new_file.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161101/css/component.css" />

<div class="demo-con">
<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101app/s_01.jpg"/>
<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101app/s_02.jpg"/>
<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101app/s_03.jpg"/>

<div class="htbox">
    <ul class="shopbox">
        <li>
            <a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=36521">
                <i class="icon-chaozhi"></i>
                <div class="imgbox"><p class="img" style="background: url(<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161101/images/pic_01.jpg)"></p></div>
                <h2>五大名窑品茗杯套装</h2>
                <div class="bxocom">
                    <span>
                        <p>惊爆价</p>
                        <strong>49.9</strong>
                    </span>
                    <i class="icon-ico">立即抢购</i>
                </div>
            </a>
        </li>   
        <li>
            <a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=17163">
                <i class="icon-zuigao"></i>
                <div class="imgbox"><p class="img" style="background: url(<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161101/images/pic_02.jpg)"></p></div>
                <h2>冰裂紫砂茶具套装</h2>
                <div class="bxocom">
                    <span>
                        <p>惊爆价</p>
                        <strong>19.9</strong>
                    </span>
                    <i class="icon-ico">立即抢购</i>
                </div>
            </a>
        </li>   
        <li>
            <a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=34192">
                <i class="icon-zuidi"></i>
                <div class="imgbox"><p class="img" style="background: url(<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161101/images/pic_04.jpg)"></p></div>
                <h2>天然玉化砗磲手串</h2>
                <div class="bxocom">
                    <span>
                        <p>惊爆价</p>
                        <strong>19</strong>
                    </span>
                    <i class="icon-ico">立即抢购</i>
                </div>
            </a>
        </li>   
        <li>
            <a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=27276">
                <i class="icon-zuidi"></i>
                <div class="imgbox"><p class="img" style="background: url(<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161101/images/pic_03.jpg)"></p></div>
                <h2>天然黑石手链</h2>
                <div class="bxocom">
                    <span>
                        <p>惊爆价</p>
                        <strong>39</strong>
                    </span>
                    <i class="icon-ico">立即抢购</i>
                </div>
            </a>
        </li>
    </ul>
</div>
    
<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101app/s_05.jpg"/>
<img class="md-trigger" data-modal="modal-from1" src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101app/s_06.jpg"/>

<?php if($output['goods_list']['goods_list_1']){?>
    <div class="htbox-one">
        <ul class="shopbox-one"  >
        <?php foreach($output['goods_list']['goods_list_1'] as $k => $v){?>
            <li>
                <a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
                    <i class="ico-qefx"></i>
                    <div class="imgbox"><p class="img" style="background: url(<?php echo cthumb($v['goods_image'],360);?>)"></p></div>
                    <h2><?php echo $v['goods_name'];?></h2>
                    <div class="bxocom">
                        <span>
                            <p>双11狂欢价</p>
                            <strong>￥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></strong>
                        </span>
                        <i class="icon-ico">立即抢购</i>
                    </div>
                </a>
            </li>   
        <?php }?>
        </ul>
    </div>
<?php }?>

<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101app/s_08.jpg"/>
<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101app/s_09.jpg"/>
<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101app/s_10.jpg"/>
<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101app/s_11.jpg"/>
<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=35361"><img src="http://images.96567.com/upload/shop/store/goods/3/3_05318544892965142_1280.jpg"/></a>
<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=12351"><img src="http://images.96567.com/upload/shop/store/goods/3/3_05318544878099667_1280.jpg"/></a>

<?php if($output['goods_list']['goods_list_2']){?>
    <div class="htbox-two">
        <ul class="shopbox-two"  >
        <?php foreach($output['goods_list']['goods_list_2'] as $k => $v){?>
            <li>
                <a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
                    <i class="ico-quane"></i>
                    <div class="imgbox"><p class="img" style="background: url(<?php echo cthumb($v['goods_image'],360);?>)"></p></div>
                    <h2><?php echo $v['goods_name'];?></h2>
                    <div class="bxocom">
                        <span>
                            <p>双11狂欢价</p>
                            <strong>￥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></strong>
                        </span>
                        <i class="icon-ico">立即抢购</i>
                    </div>
                </a>
            </li>  
        <?php }?>
        </ul>
    </div>
<?php }?>

<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101app/s_15.jpg"/>
<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=845"><img src="http://images.96567.com/upload/shop/store/goods/3/3_05318544817235379_1280.jpg"/></a>
<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=35303"><img src="http://images.96567.com/upload/shop/store/goods/3/3_05318544506479078_1280.jpg"/></a>

<?php if($output['goods_list']['goods_list_3']){?>

    <div class="htbox-two two">
        <ul class="shopbox-two"  >
        <?php foreach($output['goods_list']['goods_list_3'] as $k => $v){?>
            <li>
                <a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
                    <i class="ico-quane"></i>
                    <div class="imgbox"><p class="img" style="background: url(<?php echo cthumb($v['goods_image'],360);?>)"></p></div>
                    <h2><?php echo $v['goods_name'];?></h2>
                    <div class="bxocom">
                        <span>
                            <p>双11狂欢价</p>
                            <strong>￥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></strong>
                        </span>
                        <i class="icon-ico">立即抢购</i>
                    </div>
                </a>
            </li>   
 <?php }?>

        </ul>
    </div>
    <?php }?>

<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101app/s_19.jpg"/>
<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=27686
"><img src="http://images.96567.com/upload/shop/store/goods/3/3_05318544961426954_1280.jpg"/></a>
<a href="http://m.96567.com/index.php?act=goods&op=index&goods_id=16435
"><img src="http://images.96567.com/upload/shop/store/goods/3/3_05318544644571331_1280.jpg"/></a>
    
<?php if($output['goods_list']['goods_list_4']){?>
    <div class="htbox-two three">
        <ul class="shopbox-two"  >

        <?php foreach($output['goods_list']['goods_list_4'] as $k => $v){?>
            <li>
                <a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
                    <i class="ico-quane"></i>
                    <div class="imgbox"><p class="img" style="background: url(<?php echo cthumb($v['goods_image'],360);?>)"></p></div>
                    <h2><?php echo $v['goods_name'];?></h2>
                    <div class="bxocom">
                        <span>
                            <p>双11狂欢价</p>
                            <strong>￥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></strong>
                        </span>
                        <i class="icon-ico">立即抢购</i>
                    </div>
                </a>
            </li>   
 <?php }?>

        </ul>
    </div>
<?php }?>

<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101app/s_23.jpg"/>

<?php if($output['goods_list']['goods_list_5']){?>

    <div class="htbox-three">
        <ul class="shopbox-three"  >
        <?php foreach($output['goods_list']['goods_list_5'] as $k => $v){?>
            <li>
                <a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
                    <i class="icon-five"></i>
                    <div class="imgbox"><p class="img" style="background: url(<?php echo cthumb($v['goods_image'],360);?>)"></p></div>
                    <h2><?php echo $v['goods_name'];?></h2>
                    <div class="bxocom">
                        <span>
                            <p>￥<?php echo $v['goods_price'];?></p>
                            <strong>￥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></strong>
                        </span>
                        <i class="icon-ico">立即抢购</i>
                    </div>
                </a>
            </li>   
        <?php }?>
        </ul>
    </div>
<?php }?>

<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101app/s_25.jpg"/>

<?php if($output['goods_list']['goods_list_6']){?>

<div class="htbox-three">
    <ul class="shopbox-three"  >
        <?php foreach($output['goods_list']['goods_list_6'] as $k => $v){?>
            <li>
                <a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
                    <i class="icon-five"></i>
                    <div class="imgbox"><p class="img" style="background: url(<?php echo cthumb($v['goods_image'],360);?>)"></p></div>
                    <h2><?php echo $v['goods_name'];?></h2>
                    <div class="bxocom">
                        <span>
                            <p>￥<?php echo $v['goods_price'];?></p>
                            <strong>￥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></strong>
                        </span>
                        <i class="icon-ico">立即抢购</i>
                    </div>
                </a>
            </li>   
        <?php }?>
    </ul>
</div>
<?php }?>

<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101app/s_27.jpg"/>
    
<?php if($output['goods_list']['goods_list_7']){?>

    <div class="htbox-three">
        <ul class="shopbox-three"  >
        <?php foreach($output['goods_list']['goods_list_7'] as $k => $v){?>
            <li>
                <a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
                    <i class="icon-five"></i>
                    <div class="imgbox"><p class="img" style="background: url(<?php echo cthumb($v['goods_image'],360);?>)"></p></div>
                    <h2><?php echo $v['goods_name'];?></h2>
                    <div class="bxocom">
                        <span>
                            <p>￥<?php echo $v['goods_price'];?></p>
                            <strong>￥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></strong>
                        </span>
                        <i class="icon-ico">立即抢购</i>
                    </div>
                </a>
            </li>   
        <?php }?>
    </ul>
</div>
<?php }?>


<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101app/s_29.jpg"/>
    
<?php if($output['goods_list']['goods_list_8']){?>


    <div class="htbox-three">
        <ul class="shopbox-three"  >
        <?php foreach($output['goods_list']['goods_list_8'] as $k => $v){?>
            <li>
                <a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>">
                    <i class="icon-five"></i>
                    <div class="imgbox"><p class="img" style="background: url(<?php echo cthumb($v['goods_image'],360);?>)"></p></div>
                    <h2><?php echo $v['goods_name'];?></h2>
                    <div class="bxocom">
                        <span>
                            <p>￥<?php echo $v['goods_price'];?></p>
                            <strong>￥<?php echo intval($v['tuangou_money'])?intval($v['tuangou_money']):(intval($v['xianshi_money'])?intval($v['xianshi_money']):intval($v['goods_price']));?></strong>
                        </span>
                        <i class="icon-ico">立即抢购</i>
                    </div>
                </a>
            </li>   
        <?php }?>
    </ul>
</div>
<?php }?>

<a href="#"><img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/ss20161101app/s_28.jpg"/></a>

</div>


<div class="md-modal md-effect-11" id="modal-from1">
    <div class="md-content coloured">
        <div class="demo clearfix">
                <!-- Demo start 2-->
                <div class="demo formbox" id="c2">
                    <h3>活动说明</h3>
                    <p>1、购买【全额返现】活动区商品，且订单完成付款或确认收货即可活动商品全额返现；</p>
                    <p>2、返现将以优惠券的方式发放至会员账号，请在 <strong>我的商城→我的优惠券→店铺优惠券</strong> 中查看；</p>
                    <p>3、优惠券仅可在收藏天下书画馆中使用，直抵现金；</p>
                    <p>本活动最终解释权归收藏天下所有。</p>
                </div>
                <!-- Demo end -->  
            </div>
             
             <!--关闭按钮-->
            <button class="md-close close-one"><i class="icon-close"></i></button>

        </div>
    </div>
</div>

<!-- 这是遮罩 -->
<div class="md-overlay"></div>  
<!-- 弹出层 End -->

<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161101/js/classie.js"></script>
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20161101/js/modalEffects.js"></script>
<script>
    var polyfilter_scriptpath = '/js/';
</script>

<?php

$array['P']['title'] = "狂欢双11，低至5折，免费送大金条！";
$array['P']['imgUrl'] = '';
$array['Y']['title'] = "狂欢双11，低至5折，免费送大金条！";
$array['Y']['desc'] = "狂欢双11，低至5折，免费送大金条！1年就1次，机不可失！";
$array['Y']['imgUrl'] = '';

echo weixinShare($array);

?>