<?php


namespace nebula\we\Page;
use nebula\we\Model\ProductVariation;

class productsvariation extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new ProductVariation($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}