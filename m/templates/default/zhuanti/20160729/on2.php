
<div class="pages">

	<section class="answer1">
		<div class="answer-box"></div>     
		<div class="main1">
		<input type="hidden" id="NumberQuestions" value="2">
			<div class="img-bj">
            		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/an2.png"/>
            	</div>
            	<header>Q2：日本体操男团2015年世锦赛夺冠，作为伦敦奥运冠军的中国队能否坚挺降日？</header>
			<div class="con">
            		<ul class="answer-list">
            			
			<li onclick="dati('A');" id='Ti_A' <?php if($output['DAANDate']['DaAn_num'] == 'A') {?>class="active"<?php }?>>A、必须拿（gan）下（si） </li>
					<li onclick="dati('B');" id='Ti_B' <?php if($output['DAANDate']['DaAn_num'] == 'B') {?>class="active"<?php }?>>B、好像顶不住啊  </li>
					<li onclick="dati('C');" id='Ti_C' <?php if($output['DAANDate']['DaAn_num'] == 'C') {?>class="active"<?php }?>>C、均无缘金牌 </li>
					<li onclick="dati('D');" id='Ti_D' <?php if($output['DAANDate']['DaAn_num'] == 'D') {?>class="active"<?php }?>>D、OMG，并列了！</li>
            		
			</ul>
            	
			</div>
            
			</div>
	</section>  

</div>
