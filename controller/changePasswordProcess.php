<?php

require_once "../service/AdminService.class.php";
//接受用户数据
$oldPassword = $_POST['oldpassword'];
$newPassword= $_POST['newpassword']; 
$newPassword2 = $_POST['newpassword2']; 

 

if($oldPassword == '') {
	header("location: ../changePassword.php?err=请输入原始密码！");
	exit();
}

if($newPassword == '') {
	header("location: ../changePassword.php?err=请输入新密码！");
	exit();
}
if($newPassword2 == '') {
	header("location: ../changePassword.php?err=请输入确认新密码！");
	exit();
}

if($newPassword != $newPassword2) {
	header("location: ../changePassword.php?err=2次新密码输入不一致！");
	exit();
}


 

//实例化一个AdminService对象
$adminService = new AdminService();
 
session_start();

$username = $_SESSION['username'];

if($adminService->ChangePassword($username,$oldPassword,$newPassword)) { 
	//合法
	header("location: ../changePassword.php?err=更新成功");
} else {
	header("location: ../changePassword.php?err=".$adminService->getErrMessage());;
}

 
  
?>