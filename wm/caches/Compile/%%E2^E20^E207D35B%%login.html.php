<?php /* Smarty version 2.6.26, created on 2016-03-22 13:42:06
         compiled from manage/user/login.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $this->_tpl_vars['COMPANY']; ?>
CRM管理系统</title>
<script src="static/js/jquery-1.7.js"></script>
<script>
window.onload=roll;
	function roll(){
	
	var body=document.getElementById("body");
	
	//随机产生数..math.random()产生0-1之间的随机数..4代表4张图片....可以自己增加..math.floor获取整数部分.+1实现1-4图片的获取。
	
	var rnd=Math.floor(Math.random()*4)+1;
	
	//body.className="body"+rnd; //class实现;
	
	//dom->获取style 采用驼峰写法..
	body.style.backgroundImage="url('<?php echo $this->_tpl_vars['DIR']; ?>
images/dl_bg"+rnd+".jpg')";
}
</script>


<style type="text/css">
body{
	margin: 0;
	padding: 0;
	font-size: 12px;
	font-family: Arial"宋体";
	color: #333;
	background-color:#0066cc;
	background-repeat: no-repeat;
	background-position: center top;
}

body1{
background:url("<?php echo $this->_tpl_vars['DIR']; ?>
images/dl_bg.jpg");
}

body2{
background:url("<?php echo $this->_tpl_vars['DIR']; ?>
images/dl_bg.jpg");
}

body3{
background:url("<?php echo $this->_tpl_vars['DIR']; ?>
images/dl_bg3.jpg");
}

body4{
background:url("<?php echo $this->_tpl_vars['DIR']; ?>
images/dl_bg4.jpg");
}

a,p,span,ul,li,font,strong,h1,h3,h2,dl,dt,dd{ margin:0; padding:0; }
a{ text-decoration:none;}
ul,li{ list-style:none;}
img{ border:none}
a:hover{ text-decoration:none;}
.maina { width:400px; height:318px; background-image:url(<?php echo $this->_tpl_vars['DIR']; ?>
images/dl_main.png); margin:200px auto 0 auto;}
.mainb { width:500px; margin:0 auto 0 auto; text-align:center; font-size:12px; color:#fff; padding-top:20px;}
.dl_kuang { width:202px; height:32px; line-height:32px; border:0px; border:none; margin:0px; padding:0px; text-indent:0.5em; background-image:url(<?php echo $this->_tpl_vars['DIR']; ?>
images/202-32.jpg);} 
.dl_kuang2 { width:102px; height:32px; line-height:32px; border:0px; border:none; margin:0px; padding:0px; text-indent:0.5em; background-image:url(<?php echo $this->_tpl_vars['DIR']; ?>
images/102-32.jpg);} 
.dl_an { width:80px; height:33px; border:0px; border:none; background-image:url(<?php echo $this->_tpl_vars['DIR']; ?>
images/dl_a1.jpg); margin:0px; padding:0px; cursor:pointer;}
.dl_an2 { width:80px; height:33px; border:0px; border:none; background-image:url(<?php echo $this->_tpl_vars['DIR']; ?>
images/dl_a2.jpg); margin:0px; padding:0px; cursor:pointer;}

.dl_an1 {width:80px; height:33px; border:0px; border:none; background-image:url(<?php echo $this->_tpl_vars['DIR']; ?>
images/dl_a1.jpg); margin:0px; padding:0px; cursor:pointer;}
.dl_an21 {width:80px; height:33px; border:0px; border:none; background-image:url(<?php echo $this->_tpl_vars['DIR']; ?>
images/dl_a2.jpg); margin:0px; padding:0px; cursor:pointer;}
.dl_kuang1 {width:202px; height:32px; line-height:32px; border:0px; border:none; margin:0px; padding:0px; text-indent:0.5em; background-image:url(<?php echo $this->_tpl_vars['DIR']; ?>
images/202-32.jpg);}
.dl_kuang21 {width:102px; height:32px; line-height:32px; border:0px; border:none; margin:0px; padding:0px; text-indent:0.5em; background-image:url(<?php echo $this->_tpl_vars['DIR']; ?>
images/102-32.jpg);}
</style>
<script>
function CheckFrom(){
	var MemberNumber=$('#Number').val();
	if(MemberNumber==''){
		alert('请输入商户号!');
		return false;
	}
		
	var UserName=$('#UserName').val();
	if(UserName==''){
		alert('请输入用户名!');
		return false;
	}

	var Pass=$('#Pass').val();
	if(Pass==''){
		alert('请输入密码!');
		return false;
	}

	var Code=$('#Code').val();
	if(Code==''){
		alert('请输入验证码!');
		return false;
	}
	return 1;
} 
</script>
</head>

<body id="body">
<div class="main">
<div class="maina">
  <form id="form1" name="form1" method="post" action="index.php?m=login&c=loginAction&p=manage" onsubmit="javascript:return CheckFrom();">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="font-family:'微软雅黑'; font-size:14px;">
      <tr>
        <td width="33%" height="95">&nbsp;</td>
        <td width="67%">&nbsp;</td>
      </tr>
      <tr>
        <td height="38" align="right" style="height:37px;">商户号：</td>
        <td>&nbsp;
          <input name="Number" id="Number" type="text" class="dl_kuang1" readonly="readonly" value="<?php echo $this->_tpl_vars['W_NUMBER']; ?>
"/></td>
      </tr>
      <tr>
        <td align="right" style="height:37px;">用户名：</td>
        <td>&nbsp;
          <input name="UserName" id="UserName" type="text" class="dl_kuang1" /></td>
      </tr>
      <tr>
        <td  align="right" style="height:37px;">密码：</td>
        <td>&nbsp;
          <input name="Pass" id="Pass" type="password" class="dl_kuang1"/></td>
      </tr>
      <tr>
        <td  align="right" style="height:37px;">验证码：</td>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="41%">&nbsp;
              <input name="Code" type="text" class="dl_kuang21" id="Code"  /></td>
            <td width="59%"><img src="index.php?m=login&c=createCode&p=manage&'+new=Date().getTime()" onclick="this.src='index.php?m=login&c=createCode&p=manage&'+new Date().getTime()";/></td>
          </tr>
        </table></td>
      </tr>   
      <tr>
        <td height="50">&nbsp;</td>
        <td>&nbsp;
          <input type="submit" name="button" id="button" value=" " class="dl_an1" />
          &nbsp;&nbsp;
          <input type="submit" name="button" id="button" value=" " class="dl_an21" /></td>
      </tr>
    </table>
  </form>
</div>
<div class="mainb">Copyright&nbsp;&nbsp;<span style="font-family:Arial">&copy;</span>&nbsp;&nbsp;<?php echo $this->_tpl_vars['YEAR']; ?>
 <?php echo $this->_tpl_vars['COMPANY']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;版权所有</div>
</div>




</body>
</html>