<?php
$access_token = 'onZk0lMu38UjCMFxwuNWG68FUhMol4e0/lFcFNuMHxNF5V0bzxwh+kBDRQ7KS8w3WqZwUileaIi8jOzD/zq2mBHgLCI/KrXAdejcb4ssr+0emsS/uqn9b1qxepRfsLEcdWDgefH/E/3uU/ryHMfN6gdB04t89/1O/w1cDnyilFU=';

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