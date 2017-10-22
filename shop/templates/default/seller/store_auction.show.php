<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="tabmenu">
  <ul class="tab pngFix">
  <li class="active"><a>乐拍申请页面</a></li></ul>
 

</div>
<div class="ncsc-form-default">
<form id="add_form" action="<?php echo urlShop('store_auction', 'auction_quota_add_save');?>" method="post">
    <dl>
      <dt>店主用户名：</dt>
      <dd>
        <?php echo $output['store_joinin']['member_name'];?>
      </dd>
    </dl>
	<dl>
      <dt>主营类目：</dt>
      <dd>
        <?php echo $output['store_joinin']['sc_name'];?>
      </dd>
    </dl>
    <dl>
      <dt>公司名称：</dt>
      <dd>
        <?php echo $output['store_joinin']['company_name'];?>
      </dd>
    </dl>
    <dl>
      <dt>公司地址：</dt>
      <dd>
        <?php echo $output['store_joinin']['company_address'];?> 
		&nbsp;&nbsp;
		<?php echo $output['store_joinin']['company_address_detail'];?>
      </dd>
    </dl>
	<dl>
      <dt>公司电话：</dt>
      <dd>
        <?php echo $output['store_joinin']['company_phone'];?>
      </dd>
    </dl>
    <dl>
      <dt>联系人姓名：</dt>
      <dd>
        <?php echo $output['store_joinin']['contacts_name'];?>
      </dd>
    </dl>
    <dl>
      <dt>联系人电话：</dt>
      <dd>
        <?php echo $output['store_joinin']['contacts_phone'];?>
      </dd>
    </dl>
	<dl>
      <dt>联系人邮箱：</dt>
      <dd>
        <?php echo $output['store_joinin']['contacts_email'];?>
      </dd>
    </dl>
	

    <div class="bottom"><label class="submit-border">
      <input type="submit" class="submit" value="提交申请"></label>
    </div>
  </form>
</div>