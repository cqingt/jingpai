<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">


  <div class="fixed-bar">
    <div class="item-title">
      <h3>藏豆修改</h3>
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


  <form action="<?php echo urlAdmin('push_user_gift','do_update_cangdou');?>"  method="post" name="settingForm" id="settingForm">

    <input type="hidden" name="P_Id" value="<?php echo $output['member_info']['member_id'];?>" />

    <input type="hidden" name="form_submit" value="ok" />

    <table class="table tb-type2">
      <tbody>

    <tbody>

      <tr class="hover">
        <td class="w200">会员藏豆</td>
        <td><input id="cangdou" name="cangdou" value="<?php echo $output['member_info']['cangdou'];?>" class="txt" type="text" style="width:60px;">藏豆数</td>
      </tr>

    </tbody>

    <tfoot>
      <tr class="tfoot">
        <td colspan="2" ><input type="submit" value="提交"></td>
      </tr>
    </tfoot>

    </table>

  </form>
</div>
