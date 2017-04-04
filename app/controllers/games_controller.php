<?php

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
		View::make('game/new.html', array('locations' => $locations));
	}

	public static function store(){
		$params = $_POST;
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
			'winning_team' => $params['winning_team']
		));
		$game->save();
		Redirect::to('/game' . $game->id, array('message' => 'Uusi peli luotu!'));
		
	}
}
