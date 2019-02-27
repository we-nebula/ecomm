<?php


namespace nebula\we\Model;


class ProductVariationWarehouseMap extends \nebula\we\Model {
	
	public $table='product_variation_warehousemap';
	public $caption ="ProductVariationWarehouseMap";

    public $acl_type='Product';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('product_variation_id',new \nebula\we\Model\ProductVariation)->withTitle();
        $this->hasOne('warehouse_id',new \nebula\we\Model\Warehouse)->withTitle();

        $this->addFields([
            ['status','enum'=>array_keys($this->actions)],
        ]);
        
        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}