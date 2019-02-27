<?php


namespace nebula\we\Page;
use nebula\we\Model\MediaDescription;

class mediadescriptions extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new MediaDescription($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}