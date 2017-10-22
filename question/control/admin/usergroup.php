<?php

!defined('IN_ASK2') && exit('Access Denied');

class admin_usergroupcontrol extends base {

    function admin_usergroupcontrol(& $get,& $post) {
        $this->base($get,$post);
        $this->load('usergroup');
    }

    /*会员用户组列表*/
    function ondefault($message='') {
        if(empty($message)) unset($message);
        $usergrouplist = $_ENV['usergroup']->get_list(2);
        include template('usergrouplist','admin');
    }

    /*添加会员组*/
    function onadd() {
        $grouptitle=trim($this->post['grouptitle']);
        if($grouptitle) {
            $_ENV['usergroup']->add($grouptitle,2);
            $this -> log('添加问答系统会员组['.$grouptitle.']');
            $this->ondefault('添加会员组成功！');
        }
    }

    /*删除会员组，如果本组有会员存在，则不可删除*/
    function onremove() {
        $groupid =intval($this->get[2]);
        $_ENV['usergroup']->remove($groupid);
        $this -> log('删除问答系统会员组[ID:'.$groupid.']');
        $this->ondefault('删除组成功！');
    }

    /*设置权限*/
    function onregular() {
        $groupid =intval($this->get[2]);
        $group = $_ENV['usergroup']->get($groupid);
        if(isset($this->post['regular_code'])) {
            $group['regulars']=implode(',',$this->post['regular_code']);
            $group['questionlimits']=intval($this->post['questionlimits']);
            $group['answerlimits']=intval($this->post['answerlimits']);
            $group['credit3limits']=intval($this->post['credit3limits']);
            $_ENV['usergroup']->update($groupid,$group);
            $this -> log('编辑问答系统会员组权限[ID:'.$groupid.']');
            $message='组权限设置成功！';
        }
        $this->cache->remove('usergroup');
        include template('editusergroup','admin');
    }


    /*编辑组名*/
    function onedit() {
        $groupids =$this->post['groupid'];
        $grouptitles =$this->post['grouptitle'];
        $scorelowers =$this->post['scorelower'];
        $idcount=count($groupids);
        for($i=0;$i<$idcount;$i++) {
            $group = $_ENV['usergroup']->get($groupids[$i]);
            $group['grouptitle']=$grouptitles[$i];
            $group['creditslower']=$scorelowers[$i];
            $group['creditshigher']=isset($scorelowers[$i+1])?$scorelowers[$i+1]:999999999;
            $_ENV['usergroup']->update($groupids[$i],$group);
            $this -> log('编辑问答系统会员组[ID:'.$groupids.']');
        }
        $this->ondefault('用户组更新成功！');
    }
}
?>