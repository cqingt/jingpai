
<style>

.formbox .field_notice  .error {
    line-height: 16px;
    font-size: 12px;
    color: #F30;
    background-color: #FEFEDA;
    display: inline-block;
    padding: 2px 8px;
    margin: 4px 0 0 0;
    border: dashed 1px #FFE8C2;
}
</style>
<div class="main-con wrapper clearfix mtb">
	<div class="establish clearfix">
		<div class="title"><h2><?php echo $lang['circle_create_a_group'];?></h2><?php echo $lang['circle_first_from'];?><a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=search&op=group"><?php echo $lang['nc_find_fascinating'];?></a> <?php echo $lang['circle_find_like_group'];?></div>
		<h6><?php echo $lang['nc_welcome_at'].C('circle_name').$lang['nc_welcome_words'];?></h6>
		<div class="number">
			<div class="boxes">
				
				<p><?php echo $lang['circle_allow_create_group_count'].$lang['nc_colon'];?><em><?php echo C('circle_createsum');?></em></p>
				<p><?php echo $lang['circle_yet_create_group_count'].$lang['nc_colon'];?><em><?php echo $output['create_count'];?></em></p>
			
			</div>
			<div class="boxes">
				<p><?php echo $lang['circle_allow_join_group_count'].$lang['nc_colon'];?><em><?php echo C('circle_joinsum');?></em></p>
				<p><?php echo $lang['circle_yet_join_group_count'].$lang['nc_colon'];?><em><?php echo $output['join_count'];?></em></p>
			</div>
		</div>
	</div>
	
	<div class="formbox ml252 clearfix">
		<form method="post" id="groupadd_form" action="<?php echo CIRCLE_SITE_URL;?>/index.php?act=index&op=add_group">
	
		<input type="hidden" name="form_submit" value="ok" />
		<div class="tiem">
				<label for="">所属分类：</label>
				<select name="class_id" id="class_id">
					<option value="0">请选择</option>
					
				<?php if(!empty($output['class_list'])){?>
				<?php foreach($output['class_list'] as $val){?>
					<option value="<?php echo $val['class_id'];?>"><?php echo $val['class_name'];?></option>
				<?php }?>
				
				<?php }?>
				</select>
				<p class="field_notice"></p>
				<p style="clear: both;"><?php echo $lang['circle_belong_to_class_tips'];?></p>
				
			</div>
			<div class="tiem">
				<label for=""><em>*</em><?php echo $lang['circle_name'].$lang['nc_colon'];?></label>
				<input type="text" name="c_name" id="c_name" value="<?php echo $_GET['kw'];?>" />
				
				<p class="field_notice"></p>
				<p style="clear: both;"><?php echo $lang['circle_name_tips'];?></p>
			</div>
			<div class="tiem">
				<label for=""><?php echo $lang['circle_introduction'].$lang['nc_colon'];?></label>
			<textarea name="c_desc" id="c_desc" ></textarea>
			<span class="count" id="desccharcount"></span>
			<p class="field_notice"></p>
				<p><?php echo $lang['circle_introduction_tips'];?></p>
			</div>
			<div class="tiem">
				<label for=""><?php echo $lang['circle_tag'].$lang['nc_colon'];?></label>
				<input type="text" name="c_tag" />
				<p class="field_notice"></p>
				<p style="clear: both;"><?php echo $lang['circle_tag_tips'];?></p>
			</div>		
			<div class="tiem">
				<label for=""><?php echo $lang['circle_apply_reason'].$lang['nc_colon'];?></label>
				<textarea name="c_pursuereason" id="c_pursuereason" ></textarea>
				<span class="count" id="pursuereasoncharcount"></span>
				<p class="field_notice"></p>
				<p style="clear: both;"><?php echo $lang['circle_apply_reason_tips'];?></p>
			</div>		
			
			<div class="read">
				<p>我已认真阅读并同意《<a target="_blank" href="<?php echo SHOP_SITE_URL;?>/index.php?act=document&code=create_circle">社区使用须知</a>》中的所有条款</p>
			</div>
		</form>
		
		<div class="btnbox">
			<input type="button" nctype="submit-btn" value="<?php echo $lang['circle_submit_applications'];?>" />
		</div>
	</div>
</div>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.charCount.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script> 
<script type="text/javascript">
$(function(){
	$('input[nctype="submit-btn"]').click(function(){
		$('#groupadd_form').submit();
	});
    $('#groupadd_form').validate({
        errorPlacement: function(error, element){
            $(element).parents().children('.field_notice').html(error);
        },
    	submitHandler:function(form){
    		ajaxpost('groupadd_form', '<?php echo CIRCLE_SITE_URL;?>/index.php?act=index&op=add_group', '', 'onerror');
    	},
        rules : {
        	c_name : {
                required : true,
                minlength : 4,
            	maxlength : 12,
            	remote : {
            		url : 'index.php?act=index&op=check_circle_name',
                    type: 'get',
                    data:{
                    	name : function(){
                            return $('#c_name').val();
                        }
                    }
            	}
            },
            c_desc : {
            	maxlength : 255
            },
            c_tag : {
                maxlength : 60
            },
            c_pursuereason : {
                maxlength : 255
            }
        },
        messages : {
        	c_name : {
                required : '请填写圈子名称',
                minlength : '<?php echo $lang['circle_name_4_to_12_length'];?>',
            	maxlength : '<?php echo $lang['circle_name_4_to_12_length'];?>',
            	remote : '<?php echo $lang['circle_name_already_exists'];?>'
            },
            c_desc  : {
            	maxlength : '<?php echo $lang['circle_255_maxlength'];?>'
            },
            c_tag : {
                maxlength : '<?php echo $lang['circle_tag_maxlength'];?>'
            },
            c_pursuereason : {
                maxlength : '<?php echo $lang['circle_255_maxlength'];?>'
            }
        }
    });
    //字符个数动态计算
    $("#c_desc").charCount({
		allowed: 255,
		warning: 10,
		counterContainerID:'desccharcount',
		firstCounterText:'<?php echo $lang['charCount_firsttext'];?>',
		endCounterText:'<?php echo $lang['charCount_endtext'];?>',
		errorCounterText:'<?php echo $lang['charCount_errortext'];?>'
	});
    //字符个数动态计算
    $("#c_pursuereason").charCount({
		allowed: 255,
		warning: 10,
		counterContainerID:'pursuereasoncharcount',
		firstCounterText:'<?php echo $lang['charCount_firsttext'];?>',
		endCounterText:'<?php echo $lang['charCount_endtext'];?>',
		errorCounterText:'<?php echo $lang['charCount_errortext'];?>'
	});
});
</script> 