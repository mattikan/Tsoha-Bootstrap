<?php

class Game extends BaseModel{

	public $id, $confirmed, $played, $location_id, $added, $winning_team;

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
				'winning_team' => $row['winning_team']
			));
		}
		return $games;
	}

	public static function find($id){
		$query = DB::connection()->prepare('SELECT * FROM Game WHERE id = :id LIMIT 1');
	    $query->execute(array('id' => $id));
		$row = $query->fetch();

		if($row){
			$game = new Game(array(
				'id' => $row['id'],
				'confirmed' => $row['confirmed'],
				'played' => $row['played'],
				'location_id' => $row['location_id'],
				'added' => $row['added'],
				'winning_team' => $row['winning_team']
			));
			return $game;
		}
		return null;
	}

	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Game (confirmed, played, location_id, added, winning_team) VALUES (:confirmed, :played, :location_id, :added, :winning_team) RETURNING id');
		$query->execute(array('confirmed' => $this->confirmed, 'played' => $this->played, 'location_id' => $this->location_id, 'added' => $this->added, 'winning_team' => $this->winning_team));
		$row = $query->fetch();
		Kint::trace();
		Kint::dump($row);
	}
}
