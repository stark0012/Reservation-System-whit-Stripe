<?php
$apiKEY = "asfji657893248dsf**dsfdsf*asd";
$api = $_GET['api'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['service']) && hash_equals($apiKEY, $api)) {

    require './../config/config.php';

    $servicio = $_GET['service'];
    
    if ($stmt = $mysqli_insert->prepare("SELECT mensaje FROM servicios WHERE valor = ?")) {
        $stmt->bind_param("s", $servicio);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $message = $row['mensaje'];
            echo json_encode(['message' => $message]);
        } else {
            echo json_encode(['message' => '']);
        }


        $stmt->close();
    } else {
        echo json_encode(['message' => 'Error en la consulta']);
    }

    $mysqli_insert->close();
    exit;
} else {
    echo json_encode(['message' => 'Solicitud no válida o clave API incorrecta']);
    exit;
}
?>