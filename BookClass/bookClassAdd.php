<?php
require_once '../controller/CheckLoginState.php';
?>
<html>
  <head> 
    <title>图书类别信息登记</title>  
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
    <link href="../css/add_modify.css" rel="stylesheet" type="text/css"  /> 
    <script src="../js/util.js"  language="JavaScript"></script>
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
  		<img src="../images/ADD.gif" />图书类别信息录入 (带*号的为必填项)
  	</div>
  	<div id="content">
  		<form method="post" name="form1" action="../controller/BookClassAction.php?action=add">  
  		<br/>
		<p>
			图书类别名称:&nbsp;<input id="bookClassName" type="text" name="bookClass[bookClassName]"  class="text"/>&nbsp; <font color=red>*</font>
		    <script>writeSpaces(40);</script>
			
		</p>
 
		
		<p>
		   <input type="button" style="cursor:hand;"  class="btn" value="添加" onClick="CheckForm();"  />
		  
		</p> 
		
		
		 
		</form>
  	</div>
  </div> 
			  
  </body>
</html>