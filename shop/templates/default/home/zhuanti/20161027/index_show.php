
	<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161027/css/main.css">
		<div class="img-photo1"></div>
		<div class="img-photo2">
			<div class="m-wrap">
				<a id="btnGet" href="javascrip:;"></a>
			</div>
			<!--tc-->
			<div id="demoTc" class="demo-tc">
				<div class="demobox">
					<a class="btn-close"></a>
					<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/gy20161027web/tc.jpg"/>
				</div>
				<div class="demo-zz"></div>
			</div>
			<script type="text/javascript">
			    $(function(){
			    	var btnGet = $('#btnGet'),
			    	    demoTc = $('#demoTc'),
			    	    bClose = $('.btn-close,.demo-zz');
			    	btnGet.on('click',function(){
						  <?php if ($_SESSION['is_login'] !== '1'){?>
							   login_dialog();
							<?php } else {?>
								$.post("index.php?act=zhuanti&op=ad_20161027&action=lingqu",{},function(data){
									  if(data.state == "noLogin"){
											login_dialog();
									  }else if(data.state === true){
											demoTc.toggleClass('show').removeClass('hide');
									  }else{
											alert(data.msg);
									  }
								},'json');
							<?php } ?>
			    	})
			    	bClose.on('click',function(){
			    		demoTc.toggleClass('hide').removeClass('show');
			    	})
			    	
			    	    
			    	
			    })
			</script>
			<!--tc-->
		</div>
		
		<div class="m-wrap only">
			<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/gy20161027web/photo3.jpg"/>
			<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/gy20161027web/photo4.jpg"/>
			<ul class="demo-shop three">
				<li>
					<a href="http://www.96567.com/goods-35341.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05302788546658228_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《清香》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35388.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05302925946873270_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《丰收》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35391.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05302931049579552_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《歌唱》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35403.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05302936986817872_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《花香》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35413.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05302931049579552_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《蝶恋花》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35425.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05302877685049789_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《香》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
			</ul>
			<ul class="demo-shop four">
				<li>
					<a href="http://www.96567.com/goods-35430.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05302883786300236_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《争先恐后》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35437.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05302943612472406_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《独秀》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35441.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05302900314163859_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《三五成群》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35447.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05302906526802216_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《香气扑鼻》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
			</ul>
			
			<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/gy20161027web/photo5.jpg"/>
			<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/gy20161027web/photo6.jpg"/>
			<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/gy20161027web/photo7.jpg"/>
			
			<ul class="demo-shop three">
				<li>
					<a href="http://www.96567.com/goods-35534.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303051617822215_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《盛夏的果实》扇面</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35530.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303016601246179_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《红叶花》扇面</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35532.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303025655357294_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《盛夏之果》扇面</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35535.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303031545990379_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《竹》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35536.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303033530011992_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《夏花》扇面</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35537.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303035339101644_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《生命》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
			</ul>
			<ul class="demo-shop four">
				<li>
					<a href="http://www.96567.com/goods-35538.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303068486489731_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《生机勃勃》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35539.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303039493514451_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《喜悦》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35540.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303041506372788_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《蕊花一角》扇面</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35541.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303045542252947_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《七星瓢虫》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
			</ul>
			
			<img class="ui-mt-lg" src="http://sctx.oss-cn-beijing.aliyuncs.com/images/gy20161027web/photo8.jpg"/>
			<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/gy20161027web/photo9.jpg"/>
			
			<ul class="demo-shop three">
				<li>
					<a href="http://www.96567.com/goods-35523.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303590165351209_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《兰花香》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35517.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303587387896084_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《相伴》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35510.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303582025940063_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《盛夏》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35567.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303540245384016_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《鸟鸣竹间》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35571.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303544930639133_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《蜻蜓》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35582.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303568887469539_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《兰蝶共舞》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
			</ul>
			<ul class="demo-shop four">
				<li>
					<a href="http://www.96567.com/goods-35583.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303571802598661_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《蝶舞》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35584.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303572831216097_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《花间小憩》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35586.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303577910743527_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《竹上蝉》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
				<li>
					<a href="http://www.96567.com/goods-35585.html" target="_blank">
					    <div class="ui-img">
					        <img src="http://images.96567.com/upload/shop/store/goods/22/22_05303576134387668_360.jpg"/>
					    </div>
					    <div class="ui-txt">
					    	<h2>中国美术家协会会员 官春英《红红火火》</h2>
					    	<p>¥1980.00</p>
					    	<span>立即购买</span>
					    </div>
				    </a>
				</li>
			</ul>
			
			
			<a href="http://www.96567.com/artist/index.php" target="_blank"><img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/gy20161027web/photo10.jpg"/></a>
		</div>
