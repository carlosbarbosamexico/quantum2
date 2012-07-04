<?

/*
 * class IndexController
 */

class IndexController extends Quantum {
    
    
    function index() {
        
        $this->autoRender = false;
	redirect_to('/app');
        
    }
    
    
    
        
        
    
    
}

?>
