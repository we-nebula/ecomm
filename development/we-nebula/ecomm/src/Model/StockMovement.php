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

    public $title_field = 'id';

	public function init(){
        parent::init();

        $this->hasOne('stock_id',new \nebula\we\Model\Stock)->withTitle();
        $this->hasOne('stock_movement_reason_id',new \nebula\we\Model\StockMovementReason)->withTitle();

        $this->addFields([
            ['physical_quantity_moved'],
        	['sign'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        $this->hasMany('StockMovementVendor',new \nebula\we\Model\StockMovementVendor);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}