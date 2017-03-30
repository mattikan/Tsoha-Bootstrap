<?php

class Player extends BaseModel{

	public $id, $name, $password, $organisation;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Player');
		$query->execute();

		$rows = $query->fetchAll();
		$games = array();

		foreach($rows as $row){
			$players[] = new Player(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'password' => $row['password'],
				'organisation' => $row['organisation']
			));
		}
		return $players;
	}

	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Player WHERE id = :id LIMIT 1');
	    $query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){
			$player = new Player(array(
				'id' => $row['id'],
				'name' => $row['name'],
				'password' => $row['password'],
				'organisation' => $row['organisation']
			));
			return $player;
		}
		return null;
	}

	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Player (name, password, organisation) VALUES (:name, :password, :organisation) RETURNING id');
		$query->execute(array('name' => $this->name, 'password' => $this->password, 'organisation' => $this->organisation));
		$row = $query->fetch();
		Kint::trace();
		Kint::dump($row);
	}
}