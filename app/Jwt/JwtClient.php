<?php  

namespace App\Jwt;

class JwtClient
{
	private static $token;

	public static function jwtSend($token="", $url="")
	{
		self::$token = $token;

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

		$headers = [
			"Accept:application/json",
			"Authorization: Bearer {self::$token}"
		];

		curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

		// para debug somente
		curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

		$resp = curl_exec($curl);

		curl_close($curl);

		return $resp;
	}
}