<?php 

require_once '../phpbean/Sku.class.php';  //导入实体类
require_once '../service/SkuService.class.php';  //导入业务层类

 
//创建了SkuService实例
$skuService = new SkuService();

//根据action参数决定用户要执行什么样的操作
if(!empty($_REQUEST['action'])) {
	//接收action值
	$action = $_REQUEST['action'];
	if($action == "add") {
		//说明用户希望执行添加图书信息
		$book = new Book(); 
		$array_book = $_POST["book"];
		
		
		/*处理图片上传*/
		require_once("../util/upload.class.php");
		require_once("../util/util.php");
		
		
		$book->setBarcode($array_book['barcode']);
		$book->setBookName($array_book['bookName']);
		$book->setBookType($array_book['bookType']);
		$book->setCount($array_book['count']); 
		$book->setPrice($array_book['price']);
		$book->setPublish($array_book['publish']); 
		$book->setPublishDate($array_book['publishDate']);
		
		
		$photo = "../upload/NoImage.jpg"; 
		if ($_FILES['photo']['name'] != ''){
			/*--  实例化上传类  --*/
			$file = $_FILES['photo'];
			$upload_path = '../upload';
			$allow_type = array('jpg','bmp','png','gif','jpeg');
			$max_size=2048000;
			$upload = new upFiles($file, $upload_path, $max_size, $allow_type);

			$upload->upload();

			$pic = $upload->getSaveFileInfo();
			// $photo = substr($pic['path'], 2)."/".$pic['savename']; 
			$photo = $pic['path']."/".$pic['savename']; 
		}
		$book->setPhoto($photo);
		
		//完成添加->数据库
		$res = $skuService->AddBook($book);
		if($res==1) {
			header("Location: ../ok.php");
			exit();
		} else {
			//失败
			header("Location: ../error.php");
			exit();
		}
	} else if($action == "query") {
		//查询图书信息
		require_once '../service/SkuService.class.php';
		require_once '../service/FenyePage.class.php';
		
		//获取查询参数
		
		$barcode = !empty($_POST['barcode']) ? $_POST['barcode'] : ""; 
		$bookName = !empty($_POST['bookName'])?$_POST['bookName']:"";
		$bookType = !empty($_POST['bookType'])?$_POST['bookType']:0;
		$publishDate = !empty($_POST['publishDate'])?$_POST['publishDate']:"";
		 
		//创建SkuService实例
		$skuService = new SkuService(); 
		
		//创建一个FenyePage对象实例
		$fenyePage = new FenyePage();
		
		//给fenyePage指定必须的参数
		$fenyePage->pageNow = 1;
		$fenyePage->pageSize = 5;
		$fenyePage->gotoUrl = "BookAction.php";
		 
		//在此我们需要根据用户的点击来修改pageNow的值，不要判断是否有这个pageNow发送
		if(!empty($_REQUEST['pageNow'])){
			$fenyePage->pageNow=$_REQUEST['pageNow'];
		}
		 
		
		
		//调用getFenyePage，该方法可以把fenyePage完成
		$skuService->getFenyePage($fenyePage,$barcode,$bookName,$bookType,$publishDate);  
		
		
		require_once '../service/BookClassService.class.php';
		$bookClassService = new BookClassService();
		$bookClass_res = $bookClassService->QueryAllBookClass();
		 
		
		include '../Book/bookManage.php';
		
		
		
	} else if($action == "update") {
		//说明用户希望执行更新图书信息   
		$array_sku = $_POST['sku']; 
		$sku = $skuService->GetSku($array_sku['barcode']);
		
		$sku->setBarcode($array_sku['barcode']);
		$sku->setSkuName($array_sku['skuName']);
		$sku->setSkuType($array_sku['skuType']);
		$sku->setSkuStatus($array_sku['skuStatus']);
		$sku->setChannel($array_sku['channel']);
		$sku->setBrand($array_sku['brand']);
		$sku->setSize($array_sku['size']);
		$sku->setPrice($array_sku['price']);
		$sku->setPurchaseDate($array_sku['purchaseDate']);
		
		/*处理图片上传*/
		require_once("../util/upload.class.php");
		require_once("../util/util.php"); 
		if ($_FILES['photo']['name'] != ''){
			/*--  实例化上传类  --*/
			$file = $_FILES['photo'];
			$upload_path = '../upload';
			$allow_type = array('jpg','bmp','png','gif','jpeg');
			$max_size=2048000;
		
			$upload = new upFiles($file, $upload_path, $max_size, $allow_type);
			$upload->upload();
			$pic = $upload->getSaveFileInfo(); 
			$photo = substr($pic['path'], 2)."/".$pic['savename'];
			$sku->setPhoto($photo);
		}
	 
		//完成修改->数据库
		$res = $skuService->UpdateSku($sku);
		 
		if($res != 0 ) {
			header("Location: ../ok.php");
			exit();
		} else {
			//失败
			header("Location: ../error.php");
			exit();
		}  	
	} else if($action == "del") {
		//这时我们知道要删除图书信息
		$barcode = $_GET['barcode'];
		if($skuService->DeleteBook($barcode) == 1) {
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