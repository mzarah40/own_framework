<?php 

namespace Sys\Request;

use Sys\Security\Xss;
use Sys\Security\Injection;

class Request
{
	private static $httpRequest = [];

	public static function run() 
	{
		if ( isset($_REQUEST) ) {

			unset($_REQUEST['url']);
			unset($_REQUEST['csrf']);
			
			foreach ( $_REQUEST as $idx => $value ) {
				
				$index = Xss::clean(Injection::clean($idx));
				$valor = Xss::clean(Injection::clean($value));
				self::$httpRequest[$index] = $valor;
				
			}

		}

		return self::$httpRequest;
	}

}