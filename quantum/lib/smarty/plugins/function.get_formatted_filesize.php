<?php



function smarty_function_get_formatted_filesize($params, $smarty)
{
  //g
  	 
	 
	 $chart_formatted_size = round($params['size']/1024, 0)." KB";
	
	if ($chart_formatted_size >= 999) {
		
		$chart_formatted_size = round($chart_formatted_size/1024, 2)." MB";
	}
	 
	
	 
	 
	
	return $chart_formatted_size;
	
}


?>