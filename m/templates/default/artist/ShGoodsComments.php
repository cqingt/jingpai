<ul class="ui-tiled judge-nav">
					<li <?php echo empty($output['type']) ? 'class="active"' : '' ;?> onclick="pinglun(0);"><div>全部评论</div><i><?php echo @intval($output['goods_evaluate_info']['all']);?></i></li>
					<li <?php echo $output['type'] == '1'?'class="active"':'';?> onclick="pinglun(1);"><div>好评</div><i><?php echo @intval($output['goods_evaluate_info']['good']);?></i></li>
					<li <?php echo $output['type'] == '2'?'class="active"':'';?> onclick="pinglun(2);"><div>中评</div><i><?php echo @intval($output['goods_evaluate_info']['normal']);?></i></li>
					<li <?php echo $output['type'] == '3'?'class="active"':'';?> onclick="pinglun(3);"><div>差评</div><i><?php echo @intval($output['goods_evaluate_info']['bad']);?></i></li>
					<!--<li><div>有图</div><i>99999</i></li>-->
</ul>
				<?php if(!empty($output['goodsevallist'])){ ?>
				<div class="judge-list">
					<?php foreach($output['goodsevallist'] as $k=>$v){ ?>
					<div class="assess-flat">
						<span class="assess-wrapper">
							<div class="assess-top">
								<span class="user-portrait"><img src="<?php echo getMemberAvatarForID($v['geval_frommemberid']);?>"/></span>
								<span class="user-name"><?php echo str_cut($v['geval_frommembername'],2).'***';?></span>
								<span class="assess-date"><?php echo date('Y-m-d H:i:s',$v['geval_addtime'])?></span>
							</div>
							<div class="assess-bottom">
								<span class="comment-item-star">
									<span class="real-star comment-stars-width<?php echo $v['geval_scores']?>"></span>
								</span>
								<p class="assess-content"><?php echo $v['geval_content']?></p>
								<!--
								<p class="pay-date">购买日期：2016-09-01 22:12:12</p>
								<p class="product-type">颜色：金 型号：WIFI版64G</p>
								-->
							</div>
						</span>
					</div>
					<?php }?>
					
				</div>
<?php }else{ ?>
    <span id="loadingsave" style="line-height:2em;"><span style="display:block; text-align:center; color:#666; font-family:微软雅黑;">暂无评价</span></span>
<?php } ?>