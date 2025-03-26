<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class DevisDAO {

    public static function getAllDevis() {
        try {
            $db = getDatabaseConnection();
            $query = "
                SELECT c.id, c.name, c.date, c.content AS description, c.status, c.active, c.title, c.publication, cl.name AS entreprise
                FROM contracts c
                INNER JOIN clients cl ON cl.id = c.id_client WHERE c.status < 4
            ";
            
            $stmt = $db->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }
    public static function changeAcceptedStatus($id) {
        try {
            $pdo = getDatabaseConnection();
            $query = "UPDATE contracts SET active = '2' WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function changeRefusedStatus($id) {
        try {
            $pdo = getDatabaseConnection();
            $query = "UPDATE contracts SET active = '0' WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function startApplication($id) {
        try {
            $pdo = getDatabaseConnection();
            $query = "UPDATE contracts SET publication = '1' WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }
    public static function endApplication($id) {
        try {
            $pdo = getDatabaseConnection();
            $query = "UPDATE contracts SET publication = '0' WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }


}

