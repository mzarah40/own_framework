<?php 

namespace App\Controller;

use App\Jwt\Jwt;

class ApiController
{
	public function index() : string
	{
		$user = isset($_REQUEST['user']) ? $_REQUEST['user'] : "";
		$pass = isset($_REQUEST['pass']) ? $_REQUEST['pass'] : "";

		if ( $user != "mzaha" ) {
			throw new \Exception("Usuário nao encontrado.");
		}

		if ( $pass != "1234567" ) {
			throw new \Exception("Senha fornecida errada.");
		}



		$credentials = ['user' => $user, 'email' => 'mzaha@hotmail.com'];
		
		$jwt = new Jwt($credentials);

		return $jwt->getToken();
	
	}
}