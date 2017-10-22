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
        <li><a href="JavaScript:void(0);" class="current" ><span>拍品管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'theme');?>" ><span>专场管理</span></a></li>
        <li><a href="<?php echo urlAdmin('lepai', 'order');?>" ><span>订单管理</span></a></li>

		<!--
		<li><a href="<?php echo urlAdmin('lepai', 'canpai');?>" ><span>参拍管理</span></a></li>
		-->

      </ul>
    </div>
  </div>

  <div class="fixed-empty"></div>
  <form id="form1" method="get" name="formSearch" id="formSearch">
    <input type="hidden" name="act" value="lepai">
    <input type="hidden" name="op" value="goods">
    <table class="tb-type1 noborder search">
      <tbody>

      <tr>
        <td><input type="text" value="" name="search" id="search" class="txt"></td>
        <td>
          <select name="s_one" id="">
            <option value="">请选择</option>
            <?php foreach($output['lepai_class'] as $k=>$v){?>
            <option value="<?php echo $v['C_Id'];?>"><?php echo $v['C_Name'];?></option>
            <?php }?>
          </select>
        </td>
        <td>
          <select name="s_two" id="">
            <option value="">请选择</option>
            <?php foreach(C('lepai_goodstype') as $k=>$v){?>
            <option value="<?php echo $k;?>"><?php echo $v;?></option>
            <?php }?>
          </select>
        </td>

        <td>
          <select name="s_theme" id="">
            <option value="">请选择专场</option>
            <?php foreach($output['theme'] as $k=>$v){?>
            <option value="<?php echo $v['T_Id'];?>"><?php echo $v['T_Title'];?></option>
            <?php }?>
          </select>
        </td>

        <td>
          <select name="s_store" id="">
            <option value="">请选择店铺</option>
            <?php foreach($output['store'] as $k=>$v){?>
            <option value="<?php echo $v['member_id'];?>"><?php echo $v['store_name'];?></option>
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
          <th class="align-center">拍品信息</th>
          <th class="align-center">所属专场</th>
          <th class="align-center">拍品分类</th>
          <th class="align-center">起拍价</th>
          <th class="align-center">加价幅度</th>
          <th class="align-center">保证金</th>
          <th class="align-center">保留价</th>
          <th class="align-center">状态</th>
          <th width='150' class="align-center">操作</th>
        </tr>
      </thead>


      <tbody>
        <?php if (!empty($output['result']) && is_array($output['result'])) { ?>

        <?php foreach ($output['result'] as $k => $v) {?>
        <tr class="hover edit">
          <td class="align-center"><?php echo $v['G_Id'];?></td>
          <td class="align-center">《<?php echo $v['G_Name'];?>》所属店铺：<?php if($v['M_Store_name']){echo $v['M_Store_name'];}else{?><?php echo $v['M_Name'];}?></td>
          <td class="align-center"><?php echo $v['T_Title'];?></td>
          <td class="align-center"><?php echo $v['G_ClassName'];?></td>
          <td class="align-center"><?php echo $v['G_Qipai'];?></td>
          <td class="align-center"><?php echo $v['G_IncMoney'];?></td>
          <td class="align-center"><?php echo $v['G_BaoZhenMoney'];?></td>
          <td class="align-center"><?php echo $v['G_BaoliuMoney'];?></td>
          <td class="align-center">


<?php if($v['G_Atype'] == '0'){?>
      <dd class="tow-line">未送拍</dd>
<?php }elseif($v['G_Atype'] == '1'){?>
      <dd class="tow-line">已送拍,审核中</dd>
<?php }elseif($v['G_Atype'] == '2'){?>
      <dd class="tow-line">送拍审核未通过<br><a href="JavaScript:;" data-reveal-id="myModal-no" data-lose-id="<?php echo $v['G_Lose'];?>" data-animation="fade">查看原因</a></dd>
<?php }elseif($v['G_Atype'] == '3'){?>
      
      <?php if($v['G_Atype'] == '3' && $v['T_Shenghe'] == '1' && time() < $v['T_Ktime'] && $v['T_Iswin'] == '1'){?>
      <dd class="tow-line">正在预展</dd>
      <?php }elseif($v['G_Atype'] == '3' && $v['T_Shenghe'] == '1' && time() > $v['T_Ktime'] && time() < $v['T_Jtime']  && $v['T_Iswin'] == '1'){?>
      <dd class="tow-line">正在拍卖</dd>
      <?php }else{?>
      <dd class="tow-line">送拍审核已通过</dd>
      <?php }?>

<?php }elseif($v['G_Atype'] == '6'){?>
      <dd class="tow-line">竞拍成功</dd>
<?php }elseif($v['G_Atype'] == '7'){?>
      <dd class="tow-line">流拍</dd>

<?php }?>


          </td>
          <td class="align-center">
			<a href="index.php?act=lepai&op=ChuJiaLog&goodsid=<?php echo $v['G_Id'];?>" title="出价记录">出价</a>
			 | 
		    <a href="index.php?act=lepai&op=BaoMingLog&goodsid=<?php echo $v['G_Id'];?>"  title="报名记录">报名</a>
			 | 
            <a href="index.php?act=lepai&op=upGoods&goodsid=<?php echo $v['G_Id'];?>">编辑</a>
			 | 
            <a href="javascript:delGoods(<?php echo $v['G_Id'];?>);">删除</a>
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

function delGoods(id){
  if(confirm("确定要删除该商品吗？")){
    window.location.href="index.php?act=lepai&op=delGoods&goodsid=" + id;
  }
}


</script>
