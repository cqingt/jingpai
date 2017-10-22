<?php

!defined('IN_ASK2') && exit('Access Denied');

class updatecontrol extends base {

    function updatecontrol(& $get, & $post) {
        $this->base($get, $post);
       $this->load('usergroup');
    }



    function ondefault() {
    	
    	header("Content-Type: text/html;charset=utf-8");
    	
    	
     $sql_select_logo="select * from ". DB_TABLEPRE ."setting where k='baidu_api'";
     
     $result_sitelogo=$this->db->query($sql_select_logo);
     $numlogo1=0;
           while($logo = $this->db->fetch_array($result_sitelogo)) {
           	
           $numlogo1= 	count($logo);
           }
  
     if($numlogo1>1){
     	echo "setting表baidu_api存在<br>";
     }else{
     	$sql_sitelogo1="insert into ". DB_TABLEPRE ."setting  values('baidu_api','')";
     	$this->db->query($sql_sitelogo1);
     	 echo ' 更新成功:更新setting表，增加baidu_api<br>';
     }
    	
     
    		//---------------
    	
     $sql_select_logo="select * from ". DB_TABLEPRE ."setting where k='banner_color'";
     
     $result_sitelogo=$this->db->query($sql_select_logo);
     $numlogo1=0;
           while($logo = $this->db->fetch_array($result_sitelogo)) {
           	
           $numlogo1= 	count($logo);
           }
  
     if($numlogo1>1){
     	echo "setting表banner_color存在<br>";
     }else{
     	$sql_sitelogo1="insert into ". DB_TABLEPRE ."setting  values('banner_color','#858c96')";
     	$this->db->query($sql_sitelogo1);
     	 echo ' 更新成功:更新setting表，增加banner_color<br>';
     }
    	
     
    	//---------------
    	
     $sql_select_logo="select * from ". DB_TABLEPRE ."setting where k='banner_img'";
     
     $result_sitelogo=$this->db->query($sql_select_logo);
     $numlogo1=0;
           while($logo = $this->db->fetch_array($result_sitelogo)) {
           	
           $numlogo1= 	count($logo);
           }
  
     if($numlogo1>1){
     	echo "setting表banner_img存在<br>";
     }else{
     	$sql_sitelogo1="insert into ". DB_TABLEPRE ."setting  values('banner_img','https://gss0.bdstatic.com/7051cy89RcgCncy6lo7D0j9wexYrbOWh7c50/zhidaoribao/2016/0710/top.jpg')";
     	$this->db->query($sql_sitelogo1);
     	 echo ' 更新成功:更新setting表，增加banner_img<br>';
     }
    	
    	
    	
    	
    	//-------------
    	try{
    	$groupid=2;
    	$regular_code=',user/sendcheckmail,user/editemail';
    	   $group = $_ENV['usergroup']->get($groupid);
    	   
    	  
    	  
    	 if(!strstr($group['regulars'], $regular_code)){
    	 	 $tmp=$group['regulars'].$regular_code;
    	  $group['regulars']=$tmp;
    	   $_ENV['usergroup']->update($groupid,$group);
    	 }
    	  
    	   
    	   	$groupid=3;
    	   	   $group = $_ENV['usergroup']->get($groupid);
    	 if(!strstr($group['regulars'], $regular_code)){
    	 	 $tmp=$group['regulars'].$regular_code;
    	  $group['regulars']=$tmp;
    	   $_ENV['usergroup']->update($groupid,$group);
    	 }
    	   	 
    	   	 for($i=7;$i<=26;$i++){
    	   	 	 $group = $_ENV['usergroup']->get($i);
    	   	  if(!strstr($group['regulars'], $regular_code)){
    	 	 $tmp=$group['regulars'].$regular_code;
    	  $group['regulars']=$tmp;
    	   $_ENV['usergroup']->update($i,$group);
    	 }
    	   	 }
    	}catch (Exception $e){
    		
    	}
    	
    	//-----------------
     $sql_select_logo="select * from ". DB_TABLEPRE ."setting where k='register_on'";
     
     $result_sitelogo=$this->db->query($sql_select_logo);
     $numlogo1=0;
           while($logo = $this->db->fetch_array($result_sitelogo)) {
           	
           $numlogo1= 	count($logo);
           }
  
     if($numlogo1>1){
     	echo "setting表register_on存在<br>";
     }else{
     	$sql_sitelogo1="insert into ". DB_TABLEPRE ."setting  values('register_on','0')";
     	$this->db->query($sql_sitelogo1);
     	 echo ' 更新成功:更新setting表，增加register_on<br>';
     }
    	//-----------------------------
    	  $sql_select_logo="select * from ". DB_TABLEPRE ."setting where k='hot_on'";
     
     $result_sitelogo=$this->db->query($sql_select_logo);
     $numlogo1=0;
           while($logo = $this->db->fetch_array($result_sitelogo)) {
           	
           $numlogo1= 	count($logo);
           }
  
     if($numlogo1>1){
     	echo "setting表hot_on存在<br>";
     }else{
     	$sql_sitelogo1="insert into ". DB_TABLEPRE ."setting  values('hot_on','0')";
     	$this->db->query($sql_sitelogo1);
     	 echo ' 更新成功:更新setting表，增加hot_on<br>';
     }
     
     //---------------------
        $sql_select_logo="select * from ". DB_TABLEPRE ."setting where k='title_description'";
     
     $result_sitelogo=$this->db->query($sql_select_logo);
     $numlogo1=0;
           while($logo = $this->db->fetch_array($result_sitelogo)) {
           	
           $numlogo1= 	count($logo);
           }
  
     if($numlogo1>1){
     	echo "setting表title_description存在<br>";
     }else{
     	$sql_sitelogo1="insert into ". DB_TABLEPRE ."setting  values('title_description','知名专家为您解答')";
     	$this->db->query($sql_sitelogo1);
     	 echo ' 更新成功:更新setting表，增加title_description<br>';
     }
     
     //------------------------------
     $sql_select_logo="select * from ". DB_TABLEPRE ."setting where k='search_shownum'";
     
     $result_sitelogo=$this->db->query($sql_select_logo);
     $numlogo1=0;
           while($logo = $this->db->fetch_array($result_sitelogo)) {
           	
           $numlogo1= 	count($logo);
           }
  
     if($numlogo1>1){
     	echo "setting表search_shownum存在<br>";
     }else{
     	$sql_sitelogo1="insert into ". DB_TABLEPRE ."setting  values('search_shownum','5')";
     	$this->db->query($sql_sitelogo1);
     	 echo ' 更新成功:更新setting表，增加search_shownum<br>';
     }
     
    	//------------------------------
     $sql_select_logo="select * from ". DB_TABLEPRE ."setting where k='site_logo'";
     
     $result_sitelogo=$this->db->query($sql_select_logo);
     $numlogo1=0;
           while($logo = $this->db->fetch_array($result_sitelogo)) {
           	
           $numlogo1= 	count($logo);
           }
  
     if($numlogo1>1){
     	echo "setting表site_logo存在<br>";
     }else{
     	$sql_sitelogo1="insert into ". DB_TABLEPRE ."setting  values('site_logo','站点别名')";
     	$this->db->query($sql_sitelogo1);
     	 echo ' 更新成功:更新setting表，增加site_logo<br>';
     }
     
     //--------------------------------------
         $sql_site_qrcode="select * from ". DB_TABLEPRE ."setting where k='site_qrcode'";
     
     $result_qrcode=$this->db->query($sql_site_qrcode);
     $numqrcode=0;
           while($qrcode = $this->db->fetch_array($result_qrcode)) {
           	
           $numqrcode= 	count($qrcode);
           }
  
     if($numqrcode>1){
     	echo "setting表site_qrcode存在<br>";
     }else{
     	$sql_qrcode="insert into ". DB_TABLEPRE ."setting  values('site_qrcode','站点别名')";
     	$this->db->query($sql_qrcode);
     	 echo ' 更新成功:更新setting表，增加site_qrcode<br>';
     }
     
     
     
     
     
         $sql_select_setting1="select * from ". DB_TABLEPRE ."setting where k='site_alias'";
     
     $result_setting1=$this->db->query($sql_select_setting1);
     $num1=0;
           while($user1 = $this->db->fetch_array($result_setting1)) {
           	
           $num1= 	count($user1);
           }
  
     if($num1>1){
     	echo "setting表site_alias存在<br>";
     }else{
     	$sql_setting1="insert into ". DB_TABLEPRE ."setting  values('site_alias','站点别名')";
     	$this->db->query($sql_setting1);
     	 echo ' 更新成功:更新setting表，增加site_alias<br>';
     }
       $sql_select_setting2="select * from ". DB_TABLEPRE ."setting where k='maxindex_keywords'";
     
     $result_setting2=$this->db->query($sql_select_setting2);
     $num2=0;
           while($user2 = $this->db->fetch_array($result_setting2)) {
           	
           $num2= 	count($user2);
           }
  
     if($num2>1){
     	echo "setting表maxindex_keywords,pagemaxindex_keywords存在<br>";
     }else{
     	$sql_setting2="insert into ". DB_TABLEPRE ."setting  values('maxindex_keywords','3'),('pagemaxindex_keywords','8')";
     	$this->db->query($sql_setting2);
     	 echo ' 更新成功:更新setting表，增加maxindex_keywords,pagemaxindex_keywords<br>';
     }
     //-----
      $sql_class1="alter table ".DB_TABLEPRE."user add COLUMN activecode VARCHAR(200)  DEFAULT NULL;";
       $this->db->query($sql_class1);  
       echo ' 更新成功:更新user表，增加activecode字段<br>';
     //----
     
     
     
      $sql_class1="alter table ".DB_TABLEPRE."user add COLUMN active int(10) DEFAULT 0;";
       $this->db->query($sql_class1);  
       echo ' 更新成功:更新user表，增加active字段<br>';
     //------
     
      $sql_class1="alter table ".DB_TABLEPRE."category add COLUMN alias VARCHAR(200) DEFAULT NULL;";
  $this->db->query($sql_class1);  
       echo ' 更新成功:更新category表，增加alias字段<br>';
       
       //-------
       
        $sql_bankcard="alter table ".DB_TABLEPRE."user add COLUMN bankcard VARCHAR(200) DEFAULT NULL;";
  $this->db->query($sql_bankcard);  
       echo ' 更新成功:更新category表，增加bankcard字段<br>';
       
       
       //-------------------------------
       
       $sql_select_setting3="select * from ". DB_TABLEPRE ."setting where k='openweixin'";
     
     $result_setting3=$this->db->query($sql_select_setting3);
     $num3=0;
           while($user3 = $this->db->fetch_array($result_setting3)) {
           	
           $num3= 	count($user3);
           }
  
     if($num3>1){
     	echo "setting表openweixin存在<br>";
     }else{
     	$sql_setting3="insert into ". DB_TABLEPRE ."setting  values('openweixin','0')";
     	$this->db->query($sql_setting3);
     	 echo ' 更新成功:更新setting表，增加maxindex_keywords,pagemaxindex_keywords<br>';
     }
     
     
    
       
       //----------------------------
      //表面前缀:DB_TABLEPRE
     //1 更新setting表，增加tpl_wapdir，wap_domain
     //tpl_wapdir表示wap模板的文件夹名字  wap_domain表示手机站域名
     //查询是否存在字段
     $sql_select_setting="select * from ". DB_TABLEPRE ."setting where k='tpl_wapdir'";
     
     $result_setting=$this->db->query($sql_select_setting);
     $num=0;
           while($user = $this->db->fetch_array($result_setting)) {
           	
           $num= 	count($user);
           }
  
     if($num>1){
     	echo "setting表tpl_wapdir，wap_domain存在<br>";
     }else{
     	$sql_setting="insert into ". DB_TABLEPRE ."setting  values('tpl_wapdir','wap'),('wap_domain','')";
     	$this->db->query($sql_setting);
     	 echo '1 更新成功:更新setting表，增加tpl_wapdir，wap_domain<br>';
     }
     //----------------------
     //2  增加管理员分类表 category_admin
     
     $sql_category_admin="
CREATE TABLE IF NOT EXISTS `".DB_TABLEPRE."category_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoryid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
     ";
     
     $this->db->query($sql_category_admin);
     	 echo '2 更新成功:增加 category_admin表<br>';
     	//----------------------------------- 
     	 $sql_userbank="
CREATE TABLE IF NOT EXISTS `".DB_TABLEPRE."userbank` (
  `id` int(10) NOT NULL,
  `fromuid` int(10) NOT NULL,
  `touid` int(10) NOT NULL,
  `operation` varchar(200) NOT NULL,
   `money` int(10) NOT NULL,
  `time` int(11) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;";
     	 
      $this->db->query($sql_userbank);
     	 echo '2 更新成功:增加 userbank表<br>';	 
     	//------------------------------ 
   $sqlkeywords="
CREATE TABLE IF NOT EXISTS `".DB_TABLEPRE."keywords` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `find` varchar(200) NOT NULL,
  `replacement` varchar(200) NOT NULL,
  `admin` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;
   ";
     	  $this->db->query($sqlkeywords);
     	 echo '------ 更新成功:增加 keywords表<br>';
     	 //3 inform修改 
     	 
     	 
     	
     	 
     
     	 
     	 
     	 
     	 
     	 
     	 
     	 
     	 
     	 //----------------------------
     	 //删除 inform DROP TABLE IF EXISTS t_bd_shop_bi;
     	 $sql_inform='DROP TABLE IF EXISTS '.DB_TABLEPRE.'inform;';
     	 
     	  $this->db->query($sql_inform);
     	  
     	  $sql_create_inform="
     	  
CREATE TABLE IF NOT EXISTS `".DB_TABLEPRE."inform` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) NOT NULL,
  `uid` int(10) NOT NULL,
  `qtitle` varchar(200) NOT NULL,
  `qid` int(100) NOT NULL,
  `aid` int(11) NOT NULL,
  `content` text NOT NULL,
  `title` varchar(100) NOT NULL,
  `keywords` varchar(100) NOT NULL,
  `counts` int(11) NOT NULL DEFAULT '1',
  `time` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;";
     	 
     	 $this->db->query($sql_create_inform);  
     	 echo '3 更新INform成功<br>';
     // 4 更新 topic专题变成文章
     
    	 $sql_topic1="alter table ".DB_TABLEPRE."topic add COLUMN author VARCHAR(200) DEFAULT NULL;";
     $sql_topic2="alter table ".DB_TABLEPRE."topic add COLUMN authorid int(10) DEFAULT 1;";
     	 $sql_topic3="alter table ".DB_TABLEPRE."topic add COLUMN views int(10) DEFAULT 1;";
     	 $sql_topic4="alter table ".DB_TABLEPRE."topic add COLUMN articleclassid int(10) DEFAULT 1;";
     	  $sql_topic5="alter table ".DB_TABLEPRE."topic add COLUMN isphone int(10) DEFAULT 0;";
 	  $sql_topic6="alter table ".DB_TABLEPRE."topic add COLUMN viewtime int(10) DEFAULT 0;";
 	   $sql_topic7="alter table ".DB_TABLEPRE."topic add COLUMN ispc int(10) DEFAULT 0;";
      $sql_editcontent= "ALTER TABLE  `".DB_TABLEPRE."topic` CHANGE  `describtion`  `describtion` TEXT  DEFAULT NULL";
    
   $this->db->query($sql_editcontent);  
      $this->db->query($sql_topic1);  
     	   $this->db->query($sql_topic2);  
     	    $this->db->query($sql_topic3);  
     	     $this->db->query($sql_topic4);  
     	      $this->db->query($sql_topic5);  
     	       $this->db->query($sql_topic6);  
     	         $this->db->query($sql_topic7);  
     	  echo '4 更新topic表成功<br>';      
     	 //5 插入表
     	 
     	  $topic_tag="CREATE TABLE IF NOT EXISTS `".DB_TABLEPRE."topic_tag` (
  `aid` int(10) NOT NULL,
  `name` varchar(200) NOT NULL,
  `time` int(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
     	  ";
     	   $this->db->query($topic_tag);  
     	   echo "4.1 topic_tag文章标签表插入成功<br>";
     	  $cat_topic="
CREATE TABLE IF NOT EXISTS `".DB_TABLEPRE."topicclass` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `dir` varchar(200) NOT NULL,
  `pid` int(10) NOT NULL,
  `displayorder` int(10) NOT NULL,
  `articles` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;
     	  ";
     	   $this->db->query($cat_topic);  
     	   echo "5 topicclass表插入成功<br>";
     	   
     	      $this->config_edit();
    }
    
    
    function config_edit() {
	extract($GLOBALS, EXTR_SKIP);
	$dbhost=DB_HOST;
	$dbuser=DB_USER;
	$dbpw=DB_PW;
	$dbname=DB_NAME;
	
	$tablepre=DB_TABLEPRE;
	define('TIPASK_ROOT', dirname(__FILE__).'/../');
	define('CONFIG', TIPASK_ROOT.'./config.php');
	$config = "<?php \r\ndefine('DB_HOST', '$dbhost');\r\n";
	$config .= "define('DB_USER', '$dbuser');\r\n";
	$config .= "define('DB_PW', '$dbpw');\r\n";
	
	$config .= "define('DB_NAME', '$dbname');\r\n";
	$config .= "define('DB_CHARSET', 'utf8');\r\n";
	$config .= "define('DB_TABLEPRE', '$tablepre');\r\n";
	$config .= "define('DB_CONNECT', 0);\r\n";
	$config .= "define('ASK2_CHARSET', 'UTF-8');\r\n";
	$config .= "define('ASK2_VERSION', '3.1.1');\r\n";
	$config .= "define('ASK2_RELEASE', '20160518');\r\n";
	$fp = fopen(CONFIG, 'w');
	fwrite($fp, $config);
	fclose($fp);
	exit("重新配置成功");
}
    

}

?>