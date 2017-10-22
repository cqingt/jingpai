<?php /* Smarty version 2.6.26, created on 2016-03-22 14:24:36
         compiled from manage/user/moban_style.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>商城模板消息发送 - <?php echo $this->_tpl_vars['COMPANY']; ?>
</title>
<link href="<?php echo $this->_tpl_vars['DIR']; ?>
css/style.css" rel="stylesheet" type="text/css" />
<link href="static/js/asyncbox/skins/Ext/asyncbox.css" rel="stylesheet" type="text/css" />
<script src="static/js/jquery-1.7.js"></script>
<script src="static/js/asyncbox/AsyncBox.v1.4.js"></script>
<script src="static/js/common.js"></script>
<script src="static/js/My97DatePicker/WdatePicker.js"></script>
</head>
<style>

.clear:after {
  content: ".";
  display: block;
  height: 0;
  visibility: hidden;
  clear: both;
}

.clear {
  zoom: 1;
}


  #form1{
    float:left;
    height:33px;
  }

  .moban_input{
    width:100px;
  }

  .totle{
    font-size: 14px;
    font-family: '微软雅黑';
    font-weight: bold;
    color: #F00;
  }

  #do_moban{
    float:right;
  }


  .moban_box{
    width:100%;
  }


  .left_box{
    height:500px;
    float:left;
    width:38%;
  }

  .right_box{
    height:500px;
    float:right;
    width:60%;
  }

/*    .table_box{
    border:1px solid red;
  }*/

  .table_box{
    display:none;
  }


</style>
<body>



<div class="list_main_r">
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="table_title">

  <tr  style="height:50px;">
  	<td bgcolor="#ecf9ff"><span class="title">模板消息发送</span></td>
  </tr>
</table>



<div class="moban_box clear">


<form id="form1" action="index.php?m=manageUser&p=manage&c=setMoBanStyle" method="POST">


  <div class="left_box">
      模板样式选择：<select name="MoBanStyle" id="MoBanStyle" onchange="setmobanstyle();">
              
              <option value="">请选择</option>
              <option value="GongGao">公告通知提醒</option>
              <option value="ChaoYue">出价被超越通知</option>
              <option value="LePaiJieShu">拍卖结束提醒</option>

      </select>




    <table class="table_box" id="GongGao">
      <tr>
        <td>公告标题：<input type="text" name="GongGao_first"/></td>
      </tr>

      <tr>
        <td>公告类型：<input type="text"  name="GongGao_keyword1"/></td>
      </tr>

      <tr>
        <td>公告内容：<textarea name="GongGao_keyword2" id="" cols="30" rows="10"></textarea></td>
      </tr>

      <tr>
        <td>公告备注：<input type="text"  name="GongGao_remark"/></td>
      </tr>

      <tr>
        <td>跳转链接：<input type="text"  name="GongGao_url"/></td>
      </tr>

    </table>



    <table class="table_box" id="ChaoYue">
      <tr>
        <td>拍卖标题：<input type="text"  name="ChaoYue_first" /></td>
      </tr>

      <tr>
        <td>拍卖期数：<input type="text"  name="ChaoYue_number" /></td>
      </tr>

      <tr>
        <td>拍品名称：<input type="text"  name="ChaoYue_name" /></td>
      </tr>

      <tr>
        <td>公告备注：<input type="text"  name="ChaoYue_remark" /></td>
      </tr>

      <tr>
        <td>跳转链接：<input type="text"  name="ChaoYue_url" /></td>
      </tr>

    </table>


    <table class="table_box" id="LePaiJieShu">
      <tr>
        <td>标题：<input type="text" name="LePaiJieShu_first" /></td>
      </tr>

      <tr>
        <td>拍卖期数：<input type="text" name="LePaiJieShu_number" /></td>
      </tr>

      <tr>
        <td>拍品名称：<input type="text" name="LePaiJieShu_name" /></td>
      </tr>

      <tr>
        <td>预定结束时间：<input type="text" name="LePaiJieShu_deadline" /></td>
      </tr>

      <tr>
        <td>备注：<input type="text" name="LePaiJieShu_remark" /></td>
      </tr>

      <tr>
        <td>跳转链接：<input type="text" name="LePaiJieShu_url" /></td>
      </tr>

    </table>

<input type="hidden" name="form_submit" value="ok"/>
<input type="button" onclick="do_submit();" value="提交"/>


</form>


  </div>





    <div class="right_box">
      <img id="mobanImg" src="" alt="" />
    </div>


</div>


</div>


</body>

<script>
    function do_submit(){
      if(confirm("确定要发送模板消息嘛?")){
        $("#form1").submit();
      }
    }


    function setmobanstyle(){
      var img = 'static/images/';
     var va = $("#MoBanStyle").val();

     $(".left_box table").hide();

     $("#"+va).show();

     $("#mobanImg").attr("src",img + va + '.png');

     // $("#"+va+" input").attr("required","required=true");

    }


</script>


</html>