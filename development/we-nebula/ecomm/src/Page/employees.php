<?php


namespace nebula\we\Page;
use nebula\we\Model\Employee;

class employees extends \nebula\we\Page {
	function init(){
		parent::init();

		$emp = new Employee($this->app->db);
		$crud = $this->add(['\atk4\acl\CRUD']);
		$crud->setModel($emp);

		$modal_vp1 = $this->add(['Modal', 'title' => 'Roles']);
		$modal_vp1->set(function ($p){
			$c = $p->add(['\atk4\acl\CRUD']);
			$c->setModel(new \atk4\acl\Model\Role($this->app->db));
		});

		$crud->menu->addItem(['Roles','icon'=>'users'])
		->on('click',$modal_vp1->show());


	}
}