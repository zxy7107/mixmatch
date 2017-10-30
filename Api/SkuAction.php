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
		$sku = new Sku(); 
		// $array_sku = $_POST["sku"];

		/*处理图片上传*/
		require_once("../util/upload.class.php");
		require_once("../util/util.php");
		
		
		// $sku->setBarcode($array_sku['barcode']);
		$sku->setSkuName($_POST['skuName']);
		$sku->setSkuType($_POST['skuType']);
		$sku->setSkuStatus($_POST['skuStatus']);
		$sku->setChannel($_POST['channel']);
		$sku->setBrand($_POST['brand']);
		$sku->setSize($_POST['size']);
		$sku->setPrice($_POST['price']);
		$sku->setPurchaseDate($_POST['purchaseDate']);

		$photo = "../upload/NoImage.jpg"; 
		if ($_FILES['photo']['name'] != ''){
			/*--  实例化上传类  --*/
			$file = $_FILES['photo'];
			$upload_path = '../upload';
			$allow_type = array('jpg','bmp','png','gif','jpeg');
			// $max_size=2048000;
			$max_size=5120000;
			$upload = new upFiles($file, $upload_path, $max_size, $allow_type);

			$upload->upload();

			$pic = $upload->getSaveFileInfo();
			// $photo = substr($pic['path'], 2)."/".$pic['savename']; 
			$photo = $pic['path']."/".$pic['savename']; 
		}
		$sku->setPhoto($photo);
		
		//完成添加->数据库
		$res = $skuService->AddSku($sku);
		if($res==1) {
			header('Content-type: text/json;charset=utf-8');
			$object = (object) [
		    'result' => 'foo',
		    'success' => true,
		  ];

			// header("Location: ../ok.php");
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
		// $array_sku = $_POST['sku']; 
		$sku = $skuService->GetSku($_POST['barcode']);
		
		$sku->setBarcode($_POST['barcode']);
		$sku->setSkuName($_POST['skuName']);
		$sku->setSkuType($_POST['skuType']);
		$sku->setSkuStatus($_POST['skuStatus']);
		$sku->setChannel($_POST['channel']);
		$sku->setBrand($_POST['brand']);
		$sku->setSize($_POST['size']);
		$sku->setPrice($_POST['price']);
		$sku->setPurchaseDate($_POST['purchaseDate']);
		
		/*处理图片上传*/
		require_once("../util/upload.class.php");
		require_once("../util/util.php"); 
		if(isset($_POST['photo'])) {
			$sku->setPhoto($_POST['photo']);

		} else if($_FILES['photo']['name'] != ''){
			/*--  实例化上传类  --*/
			$file = $_FILES['photo'];
			$upload_path = '../upload';

			$allow_type = array('jpg','bmp','png','gif','jpeg');
			// $max_size=2048000;
			$max_size=5120000;
		var_dump($file);
			$upload = new upFiles($file, $upload_path, $max_size, $allow_type);
			var_dump($upload);
			$upload->upload();
			$pic = $upload->getSaveFileInfo(); 
			var_dump($pic);

			$photo = $pic['path']."/".$pic['savename']; 
			// $photo = substr($pic['path'], 2)."/".$pic['savename'];
			$sku->setPhoto($photo);
		}
	 
		//完成修改->数据库
		$res = $skuService->UpdateSku($sku);
		print_r($sku);
		if($res != 0 ) {
			// header("Location: ../ok.php");
			header('Content-type: text/json;charset=utf-8');
			$object = (object) [
		    'result' => 'OK',
		    'success' => true,
		  ];
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