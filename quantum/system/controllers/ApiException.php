<?

/*
 * class QuantumController
 */

namespace Quantum;

class ApiException {
    
    
    public $smarty;
    public $view;
    
    function __construct() {
   
    }
    
   function invalidRequest() {
		
		header('HTTP/1.0 400 Bad Request');
		$error = array(
		    "error" => "invalid_request",
		    "error_description" => "Invalid request, check the parameters provided",
		    "error_code" => "400 Bad Request",
		);
		ApiOutput::adaptableOutput($error);
		
		
		
		}
	
    function invalidSignedRequest() {
		
		header('HTTP/1.0 400 Bad Request');
		$error = array(
		    "error" => "invalid_request",
		    "error_description" => "Invalid signed request, check the parameters provided",
		    "error_code" => "400 Bad Request",
		);
		ApiOutput::adaptableOutput($error);
		
		
		}
		
    function accessDenied() {
		
		header('WWW-Authenticate: OAuth realm="http://api.flightbackpack.com"');
		ApiOutput::send_json_headers();
		$error = array(
		    "error" => "access_denied",
		    "error_description" => "You need a valid access token to access this resource",
		    "error_code" => "401 Unauthorized",
		);
		ApiOutput::adaptableOutput($error);
	
	
		}
		
	
    function resourceNotFound() {
		
		header('HTTP/1.0 404 Not Found');
		$error = array(
		    "error" => "resource_not_found",
		    "error_description" => "Requested resource was not found",
		    "error_code" => "404 Resource not found"
		);
		ApiOutput::adaptableOutput($error);
		
		}
		
    function applicationNotFound() {
		
		header('WWW-Authenticate: OAuth realm="http://api.flightbackpack.com"');
		header('HTTP/1.0 401 Unauthorized');
		$error = array(
		    "error" => "access_denied",
		    "error_description" => "Application not found, or disabled",
		    "error_code" => "401 Unauthorized",
		);
		ApiOutput::adaptableOutput($error);
	
	
		}
		
    function tokenNotFound() {
		
		header('WWW-Authenticate: OAuth realm="http://api.flightbackpack.com"');
		header('HTTP/1.0 401 Unauthorized');
		$error = array(
		    "error" => "access_denied",
		    "error_description" => "Token not found, it never existed, or it expired.",
		    "error_code" => "401 Unauthorized",
		);
		ApiOutput::adaptableOutput($error);
	
	
		}
		
    function applicationExceededDailyQuota() {
		
		header('WWW-Authenticate: OAuth realm="http://api.flightbackpack.com"');
		header('HTTP/1.0 401 Unauthorized');
		$error = array(
		    "error" => "access_denied",
		    "error_description" => "Application has exceeded the daily quota.",
		    "error_code" => "401 Unauthorized",
		);
		ApiOutput::adaptableOutput($error);
		
		
		
		}
		
    function invalidParameters() {
		
		header('HTTP/1.0 400 Bad Request');
		$error = array(
		    "error" => "invalid_parameters",
		    "error_description" => "Invalid parameters where provided.",
		    "error_code" => "400 Bad Request",
		);
		ApiOutput::adaptableOutput($error);
		
		
		
		}
		
    function invalidRedirectUrl() {
		
		header('HTTP/1.0 400 Bad Request');
		$error = array(
		    "error" => "invalid_redirect_uri",
		    "error_description" => "The redirect_uri doesn't match this access token redirect_uri",
		    "error_code" => "400 Bad Request",
		);
		ApiOutput::adaptableOutput($error);
		
		
		}
		
	function domainsDontMatch() {
		
		header('HTTP/1.0 400 Bad Request');
		$error = array(
		    "error" => "domains_dont_match",
		    "error_description" => "The provided redirect_uri doesn't match this application registered domain",
		    "error_code" => "400 Bad Request",
		);
		ApiOutput::adaptableOutput($error);
		
		
		}
		
	function iAmATeapot() {
		
		header('HTTP/1.0 418 I am a teapot');
		$error = array(
		    "error" => "i am a tepot",
		    "error_code" => "418 I'm a teapot",
		);
		ApiOutput::adaptableOutput($error);
		
		
		}
		
	function custom($error, $code, $description) {
		
		header("HTTP/1.0 $code");
		$error = array(
		    "error" => "$error",
		    "error_description" => "$description",
		    "error_code" => "$code",
		);
		ApiOutput::adaptableOutput($error);
		
		
		}
    
    
    
}