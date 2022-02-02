<?php 

namespace App\Model;

use App\Orm\FlashQuery;

class AuthModel
{
	private $table = "users";
	private $fillable = ['nome','email','password'];

	public static function assertAuth() : bool 
	{
		return true;
	}
}