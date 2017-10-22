<?php defined('InShopNC') or exit('Access Invalid!');?>



<div class="course-nav-hd wrapper mtb-course">
	<h2>留言板</h2> 
	<div class="message-board-nav">
		<a class="a1">已有<?php echo $output['totalNum'];?>条评论</a>
		<a class="a2" href="#comment">我要评论</a>
	</div>
</div>


<div class="wrapper m-t">



<?php if(!empty($output['pinglun_info'])){?>

    <?php foreach ($output['pinglun_info'] as $k => $v) {?>


    <div class="message-boxes">
    	
    	<!--1条回复 S-->
    	<div class="ques-answer">

            <!-- 评论 -->
    		<div class="answer-con first">
	     		<h5><strong><?php echo $v['P_MemberName'];?></strong><em><?php echo date('Y-m-d',$v['P_AddTime']);?></em><em><?php echo date('H:i:s',$v['P_AddTime']);?></em></h5>
	    		<p><?php echo $v['P_Content'];?></p>   	
	    		<div class="ctrl-bar">
	    			<span class="reply" onclick="show_huifu(<?php echo $v['P_Id'];?>);"><?php echo $v['Pl_Huifu_count'];?>条回复</span>
	    		</div>
    		</div>

            <!-- 回复 -->
            <div class="reply-con  reply-con-<?php echo $v['P_Id'];?>">


            	<ul class="reply-list">

<?php if(!empty($v['Pl_Huifu'])){?>
    <?php foreach ($v['Pl_Huifu'] as $pk => $pv) {?>

<li>

    <?php if(!empty($pv['H_ZdMemberName'])){?>
	<h2><span class="s_name_<?php echo $pv['H_Id'];?>"><?php echo $pv['H_MemberName'];?></span><strong> 回复 </strong><?php echo $pv['H_ZdMemberName'];?>：<em><?php echo $pv['re_day'];?></em></h2>
    <?php }else{?>
    <h2><span class="s_name_<?php echo $pv['H_Id'];?>"><?php echo $pv['H_MemberName'];?></span>：<em><?php echo $pv['re_day'];?></em></h2>
    <?php }?>

	<p><?php echo $pv['H_Content'];?></p>
    <div class="reply-btn " onclick="zd_name_huifu(<?php echo $v['P_Id'];?>,<?php echo $pv['H_Id'];?>);">回复</div>
</li>

    <?php }?>
<?php }?>

            	</ul>
    

            	<div class="release-reply-con">
            		<div class="user-name">
            			<a href="" target="_blank"><?php echo $_SESSION['member_name'];?></a>
                    </div>
            		<textarea name="release-reply" class="pinglun_huifu_text_<?php echo $v['P_Id'];?>" id="release-reply" placeholder="写下你的回复"></textarea>
            		<!--<p class="err-tip">字数不够，最少3个字</p>-->
            		<div class="do-reply-btn" onclick="pinglun_huifu(<?php echo $v['P_Id'];?>);">回复</div>
            	</div>
    

            </div>
            
    	</div>
    	<!--1条回复 a-->  	   	
    </div>


    
    <?php }?>

    <div class="pagination ptb16">
        <?php echo $output['show_page'];?>
    </div>

<?php }?>

    

</div>

<div class="wrapper" id="comment">
	<div class="release-reply-con-add">
		<h2><em>发表评论</em><strong>已有<?php echo $output['totalNum'];?>条评论</strong></h2>
		<textarea name="release-reply" class="pinglun_text" id="release-reply" placeholder="说说你的看法... ..."></textarea>
		<!--<p class="err-tip">字数不够，最少3个字</p>-->
		<p class="attention">注：藏友评论只供表达个人看法，并不代表本网站同意其看法或者证实其描述。如在未登录情况下则不能发表任何评论。</p>
		<div class="do-reply-btn" id="do_pinglun">我要评论</div>
	</div>
</div>

<script>

function show_huifu(id){
    var btn = $(".reply-con-" + id); 
    btn.css("display") === "none" && btn.show() || btn.hide();
}

function zd_name_huifu(id,hid){
    var z_name = $(".s_name_" + hid).text();
    var huifu_name = '回复 ' + z_name + ' ';
    $(".pinglun_huifu_text_" + id).val(huifu_name);
}

function pinglun_huifu(id){
    var pinglun_huifu_text = $(".pinglun_huifu_text_" + id).val();

    if(!!pinglun_huifu_text === false){

        alert('请填写内容');

    }else{
		if(pinglun_huifu_text.length > 200){
			alert('回复内容仅限200字以内');
			return false;
		}
		var txt = new RegExp(/[\"\'<>%;:.)(&+]/);
		if(txt.test(pinglun_huifu_text)){ 
			alert('你输入的信息含有非法字符，请检查！');
			return false;
		}
		pinglun_huifu_text = pinglun_huifu_text.replace(/(\d{7})\d{4}/, '$1****');
        $.ajax({

            url:"<?php echo urlArtist('artist_blog','addPinglunHuifu');?>",
            type:"POST",
            data:{data:pinglun_huifu_text,Pid:id},
            cache:false,
            dateType:'json',
            success:function(data){

                switch(data)
                {
                    case '1':
                        alert('评论成功');
                        window.location.href="<?php echo urlArtist('artist_blog','liuyan',array('aid'=>$_GET['aid']));?>";
                        break;
                    case '11':
                        alert('未登录、请在登录状态下发表评论！');
                        break;
                    case '22':
                        alert('评论失败、请重新评论！');
                        break;
                    case '33':
                        alert('请15秒后评论！');
                        break;
                }
                
            }

        });


    }


}


    
$(function(){

    $("#do_pinglun").click(function(){

        var pinglun_text = $(".pinglun_text").val();

        if(!!pinglun_text === false){

            alert('请填写内容');

        }else{
			if(pinglun_text.length > 200){
				alert('评论内容仅限200字以内');
				return false;
			}

			var txt = new RegExp(/[\"\'<>%;:.)(&+]/);
			if(txt.test(pinglun_text)){ 
				alert('你输入的信息含有非法字符，请检查！');
				return false;
			}
			pinglun_text = pinglun_text.replace(/(\d{7})\d{4}/, '$1****');
            $.ajax({
                url:"<?php echo urlArtist('artist_blog','addPinglun',array('aid'=>$_GET['aid']));?>",
                type:"POST",
                data:{data:pinglun_text},
                cache:false,
                dateType:'json',
                success:function(data){
                    switch(data)
                    {
                        case '1':
                            alert('评论成功');
                            window.location.href="<?php echo urlArtist('artist_blog','liuyan',array('aid'=>$_GET['aid']));?>";
                            break;
                        case '11':
                            alert('未登录、请在登录状态下发表评论！');
                            break;
                        case '22':
                            alert('评论失败、请重新评论！');
                            break;
                        case '33':
                            alert('请15秒后评论！');
                            break;
                    }
                    
                }

            });

        }

    })

})

</script>