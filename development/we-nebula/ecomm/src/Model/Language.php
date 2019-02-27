<?php


namespace nebula\we\Model;


class Language extends \nebula\we\Model {
	
	public $table='language';
	public $caption ="Language";

    public $acl_type='Language';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        // $this->hasOne('role_id',new \nebula\we\Model\Role)
        // ->withTitle();


        $this->addFields([
            ['name'],
            ['iso_code'],
            ['lang_code'],
            ['locale'],
            ['is_rti'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        $this->hasMany('category_id',new \nebula\we\Model\CategoryDetail);
        $this->hasMany('product_id',new \nebula\we\Model\ProductDetail);
        $this->hasMany('attribute_id',new \nebula\we\Model\AttributeDescription);
        $this->hasMany('attribute_value_id',new \nebula\we\Model\AttributeValueDescription);
        $this->hasMany('MediaDescription',new \nebula\we\Model\MediaDescription);
        $this->hasMany('VendorDescription',new \nebula\we\Model\VendorDescription);
        $this->hasMany('StockMovementReason',new \nebula\we\Model\StockMovementReason);
        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}