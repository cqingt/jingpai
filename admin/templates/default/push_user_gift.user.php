<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="page">


  <div class="fixed-bar">
    <div class="item-title">
      <h3>藏豆变更记录</h3>
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
    <form  id="form1" method="get" name="formSearch" id="formSearch">
        <input type="hidden" name="act" value="push_user_gift">
        <input type="hidden" name="op" value="user_cangdou">
        <table class="tb-type1 noborder search">
            <tbody>

            <tr>
                <td><input type="text" value="" name="search" id="search" class="txt" placeholder='用户名称'></td>

                <td ><a href="javascript:document.formSearch.submit();" id="ncsubmit" class="btn-search " title="<?php echo $lang['nc_query'];?>"></a></td>
                <td class="w120">&nbsp;</td>
            </tr>
            </tbody>
        </table>
    </form>


    <table class="table tb-type2">
        <thead>
        <tr class="thead">
            <th class="align-left">用户名称</th>
            <th class="align-center">藏豆</th>
            <th class="align-center">操作</th>
        </tr>
        </thead>


        <tbody>
        <?php if (!empty($output['result_list']) && is_array($output['result_list'])) { ?>

            <?php foreach ($output['result_list'] as $k => $v) {?>
                <tr class="hover edit">
                    <td class="align-left"><?php echo $v['member_name'];?></td>
                    <td class="align-center"><?php echo $v['cangdou'];?></td>
                    <td class="align-center"><a href="index.php?act=push_user_gift&op=update_cangdou&id=<?php echo $v['member_id'];?>">编辑</a></td>
                </tr>
                <tr style="display:none;">
                    <td colspan="20"><div class="ncsc-goods-sku ps-container"></div></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr class="no_data">
                <td colspan="15"><?php echo $lang['nc_no_record'];?></td>
            </tr>
        <?php } ?>
        </tbody>



    </table>
    <tfoot>
    <tr class="tfoot">

        <div class="pagination"> <?php echo $output['page'];?> </div></td>
    </tr>
    </tfoot>
</div>
