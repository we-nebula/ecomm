<?php


namespace nebula\we;


class Model extends \atk4\data\Model {
	
	public $created_by_field=null;
	public $assigned_by_field=null;
	
	public $acl = false;
	public $acl_type=null;
	public $assigned_field = null;
	public $status=[];
	public $actions=[];

	function init(){
		parent::init();

		if($this->created_by_field){
			$this->hasOne($this->created_by_field,new \nebula\we\Model\Staff())->addTitle();
		}

		if($this->assigned_by_field){
			$this->hasOne($this->assigned_by_field,new \nebula\we\Model\Staff())->addTitle();
		}

	}

}