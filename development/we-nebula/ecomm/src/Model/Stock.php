<?php


namespace nebula\we\Model;


class Stock extends \nebula\we\Model {
	
	public $table='stock';
	public $caption ="Stock";

    public $acl_type='Stock';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('product_id',new \nebula\we\Model\Product);
        $this->hasOne('warehouse_id',new \nebula\we\Model\Warehouse);
        $this->hasOne('product_variation_id',new \nebula\we\Model\ProductVariation);

        $this->addFields([
            ['physical_quantity'],
        	['reserved_quantity'],
            ['avilability_quantity'],
            ['low_stock_thresold'],
        	['low_stocl_alert'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}