<?php


class Teleport {
    
    const VERSION = '1.0.6';
    
    protected $params;
    protected $matterType;
    protected $argv;
    protected $quantum_root;
    protected $controllers_root;
    protected $models_root;
    protected $views_root;
    protected $scripts_root;
    protected $teleport_root;
    protected $filters_root;
    protected $app_root;
    protected $smarty_root;
    protected $libs_root;
    protected $tmp_root;
    protected $matter_root;
    
    function __construct() {
        
        
        $this->starGate();
        $this->dispatcher();
        
    }
    
    
    private function dispatcher() {
        
        $this->matterType = (string) $this->argv[1];;
        
        if (empty($this->matterType)) {
            $this->error('Error: I need to know what kind of matter to teleport');
        }
        
        switch ($this->matterType) {
            
            case "controller":
                $this->teleportController();
            break;
        
            case "model":
                $this->teleportModel();
            break;
        
            case "view":
                $this->teleportView();
            break;
        
            case "filter":
                $this->teleportFilter();
            break;
        
            case "help":
                $this->help();
            break;
        
            case "-c":
                $this->teleportController();
            break;
        
            case "-m":
                $this->teleportModel();
            break;
        
            case "-v":
                $this->teleportView();
            break;
        
            case "-f":
                $this->teleportFilter();
            break;
        
            case "-h":
                $this->help();
            break;
            
            default :
                
                $this->error("I can't teleport that scotty !");
        }
        
        
    }
    
    
    
    
    
    private function starGate() {
        
        $this->output('Welcome to Quantum Teleport: '. Teleport::VERSION);
        $this->setParams();
        $this->setFolders();
        $this->matterType = $this->argv[1];
        
        
    }
    
    
    
    
    private function setFolders() {
        
        $this->teleport_root = getcwd();
        $this->quantum_root = $this->teleport_root.'/../';
        $this->libs_root = $this->quantum_root.'lib/';
        $this->smarty_root = $this->quantum_root.'lib/smarty/';
        $this->app_root = $this->quantum_root.'app/';
        $this->controllers_root = $this->app_root.'controllers/';
        $this->models_root = $this->app_root.'models/';
        $this->views_root = $this->app_root.'views/';
        $this->filters_root = $this->app_root.'filters/';
        $this->tmp_root = $this->quantum_root.'tmp/';
        $this->matter_root = $this->quantum_root.'system/views/teleport/';
        //var_dump($this);
        
    }
    
    
    private function setParams() {
        
        global $argv;
        $this->argv = $argv;
        if (empty($this->argv[1])) {
            $this->error('Error: To teleport i need parameters', false);
            $this->error('To get help type ./teleport help or ./teleport -h');
        }
        
        $this->params = array();
        parse_str(implode('&', array_slice($argv, 1)), $this->params);
        
        return true;
    }
    
    
    private function help() {
        
        $this->output('*****************************');
        $this->output('Quantum Teleport Help:');
        $this->output('Available methods:');
        $this->output('*****************************');
        $this->output('');
        $this->output('Teleport a controller: ');
        $this->output('./teleport controller name=');
        $this->output('./teleport -c name=');
        $this->output('EX: ./teleport -c name=blog - Will generate a BlogController');
        $this->output('Optional parameters:');
        $this->output('public = Comma delimited series of public functions to generate on the controller');
        $this->output('private = Comma delimited series of private functions to generate on the controller');
        $this->output('protected = Comma delimited series of protected functions to generate on the controller');
        $this->output('EX: ./teleport -c name=blog public=latest,all private=savePostHook protected=deletePostHook');
        $this->output('');
        $this->output('*****************************');
        $this->output('');
        $this->output('Teleport a model: ');
        $this->output('./teleport model name=');
        $this->output('./teleport -m name=');
        $this->output('EX: ./teleport -m name=post - Will generate a Post model');
        $this->output('Optional parameters:');
        $this->output('public = Comma delimited series of public functions to generate on the model');
        $this->output('private = Comma delimited series of private functions to generate on the model');
        $this->output('protected = Comma delimited series of protected functions to generate on the model');
        $this->output('EX: ./teleport -m name=player public=increaseScore private=initScore protected=resetScore');
        $this->output('');
        $this->output('*****************************');
        $this->output('');
        $this->output('Teleport a view: ');
        $this->output('./teleport view controller=blog, action=index');
        $this->output('./teleport -v controller=blog, action=index');
        $this->output('EX: ./teleport -v controller=blog, action=index - Will generate a view in app/views/blog/index.tpl');
        $this->output('');
        $this->output('*****************************');
        $this->output('');
        $this->output('Teleport a filter: ');
        $this->output('./teleport filter name= type=');
        $this->output('./teleport -f name= type=');
        $this->output('EX: ./teleport -f name=if_logged type=before - Will generate a Before Filter');
        $this->output('Type of filters available type=before, type=after');
        $this->output('');
        $this->output('*****************************');
        
    }
    
    
    private function initSmarty() {
        
        define('SMARTY_DIR', $this->libs_root.'smarty/');
        define('SMARTY_SYSPLUGINS_DIR', $this->libs_root.'smarty/sysplugins/');
        define('SMARTY_PLUGINS_DIR', $this->libs_root.'smarty/plugins');
        require_once ($this->libs_root.'smarty/Smarty.class.php');
        
        $this->smarty = new Smarty();
        $this->smarty ->template_dir = $this->views_root;
        $this->smarty->compile_dir =   $this->tmp_root;
        $this->smarty->allow_php_tag = true;
        $this->smarty->plugins_dir[] = $this->libs_root.'smarty/plugins';

    }
    
    
    
    private function output($string, $newline = true) {
       
        if ($newline) {
                echo($string . "\n");
        } else {
                echo($string);
        }
    }
    
    private function error($string, $kill = true) {
        
        if ($kill) {
            $this->output($string);
            exit();
        }
        else {
            $this->output($string);
        }
        
    }
    
    
    
    private function teleportController() {
        
        if (!isset($this->params['name'])) {
            $this->error('Error: You must pass a name parameter to teleport a controller', false);
            $this->error('EX: ./teleport controller name=blog, will generate a BlogController');
        }
        
        $name = ucfirst($this->params['name']).'Controller';
        
        $this->output("Teleporting a controller: ". $name);
        
        $this->initSmarty();
        $this->smarty->assign('controller_name', $name);
        
        if (isset($this->params['public'])) {
            $public_functions = explode(',', $this->params['public']);
            $this->smarty->assign('public_functions', $public_functions);
        }
        
        if (isset($this->params['private'])) {
            $private_functions = explode(',', $this->params['private']);
            $this->smarty->assign('private_functions', $private_functions);
        }
        
        if (isset($this->params['protected'])) {
            $protected_functions = explode(',', $this->params['protected']);
            $this->smarty->assign('protected_functions', $protected_functions);
        }
        
        $c = $this->smarty->fetch($this->matter_root.'controller.tpl');
        
        $this->createFile($this->controllers_root, $name.'.php', $c);
        
        
    }
    
    
    private function teleportModel() {
        
        if (!isset($this->params['name'])) {
            $this->error('Error: You must pass a name parameter to teleport a model', false);
            $this->error('EX: ./teleport model name=user, will generate a User.php file at app/models');
        }
        
        $name = ucfirst($this->params['name']);
        
        $this->output("Teleporting a model: ". $name);
        
        $this->initSmarty();
        $this->smarty->assign('model_name', $name);
        
        if (isset($this->params['public'])) {
            $public_functions = explode(',', $this->params['public']);
            $this->smarty->assign('public_functions', $public_functions);
        }
        
        if (isset($this->params['private'])) {
            $private_functions = explode(',', $this->params['private']);
            $this->smarty->assign('private_functions', $private_functions);
        }
        
        if (isset($this->params['protected'])) {
            $protected_functions = explode(',', $this->params['protected']);
            $this->smarty->assign('protected_functions', $protected_functions);
        }
        
        $c = $this->smarty->fetch($this->matter_root.'model.tpl');
        
        $this->createFile($this->models_root, $name.'.php', $c);
        
        
    }
    
    
    private function teleportView() {
        
        if (!isset($this->params['controller']) || !isset($this->params['action'])) {
            $this->error('Error: You must pass a controller and action to generate a view.tpl', false);
            $this->error('EX: ./teleport view controller=blog action=index, will generate a index.tpl file at app/views/blog');
        }
        
        $name = $this->params['controller'].'/'.$this->params['action'];
        
        $this->output("Teleporting a view: ".$name);
        
        $view_dir = $this->views_root.$this->params['controller'].'/';
        
        if (!is_dir($view_dir)) {
            $this->output("View directory not exists... creating it.");
            mkdir($view_dir);
        }
        
        $this->createFile($this->views_root, $name.'.tpl', $c = null);
        
        
    }
    
    
    private function teleportFilter() {
        
        if (!isset($this->params['name']) || !isset($this->params['type'])) {
            $this->error('Error: You must pass a name parameter and type to generate a filter', false);
            $this->error('EX: ./teleport filter name=if_logged type=before, will generate a before_filter_if_logged.php file at app/filters');
        }
        
        if ($this->params['type'] == "before") {
            $name = "before_filter_".$this->params['name'];
            $template = "before_filter.tpl";
        }
        
        if ($this->params['type'] == "after") {
            $name = "after_filter_".$this->params['name'];
            $template = "after_filter.tpl";
        }
        
        $this->output("Teleporting a filter: ". $name);
        
        $this->initSmarty();
        $this->smarty->assign('filter_name', $name);
        
        $c = $this->smarty->fetch($this->matter_root.$template);
        
        $this->createFile($this->filters_root, $name.'.php', $c);
        
        
    }
    
    
    
    private function createFile($location, $filename, $contents) {
        
        $filename = $location.$filename;
        
        if (file_exists($filename)) {
            $this->error('Error: File already exists: '.$filename);
        }
        
        $this->output('Creating file:');
        $this->output($filename);
        
        if (!$handle = fopen($filename, 'w')) {
            $this->error("Cannot open file ($filename)");
        }
    
        if (fwrite($handle, $contents) === FALSE) {
            $this->error("Cannot write to file ($filename)");
        }
    
        $this->output("Success, created file: ($filename)");
    
        fclose($handle);
        
        
    }
    
}

date_default_timezone_set('UTC');
new Teleport();



?>

