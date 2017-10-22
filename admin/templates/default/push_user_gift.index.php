<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">


  <div class="fixed-bar">
    <div class="item-title">
      <h3>推荐有礼</h3>
        <ul class="tab-base">
            <?php   foreach($output['menu'] as $menu) {  if($menu['menu_type'] == 'text') { ?>
                <li><a href="JavaScript:void(0);" class="current"><span><?php echo $menu['menu_name'];?></span></a></li>
            <?php }  else { ?>
                <li><a href="<?php echo $menu['menu_url'];?>" ><span><?php echo $menu['menu_name'];?></span></a></li>
            <?php  } }  ?>
        </ul>
    </div>
  </div>


  <div class="fixed-empty"></div>


  <form action="<?php echo urlAdmin('push_user_gift','doSet');?>"  method="post" name="settingForm" id="settingForm">

<?php if(!empty($output['setArr'])){?>

    <input type="hidden" name="P_Id" value="<?php echo $output['setArr']['P_Id'];?>" />

    <input type="hidden" name="form_submit" value="ok" />

<?php }?>

    <table class="table tb-type2">
      <tbody>

    <tbody>

      <!-- <tr class="hover">
        <td class="w200">注册送豆：</td>
        <td><input id="P_ZhuCe" name="P_ZhuCe" value="<?php echo $output['setArr']['P_ZhuCe'];?>" class="txt" type="text" style="width:60px;">积分数</td>
      </tr> -->

      <tr class="hover">
        <td class="w200">一级分销：</td>
        <td><input id="cangdou_one" name="cangdou_one" value="<?php echo $output['setArr']['cangdou_one'];?>" class="txt" type="text" style="width:60px;">藏豆数</td>
      </tr>

      <tr class="hover">
        <td class="w200">二级分销：</td>
        <td><input id="cangdou_two" name="cangdou_two" value="<?php echo $output['setArr']['cangdou_two'];?>" class="txt" type="text" style="width:60px;">藏豆数</td>
      </tr>

      <tr class="hover">
        <td class="w200">订单完成后返利一级：</td>
        <td><input id="cangdou_order_one" name="cangdou_order_one" value="<?php echo $output['setArr']['cangdou_order_one'];?>" class="txt" type="text" style="width:60px;">千分比 被邀请会员购买商品时给邀请人返的藏豆数(例如设为5%，被邀请人购买1000元商品，返给邀请人5藏豆)</td>
      </tr>

      <tr class="hover">
        <td class="w200">订单完成后返利二级：</td>
        <td><input id="cangdou_order_two" name="cangdou_order_two" value="<?php echo $output['setArr']['cangdou_order_two'];?>" class="txt" type="text" style="width:60px;">千分比 被邀请会员购买商品时给邀请人返的藏豆数(例如设为5%，被邀请人购买1000元商品，返给邀请人5藏豆)</td>
      </tr>

    </tbody>

    <tfoot>
      <tr class="tfoot">
        <td colspan="2" ><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo $lang['nc_submit'];?></span></a></td>
      </tr>
    </tfoot>

    </table>

  </form>
</div>
<script>
!function($){


  $("#submitBtn").click(function(){

    if(testVal()){
      $("#settingForm").submit();
    }

  });

  function testVal(){
    // var z = $("#P_ZhuCe").val();
    // if(!z){
    //   alert('注册送豆不能为空');
    //   return false;
    // }

    var o = $("#cangdou_one").val();
    if(!o){
      alert('一级分销不能为空');
      return false;
    }

    var t = $("#cangdou_two").val();
    if(!t){
      alert('二级分销不能为空');
      return false;
    }

    var or = $("#cangdou_order_one").val();
    if(!or){
      alert('一级订单返利不能为空');
      return false;
    }

    var ort = $("#cangdou_order_two").val();
    if(!ort){
      alert('二级订单返利不能为空');
      return false;
    }

    return true;
  }


}(jQuery)
</script>
