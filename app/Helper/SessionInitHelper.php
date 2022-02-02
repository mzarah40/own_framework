<?php  

namespace App\Helper;

class SessionInitHelper
{
	public static function run()
	{
		if (!$_SESSION) {
			session_start();
		}
	}
}