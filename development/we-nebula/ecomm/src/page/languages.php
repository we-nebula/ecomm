<?php


namespace nebula\we\Page;
use nebula\we\Model\Language;

class languages extends \nebula\we\Page {
	function init(){
		parent::init();

		$lang = new Language($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($lang);
	}
}