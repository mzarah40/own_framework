<?php 

namespace App\Orm;

use App\Helper\SecurityHelper;
use App\Orm\SingleDbMysql;

class FlashQuery
{
	private $sql;
	private $run;

	public function __construct()
	{
		$this->run = SingleDbMysql::getInstance();
	}


	public function select (array $vetSql) 
	{
		$this->sql = ' SELECT ';

		foreach ( $vetSql as $idx => $value ) {

			$this->sql .= $this->run->realScape($value) . ',';

		}

		$this->sql = substr($this->sql, 0, -1);

		return $this;
	}

	public function from (array $table) 
	{
		$this->sql .= ' FROM ';

		foreach ( $table as $idx => $value ){
			$this->sql .= $this->run->realScape($value) . ',';
		}


		$this->sql = substr($this->sql, 0, -1);

		$this->sql .= " ";

		return $this;
	}

	public function inner ( string $table, string $on ) 
	{
		$this->sql .= ' INNER JOIN ' . $this->run->realScape($table) . ' ON ' . $this->run->realScape($on) . ' ';

		return $this;
	}

	public function left ( $table, $on ) 
	{
		$this->sql .= " LEFT JOIN " . $this->run->realScape($table) . " ON " . $this->run->realScape($on) . ' ';

		return $this;
	}

	public function right ( $table, $on )
	{
		$this->sql .= " RIGHT JOIN " . $this->run->realScape($table) . " ON " . $this->run->realScape($on) . ' ';
	}

	public function where ( string $condition ) 
	{
		$this->sql .= " WHERE " . $this->run->realScape($condition) . ' ';

		return $this;
	}

	public function and ( string $condition ) 
	{
		$this->sql .= " AND " . $this->run->realScape($condition) . " ";

		return $this;
	}

	public function or ( string $condition ) 
	{
		$this->sql .= " OR " . $this->run->realScape($condition) . " ";

		return $this;
	}

	public function like (string $like) 
	{
		$this->sql .= " LIKE '%" . $this->run->realScape($like) . "%' ";

		return $this;
	}

	public function where_like(string $field, $condition) 
	{
		$this->sql .= " WHERE " . $this->run->realScape($field) . " LIKE '%" . $this->run->realScape($condition) . "%' ";

		return $this;
	}

	public function having ( string $condition ) 
	{
		$this->sql .= " HAVING " . $this->run->realScape($condition) . " ";
	}

	public function group_by ( array $agroupment) 
	{
		$this->sql .= " GROUP BY ";
		
		foreach ($agroupment as $value) {
			$this->sql .= $this->run->realScape($value) . ",";
		} 

		$this->sql = substr($this->sql, 0, -1);

		$this->sql .= ' ';

		return $this;
	}

	public function order_by ( array $ob ) 
	{
		foreach ($ob as $idx => $value) {
			$this->sql .= " ORDER BY " . $this->run->realScape($idx) . " " . $this->run->realScape($value) . ",";
		}

		$this->sql = substr($this->sql, 0, -1);

		$this->sql .= ' ';

		return $this;
	}

	public function insert (string $table, array $fields)
	{
		$this->sql = " INSERT INTO " . $this->run->realScape($table) . " (";

		foreach ( $fields as $idx => $value ) {
			$this->sql .=  $this->run->realScape($idx) . ",";
		}

		$this->sql = substr($this->sql, 0, -1);

		// executa e retorna um resultado


		$this->sql .= ") VALUES (";


		foreach ( $fields as $idx => $value ) {
			$this->sql .= "'" . $this->run->realScape($value) . "',";
		}

		$this->sql = substr($this->sql, 0, -1);

		$this->sql .= ")";

	
		return $this->run->execute($this->sql);

	}

	public function insertBySelect (string $table, string $select) 
	{
		$this->sql = " INSERT INTO " . $table . " " . $select;

		// executa e retorna um resultado

		return $this->run->execute($this->sql);

	}


	public function update (string $table, $fields) 
	{
		$this->sql = " UPDATE " . $this->run->realScape($table) . " SET ";

		foreach ( $fields as $idx => $value ) {

			$this->sql .= " $idx = '" . $this->run->realScape($value) . "',";

		}

		$this->sql = substr($this->sql, 0, -1);

		// executa e retorna um resultado

		return $this->run->execute($this->sql);

	}

	public function delete (int $id, string $table) : bool 
	{
		$this->sql = "DELETE FROM " . $table . " WHERE id = '" . $this->run->realScape($id) . "'";

		// executa e retorna um resultado

		return $this->run->execute($this->sql);
	}

	public function get() 
	{
		return $this->run->execute($this->sql);
	}

}