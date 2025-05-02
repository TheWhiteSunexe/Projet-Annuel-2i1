<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

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

    public function getUsersByCompany($companyId) {
        try {
            $query = "
SELECT DISTINCT u.id, u.name, u.firstname, u.email, u.username, u.active,
    CASE 
        WHEN u.id_clients IS NOT NULL THEN 'clients'
        WHEN u.id_providers IS NOT NULL THEN 'providers'
        WHEN u.id_admin IS NOT NULL THEN 'admin'
        WHEN u.id_employees IS NOT NULL THEN 'employees'
        ELSE 'unknown'
    END AS role
FROM users u
INNER JOIN employees e ON u.id = e.id_employees
WHERE e.id_enterprise = :companyId;


            ";

            $stmt = $this->pdo->prepare(query: $query);
            $stmt->bindParam(':companyId', $companyId, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            return ['error' => 'Erreur lors de la récupération des utilisateurs de l\'entreprise: ' . $e->getMessage()];
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
