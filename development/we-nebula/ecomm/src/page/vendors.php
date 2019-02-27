<?php


namespace nebula\we\Page;
use nebula\we\Model\Vendor;

class vendors extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new Vendor($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}