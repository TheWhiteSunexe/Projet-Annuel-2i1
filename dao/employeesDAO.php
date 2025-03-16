<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class EmployeesDAO {

    private $pdo;

    public function __construct() {
        $this->pdo = getDatabaseConnection();
    }

    // Récupérer tous les employés
    public function getAllEmployees() {
        try {
            $query = "
                SELECT u.id, u.name, u.firstname, u.email, e.id_enterprise, e.status
                FROM users u
                INNER JOIN employees e ON e.id_employees = u.id;
            ";

            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    // Ajouter un employé
    public function addEmployee($name, $firstname, $email, $enterpriseId) {
        try {
            $checkQuery = "SELECT id FROM users WHERE email = :email";
            $stmt = $this->pdo->prepare($checkQuery);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($existingUser) {
                return ['error' => 'Cet utilisateur existe déjà.'];
            }

            $userQuery = "INSERT INTO users (name, firstname, email) VALUES (:name, :firstname, :email)";
            $stmt = $this->pdo->prepare($userQuery);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $userId = $this->pdo->lastInsertId();

            $employeeQuery = "INSERT INTO employees (id_employees, id_enterprise, status) VALUES (:userId, :enterpriseId, 1)";
            $stmt = $this->pdo->prepare($employeeQuery);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':enterpriseId', $enterpriseId, PDO::PARAM_INT);
            $stmt->execute();

            return ['success' => 'Employé ajouté avec succès !'];
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données : ' . $e->getMessage()];
        }
    }

    // Modifier un employé
    public function updateEmployee($id, $name, $firstname, $email) {
        try {
            $query = "UPDATE users SET name = :name, firstname = :firstname, email = :email WHERE id = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':name', $name, PDO::PARAM_STR);
            $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            return ['success' => 'Employé mis à jour avec succès !'];
        } catch (PDOException $e) {
            return ['error' => 'Erreur lors de la modification : ' . $e->getMessage()];
        }
    }

    // Suspendre un employé
    public function suspendEmployee($id) {
        try {
            $query = "UPDATE employees SET status = 0 WHERE id_employees = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return ['success' => 'Employé suspendu avec succès !'];
        } catch (PDOException $e) {
            return ['error' => 'Erreur lors de la suspension : ' . $e->getMessage()];
        }
    }

    // Réactiver un employé
    public function reactivateEmployee($id) {
        try {
            $query = "UPDATE employees SET status = 1 WHERE id_employees = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return ['success' => 'Employé réactivé avec succès !'];
        } catch (PDOException $e) {
            return ['error' => 'Erreur lors de la réactivation : ' . $e->getMessage()];
        }
    }
}
?>
