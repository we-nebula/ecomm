<?php

namespace nebula\we\Traits;
/**
 * This trait adds the most simple routing facility to your app, Yep, it's ugly but works
 * just add this trait in your APP
 * 
 * call $this->route('page',['your\app\namespace','or\other\paths']) at the last in your init() function
 * 
 * $menu = $this->app->layout->menu->addMenu('System');
 * $menu->addItem('Employee',$this->app->pageURL('employees']));
 * 
 * employee class will be searched as your\app\namespace\employees or or\other\paths\employees
 * 
 * usually it is sugested to create 'path' folder in your app src and create all page classes in there, you can use folder structure
 * like $menu->addItem('Employee',$this->app->pageURL('employees/invoices']));
 * 
 * class employees or invoices here extends \atk4\ui\Page class
 * while \atk4\ui\Page is with upper case P, you are sugestted to use page folder and classes in that folders
 * all in lowercases
 * 
 * 
 */

Trait PageRouter{
	
	public $page_locations = [];
	public $app_page_uri_identifier='page';

	function router($page_var='page', $page_locations=[]){
		
		$this->page_locations = $page_locations;
		$this->app_page_uri_identifier = $page_var;

        if($page = $this->app->stickyGet($page_var)){
        	$page = str_replace('-', '\\', $page);
        	foreach ($this->page_locations as $loc) {
        		$page_path = '\\'.$loc.'\\'.$page;
    			if(!class_exists($page_path,true) && !next ($this->page_locations)){
					throw new \atk4\ui\Exception(['Class Not Found','class'=>$page_path,'attempted_location'=>$this->page_locations]);
        			$this->terminate('asdas');
    			}
				$this->app->add(new $page_path);
        	}
		}
    }

    function pageUrl($page_class,$needRequestUri = false, $extra_args = []){
    	return $this->app->url(['index',$this->app_page_uri_identifier=>str_replace("\\", '-', $page_class)],$needRequestUri, $extra_args);
    }
}