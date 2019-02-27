<?php


namespace nebula\we\Model;


class CategoryDetail extends \nebula\we\Model {
	
	public $table='category_detail';
	public $caption ="category detail";

    public $acl_type='category_detail';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('category_id',new \nebula\we\Model\Category)->withTitle();
        $this->hasOne('lang_id',new \nebula\we\Model\Language)->withTitle();
        
        $this->addFields([
            ['name'],
            ['description'],
            ['meta_title'],
            ['meta_keywords'],
            ['meta_description'],
            ['status','enum'=>array_keys($this->actions)],
        ]);


        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}