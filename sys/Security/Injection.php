<?php   

namespace Sys\Security;

class Injection
{
	public static function clean ($sql) : string 
	{
		$sql     = preg_replace('/(from|alter table|select|insert|delete|update|where|drop table|show tables|#|--|\\\)/i', '', $sql);
   		$sql     = trim($sql);
	    $sql     = strip_tags($sql);
	   	$sql     = addslashes($sql);
	   	
	    
	    return $sql;
	}
}