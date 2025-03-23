<?php


if (!isset($_GET['key']) || $_GET['key'] !== '749598020d6fc55ce6d99a36c0534e15') {
    die("Acceso denegado.");
}




require 'config/config.php';



$yesterday = date('d-m-Y', strtotime('-1 day'));


$sql = "SELECT clienteNombre, clienteEmail, beneficiarioDireccion, service, price, date, time FROM citas WHERE status = 'paid' AND date = '$yesterday'";

$result = $mysqli_insert->query($sql);


if ($result->num_rows > 0) {
    
    while ($row = $result->fetch_assoc()) {
        $clienteEmail = $row['clienteEmail'];
        $name = $row['clienteNombre'];
        $date = $row['date'];
        $time = $row['time'];
        $beneficiarioDireccion = $row['beneficiarioDireccion'];
        $service = $row['service'];
        $price = $row['price'];
        
        
        $to = $clienteEmail;
        
        $subject = "Por favor, valora nuestro servicio.";

        
	    
	    $from = "CubaHomeServices <contact@cubahomeservices.com>";
	    
	    $headers = "MIME-Version: 1.0" . "\r\n";
	    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	    $headers .= 'From: ' .$from. '' . "\r\n";


        
        $message = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Seguimiento de Servicio</title>
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
                    background: #007bff;
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
                    <h1>Seguimiento de Servicio</h1>
                    <p>Estimado/a '.$name.',</p>
                    <p>Esperamos que haya quedado satisfecho con nuestro servicio. Nos encantaría conocer su opinión.</p>
                    <p>Por favor, tómese un momento para escribirnos sobre su experiencia con nuestro servicio:</p>
                    <a href="https://cubahomeservices.com/contact-es/" class="button-alert">Valora nuestro servicio</a>
                    <p>Gracias por confiar en nosotros.</p>
                    <p>Atentamente,</p>
                    <p>El equipo de Cuba Home Services</p>
                </div>
            </center>
        </body>
        </html>
        ';

        
        mail($to, '=?UTF-8?B?'.base64_encode($subject).'?=', $message, $headers);
    }
} else {
    echo "No hay reservas para enviar correos.";
}


$mysqli_insert->close();
?>