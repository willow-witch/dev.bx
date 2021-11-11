<?php
declare(strict_types=1);
/** @var array $config */
/** @var array $movies */
/** @var array $genres */
/** @var array $menu */
/** @var string $currentPage */

require_once "./data/data/movies.php";
require_once "./config/app.php";
require_once "./lib/template-functions.php";
require_once "./lib/movies-functions.php";
require_once "./data/data/menu.php";

if (isset($_GET['genre']))
{
	$movies = getFilmsByGenre($_GET['genre'], $movies);
	$currentPage = $_GET['genre'];
}
else
{
	$currentPage = 'Главная';
}

// prepare page content
$filmListPage = renderTemplate("./resources/pages/films.php", [
	'movies' => $movies
]);

// render layout
renderLayout($filmListPage, [
	'config' => $config,
	'menu' => $menu,
	'genres' => $genres,
	'currentPage' => $currentPage
]);