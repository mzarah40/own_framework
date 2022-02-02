<?php 

namespace App\Jwt;

class Jwt
{

	private $user = "";
	private $email = "";
	private $key = "";
	//private $dominio = "http://localhost/framework";

	public function __construct($arrayUserEmail=[])
	{
		$this->user  = $arrayUserEmail['user'];
		$this->email = $arrayUserEmail['email'];
	}

	public function buildToken () : string
	{
		$this->key = API_KEY;

		// Header Token
		$header = [
		    'typ' => 'JWT',
		    'alg' => 'HS256'
		];

		// Payload - Content
		$payload = [
		    //'exp' => (new DateTime("now"))->getTimestamp(),
		    //'uid' => 1,
		    //'iat' => timestamp do inicio do token
		    //'iss'   => $this->dominio,
		    'name'  => $this->user,
		    'email' => $this->email
		];

		// JSON
		$header  = json_encode($header);
		$payload = json_encode($payload);

		// Base 64
		$header  = base64_encode($header);
		$payload = base64_encode($payload);

		// Sign
		$sign    = hash_hmac('sha256', $header . "." . $payload, $this->key, true);
		$sign    = base64_encode($sign);

		// Token
		$token   = $header . '.' . $payload . '.' . $sign;

		return $token;
	}
}