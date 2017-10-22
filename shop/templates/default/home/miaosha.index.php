<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/new_miaosha.css" rel="stylesheet" type="text/css">
<script>
    $(function(){
        //--网络营销
        var NetworkFastNow=0;
        $('.Network').find('li:odd').css('background','#fff');
        if($('.NetworkFast').length>0){
            $('.NetworkFast').find('li').eq(NetworkFastNow).addClass('liNow');
            $(window).scroll(function(){
                $('.Network').find('li').each(function(i){
                    if($(window).scrollTop()>=$(this).offset().top-$(window).height()/2){
                        $('.NetworkFast').find('li').eq(NetworkFastNow).removeClass('liNow');
                        NetworkFastNow=i;
                        $('.NetworkFast').find('li').eq(NetworkFastNow).addClass('liNow');
                    }
                })
            })
        }
        $('.NetworkFast').find('.ewm').click(function(){
            $('.NetworkFast').animate({top:0}, 500);
            $('.NetworkFast').find('.ewmDiv').show();
        })
        $('.NetworkFast').find('.close').click(function(){
            $('.NetworkFast').animate({top:0}, 500);
            $('.NetworkFast').find('.ewmDiv').hide();
        })
        $('.NetworkFast').find('li').each(function(i){
            $(this).click(function(){
                $('html, body').animate({scrollTop:$('.Network').find('li').eq(i).offset().top-55}, 500);
                NetworkFastNow=i;
            })
            $(this).hover(
                function(){
                    $('.NetworkFast').find('li').eq(NetworkFastNow).removeClass('liNow');
                    $(this).addClass('liNow');
                },
                function(){
                    if(i!=NetworkFastNow){
                        $('.NetworkFast').find('li').eq(NetworkFastNow).addClass('liNow');
                        $(this).removeClass('liNow');
                    }
                }
            )
        })

    })
</script>

<!--秒杀开始-->
 

<div class="djh_ms_main"><div class="djh_ms_mainbox">


        <div class="NetworkFast" id="inner">
            <div class="djh_ms_menu">
                <?php foreach($output['miaosha_list'] as $day=>$classes){ ?>
                <p><?php echo ($day == 'today')?'今日秒杀':'明日预告';?></p>
                        <ul>
                    <?php foreach($classes as $key=>$val){ ?>
                        <li>
                            <?php if($day == 'today'){ ?>
                                <a href="###"><?php echo $output['miaosha_classes'][$key]['start_hour'];?>点档
                                    <?php if($output['hour'] >= $output['miaosha_classes'][$key]['start_hour'] && $output['hour'] < $output['miaosha_classes'][$key]['end_hour']){ ?>
                                        <span>正在秒杀</span>
                                    <?php }elseif($output['hour'] >= $output['miaosha_classes'][$key]['end_hour']){ ?>
                                        <span>已经结束</span>
                                    <?php }else{ ?>
                                        <span>即将开始</span>
                                    <?php } ?>
                                </a>
                            <?php }else{ ?>
                            <a href="###"><?php echo $output['miaosha_classes'][$key]['start_hour'];?>点档<span>抢先查看</span></a>
                            <?php } ?>

                            </li>
                    <?php } ?>
                        </ul>
                <?php } ?>

                <div class="warm-prompt">
                     <i class="icon-w-smile"></i>
                     <h4>温馨提示</h4>
                     <p>秒杀频道商品数量有限，请您在秒杀成功后及时付款，以免售罄；<span style="letter-spacing:-1px">订单生成后超过1小时未付款系统将自动取消。</span></p>
                </div>

            </div>

            <script type="text/javascript">
                var obj11 = document.getElementById("inner");
                var top11 = getTop(obj11);
                var isIE6 = /msie 6/i.test(navigator.userAgent);
                window.onscroll = function(){

                    var bodyScrollTop = document.documentElement.scrollTop || document.body.scrollTop;
                    if (bodyScrollTop > top11){
                        obj11.style.position = (isIE6) ? "absolute" : "fixed";
                        obj11.style.top = (isIE6) ? bodyScrollTop + "px" : "20px";
                    } else {
                        obj11.style.position = "static";
                    }
                }
                function getTop(e){

                    var offset = e.offsetTop;
                    if(e.offsetParent != null) offset += getTop(e.offsetParent);
                    return offset;
                }
            </script>

        </div>

        <?php foreach($output['miaosha_list'] as $day=>$classes){ ?>
            <div class="Network" id="<?php echo $day;?>">
                <ul>
                    <?php foreach($classes as $key=>$val){
                        $end = '3'; //未结束
                    if($day == 'today') {
                        if ($output['hour'] >= $output['miaosha_classes'][$key]['start_hour'] && $output['hour'] < $output['miaosha_classes'][$key]['end_hour']) {
                            $class_title = 'title01';
                            $titles = "秒杀ing…";
                            $end = '2';

                        } elseif ($output['hour'] >= $output['miaosha_classes'][$key]['end_hour']) {
                            $class_title = 'title02';
                            $titles = "秒杀已结束";
                            $end = '1';
                        } else {
                            $class_title = 'title02';
                            $titles = "即将开始…";
                            $end = '3';
                        }
                    }else{
                        $class_title = 'title02';
                        $titles = "抢先查看";
                        $end = '3';
                    }
                        $n_end = $end;
                        ?>
                    <li>
                        <div class="djh_ms_con">
                            <div class="djh_dang_box">
                                <p class="<?php echo $class_title;?>"><?php echo (($day == 'tomorrow')?'明日':'').$output['miaosha_classes'][$key]['start_hour'];?>点档 <?php echo $titles;?></p>
                                <?php foreach($val as $k=>$v){ ?>
                                    
                                <dl>


                        <?php
                            if($v['shengyukucun'] == 0){
                                $end = '1';
                            }else{
                                $end = $n_end;
                            }
                        ?>


    <?php if($n_end=='1'){ ?>
        <p class="chuo"></p>
    <?php }elseif($n_end=='2'){?>
        <?php if($v['shengyukucun'] == 0){?>
            <p class="chuo"></p>
        <?php }?>
    <?php }?>



                                    


                                    <dd>
									<?php if($v['is_shipping'] == 1 && $end !='1'){?>
									<div class="icon-by"></div>
									<?php } ?>
									<a href="<?php echo $v['goods_url'];?>" target="_blank"><img src="<?php echo $v['goods_image'];?>" alt="<?php echo $v['goods_name'];?>" width="240px" height="240px"/></a></dd>
                                    <dt>
									<div class="name"><a href="<?php echo $v['goods_url'];?>" target="_blank"><?php echo $v['goods_name'];?></a></div>
                                    <div>
                                        <?php if($end=='1'){ ?>
                                            <span class="time" id="leftTime<?php echo $v['miaosha_id'];?>">该秒杀已经结束</span>

                                        <?php }elseif($day == 'tomorrow'){ ?>
                                            <span class="time" id="leftTime<?php echo $v['miaosha_id'];?>">秒杀即将开始</span>
                                        <?php }else{ ?>
                                            <span class="time" id="leftTime<?php echo $v['miaosha_id'];?>">正在载入中...</span>
                                            <script type="text/javascript">
                                                <?php if($end=='2'){?>
                                                window.setInterval(function(){clock(<?php echo $v['end_time'];?>,<?php echo $v['miaosha_id'];?>,2);}, 1000);
                                                <?php }else{ ?>
                                                window.setInterval(function(){clock(<?php echo $v['start_time'];?>,<?php echo $v['miaosha_id'];?>,3);}, 1000);
                                                <?php } ?>
                                            </script>
                                        <?php } ?>
                                        </div>
                                    
                                    <div class="jiage">
                                        <div>
                                            <span class="one">秒杀价</span>
                                            <span class="two">参考价</span>
                                            <span class="two">立省</span>
                                        </div>
                                        <div>
                                            <span class="three">￥<?php echo intval($v['miaosha_price']);?></span>
                                            <span class="four" style="text-decoration:line-through;">￥<?php echo intval($v['goods_price']);?></span>
                                            <span class="four">￥<?php echo intval($v['goods_price'] - $v['miaosha_price']);?></span>
                                        </div>
                                    </div>
                                    <div class="<?php echo ($end=='2')?'but':'but_over';?>">
                                        <span class="sheng">仅剩：<?php echo ($end=='1')?'--':$v['shengyukucun'];?>件</span>
                                        <span class="ljms">
                                            <?php if($end=='1'){ ?>
                                                秒杀结束
                                            <?php }else{ ?>
                                            <a href="<?php echo $v['goods_url'];?>" target="_blank"><?php echo ($end=='2')?'立即秒杀':'即将开始';?></a>
                                            <?php } ?>
                                        </span>
                                    </div>
                                    </dt>
                                </dl>
                                <?php } ?>
                            </div>
                        </div>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        <?php } ?>

<script>
var daysms = 24 * 60 * 60;
var hoursms = 60 * 60;
var Secondms = 60;
function clock(time,key,t){
    var now_time = Date.parse(new Date()) / 1000;
    //alert(now_time);
    var Diffs = time -now_time;
    if(t == 2){
        var html = '距离结束：剩余';
    }else{
        var html = '距离开始：剩余';
    }

    var DifferHour = Math.floor(Diffs / hoursms);
    Diffs -= DifferHour*hoursms;
    var DifferMinute = Math.floor(Diffs / Secondms);
    Diffs -= DifferMinute*Secondms;

    if(DifferHour > 0){
        html += "<strong>"+DifferHour+"</strong>时";
    }
    if(DifferMinute > 0){
        html += "<strong>"+DifferMinute+"</strong>分";
    }
    html += "<strong>"+Diffs+"</strong>秒";
    document.getElementById("leftTime"+key).innerHTML =html;
}
</script>

    </div></div>