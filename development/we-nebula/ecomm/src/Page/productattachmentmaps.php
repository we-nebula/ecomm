<?php


namespace nebula\we\Page;
use nebula\we\Model\ProductAttachmentMap;

class productattachmentmaps extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new ProductAttachmentMap($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}