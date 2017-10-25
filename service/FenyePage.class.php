<?php

	//这是一个用户保存分页信息的类
	class FenyePage { 
	 
		public $pageSize = 6;
		public $res_array; //这是现实的数据
		public $rowCount; //这是从数据库中获取
		public $pageNow = 1; //用户指定的
		public $pageCount; //这个是计算得到的  
		public $navigate; //分页导航
		public $pageStep = 10; //整体多少页翻
		public $gotoUrl;
	}

?>