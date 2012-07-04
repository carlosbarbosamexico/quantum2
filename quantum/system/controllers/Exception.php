<?

/*
 * class QuantumController
 */

namespace Quantum;

class Exception {
    
    
    public $smarty;
    public $view;
    
    function __construct() {
   
    }
    
   function newException($content) {
		
	throw new \Exception($message = null, $code = 0); 
	
    }
	
    
    
    
    
}