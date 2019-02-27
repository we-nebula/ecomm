<?php


namespace nebula\we\Page;
use nebula\we\Model\StockMovementVendor;

class stocksmovementvendor extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new StockMovementVendor($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}