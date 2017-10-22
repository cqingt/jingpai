<?php

!defined('IN_ASK2') && exit('Access Denied');

class admin_wordcontrol extends base {

    function admin_wordcontrol(& $get, & $post) {
        $this->base($get, $post);
        $this->load("badword");
  
    }

    function ondefault($message = '') {
        $this->cache->remove('word');

        @$page = max(1, intval($this->get[2]));
        $pagesize = $this->setting['list_default'];
        $startindex = ($page - 1) * $pagesize;
        $wordlist = $_ENV['badword']->get_list($startindex, $pagesize);
        $rownum = $this->db->fetch_total("badword"," 1=1");
        $departstr = page($rownum, $pagesize, $page, "admin_word/default");
        include template('wordlist', 'admin');
    }
 
    function onadd() {
        if (isset($this->post['submit']) && $this->post['id']) {
            $ids = implode(",", $this->post['id']);
            $_ENV['badword']->remove_by_id($ids);
            $this -> log('删除问答系统过滤词语[ID:'.$ids.']');
            $message = "删除成功!";
        } else {
            $_ENV['badword']->add($this->post['wid'], $this->post['find'], $this->post['replacement'], $this->admin['name']);
            $this -> log('编辑问答系统过滤词语[ID:'.$this->post['find'].']');
            $message = "修改成功!";
        }
        $this->ondefault($message);
    }
 

    function onmuladd() {
        if (isset($this->post['submit'])) {
            $lines = explode("\n", $this->post['badwords']);
            $_ENV['badword']->multiadd($lines, $this->user['username']);
            $this -> log('添加问答系统过滤词语['.str_replace('\n',',',$this -> post['badwords']).']');
            $this->ondefault("添加成功!");
        } else {
            include template('addword', "admin");
        }
    }

}

?>