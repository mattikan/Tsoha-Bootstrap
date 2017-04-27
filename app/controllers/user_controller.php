<?php

class UserController extends BaseController{

  public static function login(){
      View::make('player/login.html');
  }

  public static function handle_login(){
    $params = $_POST;

    $player = Player::authenticate($params['name'], $params['password']);

    if(!$player){
      View::make('player/login.html', array('errors' => 'Väärä käyttäjätunnus tai salasana!', 'name' => $params['name']));
    }else{
      $_SESSION['user'] = $player->id;

      Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $player->name . '!'));
    }
  }

  public static function logout(){
    $_SESSION['user'] = null;
    Redirect::to('/', array('message' => 'Olet kirjautunut ulos!'));
  }

}