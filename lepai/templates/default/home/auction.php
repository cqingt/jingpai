<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo LEPAI_CSS_URL;?>/css/auction.css" rel="stylesheet" type="text/css">
<link href="<?php echo LEPAI_CSS_URL;?>/css/pmcss.css" rel="stylesheet" type="text/css" />
<link href="<?php echo LEPAI_CSS_URL;?>/css/article.css" rel="stylesheet" type="text/css">
<script src="<?php echo LEPAI_CSS_URL;?>/js/lepai_clock.js" type="text/javascript"></script>

<div class='auction_center'>
    <!--当前位置
    <div style="overflow:hidden;margin-bottom:20px;">
        <p class='auction_center_p'>当前位置：
            <a href="#">今日热拍&gt;</a>
            <a href="#">鼻烟壶</a>
        </p>
        <a class='auction_center_a' href="#">进入该拍品专场>>></a>
    </div>
    -->
    <!--当前位置 end-->
    <div class='auction_center_left'>
        <div class='auction_center_left_top'>
            <div class='auction_center_left_top_left'>
                <div id=preview>
                    <div class=jqzoom id=spec-n1>
                        <IMG height=350 src="<?php echo BASE_SITE_URL.$output['goods']['G_MainImg'];?>" width=350>
                    </div>
                    <div id=spec-n5>
                        <div class=control id=spec-left>
                            <img src="<?php echo LEPAI_CSS_URL;?>/images/left.gif" />
                        </div>
                        <div id=spec-list>
                            <ul class=list-h>
                                <?php if(!empty($output['goods']['imgs'])){ ?>
                                    <?php foreach($output['goods']['imgs'] as $k=>$imgs){?>
                                        <li><a href="javascript:void(0)">
                                                <img src="<?php echo BASE_SITE_URL.$imgs['IM_Img'];?>" alt="<?php echo BASE_SITE_URL.$output['goods']['G_Name'];?>" jqimg="<?php echo BASE_SITE_URL.$imgs['IM_Img'];?>" onload="DrawImage(this,50,50);" /></a>
                                        </li>
                                    <?php } ?>
                                <?php }else{ ?>
                                    <li><a href="javascript:void(0)">
                                            <img src="<?php echo BASE_SITE_URL.$output['goods']['G_MainImg'];?>" alt="<?php echo BASE_SITE_URL.$output['goods']['G_Name'];?>" jqimg="<?php echo BASE_SITE_URL.$output['goods']['G_MainImg'];?>" onload="DrawImage(this,50,50);" /></a>
                                    </li>
                                <?php } ?>
                            </ul>
                        </div>
                        <div class=control id=spec-right>
                            <img src="<?php echo LEPAI_CSS_URL;?>/images/right.gif" />
                        </div>
                    </div>
                </div>
                <script src="<?php echo LEPAI_CSS_URL;?>/js/lib_20110119zzjs_net.js" type="text/javascript"></script>
                <script type="text/javascript" src="<?php echo LEPAI_CSS_URL;?>/js/Magnifier-min.js"></script>

            </div>
            <div class='auction_center_left_top_right'>
                <?php if($output['status'] == 1){?>
                    <!-- 即将开始 -->
                    <div class='auction_center_left_top_right1'>
                        <strong><?php echo $output['goods']['G_Name'];?></strong>
                        <p class='auction_center_left_top_right1_p2'>
                            <span class="first-child">即将开始</span>
                            <span class="leftTime" count_down="<?php echo $output['goods']['T_Ktime'] - TIMESTAMP;?>" timestatus="1">正在载入中...</span>
                            <!--<a href="#" target="_blank" style="float: right;margin-right: 95px;font-family: '微软雅黑';color: #666;">了解拍卖惠规则</a>-->
                        </p>
                    </div>
                    <div class='auction_center_left_top_right2'>
                        <abbr>
                            <p>起始价<span>￥<?php echo intval($output['goods']['G_Qipai']);?></span></p>
                        </abbr>
                        <?php if($output['baoming_status']){ ?>
                            <p class="auction_center_left_top_right2_p">您已报名参加，请等待开始。</p>
                            <p class="auction_center_left_top_right2_p">没时间一直跟进出价，怕被别人拍走了？ 赶快用 <span class="auction_center_left_top_right2_p_span">委托出价</span> 吧</p>
                        <?php }else{ ?>
                            <ul class='auction_center_left_top_right2_ul'>
                                <?php if(intval($output['goods']['G_BaoZhenMoney']) > 0){?>
                                <span>缴纳保证金</span>
                                <li onclick="margin_type(1);" id="margin_xianjin" class='auction_center_left_top_right2_ul_active'><?php echo intval($output['goods']['G_BaoZhenMoney']);?>元现金</li>
                                <li onclick="margin_type(2);" id="margin_scb"><?php echo intval($output['goods']['G_BaoZhenMoney']*100);?>收藏币</li>
                                <?php } ?>
                                <input name="margintype" id="margintype" type="hidden" value="1" />
                            </ul>
                            <button class='auction_center_left_top_right2_button' id="bid" onclick="return checkform()"><img src="<?php echo LEPAI_CSS_URL;?>/images/anction_btn2.jpg" /><?php echo (intval($output['goods']['G_BaoZhenMoney']) > 0)?'报名缴纳保证金':'报名参拍'?></button>
                        <?php } ?>

                    </div>
                <?php }elseif($output['status'] == 2){ ?>
                    <!-- 正在进行 -->
                    <div class='auction_center_left_top_right1'>
                        <strong><?php echo $output['goods']['G_Name'];?></strong>
                        <p class='auction_center_left_top_right1_p1'>
                            <span class="first-child">正在进行</span>
                            <span class="leftTime" count_down="<?php echo $output['goods']['G_EndTime'] - TIMESTAMP;?>" timestatus="2">正在载入中...</span>
                            <!-- <a href="#" target="_blank" style="float: right;margin-right: 95px;font-family: '微软雅黑';color: #666;">了解拍卖惠规则</a>-->
                        </p>
                    </div>
                    <div class='auction_center_left_top_right2'>
                        <abbr>
                            <p>当前价<span>￥<?php echo intval($output['now_price']);?></span></p>
                        </abbr>
                        <?php if($output['baoming_status']){ ?>
                            <p class="auction_center_left_top_right2_p">没时间一直跟进出价，怕被别人拍走了？ 赶快用 <span class="auction_center_left_top_right2_p_span">委托出价</span> 吧</p>
                            <div class='auction_center_left_top_right2_box'>
                                <a onclick="setAmount.reduce('#price');">-</a>
                                <input type="text" id="price" name="price" value="<?php echo intval($output['now_price']+$output['goods']['G_IncMoney']);?>">
                                <a onclick="setAmount.add('#price');">+</a>
                                <button onclick="return postform()" id="bid">立即出价</button>
                            </div>
                        <?php }else{ ?>
                            <ul class='auction_center_left_top_right2_ul'>
                                <?php if(intval($output['goods']['G_BaoZhenMoney']) == 0){ ?>
                                <?php }else{ ?>
                                <span>缴纳保证金</span>
                                <li onclick="margin_type(1);" id="margin_xianjin" class='auction_center_left_top_right2_ul_active'><?php echo intval($output['goods']['G_BaoZhenMoney']);?>元现金</li>
                                <li onclick="margin_type(2);" id="margin_scb"><?php echo intval($output['goods']['G_BaoZhenMoney']*100);?>收藏币</li>
                                <?php } ?>
                                <input name="margintype" id="margintype" type="hidden" value="1" />
                            </ul>
                            <button class='auction_center_left_top_right2_button' id="bid" onclick="return checkform()"><img src="<?php echo LEPAI_CSS_URL;?>/images/anction_btn2.jpg"  /><?php echo (intval($output['goods']['G_BaoZhenMoney']) > 0)?'报名缴纳保证金':'报名参拍'?></button>
                        <?php } ?>

                    </div>
                <?php }else{ ?>
                    <!-- 已结束 -->
                    <div class='auction_center_left_top_right1'>
                        <strong><?php echo $output['goods']['G_Name'];?></strong>
                        <p class='auction_center_left_top_right1_p1'>
                            <span style="float:left;margin-right:10px;"><img src="<?php echo LEPAI_CSS_URL;?>/images/auction_over.jpg" alt=""></span>
                            <span>结束时间<?php echo date('m月d日 H:i',$output['goods']['G_EndTime']);?></span>
                            <!--<a href="#" target="_blank" style="float: right;margin-right: 95px;font-family: '微软雅黑';color: #666;">了解拍卖惠规则</a>-->
                        </p>
                    </div>
                    <div class='auction_center_left_top_right2'>
                        <?php if($output['pai_status']['status'] == 2){ ?>
                            <abbr><p>当前价<span style="margin-left: 0px;">￥<?php echo intval($output['pai_status']['price']); ?> </span></p></abbr>
                            <p style="font-size:36px;color:#999;display:block;margin:20px 0;">该拍卖活动已结束 流拍</p>
                        <?php }else{ ?>
                            <abbr><p>成功拍卖惠价<span style="margin-left: 0px;">￥<?php echo intval($output['pai_status']['price']); ?> </span></p></abbr>
                            <p style="font-size:36px;color:#999;display:block;margin:20px 0;">该拍卖活动已结束</p>
                            <p style="font-size:24px;color:#d48123;">恭喜 <i style="font-size:24px;color:#d48123;"><?php echo mb_substr($output['pai_status']['member_name'],0,2,'utf-8').'***';?></i> 竞拍成功</p>
                        <?php } ?>
                    </div>

                <?php } ?>
                <div class='auction_center_left_top_right3'>
                    <ul>
                        <li>
                            <p><span><?php echo intval($output['goods']['baoming']);?>人报名</span><span><?php echo intval($output['goods']['G_Click']);?>人想拍</span></p>
                        </li>
                        <li>
                            <p style="width: 18%;"><span>起拍价</span>￥<?php echo intval($output['goods']['G_Qipai']);?></p>
                            <p style="width: 18%;"><span>加价幅度</span>￥<?php echo intval($output['goods']['G_IncMoney']);?></p>
                            <p style="width: 45%;"><span>保证金</span><?php echo ($output['goods']['G_BaoZhenMoney'] == 0)?'无':('￥'.intval($output['goods']['G_BaoZhenMoney']).'/'.intval($output['goods']['G_BaoZhenMoney']*100).'收藏币');?></p>
                            <p style="width: 18%;"><span>保留价</span><?php echo ($output['goods']['G_BaoliuMoney'] >0)?'有':'无';?></p>
                        </li>
                    </ul>
                </div>
                <div class="auction_center_left_top_right_entrustc hide" style="top: 430px; display: none;">
                    <img class="auction_center_left_top_right_entrustc_img" src="<?php echo LEPAI_CSS_URL;?>/images/btn.jpg" alt="">
                    <div class="auction_center_left_top_right_entrust">
                        <div class="auction_center_left_top_right_entrust_p">
                            <?php if(!empty($output['weituoInfo'])){ ?>
                                <span class="wt_time">您已委托出价，委托时间：<?php echo date('m月d日 H:i',$output['weituoInfo']['add_time']);?></span><Br />
                                <span class="revised">修改出价</span>
                                <span class="client_prices" contenteditable="true" id="client_prices"><?php echo intval($output['weituoInfo']['weituo_price']);?></span>
                                <button onclick="client(0);" id="clients">立即委托</button>
                                <i><a>?</a>此处填写您可接受的本拍品的最高价格；</i>
                            <?php }else{ ?>
                                <span class="revised">我的出价</span>
                                <span class="client_prices" contenteditable="true" id="client_prices"><?php echo intval($output['weituoInfo']['weituo_price']);?></span>
                                <button onclick="client(0);" id="clients">立即委托</button>
                                <i><a>?</a>此处填写您可接受的本拍品的最高价格；</i>
                            <?php } ?>

                        </div>
                        <abbr>
                            <strong>什么是委托出价：</strong>
                            <p>拍卖惠预展时您通过报名之后就可以选择委托出价，输入自己可接受的最高出价金额，由系统代理出价。</p>
                            <p>1、当您设置未开始产品自动出价后，系统将在竞价开始时按 起始价+最低出价 自动为您做第一次出价；如其它客户的跟价超过您时，系统将再次以 当前价+最低出价 继续为您出价；如果 当前价+最低出价 高于您设置的委托出价，则停止拍卖出价；</p>
                            <p>2、当您设置已开始产品自动出价后，系统将以 当前价+最低出价 自动为您做第一次出价；如其它客户的跟价超过您时，系统将再次以 当前价+最低出价 继续为您出价；如果 当前价+最低出价 高于您设置的委托出价，则停止拍卖出价；</p>
                            <p><span>注：如果您的委托出价已停止但未竞价成功，我们将及时短信告知，您可以再次手动进行出价；</span></p>
                        </abbr>
                    </div>
                </div>
            </div>
        </div>
        <div class='auction_center_left_down'>
            <div class='auction_center_left_down_process' style="margin-bottom: 20px">
                <p>竞拍流程</p>
                <img src="<?php echo LEPAI_CSS_URL;?>/images/anction_main_process.jpg" alt="竞拍流程" />
                <p><img src="<?php echo LEPAI_CSS_URL;?>/images/lepai_notice.jpg" alt="竞拍流程" /></p>
            </div>
            <div class="wjsh_box"><?php echo htmlspecialchars_decode($output['goods']['G_Content']);?></div>
        </div>
    </div>
    <div class='auction_center_right'>
        <div class='auction_center_right_top'>
            <strong>出价记录<span>（<?php echo $output['goods']['pai_count'];?>）</span></strong>
            <span id='chujiajile'></span>
<!--
            <img class='auction_center_right_top_img' src="<?php echo LEPAI_CSS_URL;?>/images/anction_btn6.jpg" alt="" />
            <a class='auction_center_right_top_a' href="#">分享给好友</a>-->
        </div>
        <div class='auction_center_right_down'>
            <div class='auction_center_right_down_title'>
                <p>热门拍品</p>
            </div>
            <ul>
                <?php if(is_array($output['remen']) && !empty($output['remen'])){?>
                    <?php foreach($output['remen'] as $k=>$v){ ?>
                        <li><a target="_blank" href="<?php echo urlLepai('index','auction',array('id'=>$v['G_Id']));?>">
                                <img src="<?php echo BASE_SITE_URL.$v['G_MainImg'];?>" width="89" height="89" alt="<?php echo $v['G_Name'];?>"/>
                                <p class='auction_center_right_down_p1'><?php echo $v['G_Name'];?></p>
                                <p class='auction_center_right_down_p2'>当前价：<span>￥<?php echo $v['new_price'];?></span></p>
                                <p class='auction_center_right_down_p3'><?php if($v['pai_count'] >0){?><img src="<?php echo LEPAI_CSS_URL;?>/images/anction_main1_left_btn.jpg" alt="" /><?php echo $v['pai_count'].'次出价';}else{ ?><?php echo $v['G_Click'].'人关注';}?></p>
                            </a>
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </div>
    </div>
</div>
<script type="text/javascript">
    var LEPAI_SITE_URL = '<?php echo BASE_SITE_URL;?>/lepai';
    $(function(){
        $(".auction_center_left_top_right2_p_span").mouseover(function(){
            $('.auction_center_left_top_right_entrustc').show();
        })

        $('.auction_center_left_top_right_entrustc').mouseover(function(){
            $('.auction_center_left_top_right_entrustc').show();
        })

        $('.auction_center_left_top_right_entrustc').mouseout(function(){
            $('.auction_center_left_top_right_entrustc').hide();
        })
        $('.auction_center_left_top_right2_p_span').mouseout(function(){
            $('.auction_center_left_top_right_entrustc').hide();
        })
    })
</script>
<script type="text/javascript">
    $(function(){

        $("#spec-list").jdMarquee({
            deriction:"left",
            width:313,
            height:56,
            step:2,
            speed:4,
            delay:10,
            control:true,
            _front:"#spec-right",
            _back:"#spec-left"
        });
        $("#spec-list img").bind("mouseover",function(){
            var src=$(this).attr("src");
            var srcs=$(this).attr("jqimg");
            $("#spec-n1 img").eq(0).attr({
                src:src.replace("\/n5\/","\/n1\/"),
                bigsrc:srcs.replace("\/n5\/","\/n0\/")
            });
            $(this).css({
                "border":"2px solid #ff6600",
                "padding":"1px"
            });
        }).bind("mouseout",function(){
            $(this).css({
                "border":"1px solid #ccc",
                "padding":"2px"
            });
        });


    });

    function chujiajilu(pagenum){
        $.get(LEPAI_SITE_URL+"/index.php?act=index&op=ajaxChuJiaLog&id=<?php echo $output['goods']['G_Id'];?>&pagenum="+pagenum,function(result){
            $("#chujiajile").html(result);
        });
    }
    chujiajilu(1);
    function checkform(){
        document.getElementById("bid").disabled = true;
        $.post(LEPAI_SITE_URL+"/index.php?act=index&op=ajaxbaoming",{"id":<?php echo $output['goods']['G_Id'];?>,"type": $('#margintype').val()},function(result){
            if(result==-1){
                document.getElementById("bid").disabled = false;
                login_dialog();
                return false;
            }
            if(result==-2){
                alert("系统错误，请联系网站客服！");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==1){
                alert("该拍卖不存在");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==2){
                alert("您已经缴纳过了");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==3){
                alert("该拍卖活动已经结束");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==4){
                if(confirm("您的余额不足以缴纳保证金，点击“确定”将立即跳转到充值界面")==true){location.href="<?php echo urlShop('predeposit','recharge_add');?>"};
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==6){
                alert("您的收藏币不足以缴纳保证金，请返回页面选择现金支付");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==5){
                alert("您已经成功缴纳保证金");
                location.href=location.href;
                return false;
            }
            if(result==8){
                alert("您已经成功报名");
                location.href=location.href;
                return false;
            }
            if(result==7){
                alert("您已经报名过了");
                location.href=location.href;
                return false;
            }
        });
        return false;
    }
    function postform(){
        document.getElementById("bid").disabled = true;
        $.post(LEPAI_SITE_URL+"/index.php?act=index&op=ajaxchujia",{"id":<?php echo $output['goods']['G_Id'];?>,"price": $('#price').val()},function(result){
            if(result==-1){
                document.getElementById("bid").disabled = false;
                login_dialog();
                return false;
            }
            if(result==-2){
                alert("系统错误，请联系网站客服！");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==1){
                alert("该拍卖不存在");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==5){
                alert("该拍卖活动不再有效时间内");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==2){
                alert("请输入正确的价格");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==3){
                alert("您的出价不能低于当前最低出价");
                location.href=location.href;
                return false;
            }
            if(result==4){
                alert("您已经是这个商品的最高出价人了，请等待活动结束或其它竞拍者出价！");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==7){
                alert("您已出价成功，请不要重复提交");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==0){
                alert("成功出价");
                location.href=location.href;
                return false;
            }

        })
        return false;

    }

    function client(client_id){
        document.getElementById("clients").disabled = true;
        var client_prices = document.getElementById("client_prices").innerHTML;
        $.post(LEPAI_SITE_URL+"/index.php?act=index&op=ajaxweituo",{"client_prices":client_prices,"id":<?php echo $output['goods']['G_Id'];?>},function(result){
            if(result==-1){
                document.getElementById("clients").disabled = false;
                login_dialog();
                return false;
            }
            if(result==-3){
                alert("该拍卖活动已经结束");
                document.getElementById("clients").disabled = false;
                return false;
            }
            if(result==1){
                alert("该拍卖不存在");
                document.getElementById("clients").disabled = false;
                return false;
            }
            if(result==-2){
                alert("系统错误，请联系网站客服！");
                document.getElementById("clients").disabled = false;
                return false;
            }
            if(result==2){
                alert("您的委托价不能小于下一次出价的价格"+parseInt(parseInt(<?php echo intval($output['now_price']);?>)+parseInt(<?php echo intval($output['goods']['G_IncMoney']);?>)));
                document.getElementById("clients").disabled = false;
                return false;
            }

            if(result==3){
                alert("对不起，只能委托出价一次");
                document.getElementById("clients").disabled = false;
                return false;
            }
            if(result==4){
                alert("对不起，修改的委托价格不能小于上一次委托的价格");
                document.getElementById("clients").disabled = false;
                return false;
            }
            if(result==5){
                alert("该拍卖活动不再有效时间内");
                document.getElementById("bid").disabled = false;
                return false;
            }
            if(result==0){
                alert("委托成功");
                location.href=location.href;
                return false;
            }
        })
        return false;
    }

    function margin_type(type){
        if(type == 1){
            $("#margin_xianjin").addClass('auction_center_left_top_right2_ul_active');
            $("#margin_scb").removeClass('auction_center_left_top_right2_ul_active');
            document.getElementById("margintype").value = 1;
        }
        if(type == 2){
            $("#margin_xianjin").removeClass('auction_center_left_top_right2_ul_active');
            $("#margin_scb").addClass('auction_center_left_top_right2_ul_active');
            document.getElementById("margintype").value = 2;
        }
    }

    var setAmount={
        min:parseInt(<?php echo intval($output['now_price']);?>)+parseInt(<?php echo intval($output['goods']['G_IncMoney']);?>),
        max:9999,
        reg:function(x){
            return new RegExp("^[1-9]\\d*$").test(x);
        },
        amount:function(obj,mode){
            var x=$(obj).val();
            if (this.reg(x)){
                if (mode){
                    x=parseInt(x)+parseInt(<?php echo intval($output['goods']['G_IncMoney']);?>);
                }else{
                    x=parseInt(x)-parseInt(<?php echo intval($output['goods']['G_IncMoney']);?>);
                }
            }else{
                alert("请输入正确的价格！");
                $(obj).val(this.min);
                $(obj).focus();
            }
            return x;
        },
        reduce:function(obj){
            var x=this.amount(obj,false);
            if (x>=this.min){
                $(obj).val(x);
            }else{
                alert("拍品价格不得低于"+this.min);
                $(obj).val(this.min);
                $(obj).focus();
            }
        },
        add:function(obj){
            var x=this.amount(obj,true);
            $(obj).val(x);

        },
        modify:function(obj){
            var x=$(obj).val();
            if (x<this.min||x>this.max||!this.reg(x)){
                alert("请输入正确的价格！");
                $(obj).val(this.min);
                $(obj).focus();
            }
        }
    }
</script>