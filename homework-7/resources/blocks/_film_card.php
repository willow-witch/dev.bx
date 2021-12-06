<?php
/** @var array $film */

?>

<div class="movie-list--item">
	<div class="movie-list--item-overlay">
		<a href="./film.php?film_id=<?=$film['id']?>" class="movie-list--item-more">
			Подробнее
		</a>
	</div>
	<div class="movie-list--item-image" style="background-image: url(<?="./data/images/" . $film['id'] . ".jpg"?>)"></div>
	<div class="movie-list--item-head">
		<div class="movie-list--item-title"><?=$film["title"]?></div>
		<div class="movie-list--item-subtitle"><?=$film["original-title"]?></div>
	</div>
	<div class="movie-list--item-description">
		<?=cutMovieDescription($film['description'], mb_strlen($film['title']))?>
	</div>
	<div class="movie-list--item-bottom">
		<div class="movie-list--item-time">
			<div class="movie-list--item-time--icon"></div>
			<?=$film['duration'] . " мин. / " . durationInHours($film['duration'])?>
		</div>
		<div class="movie-list--item-info"><?=cutMovieGenres($film['genres'])?></div>
	</div>
</div>