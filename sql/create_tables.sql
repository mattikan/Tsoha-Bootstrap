-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Location(
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	description text
);

CREATE TABLE Player(
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	password varchar(255) NOT NULL,
	organisation varchar(50),
	rating INTEGER
);

CREATE TABLE Game(
	id SERIAL PRIMARY KEY,
	confirmed boolean DEFAULT TRUE,
	played DATE NOT NULL DEFAULT CURRENT_DATE,
	location_id INTEGER REFERENCES Location(id) ON UPDATE CASCADE,
	added DATE NOT NULL DEFAULT CURRENT_DATE,
	winning_team INTEGER NOT NULL,
	cups_left INTEGER NOT NULL
);

CREATE TABLE Participation(
	player_id INTEGER REFERENCES Player(id) ON UPDATE CASCADE ON DELETE CASCADE,
	game_id INTEGER REFERENCES Game(id) ON UPDATE CASCADE ON DELETE CASCADE,
	team INTEGER
);