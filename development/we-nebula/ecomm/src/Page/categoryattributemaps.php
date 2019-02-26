<?php


namespace nebula\we\Page;
use nebula\we\Model\CategoryAttributeMap;

class categoryattributemaps extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new CategoryAttributeMap($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}