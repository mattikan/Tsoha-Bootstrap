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

	public static function login(){
		View::make('player/login.html');
	}

	public static function handle_login(){
		$params = $_POST;
		$player = Player::authenticate($params['name'], $params['password']);
		if(!$player){
			View::make('player/login.html', array('errors' => 'Väärä käyttäjätunnus tai salasana!', 'name' => $params['name']));
		}else{
			$_SESSION['userid'] = $player->id;
			Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $user->name . '!'));
		}
	}
}
