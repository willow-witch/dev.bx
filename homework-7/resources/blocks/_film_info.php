<?php
/** @var array $film*/
?>

<div class="film-content-head">
	<div class="film-content-head--title" id="head-title">
		<?= $film['title']?>
	</div>
	<div class="film-content-head--title-age">
		<div class="film-content-head--original-title">
			<?= $film['original-title']?>
		</div>
		<div class="film-content-head--age">
			<?= $film['age-restriction'] . '+'?>
		</div>
	</div>
	<div class="film-content-head--like" id="like"></div>
	<div class="film-content-head--border"></div>
</div>
<div class="film-content-body">
	<div class="film-content-body--image" style="background-image: url(<?="./data/images/" . $film['id'] . ".jpg"?>)"></div>

	<div class="film-content-body--info">
		<div class="film-content-body--info-rating">
			<?php for ($i=1; $i <= 10; $i++): ?>
				<?php if ($i <= numberOfPointsInRating($film['rating'])): ?>
					<div class="film-content-body--info-rating-scale-active">
					</div>
				<?php else: ?>
					<div class="film-content-body--info-rating-scale">
					</div>
				<?php endif;?>
			<?php endfor;?>
			<div class="film-content-body--info-rating-rate">
				<?= $film['rating'] ?>
			</div>
		</div>
		<div class="film-content-body--info-about">
			<div class="film-content-body--info-about--header">
				О фильме
			</div>
			<ul class="film-content-body--info-about-list">
				<li class="film-content-body--info-about-list-item">
					<div class="film-content-body--info-about-list-item--point">
						Год производства:
					</div>
					<div class="film-content-body--info-about-list-item--value">
						<?= $film['release-date'] ?>
					</div>
				</li>
				<li class="film-content-body--info-about-list-item">
					<div class="film-content-body--info-about-list-item--point">
						Режиссер:
					</div>
					<div class="film-content-body--info-about-list-item--value">
						<?= $film['director'] ?>
					</div>
				</li>
				<li class="film-content-body--info-about-list-item">
					<div class="film-content-body--info-about-list-item--point">
						В главных ролях:
					</div>
					<div class="film-content-body--info-about-list-item--value">
						<?= $film['cast'] ?>
					</div>
				</li>
			</ul>
		</div>
		<div class="film-content-body--info-description">
			<div class="film-content-body--info-description--head">
				Описание
			</div>
			<div class="film-content-body--info-description--text">
				<?= $film['description'] ?>
			</div>
		</div>

	</div>

</div>
<div class="notify" id="notify"></div>

<script>

	var likeNode = document.getElementById('like');
	var notifyNode = document.getElementById('notify');
	var titleNode = document.getElementById('head-title');
	//
	var addText = ' добавлено в избранное';
	//
	likeNode.addEventListener('click', function()
	{
		if (!likeNode.classList.contains('film-content-head--like-active'))
		{
			likeNode.classList.add('film-content-head--like-active');
			notifyNode.classList.add('notify-show');
			notifyNode.innerText = titleNode.innerText + addText;
		}
		else
		{
			notifyNode.classList.add('notify-show');
			notifyNode.innerText = 'Уже в избраннном';
		}

		setTimeout(function()
		{
			notifyNode.classList.remove('notify-show');
		}, 4000);
	})

</script>
