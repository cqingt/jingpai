<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <title>服务中心</title>
</head>
<body>

<div class="inside-banner"
     style="background: url(<?php echo SHOP_TEMPLATES_URL; ?>/images/servicecenter/inside-banner.jpg);"></div>

<div class="pages-content wrapper">
    <div class="side-left">
        <div id="sidebar" class="side-navigation">
            <!--icon-sn1（购物指南）,icon-sn2（企业介绍）,icon-sn3（售后服务）,icon-sn4（特色服务），icon-sn5（客服中心）-->
            <h2><i class="icon-sn1"></i><strong><?php echo $output['data'][0]['ac_name']; ?></strong></h2>
            <ul>
                <?php foreach ( $output['data'] as $key => $val ) { ?>
                    <li <?php if ( isset( $val['article_content'] ) && $val['article_content'] == 1 ){ ?>class="active"<?php } ?>>
                        <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_id-<?php echo $val['article_id'] ?>.html">
                            <?php echo $val['article_title']; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="side-right">
        <div class="crumbs">
            <a href="<?php echo BASE_SITE_URL;?>/servercenter.html">首页</a>
            <i class="path-split">></i>
            <a href="<?php echo BASE_SITE_URL;?>/servercenter-ac_id-<?php echo $output['data'][0]['ac_id']; ?>.html">
                <?php echo $output['data'][0]['ac_name'] ?>
            </a>
            <i class="path-split">></i>
            <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_id-<?php echo $output['article']['article_id'] ?>.html">
                <?php echo $output['article']['article_title'] ?>
            </a>
        </div>

        <?php if ( $output['article']['article_title'] == '企业大事记' ) { ?>
            <div class="ui-content">
                <div class="ui-fusion">
                    <ul>
                        <?php foreach ( $output['article']['article_content'] as $key => $val ) { ?>
                            <li>
                                <h2><?php if($val['day']!=''){echo $val['month'] . '.' . $val['day'];}else{echo $val['month'];} ?><sup><?php echo $val['year'] ?></sup>
                                </h2>

                                <?php if(!empty($val['title'])){?>
                                <h4><?php echo $val['title'] ?></h4>
                                <?php }?>

                                <?php if(!empty($val['content'])){?>
                                <p><?php echo $val['content'] ?></p>
                                <?php }?>

                                <?php if(!empty($val['img'])){?>
                                <div class="photo">
                                    <?php foreach ( $val['img'] as $v ) { ?>
                                        <span><img src="<?php echo $v ?>"/></span>
                                    <?php } ?>
                                </div>
                                <?php }?>

                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        <?php }elseif($output['data'][0]['ac_name'] == '热点问题'){?>
            <div class="ui-content">
                <!--常见问题 S-->
                <ul class="qa">
                    <?php foreach($output['article']['article_content'] as $key => $val){?>
                    <li>
                        <h2 id="dom_<?php echo $key;?>"><?php echo $val['title']?></h2>
                        <p><?php echo $val['content']?></p>
                    </li>
                    <?php }?>
                </ul>
                <!--常见问题 A-->
            </div>
        <?php } elseif ( $output['article']['article_title'] == '联系我们' ) { ?>
            <div class="ui-content">
                <div class="customer-service transcript">
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
                            <div class="two"><a href="javascript:void(0)" onclick="NTKF.im_openInPageChat('sc_1000_9999')" >立即咨询</a></div>
                        </div>
                    </div>
                    <div class="csbox">
                        <i class="icon-cs3"></i>
                        <span>
							<h2>微信客服</h2>
							<p>每天  9:00 - 18:00  为您服务</p>
						</span>
                        <div class="boxhover">
                            <div class="three"><img
                                    src="<?php echo SHOP_TEMPLATES_URL; ?>/images/servicecenter/serve-wechat.jpg"/>
                                <p class="txt-wechat">扫一扫 立即咨询</p></div>
                        </div>
                    </div>
                </div>
                <h2 class="con-module-title">联系方式</h2>
                <div class="ci">
                    <p>收藏天下全国客服电话：400-81-96567</p>
                    <p>固话：010-57793222 010-577468955</p>
                    <p>传真：010-87759019</p>
                    <p>地址：北京市朝阳区十里河文化园A座三层 收藏天下</p>
                </div>
                <h2 class="con-module-title mb">在线地图</h2>
                <!--百度地图容器-->
                <script type="text/javascript" src="http://api.map.baidu.com/api?v=2.0&ak=eFBcQj5AigbC1bQp4S99jX6UNN0rKW6C"></script>
                <div style="width:928px;height:550px;border:#ccc solid 1px;font-size:12px" id="map"></div>
                <script type="text/javascript">
                    //创建和初始化地图函数：
                    function initMap() {
                        createMap();//创建地图
                        setMapEvent();//设置地图事件
                        addMapControl();//向地图添加控件
                        addMapOverlay();//向地图添加覆盖物
                    }
                    function createMap() {
                        map = new BMap.Map("map");
                        map.centerAndZoom(new BMap.Point(116.464069, 39.871661), 18);
                    }
                    function setMapEvent() {
                        map.enableScrollWheelZoom();
                        map.enableKeyboard();
                        map.enableDragging();
                        map.enableDoubleClickZoom()
                    }
                    function addClickHandler(target, window) {
                        target.addEventListener("click", function () {
                            target.openInfoWindow(window);
                        });
                    }
                    function addMapOverlay() {
                        var markers = [
                            {
                                content: "北京市朝阳区十里河文化园A座三层",
                                title: "收藏天下",
                                imageOffset: {width: 0, height: 3},
                                position: {lat: 39.872658, lng: 116.464546}
                            }
                        ];
                        for (var index = 0; index < markers.length; index++) {
                            var point = new BMap.Point(markers[index].position.lng, markers[index].position.lat);
                            var marker = new BMap.Marker(point, {
                                icon: new BMap.Icon("http://api.map.baidu.com/lbsapi/createmap/images/icon.png", new BMap.Size(20, 25), {
                                    imageOffset: new BMap.Size(markers[index].imageOffset.width, markers[index].imageOffset.height)
                                })
                            });
                            var label = new BMap.Label(markers[index].title, {offset: new BMap.Size(25, 5)});
                            var opts = {
                                width: 200,
                                title: markers[index].title,
                                enableMessage: false
                            };
                            var infoWindow = new BMap.InfoWindow(markers[index].content, opts);
                            marker.setLabel(label);
                            addClickHandler(marker, infoWindow);
                            map.addOverlay(marker);
                        }
                        ;
                    }
                    //向地图添加控件
                    function addMapControl() {
                        var scaleControl = new BMap.ScaleControl({anchor: BMAP_ANCHOR_BOTTOM_LEFT});
                        scaleControl.setUnit(BMAP_UNIT_IMPERIAL);
                        map.addControl(scaleControl);
                        var navControl = new BMap.NavigationControl({
                            anchor: BMAP_ANCHOR_TOP_LEFT,
                            type: BMAP_NAVIGATION_CONTROL_LARGE
                        });
                        map.addControl(navControl);
                        var overviewControl = new BMap.OverviewMapControl({
                            anchor: BMAP_ANCHOR_BOTTOM_RIGHT,
                            isOpen: true
                        });
                        map.addControl(overviewControl);
                    }
                    var map;
                    initMap();
                </script>
            </div>
        <?php } elseif( $output['article']['article_title'] == '账户安全' ) { ?>
            <div class="account-guide-navigation">
                <ul class="investment_title">
                    <?php foreach( $output['article']['article_content']['title'] as $key => $val ){?>
                    <li <?php if($key == 0){?>class="on"<?php }?>><?php echo $val;?></li>
                    <?php }?>
                </ul>
            </div>
            <div class="investment_con">
                <?php foreach( $output['article']['article_content']['content'] as $key => $val ){?>
                <div class="demo ui-content">
                    <?php echo $val;?>
                </div>
                <?php }?>
            </div>
        <?php }else{?>
            <div class="ui-content">
                <?php echo $output['article']['article_content'] ?>
            </div>
        <?php } ?>
        <?php if(!empty($output['question'])){?>
        <div class="ui-faq">
            <h2 class="con-module-title"><?php if($output['article']['article_title'] == '常见问题'){?>常见问题<?php }else{?>热点问题<?php }?></h2>
            <ul>
                <?php foreach ( $output['question']['article_content'] as $key => $val ) { ?>
                    <li>
                        <a href="<?php echo BASE_SITE_URL;?>/servercenter-article_id-<?php echo $output['question']['article_id'] ?>.html#dom_<?php echo $key;?>" target="_blank">
                            <?php echo $val; ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <?php }?>
    </div>
</div>
</body>
</html>