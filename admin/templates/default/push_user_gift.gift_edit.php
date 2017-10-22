<?php defined('InShopNC') or exit('Access Invalid!');?>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/i18n/zh-CN.js" charset="utf-8"></script>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/themes/ui-lightness/jquery.ui.css"  />

<div class="page">


  <div class="fixed-bar">
    <div class="item-title">
      <h3>藏豆兑换礼品添加/编辑</h3>
        <ul class="tab-base">
            <?php   foreach($output['menu'] as $menu) {  if($menu['menu_type'] == 'text') { ?>
                <li><a href="JavaScript:void(0);" class="current"><span><?php echo $menu['menu_name'];?></span></a></li>
            <?php }  else { ?>
                <li><a href="<?php echo $menu['menu_url'];?>" ><span><?php echo $menu['menu_name'];?></span></a></li>
            <?php  } }  ?>
        </ul>
    </div>
  </div>
    <form id="form1" method="post" enctype="multipart/form-data" >
        <input type="hidden" name="form_submit" value="ok" />
        <input type="hidden" name="act" value="push_user_gift" />
        <input type="hidden" name="op" value="add_gift" />
        <input type="hidden" name="gift_id" value="<?php echo $output['cangdou_info']['id'];?>" />
        <table class="table tb-type2">
            <thead>
            <tr class="space">
                <th colspan="3">商品图片</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th class="required" style="line-height:normal; border-top: 1px dotted #CBE9F3;"><label for="">商品图片:</label></th>
                <td colspan="2" class="required"><label class="validation" for="goodsname">商品goods_id:</label></td>
            </tr>
            <tr class="noborder">
                <th rowspan="9" class="picture">
                    <div class="size-200x200"><span class="thumb size-200x200"><i></i><img src="<?php echo cthumb($output['cangdou_info']['goods_image'],'240');?>" onload="javascript:DrawImage(this,200,200);" id="goods_image" /></span></div>
                    <div style="width: 200px;"><p id="goods_name"><?php echo $output['cangdou_info']['goods_name'] != ''?'商品名称'.$output['cangdou_info']['goods_name']:'';?></p><p id="goods_price"><?php echo $output['cangdou_info']['goods_price'] != ''?'价格：'.$output['cangdou_info']['goods_price']:'';?></p><p id="kucun"><?php echo $output['cangdou_info']['goods_storage'] != ''?'库存：'.$output['cangdou_info']['goods_storage']:'';?></p></div>
                </th>
                <td class="vatop rowform"><input type="text" name="goods_id" id="goods_id" class="txt" style="width:110px" value="<?php echo $output['cangdou_info']['goods_id'];?>"/><input type="button" id="select_goods" value="查询商品"></td>
                <td class="vatop tips"></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><label class="validation" for="use_cangdou">兑换所需藏豆:</label></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><input type="text" name="use_cangdou" id="use_cangdou" class="txt" value="<?php echo $output['cangdou_info']['use_cangdou'];?>"/></td>
                <td class="vatop tips"></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><label class="validation" for="kucun">可兑换数量:</label></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><input type="text" name="kucun" id="kucun" class="txt" value="<?php echo $output['cangdou_info']['kucun'];?>"/></td>
                <td class="vatop tips"></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><label class="validation" for="starttime">开始时间:</label></td>
            </tr>
            <tr class="noborder">

                <td class="vatop rowform"><input type="text" name="starttime" id="starttime" class="txt" value="<?php echo date('Y-m-d',$output['cangdou_info']['starttime']);?>"/></td>
                <td class="vatop tips"></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><label class="validation" for="endtime">结束时间:</label></td>
            </tr>
            <tr class="noborder">

                <td class="vatop rowform"><input type="text" name="endtime" id="endtime" class="txt" value="<?php echo date('Y-m-d',$output['cangdou_info']['endtime']);?>"/></td>
                <td class="vatop tips"></td>
            </tr>
            <tr>
                <td colspan="2">&nbsp;</td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform">&nbsp;</td>
                <td class="vatop tips"></td>
            </tr>



            </tbody>

            <tfoot>
            <tr class="tfoot">
                <td colspan="3"><input type="submit" name="submit1" value="提交"> </td>
            </tr>
            </tfoot>
        </table>
    </form>
</div>
<script>

    $(function(){
        $("#select_goods").click(function(){
           var goods_id = $("#goods_id").val();
            $.ajax({
                type:"GET",
                url:'<?php echo urlAdmin('push_user_gift', 'get_goods');?>',
                async:false,
                data:{goods_id: goods_id},
                dataType: 'json',
                success: function(data){
                    if(!data.state) {
                        alert('未找到商品信息');return false;
                    }else{
                        $("#goods_image").attr('src',data.info.goods_img_url);
                        $("#goods_name").html('商品名称：'+data.info.goods_name);
                        $("#goods_price").html('价格：'+data.info.goods_price);
                        $("#kucun").html('库存：'+data.info.goods_storage + '件');
                        $('input[name=goods_id]').val(data.info.goods_id);
                        $('input[name=kucun]').val(data.info.goods_storage);
                    }
                }
            });
        });


        $('#starttime').datepicker({dateFormat: 'yy-mm-dd'});
        $('#endtime').datepicker({dateFormat: 'yy-mm-dd'});

        $('#form1').validate({
            errorPlacement: function(error, element){
                error.appendTo(element.parent().parent().prev().find('td:first'));
            },
            rules : {
                goods_id : {
                    required   : true
                },
                use_cangdou    : {
                    required  : true
                },
                kucun : {
                    required   : true
                },
                starttime : {
                    required   : true
                },
                endtime  : {
                    required  : true
                }
            },
            messages : {
                goods_id  : {
                    required   : '必填项不能为空'
                },
                use_cangdou : {
                    required   : '必填项不能为空'
                },
                kucun : {
                    required   : '必填项不能为空'
                },
                starttime : {
                    required   : '必填项不能为空'
                },
                endtime : {
                    required   : '必填项不能为空'
                }
            }
        });
    });
</script>