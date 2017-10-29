<!-- wrapper start-->
<div class="wrapper">

     <div class="guide box">
          <span>
              <a href="index.php?act=adminIndex&op=index">首页</a>
          </span>
          <a href="index.php?act=adminTheme&op=index">
             <code>></code><i>专场管理</i>
          </a>
          <a href="">
             <code>></code><i>我的拍卖专场</i>
          </a>
     </div>


     <div class="content boxes mtop25">
          <div class="title">我的拍卖专场</div>
          <div class="me-list">
            <form id="form1" action="index.php?act=adminTheme&op=index" method="get">
               <input class="me-name pleft10" type="text" id="search" name="search" value="" placeholder='专场标题'>
               <input type="hidden" name="select_goods_input" id="select_goods_input" value="">
               <div class='diy_select'>
                   <div class="select-text">
                      <input type='hidden' name='' id="b" class='diy_select_input' />

                      <div class='diy_select_txt'>所有状态</div>
                      <div class='diy_select_btn'></div>
                   </div>
                   <ul class='diy_select_list'>

                    <?php foreach(C('lepai_themetype') as $k=>$v){?>
                       <li onmousemove="select_goods(<?php echo $k;?>)"><?php echo $v;?></li> 
                    <?php }?>

                   </ul>
              </div>
               <input style="margin-left:10px;" class="but-query" type="button" id="sel" name="sel" value="查询">
            </form>
               <a class="but-issue"  href="index.php?act=adminTheme&op=theme_add">创建专场</a>
          </div>
          <div class="info mleft376">
               <h1>专场信息</h1>
               <ul>
                 <li class="li-info">开始时间</li>
                 <li class="li-info">结束时间</li>
                 <li>拍品数量</li>
                 <li class="li-info">状态</li>
                 <li class="li-info">操作</li>
               </ul>
          </div>
          <ul class="info-list">

<?php foreach($output['result'] as $k=>$v){?>
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


<?php if($v['T_Tisheng'] == '0'){?>

    <dd>未提审</dd>

<?php }elseif($v['T_Tisheng'] == '1' && $v['T_Shenghe'] == '0' && $v['T_Iswin'] == '0' ){?>

    <dd>审核中</dd>

<?php }elseif($v['T_Tisheng'] == '1' && $v['T_Shenghe'] == '1' && $v['T_Iswin'] == '0' ){?>

    <dd>已通过</dd>

<?php }elseif($v['T_Tisheng'] == '1' && $v['T_Shenghe'] == '2' && $v['T_Iswin'] == '0' ){?>

    <dd>审核未通过<br>
    
    <a href="JavaScript:;" data-reveal-id="myModal-no" data-lose-id="<?php echo $v['T_Lose'];?>" data-animation="fade">查看原因</a></dd>

<?php }elseif($v['T_Tisheng'] == '1' && $v['T_Shenghe'] == '1' && $v['T_Iswin'] == '1' && time() <= $v['T_Ktime']){?>

    <dd>正在预展</dd>

<?php }elseif($v['T_Tisheng'] == '1' && $v['T_Shenghe'] == '1' && $v['T_Iswin'] == '1' && time() >= $v['T_Ktime'] && time() <= $v['T_Jtime']){?>

    <dd>正在拍卖</dd>

<?php }elseif($v['T_Tisheng'] == '1' && $v['T_Shenghe'] == '1' && $v['T_Iswin'] == '1' && time() >= $v['T_Jtime']){?>

    <dd>已结束</dd>

<?php }else{?>

    <dd>未提审</dd>

<?php }?>

                         
                       </dl>
                       <div class="info-dl1 function mtop13 pleft40"> 

<?php if($v['T_Tisheng'] == '0'){?>

  <a class="give" href="index.php?act=adminTheme&op=push_tisheng&type=1&id=<?php echo $v['T_Id'];?>">提交审核</a>
  <a class="edit-add" href="index.php?act=adminTheme&op=theme_update&id=<?php echo $v['T_Id'];?>">编辑</a>
  <a class="edit-add add" href="JavaScript:open3(<?php echo $v['T_Id'];?>);" )>添加拍品</a>

<?php }elseif($v['T_Tisheng'] == '1' && $v['T_Shenghe'] == '0' && $v['T_Iswin'] == '0' ){?>

  <a class="give" href="JavaScript:del_ti(<?php echo $v['T_Id'];?>);">取消提审</a>

<?php }elseif($v['T_Tisheng'] == '1' && $v['T_Shenghe'] == '1' && $v['T_Iswin'] == '0' ){?>

  <a class="give" href="JavaScript:del_ti(<?php echo $v['T_Id'];?>);">取消提审</a>
    <a class="edit-add add" href="JavaScript:open3(<?php echo $v['T_Id'];?>);" )>添加拍品</a>
<?php }elseif($v['T_Tisheng'] == '1' && $v['T_Shenghe'] == '2' && $v['T_Iswin'] == '0' ){?>

  <a class="give" href="index.php?act=adminTheme&op=push_tisheng&type=1&id=<?php echo $v['T_Id'];?>">提交审核</a>
  <a class="edit-add" href="index.php?act=adminTheme&op=theme_update&id=<?php echo $v['T_Id'];?>">编辑</a>
  <a class="edit-add add" href="JavaScript:open3(<?php echo $v['T_Id'];?>);" >添加拍品</a>

<?php }elseif($v['T_Tisheng'] == '1' && $v['T_Shenghe'] == '1' && $v['T_Iswin'] == '1' && time() <= $v['T_Ktime']){?>

    <a class="edit-add add" href="JavaScript:open3(<?php echo $v['T_Id'];?>);" )>添加拍品</a>

<?php }elseif($v['T_Tisheng'] == '1' && $v['T_Shenghe'] == '1' && $v['T_Iswin'] == '1' && time() >= $v['T_Ktime'] && time() <= $v['T_Jtime']){?>

    <a class="edit-add add" href="JavaScript:open3(<?php echo $v['T_Id'];?>);" )>添加拍品</a>

<?php }elseif($v['T_Tisheng'] == '1' && $v['T_Shenghe'] == '1' && $v['T_Iswin'] == '1' && time() >= $v['T_Jtime']){?>

    <dd>不可操作</dd>

<?php }else{?>

    <dd>不可操作</dd>

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
  $("#sel").click(function(){
    var v = $("#search").val();
    var s = $("#select_goods_input").val();
    window.location.href="index.php?act=adminTheme&op=index&search=" + v + "&select_goods_input=" + s;
  })





  function del_ti(id){
    if(confirm("确定要取消提审吗？")){
      window.location.href="index.php?act=adminTheme&op=del_tisheng&id="+id;
    }
  }

  function select_goods(id){
    $("#select_goods_input").val(id);
  }


  function open3(id)
  {
    var diag = new Dialog();
    diag.Width = 1000;
    diag.Height = 450;
    diag.Title = "送拍报名";
    diag.URL = "index.php?act=adminTheme&op=add_goods&themeid="+id;
    diag.show();
  }

</script>