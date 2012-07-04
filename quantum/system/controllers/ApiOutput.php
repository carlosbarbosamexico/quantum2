<?

/*
 * class QuantumController
 */

namespace Quantum;

class ApiOutput {
    
    
   function __construct() {
   
    }
    
   public function send_json_headers() {
	
	header("Content-Type: application/json");
	header("Cache-Control: no-store");
	header("Pragma: no-cache");
    }

    
    public function send_js_headers() {
            
            header("Content-Type: text/javascript");
            header("Cache-Control: no-store");
            header("Pragma: no-cache");
    }
    
    public function send_xml_headers() {
            
            header("Content-Type: text/xml");
            header("Cache-Control: no-store");
            header("Pragma: no-cache");
    }
    
    public function send_serialized_headers() {
            
            header("Content-Type: application/vnd.php.serialized");
            header("Cache-Control: no-store");
            header("Pragma: no-cache");
    }
    
    public function send_yaml_headers() {
            
            header("Content-Type: application/yaml");
            header("Cache-Control: no-store");
            header("Pragma: no-cache");
    }
    
    public function send_text_headers() {
            
            header("Content-Type: text/text");
            header("Cache-Control: no-store");
            header("Pragma: no-cache");
    }
    
    public function adaptableOutput($data) {
            
            if (isset($_REQUEST['callback'])) {
                    
                    $cb = preg_replace("/[^][.\\'\\\"_A-Za-z0-9]/", '', $_GET['callback']);
                    self::send_js_headers();
                    print sprintf('%s(%s);', $cb, json_encode($data));
                    exit(0);
                    
            }
            
            if (isset($_REQUEST['format']) && $_REQUEST['format'] == 'xml') {
                    
                    self::send_xml_headers();
            
                    require_once 'XML/Serializer.php';
            
                    $serializer_options = array (
                      'addDecl' => TRUE,
                      'encoding' => 'UTF-8',
                      'indent' => '  ',
                      'rootName' => 'quantum',
                      'mode' => 'simplexml'
                    ); 
                    
                    $Serializer = new \XML_Serializer($serializer_options);
                    $status = $Serializer->serialize($data);
                    
                    if (\PEAR::isError($status)) die($status->getMessage());
                    
                    echo $Serializer->getSerializedData();
                    
                    exit(0);
                    
            }
            
            if (isset($_REQUEST['format']) && $_REQUEST['format'] == 'serialized') {
                    
                    self::send_text_headers();
                    echo serialize($data);
                    exit(0);
                    
            }
            
            if (isset($_REQUEST['format']) && $_REQUEST['format'] == 'text') {
                    
                    self::send_text_headers();
                    echo print_r($data);
                    exit(0);
                    
            }
            
            
            if (isset($_REQUEST['format']) && $_REQUEST['format'] == 'yaml') {
                    
                    self::send_text_headers();
                    
                    $yaml =  yaml_emit($data);
                    echo $yaml;
                    exit(0);
                    
            }
            
            if (isset($_REQUEST['format']) && $_REQUEST['format'] == 'dbug') {
                    
                    
                    self::send_text_headers();
                    echo var_dump($data);
                    exit(0);
                    
            }
                    
                    self::send_json_headers();
                    echo json_encode($data);
                    exit(0);
    
    }
    
    
    
}