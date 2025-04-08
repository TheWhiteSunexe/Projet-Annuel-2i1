<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class FactureClientDAO {

    public static function getAllByClient($clientId) {
        try {
            $db = getDatabaseConnection();
            $stmt = $db->prepare("SELECT * FROM client_invoices WHERE client_id = :id ORDER BY issued_date DESC");
            $stmt->bindParam(':id', $clientId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Erreur DB: ' . $e->getMessage()];
        }
    }

    public static function insert($clientId, $amount, $description, $pdfPath) {
        try {
            $db = getDatabaseConnection();
            $stmt = $db->prepare("INSERT INTO client_invoices (client_id, amount, issued_date, pdf_path, description) VALUES (?, ?, CURDATE(), ?, ?)");
            $stmt->execute([$clientId, $amount, $pdfPath, $description]);
            return $db->lastInsertId();
        } catch (PDOException $e) {
            return false;
        }
    }
}
