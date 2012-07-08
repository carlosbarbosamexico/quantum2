<?php

namespace Quantum;
use Closure;


class Config {
    
    
    public $environment;
  
    function __construct($environment) {
	
	
        $this->setEnvironment($environment);
	
	
    }
    
    public function getEnvironment() {
	
       if (!empty($this->environment)) {
	    return $this->environment;
       }
       
       return false;
       
    }
    
    public function setEnvironment($environment) {
	
	require_once($this->quantum_root.'config/environment.php');
	
        switch($environment) {
            
            case 'live':
                
                $this->environment = (object)$QUANTUM_ENVIRONMENT['production'];
                return true;
            break;
        
            case 'staging':
                
                $this->environment = (object)$QUANTUM_ENVIRONMENT['staging'];
                return true;
            break;
        
            case 'development':
               
                $this->environment = (object)$QUANTUM_ENVIRONMENT['development'];
		return true;
            break;
        }
	
        $this->environment = $development;
        return false;
    
    }
    
    public function domainBasedAutoConfig() {
	
	require_once($this->quantum_root.'config/environment.php');
	
	$development = (object)$QUANTUM_ENVIRONMENT['development'];
	$staging = (object)$QUANTUM_ENVIRONMENT['staging'];
	$production = (object)$QUANTUM_ENVIRONMENT['production'];
	$current_domain = $_SERVER['SERVER_NAME'];
	
	if ($development->domain === $current_domain) {
	
	    $this->environment = $development;
	    return true;
	
	} elseif ($staging->domain === $current_domain){
	    
	    $this->environment = $staging;
	    return true;
	
	} elseif ($production->domain === $current_domain){
	    
	    $this->environment = $staging;
	    return true;
	
	}
	
	$this->environment = $development;
	return false;
    
    }
    
    
    public function setAppConfig($environment) {
	
	require_once($this->quantum_root.'config/app.php');
        
	switch($environment) {
            
            case 'live':
                
                $this->app_config = (object)$APP_CONFIG['production'];
                return true;
            break;
        
            case 'staging':
                
                $this->app_config = (object)$APP_CONFIG['staging'];
                return true;
            break;
        
            case 'development':
               
                $this->app_config = (object)$APP_CONFIG['development'];
		return true;
            break;
        }
	
        
        return false;
        
        
    }
    
    public function getDatabase() {
	
	$database = new \stdClass();
	$database->db_name = $this->environment->db_name;
	$database->db_host= $this->environment->db_host;
	$database->db_name = $this->environment->db_user;
	$database->db_password = $this->environment->db_password;
	
	return $database;
    }
    
    public function getInstance() {
	
	return $this->environment->instance;
    }
    
    public function getPath() {
	
	return $this->environment->path;
    }
    
    public function getSystemSalt() {
	
	return $this->environment->system_salt;
    }
    

    
    
    
    
}



?>