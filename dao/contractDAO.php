<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class ContractDAO {

    public static function getAllContracts($id) {
        try {
            $db = getDatabaseConnection();
            $query = "
                SELECT c.id, c.name, c.date, cl.name AS entreprise, c.price, c.active, c.status
                FROM contracts c
                INNER JOIN clients cl ON cl.id_user = :id 
                WHERE c.status >= 5 AND c.active = 1
            ";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    public static function acceptContract($id) {
        try {
            $db = getDatabaseConnection();
            $query = "
                UPDATE contracts SET status = 6 WHERE id = :id
            ";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $success = $stmt->execute();
    
            return ['success' => $success];
    
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }
    
    public static function refuseContract($id) {
        try {
            $db = getDatabaseConnection();
            $query = "
                UPDATE contracts SET status = 4, price = NULL, id_provider = NULL, id_application = NULL WHERE id = :id
            ";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $success = $stmt->execute();
    
            return ['success' => $success];
    
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }
    
    public static function reactivateApplication($id) {
        try {
            $db = getDatabaseConnection();
            $query = "
                UPDATE application SET active = 1 WHERE id_contract = :id
            ";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $success = $stmt->execute();
    
            return ['success' => $success];
    
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

}

