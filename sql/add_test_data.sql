-- Lisää INSERT INTO lauseet tähän tiedostoon
INSERT INTO Location (name, description) VALUES ('Alina', 'Uudella sijaitseva tilava juhlasali.');
INSERT INTO Location (name, description) VALUES ('Klusteri', 'Se tuttu ja turvallinen(?).');

INSERT INTO Player (name, password, organisation) VALUES ('nakki', '$2y$10$xfHlYICtwQ5UTr6kANLMXOkbzhr1edQBC0mLcnwRfhN.V41LzZs2K', 'TKO-äly ry');
INSERT INTO Player (name, password, organisation) VALUES ('kjarkko', '$2y$10$/mXFz6By/AUpvaO3Vf6PmOR45V69f.pGqe7z8UK2DEAlKdliPQ0I6', 'Kumpulan roskakorit ry');

INSERT INTO Game (confirmed, location_id, winning_team) values (true, (select id from Location where name like 'Alina'), 0);

INSERT INTO Game (confirmed, location_id, winning_team) values (true, (select id from Location where name like 'Klusteri'), 1);


INSERT INTO Participation (player_id, game_id, team) values (
	(select id from Player where name like 'nakki'),
	(select id from Game where winning_team = 0),
	0
	);

INSERT INTO Participation (player_id, game_id, team) values (
	(select id from Player where name like 'nakki'),
	(select id from Game where winning_team = 1),
	1
	);

INSERT INTO Participation (player_id, game_id, team) values (
	(select id from Player where name like 'kjarkko'),
	(select id from Game where winning_team = 0),
	1
	);

INSERT INTO Participation (player_id, game_id, team) values (
	(select id from Player where name like 'kjarkko'),
	(select id from Game where winning_team = 1),
	0
	);
