<?php


namespace nebula\we\Model;


class StockMovement extends \nebula\we\Model {
	
	public $table='stock_movement';
	public $caption ="Stock Movement";

    public $acl_type='StockMovement';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('product_id',new \nebula\we\Model\Stock)->withTitle();
        $this->hasOne('warehouse_id',new \nebula\we\Model\Warehouse)->withTitle();
        $this->hasOne('product_variation_id',new \nebula\we\Model\ProductVariation)->withTitle();

        $this->addFields([
            ['physical_quantity_moved'],
        	['sign'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}