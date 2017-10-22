<?php defined('InShopNC') or exit('Access Invalid!');?>

<link href="<?php echo MOBILE_TEMPLATES_URL;?>/css/m_style.css" rel="stylesheet" type="text/css">
<link href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css" rel="stylesheet" type="text/css">
<link href="<?php echo MOBILE_TEMPLATES_URL;?>/css/child.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/m_menu.css" charset="gbk"/>

<link href="<?php echo MOBILE_TEMPLATES_URL;?>/css/m_style.css" rel="stylesheet" type="text/css">
<link href="<?php echo MOBILE_TEMPLATES_URL;?>/css/m_vip.css" rel="stylesheet" type="text/css">
<link href="<?php echo MOBILE_TEMPLATES_URL;?>/css/m_category.css" rel="stylesheet" type="text/css"/>

<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/all_html5.css" type="text/css" />
<link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/base2013.css" type="text/css" />



<script type="text/javascript" src="<?php echo MOBILE_TEMPLATES_URL;?>/js/common.js"></script>
<style>
    .m_category2-lst{
        -webkit-animation:fadeInLeftBig 1s .2s ease both;
        -moz-animation:fadeInLeftBig 1s .2s ease both;
    }
</style>
<article class="demo">
<form name="searchForm" method="get" action="<?php echo urlWap('goods','goods_list');?>" >
    <input type="hidden" name="act" value="goods">
    <input type="hidden" name="op" value="goods_list">
    <div class="new-cate-srch">
        <div class="new-srch-box">
            <input name="keyword" id="newkeyword" type="text" required="" class="new-srch-input" value="" onblur="if(this.value==''){this.value='请输入搜索关键字';}" onfocus="if(this.value=='请输入搜索关键字'){this.value='';}">
            <a href="javascript:void(0);" target="_self" onclick="cancelHotWord()" class="new-s-close"></a>
            <a href="javascript:void(0)" target="_self" onclick="search_new()" class="new-s-srch"><span></span></a>
        </div>
        <div class="new-srch-lst" id="shelper" style="display:none"></div>
    </div>
</form>
<a name="top"></a>
<div class="m_w">
    <div class="m_category">
        <ul class="m_category-lst">
            <?php foreach($output['goods_class_array'] as $k=>$class1){ ?>
            <li class="m_category-li">
                <a class="m_category-a"><span class="icon"></span><?php echo $class1['gc_name'];?></a>
                <ul class="m_category2-lst" id="category1315" style="display:none">
                    <?php
                    $i = 1;
                    $all = count($class1['class2']);
                    foreach($class1['class2'] as $k1=>$class2){
                    ?>
                    <?php if(($i % 3) == 1){?>
                            <li class="m_category2-li">
                        <?php } ?>
                        <a href="<?php echo urlWap('goods','goods_list',array('cate_id'=>$class2['gc_id']))?>" class="m_category2-a"><span class="new-bar"></span><?php echo $class2['gc_name'];?></a>
                        <?php if(($i % 3) == 0){?>
                            </li>
                        <?php
                            }
                        if(($i % 3) != 0 && $i == count($class1['class2'])){
                            for($c=0;$c<(3-($i % 3));$c++){
                                echo '<a href="javascript:void(0)" class="m_category2-a"><span class="new-bar"></span> </a>';
                            }
                            echo '</li>';
                        }
                            $i++;
                        ?>
                        <?php } ?>
                </ul>
            </li>
            <?php }?>

        </ul>
    </div>
</div>
<script language="javascript">
    $(function(){
        $("li.m_category-li>a").click(function(){
            var obj = $(this).parent().children().eq(1);
            if(obj.css('display')=='none'){
                $(".m_category2-lst").hide();
                obj.fadeIn();
                $("li.m_category-li>a").removeClass("m_category-a new-on").addClass("m_category-a");
                $(this).addClass("m_category-a new-on");
            }else{
                obj.fadeOut();
                $("li.m_category-li>a").removeClass("m_category-a new-on").addClass("m_category-a");
                $(this).removeClass("m_category-a new-on").addClass("m_category-a");
            }
        })
    });
</script>

<?php $getadvImg = getadvImg(1081);
if($getadvImg['is_use']){
    ?>
    <div class="ad-banner">
        <a href="<?php echo $getadvImg['Href']?>">
            <img src="<?php echo $getadvImg['Img']?>" border="0">
        </a>
    </div>
<?php }
$getadvImg = getadvImg(1082);
if($getadvImg['is_use']){
    ?>
    <div class="ad-banner">
        <a href="<?php echo $getadvImg['Href']?>">
            <img src="<?php echo $getadvImg['Img']?>" border="0">
        </a>
    </div>
<?php } ?>


</article>

<script>
    function search_new(){
        var url = "<?php echo urlWap('goods','goods_list');?>";
        var key = $("#newkeyword").val();
        if(key){
            window.location.href = url + '&keyword=' + key;
        }else{
            alert('请输入搜索关键字');
        }
    }
</script>

<?php 

$array['P']['title'] = '收藏天下官方网站 中国收藏投资第一服务品牌';
$array['P']['imgUrl'] = 'http://m.96567.com/images/logo.png';
$array['Y']['title'] = '收藏天下官方网站 中国收藏投资第一服务品牌';
$array['Y']['desc'] = '买字画、邮币卡、文玩？上收藏天下！致力于大众正品收藏，中国收藏投资第一服务品牌！';
$array['Y']['imgUrl'] = 'http://m.96567.com/images/logo.png';

echo weixinShare($array);

?>