<?php

!defined('IN_ASK2') && exit( 'Access Denied' );

class settingmodel
{

    var $db;
    var $base;

    function settingmodel( &$base )
    {
        $this->base = $base;
        $this->db = $base->db;
    }


    function update( $setting )
    {
        foreach ( $setting as $key => $value ) {
            $this->db->query("REPLACE INTO " . DB_TABLEPRE . "setting (k,v) VALUES ('$key','$value')");
        }
        $this->base->cache->remove('setting');
    }

    /*读取view文件夹，获取模板的选项*/
    function tpl_list()
    {
        $tpllist = array();
        $filedir = ASK2_ROOT . '/view';
        $handle = opendir($filedir);
        while ( $filename = readdir($handle) ) {
            if ( is_dir($filedir . '/' . $filename) && '.' != $filename{0} && 'admin' != $filename ) {
                if ( strpos($filename , 'wap') === false ) {
                    $tpllist[] = $filename;
                }
            }
        }
        closedir($handle);
        return $tpllist;
    }

    /*读取view文件夹手机版，获取模板的选项*/
    function tpl_waplist()
    {
        $tpllist = array();
        $filedir = ASK2_ROOT . '/view';
        $handle = opendir($filedir);
        while ( $filename = readdir($handle) ) {
            if ( is_dir($filedir . '/' . $filename) && '.' != $filename{0} && 'admin' != $filename && 'default' != $filename && 'sowenda' != $filename ) {
                if ( strstr($filename , "wap") ) {
                    $tpllist[] = $filename;
                }
            }
        }
        closedir($handle);
        return $tpllist;
    }

    /**
     * 分类问题数目校正
     */
    function regulate_category()
    {
        $query = $this->db->query("SELECT * FROM " . DB_TABLEPRE . "category");
        while ( $category = $this->db->fetch_array($query) ) {
            $q1 = $this->db->fetch_total('question' , 'cid1=' . $category['id']);
            $q2 = $this->db->fetch_total('question' , 'cid2=' . $category['id']);
            $q3 = $this->db->fetch_total('question' , 'cid3=' . $category['id']);
            $questions = $q1 + $q2 + $q3;
            $this->db->query("UPDATE " . DB_TABLEPRE . "category set questions=$questions where id=" . $category['id']);
        }
    }

    /**
     * 问题回答数数目校正
     */
    function regulate_question()
    {
        $query = $this->db->query("SELECT * FROM " . DB_TABLEPRE . "question");
        while ( $question = $this->db->fetch_array($query) ) {
            $answers = $this->db->fetch_total('answer' , 'qid=' . $question['id']);
            $this->db->query("UPDATE " . DB_TABLEPRE . "question set answers=$answers where id=" . $question['id']);
        }
    }

    /**
     * 用户问题回答数目校正
     */
    function regulate_user()
    {
        $query = $this->db->query("SELECT * FROM " . DB_TABLEPRE . "user");
        while ( $user = $this->db->fetch_array($query) ) {
            $questions = $this->db->fetch_total('question' , 'authorid=' . $user['uid']);
            $answers = $this->db->fetch_total('answer' , 'authorid=' . $user['uid']);
            $this->db->query("UPDATE " . DB_TABLEPRE . "user SET questions=$questions,answers=$answers where uid=" . $user['uid']);
        }
    }

    function get_hot_words( $hot_words )
    {
        $lines = explode("\n" , $hot_words);
        $wordslist = array();
        foreach ( $lines as $line ) {
            $words = explode(str_replace("，" , "," , "，") , $line);
            if ( is_array($words) ) {
                $word['w'] = $words[0];
                $word['qid'] = intval($words[1]);
                $wordslist[] = $word;
            }

        }

        return serialize($wordslist);
    }


    /**
     * 获取积分记录数据条数
     * @return mixed
     */
    function get_credit_count($where)
    {
        $query = $this->db->query("SELECT COUNT(`id`) AS `count` FROM `" . DB_TABLEPRE . "credit` LEFT JOIN `".DB_TABLEPRE."user` ON `".DB_TABLEPRE."credit`.`uid`=`".DB_TABLEPRE."user`.`uid` WHERE (`".DB_TABLEPRE."credit`.`credit1` + `".DB_TABLEPRE."credit`.`credit2`) > 0".$where);
        $count = $this->db->fetch_array($query);
        return $count['count'];
    }
    /**
     * 获取积分记录列表
     * @param $n
     * @param $num
     * @return array
     */
    function get_credit_list($where,$n,$num)
    {
        $msg = array(
            'reward'=>'奖励',
            'punish'=>'处罚',
            'offer'=>'悬赏付出',
            'adopt'=>'回答的问题被采纳',
            'question/add'=>'提出问题',
            'question/answer'=>'回答问题',
            'message/send'=>'发送短消息',
            'user/login'=>'登录',
            'user/register'=>'注册'
        );
        $table = array(array('table1'=>'credit','table2'=>'user','join'=>'uid','join_type'=>'LEFT JOIN'));
        $where = '('.DB_TABLEPRE . 'credit.credit1+' . DB_TABLEPRE . 'credit.credit2)>0'.$where;
        $field = array(
            DB_TABLEPRE.'credit`.`id` AS `cid',
            DB_TABLEPRE.'credit`.`time',
            'operation',
            DB_TABLEPRE.'credit`.`credit1` AS `cre1',
            DB_TABLEPRE.'credit`.`credit2` AS `cre2',
            'username'
        );
        $sql = Common::selectSql($table , $where , $field , DB_TABLEPRE . 'credit.time desc' , array($n,$num));
        $query = $this->db->query($sql);
        $credit = array();
        $key = 0;
        while( $credit_list = $this->db->fetch_array($query) ){
            $credit[$key]['id'] = $credit_list['cid'];
            $credit[$key]['time'] = tdate($credit_list['time']);
            switch($credit_list['operation']){
                case 'reward'://奖励得分
                    $credit[$key]['msg'] = $msg['reward'];
                    break;
                case 'punish'://处罚得分
                    $credit[$key]['msg'] = $msg['punish'];
                    break;
                case 'offer'://悬赏付出
                    $credit[$key]['msg'] = $msg['offer'];
                    break;
                case 'adopt'://回答的问题被采纳为答案
                    $credit[$key]['msg'] = $msg['adopt'];
                    break;
                case 'question/add'://提问得分
                    $credit[$key]['msg'] = $msg['question/add'];
                    break;
                case 'question/answer'://回答得分
                    $credit[$key]['msg'] = $msg['question/answer'];
                    break;
                case 'message/send'://发送短消息
                    $credit[$key]['msg'] = $msg['message/send'];
                    break;
                case 'user/login'://登录得分
                    $credit[$key]['msg'] = $msg['user/login'];
                    break;
                case 'user/register'://注册得分
                    $credit[$key]['msg'] = $msg['user/register'];
                    break;
            }
            $credit[$key]['cre1'] = $credit_list['cre1'];
            $credit[$key]['cre2'] = $credit_list['cre2'];
            $credit[$key]['username'] = $credit_list['username'];
            $key++;
        }
        $credit[0]['operation_msg'] = $msg;
        return $credit;
    }

    function remove_credit( $ids )
    {
        $this->db->query("DELETE FROM `" . DB_TABLEPRE . "credit` WHERE `id` IN ($ids)");
    }
}

?>