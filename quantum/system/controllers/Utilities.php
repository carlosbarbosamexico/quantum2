<?

/*
 * class QuantumController
 */

namespace Quantum;
use Closure;


class Utilities {
    
    
    function __construct() {
     //echo "Hello from Quantum\controller";
    }
	
    public function guid() {

        return uniqid(); ;
    }

    public function validateUrl($url) {
	    
	    if (!preg_match('_^(?:(?:https?|ftp)://)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\x{00a1}-\x{ffff}0-9]+-?)*[a-z\x{00a1}-\x{ffff}0-9]+)(?:\.(?:[a-z\x{00a1}-\x{ffff}0-9]+-?)*[a-z\x{00a1}-\x{ffff}0-9]+)*(?:\.(?:[a-z\x{00a1}-\x{ffff}]{2,})))(?::\d{2,5})?(?:/[^\s]*)?$_iuS', $url)) {
		    return false;
		    }
		    return true;
    }
    
    
    public function getExtension($str) {
	  $i = strrpos($str,".");
	  if (!$i) { return false; } 
	  $l = strlen($str) - $i;
	  $ext = substr($str,$i+1,$l);
	  return $ext;
    }
    
    public function formatBytes($bytes, $precision = 2) { 
	$units = array('B', 'KB', 'MB', 'GB', 'TB'); 
    
	$bytes = max($bytes, 0); 
	$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
	$pow = min($pow, count($units) - 1); 
    
	// Uncomment one of the following alternatives
	// $bytes /= pow(1024, $pow);
	 $bytes /= (1 << (10 * $pow)); 
    
	return round($bytes, $precision) . ' ' . $units[$pow]; 
    }
    
    function genHash($string) {
		
	$secret = hash('ripemd160', base64_encode(pack('N6', mt_rand(), mt_rand(), mt_rand(), mt_rand(), microtime(true), uniqid(mt_rand(), true)).$string));
	
	return $secret;
	
    }
    
    function toPassword($string) {
	
	$system_salt = Config::getSystemSalt();

	$join_pw = $string.$system_salt;
	
	$hashed_password = hash("ripemd160", $join_pw);
	
	return $hashed_password;
    }
    
    function redirect($url, $boolean = true, $code = 302) {
	
	header("Location:$url", $boolean, $code);
	exit();
    }
    
    
    
}