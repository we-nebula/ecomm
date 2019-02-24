<?php


namespace nebula\we\Model;


class Employee extends \nebula\we\Model {
	
	public $table='employee';
	public $caption ="Employee";

    public $acl_type='Employee';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('role_id',new \nebula\we\Model\Role)
        ->withTitle();

        $this->hasOne('created_by_id',new \nebula\we\Model\Employee)
        ->withTitle();

        $this->addFields([
        	['name'],
        	['username'],
        	['password'],
            ['joined_on','type'=>'date'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        $this->addField('image',new \atk4\filestore\Field\File($this->app->filesystem));

        (new \atk4\schema\Migration\MySQL($this))->migrate();

    }

    function isSuperUser(){
        return $this['role']=='SuperUser';
    }
}