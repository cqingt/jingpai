<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />

<div class="wrap">
  <div class="tabmenu">
    <?php include template('layout/submenu');?>
  </div>
  <form method="get" action="index.php" target="_self">
    <table class="ncm-search-table">
      <input type="hidden" name="act" value="lepai_order" />
      <input type="hidden" name= "op" value="my_paimai" />
      <tr>
        <td>&nbsp;</td>
        <th>状态</th>
        <td class="w100"><select name="state_type">
            <option value="" <?php echo $_GET['state_type']==''?'selected':''; ?>>所有状态</option>
            <option value="state_new" <?php echo $_GET['state_type']=='state_new'?'selected':''; ?>>未返还</option>
            <option value="state_on" <?php echo $_GET['state_type']=='state_on'?'selected':''; ?>>已返还</option>
          </select></td>
          <!--
        <th>时间</th>
        <td class="w240"><input type="text" class="text w70" name="query_start_date" id="query_start_date" value="<?php echo $_GET['query_start_date']; ?>"/><label class="add-on"><i class="icon-calendar"></i></label>&nbsp;&#8211;&nbsp;<input type="text" class="text w70" name="query_end_date" id="query_end_date" value="<?php echo $_GET['query_end_date']; ?>"/><label class="add-on"><i class="icon-calendar"></i></label></td>

        <th>拍品名称</th>
        <td class="w160"><input type="text" class="text w150" name="name" value="<?php echo $_GET['name']; ?>"></td>
        <td class="w70 tc"><label class="submit-border">
            <input type="submit" class="submit" value="<?php echo $lang['nc_search'];?>"/>
          </label></td>
          -->
      </tr>
    </table>
  </form>
  <table class="ncm-default-table order">
    <thead>
      <tr>
        <th class="w10"></th>
        <th class="w100" colspan="2">拍品名称</th>
        <th class="w200">保证金类型</th>
        <th class="w100">缴纳费用</th>
        <th class="w100">返还状态</th>
        <th class="w100">缴纳时间</th>
      </tr>
    </thead>
    <?php if (is_array($output['list']) && !empty($output['list'])) { ?>
        <?php foreach($output['list'] as $k=>$v){ ?>
        <tbody order_id="" class="pay">


        <!-- S 商品列表 -->
        <tr>
            <td class="bdl"></td>
            <td class="w70"><div class="ncm-goods-thumb"><a href="<?php echo urlLepai('index','auction',array('id'=>$v['G_Id']));?>" target="_blank"><img src="<?php echo BASE_SITE_URL.$v['G_MainImg'];?>" onmouseover="toolTip('<img src=<?php echo BASE_SITE_URL.$v['G_MainImg'];?>>')" onmouseout="toolTip()"></a></div></td>
            <td class="tl"><dl class="goods-name">
                    <dt><a href="<?php echo urlLepai('index','auction',array('id'=>$v['G_Id']));?>" target="_blank"><?php echo $v['G_Name'];?></a></dt>
                </dl></td>
            <td>
                <?php
                    if($v['type'] == 1){
                        echo "现金";
                    }elseif($v['type'] == 2){
                        echo "积分";
                    }else{
                        echo "免保证金";
                    }
                ?>
            </td>
            <td>
                <?php
                if($v['type'] == 1){
                    echo $v['amount']."元";
                }elseif($v['type'] == 2){
                    echo $v['amount']."积分";
                }else{
                    echo " ";
                }
                ?>
            </td>
            <td>
                <?php
                if($v['is_return'] == 0){
                    echo "未返还";
                }elseif($v['is_return'] == 1){
                    echo "已返还";
                }else{
                    echo "订单抵扣";
                }
                ?>
            </td>
            <td><?php echo date('Y-m-d H:i',$v['bind_time']);?></td>


        </tr>

        </tbody>
        <?php } ?>
        <?php } else { ?>
    <tbody>
      <tr>
        <td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record'];?></span></div></td>
      </tr>
    </tbody>
    <?php } ?>
    <?php if (is_array($output['list']) && !empty($output['list'])) { ?>
    <tfoot>
      <tr>
        <td colspan="19"><div class="pagination"> <?php echo $output['show_page']; ?> </div></td>
      </tr>
    </tfoot>
    <?php } ?>
  </table>
</div>
<script charset="utf-8" type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js" ></script>
<script charset="utf-8" type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/sns.js" ></script>
<script type="text/javascript">
$(function(){
    $('#query_start_date').datepicker({dateFormat: 'yy-mm-dd'});
    $('#query_end_date').datepicker({dateFormat: 'yy-mm-dd'});
});
</script>
