CREATE DATABASE yeticave
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE category(
  id INT AUTO_INCREMENT PRIMARY KEY,
  name CHAR(25),
  code CHAR(50)
)

CREATE TABLE lot(
  id INT AUTO_INCREMENT PRIMARY KEY,
  creation_date TIMESTAMP,
  description CHAR(50),
  img_link CHAR(100),
  start_price INT,
  final_price INT,
  delta_bet INT,
  category_id INT,
  user_id INT,
  winner_user_id INT,
  FOREIGN KEY (category_id) REFERENCES category(id),
  FOREIGN KEY (user_id) REFERENCES user(id),
  FOREIGN KEY (winner_user_id) REFERENCES user(id)
)

CREATE TABLE bet(
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  lot_id INT,
  creation_time TIMESTAMP,
  price INT,
  FOREIGN KEY (lot_id) REFERENCES lot(id),
  FOREIGN KEY (user_id) REFERENCES user(id)
)

CREATE TABLE user(
  id INT AUTO_INCREMENT PRIMARY KEY,
  registration_date TIMESTAMP,
  email CHAR(50),
  name CHAR(50),
  password CHAR(100),
  avatar_link CHAR(100),
  contact CHAR(100)
)

CREATE INDEX category_name ON category(name);
CREATE INDEX lot_description ON lot(description);
CREATE INDEX user_name ON user(name);
CREATE INDEX user_contacts ON user(contact);

CREATE UNIQUE INDEX user_email ON user(email);
CREATE UNIQUE INDEX id_category ON category(id);
CREATE UNIQUE INDEX id_lot ON lot(id);
CREATE UNIQUE INDEX id_bet ON bet(id);
CREATE UNIQUE INDEX id_user ON user(id);

