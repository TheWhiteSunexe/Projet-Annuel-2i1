<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class EmployeesDAO {

    public static function getAllEmployees($id) {
        try {
            $db = getDatabaseConnection();
            $query = "
            SELECT u.id, u.name, u.firstname, u.email
            FROM users u
            INNER JOIN employees e ON u.id = e.id_employees
            INNER JOIN clients c ON c.id = e.id_enterprise 
            WHERE c.id_user = :clientId;
            ";
            
            $stmt = $db->prepare($query);
            $stmt->bindParam(':clientId', $_SESSION['id'], PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return ['error' => 'Erreur de base de données: ' . $e->getMessage()];
        }
    }

}

