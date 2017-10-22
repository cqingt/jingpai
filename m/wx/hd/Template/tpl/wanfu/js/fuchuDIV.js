
function fabudisplay()
{
	var popUp = document.getElementById("choujiang")
	//document.getElementById('fabu_box').style.display='';
	
	var obj = document.getElementById("choujiang");
	var W = screen.width;//取得屏幕分辨率宽度
	var H = screen.height;//取得屏幕分辨率高度
	var yScroll;//取滚动条高度
	if (self.pageYOffset) {
	yScroll = self.pageYOffset;
	} else if (document.documentElement && document.documentElement.scrollTop){
	yScroll = document.documentElement.scrollTop;
	} else if (document.body) {
	yScroll = document.body.scrollTop;
	}
	
	//obj.style.marginLeft= (W/2 - 200) + "px";

	obj.style.display="block"; 
}
function fabudisplay2()
{
	var popUp = document.getElementById("liquan")
	//document.getElementById('fabu_box').style.display='';
	
	var obj = document.getElementById("liquan");
	var W = screen.width;//取得屏幕分辨率宽度
	var H = screen.height;//取得屏幕分辨率高度
	var yScroll;//取滚动条高度
	if (self.pageYOffset) {
	yScroll = self.pageYOffset;
	} else if (document.documentElement && document.documentElement.scrollTop){
	yScroll = document.documentElement.scrollTop;
	} else if (document.body) {
	yScroll = document.body.scrollTop;
	}
	
	//obj.style.marginLeft= (W/2 - 200) + "px";
	obj.style.top= (H/2- 　+　yScroll) + "px";
	obj.style.display="block"; 
}
// JavaScript Document