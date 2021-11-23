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
require_once "./lib/film-page-functions.php";
require_once "./data/data/menu.php";

$filmId = (int)$_GET['film_id'];

unset($_GET['currentPage']);

// prepare page content
$filmListPage = renderTemplate("./resources/pages/film_full_info.php", [
	'film' => getFilmById($filmId, $movies)
]);

// render layout
renderLayout($filmListPage, [
	'config' => $config,
	'menu' => $menu,
	'genres' => $genres
]);