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
                WHERE c.status >= 4 AND c.active > 1
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
            
            $query1 = "UPDATE contracts SET status = 5 WHERE id = :id";
            $stmt1 = $db->prepare($query1);
            $stmt1->bindParam(':id', $id, PDO::PARAM_INT);
            $success1 = $stmt1->execute();
    
            $query2 = "UPDATE event SET active = 1 WHERE id_contract = :id";
            $stmt2 = $db->prepare($query2);
            $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
            $success2 = $stmt2->execute();
    
            return ['success' => $success1 && $success2];
    
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }
    
    
    public static function refuseContract($id) {
        try {
            $db = getDatabaseConnection();
            $query = "
                UPDATE contracts SET status = 3, price = NULL, id_provider = NULL, id_application = NULL WHERE id = :id
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

