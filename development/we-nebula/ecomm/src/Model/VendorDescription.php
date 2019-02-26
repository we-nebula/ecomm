<?php


namespace nebula\we\Model;


class VendorDescription extends \nebula\we\Model {
	
	public $table='vendor_description';
	public $caption ="Vendor Description";

    public $acl_type='vendor_description';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('lang_id',new \nebula\we\Model\Language)->withTitle();
        $this->hasOne('vendor_id',new \nebula\we\Model\Vendor)->withTitle(); 
        $this->hasOne('logo_id',new \nebula\we\Model\Media)->withTitle(); 

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