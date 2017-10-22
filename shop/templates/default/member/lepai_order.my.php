<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />

<style>
  .xcConfirm {
  display: none;
  background-color: #fff;
  position: fixed;
  top: 30%;
  left: 50%;
  border: 1px #ccc solid;
  width: 520px;
  text-align: center;
  margin-left: -260px;
  padding-bottom: 20px;
}
.xcConfirm .top {
  border-bottom: 1px #eee solid;
  overflow: hidden;
  height: 40px;
}
.xcConfirm h2 {
  float: left;
  font-size: 14px;
  line-height: 40px;
  margin-left: 20px;
  color: #666;
}
.xcConfirm .close {
  float: right;  
  margin-top: 8px;
  margin-right: 16px;  
}
.xcConfirm p {
  clear: both;
  color: #666;
  font-size: 14px;
  margin: 20px 0 16px;
}
.xcConfirm input.btn {
  display:inline-block;*display:inline; *zoom:1;
  width: 84px;
  height: 28px;
  border: 1px #d2d2d2 solid;
  text-decoration: none;
  margin: 0 8px;
  font-size: 14px;
}
.xcConfirm .cancel {
  background: #f5f5f5;
  color: #666;
}
.xcConfirm .go-on {
  background: #5bb75b;
  border: 1px #5bb75b solid;
  color: #fff;
}
</style>


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
            <option value="state_new" <?php echo $_GET['state_type']=='state_new'?'selected':''; ?>>即将开始</option>
            <option value="state_on" <?php echo $_GET['state_type']=='state_on'?'selected':''; ?>>正在进行</option>
            <option value="state_end" <?php echo $_GET['state_type']=='state_end'?'selected':''; ?>>已结束的</option>
          </select></td>
          <!--
        <th>时间</th>
        <td class="w240"><input type="text" class="text w70" name="query_start_date" id="query_start_date" value="<?php echo $_GET['query_start_date']; ?>"/><label class="add-on"><i class="icon-calendar"></i></label>&nbsp;&#8211;&nbsp;<input type="text" class="text w70" name="query_end_date" id="query_end_date" value="<?php echo $_GET['query_end_date']; ?>"/><label class="add-on"><i class="icon-calendar"></i></label></td>
        -->
        <th>拍品名称</th>
        <td class="w160"><input type="text" class="text w150" name="name" value="<?php echo $_GET['name']; ?>"></td>
        <td class="w70 tc"><label class="submit-border">
            <input type="submit" class="submit" value="<?php echo $lang['nc_search'];?>"/>
          </label></td>
      </tr>
    </table>
  </form>
  <table class="ncm-default-table order">
    <thead>
      <tr>
        <th class="w10"></th>
        <th class="w100" colspan="2">拍品名称</th>
        <th class="w200">所属专场</th>
        <th class="w100">状态</th>
        <th class="w100">操作</th>
      </tr>
    </thead>
    <?php if (is_array($output['lepai_list']) && !empty($output['lepai_list'])) { ?>
        <?php foreach($output['lepai_list'] as $k=>$v){ ?>
        <tbody order_id="" class="pay">


        <!-- S 商品列表 -->
        <tr>
            <td class="bdl"></td>
            <td class="w70"><div class="ncm-goods-thumb"><a href="<?php echo urlLepai('index','auction',array('id'=>$v['G_Id']));?>" target="_blank"><img src="<?php echo BASE_SITE_URL.$v['G_MainImg'];?>" onmouseover="toolTip('<img src=<?php echo BASE_SITE_URL.$v['G_MainImg'];?>>')" onmouseout="toolTip()"></a></div></td>
            <td class="tl"><dl class="goods-name">
                    <dt><a href="<?php echo urlLepai('index','auction',array('id'=>$v['G_Id']));?>" target="_blank"><?php echo $v['G_Name'];?></a></dt>
                </dl></td>
            <td><?php echo $v['T_Title'];?></td>
            <td>
                <?php
                    if($v['T_Ktime'] > TIMESTAMP){
                        echo "即将开始";
                    }elseif($v['G_Atype'] >5){
                        echo "已结束";
                    }else{
                        echo "正在进行";
                    }
                ?>
            </td>
            <td><a href="javascript:div_show();">退货</a> | <a href="<?php echo urlLepai('index','auction',array('id'=>$v['G_Id']));?>" target="_blank">拍品详情</a></td>
            

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
    <?php if (is_array($output['lepai_list']) && !empty($output['lepai_list'])) { ?>
    <tfoot>
      <tr>
        <td colspan="19"><div class="pagination"> <?php echo $output['show_page']; ?> </div></td>
      </tr>
    </tfoot>
    <?php } ?>
  </table>
</div>

<div class="xcConfirm">
    <div class="top">
      <h2>提示信息</h2>
      <a class="close" href="javascript:;">X</a>     
    </div>             
    <p>如有任何问题，请联系拍卖客服</p>
    <input class="btn cancel" type="button"  onclick="NTKF.im_openInPageChat('sc_1000_1461061274365')" value="联系客服">
    <!-- <input class="btn go-on" type="submit" value="继续申请"> -->
</div>


<script charset="utf-8" type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js" ></script>
<script charset="utf-8" type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/sns.js" ></script>
<script type="text/javascript">
$(function(){
    $('#query_start_date').datepicker({dateFormat: 'yy-mm-dd'});
    $('#query_end_date').datepicker({dateFormat: 'yy-mm-dd'});


          
  $(".close,.cancel").click(function(){
    $(".xcConfirm").hide();
  });


});

function div_show(){
  $(".xcConfirm").show();
}

</script>