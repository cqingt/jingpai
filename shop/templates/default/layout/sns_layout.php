<?php defined('InShopNC') or exit('Access Invalid!');?>
<!doctype html>
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>">
<title><?php echo ($lang['nc_member_path_'.$output['menu_sign']]==''?'':$lang['nc_member_path_'.$output['menu_sign']].'_').$output['html_title'];?></title>
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta name="keywords" content="<?php echo C('site_keywords'); ?>" />
<meta name="description" content="<?php echo C('site_description'); ?>" />


<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/sns.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_RESOURCE_SITE_URL;?>/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

<link rel="stylesheet" href="http://www.96567.com/circle/templates/default/css/basis.css">
<link rel="stylesheet" href="http://www.96567.com/circle/templates/default/css/circle.css">
<link rel="stylesheet" href="http://www.96567.com/circle/templates/default/css/smohan.face.css">

<!--[if IE 7]>
  <link rel="stylesheet" href="<?php echo SHOP_RESOURCE_SITE_URL;?>/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]
<link id="skin_link" href="<?php echo SHOP_TEMPLATES_URL;?>/sns/style/<?php echo $output['skin_style'];?>.css" rel="stylesheet" type="text/css">
-->
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
      <script src="<?php echo RESOURCE_SITE_URL;?>/js/html5shiv.js"></script>
      <script src="<?php echo RESOURCE_SITE_URL;?>/js/respond.min.js"></script>
<![endif]-->
<!--[if IE 6]>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/IE6_MAXMIX.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/IE6_PNG.js"></script>
<script>
DD_belatedPNG.fix('.pngFix');
</script>
<script>
// <![CDATA[
if((window.navigator.appName.toUpperCase().indexOf("MICROSOFT")>=0)&&(document.execCommand))
try{
document.execCommand("BackgroundImageCache", false, true);
   }
catch(e){}
// ]]>
</script>
<![endif]-->
<!--[if IE 6]><style type="text/css">
body {_behavior: url(<?php echo SHOP_TEMPLATES_URL;?>/css/csshover.htc);}
</style>
<![endif]-->

<script type="text/javascript">
var COOKIE_PRE = '<?php echo COOKIE_PRE;?>';var _CHARSET = '<?php echo strtolower(CHARSET);?>';var SITEURL = '<?php echo SHOP_SITE_URL;?>';var SHOP_SITE_URL = '<?php echo SHOP_SITE_URL;?>';var MAX_RECORDNUM = <?php echo $output['max_recordnum'];?>;var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';var SHOP_RESOURCE_SITE_URL = '<?php echo SHOP_RESOURCE_SITE_URL;?>';var SHOP_TEMPLATES_URL = '<?php echo SHOP_TEMPLATES_URL;?>';
</script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.charCount.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/member.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/sns.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/sns_friend.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/sns_store.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/smilies/smilies.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/smilies/smilies_data.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.caretInsert.js" charset="utf-8"></script>
</head>
<body>
<?php require_once template('layout/layout_top');?>




<div class="circle-header">
	<div class="wrapper">
		<div class="collection-logo">
			<a href="<?php echo SHOP_SITE_URL;?>"><img src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_COMMON.DS.C('member_logo'); ?>"/></a>
			<h2 class="collogo-text">个人主页</h2>
		</div>
		
		<div class="home-sp search-panel">



			<form id="formSearch" name="formSearch" action="index.php" method="get">
			<input id="search_act" type="hidden" value="search" name="act">
			<div class="search-input-wrap">
				<input type="text" id="keyword" name="keyword" lang="zh-CN" x-webkit-grammar="builtin:search" onwebkitspeechchange="foo()" x-webkit-speech=""  placeholder="请输入关键字" class="input-search"/>
				<input type="button" id="" value="搜索" class="input-submit" nctype="search_in_shop" onClick="$('#formSearch').submit();">
			</div>			
			</form>
		</div>
		
		<div class="personage-nav clearfix">
		<div class="hui-select">
				<a href="/circle/">
					<p>返回社区</p>
				</a>				
			</div>	
			<div class="hui-select">
				<a href="<?php echo urlShop('member', 'home');?>">
					<p>返回我的商城</p>
				</a>				
			</div>				
			<div class="hui-select">
				<a href="" target="_blank">
					<p>我关注的</p>
				</a>
				<i class="icon-hui"></i>
		
				<div class="no-cercle">
				 <?php if(!empty($output['my_attention'])){ ?>
					<?php foreach($output['my_attention'] as $val){ ?>
					<a href="index.php?act=member_snshome&mid=<?php echo $val['friend_tomid'];?>" target="_blank"><img src="<?php if ($val['friend_tomavatar']!='') { echo UPLOAD_SITE_URL.'/'.ATTACH_AVATAR.DS.$val['friend_tomavatar']; } else { echo UPLOAD_SITE_URL.'/'.ATTACH_COMMON.DS.$output['setting_config']['default_user_portrait']; } ?>" width="15px" height="15px"/><?php echo $val['friend_tomname']?></a>
					<?php }?>
					<?php }else{?>
						<a href="javascript:void(0);"><?php echo $lang['sns_no_attention_tips'];?></a>
					<?php }?>

					<?php if(!empty($output['my_attention'])){?>
					<a href="index.php?act=member_snsfriend&op=follow"><?php echo $lang['sns_attention_more'];?></a>
					<?php }else{?>
					<a href="index.php?act=member_snsfriend&op=find"><?php echo $lang['sns_search_friend'];?></a>
					<?php }?>
				</div>
				 
				
			</div>		
			<div class="hui-select">
				<a href="index.php?act=member_snshome" target="_blank">
					<p>我的个人主页</p>
				</a>				
			</div>	
		</div>
	
	</div>
</div>

<div class="wrapper dfclearfix mt-small">
	<div class="user_card dfclearfix">
		<div class="user-card-bj dfclearfix"><img src="<?php echo SHOP_TEMPLATES_URL;?>/sns/style/skin01/body_bg.jpg"></div>
		<div class="cardimg">
			<img src="<?php if ($output['master_info']['member_avatar']!='') { echo UPLOAD_SITE_URL.'/'.ATTACH_AVATAR.DS.$output['master_info']['member_avatar']; } else { echo UPLOAD_SITE_URL.'/'.ATTACH_COMMON.DS.C('default_user_portrait'); } ?>">
		</div>
		
		<div class="head-line">
			<h2><?php echo !empty($output['master_info']['member_truename'])?$output['master_info']['member_truename']:$output['master_info']['member_name'];?></h2>

		<span style="<?php if($output['relation'] != 2){?>display:none;<?php }?>" nc_type="mutualsign"><?php echo $lang['sns_mutual_attention'];?></span><span style="<?php if($output['relation'] != 4){?>display:none;<?php }?>" nc_type="followsign"><?php echo $lang['sns_already_attention'];?></span>

        <?php if($output['relation'] == 1){?>
        <a data-param='{"mid":"<?php echo $output['master_info']['member_id'];?>"}' nc_type="followbtn" href="javascript:void(0)"><?php echo $lang['sns_add_attention'];?></a>
        <?php }?>




			<div class="introduction">
				<?php if($output['master_info']['member_sex'] ==1 ){?>
				<p><?php echo $lang['sns_man'];?></p>
				<?php }else if($output['master_info']['member_sex'] == 2){?>
				<p><?php echo $lang['sns_woman'];?></p>
				<?php }?>
				<p><?php echo $output['master_info']['member_areainfo'];?></p>
				<?php if(!empty($output['master_info']['tagname'])){?>
				<p><?php echo $lang['sns_interest_label'].$lang['nc_colon'];?>
				<?php foreach ($output['master_info']['tagname'] as $val){?>
				<em><?php echo $val;?></em>
				<?php }?>
				</p>
				<?php }?>
				<?php if ($output['relation'] == '3'){?>
				<p><a href="index.php?act=member_information&op=member" title="<?php echo $lang['sns_edit_data'];?>"><?php echo $lang['sns_edit_data'];?></a></p>
				<?php }?>
			</div>
		</div>
		
		<div class="counts dfclearfix">
			<a class="followers">
				<div class="sub">粉丝</div>
				<div class="num"><?php echo $output['master_info']['fan_count'];?></div>
			</a>
			<a class="followers">
				<div class="sub">关注</div>
				<div class="num"><?php echo $output['master_info']['attention_count'];?></div>
			</a>
			<a class="followers">
				<div class="sub">访问</div>
				<div class="num"><?php echo $output['master_info']['member_snsvisitnum'];?></div>
			</a>			
		</div>
	</div>
	<div class="oneself-nav dfclearfix">
		<ul>

		<li><a <?php if($output['menu_sign'] == 'snshome'){?>class="on"<?php }?> href="index.php?act=member_snshome<?php if(!empty($output['master_id'])){ echo '&mid='.$output['master_id']; }?>"><?php echo $lang['nc_index'];?></a></li>
      <li><a <?php if($output['menu_sign'] == 'sharegoods'){?>class="on"<?php }?> href="index.php?act=member_snshome&op=shareglist<?php if(!empty($output['master_id'])){ echo '&mid='.$output['master_id']; }?>"><?php echo $lang['sns_treasure'];?></a></li>
      <li><a <?php if($output['menu_sign'] == 'sharestore'){?>class="on"<?php }?> href="index.php?act=member_snshome&op=storelist<?php if(!empty($output['master_id'])){ echo '&mid='.$output['master_id']; }?>"><?php echo $lang['sns_store'];?></a></li>
      <li><a <?php if($output['menu_sign'] == 'snsalbum'){?>class="on"<?php }?> href="index.php?act=sns_album<?php if(!empty($output['master_id'])){ echo '&mid='.$output['master_id']; }?>"><?php echo $lang['sns_album'];?></a></li>
      <li><a <?php if($output['menu_sign'] == 'snstrace'){?>class="on"<?php }?> href="index.php?act=member_snshome&op=trace<?php if(!empty($output['master_id'])){ echo '&mid='.$output['master_id']; }?>"><?php echo $lang['sns_fresh_news'];?></a></li>
      <?php if(intval(C('circle_isuse'))){?>
      <li><a <?php if($output['menu_sign'] == 'circle'){?>class="on"<?php }?> href="index.php?act=sns_circle<?php if(!empty($output['master_id'])){ echo '&mid='.$output['master_id']; }?>"><?php echo $lang['sns_group'];?></a></li>
      <?php }?>
		<?php if($output['relation'] == '3'){?>
		<!--
			<li> <a href="javascript:void(0)" title="<?php echo $lang['sns_change_skin'];?>" class="pngFix" nctype="change_skin"><?php echo $lang['sns_change_skin'];?></a></li>
			-->
		<?php }?>
		</ul>
		
	</div>
</div>



<div class="wrapper">

    <?php
		require_once($tpl_file);
		?>
  </div>

  <!-- 表情弹出层 -->
  <div id="smilies_div" class="smilies-module"></div>

<?php
require_once template('footer');
?>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.ajaxContent.pack.js" ></script> 
<script type="text/javascript" language="javascript">
var max_recordnum = '<?php echo $output['max_recordnum'];?>';

$(function(){
	// 显示关注好友名单
  $(".my-friend").click(function(){
    $(".friend-menu").slideToggle("1000");
  });

	//存在多规格时的价格修改
	$('a[nctype="change_skin"]').click(function(){
		ajax_form('change_skin', '<?php echo $lang['sns_change_skin'];?>', SITEURL + '/index.php?act=sns_setting&op=change_skin', '480');
	});
});
</script>
</body>
</html>
