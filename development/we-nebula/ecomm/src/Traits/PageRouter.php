<?php

namespace nebula\we\Traits;

Trait PageRouter{

	function router($page_var='page'){
        if($page = $this->app->stickyGet($page_var)){
			$this->app->add(new $page);			
		}
    }
}