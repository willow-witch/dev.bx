<?php

$socket = fsockopen("test.shelenkov.com", 80, $errorCode, $errorString);
if (!$socket)
{
	echo "$errorCode ($errorString)<br />\n";
	die();
}
//http://test.shelenkov.com/up/get.php

$content = "--part" . "\r\n";
$content .= "Content-Disposition: form-data; name=\"field\"" . "\r\n";
$content .= "\r\n";
$content .= "value1". "\r\n";

$content .= "--part" . "\r\n";
$content .= "Content-Disposition: form-data; name=\"field\"" . "\r\n";
$content .= "\r\n";
$content .= "value2". "\r\n";

$content .= "--part--";

$result  = "POST /up/post.php HTTP/1.1" . "\r\n";
$result .= "Host: test.shelenkov.com" . "\r\n";
$result .= "Content-Type: application/x-www-form-urlencoded" . "\r\n";
$result .= "Content-Length: ".strlen($content) . "\r\n";
$result .= "Connection close" . "\r\n";
$result .= "\r\n";
$result .= $content;

fwrite($socket, $result);
while (!feof($socket))
{
	echo fgets($socket);
}
fclose($socket);









