<?php 

namespace App\Security;

class Xss
{
	public static function xss($term=null) : string 
	{
		$str = strip_tags($term);

		return $str;
	}
}