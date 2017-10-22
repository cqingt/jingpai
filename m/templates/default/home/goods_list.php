<?php defined('InShopNC') or exit('Access Invalid!');?>

<link href="<?php echo MOBILE_TEMPLATES_URL;?>/css/list.css" rel="stylesheet" type="text/css">
<link href="<?php echo MOBILE_TEMPLATES_URL;?>/css/m_style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/all_html5.css" type="text/css" />
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/base2013.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">


<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/ping.min.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/spin.min.js"></script>
<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/zepto.min.js"></script>


<?php 
    $cate_id = $_GET['cate_id'];
    $a_id = $_GET['a_id'];
    if($_GET['order'] == 2){
        $order = 1;
    }else{
        $order = 2;
    }
    $key = $_GET['key'];
?>


<div style="position: absolute;top:0px;width: 190px;height: 100%;right: 0px;top: 0;z-index: 9999;overflow:hidden;display:none;" id="filterbar">
    <div class="new-tab-type">
        <div class="new-srch-pop" id="slidebar" style="-webkit-transition: -webkit-transform 0.4s;-webkit-transform-origin: 0px 0px; -webkit-transform-style: preserve-3d;-webkit-transform: translate(190px, 0);">
            <div class="new-pop-ul new-p-re" id="filter_prop">


<ul class="new-ul-lst">


    <li class="new-ul-li">
        <a href="javascript:void(0)" onclick="showHideFilter(this)" class="new-li-a ">分类</a>
        <div class="new-pop-sel" style="display:">
            <ul>

<?php if($output['goods_class_array']){?>
<?php foreach ($output['goods_class_array']['class2'] as $k => $v) {?>
    <li><a href="<?php echo urlWap('goods','goods_list',array('cate_id'=>$v['gc_id'],'type'=>$_GET['type']));?>" onclick="selectExpandSort(this)" class=""><span  <?php if($v['gc_id'] == $output['default_classid']){echo "style='color:red;'";}?>><?php echo $v['gc_name'];?></span></a></li>

    <?php if($v['class3']){?>
    <?php foreach ($v['class3'] as $key => $val) {?>
    <li><a href="<?php echo urlWap('goods','goods_list',array('cate_id'=>$val['gc_id'],'type'=>$_GET['type']));?>" onclick="selectExpandSort(this)" class=""><span <?php if($val['gc_id'] == $output['default_classid']){echo "style='color:red;'";}?>>----<?php echo $val['gc_name'];?></span></a></li>
    <?php }?>
    <?php }?>
<?php }?>
<?php }?>





            </ul>
        </div>
    </li>

<?php if(!empty($output['checked_attr'])){?>

    <li class="new-ul-li">
        <a href="javascript:void(0)" onclick="showHideFilter(this)" class="new-li-a on">已选择：</a>
        <div class="new-pop-sel" style="display:none">
            <ul>

<?php foreach ($output['checked_attr'] as $k => $v) {?>

    <?php if($_GET['a_id']){
       $aid_array = explode('_',$_GET['a_id']);

       if(count($aid_array) > 1){
        foreach ($aid_array as $ak => $av) {
           if($v['attr_value_id'] == $av){
            unset($aid_array[$ak]);
           }
        }

        $aid = join($aid_array,'_');

       }else{
        $aid = 0;
       }
       
    }
    ?>
    
    <li><a href="<?php echo urlWap('goods','goods_list',array('cate_id'=>$output['default_classid'],'a_id'=>$aid,'order'=>$order,'key'=>$key,'type'=>$_GET['type']));?>" onclick="selectExpandSort(this)" class="on"><span><?php echo $v['attr_name'].'--'.$v['attr_value_name'];?></span></a></li>

<?php }?>

            </ul>
        </div>
    </li>

<?php }?>





<?php if($output['attr_array']){?>

<?php foreach ($output['attr_array'] as $k => $v) {?>
    
    <li class="new-ul-li">
        <a href="javascript:void(0)" onclick="showHideFilter(this)" class="new-li-a on"><?php echo $v['name'];?></a>
        <div class="new-pop-sel" style="display:none">
            <ul>

<?php if($v['value']){?>
    <?php foreach ($v['value'] as $key => $val) {?>
                
                <?php if($_GET['a_id']){
                    $aid = $val['attr_value_id'].'_'.$_GET['a_id'];
                }else{
                    $aid = $val['attr_value_id'];
                }
                ?>
                
                <li><a href="<?php echo urlWap('goods','goods_list',array('cate_id'=>$output['default_classid'],'a_id'=>$aid,'order'=>$order,'key'=>$key,'type'=>$_GET['type']));?>" onclick="selectExpandSort(this)" class="on"><span><?php echo $val['attr_value_name'];?></span></a></li>


    <?php }?>
<?php }?>


            </ul>
        </div>
    </li>



<?php }?>

<?php }?>

</ul>



            </div>
        </div>
    </div>
</div>




<script src="<?php echo MOBILE_TEMPLATES_URL;?>/js/adv.js"></script>
<script src="<?php echo MOBILE_TEMPLATES_URL;?>/js/categorys.js"></script>




<div class="mss_c">
    <div class="mss_center_body">
        <div class="new_tab_type">
            <div class="new_tb1_type">
                
                <a class="new_tb1_cell">
                    <span class="new-bar"></span><span class="new_pre">排序:</span>
                </a>
                <a class="new_tb1_cell" href="<?php echo urlWap('goods','goods_list',array('cate_id'=>$cate_id,'a_id'=>$a_id,'order'=>$order,'key'=>1,'keyword'=>$_GET['keyword'],'type'=>$_GET['type']));?>">
                    <span class="new-bar"></span><span class="new_pre" <?php if(intval($_GET['key']) == 1){ ?>style="color: red;"<?php } ?>>销量</span>
                </a>
                <a class="new_tb1_cell" href="<?php echo urlWap('goods','goods_list',array('cate_id'=>$cate_id,'a_id'=>$a_id,'order'=>$order,'key'=>2,'keyword'=>$_GET['keyword'],'type'=>$_GET['type']));?>">
                    <span class="new-bar"></span><span class="new_pre" <?php if(intval($_GET['key']) == 2){ ?>style="color: red;"<?php } ?>>人气</span>
                </a>
                <a class="new_tb1_cell" href="<?php echo urlWap('goods','goods_list',array('cate_id'=>$cate_id,'a_id'=>$a_id,'order'=>$order,'key'=>3,'keyword'=>$_GET['keyword'],'type'=>$_GET['type']));?>">
                    <span class="new-bar"></span><span class="new_pre" <?php if(intval($_GET['key']) == 3){ ?>style="color: red;"<?php } ?>>价格</span>
                </a>
                <a class="new_tb1_cell" id="btn_filter" f="1" href="javascript:void(0)">
                    <span class="new-bar"></span><span class="icon">筛选<span></span></span>
                </a>
            </div>
        </div>
        <ul class="mss_center_body_ul">
            <?php foreach($output['goods_list'] as $key=>$val){ ?>
            <li class="mss_c_li">
                <a class="mss_c_li_a" href="<?php echo urlWap('goods','index',array('goods_id'=>$val['goods_id']));?>">
                    <span class="mss_c_left"><img src="<?php echo $val['goods_image_url']?>" width="100" height="100"></span>
                     <span class="mss_c_right">
                        <strong class="mss_c_right_strong"><?php echo $val['goods_name']?></strong>
                        <span class="mss_c_right_strong">
                              <span class="mss_c_right_strong_text"><?php echo $val['store_name']?></span>
                        </span>
                        <span class="mss_c_right_c">
                              <strong class="mss_c_right_ccc"><span>
							  <?php if($val['promotion_price'] > 0){ ?>
								<?php echo '¥'.intval($val['promotion_price'])?>
							  <?php }else{ ?>
								<?php if($_GET['type'] == 'ShuHua'){ ?>
								<?php echo ($val['goods_price'] < 1)?"价格：咨询客服":'¥'.intval($val['goods_price'])?>
								<?php }else{?>
								<?php echo ($val['goods_price'] < 1)?"咨询客服":'¥'.intval($val['goods_price'])?>
								<?php } ?>
							  <?php } ?>
							  </span> <?php if($val['xianshi_flag']){ ?><span style="padding: 0 4px;margin-right: 5px;border: 1px solid #ff6b6b;margin-left: 2px;text-align: center;font-family: 'microsoft yahei';font-size: 12px;color: #fff;background: #ff6b6b; border-radius: 3px;">限时折扣</span><?php }?></strong>
                        </span>
                        <span class="mss_c_right_c new_ct">
                              <span class="new_txt">已出售<?php echo intval($val['goods_salenum'])?>件, <?php echo round(($val['evaluation_good_star'] / 5 * 100),2)?>%好评</span>
                        </span>
                  </span>
                </a>
            </li>
            <?php }?>
        </ul>
    </div>

    <?php echo $output['show_page'];?>


</div>
 

<?php

$array['P']['title'] = $output['html_title'];//$output['goods_list']['0']['goods_name'];
$array['P']['imgUrl'] = cthumb($output['goods_list']['0']['goods_image'],60);
$array['Y']['title'] = $output['html_title'];//$output['goods_list']['0']['goods_name'];
$array['Y']['desc'] = $output['seo_description'];//$output['goods_list']['0']['goods_name'];
$array['Y']['imgUrl'] = cthumb($output['goods_list']['0']['goods_image'],60);

echo weixinShare($array);

?>

<script>
(function(){
    var bp = document.createElement('script');
    var curProtocol = window.location.protocol.split(':')[0];
    if (curProtocol === 'https') {
        bp.src = 'https://zz.bdstatic.com/linksubmit/push.js';        
    }
    else {
        bp.src = 'http://push.zhanzhang.baidu.com/push.js';
    }
    var s = document.getElementsByTagName("script")[0];
    s.parentNode.insertBefore(bp, s);
})();
</script>