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
  winner_user_id INT
)

CREATE TABLE bet(
  id INT,
  user_id INT,
  lot_id INT,
  creation_time TIMESTAMP,
  price INT
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
