# 1
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

#2
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

#3
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

#4
(
	select
		movie_title.MOVIE_ID,
		movie_title.TITLE
	from movie_title
	where CHAR_LENGTH(movie_title.TITLE) < 10
)
union
(
	select
		movie_title.MOVIE_ID,
		concat(substr(movie_title.TITLE, 1, 10), '...')
	from movie_title
	where CHAR_LENGTH(movie_title.TITLE) > 10
)
order by MOVIE_ID;

#5
select
	actor.NAME,
	count(movie_actor.MOVIE_ID) as 'count'
from movie_actor
	     inner join actor
	                on movie_actor.ACTOR_ID = actor.ID
group by movie_actor.ACTOR_ID;

#6
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

#7
select movie_genre.MOVIE_ID,
       count(movie_genre.GENRE_ID) as 'count'
from movie_genre
group by movie_genre.MOVIE_ID
having count(movie_genre.GENRE_ID) > 3;

#8
select
	distinct movie_actor.ACTOR_ID as 'actor',
             (
	             select
		             movie_genre.GENRE_ID
	             from movie_genre
		                  inner join movie_actor
		                             on movie_actor.MOVIE_ID = movie_genre.MOVIE_ID
	             where movie_actor.ACTOR_ID = actor
	             group by movie_actor.ACTOR_ID, movie_genre.GENRE_ID
	             order by count(movie_genre.GENRE_ID)
			             desc
	             limit 1
             )
from movie_actor;