<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class DAOClient {

    private $pdo;

    public function __construct() {
        $this->pdo = getDatabaseConnection(); 
    }

    public function getAllClients() {
        try {
            $query = "
                SELECT u.id, u.name, u.firstname, u.email, c.name AS company_name, c.id AS company_id, c.active
                FROM users u
                INNER JOIN clients c ON c.id_user = u.id;
            ";
            
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    public function updateActiveStatus($clientId, $status) {
        try {
            $query = "
                UPDATE clients 
                SET active = :active
                WHERE id_user = :clientId
            ";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':active', $status, PDO::PARAM_INT);
            $stmt->bindParam(':clientId', $clientId, PDO::PARAM_INT);
            
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            return ['error' => 'Erreur lors de la mise à jour du statut: ' . $e->getMessage()];
        }
    }
}
?>
