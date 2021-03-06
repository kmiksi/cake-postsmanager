-- DROP TABLE posts;
-- DROP TABLE users;
-- DROP TABLE levels;


CREATE TABLE levels (
  id INT NOT  NULL AUTO_INCREMENT,
  name VARCHAR(45) NOT NULL DEFAULT '',
  description VARCHAR(45) NOT NULL DEFAULT '',
  PRIMARY KEY (id)
);
INSERT INTO levels (id, name, description) VALUES (1, 'admin', 'Admin'), (2, 'user', 'User');

CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(45) NOT NULL,
  username VARCHAR(45) NOT NULL,
  password VARCHAR(45) NOT NULL,
  level INT NOT NULL DEFAULT 2,
  created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  INDEX (level ASC),
  FOREIGN KEY (level) REFERENCES levels (id)
);

CREATE TABLE posts (
  id INT NOT NULL AUTO_INCREMENT,
  user_id INT NOT NULL,
  title VARCHAR(40) NOT NULL DEFAULT '',
  content TEXT NOT NULL DEFAULT '',
  created TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  INDEX (user_id ASC),
  FOREIGN KEY (user_id) REFERENCES users (id)
);

