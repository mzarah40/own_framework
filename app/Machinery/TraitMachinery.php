<?php 

namespace App\Machinery;

trait TraitMachinery
{

	public function traitLoadView($view, $arrayVariables=[]) 
	{
		
		extract($arrayVariables);

		require __DIR__ . './../View/' . $view. '.php';
	}

	public function crypt (string $word) : string 
	{
		return sha1($word);
	}

	public static function isNatural (int $number) : bool 
	{
		if (!is_numeric($number)) {
			return false;
		}

		$natural = (int) $number;

		if ( ($natural - $number) != 0) {
			return false;
		}

		if ( $number <= 0 ) {
			return false;
		}

		return true;
	}

}