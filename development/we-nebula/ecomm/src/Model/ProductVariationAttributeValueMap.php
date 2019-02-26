<?php


namespace nebula\we\Model;


class ProductAttributeMap extends \nebula\we\Model {
	
	public $table='product_attribute_map';
	public $caption ="Product Attribute Map";

    public $acl_type='ProductDetail';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('product_id',new \nebula\we\Model\Product);
        $this->hasOne('attribute_value_id',new \nebula\we\Model\AttributeValue);
        
        $this->addFields([
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}