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

        $this->addFields([
            ['name'],
            ['type'],
            ['position'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        $this->hasMany('AttributeDescription',new \nebula\we\Model\AttributeDescription);
        $this->hasMany('CategoryAttributeMap',new \nebula\we\Model\CategoryAttributeMap);

        $this->addExpression('AttributeDescription_count',$this->refLink('AttributeDescription')->action('count'));
        $this->addExpression('CategoryAttributeMap_count',$this->refLink('CategoryAttributeMap')->action('count'));

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}