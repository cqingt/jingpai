<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/index.css">


<div class="search">
    <div class="header-wrap">
        <a href="javascript:history.back();" class="header-back">
            <i class="fa fa-angle-left fa-2x"></i>
        </a>
        <div class="htsearch-wrap">
            <form action="" method="GET">
            <input type="hidden" name="act" value="goods">
            <input type="hidden" name="op" value="goods_list">
            <input type="hidden" name="key" value="<?php echo $_GET['key'];?>">
            <input type="hidden" name="store_id" value="<?php echo $_GET['store_id'];?>">
            <input type="text" class="htsearch-input clr-999 ml30" value="<?php echo $_GET['keyword'];?>" name="keyword" id="keyword" placeholder="搜索全站商品">
            <!-- <a href="javascript:void(0);" class="search-btn"></a> -->
            <input type="submit"  class="search-btn" value="" style="border:0px;">
            </form>
        </div>
    </div>
</div>
    <div class="store_header"></div>
    <div id="product_detail_wp"><div class="m_store_bg"></div>
        <div class="ncs-info">
        <div class="title">
            <h4><?php echo $output['store_detail']['store_info']['store_name'];?> <a href="javascript:(0);" <?php if($output['store_detail']['store_info']['is_own_shop'] == 1){?> 
		onclick="NTKF.im_openInPageChat('sc_1000_9999')"
	<?php
	}else{
	?>
		onclick="NTKF.im_openInPageChat('sc_<?php echo 1000+intval($output['store_detail']['store_info']['store_id']);?>_9999')"
	<?php
	}
	?>><img src="http://www.96567.com/shop/templates/default/images/se1.png" width="21" height="20px"></a></h4>
        </div>
        <div class="scontent">
            <dl class="all-rate">
              <dt>综合评分：</dt>
              <dd>
                <div class="rating"><span style="width:<?php echo $output['store_detail']['store_info']['store_credit_percent'];?>%"></span></div>
                <em>5</em>分</dd>
            </dl>
            
            <!--?php } ?-->
            <!--
            <dl class="no-border">
              <dt>公司名称：</dt>
              <dd><?php echo $output['store_detail']['store_info']['store_company_name'];?></dd>
            </dl>
            <dl>
              <dt>所 在 地：</dt>
              <dd><?php echo $output['store_detail']['store_info']['area_info'];?></dd>
            </dl>
            -->
            </div>
        </div>
    </div>


    <div class="content">
        <div class="product-filter">


            <a href="javascript:window.location.href='<?php echo urlWap('member_store','store_info',array('store_id'=>$_GET['store_id'],'key'=>4,'keyword'=>$_GET['keyword']));?>';" class="clearfix <?php if($_GET['key'] == 4 || !$_GET['key']){echo 'current';}?> keyorder" key="4">
                <span class="pf-newpd-icon f-icon fleft"></span>
                <span class="pf-title">新品</span>
            </a>
            <a href="javascript:window.location.href='<?php echo urlWap('member_store','store_info',array('store_id'=>$_GET['store_id'],'key'=>3,'keyword'=>$_GET['keyword']));?>';" class="clearfix keyorder <?php if($_GET['key'] == 3){echo 'current';}?>" key="3">
                <span class="pf-price-icon  desc f-icon fleft"></span>
                <span class="pf-title">价格</span>
            </a>
            <a href="javascript:window.location.href='<?php echo urlWap('member_store','store_info',array('store_id'=>$_GET['store_id'],'key'=>1,'keyword'=>$_GET['keyword']));?>';" class="clearfix keyorder <?php if($_GET['key'] == 1){echo 'current';}?>" key="1">
                <span class="pf-sales-icon f-icon fleft"></span>
                <span class="pf-title">销量</span>
            </a>
            <a href="javascript:window.location.href='<?php echo urlWap('member_store','store_info',array('store_id'=>$_GET['store_id'],'key'=>2,'keyword'=>$_GET['keyword']));?>';" class="clearfix keyorder <?php if($_GET['key'] == 2){echo 'current';}?>" key="2">
                <span class="pf-popularity-icon f-icon fleft"></span>
                <span class="pf-title">人气</span>
            </a>


        </div>


        <div class="product-cnt">
            <div id="product_list"> 


        <ul class="product-list">
            

<?php if($output['goods_list']){?>
    
    <?php foreach($output['goods_list'] as $k => $v){?>

            <li class="pdlist-item" goods_id="10805">
                <a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>" class="pdlist-item-wrap clearfix">
                    <span class="pdlist-iw-imgwp">
                        <img src="<?php echo $v['goods_image_url'];?>">
                    </span>
                    <div class="pdlist-iw-cnt">
                        <p class="pdlist-iwc-pdname">
                            <?php echo $v['goods_name'];?>
                        </p>
                        <p class="pdlist-iwc-pdprice">
							<?php if($v['promotion_price'] > 0){ ?>
							<?php echo '￥'.intval($v['promotion_price']);?>
							<?php }else{ ?>
                            <?php echo ($v['goods_price'] < 1)?"咨询客服":'￥'.intval($v['goods_price']); ?>
							<?php } ?>
                            <?php if($v['promotion_type']){?>
                               <span style="padding: 0 4px;margin-right: 5px;border: 1px solid #ff6b6b;margin-left: 2px;text-align: center;font-family: 'microsoft yahei';font-size: 12px;color: #fff;background: #ff6b6b; border-radius: 3px;"><?php echo $v['promotion_type'];?></span>
                            <?php }?>

                            
                        </p>


                        <p class="pdlist-iwc-pdcomment  clearfix">
                            <span class="evaluation_good_swp mr5 fleft">
                            
                            <?php for($s = 0;$s<$v['evaluation_good_star'];$s++){?>
                            <span class="evaluation_good_star fleft"></span>
                            <?php }?>
                            
                            </span>
                            <span class="fleft">
                                (<?php echo $v['evaluation_count'];?>人)
                            </span>
                        </p>


                    </div>
                </a>
            </li>

    <?php }?>

<?php }else{?>
<div class="no-record">暂无记录</div>
<?php }?>
            


            
        </ul>
    </div>



    <?php echo $output['page'];?>


    </div>
</div>

