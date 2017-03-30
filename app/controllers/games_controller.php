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

	public static function store(){
		$params = $_POST;
		$game = new Game(array(
			'id' => $row['id'],
			'confirmed' => $row['confirmed'],
			'played' => $row['played'],
			'location_id' => $row['location_id'],
			'added' => $row['added'],
			'winning_team' => $row['winning_team']
		));
		$game->save();
	    Redirect::to('/game/' . $game->id, array('message' => 'Uusi peli luotu!'));
	}
}
