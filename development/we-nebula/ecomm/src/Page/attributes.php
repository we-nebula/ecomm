<?php


namespace nebula\we\Page;
use nebula\we\Model\Attribute;

class attributes extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new Attribute($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}