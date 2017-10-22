<?php defined('InShopNC') or exit('Access Invalid!');?>
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/reset.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/member.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/new_page.css">


<ul class="purchase investment_title">
<!--
<?php foreach($output['new_classes'] as $k => $v){?> 
  <li <?php if($v['start_hour'] <= date("H",TIMESTAMP) && date("H",TIMESTAMP) <= $v['end_hour']) {?>class="on"<?php }?>>
	 <h1><?php echo $v['start_hour'];?>:00</h1>
	 <?php if($v['start_hour'] <= date("H",TIMESTAMP) && date("H",TIMESTAMP) <= $v['end_hour']) {?>
		<strong>正在进行</strong>
	 <?php }else{
		echo '<strong>即将开始</strong>';
	 } ?>
  </li>
<?php } ?>
-->
<?php $i=0;?>
<?php foreach($output['miaosha'] as $start_hour => $miaosha_list){?>
<?php if($i == 0) { 
	foreach($miaosha_list as $miaosha_id => $v){
		$result_list = $v; 
		break;
	}
} ?>

<?php if($i < 3) { ?>
  <li <?php if($i == 0) { ?>class="on"<?php } ?>>
	 <?php $stArray = explode('_',$start_hour)?>
	 <h1><?php echo $stArray[0];?>:00</h1>
	 <?php if($i == 0) { ?>
		<strong>正在进行</strong>
	<?php }else{ ?>
		<strong>即将开始</strong>
	<?php } ?>
	
  </li>
<?php } ?>
<?php $i++; } ?>
</ul>
<?php if($output['miaosha']){?>
<div class="boxtime investment_con">
<?php foreach($output['miaosha'] as $k => $miaosha_list){?>
<div class="box">
   <?php foreach($miaosha_list as $miaosha_id => $v){?>
    <div class="list_tuangou">
       
         <div class="list_tuangou2">
              <div class="list_tuangou2_img">
				 <?php if($v['is_shipping'] == 1){?>
						<div class="icon-by"></div>
				 <?php } ?>
                   <a href="<?php echo $v['goods_url'];?>">
                      <img src="<?php echo $v['goods_image'];?>">
                    </a>
              </div>
              <div class="list_tuangou22">
			    <div class="list_tuangou_bt">
					<a href="<?php echo $v['goods_url'];?>"><?php echo $v['goods_name'];?></a>
				</div>
              <div class="lin_hg">秒杀价：
                   <span class="a1"><a href="<?php echo $v['goods_url'];?>" style="color:#C00;">￥<?php echo $v['miaosha_price'];?></a></span>
              </div>
              <div class="lin_hg">商城价：<span class="a2">￥<?php echo $v['goods_price'];?></span></div>

              <div class="lin_hg">
                    
                    <?php if($v['shengyukucun'] < 1){ ?>
                    <label id = "leftTime2">该秒杀已结束...</label>
                    <?php }elseif($v['start_time'] > TIMESTAMP){?>
                    <label id = "leftTime2"  class="leftTime" count_down="<?php echo $v['start_time'] - TIMESTAMP;?>" timestatus="1">载入中,请稍候...</label>
                    <?php }elseif($v['end_time'] < TIMESTAMP){?>
                    <label id = "leftTime2"  >该秒杀已结束...</label>
                    <?php }else{?>
                    <label id = "leftTime2"  class="leftTime" count_down="<?php echo $v['end_time'] - TIMESTAMP;?>" timestatus="2">载入中,请稍候...</label>
                    <?php }?>
					<em class="surplus">剩余<?php echo $v['shengyukucun'];?>件</em>
              </div>

              <div class="lin_hg">

                <?php if($v['shengyukucun'] < 1){ ?>
                <span class="c9"><a class="input">该秒杀结束</a></span>
                <?php }elseif($v['start_time'] > TIMESTAMP){?>
                <span class="c9"><a class="input">即将开始</a></span>
                <?php }elseif($v['end_time'] < TIMESTAMP){?>
                <span class="c9"><a class="input">该秒杀结束</a></span>
                <?php }else{?>
                <span class="a4"><a href="<?php echo urlWap('goods','index',array('goods_id'=>$v['goods_id']));?>" class="input">立即秒杀</a></span>
                <?php }?>

              </div>
              </div>
         </div>
    </div>
<?php }?>
</div>
<?php }?>

</div>






<?php }else{?>
<div class="no-record">暂无记录</div>
<?php }?>


<script>
    $(function(){

        /*tab标签切换*/
        function tabs(tabTit,on,tabCon){
            $(tabCon).each(function(){
                $(this).children().eq(0).show();

            });
            $(tabTit).each(function(){
                $(this).children().eq(0).addClass(on);
            });
            $(tabTit).children().hover(function(){
                $(this).addClass(on).siblings().removeClass(on);
                var index = $(tabTit).children().index(this);
                $(tabCon).children().eq(index).show().siblings().hide();
            });
        }
        tabs(".investment_title","on",".investment_con");

    })
    function lepaiclockdone(){
    setTimeout("lepaiclockdone()", 1000);
    $(".leftTime").each(function(){
        var obj = $(this);
        var tms = obj.attr("count_down");
        var t = obj.attr("timestatus");
        if(t == 2){
            var html = '距结束：';
        }else{
            var html = '距开始：';
        }
        if (tms>0) {
            tms = parseInt(tms)-1;
            var days = Math.floor(tms / (1 * 60 * 60 * 24));
            var hours = Math.floor(tms / (1 * 60 * 60)) % 24;
            var minutes = Math.floor(tms / (1 * 60)) % 60;
            var seconds = Math.floor(tms / 1) % 60;

            if(days > 0){
                html += "<span>"+days+"</span>天";
            }
            if(hours > 0){
                html += "<span>"+hours+"</span>时";
            }
            if(minutes > 0){
                html += "<span>"+minutes+"</span>分";
            }
            html += "<span>"+parseInt(seconds)+"</span>秒";
            obj.html(html);
            obj.attr("count_down",tms);
        }else{
            // location.href = location.href;
        }
    });
}
lepaiclockdone();//启动倒计时
</script>


<?php 


$array['P']['title'] = $result_list['goods_name'];
$array['P']['imgUrl'] = $result_list['goods_image'];
$array['Y']['title'] = $result_list['goods_name'];
$array['Y']['desc'] = $result_list['goods_name'];
$array['Y']['imgUrl'] = $result_list['goods_image'];

echo weixinShare($array);

?>