

   <link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/css/new_file.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/css/default.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/css/component.css" />


	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/js/jquery-1.8.3.min.js"></script>
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/js/tabulous.js"></script>
	
	<script>
	$(function(){
		$('.tabs').tabulous({
			effect: 'scale'
		});
	});
	</script>      
	
	<div class="banner clearfix">
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/banner_01.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/banner_02.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/banner_03.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/banner_04.jpg"/>
		<img class="md-trigger" data-modal="modal-3" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/banner_05.jpg"/>
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/banner_06.jpg"/>
	</div>
	
	<div class="main-con clearfix">
		<?php if($output['value']){ ?>
			<div class="headline clearfix">
				<h2><strong><?php echo $output['value']['user_name'];?></strong><?php echo $output['value']['title'];?></h2>
				<?php $img = unserialize($output['value']['img_file']);?>
				<!--<h4>CCTV《鉴宝》专家王立军为你评估鉴定</h4>-->
			</div>
			<div class="personage-baby clearfix">
			
				<div  onclick="modal_shop1('<?php echo $output['value']['id'];?>');">

					<img style="height: 268px;width: 268px;" src="http://www.96567.com<?php echo $img[0];?>"/>
			
				</div>
				<div class="lt-box clearfix">
				
					<span><i class="icon-love"></i>票数<em><?php echo $output['value']['vote_num'];?></em></span>
					<span><i class="icon-trophy"></i>排名<em><?php echo Model('zhuanti')->getPaiMing(array('vote_num'=>array('egt',$output['value']['vote_num'])))?></em></span>
			
				</div>
				<?php if(intval($_GET['push_memberid']) > 0 && intval($_GET['push_memberid']) != $_SESSION['member_id']){ ?>
				<div class="pay-out-one  clearfix" href="javascript:;" onclick="toupiao('<?php echo $output['value']['id'];?>');">为Ta投票</div>
				<a class="pay-out-two md-trigger clearfix" href="javascript:;" data-modal="modal-1">发送给好友为Ta拉票</a>
				<div class="btn-uploading  clearfix" onclick="modal_8();" href="javascript:;" ><strong>我要上传藏品</strong></div>
	
				<?php }else{ ?>
					<a class="pay-out-one md-trigger clearfix" href="javascript:;" data-modal="modal-1">邀请好友投票</a>
				<?php } ?>
			</div>
		<?php } ?>
		
		<div class="sea-mew clearfix">
			
		<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/sea-mew.jpg"/>
		
		</div>

		<div class="headline-nobj clearfix">
			<h2>您的宝贝值多少钱</h2>
			<h4>CCTV《鉴宝》专家王立军为你评估鉴定</h4>
		</div>
		 
		<div class="celebrity clearfix">
			<a class="md-trigger" data-modal="modal-2" href="javascript:;">
				<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/wanglijun_01.jpg"/>
				<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/wanglijun_02.jpg"/>
				<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/wanglijun_03.jpg"/>
				<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/wanglijun_04.jpg"/>
			</a>
		</div>
		
		<div class="sea-mew clearfix">
			<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/sea-mew.jpg"/>
		</div>		

		<div class="headline-nobj clearfix">
			<h2>活动奖励</h2>
		</div>
		
		<div class="award-box clearfix">
			<a class="md-trigger" data-modal="modal-4" href="javascript:;">
				<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/award_01.jpg"/>
				<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/award_02.jpg"/>
				<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/award_03.jpg"/>
				<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/award_04.jpg"/>
			</a>
		</div>
		
		<a class="btn-uploading mtb md-trigger clearfix" onclick="modal_8();" href="javascript:;"><strong>我要上传藏品</strong></a>
		
		<div class="sea-mew clearfix">
			<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/sea-mew.jpg"/>
		</div>	
		
		<div class="headline-nobj clearfix">
			<h2>排行榜</h2>
		</div>	

		<!-- Demo start -->
		<div class="tabs">
			<ul class="tabsnav">
				<li><a href="#tabs-1" title="">投票排行榜</a></li>
				<li><a href="#tabs-2" title="">前100名</a></li>
				<li><a href="#tabs-3" title="">中奖名单</a></li>
			</ul>

			<div id="tabs_container">
				<div class="demo showscale" id="tabs-1">
					<ul class="army">
						<?php foreach($output['PiaoList'] as $k=>$v){?>
						<?php $img = unserialize($v['img_file']);?>
					
						<li class="md-trigger" onclick="modal_shop1('<?php echo $v['id'];?>');">
							<span><img src="http://www.96567.com<?php echo $img[0];?>"/></span>
							<p><?php echo $v['title'];?></p><strong><i class="icon-love"></i><?php echo $v['vote_num'];?></strong>
						</li>
						<?php } ?>
												
					</ul>
					
					<div class="pagination">	
						<?php echo $output['page'];?>
					</div>
											
				</div>

     			<div class="demo" id="tabs-2">
     				<ol class="top-hundred clearfix">
     					<li>
     						<p>排名</p>
     						<p>姓名</p>
     						<p>票数</p>
     					</li>
     				</ol>
					<ul class="top-hundred clearfix">
					<?php foreach($output['QianYiBai'] as $qk=>$qv){?>
						<li>
							<p><?php echo $qk+1;?></p>
							<p><?php echo $qv['user_name'];?></p>
							<p><?php echo $qv['vote_num'];?></p>
						</li>
					<?php } ?>
						
				</div>

				<div class="demo" id="tabs-3">
					<span class="word">
						<h2>首届传家宝票选活动中奖声明</h2>
						<p>本次活动由收藏天下和藏真天下共同举办，本着公平、公正、公开的原则，让民间的藏品可以走到台前，接受专家的鉴定，让收藏走进大众，让大众“认识”收藏！</p>
						<p>活动结束后，将根据票数统计结果，最终获奖名单将在“收藏天下”官方微信号公布，同时将在此页面公示获奖名单。</p>
						<p>活动结束后，工作人员将会及时和获奖用户取得联系！</p>
						<strong>收藏天下 </strong>
						<strong>藏真天下王立军工作室</strong>
						<strong>2016年7月</strong>						
					</span>
				</div>
			</div>
		</div>
		<!-- Demo end -->
		
	</div>
	<?php if($output['is_mycuanjia'] == 'no' && intval($output['you_count']) > 0){ ?>
		<a class="btn-participation" href="http://m.96567.com/index.php?act=zhuanti&op=ad_20160707">查看我的传家宝</a>
	<?php }else{ ?>
	<a class="btn-participation" onclick="modal_8();" href="javascript:;">报名参与</a>
	<?php } ?>
	

	<!-- 弹出层区域  Start-->

    <!--NO.1 一个好友每天可以为你投3票哦！ -->
	<div class="md-modal md-effect-3" id="modal-1">
	    <div class="md-content">
	        <div class="demo">
	            <div class="md-close">
	            <img class="saimg" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/tc1.png"/> 
	            </div>
	        </div>
	    </div>
	</div>

	<div class="md-modal md-effect-3" id="modal-110">
	    
	</div>
	<div class="md-modal md-effect-3" id="modal-210">
	    
	</div>
    <!--NO.2 王立军简介 -->
	<div class="md-modal md-effect-3" id="modal-2">
	    <div class="md-content coloured">
	        <div class="demo clearfix">
	             
	             <!--主内容区-->
                 <div class="tc-con clearfix">
					<div class="sea-mew clearfix">
						<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/sea-mew.jpg"/>
					</div>		
			
					<div class="headline-nobj">
						<h2>王立军简介</h2>
					</div>
					<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/wlj2.jpg"/>
					<h3 class="mt">著名文物、艺术品鉴专家</h3>
					<p>中央电视台“寻宝”“鉴宝”等栏目专家组组长、中国教育台《文化遗产，艺术中国》专家组组长、文化部中国艺术品评估委员会副主任、世界华人收藏家协会荣誉主席、中国人民书画院院长；北京大学、清华大学客座教授，高级鉴定师，曾获中国收藏界十大人物等称号。他眼光犀利，一身正气，敢说真话，是我国实战型专家的领军人物，在海内外享有盛誉！</p>
                    <h3>收藏鉴定专家中的书法大家</h3>
                    <p>王立军在文学、音乐、影视等方面都具有很高的造诣。多部文学作品及新闻类文字也曾在国内多次获奖。而他的书法，更是早已名声在外。</p>
                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/wlj3.jpg"/>
                 </div>
                 <div class="bm-painting">
                 	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/painting.jpg"/>
                 </div>
	             
	             <!--关闭按钮-->
	            <button class="md-close close-one"><i class="icon-close"></i></button>
	        </div>
	    </div>
	</div>

    <!--NO.3 活动规则 -->
	<div class="md-modal md-effect-3" id="modal-3">
	    <div class="md-content coloured">
	        <div class="demo clearfix">
	             
	             <!--主内容区-->
                 <div class="tc-con clearfix">
					<div class="sea-mew clearfix">
						<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/sea-mew.jpg"/>
					</div>		
			
					<div class="headline-nobj">
						<h2>活动规则</h2>
					</div>
				 
					<h3 class="mt-border-top">1、参赛要求</h3>
                    <p>参赛资格：有自己的收藏品或艺术品</p>
                    <p>参赛形式：上传1-6张藏品照片及50字以内藏品简介</p>
                    <h3>2、活动时间</h3>
                    <p>活动时间：2016年7月19日——2016年8月8日</p>
                    <p>报名结束时间：2016年8月5日</p>
                    <p>获奖名单公布时间：2016年8月12日</p>
                    <p>奖品发放时间：2016年8月15日——19日</p>
                    <h3>3、报名方法</h3>
                    <p>长按识别下方二维码图片，进入“收藏天下”公众号，回复“传家宝”进入活动页面，即可参赛！或者在微信右上方添加朋友的地方搜索公众号（微信号：收藏天下）</p>
                    <img class="erweima" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/erweima.png" alt="二维码">
                    <h3>4、投票方法</h3>
                    <p>搜索收藏天下公众号（微信号：收藏天下），或者长按上方识别二维码，进入公众号回复“传家宝”，即可参与投票！或者点击微信下方菜单【我要投票】，也可在活动页面参与投票哦！</p>
                    <p>注：每个人每天有3次投票机会。</p>
                    <h3>5、活动声明</h3>
                    <p>（1）本活动公平、公正、公开，欢迎监督！本次活动最终解释权归收藏天下所有。</p>
                    <p>（2）为提高投票的真实性和有效性，投票人需注册并进行手机验证。</p>
                    <h3>【奖品怎么领取？】</h3>
                    <p>获奖用户，收藏天下工作人员会于五个工作日内与用户电话沟通，获现金奖励的用户须提供银行账号，开户行信息及姓名等;并由收藏天下为您代扣个人所得税。收藏天下代金券使用及消费说明：</p>
                    <p><strong>收藏天下代金券使用及消费说明：</strong></p>
                    <p>1、收藏天下所提供的代金券可在收藏天下网站直接消费抵扣现金(无消费额限制，即便您只购买10元商品，亦可使用此代金券)</p>
                    <p>2、10元收藏天下代金券参与奖用户需提供收藏天下网站注册手机号，代金券将直接发放到该账户下（参与手机号与注册手机号要一样哦~），获得10元消费现金抵扣。</p>
                 </div>
                 <div class="bm-painting">
                 	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/painting.jpg"/>
                 </div>
	             
	             <!--关闭按钮-->
	            <button class="md-close close-one"><i class="icon-close"></i></button>
	        </div>
	    </div>
	</div>
	
	<!--NO.4 活动奖励 -->
	<div class="md-modal md-effect-3" id="modal-4">
	    <div class="md-content coloured">
	        <div class="demo clearfix">
	             
	             <!--主内容区-->
                 <div class="tc-con clearfix">
					<div class="sea-mew clearfix">
						<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/sea-mew.jpg"/>
					</div>		
			
					<div class="headline-nobj">
						<h2>活动奖励</h2>
					</div>
                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/tc-award_01.jpg"/>
                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/tc-award_02.jpg"/>
                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/tc-award_03.jpg"/>
                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/tc-award_04.jpg"/>
                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/tc-award_05.jpg"/>
                    <img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/tc-award_06.jpg"/>
                 </div>
                 <div class="bm-painting">
                 	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/painting.jpg"/>
                 </div>
	             
	             <!--关闭按钮-->
	            <button class="md-close close-one"><i class="icon-close"></i></button>
	        </div>
	    </div>
	</div>
	
	<!--NO.5  查看我的传家宝 -->
	<div class="md-modal md-effect-3" id="modal-5">
	    <div class="md-content coloured">
	        <div class="demo clearfix">
	             
	             <!--主内容区-->
                 <div class="tc-con clearfix">
					<div class="sea-mew mt clearfix">
						<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/sea-mew.jpg"/>
					</div>		
	                <h1 class="tc-title">《缠枝牡丹纹梅瓶》</h1>
					<div class="personage-baby">
						<div class="perimg">
							<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/1.jpg"/>
						</div>
						<div class="lt-box clearfix">
							<span><i class="icon-love"></i>票数<em>100</em></span>
							<span><i class="icon-trophy"></i>排名<em>18</em></span>
						</div>
					</div>	 
					<p>刘星的藏品简介</p>
					<p>年代：1991</p>
					<p>入手时间：2006</p>
					<p>入手价格：8585588元</p>
				    <p>关于藏品简介要求字数限制关于藏品简介要求字数限制关于藏品简介要求字数限制关于藏品简介要求字数限制关于藏品简介要求字数限制关于藏品简介要求字数限制关于藏品简介要求字数限制关于藏品简介要求字数限制</p>
                    <button class="tc-btn-vote mt">投票</button>
                 </div>
                 
                 <div class="bm-painting">
                 	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/painting.jpg"/>
                 </div>
	             
	             <!--关闭按钮-->
	            <button class="md-close close-one"><i class="icon-close"></i></button>
	        </div>
	    </div>
	</div>

	<!--NO.6  查看我的传家宝 -->
	<div class="md-modal md-effect-3" id="modal-shop1">
	    <div class="md-content coloured">
	        <div class="demo clearfix">
	             
	             <!--主内容区-->
                 <div class="tc-con clearfix">
					<div class="sea-mew mt clearfix">
						<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/sea-mew.jpg"/>
					</div>		
	                <h1 class="tc-title">《缠枝牡丹纹梅瓶》</h1>
					<div class="personage-baby clearfix">
						<div class="perimg clearfix">
							<div class="container_12">
								<div class="grid_8">
								
									<div id="sliderA" class="slider">
										<img src="images/image1.jpg" />
										<img src="images/image2.jpg" />
										<img src="images/image3.jpg" />
										<img src="images/image5.jpg" />
										<img src="images/image6.jpg" />
										<img src="images/image7.jpg" />
										<img src="images/image8.jpg" />
									</div>
												
								</div>
							</div>                             
 
						</div>
						<div class="lt-box clearfix">
							<span><i class="icon-love"></i>票数<em>100</em></span>
							<span><i class="icon-trophy"></i>排名<em>18</em></span>
						</div>
					</div>	 
					<p>刘星的藏品简介</p>
					<p>年代：1991</p>
					<p>入手时间：2006</p>
					<p>入手价格：8585588元</p>
				    <p>关于藏品简介要求字数限制关于藏品简介要求字数限制关于藏品简介要求字数限制关于藏品简介要求字数限制关于藏品简介要求字数限制关于藏品简介要求字数限制关于藏品简介要求字数限制关于藏品简介要求字数限制</p>
                    <button class="tc-btn-vote mt">投票</button>
                 </div>
                 
                 <div class="bm-painting">
                 	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/painting.jpg"/>
                 </div>
	             
	             <!--关闭按钮-->
	            <button class="md-close close-one"><i class="icon-close"></i></button>
	        </div>
	    </div>
	</div>
	
    <!--NO.7 点击为Ta投票  关注微信 -->
	<div class="md-modal md-effect-3" id="modal-7">
	    <div class="md-content">
	        <div class="demo">
	            <div class="md-close">
	            <img class="saimg" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/tc7.png"/> 
	            </div>
	        </div>
	    </div>
	</div>
		
    <!--NO.8 点击我要上传藏品  关注微信 -->
	<div class="md-modal md-effect-3" id="modal-8">
	    <div class="md-content">
	        <div class="demo">
	            <div class="md-close">
	            <img class="saimg" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/tc8.png"/> 
	            </div>
	        </div>
	    </div>
	</div>	
	
	<!--NO.9  登录与注册 -->
	<div class="md-modal md-effect-3" id="modal-from1">
	    <div class="md-content coloured">
	        <div class="demo clearfix">
	             
	             <!--主内容区-->
                 <div class="tc-con clearfix">
					<div class="sea-mew clearfix">
						<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/sea-mew.jpg"/>
					</div>		
					
					<!--这里有两种状态 文字变化而已-->
					<div class="headline-nobj mb clearfix" id="df_clearfix">
						<h5>为防止恶意刷票行为</h5>
						<h5>请<strong>登录/注册</strong>上传您的作品或为好友投票</h5>
						
						<!--<h5>玩古 · 藏今 · <strong>登录</strong>即阅天下</h5>
						<h5>派奖时以您注册的手机号为准</h5>						-->
					</div>			
 
		<!-- Demo start -->
		<div class="tabs">
			<ul class="tabsnav tc-tabsnav">
				<li><a href="#tabs-1" title="">登录</a></li>
				<li><a href="#tabs-2" title="">注册</a></li>
			</ul>

			<div id="tabs_container">
				<div class="demo formbox showscale" id="tabs-1">
                  <span class="item">
                  	<input type="text" id="log_name" name="log_name" value="" placeholder="请输入账号" />
                  </span>	
                  <span class="item">
                  	<input type="password" id="log_password" name="log_password" value="" placeholder="请输入密码" />
                  </span>	
                  <button class="tc-btn-vote mt" id="member_login">登录</button>    
				</div>

     			<div class="demo formbox" id="tabs-2">
                  <span class="item">
                  	<input type="text" id="user_name" name="user_name" value="" placeholder="用户名" />
                  </span>	
                  <span class="item">
                  	<input type="password" id="password" name="password" value="" placeholder="设置密码" />
                  </span>	
                  <span class="item">
                  	<input type="password" id="password_confirm" name="password_confirm" value="" placeholder="确认密码" />
                  </span>  
                  <span class="item">
                  	<input type="number" id="mobile" name="mobile" pattern="[0-9]*" value="" placeholder="手机号" />
                  </span>   
                  <span class="item-yz">
                  	<input class="l" type="number" name="captcha_code" id="code" value="" pattern="[0-9]*" placeholder="验证码" />
                  	<input class="r" type="button" onclick="getPhoneYzm();" name="getYzm" id="getYzm" value="获取验证码"/>
                  </span>  
                  <button class="tc-btn-vote mt" id="member_reg">注册</button>
				</div>

			</div>
		</div>
		<!-- Demo end --> 
 
 
 
                 </div>
                 <div class="bm-painting">
                 	<img src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/painting.jpg"/>
                 </div>
	             
	             <!--关闭按钮-->
	            <button class="md-close close-one"><i class="icon-close"></i></button>
	        </div>
	    </div>
	</div>
	
	<div class="md-overlay"></div>	
	<!-- 弹出层结束 End -->

	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/js/classie.js"></script>
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/js/modalEffects.js"></script>
	<script>

		var polyfilter_scriptpath = '<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/js/';
	</script>
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/js/cssParser.js"></script>
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/js/css-filters-polyfill.js"></script>
	<script>


$("#member_login").bind("click", function() {
	var user_name = $.trim($("#log_name").val());
	var password = $.trim($("#log_password").val());
	$("#member_login").attr("disabled",true);
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=login",
		data:{user_name:user_name,password:password},
		dataType:'json',
		success:function(result){
			if(result.state){
				 window.location.href="index.php?act=zhuanti&op=ad_20160707_bnt";
			}else{
				alert(result.error);
				$("#member_login").attr("disabled",false);
			}
		}
	}); 
});

$("#member_reg").bind("click", function() {
	var user_name = $.trim($("#user_name").val());
	var password = $.trim($("#password").val());
	var password_confirm = $.trim($("#password_confirm").val());
	var mobile = $.trim($("#mobile").val());
	var ua = "<?php echo $_GET['ua']?>";
	var code =  $('#code').val();
	$("#member_reg").attr("disabled",true);
	$.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=ad_20160707",
		data:{action:'regs',user_name:user_name,password:password,password1:password_confirm,mobile:mobile,ua:ua,code:code},
		dataType:'json',
		success:function(result){
			if(result.state){
				 window.location.href="index.php?act=zhuanti&op=ad_20160707_bnt";
			}else{
				alert(result.msg);
				$("#member_reg").attr("disabled",false);
			}
		}
	}); 
});
function getPhoneYzm(){
        var mobile = $("#mobile").val();
		var name = $("#user_name").val();
		if(name == ''){
            alert('用户名不能为空！');
            return false;
        }
        if(mobile == ''){
            alert('手机号不能为空！');
            return false;
        }

        var wait=60; 
        function time() { 
            var o = document.getElementById("getYzm");
           if (wait == 0) { 
                o.removeAttribute("disabled"); 
                o.value="重新发送"; 
                o.style.background = "#ffda31";
                o.style.color = "#ac4700";
                wait = 60; 
            } 
            else { 
                o.setAttribute("disabled", true); 
                o.value=wait+"秒"; 
                o.style.background = "#959595";
                o.style.color = "#fff";
                wait--; 
                setTimeout(function() { 
                time(o) 
                }, 
                1000) 
            } 
        } 

        $.ajax({
            type:'post',
            url:"index.php?act=zhuanti&op=getPhoneYzm",
            data:{mobile:mobile,name:name},
            dataType:'json',
            success:function(result){
                if(result == 1){
                    time();
                }else{
                  alert(result.error);
                }
            }
        });

    }
$(".md-overlay").click(function(){
	     $("div").removeClass("md-show");
		 
});
$(".icon-close").click(function(){
	     $("div").removeClass("md-show");
});

function toupiao(id){
	
	 $(".tc-btn-vote").attr("disabled",true);
	 $.ajax({
		type:'post',
		url:"index.php?act=zhuanti&op=ad_20160707",
		data:{action:'toupiao',id:id},
		dataType:'json',
		success:function(result){
			if(result.state){
			  alert("投票成功，如票数没有及时更新，请刷新页面！");
			  window.location.reload();//刷新当前页面.
			}else{
				if(result.msg == -1){
					$("div").removeClass("md-show");
					$("#df_clearfix").html("<h5>为防止恶意刷票行为</h5><h5>请<strong>登录/注册</strong>上传您的作品或为好友投票</h5>");
					$("#modal-from1").addClass('md-show');
				}else if(result.msg == -2){
					$("div").removeClass("md-show");
					$("#modal-7").addClass('md-show');
				}else if(result.msg == -3){
					alert("您不能给自己投票");
				}else if(result.msg == -4){
					alert("投票失败");
				}else if(result.msg == -5){
					alert("您今天的投票次数已用完请明天再来");
				}
			}
			$(".tc-btn-vote").attr("disabled",false);
		}
      });
}
</script>

<?php
$img = unserialize($output['value']['img_file']);
$array['P']['title'] = $output['value']['user_name']."正在参加首届“传家宝”收藏品全国评选活动，邀您投票共赏";

if($img[0]){
$array['P']['imgUrl'] = 'http://www.96567.com'.$img[0].'';
}else{
$array['P']['imgUrl'] = MOBILE_TEMPLATES_URL.'/zhuanti/20160707/images/100x100.jpg';	
}
$array['P']['link'] = 'http://m.96567.com/index.php?act=zhuanti&op=ad_20160707&push_memberid='.$output['member_id']; //分享连接
$array['Y']['link'] = 'http://m.96567.com/index.php?act=zhuanti&op=ad_20160707&push_memberid='.$output['member_id']; //分享连接
$array['Y']['title'] = $output['value']['user_name']."正在参加首届“传家宝”收藏品全国评选活动，邀您投票共赏";
$array['Y']['desc'] = "央视鉴宝专家王立军亲笔签发鉴定证书";
if($img[0]){
$array['Y']['imgUrl'] = 'http://www.96567.com'.$img[0].'';
}else{
$array['Y']['imgUrl'] = MOBILE_TEMPLATES_URL.'/zhuanti/20160707/images/100x100.jpg';	
}
echo weixinShare($array);

?>