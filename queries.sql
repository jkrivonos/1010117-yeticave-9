INSERT INTO category (name) VALUES ('Доски и лыжи'),('Крепления'),('Ботинки'), ('Одежда'), ('Инструменты'),('Разное');

INSERT INTO user SET registration_date = NOW(), email='yulia@gmail.com',  name = 'Yulia', password = 'supersecret', avatar_link = 'img_link', contact = 'Краснодар';
INSERT INTO user SET registration_date = NOW(), email='lera@gmail.com',  name = 'Lera', password = 'secret', avatar_link = 'img_link2', contact = 'Астрахань';

INSERT INTO lot SET description = '2014 Rossignol District Snowboard', start_price = 10999,  img_link = 'img/lot-1.jpg', category_id = 1;
INSERT INTO lot SET description = 'DC Ply Mens 2016/2017 Snowboard', start_price = 159999,  img_link = 'img/lot-2.jpg', category_id = 1;
INSERT INTO lot SET description = 'Крепления Union Contact Pro 2015 года размер L/XL', start_price = 8000,  img_link = 'img/lot-3.jpg', category_id = 2;
INSERT INTO lot SET description = 'Ботинки для сноуборда DC Mutiny Charocal', start_price = 10999,  img_link = 'img/lot-4.jpg', category_id = 3;
INSERT INTO lot SET description = 'Куртка для сноуборда DC Mutiny Charocal', start_price = 7500,  img_link = 'img/lot-5.jpg', category_id = 4;
INSERT INTO lot SET description = 'Маска Oakley Canopy', start_price = 5400,  img_link = 'img/lot-6.jpg', category_id = 6;

INSERT INTO bet SET user_id = 1, lot_id = 2, creation_time = NOW(), price = 50000;
INSERT INTO bet SET user_id = 2, lot_id = 7, creation_time = NOW(), price = 36000;

SELECT name FROM category;

получить самые новые, открытые лоты. Каждый лот должен включать название, стартовую цену, ссылку на изображение, цену, название категории;
SELECT lot.description, category.id, lot.start_price, lot.img_link, lot.final_price, category.name FROM lot INNER JOIN category ON lot.category_id = category.id ORDER BY DESC надо написать по какому полю сортировать;

--  SELECT PARTS.Part, CATEGORIES.Cat_ID AS Cat, CATEGORIES.Price FROM PARTS INNER JOIN CATEGORIES ON PARTS.Cat = CATEGORIES.Cat_ID

Документация
#1064 - У вас ошибка в запросе. Изучите документацию по используемой версии MySQL на предмет корректного синтаксиса около 'INNER JOIN category ON lot.cat_id = category.id' на строке 1
SELECT PARTS.Part, CATEGORIES.Cat_ID AS Cat, CATEGORIES.Price FROM PARTS INNER JOIN CATEGORIES ON PARTS.Cat = CATEGORIES.Cat_ID