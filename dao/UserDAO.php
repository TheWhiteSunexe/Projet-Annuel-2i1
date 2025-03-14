<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/Projet-Annuel-2i1/PA2i1/utils/database.php';

class DAOUser {
    public static function getUserById($userId) {
        try {
            $pdo = getDatabaseConnection();
            $query = "SELECT name, firstname, email
                      FROM users 
                      WHERE id = :userId";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return "Erreur DAO : " . $e->getMessage();
        }
    }
}
?>
