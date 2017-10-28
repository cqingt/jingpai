<?php /* Smarty version 2.6.26, created on 2016-03-31 17:19:40
         compiled from manage/user/user_list.html */ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <metahttp-equivmetahttp-equiv="x-ua-compatible"content="IE=7"/> 
    <title>模板消息发送列表</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"> 
    <link rel="stylesheet" href="static/css/bootstrap.css">
    <link rel="stylesheet" href="static/css/hello.css">
    <link rel="stylesheet" href="static/css/plugin.css">
    <!--[if lt IE 9]>
      <script src="js/ie/respond.min.js"></script>
      <script src="js/ie/html5.js"></script>
    <![endif]-->
</head>
<body>
<section class="dominate padder">
  <div class="row">
    <div class="col-lg-12">
      <section class="panelling clearfix m-t-large m-b">
        <div class="text-left">
          <p class="inf">模板消息群发</p>
        </div>
      </section>
    </div>
    <div class="col-lg-12">

  <form id="form1" name="form1" method="get" action="index.php">
    <input type="hidden" name="m" id="m" value="manageUser"/>
    <input type="hidden" name="p" id="p" value="manage"/>
    <input type="hidden" name="c" id="c" value="index"/>


      <section class="panelform clearfix">
        <div class="text-left">
          <div class="col-lg-40">

            <select name="moban_type" id="moban_type" class="form-control firstly">
              <option value="0">已参与的活动</option>
              <?php $_from = $this->_tpl_vars['huoDong']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
              <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($_GET['moban_type'] == $this->_tpl_vars['k']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
              <?php endforeach; endif; unset($_from); ?>
            </select>

            <select name="gc_id_1" id="gc_id_1" class="form-control firstly">
              <option value="0">已购分类</option>
              <?php $_from = $this->_tpl_vars['goodsClass']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
              <option value="<?php echo $this->_tpl_vars['v']['gc_id']; ?>
" <?php if ($_GET['gc_id_1'] == $this->_tpl_vars['v']['gc_id']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['v']['gc_name']; ?>
</option>
              <?php endforeach; endif; unset($_from); ?>
            </select>
          </div>

           <div class="col-lg-20">
                <h5 class="text-left second">所购商品：</h5>
                <input type="text" name="goods_name" id="goods_name" value="<?php echo $_GET['goods_name']; ?>
" placeholder="(名称/编号)" class="form-control parsley-validated second">
           </div>

           <div class="col-lg-40">
                <h5 class="text-left thirdly">等级积分：</h5>
                <input type="text" name="member_points_min" id="member_points_min" value="<?php echo $_GET['member_points_min']; ?>
" size="10" maxlength="10" class="form-control parsley-validated fourthly" />
                <span class="thirdly">-</span>
                <input type="text" name="member_points_max" id="member_points_max" value="<?php echo $_GET['member_points_max']; ?>
" size="10" maxlength="10" class="form-control parsley-validated fourthly" />
           </div>

           <div class="col-lg-40">
                <h5 class="text-left thirdly">余额：</h5>
                <input type="text" name="member_available_predeposit_min" id="member_available_predeposit_min" value="<?php echo $_GET['member_available_predeposit_min']; ?>
" size="10" maxlength="10" class="form-control parsley-validated fourthly" />
                <span class="thirdly">-</span>
                <input type="text" name="member_available_predeposit_max" id="member_available_predeposit_max" value="<?php echo $_GET['member_available_predeposit_max']; ?>
" size="10" maxlength="10" class="form-control parsley-validated fourthly" />
           </div>

          <div class="col-lg-50">
                <h5 class="text-left fourthly">购买时间：</h5>
                <input name="member_add_time_min" type="text" id="control_date11" value="<?php echo $_GET['member_add_time_min']; ?>
" size="10" maxlength="10" onClick="new Calendar().show(this);" readonly="readonly" class="form-control parsley-validated fourthly" />
                <span class="thirdly">-</span>
                <input name="member_add_time_max" type="text" id="control_date22" value="<?php echo $_GET['member_add_time_max']; ?>
" size="10" maxlength="10" onClick="new Calendar().show(this);" readonly="readonly" class="form-control parsley-validated fourthly" /></span>
           </div>


           <div class="col-lg-50">
                <h5 class="text-left fourthly">注册时间：</h5>
                <input name="member_time_min" type="text" id="control_date" value="<?php echo $_GET['member_time_min']; ?>
" size="10" maxlength="10" onClick="new Calendar().show(this);" readonly="readonly" class="form-control parsley-validated fourthly" />
                <span class="thirdly">-</span>
                <input name="member_time_max" type="text" id="control_date2" value="<?php echo $_GET['member_time_max']; ?>
" size="10" maxlength="10" onClick="new Calendar().show(this);" readonly="readonly" class="form-control parsley-validated fourthly" /></span>
                
                <input type="hidden" name="form_submit" value="ok"/>
                <input class="btn btn-little" name="" type="button" value="清空" onClick="setNull();"/>
                <input class="btn btn-little" name="" type="submit" value="搜索" onClick=""/>
           </div>

        </div>
      </section>


    </form>

    </div>

    <div class="col-lg-12 number-of-people">满足当前可发用户数为<strong><?php echo $this->_tpl_vars['pageTotle']; ?>
</strong>人</div>




    <div class="col-lg-12">

      <section class="clearfix m-t-large m-b">
        <ul class="nav nav-gjtabs">
          <li class="active"><a href="#home" data-toggle="tab">模版消息群发</a></li>
          <li><a href="#profile" data-toggle="tab">聊天消息群发</a></li>
        </ul>

       


        <div class="tab-content panelling form-horizontal">
          <div class="tab-pane active clearfix" id="home">
               <form id="form2" action="index.php?m=manageUser&p=manage&c=setMoBanStyle" method="POST">


            <div class="form-group">
              <label class="col-lg-1 control-label">选择模板：</label>
                <div class="col-lg-8 left_box">
                  <select id="MoBanStyle" name="MoBanStyle" class="form-control"  onchange="setmobanstyle()";>
                    <option value="">请选择</option>
                    <option value="GongGao">微信群发公告</option>
                  </select>


  <div class="table_box" id="GongGao">

    <div class="form-group">
       <label class="col-lg-1 control-label">公告标题：</label>
       <div class="col-lg-8">
            <input type="text" name="GongGao_first" id="GongGao_first" value="<?php echo $this->_tpl_vars['mobanArray']['V_Remark']['first']; ?>
" placeholder="请输入至少10个字" class="form-control parsley-validated">
       </div>
    </div>

    <div class="form-group">
       <label class="col-lg-1 control-label">公告类型：</label>
       <div class="col-lg-8">
            <input type="text" name="GongGao_keyword1" id="GongGao_keyword1"  value="<?php echo $this->_tpl_vars['mobanArray']['V_Remark']['keyword1']; ?>
" placeholder="请输入至少10个字" class="form-control parsley-validated">
       </div>
    </div>

    <div class="form-group">
     <label class="col-lg-1 control-label">公告内容：</label>
     <div class="col-lg-8">
          <textarea name="GongGao_keyword2" id="GongGao_keyword2" placeholder="请输入至少10个字" rows="5" class="form-control parsley-validated"><?php echo $this->_tpl_vars['mobanArray']['V_Remark']['keyword2']; ?>
</textarea>
     </div>
    </div>

    <div class="form-group">
       <label class="col-lg-1 control-label">公告备注：</label>
       <div class="col-lg-8">
            <input type="text" name="GongGao_remark" id="GongGao_remark"  value="<?php echo $this->_tpl_vars['mobanArray']['V_Remark']['remark']; ?>
" placeholder="请输入至少10个字" class="form-control parsley-validated">
       </div>
    </div>

    <div class="form-group">
       <label class="col-lg-1 control-label">跳转链接：</label>
       <div class="col-lg-8">
            <input type="text" name="GongGao_url" id="GongGao_url"   value="<?php echo $this->_tpl_vars['mobanArray']['V_Remark']['url']; ?>
" placeholder="请输入至少10个字" class="form-control parsley-validated">
       </div>
    </div>



  </div>


<!-- 
  <div class="table_box" id="ChaoYue">

    <div class="form-group">
       <label class="col-lg-1 control-label">拍卖标题：</label>
       <div class="col-lg-8">
            <input type="text" name="ChaoYue_first"  id="ChaoYue_first" value="<?php echo $this->_tpl_vars['mobanArray']['V_Remark']['first']; ?>
" placeholder="请输入至少10个字" class="form-control parsley-validated">
       </div>
    </div>

    <div class="form-group">
       <label class="col-lg-1 control-label">拍卖期数：</label>
       <div class="col-lg-8">
            <input type="text" name="ChaoYue_number" id="ChaoYue_number"  value="<?php echo $this->_tpl_vars['mobanArray']['V_Remark']['number']; ?>
" placeholder="请输入至少10个字" class="form-control parsley-validated">
       </div>
    </div>

    <div class="form-group">
       <label class="col-lg-1 control-label">拍品名称：</label>
       <div class="col-lg-8">
            <input type="text" name="ChaoYue_name"  id="ChaoYue_name"  value="<?php echo $this->_tpl_vars['mobanArray']['V_Remark']['name']; ?>
" placeholder="请输入至少10个字" class="form-control parsley-validated">
       </div>
    </div>

    <div class="form-group">
       <label class="col-lg-1 control-label">公告备注：</label>
       <div class="col-lg-8">
            <input type="text" name="ChaoYue_remark"  id="ChaoYue_remark"  value="<?php echo $this->_tpl_vars['mobanArray']['V_Remark']['remark']; ?>
" placeholder="请输入至少10个字" class="form-control parsley-validated">
       </div>
    </div>

    <div class="form-group">
       <label class="col-lg-1 control-label">跳转链接：</label>
       <div class="col-lg-8">
            <input type="text" name="ChaoYue_url" id="ChaoYue_url"  value="<?php echo $this->_tpl_vars['mobanArray']['V_Remark']['url']; ?>
" placeholder="请输入至少10个字" class="form-control parsley-validated">
       </div>
    </div>

  </div>
 -->



<!--   <div class="table_box" id="LePaiJieShu">

    <div class="form-group">
       <label class="col-lg-1 control-label">标题：</label>
       <div class="col-lg-8">
            <input type="text" name="LePaiJieShu_first" id="LePaiJieShu_first"  value="<?php echo $this->_tpl_vars['mobanArray']['V_Remark']['first']; ?>
" placeholder="请输入至少10个字" class="form-control parsley-validated">
       </div>
    </div>

    <div class="form-group">
       <label class="col-lg-1 control-label">拍卖期数：</label>
       <div class="col-lg-8">
            <input type="text" name="LePaiJieShu_number" id="LePaiJieShu_number"  value="<?php echo $this->_tpl_vars['mobanArray']['V_Remark']['number']; ?>
" placeholder="请输入至少10个字" class="form-control parsley-validated">
       </div>
    </div>

    <div class="form-group">
       <label class="col-lg-1 control-label">拍品名称：</label>
       <div class="col-lg-8">
            <input type="text" name="LePaiJieShu_name" id="LePaiJieShu_name"  value="<?php echo $this->_tpl_vars['mobanArray']['V_Remark']['name']; ?>
" placeholder="请输入至少10个字" class="form-control parsley-validated">
       </div>
    </div>

    <div class="form-group">
       <label class="col-lg-1 control-label">预定结束时间：</label>
       <div class="col-lg-8">
            <input type="text" name="LePaiJieShu_deadline" id="LePaiJieShu_deadline"  value="<?php echo $this->_tpl_vars['mobanArray']['V_Remark']['deadline']; ?>
" placeholder="请输入至少10个字" class="form-control parsley-validated">
       </div>
    </div>

    <div class="form-group">
       <label class="col-lg-1 control-label">备注：</label>
       <div class="col-lg-8">
            <input type="text" name="LePaiJieShu_remark" id="LePaiJieShu_remark"  value="<?php echo $this->_tpl_vars['mobanArray']['V_Remark']['remark']; ?>
" placeholder="请输入至少10个字" class="form-control parsley-validated">
       </div>
    </div>

    <div class="form-group">
       <label class="col-lg-1 control-label">跳转链接：</label>
       <div class="col-lg-8">
            <input type="text" name="LePaiJieShu_url" id="LePaiJieShu_url"  value="<?php echo $this->_tpl_vars['mobanArray']['V_Remark']['url']; ?>
" placeholder="请输入至少10个字" class="form-control parsley-validated">
       </div>
    </div>

  </div> -->

  

                 </div>
            </div>





            <div class="form-group">
               <div class="col-lg-9 col-offset-1">                      
                  <button type="button"  onclick="do_submit1();" class="btn btn-primary">发送模版消息</button>

                  <button type="button"  onclick="do_yunan1();" class="btn btn-primary">预览</button>

预览用户：
                  <select id="Y_Name" name="Y_Name">
                    <option value="">请选择</option>
                    <option value="ocmCHjlAGwXUnTrYcCkeQeXSztuY">董总</option>
                    <option value="ocmCHjmmkbX9lPLiCKZ3RGwPyQrw">盛总</option>

                    <option value="ocmCHjp2lDPvkzyYVMgD4S7SMTRg">寇智聪</option>
                    <option value="ocmCHjvOcGWeMkzeXPBIMWTDRNaY">刘铜</option>
                  </select>
               </div>
            </div>


            <input type="hidden" name="form_submit" value="ok"/>
            </form>

          </div>






          <div class="tab-pane clearfix" id="profile">
            <form id="form3" action="index.php?m=manageUser&p=manage&c=setMoBanStyle" method="POST">
            <div class="form-group">
                 <label class="col-lg-1 control-label">内容：</label>
                 <div class="col-lg-8">
                      <textarea name="user_one_msg" id="user_one_msg" placeholder="请输入至少10个字" rows="5" class="form-control parsley-validated" data-trigger="keyup"></textarea>
                 </div>
            </div>

            <div class="form-group">
                 <div class="col-lg-9 col-offset-1">                      
                      <button type="button" onclick="do_submit2();" class="btn btn-primary">发送聊天消息</button>

                      <button type="button"  onclick="do_yunan2();" class="btn btn-primary">预览</button>

预览用户：
                  <select id="Y_Name2" name="Y_Name">
                    <option value="">请选择</option>
                    <option value="ocmCHjlAGwXUnTrYcCkeQeXSztuY">董总</option>
                    <option value="ocmCHjmmkbX9lPLiCKZ3RGwPyQrw">盛总</option>

                    <option value="ocmCHjp2lDPvkzyYVMgD4S7SMTRg">寇智聪</option>
                    <option value="ocmCHjvOcGWeMkzeXPBIMWTDRNaY">刘铜</option>
                  </select>


                 </div>
            </div>
            <input type="hidden" name="msg" value="ok"/>
            <input type="hidden" name="form_submit" value="ok"/>
            </form>
          </div>


            <div class="form-group">
                 <div class="col-lg-9 col-offset-1">                      
                      <p><span style="color:red;">注：</span>通配符格式</p>
                      <p>(用户名  %name%  )</p>
                      <p>(积分  %jifen%  )</p>
                      <p>(余额  %yue%  )</p>
                      <p>如需在发送消息内出现以上内容则用通配符代替</p>
                 </div>
            </div>


        </div>
      </section>



</section>


<div id="layout" style="position: absolute; width:100%; height:100%; background:rgba(255,255, 255, 0.8) none repeat scroll 0 0 !important;

filter:Alpha(opacity=80); background:#fff; top:0px; left:0px;display:none">
<img src="static/images/laod_wait.gif" style="padding-left:42%;padding-top:20%"/>

</div>


  
  <script>

  function do_submit1(){

    var msg = $("#MoBanStyle").val();
    var yname = $("#Y_Name").val();
    if(confirm("确定要发送模板消息嘛?")){

      if(!msg){
        alert('请填写发送内容');
      }else if(yname){
        alert('发送模板不能选择预览人！');
      }else{
        document.getElementById('layout').style.display="";
        $("#form2").submit();
      }

    }

  }


  function do_yunan1(){

    var msg = $("#MoBanStyle").val();
    var yname = $("#Y_Name").val();
    if(confirm("确定要发送预览嘛?")){

      if(!msg){
        alert('请填写发送内容');
      }else if(!yname){
        alert('请选择一个预览人');
      }else{
        document.getElementById('layout').style.display="";
        $("#form2").submit();
      }

    }

  }



  function do_submit2(){
    var msg = $("#user_one_msg").val();
    var yname = $("#Y_Name2").val();
    if(confirm("确定要发送聊天消息嘛?")){

      if(!msg){
        alert('请填写发送内容');
      }else if(yname){
        alert('发送消息不能选择预览人！');
      }else{
        document.getElementById('layout').style.display="";
        $("#form3").submit();
      }



    }

  }


  function do_yunan2(){

    var msg = $("#user_one_msg").val();
    var yname = $("#Y_Name2").val();
    if(confirm("确定要发送聊天消息嘛?")){

      if(!msg){
        alert('请填写发送内容');
      }else if(!yname){
        alert('请选择一个预览人');
      }else{
        document.getElementById('layout').style.display="";
        $("#form3").submit();
      }

    }

  }




    function setNull(){
      $("#moban_type").find("option[value='0']").attr("selected",true);
      $("#gc_id_1").find("option[value='0']").attr("selected",true);
      $("#goods_name").val('');
      $("#member_available_predeposit_min").val('');
      $("#member_available_predeposit_max").val('');
      $("#member_points_min").val('');
      $("#member_points_max").val('');
      $("#control_date").val('');
      $("#control_date2").val('');
      $("#control_date11").val('');
      $("#control_date22").val('');
    }

    function setmobanstyle(){
       var name = $("#MoBanStyle").val();

        $(".left_box .table_box").hide();

        $("#"+name).show();

  //       $.ajax({
  //           type: "POST",
  //           cache: false,
  //           dataType:"json",
  //           url : "index.php?m=manageUser&p=manage&c=ajaxGetMobanVal",
  //           data: 'id=' + va,
  //           success : function(html){
  //  if(html){

  //   name = html.V_Name;

  //   $("#MoBanStyle").val(name);

  //   $.each(html.V_Remark, function(i, e){
  //       $("#" + name + "_" + i).val(e);
  //   });


  //  }else{
  //   $("#MoBanStyle").val('');
  //   alert('没有该模板数据、请重新选择！');
  //  }
              
  // $(".left_box .table_box").hide();

  //   $("#"+name).show();
              
  //           }

  //       });

       

      }
  </script>
  <!-- / footer -->
  <script src="static/js/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="static/js/bootstrap.js"></script>
  <!-- time -->
  <script src="static/js/Calendar.js"></script>
</body>
</html>