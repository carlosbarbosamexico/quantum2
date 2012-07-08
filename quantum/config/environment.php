<?php

$QUANTUM_ENVIRONMENT = array(
    
    'development' => array(
    
        'db_host' => 'localhost',
        'db_name' => 'quantum',
        'db_user' => 'root',
        'db_password' => 'root',
        'instance' => 'development',
        'system_salt' => '98ycud739m37werC28DF29reaserasde'
    ),
    
    'staging' => array(
        
        'db_host' => 'localhost',
        'db_name' => 'quantum',
        'db_user' => 'quantum',
        'db_password' => 'quantum',
        'instance' => 'staging',
        'system_salt' => '98ycud739m37werC28DF29reaserasde'
        
         
    ),
    
    
    'production' => array(
        
        'db_host' => 'localhost',
        'db_name' => 'root',
        'db_user' => 'root',
        'db_password' => 'root#123$',
        'instance' => 'production',
        'system_salt' => '98ycud739m37werC28DF29reaserasde'
        
    )
);




?>