<?php

/**ask2问答系统地图工具**/
 set_time_limit(200); 
 //脚本超时时间设置，根据自己的数据量来设置，0为无限
 //下面获取时间
 $year = date("Y");
$month = date("m");
$day = date("d");
$dayBegin = mktime(0,0,0,$month,$day,$year);//当天开始时间戳
$dayEnd = mktime(23,59,59,$month,$day,$year);//当天结束时间戳 

 
 
 makequestion();
  makearticle();
 function makearticle(){
 	$siteurl=SITE_URL;//此处网址改成你自己的//载入数据配置文件
 	include(ASK2_ROOT.'\config.php'); //初始化数据库配置，用户，密码，表前缀
 $dbhost=DB_HOST;$dbuser=DB_USER;$dbname=DB_NAME;$dbpw=DB_PW; $dbcharset=DB_CHARSET;
  $tablepre=DB_TABLEPRE;
 $questiontable=$tablepre.'question'; //生成sitemaps文件
$topictable=$tablepre.'topic'; //生成sitemaps文件
 $conn=mysql_connect($dbhost,$dbuser,$dbpw);
 if ($conn>0) {mysql_select_db($dbname);
 mysql_query("SET NAMES".$dbcharset);
 $exec="SELECT * FROM `".$topictable."`   order by id desc limit 200 "; 
 

 $result=mysql_query($exec);
 $o_fname=SITE_URL."plugin/sitemap/topic.txt";
 $cp_o_fname=ASK2_ROOT."/plugin/sitemap/topic.txt";
  $urls = array(
   
);
 $buffer=$buffer.$siteurl."\n"; 

 $buffer=$buffer.""; 
 while($rs=mysql_fetch_object($result)){ 
 	$tid=$rs->id; 
 	
 	$linkBuffer=$linkBuffer.""; 
array_push($urls, $siteurl."article-".$tid.".html");
  $linkBuffer=$linkBuffer.$siteurl."article-".$tid.".html"."\n"; 

 $linkBuffer=$linkBuffer.""; 
 } $allBuffer=$buffer.$linkBuffer; 

 $fp = fopen($cp_o_fname,"w")or exit("Unable to open file!"); 

 fwrite($fp,$allBuffer); 
 fclose($fp);
  }mysql_close();
  
 echo  "<br>". count($urls);

 echo"<a href=".$o_fname." target=_blank>查看文章地图</a>";
 }
 function makequestion(){
 	$siteurl=SITE_URL;//此处网址改成你自己的//载入数据配置文件
 	include(ASK2_ROOT.'\config.php'); //初始化数据库配置，用户，密码，表前缀
 $dbhost=DB_HOST;$dbuser=DB_USER;$dbname=DB_NAME;$dbpw=DB_PW; $dbcharset=DB_CHARSET; $tablepre=DB_TABLEPRE;$questiontable=$tablepre.'question'; //生成sitemaps文件

 $conn=mysql_connect($dbhost,$dbuser,$dbpw);
 if ($conn>0) {mysql_select_db($dbname);
 mysql_query("SET NAMES".$dbcharset);
 $exec="SELECT * FROM `".$questiontable."`  where status!=0 order by id desc limit 2000 "; 
 $result=mysql_query($exec);
 $o_fname=SITE_URL."plugin/sitemap/pcmap.txt";
 $cp_o_fname=ASK2_ROOT."/plugin/sitemap/pcmap.txt";
  $urls = array(
   
);
 $buffer=$buffer.$siteurl."\n"; 

 $buffer=$buffer.""; 
 while($rs=mysql_fetch_object($result)){ $qid=$rs->id; $time=$rs->time; $linkBuffer=$linkBuffer.""; 
array_push($urls, $siteurl."q-".$qid.".html");
  $linkBuffer=$linkBuffer.$siteurl."q-".$qid.".html"."\n"; 

 $linkBuffer=$linkBuffer.""; 
 } $allBuffer=$buffer.$linkBuffer; 

 $fp = fopen($cp_o_fname,"w")or exit("Unable to open file!"); 

 fwrite($fp,$allBuffer); 
 fclose($fp);
  }mysql_close();
  
 echo  count($urls);

 echo"<a href=".$o_fname." target=_blank>查看问题地图</a>";
 }
?>