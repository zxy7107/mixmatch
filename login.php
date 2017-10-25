 <?php
 /**
* FILE_NAME : login.php
* @copyright Copyright (c) www.shuangyulin.com
* @author 双鱼林 
* @联系QQ:287307421或254540457
*/
 
 ?>
 <html>
  <head>
    <link href="css/style.css" rel="stylesheet" type="text/css" />  
    <link href="css/login.css" rel="stylesheet" type="text/css" />  
    <title>图书管理系统----系统登录</title> 
    <script>
    function enterIn(evt){
  	  var evt=evt?evt:(window.event?window.event:null);//兼容IE和FF
  	  if (evt.keyCode==13){
  	    document.forms[0].submit();
  	  }
  	}
  	</script>
  </head> 
  <body>    

<div id="container">
	<div id="banner"><img src="images/TopTitle.gif" /></div> 
	<div id="LoginPanel">
	  <div id="Title"><img src="images/login.jpg" width="100%" /></div>
	  <div id="Content"> 
			<form  method="post" name="form1" action="./controller/loginProcess.php">
				<p>用户:<input type="text" name="username"  class="text"/></p>
				<p>密码:<input type="password" name="password" onkeydown="enterIn(event);" class="text"/></p>
                <p><input type="button"  class="btn" value="登录" onClick="javascript:document.forms[0].submit();"  /></p>
				 
			</form>
		</div>
	  </div> 
	    <?php  
   //接受errno
 if (!empty($_GET['errno']))
 {
 	if($_GET['errno']==1)
 	{
 		echo"<br/><font color='red' size='3'>你的用户名或密码错误</font>";
 	}
 } 
 ?>
	
	<div id="footer">
		<p>双鱼林设计 QQ:287307421或254540457 &nbsp;版权所有 <a href="http://www.shuangyulin.com" target="_blank">双鱼林设计网</a></p>
	</div>
</div>


	
</body>
</html> 

