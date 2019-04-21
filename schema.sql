CREATE DATABASE yeticave
  DEFAULT CHARACTER SET utf8
  DEFAULT COLLATE utf8_general_ci;

USE yeticave;

CREATE TABLE category(
  id INT AUTO_INCREMENT PRIMARY KEY,
  name CHAR(25)

)

CREATE TABLE lot(
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_creation TIMESTAMP,
  name CHAR(50),
  description CHAR(50),
  preview_link CHAR(100),
  start_price INT,
  final_price INT,
  delta INT
)

CREATE TABLE bet(
  date TIMESTAMP,
  ready_price INT
)

CREATE TABLE users(
  id INT AUTO_INCREMENT PRIMARY KEY,
  date_registration TIMESTAMP,
  email CHAR(50),
  name CHAR(50),
  password CHAR(100),
  avatar_link CHAR(100),
  contact CHAR(100)
)
