<?php
/**
 * 服务中心
 * Created by PhpStorm.
 * User: Chenhao
 * Date: 2016/11/29
 * Time: 16:24
 */
defined('InShopNC') or exit('Access Invalid!');

class servicecenterControl extends ServiceControl {

    /**
     * 首页
     */
    public function indexOp()
    {

        //轮播图
        $model_web_config = Model('web_config');
        $web_id = '220';
        $code_list = $model_web_config->getCodeList(array('web_id'=> $web_id));
        if(is_array($code_list) && !empty($code_list)) {
            foreach ($code_list as $key => $val) {//将变量输出到页面
                $var_name = $val['var_name'];
                $code_info = $val['code_info'];
                $code_type = $val['code_type'];
                $val['code_info'] = $model_web_config->get_array($code_info,$code_type);
                Tpl::output('code_'.$var_name,$val);
            }
        }

        $model = Model('servicecenter');
        //关于我们
        $article_title = array('企业介绍' , '企业大事记' , '团队展示' , '招聘英才');
        $condition = array();
        $article_title = "'" . implode("','",$article_title) . "'";
        $condition['where'] = 'article_title IN ('.$article_title.')';
        $about_us = $model -> getArticleList($condition);
        foreach($about_us as $key => $val) {
            $about_us[$key]['article_content'] = strip_tags($val['article_content']);
        }

        //热点问题
        $condition = array();
        $condition['where'] = "article_id in (103,106,108,105,109,114)";
        $condition['field'] = 'article_id,article_title,article_content,article.ac_id,ac_name';
        $hot_question = $model -> getArticleJoinList($condition);
        $str = '#<h1>(.*)</h1>#Uis';
        foreach($hot_question as $key => $val) {
            $article_content = strip_tags($val['article_content'],'<h1>');
            preg_match_all($str , $article_content , $article_content_new);
            $hot_question[$key]['article_content'] = array_slice($article_content_new[1],0,10);
        }

        Tpl::output('hot_question',$hot_question);
        Tpl::output('about_us',$about_us);
        Tpl::output('nav_type',0);
        Tpl::showpage('index');
    }

    public function articleOp()
    {
        $type = 0;
        (isset($_GET['ac_id'])) && $type = 1;
        (isset($_GET['article_id'])) && $type = 2;
        (isset($_GET['article_title'])) && $type = 3;
        $model = Model('servicecenter');
        switch($type){
            case 1:
                $data = $model->getArticleName($_GET['ac_id']);
                $article = $model->getArticleContent($data[0]['article_id']);
                $data[0]['article_content'] = 1;
                $nav_type = $_GET['ac_id'];
                break;
            case 2:
                $article_id = $_GET['article_id'];
                $article = $model->getArticleContent($article_id);
                $data = $model->getArticleName($article['ac_id']);
                foreach( $data as $key => $val ){
                    if($val['article_id'] == $article_id){
                        $data[$key]['article_content'] = 1;
                    }
                }
                $nav_type = $article['ac_id'];
                break;
            case 3:
                $article_title = $_GET['article_title'];
                $article = $model->getArticleId($article_title);
                if(empty($article)){
                    echo "<script>alert('暂无该文章！');location.history.go(-1)</script>";
                    exit;
                }
                $data = $model->getArticleName($article['ac_id']);
                foreach( $data as $key => $val ){
                    if($val['article_title'] == $article_title){
                        $data[$key]['article_content'] = 1;
                    }
                }
                $nav_type = $article['ac_id'];
                break;
            default:
                echo "<script>alert('非法请求！');location.history.go(-1)</script>";
                exit;
                break;
        }

        if(!empty($article['article_url'])){//如果有外链   则跳转至外链
            header('Location:'.$article['article_url']);exit;
        }

        $question = array();
        //常见问题
        if($data[0]['ac_name'] != '热点问题' && $article['article_title'] != '常见问题') {
            //判断是否存在同名的热点问题文章   存在则调用此文章，不存在则调用常见问题
            $condition['field'] = 'article_content,ac_id,article_title,article_id';
            $condition['where'] = "article_title = '" . $article['article_title'] . "' and ac_id = 12";
            $condition['limit'] = 1;
            $question_con = $model->getArticleList($condition);
            if(empty($question_con)) {
                $question = $model->getArticleId('常见问题');
                $article_content = strip_tags($question['article_content'] , '<span>');
                $str = '#<span .*>咨询内容：</span>(.*)<span .*>#Uis';
                preg_match_all($str , $article_content , $article_content_new);
                $question['article_content'] = $article_content_new[1];
            }else{
                $question = $question_con[0];
                $article_content = strip_tags($question['article_content'] , '<h1>');
                $str = '#<h1>(.*)</h1>#Uis';
                preg_match_all($str , $article_content , $article_content_new);
                $question['article_content'] = $article_content_new[1];
            }
        }

        if( $article['article_title'] == '企业大事记' ){
            $str = '#<h1>(.*)</h1>(.*)<h2>(.*)</h2>(.*)<p>(.*)</p>(.*)<h3>(.*)</h3>#Uis';
            preg_match_all($str , $article['article_content'] , $new_content);
            $article['article_content'] = array();
            $num = count($new_content[0]);
            $strr = '#<img src="(.*)" .*>#Uis';
            for($i = 0 ; $i < $num ; $i++ ) {
                $year = explode('年',trim($new_content[1][$i]));
                $month = explode('月',$year[1]);
                $day = explode('日',$month[1]);
                $article['article_content'][$i]['year'] = $year[0];
                $article['article_content'][$i]['month'] = $month[0];
                $article['article_content'][$i]['day'] = $day[0];
                $article['article_content'][$i]['title'] = trim( $new_content[3][$i] );
                $article['article_content'][$i]['content'] = trim( $new_content[5][$i] );
                preg_match_all($strr , trim( $new_content[7][$i] ) , $new_img);
                $n = count($new_img[1]);
                for($j = 0 ; $j < $n ; $j++) {
                    $article['article_content'][$i]['img'][] = trim($new_img[1][$j]);
                }
            }
        } elseif($data[0]['ac_name'] == '热点问题'){
            $str = '#<h1>(.*)</h1>#Uis';
            $strr = '#<h2>(.*)</h2>#Uis';
            preg_match_all($str , strip_tags($article['article_content'] , '<h1>') , $new_title);
            preg_match_all($strr , strip_tags($article['article_content'] , '<h2>') , $new_content);
            $num = count($new_content[0]);
            $article['article_content'] = array();
            for($i = 0 ; $i < $num ; $i++ ) {
                $article['article_content'][$i]['title'] = trim($new_title[1][$i]);
                $article['article_content'][$i]['content'] = trim($new_content[1][$i]);
            }
        } elseif($article['article_title'] == '账户安全'){
            $str = '#<h1>(.*)</h1>(.*)<span>#Uis';
            preg_match_all($str , $article['article_content'] , $new_content);
            $article['article_content'] = array();
            $article['article_content']['title'] = $new_content[1];
            $article['article_content']['content'] = $new_content[2];
        }
        Tpl::output('question',$question);
        Tpl::output('data',$data);
        Tpl::output('article',$article);
        Tpl::output('nav_type',$nav_type);
        Tpl::showpage('service_content');
    }
}

