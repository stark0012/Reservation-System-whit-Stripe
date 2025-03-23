<?php
$api = $_GET['api'];
$APIkey = "adshfdgdg75467834592*shdjf44f3";

if ($api == $APIkey) {
        
        require './../config/config.php';


        
        if ($mysqli_insert->connect_error) {
            die("Error de conexión: " . $mysqli_insert->connect_error);
        }

        
        $sql = "SELECT valor, texto, precio FROM servicios WHERE active = 1";

        $result = $mysqli_insert->query($sql);

        
        $servicios = array();

        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                $servicio = array(
                    'valor' => $row['valor'],
                    'texto' => $row['texto'],
                    'precio' => $row['precio']
                );
                $servicios[] = $servicio;
            }
        }

        
        header('Content-Type: application/json');
        echo json_encode($servicios);

        
        $mysqli_insert->close();
}
?>
