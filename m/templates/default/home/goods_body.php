<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/page.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/msscss.css">
<div class="content">
    <div class="pddetail-cnt">
        <div class="pd-detail-tab">
            <!-- <ul class="product-infor">
                <li class="current">
                    <a href="index.php?act=goods&op=index&goods_id=<?php echo $_GET['goods_id']?>">返回商品</a>
                </li>
            </ul> -->
            <div id="fixed-tab-pannel" style="padding-left: 5px;padding-right: 5px">
                <div class="fixed-tab-pannel"><?php echo $output['goods_common_info']['goods_body'];?></div>
            </div>
        </div>
    </div>
</div>


<style>
    .m_w {
        margin: 0 auto;
        display: inline-block;
        text-align: center;
    }
    .m_xbj0505{margin-bottom:52px;}
    .m_bottom{width:100%; height:52px;background:#333; position:fixed; bottom:0; z-index:99999; min-width:320px; max-width:640px;}
    .m_bottom ul li{float:left; width:22%; height:42px;  padding:5px 0; text-align:center; font-size:12px; line-height:21px;}
    .m_bottom ul li img{width:19px; height:19px;}
    .m_bottom ul li a{color:#b0b0b0;}
    .m_bottom ul li.hover a{color:#ef4f4f;}
    .jrgwc{width:34%; text-align:center;  background-color:#FD5D5D; height:52px; display:block; float:right;}
    .botton_jrgwc{text-align:center;color:#fff; font-size:16px; font-family:"Microsoft YaHei"; line-height:52px; height:52px; border-radius:0;}
    .bkground9 {
        background-color: #999;
    }
</style>
<div class="m_w">
    <div class="m_bottom">
        <ul>
            <li>
                <a href="<?php echo M_SITE_URL;?>">
                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/home_icon.png" width="19">
                    <br>首页
                </a>
            </li>
            <li class="hover">
                <a href="javascript:(0);" <?php if($output['goods_info']['is_own_shop'] == 1){?> 
		onclick="NTKF.im_openInPageChat('sc_1000_9999')"
	<?php
	}else{
	?>
		onclick="NTKF.im_openInPageChat('sc_<?php echo 1000+intval($output['goods_info']['store_id']);?>_9999')"
	<?php
	}
	?>>
                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/kf_red_icon.png" width="19">
                    <br>客服</a>
            </li>
            <li><a href="<?php echo urlWap('member_cart','cart_list')?>">
                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/gwc_icon.png" width="19">
                    <br>购物车</a>
            </li>
            <?php if($output['goods_info']['goods_storage'] > 0 && $output['goods_info']['goods_price'] >= 1){ ?>
                <span class="jrgwc">
                    <input name="" type="button" value="加入购物车" class="botton_jrgwc" id="add-to-cart">
                </span>
            <?php }elseif($output['goods_info']['goods_storage'] > 0 && $output['goods_info']['goods_price'] < 1){?>
                <span class="jrgwc bkground9">
                    <input name="" type="button" value="加入购物车" class="botton_jrgwc" disabled>
                </span>
            <?php }else{?>

                <?php if (($output['goods_info']['goods_price'] <= 1 || $output['goods_info']['goods_storage'] <= 0) && $output['goods_info']['is_appoint'] == 1) {?>

                <span class="jrgwc">
                    <a href="<?php echo urlWap('goods','arrival_notice',array('goods_id'=>$output['goods_info']['goods_id'],'type'=>2));?>"  class="botton_jrgwc" >立即预约</a>
                </span>
                
                <?php }elseif($output['goods_info']['goods_state'] == 0 || $output['goods_info']['goods_storage'] <= 0){?>

                <span class="jrgwc">
                    <a href="<?php echo urlWap('goods','arrival_notice',array('goods_id'=>$output['goods_info']['goods_id']));?>"  class="botton_jrgwc" >到货通知</a>
                </span>


                <?php }else{?>

                <span class="jrgwc bkground9">
                    <input name="" type="button" value="库存不足" class="botton_jrgwc" disabled>
                </span>

              <?php }?>


                


            <?php }?>

        </ul>
    </div>
</div>


<script>
    $(function(){
        $("#add-to-cart").click(function (){
            var goods_id = "<?php echo $output['goods_info']['goods_id'];?>";
            $.ajax({
                url:"<?php echo urlWap('member_cart','cart_add')?>",
                data:{goods_id:goods_id,quantity:1},
                type:"post",
                success:function (result){
                    var rData = $.parseJSON(result);
                    if(!rData.datas.error){
                        if (confirm("添加购物车成功,现在去结算吗？"))
                        {
                            location.href="<?php echo urlWap('member_cart','cart_list')?>";
                        }
                    }else{
                        alert(rData.datas.error);
                    }
                }
            })
        })
    })
</script>
<?php 

$array['P']['title'] = $output['goods_info']['goods_name'];
$array['P']['imgUrl'] = cthumb($output['goods_info']['goods_image'],60);
$array['Y']['title'] = $output['goods_info']['goods_name'];
$array['Y']['desc'] = $output['goods_info']['goods_description'];
$array['Y']['imgUrl'] = cthumb($output['goods_info']['goods_image'],60);

echo weixinShare($array);

?>