<?php
declare(strict_types=1);
/** @var array $config */
/** @var array $movies */
/** @var array $genres */
/** @var array $menu */
/** @var string $currentPage */

require_once "./config/app.php";
require_once "./lib/template-functions.php";
require_once "./lib/movies-functions.php";
require_once "./data/data/menu.php";
require_once "./lib/db_connection.php";

$db = dbConnect(
	$config['host'],
	$config['username'],
	$config['password'],
	$config['db'],
);

$genres = getGenresFromDB(
	$db
);

if (isset($_GET['currentPage']) && $currentPage != 'Главная')
{
	$currentPage = $_GET['currentPage'];
	$movies = getMoviesFromBD($db, getGenreRus($currentPage, $genres));
}
else
{
	$movies = getMoviesFromBD($db, '');
	$currentPage = 'index';
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