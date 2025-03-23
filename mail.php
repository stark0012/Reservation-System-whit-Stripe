<?php

function enviarCorreo($correo, $txn_id, $name) {

    $from = "CubaHomeServices <contact@cubahomeservices.com>";

    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
    $headers .= 'From: ' .$from. '' . "\r\n";

    if ($correo == "paymentRecived") {
        require 'config/config.php';


        $consultData = "SELECT * FROM citas WHERE txn_id = '$txn_id'";
        $consultDued = mysqli_query($mysqli_insert, $consultData);
        $consultArray = mysqli_fetch_array($consultDued);

        $clienteNombre = $consultArray['clienteNombre'];
        $clienteEmail = $consultArray['clienteEmail'];
        $clienteTelefono = $consultArray['clienteTelefono'];
        $beneficiarioNombre = $consultArray['beneficiarioNombre'];
        $beneficiarioDireccion = $consultArray['beneficiarioDireccion'];
        $beneficiarioTelefono = $consultArray['beneficiarioTelefono'];
        $provincia = $consultArray['provincia'];
        $municipio = $consultArray['municipio'];
        $service = $consultArray['service'];
        $price = $consultArray['price'];
        $date = $consultArray['date'];
        $time = $consultArray['time'];

        $consultService = "SELECT * FROM servicios WHERE valor = '$service'";
        $duedService = mysqli_query($mysqli_insert, $consultService);
        $arrayService = mysqli_fetch_array($duedService);
        $service = $arrayService['texto'];

        require 'functions.php';

        $date = formatearFecha($date);
        $time = $time;
        

        
        $to = $clienteEmail;
        
        $subject = "Pago recibido e información de su reserva.";

        
        $message = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Confirmación de Pago</title>
            <style>
                body {
                    font-family: \'Poppins\', sans-serif;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }
                .container {
                    font-family: \'Poppins\', sans-serif;
                    border: 1px solid #ddd;
                    background: #007bff; /* Cambia #f5f5f5 por el color deseado */
                    border-radius: 19px;
                    box-shadow: 0px 0px 15px 3px rgba(0, 0, 0, 0.5);
                    width: 100%;
                    max-width: 90%;
                    margin-top: 10%;
                    margin-bottom: 6%;
                    padding: 20px;
                }
                h1 {
                    font-family: \'Poppins\', sans-serif;
                    text-align: center;
                    margin-bottom: 3%;
                }
                p {
                    font-family: \'Poppins\', sans-serif;
                }
                .info {
                    background: transparent;
                    border-radius: 10px;
                    padding: 10px;
                    margin-top: 10px;
                }
                .info p {
                    margin: 5px 0;
                }
                .button-alert {
                    background-color: #B35DBD;
                    color: white;
                    padding: 10px 20px;
                    text-decoration: none;
                    border-radius: 4px;
                    display: inline-block;
                    margin-top: 20px;
                }
                .button-alert:hover {
                    background-color: #884791;
                }
            </style>
        </head>
        <body>
            <center>
                <div class="container">
                    <h1>Confirmación de Pago</h1>
                    <p>Estimado/a '.$name.',</p>
                    <p>Nos complace informarle que hemos recibido su pago con éxito. A continuación, encontrará los detalles de su reserva:</p>
                    <div class="info">
                        <p><strong>Fecha de la Reserva:</strong> '.$date.'</p>
                        <p><strong>Hora:</strong> '.$time.'</p>
                        <p><strong>Dirección:</strong> '.$beneficiarioDireccion.'</p>
                        <p><strong>Servicio:</strong> '.$service.'</p>
                        <p><strong>Total:</strong> $'.$price.' USD</p>
                    </div>
                    <p>Si tiene alguna pregunta o necesita reprogramar, no dude en ponerse en contacto con nosotros respondiendo a este correo.</p>
                    <p>Gracias por confiar en nuestros servicios.</p>
                    <p>Atentamente,</p>
                    <p>El equipo de Cuba Home Services</p>
                    <a href="https://cubahomeservices.com/" class="button-alert">Visita nuestra página web</a>
                </div>
            </center>
        </body>
        </html>
        ';

        mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $headers);

        $to = "contact@cubahomeservices.com";
        $subject = "Nueva reserva recibida y pagada.";
        $message = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Nueva Reserva</title>
            <style>
                body {
                    font-family: \'Poppins\', sans-serif;
                    margin: 0;
                    padding: 0;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                }
                .container {
                    font-family: \'Poppins\', sans-serif;
                    border: 1px solid #ddd;
                    background: #007bff; /* Cambia #f5f5f5 por el color deseado */
                    border-radius: 19px;
                    box-shadow: 0px 0px 15px 3px rgba(0, 0, 0, 0.5);
                    width: 100%;
                    max-width: 90%;
                    margin-top: 10%;
                    margin-bottom: 6%;
                    padding: 20px;
                }
                h1 {
                    font-family: \'Poppins\', sans-serif;
                    text-align: center;
                    margin-bottom: 3%;
                }
                p {
                    font-family: \'Poppins\', sans-serif;
                }
                .info {
                    background: transparent;
                    border-radius: 10px;
                    padding: 10px;
                    margin-top: 10px;
                }
                .info p {
                    margin: 5px 0;
                }
            </style>
        </head>
        <body>
            <center>
                <div class="container">
                    <h1>Nueva reserva procesada</h1>
                    <p>Los detalles de la misma son:</p>
                    <div class="info">
                        <p><strong>ID de factura:</strong> '.$txn_id.'</p>
                        <p><strong>Nombre del Cliente:</strong> '.$clienteNombre.'</p>
                        <p><strong>Email del Cliente:</strong> '.$clienteEmail.'</p>
                        <p><strong>Teléfono del Cliente:</strong> '.$clienteTelefono.'</p>
                        <p><strong>Nombre del Beneficiario:</strong> '.$beneficiarioNombre.'</p>
                        <p><strong>Dirección del Beneficiario:</strong> '.$beneficiarioDireccion.'</p>
                        <p><strong>Teléfono del Beneficiario:</strong> '.$beneficiarioTelefono.'</p>
                        <p><strong>Provincia:</strong> '.$provincia.'</p>
                        <p><strong>Municipio:</strong> '.$municipio.'</p>
                        <p><strong>Servicio:</strong> '.$service.'</p>
                        <p><strong>Precio:</strong> $'.$price.' USD</p>
                        <p><strong>Fecha:</strong> '.$date.'</p>
                        <p><strong>Hora:</strong> '.$time.'</p>
                    </div>
                    <p>Si necesita comunicarse con el cliente, puede hacerlo al número de teléfono o al correo <a href="mailto:'.$clienteEmail.'">'.$clienteEmail.'</a></p>
                </div>
            </center>
        </body>
        </html>
        ';

        mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $headers);
    }
}

?>