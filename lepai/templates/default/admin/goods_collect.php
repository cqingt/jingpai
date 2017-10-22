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
          <div class="title">回收站<a class="title-right" href="index.php?act=adminGoods&op=index">我的拍品</a></div>
<!--           <div class="me-list">
               <input class="me-name pleft10" type="text" name="" value="" placeholder='拍品名称'>
                      <div class='diy_select me-dro'>
                           <div class="select-text">
                              <input type='hidden' name='' id="c" class='diy_select_input' />
                              <div class='diy_select_txt'>--分类--</div>
                              <div class='diy_select_btn'></div>
                           </div>
                           <ul class='diy_select_list'>
                            <?php foreach($output['lepai_class'] as $k=>$v){?>
                            
                              <li id="select_goods(<?php echo $k;?>)"><?php echo $v;?></li>

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
                              <li>邮币卡</li>
                              <li>贵金属</li>
                              <li>书法字画</li>
                              <li>玉器珠宝</li>
                              <li>瓷器紫砂</li>
                              <li>红木文玩杂项</li>
                           </ul>
                      </div>
               <input class="but-query" type="button" name="" value="查询">
               <a class="but-issue"  href="index.php?act=adminGoods&op=goods_release">拍品发布</a>
          </div> -->


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
      <dd class="tow-line">送拍审核未通过<br><a href="JavaScript:;" data-reveal-id="myModal-no" data-animation="fade">查看原因</a></dd>
<?php }elseif($v['G_Atype'] == '3'){?>
      
      <?php if($v['G_Atype'] == '3' && $v['T_Shenghe'] == '1' && time() < $v['T_Ktime']){?>
      <dd class="tow-line">正在预展</dd>
      <?php }elseif($v['G_Atype'] == '3' && $v['T_Shenghe'] == '1' && time() > $v['T_Jtime']){?>
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
      <a class="edit-delete edit" href="index.php?act=adminGoods&op=moveGoods&id=<?php echo $v['G_Id'];?>">移回我的拍品</a>


   </div>

   <div class="info-dl2">
        <p>送拍专场：书画专场</p>
   </div>

  </div>
</li>
<?php }?>


          </ul>
          <div class="page_common mbottom68 mright26">
            <?php echo $output['page'];?>
          </div>

     </div>




<input type="hidden" name="goods_id" id="goods_id">



     <!-- reveal-modal Start -->
     <div id="myModal" class="reveal-modal modal-box70">
     <div class="content boxes">
          <div class="title">送拍报名</div>
          <div class="info mleft376">
               <h1>专场信息</h1>
               <ul>
                 <li class="li-info">开始时间</li>
                 <li class="li-info">结束时间</li>
                 <li>拍品数量</li>
                 <li class="li-info">操作</li>
               </ul>
          </div>
          <ul class="info-list">


<?php foreach($output['result_theme'] as $k=>$v){?>

<li>
  <div class="info-imag big-imag" ><a href=""><img src="<?php echo LEPAI_Images_URL.$v['T_Bottonimg'];?>" alt=""></a></div>
  <div class="info-boxes">
       <dl class="info-dl1 text-dl number-dd mtop16">
         <dt>
          <a href="">
            <?php echo $v['T_Title'];?>
          </a> 
         </dt>
         <dd class="tow-line"><?php echo date('Y-m-d h:i:s',$v['T_Ktime']);?></dd>
         <dd class="tow-line"><?php echo date('Y-m-d h:i:s',$v['T_Jtime']);?></dd>
         <dd><?php echo $v['T_Sum'];?>/<?php echo $v['T_Max'];?></dd>
       </dl>
       <div class="info-dl1 function mtop32 pleft16">
            <a class="give" href="Javascript:baoming(<?php echo $v['T_Id'];?>);">我要报名</a>
       </div>
  </div>
</li>

<?php }?>



          </ul>
          <div class="page_common mbottom68 mright26"><?php echo $output['page_theme'];?></div>
     </div>
            <a class="close-reveal-modal">&#215;</a>
     </div>
     <!-- reveal-modal End -->

     <!-- reveal-modal-no Start -->
     <div id="myModal-no" class="reveal-modal modal-box52">
            <h2>未通过原因</h2>
            <div class="reveal-text">
              <p>某某产品，未通过审核。</p>
              <p>原因：愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听愿意听。</p>
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
</script>