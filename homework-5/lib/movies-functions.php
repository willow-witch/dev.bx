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

function movieListToString(array $movies) : string
{
	return implode(', ', $movies);
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
							 strripos($newDescription, ' ') + 1);
	$newDescription .= "...";
	return $newDescription;
}

function cutMovieGenres(string $movieGenres, int $symbolsQuantity = 31) : string
{
	$newGenres = mb_substr($movieGenres, 0, $symbolsQuantity);
	$newGenres = substr($newGenres, 0,
							 strripos($newGenres, ','));

	return $newGenres;
}

function getFilmsByGenre(string $genre, array $movies) : array
{
	$result = [];

	foreach ($movies as $movie)
	{
		if(in_array($genre, $movie['genres']))
		{
			$result[] = $movie;
		}
	}

	return $result;
}