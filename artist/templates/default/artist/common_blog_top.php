<?php defined('InShopNC') or exit('Access Invalid!');?>



<div class="blogs-head" style="background: url(/<?php echo $output['topimg'];?>) no-repeat center top;">
	<div class="blogs-navigation">
	  <div class="navigation wrapper">
	     <ul>
	       <li <?php if($_GET['op'] == 'index'){echo 'class=\'now\'';}?> ><a href="<?php echo urlArtist('artist_blog','index',array('aid'=>$output['aid']));?>">首页</a></li>
	       <li <?php if($_GET['op'] == 'jianjie'){echo 'class=\'now\'';}?> ><a href="<?php echo urlArtist('artist_blog','jianjie',array('aid'=>$output['aid']));?>">个人简介</a></li>
	       <li <?php if($_GET['op'] == 'xiangce'){echo 'class=\'now\'';}?> ><a href="<?php echo urlArtist('artist_blog','xiangce',array('aid'=>$output['aid']));?>">艺术相册</a></li>
	       <li <?php if($_GET['op'] == 'zixun'){echo 'class=\'now\'';}?> ><a href="<?php echo urlArtist('artist_blog','zixun',array('aid'=>$output['aid']));?>">艺术资讯</a></li>
	       <li <?php if($_GET['op'] == 'zuoping'){echo 'class=\'now\'';}?> ><a href="<?php echo urlArtist('artist_blog','zuoping',array('aid'=>$output['aid']));?>">艺术作品</a></li>
	       <li <?php if($_GET['op'] == 'liuyan'){echo 'class=\'now\'';}?> ><a href="<?php echo urlArtist('artist_blog','liuyan',array('aid'=>$output['aid']));?>">留言板</a></li>
	     </ul>
	   <ol>
	     <li><a href="JavaScript:void(0);" title="在线咨询" onclick="NTKF.im_openInPageChat('sc_1022_9999')"><i class="interaction-icon1"></i><strong>在线咨询</strong></a></li>
	     <li><a href="javascript:isDianZan(<?php echo $output['aid'];?>,'zan');"><i class="interaction-icon2"></i><strong>点赞&nbsp;&nbsp;<em id="ZanCountZZ"><?php echo $output['artist_zan_count'];?></em></strong></a></li>
	     <li><a href="javascript:isDianZan(<?php echo $output['aid'];?>,'cang');"><i class="interaction-icon3"></i><strong id="ShouCangDD">收藏</strong></a></li>
	   </ol>
	  </div>
	</div>	
</div>


<script>
	
function isDianZan(aid,type){
	$.ajax({

        url:"<?php echo urlArtist('artist_blog','isZan_Cang');?>",
        type:"POST",
        data:{aid:aid,type:type},
        cache:false,
        dateType:'json',
        success:function(data){
            switch(data)
            {
                case '1':
					if(type == 'zan'){
                		$("#ZanCountZZ").html(parseInt($("#ZanCountZZ").html())+parseInt(1));
                	}
                    alert('操作成功');
                    break;
                case '11':
                    alert('未登录、请在登录状态下操作！');
                    break;
                case '22':
                    alert('操作失败、请重新操作！');
                    break;
                case '33':
                	if(type == 'zan'){
                		alert('您已点过赞！');
                	}else{
                		alert('您已收藏！');
                	}
                    break;
                case '44':
                    alert('请稍后操作！');
                    break;
            }
            
        }

    });

}

</script>