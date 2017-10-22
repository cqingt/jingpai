
    <div class="pages">

        <section class="answer1">
            <div class="answer-box"></div>     
            <div class="main1">
			<input type="hidden" id="NumberQuestions" value="3">
            	<div class="img-bj">
            		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/an3.png"/>
            	</div>
            	<header>Q3：林丹是唯一蝉联奥运男单冠军的羽毛球巨星，此次谁将狙杀“超级丹”三连冠？</header>
            	<div class="con">
            		
						<ul class="answer-list">
            			
						<li onclick="dati('A');" id='Ti_A' <?php if($output['DAANDate']['DaAn_num'] == 'A') {?>class="active"<?php }?>>A、队友谌龙，现世界排名No.1 </li>
            			<li onclick="dati('B');" id='Ti_B' <?php if($output['DAANDate']['DaAn_num'] == 'B') {?>class="active"<?php }?>>B、“千年老二”李宗伟 </li>
            			<li onclick="dati('C');" id='Ti_C' <?php if($output['DAANDate']['DaAn_num'] == 'C') {?>class="active"<?php }?>>C、天了噜，其他黑马爆冷</li>
            			<li onclick="dati('D');" id='Ti_D' <?php if($output['DAANDate']['DaAn_num'] == 'D') {?>class="active"<?php }?>>D、Nobody</li>
            		
						</ul>
            	
						</div>
            
						</div>
        </section>  

    </div>
