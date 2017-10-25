<?php 
require_once '../service/BookClassService.class.php';
require_once '../phpbean/BookClass.class.php';

$bookClassId = $_GET['bookClassId'];
$bookClassService = new BookClassService();
$bookClass = $bookClassService->GetBookClass($bookClassId);

/*使用 JSON数据格式返回*/

header('Content-type: text/json;charset=utf-8');

echo "{bookClassId:";
echo $bookClass->getBookClassId();
echo ",bookClassName:\"";
echo $bookClass->getBookClassName();
echo "\"}"; 

 
 
?>