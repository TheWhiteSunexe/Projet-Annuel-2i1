<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class ApplicationDAO {

    public static function addApplication($id_user, $id_contract, $price) {
        try {
            $db = getDatabaseConnection();
    
            $query = "
                INSERT INTO application (id_provider, id_contract, price) 
                VALUES (:id_user, :id_contract, :price)
            ";
    
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->bindParam(':id_contract', $id_contract, PDO::PARAM_INT);
            $stmt->bindParam(':price', $price, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                return ['id' => $db->lastInsertId()];
            } else {
                return ['error' => 'Insertion échouée'];
            }
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }
    

    public static function getAllApplication() {
        try {
            $db = getDatabaseConnection();
            $query = "
                SELECT id, name, date, content AS description, title
                FROM contracts c 
                WHERE status = 4 
                AND publication = 1 
                AND active = 1
            ";

            
            $stmt = $db->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }
    

}

