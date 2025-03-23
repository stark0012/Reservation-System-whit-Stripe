<?php
require 'vendor/autoload.php';
require 'config/config.php';
require 'mail.php';

$endpoint_secret = 'whsec_...';


function addLinesToFile($newLines) {
    
    if (!is_array($newLines)) {
        $newLines = [$newLines];
    }


    $file = fopen('mail_log.txt', 'a');

        
        foreach ($newLines as $line) {
            fwrite($file, $line . PHP_EOL);
        }
        
        fclose($file);

}

$payload = @file_get_contents('php://input');
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
$event = null;

try {
    $event = \Stripe\Webhook::constructEvent(
        $payload, $sig_header, $endpoint_secret
    );
} catch (\UnexpectedValueException $e) {
    http_response_code(400);
    addLinesToFile("UnexpectedValueException:");
    exit();
} catch (\Stripe\Exception\SignatureVerificationException $e) {
    http_response_code(400);
    addLinesToFile("SignatureVerificationException:");
    exit();
}

if ($event->type == 'checkout.session.completed') {
    $session = $event->data->object;

    $status = "paid"; 
    $txn_id = $session['metadata']['txn_id']; 
    $email = $session->customer_email;
    $name = $session->customer_details->name;
    $payment_total = $session->amount_total / 100; 

    
    $sql = "UPDATE citas SET status = ? WHERE txn_id = ?";

    $stmt = $mysqli_insert->prepare($sql);

    if ($stmt === false) {
        addLinesToFile("Prepare failed:");
        die();
    }


    $stmt->bind_param('ss', $status, $txn_id);

    
    if ($stmt->execute()) {
        addLinesToFile("Registro actualizado correctamente. $txn_id");
    } else {
        addLinesToFile("Error actualizando registro: ");
    }

    addLinesToFile("Received session completed event.");

    $correo = "paymentRecived";

    enviarCorreo($correo, $txn_id, $name);

    addLinesToFile("Confirmation email sent to");

}

http_response_code(200);
addLinesToFile("Webhook processed successfully");
?>