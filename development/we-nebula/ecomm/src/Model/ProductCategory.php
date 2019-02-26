<?php


namespace nebula\we\Model;


class ProductCategory extends \nebula\we\Model {
	
	public $table='product_category';
	public $caption ="Product Category";

    public $acl_type='Product';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('product_id',new \nebula\we\Model\Product);
        $this->hasOne('category_id',new \nebula\we\Model\Category);

        $this->addFields([
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}