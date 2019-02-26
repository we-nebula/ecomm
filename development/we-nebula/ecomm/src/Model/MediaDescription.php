<?php


namespace nebula\we\Model;


class MediaDescription extends \nebula\we\Model {
	
	public $table='media_description';
	public $caption ="Media Description";

    public $acl_type='Media Description';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate'],
        'InActive'=>['view','edit','delete','activate'],
    ];

	public function init(){
        parent::init();

        $this->hasOne('lang_id',new \nebula\we\Model\Language)->withTitle();
        $this->hasOne('media_id',new \nebula\we\Model\Media)->withTitle();

        $this->addFields([
        	['name'],
            ['desc'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        (new \nebula\we\Migration\MySQL($this))->migrate();

    }
}