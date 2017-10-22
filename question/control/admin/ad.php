<?php

!defined('IN_ASK2') && exit('Access Denied');

class admin_adcontrol extends base {
    var $lang;
    function admin_adcontrol(& $get, & $post) {
        $this->base($get,$post);
        $this->load('ad');
        //加载语言包
        Language::read('admin/ad');
        $this -> lang = Language::getLangContent();
    }

    function ondefault($type=0)
	{
		if(isset($_GET['type']))$type=$_GET['type'];
		if(isset($this -> post['cid']) || isset($this -> post['sid'])){
			$type = $this-> post['type'];
			if( isset($this->post['cid']) ){
				$id = implode(',',$this->post['cid']);
			}else{
				$id = implode(',',$this->post['sid']);
			}
			$re = $_ENV['ad']->delete_all($id);
			if($re){
				$this -> log('删除问答系统轮播图[ID:'.$id.']');
				$message = '删除成功';
			}else{
				$message = '删除失败';
			}
        }
        $lang = $this -> lang;
        $ad_list = $_ENV['ad']->select_shuffling();
        include template("adlist", "admin");
    }

    /**
     * 图片上传
     */
    function onimageUpload()
    {
        $path = ASK2_ROOT."/data/uploads/shuffling/";
        $extArr = array("jpg", "png", "gif");
        if(isset( $this -> post ) and $_SERVER['REQUEST_METHOD'] == "POST"){
            $name = $_FILES['photoimg']['name'];
            $size = $_FILES['photoimg']['size'];
            if(empty($name)){
                echo $this -> lang['ad_controller_image_upload_image_empty'];
                exit;
            }
            $ext = $this -> extend($name);
            if(!in_array($ext,$extArr)){
                echo $this -> lang['ad_controller_image_upload_image_type_error'];
                exit;
            }
            if($size>(1024*1024)){
                echo $this -> lang['ad_controller_image_upload_image_size_big'];
                exit;
            }
            $image_name = time().rand(100,999).".".$ext;
            $tmp = $_FILES['photoimg']['tmp_name'];
            if(move_uploaded_file($tmp, $path.$image_name)){
                echo '<div><a href="javascript:void(0)" data-reveal-id="myModal" img_src="'.SITE_URL.'data/uploads/shuffling/'.$image_name.'" title="'.$this->lang['ad_controller_image_upload_click_preview'].'"><img src="'.SITE_URL.'data/uploads/shuffling/'.$image_name.'" class="preview" alt="'.$this->lang['ad_controller_image_upload_click_preview'].'" ></a><br><input type="text" name="url" placeholder="'.$this->lang['ad_controller_image_upload_text_placeholder'].'"><br>&nbsp;<br><input type="text" name="title" placeholder="请输入图片标题"></div>';
            }else{
                echo $this->lang['ad_controller_image_upload_upload_fail'];
            }
            exit;
        }
        exit;
    }

    function extend($file_name){
        $extend = pathinfo($file_name);
        $extend = strtolower($extend["extension"]);
        return $extend;
    }

    /**
     * 新增轮播图
     */
    function oninsertShuffling()
    {
        if(isset($_GET['src']) && isset($_GET['url'])) {
            $src = $_GET['src'];
            $url = $_GET['url'];
			$title = $_GET['title'];
            $arr1 = explode(',', $url);
            $arr = explode(',', $src);
            $arr2 = explode(',', $title);
            $newArr = array();
            $time = time();
            foreach ($arr as $key => $val) {
                $newArr[$key]['url'] = $arr1[$key];
                $newArr[$key]['title'] = $arr2[$key];
                $newArr[$key]['src'] = $val;
                $newArr[$key]['time'] = $time;
                $newArr[$key]['type'] = 0;
            }

            $re = $_ENV['ad']->insert_shuffling($newArr);
            if ($re) {
                $this -> log('新增问答系统轮播图');
                echo 1;
            } else {
                echo 0;
            }
        }else{
            echo 0;
        }
    }

    /**
     * 图片上传
     */
    function onimageUpload1()
    {
        $path = ASK2_ROOT."/data/uploads/special/";
        $extArr = array("jpg", "png", "gif");
        if(isset( $this -> post ) and $_SERVER['REQUEST_METHOD'] == "POST"){
            $name = $_FILES['photoimg']['name'];
            $size = $_FILES['photoimg']['size'];
            if(empty($name)){
                echo '请选择要上传的图片';
                exit;
            }
            $ext = $this -> extend($name);
            if(!in_array($ext,$extArr)){
                echo '图片格式错误！';
                exit;
            }
            if($size>(1024*1024)){
                echo '图片大小不能超过1M';
                exit;
            }
            $image_name = time().rand(100,999).".".$ext;
            $tmp = $_FILES['photoimg']['tmp_name'];
            if(move_uploaded_file($tmp, $path.$image_name)){
                echo '<div style="float:right;"><img src="'.SITE_URL.'data/uploads/special/'.$image_name.'"  class="preview"><br><input type="text" name="url" placeholder="请输入图片点击跳转地址"><br>&nbsp;<br><input type="text" name="title" placeholder="请输入图片标题"></div>';
            }else{
                echo '上传出错了！';
            }
            exit;
        }
        exit;
    }
    /**
     * 新增活动专题
     */
    function onspecial()
    {
        if(isset($_GET['src']) && isset($_GET['url'])) {
            $src = $_GET['src'];
            $url = $_GET['url'];
            $title = $_GET['title'];
            $arr = explode(',', $src);
            $arr1 = explode(',', $url);
            $arr2 = explode(',', $title);
            $newArr = array();
            $time = time();
            foreach ($arr as $key => $val) {
                $newArr[$key]['url'] = $arr1[$key];
                $newArr[$key]['title'] = $arr2[$key];
                $newArr[$key]['src'] = $val;
                $newArr[$key]['time'] = $time;
                $newArr[$key]['type'] = 1;
            }
            $re = $_ENV['ad']->insert_shuffling($newArr);
            $this -> log('新增问答系统活动专题');
            if ($re) {
                $this->cache->remove('adlist');
                echo 1;
            } else {
                echo 0;
            }
        }else{
            echo 0;
        }
    }
	
	/**
	 *编辑
	 */
	function onedit()
	{
		$id = $this->get[2];
		$arr = $_ENV['ad'] -> getOne($id);
		if(is_array($arr) && count($arr)>0){
			include template("editad","admin");
		}else{
			echo "alert('未找到该记录');location.history.go(-1)";
		}
	}
	
	/**
	 *修改
	 */
	function oneditInfo()
	{
		if( isset( $this -> post['form_submit'] ) ){
			$data = array();
			if( isset( $_FILES['adv_pic'] ) ){
				$path = ASK2_ROOT."/data/uploads/special/";
				$extArr = array("jpg", "png", "gif","jpeg");
				$name = $_FILES['adv_pic']['name'];
				$size = $_FILES['adv_pic']['size'];
				if(empty($name)){
					echo '<script>alert("请选择要上传的图片");location.history.go(-1)</script>';
					exit;
				}
				$ext = $this -> extend($name);
				if(!in_array($ext,$extArr)){
					echo '<script>alert("图片格式错误！");location.history.go(-1)</script>';
					exit;
				}
				if($size>(1024*1024)){
					echo '<script>alert("图片大小不能超过1M");location.history.go(-1)</script>';
					exit;
				}
				$image_name = $this->time.rand(100,999).".".$ext;
				$tmp = $_FILES['adv_pic']['tmp_name'];
				if(move_uploaded_file($tmp, $path.$image_name)){
					$data['src'] = SITE_URL.'data/uploads/special/'.$image_name;
				}else{
					echo '<script>alert("上传出错了！");location.history.go(-1)</script>';
				}
			}
			$data['id'] = $this -> post['id'];
			$data['url'] = isset($this -> post['url']) ? $this -> post['url'] : '';
			$data['title'] = isset($this -> post['title']) ? $this -> post['title'] : '';
			$data['time'] = $this -> time;
			$re = $_ENV['ad'] -> edit($data);
			if($re){
				$msg = ($this->post['type']==0) ? '轮播图' : '活动专题' ;
				$this -> log('编辑问答系统'.$msg.'[ID:'.$this->post['id'].']');
				$this -> ondefault($this->post['type']);
			}else{
				echo '<script>alert("编辑失败");location.history.go(-1)</script>';
			}
		}
	}
}

?>