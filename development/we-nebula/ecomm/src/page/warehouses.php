<?php


namespace nebula\we\Page;
use nebula\we\Model\Warehouse;

class warehouses extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new Warehouse($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}