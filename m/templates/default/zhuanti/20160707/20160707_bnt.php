
    <link rel="stylesheet" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/css/new_file.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/css/default.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/css/component.css" />
	
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/css/default2.css">
    <link href="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/css/fileinput.css" media="all" rel="stylesheet" type="text/css" />		

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
	
	<div class="main-con-form clearfix">
		
		<div class="headline clearfix">
			<h2>我要参加</h2>
			<!--<h4>CCTV《鉴宝》专家王立军为你评估鉴定</h4>-->
		</div>
		<form id="myform" method="post" action="http://m.96567.com/index.php?act=zhuanti&op=ad_20160707_bnt" enctype="multipart/form-data">
		
		<div class="formbox">
		  <span class="item">
          	<input type="text" name="user_name" id="user_name" value="" placeholder="输入姓名" />
          </span>
          <span class="item">
          	<input type="text" name="title" id="title" value="" placeholder="输入藏品名称" />
          </span>	
          
		<div class="htmleaf-container">
	 
			<div class="kv-main">
	                <div class="form-group">
						 <input id="file-5" class="file" type="file" multiple data-preview-file-type="any" data-upload-url="http://m.96567.com/index.php?act=zhuanti&op=uploadUrl" data-preview-file-icon="" data-max-file-count=5>
	                </div>
	        </div>
			
		</div>
			
			
          <span class="item">
          	<input type="text" name="years" id="years" value="" placeholder="请输入藏品年代" />
          </span>	
          <span class="item">
          	<input type="text" name="data_time" id="data_time" value="" placeholder="请输入入手时间" />
          </span>  
          <span class="item">
          	<input type="text" name="price" id="price" value="" placeholder="请输入入手价格" />
          </span> 
          <span class="item">
          	<textarea name="contents" id="contents" rows="" cols="" placeholder="请输入藏品简介" ></textarea>
          </span>
          <button class="tc-btn-vote mt" id="submit">提交</button>
		</div>		
			
		</form>
		
		
	</div>		
	

	<!-- 弹出层区域  Start-->

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
                    <p>参赛形式：上传1-5张藏品照片及XX字以内藏品简介</p>
                    <h3>2、活动时间</h3>
                    <p>活动时间：2016年7月19日——2016年8月8日</p>
                    <p>报名结束时间：2016年8月5日</p>
                    <p>获奖名单公布时间：2016年8月12日</p>
                    <p>奖品发放时间：2016年8月15日——19日</p>
                    <h3>3、报名方法</h3>
                    <p>长按识别下方二维码图片，进入“收藏天下”公众号，回复“传家宝”进入活动页面，即可参赛！或者在微信右上方添加朋友的地方搜索公众号（微信号：收藏天下）</p>
                    <h3>4、投票方法</h3>
                    <p>搜索收藏天下公众号（微信号：收藏天下），或者长按上方识别二维码，进入公众号回复“传家宝”，即可参与投票！或者点击微信下方菜单【我要投票】，也可在活动页面参与投票哦！</p>
                    <p>注：每个人每天有3次投票机会。</p>
                    <h3>5、活动声明</h3>
                    <p>（1）本活动公平、公正、公开，欢迎监督！本次活动最终解释权归收藏天下所有。</p>
                    <p>（2）为提高投票的真实性和有效性，投票人需注册并进行手机验证。</p>
                    <h3>【奖品怎么领取？】</h3>
                    <p>1、获奖用户在活动公布成绩之日起3天内接到收藏天下获奖短信提醒，用户将个人快递地址、电话、姓名发送至收藏天下微信平台，电话需与参与活动报名时所留电话一致;</p>
                    <p>2、获得现金奖励的用户，收藏天下工作人员会于五个工作日内与用户电话沟通，用户须提供银行账号，开户行信息及姓名等;并由收藏天下为您代扣个人所得税。</p>
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

                
	             
	        </div>
	    </div>
	</div>
	
	
    <!--NO.10 组 弹窗（打开此页面默认显示弹窗） -->
	<div class="md-modal only-modal md-effect-3 md-show" id="modal-sm">
	    <div class="md-content">
	        <div class="demo">
	            <div class="md-close">
	            <img class="saimg" src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/images/tc-sm.png"/> 
	            </div>
	        </div>
	    </div>
	</div>
	<!--移除md-show进行填写表单-->
	<script type="text/javascript">
	$(function(){
	    $(".md-close").click(function(){
	         $("#modal-sm").removeClass("md-show");
	    });
	});		
	</script>	
	
	<div class="md-overlay"></div>	
	<!-- 弹出层结束 End -->
	

 
    
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/js/classie.js"></script>
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/js/modalEffects.js"></script>
	<script>
		var polyfilter_scriptpath = '<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/js/';
	</script>
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/js/cssParser.js"></script>
	<script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/js/css-filters-polyfill.js"></script>
	
	
	
    <!--上传-->	
    <script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/js/fileinput.js" type="text/javascript"></script>
    <script src="<?php echo MOBILE_TEMPLATES_URL;?>/zhuanti/20160707/js/fileinput_locale_zh.js" type="text/javascript"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js" type="text/javascript"></script>
    <script>
	   
		$("#submit").click(function(){
				//表单验证
				var title = $("#title").val();
				var years = $("#years").val();
				var data_time = $("#data_time").val();
				var price = $("#price").val();
				var contents = $("#contents").val();
				var user_name = $("#user_name").val();
				if(user_name == ''){
					alert("请输入您的姓名");
					return false;
				}
				if(title == ''){
					alert("请输入藏品名称");
					return false;
				}

				if(document.getElementById("img_file")==undefined){
					alert("请至少选择一张图片上传");
					return false;
				}

				if(years == ''){
					alert("请输入藏品年代");
					return false;
				}

				if(data_time == ''){
					alert("请输入入手时间");
					return false;
				}

				if(price == ''){
					alert("请输入入手价格");
					return false;
				}
				if(contents == ''){
					alert("请输入藏品介绍");
					return false;
				}


				document.getElementById('myform').submit();
		});
		$("#file-5").fileinput({
			allowedFileExtensions : ['gif','jpg','jpeg','bmp','png'],
	        maxFilesNum: 10
		});
	 
	</script>    