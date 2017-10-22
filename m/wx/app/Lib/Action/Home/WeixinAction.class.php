<?php
class WeixinAction extends Action
{
    private $token;
    private $fun;
    private $data = array();
    private $my = '小微';
    private $myapi = 'http://www.xiaojo.com/jsonapi.php?db=freeapi&pw=111111&chat=';
    public function index()
    {
        $this->token = $this->_get('token');
        $weixin = new Wechat($this->token);
        $data = $weixin->request();
        $this->data = $weixin->request();
        $this->my = C('site_my');
        list($content, $type) = $this->reply($data);

        foreach ($content as $k => &$v) {
            $v = str_replace('wx/wx','wx',$v);
        }

        $weixin->response($content,$type);
    }
    private function reply($data)
    {   


        if ('CLICK' == $data['Event']) {
            $data['Content'] = $data['EventKey'];
        }
        if ('voice' == $data['MsgType']) {
            $data['Content'] = $data['Recognition'];
        }


        /*2015-11-04 新增扫描二维码回复 PS:已关注状态*/
        if ('SCAN' == $data['Event']) {

            /*2016-02-16 Add is name lt 收藏天下年会活动*/
            if($data['EventKey'] == '8907'){
                $getJm = M('NianhuiSet')->where("S_Id=1")->find();

                if($getJm['S_Type'] != 1){
                    return array('签到未开启或已关闭！', 'text');
                }

                $nianhui_result = $this->nianHuiTouPiao($data['FromUserName']);
                if($nianhui_result == false){
                    return array('数据异常、请重新扫描！', 'text');
                }
            }
            /*End*/

            $type = substr($data['EventKey'],0,2);
            if($type == '52'){
                //96567商家个人中心绑定
                $huifuarray = $this->bangdinghuifu('107');
                $userid = substr($data['EventKey'],2,strlen($data['EventKey']));
                $this->bangdingwx($userid,$data['FromUserName']);
                return array($huifuarray,'news');
            }else{
                $this->saomaClick($data['EventKey']);
                return array($this->guanzhuHuifu($data['EventKey']), 'news');
            }
            exit;
        }
        /*End*/

        if ('subscribe' == $data['Event']) {
            /*2015-11-04 新增扫描二维码回复 PS:未关注状态*/
            if($data['Ticket']){
                $key = explode('_',$data['EventKey']);

                /*2016-02-16 Add is name lt 收藏天下年会活动*/
                if($key == '8907'){
                    $getJm = M('NianhuiSet')->where("S_Id=1")->find();

                    if($getJm['S_Type'] != 1){
                        return array('签到未开启或已关闭！', 'text');
                    }

                    $nianhui_result = $this->nianHuiTouPiao($data['FromUserName']);
                    if($nianhui_result == false){
                    return array('数据异常、请重新扫描！', 'text');
                    }
                }
                /*End*/

                $type = substr($key[1],0,2);
                if($type == '52'){
                    //96567商家个人中心绑定
                    $huifuarray = $this->bangdinghuifu('107');
                    $userid = substr($key[1],2,strlen($key[1]));
                    $this->bangdingwx($userid,$data['FromUserName']);
                    return array($huifuarray,'news');
                }else{
                    $this->saomaClick($key[1]);
                    return array($this->guanzhuHuifu($key[1]), 'news');
                }
                exit;
            }
            /*End*/

            $this->requestdata('follownum');
            /*关注后的OpenId相关操作 09-23 LT Add*/
            // file_get_contents('http://m.96567.com/wx/index.php?g=Home&m=IsOpen&a=index&openid='.$data['FromUserName']);
            /* End */
            $data = M('Areply')->field('home,keyword,content')->where(array('token' => $this->token))->find();
            if ($data['keyword'] == '首页' || $data['keyword'] == 'home') {
                return $this->shouye();
            }
            if ($data['home'] == 1) {
                $like['keyword'] = array('like', ('%' . $data['keyword']) . '%');
                $like['token'] = $this->token;
                $back = M('Img')->field('id,text,pic,url,title')->limit(9)->order('id desc')->where($like)->select();
                foreach ($back as $keya => $infot) {
                    if ($infot['url'] != false) {
                        $url = html_entity_decode($this->getFuncLink($infot['url']));
                    } else {
                        $url = rtrim(C('site_url'), '/') . U('Wap/Index/content', array('token' => $this->token, 'id' => $infot['id'], 'wecha_id' => $this->data['FromUserName']));
                    }
                    $return[] = array($infot['title'], $infot['text'], $infot['pic'], $url);
                }

                return array($return, 'news');
            } else {
                return array($data['content'], 'text');
            }
        } elseif ('unsubscribe' == $data['Event']) {
            $this->requestdata('unfollownum');
        }
        if (!stripos($this->fun, 'api') && $data['Content']) {
            $like['keyword'] = array('like', '%' . $data['Content']);
            $like['token'] = $this->token;
            $api = M('api')->where($like)->order('id desc')->find();
            if ($api != false) {
                $vo['fromUsername'] = $this->data['FromUserName'];
                $vo['Content'] = $this->data['Content'];
                $vo['toUsername'] = $this->token;
                if ($api['type'] == 2) {
                    $apidata = $this->api_notice_increment($api['url'], $vo);
                    return array($apidata, 'text');
                } else {
                    $apidata = $this->api_notice_increment($api['url'], $file);
                    echo $apidata;
                    return false;
                }
            }
        }

        $Pin = new GetPin();
        $key = $data['Content'];
        $open = M('Token_open')->where(array('token' => $this->_get('token')))->find();
        $this->fun = $open['queryname'];
        $datafun = explode(',', $open['queryname']);

        $tags = $this->get_tags($key);

        $back = explode(',', $tags);

        foreach ($back as $keydata => $data) {
            $string = $Pin->Pinyin($data);
            if (in_array($string, $datafun) && $string) {
                $check = $this->user('connectnum');
                if ($string == 'fujin') {
                    $this->recordLastRequest($key);
                }
                $this->requestdata('textnum');
                if ($check['connectnum'] != 1) {
                    $return = C('connectout');
                    continue;
                }
                unset($back[$keydata]);
                eval(('$return= $this->' . $string) . '($back);');
                continue;
            }
        }

        if (!empty($return)) {
            if (is_array($return)) {

                return $return;
            } else {

                return array($return, 'text');
            }
        } else {

            if (!(strpos($key, 'cheat') === FALSE)) {
                $arr = explode(' ', $key);
                $datas['lid'] = intval($arr[1]);
                $lotteryPassword = $arr[2];
                $datas['prizetype'] = intval($arr[3]);
                $datas['intro'] = $arr[4];
                $datas['wecha_id'] = $this->data['FromUserName'];
                $thisLottery = M('Lottery')->where(array('id' => $datas['lid']))->find();
                if ($lotteryPassword == $thisLottery['parssword']) {
                    $rt = M('Lottery_cheat')->add($datas);
                    if ($rt) {
                        return array('设置成功', 'text');
                    }
                    return array('设置失败:未知原因', 'text');
                } else {
                    return array('设置失败:密码不对', 'text');
                }
            }
            if ($this->data['Location_X']) {
                $this->recordLastRequest(($this->data['Location_Y'] . ',') . $this->data['Location_X'], 'location');
                return $this->map($this->data['Location_X'], $this->data['Location_Y']);
            }
            if ((!(strpos($key, '开车去') === FALSE) || !(strpos($key, '坐公交') === FALSE)) || !(strpos($key, '步行去') === FALSE)) {
                $this->recordLastRequest($key);
                $user_request_model = M('User_request');
                $loctionInfo = $user_request_model->where(array('token' => $this->_get('token'), 'msgtype' => 'location', 'uid' => $this->data['FromUserName']))->find();
                if ($loctionInfo && intval($loctionInfo['time'] > time() - 60)) {
                    $latLng = explode(',', $loctionInfo['keyword']);
                    return $this->map($latLng[1], $latLng[0]);
                }
                return array('请发送您所在的位置', 'text');
            }
            switch ($key) {
            case '首页':
                return $this->home();
                break;
            case 'home':
                return $this->home();
                break;
            case '主页':
                return $this->home();
                break;
            case '地图':
                return $this->companyMap();
                break;
            case '最近的':
                $this->recordLastRequest($key);
                $user_request_model = M('User_request');
                $loctionInfo = $user_request_model->where(array('token' => $this->_get('token'), 'msgtype' => 'location', 'uid' => $this->data['FromUserName']))->find();
                if ($loctionInfo && intval($loctionInfo['time'] > time() - 60)) {
                    $latLng = explode(',', $loctionInfo['keyword']);
                    return $this->map($latLng[1], $latLng[0]);
                }
                return array('请发送您所在的位置', 'text');
                break;
            case 'lbs':
                $this->recordLastRequest($key);
                $user_request_model = M('User_request');
                $loctionInfo = $user_request_model->where(array('token' => $this->_get('token'), 'msgtype' => 'location', 'uid' => $this->data['FromUserName']))->find();
                if ($loctionInfo && intval($loctionInfo['time'] > time() - 60)) {
                    $latLng = explode(',', $loctionInfo['keyword']);
                    return $this->map($latLng[1], $latLng[0]);
                }
                return array('请发送您所在的位置', 'text');
                break;
            case '帮助':
                return $this->help();
                break;
            case '手机':
                return $this->shouji();
                break;
            case '域名':
                return $this->yuming();
                break;
            case '笑话':
                return $this->xiaohua();
                break;
            case '快递':
                return $this->kuaidi();
                break;
            case '公交':
                return $this->gongjiao();
                break;
            case '火车':
                return $this->huoche();
                break;
            case 'help':
                return $this->help();
                break;
            case '会员卡':
                return $this->member();
                break;
            case '身份证':
                return $this->shenfenzheng();
                break;
            case '会员':
                return $this->member();
                break;
            case '3g相册':
                return $this->xiangce();
                break;
            case '相册':
                return $this->xiangce();
                break;
            case '商城':
                $pro = M('reply_info')->where(array('infotype' => 'Shop', 'token' => $this->token))->find();
                return array(array(array($pro['title'], strip_tags(htmlspecialchars_decode($pro['info'])), $pro['picurl'], ((((C('site_url') . '/index.php?g=Wap&m=Product&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&sgssz=mp.weixin.qq.com')), 'news');
                break;
            case 'aaa':
                return array(array(array($pro['title'], strip_tags(htmlspecialchars_decode($pro['info'])), $pro['picurl'], ((((C('site_url') . '/cms/index.php?token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&sgssz=mp.weixin.qq.com')), 'news');
                break;
            case '订餐':
                $pro = M('reply_info')->where(array('infotype' => 'Dining', 'token' => $this->token))->find();
                return array(array(array($pro['title'], strip_tags(htmlspecialchars_decode($pro['info'])), $pro['picurl'], ((((C('site_url') . '/index.php?g=Wap&m=Product&a=dining&dining=1&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&sgssz=mp.weixin.qq.com')), 'news');
                break;
            case '留言':
                $pro = M('reply_info')->where(array('infotype' => 'Liuyan', 'token' => $this->token))->find();
                return array(array(array($pro['title'], strip_tags(htmlspecialchars_decode($pro['info'])), $pro['picurl'], (((C('site_url') . '/index.php?g=Wap&m=Liuyan&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName'])), 'news');
                break;
            case '团购':
                $pro = M('reply_info')->where(array('infotype' => 'Groupon', 'token' => $this->token))->find();
                return array(array(array($pro['title'], strip_tags(htmlspecialchars_decode($pro['info'])), $pro['picurl'], ((((C('site_url') . '/index.php?g=Wap&m=Groupon&a=grouponIndex&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&sgssz=mp.weixin.qq.com')), 'news');
                break;
            case '全景':
                $pro = M('reply_info')->where(array('infotype' => 'panorama', 'token' => $this->token))->find();
                if ($pro) {
                    return array(array(array($pro['title'], strip_tags(htmlspecialchars_decode($pro['info'])), $pro['picurl'], ((((C('site_url') . '/index.php?g=Wap&m=Panorama&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&sgssz=mp.weixin.qq.com')), 'news');
                } else {
                    return array(array(array('360°全景看车看房', '通过该功能可以实现3D全景看车看房', rtrim(C('site_url'), '/') . '/tpl/User/default/common/images/panorama/360view.jpg', ((((C('site_url') . '/index.php?g=Wap&m=Panorama&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&sgssz=mp.weixin.qq.com')), 'news');
                }
                break;
            case '微房产':
                $Estate = M('Estate')->where(array('token' => $this->token))->find();
                return array(array(array($Estate['title'], str_replace('&nbsp;', '', strip_tags(htmlspecialchars_decode($Estate['estate_desc']))), $Estate['cover'], ((((((C('site_url') . '/index.php?g=Wap&m=Estate&a=index&&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&hid=') . $Estate['id']) . '&sgssz=mp.weixin.qq.com')), 'news');
                break;
            default:


                // /*2016-02-18 Add is name lt 年会活动投票*/
                // $nianhui_jm = substr($key,0,2);
                // if(strtoupper($nianhui_jm) == 'JM'){

                //     $jm_key = strtoupper($key);
                //     $jm_openid = $this->data['FromUserName'];

                //     //检测是否报名
                //     $userinfo = M('Nianhui')->where("N_OpenId='".$jm_openid."'")->find();
                //     if(!empty($userinfo)){

                //         //是否有该节目
                //         $jminfo = M('NianhuiJm')->where("J_Number='".$jm_key."'")->find();
                //         if(empty($jminfo)){
                //             return array('0'=>'该节目编号无效、请重新投票！','1'=>'text');
                //         }

                //         if($jminfo['J_Type'] != 1){
                //             return array('0'=>'该节目投票未开启或已关闭！','1'=>'text');
                //         }

                //         //是否参与过投票
                //         $tou_info = M('NianhuiTou')->where("T_OpenId='".$jm_openid."' AND T_JmNumber='".$jm_key."'")->find();
                //         if(!empty($tou_info)){
                //             if($jm_key == "JM14"){
                //             return array('0'=>'您已参与过本节目投票、感谢您对本节目的支持！技术部全体成员恭祝您猴年大吉，万事如意！','1'=>'text');
                //             }else{
                //             return array('0'=>'您已参与过本节目投票、请勿重复投票！您还可以投其他节目，JM14期待您的一票！','1'=>'text');
                //             }
                //         }else{
                //             $tou_array['T_JmNumber'] = $jm_key;
                //             $tou_array['T_OpenId'] = $jm_openid;
                //             $tou_array['T_Time'] = time();
                //             M('NianhuiTou')->add($tou_array);

                //             if($jm_key == "JM14"){
                //             return array('0'=>'感谢您为技术部投出宝贵的一票！技术部全体成员恭祝您猴年大吉，万事如意！心想事成！','1'=>'text');
                //             }else{
                //             return array('0'=>'投票成功！您还可以投其他节目，JM14期待您的一票！','1'=>'text');
                //             }
                //         }


                //     }else{
                //         return array('0'=>'请先扫描会场二维码获取参与咨格！','1'=>'text');
                //     }

                // /*End*/
                // }else{


                    $array = $this->keyword($key);


                    //检测是否有关键词回复、没有则启用多客服
                    if($array['0'] == '' && !strstr($key, "首页") && !strstr(strtolower($key), strtolower("home"))){
                        $result = $this->transmitService();
                        echo $result;
                        exit;
                    }else{
                        return $array; 
                    }

                // }





            }
        }
    }


    /*15年添加多客服Action 09-16 LT*/
    private function transmitService()
    {
        $xmlTpl = "<xml>
        <ToUserName><![CDATA[%s]]></ToUserName>
        <FromUserName><![CDATA[%s]]></FromUserName>
        <CreateTime>%s</CreateTime>
        <MsgType><![CDATA[transfer_customer_service]]></MsgType>
        </xml>";
        $result = sprintf($xmlTpl, $this->data['FromUserName'], $this->data['ToUserName'], time());
        return $result;
    }

    /*15年中秋活动添加Action 09-14 LT*/
    public function zhongqiu($mobile,$user_openid){
        //连接活动数据表
        $hd_mysql = M('zq_hd','wx_','mysql://shop:_96567_data@localhost:3306/_96567data_');
        //检测是否参与过本活动
        $hd_result = $hd_mysql->where("H_Mobile='%s' AND H_OpenId='%s'",array($mobile,$user_openid))->find();
        if(!$hd_result){
        /*连接用户表数据库*/
        $users_mysql = M('users','ecs_','mysql://shop:_96567_data@localhost:3306/_96567data_');
        /*第一步查询手机号是否存在于数据库*/
        // 对手机号进行加密
        $mobile_jm = @file_get_contents("http://crm.96567.com/index.php?m=api&p=action&c=jmobile&mobile=".$mobile);
        // 数据中进行搜索
        $mobile_res = $users_mysql->query("SELECT * FROM `ecs_users` u  left join `ecs_user_rank` r on(u.rank_points between r.min_points and r.max_points) WHERE u.mobile_phone ='".$mobile_jm."' limit 1");
        //存在于数据库
        if($mobile_res){
            if($mobile_res[0]['rank_id'] >= '3'){
            /*把没有OPENID的用户存上OPENID*/
            // if($mobile_res[0]['openid'] == ''){ 
            // $data['openid'] = $user_openid;
            // $users_mysql->where('user_id=%d',$mobile_res[0]['user_id'])->save($data);
            // }
            /*第二步、对手机发送验证码、并记录session 、 用户OPENID 手机号 验证码*/
            $content = mt_rand('1111','9999');
            $yzm_res = file_get_contents("http://123.57.138.64:8888/sms/codeSMS.php?mobile=".$mobile."&content=你好,你的注册验证码是:".$content);
            //判断验证发送成功OR失败
            if($yzm_res == '1'){
                /*连接中秋活动验证数据库*/
                $yzm_mysql = M('zq_yzm','wx_','mysql://shop:_96567_data@localhost:3306/_96567data_');
                //删除数据库存在的数据验证
                $yzm_mysql->where("Y_Mobile='%s' AND Y_OpenId='%s'",array($mobile,$user_openid))->delete();
                //把相关信息存入数据库中
                $dataArr['Y_Mobile'] = $mobile;
                $dataArr['Y_OpenId'] = $user_openid;
                $dataArr['Y_Yzm'] = $content;
                $dataArr['Y_Uid'] = $mobile_res[0]['user_id'];
                $dataArr['Y_UserId'] = $mobile_res[0]['rank_id'];
                $dataArr['Y_UserName'] = $mobile_res[0]['rank_name'];
                $key_m = md5(md5($user_openid.$content).$user_openid);
                $dataArr['Y_Key'] = $key_m;

                /*数据验证*/
                if(!empty($mobile) && !empty($user_openid) && !empty($content)){
                    $yzm_mysql->add($dataArr);
                }

                $array = array('0'=>'您的验证码已经通过手机短信形式发送，收到后请将验证码回复至微信内；','1'=>'text');
                return $array;
            }else{
                $array = array('0'=>'很抱歉，验证码发送失败，请重新输入手机号码进行验证；','1'=>'text');
                return $array;
            }
            }else{
                $array = array('0'=>'很抱歉，您所输入的手机号码不满足活动对应的会员等级，请重新输入；','1'=>'text');
                return $array;
            }
        }else{
        //不存于数据库
            $array = array('0'=>'您未注册、请先注册','1'=>'text');
            return $array;
        }

        }else{
        //能与过本活动
            $array = array('0'=>'您好，您已成功领取过礼品，请勿重复提交信息；','1'=>'text');
            return $array;
        }
    }

    /*15年中秋活动添加验证发送活动Action 09-14 LT*/
    public function doHd($yzm,$openid){
        /*连接验证码数据库*/
        $yzm_mysql = M('zq_yzm','wx_','mysql://shop:_96567_data@localhost:3306/_96567data_');
        /*第一步、验证验证码是否和接收人匹配*/
        $yzm_result = $yzm_mysql->where("Y_Yzm='%s' AND Y_OpenId='%s'",array($yzm,$openid))->find();
        if($yzm_result['Y_Type'] == '1'){
            $array = array('0'=>'您已参与过本活动，请不要重复提交验证码，谢谢！','1'=>'text');
            return $array;
        }
        //成功匹配
        if($yzm_result){
            /*第二步、匹配的情况下根据发送人的会员等级发送活动详情*/
            /*第三步、把发送的活动详情存入中秋活动表里*/
            /*先存入数据库成功后再发送活动详情、如果存入失败则不发送*/
            //活动信息
            // $hd['1'] = "您是注册会员、不能参与本活动";
            // $hd['2'] = "您是普通会员、不能参与本活动";
            // $hd['3'] = "您是银卡会员、奖励银币一枚";
            // $hd['4'] = "您是金卡会员、奖励金币一枚";
            // $hd['5'] = "您是钻石会员、奖励钻石十克拉";
            // $hd['6'] = "您是至尊会员、奖励绝世美女";
            /*验证KEY值*/
            $key = md5(md5($yzm_result['Y_OpenId'].$yzm_result['Y_Yzm']).$yzm_result['Y_OpenId']);
            if($yzm_result['Y_Key'] == $key){
            //通过验证发送活动奖品
                // $userid = $yzm_result['Y_UserId'];
                //拼接活动数据
                $dataArr['H_Mobile'] = $yzm_result['Y_Mobile'];
                $dataArr['H_OpenId'] = $yzm_result['Y_OpenId'];
                $dataArr['H_Uid'] = $yzm_result['Y_Uid'];
                $dataArr['H_Type'] = $yzm_result['Y_UserId'];
                $dataArr['H_Rank'] = $yzm_result['Y_UserName'];
                $dataArr['H_Time'] = time();


                //连接活动数据表
                $hd_mysql = M('zq_hd','wx_','mysql://shop:_96567_data@localhost:3306/_96567data_');
                //存入数据库
                if(!empty($dataArr['H_Mobile']) && !empty($dataArr['H_OpenId'])){
                    if($hd_mysql->add($dataArr)){
                        $data['Y_Type'] = '1';
                        $yzm_mysql->where("Y_Mobile='%s' AND Y_OpenId='%s'",array($yzm_result['Y_Mobile'],$yzm_result['Y_OpenId']))->save($data);
                        $array = array('0'=>"您好，您已成功领取礼品，请等待客服与您联系确认收货信息；",'1'=>'text');
                        return $array;
                    }else{
                        $array = array('0'=>'很抱歉，4验证未通过，请重新输入手机号码进行验证；','1'=>'text');
                        return $array;
                    }
                }else{
                    $array = array('0'=>'很抱歉，3验证未通过，请重新输入手机号码进行验证；','1'=>'text');
                    return $array;
                }
            }else{
                $array = array('0'=>'很抱歉，2验证未通过，请重新输入手机号码进行验证；','1'=>'text');
                return $array;
            }
        }else{
        /*不匹配*/
            $array = array('0'=>'很抱歉，1验证未通过，请重新输入手机号码进行验证；','1'=>'text');
            return $array;
        }
    }


    public function xiangce()
    {
        $photo = M('Photo')->where(array('token' => $this->token, 'status' => 1))->find();
        $data['title'] = $photo['title'];
        $data['keyword'] = $photo['info'];
        $data['url'] = rtrim(C('site_url'), '/') . U('Wap/Photo/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName']));
        $data['picurl'] = $photo['picurl'] ? $photo['picurl'] : rtrim(C('site_url'), '/') . '/tpl/static/images/yj.jpg';
        return array(array(array($data['title'], $data['keyword'], $data['picurl'], $data['url'])), 'news');
    }
    public function companyMap()
    {
        import('Home.Action.MapAction');
        $mapAction = new MapAction();
        return $mapAction->staticCompanyMap();
    }
    public function shenhe($name)
    {
        $name = implode('', $name);
        if (empty($name)) {
            return '正确的审核帐号方式是：审核+帐号';
        } else {
            $user = M('Users')->field('id')->where(array('username' => $name))->find();
            if ($user == false) {
                return ('主人' . $this->my) . '提醒您,您还没注册吧n正确的审核帐号方式是：审核+帐号,不含+号';
            } else {
                $up = M('users')->where(array('id' => $user['id']))->save(array('status' => 1, 'viptime' => strtotime('+1 day')));
                if ($up != false) {
                    return ('主人' . $this->my) . '恭喜您,您的帐号已经审核,您现在可以登陆平台测试功能啦!';
                } else {
                    return '服务器繁忙请稍后再试';
                }
            }
        }
    }
    public function huiyuanka($name)
    {
        return $this->member();
    }
    public function member()
    {
        $card = M('member_card_create')->where(array('token' => $this->token, 'wecha_id' => $this->data['FromUserName']))->find();
        $cardInfo = M('member_card_set')->where(array('token' => $this->token))->find();
        //$this->behaviordata('Member_card_set', $cardInfo['id']);
        $reply_info_db = M('Reply_info');
        if ($card == false) {
            $where_member = array('token' => $this->token, 'infotype' => 'membercard');
            $memberConfig = $reply_info_db->where($where_member)->find();
            if (!$memberConfig) {
                $memberConfig = array();
                $memberConfig['picurl'] = rtrim(C('site_url'), '/') . '/tpl/static/images/member.jpg';
                $memberConfig['title'] = '会员卡,省钱，打折,促销，优先知道,有奖励哦';
                $memberConfig['info'] = '尊贵vip，是您消费身份的体现,会员卡,省钱，打折,促销，优先知道,有奖励哦';
            }
            $data['picurl'] = $memberConfig['picurl'];
            $data['title'] = $memberConfig['title'];
            $data['keyword'] = $memberConfig['info'];
            if (!$memberConfig['apiurl']) {
                $data['url'] = rtrim(C('site_url'), '/') . U('Wap/Card/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName']));
            } else {
                $data['url'] = str_replace('{wechat_id}', $this->data['FromUserName'], $memberConfig['apiurl']);
            }
        } else {
            $where_unmember = array('token' => $this->token, 'infotype' => 'membercard_nouse');
            $unmemberConfig = $reply_info_db->where($where_unmember)->find();
            if (!$unmemberConfig) {
                $unmemberConfig = array();
                $unmemberConfig['picurl'] = rtrim(C('site_url'), '/') . '/tpl/static/images/vip.jpg';
                $unmemberConfig['title'] = '申请成为会员';
                $unmemberConfig['info'] = '申请成为会员，享受更多优惠';
            }
            $data['picurl'] = $unmemberConfig['picurl'];
            $data['title'] = $unmemberConfig['title'];
            $data['keyword'] = $unmemberConfig['info'];
            if (!$unmemberConfig['apiurl']) {
                $data['url'] = rtrim(C('site_url'), '/') . U('Wap/Card/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName']));
            } else {
                $data['url'] = str_replace('{wechat_id}', $this->data['FromUserName'], $unmemberConfig['apiurl']);
            }
        }
        return array(array(array($data['title'], $data['keyword'], $data['picurl'], $data['url'])), 'news');
    }
    public function taobao($name)
    {
        $name = array_merge($name);
        $data = M('Taobao')->where(array('token' => $this->token))->find();
        if ($data != false) {
            if (strpos($data['keyword'], $name)) {
                $url = (($data['homeurl'] . '/search.htm?search=y&keyword=') . $name) . '&lowPrice=&highPrice=';
            } else {
                $url = $data['homeurl'];
            }
            return array(array(array($data['title'], $data['keyword'], $data['picurl'], $url)), 'news');
        } else {
            return '商家还未及时更新淘宝店铺的信息,回复帮助,查看功能详情';
        }
    }
    public function choujiang($name)
    {
        $data = M('lottery')->field('id,keyword,info,title,starpicurl')->where(array('token' => $this->token, 'status' => 1, 'type' => 1))->order('id desc')->find();
        if ($data == false) {
            return array('暂无抽奖活动', 'text');
        }
        $pic = $data['starpicurl'] ? $data['starpicurl'] : rtrim(C('site_url'), '/') . '/tpl/User/default/common/images/img/activity-lottery-start.jpg';
        $url = rtrim(C('site_url'), '/') . U('Wap/Lottery/index', array('type' => 1, 'token' => $this->token, 'id' => $data['id'], 'wecha_id' => $this->data['FromUserName']));
        return array(array(array($data['title'], $data['info'], $pic, $url)), 'news');
    }
    public function keyword($key)
    {


        $like['keyword'] = array('like', ('%' . $key) . '%');
        $like['token'] = $this->token;

        if(!empty($key)){
            $data = M('keyword')->where($like)->order('id desc')->find();
        }

        if ($data != false) {
            switch ($data['module']) {
            case 'Img':
                $this->requestdata('imgnum');
                $img_db = M($data['module']);
                $back = $img_db->field('id,text,pic,url,title')->limit(9)->order('id desc')->where($like)->select();
                $idsWhere = 'id in (';
                $comma = '';
                foreach ($back as $keya => $infot) {
                    $idsWhere .= $comma . $infot['id'];
                    $comma = ',';
                    if ($infot['url'] != false) {
                        if (!(strpos($infot['url'], 'http') === FALSE)) {
                            $url = html_entity_decode($infot['url']);
                        } else {
                            $url = $this->getFuncLink($infot['url']);
                        }
                    } else {
                        $url = rtrim(C('site_url'), '/') . U('Wap/Index/content', array('token' => $this->token, 'id' => $infot['id'], 'wecha_id' => $this->data['FromUserName']));
                    }
                    $return[] = array($infot['title'], $infot['text'], $infot['pic'], $url);
                }
                $idsWhere .= ')';
                if ($back) {
                    $img_db->where($idsWhere)->setInc('click');
                }
                return array($return, 'news');
                break;
            case 'Host':
                $this->requestdata('other');
                $host = M('Host')->where(array('id' => $data['pid']))->find();
                return array(array(array($host['name'], $host['info'], $host['ppicurl'], ((((((C('site_url') . '/index.php?g=Wap&m=Host&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&hid=') . $data['pid']) . '&sgssz=mp.weixin.qq.com')), 'news');
                break;
            case 'Estate':
                $this->requestdata('other');
                $Estate = M('Estate')->where(array('id' => $data['pid']))->find();
                return array(array(array($Estate['title'], $Estate['estate_desc'], $Estate['cover'], ((((C('site_url') . '/index.php?g=Wap&m=Estate&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&sgssz=mp.weixin.qq.com'), array('楼盘介绍', $Estate['estate_desc'], $Estate['house_banner'], ((((((C('site_url') . '/index.php?g=Wap&m=Estate&a=index&&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&hid=') . $data['pid']) . '&sgssz=mp.weixin.qq.com'), array('专家点评', $Estate['estate_desc'], $Estate['cover'], ((((((C('site_url') . '/index.php?g=Wap&m=Estate&a=impress&&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&hid=') . $data['pid']) . '&sgssz=mp.weixin.qq.com'), array('楼盘3D全景', $Estate['estate_desc'], $Estate['banner'], ((((((C('site_url') . '/index.php?g=Wap&m=Panorama&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&hid=') . $data['pid']) . '&sgssz=mp.weixin.qq.com'), array('楼盘动态', $Estate['estate_desc'], $Estate['house_banner'], ((((((((C('site_url') . '/index.php?g=Wap&m=Index&a=lists&classid=') . $data['classify_id']) . '&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&hid=') . $data['pid']) . '&sgssz=mp.weixin.qq.com')), 'news');
                break;
            case 'Reservation':
                $this->requestdata('other');
                $rt = M('Reservation')->where(array('id' => $data['pid']))->find();
                return array(array(array($rt['title'], $rt['info'], $rt['picurl'], ((((((C('site_url') . '/index.php?g=Wap&m=Reservation&a=index&rid=') . $data['pid']) . '&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&sgssz=mp.weixin.qq.com')), 'news');
                break;
            case 'Text':
                $this->requestdata('textnum');
                $info = M($data['module'])->order('id desc')->find($data['pid']);
                return array(htmlspecialchars_decode(str_replace('{wechat_id}', $this->data['FromUserName'], $info['text'])), 'text');
                break;
            case 'Product':
                $this->requestdata('other');
                $infos = M('Product')->limit(9)->order('id desc')->where($like)->select();
                if ($infos) {
                    $return = array();
                    foreach ($infos as $info) {
                        $return[] = array($info['name'], strip_tags(htmlspecialchars_decode($info['intro'])), $info['logourl'], ((((((C('site_url') . '/index.php?g=Wap&m=Product&a=product&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&id=') . $info['id']) . '&sgssz=mp.weixin.qq.com');
                    }
                }
                return array($return, 'news');
                break;
            case 'liuyan':
                $this->requestdata('other');
                $pro = M('liuyan')->where(array('id' => $data['pid']))->find();
                return array(array(array($pro['title'], strip_tags(htmlspecialchars_decode($pro['message'])), $pro['pic'], (((((C('site_url') . '/index.php?g=Wap&m=Liuyan&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&id=') . $data['pid'])), 'news');
                break;
            case 'Selfform':
                $this->requestdata('other');
                $pro = M('Selfform')->where(array('id' => $data['pid']))->find();
                return array(array(array($pro['name'], strip_tags(htmlspecialchars_decode($pro['intro'])), $pro['logourl'], ((((((C('site_url') . '/index.php?g=Wap&m=Selfform&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&id=') . $data['pid']) . '&sgssz=mp.weixin.qq.com')), 'news');
                break;
            case 'Panorama':
                $this->requestdata('other');
                $pro = M('Panorama')->where(array('id' => $data['pid']))->find();
                return array(array(array($pro['name'], strip_tags(htmlspecialchars_decode($pro['intro'])), $pro['frontpic'], ((((((C('site_url') . '/index.php?g=Wap&m=Panorama&a=item&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&id=') . $data['pid']) . '&sgssz=mp.weixin.qq.com')), 'news');
                break;
            case 'Weidiaoyan':
                $this->requestdata('other');
                $pro = M('Weidiaoyan')->where(array('id' => $data['pid']))->find();
                return array(array(array($pro['name'], strip_tags(htmlspecialchars_decode($pro['intro'])), $pro['logourl'], ((((((C('site_url') . '/index.php?g=Wap&m=Weidiaoyan&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&id=') . $data['pid']) . '&sgssz=mp.weixin.qq.com')), 'news');
                break;
            case 'Wedding':
                $this->requestdata('other');
                $pro = M('Wedding')->where(array('id' => $data['pid']))->find();
                return array(array(array($pro['title'], (($pro['man'] . '和') . $pro['woman']) . '的微信喜帖', $pro['coverurl'], (((((C('site_url') . '/index.php?g=Wap&m=Wedding&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&id=') . $data['pid']), array('给我的祝福', '', '', (((((C('site_url') . '/index.php?g=Wap&m=Wedding&a=comment&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&id=') . $data['pid']), array('赴宴名单', '', '', (((((C('site_url') . '/index.php?g=Wap&m=Wedding&a=info&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&id=') . $data['pid'])), 'news');
                break;
            case 'Vote':
                $this->requestdata('other');
                $Vote = M('Vote')->where(array('id' => $data['pid']))->find();
                return array(array(array($Vote['title'], str_replace('&nbsp;', ' ', strip_tags(htmlspecialchars_decode($Vote['info']))), $Vote['picurl'], ((((((C('site_url') . '/index.php?g=Wap&m=Vote&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&id=') . $data['pid']) . '&sgssz=mp.weixin.qq.com')), 'news');
                break;
            case 'Lottery':
                $this->requestdata('other');
                $info = M('Lottery')->find($data['pid']);
                if ($info == false || $info['status'] == 3) {
                    return array('活动可能已经结束或者被删除了', 'text');
                }
                switch ($info['type']) {
                case 1:
                    $model = 'Lottery';
                    break;
                case 2:
                    $model = 'Guajiang';
                    break;
                case 3:
                    $model = 'Coupon';
                    break;
                case 4:
                    $model = 'Zadan';
                }
                $id = $info['id'];
                $type = $info['type'];
                if ($info['status'] == 1) {
                    $picurl = $info['starpicurl'];
                    $title = $info['title'];
                    $id = $info['id'];
                    $info = $info['info'];
                } else {
                    $picurl = $info['endpicurl'];
                    $title = $info['endtite'];
                    $info = $info['endinfo'];
                }
                //$url = C('site_url') . U((('Wap/' . $model) . '/index'), array('token' => $this->token, 'type' => $type, 'wecha_id' => $this->data['FromUserName'], 'id' => $id, 'type' => $type));
				$url = C('site_urls') . U((('Wap/' . $model) . '/index'), array('token' => $this->token, 'type' => $type, 'wecha_id' => $this->data['FromUserName'], 'id' => $id, 'type' => $type));
       return array(array(array($title, $info, $picurl, $url)), 'news');
            default:
                $this->requestdata('videonum');
                $info = M($data['module'])->order('id desc')->find($data['pid']);
                return array(array($info['title'], $info['keyword'], $info['musicurl'], $info['hqmusicurl']), 'music');
            }
        } else {

            if (!strpos($this->fun, 'liaotian')) {
                $other = M('Other')->where(array('token' => $this->token))->find();
                if ($other == false) {
                    return array('回复帮助，可了解所有功能', 'text');
                } else {
                    if (empty($other['keyword'])) {
                        return array($other['info'], 'text');
                    } else {
                        $img = M('Img')->field('id,text,pic,url,title')->limit(5)->order('id desc')->where(array('token' => $this->token, 'keyword' => array('like', ('%' . $other['keyword']) . '%')))->select();
                        if ($img == false) {
                            return array('无此图文信息,请提醒商家，重新设定关键词', 'text');
                        }
                        foreach ($img as $keya => $infot) {
                            if ($infot['url'] != false) {
                                if (!(strpos($infot['url'], 'http') === FALSE)) {
                                    $url = html_entity_decode($infot['url']);
                                } else {
                                    $url = $this->getFuncLink($infot['url']);
                                }
                            } else {
                                $url = rtrim(C('site_url'), '/') . U('Wap/Index/content', array('token' => $this->token, 'id' => $infot['id'], 'wecha_id' => $this->data['FromUserName']));
                            }
                            $return[] = array($infot['title'], $infot['text'], $infot['pic'], $url);
                        }
                        return array($return, 'news');
                    }
                }
            }
            return $this->chat($key);
        }
    }
    public function getFuncLink($u)
    {
        $urlInfos = explode(' ', $u);
        switch ($urlInfos[0]) {
        default:
            $url = str_replace('{wechat_id}', $this->data['FromUserName'], $urlInfos[0]);
            break;
        case '刮刮卡':
            $Lottery = M('Lottery')->where(array('token' => $this->token, 'type' => 2, 'status' => 1))->order('id DESC')->find();
            $url = C('site_url') . U('Wap/Guajiang/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'], 'id' => $Lottery['id']));
            break;
        case '大转盘':
            $Lottery = M('Lottery')->where(array('token' => $this->token, 'type' => 1, 'status' => 1))->order('id DESC')->find();
            $url = C('site_url') . U('Wap/Lottery/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'], 'id' => $Lottery['id']));
            break;
        case '商家订单':
            $url = ((((((C('site_url') . '/index.php?g=Wap&m=Host&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&hid=') . $urlInfos[1]) . '&sgssz=mp.weixin.qq.com';
            break;
        case '万能表单':
            $url = C('site_url') . U('Wap/Selfform/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'], 'id' => $urlInfos[1]));
            break;
        case '微调研':
            $url = C('site_url') . U('Wap/Weidiaoyan/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'], 'id' => $urlInfos[1]));
            break;
        case '会员卡':
            $url = C('site_url') . U('Wap/Card/vip', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName']));
            break;
        case '首页':
            $url = (((rtrim(C('site_url'), '/') . '/index.php?g=Wap&m=Index&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName'];
            break;
        case '团购':
            $url = (((rtrim(C('site_url'), '/') . '/index.php?g=Wap&m=Groupon&a=grouponIndex&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName'];
            break;
        case '商城':
            $url = (((rtrim(C('site_url'), '/') . '/index.php?g=Wap&m=Product&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName'];
            break;
        case '订餐':
            $url = (((rtrim(C('site_url'), '/') . '/index.php?g=Wap&m=Product&a=dining&dining=1&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName'];
            break;
        case '相册':
            $url = (((rtrim(C('site_url'), '/') . '/index.php?g=Wap&m=Photo&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName'];
            break;
        case '网站分类':
            $url = C('site_url') . U('Wap/Index/lists', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'], 'classid' => $urlInfos[1]));
            break;
        case 'LBS信息':
            if ($urlInfos[1]) {
                $url = C('site_url') . U('Wap/Company/map', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'], 'companyid' => $urlInfos[1]));
            } else {
                $url = C('site_url') . U('Wap/Company/map', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName']));
            }
            break;
        case 'DIY宣传页':
            $url = (C('site_url') . '/index.php/show/') . $this->token;
            break;
        case '婚庆喜帖':
            $url = C('site_url') . U('Wap/Wedding/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'], 'id' => $urlInfos[1]));
            break;
        case '投票':
            $url = C('site_url') . U('Wap/Vote/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'], 'id' => $urlInfos[1]));
            break;
        case '喜帖':
            $url = C('site_url') . U('Wap/Wedding/index', array('token' => $this->token, 'wecha_id' => $this->data['FromUserName'], 'id' => $urlInfos[1]));
            break;
        }
        return $url;
    }
    public function home()
    {
        return $this->shouye();
    }
    public function shouye($name)
    {
/*	
		$domainkey = CONF_PATH . 'userkey.key';
		$domain = $this->GetUrlToDomain($_SERVER['HTTP_HOST']);
		$domain_err = "$domain 获取授权失败，请联系售后";
		if (!is_file($domainkey)) {
			return array($domain_err, 'text');}
		$fp   = fopen($domainkey, "r");
		$data = "";
		while (!feof($fp)) {
			$data .= fread($fp, 4096);
		}
		fclose($fp);
		$v = preg_split("/\|/", $data);
		if (count($v) != 4) {
			return array($domain_err, 'text');
		}
		if (strtoupper(sha1($v[0] . "cyzhe")) != $v[3]) {
			return array($domain_err, 'text');
		}
		if (strstr($domain, $v[0]) == "") {
			return array($domain_err, 'text');
		}
		*/
        $home = M('Home')->where(array('token' => $this->token))->find();
        if ($home == false) {
            return array('商家未做首页配置，请稍后再试', 'text');
        } else {
            $imgurl = $home['picurl'];
            if ($home['apiurl'] == false) {
                if (!$home['advancetpl']) {
                    $url = ((((rtrim(C('site_url'), '/') . '/index.php?g=Wap&m=Index&a=index&token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&sgssz=mp.weixin.qq.com';
                } else {
                    $url = ((((rtrim(C('site_url'), '/') . '/cms/index.php?token=') . $this->token) . '&wecha_id=') . $this->data['FromUserName']) . '&sgssz=mp.weixin.qq.com';
                }
            } else {
                $url = $home['apiurl'];
            }
        }
        return array(array(array($home['title'], $home['info'], $imgurl, $url)), 'news');
    }
    public function kuaidi($data)
    {
        $data = array_merge($data);
        $str = file_get_contents((('http://www.weinxinma.com/api/index.php?m=Express&a=index&name=' . $data[0]) . '&number=') . $data[1]);
        return $str;
    }
    public function langdu($data)
    {
        $data = implode('', $data);
        $mp3url = 'http://www.apiwx.com/aaa.php?w=' . urlencode($data);
        return array(array($data, '点听收听', $mp3url, $mp3url), 'music');
    }
    public function jiankang($data)
    {
        if (empty($data)) {
            return ('主人，' . $this->my) . '提醒您n正确的查询方式是:n健康+身高,+体重n例如：健康170,65';
        }
        $height = $data[1] / 100;
        $weight = $data[2];
        $Broca = ($height * 100 - 80) * 0.7;
        $kaluli = ((66 + 13.7 * $weight) + (5 * $height) * 100) - 6.8 * 25;
        $chao = $weight - $Broca;
        $zhibiao = $chao * 0.1;
        $res = round($weight / ($height * $height), 1);
        if ($res < 18.5) {
            $info = ('您的体形属于骨感型，需要增加体重' . $chao) . '公斤哦!';
            $pic = 1;
        } elseif ($res < 24) {
            $info = ('您的体形属于圆滑型的身材，需要减少体重' . $chao) . '公斤哦!';
        } elseif ($res > 24) {
            $info = ('您的体形属于肥胖型，需要减少体重' . $chao) . '公斤哦!';
        } elseif ($res > 28) {
            $info = '您的体形属于严重肥胖，请加强锻炼，或者使用我们推荐的减肥方案进行减肥';
        }
        return $info;
    }
    public function fujin($keyword)
    {
        $keyword = implode('', $keyword);
        if ($keyword == false) {
            return (($this->my . '很难过,无法识别主人的指令,正确使用方法是:输入【附近+关键词】当') . $this->my) . '提醒您输入地理位置的时候就OK啦';
        }
        $data = array();
        $data['time'] = time();
        $data['token'] = $this->_get('token');
        $data['keyword'] = $keyword;
        $data['uid'] = $this->data['FromUserName'];
        $re = M('Nearby_user');
        $user = $re->where(array('token' => $this->_get('token'), 'uid' => $data['uid']))->find();
        if ($user == false) {
            $re->data($data)->add();
        } else {
            $id['id'] = $user['id'];
            $re->where($id)->save($data);
        }
        return ('主人【' . $this->my) . '】已经接收到你的指令n请发送您的地理位置给我哈';
    }
    public function recordLastRequest($key, $msgtype = 'text')
    {
        $rdata = array();
        $rdata['time'] = time();
        $rdata['token'] = $this->_get('token');
        $rdata['keyword'] = $key;
        $rdata['msgtype'] = $msgtype;
        $rdata['uid'] = $this->data['FromUserName'];
        $user_request_model = M('User_request');
        $user_request_row = $user_request_model->where(array('token' => $this->_get('token'), 'msgtype' => $msgtype, 'uid' => $rdata['uid']))->find();
        if (!$user_request_row) {
            $user_request_model->add($rdata);
        } else {
            $rid['id'] = $user_request_row['id'];
            $user_request_model->where($rid)->save($rdata);
        }
    }
    public function map($x, $y)
    {
        $user_request_model = M('User_request');
        $user_request_row = $user_request_model->where(array('token' => $this->_get('token'), 'msgtype' => 'text', 'uid' => $this->data['FromUserName']))->find();
        if (!(strpos($user_request_row['keyword'], '附近') === FALSE)) {
            $user = M('Nearby_user')->where(array('token' => $this->_get('token'), 'uid' => $this->data['FromUserName']))->find();
            $keyword = $user['keyword'];
            $radius = 2000;
            $str = file_get_contents((((((C('site_url') . '/map.php?keyword=') . urlencode($keyword)) . '&x=') . $x) . '&y=') . $y);
            $array = json_decode($str);
            $map = array();
            foreach ($array as $key => $vo) {
                $map[] = array($vo->title, $key, rtrim(C('site_url'), '/') . '/tpl/static/images/home.jpg', $vo->url);
            }
            return array($map, 'news');
        } else {
            import('Home.Action.MapAction');
            $mapAction = new MapAction();
            if ((!(strpos($user_request_row['keyword'], '开车去') === FALSE) || !(strpos($user_request_row['keyword'], '坐公交') === FALSE)) || !(strpos($user_request_row['keyword'], '步行去') === FALSE)) {
                if (!(strpos($user_request_row['keyword'], '步行去') === FALSE)) {
                    $companyid = str_replace('步行去', '', $user_request_row['keyword']);
                    if (!$companyid) {
                        $companyid = 1;
                    }
                    return $mapAction->walk($x, $y, $companyid);
                }
                if (!(strpos($user_request_row['keyword'], '开车去') === FALSE)) {
                    $companyid = str_replace('开车去', '', $user_request_row['keyword']);
                    if (!$companyid) {
                        $companyid = 1;
                    }
                    return $mapAction->drive($x, $y, $companyid);
                }
                if (!(strpos($user_request_row['keyword'], '坐公交') === FALSE)) {
                    $companyid = str_replace('坐公交', '', $user_request_row['keyword']);
                    if (!$companyid) {
                        $companyid = 1;
                    }
                    return $mapAction->bus($x, $y, $companyid);
                }
            } else {
                switch ($user_request_row['keyword']) {
                case '最近的':
                    return $mapAction->nearest($x, $y);
                    break;
                }
            }
        }
    }
    public function suanming($name)
    {
        $name = implode('', $name);
        if (empty($name)) {
            return ('主人' . $this->my) . '提醒您正确的使用方法是[算命+姓名]';
        }
        $data = require_once CONF_PATH . 'suanming.php';
        $num = mt_rand(0, 80);
        return ($name . 'n') . trim($data[$num]);
    }
    public function yinle($name)
    {
        $name = implode('', $name);
        $url = 'http://httop1.duapp.com/mp3.php?musicName=' . $name;
        $str = file_get_contents($url);
        $obj = json_decode($str);
        return array(array($name, $name, $obj->url, $obj->url), 'music');
    }
    public function geci($n)
    {
        $name = implode('', $n);
        $str = $this->myapi . urlencode($name);
        $json = json_decode(file_get_contents($str));
        $reply = urldecode($json->content);
        $reply = str_replace('{br}', 'n', $reply);
        return $reply;
    }
    public function tianqi($n)
    {
        $name = implode('', $n);
        $str = $this->myapi . urlencode(($name . '天气'));
        $json = json_decode(file_get_contents($str));
        $reply = urldecode($json->content);
        return $reply;
    }
    public function yuming($n)
    {
        $name = implode('', $n);
        @($str = 'http://api.ajaxsns.com/api.php?key=free&appid=0&msg=' . urlencode(('域名' . $name)));
        $json = json_decode(file_get_contents($str));
        $str = str_replace('{br}', '
', $json->content);
        return str_replace('mzxing_com', 'Winxin', $str);
    }
    public function shouji($n)
    {
        $n = implode('', $n);
        if (count($n) > 1) {
            $this->error_msg($n);
            return false;
        }
        $xml_array = simplexml_load_file(('http://api.k780.com:88/?app=phone.get&phone=' . $n) . '&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=xml');
        //将XML中的数据,读取到数组对象中
        foreach ($xml_array as $tmp) {
            if ($str !== iconv('UTF-8', 'UTF-8', iconv('UTF-8', 'UTF-8', $str))) {
                $str = iconv('GBK', 'UTF-8', $str);
            }
            $str = (((((('【手机】' . $tmp->phone) . '【归属地】') . $tmp->att) . '【卡类型】') . $tmp->ctype) . '【邮编】') . $tmp->postno;
        }
        return $str;
    }
    public function shenfenzheng($n)
    {
        $n = implode('', $n);
        if (count($n) > 1) {
            $this->error_msg($n);
            return false;
        }
        $xml_array = simplexml_load_file(('http://api.k780.com:88/?app=idcard.get&idcard=' . $n) . '&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=xml');
        //将XML中的数据,读取到数组对象中
        foreach ($xml_array as $tmp) {
            if ($str !== iconv('UTF-8', 'UTF-8', iconv('UTF-8', 'UTF-8', $str))) {
                $str = iconv('GBK', 'UTF-8', $str);
            }
            $str = (((((('【身份证】' . $tmp->idcard) . '【地址】') . $tmp->att) . '【性别】') . $tmp->sex) . '【生日】') . $tmp->born;
        }
        return $str;
    }
    public function gongjiao($data)
    {
        $data = array_merge($data);
        if (count($data) != 2) {
            $this->error_msg();
            return false;
        }
        $json = file_get_contents((('http://www.twototwo.cn/bus/Service.aspx?format=json&action=QueryBusByLine&key=c3e2c03e-4a93-41f0-8ebe-dbadd7ea7858&zone=' . $data[0]) . '&line=') . $data[1]);
        $data = json_decode($json);
        $xianlu = $data->Response->Head->XianLu;
        $xdata = get_object_vars($xianlu->ShouMoBanShiJian);
        $xdata = $xdata['#cdata-section'];
        $piaojia = get_object_vars($xianlu->PiaoJia);
        $xdata = ($xdata . '
') . $piaojia['#cdata-section'];
        $main = $data->Response->Main->Item->FangXiang;
        $xianlu = $main[0]->ZhanDian;
        $str = $xdata;
        $str .= '
' . '【本公交途经】';
        for ($i = 0; $i < count($xianlu); $i++) {
            $str .= ('
' . $i) . trim($xianlu[$i]->ZhanDianMingCheng);
        }
        return $str;
    }
    public function huoche($data, $time = '')
    {
        $data = array_merge($data);
        $data[2] = date('Y', time()) . $time;
        if (count($data) != 3) {
            $this->error_msg(($data[0] . '至') . $data[1]);
            return false;
        }
        $time = empty($time) ? date('Y-m-d', time()) : date('Y-', time()) . $time;
        $json = file_get_contents(((((('http://www.twototwo.cn/train/Service.aspx?format=json&action=QueryTrainScheduleByTwoStation&key=c3e2c03e-4a93-41f0-8ebe-dbadd7ea7858&startStation=' . $data[0]) . '&arriveStation=') . $data[1]) . '&startDate=') . $data[2]) . '&ignoreStartDate=0&like=1&more=0');
        if ($json) {
            $data = json_decode($json);
            $main = $data->Response->Main->Item;
            if (count($main) > 10) {
                $conunt = 10;
            } else {
                $conunt = count($main);
            }
            for ($i = 0; $i < $conunt; $i++) {
                $str .= ((((((((('n 【编号】' . $main[$i]->CheCiMingCheng) . 'n 【类型】') . $main[$i]->CheXingMingCheng) . 'n【发车时间】:　') . $time) . ' ') . $main[$i]->FaShi) . 'n【耗时】') . $main[$i]->LiShi) . ' 小时';
                $str .= 'n----------------------';
            }
        } else {
            $str = ((('没有找到 ' . $name) . ' 至 ') . $toname) . ' 的列车';
        }
        return $str;
    }
    public function fanyi($name)
    {
        $name = array_merge($name);
        $url = ('http://openapi.baidu.com/public/2.0/bmt/translate?client_id=kylV2rmog90fKNbMTuVsL934&q=' . $name[0]) . '&from=auto&to=auto';
        $json = Http::fsockopenDownload($url);
        if ($json == false) {
            $json = file_get_contents($url);
        }
        $json = json_decode($json);
        $str = $json->trans_result;
        if ($str[0]->dst == false) {
            return $this->error_msg($name[0]);
        }
        $mp3url = 'http://www.apiwx.com/aaa.php?w=' . $str[0]->dst;
        return array(array($str[0]->src, $str[0]->dst, $mp3url, $mp3url), 'music');
    }
    public function caipiao($name)
    {
        $name = array_merge($name);
        $url = 'http://api2.sinaapp.com/search/lottery/?appkey=0020130430&appsecert=fa6095e113cd28fd&reqtype=text&keyword=' . $name[0];
        $json = Http::fsockopenDownload($url);
        if ($json == false) {
            $json = file_get_contents($url);
        }
        $json = json_decode($json, true);
        $str = $json['text']['content'];
        return $str;
    }
    public function mengjian($name)
    {
        $name = array_merge($name);
        if (empty($name)) {
            return '周公睡着了,无法解此梦,这年头神仙也偷懒';
        }
        $data = M('Dream')->field('content')->where(('`title` LIKE \'%' . $name[0]) . '%\'')->find();
        if (empty($data)) {
            return '周公睡着了,无法解此梦,这年头神仙也偷懒';
        }
        return $data['content'];
    }
    public function test($name, $data)
    {
        file_put_contents($name, $data);
    }
    public function gupiao($name)
    {
        $name = array_merge($name);
        $url = 'http://api2.sinaapp.com/search/stock/?appkey=0020130430&appsecert=fa6095e113cd28fd&reqtype=text&keyword=' . $name[0];
        $json = Http::fsockopenDownload($url);
        if ($json == false) {
            $json = file_get_contents($url);
        }
        $json = json_decode($json, true);
        $str = $json['text']['content'];
        return $str;
    }
    public function getmp3($data)
    {
        $obj = new getYu();
        $ContentString = $obj->getGoogleTTS($data);
        $randfilestring = ((('mp3/' . time()) . '_') . sprintf('%02d', rand(0, 999))) . '.mp3';
        file_put_contents($randfilestring, $ContentString);
        return rtrim(C('site_url'), '/') . $randfilestring;
    }
    public function xiaohua()
    {
        $name = implode('', $n);
        $str = $this->myapi . urlencode('笑话');
        $json = json_decode(file_get_contents($str));
        $reply = urldecode($json->content);
        $reply = str_replace('{br}', 'n', $reply);
        return $reply;
    }
    public function liaotian($name)
    {
        $name = array_merge($name);
        $this->chat($name[0]);
    }
    public function chat($name)
    {
        $this->requestdata('textnum');
        $check = $this->user('connectnum');
        if ($check['connectnum'] != 1) {
            return array(C('connectout'), 'text');
        }
        if ($name == '糗事') {
            $name = '笑话';
        }
        $str = $this->myapi . urlencode($name);
        $json = json_decode(file_get_contents($str));
        $reply = urldecode($json->content);
        $reply = str_replace('{br}', 'n', $reply);
        $reply = str_replace('小九', $this->my, $reply);
        if (stristr($reply, '还不能理解')) {
            $other = M('Other')->where(array('token' => $this->token))->find();
            if ($other == false) {
                
            } else {
                if (empty($other['keyword'])) {
                    if ($other['info']) {
                        return array($other['info'], 'text');
                    }
                } else {
                    if ($other['keyword'] == '首页' || $other['keyword'] == 'home') {
                        return $this->shouye();
                    }
                    $back = M('Img')->field('id,text,pic,url,title')->limit(5)->order('id desc')->where(array('token' => $this->token, 'keyword' => array('like', ('%' . $other['keyword']) . '%')))->select();
                    if ($back == false) {
                        return array('无此图文信息,请提醒商家，重新设定关键词', 'text');
                    }
                    foreach ($back as $keya => $infot) {
                        if ($infot['url'] != false) {
                            $url = $this->getFuncLink($infot['url']);
                        } else {
                            $url = rtrim(C('site_url'), '/') . U('Wap/Index/content', array('token' => $this->token, 'id' => $infot['id'], 'wecha_id' => $this->data['FromUserName']));
                        }
                        $return[] = array($infot['title'], $infot['text'], $infot['pic'], $url);
                    }
                    return array($return, 'news');
                }
            }
        }
        return array($reply, 'text');
    }
    public function fistMe($data)
    {
        if ('event' == $data['MsgType'] && 'subscribe' == $data['Event']) {
            return $this->help();
        }
    }
    public function help()
    {
        $data = M('Areply')->where(array('token' => $this->token))->find();
        return array(preg_replace('/(1512)|(15)|(12)/', 'n', $data['content']), 'text');
    }
    public function error_msg($data)
    {
        return ('没有找到' . $data) . '相关的数据';
    }
    public function user($action, $keyword = '')
    {
        $user = M('Wxuser')->field('uid')->where(array('token' => $this->token))->find();
        $usersdata = M('Users');
        $dataarray = array('id' => $user['uid']);
        $users = $usersdata->field('gid,diynum,connectnum,activitynum,viptime')->where(array('id' => $user['uid']))->find();
        $group = M('User_group')->where(array('id' => $users['gid']))->find();
        if ($users['diynum'] < $group['diynum']) {
            $data['diynum'] = 1;
            if ($action == 'diynum') {
                $usersdata->where($dataarray)->setInc('diynum');
            }
        }
        if ($users['connectnum'] < $group['connectnum']) {
            $data['connectnum'] = 1;
            if ($action == 'connectnum') {
                $usersdata->where($dataarray)->setInc('connectnum');
            }
        }
        if ($users['viptime'] > time()) {
            $data['viptime'] = 1;
        }
        return $data;
    }
    public function requestdata($field)
    {
        $data['year'] = date('Y');
        $data['month'] = date('m');
        $data['day'] = date('d');
        $data['token'] = $this->token;
        $mysql = M('Requestdata');
        $check = $mysql->field('id')->where($data)->find();
        if ($check == false) {
            $data['time'] = time();
            $data[$field] = 1;
            $mysql->add($data);
        } else {
            $mysql->where($data)->setInc($field);
        }
    }
    public function behaviordata($field, $id = '', $type = '')
    {
        $data['date'] = date('Y-m-d', time());
        $data['token'] = $this->token;
        $data['openid'] = $this->data['FromUserName'];
        $data['keyword'] = $this->data['Content'];
        $data['model'] = $field;
        if ($id != false) {
            $data['fid'] = $id;
        }
        if ($type != false) {
            $data['type'] = 1;
        }
        $mysql = M('Behavior');
        $check = $mysql->field('id')->where($data)->find();
        $this->updateMemberEndTime($data['openid']);
        if ($check == false) {
            $data['enddate'] = time();
            $mysql->add($data);
        } else {
            $mysql->where($data)->setInc('num');
        }
    }
    public function updateMemberEndTime($openid)
    {
        $mysql = M('Wehcat_member_enddate');
        $id = $mysql->field('id')->where(array('openid' => $openid))->find();
        $data['enddate'] = time();
        $data['openid'] = $openid;
        if ($id == false) {
            $mysql->add($data);
        } else {
            $data['id'] = $id;
            $mysql->save($data);
        }
    }
    public function baike($name)
    {
        $name = implode('', $name);
        $name_gbk = iconv('utf-8', 'gbk', $name);
        $encode = urlencode($name_gbk);
        $url = ('http://baike.baidu.com/list-php/dispose/searchword.php?word=' . $encode) . '&pic=1';
        $get_contents = $this->httpGetRequest_baike($url);
        $get_contents_gbk = iconv('gbk', 'utf-8', $get_contents);
        preg_match('/URL=(\\S+)\'>/s', $get_contents_gbk, $out);
        $real_link = 'http://baike.baidu.com' . $out[1];
        $get_contents2 = $this->httpGetRequest_baike($real_link);
        preg_match('#"Description"\\scontent="(.+?)"\\s\\/\\>#is', $get_contents2, $matchresult);
        if (isset($matchresult[1]) && $matchresult[1] != '') {
            return htmlspecialchars_decode($matchresult[1]);
        } else {
            return ('抱歉，没有找到与“' . $name) . '”相关的百科结果。';
        }
    }
    public function api_notice_increment($url, $data)
    {
        $ch = curl_init();
        $header = 'Accept-Charset: utf-8';
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        if (curl_errno($ch)) {
            return false;
        } else {
            return $tmpInfo;
        }
    }
    public function httpGetRequest_baike($url)
    {
        $headers = array('User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:14.0) Gecko/20100101 Firefox/14.0.1', 'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8', 'Accept-Language: en-us,en;q=0.5', 'Referer: http://www.baidu.com/');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $output = curl_exec($ch);
        curl_close($ch);
        if ($output === FALSE) {
            return 'cURL Error: ' . curl_error($ch);
        }
        return $output;
    }
    public function get_tags($title, $num = 10)
    {
        vendor('Pscws.Pscws4', '', '.class.php');
        $pscws = new PSCWS4();
        $pscws->set_dict(CONF_PATH . 'etc/dict.utf8.xdb');
        $pscws->set_rule(CONF_PATH . 'etc/rules.utf8.ini');
        $pscws->set_ignore(true);
        $pscws->send_text($title);
        $words = $pscws->get_tops($num);
        $pscws->close();
        $tags = array();
        foreach ($words as $val) {
            $tags[] = $val['word'];
        }
        return implode(',', $tags);
    }
	public function GetUrlToDomain($domain)
	{
		$re_domain = '';
		$domain_postfix_cn_array = array("com", "net", "org", "gov", "edu", "com.cn", "cn");
		$array_domain = explode(".", $domain);
		$array_num = count($array_domain) - 1;
		if ($array_domain[$array_num] == 'cn') {
			if (in_array($array_domain[$array_num - 1], $domain_postfix_cn_array)) {
				$re_domain = $array_domain[$array_num - 2] . "." . $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
			} else {
				$re_domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
			}
		} else {
			$re_domain = $array_domain[$array_num - 1] . "." . $array_domain[$array_num];
		}
		return $re_domain;
	}


/**
    新增ACTION

*/
    /*已关注状态扫码回复*/
    private function guanzhuHuifu($id){
        $result = M('EwmContent')->where('C_Eid=%d',$id)->order('C_Id DESC')->find();
        if($result['C_Gid']){
            // $res_g = M('Img')->where('id=%d',$result['C_Gid'])->find();
            // $data[] = array($res_g['title'], $res_g['text'], $res_g['pic'], html_entity_decode($res_g['url']));

            $res_g = M('Img')->field('keyword')->where('id=%d',$result['C_Gid'])->find();

            $res_key = M('Img')->where("keyword='%s'",$res_g['keyword'])->order('id DESC')->select();

            foreach ($res_key as $k => $v) {
                $data[] = array($v['title'], $v['text'], $v['pic'], html_entity_decode($v['url']));
            }

        }else{
            $data[] = array($result['C_Name'], $result['C_Content'], $result['C_ImgUrl'], html_entity_decode($result['C_Url']));
        }
        // file_put_contents('data11111.txt', print_r($data,true),FILE_APPEND);
        return $data;
    }

    /*给扫码增加点击率*/
    private function saomaClick($id){
        M('Ewm')->where('E_Id=%d',$id)->setInc('E_Click');
    }



    /*96567绑定关注公众号*/
    private function bangdingwx($id,$openid){
        $model = M('member','shop_','mysql://shopnc:Shengwei123@sctxdata.mysql.rds.aliyuncs.com:3306/shopnc');
        if($id && $openid){
            $userinfo = $model->where("openid='%s'",$openid)->find();
            if(!empty($userinfo)){
                if($userinfo['member_id'] && $userinfo['openid']){
                    $data['openid'] = null;
                    if($model->where("openid='%s'",$userinfo['openid'])->save($data)){
                        $save['openid'] = $openid;
                        $save['is_open'] = '1';
                        $addid = $model->where("member_id='%d'",$id)->save($save);
                    }
                }
            }else{
                $data['openid'] = $openid;
                $data['is_open'] = '1';
                $addid = $model->where("member_id='%d'",$id)->save($data);
            }
        }

        if($addid){
            $this->setDaiMoney($id,array(34,35));
        }
    }

    private function bangdinghuifu($id){
        $res_g = M('Img')->where('id=%d',$id)->find();
        $data[] = array($res_g['title'], $res_g['text'], $res_g['pic'], html_entity_decode($res_g['url']));
        return $data;
    }


    /*给用户发送代金卷*/
    private function setDaiMoney($id,$array){
        if(is_array($array)){
            foreach ($array as $k => $v) {
                file_get_contents("http://www.96567.com/index.php?act=pointvoucher&op=voucherexchange_wxadd&vid={$v}&uid={$id}");
            }
        }else{
            file_get_contents("http://www.96567.com/index.php?act=pointvoucher&op=voucherexchange_wxadd&vid={$array}&uid={$id}");
        }
    }


    private function nianHuiTouPiao($openid){
        $weixin = new WeixinSDK();
        $weixin->usertoken = 'tuqtxs1392719300';
        $weixin->app_id = 'wx00d52d21505f383f';
        $weixin->appsecret = '1dad56778549190c2d1268caa9e2aa11';
        $weixin->index();
        $token = $weixin->token;
        $url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$token&openid=$openid&lang=zh_CN";

        $result = json_decode(file_get_contents($url),true);

        file_put_contents('result111.txt',print_r($result,true),FILE_APPEND);

        if(!empty($result['openid'])){
            $userinfo = M('Nianhui')->where("N_OpenId='".$result['openid']."'")->find();
            if(empty($userinfo)){
                $data['N_OpenId'] = $result['openid'];
                $data['N_Name'] = $result['nickname'];
                $data['N_ImgUrl'] = $result['headimgurl'];
                $data['N_Time'] = time();
                M('Nianhui')->add($data);
            }
            return true;
        }else{
            if(!empty($result['errcode'])){
                file_put_contents('tuqtxs1392719300token.txt','');
                file_put_contents('tuqtxs1392719300token_time.txt','');
            }
            return false;
        }

    }






}
?>