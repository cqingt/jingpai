<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/msscss.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">
<script>
    $(function(){
        $('.header-wrap').addClass('demo-header');
        $('.mss_vip_pjc').css('marginTop',50);
        $('.main-op-warp').css({'marginTop':'50px','marginBottom':'-50px'});
    })
</script>
<div class="mss_vip_pjc" id="mss_vip_pjc">
    <dl>
<!--         <dd <?php echo ($output['type'] == 1)?'class="active"':'onclick="location.href=\''.urlWap('goods','comments',array('goods_id'=>$output['goods_id'],'type'=>1)).'\'"'?>><p>全部评论<em>（<?php echo $output['goods_evaluate_info']['good']?>）</em></p></dd> -->
        <dd <?php echo ($output['type'] == 1)?'class="active"':'onclick="location.href=\''.urlWap('goods','comments',array('goods_id'=>$output['goods_id'],'type'=>1)).'\'"'?>><p>好评<em>（<?php echo $output['goods_evaluate_info']['good']?>）</em></p></dd>
        <dd <?php echo ($output['type'] == 2)?'class="active"':'onclick="location.href=\''.urlWap('goods','comments',array('goods_id'=>$output['goods_id'],'type'=>2)).'\'"'?>><p>中评<em>（<?php echo $output['goods_evaluate_info']['normal']?>）</em></p></dd>
        <dd <?php echo ($output['type'] == 3)?'class="active"':'onclick="location.href=\''.urlWap('goods','comments',array('goods_id'=>$output['goods_id'],'type'=>3)).'\'"'?>><p>差评<em>（<?php echo $output['goods_evaluate_info']['bad']?>）</em></p></dd>
<!--         <dd <?php echo ($output['type'] == 3)?'class="active"':'onclick="location.href=\''.urlWap('goods','comments',array('goods_id'=>$output['goods_id'],'type'=>3)).'\'"'?>><p>晒图<em>（<?php echo $output['goods_evaluate_info']['bad']?>）</em></p></dd> -->
    </dl>
    <?php if(!empty($output['goodsevallist'])){ ?>
    <div class="tab_box">
        <ul style="display:block;" id="lmlm_pic">
            <?php foreach($output['goodsevallist'] as $k=>$v){ ?>
            <li>
                <div class="mss_vip_pjcp">
                    <p><?php echo str_cut($v['geval_frommembername'],2).'***';?> 评论</p>
                    <p><span>评分：</span><span class="mss_xx"><img src="<?php echo MOBILE_TEMPLATES_URL;?>/images/mss_xx<?php echo $v['geval_scores']?>.jpg" /></span><span><?php echo date('Y-m-d H:i:s',$v['geval_addtime'])?></span></p>
                    <p>心得：<?php echo $v['geval_content']?></p>
                </div>
            </li>
            <?php }?>
        </ul>
    </div>


    <?php echo $output['show_page'];?>

    <?php }else{ ?>
    <span id="loadingsave" style="line-height:2em;"><span style="display:block; text-align:center; color:#666; font-family:微软雅黑;">暂无评价</span></span>
    <?php } ?>
</div>
