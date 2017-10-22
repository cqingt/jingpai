<?php defined('InShopNC') or exit('Access Invalid!');?>

<div class="rightcircle-large clearfix mt">
		
		<div class="chitchat-box clearfix mb">
			<ul class="chitchat-nav handover_title">
				<li class="on" nc_type="visitmodule" data-param='{"name":"visit_me"}'><?php echo $lang['sns_visit_me']; if ($output['relation'] == 3){echo $lang['sns_me']; }else {echo 'TA';}?></li>
				<li nc_type="visitmodule" data-param='{"name":"visit_other"}'><?php if ($output['relation'] == 3){echo $lang['sns_me']; }else {echo 'TA';} echo $lang['sns_visit_other'];?></li>
			</ul>
			<div class="chitchat-con handover_con">
				<div class="demo">	

					<ul class="visitor-list" id="visit_me" nc_type="visitlist">
					
      <?php if (!empty($output['visitme_list'])){?>
      <?php foreach ($output['visitme_list'] as $k=>$v){?>
						<li style="margin-left: 0px;">
							<a href="index.php?act=member_snshome&mid=<?php echo $v['v_mid'];?>" target="_blank" data-param="{'id':<?php echo $v['v_mid'];?>}" nctype="mcard">
								<div class="img">
									<img src="<?php echo getMemberAvatarForID($v['v_mid']); ?>">
								</div>
							    <p><?php echo $v['v_mname'];?></p>
							</a>
						</li>
						<?php }?>
		 <?php }else {?>
      <?php echo $lang['sns_visitme_tip_1'];?><a href="index.php?act=member_snsfriend&op=find"><?php echo $lang['sns_visitme_tip_2'];?></a><?php echo $lang['sns_visitme_tip_3'];?>
      <?php }?>		  
     	
					</ul>

<?php if($output['relation'] == 3){?>
                        		<ul id="visit_other" nc_type="visitlist" style="display: none;">
         <?php if (!empty($output['visitother_list'])){?>
      <?php foreach ($output['visitother_list'] as $k=>$v){?>
                        			<li class="pl-list clearfix"> 
                        				<div class="pl-list-avator">
                        					<a href="index.php?act=member_snshome&mid=<?php echo $v['v_ownermid'];?>" target="_blank">
                        						<img src="<?php echo getMemberAvatarForID($v['v_ownermid']);?>" title="leo_tc">
                        					</a> 
                        				</div> 
                        				<div class="pl-list-main"> 
                        					<div class="pl-list-nick"> 
                        						<a href="index.php?act=member_snshome&mid=<?php echo $v['v_ownermid'];?>" target="_blank" data-param="{'id':<?php echo $v['v_ownermid'];?>}" nctype="mcard"><?php echo $v['v_ownermname'];?></a> 
                        					</div> 
                        					<div class="pl-list-content"></div>  
                        					<div class="pl-list-btm clearfix"> 
                        						<span class="pl-list-time l">时间: <?php echo @date('Y-m-d',$v['v_addtime']);?></span>  
                        					</div> 
                        				</div> 
                        			</li>  
		 <?php }?>
      <?php }else {?>
	  <?php echo $lang['sns_visitother_tip_1'];?><a href="index.php?act=member_snsfriend&op=follow"><?php echo $lang['sns_visitother_tip_2'];?></a><?php echo $lang['sns_visitother_tip_3'];?>
	  <?php }?>
                        		</ul>
<?php }?>
					<div class="visitor-message">




					<?php if($output['relation'] != 3){?>
						<!--留言框-->
					<div class="Smohan_FaceBox clearfix mb">
<h2><?php if ($output['relation'] == 3){echo $lang['sns_visitor_messages']; }else {echo $lang['sns_leave_a_message']; }?></h2>
	<form id="send_form" action='index.php?act=member_message&op=savemsg&type=sns_board' method="post">
      <input type="hidden" value="ok" name="form_submit">
      <input type="hidden" name="msg_type" value="2" />
      <input type="hidden" value="<?php echo $output['master_info']['member_name'];?>" name="to_member_name">
      <textarea id="content_msg" name="msg_content" placeholder="<?php echo $lang['sns_message_content_placeholder'];?>@<?php echo !empty($output['master_info']['member_truename'])?$output['master_info']['member_truename']:$output['master_info']['member_name'];?><?php echo $lang['sns_talk'];?>~" class="smohan_text"></textarea>
      <p> <a class="face two" href="javascript:void(0);" data-param='{"txtid":"msg"}' nc_type="smiliesbtn"></a><a href="javascript:void(0);" nctype="commentbtn" class="button Smohan_Showface"><?php echo $lang['sns_speak'];?></a>
	  </p>
    </form>
	
</div>
					  <?php }?>



                        <div id="plLoadListData" class="clearfix">
                        	
							<div class="pl-container" > 
							<?php if(!empty($output['message_list'])){?>
                        		<ul nctype="message_list">
							
								<?php foreach($output['message_list'] as $val){?>
                        			<li class="pl-list clearfix"> 
                        				<div class="pl-list-avator">
                        					<a href="index.php?act=member_snshome&mid=<?php echo $val['from_member_id'];?>" data-param="{'id':<?php echo $val['from_member_id'];?>}" nctype="mcard" target="_blank">
											
                        						<img src="<?php echo getMemberAvatarForID($val['from_member_id']); ?>" title="<?php echo $val['from_member_name'].$lang['nc_colon'];?>">
                        					</a> 
                        				</div> 
                        				<div class="pl-list-main"> 
                        					<div class="pl-list-nick"> 
                        						<a href="index.php?act=member_snshome&mid=<?php echo $val['from_member_id'];?>"  target="_blank"><?php echo $val['from_member_name'];?> </a> 
                        					</div> 
                        					<div class="pl-list-content"><?php echo parsesmiles($val['message_body']);?></div>  
                        					<div class="pl-list-btm clearfix"> 
                        						<span class="pl-list-time l">时间: <?php echo $val['message_time'];?></span>  
                        					</div> 
                        				</div> 
                        			</li> 
									   <?php }?>		
                        		</ul>
								<?php }else{?>
							  <div><?php echo $lang['sns_message_null'];?></div>
							<?php }?>
                        	</div>

                        	<div class="page pl-list-page"></div>
                        </div> 
                        
					</div>
				</div>
			
						


			</div>
		</div>	
		
	</div>

<script>
$(function(){
	$("[nc_type='visitmodule']").bind('click',function(){
		var data_str = $(this).attr('data-param');
	    eval( "data_str = "+data_str);
	    $("[nc_type='visitmodule']").removeClass('on');
	    $(this).addClass('on');
	    $("[nc_type='visitlist']").hide();
	    $("#"+data_str.name).show();
	});

	// 回复提交
	$("[nctype='commentbtn']").live('click',function(){
		if($("#send_form").valid()){
			ajaxpost('send_form', '', '', 'onerror');
		}
		return false;
	});
	$('#send_form').validate({
		errorPlacement: function(error, element){
			element.after(error);
		},      
		rules : {
			msg_content : {
				required : true,
				maxlength: 140
			}
		},
		messages : {
			msg_content : {
				required : '<?php echo $lang['sns_message_content_not_null'];?>',
				maxlength: '<?php echo $lang['sns_message_content_max_140'];?>'
			}
		}
	});

	//评论字符个数动态计算
	$("#content_msg").charCount({
		allowed: 140,
		warning: 10,
		counterContainerID:'commentcharcount',
		errortype: 'negative'
	});

	// 回复
	$('a[nctype="reply_msg"]').live('click', function(){
		var p_dd = $(this).parents('dd:first');
		var data; eval('data = ' + p_dd.attr('data-param'));
		if(!p_dd.next().is('dd[nctyoe="replyform"]')){
			$('<dd nctyoe="replyform" class="re-msg"></dd>')
				.append('<i></i>')
				.append('<form id="replyform'+data.msgid+'" action="index.php?act=member_message&op=savereply" method="post"></form>').children('form')
				.append('<input type="hidden" value="ok" name="form_submit"><input type="hidden" value="'+data.msgid+'" name="message_id">')
				.append('<textarea class="re-msg-content" name="msg_content" id="content_msg'+data.msgid+'" placeholder="<?php echo $lang['sns_reply'];?>@'+data.fname+'~"></textarea><div class="action"></div>').children('div')
				.append('<a class="face" nc_type="smiliesbtn" data-param=\'{"txtid":"msg'+data.msgid+'"}\' href="javascript:void(0);"><?php echo $lang['sns_smiles'];?></a>')
				.append('<a nc_type="commentbtn'+data.msgid+'" class="btn" href="javascript:void(0);"><?php echo $lang['nc_submit'];?></a>')
				.append('<span class="charcount"><em id="commentcharcount'+data.msgid+'"></em>/140</span>')
				.end().end().insertAfter(p_dd);
			//评论字符个数动态计算
			$("#content_msg"+data.msgid).charCount({
				allowed: 140,
				warning: 10,
				counterContainerID:'commentcharcount'+data.msgid,
				errortype: 'negative'
			});
			// 回复提交
			$("[nc_type='commentbtn"+data.msgid+"']").live('click',function(){
				if($("#content_msg"+data.msgid).val().length <= 140){
					ajaxpost("replyform"+data.msgid, '', '', 'onerror');
				}
				return false;
			});
		}
	});
});


                        					
											
                        						
                        					 
                        				 
                        				 
                        					 
                        						
                        					
                        					

function leaveMsgSuccess(data){
	//&nbsp;&nbsp;&nbsp;<span class="pl-list-time l" style="padding-left:50px;"><a href="javascript:void(0);" onclick="ajax_get_confirm(\'<?php echo $lang['nc_common_op_confirm'];?>\', \'index.php?act=member_message&op=dropcommonmsg&drop_type=sns_msg&message_id='+data.msg_id+'\');"><?php echo $lang['nc_delete'];?></a></span>  
	$('<li class="pl-list clearfix"></li>')
		.append('<div class="pl-list-avator"><a href="index.php?act=member_snshome&mid='+data.from_member_id+'" data-param="{\'id\':'+data.from_member_id+'}" nctype="mcard"  target="_blank" data-hasqtip="3" aria-describedby="qtip-3"><img src="<?php echo getMemberAvatarForID($_SESSION['member_id']); ?>" title="'+data.from_member_name+'<?php echo $lang['nc_colon'];?>"></a></div><div class="pl-list-main"><div class="pl-list-nick"><a href="index.php?act=member_snshome&mid='+data.from_member_id+'"  target="_blank">'+data.from_member_name+' </a> </div><div class="pl-list-content">'+data.msg_content+'</div><div class="pl-list-btm clearfix"> <span class="pl-list-time l">时间: <?php echo $lang['sns_just'];?></span></div></div>  ')
	.prependTo('ul[nctype="message_list"]');
	$('ul[nctype="message_list"]').children('ul').hide();
}

function replyMsgSuccess(data){
	$('dd[nctyoe="replyform"]').remove();
	var to = $('dl[nctype="dl'+data.message_parent_id+'"]').children('dd:last');
	$('<dl class="re-content"></dl>')
		.append('<dt><a href="index.php?act=member_snshome&mid='+data.from_member_id+'">'+data.from_member_name+'<?php echo $lang['sns_reply'].$lang['nc_colon'];?></a><span>'+data.msg_content+'</span></dt>')
		.append('<dd data-param="{\'msgid\':\''+data.msg_id+'\'}"><span class="time"><?php echo $lang['sns_just'];?></span></dd>')
		.appendTo(to);
}
</script>