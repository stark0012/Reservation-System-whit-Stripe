<?php
require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require 'config/config.php';

    \Stripe\Stripe::setApiKey('sk_test_51J0ZQvJ9Q7Z');

    $clienteNombre = $_POST['clienteNombre'];
    $clienteEmail = $_POST['clienteEmail'];
    $clienteTelefono = $_POST['clienteTelefono'];
    $beneficiarioNombre = $_POST['beneficiarioNombre'];
    $beneficiarioDireccion = $_POST['beneficiarioDireccion'];
    $beneficiarioTelefono = $_POST['beneficiarioTelefono'];
    $provincia = $_POST['provincia'];
    $municipio = $_POST['municipio'];
    $service = $_POST['service'];
    $price = $_POST['price'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $message = $_POST['message'];
    $txn_id = uniqid() . rand(1000, 99999);
    $status = "pendiente";
    $dateCrated = date('d-m-Y');
    $ServicioNombre = $_POST['ServicioNombre'];

    
    $subscriptionConsult = "SELECT * FROM servicios WHERE valor = '$service'";
    $subscriptionQuery = mysqli_query($mysqli_insert, $subscriptionConsult);
    $subscriptionArray = mysqli_fetch_array($subscriptionQuery);

    $subscription = $subscriptionArray['subscription'];
    $priceDatabase = $subscriptionArray['precio'];

    if ($price != $priceDatabase) {
        header('Location: /');
        die();
    }

    
    $query = "INSERT INTO citas (txn_id, status, clienteNombre, clienteEmail, clienteTelefono, beneficiarioNombre, beneficiarioDireccion, beneficiarioTelefono, provincia, municipio, service, subscription, price, date, time, message, dateCrated) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli_insert->prepare($query);

    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($mysqli_insert->error));
    }

    
    $stmt->bind_param(
        'sssssssssssssssss', 
        $txn_id,
        $status, 
        $clienteNombre,
        $clienteEmail,
        $clienteTelefono,
        $beneficiarioNombre,
        $beneficiarioDireccion,
        $beneficiarioTelefono,
        $provincia,
        $municipio,
        $service,
        $subscription,
        $price,
        $date,
        $time,
        $message,
        $dateCrated
    );

    
    $stmt->execute();

    if ($stmt->error) {
        die('Execute failed: ' . htmlspecialchars($stmt->error));
    }

    $stmt->close();

    try {
        $existingCustomers = \Stripe\Customer::all([
            'email' => $clienteEmail,
            'limit' => 1,
        ]);

        if (count($existingCustomers->data) > 0) {
            $customer = $existingCustomers->data[0];
        } else {
            $customer = \Stripe\Customer::create([
                'name' => $clienteNombre,
                'email' => $clienteEmail,
                'phone' => $clienteTelefono,
                'metadata' => [
                    'beneficiarioNombre' => $beneficiarioNombre,
                    'beneficiarioDireccion' => $beneficiarioDireccion,
                    'beneficiarioTelefono' => $beneficiarioTelefono,
                    'provincia' => $provincia,
                    'municipio' => $municipio,
                    'service' => $service,
                    'price' => $price,
                    'date' => $date,
                    'time' => $time,
                    'message' => $message,
                    'txn_id' => $txn_id,
                    'ServicioNombre' => $ServicioNombre,
                ],
            ]);
        }

        if ($subscription === '1') {
            $session = \Stripe\Checkout\Session::create([
                'customer' => $customer->id,
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $ServicioNombre . ' en CubaHomeServices.com',
                        ],
                        'recurring' => [
                            'interval' => 'month',
                        ],
                        'unit_amount' => $price * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'subscription',
                'success_url' => 'https://cubahomeservices.com/confirm-payment?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'https://cubahomeservices.com/cancel-payment?session_id={CHECKOUT_SESSION_ID}',
                'metadata' => [
                    'txn_id' => $txn_id,
                    'email' => $clienteEmail,
                    'name' => $clienteNombre,
                ],
            ]);
        } else {
            $session = \Stripe\Checkout\Session::create([
                'customer' => $customer->id,
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => $ServicioNombre . ' en CubaHomeServices.com',
                        ],
                        'unit_amount' => $price * 100,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => 'https://cubahomeservices.com/confirm-payment?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => 'https://cubahomeservices.com/cancel-payment?session_id={CHECKOUT_SESSION_ID}',
                'metadata' => [
                    'txn_id' => $txn_id,
                    'email' => $clienteEmail,
                    'name' => $clienteNombre,
                ],
            ]);
        }

        header('Location: ' . $session->url, true, 303);
        exit();
    } catch (Exception $e) {
        echo 'Error creando sesión de pago: ' . $e->getMessage();
    }
} else {
    header('Location: https://cubahomeservices.com/');
    exit();
}
?>