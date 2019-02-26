<?php


namespace nebula\we\Page;
use nebula\we\Model\Stock;

class stocks extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new Stock($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}