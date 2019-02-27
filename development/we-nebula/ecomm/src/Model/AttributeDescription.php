<?php


namespace nebula\we\Model;


class AttributeDescription extends \nebula\we\Model {
	
	public $table='attribute_description';
	public $caption ="Attribute Description";

    public $acl_type='Attribute';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('lang_id',new \nebula\we\Model\Language)->withTitle();
        $this->hasOne('attribute_id',new \nebula\we\Model\Attribute)->withTitle();

        $this->addFields([
            ['name'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}