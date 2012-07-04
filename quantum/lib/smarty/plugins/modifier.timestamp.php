<?php


function smarty_modifier_timestamp($string)
{
   
 require_once(SMARTY_PLUGINS_DIR . 'shared.make_timestamp.php');
    if ($string != '') {
        $timestamp = smarty_make_timestamp($string);
    } 
   
   
   return $timestamp;
}

?>