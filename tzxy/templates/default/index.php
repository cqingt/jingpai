<div class="channel-main warp-all">
    <div class="chaLeft-warp">
        <div class="self-motionImg">
            <!-- 轮播图 -->
            <div class="yx-rotaion">
                <ul class="rotaion_list">
                    <?php if(!empty($output['lbtw'])){?>
                        <?php foreach ($output['lbtw'] as $k=>$v){?>
                            <li>
                                <a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'max');?>" alt="<?php echo $v['article_title']?>" width="680px" height="330px"></a>
                        <?php }?>
                    <?php }?>
                </ul>
            </div>


            <script type="text/javascript" src="<?php echo CMS_TEMPLATES_URL;?>/js/jquery.yx_rotaion.js"></script>
            <script type="text/javascript">
                $(".yx-rotaion").yx_rotaion({auto:true});
            </script>
        </div>
        <div class="channel-list">
            <div class="chaLeft h467">
                <div class="b-chabox">
                    <div class="channel-title">
                        <p>热点关注</p>
                        <a href="<?php echo getCMSListsUrl('39');?>" target="_blank">更多</a>
                    </div>
                    <ul>
                        <?php if(!empty($output['rdgz'])){?>
                            <?php foreach ($output['rdgz'] as $k=>$v){?>
                                <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                            <?php }?>
                        <?php }?>
                    </ul>
                </div>
                <div class="b-chabox">
                    <div class="channel-title">
                        <p>最新动态</p>
                        <a href="<?php echo getCMSListsUrl('19');?>" target="_blank">更多</a>
                    </div>
                    <ul>
                        <?php if(!empty($output['zxdt'])){?>
                            <?php foreach ($output['zxdt'] as $k=>$v){?>
                                <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                            <?php }?>
                        <?php }?>
                    </ul>
                </div>
            </div>

            <div class="chaRight h467">
                <div class="component">
                    <?php if(!empty($output['tjwz'])){?>
                        <?php foreach ($output['tjwz'] as $k=>$v){?>
                            <dl>
                                <dt><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></dt>
                                <dd><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo html_substr_word($v['article_content'],60).'...';?></a></dd>
                            </dl>
                        <?php }?>
                    <?php }?>
                </div>
            </div>

        </div>
    </div>

    <div class="chaRight-warp">
        <div class="a-chabox h328 mb20">
            <h1>专家观点<a href="<?php echo getCMSListsUrl('40');?>" target="_blank">更多</a></h1>
            <?php if(!empty($output['zjgd'])){?>
                <dl>
                    <dt><a href="<?php echo getCMSArticleUrl($output['zjgd'][0]['article_id']);?>" target="_blank"><?php echo $output['zjgd'][0]['article_title'];?></a></dt>
                    <dd><a href="<?php echo getCMSArticleUrl($output['zjgd'][0]['article_id']);?>" target="_blank"><?php echo html_substr_word($output['zjgd'][0]['article_content'],60).'...';?><strong>详情>></strong></a></dd>
                </dl>
            <ul>
                <?php foreach ($output['zjgd'] as $k=>$v){?>
                    <?php if($k > 0){ ?>
                        <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                    <?php }?>
                <?php }?>
            </ul>
            <?php }?>
        </div>
        <div class="a-chabox h298 mb20">
            <h1>收藏趣事<a href="<?php echo getCMSListsUrl('60');?>" target="_blank">更多</a></h1>
            <ul>
                <?php if(!empty($output['scqs'])){?>
                    <?php foreach ($output['scqs'] as $k=>$v){?>
                        <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                    <?php }?>
                <?php }?>
            </ul>
        </div>
        <div class="channel-adOne">
            <?php echo loadadv(1050);?>
        </div>
    </div>
</div>

<div class="banner-ad warp-all">
    <?php echo loadadv(1048);?>
</div>
<div class="channel-column warp-all">
    <h1><em>投资</em>分析</h1>
</div>

<div class="channel-main warp-all">
    <div class="chaLeft-warp">
        <div class="channel-list">
            <div class="chaLeft h977">
                <div class="b-chabox">
                    <div class="channel-title">
                        <p>藏市热点</p>
                        <a href="<?php echo getCMSListsUrl('39');?>" target="_blank">更多</a>
                    </div>
                    <?php if(!empty($output['csrd'])){?>
                        <dl>
                            <dt style="height:32px;overflow:hidden;"><a href="<?php echo getCMSArticleUrl($output['csrd'][0]['article_id']);?>" target="_blank"><?php echo $output['csrd'][0]['article_title'];?></a></dt>
                            <dd class="b-chaImg"><a href="<?php echo getCMSArticleUrl($output['csrd'][0]['article_id']);?>" target="_blank"><img src="<?php echo getCMSArticleImageUrl($output['csrd'][0]['article_attachment_path'], $output['csrd'][0]['article_image'], 'list');?>" alt="<?php echo $output['csrd'][0]['article_title'];?>"></a></dd>
                            <dd class="b-chaText"><a href="<?php echo getCMSArticleUrl($output['csrd'][0]['article_id']);?>" target="_blank"><?php echo html_substr_word($output['csrd'][0]['article_content'],35).'...';?></a></dd>
                        </dl>
                        <ul>
                            <?php foreach ($output['csrd'] as $k=>$v){?>
                                <?php if($k > 0){ ?>
                                    <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                                <?php }?>

                            <?php }?>
                        </ul>
                    <?php }?>

                </div>
                <div class="b-chabox">
                    <div class="channel-title">
                        <p>行情快讯</p>
                        <a href="<?php echo getCMSListsUrl('20');?>" target="_blank">更多</a>
                    </div>
                    <?php if(!empty($output['hqkx'])){?>
                        <dl>
                            <dt style="height:32px;overflow:hidden;"><a href="<?php echo getCMSArticleUrl($output['hqkx'][0]['article_id']);?>" target="_blank"><?php echo $output['hqkx'][0]['article_title'];?></a></dt>
                            <dd class="b-chaImg"><a href="<?php echo getCMSArticleUrl($output['hqkx'][0]['article_id']);?>" target="_blank"><img src="<?php echo getCMSArticleImageUrl($output['hqkx'][0]['article_attachment_path'], $output['hqkx'][0]['article_image'], 'list');?>" alt="<?php echo $output['hqkx'][0]['article_title'];?>"></a></dd>
                            <dd class="b-chaText"><a href="<?php echo getCMSArticleUrl($output['hqkx'][0]['article_id']);?>" target="_blank"><?php echo html_substr_word($output['hqkx'][0]['article_content'],35).'...';?></a></dd>
                        </dl>
                        <ul>
                            <?php foreach ($output['hqkx'] as $k=>$v){?>
                                <?php if($k > 0){ ?>
                                    <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                                <?php }?>

                            <?php }?>
                        </ul>
                    <?php }?>
                </div>
                <div class="b-chabox">
                    <div class="channel-title">
                        <p>拍卖结果</p>
                        <a href="<?php echo getCMSListsUrl('56');?>" target="_blank">更多</a>
                    </div>
                    <?php if(!empty($output['hqkx'])){?>
                        <dl>
                            <dt style="height:32px;overflow:hidden;"><a href="<?php echo getCMSArticleUrl($output['pmjg'][0]['article_id']);?>" target="_blank"><?php echo $output['pmjg'][0]['article_title'];?></a></dt>
                            <dd class="b-chaImg"><a href="<?php echo getCMSArticleUrl($output['pmjg'][0]['article_id']);?>" target="_blank"><img src="<?php echo getCMSArticleImageUrl($output['pmjg'][0]['article_attachment_path'], $output['pmjg'][0]['article_image'], 'list');?>" alt="<?php echo $output['pmjg'][0]['article_title'];?>"></a></dd>
                            <dd class="b-chaText"><a href="<?php echo getCMSArticleUrl($output['pmjg'][0]['article_id']);?>" target="_blank"><?php echo html_substr_word($output['pmjg'][0]['article_content'],35).'...';?></a></dd>
                        </dl>
                        <ul>
                            <?php foreach ($output['pmjg'] as $k=>$v){?>
                                <?php if($k > 0){ ?>
                                    <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                                <?php }?>

                            <?php }?>
                        </ul>
                    <?php }?>
                </div>
            </div>

            <div class="chaRight h467">
                <div class="middle-box">
                    <div class="midbox">
                        <div class="midbox-h1">
                            <h1>邮币卡<a href="<?php echo getCMSListsUrl('37');?>" target="_blank">更多</a></h1>
                        </div>
                        <ul>
                            <?php if(!empty($output['ybk'])){?>
                                <?php foreach ($output['ybk'] as $k=>$v){?>
                                    <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                                <?php }?>
                            <?php }?>
                        </ul>
                    </div>
                    <div class="midbox">
                        <div class="midbox-h1">
                            <h1>贵金属<a href="<?php echo getCMSListsUrl('38');?>" target="_blank">更多</a></h1>
                        </div>
                        <ul>
                            <?php if(!empty($output['gjs'])){?>
                                <?php foreach ($output['gjs'] as $k=>$v){?>
                                    <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                                <?php }?>
                            <?php }?>
                        </ul>
                    </div>
                    <div class="midbox">
                        <div class="midbox-h1">
                            <h1>珠宝玉器<a href="<?php echo getCMSListsUrl('62');?>" target="_blank">更多</a></h1>
                        </div>
                        <ul>
                            <?php if(!empty($output['zbyq'])){?>
                                <?php foreach ($output['zbyq'] as $k=>$v){?>
                                    <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                                <?php }?>
                            <?php }?>
                        </ul>
                    </div>
                    <div class="midbox">
                        <div class="midbox-h1">
                            <h1>书法字画<a href="<?php echo getCMSListsUrl('55');?>" target="_blank">更多</a></h1>
                        </div>
                        <ul>
                            <?php if(!empty($output['sfzh'])){?>
                                <?php foreach ($output['sfzh'] as $k=>$v){?>
                                    <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                                <?php }?>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="chaRight-warp">
        <div class="a-chabox h975 mb20">
            <h1>藏品赏析<a href="<?php echo getCMSListsUrl('42');?>" target="_blank">更多</a></h1>
            <ol>
                <?php if(!empty($output['cpsx'])){?>
                    <?php foreach ($output['cpsx'] as $k=>$v){?>
                        <li>
                            <a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><img src="<?php echo getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image'], 'list');?>" width="258px" height="258px" alt="<?php echo $v['article_title']?>"></a>
                            <a class="oltext" href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a>
                        </li>
                    <?php }?>
                <?php }?>
            </ol>
        </div>
    </div>
</div>

<div class="banner-ad warp-all">
    <?php echo loadadv(1049);?>
</div>
<div class="channel-column warp-all">
    <h1><em>藏品</em>知识</h1>
</div>

<div class="channel-main warp-all">
    <div class="chaLeft-warp">
        <div class="channel-list">
            <div class="chaLeft h412">
                <div class="b-chabox">
                    <div class="channel-title">
                        <p>收藏百科</p>
                        <a href="<?php echo getCMSListsUrl('57');?>" target="_blank">更多</a>
                    </div>
                    <ul>
                        <?php if(!empty($output['scfg'])){?>
                            <?php foreach ($output['scfg'] as $k=>$v){?>
                                <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                            <?php }?>
                        <?php }?>
                    </ul>
                </div>
                <div class="b-chabox">
                    <div class="channel-title">
                        <p>保养知识</p>
                        <a href="<?php echo getCMSListsUrl('58');?>" target="_blank">更多</a>
                    </div>
                    <ul>
                        <?php if(!empty($output['byzs'])){?>
                            <?php foreach ($output['byzs'] as $k=>$v){?>
                                <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                            <?php }?>
                        <?php }?>
                    </ul>
                </div>
            </div>

            <div class="chaRight h412">
                <div class="middle-box">
                    <div class="midbox">
                        <div class="midbox-h1">
                            <h1>经验交流<a href="<?php echo getCMSListsUrl('59');?>" target="_blank">更多</a></h1>
                        </div>
                        <ul>
                            <?php if(!empty($output['jyjl'])){?>
                                <?php foreach ($output['jyjl'] as $k=>$v){?>
                                    <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                                <?php }?>
                            <?php }?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="chaRight-warp">
        <div class="a-chabox h412 mb10">
            <h1>发行公告<a href="<?php echo getCMSListsUrl('53');?>" target="_blank">更多</a></h1>
            <ul>
                <?php if(!empty($output['fxgg'])){?>
                    <?php foreach ($output['fxgg'] as $k=>$v){?>
                        <li><a href="<?php echo getCMSArticleUrl($v['article_id']);?>" target="_blank"><?php echo $v['article_title']?></a></li>
                    <?php }?>
                <?php }?>
            </ul>
        </div>
    </div>
</div>
