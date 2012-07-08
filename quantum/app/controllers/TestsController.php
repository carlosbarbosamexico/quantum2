<?

/*
 * class TestsController
 */

class TestsController extends Quantum {
    
    /*
     * __construct()
     * @param $arg
     */
    
    function __construct() {
        
    }
    
    function index() {
        
		pr($this);
        $this->set('somevar', $somevar = 100);
        
    }
    
    function quantum() {
        pr(Quantum);
    }
    
    function import_test() {
        $this->autoRender = false;
        Quantum\Import::library();
    }
    
    function password() {
        
		$this->autoRender = false;
        echo $this->requestData['s'].'<br/>';
        echo $this->environment->system_salt.'<br/>';
        
        echo to_password($this->requestData['s'], $this->environment->system_salt);
        
    }
    
    
}

?>