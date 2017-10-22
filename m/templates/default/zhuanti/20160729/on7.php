
    <div class="pages">

        <section class="answer1">
            <div class="answer-box"></div>     
            <div class="main1">
				<input type="hidden" id="NumberQuestions" value="7">
            	<div class="img-bj">
            		
					<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/an7.png"/>
            	
					</div>
            	
					<header>Q7：阿联能否在自己的最后一届奥运会上，率队中国男篮不负众望再度杀入八强？</header>
            	<div class="con">
            		<ul class="answer-list">
            			<li onclick="dati('A');" id='Ti_A' <?php if($output['DAANDate']['DaAn_num'] == 'A') {?>class="active"<?php }?>>A、阿联劲爆劈扣排名4到6位</li>
            			<li onclick="dati('B');" id='Ti_B' <?php if($output['DAANDate']['DaAn_num'] == 'B') {?>class="active"<?php }?>>B、阿联V587，排名7到8位</li>
            			<li onclick="dati('C');" id='Ti_C' <?php if($output['DAANDate']['DaAn_num'] == 'C') {?>class="active"<?php }?>>C、无缘8强，阿联尽力拒垫底 </li>
            			<li onclick="dati('D');" id='Ti_D' <?php if($output['DAANDate']['DaAn_num'] == 'D') {?>class="active"<?php }?>>D、无姚明，小组垫底回家钓鱼</li>
            		</ul>
            	</div>
            </div>
        </section>  

    </div>
