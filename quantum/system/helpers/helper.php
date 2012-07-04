<?php


/**
 * Helpers are just that... short methods
 * for calling Quantum\Methods
*/

function before_filter($filter_name, $params = null) {
    
    if (!empty($filter_name)) {
        
        if (Quantum\Filters::runBeforeFilter((string)$filter_name, $params)) {
            return true;
        }
        
        return false;
        
    }
    
    return false;
    
}



function redirect_to($uri, $boolean = true, $code = 302) {
    Quantum\Utilities::redirect($uri, $boolean, $code);
}


function pr($var) {
    var_dump($var);
}


function to_password($string, $salt, $algo='ripemd160') {
    
    return hash($algo, $string.$salt);
    
}

?>