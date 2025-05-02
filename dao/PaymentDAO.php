<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class PaymentDAO {
    private $conn;

    public function __construct() {
        $this->conn = getDatabaseConnection(); 
    }

    public function insertPayment($paymentIntentId, $amount, $currency, $status) {
        $query = "INSERT INTO payments (payment_intent_id, amount, currency, status) 
                  VALUES (:payment_intent_id, :amount, :currency, :status)";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':payment_intent_id', $paymentIntentId, PDO::PARAM_STR);
        $stmt->bindValue(':amount', $amount, PDO::PARAM_INT);
        $stmt->bindValue(':currency', $currency, PDO::PARAM_STR);
        $stmt->bindValue(':status', $status, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function updatePaymentStatus($paymentIntentId, $status) {
        $query = "UPDATE payments SET status = :status WHERE payment_intent_id = :payment_intent_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':status', $status, PDO::PARAM_STR);
        $stmt->bindValue(':payment_intent_id', $paymentIntentId, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function getPaymentByChargeId($paymentIntentId) {
        $query = "SELECT * FROM payments WHERE payment_intent_id = :payment_intent_id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':payment_intent_id', $paymentIntentId, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
