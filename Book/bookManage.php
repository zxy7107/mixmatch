<?php 
   require_once '../controller/CheckLoginState.php';
 ?>
<html>
<head>
<title>图书信息管理系统 - 图书信息管理</title>
<link href="../css/manage.css" rel="Stylesheet" type="text/css" />  
<script src="../opennew/alert.js" type="text/javascript"></script> 
<script src="../opennew/Dialog.js" type="text/javascript"></script> 
<script src="../js/ajax.js" type="text/javascript"></script> 
<script src="../js/util.js" type="text/javascript"></script> 
<script src="../js/calendar.js"></script>
<script>
function changepage(totalPage)
{
    var pageValue=document.bookQueryForm.pageValue.value;
    if(pageValue>totalPage) {
        alert('你输入的页码超出了总页数!');
        return ;
    }
    document.bookQueryForm.pageNow.value = pageValue;
    document.bookQueryForm.submit();
} 

/*跳转到查询结果的某页*/
function GoToPage(currentPage/*,totalPage*/) {
    //if(currentPage==0) return;
    //if(currentPage>totalPage) return;
    document.forms[0].pageNow.value = currentPage;
    document.forms[0].submit();

}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
</head>

<body> 
  <div id="container">  
	<div id="title">
  		<table width="98%" border="0" cellpadding="0" cellspacing="2" align="center">
		<tr> 
		    <td height="21"> <img src="../images/ico/ico08.gif" alt=""/><strong>图书信息管理</strong>
		    <script type="text/javascript">writeSpaces(105);</script>
		    <img src="../images/print.jpg" title="打印"  style="cursor:hand;" alt="" onclick="preview();"> </td>
		  </tr>
		</table>
  	</div>
	
	<div id="content"> 
	    <form id="bookQueryForm"  name="bookQueryForm" action="../controller/BookAction.php?action=query" method="post">
  		 <!--startprint--> 
  		<table width="98%" border="1" cellspacing="1" cellpadding="2" align="center"  style="margin:0px;"> 
	 		<tr>
				<td colspan="9">  
				    条形码:
	  			 <input class="text" type="text" style="width:200px" value="<?php echo $barcode?>" name="barcode"/> 
				  图书名称:<input class="text" type="text" style="width:200px" value="<?php echo $bookName?>" name="bookName"/>   
				 <br/> 图书类别:
				     <select name="bookType">
				     <option value="0">不限制</option>
		            <?php  
		            	for($i=0;$i<count($bookClass_res);$i++) {
							$row = $bookClass_res[$i];
							if($bookType!=$row['bookClassId'])
								echo "<option value={$row['bookClassId']}>{$row['bookClassName']}</option>";
							else
								echo "<option selected value={$row['bookClassId']}>{$row['bookClassName']}</option>";
						}
		            ?> 
           			 </select>    
           			 出版日期:<input type="text" class="text" readonly value="<?php echo $publishDate?>"  name="publishDate" onclick="setDay(this);"/>
					<input type=hidden name=pageNow value="1" />
	  				<input type="button"  class="btn" value="查询" onClick="javascript:document.forms[0].submit();"  />
				</td>
  			</tr>
  		</table>
  		
  		
		<table width="98%" border="1" cellspacing="1" cellpadding="2" align="center" style="margin:0px;"> 
  			 <tr class="a1" style="color:#ffffff;font-size:12px;">
   				        <th height="30">图书条形码</th>
				        <th>图书名称</th> 
				        <th>图书类型</th> 
				        <th>图书价格</th> 
				        <th>图书库存</th> 
				        <th>图书出版社</th> 
				        <th>出版日期</th> 
				        <th>图书图片</th>  
				        <th width="40px">操作</th>	
  			        </tr>  
  			
<?php 

for($i=0;$i<count($fenyePage->res_array);$i++) {
	$row = $fenyePage->res_array[$i];
	$row['bookType'] = $bookClassService->GetBookClass($row['bookType'])->getBookClassName();
	echo "<tr><td id=barcode_{$row['barcode']}>{$row['barcode']}</td>";
	echo "<td id=bookName_{$row['barcode']}>{$row['bookName']}</td>";
	echo "<td id=bookType_{$row['barcode']}>{$row['bookType']}</td>";
	echo "<td id=price_{$row['barcode']}>{$row['price']}</td>";
	echo "<td id=count_{$row['barcode']}>{$row['count']}</td>";
	echo "<td id=publish_{$row['barcode']}>{$row['publish']}</td>";
	echo "<td id=publishDate_{$row['barcode']}>". date("Y-m-d",strtotime($row['publishDate']))."</td>"; 
	echo "<td align='center' id=photo_{$row['barcode']}><img width='50px' height='50px' src=\"{$row['photo']}\" /></td>"; 
	echo "<td><div align='left'><a href='#' onclick=\"OpenEditBook('{$row['barcode']}', '修改图书信息','{$row['barcode']}');\">修改</a>&nbsp;&nbsp;</div><div align=\"right\"><a href='BookAction.php?action=del&barcode={$row['barcode']}' onclick=\"return confirm('警告：您确认删除吗？');\">删除</a></div></td>";
	echo "</tr>";
	  
}
echo "<input type=button id='Ajax_Btn' style='display:none;' onclick='Ajax_GetBook();' />";
echo "</table>";
 
//显示上一页和下一页
echo $fenyePage->navigate; 
 
?>
&nbsp;跳转到： <input name="pageValue" type="text" size="4" style="height:20px; width:30px; border:1px solid #999999;" />页
<img src="../images/go.gif" style="cursor:hand;" onclick="changepage(<?php echo $fenyePage->pageCount ?>);" width="37" height="15" />
		<!--endprint--> 
		</form>
	</div>
</div>
</body>
</html>