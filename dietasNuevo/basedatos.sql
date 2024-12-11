create database dietas;

use dietas;

drop table if exists users;
create table users(
	id integer not null auto_increment,
	name varchar(30),
	last_name varchar(30),
	age integer,
	weight double,
	height double,
	email varchar(50),
	password varchar(100),
	img varchar(100),
	level TINYINT,
	primary key (id)
);

insert into users values (0,'Admin','Grijalva',34,62,173,'admin@gmail.com','123','default.jpg',1);
select * from users where email='admin@gmail.com' and password='123';
select img, name from users;

drop table if exists ingredients;
create table ingredients(
	id integer not null auto_increment,
	name varchar(30),
	primary key (id)
);

drop table if exists categories;
create table categories(
	id integer not null auto_increment,
	name varchar(30),
	img varchar(30),
	primary key (id)
);

drop table if exists diets;
create table diets(
	id integer not null auto_increment,
	name varchar(30),
	description varchar(100),
	preparation text,
	img varchar(30),
	id_category int,
	id_user int,
	primary key (id),
	CONSTRAINT fk_category FOREIGN KEY (id_category) REFERENCES categories(id)  ON DELETE CASCADE,
	CONSTRAINT fk_user_dd FOREIGN KEY (id_user) REFERENCES users(id)  ON DELETE CASCADE
);
insert into diets (name,description,preparation,img,id_category,id_user) 
	values ('Pechuga','Pechuga de ','Rebane 3 lechugas',
	'default.jpg',1,1)
drop table if exists diets_ingredientes;
create table diets_ingredientes(
	id integer not null auto_increment,
	id_diet int,
	id_ingredient int,
	quantity double,
	primary key (id),
	CONSTRAINT fk_diet FOREIGN KEY (id_diet) REFERENCES diets(id)  ON DELETE CASCADE,
	CONSTRAINT fk_ing FOREIGN KEY (id_ingredient) REFERENCES ingredients(id)  ON DELETE CASCADE

);

drop table if exists user_diet;
create table user_diet(
	id integer not null auto_increment,
	day int,
	weeks int,
	hour time,
	id_diet int,
	id_user int,
	primary key (id),
	CONSTRAINT fk_diet_u FOREIGN KEY (id_diet) REFERENCES diets(id)  ON DELETE CASCADE,
	CONSTRAINT fk_user_u FOREIGN KEY (id_user) REFERENCES users(id)  ON DELETE CASCADE
);

/*datos por defecto*/
insert into categories (0, 'Desayunos','desayuno.jpg');
insert into categories (0, 'Comidas','comida.jpg');
insert into categories (0, 'Cenas','cena.jpg');
insert into categories (0, 'Snacks','snack.jpg');


