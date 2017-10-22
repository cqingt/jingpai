<!-- wrapper start-->
<div class="wrapper">

     <div class="guide box">
          <span>
              <a href="index.php?act=adminIndex&op=index">首页</a>
          </span>
          <a href="">
             <code>></code><i>送拍报名</i>
          </a>
     </div>

     <div class="content boxes mtop25">
          <div class="title">可报名拍卖专场</div>
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
          <a class="give"  href="JavaScript:open3(<?php echo $v['T_Id'];?>);">我要报名</a>
       </div>
  </div>
</li>

<?php }?>



          </ul>








          <div class="page_common mbottom68 mright26">
            <?php echo $output['page_theme'];?>
          </div>
     </div>



</div>
<!-- wrapper end-->
<script>
    function open3(id)
  {
    var diag = new Dialog();
    diag.Width = 1000;
    diag.Height = 450;
    diag.Title = "送拍报名";
    diag.URL = "index.php?act=adminReport&op=add_goods&themeid="+id;
    diag.show();
  }
</script>