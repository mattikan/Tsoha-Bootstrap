<?php

$routes->get('/', function() {
	HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
	HelloWorldController::sandbox();
});

$routes->get('/player', function() {
	PlayerController::index();
});

$routes->get('/registration', function() {
	PlayerController::create();
});

$routes->post('/player/', function() {
	PlayerController::store();
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

$routes->get('/game/:id', function($id){
	GameController::show($id);
});

$routes->get('/game/new', function(){
	GameController::create();
});

$routes->post('/game/', function(){
	GameController::store();
});

$routes->get('/game/edit/:id', function(){
	GameController::edit();
});
