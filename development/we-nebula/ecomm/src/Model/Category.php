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
        $this->hasMany('CategoryAttributeMap',new \nebula\we\Model\CategoryAttributeMap);

        $this->addExpression('CategoryDetail_count',$this->refLink('CategoryDetail')->action('count'));
        $this->addExpression('ProductCategory_count',$this->refLink('ProductCategory')->action('count'));
        $this->addExpression('CategoryAttributeMap_count',$this->refLink('CategoryAttributeMap')->action('count'));
        
        
        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
    function page_cateegorydetail($p)
    {

    }
}