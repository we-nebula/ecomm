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

	function router($page_var='page'){
        if($page = $this->app->stickyGet($page_var)){
			$this->app->add(new $page);			
		}
    }
}