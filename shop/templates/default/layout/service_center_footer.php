<div class="serve-footer">
    <div class="wrapper">
        <ul>
            <li><a href="<?php echo SHOP_SITE_URL; ?>"><?php echo $lang['nc_index']; ?></a></li>
            <?php if ( !empty( $output['nav_list'] ) && is_array($output['nav_list']) ) { ?>
                <?php foreach ( $output['nav_list'] as $nav ) { ?>
                    <?php if ( $nav['nav_location'] == '2' ) { ?>
                         <li><a <?php if ( $nav['nav_new_open'] ){ ?>target="_blank"
                             <?php } ?>href="<?php switch ( $nav['nav_type'] ) {
                                 case '0':
                                     echo $nav['nav_url'];
                                     break;
                                 case '1':
                                     echo urlShop('search' , 'index' , array( 'cate_id' => $nav['item_id'] ));
                                     break;
                                 case '2':
                                     echo urlShop('article' , 'article' , array( 'ac_id' => $nav['item_id'] ));
                                     break;
                                 case '3':
                                     echo urlShop('activity' , 'index' , array( 'activity_id' => $nav['item_id'] ));
                                     break;
                             } ?>"><?php echo $nav['nav_title']; ?>
                             </a>
                         </li>
                    <?php } ?>
                <?php } ?>
            <?php } ?>
        </ul>
        <p class="copyright"><?php echo $output['setting_config']['shopnc_version']; ?> <?php echo $output['setting_config']['icp_number']; ?></p>
        <br>
        <?php echo html_entity_decode($output['setting_config']['statistics_code'] , ENT_QUOTES); ?>
        <div class="footerbox">
            <a rel="nofollow"  href="http://www.96567.com/tzxy/templates/default/images/icpz.jpg" target="_blank"><img src="http://www.96567.com/tzxy/templates/default/images/footer1.jpg" alt=""></a>
            <a rel="nofollow" target="_blank"><script src="http://kxlogo.knet.cn/seallogo.dll?sn=e16101311010564863hxnr000000&size=0"></script></a>
            <a rel="nofollow" href="http://about.58.com/fqz/index.html" target="_blank"><img src="http://www.96567.com/tzxy/templates/default/images/footer3.jpg" alt=""></a>
            <a logo_size="124x47" logo_type="realname" href="http://www.anquan.org" ><script src="http://static.anquan.org/static/outer/js/aq_auth.js"></script></a>
        </div>
    </div>
</div>
<?php if (C('debug') == 1){?>
    <div id="think_page_trace" class="trace">
        <fieldset id="querybox">
            <legend><?php echo $lang['nc_debug_trace_title'];?></legend>
            <div> <?php print_r(Tpl::showTrace());?> </div>
        </fieldset>
    </div>
<?php }?>

    <!--小能客户代码 -->
    <script language="javascript" type="text/javascript">
        NTKF_PARAM = {
            siteid:'sc_1000',
            <?php if($output['opAction']){ ?>
            sellerid:"sc_1000",<?php } ?>
            <?php if($output['YiShu']){ ?>
            settingid:'sc_1000_1476416019320',
            <?php }else{ ?>
            settingid:'sc_1000_9999',
            <?php } ?>
            uid:"<?php echo $_SESSION['member_id'];?>",
            uname:"<?php echo $_SESSION['member_name'];?>",
            userlevel:"<?php if($_SESSION['member_name']){ echo '1';}else{ echo '0'; }?>"<?php if (count($output['order_list'])>0) {?>,
            orderid:"<?php echo substr($orderid, 0, -1);?>",
            orderprice:'<?php echo substr($orderprice, 0, -1);?>'<?php }?><?php if($output['goods']){ ?>,
            ntalkerparam:{
                item:
                {
                    'id': "<?php echo $output['goods']['goods_id']; ?>",
                    'name': "<?php echo $output['goods']['goods_name']; ?>",
                    'imageurl': "<?php echo cthumb($output['goods']['goods_image'],240)?>",
                    'url': "<?php echo urlShop('goods', 'index', array('goods_id'=>$output['goods']['goods_id']));?>",
                    'siteprice':"<?php echo ($output['goods']['goods_price'] < 1)?'咨询客服':($output['goods']['goods_price']);?>"
                }
            }
            <?php } ?>
        }
    </script>
    <script type="text/javascript" src="http://dl.ntalker.com/js/b2b/ntkfstat.js?siteid=sc_1000" charset="utf-8"></script>
    <!--小能客户代码 end -->
