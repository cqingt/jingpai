
    <div class="pages">

        <section class="answer1">
            <div class="answer-box"></div>     
            <div class="main1">
			<input type="hidden" id="NumberQuestions" value="6">
            	<div class="img-bj">
            		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/an6.png"/>
            	</div>
            	<header>Q6：苏炳添作为首位百米跑进10秒“亚洲飞人”，里约能否擦肩博尔特问鼎奥运之巅？</header>
            	<div class="con">
            		<ul class="answer-list">
            			<li onclick="dati('A');" id='Ti_A' <?php if($output['DAANDate']['DaAn_num'] == 'A') {?>class="active"<?php }?>>A、一股最炫民族风吹来，赢了 </li>
            			<li onclick="dati('B');" id='Ti_B' <?php if($output['DAANDate']['DaAn_num'] == 'B') {?>class="active"<?php }?>>B、微秒之差遗憾夺银或铜牌</li>
            			<li onclick="dati('C');" id='Ti_C' <?php if($output['DAANDate']['DaAn_num'] == 'C') {?>class="active"<?php }?>>C、红色闪电进决赛但无缘奖牌</li>
            			<li onclick="dati('D');" id='Ti_D' <?php if($output['DAANDate']['DaAn_num'] == 'D') {?>class="active"<?php }?>>D、无缘决赛</li>
            		</ul>
            	</div>
            </div>
        </section>  

    </div>
