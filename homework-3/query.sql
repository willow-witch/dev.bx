CREATE TABLE language
(
	ID varchar(2) not null,
	NAME varchar(50) not null,
	PRIMARY KEY (ID)
);

CREATE TABLE movie_title
(
	MOVIE_ID int not null,
	LANGUAGE_ID varchar(2) not null,
	TITLE varchar(500) not null,

	PRIMARY KEY (MOVIE_ID, LANGUAGE_ID),
	FOREIGN KEY FK_MT_LANGUAGE (LANGUAGE_ID)
		REFERENCES language(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT,
	FOREIGN KEY FK_MT_MOVIE (MOVIE_ID)
		REFERENCES movie(ID)
		ON UPDATE RESTRICT
		ON DELETE RESTRICT
);

insert into language
values
	('ru', 'Русский'),
	('en', 'Английский'),
	('de', 'Немецкий');

insert into movie_title(
	select ID,
	       'ru' as LANGUAGE_ID,
	       TITLE
	from movie
);

alter table movie
	drop column TITLE;
