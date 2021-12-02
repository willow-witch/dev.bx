<?php

function durationInHours(int $durationInMinutes): string
{
	$time = (int) $durationInMinutes;
	$hours = intdiv($time, 60);
	$minutes = $time % 60;

	if ($hours < 10 && $minutes < 10)
	{
		return "0" . $hours . ":0" . $minutes;
	}
	elseif ($hours < 10 && $minutes > 10)
	{
		return "0" . $hours . ":" . $minutes;
	}
	elseif ($hours > 10 && $minutes < 10)
	{
		return $hours . ":0" . $minutes;
	}
	else
	{
		return $hours . ":" . $minutes;
	}
}

function cutMovieDescription(string $movieDescription, int $movieTitleLength, int $symbolsQuantity = 175) : string
{
	if ($movieTitleLength < 24)
	{
		$newDescription = mb_substr($movieDescription, 0, $symbolsQuantity);
	}
	else
	{
		$newDescription = mb_substr($movieDescription, 0, $symbolsQuantity - 80);
	}
	$newDescription = substr($newDescription, 0,
							 strrpos($newDescription, ' ') + 1);
	$newDescription .= "...";
	return $newDescription;
}

function cutMovieGenres(string $movieGenres, int $symbolsQuantity = 31) : string
{
	if (strlen($movieGenres) < $symbolsQuantity)
	{
		return $movieGenres;
	}
	else
	{
		$newGenres = mb_substr($movieGenres, 0, $symbolsQuantity);
		$newGenres = substr($newGenres, 0, strrpos($newGenres, ','));
		return $newGenres;
	}
}

function getGenreRus(string $genreEng, array $genres) : string
{
	foreach($genres as $key=>['CODE' => $code, 'NAME' => $name])
	{
		if ($code===$genreEng)
		{
			return $name;
		}
	}
	return '';
}

function getFilmById(int $filmId, array $movies) : array
{
	foreach ($movies as $movie)
	{
		if ((int)$movie['id'] === $filmId)
		{
			return $movie;
		}
	}
	return [];
}

function getGenresFromDB(mysqli $db) : array
{
	$query = 'select ID, CODE, NAME from genre order by genre.ID';

	$result = mysqli_query($db, $query);

	if (!$result)
	{
		trigger_error(mysqli_error($db), E_USER_ERROR);
	}

	$genres = [];

	while($genre = mysqli_fetch_assoc($result))
	{
		$genres[] = $genre;
	}

	return $genres;
}

function getMoviesFromBD(mysqli $db, string $selectedGenre = '') : array
{
	$query = "select movie.ID as 'id',
       TITLE as 'title',
       ORIGINAL_TITLE as 'original-title', DESCRIPTION as 'description',
       DURATION as 'duration', AGE_RESTRICTION as 'age-restriction',
       RELEASE_DATE as 'release-date', RATING as 'rating',
       (select if (group_concat(genre.NAME) like '%{$selectedGenre}%', group_concat(genre.NAME), null)
        from genre
        where genre.ID in (
	        select distinct GENRE_ID
	        from movie_genre
	        where MOVIE_ID = movie.ID
        )
       ) as 'genres',
       (select group_concat(actor.NAME) from movie_actor
	                                             left join actor on movie_actor.ACTOR_ID = actor.ID
        where movie_actor.MOVIE_ID = movie.ID) as 'cast',
       director.NAME as 'director'
		from movie left join director on director.ID = movie.DIRECTOR_ID
		having genres is not null
				";

	$result = mysqli_query($db, $query);

	if (!$result)
	{
		trigger_error(mysqli_error($db), E_USER_ERROR);
	}

	$films = [];

	while($film = mysqli_fetch_assoc($result))
	{
		$films[] = $film;
	}

	return $films;
}