<?php

$routes->get('/', function() {
	HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
	HelloWorldController::sandbox();
});

$routes->get('/login', function() {
	PlayerController::login();
});

$routes->post('/login', function(){
	PlayerController::handle_login();
});

$routes->get('/player', function() {
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

$routes->get('/player/:id', function($id) {
	PlayerController::show($id);
});

$routes->get('/login', function() {
	HelloWorldController::login();
});

$routes->get('/game', function() {
	GameController::index();
});

$routes->get('/game/new', function(){
	GameController::create();
});

$routes->get('/game/:id', function($id){
	GameController::show($id);
});

$routes->post('/game', function(){
	GameController::store();
});

$routes->get('/game/edit/:id', function(){
	GameController::edit();
});
