<?php
/**
 * Smarty plugin
 *
 * @package Smarty
 * @subpackage PluginsModifier
 */

/**
 * Smarty regex_replace modifier plugin
 *
 * Type:     modifier<br>
 * Name:     regex_replace<br>
 * Purpose:  regular expression search/replace
 * @link http://smarty.php.net/manual/en/language.modifier.regex.replace.php
 *          regex_replace (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @param string
 * @param string|array
 * @param string|array
 * @return string
 */
function smarty_modifier_safejsvar($string)
{
   
   
   $safevar = ereg_replace("[^A-Za-z]", "", $string); 
   
   
   return $safevar;
}

?>