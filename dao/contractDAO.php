<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class ContractDAO {

    public static function getAllContracts($id) {
        try {
            $db = getDatabaseConnection();
            $query = "
                SELECT c.id, c.name, c.date, cl.entreprise 
                FROM contracts c
                INNER JOIN clients cl ON cl.id_user = :id
            ";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // En cas d'erreur avec la base de données
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

}

