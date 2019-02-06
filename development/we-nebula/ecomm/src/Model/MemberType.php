<?php


namespace nebula\we\Model;


class MemberType extends \nebula\we\Model {
	
	public $table='member_type';
	public $caption ="Member Type";


	public function init(){
        parent::init();


        $this->addFields([
        	['name'],
        ]);

        (new \atk4\schema\Migration\MySQL($this))->migrate();

    }
}