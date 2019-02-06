<?php

namespace nebula\we\Traits;

Trait ConfigFile{

	public $config_files_loaded;
	public $config_location='.';
	public $config_files = array('config-default','config');

	/**
     * Read config file and store it in $this->config. Use getConfig() to access
     */
    function readConfig($file='config.php'){
        $orig_file = $file;

        if (strpos ($file,'.php') != strlen($file)-4 ) {
            $file .= '.php';
        }

        if(strpos($file,'/')===false){
            $file=getcwd().'/'.$this->config_location.'/'.$file;
        }

        if (file_exists($file)) {
            // some tricky thing to make config be read in some cases it could not in simple way
            unset($config);

            $config=&$this->config;
            $this->config_files_loaded[]=$file;
            include $file;

            unset($config);
            return true;
        }

        return false;
    }
    /**
     * Manually set configuration option
     *
     * @param array  $config [description]
     * @param [type] $val    [description]
     */
    function setConfig($config=array(),$val=null){
        if($val!==null)return $this->setConfig(array($config=>$val));
        if(!$config)$config=array();
        if(!$this->config)$this->config=array();
        $this->config=array_merge($this->config,$config);
    }
    /** Load config if necessary and look up corresponding setting */
    function getConfig($path, $default_value = null){
        /**
         * For given path such as 'dsn' or 'logger/log_dir' returns
         * corresponding config value. Throws ExceptionNotConfigured if not set.
         *
         * To find out if config is set, do this:
         *
         * $var_is_set=true;
         * try { $app->getConfig($path); } catch ExceptionNotConfigured($e) { $var_is_set=false; };
         */
        $parts = explode('/',$path);
        $current_position = $this->config;
        foreach($parts as $part){
            if(!array_key_exists($part,$current_position)){
                if($default_value!==null)return $default_value;
                throw $this->exception("Configuration parameter is missing in config.php",'NotConfigured')
                    ->addMoreInfo('config_files_loaded',$this->config_files_loaded)
                    ->addMoreInfo("missign_line"," \$config['".join("']['",explode('/',$path))."']");
            }else{
                $current_position = $current_position[$part];
            }
        }
        return $current_position;
    }
    // }}}
}