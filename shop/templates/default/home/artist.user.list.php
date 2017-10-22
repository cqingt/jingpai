<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/hmtx.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/public.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/hmtx.css" rel="stylesheet" type="text/css">
<style type="text/css">
.nc-appbar-tabs a.compare { display: none !important;}
</style>





<!--当前位置-start-->
<div class="w1210_hmtx subposition_hmtx"><a href="#">首页</a> > 名家列表</div>
<!--当前位置-end-->

<!--筛选条件-start-->
<div class="w1210_hmtx sxtj_hmtx">
     <div class="sub_title">筛选料件</div>
     <div class="category" id="category">
        <dl>
        <dt>分类：</dt>
        <dd>
        <ul> 
                <li><a <?php if(empty($_GET['class'])){echo "class='curr'";}?> href="index.php?act=artist&op=artistList&search=<?php echo $_GET['search'];?>&class=&position=<?php echo $_GET['position'];?>&jiguan=<?php echo $_GET['jiguan'];?>">不限</a></li> 
                <?php foreach($output['listWhere']['class'] as $k => $v){?>
                  <li><a <?php if($k == $_GET['class']){echo "class='curr'";}?> href="index.php?act=artist&op=artistList&search=<?php echo $_GET['search'];?>&class=<?php echo $k;?>&position=<?php echo $_GET['position'];?>&jiguan=<?php echo $_GET['jiguan'];?>"><?php echo $v;?></a></li> 
                <?php }?>
                </ul>
            </dd>
        </dl>
                
                <dl>
        <dt>职位：</dt>
        <dd>
        <ul> 
                <li><a  <?php if(empty($_GET['position'])){echo "class='curr'";}?> href="index.php?act=artist&op=artistList&search=<?php echo $_GET['search'];?>&class=<?php echo $_GET['class'];?>&position=&jiguan=<?php echo $_GET['jiguan'];?>" >不限</a></li> 

                <?php foreach($output['listWhere']['position'] as $k => $v){?>
                  <li><a  <?php if($v['P_Id'] == $_GET['position']){echo "class='curr'";}?> href="index.php?act=artist&op=artistList&search=<?php echo $_GET['search'];?>&class=<?php echo $_GET['class'];?>&position=<?php echo $v['P_Id'];?>&jiguan=<?php echo $_GET['jiguan'];?>"><?php echo $v['P_Name'];?></a></li> 
                <?php }?>

                </ul>
            </dd>
        </dl>
                
                <dl>
        <dt>籍贯：</dt>
        <dd>
        <ul> 
                <li><a <?php if(empty($_GET['jiguan'])){echo "class='curr'";}?> href="index.php?act=artist&op=artistList&search=<?php echo $_GET['search'];?>&class=<?php echo $_GET['class'];?>&position=<?php echo $_GET['position'];?>&jiguan=" >不限</a></li> 

                <?php foreach($output['listWhere']['shi'] as $k => $v){?>
                  <li><a <?php if($v['area_id'] == $_GET['jiguan']){echo "class='curr'";}?> href="index.php?act=artist&op=artistList&search=<?php echo $_GET['search'];?>&class=<?php echo $_GET['class'];?>&position=<?php echo $_GET['position'];?>&jiguan=<?php echo $v['area_id'];?>"><?php echo $v['area_name'];?></a></li> 
                <?php }?>

                </ul>
            </dd>
        </dl>

        <form action="index.php?act=artist&op=artistList" method="get">
<input type="hidden" name="act" value="artist">
<input type="hidden" name="op" value="artistList">
<input type="hidden" name="class" value="<?php echo $_GET['class'];?>">
<input type="hidden" name="position" value="<?php echo $_GET['position'];?>">
<input type="hidden" name="jiguan" value="<?php echo $_GET['jiguan'];?>">



                <div class="djh_draw_search">
                    <span class="fl"><input name="" type="radio" value="" checked="checked" /> 艺术家名</span>
                  <span style="border:1px solid #d3d2d2; border-right:0px;"><input class="search_input" name="search" type="text" /></span>
                    <span style="border:1px solid #d3d2d2; border-left:0px;"><input class="search_btn" name="" type="submit" style="" value="搜索" /></span>
                </div>

        </form>
                
      </div>
</div>
<!--筛选条件-end-->

<!--产品列表-start-->
<div class="w1210_hmtx prolist_hmtx">
     <div class="prolist_title_hmtx">
          <div class="fl">
          <a href="index.php?act=artist&op=artistList" <?php if(!$_GET['otime'] && !$_GET['order']){echo "class='hovera'";}?>>默认排序</a>
          <a href="index.php?act=artist&op=artistList&otime=1" <?php if($_GET['otime']){echo "class='hovera'";}?>>作品更新</a>
          <a href="index.php?act=artist&op=artistList&order=1" <?php if($_GET['order']){echo "class='hovera'";}?>>最新加入</a>
          </div>
          <div class="fy">
          <span>共<i><?php echo $output['max']['0']['Max'];?></i>位艺术家</span>
          <span class="s1"><a href="#" class="hovera"><?php if($_GET['curpage']){echo $_GET['curpage'];}else{echo '1';}?></a>/<a href="#"><?php echo intval($output['max']['0']['Max']/10);?></a></span>
          <?php echo $output['page_6'];?>
          </div> 
     </div>
     
     <div class="mj_list">


<?php foreach($output['artist_list'] as $k => $v){?>

          <dl>
             <dt>
                 <div class="bt"><?php echo $v['A_Name'];?><span>官方网站</span></div>
                 <div class="mj_xx">
                    <img src="<?php echo '/'.$v['A_Img'];?>" width="110" height="128" alt="" style="float:left;" />
                    <ul>
                        <li class="li42">籍贯：</li><li class="li200">湖南湘潭</li>
                    </ul>
                    <ul>
                        <li class="li42">职位：</li><li class="li200"><?php echo $v['A_ZhiCheng']['0'];?></li>
                    </ul>
                    <ul>
                        <li class="li42">&nbsp;</li><li class="li200"><?php echo $v['A_ZhiCheng']['1'];?></li>
                    </ul>
                    <ul>
                        <li class="li42">类别：</li><li class="li200"><?php echo $output['listWhere']['class'][$v['A_Class']];?></li>
                    </ul>
                    <ul>
                        <li class="li42">润格：</li><li class="li200"><span><?php echo $v['A_Money'];?></span>元/平尺</li>
                    </ul>
                 </div>
             </dt>

             <dd>
                 <ul>

                  <?php foreach($v['A_Goods'] as $k => $vv){?>

                     <li>
                        <a href="index.php?act=goods&op=index&goods_id=<?php echo $vv['goods_id'];?>" target="_blank"><img src="<?php echo cthumb($vv['goods_image']);?>" width="140" height="140" alt="" /></a>
                        <a href="index.php?act=goods&op=index&goods_id=<?php echo $vv['goods_id'];?>" target="_blank"><?php echo $vv['goods_name'];?></a> 
                     </li>

                  <?php }?>

                     <li style="margin-left:10px; margin-top:10px; float:right;">
                        <a href="index.php?act=artist&op=index&artist_id=<?php echo $v['A_Id'];?>" target="_blank" class="btn"></a>
                     </li>
                 </ul>
             </dd>

        </dl>

        <?php }?>





     </div>
     
     <!--page-start-->
     <div class="page" >
     <?php echo $output['page'];?>
     </div>
     <!--page-end-->
</div>
<!--产品列表-end-->