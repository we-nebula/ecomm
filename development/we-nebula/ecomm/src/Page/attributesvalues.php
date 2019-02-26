<?php


namespace nebula\we\Page;
use nebula\we\Model\AttributeValue;

class attributesvalues extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new AttributeValue($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}