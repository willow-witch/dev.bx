# 1. Вывести список фильмов, в которых снимались одновременно Арнольд Шварценеггер* и Линда Хэмилтон*.
#   Формат: ID фильма, Название на русском языке, Имя режиссёра.
select
	distinct movie_actor.MOVIE_ID as 'movie id',
             movie_title.TITLE as 'movie title',
             director.NAME as 'movie director'

from movie_actor inner join movie_title
                            on movie_actor.MOVIE_ID = movie_title.MOVIE_ID
                 inner join movie
                            on movie_actor.MOVIE_ID = movie.DIRECTOR_ID
                 inner join director
                            on movie.DIRECTOR_ID = director.ID

where movie_actor.MOVIE_ID in
      (select MOVIE_ID from movie_actor
       where movie_actor.ACTOR_ID=1)
  and movie_actor.MOVIE_ID in
      (select MOVIE_ID from movie_actor
       where ACTOR_ID=3)
  and movie_title.LANGUAGE_ID = 'ru';

# 2. Вывести список названий фильмов на англйском языке с "откатом" на русский, в случае если название на английском не задано.
#    Формат: ID фильма, Название.
(
	select movie_title.MOVIE_ID,
	       movie_title.TITLE
	from movie_title
	where LANGUAGE_ID='en')
union
(
	select movie_title.MOVIE_ID,
	       movie_title.TITLE
	from movie_title
	where movie_title.MOVIE_ID in (
		select movie_title.MOVIE_ID from movie_title
		where LANGUAGE_ID = 'ru'
	)
	  and movie_title.MOVIE_ID not in (
		select movie_title.MOVIE_ID from movie_title
		where LANGUAGE_ID = 'en'
	)
)
order by MOVIE_ID;

# 3. Вывести самый длительный фильм Джеймса Кэмерона*.
#  Формат: ID фильма, Название на русском языке, Длительность.
select movie_title.MOVIE_ID,
       movie_title.TITLE,
       movie.LENGTH
from movie_title
	     inner join movie
	                on movie_title.MOVIE_ID = movie.ID
	     inner join director
	                on movie.DIRECTOR_ID = director.ID
where movie_title.LANGUAGE_ID = 'ru'
order by movie.LENGTH
		desc
limit 1;

# 4. ** Вывести список фильмов с названием, сокращённым до 10 символов.
# Если название короче 10 символов – оставляем как есть.
# Если длиннее – сокращаем до 10 символов и добавляем многоточие.
(
	select
		movie_title.TITLE
	from movie_title
	where CHAR_LENGTH(movie_title.TITLE) < 10
)
union
(
	select
		concat(substr(movie_title.TITLE, 1, 10), '...')
	from movie_title
	where CHAR_LENGTH(movie_title.TITLE) > 10
);

# 5. Вывести количество фильмов, в которых снимался каждый актёр.
#    Формат: Имя актёра, Количество фильмов актёра.
select
	actor.NAME,
	count(movie_actor.MOVIE_ID) as 'count'
from movie_actor
	     inner join actor
	                on movie_actor.ACTOR_ID = actor.ID
group by movie_actor.ACTOR_ID;

# 6. Вывести жанры, в которых никогда не снимался Арнольд Шварценеггер*.
#   Формат: ID жанра, название
select
	genre.ID,
	genre.NAME
from genre
where genre.ID not in
      (select
	       distinct movie_genre.GENRE_ID
       from movie_genre
       where movie_genre.MOVIE_ID in
             (
	             select
		             distinct movie_actor.MOVIE_ID
	             from movie_actor
	             where movie_actor.ACTOR_ID in (1)
             )
      );

# 7. Вывести список фильмов, у которых больше 3-х жанров.
#   Формат: ID фильма, название на русском языке
select
	movie_genre.MOVIE_ID,
	movie_title.TITLE
from movie_genre
	     inner join movie_title
	                on movie_genre.MOVIE_ID = movie_title.MOVIE_ID
where LANGUAGE_ID = 'ru'
group by movie_genre.MOVIE_ID
having count(movie_genre.GENRE_ID)>3;

# 8. Вывести самый популярный жанр для каждого актёра.
#   Формат вывода: Имя актёра, Жанр, в котором у актёра больше всего фильмов.
select
	distinct movie_actor.ACTOR_ID as 'actor',
             (
	             select
		             genre.NAME
	             from movie_genre
		                  inner join movie_actor
		                             on movie_actor.MOVIE_ID = movie_genre.MOVIE_ID
		                  inner join genre on movie_genre.GENRE_ID = genre.ID
	             where movie_actor.ACTOR_ID = actor
	             group by movie_actor.ACTOR_ID, movie_genre.GENRE_ID
	             order by count(movie_genre.GENRE_ID)
			             desc
	             limit 1
             )
from movie_actor;