<?php

require_once '../database/SqlHelper.class.php';
require_once '../phpbean/Book.class.php';

/*图书管理业务层类*/
class BookService {
	
	/*添加图书信息*/
	function AddBook(Book $book) {
		
		$book_barcode = $book->getBarcode();
		$book_bookName = $book->getBookName();
		$book_bookType = $book->getBookType();
		$book_price = $book->getPrice();
		$book_count = $book->getCount();
		$book_publish = $book->getPublish(); 
		$book_publishDate = $book->getPublishDate();
		$book_photo = $book->getPhoto(); 
		
		// 构建sql语句 
		$sql = "insert into t_Book(barcode,bookName,bookType,price,count,publish,publishDate,photo) values ('$book_barcode','$book_bookName',$book_bookType,$book_price,$book_count,'$book_publish','$book_publishDate','$book_photo')";
		  
		$sqlHelper = new SqlHelper ();
		$res = $sqlHelper->execute_dml ( $sql );
		$sqlHelper->close_connect ();
		return $res;
	}
	
	
	
	/*更新图书信息*/
	function UpdateBook(Book $book) {

		$book_barcode = $book->getBarcode();
		$book_bookName = $book->getBookName();
		$book_bookType = $book->getBookType();
		$book_price = $book->getPrice();
		$book_count = $book->getCount();
		$book_publish = $book->getPublish();
		$book_photo = $book->getPhoto();
		$book_publishDate = $book->getPublishDate();
		
		$sql = "update t_Book set bookName='$book_bookName'";
		$sql = $sql.",bookType=$book_bookType";
		$sql = $sql.",price=$book_price";
		$sql = $sql.",count=$book_count";
		$sql = $sql.",publish='$book_publish'";
		$sql = $sql.",photo='$book_photo'";
		$sql = $sql.",publishDate='$book_publishDate'";
		$sql = $sql." where barcode='$book_barcode'";
		
		
		$sqlHelper = new SqlHelper ();
		 
		$res = $sqlHelper->execute_dml ( $sql );
		
		
		$sqlHelper->close_connect ();
		return $res;
	}
	
	// 根据图书条形码获取图书信息
	function GetBook($barcode) {
		$sql = "select * from t_Book where barcode='$barcode'";
		$sqlHelper = new SqlHelper ();
		$arr = $sqlHelper->execute_dql2 ( $sql );
		$sqlHelper->close_connect ();
		// 二次封装,$arr=>Book对象实例
		$book = new Book();
		if(count($arr)>0) {
			$book->setBarcode($barcode);
			$book->setBookName($arr [0] ['bookName']);
			$book->setBookType($arr [0] ['bookType']);
			$book->setCount($arr [0] ['count']);
			$book->setPhoto($arr [0] ['photo']);
			$book->setPrice($arr [0] ['price']);
			$book->setPublish($arr [0] ['publish']);  
			$book->setPublishDate($arr [0] ['publishDate']);
		}
		return $book;
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
	
	
	/*查询所有的图书信息 */
	function QueryAllBook() {
		$sql = "select barcode,bookName from t_Book";
		$sqlHelper = new SqlHelper ();
		$res = $sqlHelper->execute_dql2 ( $sql );
		// 关闭连接
		$sqlHelper->close_connect ();
		return $res;
	}
}

?>
