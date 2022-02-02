<?php 

require_once "Connection.php";

class FirstMigration
{

	private $sql;
	private $mysql;

	public function __construct() {

		$this->mysql = Connection::getInstance();

		$this->sql = "

			CREATE TABLE IF NOT EXISTS users(
				id bigint(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
				nome varchar(150) DEFAULT NULL,
				email varchar(250) DEFAULT NULL,
				pass varchar(255) NOT NULL
			)
	
		";
	}

	public function run() {

		$this->mysql->execute($this->sql);

	}
}


$firstMigration = new FirstMigration();
$firstMigration->run();