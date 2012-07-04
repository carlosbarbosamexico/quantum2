<?

/*
 * class QuantumController
 */

namespace Quantum;
use Closure;


/**
 * Provides basic beforeFilter and afterFilter to be accessible for controllers.
 * This is loosely based on RoR before_filter and after_filter
*/
class Filters {
    
    
    function __construct() {
	
    }
    
    
    public function runBeforeFilter($filter, $params = null) {
	
	if (empty($filter)) {
	    return false;
	}
	$filters_root = getcwd().'/../quantum/app/filters/';
	$filter_name = 'before_filter_'.$filter.'.php';
	$filter_cb = 'before_filter_'.$filter;
	
	$n = $filters_root.$filter_name;
	
	//var_dump($n);
	if (file_exists($n)) {
	    require($n);
	    call_user_func($filter_cb, $params);
	    return true;
	}
	else {
	    exit('No such filter: '.$filter);
	}
	
	return false;
	
    }
    
    
    
    
}