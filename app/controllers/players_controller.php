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
			'organisation' => $params['organisation']
		));
		$errors = $player->check_validity();
		if(count($errors) == 0) {
			$player->save();
	    	Redirect::to('/player' . $player->id, array('message' => 'Uusi pelaaja luotu!'));
		} else {
			View::make('player/new.html', array('errors' => $errors));
		}
	}
}
