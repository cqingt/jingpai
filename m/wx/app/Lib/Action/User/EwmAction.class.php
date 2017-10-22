<?php
/*
 *扫码关注
数据表结构说明
CREATE TABLE `wx_ewm` (
  `E_Id` int(10) NOT NULL AUTO_INCREMENT,
  `E_Name` varchar(100) NOT NULL COMMENT'场景名',
  `E_Desc` text NOT NULL COMMENT'场景描述',
  `E_EwmClass` tinyint(2) NOT NULL COMMENT'1:图文回复;',
  `E_Ticket` varchar(200) DEFAULT NULL COMMENT'换取二维码值',
  `E_Url` varchar(200) DEFAULT NULL COMMENT'跳转地址',
  `E_ImgUrl` varchar(300) DEFAULT NULL COMMENT'二维码地址',
  `E_Uid` int(10) NOT NULL COMMENT'添加人uid',
  `E_Token` varchar(50) NOT NULL COMMENT'公众号token',
  `E_Time` char(11) DEFAULT NULL COMMENT'注释',
  PRIMARY KEY (`E_Id`),
  KEY `E_Token` (`E_Token`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

*/
class EwmAction extends UserAction{
	protected function _initialize()
    {
        parent::_initialize();
        $array = array(
        	'hfType'=>array(
        		'2'=>'图文回复',
        		),
        	);
    }


	/*主列表*/
	public function index(){
		$model = M('Ewm');
		$result = $model->where()->select();

		$count = $model->count();
		$page = new Page($count,5);
		$info = $model->where("E_Token='%s'",session('token'))->limit($page->firstRow.','.$page->listRows)->order('E_Id DESC')->select();
		$this->assign('info',$info);
		$this->assign('page',$page->show());



		$this->display('List');
	}

	/*添加二维码*/
	public function add(){
		
		$this->display('Add');
	}

	/*二维码提交*/
	public function doAdd(){
		$dataArr['E_Name'] = $_POST['E_Name'];
		$dataArr['E_Desc'] = $_POST['E_Desc'];
		$dataArr['E_EwmClass'] = $_POST['E_EwmClass'];
		$dataArr['E_Uid'] = session('uid');
		$dataArr['E_Token'] = session('token');
		$dataArr['E_Time'] = time();

		/*添加数据，ID为二维码数据*/
		$model = M('Ewm');
		$ewmid = $model->add($dataArr);

		if(!empty($ewmid)){
			/*创建二维码*/
			/*如果E_Uid为一则是永久，二临时*/
			$appid = M('DiymenSet')->where("token='%s'",$dataArr['E_Token'])->find();
			$this->weixin = new WeixinSDK();
			$this->weixin->usertoken = $dataArr['E_Token'];
			$this->weixin->app_id = $appid['appid'];
			$this->weixin->appsecret = $appid['appsecret'];
	        $this->weixin->index();
	        /*生成二维码*/
	        $object = $this->ewmImg($ewmid);
	        $updata['E_Ticket'] = $object['0']->ticket;
	        $updata['E_Url'] = $object['0']->url;
	        $updata['E_ImgUrl'] = $object['1'];
	        /*数据库加上二维码数据*/
	        if($model->where('E_Id=%d',$ewmid)->save($updata)){
	        	$this->success('添加成功',"index.php?g=User&m=Ewm&a=index&token=".session('token'));
	        }else{
	        	$model->where('E_Id=%d',$ewmid)->delete();
	        	$this->error('添加失败');
	        }
		}else{
			$this->error('添加失败');
		}
	}

	/*修改二维码*/
	public function save(){
		
		$this->display('Save');
	}

	/*删除二维码数据*/
	public function del(){
		$id = intval($_GET['id']);
		M('Ewm')->where('E_Id=%d',$id)->delete();
		M('EwmContent')->where('C_Eid=%d',$id)->delete();
		$this->success('操作成功');
	}


	/*添加二维码回复内容*/
	public function addContent(){
		$id = intval($_GET['id']);
		$result = $this->guanzhuHuifu($id);
		if(!empty($result)){
			/*修改*/

			/*关键词*/
			$model = M('Img');		
			$ci = $model->field('id,keyword')->where("type=2 AND token='%s'",session('token'))->order('id DESC')->select();


			$this->assign('result',$result);
			$this->assign('ci',$ci);
			$this->display('UpContent');
		}else{
			/*添加*/
			$this->assign('add',true);
			$this->assign('Eid',$id);
			$this->display('AddContent');
		}
	}

	/*提交二维码回复内容*/
	public function doAddContent(){

		/*实例数据库*/
		$model = M('EwmContent');
		/*接收数据*/
		$dataArr['C_Eid'] = $_POST['C_Eid'];
		$dataArr['C_Name'] = $_POST['C_Name'];
		$dataArr['C_Content'] = $_POST['C_Content'];
		$dataArr['C_ImgUrl'] = $_POST['pic'];
		$dataArr['C_Url'] = $_POST['C_Url'];
		$dataArr['C_Gid'] = $_POST['guanjianci'];
		$dataArr['C_Time'] = time();

		/*查找是否有重复*/
		$repeatEid = $model->where('C_Eid=%d',$dataArr['C_Eid'])->find();


		if(!empty($repeatEid)){
			$this->error('数据库已存在该数据');
		}else{
			/*判断是否关联关键词*/
			if($dataArr['C_Gid']){
				$data['C_Eid'] = $dataArr['C_Eid'];
				$data['C_Gid'] = $dataArr['C_Gid'];
				$data['C_Time'] = time();
			}else{
				$data['C_Eid'] = $dataArr['C_Eid'];
				$data['C_Name'] = $dataArr['C_Name'];
				$data['C_Content'] = $dataArr['C_Content'];
				$data['C_ImgUrl'] = $dataArr['C_ImgUrl'];
				$data['C_Url'] = $dataArr['C_Url'];
				$data['C_Time'] = time();
			}
			/*添加数据*/
			$id = $model->add($data);
			if($id){
				$this->success('添加成功','index.php?g=User&m=Ewm&a=index&token='.session('token'));
			}else{
				$this->error('添加失败');
			}
		}
	}


	/*修改二维码回复内容*/
	public function doUpContent(){

		/*实例数据库*/
		$model = M('EwmContent');
		/*接收数据*/
		$dataArr['C_Id'] = $_POST['C_Id'];
		$dataArr['C_Eid'] = $_POST['C_Eid'];
		$dataArr['C_Name'] = $_POST['C_Name'];
		$dataArr['C_Content'] = $_POST['C_Content'];
		$dataArr['C_ImgUrl'] = $_POST['pic'];
		$dataArr['C_Url'] = $_POST['C_Url'];
		$dataArr['C_Gid'] = $_POST['guanjianci'];
		$dataArr['C_Time'] = time();

		/*判断是否关联关键词*/
		if($dataArr['C_Gid']){
			$data['C_Name'] = null;
			$data['C_Content'] = null;
			$data['C_ImgUrl'] = null;
			$data['C_Url'] = null;
			$data['C_Gid'] = $dataArr['C_Gid'];
		}else{
			$data['C_Name'] = $dataArr['C_Name'];
			$data['C_Content'] = $dataArr['C_Content'];
			$data['C_ImgUrl'] = $dataArr['C_ImgUrl'];
			$data['C_Url'] = $dataArr['C_Url'];
			$data['C_Gid'] = null;
		}

		/*添加数据*/
		$id = $model->where('C_Id=%d AND C_Eid=%d',array($dataArr['C_Id'],$dataArr['C_Eid']))->save($data);
		if($id){
			$this->success('修改成功','index.php?g=User&m=Ewm&a=index&token='.session('token'));
		}else{
			$this->error('修改失败');
		}
	}



	/*AJAX提出关键词*/
	public function ajaxGuanjianci(){
		$model = M('Img');		
		$result = $model->field('id,keyword')->where("type=2 AND token='%s'",session('token'))->order('id DESC')->select();
		$select = '<select onchange="selectGuanjiancifunction()" required="required" name="guanjianci" id="guanjianci">';
		$select .= "<option value=''>请选择</option><br/>";
		foreach($result as $k=>$v){
			$select .= "<option value='{$v['id']}'>{$v['keyword']}</option><br/>";
		}
		$select .= '</select>';

		echo $select;
	}

	/*取出关键词信息*/
	public function getGuanjianci(){
		$gid = intval($_GET['gid']);
		$model = M('Img');	
		$result = $model->where('id=%d',$gid)->find();
		echo json_encode($result);
	}





/**



*/



	/*获取二维码图片*/
	/*获取到用户CODE值*/
    private function ewmImg($id){
        $array = array(
            'action_name'=>'QR_LIMIT_SCENE',
            'action_info'=>array(
                'scene'=>array(
                    'scene_id'=>"{$id}"
                    )
                )
            );

        $array = json_encode($array);
        $url = "https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=".$this->weixin->token;
        $result = $this->weixin->httpsPOST($url,$array);

        $object = json_decode($result);

        $rurl = "https://mp.weixin.qq.com/cgi-bin/showqrcode?ticket=".urlencode($object->ticket);

        return array($object,$rurl);
    }


    /*已关注状态扫码回复*/
    private function guanzhuHuifu($id){
        $result = M('EwmContent')->where('C_Eid=%d',$id)->find();
        if($result['C_Gid']){
            $res_g = M('Img')->where('id=%d',$result['C_Gid'])->find();
            if(!empty($res_g)){
            $data['C_Id'] = $result['C_Id'];
            $data['C_Eid'] = $result['C_Eid'];
            $data['C_Name'] = $res_g['title'];
            $data['C_Content'] = $res_g['text'];
            $data['C_ImgUrl'] = $res_g['pic'];
            $data['C_Url'] = $res_g['url'];
            $data['C_Gid'] = $result['C_Gid'];
        	}
        }else{
        	if(!empty($result)){
            $data['C_Id'] = $result['C_Id'];
            $data['C_Eid'] = $result['C_Eid'];
            $data['C_Name'] = $result['C_Name'];
            $data['C_Content'] = $result['C_Content'];
            $data['C_ImgUrl'] = $result['C_ImgUrl'];
            $data['C_Url'] = $result['C_Url'];
            $data['C_Gid'] = $result['C_Gid'];
        	}
        }
        return $data;
    }

}
?>