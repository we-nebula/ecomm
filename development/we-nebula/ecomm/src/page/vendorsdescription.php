<?php


namespace nebula\we\Page;
use nebula\we\Model\VendorDescription;

class vendorsdescription extends \nebula\we\Page {
	function init(){
		parent::init();

		$prod = new VendorDescription($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($prod);
	}
}