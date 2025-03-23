<?php
header('Content-Type: application/json');

require './../config/config.php';

$apiKeyGet = $_GET['apiKey'];
$apiKey = "Fdsreedsfdg478574gdfhf46h8748h7gfh2dg2hdfgdfsg5";

if ($apiKeyGet !== $apiKey) {
    header('Location: /');
    exit();
}

if ($mysqli_insert->connect_error) {
    echo json_encode(['error' => 'Error de conexión a la base de datos']);
    exit();
}

$fecha = $_GET['date'] ?? '';
$servicio = $_GET['service'] ?? '';
$municipio = $_GET['municipio'] ?? '';

if (empty($fecha) || empty($servicio) || empty($municipio)) {
    echo json_encode(['error' => 'Falta un valor estrictamente requerido.']);
    exit();
}

$consultaInformacion = "SELECT * FROM servicios WHERE valor = '$servicio'";
$duedInformacion = mysqli_query($mysqli_insert, $consultaInformacion);
$Informacion = mysqli_fetch_array($duedInformacion);

$occupiedStatuses = ['paid'];

$startHour = $Informacion['horaApertura']; // Hora de inicio
$endHour = $Informacion['horaCierre']; // Hora de fin
$slotDuration = $Informacion['duracion'] * 60; // Duración del slot en minutos


$startMinute = $startHour * 60;
$endMinute = $endHour * 60;


$allSlots = [];
for ($time = $startMinute; $time + $slotDuration <= $endMinute; $time += $slotDuration) {
    $hour = floor($time / 60);
    $minute = $time % 60;
    $endHourSlot = floor(($time + $slotDuration) / 60);
    $endMinuteSlot = ($time + $slotDuration) % 60;

    
    if (($time + $slotDuration) <= $endMinute) {
        $slot = sprintf('%02d:%02d - %02d:%02d', $hour, $minute, $endHourSlot, $endMinuteSlot);
        $allSlots[] = $slot;
    }
}


$occupiedStatusesStr = "'" . implode("','", $occupiedStatuses) . "'";


$occupiedSlots = [];

$query = $mysqli_insert->prepare("SELECT time FROM citas WHERE date = ? AND service = ? AND municipio = ? AND status IN ($occupiedStatusesStr)");
$query->bind_param('sss', $fecha, $servicio, $municipio);
$query->execute();
$result = $query->get_result();

while ($row = $result->fetch_assoc()) {
    $occupiedSlots[] = $row['time'];
}


$availableSlots = array_diff($allSlots, $occupiedSlots);

if ($availableSlots == null) {
    $availableSlots = ["No hay espacio en la fecha seleccionada."];
}

echo json_encode(['availableTimes' => array_values($availableSlots)]);

$mysqli_insert->close();
?>