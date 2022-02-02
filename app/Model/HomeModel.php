<?php 

namespace App\Model;

use App\Orm\FlashQuery;

class HomeModel
{
	use \App\Machinery\TraitMachinery;
	private $flashQuery = null;
	private $table = "users";


	public function __construct()
	{
		$this->flashQuery = new FlashQuery();
	}

	public function all()
	{
		return $this->flashQuery->select(['*'])
								->from([$this->table])
								->get();
	}

	public function findById(int $id)
	{
		if ( TraitMachinery::isNatural($id) ) {
		
			return $this->flashQuery->select(['*'])
									->from([$this->table])
									->where('id = '.$id)
									->get();
		} else {

			return false;
		
		}
	}

	public function insert(array $values)
	{
		return $this->flashQuery->insert($this->table, $values);
	}
}