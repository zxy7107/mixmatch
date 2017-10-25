<?php
/*映射数据库表t_BookClass*/
class BookClass {
	/* 图书类别编号 */
	private $bookClassId;
	/* 图书类别名称 */
	private $bookClassName;
	
	public function getBookClassId() {
		return $this->bookClassId;
	}
	public function getBookClassName() {
		return $this->bookClassName;
	}
	public function setBookClassId($bookClassId) {
		$this->bookClassId = $bookClassId;
	}
	public function setBookClassName($bookClassName) {
		$this->bookClassName = $bookClassName;
	}
}