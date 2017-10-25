<?php

require_once '../database/SqlHelper.class.php';
require_once '../phpbean/BookClass.class.php';

/*图书类别管理业务层类*/
class BookClassService {
	
	/*更新图书类别信息*/
	function UpdateBookClass(BookClass $bookClass) {
		
		$bookClassId = $bookClass->getBookClassId();
		$bookClassName = $bookClass->getBookClassName();
		
		$sql = "update t_BookClass set bookClassName='$bookClassName' where bookClassId=$bookClassId";
		
		$sqlHelper = new SqlHelper ();
		$res = $sqlHelper->execute_dml ( $sql );
		
		$sqlHelper->close_connect ();
		return $res;
	}
	
	// 根据图书类别编号获取图书类别信息
	function GetBookClass($bookClassId) {
		$sql = "select * from t_BookClass where bookClassId=$bookClassId";
		$sqlHelper = new SqlHelper ();
		$arr = $sqlHelper->execute_dql2 ( $sql );
		$sqlHelper->close_connect ();
		// 二次封装,$arr=>BookClass对象实例
		$bookClass = new BookClass();
		$bookClass->setBookClassId($arr [0] ['bookClassId']);
		$bookClass->setBookClassName($arr [0] ['bookClassName']);
		 
		return $bookClass;
	}
	
	// 添加图书类别信息
	function AddBookClass(BookClass $bookClass) {
		// 构建sql语句
	 
		$bookClass_bookClassName = $bookClass->getBookClassName();
		
		$sql = "insert into t_BookClass(bookClassName) values ('$bookClass_bookClassName')";
 
		
		$sqlHelper = new SqlHelper ();
		$res = $sqlHelper->execute_dml ( $sql );
		$sqlHelper->close_connect ();
		return $res;
	}
	
	// 一个函数可以获取共有多少页
	function getPageCount($pageSize) {
		// 需要查询$rowCount
		$sql = "select count(id) from t_BookClass";
		$sqlHelper = new SqlHelper ();
		$res = $sqlHelper->execute_dql ( $sql );
		// 这样就可以计算$pageCount
		if ($row = mysql_fetch_row ( $res )) {
			$pageCount = ceil ( $row [0] / $pageSize );
		}
		
		// 释放资源关闭连接
		mysql_free_result ( $res );
		$sqlHelper->close_connect ();
		return $pageCount;
	}
	
	// 一个函数可以获取应当显示的雇员信息
	function BookClassListByPage($pageNow, $pageSize) {
		$sql = "select * from t_BookClass limit " . ($pageNow - 1) * $pageSize . ",$pageSize";
		$sqlHelper = new SqlHelper ();
		$res = $sqlHelper->execute_dql2 ( $sql );
		// 关闭连接
		$sqlHelper->close_connect ();
		return $res;
	}
	
	// 第二种使用封装的方式完成分页
	function getFenyePage($fenyePage) {
		// 创建一个SqlHelper对象实例
		$sqlHelper = new SqlHelper ();
		$sql1 = "select * from t_BookClass limit " . ($fenyePage->pageNow - 1) * $fenyePage->pageSize . "," . $fenyePage->pageSize;
		$sql2 = "select count(bookClassId) from t_BookClass";
		$sqlHelper->execute_dql_fenye ( $sql1, $sql2, $fenyePage );
		$sqlHelper->close_connect ();
	}
	
	// 根据输入图书编号删除某个图书类别信息 
	function DeleteBookClass($bookClassId) {
		$sql = "delete from t_BookClass where bookClassId=$bookClassId";
		// 创建SqlHelper对象实例
		$sqlHelper = new SqlHelper ();
		return $sqlHelper->execute_dml ( $sql );
	}
	
	
	/*查询所有的图书类别信息 */
	function QueryAllBookClass() {
		$sql = "select bookClassId,bookClassName from t_BookClass";
		$sqlHelper = new SqlHelper ();
		$res = $sqlHelper->execute_dql2 ( $sql );
		// 关闭连接
		$sqlHelper->close_connect ();
		return $res;
	}
}

?>
