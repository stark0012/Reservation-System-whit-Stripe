<?php

require 'config/config.php';
require 'functions.php';


$clienteNombre = $_POST['cliente-nombre'];
$clienteEmail = $_POST['cliente-email'];
$clienteTelefono = $_POST['cliente-telefono'];
$beneficiarioNombre = $_POST['beneficiario-nombre'];
$beneficiarioDireccion = $_POST['beneficiario-direccion'];
$beneficiarioTelefono = $_POST['beneficiario-telefono'];
$provincia = $_POST['provincia'];
$municipio = $_POST['municipio'];
$beneficiarioDireccionFormated = $beneficiarioDireccion.", ".ucfirst($municipio).", ".ucfirst($provincia).", Cuba";
$service = $_POST['service'];
$price = $_POST['price'];
$date = date("d-m-Y", strtotime($_POST['date']));
$time = $_POST['time'];
$message = (empty($_POST['message'])) ? "No hay mensaje adicional." : $_POST['message'];
$remember = (empty($_POST['remember']) ? "off" : "on");
$boletin = (empty($_POST['boletin']) ? "off" : "on");


if (!isset($clienteNombre) || !isset($clienteEmail) || !isset($clienteTelefono) || !isset($beneficiarioNombre) || !isset($beneficiarioDireccion) || !isset($beneficiarioTelefono) || !isset($provincia) || !isset($municipio) || !isset($price)) {
    header('Location: index.php');
    die();
}

$consultPrecio = "SELECT * FROM servicios WHERE valor = '$service'";
$PrecioDued = mysqli_query($mysqli_insert, $consultPrecio);
$PrecioArray = mysqli_fetch_array($PrecioDued);

$PrecioServicio = $PrecioArray["precio"];
$ServicioNombre = $PrecioArray['texto'];

if ($price != $PrecioServicio) {
    header('Location: index.php');
    die();
}

$PrecioServicioFormated = "$".$PrecioServicio." USD";



if ($boletin == 'on') {
    boletin($clienteNombre, $clienteEmail, $mysqli_insert);
}

if ($remember == 'on') {
    rememberMe($clienteNombre, $clienteEmail, $clienteTelefono, $beneficiarioNombre, $beneficiarioDireccion, $beneficiarioTelefono, $provincia, $municipio, $mysqli_insert);
}


?>




<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resumen de Pago</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/pay.css?timestamp=<?php echo time();?>">
    <script defer src="js/pay.js?timestamp=<?php echo time();?>"></script>
</head>
<body>
    <header>
        <div class="logo">
            <a href="https://cubahomeservices.com/"><img src="image/Logo.png" alt="Logo Cuba Home Services"></a>
        </div>
        <nav class="nav" id="nav">
            <ul>
                <li><a href="https://cubahomeservices.com/">Inicio</a></li>
                <li><a href="https://cubahomeservices.com/services-es/">Servicios</a></li>
                <li><a href="https://cubahomeservices.com/contact-es/">Contacto</a></li>
            </ul>
            <button id="close-menu" class="close-menu">&times;</button>
        </nav>
        <div class="menu-toggle" id="menu-toggle">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </header>
    <a href="https://cubahomeservices.com/how-does-it-work-es/" target="_blank" class="floating-button">¿Cómo funciona?</a>
    <a href="https://cubahomeservices.com/how-does-it-work-es/" target="_blank" class="mobile-button">?</a>
    <div class="container">
        <h2>Resumen de Pago</h2>
        <div class="form-group">
            <label>Nombre Completo del Cliente:</label>
            <p><?php echo htmlspecialchars($_POST['cliente-nombre']); ?></p>
        </div>
        <div class="form-group">
            <label>Correo Electrónico del Cliente:</label>
            <p><?php echo htmlspecialchars($_POST['cliente-email']); ?></p>
        </div>
        <div class="form-group">
            <label>Número de Teléfono del Cliente:</label>
            <p><?php echo htmlspecialchars($_POST['cliente-telefono']); ?></p>
        </div>
        <div class="form-group">
            <label>Nombre Completo del Beneficiario:</label>
            <p><?php echo htmlspecialchars($_POST['beneficiario-nombre']); ?></p>
        </div>
        <div class="form-group">
            <label>Dirección del Beneficiario:</label>
            <p><?php echo htmlspecialchars($beneficiarioDireccionFormated); ?></p>
        </div>
        <div class="form-group">
            <label>Número de Teléfono del Beneficiario:</label>
            <p><?php echo htmlspecialchars($_POST['beneficiario-telefono']); ?></p>
        </div>
        <div class="form-group">
            <label>Servicio:</label>
            <p><?php echo ucfirst(htmlspecialchars($_POST['service'])); ?></p>
        </div>
        <div class="form-group">
            <label>Total:</label>
            <p><?php echo ucfirst(htmlspecialchars($PrecioServicioFormated)); ?></p>
        </div>
        <div class="form-group">
            <label>Fecha:</label>
            <p><?php echo htmlspecialchars(formatearFecha($date)); ?></p>
        </div>
        <div class="form-group">
            <label>Hora:</label>
            <p><?php echo htmlspecialchars($_POST['time']); ?></p>
        </div>
        <div class="form-group">
            <label>Mensaje Adicional:</label>
            <p><?php echo htmlspecialchars($message); ?></p>
        </div>
        <button class="boton-atras" id="payButton" onclick="back()">Atrás</button>
        <form id="payForm" class="display: hidden;" method="POST" action="process-reservation.php">
            <input type="text" name="clienteNombre" value="<?php echo $clienteNombre;?>" required readonly hidden>
            <input type="text" name="clienteEmail" value="<?php echo $clienteEmail;?>" required readonly hidden>
            <input type="text" name="clienteTelefono" value="<?php echo $clienteTelefono;?>" required readonly hidden>
            <input type="text" name="beneficiarioNombre" value="<?php echo $beneficiarioNombre;?>" required readonly hidden>
            <input type="text" name="beneficiarioDireccion" value="<?php echo $beneficiarioDireccion;?>" required readonly hidden>
            <input type="text" name="beneficiarioTelefono" value="<?php echo $beneficiarioTelefono;?>" required readonly hidden>
            <input type="text" name="provincia" value="<?php echo $provincia;?>" required readonly hidden>
            <input type="text" name="municipio" value="<?php echo $municipio;?>" required readonly hidden>
            <input type="text" name="service" value="<?php echo $service;?>" required readonly hidden>
            <input type="text" name="price" value="<?php echo $price;?>" required readonly hidden>
            <input type="text" name="date" value="<?php echo $date;?>" required readonly hidden>
            <input type="text" name="time" value="<?php echo $time;?>" required readonly hidden>
            <input type="text" name="message" value="<?php echo $message;?>" required readonly hidden>
            <input type="text" name="ServicioNombre" value="<?php echo $ServicioNombre;?>" required readonly hidden>
        <button class="boton-pagar" id="payButton" type="submit">Realizar Pago</button>
        </form>
    </div>
</body>
</html>