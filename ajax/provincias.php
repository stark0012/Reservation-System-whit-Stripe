<?php


$key = $_GET['key'];
$APIkey = "asdffdg3456rtgfdg5423*fdsf4";



if ($key == $APIkey) {
        
        require './../config/config.php';

        
        if ($mysqli_insert->connect_error) {
            die("Error de conexión: " . $mysqli_insert->connect_error);
        }

        
        $sql = "SELECT * FROM provincias";

        $result = $mysqli_insert->query($sql);

        
        $provincias = array();

        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                $provincias[] = $row;
            }
        }

        
        header('Content-Type: application/json');
        echo json_encode($provincias);

        
        $mysqli_insert->close();
}


?>