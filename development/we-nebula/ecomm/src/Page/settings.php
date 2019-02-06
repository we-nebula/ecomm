<?php


namespace nebula\we\Page;
use nebula\we\Model\Employee;

class settings extends \nebula\we\Page {
	function init(){
		parent::init();

		$tabs = $this->add('Tabs');

		$tabs->addTab('Member Types',[$this,'memberType']);
		$tabs->addTab('Products',[$this,'products']);

	}

	function memberType($tab){
		$c = $tab->add(['CRUD']);
		$c->setModel(new \nebula\we\Model\MemberType($this->app->db));
	}

	function products($tab){
		$tab->add(['View','ui'=>'card']);
	}
}