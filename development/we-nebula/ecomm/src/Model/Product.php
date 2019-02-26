<?php


namespace nebula\we\Model;


class Product extends \nebula\we\Model {
	
	public $table='product';
	public $caption ="Product";

    public $acl_type='Product';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasMany('ProductDetail',new \nebula\we\Model\ProductDetail);
        $this->hasMany('ProductCategory',new \nebula\we\Model\ProductCategory);
        $this->hasMany('ProductAttributeMap',new \nebula\we\Model\ProductAttributeMap);
        $this->hasMany('ProductAttachmentMap',new \nebula\we\Model\ProductAttachmentMap);
        $this->hasMany('ProductVariation',new \nebula\we\Model\ProductVariation);

        $this->addFields([
            ['name'],
        	['price'],
        	['weight'],
            ['height'],
        	['length'],
            ['width'],
            ['barcode'],
            ['isbn'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}