<?php


namespace nebula\we\Model;


class ProductAttachmentMap extends \nebula\we\Model {
	
	public $table='product_attachment_map';
	public $caption ="Product Attachment Map";

    public $acl_type='ProductDetail';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('product_id',new \nebula\we\Model\Product)->withTitle();
        $this->hasOne('media_id',new \nebula\we\Model\Media)->withTitle();
        
        $this->addFields([
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}