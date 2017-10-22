
<script type="text/javascript"> var NTKF_PARAM ={"siteid":"sc_1000" /*网站siteid*/,"settingid":"sc_1000_1476416019320" /*代码ID*/, "uid":"<?php echo $_SESSION['member_id'];?>" /*会员ID*/,"uname":"<?php echo $_SESSION['member_name'];?>"/*会员名*/,"userlevel": "<?php if($_SESSION['member_name']){ echo '1';}else{ echo '0'; }?>"/*会员等级*/}</script><script type="text/javascript" src="http://dl.ntalker.com/js/b2b/ntkfstat.js?siteid=sc_1000" charset="utf-8"></script>
<!--小能客户代码 end -->


<!--footerNav-blogs nav S -->
<div class="emptyBox"></div>
<footer class="footerNav-blogs">
    <div class="ui-row-flex">
        <div <?php if($_GET['op'] == 'index'){?>class="ui-col ui-col active" <?php }else{?>data-href="<?php echo urlWap('artist_blog','index',array('aid'=>$output['aid']))?>" class="ui-col ui-col"<?php }?>>
            <p>首页</p>
        </div>
        <div <?php if($_GET['op'] == 'jianjie'){?>class="ui-col ui-col active" <?php }else{?>data-href="<?php echo urlWap('artist_blog','jianjie',array('aid'=>$output['aid']))?>" class="ui-col ui-col"<?php }?>>
            <p>简介</p>
        </div>
        <div <?php if($_GET['op'] == 'zuoping'){?>class="ui-col ui-col active" <?php }else{?>data-href="<?php echo urlWap('artist_blog','zuoping',array('aid'=>$output['aid']))?>" class="ui-col ui-col"<?php }?>>
            <p>作品</p>
        </div>
        <div <?php if($_GET['op'] == 'xiangce'){?>class="ui-col ui-col active" <?php }else{?>data-href="<?php echo urlWap('artist_blog','xiangce',array('aid'=>$output['aid']))?>" class="ui-col ui-col"<?php }?>>
            <p>相册</p>
        </div>
        <div <?php if($_GET['op'] == 'zixun'){?>class="ui-col ui-col active" <?php }else{?>data-href="<?php echo urlWap('artist_blog','zixun',array('aid'=>$output['aid']))?>" class="ui-col ui-col"<?php }?>>
            <p>资讯</p>
        </div>
    </div>
</footer>
<!--footerNav-blogs nav E -->

<div style="display:none;">

    <!-- CNZZ -->
    <script>
        (function() {
            var hm = document.createElement("script");
            hm.src = "http://s22.cnzz.com/stat.php?id=4528288&web_id=4528288";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>
    <script>
        var _hmt = _hmt || [];
        (function() {
            var hm = document.createElement("script");
            hm.src = "//hm.baidu.com/hm.js?4990e66d06ee96054218c1b03d13daa7";
            var s = document.getElementsByTagName("script")[0];
            s.parentNode.insertBefore(hm, s);
        })();
    </script>

    <script  type="text/javascript">
        var _sogou_sa_q = _sogou_sa_q || [];
        _sogou_sa_q.push(['_sid', '318839-327313']);
        (function() {
            var _sogou_sa_protocol = (("https:" == document.location.protocol) ? "https://" : "http://");
            var _sogou_sa_src=_sogou_sa_protocol+"hermes.sogou.com/sa.js%3Fsid%3D318839-327313";
            document.write(unescape("%3Cscript src='" + _sogou_sa_src + "' type='text/javascript'%3E%3C/script%3E"));
        })();
    </script>
    <script type="text/javascript" src="http://s.union.360.cn/2780.js"></script>

</div>


<?php

$http = strtolower($_SERVER['HTTP_HOST']);
$act = strtolower($_GET['act']);
if($http == 'ads.82698.com' && $act == 'zhuanti'){

    $html = <<<BODY
    <div style="display:none;"><script type="text/javascript" src="http://mo.fx91.cn/api.aspx?api=aa&bhid=1"></script></div>
BODY;
    echo $html;

}


?>


<!--站点统计代码-->
<script type="text/javascript">

    <?php if($_GET['act'] == 'goods' && $_GET['op'] != 'goods_list'){ ?>
    _ozprm="id=<?php echo $output['goods']['goods_id']; ?>&cid=<?php echo $output['goods']['gc_id']; ?>&bid=<?php echo $output['goods']['brand_id']; ?>";
    <?php } ?>

    <?php if($_GET['act'] == 'goods' && $_GET['op'] == 'goods_list' && $_GET['keyword']){ ?>
    _ozprm="keyword=<?php echo $_GET['keyword']; ?>";
    <?php } ?>

    try{
        var _ozuid;
        var _user='<?php echo $_SESSION['member_name'];?>';//需传值，用户登陆后的用户id，如果没有登录传空值，即_user=’’;
        var _domain=document.domain.match(/\.[a-zA-Z0-9.-]+/);
        if($.cookie("ozuid") &&(_user==''|| null==_user)){  //cookie有值，但是用户尚未登录 ;那么取cookie值
            _ozuid=$.cookie("ozuid");
        }else if($.cookie("ozuid") &&(null!= _user)){ //cookie有值，但是用户已登录 ;那么更新cookie值，再取cookie值
            $.cookie("ozuid",_user,{path:"/",expires:365,domain:_domain});
            _ozuid=$.cookie("ozuid");
        }else if(!$.cookie("ozuid") &&(_user==''|| null==_user)){//cookie无值，用户也未登录，不能记录会员行为
            //无动作
        }else if(!$.cookie("ozuid") &&(null!= _user)){
            $.cookie("ozuid",_user,{path:"/",expires:365,domain:_domain}); //cookie无值，但是用户已登录 ;那么存储cookie值，再取cookie值
            _ozuid=$.cookie("ozuid");
        }
    }catch(e){
    }

</script>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/mo_code.js"></script>
<script>
    <?php if($_GET['act'] == 'goods' && $_GET['op'] == 'goods_list' && $_GET['keyword'] == ''){ ?>
    var tprm="cate_id=<?php echo $_GET['cate_id'];?>&b_id=<?php echo $_GET['b_id'];?>&a_id=<?php echo $_GET['a_id'];?>&key=<?php echo $_GET['key'];?>&order=<?php echo $_GET['order'];?>&type=<?php echo $_GET['type'];?>&gift=<?php echo $_GET['gift'];?>&area_id=<?php echo $_GET['area_id'];?>&curpage=<?php echo $_GET['curpage'];?>";
    __ozfac2(tprm,"#categoryPage");
    setTimeout("",300);
    <?php } ?>
    <?php if($output["buy_step"] == 'step3' || $output['buy_step'] == 'step4'){ ?>
    <?php if (count($output['order_list'])>0) {
    foreach($output['order_list'] as $key => $order) {
    if($order['extend_order_goods']){
    foreach($order['extend_order_goods'] as $ogkey=>$ogval){
    ?>
    var skulist = '';
    skulist += "<?php echo $ogval['goods_id'];?>,<?php echo $ogval['goods_price'];?>,<?php echo $ogval['goods_num'];?>,,,,,,,;";
    <?php
    }
    }
    ?>
    var tprm="orderid=<?php echo $order['order_sn'];?>&orderTotal=<?php echo $order['order_amount'];?>&storeid=<?php echo $order['store_id'];?>&skulist="+skulist;
    __ozfac2(tprm,"#orderPage");
    setTimeout("",300);
    <?php
    }
    }
    ?>
    <?php } ?>
</script>
</body>

</html>