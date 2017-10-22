<?php defined('InShopNC') or exit('Access Invalid!');?>

<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/msscss.css">
<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/css/main.css">

<div class="mss_vip_consult" id="mss_vip_consult">
    <dl>
        <dd class="active"><p>购买咨询</p></dd>
        <dd><p>常见问题</p></dd>
        <dd><p>配送支付</p></dd>
    </dl>
    <div class="tab_box">
        <ul style=" display:block;" id="lmlm_pic">
            <?php if(!empty($output['consult_list'])){ ?>
                <?php foreach($output['consult_list'] as $k=>$v){ ?>
                    <li>
                        <div class="mss_vip_consultp"><strong class="mss_red"><?php echo ($v['geval_frommembername'] == '')?'游客':str_cut($v['geval_frommembername'],2).'***';?> 咨询：</strong><p><?php echo $v['consult_content']?></p><?php if($v['consult_reply'] != ''){?><strong>收藏回答：</strong><p><?php echo $v['consult_reply']?></p><?php } ?></div>
                    </li>
                <?php }?>
                <?php echo $output['show_page'];?>
            <?php }else{ ?>
            <span id="loadingsave" style="line-height:2em;"><span style="display:block; text-align:center; color:#666; font-family:微软雅黑;">暂无评价</span></span>
            <?php } ?>
        </ul>

        <ul class="hide">
            <li>
                <div class="mss_vip_consultp">
                    <p>收藏天下所售商品都是正品行货吗？有保真证明吗？</p>
                    <strong>收藏回答：</strong>
                    <p>收藏天下所售商品全部为正品行货，藏品附带专业机构的认证证书与保真证明，书画、玉器、古玩等多种门类产品可提供专业鉴赏家的鉴赏证明，每套藏品均配有收藏天下收藏票，确保藏品的质量。</p>
                </div>
            </li>
            <li>
                <div class="mss_vip_consultp">
                    <p>购买的商品能开发票？如果是公司购买，可以开增值税发票吗？</p>
                    <strong>收藏回答：</strong>
                    <p>由于收藏品的特殊性，您购买的商品均为不含税价格，需要发票的客户需另行加税。</p>
                </div>
            </li>
            <li>
                <div class="mss_vip_consultp">
                    <p>下单多久后可以发货？</p>
                    <strong>收藏回答：</strong>
                    <p>上午下单的客户一般下午发货，下午下单的客户一般隔日发货，个别缺货的情况会以短信或电话通知。</p>
                </div>
            </li>
            <li>
                <div class="mss_vip_consultp">
                    <p>无货商品什么时候能到货？</p>
                    <strong>收藏回答：</strong>
                    <p>收藏商城绝大多数商品都能保证供应充足，部分热销产品如遇暂时断货情况，客服会在第一时间与您取得联系，无货商品的到货时间根据配货情况而定，一般两个工作日内仍无法顺利配货的，产品部会及时将信息反馈至客户，以便客户决定是否继续等待配货，全程了解自己的订单状况。</p>
                </div>
            </li>
            <li>
                <div class="mss_vip_consultp">
                    <p>快递费是多少？</p>
                    <strong>收藏回答：</strong>
                    <p>凡是活动藏品快递费用由收藏天下全部承担，其余藏品根据不同的快递公司费用会有所差异。</p>
                </div>
            </li>
            <li>
                <div class="mss_vip_consultp">
                    <p>上门提货、货到付款支持刷卡吗？ 周末可以自提吗？</p>
                    <strong>收藏回答：</strong>
                    <p>上门提货、货到付款均支持刷卡支付。我公司营业时间在周一至周六8:30-18:00，营业时间内可上门自提。</p>
                </div>
            </li>
            <li>
                <div class="mss_vip_consultp">
                    <p>支持信用卡分期付款吗？如何申请？</p>
                    <strong>收藏回答：</strong>
                    <p>我公司目前不支持信用卡分期付款，不支持赊销，如果有特殊要求请与相关客服人员联系。</p>
                </div>
            </li>
            <li>
                <div class="mss_vip_consultp">
                    <p>哪些地区支持货到付款？</p>
                    <strong>收藏回答：</strong>
                    <p>收藏天下开通了国内全境货到付款，您可使用现金、银行卡（针对已开通此种服务的部分区域）当面付款收货。</p>
                </div>
            </li>
            <li>
                <div class="mss_vip_consultp">
                    <p>汇款确认后多久能够将货物发出？</p>
                    <strong>收藏回答：</strong>
                    <p>正常情况下在工作时间24小时内可以将您的货物发出。</p>
                </div>
            </li>
            <li>
                <div class="mss_vip_consultp">
                    <p>收货时发现问题可以拒收吗？</p>
                    <strong>收藏回答：</strong>
                    <p>在签收货物时如发现货物有损坏，请直接拒收退回我公司（货件如有异常，望您能积极与我公司配合，电话沟通，以便对此类事件能准确、及时作出判断），相关人员将为您重新安排发货。</p>
                </div>
            </li>
            <li>
                <div class="mss_vip_consultp">
                    <p>如果我刚刚下单商品就降价了，能给我补偿吗？</p>
                    <strong>收藏回答：</strong>
                    <p>由于收藏品价格的特殊性，商品价格每日都会有波动，下单后价格不作任何修改。</p>
                </div>
            </li>
            <li>
                <div class="mss_vip_consultp">
                    <p>订单付款后，如果长时间未收到货，我是否可以申请办理退款？</p>
                    <strong>收藏回答：</strong>
                    <p>收藏天下货件由第三方快递公司负责直接送达的订单，如EMS、宅急送，自发货时间算起超过3-7天仍未收到货，请致电客服中心400-81-96567售后热线帮助查询，自发货时间算起超过20天仍未收到货，可由客服人员为您申请办理退款事宜。</p>
                </div>
            </li>
            <li>
                <div class="mss_vip_consultp">
                    <p>非商品自身质量问题是否可以退货？</p>
                    <strong>收藏回答：</strong>
                    <p>部分非藏品自身质量问题的情况下，加收一定的退货手续费，是可以办理退货的，详情请查看"退换货政策"。</p>
                </div>
            </li>
            <li>
                <div class="mss_vip_consultp">
                    <p>藏品包装问题？</p>
                    <strong>收藏回答：</strong>
                    <p>我司所发送藏品均由专人进行打包，并全方位视频监控。商品在未签收前都由我司负责，如在收到藏品时务必详细检查，发现包装有破损或是其它方面问题，请直接致电我司客服400-01-96567，客服人员会帮您解决。</p>
                </div>
            </li>
            <li>
                <div class="mss_vip_consultp">
                    <p>工作时间是什么时候</p>
                    <strong>收藏回答：</strong>
                    <p>客服中心受理热线电话及订单处理时间为周一至周日：8：30：00-18：00（如遇国家法定节假日，则以收藏天下公告发布放假时间为准，请大家届时关注）。</p>
                </div>
            </li>
            <li>
                <div class="mss_vip_consultp">
                    <p>如何将退款打回银行卡？</p>
                    <strong>收藏回答：</strong>
                    <p>在投诉中心留言相关信息（或致电收藏天下客服），如银行卡的开户行(详细到支行）、开户姓名、卡号，相关人员会为您处理，退款周期视您的货物是否发出而定，如果货物未出库发出，退款会在三个工作日内完成；如果货物已发出，则需货物返回我司物流中心后为您办理退款。</p>
                </div>
            </li>
        </ul>
        <ul class="mss_vip_con_dispatching">
            <strong>购买贵公司的藏品，藏品怎么配送？</strong>
            <p>1、您下订单以后，如方便可来公司可上门自取，公司地址在北京市朝阳区百子湾南二路78号3号楼收藏天下<br>
                2、北京境外藏友购买藏品，收藏天下一律安排最先到达的快递派送，代收货款的客户需要根据代收货款的区域选择快递公司。<br>
            </p>
            <strong>贵重藏品贵公司可以安排直送吗？</strong>
            <p>凡是贵重藏品、或一次性购物满10万元，由收藏天下安排公司自己的送货专员上门亲自送货，确保货物安全放心。
            </p>
            <strong>异地配送：</strong>
            <p>1、收藏天下网对全国大部分城市收藏天下都能委托签约快递公司进行送货上门服务，时间和范围请看配送时间及配送范围。<br>
                2、针对较偏远的城市，收藏天下开展了委托EMS的送货上门业务，由于地段的限制，此类配送服务的时间可能比快递稍长。<br>
            </p>
            <strong>在线支付：</strong>
            <p>1、支付宝担保交易<br>支付宝担保交易是在买家未收到网购商品之前，货款由支付宝暂时管理，卖家确认收货后，支付宝将货款支付给卖家。<br>
                2、我们为您提供几乎全部银行的银行卡及信用卡在线支付，只要您开通了"网上支付"功能，即可在线支付；您有支付宝账户的可选择支付宝进行在线支付，无需手续费，实时到帐，方便快捷；<br>
            </p>
            <strong>货到付款：</strong>
            <p>收藏天下网开通了全国所有省市、县（区）1000多个城市的货到付款业务；
            </p>
            <strong>公司转帐：</strong>
            <p>您可以向收藏天下网公司帐户汇款，到帐时间一般为款汇出后的1-5个工作日，<a target="_blank" style="color: #e00" href="http://www.96567.com/article-17.html">查看公司帐户&gt;&gt;</a>
            </p>
            <strong>服务协助：</strong>
            <p>当您在接收商品时，遇到任何问题时，稍安勿躁，请您拨打客服热线4008196567（9：00-18：00），由客服人员协助您解决，请勿直接与快递人员私下交涉，防止给您带来不便。
            </p>
            <strong>特别提醒：</strong>
            <p>如您收货时签收了货品，则默认为您确认商品无误，此订单交易正常完成。此后，您已签收的商品存在任何质量、瑕疵、货品不全、发错货等情况，收藏天下将享受完全免责权利，请您谅解。
            </p>
        </ul>
    </div>
</div>
<script>
    $(function(){
        var $div_li=$(".mss_vip_consult dl dd");
        $div_li.click(function(){
            $(this).addClass('active').siblings().removeClass('active');
            var index=$div_li.index(this);
            $("div.tab_box>ul").eq(index).show().siblings().hide();
            if(index){
                $("#loadingsave").hide();
            }
            else{
                $("#loadingsave").show();
            }
        });
    });
</script>
