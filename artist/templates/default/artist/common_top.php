<?php defined('InShopNC') or exit('Access Invalid!');?>



<!-- 顶部搜索 -->

<div class="art-nav wrapper">
 <div class="art-logo">
 	<a href="http://www.96567.com"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/art/artlogo1.png" alt=""></a>
 	<a href="http://www.96567.com/artist/index.php?act=artist_new&op=index"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/art/artlogo2.png" alt=""></a>
 </div>
 <div class="art-search">
  <div class="input-prepend">

  
   <form action="/artist/index.php" method="get">
		<input type="hidden" name="act" value="artist_new">
		<input type="hidden" name="op" value="searchshuhua">
	

    <input class="seek" type="text" name="keyword" placeholder="输入想要搜索的内容">

    <i class="icon-key"></i>
    <input type="submit" value="搜索" id="button" class="input-submit btn-seek">
   </form>

  </div>
  <ul class="hot-query">
       <li><a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>182,"cate_id"=>182));?>" >国画</a></li>
    <li><a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>332,"cate_id"=>332));?>" >书法</a></li>
    <li><a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>183,"cate_id"=>183));?>" >油画</a></li>
    <li><a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>330,"cate_id"=>330));?>" >版画</a></li>
  </ul>
 </div>
 <div class="topadd">
 	<a><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/art/topadd.jpg"/></a>
 </div>
</div>

<!-- 顶部菜单栏 -->
<div class="art-navigation <?php if($_GET['op'] != 'index'){echo 'art-inside';}?> ">
  <div class="navigation wrapper">
   <ul>
     <li id="navinside"><a href="<?php echo urlArtist('artist_new','searchShuHua');?>" >全部商品分类</a></li>
	 <li <?php if(!$output['selOp']){echo "class='now'";}?> ><a href="index.php" >首页</a></li>
	 <li <?php if($output['selOp'] == 'searchshuhua'){echo "class='now'";}?> ><a href="<?php echo urlArtist('artist_new','searchShuHua');?>" >选画中心</a></li>
     <li <?php if($output['selOp'] == 'searchartist'){echo "class='now'";}?> ><a href="<?php echo urlArtist('artist_new','searchArtist');?>" >艺术家</a></li>
     <li <?php if($output['selOp'] == 'goodscustom'){echo "class='now'";}?> ><a href="<?php echo urlArtist('artist_new','goodsCustom');?>">私人定制</a></li>
     <li  ><a href="http://zu.96567.com" target="_blank">艺租</a></li>
     <!-- <li  ><a href="JavaScript:void(0);" target="_blank">收藏问答</a></li> -->
	 <!-- <li  ><a href="JavaScript:void(0);" target="_blank">艺术百科</a></li> -->
   </ul>
   <ol>
     <li><a class="icon-longhair" href="<?php echo urlArtist('artist_new','artistJoin');?>" target="_blank">艺术家加盟</a></li>
   </ol>
  </div>
  
  <div class="wrapper">
	  <div <?php if($_GET['op'] != 'index'){echo "id='secnav'";}?> class="art-secondary">
	  	<ul class="dd-inner">
	  		<li>
	  			<h2><a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>332,'cate_id' =>332));?>" target="_blank">书法</a></h2>
	  			<div class="hot-item">
	  				<a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>332,'cate_id' =>616));?>" target="_blank">草书</a>
	  				<a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>332,'cate_id'=>615));?>" target="_blank">行书</a>
	  				<a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>332,'cate_id'=>613));?>" target="_blank">隶书</a>
	  				<a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>332,'cate_id'=>612));?>" target="_blank">篆书</a>
	  				<a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>332,'cate_id'=>614));?>" target="_blank">楷书</a>
	  			</div>
	  		</li>
	  		<li>
	  			<h2><a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>182,'cate_id' =>182));?>" target="_blank">国画</a></h2>
	  			<div class="hot-item">
	  				<a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>182,'cate_id' => 619));?>" target="_blank">山水</a>
	  				<a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>182,'cate_id' => 617));?>" target="_blank">人物</a>
	  				<a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>182,'cate_id' => 618));?>" target="_blank">花鸟</a>
	  				<a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>182,'cate_id' => 636));?>" target="_blank">动物</a>
	  				<a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>182,'cate_id' => 637));?>" target="_blank">瓜果</a>
	  			</div>
	  		</li>	
	  		<li>
	  			<h2><a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>183,'cate_id' =>183));?>" target="_blank">油画</a></h2>
	  			<div class="hot-item">
	  				<a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>183,'cate_id' => 639));?>" target="_blank">人物</a>
	  				<a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>183,'cate_id' => 640));?>" target="_blank">风景</a>
	  				<a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>183,'cate_id' => 641));?>" target="_blank">静物</a>
	  				<a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>183,'cate_id' => 642));?>" target="_blank">花鸟</a>
	  				<a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>183,'cate_id' => 643));?>" target="_blank">动物</a>
	  			</div>
	  		</li>	
	  		<li class="lastu">
	  			<h2><a href="<?php echo urlArtist('artist_new','searchShuHua',array('gc_parent_id'=>330,'cate_id' =>330));?>" target="_blank">版画</a></h2>
	  			<div class="hot-item">
	  			</div>
	  		</li>	 
	  		<li class="lastd">
	  			<h2><a href="<?php echo urlArtist('artist_new','searchArtist');?>" target="_blank">名家</a></h2>
	  			<div class="hot-item">
	  				<a href="<?php echo urlArtist('artist_blog','index',array('aid'=>'234'));?>"  target="_blank" >官春英</a>
	  				<a href="<?php echo urlArtist('artist_blog','index',array('aid'=>'128'));?>"  target="_blank" >杨建军</a>
	  				<a href="<?php echo urlArtist('artist_blog','index',array('aid'=>'154'));?>"  target="_blank" >吴冬梅</a>
	  				<a href="<?php echo urlArtist('artist_blog','index',array('aid'=>'122'));?>"  target="_blank" >毕政</a>
	  				<a href="<?php echo urlArtist('artist_blog','index',array('aid'=>'123'));?>"  target="_blank" >何满宗</a>
	  			</div>
	  		</li>	  		
	  	</ul>
	  </div>
  </div>  
  
<script>

$(function() {
    $("#navinside").mouseover(function(){
      if($("#secnav").css("display")=="none"){
        $("#secnav").show();
      }else{
        clearTimeout(time);
        time=setTimeout(function(){
          $("#secnav").hide();
        },1000)
      }
    });
    $("#navinside").mouseleave(function(){
      if($("#secnav").css("display")=="block"){
        time=setTimeout(function(){
          $("#secnav").hide();
        },100)
      }else{
        clearTimeout(time);
        $("#secnav").show();
      }
    });
    $("#secnav").mouseover(function(){
        clearTimeout(time);
    });
    $("#secnav").mouseleave(function(){
        $("#secnav").hide();
    });
  
})

</script>

</div>






