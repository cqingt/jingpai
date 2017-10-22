
    <div class="pages">

        <section class="answer1">
            <div class="answer-box"></div>     
            <div class="main1">
			<input type="hidden" id="NumberQuestions" value="4">
            	<div class="img-bj">
            		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/an4.png"/>
            	</div>
            	<header>Q4：宁泽涛作为中国队颜值担当、刷爆朋友圈的小鲜肉、国民老公 ，能否踏平纪录为国摘金？ </header>
            	<div class="con">
            		<ul class="answer-list">
            			<li onclick="dati('A');" id='Ti_A' <?php if($output['DAANDate']['DaAn_num'] == 'A') {?>class="active"<?php }?>>A、颜值刷爆表，必拿金牌 </li>
            			<li onclick="dati('B');" id='Ti_B' <?php if($output['DAANDate']['DaAn_num'] == 'B') {?>class="active"<?php }?>>B、因为太帅只拿了银牌或铜牌</li>
            			<li onclick="dati('C');" id='Ti_C' <?php if($output['DAANDate']['DaAn_num'] == 'C') {?>class="active"<?php }?>>C、进决赛，无缘奖牌好心塞 </li>
            			<li onclick="dati('D');" id='Ti_D' <?php if($output['DAANDate']['DaAn_num'] == 'D') {?>class="active"<?php }?>>D、我只为了看身材，好污</li>
            		</ul>
            	</div>
            </div>
        </section>  

    </div>
