<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class RoomDAO {

    public static function addRoom($name, $capacity, $address, $postal_code, $city, $country, $id_client) {
        try {
            $db = getDatabaseConnection();
    
            $query = "
                INSERT INTO room (name, address, postal_code, country, city, capacity, id_client) 
                VALUES (:name, :address, :postal_code, :country, :city, :capacity, :id_client)
            ";
    
            $stmt = $db->prepare($query);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':address', $address, PDO::PARAM_STR);
            $stmt->bindParam(':postal_code', $postal_code, PDO::PARAM_STR); 
            $stmt->bindParam(':country', $country, PDO::PARAM_STR);
            $stmt->bindParam(':city', $city, PDO::PARAM_STR);
            $stmt->bindParam(':capacity', $capacity, PDO::PARAM_INT); 
            $stmt->bindParam(':id_client', $id_client, PDO::PARAM_INT);
    
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

    public static function getAllRoom($id) {
        try {
            $db = getDatabaseConnection();
            $query = "
                SELECT id, name, address, postal_code, country, city, capacity, active
                FROM room WHERE id_client = :id AND active = 1
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

