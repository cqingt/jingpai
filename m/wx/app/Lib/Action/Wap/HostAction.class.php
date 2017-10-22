<?php
class HostAction extends BaseAction{
    public function index(){
        $agent = $_SERVER['HTTP_USER_AGENT']; 
        if(!strpos($agent,"icroMessenger")) {
           // echo '此功能只能在微信浏览器中使用';exit;
        }
        $token      = $this->_get('token'); 
        $hid         = $this->_get('hid'); 
        $where      = array('token'=>$token,'hid'=>$hid);             
        $list_add     = M('Host_list_add')->where($where)->select();   
        $hostset =  M('Host')->where(array('token'=>$token,'id'=>$hid))->find();
        $this->assign('list',$list_add);
        //company info
        $company_db=M('Company');
        $thisCompany=$company_db->where(array('token'=>$token,'isbranch'=>0))->find();
        $hostset['address']=$thisCompany['address'];
        $this->assign('set',$hostset);
      //  $this->assign('isAndroid',isAndroid());
        $this->display();
    }
    
    //首次进入，罗列在线商家
    public function online($display=1){
        $agent = $_SERVER['HTTP_USER_AGENT']; 
        if(!strpos($agent,"icroMessenger")) {
            echo '此功能只能在微信浏览器中使用';exit;
        }
        $token      = $this->_get('token'); 
        if(empty($token))  $this->error('非法操作');

        $where      = array('token'=>$token); 
        $data=M('Host');
        $count      = $data->where( $where )->count();
        $Page       = new Page($count,7);
        $show       = $Page->show();
        $list = $data->where( $where )->limit($Page->firstRow.','.$Page->listRows)->select();

        $this->assign('list',$list);
        $this->assign('show',$show);
        //
        $hid         = $this->_get('hid'); 
        $hostset =  M('Host')->where(array('token'=>$token,'id'=>$hid))->find();
        $this->assign('set',$hostset);
        if ($display){
        $this->display();
        }
    }
    public function companyDetail(){
    	$this->online(0);
    	$this->display();
    }
    public function lists(){
       $agent = $_SERVER['HTTP_USER_AGENT']; 
        if(!strpos($agent,"MicroMessenger")) {
            echo '此功能只能在微信浏览器中使用';exit;
        }
       $id    = $this->_get('id');
       $token = $this->_get('token');
       $hid = $this->_get('hid');
       $wecha_id = $this->_get('wecha_id');
       $userinfo = M('userinfo')->where(array('wecha_id'=>$wecha_id,'token'=>$token))->find();

       $host = M('Host')->where(array('id'=>$hid,'token'=>$token))->find();
       $where = array('id'=>$id,'token'=>$token);
       $types = M('Host_list_add')->where($where)->find();
	   //dump($types);
       $this->assign('types',$types);
       $save_monery = $types['price'] - $types['yhprice']; 
       $this->assign('userinfo',$userinfo);
       $this->assign('saves',$save_monery );
       $this->assign('host',$host);
        
        $this->display();

    }
    
    //在线预定
    public function book(){ 
        $agent = $_SERVER['HTTP_USER_AGENT']; 
        if(!strpos($agent,"MicroMessenger")) {
            echo '此功能只能在微信浏览器中使用';exit;
        }
        if($_POST['action'] == 'book'){           

            $data['wecha_id']  =  $this->_post('wecha_id');
            $data['book_people']  =  $this->_post('truename'); 
            $data['remarks']   =  $this->_post('remarks');  
            $data['tel']       = $this->_post('tel');  
            $data['book_num']      = $this->_post('nums'); 
            $data['book_time']  = strtotime($this->_post('dateline'));           
            $id       = $this->_post('id');
            $data['room_type'] = $this->_post('roomtype'); 
            $data['order_status'] = 3 ;
            $data['hid'] = $this->_get('hid');
            $data['token'] = $this->_get('token');

            $price = M('Host_list_add')->where(array('id'=>$id,'token'=>$data['token'],'hid'=>$data['hid']))->find();

            $data['price'] = $price['yhprice'] * $data['book_num'];
                    
          
            $order = M('Host_order')->data($data)->add();    

            if($order){
                echo'{"success":1,"msg":"恭喜,预定成功。"}';
				$info=M('Wxuser')->where(array('token'=>$this->_get('token')))->find();
				$content = "您的" .$data['room_type']. "已被" . $data['book_people'] . "电话" . $data['tel']."预订，预订时间" .date(Y-m-d,$data['book_time']). "数量" .$data['book_num']. "备注：".$data['remarks'];
				// 增加 发送短信
				if ($smsstatus == 1) {
					$phone=$info['phone'];
					$user=$info['smsuser'];//短信平台帐号
					$pass=md5($info['smspassword']);//短信平台密码
					$smsstatus=$info['smsstatus'];//短信平台状态
					$smsrs = file_get_contents('http://api.smsbao.com/sms?u='.$user.'&p='.$pass.'&m='.$phone.'&c='.urlencode($content));
					//$log = file_get_contents('http://www.test.com/test.php?u=' . $user . '&p=' . $pass . '&m=' . $phone . '&test=' . urlencode($content));
				}
				// 发送短信结束
				// 增加 发送邮件
				if ($emailstatus == 1) {
					$email=$info['email'];
					$emailuser=$info['emailuser'];
					$emailpassword=$info['emailpassword'];
					$emailstatus=$info['emailstatus'];
					date_default_timezone_set('PRC');
					require_once 'class.phpmailer.php';
					//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
					$mail = new PHPMailer();
					$body = $content;
					$mail->IsSMTP();
					// telling the class to use SMTP
					$mail->Host = 'smtp.qq.com';
					// SMTP server
					$mail->SMTPDebug = '1';
					// enables SMTP debug information (for testing)
					// 1 = errors and messages
					// 2 = messages only
					$mail->SMTPAuth = true;
					// enable SMTP authentication
					$mail->Host = 'smtp.qq.com';
					// sets the SMTP server
					$mail->Port = 25;
					// set the SMTP port for the GMAIL server
					$mail->Username = $emailuser;
					// SMTP account username
					$mail->Password = $emailpassword;
					// SMTP account password
					$mail->SetFrom($emailuser.'@qq.com', '微信平台');
					$mail->AddReplyTo($emailuser.'@qq.com', '微信平台');
					$mail->Subject = '客户订单';
					$mail->AltBody = '';
					// optional, comment out and test
					$mail->MsgHTML($body);
					$address = $email;
					$mail->AddAddress($address, '商户');
					$emailrs = $mail->Send();
					//$log = file_get_contents('http://www.test.com/test.php?u=' . $user . '&p=' . $pass . '&m=' . $phone . '&test=' . urlencode($content));
				}
				
			}else{
                echo'{"success":0,"msg":"请从新预定。"}';
            }            
            exit;
        }    
            
        
    }
}
    
?>