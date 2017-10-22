<?php defined('InShopNC') or exit('Access Invalid!');?>


<div class="course-nav-hd wrapper mtb-course">
	<h2>艺术名家</h2>
</div>

<div class="course-nav-box wrapper m-b">



	<div class="course-nav-row clearfix">
	    <span class="hd l">艺术分类：</span>
	    <div class="bd">
	        <ul>
            

	          <?php if(!empty($output['yishuClass'])){?>

  
              <?php if(!empty($_GET['class'])){?>
                
                <li class="course-nav-item ">

                  <a class="category" href="<?php echo urlArtist('artist_new','searchArtist',  array('class'=>0,'address'=>$_GET['address'],'zhiwei'=>$_GET['zhiwei'],'keyword'=>$_GET['keyword']));?>"><i class="icon-close"></i><?php echo $output['yishuClass'][$_GET['class']]?></a>

                </li>

              <?php }else{?>

                <?php foreach ($output['yishuClass'] as $k => $v){?>

                  <li class="course-nav-item">
                      <a href="<?php echo urlArtist('artist_new','searchArtist',  array('class'=>$k,'address'=>$_GET['address'],'zhiwei'=>$_GET['zhiwei'],'keyword'=>$_GET['keyword']));?>"><?php echo $v;?></a>
                  </li>
                
                <?php }?>

              <?php }?>


            <?php }?>


	        </ul>
	    </div>
	</div>



	<div class="course-nav-row clearfix">
	    <span class="hd l">地区名家：</span>
	    <div class="bd">
	        <ul>

<?php if(!empty($output['address'])){?>

  <?php foreach ($output['address'] as $k => $v){?>

    <?php if(!empty($_GET['address'])){?>

      <?php if($_GET['address'] == $v['area_id']){?> 

        <li class="course-nav-item ">

          <a class="category" href="<?php echo urlArtist('artist_new','searchArtist',  array('class'=>$_GET['class'],'address'=>0,'zhiwei'=>$_GET['zhiwei'],'keyword'=>$_GET['keyword']));?>"><i class="icon-close"></i><?php echo $v['area_name'];?></a>

        </li>

      <?php }?>

    <?php }else{?>

        <li class="course-nav-item">
            <a href="<?php echo urlArtist('artist_new','searchArtist',  array('class'=>$_GET['class'],'address'=>$v['area_id'],'zhiwei'=>$_GET['zhiwei'],'keyword'=>$_GET['keyword']));?>"><?php echo $v['area_name'];?></a>
        </li>

    <?php }?>

  <?php }?>

<?php }?>
          
	        </ul>
	    </div>
	</div>	




	<div class="course-nav-row clearfix">
	    <span class="hd l">职<em></em>位：</span>
	    <div class="bd">
	        <ul>

<?php if(!empty($output['zhiwei'])){?>

  <?php foreach ($output['zhiwei'] as $k => $v){?>

    <?php if(!empty($_GET['zhiwei'])){?>

      <?php if($_GET['zhiwei'] == $v['P_Id']){?> 

        <li class="course-nav-item ">

          <a class="category" href="<?php echo urlArtist('artist_new','searchArtist',  array('class'=>$_GET['class'],'address'=>$_GET['address'],'zhiwei'=>0,'keyword'=>$_GET['keyword']));?>"><i class="icon-close"></i><?php echo $v['P_Name'];?></a>

        </li>

      <?php }?>

    <?php }else{?>

        <li class="course-nav-item">
          <a href="<?php echo urlArtist('artist_new','searchArtist', array('class'=>$_GET['class'],'address'=>$_GET['address'],'zhiwei'=>$v['P_Id'],'keyword'=>$_GET['keyword']));?>"><?php echo $v['P_Name'];?></a>
        </li>

    <?php }?>

  <?php }?>

<?php }?>

	        </ul>
	    </div>
	</div>	




    <div class="course-tool-bar clearfix">
    	<div class="tool-search">

			 <form action="<?php echo urlArtist('artist_new','searchArtist');?>" method="get">
        
        <input type="hidden" value="artist_new" id="artist_new" name="act">
        <input type="hidden" value="searchArtist" id="searchArtist" name="op">

        <input type="hidden" value="<?php echo $_GET['class'];?>" name="class">
        <input type="hidden" value="<?php echo $_GET['address'];?>" name="address">
        <input type="hidden" value="<?php echo $_GET['zhiwei'];?>" name="zhiwei">
				<input class="seek" type="text" value="<?php echo $_GET['keyword'];?>" name="keyword" placeholder="艺术家名">


				<i class="icon-key"></i>
				<input type="submit" value="搜索" id="button" class="input-submit btn-seek">

			</form>	

       </div>       
    </div>
    <h5 style="float: right;margin-top: 30px;color: #CEA66A;font-size: 14px;margin-left: 20px;margin-right: 32px;">共<?php echo $output['YiShuCount'];?>位艺术家</h5>
</div>
<!--
<div class="course-nav-hd wrapper mtb-course">
	<h2>默认排序</h2>
	<strong>按入驻时间排序</strong>
</div>
-->
<div class="wrapper mt10">
    <ul class="celebrity">

      <?php if(!empty($output['artist_list'])){?>
    
        <?php foreach ($output['artist_list'] as $k => $v) {?>

            <li>
              <a href="<?php echo urlArtist('artist_blog','index',array('aid'=>$v['A_Id']));?>" target="_blank">
                 <div class="celimg">
                 	<img src="<?php echo BASE_SITE_URL.'/'.$v['A_Img'];?>"/>
                 </div>
                 <h2><?php echo $v['A_Name'];?></h2>
              </a>
              <p><?php $zhi = explode('|',$v['A_ZhiCheng']);echo reset($zhi);?></p>
              <a href="JavaScript:void(0);" title="在线咨询" onclick="NTKF.im_openInPageChat('sc_1022_9999')"><i class="btn icon-chat"></i></a>
            </li>

          <?php }?>

      <?php }?>

    </ul>
    

    <div class="pagination ptb16">
      <?php echo $output['show_page'];?>
    </div>


</div>
