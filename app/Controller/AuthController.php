<?php 

namespace App\Controller;

use App\Jwt\Jwt;
use App\Jwt\JwtResponseHttp;
use App\Jwt\JwtVerify;
use App\Model\AuthModel;
use App\Helper\View;


class AuthController 
{
	// use \App\Machinery\TraitMachinery;

	private $jwt = null;
	private $user = "";
	private $pass = "";
	
	public function login()
	{
		// $this->traitLoadView('template/header', []);
		// $this->traitLoadView('content/login',   []);
		// $this->traitLoadView('template/footer', []);

		View::render('template/header', ['title' => 'Jwt']);
		View::render('content/login',   []);
		View::render('template/footer', []);

		// View::smarty('index',[]);

	}

	public function get_token()
	{
		$input_data = file_get_contents("php://input");

		$post = json_decode($input_data);


		if ($post && $post->email == "mzaha@hotmail.com" && $post->pass == "123") {

			$vet          = [];
			$vet['email'] = $post->email;
			$vet['user']  = "Mauricio";

			// criando o token
			$res = (new Jwt($vet))->buildToken();


			// se não for possivel gerar o token
			if (!$res) {
				echo JwtResponseHttp::response(401);
				return false;
			}

			// retornando o token
			echo json_encode(['token' => $res]);

		} else {

			// se as credenciais forem inválidas
			echo JwtResponseHttp::response(401);
			return false;

		}

		
	}

	public function validation_token() 
	{
		
		$input_data = file_get_contents("php://input");

		$authorization = getallheaders();
		$authorization = $authorization['Authorization'];

		$verify = JwtVerify::verify($authorization);

		if (!$verify) {
			echo JwtResponseHttp::response(401);
			return false;
		}

		//echo JwtResponseHttp::response(200);
		echo json_encode(['token' => $authorization]);

	}
}