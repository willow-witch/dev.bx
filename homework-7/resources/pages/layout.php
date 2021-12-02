<?php

/** @var array $genres */
/** @var array $menu */
/** @var array $content */
/** @var string $currentPage */

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<link rel="stylesheet" href="./resources/css/reset.css">
	<link rel="stylesheet" href="./resources/css/style.css">
</head>
<body>
<div class="wrapper">
	<div class="sidebar">
		<div class="logo">
			<a href="./index.php">
				<img src="./data/logos/logo.png">
			</a>
		</div>
		<ul class="menu">
			<?php foreach($menu as $point): ?>
				<?php if ($currentPage === $point['name']): ?>
					<li class="menu-item--active">
						<a href="<?=$point['link']?>?currentPage=<?=$point['name']?>"><?=$point['view']?></a>
					</li>
				<?php else: ?>
					<li class="menu-item">
						<a href="<?=$point['link']?>?currentPage=<?=$point['name']?>"><?=$point['view']?></a>
					</li>
				<?php endif;?>
			<?php endforeach; ?>

			<?php foreach($genres as $key=>['CODE' => $code, 'NAME' => $name]): ?>
				<?php if ($currentPage === $code): ?>
					<li class="menu-item--active">
						<a href="./index.php?currentPage=<?=$code?>"> <?= $name?> </a>
					</li>
				<?php else: ?>
					<li class="menu-item">
						<a href="./index.php?currentPage=<?=$code?>"> <?= $name?> </a>
					</li>
				<?php endif;?>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="container">
		<div class="header">
			<div class="search">
				<div class="search-icon"></div>
				<input class="search-row" type="search" placeholder="Поиск по каталогу..."></input>
				<input class="search-button" type="button" value="ИСКАТЬ"></input>
				<a class="add-link" href="add_film.php">Добавить фильм</a>
			</div>
			<div class="search-border"></div>
		</div>

		<div class="content">
			<?= $content ?>
		</div>
	</div>
</div>
</body>
</html>