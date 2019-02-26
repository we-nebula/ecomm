<?php


namespace nebula\we\Model;


class AttributeValue extends \nebula\we\Model {
	
	public $table='attribute_value';
	public $caption ="Attribute Value";

    public $acl_type='Attribute';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasMany('AttributeValueDescription',new \nebula\we\Model\AttributeValueDescription);

        $this->addFields([
            ['name'],
        	['type'],
        	['position'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}