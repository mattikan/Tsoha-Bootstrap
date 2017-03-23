<?php

  class HelloWorldController extends BaseController{

    public static function index(){
      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
   	  View::make('home.html');
    }

    public static function sandbox(){
      // Testaa koodiasi täällä
      View::make('helloworld.html');
    }

    public static function login() {
      View::make('login.html');
    }

    public static function player_list() {
      View::make('player_list.html');
    }

    public static function player_show() {
      View::make('player_show.html');
    }
  }
