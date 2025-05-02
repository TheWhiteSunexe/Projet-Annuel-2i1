<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class DevisDAO {

    public static function getAllDevis() {
        try {
            $db = getDatabaseConnection();
            $query = "
                SELECT c.id, c.name, c.date, c.content AS description, c.status, c.active, c.title, c.publication, cl.name AS entreprise, cl.id AS id_entreprise, c.capacity, c.complain, c.location, c.is_medical
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
            $query = "UPDATE contracts SET active = '2', status = '2' WHERE id = :id";
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
    public static function startApplication($id, $id_company, $id_room, $start_date, $end_date, $start_hour, $end_hour, $title, $description) {
        try {
            $pdo = getDatabaseConnection();
    
            $query = "INSERT INTO event (id_contract, id_company, title, description, start_date, end_date, start_hour, end_hour, id_room) 
                      VALUES (:id_contract, :id_company, :title, :description, :start_date, :end_date, :start_hour, :end_hour, :id_room)";
            
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id_contract', $id, PDO::PARAM_INT);
            $stmt->bindParam(':id_company', $id_company, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':start_date', $start_date, PDO::PARAM_STR);
            $stmt->bindParam(':end_date', $end_date, PDO::PARAM_STR);
            $stmt->bindParam(':start_hour', $start_hour, PDO::PARAM_STR);
            $stmt->bindParam(':end_hour', $end_hour, PDO::PARAM_STR);
            $stmt->bindParam(':id_room', $id_room, PDO::PARAM_INT);
            
            if (!$stmt->execute()) {
                return false;
            }
    
            $id_event = $pdo->lastInsertId();
    
            $query = "UPDATE contracts SET publication = '1', id_event = :id_event, status = '3' WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':id_event', $id_event, PDO::PARAM_INT);
            
            return $stmt->execute();
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
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

