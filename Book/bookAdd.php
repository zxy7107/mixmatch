<?php
require_once '../controller/CheckLoginState.php';
?>
<html>
  <head> 
    <title>图书信息登记</title>  
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
    <link href="../css/add_modify.css" rel="stylesheet" type="text/css"  /> 
    <script src="../js/util.js"  language="JavaScript"></script> 
   <script src="../js/calendar.js"></script>
   <script type="text/javascript">
        function CheckForm() {
            var barcode = document.getElementById("barcode").value;
            var bookName = document.getElementById("bookName").value;
            
            var count = document.getElementById("count").value;
            var price = document.getElementById("price").value;
 
            var publishDate = document.getElementById("publishDate").value;

            var re = /^[0-9]+.?[0-9]*$/;
            var resc=/^[1-9]+[0-9]*]*$/ ;

            if (barcode == "") {
                alert("请输入图书条形码...");
                document.getElementById("barcode").focus();
                return false;
            }
                
            if (bookName == "") {
                alert("请输入图书名称...");
                document.getElementById("bookName").focus();
                return false;
            }
            
           
          
            if(count == ""){
                alert("请输入库存...");
                document.getElementById("count").focus();
                return false;
            }     
            else if (!resc.test(count))
            {
                alert("库存请输入数字");
                document.getElementById("count").focus();
                //input.rate.focus();
                return false;
            }
                 
                 
             if(price == ""){
                alert("请输入价格...");
                document.getElementById("price").focus();
                return false;
            }     
            else if (!re.test(price))
            {
                alert("价格请输入数字");
                document.getElementById("price").focus();
                //input.rate.focus();
                return false;
            }
            
            if(publishDate == ""){
                alert("请输入出版日期...");
                document.getElementById("publishDate").focus();
                return false;
            } 
            document.forms[0].submit();        
       } 
    </script>
  </head>
  
  <body>  

  <div id="container">
  	<div id="title">
  		<img src="../images/ADD.gif" />图书信息录入 (带*号的为必填项)
  	</div>
  	<div id="content">
  		<form method="post" name="bookAddForm" action="../controller/BookAction.php?action=add" enctype="multipart/form-data">  
  		<br/> 
		
		<p>
		     图书条形码: &nbsp;
		  <input id="barcode" class="text" type="text" style="width:200px" value="" name="book[barcode]"/> 
		  <font color=red>*</font> 
        </p>

        <p>图书名称:&nbsp;
          <input id="bookName" class="text" type="text" style="width:200px" value="" name="book[bookName]"/> 
          <font color=red>*</font> 
        </p>
        
        <p>图书所在类别:&nbsp; 
            <select name="book[bookType]">
            <?php 
            	require_once '../service/BookClassService.class.php';
            	$bookClassService = new BookClassService();
            	$bookClass_res = $bookClassService->QueryAllBookClass();
            	for($i=0;$i<count($bookClass_res);$i++) {
					$row = $bookClass_res[$i];
					echo "<option value={$row['bookClassId']}>{$row['bookClassName']}</option>";

				}
            ?>
             
            </select>   
       </p>

       <p>图书价格:&nbsp;
          <input id="price" class="text" type="text" style="width:60px" value="" name="book[price]"/>
          <font color=red>*</font> 
       </p>
              
       <p>库存:&nbsp;
          <input id="count" class="text" type="text" style="width:60px" value="" name="book[count]"/> 
          <font color=red>*</font>
       </p>

       <p>出版社:&nbsp;
         <input id="publish" class="text" type="text" style="width:200px" value="" name="book[publish]"/>     
         
       </p>
       
       
       <p>出版日期:&nbsp;
         <input id="publishDate" type="text" class="text" readonly id="book[publishDate]"  name="book[publishDate]" onclick="setDay(this);"/>    
         <font color=red>*</font> 
       </p>
       
       
       <p>图书图片:&nbsp;
          <input class="text" type="file" style="width:200px" value="" name="photo"/>  
        </p>
 
		
		<p>
		   <input type="button" style="cursor:hand;"  class="btn" value="添加" onClick="CheckForm();"  />
		</p> 
		
		</form>
  	</div>
  </div> 
			  
  </body>
</html>