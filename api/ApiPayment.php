<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/dao/PaymentDAO.php';

\Stripe\Stripe::setApiKey('');

if (isset($_POST['stripeToken'])) {
    $token = $_POST['stripeToken'];

    try {
        $charge = \Stripe\Charge::create([
            'amount' => 59900,
            'currency' => 'usd',
            'description' => 'Test Payment',
            'source' => $token,
        ]);

        if ($charge->status == 'succeeded') {
            $paymentDao = new PaymentDAO();
            $result = $paymentDao->insertPayment(
                $charge->id,
                $charge->amount,
                $charge->currency,
                $charge->status
            );

            if ($result) {
                header("Location: home.php");
                exit();
            } else {
                header("Location: error.php?error=" . urlencode("Database insertion failed"));
                exit();
            }
        } else {
            header("Location: error.php?error=" . urlencode("Payment failed"));
            exit();
        }
    } catch (Exception $e) {
        header("Location: error.php?error=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: error.php?error=" . urlencode("Stripe token missing"));
    exit();
}
?>
