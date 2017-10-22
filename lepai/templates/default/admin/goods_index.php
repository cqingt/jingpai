<!-- wrapper start-->
<div class="wrapper">

     <div class="guide box">
          <span>
              <a href="index.php?act=adminIndex&op=index">首页</a>
          </span>
          <a href="">
             <code>></code><i>拍品管理</i>
          </a>
     </div>

     <div class="content boxes mtop25">
          <div class="title">我的拍品<a class="title-right" href="index.php?act=adminGoods&op=collect">回收站</a></div>

<form action="index.php?act=adminGoods&op=index" method="get">

          <div class="me-list">
               <input class="me-name pleft10" type="text" id="search" name="search" value="" placeholder='拍品名称'>

<input type="hidden" name="select_one_goods" id="select_one_goods">
<input type="hidden" name="select_two_goods" id="select_two_goods">
                      <div class='diy_select me-dro'>
                           <div class="select-text">
                              <input type='hidden' name='' id="c" class='diy_select_input' />
                              <div class='diy_select_txt'>--分类--</div>
                              <div class='diy_select_btn'></div>
                           </div>
                           <ul class='diy_select_list'>
                            <?php foreach($output['lepai_class'] as $k=>$v){?>
                            
                              <li id="select_one_goods" onmousemove="select_goods('select_one_goods',<?php echo $v['C_Id'];?>)"><?php echo $v['C_Name'];?></li>

                              <?php }?>
                           </ul>
                      </div>



                      <div class='diy_select me-dro'>
                           <div class="select-text">
                              <input type='hidden' name='' id="c" class='diy_select_input' />
                              <div class='diy_select_txt'>--状态--</div>
                              <div class='diy_select_btn'></div>
                           </div>
                           <ul class='diy_select_list'>
                              <?php foreach(C('lepai_goodstype') as $k=>$v){?>
                            
                              <li id="select_two_goods" onmousemove="select_goods('select_two_goods',<?php echo $k;?>)"><?php echo $v;?></li>

                              <?php }?>
                           </ul>
                      </div>
               <input class="but-query" type="button" onclick="pushSearch();" name="" value="查询">
               <a class="but-issue"  href="index.php?act=adminGoods&op=goods_release">拍品发布</a>
          </div>


</form>


          <div class="info info-flet">
               <h1>拍品信息</h1>
               <ul>
                 <li class="li-info">起拍价</li>
                 <li class="li-info">加价幅度</li>
                 <li class="li-info">保证金</li>
                 <li class="li-info">保留价</li>
                 <li class="li-info">状态</li>
                 <li class="li-info">操作</li>
               </ul>
          </div>

          <ul class="info-list">


<?php foreach($output['result'] as $k=>$v){?>
<li>
  <div class="info-imag small-imag" ><a href=""><img src="<?php echo LEPAI_Images_URL.$v['G_MainImg'];?>" alt=""></a></div>
  <div class="info-boxes">
   <dl class="info-dl1 text-dl number-dd mtop8">
     <dt>
      <a href="">
        <?php echo $v['G_Name'];?>
      </a> 
     </dt>
     <dd>￥<?php echo $v['G_Qipai'];?></dd>
     <dd>￥<?php echo $v['G_IncMoney'];?></dd>
     <dd>￥<?php echo $v['G_BaoZhenMoney'];?></dd>
     <dd>￥<?php echo $v['G_BaoliuMoney'];?></dd>
<?php if($v['G_Atype'] == '0'){?>
      <dd class="tow-line">未送拍</dd>
<?php }elseif($v['G_Atype'] == '1'){?>
      <dd class="tow-line">已送拍,审核中</dd>
<?php }elseif($v['G_Atype'] == '2'){?>
      <dd class="tow-line">送拍审核未通过<br><a href="JavaScript:;" data-reveal-id="myModal-no" data-lose-id="<?php echo $v['G_Lose'];?>" data-animation="fade">查看原因</a></dd>
<?php }elseif($v['G_Atype'] == '3'){?>
      
      <?php if($v['G_Atype'] == '3' && $v['T_Shenghe'] == '1' && time() < $v['T_Ktime'] && $v['T_Iswin'] == '1'){?>
      <dd class="tow-line">正在预展</dd>
      <?php }elseif($v['G_Atype'] == '3' && $v['T_Shenghe'] == '1' && time() > $v['T_Ktime'] && time() < $v['T_Jtime']  && $v['T_Iswin'] == '1'){?>
      <dd class="tow-line">正在拍卖</dd>
      <?php }else{?>
      <dd class="tow-line">送拍审核已通过</dd>
      <?php }?>

<?php }elseif($v['G_Atype'] == '6'){?>
      <dd class="tow-line">竞拍成功</dd>
<?php }elseif($v['G_Atype'] == '7'){?>
      <dd class="tow-line">流拍</dd>

<?php }?>
   </dl>
   <div class="info-dl1 function mtop13 pleft24"> 
<?php if($v['G_Atype'] == '0'){?>
      <a class="give" href="JavaScript:open3(<?php echo $v['G_Id'];?>);" >我要送拍</a>
      <a class="edit-delete edit" href="index.php?act=adminGoods&op=upGoods&gid=<?php echo $v['G_Id'];?>">编辑</a>
      <a class="edit-delete" href="index.php?act=adminGoods&op=goods_delete&id=<?php echo $v['G_Id'];?>">删除</a>
<?php }elseif($v['G_Atype'] == '1'){?>
      <a class="give" href="index.php?act=adminGoods&op=delThemeGoods&goodsid=<?php echo $v['G_Id'];?>&themeid=<?php echo $v['T_Id'];?>">取消送拍</a>
      <!-- <a class="edit-delete edit" href="index.php?act=adminGoods&op=upGoods&gid=<?php echo $v['G_Id'];?>">编辑</a> -->
<?php }elseif($v['G_Atype'] == '2'){?>
      <a class="give" href="JavaScript:open3(<?php echo $v['G_Id'];?>);" >我要送拍</a>
      <a class="edit-delete edit" href="index.php?act=adminGoods&op=upGoods&gid=<?php echo $v['G_Id'];?>">编辑</a>
      <a class="edit-delete" href="index.php?act=adminGoods&op=goods_delete&id=<?php echo $v['G_Id'];?>">删除</a>
<?php }elseif($v['G_Atype'] == '3'){?>
      
      <?php if($v['G_Atype'] == '3' && $v['T_Shenghe'] == '1' && time() < $v['T_Ktime']){?>
      <a class="edit-delete edit">不可操作</a>
      <?php }elseif($v['G_Atype'] == '3' && $v['T_Shenghe'] == '1' && time() > $v['T_Ktime'] && time() < $v['T_Jtime']){?>
      <a class="edit-delete edit">不可操作</a>
      <?php }else{?>
      <a class="give" href="index.php?act=adminGoods&op=delThemeGoods&goodsid=<?php echo $v['G_Id'];?>&themeid=<?php echo $v['T_Id'];?>" >取消送拍</a>
      <?php }?>

<?php }elseif($v['G_Atype'] == '6'){?>
      <!--<a class="edit-delete edit" href="">查看订单</a>-->
<?php }elseif($v['G_Atype'] == '7'){?>
      <a class="edit-delete edit" href="index.php?act=adminGoods&op=upGoods&gid=<?php echo $v['G_Id'];?>">编辑</a>
<?php }?>
  





   </div>

   <div class="info-dl2">
    <?php if($v['T_Title']){?>
        <p>送拍专场：<?php echo $v['T_Title'];?></p>
    <?php }?>
   </div>

  </div>
</li>
<?php }?>


          </ul>
          <div class="page_common mbottom68 mright26">
            <?php echo $output['page'];?>
          </div>

     </div>





     <!-- reveal-modal-no Start -->
     <div id="myModal-no" class="reveal-modal modal-box52">
            <h2>未通过原因</h2>
            <div class="reveal-text">
              未通过原因：<p id="losetext">愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听。</p>
            </div>
            <a class="close-reveal-modal color-fff">&#215;</a>
     </div>
     <!-- reveal-modal End -->

</div>
<!-- wrapper end-->

<script>
  function baoming(tid){
    var gid = $("#goods_id").val();
    if(confirm("确定要报名该专场吗？")){
      window.location.href="index.php?act=adminGoods&op=doThemeGoods&themeid="+tid+"&goodsid="+gid;
    }
  }

    function open3(id)
  {
    var diag = new Dialog();
    diag.Width = 1000;
    diag.Height = 450;
    diag.Title = "送拍报名";
    diag.URL = "index.php?act=adminGoods&op=add_goods&themeid="+id;
    diag.show();
  }

  function select_goods(id,v){
    $("#"+id).val(v);
  }

  function pushSearch(){
    var s = $("#search").val();
    var t = $("#select_one_goods").val();
    var y = $("#select_two_goods").val();
    window.location.href="index.php?act=adminGoods&op=index&search=" + s + "&s_one=" + t + "&s_two=" + y;
  }

</script>

