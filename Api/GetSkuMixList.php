<?php 
require_once '../phpbean/SkuMix.class.php';  //导入实体类
require_once '../service/SkuMixService.class.php';  //导入业务层类


// $barcode = $_GET['barcode'];
$skuMixService = new SkuMixService(); 
// $book = $skuMixService->GetBook($barcode);
$skumixlist = $skuMixService->QueryAllSkuMixList();

/*使用 JSON数据格式返回*/
header('Content-type: text/json;charset=utf-8');
// echo "{barcode:\"".$book->getBarcode();
// echo "\",bookName:\"".$book->getBookName(); 
// echo "\",bookType:\"".$bookClassService->GetBookClass($book->getBookType())->getBookClassName();
// echo "\",price:".$book->getPrice();
// echo ",count:".$book->getCount();
// echo ",publish:\"".$book->getPublish();
// echo "\",publishDate:\"".date("Y-m-d",strtotime($book->getPublishDate()));
// echo "\",photo:\"".$book->getPhoto();  
// echo "\"}"; 
echo json_encode($skumixlist, JSON_UNESCAPED_UNICODE);
 
?>