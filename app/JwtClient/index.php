<?php  

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);


require "vendor/autoload.php";


$client = new \GuzzleHttp\Client();

$response = $client->request('POST', 'http://localhost/framework/auth/get_token', [
    'json' => ['email' => 'mzaha@hotmail.com', 'pass' => '123'] // or 'json' => [...]
]);

if ($response->getStatusCode() == 200) {

	
	$resposta = $response->getBody()->getContents();
	$resposta = json_decode($resposta);

	//echo $resposta->token;



	$clientB = new GuzzleHttp\Client();

	$responseB = $clientB->request('POST', 'http://localhost/framework/auth/validation_token', [
		"headers" => [ "Authorization" => "Bearer {$resposta->token}" ],
		'json' => ['foo' => 'bar', 'baz' => ['hi', 'there!']]
	]);

	if ($responseB->getStatusCode() == 200) {

		echo "<pre>";
		$respostaB = $responseB->getBody()->getContents();
		$respostaB = json_decode($respostaB);

		var_dump($respostaB->token);

	}

}


