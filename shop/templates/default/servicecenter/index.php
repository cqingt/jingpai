<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>服务中心</title>
</head>
<body>
<div class="lunbotu">
    <ul class="lunbotu_box">
        <!--<?php print_r($output['code_screen_list']['code_info']);?>-->
        <?php foreach ($output['code_screen_list']['code_info'] as $key => $val) { ?>
        <li><a href="<?php echo $val['pic_url']?>" target="_blank" style="background:url(<?php echo UPLOAD_SITE_URL.'/'.$val['pic_img']?>) center top no-repeat" title="<?php echo $val['pic_name']?>"></a></li>
        <?php }?>
    </ul>
</div>
<script type="text/javascript">
    $(function () {
        $(".lunbotu").lunbotu({});
    })
</script>

<div class="serve-title wrapper"><strong>常用自助服务</strong></div>
<div class="normal-service wrapper">
    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-支付方式.html" target="_blank">
        <i class="icon-normal1"></i>
        <span>
			<h2>支付方式</h2>
			<p>快速查看支付方式、发票索取等</p>
		</span>
    </a>
    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-退换货政策.html" target="_blank">
        <i class="icon-normal2"></i>
        <span>
			<h2>退换货政策</h2>
			<p>查看退换货条件及详细说明</p>
		</span>
    </a>
    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-退换货流程.html" target="_blank">
        <i class="icon-normal3"></i>
        <span>
			<h2>退换货流程</h2>
			<p>查看退换货流程及进度</p>
		</span>
    </a>
    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-账户安全.html" target="_blank">
        <i class="icon-normal4"></i>
        <span>
			<h2>账户安全</h2>
			<p>账户设置提高账户安全</p>
		</span>
    </a>
    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-配送方式.html" target="_blank">
        <i class="icon-normal5"></i>
        <span>
			<h2>配送方式</h2>
			<p>配送方式及说明</p>
		</span>
    </a>
    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-商家服务.html" target="_blank">
        <i class="icon-normal6"></i>
        <span>
			<h2>商家服务</h2>
			<p>商家入驻及艺术家加盟条件、流程</p>
		</span>
    </a>
    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-关于我们.html" target="_blank">
        <i class="icon-normal7"></i>
        <span>
			<h2>关于我们</h2>
			<p>快速查看公司详细介绍</p>
		</span>
    </a>
    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-企业大事记.html" target="_blank">
        <i class="icon-normal8"></i>
        <span>
			<h2>企业大事记</h2>
			<p>阅读公司重大事件</p>
		</span>
    </a>
</div>

<div class="serve-title wrapper"><strong>热点问题</strong></div>
<div class="serve-hot-issues wrapper">
    <ul class="hot-issues-nav investment_title">
        <?php foreach($output['hot_question'] as $key => $val){?>
            <li <?php if($key==0){?>class="on" <?php }?>><?php echo $val['article_title']?></li>
        <?php }?>
    </ul>
    <div class="hot-issues-con investment_con">
        <?php foreach($output['hot_question'] as $key => $val){?>
        <div class="demo">
            <ul>
                <?php foreach($val['article_content'] as $k=>$v){?>
                <li>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_id-<?php echo $val['article_id'];?>.html#dom_<?php echo $k?>" target="_blank">
                        <?php echo $v;?>
                    </a>
                </li>
                <?php }?>
            </ul>
        </div>
        <?php }?>
    </div>
</div>

<div class="serve-title wrapper"><strong>关于我们</strong></div>
<div class="serve-about wrapper">
    <?php foreach($output['about_us'] as $key => $val){?>
    <div class="items">
        <h2><?php echo $val['article_title'];?></h2>
        <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_id-<?php echo $val['article_id']?>.html" target="_blank">
            <span class="img"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/servicecenter/about<?php echo ($key+1);?>.jpg"/></span>
            <div class="txt">
                <?php echo $val['article_content']?>
            </div>
            <strong>查看详情</strong>
        </a>
    </div>
    <?php }?>
</div>

<div class="serve-desc">
    <div class="wrapper">
        <div class="ui-global-fragment">
            <dl class="ensure">
                <dt>
					<span>
						<i class="icon-fragment1"></i>
						<p>购物指南</p>
					</span>
                </dt>
                <dd>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-注册会员.html" target="_blank">注册会员</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-会员修改资料.html" target="_blank">会员修改资料</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-修改收货地址.html" target="_blank">修改收货地址</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-会员制度.html" target="_blank">会员制度</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-账户安全.html" target="_blank">账户安全</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-积分规则.html" target="_blank">积分规则</a>
                </dd>
            </dl>
            <dl class="ensure">
                <dt>
					<span>
						<i class="icon-fragment2"></i>
						<p>支付方式</p>
					</span>
                </dt>
                <dd>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-在线支付.html" target="_blank">在线支付</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-银行汇款.html" target="_blank">银行汇款</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-余额支付.html" target="_blank">余额支付</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-货到付款.html" target="_blank">货到付款</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-发票索取.html" target="_blank">发票索取</a>
                </dd>
            </dl>
            <dl class="ensure">
                <dt>
					<span>
						<i class="icon-fragment3"></i>
						<p>售后服务</p>
					</span>
                </dt>
                <dd>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-退换货政策.html" target="_blank">退换货政策</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-退换货流程.html" target="_blank">退换货流程</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-商家服务.html" target="_blank">商家服务</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-正品保证.html" target="_blank">正品保证</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-服务承诺.html" target="_blank">服务承诺</a>
                </dd>
            </dl>
            <dl class="ensure">
                <dt>
					<span>
						<i class="icon-fragment4"></i>
						<p>企业介绍</p>
					</span>
                </dt>
                <dd>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-关于我们.html" target="_blank">关于我们</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-企业大事记.html" target="_blank">企业大事记</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-公司人才.html" target="_blank">公司人才</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-招聘英才.html" target="_blank">招聘英才</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-合作及洽谈.html" target="_blank">合作及洽谈</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-联系我们.html" target="_blank">联系我们</a>
                </dd>
            </dl>
            <dl class="ensure">
                <dt>
					<span>
						<i class="icon-fragment5"></i>
						<p>配送方式</p>
					</span>
                </dt>
                <dd>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-特快专递.html" target="_blank">特快专递</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-上门自提.html" target="_blank">上门自提</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-收藏自送.html" target="_blank">收藏自送</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-货到付款.html" target="_blank">货到付款</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-商品签收.html" target="_blank">商品签收</a>
                </dd>
            </dl>
            <dl class="ensure">
                <dt>
					<span>
						<i class="icon-fragment6"></i>
						<p>特色服务</p>
					</span>
                </dt>
                <dd>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-限时秒杀.html" target="_blank">限时秒杀</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-会员俱乐部.html" target="_blank">会员俱乐部</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-藏品惠.html" target="_blank">藏品惠</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-拍卖惠.html" target="_blank">拍卖惠</a>
                    <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_title-推荐有礼.html" target="_blank">推荐有礼</a>
<!--                    <a href="--><?php //echo BASE_SITE_URL;?><!--/servercenter-article_title-收藏圈子.html" target="_blank">收藏圈子</a>-->
<!--                    <a href="--><?php //echo BASE_SITE_URL;?><!--/servercenter-article_title-收藏问答.html" target="_blank">收藏问答</a>-->
                </dd>
            </dl>
        </div>
    </div>
</div>

<div class="customer-service">
    <div class="wrapper">
        <div class="csbox">
            <i class="icon-cs1"></i>
            <span>
				<h2>电话客服</h2>
				<p>每天  9:00 - 18:00  为您服务</p>
			</span>
            <div class="boxhover">
                <div><strong>400-81-96567</strong></i></div>
            </div>
        </div>
        <div class="csbox" href="" target="_blank">
            <i class="icon-cs2"></i>
            <span>
				<h2>在线客服</h2>
				<p>每天  9:00 - 18:00  为您服务</p>
			</span>
            <div class="boxhover">
                <div class="two"><a href="javascript:void(0)" onclick="NTKF.im_openInPageChat('sc_1000_9999')">立即咨询</a></div>
            </div>
        </div>
        <div class="csbox">
            <i class="icon-cs3"></i>
            <span>
				<h2>微信客服</h2>
				<p>每天  9:00 - 18:00  为您服务</p>
			</span>
            <div class="boxhover">
                <div class="three"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/servicecenter/serve-wechat.jpg"/></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>