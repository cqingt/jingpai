<?php defined('InShopNC') or exit('Access Invalid!');?>

<script src="<?php echo LEPAI_CSS_URL;?>/js/koala.min.1.5.js" type="text/javascript" ></script>
<!--auction_top_img-->
<div class='auction_top_img'>
    <div id="fsD1" class="focus">
        <div id="D1pic1" class="fPic">
            <div class="fcon" style="display: block;"><?php echo loadadv(1074);?></div>
            <div class="fcon" style="display: none;"><?php echo loadadv(1075);?></div>
        </div>

        <div class="fbg">
            <div class="D1fBt" id="D1fBt">
                <a href="javascript:void(0)" hidefocus="true" target="_self" class=""><i>1</i></a>
                <a href="javascript:void(0)" hidefocus="true" target="_self" class=""><i>2</i></a>
            </div>
        </div>

        <div>
            <span class="prev"></span>
            <span class="next"></span>
        </div>
    </div>
    <script type="text/javascript">
        Qfast.add('widgets', {path: "<?php echo LEPAI_CSS_URL;?>/js/terminator2.2.min.js", type: "js", requires: ['fx']});
        Qfast(false, 'widgets', function () {
            K.tabs({
                id: 'fsD1',   //焦点图包裹id
                conId: "D1pic1",  //** 大图域包裹id
                tabId:"D1fBt",
                tabTn:"a",
                conCn: '.fcon', //** 大图域配置class
                auto: 1,   //自动播放 1或0
                effect: 'fade',   //效果配置
                eType: 'click', //** 鼠标事件
                pageBt:true,//是否有按钮切换页码
                bns: ['.prev', '.next'],//** 前后按钮配置class
                interval: 3000  //** 停顿时间
            })

        })

    </script>
</div>
<!--auction_top_img end-->
