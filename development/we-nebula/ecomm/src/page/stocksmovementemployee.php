<?php


namespace nebula\we\Page;
use nebula\we\Model\StockMovementEmployee;

class stocksmovementemployee extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new StockMovementEmployee($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}