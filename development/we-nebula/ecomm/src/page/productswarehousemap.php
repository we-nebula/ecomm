<?php


namespace nebula\we\Page;
use nebula\we\Model\ProductWarehouseMap;

class productswarehousemap extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new ProductWarehouseMap($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}