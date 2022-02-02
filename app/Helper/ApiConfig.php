<?php  

namespace App\Helper;

class ApiConfig
{

	public static function check($requestInput) 
	{
		if (is_object($requestInput)) {
			return "object";
		}

		
	}

}