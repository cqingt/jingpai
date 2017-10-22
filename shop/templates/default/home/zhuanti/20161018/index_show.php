<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161018/css/main.css">

		<div class="photo1"></div>
		<div class="photo2"></div>
		<div class="wwrap">
		<div class="m-wrap">
            <div>
			<div class="boxes">
				<a href="javascript:linquan(200);"></a>
				<a href="javascript:linquan(500);"></a>
			</div>
            </div>
			<div class="box">
				<a href="http://www.96567.com/artist/index.php" target="_blank"></a>
			</div>
			<div class="demo-photo">
				<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/sh20161018/photo5.jpg"/>
			</div>
			
			<div class="boxes-four one1">
				<a href="http://www.96567.com/goods-33646.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-18722.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-30495.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-27959.html" target="_blank"></a>
			</div>
			<div class="boxes-four one2">
				<a href="http://www.96567.com/goods-24185.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-22288.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-22021.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-10075.html" target="_blank"></a>
			</div>
			
			<div class="demo-photo">
		    	<a href="http://www.96567.com/artist/index.php?act=artist_new&op=searchShuHua&gc_parent_id=182&cate_id=619" target="_blank"><img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/sh20161018/photo12.jpg"></a>
				<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/sh20161018/photo9.jpg"/>
			</div>
			
			<div class="boxes-four one3">
				<a href="http://www.96567.com/goods-8048.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-25708.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-25246.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-25142.html" target="_blank"></a>
			</div>
			<div class="boxes-four one4">
				<a href="http://www.96567.com/goods-20445.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-35413.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-33466.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-17520.html" target="_blank"></a>
			</div>
			
			<div class="demo-photo">
				<a href="http://www.96567.com/artist/index.php?act=artist_new&op=searchShuHua&gc_parent_id=182&cate_id=618" target="_blank"><img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/sh20161018/photo12.jpg"/></a>
				<img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/sh20161018/photo13.jpg"/>
			</div>
			
			<div class="boxes-four one5">
				<a href="http://www.96567.com/goods-22174.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-6687.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-33298.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-32720.html" target="_blank"></a>
			</div>
			<div class="boxes-four one6">
				<a href="http://www.96567.com/goods-32568.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-31713.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-28997.html" target="_blank"></a>
				<a href="http://www.96567.com/goods-28445.html" target="_blank"></a>
			</div>
			
			<div class="demo-photo">
				<a href="http://www.96567.com/artist/index.php?act=artist_new&op=searchShuHua&gc_parent_id=332&cate_id=332" target="_blank"><img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/sh20161018/photo16.jpg"/></a>
				<a href="http://www.96567.com/artist/index.php" target="_blank"><img src="http://sctx.oss-cn-beijing.aliyuncs.com/images/sh20161018/photo17.jpg"/></a>
			<!--	<img src="?php echo SHOP_TEMPLATES_URL;?>/home/zhuanti/20161018/images/photo18.jpg"/>-->
			</div>
		</div>
		</div>
		<script type="text/javascript">
		function linquan(s){
		$.post("index.php?act=zhuanti&op=shLinQuan_1018",{'quan':s},function(data){
		      if(data.state == "noLogin"){
		            login_dialog();
		      }else if(data.state === true){
		            alert(data.msg);
		      }else{
		            alert(data.msg);
		      }
		},'json');
		
		}
		
		</script>