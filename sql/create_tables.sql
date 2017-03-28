-- Lisää CREATE TABLE lauseet tähän tiedostoon
CREATE TABLE Location(
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	description text
);

CREATE TABLE Player(
	id SERIAL PRIMARY KEY,
	name varchar(50) NOT NULL,
	password varchar(50) NOT NULL
);

CREATE TABLE Game(
	id SERIAL PRIMARY KEY,
	confirmed boolean DEFAULT FALSE,
	played DATE,
	location_id INTEGER REFERENCES Location(id) ON UPDATE CASCADE,
	added DATE,
	winning_team INTEGER
);

CREATE TABLE Participation(
	player_id INTEGER REFERENCES Player(id) ON UPDATE CASCADE ON DELETE CASCADE,
	game_id INTEGER REFERENCES Game(id) ON UPDATE CASCADE ON DELETE CASCADE,
	team INTEGER
);