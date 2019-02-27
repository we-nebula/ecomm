<?php


namespace nebula\we\Model;


class StockMovementVendor extends \nebula\we\Model {
	
	public $table='stock_movement_vendor';
	public $caption ="Stock Movement Vendor";

    public $acl_type='StockMovement';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

    
	public function init(){
        parent::init();

        $this->hasOne('stock_movement_id',new \nebula\we\Model\StockMovement);
        $this->hasOne('vendor_id',new \nebula\we\Model\Vendor)->withTitle();

        $this->addFields([
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}