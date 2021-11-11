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

// prepare page content
$filmListPage = renderTemplate("./resources/pages/add_film.php", [

]);

// render layout
renderLayout($filmListPage, [
	'config' => $config,
	'menu' => $menu,
	'genres' => $genres
]);