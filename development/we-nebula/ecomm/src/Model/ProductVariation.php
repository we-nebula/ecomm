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

        $this->hasOne('product_id',new \nebula\we\Model\Product)->withTitle();
        
        $this->addFields([
            ['name'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        $this->hasMany('ProductAttachmentMap',new \nebula\we\Model\ProductAttachmentMap);
        $this->hasMany('Stock',new \nebula\we\Model\Stock);
        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}