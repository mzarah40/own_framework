<?php  

namespace Sys\Security;

class Xss
{
	public static function clean($term=null) 
	{
		$str = strip_tags($term);

		return $str;
	}
}