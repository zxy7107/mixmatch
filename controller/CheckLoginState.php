<?php
session_start();
if(empty($_SESSION['username'])) {
		echo  "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />";
		echo "<script>alert('对不起，请先登录系统');top.location.href='/login.php';</script>";
	}
?>