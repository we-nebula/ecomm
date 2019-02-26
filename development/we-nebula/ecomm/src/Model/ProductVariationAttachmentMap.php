<?php


namespace nebula\we\Model;


class ProductVariationAttachmentMap extends \nebula\we\Model {
	
	public $table='product_variation_attachment_map';
	public $caption ="Product Variation Attachment Map";

    public $acl_type='ProductDetail';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('product_variation_id',new \nebula\we\Model\ProductVariation)->withTitle();
        $this->hasOne('media_id',new \nebula\we\Model\Media)->withTitle();
        
        $this->addFields([
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}