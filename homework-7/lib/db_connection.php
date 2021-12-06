<?php

// 1) На входе она принимает массив с настройками подключения (хост, имя пользователя и тд)
// 2) Создает ресурс mysqli для работы с базой (mysqli_init)
// 3) Выполняет попытку подключения к базе с нужными параметрами (mysqli_real_connect)
// 4) Если подключение не удалось - выкидывает возникшую ошибку с помощью trigger_error
// 5) Устанавливает кодировку UTF-8 для работы с базой (mysqli_set_charset)
// 6) Если установка кодировка не удалась - выкидывает возникшую ошибку с помощью trigger_error
// 7) Возвращает ресурс для работы с базой (который был создан в первом пункте)

function dbConnect(string $host, string $username, string $password, string $dbName) : mysqli
{
	$database = mysqli_init();
	$connection = mysqli_real_connect($database, $host, $username, $password, $dbName);
	if(!$connection)
	{
		$error = mysqli_connect_errno() . ": ". mysqli_connect_error();
		trigger_error($error, E_USER_ERROR);
	}

	$result = mysqli_set_charset($database, 'utf8');
	if(!$result)
	{
		trigger_error(mysqli_error($database), E_USER_ERROR);
	}

	return $database;
}
