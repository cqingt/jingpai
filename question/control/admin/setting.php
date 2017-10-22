<?php
ini_set('user_agent' , 'Mozilla/4.0 (compatible; MSIE 7.0; Windows NT 6.0; Win64; x64; .NET CLR 2.0.50727; SLCC1; Media Center PC 5.0; .NET CLR 3.0.30618; .NET CLR 3.5.30729)');
!defined('IN_ASK2') && exit( 'Access Denied' );

class admin_settingcontrol extends base
{
    var $lang;
    function admin_settingcontrol( & $get , & $post )
    {
        $this->base($get , $post);
        $this->load("tag");
        $this->load('user');
        $this->load('setting');
        $this->load("question");
        $this->load("doing");
        $this->load("category");
        $this->load('answer');
        $this->load('answer_comment');
        $this->load('web');
        //加载语言包
        Language::read('admin/setting');
        $this->lang = Language::getLangContent();
    }

    function ondefault()
    {
        $this->onbase();
    }

    /* 基本设置 */

    function onbase()
    {
        $tpllist = $_ENV['setting']->tpl_list();
        $waptpllist = $_ENV['setting']->tpl_waplist();

        if ( isset( $this->post['submit'] ) ) {
            if ( isset( $_FILES["file_upload"] ) ) {
                $imgname = strtolower($_FILES['file_upload']['name']);

                $type = substr(strrchr($imgname , '.') , 1);

                if ( isimage($type) ) {


                    $upload_tmp_file = ASK2_ROOT . '/data/tmp/sitelogo.' . $type;

                    $filepath = '/data/attach/logo/logo' . '.' . $type;
                    forcemkdir(ASK2_ROOT . '/data/attach/logo');
                    if ( move_uploaded_file($_FILES['file_upload']['tmp_name'] , $upload_tmp_file) ) {
                        image_resize($upload_tmp_file , ASK2_ROOT . $filepath , 172 , 60);
                        $this->setting['site_logo'] = SITE_URL . substr($filepath , 1);
                    }
                }
            }
            if ( isset( $_FILES["bannerfile"] ) ) {
                $bannerfile = strtolower($_FILES['bannerfile']['name']);
                $bannertype = substr(strrchr($bannerfile , '.') , 1);
                if ( isimage($bannertype) ) {
                    $upload_tmp_file = ASK2_ROOT . '/data/tmp/sitebanner.' . $bannertype;
                    $filepath = '/data/attach/banner/sitebanner' . '.' . $bannertype;
                    forcemkdir(ASK2_ROOT . '/data/attach/banner');
                    if ( move_uploaded_file($_FILES['bannerfile']['tmp_name'] , $upload_tmp_file) ) {
                        image_resize($upload_tmp_file , ASK2_ROOT . $filepath , 1180 , 400);
                        $this->setting['banner_img'] = SITE_URL . substr($filepath , 1);
                    }
                }
            }
            $this->setting['banner_color'] = $this->post['banner_color'];
            $this->setting['duoshuoname'] = $this->post['duoshuoname'];
            $this->setting['site_name'] = $this->post['site_name'];
            $this->setting['seo_index_title'] = $this->post['seo_index_title'];
            $this->setting['openweixin'] = $this->post['openweixin'];
            $this->setting['register_clause'] = $this->post['register_clause'];
            $this->setting['site_icp'] = $this->post['site_icp'];
            $this->setting['verify_question'] = $this->post['verify_question'];
            $this->setting['allow_outer'] = $this->post['allow_outer'];
            $this->setting['tpl_dir'] = $this->post['tpl_dir'];
            $this->setting['tpl_wapdir'] = $this->post['tpl_wapdir'];
            $this->setting['wap_domain'] = $this->post['wap_domain'];
            $this->setting['question_share'] = stripslashes($this->post['question_share']);
            $this->setting['site_statcode'] = stripslashes($this->post['site_statcode']);
            $this->setting['index_life'] = $this->post['index_life'];
            $this->setting['sum_category_time'] = $this->post['sum_category_time'];
            $this->setting['sum_onlineuser_time'] = $this->post['sum_onlineuser_time'];
            $this->setting['list_default'] = $this->post['list_default'];
            $this->setting['rss_ttl'] = $this->post['rss_ttl'];
            $this->setting['code_register'] = intval(isset( $this->post['code_register'] ));
            $this->setting['code_login'] = intval(isset( $this->post['code_login'] ));
            $this->setting['code_ask'] = intval(isset( $this->post['code_ask'] ));
            $this->setting['code_message'] = intval(isset( $this->post['code_message'] ));
            $this->setting['notify_mail'] = intval(isset( $this->post['notify_mail'] ));
            $this->setting['notify_message'] = intval(isset( $this->post['notify_message'] ));
            $this->setting['allow_expert'] = intval($this->post['allow_expert']);
            $this->setting['apend_question_num'] = intval($this->post['apend_question_num']);
            $this->setting['allow_credit3'] = intval($this->post['allow_credit3']);
            $_ENV['setting']->update($this->setting);
            $message = '站点设置更新成功！';
        }
        include template('setting_base' , 'admin');
    }

    /* 列表显示 */

    function onlist()
    {
        if ( isset( $this->post['submit'] ) ) {
            foreach ( $this->post as $key => $value ) {
                if ( 'list' == substr($key , 0 , 4) ) {
                    $this->setting[$key] = $value;
                }
            }
            $this->setting['title_description'] = $this->post['title_description'];
            $this->setting['hot_on'] = intval($this->post['hot_on']);
            $this->setting['index_life'] = intval($this->post['index_life']);
            $this->setting['hot_words'] = $_ENV['setting']->get_hot_words($this->setting['list_hot_words']);
            $_ENV['setting']->update($this->setting);
            $message = '列表显示更新成功！';
        }
        $lang = $this->lang;
        //获取首页栏目信息
        $web_list = $_ENV['web']->get();
        $web_config = include WEB_SETTING_LIST;
        include template('setting_list' , 'admin');
    }

    /**
     * 即点即改
     */
    function onajaxUpdate()
    {
        $data = array();
        $data[$_GET['field_name']] = $_GET['value'];
        $id = intval($_GET['id']);
        $re = $_ENV['web']->update($data , $id);
        if ( $re ) {
            $this -> log('编辑问答系统首页板块设置['. $id .']',null);
            echo 1;
            exit;
        } else {
            echo 0;
            exit;
        }
    }

    /**
     * 栏目删除
     */
    function onajaxDelete()
    {
        $id = intval($_GET['id']);
        $re = $_ENV['web']->delete($id);
        if ( $re ) {
            echo 1;
            $this -> log('删除问答系统首页板块['. $id .']',null);
            exit;
        } else {
            echo 0;
            exit;
        }
    }

    /**
     * 添加
     */
    function onwebAdd()
    {
        if ( isset( $this->post['submit'] ) ) {
            $data = array();
            $data['web_name'] = $this->post['web_name'];
            $data['web_site'] = $this->post['web_site'];
            $data['web_sort'] = intval($this->post['web_sort']);
            $data['web_list_type'] = intval($this->post['web_list_type']);
            $data['web_show'] = intval($this->post['web_show']);
            $data['web_num'] = intval($this->post['web_num']);
            $data['update_time'] = time();
            $re = $_ENV['web']->add($data);
            if ( $re ) {
                $this -> log('添加问答系统首页板块['. $data['web_name'] .']',null);
                $message = $this->lang['setting_list_add_success_msg'];
            } else {
                $message = $this->lang['setting_list_add_fail_msg'];
            }
        }
        $lang = $this->lang;
        //获取首页栏目信息
        $web_list = $_ENV['web']->get();
        $add_state = 1;
        $web_config = include WEB_SETTING_LIST;
        include template('setting_list' , 'admin');
    }

    //关注问题
    function attention_question( $qid , $user_uid , $user_username )
    {
        $uid = $user_uid;
        $username = $user_username;
        $is_followed = $_ENV['question']->is_followed($qid , $uid);
        if ( $is_followed ) {
            $_ENV['user']->unfollow($qid , $uid);
        } else {
            $_ENV['user']->follow($qid , $uid , $username);
            $_ENV['doing']->add($uid , $username , 4 , $qid);
        }
    }

    function rand_time( $a , $b )
    {
        $a = strtotime($a);
        $b = strtotime($b);
        return date("Y-m-d H:m:s" , mt_rand($a , $b));
    }

    /* 积分设置 */

    function oncredit()
    {
        if ( isset( $this->post['submit'] ) ) {
            foreach ( $this->post as $key => $value ) {
                if ( 'credit' == substr($key , 0 , 6) ) {
                    $this->setting[$key] = $value;
                }
            }
            $_ENV['setting']->update($this->setting);
            $this -> log('更新问答系统积分设置');
            $message = '积分设置更新成功！';
        }
        $lang = $this -> lang;
        include template('setting_credit' , 'admin');
    }

    /**
     * 积分明细列表
     */
    function onclist($msg = '')
    {
        $search = array();
        if (count($this->get) > 2) {
            $search['srchname'] = $this->get[2];
            $search['srchuid'] = $this->get[3];
            $search['srchregdatestart'] = $this->get[4];
            $search['srchregdateend'] = $this->get[5];
            $search['srchoperation'] = $this->get[6];
        } else {
            $search = $this->post;
        }
        $condition = '';
        if (isset($search['srchname']) && '' != trim($search['srchname'])) {
            $condition .=" AND `username` like '" . trim($search['srchname']) . "%' ";
        }
        if (isset($search['srchuid']) && '' != trim($search['srchuid'])) {
            $condition .= " AND `".DB_TABLEPRE."credit`.`uid`=" . intval($search['srchuid']);
        }
        if (isset($search['srchoperation']) && '' != trim($search['srchoperation'])) {
            $condition .= " AND `operation` = '" . trim($search['operation']) . "'";
        }
        if (isset($search['srchregdatestart']) && '' != trim($search['srchregdatestart'])) {
            $datestart = strtotime($search['srchregdatestart']);
            $condition .= " AND `".DB_TABLEPRE."credit`.`time` >= $datestart ";
        }
        if (isset($search['srchregdateend']) && '' != trim($search['srchregdateend'])) {
            $dateend = strtotime($search['srchregdateend']);
            $condition .= " AND `".DB_TABLEPRE."credit`.`time` <= " . $dateend;
        }
        @$page = max(1, intval($this->get[7]));
        $pagesize = $this->setting['list_default'];
        $startindex = ($page - 1) * $pagesize;
        $creditlist = $_ENV['setting']->get_credit_list($condition,$startindex,$pagesize);
        $creditlistnum = $_ENV['setting']->get_credit_count($condition);
        $departstr = page($creditlistnum , $pagesize , $page , "admin_setting/clist/$search[srchname]/$search[srchuid]/$search[srchregdatestart]/$search[srchregdateend]/$search[srchoperation]");
        $msg && $message = $msg;
        $lang = $this->lang;
        include template('setting_creditlist' , 'admin');
    }

    function onremovecredit() {
        if (isset($this->post['id'])) {
            $uids = implode(",", $this->post['id']);
            $_ENV['setting']->remove_credit($uids);
            $this -> log('删除问答系统积分明细[ID:'.$uids.']');
            $this->onclist($this->lang['setting_creditlist_list_delete_confirm_msg']);
        }
    }

    /* 缓存设置 */

    function oncache()
    {
        $tplchecked = $datachecked = false;
        if ( isset( $this->post['submit'] ) ) {
            if ( isset( $this->post['type'] ) ) {
                if ( in_array('tpl' , $this->post['type']) ) {
                    $tplchecked = true;
                    cleardir(ASK2_ROOT . '/data/view');
                }
                if ( in_array('data' , $this->post['type']) ) {
                    $datachecked = true;
                    cleardir(ASK2_ROOT . '/data/cache');
                }
                $message = '缓存更新成功！';
            } else {
                $tplchecked = $datachecked = false;
                $message = '没有选择缓存类型！';
                $type = 'errormsg';
            }
        }
        include template('setting_cache' , 'admin');
    }

    /* 通行证设置 */

    function onpassport()
    {
        if ( isset( $this->post['submit'] ) ) {
            foreach ( $this->post as $key => $value ) {
                if ( 'passport' == substr($key , 0 , 8) ) {
                    $this->setting[$key] = $value;
                }
            }
            $this->setting['passport_credit1'] = intval(isset( $this->post['passport_credit1'] ));
            $this->setting['passport_credit2'] = intval(isset( $this->post['passport_credit2'] ));
            $_ENV['setting']->update($this->setting);
            $message = '通行证设置更新成功！';
        }
        include template('setting_passport' , 'admin');
    }


    /* SEO设置 */

    function onseo()
    {
        if ( isset( $this->post['submit'] ) ) {
            foreach ( $this->post as $key => $value ) {
                if ( 'seo' == substr($key , 0 , 3) ) {
                    $this->setting[$key] = $value;
                }
            }
            $this->setting['baidu_api'] = $this->post['baidu_api'];
            $this->setting['seo_prefix'] = ( $this->post['seo_on'] ) ? '' : '?';
            $_ENV['setting']->update($this->setting);
            $message = 'SEO设置更新成功！';
        }
        include template('setting_seo' , 'admin');
    }

    /* 消息模板 */

    function onmsgtpl()
    {
        if ( isset( $this->post['submit'] ) ) {
            $msgtpl = array();
            for ( $i = 1; $i <= 4; $i++ ) {
                $message['title'] = $this->post['title' . $i];
                $message['content'] = $this->post['content' . $i];
                $msgtpl[] = $message;
            }
            $this->setting['msgtpl'] = serialize($msgtpl);
            $_ENV['setting']->update($this->setting);
            unset( $type );
            $message = '消息模板设置成功!';
        }
        $msgtpl = unserialize($this->setting['msgtpl']);
        include template('setting_msgtpl' , 'admin');
    }

    /* 生成htm页面 */

    function onhtm()
    {
        $minqid = $this->get[2];
        $maxqid = $this->get[3];
        $qid = $this->get[4];
        $this->load('question');
        $question = $_ENV['question']->get($qid);
        if ( $question && 0 != $question['status'] && 9 != $question['status'] ) {
            $this->write_question($question);
        }
        $nextqid = $qid + 1;
        $finish = $qid - $minqid + 1;
        include template('makehtm' , 'admin');
    }

    /* 更新问答统计 */

    function oncounter()
    {
        if ( isset( $this->post['submit'] ) ) {
            foreach ( $this->post as $key => $value ) {
                if ( 'counter' == substr($key , 0 , 7) ) {
                    $this->setting[$key] = strtolower($value);
                }
            }
            $_ENV['setting']->update_counter();
            $_ENV['setting']->update($this->setting);
            $message = '问答统计更新成功！';
        }
        include template('setting_counter' , 'admin');
    }

    /* * 广告管理* */

    function onad()
    {
        if ( isset( $this->post['submit'] ) ) {
            $this->setting['ads'] = taddslashes(serialize($this->post['ad']) , 1);
            $_ENV['setting']->update($this->setting);
            $type = 'correctmsg';
            $message = '广告修改成功!';
            $this->setting = $this->cache->load('setting');
        }
        $adlist = tstripslashes(unserialize($this->setting['ads']));
        include template('setting_ad' , 'admin');
    }

    /**
     * 搜索设置
     */
    function onsearch()
    {
        if ( isset( $this->post['submit'] ) ) {
            $this->setting['search_placeholder'] = $this->post['search_placeholder'];
            $this->setting['search_shownum'] = $this->post['search_shownum'];
            $this->setting['search_hot'] = str_replace('，' , ',' , $this->post['search_hot']);
            $this->setting['xunsearch_open'] = $this->post['xunsearch_open'];
            $this->setting['xunsearch_sdk_file'] = $this->post['xunsearch_sdk_file'];
            if ( $this->setting['xunsearch_open'] && !file_exists($this->setting['xunsearch_sdk_file']) ) {
                $type = 'errormsg';
                $message = 'SDK文件不存在，请核实!';
            } else {
                $type = 'correctmsg';
                $message = '搜索设置成功!';
            }
            $_ENV['setting']->update($this->setting);
            $this -> log('更新问答系统搜索设置');
        }
        include template('setting_search' , 'admin');
    }

    /**
     * 生产全文检索
     */
    function onmakewords()
    {
        $this->load("question");
        $_ENV['question']->make_words();
    }

    function ongetfolders()
    {
        $file_dir = "caiji";
        $shili = $file_dir;
        if ( !file_exists($shili) ) {
            echo $shili . "目录不存在!";
        } else {
            $i = 0;
            $file = '';
            if ( is_dir($shili) ) {                   //检测是否是合法目录
                if ( $shi = opendir($shili) ) {          //打开目录
                    while ( $li = readdir($shi) ) {       //读取目录
                        $i++;
                        $temps = explode('.' , $li);
                        $file = $file . $temps[0] . ',';
                    }
                }
            }     //输出目录中的内容
            echo trim($file , ",");
            closedir($shi);
        }
    }
}

?>