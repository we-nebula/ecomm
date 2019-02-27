<?php

namespace nebula\we\Traits;
/**
 * This trait adds the most simple routing facility to your app, Yep, it's ugly but works
 * just add this trait in your APP
 * call $this->route() at the last in your init() function
 * and use like this (yes, its always index in url)
 * $menu = $this->app->layout->menu->addMenu('System');
 * $menu->addItem('Employee',$this->app->url(['index','page'=>'nebula\we\page\employees']));
 * 
 * This way ane class defined by page will be added in app and you will just be creating pages as class
 * for simplicity, we have a Page class that extends View (just empty)
 * and in 'page' folder in root we create extra pages like 'class employees extends Page' (from above example)
 * --- This will surely save you a lot of time
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

    function pageUrl($page_class){
    	return $this->app->url(['index',$this->app_page_uri_identifier=>str_replace("\\", '-', $page_class)]);
    }
}