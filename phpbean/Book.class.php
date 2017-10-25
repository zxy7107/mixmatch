<?php 
/*映射图书数据库表t_Sku*/
class Book {
	/*图书条形码*/
	private $barcode;
	/*图书名称*/
	private $bookName;
	/*图书所在类别*/
	private $bookType;
	/*图书价格*/
	private $price;
	/*库存*/
	private $count;
	/*出版社*/
	private $publish;
	/*出版日期*/
	private $publishDate;
	/*photo*/
	private $photo;
	
	/**
	 * @return the $publishDate
	 */
	public function getPublishDate() {
		return $this->publishDate;
	}

	/**
	 * @param field_type $publishDate
	 */
	public function setPublishDate($publishDate) {
		$this->publishDate = $publishDate;
	}

	/**
	 * @return the $barcode
	 */
	public function getBarcode() {
		return $this->barcode;
	}

	/**
	 * @return the $bookName
	 */
	public function getBookName() {
		return $this->bookName;
	}

	/**
	 * @return the $bookType
	 */
	public function getBookType() {
		return $this->bookType;
	}

	/**
	 * @return the $price
	 */
	public function getPrice() {
		return $this->price;
	}

	/**
	 * @return the $count
	 */
	public function getCount() {
		return $this->count;
	}

	/**
	 * @return the $publish
	 */
	public function getPublish() {
		return $this->publish;
	}

	/**
	 * @return the $photo
	 */
	public function getPhoto() {
		return $this->photo;
	}

	/**
	 * @param field_type $barcode
	 */
	public function setBarcode($barcode) {
		$this->barcode = $barcode;
	}

	/**
	 * @param field_type $bookName
	 */
	public function setBookName($bookName) {
		$this->bookName = $bookName;
	}

	/**
	 * @param field_type $bookType
	 */
	public function setBookType($bookType) {
		$this->bookType = $bookType;
	}

	/**
	 * @param field_type $price
	 */
	public function setPrice($price) {
		$this->price = $price;
	}

	/**
	 * @param field_type $count
	 */
	public function setCount($count) {
		$this->count = $count;
	}

	/**
	 * @param field_type $publish
	 */
	public function setPublish($publish) {
		$this->publish = $publish;
	}

	/**
	 * @param field_type $photo
	 */
	public function setPhoto($photo) {
		$this->photo = $photo;
	}

	
	
}


?>