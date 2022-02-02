<?php   

namespace App\Jwt;

class JwtResponseHttp
{
	public static function response($statusCode)
	{
		return http_response_code($statusCode);
	}
}