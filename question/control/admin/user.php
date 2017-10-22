<?php

!defined('IN_ASK2') && exit('Access Denied');

class admin_usercontrol extends base {

    var $lang;
    function admin_usercontrol(& $get, & $post) {
        $this->base($get, $post);
        $this->load('user');
        $this->load('usergroup');
        //加载语言包
        Language::read('admin/user');
        $this -> lang = Language::getLangContent();
    }

    function ondefault($msg = '') {
        @$page = max(1, intval($this->get[2]));
        $pagesize = $this->setting['list_default'];
        $startindex = ($page - 1) * $pagesize;
        $userlist = $_ENV['user']->get_list($startindex, $pagesize);
        $usernum = $this->db->fetch_total('user');
        $departstr = page($usernum, $pagesize, $page, "admin_user/default");
        $msg && $message = $msg;
        $usergrouplist = $_ENV['usergroup']->get_list();
        $sysgrouplist = $_ENV['usergroup']->get_list(1);
        $lang = $this -> lang;
        include template('userlist', 'admin');
    }

    function onsearch() {
        $search = array();
        if (count($this->get) > 2) {
            $search['srchname'] = $this->get[2];
            $search['srchuid'] = $this->get[3];
            $search['srchemail'] = $this->get[4];
            $search['srchregdatestart'] = $this->get[5];
            $search['srchregdateend'] = $this->get[6];
            $search['srchregip'] = $this->get[7];
            $search['srchgroupid'] = $this->get[8];
        } else {
            $search = $this->post;
        }
        @$page = max(1, intval($this->get[9]));
        $pagesize = $this->setting['list_default'];
        $startindex = ($page - 1) * $pagesize;
        $condition = '1=1 ';
        if (isset($search['srchname']) && '' != trim($search['srchname'])) {
            $condition .=" AND `member_name` like '" . trim($search['srchname']) . "%' ";
        }
        if (isset($search['srchuid']) && '' != trim($search['srchuid'])) {
            $condition .= " AND `uid`=" . intval($search['srchuid']);
        }
        if (isset($search['srchemail']) && '' != trim($search['srchemail'])) {
            $condition .= " AND `member_email` = '" . trim($search['srchemail']) . "'";
        }
        if (isset($search['srchregdatestart']) && '' != trim($search['srchregdatestart'])) {
            $datestart = strtotime($search['srchregdatestart']);
            $condition .= " AND `regtime` >= $datestart ";
        }
        if (isset($search['srchregdateend']) && '' != trim($search['srchregdateend'])) {
            $dateend = strtotime($search['srchregdateend']);
            $condition .= " AND `regtime` <= " . $dateend;
        }
        if (isset($search['srchregip']) && '' != trim($search['srchregip'])) {
            $condition .= " AND `regip` = '" . $search['srchregip'] . "' ";
        }
        if (isset($search['srchgroupid']) && 0 != $search['srchgroupid']) {
            $condition .= " AND `groupid` = '" . $search['srchgroupid'] . "' ";
        }
        $usergrouplist = $_ENV['usergroup']->get_list();
        $sysgrouplist = $_ENV['usergroup']->get_list(1);
        $userlist = $_ENV['user']->list_by_search_condition_username($condition, $startindex, $pagesize);
        $usernum = $_ENV['user']->get_search_num($condition);
        $departstr = page($usernum, $pagesize, $page, "admin_user/search/$search[srchname]/$search[srchuid]/$search[srchemail]/$search[srchregdatestart]/$search[srchregdateend]/$search[srchregip]/$search[srchgroupid]");
        $lang = $this -> lang;
        include template('userlist', 'admin');
    }

    function onadd() {
        if (isset($this->post['submit'])) {
            if (!$_ENV['user']->get_by_username($this->post['addname'])) {
                $_ENV['user']->add($this->post['addname'], $this->post['addpassword'], $this->post['addemail']);
                $this->ondefault();
                exit;
            }else{
            	
            }
        }
        include template('adduser', 'admin');
    }

    function onremove() {
        if (isset($this->post['uid'])) {
            $uids = implode(",", $this->post['uid']);
            $all = isset($this->get[2]) ? 1 : 0;
            $_ENV['user']->remove($uids, $all);
            $this -> log('删除问答系统用户问答信息[ID:'.$uids.']');
            $this->ondefault('用户删除成功!');
        }
    }

    function onedit() {
        $uid = (isset($this->get[2])) ? intval($this->get[2]) : $this->post['uid'];
        if (isset($this->post['submit'])) {
            $type = 'errormsg';
            //需要更新的数据
            $groupid = $this->post['groupid'];
            $credit1 = intval($this->post['credit1']);
            $credit2 = intval($this->post['credit2']);
            $gender = $this->post['gender'];
            $signature = htmlspecialchars($this->post['signature']);
            //表单检查
            $user = $_ENV['user']->get_by_uid($uid);
            $_ENV['user']->update_user($uid, $credit1, $credit2, $gender,$signature);
            $this -> log('编辑问答系统用户问答信息[ID:'.$uid.']');
            $message = '用户资料编辑成功!';
            unset($type);
        }
        $member = $_ENV['user']->get_by_uid($uid);
        $usergrouplist = $_ENV['usergroup']->get_list();
        $sysgrouplist = $_ENV['usergroup']->get_list(1);
        $lang = $this -> lang;
        include template('edituser', 'admin');
    }

    function onajaxgetcredit1(){
        $groupid = intval($this->get[2]);
        if(isset($this->usergroup[$groupid]) && $this->usergroup[$groupid]['grouptype']==2){
            exit($this->usergroup[$groupid]['creditslower']);
        }
        exit('0');
    }
}

?>