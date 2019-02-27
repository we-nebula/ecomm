<?php


namespace nebula\we\Page;
use nebula\we\Model\Product;

class products extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new Product($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}