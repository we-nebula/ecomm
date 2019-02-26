<?php


namespace nebula\we\Model;


class Attribute extends \nebula\we\Model {
	
	public $table='attribute';
	public $caption ="Attribute";

    public $acl_type='Attribute';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasMany('AttributeDescription',new \nebula\we\Model\AttributeDescription);
        $this->hasMany('CategoryAttributeMap',new \nebula\we\Model\CategoryAttributeMap);

        $this->addFields([
            ['name'],
        	['type'],
        	['position'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}