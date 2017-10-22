<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="tabmenu">
  <?php include template('layout/submenu');?>
</div>
  
<form method="get" action="index.php">
  <table class="search-form">
    <input type="hidden" name="act" value="store_goods_online" />
    <input type="hidden" name="op" value="arrival_notice" />
    <tr>
      <td>总数<?php echo $output['pageNumber'];?></td>
      <th></th>
      <td class="w160"></td>
      <th> <select name="search_type">
        <option value="2">商品名称</option>
          <!-- <option value="1" <?php if ($_GET['type'] == 1) {?>selected="selected"<?php }?>><?php echo $lang['store_goods_index_goods_no'];?></option> -->
          <!-- <option value="2" <?php if ($_GET['type'] == 2) {?>selected="selected"<?php }?>>平台货号</option> -->
        </select>
      </th>
      <td class="w160"><input type="text" class="text w150" name="keyword" value="<?php echo $_GET['keyword']; ?>"/></td>
      <td class="tc w70"><label class="submit-border">
          <input type="submit" class="submit" value="<?php echo $lang['nc_search'];?>" />
        </label></td>
    </tr>
  </table>
</form>




<table class="ncsc-default-table">
  <thead>

    <tr nc_type="table_header">
      <th class="w30">商品ID</th>
      <th class="w300">商品名称</th>
      <th class="w50">会员ID</th>
      <th class="w100">添加时间</th>
      <th class="w100">邮箱</th>
      <th class="w100">手机号</th>
      <th class="w120">状态</th>
    </tr>

  </thead>
  <tbody>



    <?php  if (!empty($output['result'])) { ?>

     <?php  foreach($output['result'] as $k=>$v) { ?>
    <tr>
      <td><?php echo $v['goods_id'];?></td>
      <td><a target="_blank" href="<?php echo urlShop('goods','index',array('goods_id'=>$v['goods_id']));?>"><?php echo $v['goods_name'];?></a></td>
      <td><?php echo $v['member_id'];?></td>
      <td><?php echo date('Y-m-d',$v['an_addtime']);?></td>
      <td><?php echo $v['an_email'];?></td>
      <td><?php echo $v['an_mobile'];?></td>
      <td><?php if($v['an_type'] == 1){echo '到货';}else{echo '预约';}?></td>
      <?php } ?>
    </tr>
    <?php } ?>


  </tbody>
  <tfoot>
    <?php  if (!empty($output['result'])) { ?>

    <tr>
      <td colspan="20"><div class="pagination"> <?php echo $output['page']; ?> </div></td>
    </tr>
    <?php } ?>
  </tfoot>
</table>