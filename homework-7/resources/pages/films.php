<?php

/** @var array $movies */
?>

<div class="movie-list">
	<?php foreach ($movies as $film) : ?>
		<?= renderTemplate("./resources/blocks/_film_card.php", ['film' => $film]) ?>
	<?php endforeach; ?>
</div>