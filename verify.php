<?php
$access_token = 'ZZBpFxnTKtJQtRFjwwuHm+fFqRPk8Vw+bvFh6HtfsaNNkpc4F3+yRUPqFMUEgyaoWpbjQcvJ9+OXQSu89T5hpc5/Gqqmivcwv7LUip9smTviGg6vwZjT+KomW0QuJ4wZsJ3hqXsoDz9iYD4UxBnidQdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
?>