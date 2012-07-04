<?php

function format_json($array, $indent) {

    $indent_text = '';

    for ($ii = 0;$ii < $indent; $ii++)
        $indent_text .= '    ';

    echo '<br />'.$indent_text.'{<br />';

    foreach ($array as $key => $value) {
        echo $indent_text.'"'.$key.'" : '; 
        if (is_array($value))
            format_json( $value, $indent + 1 );
        else echo '"'.$value.'"; <br />';
    }
    echo $indent_text.'}<br />';
}



function smarty_function_pretty_format_json($params, $smarty)
{
  //$array // $indent
  
  $array = json_decode($params['json'], true);
  	
 $indent_text = '';

    for ($ii = 0;$ii < $params['indent']; $ii++)
        $indent_text .= '    ';

    echo '<br />'.$indent_text.'{<br />';

    foreach ($array as $key => $value) {
        echo $indent_text.'"'.$key.'" : '; 
        if (is_array($value))
            format_json( $value, $indent + 1 );
        else echo '"'.$value.'"; <br />';
    }
    echo $indent_text.'}<br />';
}


?>