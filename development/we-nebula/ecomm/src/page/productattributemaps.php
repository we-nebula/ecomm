<?php


namespace nebula\we\Page;
use nebula\we\Model\ProductAttributeMap;

class productattributemaps extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new ProductAttributeMap($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}