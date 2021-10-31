<?php
/** @var array $data */
require_once "../../data/data/data.php";

/** @var array $menu */
require_once "../../data/data/menu.php";
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="../css/reset.css">
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>

<div class="wrapper">
	<div class="sidebar">
		<div class="logo">
			<a href="jhfdhfgh.html">
				<img src="../../data/logos/logo.png">
			</a>
		</div>
		<ul class="menu">
			<?php foreach ($menu as $point): ?>
			<li class="menu-item">
				<a href="<?= $point["link"]?>"><?= $point["name"]?></a>
			</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="container">
		<div class="header">
			<div class="search">
				<div class="search-icon"></div>
				<input class="search-row" type="search" placeholder="Поиск по каталогу..."></input>
				<input class="search-button" type="button" value="ИСКАТЬ"></input>
				<input class="add-button" type="button" value="Добавить фильм"></input>
			</div>
			<div class="search-border"></div>
		</div>

		<div class="content">
			<div class="movie-list">
				<?php foreach ($data as $film) : ?>
				<div class="movie-list--item">
					<input class="button-learn-more" type="button" value="Подробнее"></input>
					<div class="movie-list--item-image" style="background-image: url(<?=$film["image"]?>)"></div>
					<div class="movie-list--item-head">
						<div class="movie-list--item-title"><?=$film["title"]?></div>
						<div class="movie-list--item-subtitle"><?=$film["subtitle"]?></div>
					</div>
					<div class="movie-list--item-description">
						<?=$film["description"]?>
					</div>
					<div class="movie-list--item-bottom">
						<div class="movie-list--item-time">
							<div class="movie-list--item-time--icon"></div>
							<?=$film["time"]?>
						</div>
						<div class="movie-list--item-info"><?=$film["info"]?></div>
					</div>
				</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</div>
</body>
</html>