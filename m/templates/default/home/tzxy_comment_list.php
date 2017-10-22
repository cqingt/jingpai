<?php defined('InShopNC') or exit('Access Invalid!');?>
<?php if(!empty($output['comment_list']) && is_array($output['comment_list'])){ ?>
<?php foreach($output['comment_list'] as $value){ ?>
 <li>
	<div class="com-img">
		 <i><img src="<?php echo getMemberAvatar($value['member_avatar']);?>" alt="<?php echo $value['member_name'];?>"></i>
	</div>
	<div class="com-word">
		 <h4><?php echo $value['member_name'];?></h4>
		  <strong><time style="margin-left: 0px;">发表于<?php echo date('Y-m-d H:i:s',$value['comment_time']);?></time></strong>
		  <p><?php echo $value['comment_message'];?></p>
	</div>
 </li>
<?php } ?>
<?php } ?>