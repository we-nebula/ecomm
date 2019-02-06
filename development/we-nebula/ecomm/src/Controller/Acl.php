<?php

namespace nebula\we\Controller;

class Acl extends \nebula\we\Controller {
	
	public $model; // To put condition on model
	public $role; // Based on which post auth model user belongs to 
	public $view; // add acl button for super user and create actions based on ACL

	public $acl_type=null;
	public $available_options=['SelfOnly','All','None'];

	function init(){
		parent::init();

		$this->model = $this->getModel();
		$this->view = $this->getView();
		
		// Actual Acl between role and acl_type
		$this->role = $this->app->auth->model['role_id'];
		$this->acl_type = $this->model->acl_type?:$this->model->getModelCaption();
		
		if(isset($this->model->assigned_field)) $this->available_options = array_merge($this->available_options,['Assigned To Self']);

		$this->model_vp1 = $modal_vp1 = $this->app->add(['Modal', 'title' => 'Role Selection']);
		$modal_vp1->set(\Closure::fromCallable([$this,'manageAclPage']));

		$this->modal_vp2 = $this->app->add(['Modal', 'title' => 'ACL For Selected Role']);
		$this->modal_vp2->set(\Closure::fromCallable([$this,'manageAclForm']));

		if($this->app->auth->model->isSuperUser()){
			$acl_btn = $this->view->menu->addItem(['ACL', 'icon' => 'ban']);
			$acl_btn->on('click', $modal_vp1->show());
		}
	}

	function manageAclPage($p){
		$form = $p->add('Form',['buttonSave'=>['Button','update','primary']]);
		$g = $form->addGroup(['width' => 'two']);

		$g->addField('role', [
		    'Lookup',
		    'model'       => new \nebula\we\Model\Role($this->app->db),
		    'hint'        => 'Lookup field is just like AutoComplete, supports all the same options.',
		    'placeholder' => 'Search for roles',
		    'search'      => ['name'],
		]);
		$g->addField('entity',['disabled'=>true])->set($this->acl_type);

		$form->onSubmit(function($form){
			return [$this->modal_vp2->show(['role'=>$form->model['role']])];
		});
	}

	function manageAclForm($p){
		$form = $p->add('Form');
		$form->addField('allow_add',['Checkbox']);

		foreach ($this->model->actions as $status => $actions) {
			$grp = $form->addGroup($status);
			foreach ($actions as $act) {
				$grp->add(['View'])->set($act);
				$grp->addField($status.'_'.$act,['DropDown'],['enum'=>$this->available_options]);
			}
		}

		$form->onSubmit(function($form){
			foreach ($this->model->actions as $status => $actions) {
				foreach ($actions as $act) {
					var_dump($status.'_'.$act.':'. $form->model[$status.'_'.$act]);
				}
			}
			return $form->success(print_r($form->model,true));
		});
	}

	function getModel(){
		return $this->owner instanceof \nebula\we\Model ? $this->owner: $this->owner->model;
	}

	function getView(){
		return $this->owner instanceof \nebula\we\Model ? $this->owner->owner: $this->owner;
	}

}