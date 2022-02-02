<?php 

namespace App\Security;

class Csrf
{
	public static function get()
	{
		$_SESSION['csrf'] = md5(uniqid(time()));
		return "<input type='hidden' name='csrf' value='" . $_SESSION['csrf'] . "'>";
	}

	public static function run($csrf): bool
	{
		$sessionCsrf = $_SESSION['csrf'];

		unset($_SESSION['csrf']);

		if ($csrf == $sessionCsrf)	{
			return true;
		} else {
			return false;
		}
	}
}