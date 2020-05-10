
INSERT INTO user (fullname, email, password) VALUES ('Paduraru Dana', 'danapaduraru@gmail.com', 'parola1');
INSERT INTO user (fullname, email, password) VALUES ('Georgescu Florin', 'georgescuflorin24@gmail.com', 'parola2');

INSERT INTO album(name, short_description) VALUES ('De munte', 'Acesta este un album cu flori de munte');
INSERT INTO album(name, short_description) VALUES ('Plante carnivore', 'Acesta este un album cu plante carnivore');

INSERT INTO user_album(id_user, id_album) VALUES ((SELECT id FROM user WHERE fullname = 'Paduraru Dana'), (SELECT id FROM album WHERE name = 'Plante carnivore'));

INSERT INTO plant(name, family, collection, collecter, location, image) VALUES ('floare', 'plantus verdaculus', 'plante', 'Jhon Smith', 'Nicaragua', 'mai vedem dupa');

INSERT INTO plant_album(id_plant, id_album) VALUES ((SELECT id FROM plant WHERE name = 'Buxus'), (SELECT id FROM album WHERE name = 'De munte'));