<?php
/**
 * Created by PhpStorm.
 * User: ChenHao
 * Date: 2016/11/1
 * Time: 9:20
 */
return array(
    array(
        'msg' => '按浏览数量排序',
        'order_field' => 'views' ,
        'status' => '' ,
        'table' => 'question',
        'field' => array( DB_TABLEPRE.'question`.`id','author' , 'title' , 'description' , 'time' , 'answers' , 'attentions' , 'status' , 'views' )
    ),
    array(
        'msg' => '按回复数量排序',
        'order_field' => 'answers' ,
        'status' => '' ,
        'table' => 'question',
        'field' => array( DB_TABLEPRE.'question`.`id','author' , 'title' , 'description' , 'time' , 'answers' , 'attentions' , 'status' , 'views' )
    ),
    array(
        'msg' => '按赞同数量排序',
        'order_field' => 'supports' ,
        'status' => '' ,
        'table' => array(
            array(
                'table1'     => 'answer' ,
                'table2'     => 'question',
                'join'        =>'qid,id',
                'join_type'  => 'left join'
            )
        ),
        'field' => array( DB_TABLEPRE.'question`.`id','author' , 'title' , 'description' , DB_TABLEPRE.'answer`.`time' , 'answers' , 'attentions' , 'status' , 'views' )
    ),
    array(
        'msg' => '按问题发表时间排序',
        'order_field' => DB_TABLEPRE.'question.time' ,
        'status' => '' ,
        'table' => array(
            array(
                'table1'     => 'question' ,
                'table2'     => 'category',
                'join'        =>'cid,id',
                'join_type'  => 'left join'
            ),
            array(
                'table1'     => 'question' ,
                'table2'     => 'question_img',
                'join'        =>'id,qid',
                'join_type'  => 'left join'
            ),
        ),
        'field' => array( DB_TABLEPRE.'question`.`id','author' , 'title' , 'description' , DB_TABLEPRE.'question`.`time' , 'answers' , 'attentions' , 'status' , 'views' , 'name' , 'img' )
    ),
    array(
        'msg' => '按未解决问题发表时间排序',
        'order_field' => DB_TABLEPRE.'question.time' ,
        'status' => 'status=1' ,
        'table' => array(
            array(
                'table1'     => 'question' ,
                'table2'     => 'category',
                'join'        =>'cid,id',
                'join_type'  => 'left join'
            ),
            array(
                'table1'     => 'question' ,
                'table2'     => 'question_img',
                'join'        =>'id,qid',
                'join_type'  => 'left join'
            ),
        ),
        'field' => array( DB_TABLEPRE.'question`.`id','author' , 'title' , 'description' , DB_TABLEPRE.'question`.`time' , 'answers' , 'attentions' , 'status' , 'views' , 'name' )
    ),
    array(
        'msg' => '按已解决问题发表时间排序',
        'order_field' => DB_TABLEPRE.'question.time' ,
        'status' => 'status=2' ,
        'table' => array(
            array(
                'table1'     => 'question' ,
                'table2'     => 'category',
                'join'        =>'cid,id',
                'join_type'  => 'left join'
            ),
            array(
                'table1'     => 'question' ,
                'table2'     => 'question_img',
                'join'        =>'id,qid',
                'join_type'  => 'left join'
            ),
        ),
        'field' => array( DB_TABLEPRE.'question`.`id','author' , 'title' , 'description' , DB_TABLEPRE.'question`.`time' , 'answers' , 'attentions' , 'status' , 'views' , 'name' )
    ),
    array(
        'msg' => '按悬赏问题的时间排序',
        'order_field' => DB_TABLEPRE.'question.time' ,
        'status' => 'price>0' ,
        'table' => array(
            array(
                'table1'     => 'question' ,
                'table2'     => 'category',
                'join'        =>'cid,id',
                'join_type'  => 'left join'
            ),
            array(
                'table1'     => 'question' ,
                'table2'     => 'question_img',
                'join'        =>'id,qid',
                'join_type'  => 'left join'
            ),
        ),
        'field' => array( DB_TABLEPRE.'question`.`id','author','price' , 'title' , 'description' , DB_TABLEPRE.'question`.`time' , 'answers' , 'attentions' , 'status' , 'views' , 'name' )
    ),
    array(
        'msg' => '按未解决问题的悬赏排序',
        'order_field' => DB_TABLEPRE.'question.price' ,
        'status' => 'price>0' ,
        'table' => array(
            array(
                'table1'     => 'question' ,
                'table2'     => 'category',
                'join'        =>'cid,id',
                'join_type'  => 'left join'
            ),
            array(
                'table1'     => 'question' ,
                'table2'     => 'question_img',
                'join'        =>'id,qid',
                'join_type'  => 'left join'
            ),
        ),
        'field' => array( DB_TABLEPRE.'question`.`id','author' ,'price', 'title' , 'description' , DB_TABLEPRE.'question`.`time' , 'answers' , 'attentions' , 'status' , 'views' , 'name' )
    ),
);
?>