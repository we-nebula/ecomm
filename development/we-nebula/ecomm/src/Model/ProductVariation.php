<?php


namespace nebula\we\Model;


class ProductVariation extends \nebula\we\Model {
	
	public $table='product_variation';
	public $caption ="Product variation";

    public $acl_type='Product';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('Product',new \nebula\we\Model\Product);

        $this->addFields([
            ['name'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}