<?php


namespace nebula\we\Page;
use nebula\we\Model\AttributeDescription;

class attributesdescription extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new AttributeDescription($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}