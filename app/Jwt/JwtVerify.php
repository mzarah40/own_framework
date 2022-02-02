<?php   

namespace App\Jwt;

class JwtVerify
{
	private static $token;
	private static $key = API_KEY;

	public static function verify($token="") : bool
	{
		$parts = explode(" ", $token);

		if ($token !== "" && is_array($parts) && count($parts) == 2) {
		
			$parts = explode(".", $parts[1]);

			$header     = $parts[0];
			$payload    = $parts[1];
			$signature  = $parts[2];

			$valid = hash_hmac('sha256', "$header.$payload", self::$key, true);

			$valid = base64_encode($valid);

			if ($signature == $valid) {
				return true;
			}


			return false;

		} else {

			return false;
		
		}

	}
}