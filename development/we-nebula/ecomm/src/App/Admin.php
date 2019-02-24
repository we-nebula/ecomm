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
		$this->router();

	}

	function createMenus(){
		$menu = $this->app->layout->menu->addMenu('System');
		$menu->addItem('Employee',$this->app->url(['index','page'=>'nebula\we\Page\employees']));
		$menu->addItem('Settings',$this->app->url(['index','page'=>'nebula\we\Page\settings']));
		
		$menu = $this->app->layout->menu->addMenu('Commission System');
		$menu = $this->app->layout->menu->addMenu('Reporting');
	}

}