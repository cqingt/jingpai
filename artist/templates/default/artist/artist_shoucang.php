<?php defined('InShopNC') or exit('Access Invalid!');?>


<div class="wrapper">
  <ol class="art-breadcrumb">
    <li><a href="">我的收藏</a></li>
  </ol>
    <ul class="art-batch">
      <li><i id="all">全选</i></li>
      <li><i id="delete">删除</i></li>
    </ul>
    <i class="batch-manage">批量管理</i>
</div>

<div class="wrapper">
    <ul class="celebrity one">
      <?php if(!empty($output['artist_list'])){?>
    
        <?php foreach ($output['artist_list'] as $k => $v) {?>

            <li  data-id="<?php echo $v['C_Id'];?>">
              <a href="<?php echo urlArtist('artist_blog','index',array('aid'=>$v['A_Id']));?>" target="_blank">
                 <div class="celimg">
                  <img src="<?php echo BASE_SITE_URL.'/'.$v['A_Img'];?>"/>
                 </div>
                 <h2><?php echo $v['A_Name'];?></h2>
              <p><?php $zhi = explode('|',$v['A_ZhiCheng']);echo reset($zhi);?></p>
			  
              </a>
              <a href="JavaScript:void(0);" title="在线联系" onclick="NTKF.im_openInPageChat('sc_1022_9999')">
			  <i class="btn icon-chat"></i>
              </a>
              <i class="art-remove"></i>
            </li>

          <?php }?>

      <?php }?>                                                                          
    </ul>
    
    <div class="pagination ptb29">
      <?php echo $output['show_page'];?>
    </div>

</div>

<script>
  $(function(){
    function tabs(tabTit,on,tabCon){
        $(tabCon).each(function(){
            $(this).children().eq(0).show();

        });
        $(tabTit).each(function(){
            $(this).children().eq(0).addClass(on);
        });
        $(tabTit).children().hover(function(){
            $(this).addClass(on).siblings().removeClass(on);
            var index = $(tabTit).children().index(this);
            $(tabCon).children().eq(index).show().siblings().hide();
        });
    }
    tabs(".handover_title","on",".handover_con");

})

//边距 
$(function(){
  $('.collect-list').find("li:lt(6)").addClass('small');
  $('.collect-list li:last-child').addClass('last');
  $('.works-list1 li:nth-child(5n+1)').css('margin','0')
  $('.consult.home li:nth-child(2n+1)').css('margin','0')
  $('.product-display:nth-child(5n+1)').css('margin-left','0')
})

//删除 以及批量管理 我的收藏
$(function(){
  // $('.celebrity.one li a').after('<i class="art-remove"></i>');
  $(".art-remove").click(function(){  
    var obj = $(this);
    var id = $(this).parent().attr('data-id');

    $.post("<?php echo urlArtist('artist_new','delShoucang')?>",{'id':id},function(data){
      if(data.state){
        obj.closest('li').remove();
      }else{
        alert(data.msg);
      }
    },'json');

  }) 
  
  $(".batch-manage").click(function(){   
       $('.celebrity.one li a').after('<i class="art-all"></i>');
       $('.art-remove').remove()
       $('.art-batch').show();
       $('.batch-manage').html('取消管理');             
  }) 


  $("#all").click(function(){ 
     $('.celebrity.one li a').after('<i class="art-all-ok"></i>');
     $('.art-all').remove()
  })  

  $("#delete").click(function(){

      var del_id = [];

      $('ul li').children('.art-all-ok').addClass('art-all-del-ok');

      var obj = $('ul li').children('.art-all-ok').parent().each(function(){

        del_id.push($(this).attr('data-id'));

      });


      $.post("<?php echo urlArtist('artist_new','delShoucangAll')?>",{'del_id':del_id},function(data){
        if(data.state){
          $('ul li').children('.art-all-ok').parent().remove();
        }else{
          alert(data.msg);
        }
      },'json');

      
  }) 
  

})


</script>