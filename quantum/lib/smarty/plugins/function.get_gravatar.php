<?php

 function GetGravatarUrl( $email, $size = 128, $type, $rating = 'pg' )
    {
        $gravatar = sprintf( 'http://www.gravatar.com/avatar/%s?d=%s&s=%d&r=%s',
                              md5( $email ), $type, $size, $rating );
        return $gravatar;
    }



function smarty_function_get_gravatar($params, $smarty)

{
  //g
  
  $type = $params["type"];
  $gravatar =	GetGravatarUrl($params["email"], $params["size"], $type);
	return $gravatar;
}



?>