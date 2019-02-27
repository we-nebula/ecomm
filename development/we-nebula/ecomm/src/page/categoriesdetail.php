<?php


namespace nebula\we\Page;
use nebula\we\Model\CategoryDetail;

class categoriesdetail extends \nebula\we\Page {
	function init(){
		parent::init();

		// $t = $this->add('Tabs');

		// $t->addTab('Other Details', function ($tab) {
		// 	$cat = new Category($this->app->db);
		//  	$crud = $tab->add([['CRUD']]);
		//  	$crud->setModel($cat);
		// });
		
		// $t->addTab('Basic info', function ($tab) {
		// 	$cat = new \nebula\we\Model\CategoryDetail($this->app->db);
		//  	$crud = $tab->add([['CRUD']]);
		//  	$crud->setModel($cat);
		// });



		$cat = new CategoryDetail($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($cat);
	}
}