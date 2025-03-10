<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '\Projet-Annuel-2i1\PA2i1\views\admin\back\dao\utils\database.php';

class DAOUser {

    private $pdo;

    public function __construct() {
        $this->pdo = getDatabaseConnection(); 
    }

    public function getAllUsers() {
        try {
            $query = "
                SELECT 
                id, 
                name, 
                firstname, 
                email, 
                username, 
                active,
                CASE 
                    WHEN id_clients IS NOT NULL THEN 'clients'
                    WHEN id_providers IS NOT NULL THEN 'providers'
                    WHEN id_admin IS NOT NULL THEN 'admin'
                    WHEN id_employees IS NOT NULL THEN 'employees'
                    ELSE 'unknown'
                END AS role
                FROM users;
            ";
            
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    public function updateActiveStatus($userId, $status) {
        try {
            $query = "
                UPDATE users 
                SET active = :active
                WHERE id = :userId
            ";

            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':active', $status, PDO::PARAM_INT);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            
            $stmt->execute();
            
            return true;
        } catch (PDOException $e) {
            return ['error' => 'Erreur lors de la mise à jour du statut: ' . $e->getMessage()];
        }
    }
}
?>
