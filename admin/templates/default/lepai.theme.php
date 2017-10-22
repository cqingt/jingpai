<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<div class="page">

  <div class="fixed-bar">
    <div class="item-title">
      <h3>乐拍管理</h3>
      <ul class="tab-base">
        <li><a href="<?php echo urlAdmin('lepai', 'index');?>"><span>用户管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'adduser');?>"><span>用户添加</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'songpai');?>" ><span>送拍信息</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'goods');?>" ><span>拍品管理</span></a></li>
        <li><a href="JavaScript:void(0);" class="current" ><span>专场管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'order');?>" ><span>订单管理</span></a></li>


      </ul>
    </div>
  </div>

  <div class="fixed-empty"></div>
  <form id="form1" method="get" name="formSearch" id="formSearch">
    <input type="hidden" name="act" value="lepai">
    <input type="hidden" name="op" value="theme">
    <table class="tb-type1 noborder search">
      <tbody>

      <tr>
        
        <td><input type="text" value="" name="search" id="search" class="txt"  placeholder='专场标题'></td>
        <td>
          <select name="select_goods_input" id="">
            <option value="">请选择</option>
            <?php foreach(C('lepai_themetype') as $k=>$v){?>
            <option value="<?php echo $k;?>"><?php echo $v;?></option>
            <?php }?>
          </select>
        </td>
          <td ><a href="javascript:void(0);" id="ncsubmit" class="btn-search " title="<?php echo $lang['nc_query'];?>"></a></td>
          <td class="w120">&nbsp;</td>
        </tr>
      </tbody>
    </table>
  </form>




  <form method='POST' id="form_goods" action="<?php echo urlAdmin('artist', 'del_artist');?>">
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24">ID</th>
          <th class="align-center">专场信息</th>
          <th class="align-center">店铺名称</th>
          <th class="align-center">开始时间</th>
          <th class="align-center">结束时间</th>
          <th class="align-center">拍品数量</th>
          <th class="align-center">审核状态</th>

          <th width='150' class="align-center">操作</th>
        </tr>
      </thead>


      <tbody>
        <?php if (!empty($output['result']) && is_array($output['result'])) { ?>

        <?php foreach ($output['result'] as $k => $v) {?>
        <tr class="hover edit">
          <td class="align-center"><?php echo $v['T_Id'];?></td>
          <td class="align-center"><?php echo $v['T_Title'];?></td>
          <td class="align-center"><?php echo $v['store_name'];?></td>
          <td class="align-center"><?php echo date("Y-m-d",$v['T_Ktime']);?></td>
          <td class="align-center"><?php echo date("Y-m-d",$v['T_Jtime']);?></td>
          <td class="align-center"><?php echo $v['T_Sum'].'/'.$v['T_Max'];?></td>
          <td class="align-center">
<?php if($v['T_Tisheng'] == '1' && $v['T_Shenghe'] == '0' && $v['T_Iswin'] == '0'){?>
待审核
<?php }?>

<?php if($v['T_Tisheng'] == '1' && $v['T_Shenghe'] == '1' && $v['T_Iswin'] == '0'){?>
审核通过
<?php }?>

<?php if($v['T_Tisheng'] == '1' && $v['T_Shenghe'] == '2' && $v['T_Iswin'] == '0'){?>
审核未通过
<?php }?>

<?php if($v['T_Tisheng'] == '1' && $v['T_Shenghe'] == '1' && $v['T_Iswin'] == '1'){?>
进行中
<?php }?>

          </td>

          <td class="align-center">
            <?php if($v['T_Tisheng'] == '1' && $v['T_Shenghe'] == '1' && $v['T_Iswin'] == '0'){?>
            <a href="javascript:pushTheme(<?php echo $v['T_Id'];?>);">开启专场</a> | 
            <?php }?>
            
            <a href="index.php?act=lepai&op=upTheme&id=<?php echo $v['T_Id'];?>">编辑</a> | 
            <a href="javascript:clickDel(<?php echo $v['T_Id'];?>);">删除</a>
          </td>
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


      <tfoot>
        <tr class="tfoot">
          
          <td colspan="16">
            <div class="pagination"> <?php echo $output['page'];?> </div></td>

        </tr>
      </tfoot>
    </table>
  </form>
</div>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.mousewheel.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script>

<script type="text/javascript">
$(function (){

  $("#ncsubmit").click(function (){
      $("#form1").submit();
  });

})

function clickDel(id){
  if(confirm("确定要删除该专场吗？不可恢复！")){
    window.location.href="index.php?act=lepai&op=delTheme&themeid=" + id;
  }
}

function pushTheme(id){
  if(confirm("确定要开启该专场吗？")){
    window.location.href="index.php?act=lepai&op=pushTheme&themeid=" + id;
  }
}

</script>
