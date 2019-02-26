<?php


namespace nebula\we\Model;


class AttributeValueDescription extends \nebula\we\Model {
	
	public $table='attribute_value_description';
	public $caption ="Attribute Value Description";

    public $acl_type='Attribute';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('lang_id',new \nebula\we\Model\Language)->withTitle();
        $this->hasOne('attribute_value_id',new \nebula\we\Model\AttributeValue);

        $this->addFields([
            ['name'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}