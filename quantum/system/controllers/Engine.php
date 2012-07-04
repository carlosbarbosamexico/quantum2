<?

/*
 * class QuantumController
 */

namespace Quantum;
use Closure;


class Engine {
    
    
    function __construct() {
   
    }
    
    public function start() {
        
        $this->requestData = $_REQUEST;
        $this->postData = $_POST;
        $this->getData = $_GET;
        $this->version = '0.1.1';
        $this->requestUrl = array("http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
        
        if  (!empty($this->requestData['controller'])) {
            array_push($this->requestUrl, $this->requestData['controller']);
            }
        if  (!empty($this->requestData['task'])) {
            array_push($this->requestUrl, $this->requestData['task']);
            }
        if  (!empty($this->requestData['object_id'])) {
            array_push($this->requestUrl, $this->requestData['object_id']);
            }
                                 
      
    }
    
    
    
    
    
   
    
    
    
}