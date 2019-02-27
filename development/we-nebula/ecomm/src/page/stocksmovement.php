<?php


namespace nebula\we\Page;
use nebula\we\Model\StockMovement;

class stocksmovement extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new StockMovement($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}