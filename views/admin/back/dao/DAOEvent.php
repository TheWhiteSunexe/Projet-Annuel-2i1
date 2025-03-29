<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class EventDAO {

    public static function addEvent($name, $capacity, $address, $postal_code, $city, $country, $id_admin) {
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
            $stmt->bindParam(':id_client', $id_admin, PDO::PARAM_INT);
    
            $stmt->execute();
    
            return $db->lastInsertId();
    
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }


    public static function getAllEvent() {
        try {
            $db = getDatabaseConnection();
            $query = "
                SELECT e.id, e.id_contract, e.title, e.description, e.start_date, e.end_date, e.start_hour, e.end_hour, e.active, c.name
                FROM event e
                INNER JOIN contracts c
                ON e.id_contract = c.id
                ORDER BY e.start_date
            ";
            
            $stmt = $db->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

}

