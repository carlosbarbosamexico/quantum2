<?

/*
 * class QuantumController
 */

namespace Quantum ;

//use Closure;


class Controller{
    
    
    function __construct() {
     
    }
    
    
    function loadHelpers($type) {
        
        if ($type === 'all') {
            $files = scandir($this->quantum_root.'system/helpers/');
            //var_dump($files);
            foreach ($files as $file) {
                if (Utilities::getExtension($file) == 'php') {
                    include_once($this->quantum_root.'system/helpers/'.$file);
                }
                
            }
            return true;
        
        } else {
           
            $file = $type;
            include_once($this->quantum_root.'app/helpers/'.$file);
            return true;
        }
        
        
        
    }
    
    
}