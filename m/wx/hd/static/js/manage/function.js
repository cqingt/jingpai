//һ���˵���ѡ����
function selectBoxParent(ID){
	var a=$("#MenuID" + ID + ":checkbox").attr('checked');//��ȡ��ǰһ���˵���ѡ�����
	if(a){
		var checked=true;
	}else{
		var checked=false;	
	}
	$("#K_" + ID + " input:checkbox").attr('checked',checked);	
}

//�����˵���ѡ����
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

//�����˵���ѡ����
function selectBox(ID,SID,XID){
	if( $("#MenuID" + XID + ":checkbox").attr('checked') ){
		$("#MenuID" + SID + ":checkbox").attr('checked',true);	
		$("#MenuID" + ID + ":checkbox").attr('checked',true);	
	}else{
		var items = $("#K_" + SID + " input:checked");//��ȡ������ѡ�еĸ�ѡ��
		var Num=items.length;//��ѡ������д�����
		if(!Num){//�жϲ��Ƿ�������ѡ��û��һ����ѡ��
			$("#MenuID" + SID + ":checkbox").attr('checked',false);//��������ѡ��Ķ�����ѡ���趨Ϊδ��ѡ
			var i = $("#K_" + ID + " input:checked");//��ȡ������ѡ�еĸ�ѡ��
			var iNum=i.length;//��������ѡ��ѡ������д�����
			if(!iNum){//���������ѡ��ѡ������Ϊ0����һ����ѡ������ΪΪ��ѡ
				$("#MenuID" + ID + ":checkbox").attr('checked',false);
			}
		}
	}				
}

function CheckUser(status){
	var U_Number=$("#U_Number").val();
	var User=$("#U_UserName").val();
	if(!User || !U_Number){
		alert('�̻��Ż��û�������Ϊ��!');	
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
				$("#U").html('���û����Ѵ��ڣ�');
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