
INSERT INTO user (fullname, email, password) VALUES ('Paduraru Dana', 'd@mail.com', '123');
INSERT INTO user (fullname, email, password) VALUES ('P Dana', 'danapaduraru@gmail.com', 'parola1');
INSERT INTO user (fullname, email, password) VALUES ('Georgescu Florin', 'georgescuflorin24@gmail.com', 'parola2');

INSERT INTO album(name, short_description, user_id) VALUES ('Favourites', 'Description for now.', (SELECT id FROM user WHERE email = 'd@mail.com'));
INSERT INTO album(name, short_description, user_id) VALUES ('Cleomaceae Family', 'Cleomaceae family only.', (SELECT id FROM user WHERE email = 'd@mail.com'));

INSERT INTO album(name, short_description, user_id) VALUES ('De munte', 'Acesta este un album cu flori de munte', (SELECT id FROM user WHERE fullName = 'Georgescu Florin'));
INSERT INTO album(name, short_description, user_id) VALUES ('Plante carnivore', 'Acesta este un album cu plante carnivore', (SELECT id FROM user WHERE fullName = 'Georgescu Florin'));

INSERT INTO plant(name, family, collection, collector, location, image) VALUES ('floare', 'plantus verdaculus', 'plante', 'Jhon Smith', 'Nicaragua', 'mai vedem dupa');

INSERT INTO plant_album(id_plant, id_album) VALUES ((SELECT id FROM plant WHERE name = 'floare'), (SELECT id FROM album WHERE name = 'Plante carnivore'));