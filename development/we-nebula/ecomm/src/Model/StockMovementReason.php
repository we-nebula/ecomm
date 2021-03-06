<?php


namespace nebula\we\Model;


class StockMovementReason extends \nebula\we\Model {
	
	public $table='stock_movement_reason';
	public $caption ="StockMovementReason";

    public $acl_type='StockMovementReason';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('lang_id',new \nebula\we\Model\Language)->withTitle();

        $this->addFields([
            ['name'],
        	['reason'],
            ['status','enum'=>array_keys($this->actions)],
        ]);
        
        $this->hasMany('StockMovement',new \nebula\we\Model\StockMovement);
        
        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}