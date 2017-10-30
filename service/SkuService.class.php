<?php

require_once '../database/SqlHelper.class.php';
require_once '../phpbean/Sku.class.php';

/*图书管理业务层类*/
class SkuService {
	
	/*添加图书信息*/
	function AddSku(Sku $sku) {
		
		// $sku_barcode = $sku->getBarcode();
		$sku_skuName = $sku->getSkuName();
		$sku_skuType = $sku->getSkuType();

		$sku_skuStatus = $sku->getSkuStatus();
		$sku_price = $sku->getPrice();
		$sku_channel = $sku->getChannel();
		$sku_brand = $sku->getBrand();
		$sku_size = $sku->getSize();
		$sku_purchaseDate = $sku->getPurchaseDate();
		$sku_photo = $sku->getPhoto(); 
		// 构建sql语句 
		// $sql = "insert into t_Sku(barcode,bookName,bookType,price,count,publish,publishDate,photo) values ('$book_barcode','$book_bookName',$book_bookType,$book_price,$book_count,'$book_publish','$book_publishDate','$book_photo')";
		$sql = "insert into t_Sku(skuName,skuType,skuStatus, price,channel,brand, size,purchaseDate,photo) 
		values ('$sku_skuName','$sku_skuType','$sku_skuStatus', $sku_price,'$sku_channel','$sku_brand','$sku_size','$sku_purchaseDate','$sku_photo')";
		  
		$sqlHelper = new SqlHelper ();
		$res = $sqlHelper->execute_dml ( $sql );
		$sqlHelper->close_connect ();
		return $res;
	}
	
	/*更新图书信息*/
	function UpdateSku(Sku $sku) {

		$sku_barcode = $sku->getBarcode();
		$sku_skuName = $sku->getSkuName();
		$sku_skuType = $sku->getSkuType();
		$sku_skuStatus = $sku->getSkuStatus();
		$sku_price = $sku->getPrice();
		$sku_channel = $sku->getChannel();
		$sku_brand = $sku->getBrand();
		$sku_size = $sku->getSize();
		$sku_photo = $sku->getPhoto();
		$sku_purchaseDate = $sku->getPurchaseDate();
		
		$sql = "update t_Sku set skuName='$sku_skuName'";
		$sql = $sql.",skuType=$sku_skuType";
		$sql = $sql.",skuStatus='$sku_skuStatus'";
		$sql = $sql.",price=$sku_price";
		$sql = $sql.",channel='$sku_channel'";
		$sql = $sql.",brand='$sku_brand'";
		$sql = $sql.",size='$sku_size'";
		$sql = $sql.",photo='$sku_photo'";
		$sql = $sql.",purchaseDate='$sku_purchaseDate'";
		$sql = $sql." where barcode='$sku_barcode'";
		
		var_dump($sql); 
		$sqlHelper = new SqlHelper ();
		 
		$res = $sqlHelper->execute_dml ( $sql );
		
		$sqlHelper->close_connect ();
		return $res;
	}
	
	// 根据图书条形码获取图书信息
	function GetSku($barcode) {
		$sql = "select * from t_Sku where barcode='$barcode'";
		$sqlHelper = new SqlHelper ();
		$arr = $sqlHelper->execute_dql2 ( $sql );
		$sqlHelper->close_connect ();
		// 二次封装,$arr=>Sku对象实例
		$sku = new Sku();
		if(count($arr)>0) {
			$sku->setBarcode($barcode);
			$sku->setSkuName($arr [0] ['skuName']);
			$sku->setSkuType($arr [0] ['skuType']);
			$sku->setSkuStatus($arr [0] ['skuStatus']);
			$sku->setChannel($arr [0] ['channel']);
			$sku->setPhoto($arr [0] ['photo']);
			$sku->setBrand($arr [0] ['brand']);
			$sku->setSize($arr [0] ['size']);
			$sku->setPrice($arr [0] ['price']);
			$sku->setPurchaseDate($arr [0] ['purchaseDate']);
		}
		return $sku;
	}


	
	/*用封装的方式完成分页查询*/
	function getFenyePage($fenyePage,$barcode,$bookName,$bookType,$publishDate) {
		// 创建一个SqlHelper对象实例
		$sqlHelper = new SqlHelper ();
		$sql1 = "select * from t_Book where 1=1";
		$sql2 = "select count(barcode) from t_Book where 1=1"; 
		$condition = "";
		if($barcode != "") $condition = $condition." and barcode like '%$barcode%'";
		if($bookName != "") $condition = $condition." and bookName like '%$bookName%'";
		if($bookType != 0) $condition = $condition." and bookType=$bookType";
		if($publishDate != "") $condition = $condition." and publishDate='$publishDate'";
		
		$sql1 = $sql1.$condition." limit ". ($fenyePage->pageNow - 1) * $fenyePage->pageSize . "," . $fenyePage->pageSize;
		$sql2 = $sql2.$condition;
		$sqlHelper->execute_dql_fenye ( $sql1, $sql2, $fenyePage );
		$sqlHelper->close_connect ();
	}
	
	// 根据输入图书条形码删除某个图书信息 
	function DeleteBook($barcode) {
		$sql = "delete from t_Book where barcode='$barcode'";
		// 创建SqlHelper对象实例
		$sqlHelper = new SqlHelper ();
		return $sqlHelper->execute_dml ( $sql );
	}
	
	
	/*查询所有的单品信息 */
	function QueryAllSku() {
		$sql = "select barcode,photo,skuStatus from t_sku";
		$sqlHelper = new SqlHelper ();
		$res = $sqlHelper->execute_dql2 ( $sql );
		// 关闭连接
		$sqlHelper->close_connect ();
		return $res;
	}
	function QuerySkuByBarcode($barcodeString) {
		// print_r (explode("/",$barcodeString));
		$sql = "select barcode,skuStatus from t_sku where barcode in (".$barcodeString.") ";
		$sqlHelper = new SqlHelper ();
		$res = $sqlHelper->execute_dql2 ( $sql );
		// 关闭连接
		$sqlHelper->close_connect ();
		return $res;
	}

	function QueryAllSkuList() {
		$sql = "select * from t_sku";
		$sqlHelper = new SqlHelper ();
		$res = $sqlHelper->execute_dql2 ( $sql );
		// 关闭连接
		$sqlHelper->close_connect ();
		return $res;
	}
}

?>
