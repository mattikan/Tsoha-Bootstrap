<?php

function check_logged_in(){
  BaseController::check_logged_in();
}

$routes->get('/', function() {
	HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', 'check_logged_in', function() {
	HelloWorldController::sandbox();
});

$routes->get('/login', function() {
	UserController::login();
});

$routes->post('/login', function(){
	UserController::handle_login();
});

$routes->post('/logout', function(){
	UserController::logout();
});

$routes->get('/player', 'check_logged_in', function() {
	PlayerController::index();
});

$routes->get('/registration', function() {
	PlayerController::create();
});

$routes->post('/player', function() {
	PlayerController::store();
});

$routes->get('/player/edit/:id', function($id) {
	PlayerController::edit($id);
});

$routes->get('/player/:id', 'check_logged_in', function($id) {
	PlayerController::show($id);
});

$routes->get('/game', 'check_logged_in', function() {
	GameController::index();
});

$routes->get('/game/new', 'check_logged_in', function(){
	GameController::create();
});

$routes->get('/game/:id', 'check_logged_in', function($id){
	GameController::show($id);
});

$routes->post('/game', 'check_logged_in', function(){
	GameController::store();
});

$routes->get('/game/edit/:id', 'check_logged_in', function(){
	GameController::edit();
});
