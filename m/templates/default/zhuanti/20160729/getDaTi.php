
    <div class="pages">
 
        <section class="jieguo">
            <div class="jieguo-box"></div>     
            
            <div class="main2">
            	<div class="renbox">
            		
					<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160729/img/ren1.png"/>
            	
					</div>
            	
					<header><?php echo $output['QTI'];?></header>
                <ul class="result">
				<?php foreach($output['TiArray'] as $k=>$v){ ?>
                	<li>
                		<div class="demo-item">
                            
							<div class="box" style="height:<?php echo @round($v/$output['ZongNum']*100);?>%;">
     
								<?php echo @round($v/$output['ZongNum']*100);?>%
                            
							</div>
                		
						</div>
                		<p><?php echo $k; ?></p>
                	</li>
				<?php } ?>
                </ul>
                
                <a class="btn-next" onclick="XiaYiTi('<?php echo $output['NumberQuestions'];?>');">NEXT</a>
            
				
				</div>
            
        </section>  

    </div>
