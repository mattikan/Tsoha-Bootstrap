<?php

class Participation extends BaseModel{

	public $player_id, $game_id, $team;

	public function __construct($attributes){
		parent::__construct($attributes);
	}

	public static function all(){
		$query = DB::connection()->prepare('SELECT * FROM Participation');
		$query->execute();

		$rows = $query->fetchAll();
		$participations = array();

		foreach($rows as $row){
			$participations[] = new Participation(array(
				'player_id' => $row['player_id'],
				'game_id' => $row['game_id'],
				'team' => $row['team']
			));
		}
		return $participations;
	}

	public static function find($player_id, $game_id){
		$query = DB::connection()->prepare('SELECT * FROM Participation WHERE player_id = :player_id AND game_id = :game_id');
	    $query->execute(array('player_id' => $player_id, 'game_id' => $game_id));
		$row = $query->fetch();

		if($row){
			$participation = new Participation(array(
				'player_id' => $row['player_id'],
				'game_id' => $row['game_id'],
				'team' => $row['team']
			));
			return $participation;
		}
		return null;
	}

	public static function destroy($player_id, $game_id){
		$query = DB::connection()->prepare('DELETE FROM Participation WHERE game_id = :game_id AND player_id = :player_id');
	    $query->execute(array('game_id' => $game_id, 'player_id' => $player_id));
	}

	public function check_validity(){
		$errors = array();
        // TODO
		return $errors;
	}

	public function save(){
		$query = DB::connection()->prepare('INSERT INTO Participation (game_id, player_id, team) VALUES (:game_id, :player_id, :team)');
		$query->execute(array('game_id' => $this->game_id, 'player_id' => $this->player_id, 'team' => $this->team));
		$row = $query->fetch();
		Kint::trace();
		Kint::dump($row);
	}
}
