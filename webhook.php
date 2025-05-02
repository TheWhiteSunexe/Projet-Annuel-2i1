<?php
// require 'vendor/autoload.php';

// \Stripe\Stripe::setApiKey('

// $endpoint_secret = ' ';

// $payload = @file_get_contents('php://input');
// $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];

// try {
//     $event = \Stripe\Webhook::constructEvent(
//         $payload, $sig_header, $endpoint_secret
//     );

//     http_response_code(200);

//     if ($event->type == 'payment_intent.succeeded') {
//         $paymentIntent = $event->data->object; 
//         file_put_contents('logs.txt', "Paiement réussi: " . $paymentIntent->id . "\n", FILE_APPEND);
//     }

// } catch(\UnexpectedValueException $e) {
//     http_response_code(400);
//     exit();
// } catch(\Stripe\Exception\SignatureVerificationException $e) {
//     http_response_code(400);
//     exit();
// }
require 'vendor/autoload.php';

$webhookSecret = ''; 

$input = @file_get_contents("php://input");
$sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];

try {
    $event = \Stripe\Webhook::constructEvent($input, $sig_header, $webhookSecret);
} catch(\UnexpectedValueException $e) {
    http_response_code(400);
    exit();
} catch(\Stripe\Exception\SignatureVerificationException $e) {
    http_response_code(400);
    exit();
}

switch ($event->type) {
    case 'payment_intent.succeeded':
        $paymentIntent = $event->data->object;
        $paymentDAO = new PaymentDAO();
        $paymentDAO->updatePaymentStatus($paymentIntent->id, 'succeeded');
        break;
    case 'payment_intent.failed':
        $paymentIntent = $event->data->object;
        $paymentDAO = new PaymentDAO();
        $paymentDAO->updatePaymentStatus($paymentIntent->id, 'failed');
        break;
    default:
        break;
}

http_response_code(200);
?>
