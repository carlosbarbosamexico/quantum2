<?php

class ClosureCompiler  {
	
	private $compiled_file;
	
	
	function __construct() {
		
		$this->compiled_file = $this->getCompiledFile();
		
		if ($this->compiled_file && !isset($_GET['recompile']) ) {
			
			$this->outputCompiledFile();
			
		}
		
		else {
			$this->compile();
		}	
	
		
	}
	
	function getCompiledFile() {
		
		return file_get_contents('compiled.js');
		
	}
	
	function outputCompiledFile() {
			
		header ('Content-type: text/javascript');
		echo $this->compiled_file;
		exit(0);
			
			
	}
		
	
	
	function compile() {
		
		$url_to_compile = 'http://my.flightbackpack.com/public/js/framework/v2/Quantum.js';
		
		$js = file_get_contents($url_to_compile);
		
		if ($js != '') {
		
			$apiArgs = array(
				'compilation_level' => 'SIMPLE_OPTIMIZATIONS',
				'output_format' => 'text',
				'output_info' => 'compiled_code'
			);
			
			$args = 'js_code=' . urlencode($js);
			foreach ($apiArgs as $key => $value) {
				$args .= '&' . $key . '=' . urlencode($value);
			}
			
			// API call using cURL
			$call = curl_init();
			curl_setopt_array($call, array(
				CURLOPT_URL => 'http://closure-compiler.appspot.com/compile',
				CURLOPT_POST => 1,
				CURLOPT_POSTFIELDS => $args,
				CURLOPT_RETURNTRANSFER => 1,
				CURLOPT_HEADER => 0,
				CURLOPT_FOLLOWLOCATION => 0
			));
			$jscomp = curl_exec($call);
			curl_close($call);
			
			// calculate compression saving
			$reduced = (strlen($js) - strlen($jscomp)) / strlen($js) * 100;
			
			if ($this->writeCompiledFile($jscomp)) {
				
				$this->compiled_file = $this->getCompiledFile();
				
				$this->outputCompiledFile();
				
			}
			
		};
		
	}
		
	
	
	function writeCompiledFile($content) {
			
			$jsfilename = 'compiled.js';
			$handle = fopen($jsfilename, "w");
			fwrite($handle, $content);
			fclose($handle);
			
			return true;
			
			
		}
		
		
	}
	
	$x = new ClosureCompiler();




?>
