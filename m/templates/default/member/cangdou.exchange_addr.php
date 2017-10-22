<?php defined('InShopNC') or exit('Access Invalid!');?>
<div class="form-group">
	<label for="">收货人姓名：</label>
	<input type="text" value="" name="true_name" id="true_name">
</div>
<div class="form-group number">
	<label for="">手机号：</label>
	<input type="tel" value="" name="mob_phone" id="mob_phone">
</div>

<div class="form-group sole">
  <label for="">省份：</label>
   <input type="hidden" value="" name="city_id" id="city_id">
   <input type="hidden" name="area_id" id="area_id" class="area_ids"/>
  <input type="hidden" name="area_info" id="area_info" class="area_names"/>
	<select class="valid" name="prov" id="vprov">
		<option value="">-请选择-</option>
	</select>
	
  <i class="fa fa-angle-down fa-lg"></i>
</div>

<div class="form-group sole">
	<label for="">城市：</label>
	<select class="valid" name="city" id="vcity">
		<option value="">-请选择-</option>
	</select>
	<i class="fa fa-angle-down fa-lg"></i>
</div>

<div class="form-group sole">
	<label for="">区县：</label>
	<select class="valid" name="region" id="vregion">
		<option value="">-请选择-</option>
	</select>
	<i class="fa fa-angle-down fa-lg"></i>
</div>

<div class="form-group">
	<textarea placeholder="请输入您的详细地址" rows="2" id="address" name="address"></textarea>
</div>
<div class="error-tips"></div>
