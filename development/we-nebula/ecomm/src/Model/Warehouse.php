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

        $this->hasOne('vendor_id',new \nebula\we\Model\Vendor)->withTitle();
        
        $this->addFields([
            ['name'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        $this->hasMany('Stock',new \nebula\we\Model\Stock);
        $this->hasMany('ProductWarehouseMap',new \nebula\we\Model\ProductWarehouseMap);
        $this->hasMany('ProductVariationWarehouseMap',new \nebula\we\Model\ProductVariationWarehouseMap);
        
        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}