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

function CheckUser(status){
	var U_Number=$("#U_Number").val();
	var User=$("#U_UserName").val();
	if(!User || !U_Number){
		alert('商户号或用户名不能为空!');	
		return false;
	}
	$.ajax({
		url:"index.php?m=manageUserList&c=checkUser&p=admin&user=" + User + "&Number=" + U_Number + "&status=" + status,
		type:"GET",
		cache:false,
		success: function(html){
			var status=parseInt(html);
			if(status){
				$("#submit").attr('disabled','disabled');
				$("#U").html('该用户名已存在！');
			}else{
				$("#submit").removeAttr('disabled');
				$("#U").html('*');
			}
		}
	});	
}

function paddingvalp(num){
	var regx = /[\d.]/g;
	value = $("#p"+num).val();
	r = value.match(regx);
	if(r){
		for(i=num;i<20;i++){
			//if($("#p"+i).val() == ""){
				$("#p"+i).val(value)
			//}
		}
	}else{
		$("#p"+num).val("");
	}
	
}
function paddingvalt(num){
	var regx = /[\d.]/g;
	
	valuet = $("#t"+num).val();

	rt = valuet.match(regx);
	if(rt){
		for(i=num;i<20;i++){
			$("#t"+i).val(valuet)
		}
	}else{
		$("#t"+num).val("");
	}
}

function paddingvals(num){
	
	var regx = /[\d.]/g;
	
	values = $("#s"+num).val();

	rs = values.match(regx);
	if(rs){
		for(i=num;i<20;i++){
			$("#s"+i).val(values)
		}
	}else{
		$("#s"+num).val("");
	}
}