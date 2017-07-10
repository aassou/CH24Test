CREATE TABLE IF NOT EXISTS t_comment (
	id INT(11) NOT NULL AUTO_INCREMENT,
	name VARCHAR(50) DEFAULT NULL,
	email VARCHAR(100) DEFAULT NULL,
	url VARCHAR(255) DEFAULT NULL,
	remark TEXT DEFAULT NULL,
	idEntry INT(12) DEFAULT NULL,
	created DATETIME DEFAULT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;