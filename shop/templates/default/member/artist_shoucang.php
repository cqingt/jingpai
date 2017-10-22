<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="wrap">
  <div class="tabmenu">
    <?php include template('layout/submenu');?>
  </div>
  <table class="ncm-default-table">
    
    <tbody>
      <?php if(!empty($output['artist_list']) && is_array($output['artist_list'])){ ?>
      <tr>
        <td colspan="2" class="pic-model"><ul>
            <?php foreach($output['artist_list'] as $key=>$favorites){?>
            <li class="favorite-pic-list">
              <div class="favorite-goods-thumb"><a href="/artist/index.php?act=artist_blog&op=index&aid=<?php echo $favorites['A_Id'];?>" target="_blank"><img src="<?php echo BASE_SITE_URL.'/'.$favorites['A_Img'];?>" /></a></div>
              <div class="favorite-goods-info">
                <dl>
                  <dt>
                  <a href="/artist/index.php?act=artist_blog&op=index&aid=<?php echo $favorites['A_Id'];?>" target="_blank"><?php echo $favorites['A_Name'];?></a></dt>

                  <dd><span><?php $zhi = explode('|',$favorites['A_ZhiCheng']);echo reset($zhi);?></span><a href="javascript:void(0)" onclick="ajax_get_confirm('<?php echo $lang['nc_ensure_del'];?>', 'index.php?act=member_favorites&op=delShoucang&id=<?php echo $favorites['C_Id'];?>');" class="ncm-btn-mini" title="<?php echo $lang['nc_del'];?>"><?php echo $lang['nc_del'];?></a></dd>
                  </dd>
                </dl>
              </div>
            </li>
            <?php }?>
          </ul></td>
      </tr>
      <?php }else{?>
      <tr>
        <td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record'];?></span></div></td>
      </tr>
      <?php }?>
    </tbody>
    <tfoot>
      <?php if(!empty($output['favorites_list']) && is_array($output['favorites_list'])){?>
      <tr>
        <td colspan="20"><div class="pagination"><?php echo $output['show_page']; ?></div></td>
      </tr>
      <?php }?>
    </tfoot>
  </table>
  
  <!-- 猜你喜欢 -->
  <div id="guesslike_div" style="width:980px;"></div>
  
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/sns.js" charset="utf-8"></script> 
<script>
//鼠标经过弹出图片信息
$(document).ready(function() {
	$(".favorite-pic-list div").hover(function() {
		$(this).animate({
			"top": "-40px"
		},
		400, "swing");
	},
	function() {
		$(this).stop(true, false).animate({
			"top": "0"
		},
		400, "swing");
	});

	//猜你喜欢
	$('#guesslike_div').load('<?php echo urlShop('search', 'get_guesslike', array()); ?>', function(){
        $(this).show();
    });
});
</script> 
