<?php


namespace nebula\we\Page;
use nebula\we\Model\AttributeValueDescription;

class attributesvaluesdescription extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new AttributeValueDescription($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}