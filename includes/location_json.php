<?php

$server = $_SERVER['REMOTE_ADDR'];
$rrs = file_get_contents("http://api.sypexgeo.net/json/".$server);
$obj = json_decode($rrs);
$country = $obj->country->name_ru;

?>