<?php
$host = "";
$user = "";
$password = "";
$bd = "";


date_default_timezone_set('America/Havana');


$mysqli_insert = mysqli_connect($host, $user, $password, $bd);
mysqli_set_charset($mysqli_insert, "utf8");




?>