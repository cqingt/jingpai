  <link href="<?php echo LEPAI_CSS_URL;?>/css/admin/common.css" rel="stylesheet">
  <script src="<?php echo LEPAI_JS_URL;?>/js/lepai_admin/jquery-1.9.1.js"></script>
  <script src="<?php echo LEPAI_JS_URL;?>/js/lepai_admin/date.js"></script>
  <script src="<?php echo LEPAI_JS_URL;?>/js/lepai_admin/iscroll.js"></script>
  <script src="<?php echo LEPAI_JS_URL;?>/js/lepai_admin/jquery.form.js"></script>


<script type="text/javascript">
$(function(){
  $('#beginTime').date({theme:"datetime"});
  $('#endTime').date({theme:"datetime"});



});
</script>

<!-- wrapper start-->
  <div class="wrapper">

       <div class="guide box">
            <span>
                <a href="index.php?act=adminIndex&op=index">首页</a>
            </span>
            <a href="ndex.php?act=adminTheme&op=index">
               <code>></code><i>专场管理</i>
            </a>
            <a href="index.php?act=adminTheme&op=index">
               <code>></code><i>我的拍卖专场</i>
            </a>
            <a href="">
               <code>></code><i>专场创建</i>
            </a>
       </div>

       <div class="content boxes mtop25">
            <div class="title">专场创建</div>
            <div class="article">
                 <form action="index.php?act=adminTheme&op=do_add" method="POST">
                 <div class="overflow issue has-name">
                      <label>专场标题</label>
                      <input required="required" name="T_Title" type="text" class="overflow issue-input" value="" placeholder="请输入专场标题">
                 </div>
                 <div class="overflow issue has-name">
                      <label>拍品数量</label>
                      <input onkeyup="if(/\D/.test(this.value)){this.value='';}" required="required" name="T_Max" type="text" class="overflow issue-input" value="" placeholder="请输入拍品数量">
                 </div>
                 <div class="issue has-number number-date">
                       <label>开始时间</label>
                       <input required="required" id="beginTime" name="T_Ktime" type="textarea" class="overflow issue-input" value="">
                       <span class=""><a></a></span>
                       <span class="describe-red">请选择3天（72小时）之后的时间作为开始时间</span>
                 </div>
                 <div class="issue has-number number-date">
                       <label>结束时间</label>
                       <input required="required" id="endTime" name="T_Jtime" type="textarea" class="overflow issue-input" value="">
                       <span class=""><a></a></span>
                       <span class="describe-red">拍卖专场最长时间不超过3天（72小时）</span>
                 </div>
                 <div class="overflow issue has-cover">
                       <label>banner图</label>
                       <strong>
                       尺寸：1440px*320px，小于1m，显示在拍卖专场顶部
                       </strong>
                      <div class="cover-banner" id="divimg1" style="background-size:570px 125px;width:570px;background-image: url(<?php echo LEPAI_CSS_URL;?>/images/admin/img3.jpg)">
                        <input required="required" onchange="uploadImg('imgPhonto','divimg1','T_Topimg');" type="file" id="imgPhonto" name="imgPhonto"  style="width:570px;height:200px;opacity: 0;"  />
                        <input type="hidden" id="T_Topimg" name="T_Topimg" value="">
                      </div>
                 </div>
                 <div class="overflow issue has-cover">
                       <label>首 焦 图</label>
                       <strong>
                       尺寸：474px*230px，小于1m，显示在拍卖专场列表页
                       </strong>
                      <div class="cover-banner" id="divimg2" style="background-size:300px 130px;width:300px;background-image: url(<?php echo LEPAI_CSS_URL;?>/images/admin/img3.jpg)">
                        <input required="required" onchange="uploadImg('imgPhonto1','divimg2','T_Bottonimg');" type="file" id="imgPhonto1" name="imgPhonto"  style="width:300px;height:130px;opacity: 0;"  />
                        <input type="hidden" id="T_Bottonimg" name="T_Bottonimg" value="">
                      </div>
                  </div>
                 <div class="overflow issue has-describe">
                       <label>专场描述</label>
                       <!-- <textarea required="required" name="T_Content" id="T_Content" cols="" rows="" placeholder="请输入专场的描述"></textarea> -->
                       <?php showEditor('T_Content','','100%','480px','visibility:hidden;',"true");?></td>
                 </div>
                 <div class="overflow issue-gobtn"><input type="submit" class="go-btn" value="确认提交"></div>
                 
                 </form>
            </div>
       </div>
  </div>


        <!-- wrapper end-->
<div id="datePlugin"></div>


<script>
  function uploadImg(pid,id,vid){
    var data = new FormData();
    $.each($('#' + pid )[0].files, function(i, file){
      data.append('imgPhonto', file);
    })
    $.ajax({
        url:"index.php?act=adminTheme&op=ajaxUpload",
        type:"POST",
        data:data,
        dataType:'json',
        cache:false,
        contentType:false,
        processData:false,
        success:function(data){
          var u = "<?php echo LEPAI_Images_URL;?>";
          $("#" + id ).css("background-image","url(" + u + data +")");
          $("#" + vid ).val(data);
        }
    });

}

</script>


