<?php


namespace nebula\we\Page;
use nebula\we\Model\ProductDetail;

class productdetails extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new ProductDetail($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}