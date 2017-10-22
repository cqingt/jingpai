  $(function(){
    var $plateBtn = $('#plateBtn');
    var $result = $('#result');
    var $resultTxt = $('#resultTxt');
    var $resultBtn = $('#resultBtn');
	var isClickIng = false;
    $plateBtn.click(function(){
	 //$("#plateBtn").unbind('click').css("cursor","default");
	 if (!isClickIng) {
	        isClickIng = true;
			  $.ajax({
					type:'post',
					url:"index.php?act=zhuanti&op=ad_20160110&action=chou_jiang",
					dataType:'json',
					success:function(result){
							if(result.error == -1){//未登录跳转到登录页面
								window.location.href="index.php?act=login&op=index";
								return false; 
							}else if(result.error == -3){
								alert("对不起，您未获得抽奖次数。");
								isClickIng = false;
								return false;
							}else if(result.error == -4){
								alert("对不起，活动已结束。");
								isClickIng = false;
								return false;
							}else{
								rotateFunc(0,result.angle,'恭喜您中了<em>'+result.prize+'</em>');
							}
					}
				});
		}
    });

    var rotateFunc = function(awards,angle,text){  //awards:奖项，angle:奖项对应的角度
      $plateBtn.stopRotate();
      $plateBtn.rotate({
        angle: 0,
        duration: 3000,
        animateTo: angle + 1800,  //angle是图片上各奖项对应的角度，1440是让指针固定旋转4圈
        callback: function(){
          $resultTxt.html(text);
          $result.show();
		  isClickIng = false;
        }
      });
    };

    $resultBtn.click(function(){
      $result.hide();
    });
  });