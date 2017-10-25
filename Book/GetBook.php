<?php 
require_once '../service/BookService.class.php';
require_once '../service/BookClassService.class.php';
require_once '../phpbean/Book.class.php';

$barcode = $_GET['barcode'];
$bookService = new BookService(); 
$book = $bookService->GetBook($barcode);
$bookClassService = new BookClassService(); 

/*使用 JSON数据格式返回*/
header('Content-type: text/json;charset=utf-8');
echo "{barcode:\"".$book->getBarcode();
echo "\",bookName:\"".$book->getBookName(); 
echo "\",bookType:\"".$bookClassService->GetBookClass($book->getBookType())->getBookClassName();
echo "\",price:".$book->getPrice();
echo ",count:".$book->getCount();
echo ",publish:\"".$book->getPublish();
echo "\",publishDate:\"".date("Y-m-d",strtotime($book->getPublishDate()));
echo "\",photo:\"".$book->getPhoto();  
echo "\"}"; 
 
?>