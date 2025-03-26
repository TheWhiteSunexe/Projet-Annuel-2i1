<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class ApplicationDAO {

    public static function getAllApplications() {
        try {
            $db = getDatabaseConnection();
            $query = "
                SELECT a.id AS application_id , a.id_provider, a.id_contract, a.price, c.name AS contact_name, u.name AS user_name, u.firstname, u.id AS user_id, p.company_name AS provider_company_name, p.address, p.country, p.postal_code
                FROM application a 
                INNER JOIN contracts c 
                ON a.id_contract = c.id 
                INNER JOIN providers p
                ON a.id_provider = p.id
                INNER JOIN users u
                ON p.user_id = u.id
                WHERE a.active = 1
                ORDER BY a.price ASC
            ";
            //POUR CHOISIR L'ORDRE : Le order by va choisir le prix le plus bas mais on peut changer avec autre chose
            $stmt = $db->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    public static function sendContract($id_provider, $id_contract, $id_application, $price) {
        try {
            $db = getDatabaseConnection();
            $query = "
                UPDATE contracts SET id_provider = :id_provider, price = :price, status = 5, id_application = :id_application WHERE id = :id_contract 
            ";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id_provider', $id_provider, PDO::PARAM_INT);
            $stmt->bindParam(':price', $price, PDO::PARAM_INT);
            $stmt->bindParam(':id_application', $id_application, PDO::PARAM_INT);
            $stmt->bindParam(':id_contract', $id_contract, PDO::PARAM_INT);
    
            $success = $stmt->execute();
    
            return ['success' => $success];
    
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }
    
    public static function updateApplication($id_contract) {
        try {
            $db = getDatabaseConnection();
            $query = "
                UPDATE application SET active = 0 WHERE id_contract = :id_contract
            ";
    
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id_contract', $id_contract, PDO::PARAM_INT);
    
            $success = $stmt->execute();
    
            return ['success' => $success];
    
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }
    
}
