<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="tabmenu">
  <?php include template('layout/submenu');?>
</div>
<div class="alert alert-block mt10">
    <ul class="mt5">
        <li>一元夺宝网址：http://1.96567.com</li>
        <li>参与夺宝活动请联系官方运营人员</li>
    </ul>
</div>

<table class="ncsc-default-table">
  <thead>
    <tr>
      <th class="w90">图片</th>
      <th class="w130">商品标题</th>
      <th class="w90">金额</th>
      <th class="w90">总需人数</th>
      <th class="w90">已参与人数</th>
      <th class="w90">剩余人数</th>
      <th class="w110">开始时间</th>
    </tr>
  </thead>
  <tbody>
    <?php if($output['item_list']['code'] == 1){?>
    <?php foreach($output['item_list']['list'] as $key=>$val){?>
    <tr class="bd-line">
      <td><div><a href="http://1.96567.com/?/goods/<?php echo $val['id'];?>" target="_blank"><img src="http://1.96567.com/statics/uploads/<?php echo $val['thumb'];?>" width="50px" height="50px"/></a></div></td>
      <td class="tl"><a href="http://1.96567.com/?/goods/<?php echo $val['id'];?>" target="_blank"><?php echo '【第'.$val['qishu'].'期】'.$val['title'];?></a></td>
      <td><?php echo $val['money'];?></td>
      <td><?php echo $val['zongrenshu'];?></td>
      <td><?php echo $val['canyurenshu'];?></td>
      <td><?php echo $val['shenyurenshu'];?></td>
      <td><?php echo date('Y-m-d H:i:s',$val['time']);?></td>
    </tr>
    <?php }?>
    <?php }else{?>
    <tr>
      <td colspan="20" class="norecord"><div class="warning-option"><i class="icon-warning-sign"></i><span><?php echo $lang['no_record'];?></span></div></td>
    </tr>
    <?php }?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="20"><div class="pagination"><?php echo $output['show_page']; ?></div></td>
    </tr>
  </tfoot>
</table>
