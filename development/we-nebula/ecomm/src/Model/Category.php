<?php


namespace nebula\we\Model;


class Category extends \nebula\we\Model {
	
	public $table='category';
	public $caption ="Category";

    public $acl_type='Category';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate','cateegorydetail'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->addFields([
            ['name'],
            ['level_of_depth'],
        	['nleft'],
            ['nright'],
        	['is_root'],
            ['is_rti'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        $this->hasMany('CategoryDetail',new \nebula\we\Model\CategoryDetail);
        $this->hasMany('ProductCategory',new \nebula\we\Model\ProductCategory);
        $this->hasMany('attribute_id',new \nebula\we\Model\Attribute);

        
        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
    function page_cateegorydetail($p)
    {

    }
}