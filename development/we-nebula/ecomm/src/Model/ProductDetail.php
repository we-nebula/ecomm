<?php


namespace nebula\we\Model;


class ProductDetail extends \nebula\we\Model {
	
	public $table='product_detail';
	public $caption ="Product Detail";

    public $acl_type='Product_Detail';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('lang_id',new \nebula\we\Model\Language)->withTitle();
        $this->hasOne('product_id',new \nebula\we\Model\Product);

        $this->addFields([
        	['name'],
        	['short_desc'],
            ['desc'],
        	['meta_desc'],
            ['meta_title'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}