function delConfirm(obj){
	asyncbox.confirm('你确认要删除改条信息吗？一旦删除无法恢复!','友情提示',function(action){
		if(action == 'ok'){
			$.close('id');
			var url = $(obj).attr('href');
			window.location.href = url;
		}
	});
	return false;
}


function sendConfirm(obj){
	asyncbox.confirm('你确认要执行重复发送吗!','友情提示',function(action){
		if(action == 'ok'){
			$.close('id');
			var url = $(obj).attr('href');
			window.location.href = url;
		}
	});
	return false;
}

function showPOP(url,w,h,title){
	asyncbox.open({
		url : url,
		width : w,
		height : h,
		title : title
	});
}

//域名可用性验证
function verDomain(str){
	var regExp = /([a-zA-Z0-9]+)\.([a-zA-Z0-9\-]+)\.([a-zA-Z\-\.]+)$/i;
	if( str.match(regExp) == null ){
		return false;
	}else{
		return true
	}
}

//汉字验证
function checkChinese(str){
	/*
	var regExp = /[\u4E00-\u9FA5]/;
	if( str.match(regExp) == null ){
		return false;
	}else{
		return true
	}
	*/

	if(str != str.replace(/[^\u4E00-\u9FA5]/g,'')){
	   return false;
	}else{
		return true
	}
}

//手机验证
function checkMobile(str){
	if(str.length!=11){	return false; }

	if(!(/^1[3|4|5|8][0-9]\d{4,8}$/.test(str))){ 
		return false; 
	}else{
		return true;
	}
}

//邮箱验证
function checkMail(str){
	var regExp = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
	if( str.match(regExp) == null ){
		return false;
	}else{
		return true
	}
}

//一级菜单复选框函数
function selectBoxParent(ID){
	var a=$("#MenuID" + ID + ":checkbox").attr('checked');//获取当前一级菜单的选择情况
	if(a){
		var checked=true;
	}else{
		var checked=false;	
	}
	$("#K_" + ID + " input:checkbox").attr('checked',checked);	
}

//二级菜单复选框函数
function selectCheckBox(ID,SID){
	var a=$("#MenuID" + SID + ":checkbox").attr('checked');
	if(a){
		$("#K_" + SID + " input:checkbox").attr('checked',true);
		$("#MenuID" + ID + ":checkbox").attr('checked',true);
	}else{
		$("#K_" + SID + " input:checkbox").attr('checked',false);
		var items=$("#K_" + ID + " input:checked");
		Num=items.length;
		if(!Num){
			$("#MenuID" + ID + ":checkbox").attr('checked',false);
		}
	}
}

//三级菜单复选框函数
function selectBox(ID,SID,XID){
	if( $("#MenuID" + XID + ":checkbox").attr('checked') ){
		$("#MenuID" + SID + ":checkbox").attr('checked',true);	
		$("#MenuID" + ID + ":checkbox").attr('checked',true);	
	}else{
		var items = $("#K_" + SID + " input:checked");//获取三级被选中的复选框
		var Num=items.length;//将选中数量写入变量
		if(!Num){//判断不是否三级复选框没有一个被选中
			$("#MenuID" + SID + ":checkbox").attr('checked',false);//将三级复选框的二级复选框设定为未勾选
			var i = $("#K_" + ID + " input:checked");//获取二级被选中的复选框
			var iNum=i.length;//将二级复选框选中数量写入变量
			if(!iNum){//如果二级复选框选中数量为0，则将一级复选框设置为为勾选
				$("#MenuID" + ID + ":checkbox").attr('checked',false);
			}
		}
	}				
}

//删除确认
function DelConfirm(){
	if(confirm("你确定要删除该条数据吗!")){
		return true;
	}else{
		return false;
	}
}

//全选取消
function checkAll(status){
	if(status==1){
		status = true;
	}else{
		status = false;
	}
	$('input:checkbox').attr('checked',status);
}

//显示加载层
function showLayout(){
	$('#layout').show();
}