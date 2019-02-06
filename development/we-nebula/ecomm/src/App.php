<?php


namespace nebula\we;


class App extends \atk4\ui\App {

    use \atk4\core\SessionTrait;
    use \atk4\core\NameTrait;
    use \nebula\we\Traits\DomainManager;
    use \nebula\we\Traits\DateAndTime;
	use \nebula\we\Traits\PageRouter;
	use \nebula\we\Traits\ConfigFile;

    function init(){
        parent::init();

        $this->readConfig();
        
    }

}