<?php


namespace nebula\we\Model;


class Acl extends \nebula\we\Model {
	
	public $table='acl_permission';
    public $acl_type='Acl_Permission';
    public $caption='ACL';

    public $actions = [
        'Active'=>['view','edit','delete'],
        'InActive'=>['view','edit','delete'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('role_id',new \nebula\we\Model\Role)
        ->withTitle();

        $this->addFields([
        	['acl_type'],
        	['can_add','type'=>'boolean'],
            ['acl','type'=>'text']
        ]);

        (new \atk4\schema\Migration\MySQL($this))->migrate();

    }

    function isSuperUser(){
        return $this['role']=='SuperUser';
    }
}