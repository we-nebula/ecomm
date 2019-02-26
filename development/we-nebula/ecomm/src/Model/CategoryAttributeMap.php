<?php


namespace nebula\we\Model;


class CategoryAttributeMap extends \nebula\we\Model {
	
	public $table='category_attribute_map';
	public $caption ="Category Attribute Map";

    public $acl_type='ProductDetail';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('category_id',new \nebula\we\Model\Category);
        $this->hasOne('attribute_id',new \nebula\we\Model\Attribute);
        
        $this->addFields([
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}