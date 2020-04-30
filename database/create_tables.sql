create table user(
    id INT NOT NULL AUTO_INCREMENT,
    fullname VARCHAR(60) NOT NULL,
    email VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    PRIMARY KEY(id)
);

CREATE TABLE album(
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
	short_description VARCHAR(50) NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE user_album(
	id INT NOT NULL AUTO_INCREMENT,
	id_user INT NOT NULL,
	id_album INT NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY (id_user) REFERENCES user(id),
	FOREIGN KEY (id_album) REFERENCES album(id)
);

CREATE TABLE plant_album(
	id INT NOT NULL AUTO_INCREMENT,
	id_plant INT NOT NULL,
	id_album INT NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(id_plant) REFERENCES plant(id),
	FOREIGN KEY(id_album) REFERENCES album(id)
);

CREATE TABLE plant(
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(50) NOT NULL,
	family VARCHAR(50) NOT NULL,
	collection VARCHAR(50) NOT NULL,
	collecter VARCHAR(50) NOT NULL,
	location VARCHAR(50) NOT NULL,
	image LONGBLOB NOT NULL,
	PRIMARY KEY(id)
);