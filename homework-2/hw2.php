<?php

/** @var array $movies */
require "movies (1).php";

$userAge = readline("Input your age: \n");
if (is_numeric($userAge))
{
	getAvailableMovies($movies, (int) $userAge);
}

function getAvailableMovies(array $movies, int $age)
{
	$i = 0;
	foreach ($movies as $movie)
	{
		if($movie['age_restriction'] <= $age){
			$i++;
			printMovie($movie, $i);
		}
	}
}

function printMovie(array $movie, int $i)
{
	echo $i . ". ";
	echo $movie['title'] . ' (' . $movie['release_year'] . '), ';
	echo $movie['age_restriction'] . '+. ';
	echo 'Rating - ' . $movie['rating'];
	echo "\n";
}
?>