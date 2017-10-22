
    <div class="pages">

        <section class="answer1">
            <div class="answer-box"></div>     
            <div class="main1">
			<input type="hidden" id="NumberQuestions" value="5">
            	<div class="img-bj">
            		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/an5.png"/>
            	</div>
            	<header>Q5：“铁榔头”（我为补钙带盐）再度执掌中国女排教鞭，能否带领中国女排再创辉煌？</header>
            	<div class="con">
            		<ul class="answer-list">
            			
						<li onclick="dati('A');" id='Ti_A' <?php if($output['DAANDate']['DaAn_num'] == 'A') {?>class="active"<?php }?>>A、“郎头”之师，霸气夺金 </li>
            			<li onclick="dati('B');" id='Ti_B' <?php if($output['DAANDate']['DaAn_num'] == 'B') {?>class="active"<?php }?>>B、再度饮恨，收获银牌或铜牌 </li>
            			<li onclick="dati('C');" id='Ti_C' <?php if($output['DAANDate']['DaAn_num'] == 'C') {?>class="active"<?php }?>>C、挺进四强，但无缘奖牌</li>
            			<li onclick="dati('D');" id='Ti_D' <?php if($output['DAANDate']['DaAn_num'] == 'D') {?>class="active"<?php }?>>D、其他</li>
            		</ul>
            	</div>
            </div>
        </section>  

    </div>
