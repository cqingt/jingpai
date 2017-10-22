<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/demo.css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/has.css" />
<ul class="voucher-tab">
  <li style="width: 25%;"><a <?php if($_GET['op'] == 'index'){echo 'class="current"';}?> href="<?php echo urlWap('cangdou','index');?>">邀请好友</a> </li>
  <li style="width: 25%;"><a <?php if($_GET['op'] == 'cangdou_log'){echo 'class="current"';}?> href="<?php echo urlWap('cangdou','cangdou_log');?>">藏豆明细</a> </li>
  <li style="width: 25%;"><a <?php if($_GET['op'] == 'cangdou_exchange'){echo 'class="current"';}?> href="<?php echo urlWap('cangdou','cangdou_exchange');?>">藏豆兑换</a> </li>
  <li style="width: 25%;"><a <?php if($_GET['op'] == 'cangdou_tuijian'){echo 'class="current"';}?> href="<?php echo urlWap('cangdou','cangdou_tuijian');?>">优惠购买</a> </li>
</ul>
<section>
            <div class="rule">
			  <h1><p style="font-size: 23px;">当前可用藏豆：<?php echo $output['member_info']['cangdou']; ?></p></h1>
              <h1>藏豆兑换规则</h1>
              <p>1、积分商城产品按售价折藏豆，1元=1藏豆；</p>
              <p>2、每款商品每人仅限兑换3件。<strong>(包邮)</strong></p>
              <a href="<?php echo urlWap('cangdou','cangdou_log');?>">藏豆明细<i class="fa fa-angle-right fa-lg"></i></a>
            </div>

            <div class="cash-list">
			<?php if(!empty($output['result_list'])){ ?>
             <ul>
			 <?php foreach($output['result_list'] as $k=>$v){?>
			
             	<li>
				
             	  <div class="cashimg">
				   <?php if(intval($v['kucun']-$v['goods_duihuan_sum']) <= 0) {
				?>
				<div class="icon-sold"></div>
				<?php
				}
				?>
             	  	<img src="<?php echo cthumb($v['goods_image'],'240');?>" alt="<?php echo $v['goods_name'];?>">
             	  </div>
             	  <div class="cashword">
             	  	<h2><?php echo $v['goods_name'];?></h2>
             	  	<p class="p1">售价：<em> ¥<?php echo $v['goods_price'];?></em></p>
             	  	<p class="p2">藏豆：<em><?php echo $v['use_cangdou'];?></em></p>
					<?php if($output['member_info']['cangdou'] < $v['use_cangdou'] || intval($v['kucun']-$v['goods_duihuan_sum']) <= 0){ ?>
					<a href="javascript:(0);" class="btn-cash" style="background: #bfbfbf;">立即兑换</a>
					<?php }else{ ?>
             	  	<a href="index.php?act=cangdou&op=giftexchange&dialog=1&gift_id=<?php echo $v['id'];?>" class="btn-cash">立即兑换</a>
					<?php } ?>
             	  </div>
             	</li>
				<?php }?>
             </ul>
			 <?php }?>
			 <!--
             <a class="functional-box" href=""><i class="fa fa-spinner fa-spin"></i>正在载入</a>
			 -->
            </div>
		  </section>
