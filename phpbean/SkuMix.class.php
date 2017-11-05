<?php 
/*映射组合数据库表t_SkuMix*/
class SkuMix {


	/*组合id*/
	private $id;
	/*组合名称*/
	private $skuMixName;
	/*组合所在类别*/
	private $skuMixType;
	private $skuMix;
	private $skuMixStatus;
	/*组合价格*/
	private $price;
	/*photo*/
	private $photo;
	private $photoModel;
	


	/**
	 * @return the $id
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * @return the $skuMixName
	 */
	public function getSkuMixName() {
		return $this->skuMixName;
	}

	/**
	 * @return the $skuMixType
	 */
	public function getSkuMixType() {
		return $this->skuMixType;
	}	
	public function getSkuMix() {
		return $this->skuMix;
	}
	public function getSkuMixStatus() {
		return $this->skuMixStatus;
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
	 * @return the $photoModel
	 */
	public function getPhotoModel() {
		return $this->photoModel;
	}

	/**
	 * @param field_type $id
	 */
	public function setId($id) {
		$this->id = $id;
	}

	/**
	 * @param field_type $skuMixName
	 */
	public function setSkuMixName($skuMixName) {
		$this->skuMixName = $skuMixName;
	}

	/**
	 * @param field_type $skuMixType
	 */
	public function setSkuMixType($skuMixType) {
		$this->skuMixType = $skuMixType;
	}
	public function setSkuMix($skuMix) {
		$this->skuMix = $skuMix;
	}
	public function setSkuMixStatus($skuMixStatus) {
		$this->skuMixStatus = $skuMixStatus;
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
	/**
	 * @param field_type $photoModel
	 */
	public function setPhotoModel($photoModel) {
		$this->photoModel = $photoModel;
	}

	
	
}


?>