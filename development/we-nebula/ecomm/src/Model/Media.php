<?php


namespace nebula\we\Model;


class Media extends \nebula\we\Model {
	
	public $table='media';
	public $caption ="Media";

    public $acl_type='Media';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasMany('MediaDescription',new \nebula\we\Model\MediaDescription);
        $this->hasMany('ProductAttachmentMap',new \nebula\we\Model\ProductAttachmentMap);
        $this->hasMany('ProductVariationAttachmentMap',new \nebula\we\Model\ProductVariationAttachmentMap);

        $this->addFields([
            ['name'],
            ['file_url'],
        	['meta'],
        	['mime_type'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}