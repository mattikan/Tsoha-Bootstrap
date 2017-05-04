<?php

require('lib/elo.php');

class GameController extends BaseController{
	public static function index(){
		$games = Game::all();
		View::make('game/index.html', array('games' => $games));
	}

	public static function show($id){
		$game = Game::find($id);
		View::make('game/show.html', array('game' => $game));
	}

	public static function edit($id){
		$game = Game::find($id);
		View::make('game/edit.html', array('id' => $id));
	}

	public static function create(){
		$locations = Location::all();
		$players = Player::all();
		View::make('game/new.html', array('locations' => $locations, 'players' => $players));
	}

	public static function store(){
		$params = $_POST;
		if (!Player::authenticate(Player::find($params['player2'])->name, $params['player2-password'])) {
			Redirect::to('/game/new', array('message' => 'Salasana väärin!'));
		} else {
			$date = date_parse($params['played']);
			foreach ($date as $value){
				if ($value == false) {
					$format = 'Ymd';
					$date = date($format);
					break;
				}
			}  
			$game = new Game(array(
				'played' => $date,
				'location_id' => $params['location_id'],
				'winning_team' => $params['winning_team'],
				'cups_left' => $params['cups_left']
			));
			$game->save();

			$player1 = BaseController::get_user_logged_in();
			$player2 = Player::find($params['player2']);
			PlayerController::update_ratings($player1, $player2, $params['winning_team']);

			Redirect::to('/player', array('message' => 'Uusi peli luotu ja rankingit päivitetty!'));
			
		}
		
	}
/*
	public static function calculate_elo_changes($participations) {
		if ($participations.sizeof == 2) {
			$player1 = Player::find($participations[1]->player_id);
			$player2 = Player::find($participations[2]->player_id);
			$game = Game::find($participations[1]->game_id);
			$match = new ELOMatch();
			if ($game->winning_team == $participations[1]->team) {
				$match->addPlayer($player1->name, 1, $player1->rating);
				$match->addPlayer($player2->name, 2, $player2->rating);
			} else {
				$match->addPlayer($player1->name, 2, $player1->rating);
				$match->addPlayer($player2->name, 1, $player2->rating);
			}
			$match->calculateELOs();
			$match->getELO($player1->name);
			$match->getELO($player2->name);
		}
	}
*/
}
