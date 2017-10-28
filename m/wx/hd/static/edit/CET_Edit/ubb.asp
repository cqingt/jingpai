<%

Public Function Ubbcode(strcontent)
	dim re
	Set re=new RegExp
	re.IgnoreCase =true
	re.Global=True
    strcontent="<style>*{ word-break:break-all;word-wrap:break-word;}.blockcode, .quote { font-size: 12px; margin: 10px 20px; border: solid #CAD9EA; border-width: 4px 1px 1px; background: #FFF url(""images/portalbox_bg.gif""); background-repeat: repeat-x; background-position: 0 0; overflow: hidden; }.blockcode h5, .quote h5 { border: 1px solid; border-color: #FFF #FFF #CAD9EA #FFF; height:20px;line-height: 26px; padding-left: 5px; color: #666; }.blockcode code, .quote blockquote { margin: 1em 1em 1em 3em; line-height: 1.6em; }.blockcode code { font: 14px/1.4em ""Courier New"", Courier, monospace; display: block; padding: 5px; }.blockcode em { float: right; line-height: 1em; padding: 10px 10px 0 0; color: #666; font-size: 12px; cursor: pointer; padding-top: 5px; }.floatcode{padding:5px;font-size: 12px; border: solid #CAD9EA; border-width: 1px; background: #FFF ; overflow: hidden; clear:both;}</style>"&server.htmlencode(strcontent)
	'strcontent=Replace(strcontent,"file:","file :")
	'strcontent=Replace(strcontent,"files:","files :")
	'strcontent=Replace(strcontent,"script:","script :")
	'strcontent=Replace(strcontent,"js:","js :")
    
    'ͼƬUBB
	re.pattern="\[img\](http|https|ftp):\/\/(.[^\[]*)\[\/img\]"
	strcontent=re.replace(strcontent,"<a onfocus=""this.blur()"" href=""$1://$2"" target=new><img src=""$1://$2"" border=""0"" alt=""�������´������ͼƬ"" onload=""javascript:if(this.width>screen.width-333)this.width=screen.width-333""></a>")

	re.pattern="\[img=*([0-9]*),*([0-9]*)\](http|https|ftp):\/\/(.[^\[]*)\[\/img\]"
	strcontent=re.replace(strcontent,"<a onfocus=""this.blur()"" href=""$3://$4"" target=new><img src=""$3://$4"" border=""0""  width=""$1"" heigh=""$2"" alt=""�������´������ͼƬ"" onload=""javascript:if(this.width>screen.width-333)this.width=screen.width-333""></a>")
	'����UBB
	re.pattern="(\[url\])(.[^\[]*)(\[url\])"
	strcontent= re.replace(strcontent,"<a href=""$2"" target=""new"">$2</a>")
	re.pattern="\[url=(.[^\[]*)\]"
	strcontent= re.replace(strcontent,"<a href=""$1"" target=""new"">")
	'����UBB
	re.pattern="(\[email\])(.*?)(\[\/email\])"
	strcontent= re.replace(strcontent,"<img align=""absmiddle"" ""src=images/common/bb_email.gif""><a href=""mailto:$2"">$2</a>")
	re.pattern="\[email=(.[^\[]*)\]"
	strcontent= re.replace(strcontent,"<img align=""absmiddle"" src=""images/common/bb_email.gif""><a href=""mailto:$1"" target=""new"">")
	'QQ����UBB
	re.pattern="\[qq]([0-9]*)\[\/qq\]"
	strcontent= re.replace(strcontent,"<a target=""new"" href=""tencent://message/?uin=$1&Site=http://www.52515.net&Menu=yes""><img border=""0"" src=""http://wpa.qq.com/pa?p=4:$1:4"" alt=""���������ҷ���Ϣ""></a>")
    '��ɫUBB
	re.pattern="\[color=(.[^\[]*)\]"
	strcontent=re.replace(strcontent,"<font color=""$1"">")
	'��������UBB
	re.pattern="\[font=(.[^\[]*)\]"
	strcontent=re.replace(strcontent,"<font face=""$1"">")
	'���ִ�СUBB
	re.pattern="\[size=([0-9]*)\]"
	strcontent=re.replace(strcontent,"<font size=""$1"">")
	re.pattern="\[size=([0-9]*)pt\]"
	strcontent=re.replace(strcontent,"<font size=""$1"">")
	re.pattern="\[size=([0-9]*)px\]"
	strcontent=re.replace(strcontent,"<font size=""$1"">")
	'���ֶ��뷽ʽUBB
	re.pattern="\[align=(center|left|right)\]"
	strcontent=re.replace(strcontent,"<div align=""$1"">")
	'����UBB
	re.pattern="\[table=(.[^\[]*),(.*?)\]"
	strcontent=re.replace(strcontent,"<table width=""$1"" border=""1"" style=""border-collapse:collapse;background:$2"">")


	re.pattern="\[table=(.[^\[]*)\]"
	strcontent=re.replace(strcontent,"<table width=""$1"" border=""1"" style=""border-collapse:collapse;"">")
    '����UBB2
	re.pattern="\[td=([0-9]*),([0-9]*),(.*?)\]"
	strcontent=re.replace(strcontent,"<td colspan=""$1"" rowspan=""$2"" width=""$3"">")
    re.pattern="\[td=([0-9]*),([0-9]*)\]"
	strcontent=re.replace(strcontent,"<td colspan=""$1"" rowspan=""$2"">")

	'������б
	re.Pattern="\[i\]((.|\n)*?)\[\/i\]"
	strContent=re.Replace(strContent,"<i>$1</i>")
	'��������
	re.pattern="\[float=(left|right)\]"
	strcontent=re.replace(strcontent,"<div style=""float:$1"" class=""floatcode"">")

    'media
	re.pattern="\[media=(ra),*([0-9]*),*([0-9]*),*([0-1]*)\](http://.[^\[]*)\[\/media\]"
	strcontent= re.replace(strcontent,"<object classid=""clsid:CFCDAA03-8BE4-11CF-B84B-0020AFBBCCFA"" width=""$2"" height=""32""><param name=""autostart"" value=""$4"" /><param name=""src"" value=""$5"" /><param name=""controls"" value=""controlpanel"" /><param name=""console"" value=""mediaid"" /><embed src=""$5"" type=""audio/x-pn-realaudio-plugin"" width=""$2"" height=""32""></embed></object>")
	
	re.pattern="\[media=(rm|rmvb),*([0-9]*),*([0-9]*),*([0-1]*)\](http://.[^\[]*)\[\/media\]"
	strcontent= re.replace(strcontent,"<object classid=""clsid:CFCDAA03-8BE4-11cf-B84B-0020AFBBCCFA"" width=""$2"" height=""$3""><param name=""autostart"" value=""$4""/><param name=""src"" value=""$5""/><param name=""controls"" value=""imagewindow""/><param name=""console"" value=""mediaid""/><embed src=""$5"" type=""audio/x-pn-realaudio-plugin"" controls=""IMAGEWINDOW"" console=""mediaid"" width=""$2"" height=""$3""></embed></object><br/><object classid=""clsid:CFCDAA03-8BE4-11CF-B84B-0020AFBBCCFA"" width=""$2"" height=""32""><param name=""src"" value=""$5"" /><param name=""controls"" value=""controlpanel"" /><param name=""console"" value=""mediaid"" /><embed src=""$5"" type=""audio/x-pn-realaudio-plugin"" controls=""ControlPanel""  console=""mediaid"" width=""$2"" height=""32""></embed></object>")

	re.pattern="\[media=(wma),*([0-9]*),*([0-9]*),*([0-1]*)\](http://.[^\[]*)\[\/media\]"
	strcontent= re.replace(strcontent, "<object classid=""clsid:6BF52A52-394A-11d3-B153-00C04F79FAA6"" width=""$2"" height=""64""><param name=""autostart"" value=""$4"" /><param name=""url"" value=""$5"" /><embed src=""$5"" autostart=""$4"" type=""audio/x-ms-wma"" width=""$2"" height=""64""></embed></object>")

	re.pattern="\[media=(mp3),*([0-9]*),*([0-9]*),*([0-1]*)\](http://.[^\[]*)\[\/media\]"
	strcontent= re.replace(strcontent,"<object classid=""clsid:6BF52A52-394A-11d3-B153-00C04F79FAA6"" width=""$2"" height=""64""><param name=""autostart"" value=""$4"" /><param name=""url"" value=""$5"" /><embed src=""$5"" autostart=""$4"" type=""application/x-mplayer2"" width=""$2"" height=""64""></embed></object>")

	re.pattern="\[media=(wmv),*([0-9]*),*([0-9]*),*([0-1]*)\](http://.[^\[]*)\[\/media\]"
	strcontent= re.replace(strcontent,"<object classid=""clsid:6BF52A52-394A-11d3-B153-00C04F79FAA6"" width=""$2"" height=""$3""><param name=""autostart"" value=""$4"" /><param name=""url"" value=""$5"" /><embed src=""$5"" autostart=""$4"" type=""video/x-ms-wmv"" width=""$2"" height=""$3""></embed></object>")

	re.pattern="\[media=(mov),*([0-9]*),*([0-9]*),*([0-1]*)\](http://.[^\[]*)\[\/media\]"
	strcontent= re.replace(strcontent,"<object classid=""clsid:02BF25D5-8C17-4B23-BC80-D3488ABDDC6B"" width=""$2"" height=""$3""><param name=""autostart"" value=""$4"" /><param name=""src"" value=""$5"" /><embed controller=""true"" width=""$2"" height=""$3"" src=""$5"" autostart="""&autostart &"""></embed></object>")


    strcontent=replace(strcontent,vbcrlf,"<BR/>")
	re.pattern="\[code\]((.|\n)*?)\[\/code\]"
	Set tempcodes=re.Execute(strcontent)
	For i=0 To tempcodes.count-1
	  re.pattern="<BR/>"
	  tempcode=Replace(tempcodes(i),"<BR/>",vbcrlf)
	  strcontent=replace(strcontent,tempcodes(i),tempcode)
	next

    searcharray=Array("[/url]","[/email]","[/color]", "[/size]", "[/font]", "[/align]", "[b]", "[/b]","[u]", "[/u]", "[list]", "[list=1]", "[list=a]","[list=A]", "[*]", "[/list]", "[indent]", "[/indent]","[code]","[/code]","[quote]","[/quote]","[free]","[/free]","[hide]","[/hide]","[tr]","[td]","[/td]","[/tr]","[/table]","[/float]")
	replacearray=Array("</a>","</a>","</font>", "</font>", "</font>", "</div>", "<b>", "</b>","<u>", "</u>", "<ul>", "<ol type=1>", "<ol type=a>","<ol type=A>", "<li>", "</ul></ol>", "<blockquote>", "</blockquote>","<div><textarea name=""codes"" id=""codes"" rows=""14"" cols=""60"">","</textarea><br/><input type=""button"" value=""���д���"" onclick=""RunCode()"" accesskey=""r""> <input type=""button"" value=""���ƴ���"" onclick=""CopyCode()"" accesskey=""c""><input type=""button"" value=""�������"" onclick=""SaveCode()"" accesskey=""s""> <input type=""button"" value=""��&nbsp;&nbsp;ת"" onclick=""Goto(prompt('������Ҫ��ת���ڼ��У�','1'))""  accesskey=""g""></div>","<div class=""quote""><h5>����:</h5><blockquote>","</blockquote></div>","<div class=""quote""><h5>�������:</h5><blockquote>","</blockquote></div>","<div class=""quote""><h5>��������:</h5><blockquote>","</blockquote></div>","<tr>","<td>&nbsp;","</td>","</tr>","</table>","</div>")
	For i=0 To UBound(searcharray)
		strcontent=replace(strcontent,searcharray(i),replacearray(i))
	next
	set re=Nothing
	Ubbcode=strcontent
End Function


%> 