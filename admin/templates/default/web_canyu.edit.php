

<?php defined('InShopNC') or exit('Access Invalid!');?>
<link href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<style type="text/css">
h3.dialog_head {
	margin: 0 !important;
}
.dialog_content {
	width: 610px;
	padding: 0 15px 15px 15px !important;
	overflow: hidden;
}

.home-everyone-logo {
    margin-top: 16px;
    height: 176px;
    border: 1px #ededed solid;
    overflow: hidden;
}
.home-everyone-logo .everyone-l,
.home-everyone-logo .everyone-r {
	float: left;
	overflow: hidden;
}
.home-everyone-logo .everyone-l a,
.home-everyone-logo .everyone-r a {
	float: left;
	display: block;
    transition: .2s;
    -moz-transition: .2s;
    -webkit-transition: .2s;
    -o-transition: .2s;
}
.home-everyone-logo .everyone-l a:first-child {
	border-right: 1px #ededed solid;
}
.home-everyone-logo .everyone-l {
	width: 604px; 
}
.home-everyone-logo .everyone-r {
	width: 578px;
}
.home-everyone-logo .everyone-r a {
	position: relative;
	border-left: 1px #ededed solid;
	border-bottom: 1px #ededed solid;
	width: 143px;
	height: 58px;
	overflow: hidden;
}
.home-everyone-logo .everyone-l a:hover {
    filter: Alpha(Opacity=.6);
    opacity: .6;
}
.home-everyone-logo  .instructions-box {
	position: absolute;
	top: 0;
	left: 0;
	height: 58px;
}
.home-everyone-logo  .instructions-box .ins-opacity {
	height: 58px;
	width: 100%;
	width: 148px;
	background: #000;
    filter: Alpha(Opacity=0);
    opacity: 0;
    transition: .2s;
    -moz-transition: .2s;
    -webkit-transition: .2s;
    -o-transition: .2s;
}
.home-everyone-logo  .instructions-box p {
	position: absolute;
	top: 0;
	left: 0;
	text-align: center;
	padding: 12px 30px;
	font-size: 12px;
	line-height: 18px;	
	height: 36px;
	overflow: hidden;
	color: #fff;
    filter: Alpha(Opacity=0);
    opacity: 0;
}
.home-everyone-logo  .instructions-box p strong {
	display: block;
}
.home-everyone-logo  .instructions-box:hover .ins-opacity {
    filter: Alpha(Opacity=.7);
    opacity: .7;	
}
.home-everyone-logo  .instructions-box:hover p {
    filter: Alpha(Opacity=1);
    opacity: 1;	
}
</style>

<script type="text/javascript">
var SHOP_SITE_URL = "<?php echo SHOP_SITE_URL; ?>";
var UPLOAD_SITE_URL = "<?php echo UPLOAD_SITE_URL; ?>";
</script>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['web_config_index'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=web_config&op=web_config"><span><?php echo '板块区';?></span></a></li>
        <li><a href="index.php?act=web_api&op=focus_edit"><span><?php echo '焦点区';?></span></a></li>
        <li><a href="index.php?act=web_api&op=sale_edit"><span><?php echo '促销区';?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo '值得参与';?></span></a></li>
      </ul>
    </div>
  </div>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title"><h5><?php echo $lang['nc_prompts'];?></h5><span class="arrow"></span></div></th>
      </tr>
    </tbody>
  </table>
  <div class="middle">
  <table class="table tb-type2 nohover">
    <tbody>
      <tr class="noborder">
        <td colspan="2" class="vatop"><div class="home-templates-board-layout1 style-<?php echo $output['web_array']['style_name'];?>">
          <div class="middle1" style="height: 630px;">
              <div><?php if (is_array($output['code_recommend_list']['code_info']) && !empty($output['code_recommend_list']['code_info'])) { ?>
              <?php foreach ($output['code_recommend_list']['code_info'] as $key => $val) { ?>
              <dl recommend_id="<?php echo $key;?>">
                <dt>
                  <h4><?php echo $val['recommend']['name'];?></h4>
                  <a href="JavaScript:show_recommend_pic_dialog1(<?php echo $key;?>);"><i class="icon-lightbulb"></i><?php echo '广告块';?></a>
                  </dt>
                <dd>
                    <?php if(!empty($val['goods_list']) && is_array($val['goods_list'])) { ?>
                    <ul class="goods-list">
                        <?php foreach($val['goods_list'] as $k => $v) { ?>
                        <li><span><a href="javascript:void(0);">
                            <img title="<?php echo $v['goods_name'];?>" src="<?php echo strpos($v['goods_pic'],'http')===0 ? $v['goods_pic']:UPLOAD_SITE_URL."/".$v['goods_pic'];?>"/></a></span>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } elseif (!empty($val['pic_list']) && is_array($val['pic_list'])) { ?>
                        <div class="middle-banner">
                            <a href="javascript:void(0);" class="left-a"><img pic_url="<?php echo $val['pic_list']['11']['pic_url'];?>" title="<?php echo $val['pic_list']['11']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['11']['pic_img'];?>"/></a>
                           

                            <a href="javascript:void(0);" class="left-b"><img pic_url="<?php echo $val['pic_list']['12']['pic_url'];?>" title="<?php echo $val['pic_list']['12']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['12']['pic_img'];?>"/></a>
                            
                            <a href="javascript:void(0);" class="middle-a"><img pic_url="<?php echo $val['pic_list']['14']['pic_url'];?>" title="<?php echo $val['pic_list']['14']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['14']['pic_img'];?>"/></a>
                             
                            <a href="javascript:void(0);" class="right-a"><img pic_url="<?php echo $val['pic_list']['21']['pic_url'];?>" title="<?php echo $val['pic_list']['21']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['21']['pic_img'];?>"/></a>
                            
                            <a href="javascript:void(0);" class="right-b"><img pic_url="<?php echo $val['pic_list']['24']['pic_url'];?>" title="<?php echo $val['pic_list']['24']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['24']['pic_img'];?>"/></a>
                            
                            <a href="javascript:void(0);" class="bottom-a"><img pic_url="<?php echo $val['pic_list']['31']['pic_url'];?>" title="<?php echo $val['pic_list']['31']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['31']['pic_img'];?>"/></a>
                            
                            <a href="javascript:void(0);" class="bottom-b"><img pic_url="<?php echo $val['pic_list']['32']['pic_url'];?>" title="<?php echo $val['pic_list']['32']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['32']['pic_img'];?>"/></a>

                            <a href="javascript:void(0);" class="bottom-c"><img pic_url="<?php echo $val['pic_list']['33']['pic_url'];?>" title="<?php echo $val['pic_list']['33']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['33']['pic_img'];?>"/></a>
                             <!--
                            <a href="javascript:void(0);" class="bottom-d"><img pic_url="<?php echo $val['pic_list']['34']['pic_url'];?>" title="<?php echo $val['pic_list']['34']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['34']['pic_img'];?>"/></a>
                            -->
                        </div>
		<div class="home-everyone-logo wrapper">
			<div class="everyone-l">
				<a href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['34']['pic_url'];?>" title="<?php echo $val['pic_list']['34']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['34']['pic_img'];?>"/></a>
				<a href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['35']['pic_url'];?>" title="<?php echo $val['pic_list']['35']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['35']['pic_img'];?>"/></a>
			</div>
			<div class="everyone-r">
				<a href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['36']['pic_url'];?>" title="<?php echo $val['pic_list']['36']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['36']['pic_img'];?>"/></a>

				<a href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['37']['pic_url'];?>" title="<?php echo $val['pic_list']['37']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['37']['pic_img'];?>"/></a>

				<a href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['38']['pic_url'];?>" title="<?php echo $val['pic_list']['38']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['38']['pic_img'];?>"/></a>
				
							<a href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['39']['pic_url'];?>" title="<?php echo $val['pic_list']['39']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['39']['pic_img'];?>"/></a>
								<a href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['40']['pic_url'];?>" title="<?php echo $val['pic_list']['40']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['40']['pic_img'];?>"/></a>

									<a href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['41']['pic_url'];?>" title="<?php echo $val['pic_list']['41']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['41']['pic_img'];?>"/></a>
									<a href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['42']['pic_url'];?>" title="<?php echo $val['pic_list']['42']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['42']['pic_img'];?>"/></a>
									<a href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['43']['pic_url'];?>" title="<?php echo $val['pic_list']['43']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['43']['pic_img'];?>"/></a>

									<a href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['44']['pic_url'];?>" title="<?php echo $val['pic_list']['44']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['44']['pic_img'];?>"/></a>
										<a href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['45']['pic_url'];?>" title="<?php echo $val['pic_list']['45']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['45']['pic_img'];?>"/></a>
										<a href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['46']['pic_url'];?>" title="<?php echo $val['pic_list']['46']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['46']['pic_img'];?>"/></a>
										<a href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['47']['pic_url'];?>" title="<?php echo $val['pic_list']['47']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['47']['pic_img'];?>"/></a>
			</div>
		</div>
                    <?php }else { ?>
                    <ul class="goods-list">
                        <li><span><i class="icon-gift"></i></span></li>
                        <li><span><i class="icon-gift"></i></span></li>
                        <li><span><i class="icon-gift"></i></span></li>
                        <li><span><i class="icon-gift"></i></span></li>
                        <li><span><i class="icon-gift"></i></span></li>
                        <li><span><i class="icon-gift"></i></span></li>
                        <li><span><i class="icon-gift"></i></span></li>
                        <li><span><i class="icon-gift"></i></span></li>
                    </ul>
                    <?php } ?>
                </dd>
              </dl>
              <?php } ?>
              <?php } ?>
              </div>
            </div>
          </div></td>
      </tr>
    </tbody>
    <tfoot>
        <tr class="tfoot">
          <td colspan="2" ><a href="index.php?act=web_config&op=web_html&web_id=<?php echo $_GET['web_id'];?>" class="btn" id="submitBtn"><span><?php echo $lang['web_config_web_html'];?></span></a></td>
        </tr>
      </tfoot>
  </table>
  </div>
</div>

<!-- 中部推荐图片 -->
<div id="recommend_pic_dialog" style="display:none;">
  <form id="recommend_pic_form" name="recommend_pic_form" enctype="multipart/form-data" method="post" action="index.php?act=web_api&op=recommend_pic&sw=1" target="upload_pic">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="web_id" value="<?php echo $output['code_recommend_list']['web_id'];?>">
    <input type="hidden" name="code_id" value="<?php echo $output['code_recommend_list']['code_id'];?>">
    <input type="hidden" name="key_id" value="">
    <input type="hidden" name="pic_id" value="">
        <dl>
          <dt>
            <h4 class="dialog-handle-title"><?php echo '值得参与名称';?></h4>
            <div class="dialog-handle-box"><span class="left">
              <input name="recommend_list[recommend][name]" value="" type="text" class="w200">
              </span><span class="right"><?php echo ' 修改该区域中部推荐模块选项卡名称，控制名称字符在4-8字左右，超出范围自动隐藏';?></span>
              <div class="clear"></div>
            </div>
          </dt>
        </dl>
        <div class="s-tips"><i></i><?php echo '单击左侧编号选中对应的位置，在右侧上传和修改图片信息。';?></div>
    	<table class="">
            <tr>
              <td id="add_recommend_pic">
            <?php if (is_array($output['code_recommend_list']['code_info']) && !empty($output['code_recommend_list']['code_info'])) { ?>
            <?php foreach ($output['code_recommend_list']['code_info'] as $key => $val) { ?>
            <?php if (!empty($val['pic_list']) && is_array($val['pic_list'])) { ?>
<style>
				.eachphoto {
	background:red;
	width: 50px;
	height: 30px;
	overflow: hidden;
	border: 1px #000 solid;
	float: left;
	position: relative !important;
}
.eachphoto1 {
	width: 154px !important;
	float: left;
	top: 100px;
}
.eachphoto2 {
	top: 100px;
}
.eachphoto3 {
	top: 100px;
}

.each-clear {
	clear: both;	
}
.eachphoto img{
	max-width: 64px;
    max-height: 50px;
}
</style>
                <div select_recommend_pic_id="<?php echo $key;?>" class="middle-banner1" style="height: 160px;">
                        <a recommend_pic_id="11" href="javascript:void(0);" class="left-a"><img pic_url="<?php echo $val['pic_list']['11']['pic_url'];?>" title="<?php echo $val['pic_list']['11']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['11']['pic_img'];?>"/></a>
                        <a recommend_pic_id="12" href="javascript:void(0);" class="left-b"><img pic_url="<?php echo $val['pic_list']['12']['pic_url'];?>" title="<?php echo $val['pic_list']['12']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['12']['pic_img'];?>"/></a>
                        <a recommend_pic_id="14" href="javascript:void(0);" class="middle-a"><img pic_url="<?php echo $val['pic_list']['14']['pic_url'];?>" title="<?php echo $val['pic_list']['14']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['14']['pic_img'];?>"/></a>
                        
                        
                        <a recommend_pic_id="21" href="javascript:void(0);" class="right-a"><img pic_url="<?php echo $val['pic_list']['21']['pic_url'];?>" title="<?php echo $val['pic_list']['21']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['21']['pic_img'];?>"/></a>
                        <a recommend_pic_id="24" href="javascript:void(0);" class="right-b"><img pic_url="<?php echo $val['pic_list']['24']['pic_url'];?>" title="<?php echo $val['pic_list']['24']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['24']['pic_img'];?>"/></a>
                        
                        <a recommend_pic_id="31" href="javascript:void(0);" class="bottom-a"><img pic_url="<?php echo $val['pic_list']['31']['pic_url'];?>" title="<?php echo $val['pic_list']['31']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['31']['pic_img'];?>"/></a>
                        
                        <a recommend_pic_id="32" href="javascript:void(0);" class="bottom-b"><img pic_url="<?php echo $val['pic_list']['32']['pic_url'];?>" title="<?php echo $val['pic_list']['32']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['32']['pic_img'];?>"/></a>
                        <a recommend_pic_id="33" href="javascript:void(0);" class="bottom-c"><img pic_url="<?php echo $val['pic_list']['33']['pic_url'];?>" title="<?php echo $val['pic_list']['33']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['33']['pic_img'];?>"/></a>

				<a recommend_pic_id="34" class="eachphoto eachphoto1" href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['34']['pic_url'];?>" title="<?php echo $val['pic_list']['34']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['34']['pic_img'];?>"/></a>
				<a recommend_pic_id="35" class="eachphoto eachphoto1" href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['35']['pic_url'];?>" title="<?php echo $val['pic_list']['35']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['35']['pic_img'];?>"/></a>
				<a recommend_pic_id="36" class="eachphoto eachphoto2" href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['36']['pic_url'];?>" title="<?php echo $val['pic_list']['36']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['36']['pic_img'];?>"/></a>
				<a recommend_pic_id="37" class="eachphoto eachphoto2" href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['37']['pic_url'];?>" title="<?php echo $val['pic_list']['37']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['37']['pic_img'];?>"/></a>
				<a recommend_pic_id="38" class="eachphoto eachphoto2" href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['38']['pic_url'];?>" title="<?php echo $val['pic_list']['38']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['38']['pic_img'];?>"/></a>
				<a recommend_pic_id="39" class="eachphoto eachphoto2" href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['39']['pic_url'];?>" title="<?php echo $val['pic_list']['39']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['39']['pic_img'];?>"/></a>		
				<a recommend_pic_id="40" class="eachphoto eachphoto2" href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['40']['pic_url'];?>" title="<?php echo $val['pic_list']['40']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['40']['pic_img'];?>"/></a>
				<a recommend_pic_id="41" class="eachphoto eachphoto2" href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['41']['pic_url'];?>" title="<?php echo $val['pic_list']['41']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['41']['pic_img'];?>"/></a>				
				<a recommend_pic_id="42" class="eachphoto eachphoto3" href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['42']['pic_url'];?>" title="<?php echo $val['pic_list']['42']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['42']['pic_img'];?>"/></a>				
				<a recommend_pic_id="43" class="eachphoto eachphoto3" href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['43']['pic_url'];?>" title="<?php echo $val['pic_list']['43']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['43']['pic_img'];?>"/></a>
				<a recommend_pic_id="44" class="eachphoto eachphoto3" href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['44']['pic_url'];?>" title="<?php echo $val['pic_list']['44']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['44']['pic_img'];?>"/></a>				
				<a recommend_pic_id="45" class="eachphoto eachphoto3" href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['45']['pic_url'];?>" title="<?php echo $val['pic_list']['45']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['45']['pic_img'];?>"/></a>				
				<a recommend_pic_id="46" class="eachphoto eachphoto3" href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['46']['pic_url'];?>" title="<?php echo $val['pic_list']['46']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['46']['pic_img'];?>"/></a>				
				<a recommend_pic_id="47" class="eachphoto eachphoto3" href="javascript:void(0);" ><img pic_url="<?php echo $val['pic_list']['47']['pic_url'];?>" title="<?php echo $val['pic_list']['47']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['47']['pic_img'];?>"/></a>

			
				
				

 
                        <!--
                        <a recommend_pic_id="34" href="javascript:void(0);" class="bottom-d"><img pic_url="<?php echo $val['pic_list']['34']['pic_url'];?>" title="<?php echo $val['pic_list']['34']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['34']['pic_img'];?>"/></a>
                        -->
                        
            	</div>
            <?php } ?>
            <?php } ?>
            <?php } ?>
    	      </td>
              <td>
            	 <table class="table tb-type2">
            	   <tbody>
                    <tr>
                      <td><?php echo '文字标题'.$lang['nc_colon'];?></td>
                    </tr>
                    <tr class="noborder">
                      <td class="vatop rowform">
                      	<input class="txt" type="text" name="pic_list[pic_name]" value="">
                      	</td>
                    </tr>
                    <tr>
                      <td><?php echo '跳转链接'.$lang['nc_colon'];?></td>
                    </tr>
                    <tr class="noborder">
                      <td class="vatop rowform">
                      	<input class="txt" type="text" name="pic_list[pic_url]" value="<?php echo SHOP_SITE_URL;?>">
                      	</td>
                    </tr>
                    <tr>
                      <td><?php echo '图片上传'.$lang['nc_colon'];?></td>
                    </tr>
                    <tr class="noborder">
                      <td class="vatop rowform"><span class="type-file-box">
                        <input type='text' name='textfield' id='textfield1' value='' class='type-file-text' />
                        <input type='button' name='button' id='button1' value='' class='type-file-button' />
                        <input name="pic" id="pic" type="file" class="type-file-file" value='' size="30">
                        </span></td>
                    </tr>
                  </tbody>
                  <tfoot>
                    <tr class="tfoot">
                      <td colspan="15" ><a href="JavaScript:void(0);" onclick="$('#recommend_pic_form').submit();" class="btn"><span><?php echo $lang['web_config_save'];?></span></a></td>
                    </tr>
                  </tfoot>
                </table>
              </td>
            </tr>
        </table>
  </form>
</div>
<iframe style="display:none;" src="" name="upload_pic"></iframe>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.ajaxContent.pack.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.mousewheel.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/waypoints.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/web_config/web_index.js"></script>
