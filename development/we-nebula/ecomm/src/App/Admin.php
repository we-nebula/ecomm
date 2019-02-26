<?php


namespace nebula\we\App;


use League\Flysystem\Filesystem;
use League\Flysystem\Adapter\Local;

class Admin extends \nebula\we\App {

	public $title = "WE :: Commission Engine (2)";
	
	function init(){
		parent::init();

		$adapter = new Local(getcwd().'/localfiles');
		$this->filesystem = new Filesystem($adapter);

		$this->dbConnect($this->getConfig('dns'), $this->getConfig('db_user'), $this->getConfig('db_password'));

		$this->auth = $this->add(new \atk4\login\Auth());
	    $this->auth->setModel(new \nebula\we\Model\Employee($this->db),'username','password');
	    $this->auth->model = $this->auth->user;

		$this->createMenus();
		$this->sidecreateMenus();
		$this->router();

	}

	function createMenus(){
		$menu = $this->app->layout->menu->addMenu('System');
		$menu->addItem('Employee',$this->app->url(['index','page'=>'nebula\we\Page\employees']));
		$menu->addItem('Settings',$this->app->url(['index','page'=>'nebula\we\Page\settings']));
		
		$menu = $this->app->layout->menu->addMenu('Commission System');
		$menu = $this->app->layout->menu->addMenu('Reporting');
	}
	function sidecreateMenus()
    {	
        $this->app->layout->menuLeft->addItem(['Language'], ['index','page'=>'nebula\we\Page\languages']);
        $this->app->layout->menuLeft->addItem(['Category'], ['index','page'=>'nebula\we\Page\categories']);
        $this->app->layout->menuLeft->addItem(['CategoryDetail'], ['index','page'=>'nebula\we\Page\categoriesdetail']);
        $this->app->layout->menuLeft->addItem(['Product'], ['index','page'=>'nebula\we\Page\products']);
        $this->app->layout->menuLeft->addItem(['ProductDetail'], ['index','page'=>'nebula\we\Page\productdetails']);
        $this->app->layout->menuLeft->addItem(['ProductCategory'], ['index','page'=>'nebula\we\Page\productcategories']);
        $this->app->layout->menuLeft->addItem(['Attribute'], ['index','page'=>'nebula\we\Page\attributes']);
        $this->app->layout->menuLeft->addItem(['AttributeDescription'], ['index','page'=>'nebula\we\Page\attributesdescription']);
        $this->app->layout->menuLeft->addItem(['AttributeValue'], ['index','page'=>'nebula\we\Page\attributesvalues']);
        $this->app->layout->menuLeft->addItem(['AttributeValueDescription'], ['index','page'=>'nebula\we\Page\attributesvaluesdescription']);
    }

	function addURLArgs($arg,$value){
		$this->sticky_get_arguments[$arg] = $value;
	}

}