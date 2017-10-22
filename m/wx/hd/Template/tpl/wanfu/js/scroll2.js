window.onload=function(){
	var oDiv=document.getElementById('div2');
	var aUl=oDiv.getElementsByTagName('ul')[0];
	var aLi=oDiv.getElementsByTagName('li');
	
	var timer1=null
	
	aUl.innerHTML+=aUl.innerHTML;
	aUl.offsetHeight=aLi[0].style.height*aLi.length+'px';
	
	timer1=setInterval(function(){
		if(aUl.offsetTop<-aUl.offsetHeight/2){
			aUl.style.top='0';	
		}
		aUl.style.top=aUl.offsetTop-1+'px';	
	},30);
	
	oDiv.onmouseover=function(){
		clearInterval(timer1);
	}
	oDiv.onmouseout=function(){
		timer1=setInterval(function(){
		if(aUl.offsetTop<-aUl.offsetHeight/2){
			aUl.style.top='0';	
		}
		aUl.style.top=aUl.offsetTop-1+'px';	
	},30);
	}
}