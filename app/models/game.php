<?php

class Game extends BaseModel{

	public $id, $confirmed, $played, $location_id, $added, $winning_team, $cups_left;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Game');
		$query->execute();

		$rows = $query->fetchAll();
		$games = array();

		foreach($rows as $row){
			$games[] = new Game(array(
				'id' => $row['id'],
				'confirmed' => $row['confirmed'],
				'played' => $row['played'],
				'location_id' => $row['location_id'],
				'added' => $row['added'],
				'winning_team' => $row['winning_team'],
				'cups_left' => $row['cups_left']
			));
		}
		return $games;
	}

	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Game WHERE id = :id');
	    $query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){
			$game = new Game(array(
				'id' => $row['id'],
				'confirmed' => $row['confirmed'],
				'played' => $row['played'],
				'location_id' => $row['location_id'],
				'added' => $row['added'],
				'winning_team' => $row['winning_team'],
				'cups_left' => $row['cups_left']
			));
			return $game;
		}
		return null;
	}

	public static function destroy($id){
		$query = DB::connection()->prepare('DELETE FROM Game WHERE id = :id');
	    $query->execute(array('id' => $id));
	}

	public function check_validity(){
		$errors = array();
		if($this->confirmed != true || $this->confirmed != false) {
			$errors[] = 'confirmed must be boolean';
		}
		if($this->winning_team != 0 || $this->winning_team != 1) {
			$errors[] = 'winning team must be 0 or 1';
		}
		return $errors;
	} 

	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Game (played, location_id, winning_team, cups_left) VALUES (:played, :location_id, :winning_team, :cups_left) RETURNING id');
		$query->execute(array('played' => $this->played, 'location_id' => $this->location_id, 'winning_team' => $this->winning_team, 'cups_left' => $this->cups_left));
		$row = $query->fetch();
	}

	public function update(){
		$query = DB::connection()->prepare('UPDATE Game SET played = :played, location_id = :location_id, winning_team = :winning_team, cups_left = :cups_left WHERE id = :id');
		$query->execute(array('played' => $this->played, 'location_id' => $this->location_id, 'winning_team' => $this->winning_team, 'cups_left' => $this->cups_left, 'id' => $this->id));
		$row = $query->fetch();
	}
}
