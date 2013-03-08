CREATE TABLE file
(
	id INTEGER NOT NULL AUTO_INCREMENT,
	name VARCHAR(128) NOT NULL,
	extension VARCHAR(128) NOT NULL,
	type VARCHAR(128) NOT NULL,
	size INTEGER NOT NULL,
	PRIMARY KEY (id)
)
ENGINE = InnoDB;

