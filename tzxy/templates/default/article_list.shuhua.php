<?php defined('InShopNC') or exit('Access Invalid!');?>
<script type="text/javascript">
    $(document).ready(function(){
        $(".image_lazy_load").nc_lazyload();
    });
</script>
<div class="warp-all article-layout-a">
  <div class="mainbox">
    <div class="sitenav-bar">
        <div class="sitenav"><?php echo $lang['current_location'];?><?php echo $lang['nc_colon'];?> <a href="<?php echo CMS_SITE_URL;?>"><?php echo $lang['cms_site_name'];?></a> > <a href="<?php echo CMS_SITE_URL.DS.'index.php?act=article&op=article_list';?>"><?php echo $lang['cms_article'];?></a><?php echo empty($_GET['class_id'])?'':' > '.$output['article_class_list'][$_GET['class_id']]['class_name'];?></div>

    </div>

      <article class="article-directory-content">
          <header class="home-directory">
              <h2>【书画家名录】</h2>
          </header>
          <section class="job-classification">
              <p>职位</p>
              <?php
              $zhiwei = array('中国美协','中国书协','省级美协','中国国家画院','中国画研究院','北京画院','一级美术师','二级美术师','三级美术师');
              $chuangzuo = array('山水','花鸟','人物','书法','油画','版画');
              ?>
              <ul>
                  <?php foreach($zhiwei as $k=>$v){ ?>
                      <li><a href="index.php?act=article&op=article_list&class_id=69&keywords=<?php echo $v;?>" <?php echo ($_GET['keywords'] == $v)?'class="on"':'';?>><?php echo $v;?></a></li>
                  <?php } ?>
              </ul>
          </section>
          <section class="job-classification no-bob">
              <ul>
                  <?php foreach($chuangzuo as $k=>$v){ ?>
                      <li><a href="index.php?act=article&op=article_list&class_id=69&keywords=<?php echo $v;?>" <?php echo ($_GET['keywords'] == $v)?'class="on"':'';?>><?php echo $v;?></a></li>
                  <?php } ?>
              </ul>
          </section>
          <section class="famous-story">
              <?php if(!empty($output['article_list']) && is_array($output['article_list'])) {?>
              <ul>
                  <?php foreach($output['article_list'] as $value) {?>
                  <?php $article_url = getCMSArticleUrl($value['article_id']);
                      preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i',$value['article_content'],$match);
                      $img = $match[1];

                      ?>
                  <li>
                      <a href="<?php echo $article_url;?>" target="_blank">
                          <div class="story-imga">
                              <img src="<?php echo $img;?>" alt="<?php echo $value['article_title'];?>">
                          </div>
                          <div class="story-word">
                              <?php echo mb_substr(strip_tags($value['article_content']),0,100);?>
                          </div>
                      </a>
                  </li>
              <?php } ?>
              </ul>
              <div class="pagination"> <?php echo $output['show_page'];?> </div>
              <?php } else { ?>
                  <div class="no-content-b"><i class="article"></i><?php echo $lang['no_record'];?></div>
              <?php } ?>
          </section>
          <header class="home-directory">
              <h2>【艺术家推荐】</h2>
          </header>
          <section class="longhair-list">
              <?php if(!empty($output['tuijian_list']) && is_array($output['tuijian_list'])) {?>
              <ul>
                  <?php foreach($output['tuijian_list'] as $value) {?>
                      <?php $article_url = getCMSArticleUrl($value['article_id']);
                      preg_match('/<img.+src=\"?(.+\.(jpg|gif|bmp|bnp|png))\"?.+>/i',$value['article_content'],$match);
                      $img = $match[1];
                      $zuozhe = mb_substr($value['article_title'],0,strpos($value['article_title'],'作品'));

                      ?>
                  <li>
                      <a href="<?php echo $article_url;?>"><img src="<?php echo $img;?>" alt="<?php echo $value['article_title'];?>"><span><?php echo $zuozhe;?></span></a>
                  </li>
                  <?php } ?>
              </ul>
              <?php } ?>
          </section>
          <style>
              .article-directory-content { padding-top: 20px;}
              .home-directory { margin-left: 0 !important; border-bottom: 1px #d4cfcb solid;}
              .home-directory h2 {
                  position: relative;
                  font-size: 18px;
                  width: 650px;
                  color: #6b6b6b;
                  font-family: '方正兰亭粗黑简体';
                  padding-bottom: 14px;
              }
              .home-directory h2:after {
                  position: absolute;
                  top: 31px;
                  content: '';
                  display: block;
                  width: 122px;
                  border-bottom: 3px #ed1b2f solid;
              }
              .home-directory a {
                  float: right;
                  display: block;
                  font-size: 12px;
                  font-weight: none;
                  margin-top: 14px;
                  color: #ed1b2f;
                  font-family: 'Microsoft YaHei';
              }
              .home-directory a:hover {
                  text-decoration: underline;
              }
              .job-classification { padding: 20px 0 8px; border-bottom: 1px #d4cfcb solid; overflow: hidden;}
              .job-classification p { display: block; float: left; width: 30px;}
              .no-bob {border-bottom: 0;}
              .job-classification ul {float: left; width: 620px;}
              .job-classification ul li { display: block; float: left; margin: 0 8px 12px;}
              .job-classification ul li a:hover {
                  text-decoration: none;
              }
              .job-classification .on {
                  color: #ed1b2f;
              }
              .famous-story {
                  margin-bottom: 22px;
              }
              .famous-story li {
                  overflow: hidden;
                  border-bottom: 1px #d4cfcb solid;
                  padding: 23px 0;
                  clear: both;
              }
              .famous-story .story-imga {
                  float: left;
                  width: 120px;
                  height: 160px;
                  margin-right: 42px;
                  overflow: hidden;
                  text-align: center;
              }
              .famous-story .story-imga img {
                  vertical-align: middle;
                  display: inline-block;
                  height: auto;
                  max-width: 100%;
              }
              .famous-story .story-word {
                  line-height: 22px;
                  font-size: 12px;
                  height: 160px;
                  width: 440px;
                  color: #000;
                  overflow: hidden;
                  text-overflow: ellipsis;
                  display: -webkit-box;
                  -webkit-line-clamp: 7;
                  -webkit-box-orient: vertical;
                  word-wrap: break-word;
              }
              .famous-story a {
                  text-decoration: none;
                  color: #000;
              }
              .longhair-list {
                  padding: 30px 0;
              }
              .longhair-list li:first-child {
                  margin-left: 0;
              }
              .longhair-list li {
                  position: relative;
                  float: left;
                  width: 152px;
                  height: 200px;
                  overflow: hidden;
                  margin-left: 14px;
              }
              .longhair-list li img {
                  width: 100%;
              }
              .longhair-list li span {
                  position: absolute;
                  bottom: 0;
                  left: 0;
                  font-size: 14px;
                  color: #fff;
                  font-family: 'Microsoft YaHei';
                  text-align: center;
                  width: 100%;
                  height: 40px;
                  line-height: 40px;
                  background: rgb(0,0,0);
                  background: rgba(0,0,0,0.5);
                  transition: .2s;
                  -moz-transition: .2s;  /* Firefox 4 */
                  -webkit-transition: .2s;   /* Safari 和 Chrome */
                  -o-transition: .2s;
              }
              .longhair-list li:hover span {
                  background: #d23d43;
              }
          </style>

      </article>

  </div>
  <div class="sidebar">
    <?php require('article_list.sidebar.php');?>
  </div>
</div>
