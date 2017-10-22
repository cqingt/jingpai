// JavaScript Document
var isIe=(document.all)?true:false;
//设置select的可见状态
function setSelectState(state)
{
var objl=document.getElementsByTagName('select');
for(var i=0;i<objl.length;i++)
{
objl[i].style.visibility=state;
}
}
function mousePosition(ev)
{
if(ev.pageX || ev.pageY)
{
return {x:ev.pageX, y:ev.pageY};
}
return {
x:ev.clientX + document.body.scrollLeft - document.body.clientLeft,y:ev.clientY + document.body.scrollTop - document.body.clientTop
};
}
//弹出方法
function showMessageBox(wTitle,content,pos,wWidth)
{
	closeWindow();
	var bWidth=parseInt(document.documentElement.scrollWidth);
	var bHeight=parseInt(document.documentElement.scrollHeight);
	if(isIe){
	setSelectState('hidden');}
	var back=document.createElement("div");
	back.id="back";
	var styleStr="top:0px;left:0px;position:absolute;background:#000;width:"+bWidth+"px;height:"+bHeight+"px;";
	styleStr+=(isIe)?"filter:alpha(opacity=0);":"opacity:0;";
	back.style.cssText=styleStr;
	document.body.appendChild(back);
	showBackground(back,50);
	var mesW=document.createElement("div");
	mesW.id="dingzhik";
	mesW.className="mesWindow";
	var dingzhik = document.getElementById("dingzhik");
	mesW = dingzhik;
	
	
	styleStr="left:"+(bWidth-815)/2+"px;top:"+(bHeight-415)/2+"px;position:absolute;";
	mesW.style.cssText=styleStr;
	document.body.appendChild(mesW);
}
//让背景渐渐变暗
function showBackground(obj,endInt)
{
	if(isIe)
	{
		obj.filters.alpha.opacity+=50;
		if(obj.filters.alpha.opacity<endInt)
		{
			setTimeout(function(){showBackground(obj,endInt)},100);
		}
		}else{
			var al=parseFloat(obj.style.opacity);al+=0.5;
			obj.style.opacity=al;
		
			if(al<(endInt/100))
			{
				setTimeout(function(){showBackground(obj,endInt)},0);
			}
	}
}
//关闭窗口
function closeWindow()
{
	if(document.getElementById('back')!=null)
	{
		document.getElementById('back').parentNode.removeChild(document.getElementById('back'));
	}
	if(document.getElementById('mesWindow')!=null)
	{
		document.getElementById('mesWindow').parentNode.removeChild(document.getElementById('mesWindow'));
	}
	if(isIe)
	{
		setSelectState('');
	}
}
//测试弹出
function testMessageBox(ev)
{
	var objPos = mousePosition(ev);
	messContent="<div style='padding:20px 0 20px 0;text-align:center'>消息正文</div>";
	showMessageBox('writebg',messContent,objPos,575);
}