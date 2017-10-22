<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_point.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_login.css" rel="stylesheet" type="text/css">
<div class="ncp-container">
  <div class="ncp-base-layout">
    <div class="ncp-member-left">
      <?php if($_SESSION['is_login'] == '1'){?>
      <?php include_once BASE_TPL_PATH.'/home/pointshop.minfo.php'; ?>
      <?php } else { ?>
      <!-- GJ -->
      <div class="ncp-not-login">
           <div class="member">
                <div class="login-imm">
                     <a href="javascript:login_dialog();">立即登录</a>
                     <p>获知会员信息详情</p>
                </div>
                <div class="sign-in">
                    <!--  <a class="sign" href="#" target="_blank">每日签到<br>领收藏币</a> -->
                </div>
           </div>
        <div class="function" style="border: none;">
        <i class="favorable"></i>
          <dl>
            <dt><a href="<?php echo urlShop('pointvoucher', 'index');?>">店铺优惠券</a></dt>
            <dd>换取店铺优惠卷购买商品更划算</dd>
          </dl>
        </div>
        <div class="function">
        <i class="conversion"></i>
          <dl>
            <dt><a href="<?php echo urlShop('pointprod', 'plist');?>">礼品兑换</a></dt>
            <dd>可使用积分兑换商城超值礼品</dd>
          </dl>
        </div>
        <div class="function">
        <i class="funvip"></i>
          <dl>
<!--        <dt>会员特价</dt>
            <dd>可使用积分兑换商城超值礼品</dd> -->
            <dt><a href="<?php echo urlShop('show_miaosha', 'index');?>">秒杀</a></dt>
            <dd>限时破底价，会员尊享！</dd>
          </dl>
        </div>
        <div class="function">
        <i class="scrmb"></i>
          <dl>
<!--             <dt>收藏币抽奖</dt>
            <dd>可使用积分兑换商城超值礼品</dd> -->
            <dt><a href="http://www.96567.com/lepai/">拍卖惠</a></dt>
            <dd>收藏品0元起拍，正品底价！</dd>
          </dl>
        </div>
      </div>
      <?php }?>
    </div>
    <div class="ncp-banner-right"><?php echo loadadv(35,'html');?></div>
  </div>
  <?php if (C('voucher_allow')==1){?>
  <div class="ncp-main-layout">
    <div class="title">
      <h3><i class="voucher"></i>热门优惠券</h3>
      <span class="more"><a href="<?php echo urlShop('pointvoucher', 'index');?>"><?php echo $lang['home_voucher_moretitle'];?></a></span> </div>
    <?php if (!empty($output['recommend_voucher'])){?>
    <ul class="ncp-voucher-list">
      <?php foreach ($output['recommend_voucher'] as $k=>$v){?>
      <li>
        <div class="ncp-voucher">
          <div class="cut"></div>
          <div class="info"><a href="<?php echo urlShop('show_store', 'index', array('store_id'=>$v['voucher_t_store_id']));?>" class="store"><?php echo $v['voucher_t_storename'];?></a>
            <p class="store-classify"><?php echo $v['voucher_t_sc_name'];?></p>


<?php if($v['voucher_t_cate_rule'] == '3'){?>
              <span><a href="<?php echo urlShop('goods', 'index', array('goods_id'=>$v['voucher_t_diff_goods']));?>"><img style="width:125px;" src="<?php echo $v['voucher_t_customimg'];?>" onerror="this.src='<?php echo UPLOAD_SITE_URL.DS.defaultGoodsImage(240);?>'"/></a></span>

            <?php }else{?>
            <div class="pic"><img src="<?php echo $v['voucher_t_customimg'];?>" onerror="this.src='<?php echo UPLOAD_SITE_URL.DS.defaultGoodsImage(240);?>'"/></div>

            <?php }?>

            <!-- <div class="pic"><img src="<?php echo $v['voucher_t_customimg'];?>" onerror="this.src='<?php echo UPLOAD_SITE_URL.DS.defaultGoodsImage(240);?>'"/></div> -->


          </div>
          <dl class="value">
            <dt><?php echo $lang['currency'];?><em><?php echo $v['voucher_t_price'];?></em></dt>
            <dd>购物满<?php echo $v['voucher_t_limit'];?>元可用</dd>
            <dd class="time" style="height:20px;overflow:hidden;"><?php echo $v['voucher_t_title'];?></dd>
          </dl>
          <div class="point">
            <p class="required">需<em><?php echo $v['voucher_t_points'];?></em>积分</p>
            <p>有效期至<?php echo @date('Y-m-d',$v['voucher_t_end_date']);?></p>
          </div>
          <div class="button"><a target="_blank" href="javascript:void(0);" nc_type="exchangebtn" data-param='{"vid":"<?php echo $v['voucher_t_id'];?>"}' class="ncp-btn ncp-btn-red">立即兑换</a></div>
        </div>
      </li>
      <?php }?>
    </ul>
    <?php }else{?>
    <div class="norecord"><?php echo $lang['home_voucher_list_null'];?></div>
    <?php }?>
  </div>
  <?php }?>
  <?php if (C('pointprod_isuse')==1){?>
  <div class="ncp-main-layout mb30">
    <div class="title">
      <h3><i class="exchange"></i>热门礼品</h3>
      <span class="more"><a href="<?php echo urlShop('pointprod', 'plist');?>"><?php echo $lang['pointprod_list_more'];?></a></span> </div>
    <?php if (is_array($output['recommend_pointsprod']) && count($output['recommend_pointsprod'])>0){?>
    <ul class="ncp-exchange-list">
      <?php foreach ($output['recommend_pointsprod'] as $k=>$v){?>
      <li>
        <div class="gift-pic"><a target="_blank" href="<?php echo urlShop('pointprod', 'pinfo', array('id' => $v['pgoods_id']));?>"> <img src="<?php echo $v['pgoods_image'] ?>" alt="<?php echo $v['pgoods_name']; ?>" /> </a></div>
        <div class="gift-name"><a href="<?php echo urlShop('pointprod', 'pinfo', array('id' => $v['pgoods_id']));?>" target="_blank" tile="<?php echo $v['pgoods_name']; ?>"><?php echo $v['pgoods_name']; ?></a></div>
        <div class="exchange-rule">
          <?php if (intval($v['pgoods_limitmgrade']) > 0){ ?>
          <span class="pgoods-grade"><?php echo $v['pgoods_limitgradename']; ?></span>
          <?php } ?>
          <span class="pgoods-price"><?php echo $lang['pointprod_goodsprice'].$lang['nc_colon']; ?><em><?php echo $lang['currency'].$v['pgoods_price']; ?></em></span> <span class="pgoods-points"><?php echo $lang['pointprod_pointsname'].$lang['nc_colon'];?><strong><?php echo $v['pgoods_points']; ?></strong><?php echo $lang['points_unit']; ?></span> </div>
      </li>
      <?php } ?>
    </ul>
    <?php }else{?>
    <div class="norecord"><?php echo $lang['pointprod_list_null'];?></div>
    <?php }?>
  </div>
  <?php }?>
  <?php if (C('pointprod_isuse')==1){?>
<!--   <div class="ncp-main-layout mb30">
    <div class="title">
      <h3><i class="exchange"></i>会员特价</h3>
      <span class="more"><a href="<?php echo urlShop('pointprod', 'plist');?>"><?php echo $lang['pointprod_list_more'];?></a></span> </div>
    <?php if (is_array($output['recommend_pointsprod']) && count($output['recommend_pointsprod'])>0){?>
    <ul class="ncp-exchange-list">
      <?php foreach ($output['recommend_pointsprod'] as $k=>$v){?>
      <li>
        <div class="gift-pic"><a target="_blank" href="<?php echo urlShop('pointprod', 'pinfo', array('id' => $v['pgoods_id']));?>"> <img src="<?php echo $v['pgoods_image'] ?>" alt="<?php echo $v['pgoods_name']; ?>" /> </a></div>
        <div class="gift-name"><a href="<?php echo urlShop('pointprod', 'pinfo', array('id' => $v['pgoods_id']));?>" target="_blank" tile="<?php echo $v['pgoods_name']; ?>"><?php echo $v['pgoods_name']; ?></a></div>
        <div class="exchange-rule">
          <?php if (intval($v['pgoods_limitmgrade']) > 0){ ?>
          <span class="pgoods-grade"><?php echo $v['pgoods_limitgradename']; ?></span>
          <?php } ?>
          <span class="pgoods-price"><?php echo $lang['pointprod_goodsprice'].$lang['nc_colon']; ?><em><?php echo $lang['currency'].$v['pgoods_price']; ?></em></span> <span class="pgoods-points"><?php echo $lang['pointprod_pointsname'].$lang['nc_colon'];?><strong><?php echo $v['pgoods_points']; ?></strong><?php echo $lang['points_unit']; ?></span> </div>
      </li>
      <?php } ?>
    </ul>
    <?php }else{?>
    <!-- <div class="norecord"><?php echo $lang['pointprod_list_null'];?></div> -->
    <div class="norecord">暂无商品</div>
    <?php }?>
  </div> -->
  <?php }?>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/home.js" id="dialog_js" charset="utf-8"></script>
