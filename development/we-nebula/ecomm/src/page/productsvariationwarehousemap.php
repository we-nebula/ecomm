<?php


namespace nebula\we\Page;
use nebula\we\Model\ProductVariationWarehouseMap;

class productsvariationwarehousemap extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new ProductVariationWarehouseMap($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}