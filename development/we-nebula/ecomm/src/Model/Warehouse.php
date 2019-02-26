<?php


namespace nebula\we\Model;


class Warehouse extends \nebula\we\Model {
	
	public $table='warehouse';
	public $caption ="Warehouse";

    public $acl_type='Warehouse';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('Vendor',new \nebula\we\Model\Vendor);
        
        $this->addFields([
            ['name'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}