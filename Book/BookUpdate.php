 <?php 
  
    require_once '../controller/CheckLoginState.php'; 
 	require_once '../service/BookService.class.php'; 
 	require_once '../phpbean/Book.class.php';
 	
 	$barcode = $_GET['barcode'];
 	$bookService = new BookService();
 	$book = $bookService->GetBook($barcode);
  
 ?>
 <html>
  <head>  
    <title>修改图书信息</title> 
 	<link href="/css/add_modify.css" rel="stylesheet" type="text/css"  />
 	<script src="/js/util.js" type="text/javascript"></script>
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
		<table width="100%" border="0" cellpadding="0" cellspacing="2" align="center">
		<tr> 
		    <td height="21"> <img src="../images/ico/ico29.gif" width="32" height="32" hspace="2" vspace="2" align="absmiddle"> <strong> 图书信息修改 </font></td>
		  </tr>
		</table>
	</div>
	
	<div id="content">
		<form id="form1" method="post" action="/controller/BookAction.php?action=update" enctype="multipart/form-data">
		 
		<p>
		     图书条形码: &nbsp;
		  <input id="barcode" class="text" type="text" readonly style="width:200px" value="<?php echo $book->getBarcode()?>" name="book[barcode]"/> 
		  <font color=red>*</font> 
        </p>

        <p>图书名称:&nbsp;
          <input id="bookName" class="text" type="text" style="width:200px" value="<?php echo $book->getBookName()?>" name="book[bookName]"/> 
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
					if($row['bookClassId'] == $book->getBookType())
						echo "<option selected value={$row['bookClassId']}>{$row['bookClassName']}</option>";
					else
						echo "<option value={$row['bookClassId']}>{$row['bookClassName']}</option>";

				}
            ?>
             
            </select>   
       </p>

       <p>图书价格:&nbsp;
          <input id="price" class="text" type="text" style="width:60px" value="<?php echo $book->getPrice()?>" name="book[price]"/>
          <font color=red>*</font> 
       </p>
              
       <p>库存:&nbsp;
          <input id="count" class="text" type="text" style="width:60px" value="<?php echo $book->getCount()?>" name="book[count]"/> 
          <font color=red>*</font>
       </p>

       <p>出版社:&nbsp;
         <input id="publish" class="text" type="text" style="width:200px" value="<?php echo $book->getPublish()?>" name="book[publish]"/>     
       </p>
       
       
       <p>出版日期:&nbsp; 
         <input id="publishDate" type="text" class="text" readonly id="book[publishDate]" value="<?php echo date("Y-m-d",strtotime($book->getPublishDate()));?>"  name="book[publishDate]" onclick="setDay(this);"/>    
       </p>
       
       
       <p>图书图片:&nbsp; 
           <img src="<?php echo $book->getPhoto()?>" width="200px" border="0px"/><br/>
    	   <input class="text" type="file" style="width:200px" value="" name="photo"/>
        </p>
        
		<p>
		   <input type="button" style="cursor:hand;"  class="btn" value="修改" onClick="CheckForm();"  />
		</p>  
		 
		</form>
	</div>
</div>
    
  </body>
</html>
