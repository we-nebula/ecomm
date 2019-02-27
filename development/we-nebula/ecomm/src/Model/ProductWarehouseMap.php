<?php


namespace nebula\we\Model;


class ProductWarehouseMap extends \nebula\we\Model {
	
	public $table='product_warehouse_map';
	public $caption ="ProductWarehouseMap";

    public $acl_type='Product';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('product_id',new \nebula\we\Model\Product)->withTitle();
        $this->hasOne('warehouse_id',new \nebula\we\Model\Warehouse)->withTitle();

        $this->addFields([
            ['status','enum'=>array_keys($this->actions)],
        ]);
        
        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}