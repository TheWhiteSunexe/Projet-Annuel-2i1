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
                SELECT u.id, u.name, u.firstname, u.email, e.id_enterprise, e.status, e.id_users
                FROM users u
                INNER JOIN employees e ON e.id_users = u.id;
            ";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

    // Ajouter un employé
    // Si l'utilisateur existe déjà dans "users", on vérifie qu'il n'est pas déjà client ou provider
    // et qu'il n'est pas déjà employé dans cette entreprise.
    // Sinon, on crée l'utilisateur et on l'associe comme employé.
    public function addEmployee($name, $firstname, $email, $password, $enterpriseId) {
        try {
            // Vérifier si l'email est déjà utilisé dans users
            $checkEmailQuery = "SELECT id, id_clients, id_providers, id_employees FROM users WHERE email = :email";
            $stmt = $this->pdo->prepare($checkEmailQuery);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

            // Vérifier si l'entreprise existe
            $checkEnterpriseQuery = "SELECT id FROM clients WHERE id = :enterpriseId";
            $stmt = $this->pdo->prepare($checkEnterpriseQuery);
            $stmt->bindParam(':enterpriseId', $enterpriseId, PDO::PARAM_INT);
            $stmt->execute();
            if (!$stmt->fetch(PDO::FETCH_ASSOC)) {
                return ['error' => 'L\'entreprise spécifiée n\'existe pas.'];
            }

            if ($existingUser) {
                $userId = $existingUser['id'];
                // Vérifier que l'utilisateur n'est pas déjà client ou prestataire
                if (!empty($existingUser['id_clients']) || !empty($existingUser['id_providers'])) {
                    return ['error' => 'Cet utilisateur est déjà un client ou un prestataire.'];
                }
                // Vérifier s'il est déjà employé dans cette entreprise
                $checkEmployeeQuery = "SELECT id FROM employees WHERE id_users = :userId AND id_enterprise = :enterpriseId";
                $stmt = $this->pdo->prepare($checkEmployeeQuery);
                $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $stmt->bindParam(':enterpriseId', $enterpriseId, PDO::PARAM_INT);
                $stmt->execute();
                if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                    return ['error' => 'Cet utilisateur est déjà employé dans cette entreprise.'];
                }
                // Ajouter l'utilisateur existant en tant qu'employé
                $insertEmployeeQuery = "INSERT INTO employees (id_users, id_enterprise, status) VALUES (:userId, :enterpriseId, 1)";
                $stmt = $this->pdo->prepare($insertEmployeeQuery);
                $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $stmt->bindParam(':enterpriseId', $enterpriseId, PDO::PARAM_INT);
                $stmt->execute();
                return ['success' => 'Utilisateur existant ajouté comme employé dans cette entreprise !'];
            } else {
                // L'utilisateur n'existe pas : créer le nouvel utilisateur
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                // On crée l'utilisateur avec id_employees = 1 (pour signifier qu'il s'agit d'un employé) et active = 1
                $insertUserQuery = "INSERT INTO users (name, firstname, email, password, id_users, active) 
                                    VALUES (:name, :firstname, :email, :password, 1, 1)";
                $stmt = $this->pdo->prepare($insertUserQuery);
                $stmt->bindParam(':name', $name, PDO::PARAM_STR);
                $stmt->bindParam(':firstname', $firstname, PDO::PARAM_STR);
                $stmt->bindParam(':email', $email, PDO::PARAM_STR);
                $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
                $stmt->execute();
                $userId = $this->pdo->lastInsertId();

                // Associer ce nouvel utilisateur comme employé
                $insertEmployeeQuery = "INSERT INTO employees (id_users, id_enterprise, status) VALUES (:userId, :enterpriseId, 1)";
                $stmt = $this->pdo->prepare($insertEmployeeQuery);
                $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $stmt->bindParam(':enterpriseId', $enterpriseId, PDO::PARAM_INT);
                $stmt->execute();
                return ['success' => 'Nouvel employé ajouté avec succès !'];
            }
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données : ' . $e->getMessage()];
        }
    }

    // Modifier un employé (mise à jour des infos dans users)
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

    // Suspendre un employé (status = 0)
    public function suspendEmployee($id) {
        try {
            $query = "UPDATE employees SET status = 0 WHERE id_users = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return ['success' => 'Employé suspendu avec succès !'];
        } catch (PDOException $e) {
            return ['error' => 'Erreur lors de la suspension : ' . $e->getMessage()];
        }
    }

    // Réactiver un employé (status = 1)
    public function reactivateEmployee($id) {
        try {
            $query = "UPDATE employees SET status = 1 WHERE id_users = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return ['success' => 'Employé réactivé avec succès !'];
        } catch (PDOException $e) {
            return ['error' => 'Erreur lors de la réactivation : ' . $e->getMessage()];
        }
    }

    public function getEntrepriseId($id) {
        try {
            $query = "SELECT id FROM clients WHERE id_user = :id";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return ['success' => 'Employé suspendu avec succès !'];
        } catch (PDOException $e) {
            return ['error' => 'Erreur lors de la suspension : ' . $e->getMessage()];
        }
    }
}
?>
