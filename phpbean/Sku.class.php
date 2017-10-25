<?php 
/*映射图书数据库表t_Sku*/
class Sku {


	/*图书条形码*/
	private $barcode;
	/*图书名称*/
	private $skuName;
	/*图书所在类别*/
	private $skuType;
	private $skuStatus;
	private $channel;
	private $brand;
	private $size;
	/*图书价格*/
	private $price;
	/*出版社*/
	/*出版日期*/
	private $purchaseDate;
	/*photo*/
	private $photo;
	
	/**
	 * @return the $purchaseDate
	 */
	public function getPurchaseDate() {
		return $this->purchaseDate;
	}

	/**
	 * @param field_type $purchaseDate
	 */
	public function setPurchaseDate($purchaseDate) {
		$this->purchaseDate = $purchaseDate;
	}

	/**
	 * @return the $barcode
	 */
	public function getBarcode() {
		return $this->barcode;
	}

	/**
	 * @return the $skuName
	 */
	public function getSkuName() {
		return $this->skuName;
	}

	/**
	 * @return the $skuType
	 */
	public function getSkuType() {
		return $this->skuType;
	}
	public function getSkuStatus() {
		return $this->skuStatus;
	}
	public function getChannel() {
		return $this->channel;
	}

	public function getBrand() {
		return $this->brand;
	}
	public function getSize() {
		return $this->size;
	}

	/**
	 * @return the $price
	 */
	public function getPrice() {
		return $this->price;
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
	 * @param field_type $skuName
	 */
	public function setSkuName($skuName) {
		$this->skuName = $skuName;
	}

	/**
	 * @param field_type $skuType
	 */
	public function setSkuType($skuType) {
		$this->skuType = $skuType;
	}
	public function setSkuStatus($skuStatus) {
		$this->skuStatus = $skuStatus;
	}
	public function setChannel($channel) {
		$this->channel = $channel;
	}
	public function setBrand($brand) {
		$this->brand = $brand;
	}
	public function setSize($size) {
		$this->size = $size;
	}

	/**
	 * @param field_type $price
	 */
	public function setPrice($price) {
		$this->price = $price;
	}



	/**
	 * @param field_type $photo
	 */
	public function setPhoto($photo) {
		$this->photo = $photo;
	}

	
	
}


?>