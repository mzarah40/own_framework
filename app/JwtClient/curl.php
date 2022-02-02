<?php  

/*********************************************
 * 
 *  Enviando a requisição para o JWT
 * 
 * *******************************************/


$ArrayData = [];
$ArrayData['email'] = "mzaha@hotmail.com";
$ArrayData['pass']  = "123";

$DataJson = json_encode($ArrayData);

$curl = curl_init('http://localhost/framework/auth/get_token');

curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $DataJson);

$result = curl_exec($curl);

curl_close($curl);

$result = json_decode($result);

/*
echo "<pre>";
var_dump($result);
die();
*/

/************************************************
 * 
 *  RESGATANDO O SERVIÇO
 * 
 * **********************************************/

$DadosArray = array();
$DadosArray["item"] = "1234";
$DadosArray["descricao"] = "Pedido teste";
$DadosArray["valor"] = "4321";

$buildQuery = json_encode($DadosArray);

$curl = curl_init("http://localhost/framework/auth/validation_token");
curl_setopt($curl, CURLOPT_HTTPHEADER,["Authorization: Bearer {$result->token}","Content-Type: application/json"]);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $buildQuery);
curl_setopt($curl, CURLOPT_VERBOSE, true);

$retorno = curl_exec($curl);

curl_close($curl);

$retorno = json_decode($retorno);

var_dump($retorno->token);