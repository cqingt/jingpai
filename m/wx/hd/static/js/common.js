function delConfirm(obj){
	asyncbox.confirm('��ȷ��Ҫɾ��������Ϣ��һ��ɾ���޷��ָ�!','������ʾ',function(action){
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

//������������֤
function verDomain(str){
	var regExp = /([a-zA-Z0-9]+)\.([a-zA-Z0-9\-]+)\.([a-zA-Z\-\.]+)$/i;
	if( str.match(regExp) == null ){
		return false;
	}else{
		return true
	}
}

//������֤
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

//�ֻ���֤
function checkMobile(str){
	if(str.length!=11){	return false; }

	if(!(/^1[3|4|5|8][0-9]\d{4,8}$/.test(str))){ 
		return false; 
	}else{
		return true;
	}
}

//������֤
function checkMail(str){
	var regExp = /^([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|\_|\.]?)*[a-zA-Z0-9]+\.[a-zA-Z]{2,3}$/;
	if( str.match(regExp) == null ){
		return false;
	}else{
		return true
	}
}

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

//ɾ��ȷ��
function DelConfirm(){
	if(confirm("��ȷ��Ҫɾ������������!")){
		return true;
	}else{
		return false;
	}
}

//ȫѡȡ��
function checkAll(status){
	if(status==1){
		status = true;
	}else{
		status = false;
	}
	$('input:checkbox').attr('checked',status);
}

//��ʾ���ز�
function showLayout(){
	$('#layout').show();
}