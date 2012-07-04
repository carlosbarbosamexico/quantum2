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
         //var_dump($this);
         //$this->template = 'app';
        // var_dump($this);
        
        //pr($this);
    }
    
    function index() {
        //var_dump($this);
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
        //var_dump($this);
        $this->autoRender = false;
        echo $this->requestData['s'].'<br/>';
        echo $this->environment->system_salt.'<br/>';
        
        echo to_password($this->requestData['s'], $this->environment->system_salt);
        
    }
    
    
}

?>