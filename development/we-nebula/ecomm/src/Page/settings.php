<?php


namespace nebula\we\Page;
use nebula\we\Model\Employee;
use nebula\we\Model\Acl;

class settings extends \nebula\we\Page {
	function init(){
		parent::init();

		$tabs = $this->add('Tabs');

		$tabs->addTab('Member Types',[$this,'memberType']);
		$tabs->addTab('Products',[$this,'products']);
		$tabs->addTab('Acl_Model',[$this,'acl']);

	}

	function memberType($tab){
		$c = $tab->add(['CRUD']);
		$c->setModel(new \nebula\we\Model\MemberType($this->app->db));
	}

	function products($tab){
		$tab->add(['View','ui'=>'card']);
	}

	function acl($tab){
		$crud = $tab->add(['CRUD']);
		$crud->setModel(new Acl($this->app->db));
	}
}