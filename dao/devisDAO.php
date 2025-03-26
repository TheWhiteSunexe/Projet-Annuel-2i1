<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class DevisDAO {

    public static function addDevis($name, $title, $description, $id_client) {
        try {
            $db = getDatabaseConnection();
            $date = date("Y-m-d"); // Format de la date actuelle
    
            // Modification de la requête pour inclure toutes les colonnes
            $query = "
                INSERT INTO contracts (name, date, id_client, title, content, complain, price, pay_status, file, status, active) 
                VALUES (:name, :date, :id_client, :title, :content, NULL, NULL, NULL, NULL, 1, 1)
            ";
    
            $stmt = $db->prepare($query);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':date', $date, PDO::PARAM_STR);
            $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':content', $description, PDO::PARAM_STR);
    
            $stmt->execute();
    
            return $db->lastInsertId();
    
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }
    
    
    
    public static function GetIdclient($id) {
        try {
            $db = getDatabaseConnection();
            $query = "
                SELECT c.id FROM client c INNER JOIN users u ON c.id_user = u.id WHERE u.id = :id
            ";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            return $db->lastInsertId();

        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    public static function getAllDevis($id) {
        try {
            $db = getDatabaseConnection();
            $query = "
                SELECT c.id, c.name, c.date, c.content AS description, c.status, c.active, c.title, cl.name AS entreprise
                FROM contracts c
                INNER JOIN clients cl ON cl.id_user = :id WHERE c.status < 4
            ";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

}

