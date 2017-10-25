<?php

require_once "../service/AdminService.class.php";
//接受用户数据
//1.用户username
$username=$_POST['username'];
//2.密码
$password=$_POST['password']; 

//实例化一个AdminService对象
$adminService = new AdminService();
 

if($name=$adminService->checkAdmin($username, $password)) { 
	//合法
	session_start();
	$_SESSION['username'] = $name;
	header("location:../main.php");
} else {
	 
	//非法
	// header("location:../login.php?errno=1");
}

//$res=mysql_query($sql,$conn);
  
?>