<?php


namespace nebula\we\Model;


class Vendor extends \nebula\we\Model {
	
	public $table='vendor';
	public $caption ="Vendor";

    public $acl_type='Vendor';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasMany('VendorDescription',new \nebula\we\Model\VendorDescription);
        $this->hasMany('Warehouse',new \nebula\we\Model\Warehouse);
        
        $this->addFields([
            ['name'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}