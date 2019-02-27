<?php

namespace nebula\we;

class Page extends \atk4\ui\View{
	public $title=null;

	function init(){
		parent::init();

		$this->app->title = $this->title;
	}
	

}