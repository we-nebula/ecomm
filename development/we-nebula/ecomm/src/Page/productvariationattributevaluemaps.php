<?php


namespace nebula\we\Page;
use nebula\we\Model\ProductVariationAttributeValueMap;

class productvariationattributevaluemaps extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new ProductVariationAttributeValueMap($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}