<!--#include file="ubb.asp"-->
<%
If request("content")="" Then 
	response.write"请输入内容<a href=""javascript:history.go(-1)"">返回</a>"
else
	response.write Ubbcode(request("content"))
End If 
%>