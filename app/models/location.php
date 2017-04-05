<?php

class Location extends BaseModel{

	public $id, $name, $description;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Location');
		$query->execute();

		$rows = $query->fetchAll();
		$locations = array();

		foreach($rows as $row){
			$locations[] = new Location(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'description' => $row['description']
			));
		}
		return $locations;
	}

	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Location WHERE id = :id');
	    $query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){
			$location = new Location(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'description' => $row['description']
			));
			return $location;
		}
		return null;
	}

	public static function destroy($id){
		$query = DB::connection()->prepare('DELETE FROM Location WHERE id = :id');
	    $query->execute(array('id' => $id));
	}

	public function check_validity(){
		$errors = array();
        // TODO
		return $errors;
	}

	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Location (name, description) VALUES (:name, :description) RETURNING id');
		$query->execute(array('name' => $this->name, 'description' => $this->description));
		$row = $query->fetch();
		Kint::trace();
		Kint::dump($row);
	}
}
