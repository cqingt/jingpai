<?php defined('InShopNC') or exit('Access Invalid!');?>
<?php
if (!empty($output['code_recommend_list']) && is_array($output['code_recommend_list'])) {
$val = $output['code_recommend_list']['code_info'][1];
?>
<div class="m_index">
	<h1>值得参与<?php //echo $val['recommend']['name'];?></h1>
    <div class="m_indexn">
    	<div class="m_indexn_l">
        <a href="<?php echo $val['pic_list']['11']['pic_url'];?>" title="<?php echo $val['pic_list']['11']['pic_name'];?>" target="_balnk"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['11']['pic_img'];?>" alt="<?php echo $val['pic_list']['11']['pic_name'];?>"/></a>
        </div>
        <div class="m_indexn_x">
            <p><a href="<?php echo $val['pic_list']['12']['pic_url'];?>" title="<?php echo $val['pic_list']['12']['pic_name'];?>" target="_blank"> <img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['12']['pic_img'];?>" alt="<?php echo $val['pic_list']['12']['pic_name'];?>"></a></p>
            <p><a href="<?php echo $val['pic_list']['14']['pic_url'];?>" title="<?php echo $val['pic_list']['14']['pic_name'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['14']['pic_img'];?>" alt="<?php echo $val['pic_list']['14']['pic_name'];?>"></a></p>
        </div>
        <div class="m_indexn_x">
            <p><a href="<?php echo $val['pic_list']['21']['pic_url'];?>" title="<?php echo $val['pic_list']['21']['pic_name'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['21']['pic_img'];?>" alt="<?php echo $val['pic_list']['21']['pic_name'];?>"></a></p>
            <p><a href="<?php echo $val['pic_list']['24']['pic_url'];?>" title="<?php echo $val['pic_list']['24']['pic_name'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['24']['pic_img'];?>" alt="<?php echo $val['pic_list']['24']['pic_name'];?>"></a></p>
        </div>
        <div class="m_indexn_l"><a href="<?php echo $val['pic_list']['31']['pic_url'];?>" title="<?php echo $val['pic_list']['31']['pic_name'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['31']['pic_img'];?>" alt="<?php echo $val['pic_list']['31']['pic_name'];?>"></a></div>
        <div class="m_indexn_x">
            <p><a href="<?php echo $val['pic_list']['32']['pic_url'];?>" title="<?php echo $val['pic_list']['32']['pic_name'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['32']['pic_img'];?>" alt="<?php echo $val['pic_list']['32']['pic_name'];?>"></a></p>
            <p><a href="<?php echo $val['pic_list']['33']['pic_url'];?>" title="<?php echo $val['pic_list']['33']['pic_name'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['33']['pic_img'];?>" alt="<?php echo $val['pic_list']['33']['pic_name'];?>"></a></p>
        </div>
    </div>
</div>

<div class="home-everyone-logo wrapper">
			<div class="everyone-l">
				<a href="<?php echo $val['pic_list']['34']['pic_url'];?>" title="<?php echo $val['pic_list']['34']['pic_name'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['34']['pic_img'];?>" alt="<?php echo $val['pic_list']['34']['pic_name'];?>"></a>
				<a href="<?php echo $val['pic_list']['35']['pic_url'];?>" title="<?php echo $val['pic_list']['35']['pic_name'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['35']['pic_img'];?>" alt="<?php echo $val['pic_list']['35']['pic_name'];?>"></a>
			</div>
			<div class="everyone-r">
				<a href="<?php echo $val['pic_list']['36']['pic_url'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['36']['pic_img'];?>"/>
				  <div class="instructions-box">
				  	 <div class="ins-opacity"></div>
				  	 <p><?php echo $val['pic_list']['36']['pic_name'];?></p>
				  </div>
				</a>
				<a href="<?php echo $val['pic_list']['37']['pic_url'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['37']['pic_img'];?>"/>
				  <div class="instructions-box">
				  	 <div class="ins-opacity"></div>
				  	 <p><?php echo $val['pic_list']['37']['pic_name'];?></p>
				  </div>
				</a>
				<a href="<?php echo $val['pic_list']['38']['pic_url'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['38']['pic_img'];?>"/>
				  <div class="instructions-box">
				  	 <div class="ins-opacity"></div>
				  	 <p><?php echo $val['pic_list']['38']['pic_name'];?></p>
				  </div>
				</a>
					<a href="<?php echo $val['pic_list']['39']['pic_url'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['39']['pic_img'];?>"/>
				  <div class="instructions-box">
				  	 <div class="ins-opacity"></div>
				  	 <p><?php echo $val['pic_list']['39']['pic_name'];?></p>
				  </div>
				</a>		
				<a href="<?php echo $val['pic_list']['40']['pic_url'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['40']['pic_img'];?>"/>
				  <div class="instructions-box">
				  	 <div class="ins-opacity"></div>
				  	 <p><?php echo $val['pic_list']['40']['pic_name'];?></p>
				  </div>
				</a>		
				<a href="<?php echo $val['pic_list']['41']['pic_url'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['41']['pic_img'];?>"/>
				  <div class="instructions-box">
				  	 <div class="ins-opacity"></div>
				  	 <p><?php echo $val['pic_list']['41']['pic_name'];?></p>
				  </div>
				</a>
				<a href="<?php echo $val['pic_list']['42']['pic_url'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['42']['pic_img'];?>"/>
				  <div class="instructions-box">
				  	 <div class="ins-opacity"></div>
				  	 <p><?php echo $val['pic_list']['42']['pic_name'];?></p>
				  </div>
				</a>
				<a href="<?php echo $val['pic_list']['43']['pic_url'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['43']['pic_img'];?>"/>
				  <div class="instructions-box">
				  	 <div class="ins-opacity"></div>
				  	 <p><?php echo $val['pic_list']['43']['pic_name'];?></p>
				  </div>
				</a>		
				<a href="<?php echo $val['pic_list']['44']['pic_url'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['44']['pic_img'];?>"/>
				  <div class="instructions-box">
				  	 <div class="ins-opacity"></div>
				  	 <p><?php echo $val['pic_list']['44']['pic_name'];?></p>
				  </div>
				</a>
				<a href="<?php echo $val['pic_list']['45']['pic_url'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['45']['pic_img'];?>"/>
				  <div class="instructions-box">
				  	 <div class="ins-opacity"></div>
				  	 <p><?php echo $val['pic_list']['45']['pic_name'];?></p>
				  </div>
				</a>
				<a href="<?php echo $val['pic_list']['46']['pic_url'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['46']['pic_img'];?>"/>
				  <div class="instructions-box">
				  	 <div class="ins-opacity"></div>
				  	 <p><?php echo $val['pic_list']['46']['pic_name'];?></p>
				  </div>
				</a>
				<a href="<?php echo $val['pic_list']['47']['pic_url'];?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['47']['pic_img'];?>"/>
				  <div class="instructions-box">
				  	 <div class="ins-opacity"></div>
				  	 <p><?php echo $val['pic_list']['47']['pic_name'];?></p>
				  </div>
				</a>						
			</div>
		</div>
<?php
}
?>