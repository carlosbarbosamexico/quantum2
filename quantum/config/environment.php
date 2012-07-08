<?php

$QUANTUM_ENVIRONMENT = array(
    
    'development' => array(
    	
		'domain' => 'master.quantum.dev',
        'db_host' => 'localhost',
        'db_name' => 'quantum',
        'db_user' => 'root',
        'db_password' => 'root',
        'instance' => 'development',
        'system_salt' => '5a32fafa25541ab0e9e87725ebd3d652c81e15cb'
    ),
    
    'staging' => array(
        
		'domain' => 'demo.quantum-fw.org',
        'db_host' => 'localhost',
        'db_name' => 'quantum',
        'db_user' => 'quantum',
        'db_password' => 'quantum',
        'instance' => 'staging',
        'system_salt' => 'cb6bfd1dec153d6ae69083ab207102103ce5db7e'
        
         
    ),
    
    
    'production' => array(
        
        'domain' => 'demo.quantum-fw.org',
		'db_host' => 'localhost',
        'db_name' => 'root',
        'db_user' => 'root',
        'db_password' => 'root#123$',
        'instance' => 'production',
        'system_salt' => '000315ea15336c9865981f9a9108d11402e9d9ff'
        
    )
);




?>