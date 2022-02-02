<?php 

namespace App\Helper;

// require_once __DIR__ .  "./../../vendor/autoload.php";

class View
{
	public static function render($view, $data=[]) {
	
		extract($data);
		require __DIR__ . './../View/' . $view. '.php';

	}

	public static function smarty($view, $data=[]) {

		$smart = new Smarty;
		$smarty->debugging = true;
		$smarty->caching = true;
		$smarty->cache_lifetime = 120;

		$smarty->assign("data", $data);
		$smarty->display($view);
	}
}