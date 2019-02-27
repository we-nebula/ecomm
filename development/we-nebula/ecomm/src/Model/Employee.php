<?php


namespace nebula\we\Model;


class Employee extends \nebula\we\Model {
	
	public $table='employee';
	public $caption ="Employee";

    public $acl_type='Employee';

    public $actions = [
        'Active'=>['view','edit','delete','deactivate','superpass','not_implemented'],
        'InActive'=>['view','edit','delete','activate'],
        'Draft'=>['view','edit','delete','submit'],
    ];

    // public $actions = [
    //     ['view','edit','delete','deactivate','superpass']
    // ];

	public function init(){
        parent::init();

        $this->hasOne('role_id',new \atk4\acl\Model\Role)
        ->withTitle();

        $this->hasOne('created_by_id',new \nebula\we\Model\Employee)
        ->withTitle();

        $this->addFields([
        	['name'],
        	['username'],
        	['password'],
            ['joined_on','type'=>'date'],
            ['status','enum'=>array_keys($this->actions)],
        ]);

        $this->addField('image',new \atk4\filestore\Field\File($this->app->filesystem));

        (new \atk4\schema\Migration\MySQL($this))->migrate();

    }

    function isSuperUser(){
        return $this['role']=='SuperUser';
    }

    function activate(){
        $this['status']='Active';
        $this->save();
    }

    function deactivate(){
        $this['status']='InActive';
        $this->save();
    }

    function page_superpass($p){
        $p->add(['Message'])->set("HELLO");
        $form = $p->add('Form');
        $form->addField('name');
        $form->buttonSave->set('Subscribe');
        $form->buttonSave->icon = 'mail';


        $form->onSubmit(function($f)use($p){
            $this['name']=$f->model['name'];
            $this->save();
            return [new \atk4\ui\jsReload($p->owner->owner)];
        });
    }

    function superpass(){
        if($this['username']=='admin') throw new \Exception("Error Processing Request", 1);
        
        $this['password'] = rand();
        $this->save();
    }

    function submit(){
        $this['status']='Active';
        $this->save();
    }
}