<?php

!defined('IN_ASK2') && exit('Access Denied');

class api_articlecontrol extends base {

	var $apikey='';
		var $whitelist;
	//构造函数
    function api_articlecontrol(& $get, & $post) {
        $this->base($get,$post);
        $this->load('topic');
     $this->whitelist="list,newqlist,hotqlist,hotalist";
    }
    function onlist(){
    	
          $content = array();
        $query = $this->db->query("SELECT * FROM " . DB_TABLEPRE . "topic order by id desc LIMIT 0,9");
        while ($topic = $this->db->fetch_array($query)) {
           
  //$topic['viewtime'] = tdate($topic['viewtime']);
  $description=cutstr(strip_tags($topic['describtion']),120,'');

  if(strstr($topic['image'],'http')){
  	 $content[] = array("Title"=>$topic['title'], "Description"=>$description, "PicUrl"=> $topic['image'], "Url" =>'http://' . $_SERVER['HTTP_HOST'].'/article-'.$topic['id']);
  }else{
  	 $content[] = array("Title"=>$topic['title'], "Description"=>$description, "PicUrl"=> 'http://' . $_SERVER['HTTP_HOST'].$topic['image'], "Url" =>'http://' . $_SERVER['HTTP_HOST'].'/?article-'.$topic['id']);
  }
            
        }
        echo json_encode($content);
    }
    function onnewqlist(){
    	
          $questionlist = array();
        $query = $this->db->query("SELECT * FROM " . DB_TABLEPRE . "question where status=1 order by id desc LIMIT 0,9");

           
  
  $description=cutstr(strip_tags($question['describtion']),120,'');
          while ($question = $this->db->fetch_array($query)) {
         
           $question['describtion']=cutstr(strip_tags($question['describtion']),120,'');
 $question['avatar']=get_avatar_dir($question['authorid']);
            $question['url'] ='http://' . $_SERVER['HTTP_HOST'].'/?q-'.$question['id'].'.html';
            $questionlist[] = $question;
        }
    
        echo json_encode($questionlist);
    }
   function onhotqlist(){
    	
          $attentionlist=$this->fromcache('attentionlist');
    
          foreach ($attentionlist as $key=>$val){
          	$attentionlist[$key]['url']='http://' . $_SERVER['HTTP_HOST'].'/?q-'.$attentionlist[$key]['id'].'.html';
          	 $attentionlist[$key]['avatar']=get_avatar_dir($attentionlist[$key]['authorid']);
          }
         
        echo json_encode($attentionlist);
    }
   function onhotalist(){
    	$content = array();
          $modellist=$this->fromcache('hottopiclist');
    
        
          $i=1;
          foreach ($modellist as $key=>$val){
          	if($i>=9)break;
          //$topic['viewtime'] = tdate($topic['viewtime']);
  $description=cutstr(strip_tags($modellist[$key]['describtion']),120,'');

  if(strstr($modellist[$key]['image'],'http')){
  	 $content[] = array("Title"=>$modellist[$key]['title'], "Description"=>$description, "PicUrl"=> $modellist[$key]['image'], "Url" =>'http://' . $_SERVER['HTTP_HOST'].'/article-'.$modellist[$key]['id']);
  }else{
  	 $content[] = array("Title"=>$modellist[$key]['title'], "Description"=>$description, "PicUrl"=> 'http://' . $_SERVER['HTTP_HOST'].$modellist[$key]['image'], "Url" =>'http://' . $_SERVER['HTTP_HOST'].'/?article-'.$modellist[$key]['id']);
  }
  $i++;
          }
         
        echo json_encode($content);
    }
}

?>