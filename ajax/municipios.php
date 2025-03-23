<?php

$api = $_GET['api'];
$APIkey = "dashgfdsg546789234**adf8";

if ($api == $APIkey) {

require './../config/config.php';


if ($mysqli_insert->connect_error) {
    die("Error de conexión: " . $mysqli_insert->connect_error);
}


$provinciaSeleccionada = $_GET["provincia"];


$sql = "SELECT municipio FROM municipios WHERE provincia = '" . $provinciaSeleccionada . "'";

$result = $mysqli_insert->query($sql);


$municipios = array();

if ($result->num_rows > 0) {
    
    while($row = $result->fetch_assoc()) {
        $municipios[] = $row;
    }
}


header('Content-Type: application/json');
echo json_encode($municipios);


$mysqli_insert->close();
}
?>