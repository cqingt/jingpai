<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">


<div class="favorites-list" id="favorites_list">

<?php if($output['favorites_list']){?>
    <ul>
    <?php foreach($output['favorites_list'] as $k => $v){?>
    <li>
        <a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>" class="mf-item clearfix">
            <span class="mf-pic">
                <img src="<?php echo $v['goods_image_url'];?>">
            </span>
            <div class="mf-infor">
                <p class="mf-pd-name"><?php echo $v['goods_name'];?></p>
                <p class="mf-pd-price"><?php if($v['promotion_price'] > 0){ ?>￥<?php echo intval($v['promotion_price']); ?><?php }else{ ?><?php echo ($v['goods_price'] < 1)?"咨询客服":'￥'.intval($v['goods_price']); ?><?php } ?></p>
                <p class="mf-pd-comment">&nbsp;</p>
                <spaan class="i-del" goods_id="<?php echo $v['goods_id'];?>"></span>
            </div>
        </a>
    </li>
    <?php }?>

<?php echo $output['page'];?>

    </ul>
<?php }else{?>
<div class="no-record">暂无记录</div>
<?php }?>


</div>


<script>
    $(function(){
        $(".i-del").click(function(){
            $(".clearfix").attr('href','###');
            var goods_id = $(this).attr('goods_id');
            var url = "<?php echo urlWap('member_favorites','favorites_del',array('fav_id'=>''));?>";
            if(goods_id){
                window.location.href=url+goods_id;
            }
        })
    })
</script>