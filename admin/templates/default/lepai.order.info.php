<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">
  <table class="table tb-type2 order">
    <tbody>
      <tr class="space">
        <th colspan="2">乐拍订单详情</th>
      </tr>
      <tr>
        <th><?php echo $lang['order_info'];?></th>
      </tr>
      <tr>
        <td colspan="2"><ul>
            <li>
            <strong><?php echo $lang['order_number'];?>:</strong><?php echo $output['result']['order_sn'];?>
            ( 支付单号 <?php echo $lang['nc_colon'];?> <?php echo $output['result']['pay_sn'];?> )
            </li>
            <li><strong><?php echo $lang['order_state'];?>:</strong><?php echo orderState($output['result']);?></li>
            <li><strong><?php echo $lang['order_total_price'];?>:</strong><span class="red_common"><?php echo $lang['currency'].$output['result']['order_amount'];?> </span>
             <!--//zmr>v80-->
             <?php if($output['result']['rcb_amount']>0){ ?>
             <li><strong  style="color:blue">充值卡已支付:</strong><span class="red_common"><?php echo $lang['currency'].$output['result']['rcb_amount'];?> </span>
              <?php } ?>
               <?php if($output['result']['pd_amount']>0){ ?>
             
             
              <li><strong style="color:blue">预存款已支付:</strong><span class="red_common"><?php echo $lang['currency'].$output['result']['pd_amount'];?> </span> 
			  <?php if($output['result']['Bao_type'] == 1){echo '（保证金抵扣￥'.$output['result']['Bao_amount'].'元）';}?>
			  <?php } ?>
              
              
            	<?php if($output['result']['refund_amount'] > 0) { ?>
            	(<?php echo $lang['order_refund'];?>:<?php echo $lang['currency'].$output['result']['refund_amount'];?>)
            	<?php } ?></li>
            <li><strong><?php echo $lang['order_total_transport'];?>:</strong><?php echo $lang['currency'].$output['result']['shipping_fee'];?></li>
<!--
			 <li><strong>保证金:</strong><?php echo $output['result']['Bao_amount'];?></li>
			 <li><strong>保证金类型:</strong><?php if($output['result']['Bao_type'] == 1){echo '现金';}else{echo '收藏币';}?></li>
			-->
          </ul></td>
      </tr>
      <tr>
        <td><ul>
            <li><strong><?php echo $lang['buyer_name'];?><?php echo $lang['nc_colon'];?></strong><?php echo $output['result']['buyer_name'];?></li>
            <li><strong><?php echo $lang['store_name'];?><?php echo $lang['nc_colon'];?></strong><?php echo $output['result']['company_name'];?></li>
            <li><strong><?php echo $lang['payment'];?><?php echo $lang['nc_colon'];?></strong><?php echo orderPaymentName($output['result']['payment_code']);?></li>
            <?php if(intval($output['result']['trade_no'])){?>
                <li><strong>第三方流水号：</strong><?php echo $output['result']['trade_no'];?></li>
            <?php }?>
            <li><strong><?php echo $lang['order_time'];?><?php echo $lang['nc_colon'];?></strong><?php echo date('Y-m-d H:i:s',$output['result']['add_time']);?></li>
            <?php if(intval($output['result']['payment_time'])){?>
            <li><strong><?php echo $lang['payment_time'];?><?php echo $lang['nc_colon'];?></strong><?php echo date('Y-m-d H:i:s',$output['result']['payment_time']);?></li>
            <?php }?>
            <?php if(intval($output['result']['shipping_time'])){?>
            <li><strong><?php echo $lang['ship_time'];?><?php echo $lang['nc_colon'];?></strong><?php echo date('Y-m-d H:i:s',$output['result']['shipping_time']);?></li>
            <?php }?>
            <?php if(intval($output['result']['finnshed_time'])){?>
            <li><strong><?php echo $lang['complate_time'];?><?php echo $lang['nc_colon'];?></strong><?php echo date('Y-m-d H:i:s',$output['result']['finnshed_time']);?></li>
            <?php }?>
            <?php if($output['result']['extend_order_common']['order_message'] != ''){?>
            <li><strong><?php echo $lang['buyer_message'];?><?php echo $lang['nc_colon'];?></strong><?php echo $output['result']['extend_order_common']['order_message'];?></li>
            <?php }?>
          </ul></td>
      </tr>
      <tr>
        <th>收货人信息</th>
      </tr>
      <tr>
        <td><ul>
            <li><strong><?php echo $lang['consignee_name'];?><?php echo $lang['nc_colon'];?></strong><?php echo $output['area_info']['true_name'];?></li>
            <li><strong><?php echo $lang['tel_phone'];?><?php echo $lang['nc_colon'];?></strong><?php echo JieMiMobile($output['area_info']['mob_phone']);?></li>
            <li><strong><?php echo $lang['address'];?><?php echo $lang['nc_colon'];?></strong><?php echo $output['area_info']['area_info'].' '.$output['area_info']['address'];?></li>
            <?php if($output['result']['shipping_code'] != ''){?>
            <li><strong><?php echo $lang['ship_code'];?><?php echo $lang['nc_colon'];?></strong><?php echo $output['result']['shipping_code'];?></li>
            <?php }?>
            <li><strong><?php echo '快递公司';?><?php echo $lang['nc_colon'];?></strong><?php echo $output['kuaidi']['e_name'];?></li>
          </ul></td>
          </tr>


      <tr>
        <th><?php echo $lang['product_info'];?></th>
      </tr>
      <tr>
        <td><table class="table tb-type2 goods ">
            <tbody>
              <tr>
                <th></th>
                <th><?php echo $lang['product_info'];?></th>
                <th class="align-center">成交价</th>
                <th class="align-center">实际支付金额</th>
                <th class="align-center"><?php echo $lang['product_num'];?></th>
                <th class="align-center">佣金比例</th>
                <th class="align-center">收取佣金</th>
              </tr>
              <tr>
                <td class="w60 picture"><div class="size-56x56"><span class="thumb size-56x56"><i></i><a href="http://pm.96567.com/index.php?act=index&op=auction&id=<?php echo $output['result']['G_Id'];?>" target="_blank"><img alt="<?php echo $lang['product_pic'];?>" src="http://www.96567.com/<?php echo $output['result']['G_MainImg'];?>" style="width: 60px;height: 60px;"/> </a></span></div></td>
                <td class="w50pre"><p><a href="http://pm.96567.com/index.php?act=index&op=auction&id=<?php echo $output['result']['G_Id'];?>" target="_blank"><?php echo $output['result']['G_Name'];?></a></p></td>
                <td class="w96 align-center"><span class="red_common"><?php echo $lang['currency'].$output['result']['goods_amount'];?></span></td>
                <td class="w96 align-center"><span class="red_common"><?php echo $lang['currency'].$output['result']['order_amount'];?></span></td>
                <td class="w96 align-center">1</td>
                <td class="w96 align-center"><?php echo intval($output['result']['commis_rate']) == 200 ? '0' : intval($output['result']['commis_rate']).'%';?></td>
                <td class="w96 align-center"><?php echo intval($output['result']['commis_rate']) == 200 ? '0' : ncPriceFormat($output['result']['goods_amount']*$output['result']['commis_rate']/100);?></td>
              </tr>
            </tbody>
          </table></td>
      </tr>
    <!-- S 促销信息 
      <?php if(!empty($output['result']['extend_order_common']['promotion_info']) && !empty($output['result']['extend_order_common']['voucher_code'])){ ?>
      <tr>
      	<th>其它信息</th>
      </tr>
      <tr>
          <td>
        <?php if(!empty($output['result']['extend_order_common']['promotion_info'])){ ?>
        <?php echo $output['result']['extend_order_common']['promotion_info'];?>，
        <?php } ?>
        <?php if(!empty($output['result']['extend_order_common']['voucher_code'])){ ?>
        使用了面额为 <?php echo $lang['nc_colon'];?> <?php echo $output['result']['extend_order_common']['voucher_price'];?> 元的代金券，
         编码 : <?php echo $output['result']['extend_order_common']['voucher_code'];?>
        <?php } ?>
          </td>
      </tr>
      <?php } ?>
	  -->
    <!-- E 促销信息 -->

    </tbody>
    <tfoot>
      <tr class="tfoot">
        <td><a href="JavaScript:void(0);" class="btn" onclick="history.go(-1)"><span><?php echo $lang['nc_back'];?></span></a></td>
      </tr>

    </tfoot>
  </table>
  <?php if($output['result']['shipping_code'] == '' && $output['area_info']['true_name']){?>
  <form action="index.php?act=lepai&op=orderPush" method="POST">
  <input type="hidden" name="order_id" id="order_id" value="<?php echo $output['result']['order_id'];?>">
  <table class="table tb-type2">
      <tbody>
	  <tr class="noborder" style="background: rgb(255, 255, 255);">
          <td colspan="2" class="required"><label for="site_name">快递公司 ：</label></td>
        </tr>
       <tr class="noborder" style="background: rgb(251, 251, 251);">
          <td class="vatop rowform">
             <select required="required" name="kuaidi" id="" class="querySelect">
                                     <option value="">请选择</option>
                                     <?php foreach($output['express'] as $k => $v){?>
                                      <option value="<?php echo $v['id'];?>"><?php echo $v['e_name'];?></option> 
                  <?php }?>
            </select>
          </td>
          <td class="vatop tips"></td>
        </tr>
	  <tr class="noborder" style="background: rgb(255, 255, 255);">
          <td colspan="2" class="required"><label for="site_name">快递单号 ：</label></td>
        </tr>
		<tr class="noborder" style="background: rgb(251, 251, 251);">
          <td class="vatop rowform">
		  <input required="required" id="text" name="order_sn" type="text" value="" placeholder="请输入快递单号" class="basic-input" tabindex="2" maxlength="20" class="txt2">
		  </td>
        </tr>
      </tbody>
      <tfoot id="submit-holder">
        <tr class="tfoot">
          <td colspan="2"><input type="submit" name="login" value="确认发货" class="btn-ok"></td>
        </tr>
      </tfoot>
 </table>
 <script src="<?php echo LEPAI_JS_URL;?>/js/lepai_admin/attribute.js"></script>
 </form>
 <?php }?>
</div>
