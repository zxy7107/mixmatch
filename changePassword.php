<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
  <head> 
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
    <title>密码设置</title>  
    <link href="css/add_modify.css" rel="stylesheet" type="text/css"  /> 
    <script src="js/util.js" language="JavaScript"></script> 
  </head>
  
  <body> 
  <div id="container">
  	<div id="title">
  		<img src="../images/ADD.gif" />系统密码设置
  	</div>
  	<div id="content">
  	<br/>
  		<form  method="post" name="form1" action="/controller/changePasswordProcess.php">
		 
		 <p>
		    原始密码: &nbsp;
		  <input class="text" type="password" style="width:200px" value="" name="oldpassword"/> 
		  <font color=red>*</font> 
        </p>
		 
		 <p>
		     新密码: &nbsp;
		  <input class="text" type="password" style="width:200px" value="" name="newpassword"/> 
		  <font color=red>*</font> 
        </p>
        
        <p>
		     确认新密码: &nbsp;
		  <input class="text" type="password" style="width:200px" value="" name="newpassword2"/> 
		  <font color=red>*</font> 
        </p> 
        
        <p>
		   <input type="button"  class="btn" value="更新密码" onClick="javascript:document.forms[0].submit();"  />
		</p>  
		
		
		</form>
  	</div>
  </div> 
  
      <?php  
   //接受errno
 if (!empty($_GET['err'])) 
 	 echo "<script>alert('".$_GET['err']."');</script>";
 ?> 
  </body>
</html>