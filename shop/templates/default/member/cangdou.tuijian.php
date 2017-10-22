<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script>
<div class="wrap">
  <div class="tabmenu">
    <?php include template('layout/submenu');?>
  </div>
  <div class="alert alert-block">
      <h4>优惠购买规则</h4>
		<ul>
            <li>1.好友通过分享邀请可直接以最低折扣价购买该商品</li>
            <li>2.通过商品分享按钮将商品分享给好友，好友下单购买后，即可以最低折扣价购买该商品</li>
            <!-- <li>3.购买不限量</li> -->
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
        .bean-list ul li  {
            border: 1px #e6e6e6 solid;
            display: block;
            width: 306px;
            height: 340px;
            overflow: hidden;
        }
        .bean-list ul li  .beanimg {
            position: relative;
            width: 240px;
            height: 240px;
            margin: 0 auto;
            overflow: hidden;
        }
        .bean-list ul li  .beanimg .over {
            position: absolute;
            bottom: 10px;
            right: 10px;
        }
        .bean-list ul li .beanimg img {
            width: 100%;
        }
        .bean-list ul li  .beaniword {
            width: 234px;
            float: left;
            padding: 0 10px;
        }
        .bean-list ul li  .beaniword h2 {
            font-size: 14px;
            line-height: 16px;
            height: 32px;
            width: 292px;
            margin-top: 10px;
            overflow: hidden;
            color: #555;
        }
        .bean-list ul li  .beaniword .p1 {
            font: 14px/16px 'Microsoft YaHei';
            color: #999;
            margin-top: 8px;
        }
        .bean-list ul li  .beaniword .p1 em {
            text-decoration:line-through;
        }
        .bean-list ul li  .beaniword .finish {
            font-size: 16px;
            color: #ec4f4a;
            margin-top: 2px;
            font-family: 'Microsoft YaHei';
        }
        .bean-list ul li  .beaniword .finish em {
            font: 12px/20px 'Microsoft YaHei';
            color: #999;
            display: block;
            float: left;
            margin-right: 8px;
        }
        .bean-list ul li  .beaniword .finish em i {
            margin: 0 6px;
        }
        .bean-list ul li  .beaniword .finish strong {
            color: #000;
        }
        .bean-list ul li  .numberbox {
            float: right;
            width: 42px;
            height: 44px;
            margin: 45px 10px 0 0;
            color: #fff;
            background: #ef4d4a;
            text-align: center;
			cursor:pointer;
        }
        .bean-list ul li  .numberbox h4 {
            font-size: 20px;
            font-size: 14px;
            padding-top: 2px;
            border-top: 2px #dd2429 solid;
        }
        .bean-list ul li  .numberbox p {
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
        .bean-title h2  {
            font-size: 14px;
            color: #3672ae;
            text-decoration: underline;
            margin-left: 4px;
        }

        .form-edit {
            margin: 10px 0 0 46px;
        }
        .form-edit .form-control {
            width: 272px;
        }
    </style>
    <div class="bean-list wrapper">
        <?php if(!empty($output['result_list'])){ ?>
        <ul>
            <?php foreach($output['result_list'] as $k=>$v){?>
            <li<?php echo (($k % 3) > 0)?'':' class="last"'?>>
				<?php if(intval($v['number']-$v['buy_quantity']) <= 0) {
				?>
				<div class="icon-sold"></div>
				<?php
				}
				?>
                
                    <div class="beanimg">
                       <a href="http://www.96567.com/index.php?act=goods&goods_id=<?php echo $v['goods_id'];?>&tjgoods=1" target="_blank"> <img src="<?php echo cthumb($v['goods_image'],'240');?>" alt="<?php echo $v['goods_name'];?>"></a>     
                        <p class="over"><i class="icon-make"></i></p>
                    </div>
                    <div class="beaniword" style="width:150px;">
                        <h2><?php echo $v['goods_name'];?></h2>
                        <p class="p1">售价：<em>￥<?php echo $v['goods_price'];?></em></p>
                        <p class="finish">折后价：<?php echo $v['price'];?></p>
                    </div>
        <?php if(Model('pushuser_gift')->getYouHuiByGoodsID($v['goods_id'])){?>
		 <div class="numberbox duihuan" nc_type='exchangebtn' goods_id="<?php echo $v['goods_id'];?>">
                        <h4>立即</h4>
                        <p>购买</p>
                    </div>
		<?php }else{?>
		<div class="numberbox duihuan" nc_type='W_exchangebtn' style="background: #bfbfbf;">
                        <h4  style="border-top: 2px #bfbfbf solid;">立即</h4>
                        <p>购买</p>
                    </div>
		<?php } ?>
		
               <?php if(intval($v['number']-$v['buy_quantity']) <= 0) {
				?>
				<div class="numberbox duihuan" style="background: #bfbfbf;" nc_type='no_fenxiang'>
                        <h4 style="border-top: 2px #bfbfbf solid;">立即</h4>
                        <p>分享</p>
                    </div>
				<?php
				}else{
				?>
				<div class="numberbox duihuan" style="background:#6A1;" nc_type='fenxiang' goods_id="<?php echo $v['goods_id'];?>">
                        <h4 style="border-top: 2px #6A1; solid;">立即</h4>
                        <p>分享</p>
                    </div>
				<?php } ?>
            
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
        var copy_text = '精美产品，最低五折，享不完的折扣，快来参与吧！'+$("#copy_lnk").val();
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
            var goods_id = $(this).attr('goods_id');
            window.location.href='http://www.96567.com/index.php?act=goods&goods_id='+goods_id+'&tjgoods=1';
            return false;
        });

		$("[nc_type='W_exchangebtn']").live('click',function(){
            return false;
        });

        $("[nc_type='fenxiang']").live('click',function(){
            var goods_id = $(this).attr('goods_id');
            ajax_form('arrival_notice', '立即分享', 'http://www.96567.com/index.php?act=goods&op=share_notice&goods_id='+goods_id, 650);

            return false;
        });
		$("[nc_type='no_fenxiang']").live('click',function(){
			return false;
		});

		
    });
</script>
