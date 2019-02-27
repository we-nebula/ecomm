<?php


namespace nebula\we\Page;
use nebula\we\Model\ProductVariationAttachmentMap;

class productvariationattachmentmaps extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new ProductVariationAttachmentMap($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}