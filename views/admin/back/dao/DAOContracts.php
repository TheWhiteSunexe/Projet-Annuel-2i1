<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class ContractDAO {

    public static function getAllContracts() {
        try {
            $db = getDatabaseConnection();
            $query = "
                SELECT c.id, c.name, c.date, c.content AS description, c.status, c.active, c.title, c.price, c.complain, c.capacity, c.location, c.is_medical, c.id_provider, 
                cl.name AS entreprise, p.company_name, p.siret, p.phone, u.email, u.name AS nameProvider, u.firstname AS firstnameProvider, r.name AS nameRoom, r.address, r.postal_code, r.country, r.city,
                e.start_date, e.end_date, e.start_hour, e.end_hour
                FROM contracts c
                INNER JOIN clients cl ON cl.id = c.id_client 
                INNER JOIN providers p ON p.id = c.id_provider
                INNER JOIN users u ON p.user_id = u.id
                INNER JOIN room r ON c.id_room = r.id
                INNER JOIN event e ON id_event = e.id
                WHERE c.status >= 4
            ";
            
            $stmt = $db->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

}

