<!--#include file="ubb.asp"-->
<%
If request("content")="" Then 
	response.write"����������<a href=""javascript:history.go(-1)"">����</a>"
else
	response.write Ubbcode(request("content"))
End If 
%>