<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class DAOProvider {

    private $pdo;

    public function __construct() {
        $this->pdo = getDatabaseConnection(); 
    }

    public function getAllProviders() {
        try {
            $query = "
                SELECT u.id, u.name, u.firstname, u.email, p.active
                FROM users u
                INNER JOIN providers p ON p.user_id = u.id;
            ";
            
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    public function updateActiveStatus($providerId, $status) {
        try {
            $query = "
                UPDATE providers 
                SET active = :active
                WHERE user_id = :providerId
            ";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':active', $status, PDO::PARAM_INT);
            $stmt->bindParam(':providerId', $providerId, PDO::PARAM_INT);
            
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            return ['error' => 'Erreur lors de la mise à jour du statut: ' . $e->getMessage()];
        }
    }
}
?>
