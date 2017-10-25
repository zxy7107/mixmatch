<?php
require_once 'controller/CheckLoginState.php';
?>

<html>
<head> 
<title>php图书管理系统</title>
 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<link href="css/style.css" rel="stylesheet" type="text/css" /> 
<script src="js/treemenu.js" language="JavaScript"></script> 
<script src="opennew/Dialog.js" language="javascript"></script>
</head>
<body> 
<div id="container">
	<div id="banner"><img src="images/TopTitle.gif" /></div>
	<div id="globallink">
		<ul>
			<li><a href="#" onclick="javascript:ShowTreeNode(1);">图书类别</a></li>
			<li><a href="#" onclick="javascript:ShowTreeNode(2);">图书信息</a></li> 
			<li><a href="#" onclick="javascript:ShowTreeNode(3);">系统管理</a></li>
		</ul>
		<br />
	</div>
	 
	<div id="left">
		<div id="MenuTitle"> <img src="images/menu.jpg" /></div>
		<div id="NavMenu"> <script language=JavaScript> WriteTreeInfo();</script></div>
	</div>	
    
	<div id="main">
	 <iframe id="frame1" src="desk.php" name="OfficeMain" width="100%" height="100%" scrolling="no" marginwidth=0 marginheight=0 frameborder=0 vspace=0 hspace=0 >
	 </iframe>
	</div>
	
	<div id="footer" style="display:none;">
		<p>双鱼林设计 QQ:287307421或254540457 手机:13908064703 &copy;版权所有 <a href="http://www.shuangyulin.com" target="_blank">双鱼林设计网</a></p>
	</div>
</div>
</body>
</html>