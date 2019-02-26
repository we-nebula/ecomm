<?php


namespace nebula\we\Page;
use nebula\we\Model\ProductCategory;

class productcategories extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new ProductCategory($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}