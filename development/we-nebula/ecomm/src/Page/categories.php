<?php


namespace nebula\we\Page;
use nebula\we\Model\Category;

class Categories extends \nebula\we\Page {
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



		$cat = new Category($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($cat);

		// $crud->addAction('cateegorydetail',new \nebula\we\Page\categoriesdetail);
		// $crud->jsRender();
	}
}