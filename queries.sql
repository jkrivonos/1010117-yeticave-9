INSERT INTO category (name) VALUES ('Доски и лыжи'),('Крепления'),('Ботинки'), ('Одежда'), ('Инструменты'),('Разное');

INSERT INTO user SET registration_date = NOW(), email='yulia@gmail.com',  name = 'Yulia', password = 'supersecret', avatar_link = 'img_link', contact = 'Краснодар';
INSERT INTO user SET registration_date = NOW(), email='lera@gmail.com',  name = 'Lera', password = 'secret', avatar_link = 'img_link2', contact = 'Астрахань';

$date = "04-15-2013";
$date1 = str_replace('-', '/', NOW());
$tomorrow = date('m-d-Y',strtotime(str_replace('-', '/', NOW()). "+1 days"));

INSERT INTO lot SET description = '2014 Rossignol District Snowboard', start_price = 10999,  img_link = 'img/lot-1.jpg', category_id = 1, creation_date = NOW();
INSERT INTO lot SET description = 'DC Ply Mens 2016/2017 Snowboard', start_price = 159999,  img_link = 'img/lot-2.jpg', category_id = 1, creation_date = NOW();
INSERT INTO lot SET description = 'Крепления Union Contact Pro 2015 года размер L/XL', start_price = 8000,  img_link = 'img/lot-3.jpg', category_id = 2, creation_date = NOW();
INSERT INTO lot SET description = 'Ботинки для сноуборда DC Mutiny Charocal', start_price = 10999,  img_link = 'img/lot-4.jpg', category_id = 3, creation_date = NOW();
INSERT INTO lot SET description = 'Куртка для сноуборда DC Mutiny Charocal', start_price = 7500,  img_link = 'img/lot-5.jpg', category_id = 4, creation_date = NOW();
INSERT INTO lot SET description = 'Маска Oakley Canopy', start_price = 5400,  img_link = 'img/lot-6.jpg', category_id = 6, creation_date = NOW();

ALTER TABLE lot ADD COLUMN expiration_date TIMESTAMP;
UPDATE lot SET expiration_date = 20201230 WHERE description = '2014 Rossignol District Snowboard';
UPDATE lot SET expiration_date = 20201225 WHERE description = 'DC Ply Mens 2016/2017 Snowboard';
UPDATE lot SET expiration_date = 20201220 WHERE description = 'Крепления Union Contact Pro 2015 года размер L/XL';
UPDATE lot SET expiration_date = 20201217 WHERE description = 'Ботинки для сноуборда DC Mutiny Charocal';
UPDATE lot SET expiration_date = 20190427 WHERE description = 'Куртка для сноуборда DC Mutiny Charocal';
UPDATE lot SET expiration_date = 20201212 WHERE description = 'yellow duck';

INSERT INTO bet SET user_id = 1, lot_id = 2, creation_time = NOW(), price = 50000;
INSERT INTO bet SET user_id = 2, lot_id = 2, creation_time = NOW(), price = 70000;
INSERT INTO bet SET user_id = 2, lot_id = 7, creation_time = NOW(), price = 36000;

SELECT name FROM category;

-- получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, название категории;
SELECT
  lot.description,
  lot.start_price,
  lot.creation_date,
  lot.img_link,
  lot.expiration_date,
  category.name,
  IFNULL( MAX(bet.price), lot.start_price) as max_price
  FROM
  lot INNER JOIN category ON lot.category_id = category.id
  LEFT JOIN bet ON lot.id = bet.lot_id WHERE lot.expiration_date > NOW() GROUP BY lot.id
  ORDER BY lot.creation_date DESC;

-- показать лот по его id. Получите также название категории, к которой принадлежит лот;
SELECT lot.description, category.name FROM lot INNER JOIN category ON lot.category_id = category.id WHERE lot.id = 2

UPDATE lot SET description = 'yellow duck' WHERE id = 7;

-- получить список самых свежих ставок для лота по его идентификатору.
SELECT bet.price, bet.creation_time FROM lot INNER JOIN bet ON bet.lot_id = lot.id WHERE lot.id = 2 ORDER BY bet.creation_time DESC;

