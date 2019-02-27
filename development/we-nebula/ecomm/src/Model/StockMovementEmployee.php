<?php


namespace nebula\we\Model;


class StockMovementEmployee extends \nebula\we\Model {
	
	public $table='stock_movement_employee';
	public $caption ="Stock Movement Employee";

    public $acl_type='StockMovement';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

    
	public function init(){
        parent::init();

        $this->hasOne('stock_movement_id',new \nebula\we\Model\StockMovement);
        $this->hasOne('employee_id',new \nebula\we\Model\Employee)->withTitle();

        $this->addFields([
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}