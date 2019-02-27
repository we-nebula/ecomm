<?php


namespace nebula\we\Page;
use nebula\we\Model\StockMovementReason;

class stockmovementreasons extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new StockMovementReason($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}