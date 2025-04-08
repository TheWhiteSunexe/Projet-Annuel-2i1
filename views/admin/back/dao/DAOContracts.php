<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class ContractDAO {

    public static function getAllContracts() {
        try {
            $db = getDatabaseConnection();
            $query = "
                SELECT c.id, c.name, c.date, c.content AS description, c.status, c.active, c.title, cl.name AS entreprise
                FROM contracts c
                INNER JOIN clients cl ON cl.id = c.id_client WHERE c.status >= 4
            ";
            
            $stmt = $db->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

}

