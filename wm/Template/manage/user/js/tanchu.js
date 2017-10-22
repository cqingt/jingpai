// JavaScript Document
//鼠标点击弹出，再次点击隐藏
function ShowDisplay(id){
	if(document.getElementById("tr"+id).style.display=="none"){
		document.getElementById("tr"+id).style.display="";
	}else{
		document.getElementById("tr"+id).style.display="none";
	}
	}