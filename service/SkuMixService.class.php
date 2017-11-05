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
	
	function UpdateSkuMix(SkuMix $skuMix) {

		$skuMix_id = $skuMix->getId();
		$skuMix_skuMixName = $skuMix->getSkuMixName();
		$skuMix_skuMixType = $skuMix->getSkuMixType();
		$skuMix_skuMix = $skuMix->getSkuMix();
		$skuMix_skuMixStatus = $skuMix->getSkuMixStatus();
		$skuMix_price = $skuMix->getPrice();
		$skuMix_photo = $skuMix->getPhoto();
		$skuMix_photoModel = $skuMix->getPhotoModel();
		
		$sql = "update t_SkuMix set skuMixName='$skuMix_skuMixName'";
		$sql = $sql.",skuMixType=$skuMix_skuMixType";
		$sql = $sql.",skuMixStatus='$skuMix_skuMixStatus'";
		$sql = $sql.",skuMix='$skuMix_skuMix'";
		$sql = $sql.",price=$skuMix_price";
		$sql = $sql.",photo='$skuMix_photo'";
		$sql = $sql.",photoModel='$skuMix_photoModel'";
		$sql = $sql." where id='$skuMix_id'";
		
		var_dump($sql); 
		$sqlHelper = new SqlHelper ();
		 
		$res = $sqlHelper->execute_dml ( $sql );
		
		$sqlHelper->close_connect ();
		return $res;
	}
	function UpdateSkuMixSingle(SkuMix $skuMix) {

		$skuMix_id = $skuMix->getId();
		// $skuMix_skuMixName = $skuMix->getSkuMixName();
		// $skuMix_skuMixType = $skuMix->getSkuMixType();
		$skuMix_skuMix = $skuMix->getSkuMix();
		// $skuMix_skuMixStatus = $skuMix->getSkuMixStatus();
		// $skuMix_price = $skuMix->getPrice();
		// $skuMix_photo = $skuMix->getPhoto();
		// $skuMix_photoModel = $skuMix->getPhotoModel();
		
		// $sql = "update t_SkuMix set skuMixName='$skuMix_skuMixName'";
		$sql = "update t_SkuMix set ";
		// $sql = $sql.",skuMixType=$skuMix_skuMixType";
		// $sql = $sql.",skuMixStatus='$skuMix_skuMixStatus'";
		$sql = $sql."skuMix='$skuMix_skuMix'";
		// $sql = $sql.",price=$skuMix_price";
		// $sql = $sql.",photo='$skuMix_photo'";
		// $sql = $sql.",photoModel='$skuMix_photoModel'";
		$sql = $sql." where id='$skuMix_id'";
		
		var_dump($sql); 
		$sqlHelper = new SqlHelper ();
		 
		$res = $sqlHelper->execute_dml ( $sql );
		
		$sqlHelper->close_connect ();
		return $res;
	}
	
	// 根据图书条形码获取图书信息
	function GetSkuMix($id) {
		$sql = "select * from t_SkuMix where id='$id'";
		$sqlHelper = new SqlHelper ();
		$arr = $sqlHelper->execute_dql2 ( $sql );
		$sqlHelper->close_connect ();
		// 二次封装,$arr=>SkuMix对象实例
		$skuMix = new SkuMix();
		if(count($arr)>0) {
			$skuMix->setId($id);
			$skuMix->setSkuMixName($arr [0] ['skuMixName']);
			$skuMix->setSkuMix($arr [0] ['skuMix']);
			$skuMix->setSkuMixType($arr [0] ['skuMixType']);
			$skuMix->setSkuMixStatus($arr [0] ['skuMixStatus']);
			$skuMix->setPhoto($arr [0] ['photo']);
			$skuMix->setPhotoModel($arr [0] ['photoModel']);
			$skuMix->setPrice($arr [0] ['price']);
		}
		return $skuMix;
	}


	
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
