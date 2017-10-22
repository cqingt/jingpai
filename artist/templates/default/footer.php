<?php defined('InShopNC') or exit('Access Invalid!');?>

<div id="faq">
  <div class="faq-wrapper">
    <?php if(is_array($output['article_list']) && !empty($output['article_list'][0]['list'])){ ?><ul>
    <?php foreach ($output['article_list'] as $k=> $article_class){ ?>
    <?php if(!empty($article_class)){ ?>
   <li> <dl class="s<?php echo ''.$k+1;?>">
      <dt>
        <?php if(is_array($article_class['class'])) echo $article_class['class']['ac_name'];?>
      </dt>
      <?php if(is_array($article_class['list']) && !empty($article_class['list'])){ ?>
      <?php foreach ($article_class['list'] as $article){ ?>
      <dd><i></i><a href="<?php if($article['article_url'] != '')echo $article['article_url'];else echo urlShop('article', 'show',array('article_id'=> $article['article_id']));?>" title="<?php echo $article['article_title']; ?>"> <?php echo $article['article_title'];?> </a></dd>
      <?php }?>
      <?php }?>
    </dl></li>
    <?php }?>
    <?php }?>       
  </ul> 
<div class="help">
    <div class="w1190 clearfix">
        <div class="contact f-l">
          <div class="contact-border clearfix">
              <p>全国统一免费热线</p>
              <span class="ic tel t20">400-08-96567</span>
          </div>
        </div>
    </div>
  </div>      
    <?php }?>
  </div>
</div>
<!--友情链接 begin-->
<?php if(is_array($output['$link_list']) && !empty($output['$link_list']) && $output['index_sign'] == 'index') { ?>
<div class="blogroll">
     <div class="wrapper">
          <h2><?php echo $lang['index_index_link'];?></h2>
          <div class="blo-box">
             <?php foreach($output['$link_list'] as $val) { ?>
               <span><a href="<?php echo $val['link_url']; ?>" target="_blank"><?php echo $val['link_title']; ?></a></span>
             <?php } ?>
          </div>
     </div>
</div>
<?php } ?>
<!--友情链接 end-->
<div id="footer" class="wrapper">
  <p><a href="<?php echo SHOP_SITE_URL;?>"><?php echo $lang['nc_index'];?></a>
    <?php if(!empty($output['nav_list']) && is_array($output['nav_list'])){?>
    <?php foreach($output['nav_list'] as $nav){?>
    <?php if($nav['nav_location'] == '2'){?>
    | <a  <?php if($nav['nav_new_open']){?>target="_blank" <?php }?>href="<?php switch($nav['nav_type']){
      case '0':echo $nav['nav_url'];break;
      case '1':echo urlShop('search', 'index', array('cate_id'=>$nav['item_id']));break;
      case '2':echo urlShop('article', 'article',array('ac_id'=>$nav['item_id']));break;
      case '3':echo urlShop('activity', 'index',array('activity_id'=>$nav['item_id']));break;
    }?>"><?php echo $nav['nav_title'];?></a>
    <?php }?>
    <?php }?>
    <?php }?>
  </p>
  <?php echo $output['setting_config']['shopnc_version'];?> <?php echo $output['setting_config']['icp_number']; ?><br />北京<br />
  <?php echo html_entity_decode($output['setting_config']['statistics_code'],ENT_QUOTES); ?> 
  <div class="footerbox mt10">
            <a rel="nofollow"  href="/tzxy/templates/default/images/icpz.jpg" target="_blank"><img src="/tzxy/templates/default/images/footer1.jpg" alt=""></a>
            <a rel="nofollow" href="https://ss.knet.cn/verifyseal.dll?sn=e15081911010559990rbct000000&ct=df&a=1&pa=0.30423407070338726"  target="_blank"><img src="/tzxy/templates/default/images/footer2.jpg" alt=""></a>
            <a rel="nofollow" href="http://about.58.com/fqz/index.html" target="_blank"><img src="/tzxy/templates/default/images/footer3.jpg" alt=""></a>
  </div>

</div>
