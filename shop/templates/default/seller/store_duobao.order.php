<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="tabmenu">
    <?php include template('layout/submenu');?>
</div>
<div class="alert alert-block mt10">
    <ul class="mt5">
        <li>只有中奖用户填写收货地址后，才会显示夺宝订单</li>
        <li>请及时发货</li>
    </ul>
</div>

<table class="ncsc-default-table">
  <thead>
  <tr>
      <th class="w90">图片</th>
      <th class="w130">商品标题</th>
      <th class="w60">金额</th>
      <th class="w60">总需人数</th>
      <th class="w110">开始时间</th>
      <th class="w110">结束时间</th>
      <th class="w140">收货地址</th>
      <th class="w80">状态</th>
  </tr>
  </thead>
    <style type="text/css">
        .reveal-modal-bg { position: fixed; height: 100%; width: 100%; z-index: 100; display: none; top: 0; left: 0; background:rgba(00, 00, 00, 0.8) }
        .reveal-box {position: relative;}
        .reveal-modal div {font: 14px/24px 'Microsoft YaHei';}
        input.reva-input {font-size: 14px;font-weight: normal;outline: 0;height: 20px;border-radius: 4px;color: #7e7e7e;background: #fff;border: 1px solid #bbb;width: 100%;padding: 2px 0;text-indent: 10px;}
        .reveal-modal { width: 200px; position: absolute; top:-100px; left: -250px; z-index: 101; padding: 20px; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; -moz-box-shadow: 0 0 10px rgba(0,0,0,.4); -webkit-box-shadow: 0 0 10px rgba(0,0,0,.4); -box-shadow: 0 0 10px rgba(0,0,0,.4); background-color: #FFF;}
        .reveal-modal .close-reveal-modal { font-size: 22px; line-height: 0.5; position: absolute; top: 10px; right: 12px; color: #333; text-shadow: 0 -1px 1px rbga(0,0,0,.6); font-weight: bold; cursor: pointer;}
        .reveal-inss {margin-bottom: 6px;}
        .reveal-inss strong {font-weight: normal;margin-bottom: 4px;display: block;}
        .reva-button {width: 100%;font-size: 16px;padding: 2px 0;margin-top:10px;font: 14px/24px 'Microsoft YaHei';}
        a.big-link {font-size: 14px;width: 80px;text-decoration: none;text-align: center;color: #fff !important;background: #FA6427;display: block;padding: 6px;moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius:}
    </style>
    <tbody>
    <?php if($output['item_list']['code'] == 1){?>
        <?php foreach($output['item_list']['list'] as $key=>$val){?>
            <tr class="bd-line">
                <td><div><a href="http://1.96567.com/?/goods/<?php echo $val['id'];?>" target="_blank"><img src="http://1.96567.com/statics/uploads/<?php echo $val['thumb'];?>" width="50px" height="50px"/></a></div></td>
                <td class="tl"><a href="http://1.96567.com/?/goods/<?php echo $val['id'];?>" target="_blank"><?php echo '【第'.$val['qishu'].'期】'.$val['title'];?></a></td>
                <td><?php echo $val['money'];?></td>
                <td><?php echo $val['zongrenshu'];?></td>
                <td><?php echo date('Y-m-d H:i:s',$val['time']);?></td>
                <td><?php echo date('Y-m-d H:i:s',$val['q_end_time']);?></td>
                <td class="tl">
                    <?php $address = unserialize($val['address']);?>
                    收货人：<?php echo $address['shouhuoren'];?>（<?php echo $address['mobile'];?>）
                    <Br/>收货地区：<?php echo $address['sheng'].$address['shi'].$address['xian']?>
                    <Br/>街道地址：<?php echo $address['jiedao'];?>（<?php echo $address['youbian'];?>）
                </td>
                <td><?php
                        if($val['status'] == "已付款,未发货,未完成"){ ?>
                        <div class="reveal-box" id="fahuoid<?php echo $val['id'];?>">
                            <a href="javascript:void(0)" onclick="javascript:fahuofunc(<?php echo $val['id'];?>)" class="big-link" data-reveal-id="myModal" data-animation="fade">点击发货</a>
                        </div>
                        <?php }else{
                            echo $val['status'];
                        }
                    ?>
                </td>
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
<script>
    var c = function(){
        $("#closefahuo").click(function(){
            $("#myModal").remove();
        });
        $("#submitfahuo").click(function(){
            var gid = $("input[name='gid']").val();
            var company = $("input[name='company']").val();
            var company_code = $("input[name='company_code']").val();
            if(gid == ''){
                alert("发货参数错误！");
                return false;
            }
            if(company == '' || company_code == ''){
                alert("物流公司和快递单号不能为空");
                return false;
            }
            $.ajax({
                type:'post',
                url:'index.php?act=store_duobao&op=ajax_fahuo',
                data:"gid="+gid+"&company="+company+"&company_code="+company_code,
                cache:false,
                dataType:'text',
                success:function(data){
                    if(data == 1){
                        alert("发货成功");
                        window.location.reload();
                    }else if(data == 2){
                        alert("已发货，请勿重复发货");
                    }else{
                        alert("系统错误，发货失败，请联系客服");
                    }
                }
            })
        });
    }
    function fahuofunc(gid){
        var fahuo_html = '<div id="myModal" class="reveal-modal"><input type="hidden" name="gid" value="'+gid+'"> <div class="reveal-inss"> <strong>物流公司</strong><input class="reva-input" type="text" value="" name="company" placeholder="请输入物流公司" /> </div> <div class="reveal-inss"> <strong>快递单号</strong><input class="reva-input" type="text"  name="company_code" value="" placeholder="请输入快递单号" /> </div> <div class="reveal-inss"><input class="reva-button" type="button" id="submitfahuo" value="确认发货" /></div> <a class="close-reveal-modal" id="closefahuo">&#215;</a> </div>';
        $("#myModal").remove();
        $("#fahuoid"+gid).append(fahuo_html);
        c();
    }
</script>