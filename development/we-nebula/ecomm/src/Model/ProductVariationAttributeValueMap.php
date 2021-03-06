<?php


namespace nebula\we\Model;


class ProductVariationAttributeValueMap extends \nebula\we\Model {
	
	public $table='product_variantion_attribute_value_map';
	public $caption ="Product Variation Attribute Value Map";

    public $acl_type='ProductDetail';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('product_variation_id',new \nebula\we\Model\ProductVariation)->withTitle();
        $this->hasOne('attribute_value_id',new \nebula\we\Model\AttributeValue)->withTitle();
        
        $this->addFields([
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}