<?php


namespace nebula\we\Page;
use nebula\we\Model\Media;

class medias extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new Media($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}