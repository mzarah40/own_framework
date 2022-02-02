<?php   


class Connection 
{
	private static $instance;
	private $connection;
	private $resultSet;

	private function __construct () 
	{
		$this->connection = mysqli_connect("localhost", "root", "root") or die("Erro de conexão");
		mysqli_select_db($this->connection, "framework");
	}

	public static function getInstance () 
	{
		if ( !isset(self::$instance) ) {
			self::$instance = new Connection();
		}

		return self::$instance;
	}

	public function realScape($sql) 
	{
		return mysqli_real_escape_string($this->connection, $sql);
	}

	public function execute ($sql)
	{
		$this->resultSet = mysqli_query($this->connection, $sql);

		return $this->resultSet;
	}

	public function mfo () : mixed 
	{
		return mysqli_fecth_object($this->resultSet);
	}

	public function get($vazio=null){}

}