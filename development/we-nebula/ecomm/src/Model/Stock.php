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

    public $title_field='id';

	public function init(){
        parent::init();

        $this->hasOne('product_id',new \nebula\we\Model\Product)->withTitle();
        $this->hasOne('warehouse_id',new \nebula\we\Model\Warehouse)->withTitle();
        $this->hasOne('product_variation_id',new \nebula\we\Model\ProductVariation)->withTitle();

        $this->addFields([
            ['physical_quantity'],
        	['reserved_quantity'],
            ['avilability_quantity'],
            ['low_stock_thresold'],
        	['low_stocl_alert'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        $this->hasMany('StockMovement',new \nebula\we\Model\StockMovement);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}