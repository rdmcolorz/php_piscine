CREATE TABLE db_tyang.ft_table 
(
	id INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
	login varchar(8) DEFAULT 'toto' NOT NULL,
	`group` ENUM('staff', 'student', 'other') NOT NULL,
	creation_date DATE NOT NULL
);