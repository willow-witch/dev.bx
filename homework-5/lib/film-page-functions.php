<?php

function numberOfPointsInRating(int $rating) : string
{
	return round($rating);
}

function castListToString(array $cast) : string
{
	return implode(', ', $cast);
}

