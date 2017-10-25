<?php 

require_once '../phpbean/BookClass.class.php';  //导入实体类
require_once '../service/BookClassService.class.php';  //导入业务层类

 
//创建了BookClassService实例
$bookClassService = new BookClassService();

//先看看用户要分页还是要删除某个雇员
if(!empty($_REQUEST['action'])) {
	//接收action值
	$action = $_REQUEST['action'];
	if($action == "add") {
		//说明用户希望执行添加图书类别信息
		$bookClass = new BookClass();  
		
		$array_bookClass = $_POST["bookClass"];
		
		$bookClass->setBookClassName($array_bookClass['bookClassName']);
			
		//完成添加->数据库
		$res = $bookClassService->AddBookClass($bookClass);
		if($res==1) {
			header("Location: ../ok.php");
			exit();
		} else {
			//失败
			header("Location: ../error.php");
			exit();
		}
	} else if($action == "query") {
		//查询图书类别信息
		require_once '../service/BookClassService.class.php';
		require_once '../service/FenyePage.class.php';
		
		//创建BookClassService实例
		$bookClassService = new BookClassService(); 
		
		//创建一个FenyePage对象实例
		$fenyePage = new FenyePage();
		
		//给fenyePage指定必须的参数
		$fenyePage->pageNow = 1;
		$fenyePage->pageSize = 6;
		$fenyePage->gotoUrl = "BookClassAction.php";
		
		
		
		//在此我们需要根据用户的点击来修改pageNow的值，不要判断是否有这个pageNow发送
		if(!empty($_REQUEST['pageNow'])){
			$fenyePage->pageNow=$_REQUEST['pageNow'];
		}
		
		
		//调用getFenyePage，该方法可以吧fenyePage完成
		$bookClassService->getFenyePage($fenyePage);  
		
		include '../BookClass/bookClassManage.php';
		
	}  
	
	else if($action == "update") {
		//说明用户希望执行更新图书类别信息  
		$bookClass = new BookClass();
		
		$array_bookClass = $_POST['bookClass'];
		
		$bookClass->setBookClassId($array_bookClass['bookClassId']);
		$bookClass->setBookClassName($array_bookClass['bookClassName']); 
			
		//完成修改->数据库
		$res = $bookClassService->UpdateBookClass($bookClass);
		echo $res;
		if($res!=0) {
			header("Location: ../ok.php");
			exit();
		} else {
			//失败
			header("Location: ../error.php");
			exit();
		}  	
	} else if($action == "del") {
		//这时我们知道要删除图书类别信息
		$bookClassId = $_GET['bookClassId'];
		if($bookClassService->DeleteBookClass($bookClassId) == 1) {
			//成功
			header("Location: ../ok.php");
			exit();
		} else {
			//失败
			header("Location: ../error.php");
			exit();
		}
	}

}

?>