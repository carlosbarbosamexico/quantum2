<?

/*
 * class QuantumController
 */

namespace Quantum;

class Import {
    
    
    function __construct() {
   
    }
    
    function library($uri) {
        include_once($this->lib_root.$uri);
    }
    
    function filter($filter_name) {
        include_once($this->filters_root.$filter_name.'.php');
    }
    
    function helper($helper_name) {
        include_once($this->helpers_root.$helper_name.'.php');
    }
    
    function view($view_name) {
        include_once($this->views_root.$view_name.'.tpl');
    }
    
    
    
   
    
    
    
}