<?php

require_once '../database/SqlHelper.class.php';
// require_once '../phpbean/Sku.class.php';
require_once '../phpbean/SkuMix.class.php';

/*搭配组合业务层类*/
class SkuMixService {
	
	/*添加图书信息*/
	function AddSkuMix(SkuMix $skuMix) {
		



		$skuMix_skuName = $skuMix->getSkuMixName();
		$skuMix_skuType = $skuMix->getSkuMixType();
		$skuMix_skuMix = $skuMix->getSkuMix();

		$skuMix_skuStatus = $skuMix->getSkuMixStatus();
		$skuMix_price = $skuMix->getPrice();
		$skuMix_photo = $skuMix->getPhoto(); 
		$skuMix_photoModel = $skuMix->getPhotoModel(); 
		// 构建sql语句 
		$sql = "insert into t_SkuMix(skuMixName,skuMixType,skuMixStatus, price,photo, photoModel, skuMix) 
		values ('$skuMix_skuName','$skuMix_skuType','$skuMix_skuStatus', $skuMix_price,'$skuMix_photo', '$skuMix_photoModel', '$skuMix_skuMix')";
		  
		$sqlHelper = new SqlHelper ();
		$res = $sqlHelper->execute_dml ( $sql );
		$sqlHelper->close_connect ();
		return $res;
	}
	
	// /*更新图书信息*/
	// function UpdateSku(Sku $sku) {

	// 	$sku_barcode = $sku->getBarcode();
	// 	$sku_skuName = $sku->getSkuName();
	// 	$sku_skuType = $sku->getSkuType();
	// 	$sku_skuStatus = $sku->getSkuStatus();
	// 	$sku_price = $sku->getPrice();
	// 	$sku_channel = $sku->getChannel();
	// 	$sku_brand = $sku->getBrand();
	// 	$sku_size = $sku->getSize();
	// 	$sku_photo = $sku->getPhoto();
	// 	$sku_purchaseDate = $sku->getPurchaseDate();
		
	// 	$sql = "update t_Sku set skuName='$sku_skuName'";
	// 	$sql = $sql.",skuType=$sku_skuType";
	// 	$sql = $sql.",skuStatus='$sku_skuStatus'";
	// 	$sql = $sql.",price=$sku_price";
	// 	$sql = $sql.",channel='$sku_channel'";
	// 	$sql = $sql.",brand='$sku_brand'";
	// 	$sql = $sql.",size='$sku_size'";
	// 	$sql = $sql.",photo='$sku_photo'";
	// 	$sql = $sql.",purchaseDate='$sku_purchaseDate'";
	// 	$sql = $sql." where barcode='$sku_barcode'";
		
	// 	var_dump($sql); 
	// 	$sqlHelper = new SqlHelper ();
		 
	// 	$res = $sqlHelper->execute_dml ( $sql );
		
	// 	$sqlHelper->close_connect ();
	// 	return $res;
	// }
	
	// // 根据图书条形码获取图书信息
	// function GetSku($barcode) {
	// 	$sql = "select * from t_Sku where barcode='$barcode'";
	// 	$sqlHelper = new SqlHelper ();
	// 	$arr = $sqlHelper->execute_dql2 ( $sql );
	// 	$sqlHelper->close_connect ();
	// 	// 二次封装,$arr=>Sku对象实例
	// 	$sku = new Sku();
	// 	if(count($arr)>0) {
	// 		$sku->setBarcode($barcode);
	// 		$sku->setSkuName($arr [0] ['skuName']);
	// 		$sku->setSkuType($arr [0] ['skuType']);
	// 		$sku->setSkuStatus($arr [0] ['skuStatus']);
	// 		$sku->setChannel($arr [0] ['channel']);
	// 		$sku->setPhoto($arr [0] ['photo']);
	// 		$sku->setBrand($arr [0] ['brand']);
	// 		$sku->setSize($arr [0] ['size']);
	// 		$sku->setPrice($arr [0] ['price']);
	// 		$sku->setPurchaseDate($arr [0] ['purchaseDate']);
	// 	}
	// 	return $sku;
	// }


	
	// /*用封装的方式完成分页查询*/
	// function getFenyePage($fenyePage,$barcode,$bookName,$bookType,$publishDate) {
	// 	// 创建一个SqlHelper对象实例
	// 	$sqlHelper = new SqlHelper ();
	// 	$sql1 = "select * from t_Book where 1=1";
	// 	$sql2 = "select count(barcode) from t_Book where 1=1"; 
	// 	$condition = "";
	// 	if($barcode != "") $condition = $condition." and barcode like '%$barcode%'";
	// 	if($bookName != "") $condition = $condition." and bookName like '%$bookName%'";
	// 	if($bookType != 0) $condition = $condition." and bookType=$bookType";
	// 	if($publishDate != "") $condition = $condition." and publishDate='$publishDate'";
		
	// 	$sql1 = $sql1.$condition." limit ". ($fenyePage->pageNow - 1) * $fenyePage->pageSize . "," . $fenyePage->pageSize;
	// 	$sql2 = $sql2.$condition;
	// 	$sqlHelper->execute_dql_fenye ( $sql1, $sql2, $fenyePage );
	// 	$sqlHelper->close_connect ();
	// }
	
	// // 根据输入图书条形码删除某个图书信息 
	// function DeleteBook($barcode) {
	// 	$sql = "delete from t_Book where barcode='$barcode'";
	// 	// 创建SqlHelper对象实例
	// 	$sqlHelper = new SqlHelper ();
	// 	return $sqlHelper->execute_dml ( $sql );
	// }
	
	
	// /*查询所有的图书信息 */
	// function QueryAllBook() {
	// 	$sql = "select barcode,bookName from t_Book";
	// 	$sqlHelper = new SqlHelper ();
	// 	$res = $sqlHelper->execute_dql2 ( $sql );
	// 	// 关闭连接
	// 	$sqlHelper->close_connect ();
	// 	return $res;
	// }

	function QueryAllSkuMixList() {
		$sql = "select * from t_skuMix order by id desc";
		$sqlHelper = new SqlHelper ();
		$res = $sqlHelper->execute_dql2 ( $sql );
		// 关闭连接
		$sqlHelper->close_connect ();
		return $res;
	}
}

?>
