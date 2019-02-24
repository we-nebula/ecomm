<?php


namespace nebula\we\Page;
use nebula\we\Model\Employee;

class employees extends \nebula\we\Page {
	function init(){
		parent::init();

		$emp = new Employee($this->app->db);
		$crud = $this->add(['CRUD']);
		$crud->setModel($emp);


		$crud->add(new \nebula\we\Controller\Acl);
		// echo $emp->action('select')->render();
		// $this->app->terminate();
		$modal_vp1 = $this->add(['Modal', 'title' => 'Roles']);
		$modal_vp1->set(function ($p){
			$c = $p->add(['CRUD']);
			$c->setModel(new \nebula\we\Model\Role($this->app->db));
		});

		$crud->menu->addItem(['Roles','icon'=>'users'])
		->on('click',$modal_vp1->show());


	}
}