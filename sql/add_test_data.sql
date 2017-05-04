-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Location (name, description) VALUES ('Alina', 'Uudella sijaitseva tilava juhlasali.');
INSERT INTO Location (name, description) VALUES ('Klusteri', 'Se tuttu ja turvallinen(?).');
INSERT INTO Location (name, description) VALUES ('Muu', 'Ei siis se mitä lehmät sanoo.');

INSERT INTO Player (name, password, organisation, rating) VALUES ('nakki', 'makkara', 'TKO-äly ry', 1000);
INSERT INTO Player (name, password, organisation, rating) VALUES ('kjarkko', 'stallmanonjumala', 'Kumpulan roskakorit ry', 500);

INSERT INTO Game (confirmed, location_id, winning_team, cups_left) values (true, (select id from Location where name like 'Alina' limit 1), 0, 10);

INSERT INTO Game (confirmed, location_id, winning_team, cups_left) values (true, (select id from Location where name like 'Klusteri' limit 1), 1, 10);


INSERT INTO Participation (player_id, game_id, team) values (
	(select id from Player where name like 'nakki' limit 1),
	(select id from Game where winning_team = 0),
	0
	);

INSERT INTO Participation (player_id, game_id, team) values (
	(select id from Player where name like 'nakki' limit 1),
	(select id from Game where winning_team = 1),
	1
	);

INSERT INTO Participation (player_id, game_id, team) values (
	(select id from Player where name like 'kjarkko' limit 1),
	(select id from Game where winning_team = 0),
	1
	);

INSERT INTO Participation (player_id, game_id, team) values (
	(select id from Player where name like 'kjarkko' limit 1),
	(select id from Game where winning_team = 1),
	0
	);
