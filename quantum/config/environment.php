<?php

error_reporting('E_ALL');

$QUANTUM_ENVIRONMENT = array(
    
    'development' => array(
    
        'path' => '/home/appsandbox/domains/virginapp.appsandbox.in/src/webroot/',
        'db_host' => 'localhost',
        'db_name' => 'virgin_v2',
        'db_user' => 'root',
        'db_password' => 'carl8311',
        'instance' => 'development',
        'system_salt' => '98ycud739m37werC28DF29reaserasde'
    ),
    
    'staging' => array(
        
        'path' => '/var/sites/virginstg/',
        'db_host' => 'localhost',
        'db_name' => 'virginstg',
        'db_user' => 'virginstg',
        'db_password' => 'virginstg',
        'instance' => 'staging',
        'system_salt' => '98ycud739m37werC28DF29reaserasde'
        
         
    ),
    
    
    'production' => array(
        
        'path' => '/home/socialreader/public_html/socialreader/',
        'db_host' => 'localhost',
        'db_name' => 'virgin',
        'db_user' => 'virgin',
        'db_password' => 'virgin#123$',
        'instance' => 'production',
        'system_salt' => '98ycud739m37werC28DF29reaserasde'
        
    )
);




?>