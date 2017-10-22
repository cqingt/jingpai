<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/hmtx.css" rel="stylesheet" type="text/css">
<style type="text/css">
.nc-appbar-tabs a.compare { display: none !important;}
</style>


<!--筛选条件-start-->
<div class="w1210_hmtx sxtj_hmtx">
     <div class="sub_title">筛选料件</div>
     <div class="category" id="category">
        <dl>
        <dt>名家：</dt>
        <dd>
        <ul> 
                <li><a href="/shop/index.php?act=artist&op=list&idname=&id_14=<?php echo $_GET['id_14']?>&id_15=<?php echo $_GET['id_15']?>&id_16=<?php echo $_GET['id_16']?>"  <?php if($_GET['idname'] == ''){echo "class='curr'";}?>>不限</a></li> 
                <?php if(is_array($output['result_name'])){?>
                <?php foreach($output['result_name'] as $k=>$v){?>
                <li><a href="/shop/index.php?act=artist&op=list&idname=<?php echo $v['A_Id']?>&id_14=<?php echo $_GET['id_14']?>&id_15=<?php echo $_GET['id_15']?>&id_16=<?php echo $_GET['id_16']?>"  <?php if($_GET['idname'] == $v['A_Id']){echo "class='curr'";}?>><?php echo $v['A_Name'];?></a></li> 
                <?php }}?>

                </ul>
            </dd>
        </dl>

        <dl>
        <dt>环境：</dt>
        <dd>
        <ul> 
                <li><a href="/shop/index.php?act=artist&op=list&idname=<?php echo $_GET['idname']?>&id_14=&id_15=<?php echo $_GET['id_15']?>&id_16=<?php echo $_GET['id_16']?>"  <?php if($_GET['id_14'] == ''){echo "class='curr'";}?>>不限</a></li> 
                <?php if(is_array($output['result_14'])){?>
                <?php foreach($output['result_14'] as $k=>$v){?>
                <li><a href="/shop/index.php?act=artist&op=list&idname=<?php echo $_GET['idname']?>&id_14=<?php echo $v['attr_value_id']?>&id_15=<?php echo $_GET['id_15']?>&id_16=<?php echo $_GET['id_16']?>" <?php if($_GET['id_14'] == $v['attr_value_id']){echo "class='curr'";}?>><?php echo $v['attr_value_name'];?></a></li> 
                <?php }}?>
                </ul>
            </dd>
        </dl>
                
        <dl>
        <dt>形制：</dt>
        <dd>
        <ul> 
                <li><a href="/shop/index.php?act=artist&op=list&idname=<?php echo $_GET['idname']?>&id_14=<?php echo $_GET['id_14']?>&id_15=<?php echo $_GET['id_15']?>&id_16="  <?php if($_GET['id_16'] == ''){echo "class='curr'";}?>>不限</a></li> 
                <?php if(is_array($output['result_16'])){?>
                <?php foreach($output['result_16'] as $k=>$v){?>
                <li><a href="/shop/index.php?act=artist&op=list&idname=<?php echo $_GET['idname']?>&id_14=<?php echo $_GET['id_14']?>&id_15=<?php echo $_GET['id_15']?>&id_16=<?php echo $v['attr_value_id']?>" <?php if($_GET['id_16'] == $v['attr_value_id']){echo "class='curr'";}?>><?php echo $v['attr_value_name'];?></a></li> 
                <?php }}?> 

                </ul>
            </dd>
        </dl>
                
        <dl>
        <dt>职位：</dt>
        <dd>
        <ul> 
                <li><a href="/shop/index.php?act=artist&op=list&idname=<?php echo $_GET['idname']?>&id_14=<?php echo $_GET['id_14']?>&id_15=&id_16=<?php echo $_GET['id_16']?>"  <?php if($_GET['id_15'] == ''){echo "class='curr'";}?>>不限</a></li> 
                <?php if(is_array($output['result_15'])){?>
                <?php foreach($output['result_15'] as $k=>$v){?>
                <li><a href="/shop/index.php?act=artist&op=list&idname=<?php echo $_GET['idname']?>&id_14=<?php echo $_GET['id_14']?>&id_15=<?php echo $v['attr_value_id']?>&id_16=<?php echo $_GET['id_16']?>" <?php if($_GET['id_15'] == $v['attr_value_id']){echo "class='curr'";}?>><?php echo $v['attr_value_name'];?></a></li> 
                <?php }}?> 

                </ul>
            </dd>
        </dl>
                
                
      </div>
</div>
<!--筛选条件-end-->

<!--产品列表-start-->
<div class="w1210_hmtx prolist_hmtx">
     <div class="prolist_title_hmtx">
          <div class="fl">
          <a href="/shop/index.php?act=artist&op=list&idname=<?php echo $_GET['idname']?>&id_14=<?php echo $_GET['id_14']?>&id_15=&id_16=<?php echo $_GET['id_16']?>" <?php if(!$_GET['time'] && !$_GET['click'] && !$_GET['money'] && !$_GET['sa']){echo "class='hovera'";}?>>默认排序</a>
          <a href="/shop/index.php?act=artist&op=list&idname=<?php echo $_GET['idname']?>&id_14=<?php echo $_GET['id_14']?>&id_15=&id_16=<?php echo $_GET['id_16']?>&time=1" <?php if($_GET['time']){echo "class='hovera'";}?>>上架时间</a>
          <a href="/shop/index.php?act=artist&op=list&idname=<?php echo $_GET['idname']?>&id_14=<?php echo $_GET['id_14']?>&id_15=&id_16=<?php echo $_GET['id_16']?>&click=1" <?php if($_GET['click']){echo "class='hovera'";}?>>热度</a>
          <a href="/shop/index.php?act=artist&op=list&idname=<?php echo $_GET['idname']?>&id_14=<?php echo $_GET['id_14']?>&id_15=&id_16=<?php echo $_GET['id_16']?>&money=1" <?php if($_GET['money']){echo "class='hovera'";}?>>价格</a>
          <a href="/shop/index.php?act=artist&op=list&idname=<?php echo $_GET['idname']?>&id_14=<?php echo $_GET['id_14']?>&id_15=&id_16=<?php echo $_GET['id_16']?>&sa=1" <?php if($_GET['sa']){echo "class='hovera'";}?>>销量</a>
          </div>

          <div class="fy">
          <span>共<i><?php echo $output['goods_max']['goods_max'];?></i>副作品</span>
          <span class="s1"><a href="#" class="hovera"><?php if($_GET['curpage']){echo $_GET['curpage'];}else{echo "1";}?></a>/<a href="#"><?php echo intval($output['goods_max']['goods_max']/35);?></a></span>
          <?php echo $output['page_1'];?>
          </div> 

     </div>
     
     <div class="list">
        <ul>

<?php foreach($output['result'] as $k=>$v){?>
          <li>
          <div class="product"><a href="index.php?act=goods&op=index&goods_id=<?php echo $v['goods_id'];?>" target="_blank"><img src="<?php echo cthumb($v['goods_image']);?>" /></a></div>
          <div class="name"><a href="index.php?act=goods&op=index&goods_id=<?php echo $v['goods_id'];?>" target="_blank"><?php echo $v['goods_name'];?></a></div>
          <div class="price">￥<strong><?php echo $v['goods_price'];?></strong></div>
          </li>
<?php }?>

        </ul>
     </div>
     

     <div class="page">
     <?php echo $output['page'];?>
     </div>
     <!--page-end-->
</div>
<!--产品列表-end-->