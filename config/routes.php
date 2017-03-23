<?php

$routes->get('/', function() {
	HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
	HelloWorldController::sandbox();
});

$routes->get('/player', function() {
	HelloWorldController::player_list();
});

$routes->get('/player/1', function() {
	HelloWorldController::player_show();
});

$routes->get('/login', function() {
	HelloWorldController::login();
});