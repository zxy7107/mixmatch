<?php
require_once '../controller/CheckLoginState.php';
?>
<html>
<head>
<title>图书信息管理系统 - 图书类别管理</title>
<link href="../css/manage.css" rel="Stylesheet" type="text/css" />  
<script src="../opennew/alert.js" type="text/javascript"></script> 
<script src="../opennew/Dialog.js" type="text/javascript"></script> 
<script src="../js/ajax.js" type="text/javascript"></script> 
<script src="../js/util.js" type="text/javascript"></script> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head>

<body> 
  <div id="container">  
	<div id="title">
  		<table width="98%" border="0" cellpadding="0" cellspacing="2" align="center">
		<tr> 
		    <td height="21"> <img src="../images/ico/ico08.gif" alt=""/><strong>图书类别信息管理</strong>
		    <script type="text/javascript">writeSpaces(105);</script>
		    <img src="../images/print.jpg" title="打印"  style="cursor:hand;" alt="" onclick="preview();"> </td>
		  </tr>
		</table>
  	</div>
	
	<div id="content"> 
	  
  		<!--startprint--> 
		<table width="98%" border="1" cellspacing="1" cellpadding="2" align="center" style="margin:0px;"> 
  			 <tr class="a1" style="color:#ffffff;font-size:12px;">
   				        <th height="30">类别编号</th>
				        <th>类别名称</th> 
				        <th width="40px">操作</th>	
  			        </tr>  
  			
<?php 

for($i=0;$i<count($fenyePage->res_array);$i++) {
	$row = $fenyePage->res_array[$i];
	echo "<tr><td id=bookClassId_{$row['bookClassId']}>{$row['bookClassId']}</td>";
	echo "<td id=bookClassName_{$row['bookClassId']}>{$row['bookClassName']}</td>";
	echo "<td><div align='left'><a href='#' onclick=\"OpenEditBookClass({$row['bookClassId']}, '修改图书类别信息',{$row['bookClassId']});\">修改</a>&nbsp;&nbsp;</div><div align=\"right\"><a href='BookClassAction.php?action=del&bookClassId={$row['bookClassId']}' onclick=\"return confirm('警告：您确认删除吗？');\">删除</a></div></td>";
	echo "</tr>";
	  
}
echo "<input type=button id='Ajax_Btn' style='display:none;' onclick='Ajax_GetBookClass();' />";
echo "</table>";
 
//显示上一页和下一页
echo $fenyePage->navigate;

 
 
?>
<form action="/controller/BookClassAction.php?action=query" method="post">
跳转到：<input type="text" name="pageNow"/>
<input type="submit" value="GO"/>
 
		<!--endprint-->
</form>	 
	</div>
</div>
</body>
</html>