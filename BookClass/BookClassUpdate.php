 <?php 
 	require_once '../controller/CheckLoginState.php';
 	require_once '../service/BookClassService.class.php'; 
 	require_once '../phpbean/BookClass.class.php'; 
  
 	$bookClassId = $_GET['bookClassId'];
 	$bookClassService = new BookClassService();
 	$bookClass = $bookClassService->GetBookClass($bookClassId);
  
 ?>
 <html>
  <head>  
    <title>修改图书类别信息</title> 
 	<link href="/css/add_modify.css" rel="stylesheet" type="text/css"  />
 	<script src="/js/util.js" type="text/javascript"></script>
 	 <script type="text/javascript">
        function CheckForm() {
             
            var bookClassName = document.getElementById("bookClassName").value; 
          

            var re = /^[0-9]+.?[0-9]*$/;
            var resc=/^[1-9]+[0-9]*]*$/ ;

            if (bookClassName == "") {
                alert("请输入图书类别名称...");
                document.getElementById("bookClassName").focus();
                return false;
            } 
            document.forms[0].submit();        
       } 
    </script> 
 </head> 
  <body>
  
  <div id="container">  
	<div id="title">
		<table width="100%" border="0" cellpadding="0" cellspacing="2" align="center">
		<tr> 
		    <td height="21"> <img src="../images/ico/ico29.gif" width="32" height="32" hspace="2" vspace="2" align="absmiddle"> <strong> 图书类别信息修改 </font></td>
		  </tr>
		</table>
	</div>
	
	<div id="content">
		<form id="form1" method="post" action="/controller/BookClassAction.php?action=update">
		
		<p> 
			图书类别编号:&nbsp;<input type="text" readonly name="bookClass[bookClassId]"" value='<?php echo $bookClass->getBookClassId() ?>'  class="text"/>&nbsp; 
		    <script>writeSpaces(40);</script>
		 
		</p>
		
		<p> 
			图书类别名称:&nbsp;<input id="bookClassName" type="text" name="bookClass[bookClassName]" value='<?php echo $bookClass->getBookClassName() ?>'  class="text"/>&nbsp; 
		    <script>writeSpaces(40);</script>
		 
		</p>
		<p>
		   <input type="button" style="cursor:hand;"  class="btn" value="修改" onClick="CheckForm();"  />
		</p>  
		
		 
		</form>
	</div>
</div>
    
  </body>
</html>
