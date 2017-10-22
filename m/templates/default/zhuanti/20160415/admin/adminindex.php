<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>迎新春专题活动</title>
<script src="http://resource.96567.com/js/jquery.js"></script>
<script language="javascript" type="text/javascript" src="http://crm.96567.com/static/js/My97DatePicker/WdatePicker.js"></script>


<style>
#mainass table,tr,th,td{border-collapse:collapse;}
#mainass table{width:1000px;}
#mainass th,td{padding:5px;border:1px solid #ccc;}

body { margin:0px; padding:0px; background-color:#f5f5f5;}
#mains { width:858px; overflow:hidden; border:1px solid #dcdcdc; margin-left:auto; margin-right:auto; background-color:#fff; margin-top:10px; margin-bottom:10px;}
#mainas { width:858px; font-size:12px; font-weight:bold; color:#c00; border-bottom:1px #dcdcdc solid; background-color:#fff8f8;}
#cc {width:400px; height:50px; line-height:50px;}
#cc {width:458px; text-align:center; height:50px; line-height:50px; margin-left:229px;font-size:30px; font-family:"黑体"; }
#mainass table{ width:858px; height:auto; font-size:20px; font-family:"黑体"; font-weight:bold; color:#c00;text-align:center; border-bottom:1px #dcdcdc solid; background-color:#FFFFFF;}

.date-picker-wp {
display: none;
position: absolute;
background: #f1f1f1;
left: 40px;
top: 40px;
border-top: 4px solid #3879d9;
}
.date-picker-wp table {
border: 1px solid #ddd;
}
.date-picker-wp td {
background: #fafafa;
width: 22px;
height: 18px;
border: 1px solid #ccc;
font-size: 12px;
text-align: center;
}
.date-picker-wp td.noborder {
border: none;
background: none;
}
.date-picker-wp td a {
color: #1c93c4;
text-decoration: none;
}
.strong {font-weight: bold}
.hand {cursor: pointer; color: #3879d9}
</style>
</head>
<body>
<div id="mains">

<div id="mainas">

<span id="cc">
<br />
&nbsp;微信抢钱包活动后台
</span>
<br />
<?php echo $output['str'];?><br />
<?php echo $output['hd_str'];?><br />
<?php echo $output['JiangHtml'];?><br />
<?php echo $output['sssssJiangHtml'];?><br />
总共参与次数：<?php echo $output['ZongCount'];?>&nbsp;
参与会员总数：<?php echo $output['ZongMember'];?>&nbsp;
新会员参与总数：<?php echo $output['xinhuiyuanchanyu'];?>&nbsp;
分享一次的会员：<?php echo $output['FenXiangCount'];?>&nbsp;
分享二次的会员：<?php echo $output['FenXiangLiangCount'];?>&nbsp;

<!--
-->
<br />
<form method="get" action="">
<input type="hidden" name="act" value="zhuanti">
<input type="hidden" name="op" value="ad_20160415">
<input type="hidden" name="action" value="url_admin">
<span style="font-size: 20px;">&nbsp;按时间检索：<input name="Start_time" type="text" id="Start_time" maxlength="12" style="width:100px;height:28px; line-height:28px; padding:0px; margin:0px;" onclick="WdatePicker({isShowWeek:true});" class="Wdate" onblur="times(this);" value="<?php echo date("Y-m",time()).'-01'?>"> &nbsp;-&nbsp;<input name="End_time" type="text" id="End_time" maxlength="12" style="width:100px; height:28px; line-height:28px; padding:0px; margin:0px;" onclick="WdatePicker({isShowWeek:true});" class="Wdate" onblur="times(this);" value="<?php echo date("Y-m",time()).'-30'?>"></span>
<input type="submit" value="搜索">
</form>
<br />
</div>
<div id="mainass">
<table>
 <tr>

    <th>抽奖会员</th>
    <th width="35%">获得奖品</th>
	<th>抽奖时间</th>
    <th>领取单号</th>
	<th>是否领取</th>
  </tr>


<?php
if($output['List']){
foreach ($output['List'] as $row){
?>
  <tr>
    <td><?php echo $row['member_name'];?></td>
    <td><?php echo $row['l_name'];?></td>
	<td><?php echo date("Y-m-d H:i:s",$row['add_time']);?></td>
	<td><?php echo $row['order_sn'];?> </td>
	<td>
			<?php if($row['is_fafang'] == 0){
					echo '未领取';
				}else{
					echo '已领取';
			}
		?>
	</td>

  </tr>
  <?php
		}
}
?>
	
</table>
</div>
<style>
/* 翻页样式 */
.pagination { display: inline-block; margin: 0 auto;}
.pagination ul { font-size: 0; *word-spacing:-1px/*IE6、7*/; }
.pagination ul li { vertical-align: top; letter-spacing: normal; word-spacing: normal; display: inline-block; margin: 0 0 0 -1px;}
.pagination ul li { *display: inline/*IE6、7*/; *zoom:1;}
.pagination li span { font: normal 14px/20px "microsoft yahei"; color: #AAA; background-color: #FAFAFA; text-align: center; display: block; min-width: 20px; padding: 8px; border: 1px solid #E6E6E6; position: relative; z-index: 1;}
.pagination li a span , 
.pagination li a:visited span { color: #005AA0; text-decoration: none; background-color: #FFF; position: relative; z-index: 1;}
.pagination li a:hover span, .pagination li a:active span{ color: #FFF; text-decoration: none !important; background-color: #D93600; border-color: #CA3300; position: relative; z-index: 9; cursor:pointer;}
.pagination li a:hover { text-decoration: none;}
.pagination li span.currentpage { color: #AAA; font-weight: bold; background-color: #FAFAFA; border-color: #E6E6E6; position: relative; z-index: 2;}
</style>
<div class="pagination"><?php echo $output['show_page']; ?></div>
<p></p>
</div>			
</body>
</html>