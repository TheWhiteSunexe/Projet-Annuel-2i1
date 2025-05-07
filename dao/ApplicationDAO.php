<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class ApplicationDAO {

    public static function addApplication($id_contract, $id_provider, $price) {
        try {
            $db = getDatabaseConnection();
    
            $query = "
                INSERT INTO application (id_contract, id_provider, price) 
                VALUES ( :id_contract, :id_provider, :price)
            ";
    
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id_contract', $id_contract, PDO::PARAM_INT);
            $stmt->bindParam(':id_provider', $id_provider, PDO::PARAM_INT);
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
    public static function searchProvider($id_user) {
        try {
            $db = getDatabaseConnection();
            $query = "
                SELECT id
                FROM providers  
                WHERE user_id = :id_user
            ";
    
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
            return $result ? $result['id'] : null;
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }
    
    
    public static function getAllApplication($id_provider) {
        try {
            $db = getDatabaseConnection();
            
            $query = "
                SELECT 
                    c.id, 
                    c.name, 
                    c.date, 
                    c.content AS description, 
                    c.title, 
                    c.id_event, 
                    e.start_date, 
                    e.end_date, 
                    e.start_hour, 
                    e.end_hour, 
                    e.participant, 
                    r.name AS roomName, 
                    r.address, 
                    r.country, 
                    r.city, 
                    r.postal_code
                FROM contracts c
                LEFT JOIN application a 
                    ON c.id = a.id_contract AND a.id_provider = :id_provider
                INNER JOIN event e 
                    ON e.id = c.id_event
                INNER JOIN room r 
                    ON e.id_room = r.id
                WHERE 
                    c.status = 3
                    AND c.publication = 1
                    AND c.active > 1
                    AND a.id IS NULL

            ";
    
            $stmt = $db->prepare($query);
    
            if ($id_provider === null) {
                error_log('Erreur : id_provider est NULL');
                return ['error' => 'Aucun fournisseur trouvé pour cet utilisateur.'];
            }
    
            $stmt->bindParam(':id_provider', $id_provider, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage());
            return ['error' => 'Une erreur interne est survenue.'];
        }
    }

    public static function getAllApplicationHistory($id_provider) {
        try {
            $db = getDatabaseConnection();
            
            $query = "
                SELECT a.id, c.name, c.date, c.content AS description, c.title, a.active, a.price
            FROM contracts c 
            LEFT JOIN application a 
            ON c.id = a.id_contract AND a.id_provider = :id_provider
            WHERE a.id_provider = :id_provider
            AND (c.id_application IS NULL OR a.id != c.id_application)
            ";
    
            $stmt = $db->prepare($query);
    
            if ($id_provider === null) {
                error_log('Erreur : id_provider est NULL');
                return ['error' => 'Aucun fournisseur trouvé pour cet utilisateur.'];
            }
    
            $stmt->bindParam(':id_provider', $id_provider, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage());
            return ['error' => 'Une erreur interne est survenue.'];
        }
    }
    
}

