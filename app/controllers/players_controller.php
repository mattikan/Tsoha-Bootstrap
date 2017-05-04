<?php
class PlayerController extends BaseController{
	public static function index(){
		$players = Player::all();
		View::make('player/index.html', array('players' => $players));
	}

	public static function show($id){
		$player = Player::find($id);
		View::make('player/show.html', array('player' => $player));
	}

	public static function edit($id){
		$player = Player::find($id);
		View::make('player/edit.html', array('id' => $id));
	}

	public static function create(){
		View::make('player/new.html');
	}

	public static function store(){
		$params = $_POST;
		$player = new Player(array(
			'name' => $params['name'],
			'password' => $params['password'],
			'organisation' => $params['organisation'],
			'rating' => 800
		));
		$errors = $player->check_validity();
		if(count($errors) == 0) {
			$player->save();
	    	Redirect::to('/player' . $player->id, array('message' => 'Uusi pelaaja luotu!'));
		} else {
			View::make('player/new.html', array('errors' => $errors));
		}
	}

	public static function update_ratings($player1, $player2, $winning_team) {
		$match = new ELOMatch();
		if ($winning_team === 0) {
			$match->addPlayer($player1->name, 2, $player1->rating);
			$match->addPlayer($player2->name, 1, $player2->rating);
		} else {
			$match->addPlayer($player1->name, 1, $player1->rating);
			$match->addPlayer($player2->name, 2, $player2->rating);
		}
		$match->calculateELOs();
		$player1->rating = $match->getELO($player1->name);
		$player2->rating = $match->getELO($player2->name);
		$player1->update_rating();
		$player2->update_rating();
	}

	
}
